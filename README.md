# TUGAS BESAR MATA KULIAH REKAYASA PERANGKAT LUNAK
## KELOMPOK 5
### NAMA ANGGOTA :
1. Bunga Indah Lestari 240511170
2. Kevin Adhiyasa Ilham 240511015
3. Reza Maulana Firdaus 240511104
4. Sherly  Patrecia 240511077
5. ⁠Ahmad ilham 240511095

# PROJEK YANG DIBUAT: SISTEM RESERVASI HOTEL BERBASIS WEBSITE
## DESKRIPSI PROJEK
Hotel Reservation System merupakan aplikasi berbasis web yang dikembangkan sebagai tugas besar mata kuliah **Rekayasa Perangkat Lunak**. Aplikasi ini dibangun menggunakan **PHP Native**, **MySQL**, dan **Tailwind CSS** untuk memudahkan proses reservasi kamar hotel secara online.

Sistem menyediakan dua jenis pengguna, yaitu **Admin** dan **Pelanggan**. Admin dapat mengelola data kamar, data pelanggan, serta reservasi yang masuk. Sementara itu, pelanggan dapat melakukan registrasi akun, login, melihat daftar kamar beserta detailnya, melakukan reservasi, melihat riwayat pemesanan, dan mengelola profil mereka.

Dengan adanya aplikasi ini, proses pemesanan kamar menjadi lebih cepat, mudah, dan terorganisir dibandingkan dengan pencatatan secara manual. Selain itu, sistem juga membantu pihak hotel dalam mengelola data reservasi secara efisien dan meminimalkan kesalahan pengelolaan data.

## Teknologi yang Digunakan

### Sisi Klien (Frontend)
- HTML5
- Tailwind CSS v3
- JavaScript

### Sisi Server (Backend)
- PHP 8.x Native (berbasis session, tanpa menggunakan framework seperti Laravel)

### Penyimpanan Data (Database)
- MySQL (`db_perhotelan`)

### Development Environment
- Laragon

# Fitur dan Kemampuan Sistem

## Fitur Pelanggan

- Registrasi akun pelanggan.
- Login dan logout menggunakan sistem autentikasi berbasis session.
- Melihat daftar kamar yang tersedia.
- Melihat informasi detail kamar, termasuk harga dan deskripsi.
- Melakukan reservasi kamar dengan menentukan tanggal check-in dan check-out.
- Melihat riwayat reservasi yang pernah dilakukan.
- Mengubah data profil pelanggan.

---

## Fitur Admin

- Login admin dengan autentikasi berbasis session.
- Dashboard yang menampilkan ringkasan data sistem.
- Mengelola data kamar:
  - Menambah kamar baru.
  - Mengubah informasi kamar.
  - Menghapus data kamar.
- Mengelola data reservasi pelanggan.
- Melihat data pelanggan yang telah terdaftar.

---

## Kemampuan Sistem

- Autentikasi pengguna menggunakan PHP Session.
- Pemisahan hak akses antara Admin dan Pelanggan.
- Penyimpanan data menggunakan database MySQL.
- Menampilkan informasi kamar secara dinamis dari database.
- Mendukung operasi CRUD (Create, Read, Update, Delete) pada data kamar.
- Menyimpan riwayat reservasi pelanggan.
- Antarmuka responsif menggunakan Tailwind CSS sehingga dapat diakses melalui desktop maupun perangkat mobile.
- Struktur kode menggunakan PHP Native sehingga mudah dipahami dan dikembangkan.
- Validasi dasar pada proses login, registrasi, dan reservasi.

## Fitur Autentikasi

- Registrasi akun pelanggan.
- Login menggunakan username dan password.
- Manajemen sesi (Session Management) menggunakan PHP.
- Pembatasan akses berdasarkan peran (Admin dan Pelanggan).
- Logout untuk mengakhiri sesi pengguna.

# Struktur Proyek

```text
hotel_final/
│
├── admin/                              # Halaman khusus administrator
│   ├── dashboard.php                   # Dashboard admin
│   ├── kamar/                          # Manajemen data kamar
│   │   ├── index.php
│   │   ├── tambah.php
│   │   ├── edit.php
│   │   └── hapus.php
│   │
│   ├── pelanggan/                      # Manajemen data pelanggan
│   │   └── index.php
│   │
│   └── reservasi/                      # Manajemen data reservasi
│       ├── index.php
│       └── edit.php
│
├── assets/
│   └── img/                            # Gambar hotel dan kamar
│       ├── Deluxe Room.png
│       ├── Family Room.png
│       ├── hotel.png
│       ├── Suite Room.png
│       └── SUPERIOR.png
│
├── config/
│   └── koneksi.php                     # Konfigurasi koneksi database
│
├── includes/                           # Komponen yang digunakan berulang
│   ├── navbar.php
│   ├── navbar_tentang.php
│   └── footer.php
│
├── pelanggan/                          # Halaman pelanggan
│   ├── dashboard_pelanggan.php
│   ├── kamar.php
│   ├── reservasi.php
│   ├── riwayat.php
│   ├── profil.php
│   └── edit_profil.php
│
├── db_hotel.sql                        # File database MySQL
├── detail.php                          # Detail informasi kamar
├── index.php                           # Halaman utama
├── login.php                           # Login pengguna
├── logout.php                          # Logout pengguna
├── register.php                        # Registrasi pelanggan
├── tentang.php                         # Halaman tentang
└── README.md                           # Dokumentasi proyek
```

