<?php
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require '../utils/functions.php';

    $cId = $_GET["id"];
    $check = courseAdmit($_SESSION["uid"], $cId);

    if ($check > 0) {
        echo "
            <script>
                alert('Succesfully registered to the course!');
                document.location.href = '../index.php';
            </script>
        ";
    } else if ($check !== 0) {
        echo "
            <script>
                alert('Failed to registering the course..');
                document.location.href = '../index.php';
            </script>
        ";
    }
?>
