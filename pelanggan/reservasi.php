<?php
session_start();

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: kamar.php");
    exit;
}

$id_kamar = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM t_kamar WHERE id_kamar='$id_kamar'");
$kamar = mysqli_fetch_assoc($query);

if (!$kamar) {
    die("Data kamar tidak ditemukan.");
}

if(isset($_POST['pesan'])){

    $id_pelanggan = $_SESSION['id_pelanggan'];

    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $jumlah_tamu = $_POST['jumlah_tamu'];

    $awal = new DateTime($check_in);
    $akhir = new DateTime($check_out);

    $lama = $awal->diff($akhir)->days;

    if($lama <= 0){
        echo "<script>alert('Tanggal Check Out harus lebih besar dari Check In');</script>";
    }else{

        $total = $lama * $kamar['harga'];

        $simpan = mysqli_query($conn,"INSERT INTO t_reservasi
        (
            id_pelanggan,
            id_kamar,
            check_in,
            check_out,
            jumlah_tamu,
            total_harga,
            status_reservasi
        )

        VALUES

        (
            '$id_pelanggan',
            '$id_kamar',
            '$check_in',
            '$check_out',
            '$jumlah_tamu',
            '$total',
            'Pending'
        )");

        if($simpan){

            echo "<script>
                    alert('Reservasi berhasil dibuat!');
                    window.location='riwayat.php';
                  </script>";

        }else{

            echo "<script>alert('Reservasi gagal!');</script>";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="max-w-5xl mx-auto py-6 md:py-10 px-4 sm:px-0">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex border border-gray-100">

        <!-- Sisi Gambar (Atas di Mobile, Kiri di Desktop) -->
        <div class="w-full md:w-1/2">
            <img
                src="../assets/img/<?= $kamar['foto']; ?>"
                class="w-full h-64 md:h-full object-cover"
                alt="Foto Kamar">
        </div>

        <!-- Sisi Form (Bawah di Mobile, Kanan di Desktop) -->
        <div class="w-full md:w-1/2 p-5 md:p-8 flex flex-col justify-center">

            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                <?= $kamar['nama_kamar']; ?>
            </h2>

            <p class="text-sm md:text-base text-gray-500 mt-1">
                Tipe: <span class="font-semibold text-gray-700"><?= $kamar['tipe']; ?></span>
            </p>

            <p class="text-blue-600 text-2xl md:text-3xl font-bold mt-3 md:mt-4">
                Rp <?= number_format($kamar['harga'],0,",","."); ?>
                <span class="text-xs md:text-sm text-gray-500 font-normal"> / malam</span>
            </p>

            <form method="POST" class="mt-6 md:mt-8">

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Check In
                    </label>
                    <input
                        type="date"
                        name="check_in"
                        required
                        class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Check Out
                    </label>
                    <input
                        type="date"
                        name="check_out"
                        required
                        class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                </div>

                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">
                        Jumlah Tamu
                    </label>
                    <input
                        type="number"
                        name="jumlah_tamu"
                        min="1"
                        required
                        class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                </div>

                <div class="space-y-3">
                    <button
                        type="submit"
                        name="pesan"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg shadow-sm transition duration-200">
                        Pesan Sekarang
                    </button>

                    <a
                        href="kamar.php"
                        class="block text-center bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 rounded-lg shadow-sm transition duration-200">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>