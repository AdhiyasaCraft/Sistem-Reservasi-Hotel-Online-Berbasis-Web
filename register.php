<?php
include "config/koneksi.php";

if (isset($_POST['register'])) {

    $nama     = htmlspecialchars($_POST['nama']);
    $email    = htmlspecialchars($_POST['email']);
    $no_hp    = htmlspecialchars($_POST['no_hp']);
    $alamat   = htmlspecialchars($_POST['alamat']);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Cek password
    if ($password != $konfirmasi) {
        echo "<script>
                alert('Konfirmasi password tidak sama!');
              </script>";
    } else {

        // Cek username
        $cek = mysqli_query($conn, "SELECT * FROM t_pelanggan WHERE username='$username'");

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>
                    alert('Username sudah digunakan!');
                  </script>";

        } else {

            // Simpan ke database
            mysqli_query($conn, "INSERT INTO t_pelanggan
            (nama,email,no_hp,alamat,username,passwords)

            VALUES

            ('$nama','$email','$no_hp','$alamat','$username','$password')");

            echo "<script>
                    alert('Registrasi berhasil!');
                    window.location='login.php';
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4 py-8">

<div class="bg-white shadow-lg rounded-xl w-full max-w-md p-6 sm:p-8">

<h2 class="text-2xl sm:text-3xl font-bold text-center text-blue-600">

Register

</h2>

<p class="text-center text-gray-500 mt-2">

Silakan buat akun baru

</p>

<form method="POST" class="mt-6">

<div class="mb-4">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-4">

<label>Email</label>

<input
type="email"
name="email"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-4">

<label>No HP</label>

<input
type="text"
name="no_hp"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-4">

<label>Alamat</label>

<textarea
name="alamat"
required
class="w-full border rounded-lg p-3 mt-2"></textarea>

</div>

<div class="mb-4">

<label>Username</label>

<input
type="text"
name="username"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-4">

<label>Password</label>

<input
type="password"
name="password"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-6">

<label>Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
required
class="w-full border rounded-lg p-3 mt-2">

</div>

<button
type="submit"
name="register"

class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">

Daftar

</button>

</form>

<p class="text-center mt-5">

Sudah punya akun?

<a href="login.php"
class="text-blue-600 font-semibold">

Login

</a>

</p>

</div>

</div>

</body>

</html>