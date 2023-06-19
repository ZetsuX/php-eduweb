<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'utils/functions.php';

$uId = $_SESSION["uid"];

$courses = getByQuery("SELECT co.id as course_id, co.name as course_name, co.description as course_description, co.price as course_price, co.picture as course_picture, pa.name as partner_name, pa.logo as partner_logo FROM courses co INNER JOIN partners pa ON pa.id = co.partner_id LIMIT 3");
$tutors = getByQuery("SELECT us.id as tutor_id, co.name as course_name, co.description as course_description, co.price as course_price, co.picture as course_picture, us.name as tutor_name, us.picture as tutor_picture FROM courses co INNER JOIN users us ON us.id = co.tutor_id LIMIT 3");
$registeredCourse = getByQuery(sprintf("SELECT course_id FROM admissions WHERE user_id=%s",$uId));
$outputArray = array();

foreach ($registeredCourse as $item) {
    $outputArray[] = $item["course_id"];
}
if (isset($_POST["cosubmit"])) {
    $check = createContact($_POST);
    if ($check > 0) {
        echo "
                <script>
                    alert('Succesfully contacted us!');
                    document.location.href = 'index.php';
                </script>
            ";
    } else if ($check !== 0) {
        echo "
                <script>
                    alert('Failed to contact us..');
                    document.location.href = 'index.php';
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
    <div><?php var_dump($outputArray) ?></div>
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
            <?php $i = 1 ?>
            <?php foreach($courses as $c) :?>
                <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                    <div class='w-full h-[250px] overflow-hidden rounded-lg relative'>
                        <img src="<?= $c['course_picture'] ?>" alt="" class='object-cover'>
                        <img src="<?= $c['partner_logo'] ?>" alt="" class='absolute top-0' width='40px'>
                    </div>
                    <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                        <h3><?= $c['course_name'] ?></h3>
                        <img src="images/rating.png" alt="" width='80px'>
                    </div>
                    <div>
                        <h3 class='font-semibold align-justify truncate '><?= $c['course_description'] ?></h3>
                        <p class='text-[#FF7426] font-semibold'>Rp <?= $c['course_price'] ?></p>
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
                        <?php if (in_array($c["course_id"], $outputArray)) :?> 
                            <a class="px-6 py-3 rounded-3xl bg-[#4D2C5E] text-white font-medium">Ayo Belajar</a>
                        <?php else :?>
                            <a href="course/admission.php?id=<?= $c["course_id"]?>" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">Join Course</a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class='text-center text-slate-800 font-semibold w-fit border-b mx-auto border-slate-700'>
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
                    <h3 class='text-6xl'>Premium <span class='text-[#FF7426]'>Learning</span> Experience</h3>
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
            <?php $i = 1 ?>
            <?php foreach($tutors as $t) :?>
                <div class="w-1/3 px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                    <div class="w-full h-[200px] overflow-hidden rounded-lg">
                        <img src="<?= $t['tutor_picture'] ?>" alt="" class='object-cover'>
                    </div>
                    <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                        <h3><?= $t['course_name'] ?></h3>
                        <img src="images/rating.png" alt="" width='80px'>
                    </div>
                    <div>
                        <h3 class='font-semibold'><?= $t['tutor_name'] ?></h3>
                        <p class='text-[#FF7426] font-semibold truncate'><?= $t['course_description'] ?></p>
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
            <?php endforeach; ?>
        </div>
        <div class='text-center text-slate-800 font-semibold w-fit border-b mx-auto border-slate-700'>
            <a href='tutors.php'>Lihat Semua</a>
        </div>
    </section>

    <!-- testimonial -->
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-24 justify-center relative">
        <div class="space-y-4 text-center flex flex-col items-center">
            <h2 class="text-4xl font-bold text-center">Student Testimonial</h2>
            <p class="w-3/5 text-center">vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra orci</p>
        </div>
        <div class="py-24 w-[440px] mx-auto">
            <div class='flex justify-end items-center gap-x-4 border-2 border-[#4D2C5E] shadow-md rounded-xl w-fit p-4 pt-5 pb-2 relative'>
                <img src="images/pfp.png" alt="" width="120" height="120" class="absolute -left-14 top-1/2 -translate-y-1/2">
                <div class="flex flex-col w-10/12 gap-y-1">
                    <p class=''>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis, lectus magna fringilla urna, porttitor</p>
                    <p class="text-right text-sm">- Joe stanlee</p>
                </div>
            </div>
        </div>
        <div class="w-9/12 bg-[#4D2C5E] text-white absolute -bottom-28 mx-auto px-8 py-16 flex flex-col justify-center left-1/2 -translate-x-1/2 rounded-2xl z-10">
            <div class='text-center space-y-6 flex flex-col justify-center'>
                <h3 class='text-3xl font-semibold'>Contact Us!</h3>
                <p class="mb-2">Lorem Ipsum is simply dummy text of the printing.</p>
                <div class="w-full flex justify-center">
                <form method="post" class="relative w-1/2">
                    <input type="hidden" name="couid" id="couid" value=<?= $_SESSION['uid'] ?> />
                    <input type="text" name="comessage" id="comessage" class='px-10 py-4 w-full text-black rounded-full focus:outline-2 focus:outline-[#ACACAC]' placeholder="Masukkan pesan Anda">
                    <button name="cosubmit" id="cosubmit" type="submit" class="rounded-full bg-[#FF7426] absolute right-1.5 px-8 py-3 font-medium top-1/2 -translate-y-1/2">Send</button>
                </form>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <section class="w-full mx-auto pt-24 pb-16 bg-[#FDF8EE] h-[400px]">
        <div class="flex justify-center items-end gap-x-4 text-xl h-full">
            <a class="hover:opacity-75 cursor-pointer" href="https://github.com/ZetsuX/php-eduweb"><i class="fa-brands fa-github"></i></a>
            <a class="hover:opacity-75 cursor-pointer" href=""><i class="fa-brands fa-facebook"></i></a>
            <a class="hover:opacity-75 cursor-pointer" href=""><i class="fa-brands fa-linkedin-in"></i></a>
            <a class="hover:opacity-75 cursor-pointer" href=""><i class="fa-brands fa-twitter"></i></a>
        </div>
    </section>
</body>

</html>