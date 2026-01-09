# 🎓 Aplikasi Manajemen Uji Kompetensi Keahlian

Aplikasi manajemen uji kompetensi keahlian berbasis **Laravel 12** dengan **MySQL (XAMPP)**, **Bootstrap 5**, dan **Authentication**.

## 🌟 Fitur Utama

### 👨‍🏫 **Admin**
- **Dashboard**: Statistik total siswa, guru, kelas, dan jadwal
- **Manajemen User**: Tambah, edit, hapus user (admin, guru, siswa)
- **Manajemen Kelas**: Kelola data kelas dan jurusan
- **Manajemen Jadwal Bimbingan**: Buat dan kelola jadwal bimbingan
- **Manajemen Jadwal Lab**: Buat dan kelola jadwal penggunaan lab
- **Laporan Absensi**: Lihat semua data absensi
- **Laporan Nilai**: Lihat semua nilai siswa
- **Halaman Login Khusus**: Akses hanya untuk admin

### 👨‍🏫 **Guru (Biasa & Pembimbing)**
- **Dashboard**: Ringkasan jadwal dan aktivitas
- **Jadwal Bimbingan**: Buat jadwal bimbingan untuk kelas
- **Jadwal Lab**: Buat jadwal lab untuk praktik siswa
- **Absensi**: Lihat dan kelola absensi siswa
- **Penilaian**: Input nilai kompetensi dan sikap siswa
- **Akses Berbasis Role**: Siswa hanya melihat jadwal dan nilai mereka sendiri

### 🎓 **Siswa**
- **Dashboard**: Lihat jadwal bimbingan, jadwal lab, dan nilai
- **Jadwal Bimbingan**: Lihat jadwal bimbingan kelas
- **Jadwal Lab**: Lihat jadwal penggunaan lab
- **Nilai**: Lihat riwayat nilai dan catatan guru
- **Profile**: Update data pribadi

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Frontend**: Blade Templates dengan Bootstrap 5
- **Database**: MySQL (XAMPP)
- **Authentication**: Laravel Breeze (Blade Stack)
- **Role Management**: Custom Middleware (Admin, Guru, Siswa)

## 📦 Struktur Database

### **Users**
- id
- name
- username (unique)
- email (unique)
- password (hashed)
- role (admin, guru, siswa)
- status_guru (biasa, pembimbing)
- nis (Nomor Induk Siswa)
- nip (Nomor Induk Pegawai)

### **Kelas**
- id
- nama_kelas
- jurusan
- angkatan

### **Jadwal Bimbingan**
- id
- kelas_id (foreign)
- guru_id (foreign)
- tanggal
- waktu_mulai
- waktu_selesai
- materi

### **Jadwal Lab**
- id
- kelas_id (foreign)
- guru_id (foreign)
- tanggal
- waktu_mulai
- waktu_selesai
- materi

### **Absensi**
- id
- jadwal_bimbingan_id (foreign)
- siswa_id (foreign)
- status_kehadiran (hadir, izin, alpa, sakit)
- keterangan
- tanggal

### **Nilai**
- id
- siswa_id (foreign)
- jadwal_bimbingan_id (foreign)
- guru_id (foreign)
- nilai_kompetensi (0-100)
- nilai_sikap (0-100)
- catatan
- tanggal_penilaian

## 📋 Instalasi & Konfigurasi

### **1. Prasyarat**
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL (XAMPP)
- Apache/Nginx Web Server

### **2. Clone Proyek**
```bash
cd /home/z/my-project/laravel-app
```

### **3. Install Dependencies**
```bash
composer install
```

### **4. Konfigurasi Environment**
Buat file `.env` dari `.env.example`:
```bash
cp .env.example .env
```

Edit file `.env` sesuai dengan konfigurasi XAMPP:
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uji_kompetensi
DB_USERNAME=root
DB_PASSWORD=
```

### **5. Generate Application Key**
```bash
php artisan key:generate
```

### **6. Buat Database di MySQL**
Buka phpMyAdmin dan buat database:
- Database Name: `uji_kompetensi`
- Collation: `utf8mb4_unicode_ci`

### **7. Jalankan Migrations**
```bash
php artisan migrate
```

### **8. Buat Data Awal (Seeder)**
```bash
php artisan db:seed
```

### **9. Jalankan Development Server**
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## 👤 Akun Default

Setelah menjalankan seeder, login dengan:

### **Admin**
- Email: `admin@ukkapp.com`
- Password: `password123`

### **Guru (Pembimbing)**
- Email: `guru@ukkapp.com`
- Password: `password123`

### **Siswa**
- Email: `siswa@ukkapp.com`
- Password: `password123`

> ⚠️ **PENTING**: Ubah password default setelah login pertama!

## 🔐 Fitur Keamanan

- ✅ Password hashing menggunakan bcrypt
- ✅ CSRF protection untuk semua form
- ✅ Input validation
- ✅ SQL Injection protection (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ Role-based access control middleware

## 📂 Struktur Direktori

```
laravel-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── GuruController.php
│   │   │   ├── SiswaController.php
│   │   │   └── AuthController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       ├── GuruMiddleware.php
│   │       └── SiswaMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Kelas.php
│       ├── JadwalBimbingan.php
│       ├── JadwalLab.php
│       ├── Absensi.php
│       └── Nilai.php
├── config/
│   └── database.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       ├── admin/
│       ├── guru/
│       └── siswa/
└── routes/
    └── web.php
```

## 🚀 Cara Menjalankan Aplikasi

### **Opsi 1: Development Server (Laravel Artisan)**
```bash
cd /home/z/my-project/laravel-app
php artisan serve
```
Buka browser: `http://localhost:8000`

### **Opsi 2: XAMPP Apache**
1. Konfigurasi VirtualHost Apache untuk mengarah ke:
   `/home/z/my-project/laravel-app/public`
2. Restart Apache
3. Buka browser: `http://ukkapp.local`

## 📝 Penggunaan Aplikasi

### **Untuk Admin:**
1. Login dengan akun admin
2. Akses menu manajemen
3. Tambah data guru dan siswa
4. Buat kelas dan jadwal
5. Pantau absensi dan nilai

### **Untuk Guru:**
1. Login dengan akun guru
2. Buat jadwal bimbingan dan lab
3. Input absensi siswa
4. Input nilai kompetensi dan sikap
5. Lihat statistik performa siswa

### **Untuk Siswa:**
1. Login dengan akun siswa
2. Lihat jadwal bimbingan dan lab
3. Cek riwayat nilai
4. Update profile pribadi

## 🔧 Troubleshooting

### **Database Connection Error**
- Pastikan MySQL di XAMPP berjalan
- Cek kredensial database di `.env`
- Pastikan database `uji_kompetensi` sudah dibuat

### **Migration Error**
- Pastikan database sudah dibuat
- Hapus tabel manual jika perlu dan jalankan `php artisan migrate:fresh`

### **Permission Denied**
- Berikan akses tulis ke storage:
```bash
chmod -R 775 storage bootstrap/cache
```

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pendidikan SMK DATA dan dapat dimodifikasi sesuai kebutuhan.

## 👥 Tim Pengembang

Aplikasi ini dibuat dengan ❤️ untuk mendukung manajemen uji kompetensi keahlian di SMK DATA.

---

**© 2024 SMK DATA - Uji Kompetensi Keahlian Management**
