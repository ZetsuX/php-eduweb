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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <header class="fixed top-0 w-full flex justify-between items-center min-h-[5rem] px-12 z-10">
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
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-24 justify-center">
        <div class="space-y-4 text-center">
            <h2 class="text-4xl font-bold text-center">Our Courses</h2>
            <p>Lorem ipsum is simply dummy text of the printing.</p>
        </div>
        <div class="w-full justify-between flex flex-row py-24 gap-x-8">
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/courses.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Frontend Engineer</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Frontend Engineering for Beginners</h3>
                    <p class='text-[#FF7426] font-semibold'>Rp 129.000</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/courses2.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Backend Engineer</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Backend Engineering for Beginners</h3>
                    <p class='text-[#FF7426] font-semibold'>Rp 259.000</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/courses3.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Fullstack Engineer</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Fullstack Engineering for Beginners</h3>
                    <p class='text-[#FF7426] font-semibold'>Rp 199.000</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
        </div>
        <div class='text-center text-purple-800 font-semibold w-fit border-b mx-auto border-purple-700'>
            <a href='courses.php'>Lihat Semua</a>
        </div>
    </section>
    <section class='bg-[#4D2C5E] w-full mx-auto justify-center flex px-2 py-4'>
        <div class='max-w-[1280px] justify-center flex'>
            <div class='w-1/2'>
                <img src="images/asset.png" alt="" width='300px'>
            </div>
            <div class='w-1/2 space-y-6 flex flex-col justify-center'>
                <div class='text-white font-semibold'>
                    <h3 class='text-[60px]'>Premium <span class='text-[#FF7426]'>Learning</span> Experience</h3>
                </div>
                <div class='space-y-8'>
                    <div class="flex gap-x-8 items-center text-white">
                        <img src="images/hearts.png" alt="" width='40px'>
                        <div>
                            <h3 class='text-lg'>Easily Acessible</h3>
                            <p class='text-[#ACACAC]'>Learning will feel very comfortable with EduWeb</p>
                        </div>
                    </div>
                    <div class="flex gap-x-8 items-center text-white">
                        <img src="images/jigsaw.png" alt="" width='40px'>
                        <div>
                            <h3 class='text-lg'>Easily Acessible</h3>
                            <p class='text-[#ACACAC]'>Learning will feel very comfortable with EduWeb</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-24 justify-center relative">
        <div class="space-y-4 text-center">
            <h2 class="text-4xl font-bold text-center">Our Tutors</h2>
            <p>Lorem ipsum is simply dummy text of the printing.</p>
        </div>
        <div class="w-full justify-between flex flex-row py-24 gap-x-8">
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/tutor.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Basic Frontend</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Calvin Janitra</h3>
                    <p class='text-[#FF7426] font-semibold'>Frontend Developer in Tokopedia</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/tutor.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Advanced Frontend</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Zhafran Dzaky</h3>
                    <p class='text-[#FF7426] font-semibold'>Senior Frontend Developer in Spotify</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
            <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                <img src="images/tutor.png" alt="">
                <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                    <h3>Fullstack Engineer</h3>
                    <img src="images/rating.png" alt="" width='80px'>
                </div>
                <div>
                    <h3 class='font-semibold'>Kevin Nathanael</h3>
                    <p class='text-[#FF7426] font-semibold'>Backend Developer in Shopee</p>
                </div>
                <div class="w-full border-2 border-dashed my-2"></div>
                <div class='flex gap-x-4'>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-regular fa-clock"></i>
                        <h3 class="text-[#ACACAC] text-sm" >22hr 30min</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-video"></i>
                        <h3 class="text-[#ACACAC] text-sm" >34 Courses</h3>
                    </div>
                    <div class="flex gap-x-2 justify-center items-center">
                        <i class="fa-solid fa-download"></i>
                        <h3 class="text-[#ACACAC]" >250 Sales</h3>
                    </div>
                </div>
                <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                    <a href="" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                </div>
            </div>
        </div>
        <div class='text-center text-purple-800 font-semibold w-fit border-b mx-auto border-purple-700'>
            <a href='tutors.php'>Lihat Semua</a>
        </div>
    </section>

    <!-- testimonial -->
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-24 justify-center relative">
        <div class="space-y-4 text-center flex flex-col items-center">
            <h2 class="text-4xl font-bold text-center">Student Testimonial</h2>
            <p class="w-3/5 text-center">vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra orci</p>
        </div>
        <div class="w-2/5 py-24 mx-auto">
            <div class='flex justify-center items-center gap-x-4 border-2 border-solid w-fit px-2 py-2'>
                <img src="images/pfp.png" alt="" width="100px">
                <h3 class=''>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis, lectus magna fringilla urna, porttitor</h3>
            </div>
        </div>
        <div class="w-9/12 bg-[#4D2C5E] text-white absolute -bottom-28 mx-auto px-8 py-10 flex flex-col justify-center left-1/2 -translate-x-1/2 rounded-2xl">
            <div class='text-center space-y-4'>
                <h3 class='text-lg'>Contact Us!</h3>
                <p>Lorem Ipsum is simply dummy text of the printing.</p>
                <input type="text" class='px-2 py-4 rounded-xl focus:outline-none' placeholder="Email Adress">
            </div>
        </div>
    </section>
    <!-- footer -->
    <section class="w-full mx-auto py-24 justify-center bg-[#FDF8EE] min-h-[400px]">
    </section>
</body>

</html>