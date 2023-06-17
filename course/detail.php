<?php
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require '../utils/functions.php';

    $cId = $_GET["id"];
    $course = getByQuery("SELECT * FROM courses WHERE m.id = $cId")[0];

    if (isset($_POST["isubmit"])) {
        $check = replyMsg($_POST);
        if ($check > 0) {
            echo "
                <script>
                    alert('Succesfully replied the course!');
                    document.location.href = '../index.php';
                </script>
            ";
        } else if ($check !== 0) {
            echo "
                <script>
                    alert('Failed replying course..');
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
    <title>Eduweb | Course Detail</title>
</head>
<body>
    
</body>
</html>