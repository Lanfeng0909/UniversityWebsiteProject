<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
?>
<!--add and remove lecturer and only access for dc and uc access-->
<?php
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

if ($session_position!="DC"&& $session_position!="UC"){
    echo '<script>alert("DC/UC ACCESS is required");
            window.location.href="homepage.php";
            </script>';

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/unit-details.css">
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


    <div class="container">
        <h2 align="center">Add lecturer</h2>
        <h3 align="center">Each personal only can have one role</h3>
        <h4 align="center">Communicate with DC when allocated</h4>
        <h4 align="center">Do not add lecturer to Lanfeng Shi (DC)</h4>
        <!-- Edit table for adding lecturer --->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Expertise</th>
                    <th scope="col">Avalibility</th>
                    <th scope="col">lec add</th>


                </tr>
            </thead>
            <tbody>


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


                    </form>
                </tr>

                <?php

                }
              ?>

            </tbody>
        </table>
    </div>






    <a href="./uc_allocatelec.php" class="btn btn-outline-primary float-left ">allocate lecturer</a>
    <a href="./uc_allocatetut.php" class="btn btn-outline-primary float-right">allocate tutor</a>




    <script>
    $(document).ready(function() {
        $('#editable1').Tabledit({
            url: 'edittut.php',
            hideIdentifier: true,
            columns: {
                identifier: [0, "unit_id"],
                editable: [
                    [5, 'tutor', tutors]
                ]

            },

            restoreButton: false,
            onSuccess: function(data, textStatus, jqXHR) {

                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }







        });
    })
    </script>

    </div>

</body>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>