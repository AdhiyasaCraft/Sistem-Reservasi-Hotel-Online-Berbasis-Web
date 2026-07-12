<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT
t_reservasi.*,
t_pelanggan.nama,
t_kamar.nama_kamar

FROM t_reservasi

JOIN t_pelanggan
ON t_reservasi.id_pelanggan=t_pelanggan.id_pelanggan

JOIN t_kamar
ON t_reservasi.id_kamar=t_kamar.id_kamar

ORDER BY id_reservasi DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600">
            Data Reservasi
        </h1>

        <a href="../dashboard.php"
            class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-3 rounded-lg text-center transition w-full sm:w-auto">
            Dashboard
        </a>

    </div>

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">

                <thead class="bg-blue-600 text-white">

                    <tr>

                        <th class="p-4 text-left">No</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Kamar</th>
                        <th class="p-4 text-left">Check In</th>
                        <th class="p-4 text-left">Check Out</th>
                        <th class="p-4 text-center">Tamu</th>
                        <th class="p-4 text-left">Total</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;

                while($row=mysqli_fetch_assoc($query)){
                ?>

                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-4"><?= $no++; ?></td>

                    <td class="p-4"><?= $row['nama']; ?></td>

                    <td class="p-4"><?= $row['nama_kamar']; ?></td>

                    <td class="p-4">
                        <?= date('d-m-Y',strtotime($row['check_in'])); ?>
                    </td>

                    <td class="p-4">
                        <?= date('d-m-Y',strtotime($row['check_out'])); ?>
                    </td>

                    <td class="p-4 text-center">
                        <?= $row['jumlah_tamu']; ?>
                    </td>

                    <td class="p-4 font-semibold text-blue-600 whitespace-nowrap">
                        Rp <?= number_format($row['total_harga'],0,",","."); ?>
                    </td>

                    <td class="p-4 text-center">

                        <?php

                        $status = $row['status_reservasi'];

                        if($status=="Pending"){
                            echo "<span class='inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold'>Pending</span>";
                        }elseif($status=="Dikonfirmasi"){
                            echo "<span class='inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold'>Dikonfirmasi</span>";
                        }elseif($status=="Check In"){
                            echo "<span class='inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold'>Check In</span>";
                        }elseif($status=="Check Out"){
                            echo "<span class='inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold'>Check Out</span>";
                        }elseif($status=="Selesai"){
                            echo "<span class='inline-block bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold'>Selesai</span>";
                        }else{
                            echo "<span class='inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold'>Batal</span>";
                        }

                        ?>

                    </td>

                    <td class="p-4 text-center">

                        <a href="edit.php?id=<?= $row['id_reservasi']; ?>"
                            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                            Edit
                        </a>

                    </td>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>