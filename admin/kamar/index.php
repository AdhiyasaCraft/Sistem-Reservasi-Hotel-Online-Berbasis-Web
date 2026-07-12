<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_kamar ORDER BY id_kamar DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen relative overflow-x-hidden">

    <!-- Mobile Header (Hanya muncul di HP) -->
    <header class="md:hidden w-full bg-blue-700 text-white p-4 flex justify-between items-center fixed top-0 left-0 z-40 shadow-md">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>
            </svg>
            <span class="text-xl font-bold">Hotel Admin</span>
        </div>
        <!-- Tombol Hamburger -->
        <button id="hamburgerBtn" class="p-2 focus:outline-none hover:bg-blue-600 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </header>

    <!-- Overlay untuk Mobile Sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden opacity-0 transition-opacity duration-300"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-blue-700 text-white fixed md:sticky top-0 bottom-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col h-screen shadow-xl md:shadow-none">

        <div class="p-6 text-center border-b border-blue-600 flex justify-between items-center md:block">
            <div class="flex items-center justify-center gap-3 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>
                </svg>
                <span class="text-2xl font-bold">Hotel Admin</span>
            </div>
            <!-- Tombol Close Sidebar (Hanya Mobile) -->
            <button id="closeSidebarBtn" class="md:hidden p-1 text-blue-200 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="mt-6 flex-1 overflow-y-auto">
            <a href="../dashboard.php" class="flex items-center gap-3 px-6 py-3 hover:bg-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.75L12 3l8.25 6.75V20.25H3.75V9.75z"/>
                </svg>
                Dashboard
            </a>

            <a href="index.php" class="flex items-center gap-3 px-6 py-3 bg-blue-800 border-l-4 border-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5h18v7.5H3v-7.5zm3-4.5h4.5v4.5H6V6zm7.5 0H18v4.5h-4.5V6z"/>
                </svg>
                Data Kamar
            </a>

            <a href="../reservasi/index.php" class="flex items-center gap-3 px-6 py-3 hover:bg-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 2.25v3m7.5-3v3m-9 3h10.5m-13.5 12h16.5V6.75A2.25 2.25 0 0018 4.5H6A2.25 2.25 0 003.75 6.75V20.25z"/>
                </svg>
                Data Reservasi
            </a>

            <a href="../pelanggan/index.php" class="flex items-center gap-3 px-6 py-3 hover:bg-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0A9 9 0 1112 3a9 9 0 015.982 15.725zM15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Data Pelanggan
            </a>

            <a href="../../logout.php" class="flex items-center gap-3 px-6 py-3 hover:bg-red-600 transition mt-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m-6-3h10.5m0 0l-3-3m3 3l-3 3"/>
                </svg>
                Logout
            </a>
        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-4 md:p-8 pt-20 md:pt-8 w-full overflow-hidden">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Data Kamar</h1>
                <p class="text-gray-500 text-sm md:text-base">Kelola seluruh data kamar hotel</p>
            </div>
            <a href="tambah.php" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition">
                + Tambah Kamar
            </a>
        </div>

        <!-- Tabel Responsif -->
        <div class="bg-white rounded-xl shadow mt-6 md:mt-8 overflow-x-auto border border-gray-100">
            <table class="w-full min-w-[800px]">
                <thead class="bg-blue-600 text-white text-left">
                    <tr>
                        <th class="p-4 text-center w-16">No</th>
                        <th class="p-4 text-center">Foto</th>
                        <th class="p-4">Nama Kamar</th>
                        <th class="p-4">Tipe</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="text-center p-4 text-gray-600"><?= $no++; ?></td>
                    <td class="p-4 text-center">
                        <img src="../../assets/img/<?= $row['foto']; ?>" class="w-20 h-14 object-cover rounded shadow-sm mx-auto">
                    </td>
                    <td class="p-4 font-semibold text-gray-800"><?= $row['nama_kamar']; ?></td>
                    <td class="p-4 text-gray-600"><?= $row['tipe']; ?></td>
                    <td class="p-4 font-medium text-gray-900">Rp <?= number_format($row['harga'],0,",","."); ?></td>
                    <td class="p-4 text-center">
                        <?php if($row['status_kamar'] == "Tersedia"): ?>
                            <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Tersedia</span>
                        <?php else: ?>
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">Terisi</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center gap-2">
                            <a href="edit.php?id=<?= $row['id_kamar']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-sm shadow transition">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_kamar']; ?>" onclick="return confirm('Yakin ingin menghapus kamar ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm shadow transition">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </main>

</div>

<!-- JavaScript untuk Toggle Sidebar di Mobile -->
<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        setTimeout(() => {
            overlay.classList.toggle('opacity-0');
        }, 5);
    }

    hamburgerBtn.addEventListener('click', toggleSidebar);
    closeSidebarBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);
</script>

</body>
</html>