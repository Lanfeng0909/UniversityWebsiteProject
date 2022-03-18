<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

// enrol tut to the unit and fix the seat
if (isset($_POST['enrol'])) {
    $add3=$_POST['enrol'];
    //$add3=$_POST['allo'];
   // foreach ($add3 as $allocate =>$value) {

        foreach ($add3 as $tutorialid =>$value) {
        //$query11="INSERT INTO `tutorial`(`tutor`) VALUES ($allocate)";
       $tutorid=$_POST['time-select'];
     
        $query11="UPDATE `tutorial` SET `tutor`='$tutorid' WHERE `tut_id`='$tutorialid'";
        $mysqli->query($query11);
    }
  }

//DC access required
if ($session_position!="DC") {
    echo '<script>alert("DC ACCESS is required");
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
    <link rel="stylesheet" href="./css/academic-staff.css" />

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
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">UC Management</a>
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

            <!--  <a href="./UserAccount-student.php" class="navbar nav-font-white" >My account</a>-->
            <a id="logout" class="btn btn-outline-primary my-2 my-sm-0" href='./signout.php'>Log Out</a>
            <!--  <button class="btn btn-outline-primary my-2 my-sm-2" id="logout" type="submit">Log Out</button>-->

            <?php
          }
          ?>

        </form>

    </nav>

    <!--tutor allcoation to unit and tutorial-->
    <div class="container text-center my-5" id="unit-enro">
        <p id="unit-name">Tutor allocation</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tutorial code</th>
                    <th scope="col">Available tutor</th>
                    <th scope="col">Allocated</th>

                </tr>
            </thead>
            <tbody>

                <!--Select tutorial data from database table tutorial-->
                <?php

$query="SELECT * FROM `tutorial`";

$result = $mysqli->query($query);
while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
    $enrolid=$row['enrol_id'];
    $unit_code=$row['unit_code'];
    $tutorialid=$row['tut_id'];
    $tutorid=$row['tutor'];
    //if (!in_array($unit_code, $units)) {
        ?>

                <tr>

                    <form action='' method='post'>
                        <th scope="row"><?php  echo $row['tut_id']; ?></th>



                        <td>

                            <div class="form-group">
                                <select name="time-select" id="time-select" class="form-control">
                                    <option value=''>Please select Tutor</option>

                                    <?php
$query2=" SELECT * FROM `tutor` ";

        $result2 = $mysqli->query($query2);
        while ($row2=$result2->fetch_array(MYSQLI_ASSOC)) {
            $tutor=$row2['tutor_id'];
            $selected="";
            if($tutor==$tutorid){
                $selected="selected";
            }
            echo " <option value='",$tutor,"'  ",$selected,">",$tutor,"</option>";
        } ?>


                                </select>
                            </div>

                        </td>
                        <td>
                            <!--  <input type='hidden' name='allo[<?php echo $tutorialid; ?>]' value='<?php echo $tutor; ?>'>-->
                            <input type='submit' name='enrol[<?php echo $tutorialid; ?>]'
                                class="btn btn-outline-primary" value="Allocate">
                        </td>

                </tr>
                </form>

                <?php
    }
//}
                ?>

            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-primary float-right" onclick="window.location.href='./academic-staff.php'">Back
        to staff page</button>
</body>

</html>