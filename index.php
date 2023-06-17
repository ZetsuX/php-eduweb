<?php 
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require 'utils/functions.php';

    $uId = $_SESSION["uid"];

    $courses = getByQuery("SELECT * FROM courses ORDER BY id ASC LIMIT 3");
    $tutors = getByQuery("SELECT * FROM tutors ORDER BY id ASC LIMIT 3");

    if (isset($_POST["cosubmit"])) {
        $check = createContact($_POST);
        if ($check > 0) {
            echo "
                <script>
                    alert('Succesfully contacted us!');
                    document.location.href = '../index.php';
                </script>
            ";
        } else if ($check !== 0) {
            echo "
                <script>
                    alert('Failed to contact us..');
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
    <title>Eduweb | Home</title>
    
</head>
<body>
    <a href="logout.php" style="float: right">Log Out</a>
</body>
</html>