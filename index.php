<?php
include "config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_kamar WHERE status_kamar='Tersedia' LIMIT 6");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-50">

   <?php include "includes/navbar.php"; ?>

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-16">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <div>

            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full">
                Selamat Datang
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-6 leading-tight">

                Temukan Hotel
                Terbaik Untuk Liburan Anda

            </h1>

            <p class="text-gray-600 mt-6 text-base md:text-lg">

                Booking kamar hotel dengan mudah,
                cepat dan aman menggunakan sistem
                reservasi online.

            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-4">

                <a href="login.php"
                    class="bg-blue-600 text-white px-7 py-3 rounded-lg hover:bg-blue-700 text-center">

                    Pesan Sekarang

                </a>

                <a href="#kamar"
                    class="border border-blue-600 text-blue-600 px-7 py-3 rounded-lg text-center">

                    Lihat Kamar

                </a>

            </div>

        </div>

        <div>

            <img src="assets/img/hotel.png"
                class="rounded-3xl shadow-xl w-full h-64 md:h-auto object-cover">

        </div>

    </div>

</section>

<!-- ================= FITUR ================= -->

<section class="bg-white py-12">

    <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8 px-4 sm:px-6">

        <!-- Kamar -->
        <div class="text-center">

            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-10 h-10 md:w-14 md:h-14 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10h18v8H3v-8zm2-4h4a2 2 0 012 2v2H5V6a2 2 0 012-2zm8 0h4a2 2 0 012 2v2h-6V6a2 2 0 012-2z" />

                </svg>
            </div>

            <h3 class="font-bold text-base md:text-lg mt-4">
                Kamar Nyaman
            </h3>

            <p class="text-gray-500 text-sm mt-2">
                Kamar bersih dan nyaman untuk keluarga.
            </p>

        </div>

        <!-- WiFi -->
        <div class="text-center">

            <div class="flex justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-10 h-10 md:w-14 md:h-14 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.111 16.556a5.5 5.5 0 017.778 0M5.282 13.727a9.5 9.5 0 0113.436 0M2.454 10.899a13.5 13.5 0 0119.092 0M12 20h.01" />

                </svg>

            </div>

            <h3 class="font-bold text-base md:text-lg mt-4">
                WiFi Gratis
            </h3>

            <p class="text-gray-500 text-sm mt-2">
                Internet cepat tersedia di seluruh area hotel.
            </p>

        </div>

        <!-- Restaurant -->
        <div class="text-center">

            <div class="flex justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-10 h-10 md:w-14 md:h-14 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 3v8M12 3v8M16 3v8M6 11h12M18 21V11M6 21V11" />

                </svg>

            </div>

            <h3 class="font-bold text-base md:text-lg mt-4">
                Breakfast
            </h3>

            <p class="text-gray-500 text-sm mt-2">
                Sarapan tersedia setiap pagi.
            </p>

        </div>

        <!-- Pool -->
        <div class="text-center">

            <div class="flex justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-10 h-10 md:w-14 md:h-14 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 18c1 1 2 1.5 3.5 1.5S9 19 10.5 18s3-.5 4.5.5S18 20 20 18" />

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v8m0 0l-2-2m2 2l2-2" />

                </svg>

            </div>

            <h3 class="font-bold text-base md:text-lg mt-4">
                Kolam Renang
            </h3>

            <p class="text-gray-500 text-sm mt-2">
                Kolam renang untuk dewasa dan anak-anak.
            </p>

        </div>

    </div>

</section>
<!-- ================= KAMAR ================= -->

<section id="kamar" class="max-w-7xl mx-auto py-10 md:py-16 px-4 sm:px-6">

    <h2 class="text-3xl md:text-4xl font-bold text-center mb-10">
        Daftar Kamar
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php while($row = mysqli_fetch_assoc($query)){ ?>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <img src="assets/img/<?php echo $row['foto']; ?>"
                class="w-full h-52 md:h-56 object-cover">

            <div class="p-5">

                <h3 class="text-xl md:text-2xl font-bold">
                    <?php echo $row['nama_kamar']; ?>
                </h3>

                <p class="text-gray-500">
                    <?php echo $row['tipe']; ?>
                </p>

                <p class="text-blue-600 text-xl md:text-2xl font-bold mt-3">
                    Rp <?= number_format($row['harga'],0,",","."); ?>
                </p>

                <p class="text-gray-600 mt-3 text-sm md:text-base">
                    <?php echo $row['deskripsi']; ?>
                </p>

                <a href="detail.php?id=<?= $row['id_kamar']; ?>"
                    class="block w-full mt-5 text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">

                    Detail

                </a>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
