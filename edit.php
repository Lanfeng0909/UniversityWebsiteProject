<?php

$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

$input = filter_input_array(INPUT_POST);

$unit_code = mysqli_real_escape_string($mysqli,$input["unit_code"]);
$unit_name = mysqli_real_escape_string($mysqli,$input["unit_name"]);
$lecturer = mysqli_real_escape_string($mysqli,$input["lecturer"]);
$semester = mysqli_real_escape_string($mysqli,$input["semester"]);
$unitdescription = mysqli_real_escape_string($mysqli,$input["unit_descript"]);
$cam = mysqli_real_escape_string($mysqli,$input["cam"]);
$ucnames= mysqli_real_escape_string($mysqli,$input["uc"]);
if($input["action"] === 'edit')
{
    $query = "
        UPDATE units
        SET unit_code='".$unit_code."',
        unit_name='".$unit_name."',
        lecturer='".$lecturer."',
        semester='".$semester."',
        unit_descript='".$unitdescription."',
        cam='".$cam."',
        uc='".$ucnames."'
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);



        $query = "
        UPDATE units
        SET 
        unit_name='".$unit_name."',
       
        unit_descript='".$unitdescription."'
       
        WHERE unit_code ='".$unit_code."'
        ";

        mysqli_query($mysqli,$query);

        

}
if($input["action"] === 'delete')
{
    $query = "
        DELETE FROM units
        WHERE id ='".$input["id"]."'
        ";

        mysqli_query($mysqli,$query);
}
    echo json_encode($input);
?>