<?php
session_start();
include "db_config.php";
$username = $_SESSION['username'];
$sql = "SELECT user_id,first_name, last_name, user_name, password,email,phone, address,city FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["user_name"] == $username) {
            $firstname = $row["first_name"];
            $lastname = $row["last_name"];
            $phone = $row["phone"];
        }
    }
}
$num=0;
if(empty($_POST['breadroll'])){
    header("Location:order.php?k=2");
    $num++;
}
if($num==0) {
    $bread = $_POST['breadroll'];
    $meat = $_POST['meat'];
    $cheese = $_POST['cheese'];
    $sauce = $_POST['sauce'];
    $extras = $_POST['extras'];

    $sauces = implode(", ",$sauce);
    $extra_s = implode(", ",$extras);
    //print_r($sauce);

    $sql = "INSERT INTO orders (bread_roll, meat, cheese, sauce,extras,first_name, last_name,phone)
VALUES ('$bread', '$meat', '$cheese','$sauces','$extra_s','$firstname', '$lastname', '$phone')";

    if (mysqli_query($conn, $sql)) {
        header("Location:order.php?k=1");
    } else if($num>0) {
        header("Location:order.php?k=2");
    }




mysqli_close($conn);


}