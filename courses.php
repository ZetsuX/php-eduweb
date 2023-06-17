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

</body>
</html>