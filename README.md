# TUGAS BESAR MATA KULIAH REKAYASA PERANGKAT LUNAK
## KELOMPOK 5
### NAMA ANGGOTA :
1. Bunga Indah Lestari (240511170)
2. Kevin Adhiyasa Ilham (240511015)
3. Reza Maulana Firdaus (240511104)
4. Sherly  Patrecia (240511077)
5. ⁠Ahmad ilham (240511095)

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
├── admin/                            
│   ├── dashboard.php              
│   ├── kamar/                        
│   │   ├── index.php
│   │   ├── tambah.php
│   │   ├── edit.php
│   │   └── hapus.php
│   │
│   ├── pelanggan/                 
│   │   └── index.php
│   │
│   └── reservasi/                   
│       ├── index.php
│       └── edit.php
│
├── assets/
│   └── img/                            
│       ├── Deluxe Room.png
│       ├── Family Room.png
│       ├── hotel.png
│       ├── Suite Room.png
│       └── SUPERIOR.png
│
├── config/
│   └── koneksi.php                     
│
├── includes/                          
│   ├── navbar.php
│   ├── navbar_tentang.php
│   └── footer.php
│
├── pelanggan/                         
│   ├── dashboard_pelanggan.php
│   ├── kamar.php
│   ├── reservasi.php
│   ├── riwayat.php
│   ├── profil.php
│   └── edit_profil.php
│
├── db_hotel.sql                       
├── detail.php                       
├── index.php                          
├── login.php                          
├── logout.php                        
├── register.php                       
├── tentang.php                       
└── README.md                           
```

# Struktur Basis Data (Database)

Sistem menggunakan empat tabel utama yang saling berelasi untuk mengelola proses reservasi hotel.

- **t_admin** — Menyimpan data akun administrator yang memiliki hak akses untuk mengelola sistem.
- **t_pelanggan** — Menyimpan informasi akun pelanggan yang dapat melakukan reservasi kamar.
- **t_kamar** — Menyimpan data kamar hotel, meliputi nama kamar, tipe kamar, harga, status ketersediaan, foto, dan deskripsi.
- **t_reservasi** — Menyimpan data pemesanan kamar yang dilakukan pelanggan, seperti tanggal check-in, tanggal check-out, jumlah tamu, total harga, dan status reservasi.

### Relasi Antar Tabel

- Satu **pelanggan** dapat memiliki lebih dari satu **reservasi**.
- Satu **kamar** dapat muncul pada banyak **reservasi** yang berbeda sesuai jadwal pemesanan.
- Setiap **reservasi** terhubung dengan satu **pelanggan** dan satu **kamar** melalui *foreign key*.

Rincian lengkap struktur tabel dapat dilihat pada berkas **`db_hotel.sql`**.

# Akun Demo

## Administrator

| Username | Password |
|----------|----------|
| admin | admin123 |

## Pelanggan Hotel

| Username | Password |
|----------|----------|
| Pelanggan | 123 |
