<?php

include "db_config.php";

if (isset($_POST['username'])){
    $username = $_POST['username'];
}

if (isset($_POST['password'])){
    $password = $_POST['password'];
}


$sql = "SELECT admin_id, user_name, password, email FROM admin";
$result = $conn->query($sql);

$num=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($username == $row["user_name"] and $password == $row["password"]){
            header('Location: admin_page.php');
            session_start();
            $_SESSION["username"] = $row["user_name"];
            $_SESSION["password"] = $row["password"];
            $num++;

        }

    }
   if ($num==0){
       header('Location: admin_login.php');
   }

}

else {
    header('Location: admin_login.php');
}

$conn->close();

?>