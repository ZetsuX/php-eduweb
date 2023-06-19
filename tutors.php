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
    
    $tutors = getByQuery("SELECT * FROM users WHERE role='t' ORDER BY id ASC LIMIT $firstIndex, $tutorPerPage");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eduweb | Tutors</title>
</head>
<body>

</body>
</html>