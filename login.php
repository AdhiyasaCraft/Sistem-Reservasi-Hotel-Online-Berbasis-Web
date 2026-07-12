<?php
session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // ==========================
    // Login Admin
    // ==========================
    $admin = mysqli_query($conn, "SELECT * FROM t_admin WHERE username='$username' AND passwords='$password'");

    if (mysqli_num_rows($admin) > 0) {

        $data = mysqli_fetch_assoc($admin);

        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['nm_admin'] = $data['nm_admin'];
        $_SESSION['level'] = "admin";

        header("Location: admin/dashboard.php");
        exit;
    }

    // ==========================
    // Login Pelanggan
    // ==========================
    $pelanggan = mysqli_query($conn, "SELECT * FROM t_pelanggan WHERE username='$username' AND passwords='$password'");

    if (mysqli_num_rows($pelanggan) > 0) {

        $data = mysqli_fetch_assoc($pelanggan);
        
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        $_SESSION['pelanggan'] = $data['nama'];
        $_SESSION['level'] = "pelanggan";

        header("Location: pelanggan/dashboard_pelanggan.php");
        exit;
    }


    echo "<script>
            alert('Username atau Password salah!');
          </script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex justify-center items-center px-4 py-8">

    <div class="bg-white shadow-lg rounded-xl w-full max-w-md p-6 sm:p-8">

        <h2 class="text-2xl sm:text-3xl font-bold text-center text-blue-600">
            Login
        </h2>

        <p class="text-center text-gray-500 mb-6">
            Silakan login untuk melanjutkan
        </p>

        <form method="POST">

            <div class="mb-4">
                <label class="block mb-2">Username</label>

                <input
                    type="text"
                    name="username"
                    required
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block mb-2">Password</label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button
                type="submit"
                name="login"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">

                Login

            </button>

        </form>

        <p class="text-center mt-5">
            Belum punya akun?

            <a href="register.php"
                class="text-blue-600 font-semibold">
                Register
            </a>
        </p>

    </div>

</div>

</body>
</html>