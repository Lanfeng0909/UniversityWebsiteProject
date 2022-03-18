<?php

$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

$input = filter_input_array(INPUT_POST);

$unit_id = mysqli_real_escape_string($mysqli,$input["unit_id"]);
$tut_id = mysqli_real_escape_string($mysqli,$input["tut_id"]);
$time = mysqli_real_escape_string($mysqli,$input["time"]);
$capa= mysqli_real_escape_string($mysqli,$input["capa"]);
$room = mysqli_real_escape_string($mysqli,$input["room"]);
$tutor= mysqli_real_escape_string($mysqli,$input["tutor"]);


if($input["action"] === 'edit')
{


        $query = "
        UPDATE tutorial
        SET
        time='".$time."',
        room='".$room."',
        tutor='".$tutor."'
        
        WHERE unit_id ='".$input["unit_id"]."'
        ";

        mysqli_query($mysqli,$query);

        

}
if($input["action"] === 'delete')
{
    $query = "
        DELETE FROM tutorial
        WHERE unit_id ='".$input["unit_id"]."'
        ";

        mysqli_query($mysqli,$query);
}
    echo json_encode($input);
?>