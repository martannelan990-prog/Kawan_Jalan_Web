# Kawan Jalan - Laravel Mobile Web

Project ini sudah diubah dari struktur toko menjadi aplikasi wisata **Kawan Jalan** berdasarkan 23 desain Figma/screenshot yang dikirim.

Desain dibuat ulang dengan Blade + CSS, bukan menempelkan screenshot Figma sebagai gambar halaman. Asset yang dipakai hanya logo dan hero login.

## Fitur

- Beranda mobile dengan destinasi terlaris, rekomendasi, bottom navigation
- Login, register, forgot password
- Multi akun: `user` dan `admin`
- User wajib login sebelum beli tiket
- Search kota/destinasi
- Detail wisata kota Bogor dan daftar destinasi
- Favorit
- Payment QRIS/barcode dengan countdown 15 menit
- Pembayaran berhasil, barcode grup wisata, tombol e-ticket
- E-ticket otomatis masuk ke menu Jadwal setelah pembayaran dikonfirmasi
- Notifikasi
- Profile, edit profile, ganti password, riwayat wisata
- Setting account, bantuan FAQ, saran, laporan guide/grup
- Admin dashboard, kelola user, kelola laporan grup wisata

## Akun Demo

```txt
Admin
email: admin@kawanjalan.com
password: password

User
email: user@gmail.com
password: password
```

## Instalasi

```bash
php artisan view:clear
php artisan route:clear
php artisan config:clear
npm run dev 
php artisan serve
```

Buka:

```txt
http://127.0.0.1:8000
```

## Database SQL Manual

File SQL tersedia di:

```txt
database/db_kawan_jalan.sql
```

Import manual:

```bash
mysql -u root -p nama_database < database/db_kawan_jalan.sql
```

## File penting

```txt
routes/web.php
app/Http/Controllers/AuthController.php
app/Http/Controllers/PageController.php
app/Http/Controllers/PaymentController.php
app/Http/Controllers/AdminController.php
resources/views/**/*.blade.php
resources/css/app.css
database/migrations/2026_05_15_000001_create_kawan_jalan_tables.php
database/seeders/DatabaseSeeder.php
```
