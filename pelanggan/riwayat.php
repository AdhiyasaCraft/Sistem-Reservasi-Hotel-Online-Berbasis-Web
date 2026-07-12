<?php
session_start();

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn, "SELECT
t_reservasi.*,
t_kamar.nama_kamar,
t_kamar.foto

FROM t_reservasi

JOIN t_kamar
ON t_reservasi.id_kamar = t_kamar.id_kamar

WHERE id_pelanggan='$id_pelanggan'

ORDER BY id_reservasi DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Reservasi</title>
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

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="dashboard_pelanggan.php" class="text-white hover:text-blue-100 transition font-medium">Dashboard</a>
            <a href="kamar.php" class="text-white hover:text-blue-100 transition font-medium">Lihat Kamar</a>
            <a href="../logout.php" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 text-white shadow transition font-medium">Logout</a>
        </div>
    </div>
</nav>

<!-- Overlay Gelap Sidebar Mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden opacity-0 transition-opacity duration-300"></div>

<!-- Sidebar Mobile (Slide-in dari Kanan) -->
<aside id="mobileSidebar" class="fixed top-0 bottom-0 right-0 z-50 w-64 bg-blue-700 text-white transform translate-x-full md:hidden transition-transform duration-300 ease-in-out flex flex-col h-screen shadow-2xl">
    <div class="p-5 border-b border-blue-500 flex justify-between items-center">
        <span class="text-xl font-bold">Menu Navigasi</span>
        <button id="closeSidebarBtn" class="p-1 text-blue-200 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <nav class="p-4 flex flex-col gap-2">
        <a href="dashboard_pelanggan.php" class="block text-white hover:bg-blue-600 px-4 py-3 rounded-lg transition font-medium">Dashboard</a>
        <a href="kamar.php" class="block text-white hover:bg-blue-600 px-4 py-3 rounded-lg transition font-medium">Lihat Kamar</a>
        <a href="../logout.php" class="block text-center bg-red-500 hover:bg-red-600 px-4 py-3 rounded-lg text-white font-medium transition mt-4 shadow">Logout</a>
    </nav>
</aside>

<!-- Konten Utama -->
<div class="max-w-7xl mx-auto py-6 md:py-10 px-4 sm:px-6">

    <h2 class="text-2xl md:text-3xl font-bold mb-6 md:mb-8 text-gray-800 text-center sm:text-left">
        Riwayat Reservasi Saya
    </h2>

    <?php if(mysqli_num_rows($query) > 0) { ?>
        
        <!-- 1. TAMPILAN TABLE (Hanya muncul di Desktop / Tablet) -->
        <div class="hidden md:block bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-600 text-white text-sm font-semibold">
                    <tr>
                        <th class="p-4 text-center">Foto</th>
                        <th class="p-4">Nama Kamar</th>
                        <th class="p-4">Check In</th>
                        <th class="p-4">Check Out</th>
                        <th class="p-4 text-center">Tamu</th>
                        <th class="p-4">Total</th>
                        <th class="p-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <?php 
                    // Reset pointer data agar bisa dilooping kembali
                    mysqli_data_seek($query, 0); 
                    while($row = mysqli_fetch_assoc($query)) { 
                        $status = $row['status_reservasi'];
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 flex justify-center">
                            <img src="../assets/img/<?= $row['foto']; ?>" class="w-24 h-16 object-cover rounded shadow-sm border border-gray-200">
                        </td>
                        <td class="p-4 font-semibold text-gray-800"><?= $row['nama_kamar']; ?></td>
                        <td class="p-4"><?= date('d-m-Y', strtotime($row['check_in'])); ?></td>
                        <td class="p-4"><?= date('d-m-Y', strtotime($row['check_out'])); ?></td>
                        <td class="p-4 text-center"><?= $row['jumlah_tamu']; ?></td>
                        <td class="p-4 text-blue-600 font-bold">Rp <?= number_format($row['total_harga'],0,",","."); ?></td>
                        <td class="p-4 text-center">
                            <?php if($status=="Pending") { ?>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                            <?php } elseif($status=="Dikonfirmasi") { ?>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">Dikonfirmasi</span>
                            <?php } elseif($status=="Check In") { ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Check In</span>
                            <?php } elseif($status=="Check Out") { ?>
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">Check Out</span>
                            <?php } elseif($status=="Selesai") { ?>
                                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                            <?php } else { ?>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">Batal</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- 2. TAMPILAN KARTU / CARD LIST (Hanya muncul di Mobile / HP) -->
        <div class="block md:hidden space-y-4">
            <?php 
            mysqli_data_seek($query, 0); 
            while($row = mysqli_fetch_assoc($query)) { 
                $status = $row['status_reservasi'];
            ?>
            <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100 flex flex-col gap-3">
                <div class="flex gap-4 items-center">
                    <img src="../assets/img/<?= $row['foto']; ?>" class="w-24 h-16 object-cover rounded border border-gray-200 flex-shrink-0">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base line-clamp-1"><?= $row['nama_kamar']; ?></h3>
                        <p class="text-blue-600 font-bold text-sm mt-1">Rp <?= number_format($row['total_harga'],0,",","."); ?></p>
                    </div>
                </div>
                
                <hr class="border-gray-100">

                <div class="grid grid-cols-2 gap-y-2 gap-x-1 text-xs text-gray-600">
                    <div><span class="text-gray-400 block">Check In</span> <strong class="text-gray-700"><?= date('d-m-Y', strtotime($row['check_in'])); ?></strong></div>
                    <div><span class="text-gray-400 block">Check Out</span> <strong class="text-gray-700"><?= date('d-m-Y', strtotime($row['check_out'])); ?></strong></div>
                    <div><span class="text-gray-400 block">Jumlah Tamu</span> <strong class="text-gray-700"><?= $row['jumlah_tamu']; ?> Orang</strong></div>
                    <div class="flex flex-col justify-end items-start">
                        <span class="text-gray-400 block mb-0.5">Status</span>
                        <?php if($status=="Pending") { ?>
                            <span class="bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full font-semibold">Pending</span>
                        <?php } elseif($status=="Dikonfirmasi") { ?>
                            <span class="bg-blue-100 text-blue-700 px-2.5 py-0.5 rounded-full font-semibold">Dikonfirmasi</span>
                        <?php } elseif($status=="Check In") { ?>
                            <span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full font-semibold">Check In</span>
                        <?php } elseif($status=="Check Out") { ?>
                            <span class="bg-purple-100 text-purple-700 px-2.5 py-0.5 rounded-full font-semibold">Check Out</span>
                        <?php } elseif($status=="Selesai") { ?>
                            <span class="bg-gray-200 text-gray-700 px-2.5 py-0.5 rounded-full font-semibold">Selesai</span>
                        <?php } else { ?>
                            <span class="bg-red-100 text-red-700 px-2.5 py-0.5 rounded-full font-semibold">Batal</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    <?php } else { ?>
        <!-- State Kosong -->
        <div class="bg-white rounded-xl shadow border border-gray-100 p-10 text-center text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Belum ada data riwayat reservasi Anda.
        </div>
    <?php } ?>

</div>

<!-- JavaScript untuk Animasi Slide-in Sidebar -->
<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        overlay.classList.remove('hidden');
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            mobileSidebar.classList.remove('translate-x-full');
        }, 20);
    }

    function closeSidebar() {
        mobileSidebar.classList.add('translate-x-full');
        overlay.classList.add('opacity-0');
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