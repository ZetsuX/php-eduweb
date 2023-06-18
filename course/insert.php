<?php
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    if ($_SESSION['urole'] != 't'){
      header('Location: index.php');
      exit;
    }
    
    require '../utils/functions.php';

    $uId = $_SESSION['uid'];
    $user = getByQuery("SELECT name FROM users WHERE id = $uId");
    $uname = $user[0]['name'];

    if (isset($_POST["isubmit"])) {
        $check = createCourse($_POST, $_FILES, $uId);
        if ($check > 0) {
            echo "
                <script>
                    alert('Succesfully created the course!');
                    document.location.href = '../index.php';
                </script>
            ";
        } else if ($check !== 0) {
            echo "
                <script>
                    alert('Failed creating course..');
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
    <title>Eduweb | New Course</title>
</head>
<body>
    
</body>
</html>