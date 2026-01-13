# LaundryUAS

## Deskripsi
Proyek ini adalah aplikasi manajemen laundry sederhana yang dibangun menggunakan framework Laravel. Tujuan utama proyek ini adalah untuk memenuhi tugas UAS (Ujian Akhir Semester) dengan tema laundry. Aplikasi ini memungkinkan pengelolaan data pelanggan, pesanan laundry, harga layanan, dan fitur dasar lainnya untuk operasional laundry sehari-hari.

Aplikasi ini mencakup backend dengan PHP dan frontend menggunakan Blade templating, dengan dukungan untuk database melalui migrasi Laravel.

## Fitur Utama
- **Manajemen Pelanggan**: Tambah, edit, hapus data pelanggan.
- **Manajemen Pesanan**: Buat pesanan baru, lacak status (misalnya: diterima, diproses, selesai), dan hitung biaya.
- **Manajemen Layanan**: Definisi jenis layanan laundry beserta harga (misalnya: cuci kering, setrika, dll.).
- **Dashboard Admin**: Tampilan ringkasan untuk pengelola.
- **Autentikasi**: Login sederhana untuk user/admin (jika diimplementasikan).
- **Database Integration**: Menggunakan migrasi untuk tabel-tabel terkait laundry.


## Teknologi yang Digunakan
- **Backend**: PHP dengan Laravel Framework (versi terbaru berdasarkan composer.json).
- **Frontend**: Blade templating engine, dengan dukungan CSS/JS melalui Vite.
- **Database**: MySQL atau database lain yang dikonfigurasi di .env (migrasi di database/migrations).
- **Dependencies**:
  - Composer untuk PHP packages (Laravel core).
  - NPM/Vite untuk asset bundling (JavaScript/CSS).
- **Testing**: PHPUnit untuk unit dan integration tests.

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- Node.js dan NPM
- Database server (misalnya: MySQL)
- Web server (misalnya: Apache/Nginx) atau gunakan Laravel's built-in server untuk development.

## Instalasi
1. Clone repository:
   ```
   git clone https://github.com/Muhammad-Rizqan/laundryuas.git
   cd laundryuas
   ```

2. Install dependencies:
   ```
   composer install
   npm install
   ```

3. Salin file environment example dan generate key:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Konfigurasi database di file `.env` (DB_CONNECTION, DB_HOST, dll.).

5. Jalankan migrasi database:
   ```
   php artisan migrate
   ```

6. (Opsional) Seed data dummy jika ada:
   ```
   php artisan db:seed
   ```

7. Build assets:
   ```
   npm run dev
   ```

8. Jalankan server:
   ```
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000`.

## Penggunaan
- Buka browser dan akses URL server.
- Login sebagai admin (jika autentikasi diimplementasikan; default credentials mungkin ada di seeder).
- Gunakan menu untuk mengelola pelanggan, pesanan, dan layanan.
- Untuk pengembangan lebih lanjut, edit controller di `app/Http/Controllers`, views di `resources/views`, dan routes di `routes/web.php`.

## Kontribusi
Jika ingin berkontribusi:
1. Fork repository ini.
2. Buat branch baru: `git checkout -b feature/nama-fitur`.
3. Commit perubahan: `git commit -m 'Tambah fitur X'`.
4. Push ke branch: `git push origin feature/nama-fitur`.
5. Buat Pull Request.

## Lisensi
Proyek ini open-source di bawah lisensi MIT (atau sesuaikan sesuai kebutuhan). Silakan gunakan dan modifikasi sesuai keperluan.

## Kontak
- Pemilik: Muhammad Rizqan
- GitHub: [Muhammad-Rizqan](https://github.com/Muhammad-Rizqan)

Terima kasih telah menggunakan proyek ini! Jika ada pertanyaan, buka issue di repository.
