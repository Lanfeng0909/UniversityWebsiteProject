<?php

$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

$input = filter_input_array(INPUT_POST);

$unit_code = mysqli_real_escape_string($mysqli,$input["unit_code"]);
$unit_name = mysqli_real_escape_string($mysqli,$input["unit_name"]);
$lecturer = mysqli_real_escape_string($mysqli,$input["lecturer"]);
$semester = mysqli_real_escape_string($mysqli,$input["semester"]);
$unitdescription = mysqli_real_escape_string($mysqli,$input["unit_descript"]);
$cam = mysqli_real_escape_string($mysqli,$input["cam"]);
echo $input["lecturer"];
echo $input["contime"];
$consultation= mysqli_real_escape_string($mysqli,$input["contime"]);



if($input["action"] === 'edit')
{
        //$query = "
        //UPDATE units
        //SET unit_code='".$unit_code."',
        //unit_name='".$unit_name."',
        //lecturer='".$lecturer."',
        //semester='".$semester."',
        //unit_descript='".$unitdescription."',
        //cam='".$cam."',
        ///contime='".$consultation."'
       //WHERE id ='".$input["id"]."'
      //";

      // mysqli_query($mysqli,$query);
        echo $consultation;
        $query = "
        UPDATE units
        SET
        lecturer='".$lecturer."',
        contime='".$consultation."'

        WHERE id ='".$input["id"]."'
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