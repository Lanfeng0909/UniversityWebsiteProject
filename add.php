<?php
    include('db_conn.php');

    if(isset($_GET)){
        $unit_code = $_GET['unit_code'];
        $unit_name = $_GET['unit_name'];
        //$lecturer = $_GET['lecturer'];
        $semester = $_GET['semester'];
        $unitdescription = $_GET['unit_descript'];
        $campus = $_GET['cam'];

        $sql = "INSERT INTO units (`unit_code`,`unit_name`,`semester`,`unit_descript`,`cam`)
        VALUES ('$unit_code','$unit_name','$semester','$unitdescription','$campus')";
        
        mysqli_query($mysqli,$sql);
    }

?>
