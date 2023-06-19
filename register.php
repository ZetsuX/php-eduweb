<?php
require 'utils/functions.php';

if (isset($_POST['rsubmit'])) {
    $check = registerUser($_POST,'u');
    if ($check > 0) {
        echo "
                <script>
                    alert('Succesfully registered as a new user!');
                    window.location = 'login.php';
                </script>
            ";
    } else if ($check !== 0) {
        echo "
                <script>
                    alert('Failed registering new user..');
                </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eduweb | Register</title>
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
                    <h1 class="font-semibold text-4xl">Daftar Sekarang</h1>
                    <p class="font-medium text-lg">Silahkan isi data berikut ini</p>
                </div>
                <div class="space-y-4">
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="rname">Nama</label>
                        <input type="text" name="rname" id="rname" required placeholder="Masukkan Nama Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="remail">Email</label>
                        <input type="email" name="remail" id="remail" required placeholder="Masukkan Email Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="rpw">Password</label>
                        <input type="password" name="rpw" id="rpw" placeholder="Masukkan Password Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label class="font-medium" for="rpw2">Confirm Password</label>
                        <input type="password" name="rpw2" id="rpw2" required placeholder="Masukkan Ulang Password Anda" class="px-4 py-2 border border-[#9E9E9E] rounded-lg">
                    </div>
                </div>
                <?php if (isset($error)) : ?>
                    <div class="bg-[#ff00601a] border border-[#FF2B7B] flex justify-center items-center px-3 py-1">
                        <p class="text-[#FF0060] text-sm font-medium">Masukkan data dengan benar</p>
                    </div>
                <?php endif; ?>
                <div class="space-y-4">
                    <button name="rsubmit" type="submit" class="px-4 py-2 text-center rounded-lg border-2 border-[#1A3650] bg-[#4D2C5E] w-full text-white">Daftar</button>
                    <p class="text-sm text-center">sudah punya akun? <a href="login.php" class="text-[#9470CE]">Masuk di sini</a></p>
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