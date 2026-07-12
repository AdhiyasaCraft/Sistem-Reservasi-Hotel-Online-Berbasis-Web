<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM t_kamar WHERE id_kamar='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='index.php';
          </script>";
    exit;
}

if (isset($_POST['update'])) {

    $nama       = mysqli_real_escape_string($conn, $_POST['nama_kamar']);
    $tipe       = mysqli_real_escape_string($conn, $_POST['tipe']);
    $harga      = mysqli_real_escape_string($conn, $_POST['harga']);
    $status     = mysqli_real_escape_string($conn, $_POST['status_kamar']);
    $deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Upload Foto Baru
    if ($_FILES['foto']['name'] != "") {

        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "../../assets/img/".$foto);

    } else {

        // Jika tidak upload foto baru
        $foto = $row['foto'];

    }

    $update = mysqli_query($conn, "UPDATE t_kamar SET

        nama_kamar='$nama',
        tipe='$tipe',
        harga='$harga',
        foto='$foto',
        status_kamar='$status',
        deskripsi='$deskripsi'

        WHERE id_kamar='$id'
    ");

    if ($update) {

        echo "<script>
                alert('Data berhasil diubah');
                window.location='index.php';
              </script>";

    } else {

        echo "<script>alert('Gagal mengubah data');</script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="max-w-3xl mx-auto mt-4 md:mt-10 mb-10 px-4 sm:px-0">

    <div class="bg-white shadow-lg rounded-xl p-5 md:p-8 border border-gray-100">

        <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-6 md:mb-8 text-center sm:text-left">
            Edit Data Kamar
        </h2>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Nama Kamar
                </label>
                <input
                    type="text"
                    name="nama_kamar"
                    value="<?= $row['nama_kamar']; ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Tipe
                </label>
                <select
                    name="tipe"
                    class="w-full border border-gray-300 rounded-lg p-3 bg-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option <?= ($row['tipe']=="Deluxe")?"selected":""; ?>>Deluxe</option>
                    <option <?= ($row['tipe']=="Superior")?"selected":""; ?>>Superior</option>
                    <option <?= ($row['tipe']=="Family")?"selected":""; ?>>Family</option>
                    <option <?= ($row['tipe']=="Suite")?"selected":""; ?>>Suite</option>
                </select>
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Harga
                </label>
                <input
                    type="number"
                    name="harga"
                    value="<?= $row['harga']; ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Foto Saat Ini
                </label>
                <div class="mb-3">
                    <img
                        src="../../assets/img/<?= $row['foto']; ?>"
                        class="w-40 max-w-full rounded shadow-sm border border-gray-200 object-cover">
                </div>
                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-lg p-2.5 bg-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs md:text-sm text-gray-500 mt-2">
                    Kosongkan jika tidak ingin mengganti foto.
                </p>
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Status
                </label>
                <select
                    name="status_kamar"
                    class="w-full border border-gray-300 rounded-lg p-3 bg-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="Tersedia" <?= ($row['status_kamar']=="Tersedia")?"selected":""; ?>>Tersedia</option>
                    <option value="Terisi" <?= ($row['status_kamar']=="Terisi")?"selected":""; ?>>Terisi</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    rows="5"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"><?= $row['deskripsi']; ?></textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2">
                <button
                    type="submit"
                    name="update"
                    class="w-full sm:w-auto text-center bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-6 py-3 rounded-lg shadow transition duration-200">
                    Update
                </button>

                <a href="index.php"
                   class="w-full sm:w-auto text-center bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-3 rounded-lg shadow transition duration-200">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>