<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");


if ($session_user==""){
	header('Location: login.php');
}

// remove courses from enroll table
if(isset($_POST['enroltut_id'])){
$remove=$_POST['enroltut_id'];
   foreach($remove as $enroltutid =>$value){
     $query1="DELETE FROM `enroll_tut` WHERE `tut_id`='$enroltutid'";

     $mysqli->query($query1);

   }
}

// enroll courses

if(isset($_POST['enrol'])){
  //print_r($_POST['enrol']);

  $tutid=$_POST['time-select'];
  //print_r($tutid);
  //$query = "SELECT * FROM `tutorial` WHERE `tutid = $tutid`"
  //$result = $mysqli->query($query);
  //$row=$result->fetch_array(MYSQLI_ASSOC)
 // if($row[STUDENT_NO] <  $row[CAPA]) {
    $query1="INSERT INTO `enroll_tut`(`student_id`, `tut_id`) VALUES ('$session_user','$tutid')";
   // $query2 = "UPDATE SET `TUTORIAL`(`STUDENT_NO`)" VALUES ($ROW[STUDENT_NO]+1);
    //STR(INT($ROW[STUDENT_NO])+1
    $mysqli->query($query1);
   // $mysqli->query($query2);

  //}else{
   // alert("Semester is required");
 // }

}
// only student can access
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
    <link rel="stylesheet" href="./css/tutorial-allocation-system.css">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="./signout.php" method="post">
        <!--<a id="login" class="btn btn-outline-primary my-2 my-sm-0" href='./login.html'>Log In</a>-->
        <!--<button class="btn btn-outline-primary my-2 my-sm-2" id="logout" type="submit">Log Out</button>-->
        <meta charset="utf-8">
    </form>
    <!-- jQuery library -->
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

    <!-- Tut enrolled table --->
    <div class="container text-center my-5" id="tut-enro">
        <h1>Tutorial time enrolled </h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Unit ID</th>
                <th scope="col">Tut ID</th>
                <th scope="col">Tutorial time</th>
                <th scope="col">Tutorial capacity</th>
                <th scope="col">Tutorial room</th>
                <th scope="col">Remove</th>

            </tr>
        </thead>
        <tbody>
            <form action='' method='post'>

                <?php

              $query="SELECT `enroll_tut`.`tut_id` as `enroltut_id`, `tutorial`.`unit_id`,`tutorial`.`tut_id`,`tutorial`.`time` ,`tutorial`.`capa`,`tutorial`.`room`, `units`.`id`,`units`.`unit_code`FROM `enroll_tut`,`tutorial`,`units` WHERE `enroll_tut`.`tut_id`=`tutorial`.`tut_id` AND `tutorial`.`unit_id`=`units`.`id` AND`student_id`='$session_user'";

              $result = $mysqli->query($query);
              while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
                  $enroltutid=$row['enroltut_id'];

                  $units[]=$row['tut_id']; ?>

                <tr>
                    <th scope="row"><?php echo $row['unit_id']; ?></th>
                    <td><?php echo $row['unit_code']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['capa']; ?></td>
                    <td><?php echo $row['room']; ?></td>



                    <td>

                        <input type="submit" name='enroltut_id[<?php echo $enroltutid; ?>]' id="removebtn"
                            class="btn btn-outline-primary removebutton" value="Remove">


                    </td>
                </tr>


                <?php
              
            }

              ?>

            </form>
        </tbody>
    </table>
    </div>

    <!-- Unit unenrolled table--->
    <div class="container text-center my-5" id="tut-enro">
        <h1>Tutorial time unenrolled </h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Unit ID</th>
                <th scope="col">Tut ID</th>
                <th scope="col">Tutorial selection</th>
                <th scope="col">Enroll</th>

            </tr>
        </thead>
        <tbody>


            <?php

$query="SELECT * FROM `tutorial`,`units`,`Enroll_unit` where `tutorial`.`unit_id`=`units`.`id` and `Enroll_unit`.`unit_id`=`units`.`id` and `Enroll_unit`.`student_id`='$session_user' group by `units`.`id`  ";

$result = $mysqli->query($query);
while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
    $enroltutid=$row['enroltut_id'];
    $tut_id=$row['tut_id'];
        if (!in_array($tut_id, $units)) {
        ?>

            <tr>

                <form action='' method='post'>
                    <th scope="row"><?php  echo $row['unit_id']; ?></th>

                    <td><?php  echo $row['unit_code']; ?></td>

                    <td>

                        <div class="form-group">
                            <select name="time-select" id="time-select" class="form-control">
                                <option value=''>Please select time</option>

                                <?php
$query2=" SELECT * FROM `tutorial`  where `tut_id`='$tut_id'";

        $result2 = $mysqli->query($query2);
        while ($row2=$result2->fetch_array(MYSQLI_ASSOC)) {
            $tutid=$row2['tut_id'];
            $time=$row2['time'];
            $capacity=$row2['capa'];
            $location=$row2['room'];
            echo " <option value='",$tutid,"'>",$time," ",$capacity," ",$location,"</option>";
        } ?>


                            </select>
                        </div>

                    </td>
                    <td>
                        <input type='submit' name='enrol[<?php echo $unit_id; ?>]' class="btn btn-outline-primary"
                            value="Enroll">
                    </td>

            </tr>
            </form>

            <?php
    }
}
                ?>

        </tbody>
    </table>
    </div>
    <a href="./individual-timetable.php" class="btn btn-outline-primary button">Timetable</a>
    <!-- Script --->
    <script type="text/javascript" src="./js/homepage.js"></script>
</body>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>