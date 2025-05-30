<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingForm;
use App\Models\TrainingFormField;
use App\Models\TrainingRegistration; // Tambahkan import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrainingFormController extends Controller
{
    public function index(Request $request)
    {
        // PERBAIKAN: Ambil semua training forms dengan hitung approved registrations
        $allTrainingForms = TrainingForm::withCount([
            'registrations', // Total semua registrasi (untuk statistik umum)
            'registrations as approved_registrations_count' => function ($query) {
                $query->where('status', TrainingRegistration::STATUS_APPROVED);
            }
        ])->get();

        // Query untuk pagination dengan filter - juga hitung approved registrations
        $query = TrainingForm::withCount([
            'registrations', // Total semua registrasi
            'registrations as approved_registrations_count' => function ($query) {
                $query->where('status', TrainingRegistration::STATUS_APPROVED);
            }
        ])->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $trainingForms = $query->paginate(9); // 9 items per page (3x3 grid)

        // Append query parameters untuk pagination
        $trainingForms->appends($request->query());

        // Pass both collections to view
        return view('mitra.training-forms.index', compact('trainingForms', 'allTrainingForms'));
    }

    public function create()
    {
        return view('mitra.training-forms.create');
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        Log::info('Training Form Store Request:', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'max_quota' => 'required|integer|min:1',
                'training_date' => 'required|date|after:today',
                'training_time' => 'nullable|date_format:H:i',
                'location' => 'nullable|string',
                'location_url' => 'nullable|url',
                'price' => 'required|numeric|min:0',
                'fields' => 'required|array|min:1',
                'fields.*.field_name' => 'required|string|max:255',
                'fields.*.field_type' => 'required|in:text,textarea,email,phone,file',
                'fields.*.field_description' => 'nullable|string',
                'fields.*.is_required' => 'sometimes|boolean'
            ]);

            DB::transaction(function () use ($validated) {
                // Buat training form - tambahkan current_quota = 0
                $trainingForm = TrainingForm::create([
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?? null,
                    'max_quota' => $validated['max_quota'],
                    'current_quota' => 0, // Tambahkan ini
                    'training_date' => $validated['training_date'],
                    'training_time' => $validated['training_time'] ?? null,
                    'location' => $validated['location'] ?? null,
                    'location_url' => $validated['location_url'] ?? null,
                    'price' => $validated['price'],
                    'is_active' => true
                ]);

                // Buat fields
                foreach ($validated['fields'] as $index => $field) {
                    TrainingFormField::create([
                        'training_form_id' => $trainingForm->id,
                        'field_name' => $field['field_name'],
                        'field_type' => $field['field_type'],
                        'field_description' => $field['field_description'] ?? null,
                        'is_required' => isset($field['is_required']) ? (bool)$field['is_required'] : false,
                        'field_order' => $index + 1
                    ]);
                }
            });

            return redirect()->route('mitra.training-forms.index')
                ->with('success', 'Form Pelatihan berhasil dibuat');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Training Form Store Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(TrainingForm $trainingForm)
    {
        $trainingForm->load(['fields', 'registrations']);

        return view('mitra.training-forms.show', compact('trainingForm'));
    }

    public function edit(TrainingForm $trainingForm)
    {
        $trainingForm->load('fields');

        return view('mitra.training-forms.edit', compact('trainingForm'));
    }

    public function update(Request $request, TrainingForm $trainingForm)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'max_quota' => 'required|integer|min:' . $trainingForm->actual_current_quota, // Gunakan actual_current_quota
                'training_date' => 'required|date',
                'training_time' => 'nullable|date_format:H:i',
                'location' => 'nullable|string',
                'location_url' => 'nullable|url',
                'price' => 'required|numeric|min:0',
                'is_active' => 'sometimes|boolean',
                'fields' => 'required|array|min:1',
                'fields.*.field_name' => 'required|string|max:255',
                'fields.*.field_type' => 'required|in:text,textarea,email,phone,file',
                'fields.*.field_description' => 'nullable|string',
                'fields.*.is_required' => 'sometimes|boolean'
            ]);

            DB::transaction(function () use ($validated, $trainingForm) {
                // Update training form
                $trainingForm->update([
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?? null,
                    'max_quota' => $validated['max_quota'],
                    'training_date' => $validated['training_date'],
                    'training_time' => $validated['training_time'] ?? null,
                    'location' => $validated['location'] ?? null,
                    'location_url' => $validated['location_url'] ?? null,
                    'price' => $validated['price'],
                    'is_active' => isset($validated['is_active']) ? (bool)$validated['is_active'] : true
                ]);

                // Hapus field lama dan buat yang baru
                $trainingForm->fields()->delete();

                foreach ($validated['fields'] as $index => $field) {
                    TrainingFormField::create([
                        'training_form_id' => $trainingForm->id,
                        'field_name' => $field['field_name'],
                        'field_type' => $field['field_type'],
                        'field_description' => $field['field_description'] ?? null,
                        'is_required' => isset($field['is_required']) ? (bool)$field['is_required'] : false,
                        'field_order' => $index + 1
                    ]);
                }
            });

            return redirect()->route('mitra.training-forms.index')
                ->with('success', 'Form Pelatihan berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Training Form Update Error:', [
                'message' => $e->getMessage(),
                'training_form_id' => $trainingForm->id
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui form')
                ->withInput();
        }
    }

    public function destroy(TrainingForm $trainingForm)
    {
        if ($trainingForm->registrations()->count() > 0) {
            return redirect()->route('mitra.training-forms.index')
                ->with('error', 'Tidak dapat menghapus form yang sudah memiliki pendaftar');
        }

        $trainingForm->delete();

        return redirect()->route('mitra.training-forms.index')
            ->with('success', 'Form Pelatihan berhasil dihapus');
    }

    public function toggle(TrainingForm $trainingForm)
    {
        $trainingForm->update([
            'is_active' => !$trainingForm->is_active
        ]);

        $status = $trainingForm->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('mitra.training-forms.index')
            ->with('success', "Form Pelatihan berhasil {$status}");
    }

    public function viewAnswers(TrainingForm $trainingForm)
    {
        // Debug logging
        Log::info('ViewAnswers Method Called', [
            'training_form_id' => $trainingForm->id,
            'training_form_title' => $trainingForm->title
        ]);

        try {
            $registrations = $trainingForm->registrations()
                ->with('trainingForm.fields')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            Log::info('Registrations Loaded', [
                'count' => $registrations->count(),
                'total' => $registrations->total()
            ]);

            return view('mitra.training-forms.answers', compact('trainingForm', 'registrations'));

        } catch (\Exception $e) {
            Log::error('Error in ViewAnswers Method', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->route('mitra.training-forms.index')
                ->with('error', 'Terjadi kesalahan saat menampilkan jawaban: ' . $e->getMessage());
        }
    }
}
