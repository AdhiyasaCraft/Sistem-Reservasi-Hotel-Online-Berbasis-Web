<?php
session_start();

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$id = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn, "SELECT * FROM t_pelanggan WHERE id_pelanggan='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama      = mysqli_real_escape_string($conn,$_POST['nama']);
    $email     = mysqli_real_escape_string($conn,$_POST['email']);
    $no_hp     = mysqli_real_escape_string($conn,$_POST['no_hp']);
    $alamat    = mysqli_real_escape_string($conn,$_POST['alamat']);
    $username  = mysqli_real_escape_string($conn,$_POST['username']);

    $update = mysqli_query($conn,"UPDATE t_pelanggan SET
        nama='$nama',
        email='$email',
        no_hp='$no_hp',
        alamat='$alamat',
        username='$username'
        WHERE id_pelanggan='$id'
    ");

    if($update){

        $_SESSION['nama'] = $nama;

        echo "<script>
                alert('Profil berhasil diperbarui!');
                window.location='profil.php';
              </script>";

    }else{

        echo "<script>
                alert('Gagal memperbarui profil!');
              </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<!-- Navbar -->
<nav class="bg-blue-600 shadow sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4 md:p-5">
         <h1 class="flex items-center gap-2 md:gap-3 text-lg md:text-2xl font-bold text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>
            </svg>
            Hotel Reservation
        </h1>

        <a href="profil.php" class="bg-white text-blue-600 px-3 py-1.5 md:px-4 md:py-2 rounded-lg text-sm md:text-base font-medium hover:bg-gray-100 shadow transition duration-200">
            Kembali
        </a>
    </div>
</nav>

<!-- Konten Utama -->
<div class="max-w-2xl mx-auto mt-4 md:mt-10 mb-10 px-4 sm:px-0">

    <div class="bg-white rounded-xl shadow-lg p-5 md:p-8 border border-gray-100">

        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 md:w-20 md:h-20 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0A9 9 0 1112 3a9 9 0 015.982 15.725zM15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>

        <h2 class="text-2xl md:text-3xl font-bold text-center mb-6 md:mb-8 text-gray-800">
            Edit Profil
        </h2>

        <form method="POST">

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700 text-sm md:text-base">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="nama"
                    value="<?= $data['nama']; ?>"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700 text-sm md:text-base">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    value="<?= $data['username']; ?>"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700 text-sm md:text-base">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="<?= $data['email']; ?>"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700 text-sm md:text-base">
                    Nomor HP
                </label>
                <input
                    type="text"
                    name="no_hp"
                    value="<?= $data['no_hp']; ?>"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium text-gray-700 text-sm md:text-base">
                    Alamat
                </label>
                <textarea
                    name="alamat"
                    rows="4"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"><?= $data['alamat']; ?></textarea>
            </div>

            <!-- Tombol Aksi Responsif -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <button
                    type="submit"
                    name="update"
                    class="w-full sm:flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg shadow-sm transition duration-200">
                    Simpan Perubahan
                </button>

                <a href="profil.php"
                    class="w-full sm:flex-1 bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 rounded-lg text-center shadow-sm transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>