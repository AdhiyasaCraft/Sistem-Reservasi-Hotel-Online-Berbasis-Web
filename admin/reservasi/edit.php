<?php
session_start();

if(!isset($_SESSION['id_admin'])){
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM t_reservasi WHERE id_reservasi='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $status = $_POST['status_reservasi'];

    mysqli_query($conn,"UPDATE t_reservasi SET
    status_reservasi='$status'
    WHERE id_reservasi='$id'");

    echo "
    <script>
        alert('Status berhasil diubah');
        window.location='index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Status Reservasi</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto px-4 py-8 md:py-16">

    <div class="bg-white shadow-lg rounded-xl p-5 md:p-8">

        <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-6">
            Update Status Reservasi
        </h2>

        <form method="POST" class="space-y-6">

            <div>
                <label class="block font-semibold mb-2">
                    Status Reservasi
                </label>

                <select
                    name="status_reservasi"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <?php

                    $status = [
                        "Pending",
                        "Dikonfirmasi",
                        "Check In",
                        "Check Out",
                        "Selesai",
                        "Batal"
                    ];

                    foreach($status as $s){

                        $selected = ($row['status_reservasi']==$s) ? "selected" : "";

                        echo "<option value='$s' $selected>$s</option>";

                    }

                    ?>

                </select>

            </div>

            <div class="flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    name="update"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-300">
                    Update
                </button>

                <a
                    href="index.php"
                    class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-center transition duration-300">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>