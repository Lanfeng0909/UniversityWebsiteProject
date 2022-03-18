<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

//if($session_value=='staff1'){
  //$query="SELECT * FROM `staff1` WHERE `id`='$session_user'";
  //$result = $mysqli->query($query);	
  //$row=$result->fetch_array(MYSQLI_ASSOC);
 
//}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/homepage.css">

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
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">Lecture/tutor allocaiton</a>
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

               
               <a id="logout" class="btn btn-outline-primary my-2 my-sm-0" href='./signout.php'>Log Out</a>
        

            <?php
          }
          ?>
        
        </form>

    </nav>


    <!-- Heading --->
    <div class="container text-center my-5">
        <h1>University of Dowell in Wonderland</h1>
    </div>

    <!-- Background -->
    <div class="background-container text-center my-5">
        <img src="university.jpg">
    </div>

    <footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>
    <!-- Script -->
    <script type="text/javascript" src="./js/homepage.js"></script>

    
</body>

</html>