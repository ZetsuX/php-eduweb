<?php 
    include("config.php");

    function registerUser($newUser) {
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
            "INSERT INTO users (name, email, password) VALUES (
                '$rname', '$remail', '$rpass')";

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

    function uploadFile($file, $allowedExtensions, $maxSize) {
        $fileName = $file["name"];
        $fileSize = $file["size"];
        $fileTmp = $file["tmp_name"];

        $fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));

        $allowedEString = implode(", ", $allowedExtensions);
        if ( !in_array($fileExtension, $allowedExtensions) ) {
            echo "
                <script>
                    alert('Please upload a file with extension $allowedEString.');
                </script>
            ";
            return false;
        }

        if ( $fileSize > $maxSize ) {
            echo "
                <script>
                    alert('File size is too large, maximum allowed size is $maxSize byte(s).');
                </script>
            ";
            return false;
        }

        $fileName = str_replace("." . $fileExtension, "", $fileName);
        $fileName = substr($fileName, 0, 75) . uniqid() . '.' . $fileExtension;

        move_uploaded_file($fileTmp, '../img/' . $fileName);
        return $fileName;
    }

    function createContact($newData) {
        global $dbConn;

        $coMessage = htmlspecialchars($newData["comessage"]);
        $coUid = htmlspecialchars($newData["couid"]);

        $query = "INSERT INTO contacts (message, user_id) VALUES ('$coMessage', $coUid)";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function createCourse($newData, $newFile, $tutorId) {
        global $dbConn;

        $crName = htmlspecialchars($newData["crname"]);
        $crDesc = htmlspecialchars($newData["crdescription"]);
        $crPrice = $newData["crprice"];

        if ($newFile['crimage']['error'] == 4 || ($newFile['crimage']['size'] == 0 && $newFile['crimage']['error'] == 0)) {
            $query = "INSERT INTO courses (name, description, price, tutor_id) VALUES (
                '$crName', '$crDesc', $crPrice, $tutorId)";
        } else {
            $crImg = uploadFile($newFile["crimage"], ['jpg', 'png', 'jpeg'], 2000000);
            if (!$crImg) {
                return 0;
            }

            $query = "INSERT INTO courses (name, description, price, image, tutor_id) VALUES (
                '$crName', '$crDesc', $crPrice, '$crImg', $tutorId)";
        }

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function createPartner($newData, $newFile) {
        global $dbConn;

        $paName = htmlspecialchars($newData["crname"]);

        if ($newFile['paimage']['error'] == 4 || ($newFile['paimage']['size'] == 0 && $newFile['paimage']['error'] == 0)) {
            $query = "INSERT INTO partners (name) VALUES ('$paName')";
        } else {
            $paImg = uploadFile($newFile["paimage"], ['jpg', 'png', 'jpeg'], 2000000);
            if (!$paImg) {
                return 0;
            }

            $query = "INSERT INTO partners (name, logo) VALUES ('$paName', '$paImg)";
        }

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function editMsg($editedData, $editedFile) {
        global $dbConn;

        $eid = $editedData["eid"];
        $econtent = htmlspecialchars($editedData["econtent"]);
        $oldimage = htmlspecialchars($editedData["oldimg"]);

        if (($editedFile['eimage']['size'] == 0 && $editedFile['eimage']['error'] == 0) || $editedFile['eimage']['error'] === 4) {
            $eimage = $oldimage;
        } else {
            $eimage = uploadFile($editedFile['eimage'], ['jpg', 'png', 'jpeg'], 2000000);
            if (!$eimage) {
                return 0;
            }
        }

        $query = 
            "UPDATE messages SET 
                content = '$econtent',
                image = '$eimage'
            WHERE id = $eid
            ";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function deleteMsg($dId) {
        global $dbConn;

        $query = "DELETE FROM messages WHERE id = $dId";
        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }

    function replyMsg($newData) {
        global $dbConn;

        $rid = $newData["rid"];
        $radm = $newData["radm"];
        $mreply = $newData["mreply"];

        $query = 
            "UPDATE messages SET 
                reply = '$mreply -$radm'
            WHERE id = $rid
            ";

        mysqli_query($dbConn, $query);
        return mysqli_affected_rows($dbConn);
    }
?>