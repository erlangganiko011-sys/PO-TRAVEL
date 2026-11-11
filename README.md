# PO CAN Travel

**Sistem Pemesanan Tiket Bus Berbasis Web**

## Deskripsi
PO CAN Travel merupakan aplikasi berbasis web yang dibuat menggunakan Laravel 10 untuk memudahkan pengguna dalam mencari jadwal bus, memilih kursi, dan melakukan pemesanan tiket bus secara online.

## Teknologi yang Digunakan
- Laravel 10
- PHP
- MySQL
- Bootstrap
- JavaScript
- Laravel Breeze

## Fitur Aplikasi
1. Registrasi akun pengguna.
2. Login dan logout.
3. Pencarian jadwal bus.
4. Melihat detail jadwal dan informasi bus.
5. Pemilihan kursi bus.
6. Pemesanan tiket bus.
7. Melihat detail pemesanan.
8. Dashboard admin.

**Catatan:** Status pembayaran masih menggunakan status pending. Integrasi payment gateway belum diterapkan.

## Database
Database yang digunakan bernama `po_can_travel1`.

Tabel yang digunakan:
- users
- buses
- seats
- terminals
- routes
- schedules
- bookings
- booking_details
- payments

## Entity Relationship Diagram (ERD)

ERD dapat dilihat pada folder berikut:

`ERD/CAN TRAVEL.png`

## Cara Menjalankan Project

1. Clone repository:
   ```bash
   git clone URL_REPOSITORY
   ```

2. Masuk ke folder project:
   ```bash
   cd po-can-travel
   ```

3. Install dependency Laravel:
   ```bash
   composer install
   ```

4. Salin file konfigurasi:
   ```bash
   cp .env.example .env
   ```

5. Buat application key:
   ```bash
   php artisan key:generate
   ```

6. Atur koneksi database pada file `.env`.

7. Jalankan migration:
   ```bash
   php artisan migrate
   ```

8. Isi data contoh:
   ```bash
   php artisan db:seed --class=DemoBusSeeder
   ```

9. Install dan jalankan frontend:
   ```bash
   npm install
   npm run build
   ```

10. Jalankan aplikasi:
    ```bash
    php artisan serve
    ```

Buka browser dan akses:

`http://127.0.0.1:8000`

## Pengembang
Project PO CAN Travel dibuat sebagai project pembelajaran pengembangan aplikasi web menggunakan Laravel 10.
