<?php
$host="localhost";
$username="root";
$password="";
$db="hamburgers";
$conn = mysqli_connect($host, $username, $password, $db) or die(mysqli_connect_error());
//Kapcsolodik a az adatbazishos ha nem letezik kidobja az errort.