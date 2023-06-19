<?php 
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require 'utils/functions.php';

    $uId = $_SESSION["uid"];

    $tutorPerPage = 5;
    $currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
    $firstIndex = ($currentPage-1)*$tutorPerPage;
    $tutorTotal = count(getByQuery("SELECT * FROM users WHERE role='t'"));
    $pageCount = ceil($tutorTotal/$tutorPerPage);
    
    $tutors = getByQuery("SELECT us.id as tutor_id, us.name as tutor_name, us.picture as tutor_picture, COUNT(co.id) as course_count FROM users us INNER JOIN courses co ON co.tutor_id = us.id WHERE us.role = 't' GROUP BY us.id, us.name, us.picture");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eduweb | Tutors</title>
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
<section class="min-h-screen w-full max-w-[1280px] mx-auto h-full py-16 justify-center relative">
    <img src="images/lamp.svg" alt="decor-lamp" width="100" height="100" class="absolute top-28 left-6">
    <img src="images/prpl-curl.svg" alt="decor-lamp" width="100" height="100" class="absolute top-32 right-6 rotate-180">
        <div class="space-y-4">
            <a href="index.php" class="space-x-2 border-b border-slate-800 font-medium"><i class="fa-solid fa-chevron-left"></i><span>Kembali</span></a>
            <h2 class="text-4xl font-bold text-center">Our Tutors</h2>
            <p class="text-center">Lorem ipsum is simply dummy text of the printing.</p>
        </div>
        <div class="w-full justify-between flex flex-wrap gap-y-16 py-20">
            <?php $i = 1 ?>
            <?php foreach($tutors as $t) :?>
                <div class="w-[32%] px-2 pt-2 py-10 shadow-lg rounded-lg relative">
                    <div class="w-full h-[200px] overflow-hidden rounded-lg">
                        <img src="<?= $t['tutor_picture'] ?>" alt="" class='object-cover'>
                    </div>
                    <div class='text-[#ACACAC] flex justify-between w-full items-center pt-2'>
                        <h3 class='font-semibold text-slate-900'><?= $t['tutor_name'] ?></h3>
                        <img src="images/rating.png" alt="" width='80px'>
                    </div>
                    <div class="w-full border-2 border-dashed my-2"></div>
                    <div class='flex gap-x-4'>
                        <div class="flex gap-x-2 justify-center items-center">
                            <i class="fa-solid fa-book"></i>
                            <h3 class="text-[#ACACAC] text-sm" ><?= $t['course_count'] ?> Courses</h3>
                        </div>
                    </div>
                    <div class='absolute bottom-0 left-1/2 -translate-x-1/2'>
                        <a href="tutor/index.php?id=<?= $t["tutor_id"]?>" class="px-6 py-3 rounded-3xl bg-[#FF7426] text-white font-medium">See Courses</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>