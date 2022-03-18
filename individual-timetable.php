<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
?>

<!-- only student can access-->
<?php
if ($session_position!="student") {
    echo '<script>alert("Student ACCESS is required");
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
    <link rel="stylesheet" href="./css/individual timetable.css" />

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
            <a href="<?php echo $account; ?>" class="navbar nav-font-white">My account</a>


            <a id="logout" class="btn btn-outline-primary my-2 my-sm-0" href='./signout.php'>Log Out</a>


            <?php
          }
          ?>

        </form>

    </nav>

    <?php


$res=mysqli_query($mysqli, "SELECT * FROM student WHERE id LIKE '$session_user'"); 
if ($res) $rs = mysqli_fetch_array($res);

//if the session for username has not been saved, automatically go back to signin_form.php
if ($session_user==""){
	header('Location: login.php');
}
?>
    <!-- create individual time table with lecturer data-->
    <div class="container text-center my-5" id="tut-enro">
        <h1>Individual timetable </h1> 
    </div>
    
    <table class="table">
    <h4 align="center">Lecture time</h4>
        <thead>
            <tr>
                <th scope="col">Unit ID</th>
                <th scope="col">Lecture time</th>
                <th scope="col">Room</th>
                <th scope="col">Lecturer</th>
            </tr>
        </thead>
        <tbody>
            <form action='' method='post'>

                <?php
              
        $query1="SELECT * FROM `staff1`,`lecture`,`units`,`Enroll_unit` where  `lecture`.`unit_id`=`units`.`id` and `Enroll_unit`.`unit_id`=`units`.`id` and `units`.`lecturer`=`staff1`.`id` and `Enroll_unit`.`student_id`='$session_user'";      
        $result1 = $mysqli->query($query1);
              while ($row=$result1->fetch_array(MYSQLI_ASSOC)) {
                  $enrolid=$row['enrol_id'];
                  $units[]=$row['unit_code']; ?>

                <tr>
                    <th scope="row"><?php echo $row['unit_code']; ?></th>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['room']; ?></td>
                    <td><?php echo $row['fname']." ".$row['lname']; ?></td>

                </tr>


                <?php
               }
               ?>
            </form>
        </tbody>
    </table>


    <!-- create individual time table with lecturer data-->
               <br>
               <br>
    <table class="table">
    <h4 align="center">Tutorial time</h4>
        <thead>
            <tr>
                <th scope="col">Unit ID</th>
                <th scope="col">Tutorial time</th>
                <th scope="col">Room</th>
                <th scope="col">tutor</th>
            </tr>
        </thead>
        <?php
      $query2="SELECT * FROM `enroll_tut`,`tutorial`,`units`,`staff1` WHERE `enroll_tut`.`tut_id`=`tutorial`.`tut_id` and `tutorial`.`unit_id`=`units`.`id` and `tutorial`.`tutor` = `staff1`.`id` AND `enroll_tut`.`student_id`='$session_user'";
      $result2 = $mysqli->query($query2);
              while ($row=$result2->fetch_array(MYSQLI_ASSOC)) {
                    $enroltutid=$row['enroltut_id'];

                    $units[]=$row['tut_id']; ?>

        <tr>
            <th scope="row"><?php echo $row['unit_code']; ?></th>
            <td><?php echo $row['time']; ?></td>
            <td><?php echo $row['room']; ?></td>
            <td><?php echo $row['fname']." ".$row['lname']; ?></td>

        </tr>


        <?php
      
        }

        ?>
    </table>

    <!-- Script --->
    </div>

    <script type="text/javascript" src="./js/homepage.js"></script>
</body>
<a href="./unit-enrolment.php" class="btn btn-outline-primary float-left ">Swap</a>
<a href="./tutorial-allocation-system.php" class="btn btn-outline-primary float-right">Edit</a>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
</footer>
</html>