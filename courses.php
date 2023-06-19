<?php 
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require 'utils/functions.php';

    $uId = $_SESSION["uid"];

    $coursePerPage = 5;
    $currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
    $firstIndex = ($currentPage-1)*$coursePerPage;
    $courseTotal = count(getByQuery("SELECT * FROM courses"));
    $pageCount = ceil($courseTotal/$coursePerPage);
    
    $courses = getByQuery("SELECT * FROM courses ORDER BY id ASC LIMIT $firstIndex, $coursePerPage");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eduweb | Courses</title>
</head>
<body>
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
</body>
</html>