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
    
    $courses = getByQuery("SELECT pa.id as partner_id, pa.name as partner_name, pa.logo as partner_logo, COUNT(DISTINCT us.id) as tutor_count, COUNT(co.id) as course_count FROM partners pa INNER JOIN courses co ON co.partner_id = pa.id INNER JOIN users us ON co.tutor_id = us.id GROUP BY pa.id, pa.name, pa.logo");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduweb | Partners</title>
    <link rel="icon" href="images/logo.svg">
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
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
<section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-16 justify-center relative">
    <img src="images/lamp.svg" alt="decor-lamp" width="100" height="100" class="absolute top-28 left-6">
    <img src="images/prpl-curl.svg" alt="decor-lamp" width="100" height="100" class="absolute top-32 right-6 rotate-180">
        <div class="space-y-4">
            <a href="index.php" class="space-x-2 border-b border-slate-800 font-medium"><i class="fa-solid fa-chevron-left"></i><span>Kembali</span></a>
            <h2 class="text-4xl font-bold text-center">Our Partners</h2>
            <p class="text-center">Lorem ipsum is simply dummy text of the printing.</p>
        </div>
        <div class="w-full flex-wrap gap-x-6 gap-y-16 flex py-20">
            <?php $i = 1 ?>
            <?php foreach($courses as $c) :?>
                <div class="w-[32%] px-2 pt-2 py-10 shadow-lg rounded-lg relative bg-white">
                    <div class='w-full h-[200px] rounded-lg flex justify-center items-center overflow-hidden'>
                        <img src="<?= $c['partner_logo'] ?>" alt="" class='w-full'>
                    </div>
                    <div class='flex justify-between w-full items-center pt-2'>
                        <h3><?= $c['partner_name'] ?></h3>
                        <img src="images/rating.png" alt="" width='80px'>
                    </div>
                    <div class="w-full border my-2"></div>

                    <div class='flex gap-x-4'>
                        <div class="flex gap-x-2.5 justify-center items-center">
                            <i class="fa-solid fa-book"></i>
                            <h3 class="text-[#ACACAC]" ><?= $c['course_count'] ?> Courses</h3>
                        </div>
                        <div class="flex gap-x-2.5 justify-center items-center">
                            <i class="fa-solid fa-chalkboard-user"></i>
                            <h3 class="text-[#ACACAC]" ><?= $c['tutor_count'] ?> Tutors</h3>
                        </div>
                    </div>
                    <div>
                    </div>
                    <!-- <div class="w-full border-2 border-dashed my-2"></div>
                    <div class='flex gap-x-4'>
                        <div class="flex gap-x-2 justify-center items-center"> -->
                            <!-- <i class="fa-solid fa-download"></i> -->
                            <!-- <h3 class="text-[#ACACAC]" ><?= $c['courses_name'] ?> Courses</h3>
                        </div>
                    </div> -->
                    <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                        <a href="partner/index.php?id=<?= $c["partner_id"]?>" class="px-6 py-3 rounded-3xl bg-[#FF7426] hover:bg-[#ef4207] text-white font-medium">See Courses</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class='text-center text-slate-800 font-semibold w-fit border-b mx-auto border-slate-700'>
            <a href='courses.php'>Lihat Semua</a>
        </div> -->
    </section>
</body>
</html>