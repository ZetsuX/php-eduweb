<?php 
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require '../utils/functions.php';
    $tId = $_GET["id"];
    $uId = $_SESSION["uid"];

    $tutorPerPage = 5;
    $currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
    $firstIndex = ($currentPage-1)*$tutorPerPage;
    $tutorTotal = count(getByQuery("SELECT * FROM users WHERE role='t'"));
    $pageCount = ceil($tutorTotal/$tutorPerPage);
    
    $tCourses = getByQuery(sprintf("SELECT co.id AS course_id, co.name AS course_name, co.description AS course_description, co.price AS course_price, co.picture AS course_picture, pa.name AS partner_name, pa.logo AS partner_logo, (SELECT COUNT(ad.id) FROM admissions ad WHERE ad.course_id = co.id) AS admission_count, us.name AS tutor_name FROM courses co INNER JOIN partners pa ON pa.id = co.partner_id INNER JOIN users us ON us.id = co.tutor_id WHERE us.id = %s", $tId));
    $registeredCourse = getByQuery(sprintf("SELECT course_id FROM admissions WHERE user_id=%s",$uId));
    $outputArray = array();

    foreach ($registeredCourse as $item) {
        $outputArray[] = $item["course_id"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduweb | Tutor - courses</title>
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
<body class="bg-[#FDF8EE]">
    <section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-16 justify-center relative">
        <img src="../images/lamp.svg" alt="decor-lamp" width="100" height="100" class="absolute top-28 left-6">
        <img src="../images/prpl-curl.svg" alt="decor-lamp" width="100" height="100" class="absolute top-32 right-6 rotate-180">
        <div class="space-y-4">
            <a href="../tutors.php" class="space-x-2 border-b border-slate-800 font-medium"><i class="fa-solid fa-chevron-left"></i><span>Kembali</span></a>
            <h2 class="text-4xl font-bold text-center"><?= $tCourses[0]['tutor_name'] ?>&apos;s Courses</h2>
            <p class="text-center">Lorem ipsum is simply dummy text of the printing.</p>
        </div>
        <div class="w-full flex-wrap gap-y-16 gap-x-6 flex py-20">
            <?php $i = 1 ?>
            <?php foreach($tCourses as $c) :?>
                <div class="w-[32%] px-2 pt-2 py-10 shadow-lg rounded-lg relative bg-white">
                    <div class='w-full h-[200px] overflow-hidden rounded-lg relative'>
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
                            <i class="fa-solid fa-download"></i>
                            <h3 class="text-[#ACACAC]" ><?= $c['admission_count'] ?> Sales</h3>
                        </div>
                    </div>
                    <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                        <?php if (in_array($c["course_id"], $outputArray)) :?> 
                            <a href="https://fajarbaskoro.blogspot.com/2018/02/pweb-1-1-hosting-dan-domain.html" class="px-6 py-3 rounded-3xl bg-[#4D2C5E] hover:bg-[#25162d] text-white font-medium">Ayo Belajar</a>
                        <?php else :?>
                            <a href="../course/admission.php?id=<?= $c["course_id"]?>" class="px-6 py-3 rounded-3xl bg-[#FF7426] hover:bg-[#ef4207] hover:bg-[#ef4207] text-white font-medium">Join Course</a>
                        <?php endif;?>
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