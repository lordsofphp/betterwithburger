<?php
$lastname = "david+";
if(!preg_match('/[0-9]/', $lastname) and preg_match('/[A-Za-z]/', $lastname)){
    $lastname = strip_tags($lastname);
    $lastname = strtolower($lastname);
    $lastname = ucfirst($lastname);
    echo $lastname;
}
else {
    echo "error";
}