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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
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

        <a href="dashboard_pelanggan.php" class="bg-white text-blue-600 px-3 py-1.5 md:px-4 md:py-2 rounded-lg text-sm md:text-base font-medium hover:bg-gray-100 shadow transition duration-200">
            Dashboard
        </a>
    </div>
</nav>

<!-- Konten Utama -->
<div class="max-w-3xl mx-auto mt-4 md:mt-10 mb-10 px-4 sm:px-0">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

        <!-- Header Profil -->
        <div class="bg-blue-600 p-6 md:p-8 text-center text-white">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 md:w-24 md:h-24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0A9 9 0 1112 3a9 9 0 015.982 15.725zM15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl md:text-3xl font-bold mt-3 break-words">
                <?= $data['nama']; ?>
            </h2>

            <p class="text-sm md:text-base text-blue-100 mt-0.5">
                Pelanggan
            </p>
        </div>

        <!-- Data Profil -->
        <div class="p-5 md:p-8">
            <div class="grid grid-cols-1 gap-5">

                <div>
                    <label class="text-gray-500 text-xs md:text-sm font-medium">
                        Nama Lengkap
                    </label>
                    <div class="border border-gray-200 rounded-lg p-3 mt-1 bg-gray-50 text-gray-800 font-medium">
                        <?= $data['nama']; ?>
                    </div>
                </div>

                <div>
                    <label class="text-gray-500 text-xs md:text-sm font-medium">
                        Username
                    </label>
                    <div class="border border-gray-200 rounded-lg p-3 mt-1 bg-gray-50 text-gray-800">
                        <?= $data['username']; ?>
                    </div>
                </div>

                <div>
                    <label class="text-gray-500 text-xs md:text-sm font-medium">
                        Email
                    </label>
                    <div class="border border-gray-200 rounded-lg p-3 mt-1 bg-gray-50 text-gray-800 break-all">
                        <?= $data['email']; ?>
                    </div>
                </div>

                <div>
                    <label class="text-gray-500 text-xs md:text-sm font-medium">
                        Nomor HP
                    </label>
                    <div class="border border-gray-200 rounded-lg p-3 mt-1 bg-gray-50 text-gray-800">
                        <?= $data['no_hp']; ?>
                    </div>
                </div>

                <div>
                    <label class="text-gray-500 text-xs md:text-sm font-medium">
                        Alamat
                    </label>
                    <div class="border border-gray-200 rounded-lg p-3 mt-1 bg-gray-50 text-gray-800 whitespace-pre-line">
                        <?= $data['alamat']; ?>
                    </div>
                </div>

            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4">
                <a href="edit_profil.php"
                   class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow-sm transition duration-200">
                    Edit Profil
                </a>

                <a href="dashboard_pelanggan.php"
                   class="w-full sm:w-auto text-center bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-3 rounded-lg shadow-sm transition duration-200">
                    Kembali
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>