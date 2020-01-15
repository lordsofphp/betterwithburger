<?php
$num = 0;

if (empty($_POST['fn'])){
    header("Location:index.php?p=1");
    $num++;
}
else if (empty($_POST['ln'])){
    header("Location:index.php?p=2");
    $num++;
}
else if (empty($_POST['username'])){
    header("Location:index.php?p=3");
    $num++;
}
else if (empty($_POST['password'])){
    header("Location:index.php?p=4");
    $num++;
}
else if (empty($_POST['password2'])){
    header("Location:index.php?p=5");
    $num++;
}
else if (empty($_POST['email'])){
    header("Location:index.php?p=6");
    $num++;
}
else if (empty($_POST['phone'])){
    header("Location:index.php?p=7");
    $num++;
}
else if (empty($_POST['address'])){
    header("Location:index.php?p=8");
    $num++;
}
else if (empty($_POST['city'])){
    header("Location:index.php?p=9");
    $num++;
}

if($num == 0) {
    include "db_config.php";
    define("SALT1", "wtSHSU890381IC4");
    define("SALT2", "4CITAcywut46a");

    $firstname = $_POST['fn'];
    $lastname = $_POST['ln'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $num = 0;

    if (!preg_match('/[0-9]/', $firstname) and !preg_match('/[\/^£$%&*()}{@#~?><>,|=_+¬-]/', $firstname) and preg_match('/[A-Za-z]/', $firstname)) {
        $firstname = strip_tags($firstname);
        $firstname = strtolower($firstname);
        $firstname = ucfirst($firstname);
    } else {
        header("Location:index.php?p=10");
        $num++;
    }
    if (!preg_match('/[0-9]/', $lastname) and !preg_match('/[\/^£$%&*()}{@#~?><>,|=_+¬-]/', $lastname) and preg_match('/[A-Za-z]/', $lastname)) {
        $lastname = strip_tags($lastname);
        $lastname = strtolower($lastname);
        $lastname = ucfirst($lastname);

    } else {
        header("Location:index.php?p=11");
        $num++;
    }
    if ((preg_match('/[0-9]/', $username) or preg_match('/[A-Za-z]/', $username)) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
        $username = strip_tags($username);
        $username = strtolower($username);

    } else {
        header("Location:index.php?p=12");
        $num++;
    }

    if ($password == $password2 and strlen($password) >= 8) {
        $password = strip_tags($password);
        $password_temp = SALT1 . "$password" . SALT2;
        $password_decrypt = md5($password_temp);

    } else {
        header("Location:index.php?p=13");
        $num++;
    }


    $email = strip_tags($email);


    if (preg_match('/[0-9]/', $phone) and !preg_match('/[A-Za-z]/', $phone) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $phone) and strlen($phone) >= 6) {
        $phone = strip_tags($phone);

    } else {
        header("Location:index.php?p=14");
        $num++;
    }


    $address = strip_tags($address);


    if (!preg_match('/[0-9]/', $city) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $city) and preg_match('/[A-Za-z]/', $city)) {
        $city = strip_tags($city);
        $city = strtolower($city);
        $city = ucfirst($city);

    } else {
        header("Location:index.php?p=15");
        $num++;
    }

    if ($num == 0) {
        $sql = "SELECT user_name, email FROM users";
        $result = $conn->query($sql);
        $num = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row["user_name"] == $username or $row['email'] == $email) {
                    header("Location:index.php?p=16");
                    $num++;

                }
            }
        }
        if ($num == 0) {
            $sql = "INSERT INTO users (first_name, last_name, user_name, password,email,phone, address,city)
VALUES ('$firstname', '$lastname', '$username','$password_decrypt','$email','$phone', '$address', '$city')";

            if (mysqli_query($conn, $sql)) {
                header("Location:index.php?p=17");
            } else if($num>0) {
                header("Location:index.php?p=18");
            }

        }


        mysqli_close($conn);
    }
}
// nem biztos hogy kell, mukodik nelkule is
/*else if($num>0){
    header("Location:index.php?p=18");
}*/



