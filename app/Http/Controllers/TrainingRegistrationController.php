<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingForm;
use App\Models\TrainingRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrainingRegistrationController extends Controller
{
    // Method untuk menampilkan form pendaftaran (customer)
    public function create(TrainingForm $trainingForm)
    {
        // Cek apakah form masih aktif dan ada kuota
        if (!$trainingForm->is_active) {
            return redirect()->route('training-forms.index')
                ->with('error', 'Pendaftaran untuk pelatihan ini sudah ditutup.');
        }

        if (!$trainingForm->hasAvailableQuota()) {
            return redirect()->route('training-forms.index')
                ->with('error', 'Kuota untuk pelatihan ini sudah penuh.');
        }

        $trainingForm->load('fields');

        return view('customer.training-register', compact('trainingForm'));
    }

    // Method untuk menyimpan pendaftaran (customer)
    public function store(Request $request, TrainingForm $trainingForm)
    {
        // Cek apakah form masih aktif dan ada kuota
        if (!$trainingForm->is_active || !$trainingForm->hasAvailableQuota()) {
            return redirect()->route('training-forms.index')
                ->with('error', 'Pendaftaran tidak dapat dilakukan.');
        }

        try {
            // PERBAIKAN: Hapus validasi terms yang tidak ada di form
            $rules = [];

            // Load fields untuk validasi
            $trainingForm->load('fields');

            // Validasi custom fields
            foreach ($trainingForm->fields as $field) {
                $fieldRule = [];

                if ($field->is_required) {
                    $fieldRule[] = 'required';
                } else {
                    $fieldRule[] = 'nullable';
                }

                switch ($field->field_type) {
                    case 'email':
                        $fieldRule[] = 'email';
                        break;
                    case 'phone':
                        $fieldRule[] = 'string|max:20';
                        break;
                    case 'file':
                        if ($field->is_required) {
                            $fieldRule[] = 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048';
                        } else {
                            $fieldRule[] = 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048';
                        }
                        break;
                    case 'textarea':
                        $fieldRule[] = 'string|max:1000';
                        break;
                    default:
                        $fieldRule[] = 'string|max:255';
                        break;
                }

                $rules["answers.{$field->field_name}"] = implode('|', $fieldRule);
            }

            // Log untuk debugging
            Log::info('Validation Rules:', $rules);
            Log::info('Request Data:', $request->all());

            $validated = $request->validate($rules);

            DB::transaction(function () use ($validated, $request, $trainingForm) {
                // Handle file uploads
                $answers = $validated['answers'] ?? [];

                // Handle custom field file uploads
                foreach ($trainingForm->fields as $field) {
                    if ($field->field_type === 'file' && $request->hasFile("answers.{$field->field_name}")) {
                        $filePath = $request->file("answers.{$field->field_name}")
                            ->store('training-files', 'public');
                        $answers[$field->field_name] = $filePath;
                    }
                }

                // Extract email dari answers untuk kolom email yang terpisah
                $email = null;
                $name = null;
                $phone = null;
                $paymentProof = null;

                // Cari field email, name, phone, dan payment proof dari answers
                foreach ($answers as $fieldName => $value) {
                    $fieldNameLower = strtolower($fieldName);

                    // Untuk nama - simpan sebagai backup
                    if (in_array($fieldNameLower, ['nama', 'name', 'full_name', 'fullname', 'nama_lengkap'])) {
                        $name = $value;
                    }

                    // Untuk email - ini akan disimpan di kolom email terpisah
                    if (in_array($fieldNameLower, ['email', 'e-mail', 'alamat_email'])) {
                        $email = $value;
                    }

                    // Untuk phone - simpan sebagai backup
                    if (in_array($fieldNameLower, ['telepon', 'phone', 'no_telepon', 'nomor_telepon', 'no_hp', 'handphone'])) {
                        $phone = $value;
                    }

                    // Untuk payment proof - simpan sebagai backup
                    if (in_array($fieldNameLower, ['payment_proof', 'bukti_bayar', 'bukti_pembayaran', 'proof_of_payment'])) {
                        $paymentProof = $value;
                    }
                }

                // Jika masih null, cari berdasarkan field type
                if (!$email || !$phone) {
                    foreach ($trainingForm->fields as $field) {
                        if ($field->field_type === 'email' && !$email && isset($answers[$field->field_name])) {
                            $email = $answers[$field->field_name];
                        }
                        if ($field->field_type === 'phone' && !$phone && isset($answers[$field->field_name])) {
                            $phone = $answers[$field->field_name];
                        }
                    }
                }

                // Simpan data backup ke dalam answers array
                if ($name) {
                    $answers['backup_name'] = $name;
                }
                if ($phone) {
                    $answers['backup_phone'] = $phone;
                }
                if ($paymentProof) {
                    $answers['backup_payment_proof'] = $paymentProof;
                }

                // Create registration sesuai dengan struktur model baru
                TrainingRegistration::create([
                    'training_form_id' => $trainingForm->id,
                    'email' => $email, // Email disimpan di kolom terpisah
                    'answers' => $answers, // Semua jawaban termasuk backup data
                    'status' => TrainingRegistration::STATUS_PENDING,
                    'registered_at' => now()
                ]);

                // PERBAIKAN: JANGAN increment kuota di sini!
                // Kuota hanya akan bertambah saat status berubah ke approved
                Log::info('Registration created with PENDING status - quota not incremented yet');
            });

            return redirect()->route('training.success')
                ->with('success', 'Pendaftaran berhasil! Silakan tunggu konfirmasi dari admin.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Training Registration Error:', [
                'message' => $e->getMessage(),
                'training_form_id' => $trainingForm->id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Method untuk admin melihat daftar registrasi
    public function index(Request $request)
    {
        $query = TrainingRegistration::with(['trainingForm'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by training form
        if ($request->filled('training_form_id')) {
            $query->where('training_form_id', $request->training_form_id);
        }

        $registrations = $query->paginate(15);

        // Get training forms for filter
        $trainingForms = TrainingForm::orderBy('title')->get();

        return view('mitra.training-registrations.index', compact('registrations', 'trainingForms'));
    }

    // Method untuk admin melihat detail registrasi
    public function show(TrainingRegistration $trainingRegistration)
    {
        $trainingRegistration->load(['trainingForm.fields']);

        return view('mitra.training-registrations.show', compact('trainingRegistration'));
    }

    // Method untuk menampilkan jawaban form pelatihan
    public function showAnswers(TrainingForm $form)
    {
        // Load semua registrasi untuk form ini
        $registrations = TrainingRegistration::where('training_form_id', $form->id)
            ->with(['trainingForm.fields'])
            ->orderBy('registered_at', 'desc')
            ->paginate(10);

        // Load fields untuk form
        $form->load('fields');

        // Hitung ulang kuota berdasarkan data aktual (hanya yang approved)
        $this->recalculateQuota($form);

        return view('mitra.training-forms.answers', compact('form', 'registrations'));
    }

    // Method untuk menghitung ulang kuota (HANYA APPROVED)
    private function recalculateQuota(TrainingForm $form)
    {
        // PERBAIKAN: Hitung berdasarkan registrasi yang APPROVED saja
        $approvedRegistrations = TrainingRegistration::where('training_form_id', $form->id)
            ->where('status', TrainingRegistration::STATUS_APPROVED)
            ->count();

        // Update current_quota jika berbeda
        if ($form->current_quota != $approvedRegistrations) {
            $oldQuota = $form->current_quota;
            $form->update(['current_quota' => $approvedRegistrations]);

            Log::info('Quota recalculated:', [
                'form_id' => $form->id,
                'form_title' => $form->title,
                'old_quota' => $oldQuota,
                'new_quota' => $approvedRegistrations,
                'max_quota' => $form->max_quota
            ]);
        }
    }

    // Method update status dengan logika kuota yang benar
    public function updateStatus(Request $request, TrainingRegistration $trainingRegistration)
    {
        try {
            Log::info('Update Status Request:', [
                'registration_id' => $trainingRegistration->id,
                'current_status' => $trainingRegistration->status,
                'requested_status' => $request->get('status')
            ]);

            $validated = $request->validate([
                'status' => 'required|in:pending,approved,rejected'
            ]);

            $oldStatus = $trainingRegistration->status;
            $newStatus = $validated['status'];

            // Jangan lakukan apa-apa jika status sama
            if ($oldStatus === $newStatus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status sudah ' . ucfirst($newStatus)
                ]);
            }

            DB::transaction(function () use ($trainingRegistration, $oldStatus, $newStatus) {
                // Update status registration
                $trainingRegistration->update([
                    'status' => $newStatus
                ]);

                // PERBAIKAN: Update kuota berdasarkan perubahan status
                $trainingForm = $trainingRegistration->trainingForm;

                // Jika status berubah dari non-approved ke approved: +1 kuota
                if ($oldStatus !== TrainingRegistration::STATUS_APPROVED && $newStatus === TrainingRegistration::STATUS_APPROVED) {
                    $trainingForm->increment('current_quota');

                    Log::info('Quota incremented:', [
                        'form_id' => $trainingForm->id,
                        'old_quota' => $trainingForm->current_quota - 1,
                        'new_quota' => $trainingForm->current_quota,
                        'reason' => "Status changed from {$oldStatus} to {$newStatus}"
                    ]);
                }

                // Jika status berubah dari approved ke non-approved: -1 kuota
                elseif ($oldStatus === TrainingRegistration::STATUS_APPROVED && $newStatus !== TrainingRegistration::STATUS_APPROVED) {
                    $trainingForm->decrement('current_quota');

                    Log::info('Quota decremented:', [
                        'form_id' => $trainingForm->id,
                        'old_quota' => $trainingForm->current_quota + 1,
                        'new_quota' => $trainingForm->current_quota,
                        'reason' => "Status changed from {$oldStatus} to {$newStatus}"
                    ]);
                }
            });

            Log::info('Status Updated Successfully:', [
                'registration_id' => $trainingRegistration->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui menjadi ' . ucfirst($newStatus),
                'data' => [
                    'id' => $trainingRegistration->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Update Status Error:', [
                'message' => $e->getMessage(),
                'registration_id' => $trainingRegistration->id ?? 'unknown',
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }
}
