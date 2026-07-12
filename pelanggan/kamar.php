<?php
session_start();

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_kamar WHERE status_kamar='Tersedia' ORDER BY id_kamar DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased overflow-x-hidden">

<!-- Navbar -->
<nav class="bg-blue-600 shadow sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4 md:p-5">
        <h1 class="flex items-center gap-2 md:gap-3 text-xl md:text-2xl font-bold text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7 md:w-8 md:h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>
            </svg>
            Hotel Reservation
        </h1>

        <!-- Tombol Hamburger (Hanya Mobile) -->
        <button id="hamburgerBtn" class="md:hidden text-white p-2 focus:outline-none hover:bg-blue-700 rounded transition ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Menu Desktop (Sembunyi di Mobile) -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="dashboard_pelanggan.php" class="text-white hover:text-blue-100 transition font-medium">Dashboard</a>
            <a href="riwayat.php" class="text-white hover:text-blue-100 transition font-medium">Reservasi Saya</a>
            <a href="../logout.php" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 text-white shadow transition font-medium">Logout</a>
        </div>
    </div>
</nav>

<!-- Overlay Gelap (Hanya muncul saat Sidebar Aktif) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden opacity-0 transition-opacity duration-300"></div>

<!-- Sidebar Mobile (Muncul/Slide-in dari Kanan) -->
<aside id="mobileSidebar" class="fixed top-0 bottom-0 right-0 z-50 w-64 bg-blue-700 text-white transform translate-x-full md:hidden transition-transform duration-300 ease-in-out flex flex-col h-screen shadow-2xl">
    <!-- Header Sidebar Mobile -->
    <div class="p-5 border-b border-blue-500 flex justify-between items-center">
        <span class="text-xl font-bold">Menu Navigasi</span>
        <!-- Tombol Close -->
        <button id="closeSidebarBtn" class="p-1 text-blue-200 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Link Menu -->
    <nav class="p-4 flex flex-col gap-2">
        <a href="dashboard_pelanggan.php" class="block text-white hover:bg-blue-600 px-4 py-3 rounded-lg transition font-medium">Dashboard</a>
        <a href="riwayat.php" class="block text-white hover:bg-blue-600 px-4 py-3 rounded-lg transition font-medium">Reservasi Saya</a>
        <a href="../logout.php" class="block text-center bg-red-500 hover:bg-red-600 px-4 py-3 rounded-lg text-white font-medium transition mt-4 shadow">Logout</a>
    </nav>
</aside>

<!-- Konten Utama -->
<div class="max-w-7xl mx-auto py-8 md:py-12 px-4 sm:px-6">

    <h2 class="text-2xl md:text-4xl font-bold text-center text-gray-800">
        Daftar Kamar
    </h2>

    <p class="text-center text-sm md:text-base text-gray-500 mt-2">
        Pilih kamar yang ingin Anda pesan
    </p>

    <!-- Grid Layout Responsif -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8 md:mt-10">

    <?php while($row = mysqli_fetch_assoc($query)) { ?>

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl md:hover:-translate-y-1 transition duration-300 flex flex-col">

            <img
                src="../assets/img/<?= $row['foto']; ?>"
                class="w-full h-48 sm:h-56 object-cover"
                alt="Foto Kamar">

            <div class="p-5 md:p-6 flex flex-col flex-1">

                <h3 class="text-xl md:text-2xl font-bold text-gray-800 line-clamp-1">
                    <?= $row['nama_kamar']; ?>
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Tipe: <span class="font-semibold text-gray-700"><?= $row['tipe']; ?></span>
                </p>

                <p class="text-blue-600 text-xl md:text-2xl font-bold mt-3">
                    Rp <?= number_format($row['harga'],0,",","."); ?>
                    <span class="text-xs md:text-sm text-gray-500 font-normal">/ malam</span>
                </p>

                <p class="text-gray-600 text-sm mt-3 flex-1 line-clamp-3">
                    <?= substr($row['deskripsi'],0,100); ?>...
                </p>

                <div class="mt-5 pt-2">
                    <a href="reservasi.php?id=<?= $row['id_kamar']; ?>"
                       class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 md:py-3 rounded-lg font-medium shadow-sm hover:shadow transition">
                        Pesan Sekarang
                    </a>
                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<!-- JavaScript untuk Animasi Slide-in Sidebar dari Kanan -->
<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        overlay.classList.remove('hidden');
        // Memberi jeda mikroskopis agar efek transisi opacity berjalan lancar
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            mobileSidebar.classList.remove('translate-x-full');
        }, 20);
    }

    function closeSidebar() {
        mobileSidebar.classList.add('translate-x-full');
        overlay.classList.add('opacity-0');
        // Menyembunyikan overlay setelah animasi transisi selesai (300ms)
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }

    hamburgerBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
</script>

</body>
</html>