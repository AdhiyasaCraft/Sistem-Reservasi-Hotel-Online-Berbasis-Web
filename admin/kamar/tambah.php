<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama_kamar']);
    $tipe = mysqli_real_escape_string($conn, $_POST['tipe']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $status = mysqli_real_escape_string($conn, $_POST['status_kamar']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Upload Foto
    $namaFoto = $_FILES['foto']['name'];
    $tmpFoto = $_FILES['foto']['tmp_name'];

    // Folder penyimpanan
    $folder = "../../assets/img/";

    if ($namaFoto != "") {

        move_uploaded_file($tmpFoto, $folder . $namaFoto);

        $simpan = mysqli_query($conn, "INSERT INTO t_kamar
        (nama_kamar, tipe, harga, foto, status_kamar, deskripsi)
        VALUES
        ('$nama','$tipe','$harga','$namaFoto','$status','$deskripsi')");

        if ($simpan) {
            echo "<script>
                    alert('Data kamar berhasil ditambahkan');
                    window.location='index.php';
                  </script>";
        } else {
            echo "<script>alert('Gagal menambahkan data');</script>";
        }

    } else {
        echo "<script>alert('Foto harus dipilih');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="max-w-3xl mx-auto mt-4 md:mt-10 mb-10 px-4 sm:px-0">

    <div class="bg-white shadow-lg rounded-xl p-5 md:p-8 border border-gray-100">

        <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-6 md:mb-8 text-center sm:text-left">
            Tambah Data Kamar
        </h2>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Nama Kamar
                </label>
                <input
                    type="text"
                    name="nama_kamar"
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
                    <option>Deluxe</option>
                    <option>Superior</option>
                    <option>Family</option>
                    <option>Suite</option>
                </select>
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Harga
                </label>
                <input
                    type="number"
                    name="harga"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Foto
                </label>
                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    required
                    class="w-full border border-gray-300 rounded-lg p-2.5 bg-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Status
                </label>
                <select
                    name="status_kamar"
                    class="w-full border border-gray-300 rounded-lg p-3 bg-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="Tersedia">Tersedia</option>
                    <option value="Terisi">Terisi</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    rows="5"
                    class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"></textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2">
                <button
                    type="submit"
                    name="simpan"
                    class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow transition duration-200">
                    Simpan
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