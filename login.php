<?php
session_start();
require 'utils/functions.php';

if (isset($_COOKIE['log1']) && isset($_COOKIE['log2'])) {
    $cid = $_COOKIE['log1'];
    $chash = $_COOKIE['log2'];

    $checkUser = mysqli_query($dbConn, "SELECT email FROM users WHERE id = $cid");
    $cuser = mysqli_fetch_assoc($checkUser);

    if ($chash === hash('haval160,5', $cuser["email"])) {
        $_SESSION['loggedin'] = true;
    }
}

if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['lsubmit'])) {

    $email = $_POST['lemail'];
    $pass = $_POST['lpw'];

    $checkUser = mysqli_query($dbConn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($checkUser) == 1) {
        $user = mysqli_fetch_assoc($checkUser);
        var_dump($user);
        if (password_verify($pass, $user["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["uid"] = $user["id"];
            $_SESSION["urole"] = $user["role"];

            if (isset($_POST["rmb"])) {
                setcookie("log1", $user["id"], time() + 1800);
                setcookie("log2", hash('haval160,5', $user["email"]), time() + 1800);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eduweb | Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <main class="h-screen w-full flex">
        <section class="h-full w-5/12 grid place-items-center">
            <form method="post" class="space-y-8 min-w-fit w-[28rem]">
                <div class="py-2.5 space-y-1.5">
                    <h1 class="font-semibold text-4xl">Masuk Sekarang</h1>
                    <p class="font-medium text-lg">Silahkan masuk dengan akunmu</p>
                </div>
                <div class="space-y-4">
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="email">Email</label>
                        <input name="lemail" id="lemail" type="email" placeholder="Masukkan Email Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="password">Password</label>
                        <input name="lpw" id="lpw" type="password" placeholder="Masukkan Password Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                    <div class="flex justify-end">
                        <div class="flex items-center gap-x-2">
                            <input type="checkbox">
                            <label class="text-sm text-[#9470CE]" for="rmb">Ingat saya</label>
                        </div>
                    </div>
                </div>
                <?php if (isset($error)) : ?>
                    <div class="bg-[#ff00601a] border border-[#FF2B7B] flex justify-center items-center px-3 py-1">
                        <p class="text-[#FF0060] text-sm font-medium">Email atau password salah</p>
                    </div>
                <?php endif; ?>
                <div class="space-y-4">
                    <button name="lsubmit" type="submit" class="px-4 py-2 text-center rounded-lg border-2 border-[#1A3650] bg-[#4D2C5E] w-full text-white">Masuk</button>
                    <p class="text-sm text-center">belum punya akun? <a href="register.php" class="text-[#9470CE]">Daftar di sini</a></p>
                </div>
            </form>
        </section>
        <section class="h-full w-7/12 bg-[#FDF8EE]">
            <div class="h-full w-full flex items-center justify-center">
                <img src="images/login.svg" alt="login-illustration" class="scale-90">
            </div>
        </section>
    </main>
</body>

</html>