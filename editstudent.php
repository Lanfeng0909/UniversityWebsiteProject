<?php

$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

$input = filter_input_array(INPUT_POST);

$fname = mysqli_real_escape_string($mysqli,$input["fname"]);
$lname = mysqli_real_escape_string($mysqli,$input["lname"]);
$email = mysqli_real_escape_string($mysqli,$input["email"]);
//$id = mysqli_real_escape_string($mysqli,$input["id"]);
//$exp=mysqli_real_escape_string($mysqli,$input["exp"]);
$phone = mysqli_real_escape_string($mysqli,$input["phone"]);
$birthday = mysqli_real_escape_string($mysqli,$input["birthday"]);
$address = mysqli_real_escape_string($mysqli,$input["address"]);

if($input["action"] === 'edit')
{
    $query = "
        UPDATE student
        SET fname='".$fname."',
        lname='".$lname."',
        email='".$email."',
        phone='".$phone."',
        birthday='".$birthday."',
        address='".$address."'
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);

       
}
if($input["action"] === 'delete')
{
    $query = "
        DELETE FROM student
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);
}
    echo json_encode($input);
?>