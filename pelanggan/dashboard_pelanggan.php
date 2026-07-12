<?php
session_start();

if (!isset($_SESSION['pelanggan'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$nama = $_SESSION['pelanggan'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-blue-600 shadow">

    <div class="max-w-7xl mx-auto flex justify-between items-center p-5">

         <h1 class="flex items-center gap-3 text-2xl font-bold text-white">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-8 h-8">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>

            </svg>

            Hotel Reservation

        </h1>

        <a href="../logout.php"
        class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">

            Logout

        </a>

    </div>

</nav>

<div class="max-w-7xl mx-auto p-10">

    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-4xl font-bold text-gray-800">

            Halo, <?= $nama; ?>

        </h2>

        <p class="text-gray-500 mt-3">

            Selamat datang di Dashboard Pelanggan.
            Silakan pilih menu yang tersedia.

        </p>

    </div>

<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">

    <!-- Lihat Kamar -->
    <a href="kamar.php"
        class="bg-white rounded-xl shadow hover:shadow-xl p-8 text-center transition hover:-translate-y-1">

        <div class="flex justify-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-16 h-16 text-blue-600">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>

            </svg>

        </div>

        <h3 class="font-bold text-xl mt-4">
            Lihat Kamar
        </h3>

    </a>

    <!-- Reservasi -->
    <a href="riwayat.php"
        class="bg-white rounded-xl shadow hover:shadow-xl p-8 text-center transition hover:-translate-y-1">

        <div class="flex justify-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-16 h-16 text-blue-600">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 2.25v3m7.5-3v3m-9 3h10.5m-13.5 12h16.5V6.75A2.25 2.25 0 0018 4.5H6A2.25 2.25 0 003.75 6.75V20.25z"/>

            </svg>

        </div>

        <h3 class="font-bold text-xl mt-4">
            Reservasi Saya
        </h3>

    </a>

    <!-- Profil -->
    <a href="profil.php"
        class="bg-white rounded-xl shadow hover:shadow-xl p-8 text-center transition hover:-translate-y-1">

        <div class="flex justify-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-16 h-16 text-blue-600">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0A9 9 0 1112 3a9 9 0 015.982 15.725zM15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>

            </svg>

        </div>

        <h3 class="font-bold text-xl mt-4">
            Profil Saya
        </h3>

    </a>

    <!-- Logout -->
    <a href="../logout.php"
        class="bg-white rounded-xl shadow hover:shadow-xl p-8 text-center transition hover:-translate-y-1">

        <div class="flex justify-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-16 h-16 text-red-600">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m-6-3h10.5m0 0l-3-3m3 3l-3 3"/>

            </svg>

        </div>

        <h3 class="font-bold text-xl mt-4">
            Logout
        </h3>

    </a>

</div>

</div>

</body>
</html>