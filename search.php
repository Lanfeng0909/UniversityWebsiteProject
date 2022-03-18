<?php
    include('db_conn.php');
    
    if(isset($_GET)){
        $search = $_GET['search'];
        $sql = "SELECT * FROM units WHERE concat(id,unit_code,unit_name,lecturer,semester) LIKE '%$search%'";
        $result = mysqli_query($mysqli,$sql);
        $num_rows = mysqli_num_rows($result);

        if (!$result){
            die('error: '.mysqli_error());
        } else if($num_rows == 0){
            echo 'none';
        }else {
            echo '<p>We found '.$num_rows.' result(s)</p>';
            while($row = mysqli_fetch_array($result)){
                        echo
                            '<table class="table table-bordered">
                            <tr><td>ID</td><td>'.$row["id"].'</td></tr>
                            <tr><td>Unit Code</td><td>'.$row["unit_code"].'</td></tr>
                            <tr><td>Unit Name</td><td>'.$row["unit_name"].'</td></tr>
                            <tr><td>Lecturer</td><td>'.$row["lecturer"].'</td></tr>
                            <tr><td>Semester</td><td>'.$row["semester"].'</td></tr>
                            </table>';
                    }
        }
    }
?>