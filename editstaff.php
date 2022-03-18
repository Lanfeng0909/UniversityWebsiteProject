<?php

$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

$input = filter_input_array(INPUT_POST);

$fname = mysqli_real_escape_string($mysqli,$input["fname"]);
$lname = mysqli_real_escape_string($mysqli,$input["lname"]);
$email = mysqli_real_escape_string($mysqli,$input["email"]);
//$id = mysqli_real_escape_string($mysqli,$input["id"]);
//$exp=mysqli_real_escape_string($mysqli,$input["exp"]);
$phone = mysqli_real_escape_string($mysqli,$input["phone"]);
$expertise = mysqli_real_escape_string($mysqli,$input["exp"]);
$qualification = mysqli_real_escape_string($mysqli,$input["qual"]);
$availability = mysqli_real_escape_string($mysqli,$input["ava_time"]);

if($input["action"] === 'edit')
{
    $query = "
        UPDATE staff1
        SET fname='".$fname."',
        lname='".$lname."',
        email='".$email."',
        phone='".$phone."',
        exp='".$expertise."',
        qual='".$qualification."',
        ava_time='".$availability."'
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);

       
}
if($input["action"] === 'delete')
{
    $query = "
        DELETE FROM staff1
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);
}
    echo json_encode($input);
?>