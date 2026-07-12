<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

// Cek apakah ID ada
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data kamar
$data = mysqli_query($conn, "SELECT * FROM t_kamar WHERE id_kamar='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='index.php';
          </script>";
    exit;
}

// Hapus foto jika ada
$foto = "../../assets/img/" . $row['foto'];

if (!empty($row['foto']) && file_exists($foto)) {
    unlink($foto);
}

// Hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM t_kamar WHERE id_kamar='$id'");

if ($hapus) {

    echo "<script>
            alert('Data kamar berhasil dihapus');
            window.location='index.php';
          </script>";

} else {

    echo "<script>
            alert('Data gagal dihapus');
            window.location='index.php';
          </script>";

}
?>