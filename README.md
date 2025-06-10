# 🌿 SJAM GAMA FARM – Sistem Informasi Manajemen Pemasaran Produk Hidroponik dan Pelatihan

Sistem informasi berbasis website yang dikembangkan untuk membantu **SJAM GAMA FARM** dalam mengelola penjualan produk hidroponik dan pelatihan secara digital.  
Proyek ini merupakan tugas dari mata kuliah **Pengembangan Perangkat Lunak untuk Agroindustri Modern**.

---

## 👨‍💻 Tim Pengembang

| Nama                                 | NIM            |
|--------------------------------------|----------------|
| Danish Najwa El Moslem Himam         | 232410101056   |
| Muhammad Najmi Nafis Zuhair          | 232410101066   |
| Keysha Kinanti A                     | 232410101067   |
| Reyvandi Adji Pramudya               | 232410101091   |

---

## 🚀 Cara Menjalankan Proyek Ini

Ikuti langkah-langkah berikut untuk menjalankan proyek Laravel ini di komputer lokal kamu:

### 1. Clone Repository

```bash
git clone https://github.com/Napeace/Sjam-Gama-Farm.git
cd Sjam-Gama-Farm
```

### 2. Install Dependencies
Install dependency PHP dengan Composer:
```bash
composer install
```
Install dependency JavaScript (untuk Tailwind, dll):
```bash
npm install
```

### 3. Konfigurasi File .env
Salin file .env.example menjadi .env:
```bash
cp .env.example .env
```
Ubah konfigurasi database di file .env sesuai dengan environment lokal kamu, misalnya:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sjam_gama_farm
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database
```bash
php artisan migrate
```

### 6. Jalankan Build Front-End (Tailwind)
Untuk build production:
```bash
npm run build
```

### 6. Jalankan Server Lokal Laravel
```bash
php artisan serve
```
Aplikasi dapat diakses melalui: http://127.0.0.1:8000

## 🧰 Kebutuhan Sistem

- PHP >= 8.1  
- Composer  
- Node.js & npm  
- MySQL
- Git (opsional, untuk clone repo)
