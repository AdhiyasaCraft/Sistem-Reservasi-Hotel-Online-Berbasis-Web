<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_pelanggan ORDER BY id_pelanggan DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <!-- WAJIB: Agar responsive design bekerja di perangkat mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 antialiased">

<div class="max-w-7xl mx-auto px-4 py-6 sm:py-10">

    <!-- Header Area: flex-col untuk mobile, sm:flex-row untuk layar tablet ke atas -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">

        <h1 class="text-2xl sm:text-4xl font-bold text-blue-600">
            Data Pelanggan
        </h1>

        <a href="../dashboard.php"
           class="w-full sm:w-auto text-center bg-gray-600 hover:bg-gray-700 text-white px-5 py-2.5 sm:py-3 rounded-lg text-sm sm:text-base transition-colors duration-200">
            Dashboard
        </a>

    </div>

    <!-- Container Tabel dengan shadow dan rounded -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        
        <!-- Pembungkus Responsive Scroll Horizontal -->
        <div class="overflow-x-auto w-full">

            <table class="w-full min-w-[700px] border-collapse">

                <thead class="bg-blue-600 text-white text-sm sm:text-base">

                    <tr>
                        <th class="p-4 text-left w-16">No</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">No HP</th>
                        <th class="p-4 text-left">Alamat</th>
                        <th class="p-4 text-left">Username</th>
                    </tr>

                </thead>

                <tbody class="text-sm sm:text-base text-gray-700">

                <?php
                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)){
                ?>

                    <tr class="border-b last:border-0 hover:bg-gray-50 transition-colors">

                        <td class="p-4 font-medium"><?= $no++; ?></td>

                        <td class="p-4 whitespace-nowrap"><?= htmlspecialchars($row['nama']); ?></td>

                        <td class="p-4"><?= htmlspecialchars($row['email']); ?></td>

                        <td class="p-4 whitespace-nowrap"><?= htmlspecialchars($row['no_hp']); ?></td>

                        <td class="p-4 max-w-xs truncate" title="<?= htmlspecialchars($row['alamat']); ?>">
                            <?= htmlspecialchars($row['alamat']); ?>
                        </td>

                        <td class="p-4 font-semibold text-gray-600"><?= htmlspecialchars($row['username']); ?></td>

                    </tr>

                <?php
                    }
                } else {
                ?>

                    <tr>

                        <td colspan="6" class="text-center p-8 text-gray-500 italic">
                            Belum ada pelanggan yang mendaftar.
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