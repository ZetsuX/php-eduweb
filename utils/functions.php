<?php 
    include("config.php");

    function registerUser($newUser,$role) {
        global $dbConn;

        $rname = mysqli_real_escape_string($dbConn, $newUser["rname"]);
        $remail = mysqli_real_escape_string($dbConn, $newUser["remail"]);
        $rpass = mysqli_real_escape_string($dbConn, $newUser["rpw"]);
        $rconfirmpass = mysqli_real_escape_string($dbConn, $newUser["rpw2"]);

        $checkUser = mysqli_query($dbConn, "SELECT email FROM users WHERE email = '$remail'");
        if (mysqli_fetch_assoc($checkUser)) {
            echo "
                <script>
                    alert('The email is already registered, please choose another email to register with.');
                </script>
            ";
            return 0;
        }

        if ($rpass !== $rconfirmpass) {
            echo "
                <script>
                    alert('The password and the confirmation password are different.');
                </script>
            ";
            return 0;
        }

        $rpass = password_hash($rpass, PASSWORD_DEFAULT);

        if (strlen($rpass) > 300) {
            echo "
                <script>
                    alert('The password is too long, please shorten it.');
                </script>
            ";
            return 0;
        }

        $query = 
            "INSERT INTO users (name, email, password,role) VALUES (
                '$rname', '$remail', '$rpass','$role')";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function getByQuery($query) {
        global $dbConn;

        $res = mysqli_query($dbConn, $query);
        $rows = [];

        while ($r = mysqli_fetch_assoc($res)) {
            $rows[] = $r;
        }

        return $rows;
    }

    function createContact($newData) {
        global $dbConn;

        $coMessage = htmlspecialchars($newData["comessage"]);
        $coUid = htmlspecialchars($newData["couid"]);

        $query = "INSERT INTO contacts (message, user_id) VALUES ('$coMessage', $coUid)";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function createCourse($newData, $tutorId) {
        global $dbConn;

        $crName = htmlspecialchars($newData["crname"]);
        $crDesc = htmlspecialchars($newData["crdescription"]);
        $crImg = htmlspecialchars($newData["crimage"]);
        $crPrice = $newData["crprice"];

        $query = "INSERT INTO courses (name, description, price, image, tutor_id) VALUES (
                '$crName', '$crDesc', $crPrice, '$crImg', $tutorId)";


        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function createPartner($newData, $newFile) {
        global $dbConn;

        $paName = htmlspecialchars($newData["crname"]);
        $paImg = htmlspecialchars($newData["crimage"]);
        $query = "INSERT INTO partners (name, logo) VALUES ('$paName', '$paImg)";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }
    function courseAdmit($uId, $cId) {
        global $dbConn;
        
        $query = "INSERT INTO admissions (timestamp, user_id, course_id) VALUES (CURRENT_TIMESTAMP,$uId,$cId)";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }
?>