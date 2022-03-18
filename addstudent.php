<?php
    include('db_conn.php');

    if(isset($_GET)){
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $email = $_GET['email'];
        $id = $_GET['id'];
        $password = $_GET['password'];
        $phone = $_GET['phone'];
        $birthday = $_GET['birthday'];
        $address = $_GET['address'];

        $sql = "INSERT INTO units (unit_code,unit_name,lecturer,semester)
        VALUES ('$unit_code','$unit_name','$lecturer','$semester')";
        
        mysqli_query($mysqli,$sql);
    }

?>