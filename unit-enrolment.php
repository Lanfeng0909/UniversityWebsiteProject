<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");


if ($session_user=="") {
    header('Location: login.php');
}

// enrol unit into database
if (isset($_POST['enrol_id'])) {

$remove=$_POST['enrol_id'];
foreach ($remove as $enrolid =>$value) {
    $query1="DELETE FROM `Enroll_unit` WHERE `id`='$enrolid'";

    $mysqli->query($query1);
    }
}

if (isset($_POST['enrol'])) {
    print_r($_POST['enrol']);

    $unitid=$_POST['time-select'];
    $query1="INSERT INTO `Enroll_unit`(`student_id`, `unit_id`) VALUES ('$session_user','$unitid')";
    $mysqli->query($query1);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="./css/unit-enrolment.css">




</head>

<body>
     <!-- Navigation Bar --->
     <nav class="navbar navbar-expand-lg">
        <img src="logo.jpg" id="logo">
        <a href="./homepage.php" class="navbar-brand nav-font-white">Course Management System</a>

      <?php
if ($session_position=="student") {
    ?>
        <a href="./unit-details.php" class="navbar nav-font-white" >Unit Details</a>
        <a href="./unit-enrolment.php" class="navbar nav-font-white" >Unit Enrolment</a>
        <a href="./tutorial-allocation-system.php" class="navbar nav-font-white">Tutorial allocation system</a>
        <a href="./individual-timetable.php" class="navbar nav-font-white" >Individual Timetable</a>
        <?php
}else if($session_position=='DC'){
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white" >Unit Details</a>
        <a href="./UnitManagement.php" class="navbar nav-font-white">Unit management</a>
        <a href="./academic-staff.php" class="navbar nav-font-white">Master page for Academic Staff</a>
        <a href="./Enrolled student.php" class="navbar nav-font-white">Enrolled student</a>
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">UC Management</a>
        <?php
}else if($session_position=='UC'){
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white" >Unit Details</a>
        <a href="./Enrolled student.php" class="navbar nav-font-white">Enrolled student</a>
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">Lecture/tutor allocaiton</a>
        <?php
}else{
        ?>
        <a href="./unit-details.php" class="navbar nav-font-white" >Unit Details</a>
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
               <a href="<?php echo $account; ?>" class="navbar nav-font-white" >My account</a>

                <!--  <a href="./UserAccount-student.php" class="navbar nav-font-white" >My account</a>-->
               <a id="logout" class="btn btn-outline-primary my-2 my-sm-0" href='./signout.php'>Log Out</a>
         <!--  <button class="btn btn-outline-primary my-2 my-sm-2" id="logout" type="submit">Log Out</button>-->

            <?php
          }
          ?>

        </form>

    </nav>



    <!-- Unit enrolled table --->
    <div class="container text-center my-5" id="unit-enro">
        <p id="unit-name">Unit enrolled</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Unit code</th>
                    <th scope="col">Availabe Semester</th>
                    <th scope="col">Availabe Campus</th>
                    <th scope="col">Allocated</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <form action='' method='post'>

                    <?php

              $query="SELECT `Enroll_unit`.`id` as `enrol_id`, `units`.`unit_code`,`units`.`semester`,`units`.`cam` FROM `Enroll_unit`,`units` WHERE `Enroll_unit`.`unit_id`=`units`.`id` AND`student_id`='$session_user'";

              $result = $mysqli->query($query);
              while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
                  $enrolid=$row['enrol_id'];

                  $units[]=$row['unit_code']; ?>

                    <tr>
                        <th scope="row"><?php echo $row['unit_code']; ?></th>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['cam']; ?></td>
                        <td>
                            <a href="./tutorial-allocation-system.php" class="btn btn-outline-primary">Allocate In</a>

                        </td>
                        <td>

                            <input type="submit" name='enrol_id[<?php echo $enrolid; ?>]' id="removebtn"
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
    <div class="container text-center my-5" id="unit-enro">
        <p id="unit-name">Unit unenrolled</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Unit code</th>
                    <th scope="col">Availabe Semester campus</th>

                    <th scope="col">Allocated</th>

                </tr>
            </thead>
            <tbody>


                <?php

$query="SELECT * FROM `units` group by `unit_code` ";

$result = $mysqli->query($query);
while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
    $enrolid=$row['enrol_id'];
    $unit_code=$row['unit_code'];
    if (!in_array($unit_code, $units)) {
        ?>

                <tr>

                    <form action='' method='post'>
                        <th scope="row"><?php  echo $row['unit_code']; ?></th>



                        <td>

                            <div class="form-group">
                                <select name="time-select" id="time-select" class="form-control">
                                    <option value=''>Please select time</option>

                                    <?php
$query2=" SELECT * FROM `units`  where `unit_code`='$unit_code'";

        $result2 = $mysqli->query($query2);
        while ($row2=$result2->fetch_array(MYSQLI_ASSOC)) {
            $semester=$row2['semester'];
            $campus=$row2['cam'];
            $unitid=$row2['id'];
            echo " <option value='",$unitid,"'>",$semester," ",$campus,"</option>";
        } ?>


                                </select>
                            </div>

                        </td>
                        <td>
                            <input type='submit' name='enrol[<?php echo $unit_code; ?>]' class="btn btn-outline-primary"
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
    <div id="error"></div>

    <a href="./tutorial-allocation-system.php" class="btn btn-outline-primary button">Unit Courses selection</a>
    <!-- Script --->
    <script type="text/javascript" src="./js/homepage.js"></script>
    <script type="text/javascript" src="./js/unit-enrolment.js"></script>

</body>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>