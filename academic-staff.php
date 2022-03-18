<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

//Add and remove and update the data into corresponding database table
if (isset($_POST['rmlec'])) {
    $remove=$_POST['rmlec'];
    foreach ($remove as $rmlec =>$value) {
        //echo $enroltutid;
        $query5="DELETE FROM `lecturer` WHERE `lecturer_id`='$rmlec'";
        $query20="UPDATE `staff1` SET `position`='staff' where `staff1`.`id`='$rmlec'";
        $mysqli->query($query5);
        $mysqli->query($query20);
    }
}

if (isset($_POST['addlec'])) {
    $add=$_POST['addlec'];
    foreach ($add as $addlec =>$value) {
        $query6="INSERT INTO `lecturer`(`lecturer_id`) VALUES ($addlec)";
        $query30="UPDATE `staff1` set `position`='lecturer' where `staff1`.`id`='$addlec'";
        $mysqli->query($query6);
        $mysqli->query($query30);
        
        
    }
}

if (isset($_POST['rmtut'])) {
  $remove1=$_POST['rmtut'];
  foreach ($remove1 as $rmtut =>$value) {
      //echo $enroltutid;
      $query7="DELETE FROM `tutor` WHERE `tutor_id`='$rmtut'";
      $query13="UPDATE `staff1` SET `position`='staff' where `staff1`.`id`='$rmtut'";
      $mysqli->query($query7);
      $mysqli->query($query13);
  } 
}

if (isset($_POST['addtut'])) {
  $add1=$_POST['addtut'];
  foreach ($add1 as $addtut =>$value) {
      $query8="INSERT INTO `tutor`(`tutor_id`) VALUES ($addtut)";
      $query12="UPDATE `staff1` set `position`='tutor' where `staff1`.`id`='$addtut'";
      $mysqli->query($query8);
      $mysqli->query($query12);
  }
}
if (isset($_POST['rmuc'])) {
  $remove2=$_POST['rmuc'];
  foreach ($remove2 as $rmuc =>$value) {
      $query9="DELETE FROM `UC` WHERE `uc_id`='$rmuc'";
      $query21="UPDATE `staff1` SET `position`='staff' where `staff1`.`id`='$rmuc'";
      $mysqli->query($query9);
      $mysqli->query($query21);

  }
}

if (isset($_POST['adduc'])) {
  $add2=$_POST['adduc'];
  foreach ($add2 as $adduc =>$value) {
      $query10="INSERT INTO `UC`(`uc_id`) VALUES ($adduc)";
      $query31="UPDATE `staff1` set `position`='UC' where `staff1`.`id`='$adduc'";
      $mysqli->query($query10);
      $mysqli->query($query31);
  }
}

if (isset($_POST['enrol'])) {
    $add3=$_POST['enrol'];

   foreach ($add3 as $tutorialid =>$value) {
       $tutorid=$_POST['time-select'];
        $query11="UPDATE `tutorial` SET `tutor`='$tutorid' WHERE `tut_id`='$tutorialid'";
        $mysqli->query($query11);
    }
  }
// Only DC can access
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
            <!-- Go to different account page according to test session_pisition -->
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


    <div class="container">
        <h2 align="center">Staff management</h2>
        <h3 align="center">(Do not allocate role for Lanfeng Shi DC)</h3>
        <h4 align="center">(Each person only have one role)</h4>
        <!-- Create staff button for DC --->
        <button class="btn btn-outline-primary" id="create">Create a new
            staff</button>

        <!--Create a editable stafftable-->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Expertise</th>
                    <th scope="col">Availability</th>
                    <th scope="col">lec add</th>
                    <th scope="col">tutor add</th>
                    <th scope="col">UC add</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>

                <!--select all staff data from database table staff1-->
                <?php
        $query="SELECT * FROM `staff1` ";
          $result = $mysqli->query($query);

        while($rows=mysqli_fetch_array($result)){
          $staff_id=$rows['id'];
        

          ?>
                <tr>
                    <form action='' method='post'>
                        <th scope="row"><?php  echo $rows['fname']." ".$rows['lname'];?></th>
                        <th scope="row"><?php  echo $rows['qual'];?></th>
                        <th scope="row"><?php  echo $rows['exp'];?></th>
                        <th scope="row"><?php  echo $rows['ava_time'];?></th>
                        <td> <?php

                    $query1="select * from lecturer where lecturer_id='$staff_id'";
                    $result1 = $mysqli->query($query1);
                
                  if ($result1->num_rows==0) {
                  ?>
                            <input type="submit" value="add to lecturer" name='addlec[<?php echo $staff_id; ?>]'></td>
                        <?php
                    }else{

                    ?>
                        <input type="submit" value="remove from lecturer" name='rmlec[<?php echo $staff_id; ?>]'></td>
                        <?php
                    };
                    ?>

                        <td><?php
                    $query2="select * from tutor where tutor_id='$staff_id'";
                    $result2 = $mysqli->query($query2);
                  if ($result2->num_rows==0) {
                      ?>
                            <input type="submit" value="add to tutor" name='addtut[<?php echo $staff_id; ?>]'></td>
                        <?php
                        }else{
    
                        ?>
                        <input type="submit" value="remove from tutor" name='rmtut[<?php echo $staff_id; ?>]'></td>
                        <?php
                        };
                        ?>

                        <td><?php
                    $query3="select * from UC where uc_id='$staff_id'";
                    $result3 = $mysqli->query($query3);
                    if ($result3->num_rows==0) {
                      ?>
                            <input type="submit" value="add to UC" name='adduc[<?php echo $staff_id; ?>]'></td>
                        <?php
                        }else{
    
                        ?>
                        <input type="submit" value="remove from UC" name='rmuc[<?php echo $staff_id; ?>]'></td>
                        <?php
                        };
      
                    ?>
                    </form>
                </tr>

                <?php

      }
      ?>

            </tbody>
        </table>
    </div>




    <!-- DC role to add new staff and allocate tutor into units --->
    <button type="button" class="btn btn-primary float-left" onclick="window.location.href='./registration.php'">Add New
        Unit</button>
    <button type="button" class="btn btn-primary float-right"
        onclick="window.location.href='./dc_allocatetut.php'">Allocate tutor</button>

    <footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

    <!-- Script --->
    <script type="text/javascript" src="./js/academic-staff.js"></script>
    <script type="text/javascript" src="./js/homepage.js"></script>

</body>

</html>