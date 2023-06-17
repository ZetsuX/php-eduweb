<?php
    session_start();
    require 'utils/functions.php';

    if (isset($_COOKIE['log1']) && isset($_COOKIE['log2'])){
        $cid = $_COOKIE['log1'];
        $chash = $_COOKIE['log2'];

        $checkUser = mysqli_query($dbConn, "SELECT email FROM users WHERE id = $cid");
        $cuser = mysqli_fetch_assoc($checkUser);

        if ($chash === hash('haval160,5', $cuser["email"])) {
            $_SESSION['loggedin'] = true;
        }
    }

    if (isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['lsubmit'])) {
        
        $email = $_POST['lemail'];
        $pass = $_POST['lpw'];

        $checkUser = mysqli_query($dbConn, "SELECT * FROM users WHERE email = '$email'");

        if (mysqli_num_rows($checkUser) == 1) {
            $user = mysqli_fetch_assoc($checkUser);
            var_dump($user);
            if (password_verify($pass, $user["password"])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["uid"] = $user["id"];
                $_SESSION["urole"] = $user["role"];

                if (isset($_POST["rmb"])) {
                    setcookie("log1", $user["id"], time() + 1800);
                    setcookie("log2", hash('haval160,5', $user["email"]), time() + 1800);
                }

                header("Location: index.php");
                exit;
            }
        }

        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eduweb | Login</title>
</head>
<body>
    <h1>Login Page</h1>

    <a href="register.php" style="float: left">Register</a>
    <br>
        
    <?php if (isset($error)) : ?>
        <p style="color: red; font-family: Arial, Helvetica, sans-serif;">Email / Password is incorrect.</p>
    <?php endif; ?>

    <form method="post">
        <ul>
            <li>
                <label for="lemail">Email : </label>
                <input type="text" name="lemail" id="lemail">
            </li>

            <li>
                <label style="padding: 0px 1.5px;" for="lpw">Password : </label>
                <input type="password" name="lpw" id="lpw">
            </li>

            <br>
            <button type="submit" name="lsubmit">Login</button>

            <div style="padding: 0px 0px 10px 77px; display: inline-block">
                <input type="checkbox" name="rmb" id="rmb">
                <label for="rmb">Remember Me </label>
            </div>

        </ul>
    </form>
</body>
</html>