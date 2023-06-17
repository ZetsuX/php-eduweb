<?php
    session_start();

    if (!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
    
    require '../utils/functions.php';

    $uId = $_SESSION['uid'];
    $user = getByQuery("SELECT name FROM users WHERE id = $uId");
    $uname = $user[0]['name'];

    if (isset($_POST["isubmit"])) {
        $check = createPartner($_POST, $_FILES);
        if ($check > 0) {
            echo "
                <script>
                    alert('Succesfully created the partner!');
                    document.location.href = '../index.php';
                </script>
            ";
        } else if ($check !== 0) {
            echo "
                <script>
                    alert('Failed creating partner..');
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