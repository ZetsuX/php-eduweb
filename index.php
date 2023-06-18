<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'utils/functions.php';

$uId = $_SESSION["uid"];

$courses = getByQuery("SELECT * FROM courses ORDER BY id ASC LIMIT 3");
$tutors = getByQuery("SELECT * FROM users WHERE role = 't' ORDER BY id ASC LIMIT 3");

if (isset($_POST["cosubmit"])) {
    $check = createContact($_POST);
    if ($check > 0) {
        echo "
                <script>
                    alert('Succesfully contacted us!');
                    document.location.href = '../index.php';
                </script>
            ";
    } else if ($check !== 0) {
        echo "
                <script>
                    alert('Failed to contact us..');
                    document.location.href = '../index.php';
                </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eduweb | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <section class="h-screen w-full bg-[#FDF8EE] relative mb-10">
        <header class="fixed top-0 w-full flex justify-between items-center min-h-[5rem] px-12">
            <div class="flex items-center gap-x-3"><img src="images/logo.svg" alt="logo-eduweb" width="30" height="30"><span class="uppercase text-xl font-bold">eduweb</span></div>
            <ul class="flex items-center gap-x-8">
                <li><a href="#home" class="text-sm font-medium">Home</a></li>
                <li><a href="" class="text-sm font-medium">Courses</a></li>
                <li><a href="" class="text-sm font-medium">Tutors</a></li>
                <li><a href="" class="text-sm font-medium">Partners</a></li>
                <li><a href="" class="text-sm font-medium">Admission</a></li>
                <li><a href="" class="text-sm font-medium">Contact</a></li>
            </ul>
            <div>
                <a href="logout.php" class="px-6 py-2 rounded-3xl bg-[#4D2C5E] text-white font-medium">Keluar</a>
            </div>
        </header>
        <div id="home" class="flex items-center max-w-[1280px] mx-auto h-full">
            <div class="w-1/2">
                <div class="space-y-8">
                    <h1 class="font-extrabold text-5xl leading-[4rem]">Cara <span class="text-[#FF7426]">Cerdas</span> <br /> untuk <span class="text-[]">Belajar</span> Website</h1>
                    <p class="max-w-[80%]">EduWeb adalah platform online untuk belajar website bagi seluruh kalangan. Dapatkan juga sertifikasi dari menyelesaikan courses</p>
                    <div>
                        <a href="" class="px-6 py-3 rounded-3xl bg-[#4D2C5E] text-white font-medium">Ayo Belajar</a>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <img src="images/login.svg" alt="index-illustration" class="scale-90">
            </div>
        </div>
        <div class="w-9/12 bg-[#4D2C5E] text-white absolute -bottom-16 mx-auto px-8 py-10 flex justify-between left-1/2 -translate-x-1/2 rounded-2xl">
            <div class="flex items-center gap-x-3 w-[30%]">
                <img src="images/land-1.png" alt="landing-1" width="50" height="50">
                <div class="space-y-2">
                    <h3 class="font-semibold">Belajar Skill Baru</h3>
                    <p class="text-xs opacity-[.6]">Contrary to popular beliehf, Lorem Ipsum is not simply random text. It has roots in a BC, making it over 2000 years old.</p>
                </div>
            </div>
            <div class="flex items-center gap-x-3 w-[30%]">
                <img src="images/land-1.png" alt="landing-1" width="50" height="50">
                <div class="space-y-2">
                    <h3 class="font-semibold">Belajar Skill Baru</h3>
                    <p class="text-xs opacity-[.6]">Contrary to popular beliehf, Lorem Ipsum is not simply random text. It has roots in a BC, making it over 2000 years old.</p>
                </div>
            </div>
            <div class="flex items-center gap-x-3 w-[30%]">
                <img src="images/land-1.png" alt="landing-1" width="50" height="50">
                <div class="space-y-2">
                    <h3 class="font-semibold">Belajar Skill Baru</h3>
                    <p class="text-xs opacity-[.6]">Contrary to popular beliehf, Lorem Ipsum is not simply random text. It has roots in a BC, making it over 2000 years old.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-24 flex justify-center">
        <div class="space-y-4">
            <h2 class="text-4xl font-bold text-center">Our Courses</h2>
            <p>Lorem ipsum is simply dummy text of the printing.</p>
        </div>
    </section>
</body>

</html>