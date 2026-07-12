<?php
include "config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM t_kamar WHERE id_kamar='$id'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Data kamar tidak ditemukan!');
            window.location='index.php';
          </script>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['nama_kamar']; ?> | Hotel Reservation</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-white shadow sticky top-0 z-50">
<div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-4">
<a href="index.php" class="flex items-center gap-2 text-xl font-bold text-blue-600">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/></svg>
Hotel Reservation</a>
<div class="hidden md:flex items-center gap-5">
<a href="index.php">Home</a><a href="login.php" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Login</a></div>
<button id="menuBtn" class="md:hidden"><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button>
</div></nav>
<div id="overlay" class="fixed inset-0 bg-black/50 hidden z-40"></div>
<div id="mobileMenu" class="fixed top-0 right-0 h-full w-72 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300">
<div class="flex justify-between p-5 border-b"><b>Menu</b><button id="closeBtn">✕</button></div>
<div class="flex flex-col p-5 gap-4"><a href="index.php">Home</a><a href="index.php#kamar">Kamar</a><a href="login.php" class="bg-blue-600 text-white py-3 rounded text-center">Login</a></div></div>
<script>
const m=document.getElementById('mobileMenu'),o=document.getElementById('overlay');
menuBtn.onclick=()=>{m.classList.remove('translate-x-full');o.classList.remove('hidden');}
function c(){m.classList.add('translate-x-full');o.classList.add('hidden');}
closeBtn.onclick=c;overlay.onclick=c;
</script>


<!-- Content -->
<div class="max-w-6xl mx-auto py-8 md:py-12 px-4 md:px-6">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">

        <!-- Foto -->
        <div class="w-full md:w-1/2">

            <?php if (!empty($data['foto'])) { ?>

                <img src="assets/img/<?= $data['foto']; ?>"
                    class="w-full h-64 md:h-full object-cover">

            <?php } else { ?>

                <img src="https://via.placeholder.com/700x500?text=No+Image"
                    class="w-full h-full object-cover">

            <?php } ?>

        </div>

        <!-- Informasi -->
        <div class="w-full md:w-1/2 p-5 md:p-8">

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                <?= $data['nama_kamar']; ?>
            </h1>

            <p class="text-gray-500 mt-2">
                Tipe :
                <span class="font-semibold">
                    <?= $data['tipe']; ?>
                </span>
            </p>

            <div class="mt-5">

                <span class="px-4 py-2 rounded-full text-sm font-semibold
                <?= ($data['status_kamar'] == 'Tersedia')
                    ? 'bg-green-100 text-green-700'
                    : 'bg-red-100 text-red-700'; ?>">

                    <?= $data['status_kamar']; ?>

                </span>

            </div>

            <h2 class="text-3xl md:text-4xl text-blue-600 font-bold mt-6">
                Rp <?= number_format($data['harga'],0,",","."); ?>

                <span class="text-lg text-gray-500 font-normal">
                    / malam
                </span>
            </h2>

            <hr class="my-8">

            <h3 class="text-xl font-bold mb-3">
                Deskripsi Kamar
            </h3>

            <p class="text-gray-600 leading-8">

                <?= $data['deskripsi']; ?>

            </p>

            <hr class="my-8">

            <h3 class="text-xl font-bold mb-4">
                Fasilitas
            </h3>

            <div class="grid grid-cols-2 gap-3 text-gray-700">

                <div>✅ AC</div>
                <div>✅ WiFi Gratis</div>
                <div>✅ Smart TV</div>
                <div>✅ Breakfast</div>
                <div>✅ Kamar Mandi Dalam</div>
                <div>✅ Air Panas</div>

            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-10">

                <a href="login.php"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Pesan Sekarang

                </a>

                <a href="index.php#kamar"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg">

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>