<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

?>
<!-- DC/UD/Lecturer/tutor access is required -->
<?php

if ($session_position!="DC" && $session_position!="UC" && $session_position!="lecturer" && $session_position!="tutor"&&$session_position!="staff") {
    echo '<script>alert("Staff ACCESS is required");
            window.location.href="homepage.php";
            </script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/homepage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Link to use icon-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src='./jquery.tabledit.min.js'></script>
    <script src='./jquery.tabledit.js'></script>
</head>

<body>
    <!-- Navigation Bar --->
    <nav class="navbar navbar-expand-lg">
        <img src="logo.jpg" id="logo">
        <a href="./homepage.php" class="navbar-brand nav-font-white">Course Management System</a>

        <?php
if ($session_position=="student") {
    ?>
        <a href="./unit-details.php" class="navbar nav-font-white">Unit Details</a>
        <a href="./unit-enrolment.php" class="navbar nav-font-white">Unit Enrolment</a>
        <a href="./tutorial-allocation-system.php" class="navbar nav-font-white">Tutorial allocation system</a>
        <a href="./individual-timetable.php" class="navbar nav-font-white">Individual Timetable</a>
        <?php
}else if($session_position=='DC'){
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white">Unit Details</a>
        <a href="./UnitManagement.php" class="navbar nav-font-white">Unit management</a>
        <a href="./academic-staff.php" class="navbar nav-font-white">Master page for Academic Staff</a>
        <a href="./Enrolled student.php" class="navbar nav-font-white">Enrolled student</a>
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">UC Management</a>
        <?php
}else if($session_position=='UC'){
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white">Unit Details</a>
        <a href="./Enrolled student.php" class="navbar nav-font-white">Enrolled student</a>
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">Lecture/tutor allocaiton</a>
        <?php
}else{
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white">Unit Details</a>
        <a href="./Enrolled student.php" class="navbar nav-font-white">Enrolled student</a>
        <?php
}
        ?>
        <form class="form-inline my-2 my-lg-0 ml-auto">

            <?php
          if ($session_user=='') {
              ?>
            <a id="login" class="btn btn-outline-primary my-2 my-sm-0" href='./login.php'>Log In</a>

            <?php
          }else {

            if($session_position=='student'){
                $account="./UserAccount-student.php";
            }else{
                $account="./UserAccount-staff.php";

            }
              ?>
            <?php echo $session_position;?>
            <?php echo $session_user;?>
            <a href="<?php echo $account; ?>" class="navbar nav-font-white">My account</a>

            <!--  <a href="./UserAccount-student.php" class="navbar nav-font-white" >My account</a>-->
            <a id="logout" class="btn btn-outline-primary my-2 my-sm-0" href='./signout.php'>Log Out</a>
            <!--  <button class="btn btn-outline-primary my-2 my-sm-2" id="logout" type="submit">Log Out</button>-->

            <?php
            }
            ?>

        </form>

    </nav>

   <!--DC table-->
    <div id='DC'>
    
    <div class="container text-center my-5">
        <h1>All enrolled student</h1>
    </div>
            

        <table class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>


            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student</th>
                    <th scope="col">Unit</th>
                </tr>
            </thead>
            <?php
        $query1="SELECT * FROM `Enroll_unit`,`student`,`units` WHERE`Enroll_unit`.`student_id`=`student`.`id`and `Enroll_unit`.`unit_id`=`units`.`id` order by `unit_id` ASC";
        $result1= $mysqli->query($query1);


        while($rows1=mysqli_fetch_array($result1)){
        ?>

            <tr>
                <td><?php echo $rows1['id']; ?></td>
                <td><?php echo $rows1['fname']." ".$rows1['lname']; ?></td>
                <td><?php echo $rows1['unit_code']; ?></td>

            </tr>


            <?php 
       };
       
       ?>
        </table>
    </div>

    <!--UC table-->
    <div id='UC'>
    <div class="container text-center my-5">
        <h1>All enrolled student in incharged units</h1>
    </div>
            

        <table class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>


            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student</th>
                    <th scope="col">Unit</th>
                </tr>
            </thead>
            <?php
        $queryuc="SELECT * FROM `units`,`Enroll_unit`,`student` WHERE `Enroll_unit`.`student_id`=`student`.`id` AND `units`.`id`=`Enroll_unit`.`unit_id` AND`units`.`uc`='$session_user'";
        $resultuc= $mysqli->query($queryuc);


        while($rows2=mysqli_fetch_array($resultuc)){
        ?>

            <tr>
                <td><?php echo $rows2['id']; ?></td>
                <td><?php echo $rows2['fname']." ".$rows2['lname']; ?></td>
                <td><?php echo $rows2['unit_code']; ?></td>

            </tr>


            <?php 
       };
       
       ?>
        </table>
    </div>

    <!--lecturer table-->
    <div id='lecturer'>

    <div class="container text-center my-5">
        <h1>All enrolled student in incharged units</h1>
    </div>
            

        <table class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>


            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student</th>
                    <th scope="col">Unit</th>
                </tr>
            </thead>
            <?php
        $querylec="SELECT * FROM `units`,`Enroll_unit`,`student` WHERE `Enroll_unit`.`student_id`=`student`.`id` AND `units`.`id`=`Enroll_unit`.`unit_id` AND`units`.`lecturer`='$session_user'";
        $resultlec= $mysqli->query($querylec);


        while($rows3=mysqli_fetch_array($resultlec)){
        ?>

            <tr>
                <td><?php echo $rows3['id']; ?></td>
                <td><?php echo $rows3['fname']." ".$rows3['lname']; ?></td>
                <td><?php echo $rows3['unit_code']; ?></td>

            </tr>


            <?php 
       };
       
       ?>
        </table>
    
    </div>

    <!--tutor table-->
    <div id='tutor'>

    <div class="container text-center my-5">
        <h1>All enrolled student in Tut</h1>
    </div>
            

        <table class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>


            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student</th>
                    <th scope="col">Tutor</th>
                </tr>
            </thead>
            <?php
        $querytut="SELECT * FROM `tutorial`,`enroll_tut`,`student`,`tutor` WHERE `enroll_tut`.`student_id`=`student`.`id` AND `tutorial`.`tut_id`=`enroll_tut`.`tut_id` AND`tutor`.`tutor_id`='$session_user'";
        $resulttut= $mysqli->query($querytut);


        while($rows4=mysqli_fetch_array($resulttut)){
        ?>

            <tr>
                <td><?php echo $rows4['id']; ?></td>
                <td><?php echo $rows4['fname']." ".$rows4['lname']; ?></td>
                <td><?php echo $rows4['tut_id']; ?></td>

            </tr>


            <?php 
       };
       
       ?>
        </table>
    </div>
<!-- staff situation-->
    <div id='staff'>
    <h1>You have not been allocated the position, please contact the Degree Coordinator!</h1>
    </div>


</body>
<script>
//Retrieve the student or staff based on session_position
$(document).ready(function() {
    var session_position = '<?php echo $session_position;?>';
    if (session_position == 'tutor') {
        document.getElementById("tutor").style.display = "block";
        document.getElementById("lecturer").style.display = "none";
        document.getElementById("UC").style.display = "none";
        document.getElementById("DC").style.display = "none";
        document.getElementById("staff").style.display = "none";
    } else if (session_position == 'lecturer') {
        document.getElementById("tutor").style.display = "none";
        document.getElementById("lecturer").style.display = "block";
        document.getElementById("UC").style.display = "none";
        document.getElementById("DC").style.display = "none";
        document.getElementById("staff").style.display = "none";
    } else if (session_position == 'UC') {
        document.getElementById("tutor").style.display = "none";
        document.getElementById("lecturer").style.display = "none";
        document.getElementById("UC").style.display = "block";
        document.getElementById("DC").style.display = "none";
        document.getElementById("staff").style.display = "none";
    } else if (session_position == 'DC') {
        document.getElementById("tutor").style.display = "none";
        document.getElementById("lecturer").style.display = "none";
        document.getElementById("UC").style.display = "none";
        document.getElementById("DC").style.display = "block";
        document.getElementById("staff").style.display = "none";
    }else if (session_position == 'staff') {
        document.getElementById("tutor").style.display = "none";
        document.getElementById("lecturer").style.display = "none";
        document.getElementById("UC").style.display = "none";
        document.getElementById("DC").style.display = "none";
        document.getElementById("staff").style.display = "block";
    };
});


</script>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
</footer>
</html>