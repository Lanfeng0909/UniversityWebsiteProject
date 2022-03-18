<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
?>
<?php
if (isset($_POST['rmlec'])) {
    $remove=$_POST['rmlec'];
    foreach ($remove as $rmlec =>$value) {
        $query5="DELETE FROM `lecturer` WHERE `lecturer_id`='$rmlec'";
        $mysqli->query($query5);
    }
}

if (isset($_POST['addlec'])) {
    $add=$_POST['addlec'];
    foreach ($add as $addlec =>$value) {
        $query6="INSERT INTO `lecturer`(`lecturer_id`) VALUES ($addlec)";
        $mysqli->query($query6);
    }
}

// only DC/UC can access
if ($session_position!="DC"&& $session_position!="UC"){
    echo '<script>alert("UC/DC ACCESS is required");
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




    <!-- allocated tutor-->
    <h2 align="center">Allocate tutor </h2>

    <table id="editable1" class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>
        <thead>
            <tr>
                <th scope="col">Unitid</th>
                <th scope="col">Tutid</th>
                <th scope="col">Time</th>
                <th scope="col">Capacity</th>
                <th scope="col">Location</th>
                <th scope="col">Tutor</th>


            </tr>
        </thead>
        <tbody>
            <?php
         
           
           $query0="SELECT * FROM `tutorial` ,`staff1` WHERE `tutorial`.`tutor`=`staff1`.`id`;";
           $result0= $mysqli->query($query0);
            if ($result0){
                 while($rows=mysqli_fetch_array($result0))
                 {
                     ?>
            <tr>

                <td><?php echo $rows['unit_id']; ?></td>
                <td><?php echo $rows['tut_id']; ?></td>
                <td><?php echo $rows['time']; ?></td>
                <td><?php echo $rows['capa']; ?></td>
                <td><?php echo $rows['room']; ?></td>
                <td><?php echo $rows['fname']." ".$rows['lname']; ?></td>
                </td>

                </td>
            </tr>

            <?php
                 }
             }
         
        ?>
        </tbody>
    </table>






    <!-- allow name and time selection-->
    <?php
                $query90="SELECT * FROM `tutor`,`staff1` where `tutor`.`tutor_id`=`staff1`.`id`";

                $result90 = $mysqli->query($query90);
                 while($rows90=mysqli_fetch_array($result90)){
                     $tutor_id=$rows90['tutor_id'];
                     $tutors[$tutor_id]=$rows90['fname']." ".$rows90['lname'];
                 }
                 $query2="SELECT * FROM `time`";
                    $result2 = $mysqli->query($query2);                
                 while($rows2=mysqli_fetch_array($result2)){
                             $time=$rows2['weektime'];
                             $times[$time]= $time;
                            
                         }
                 $query3="SELECT * FROM `location`";
                    $result3 = $mysqli->query($query3);                
                      while($rows3=mysqli_fetch_array($result3)){
                                  $room=$rows3['room'];
                                  $rooms[$room]= $room;
                                 
                              }

                 $tutors=json_encode($tutors);
                 $times=json_encode($times);
                 $rooms=json_encode($rooms);

                 echo  "<script>

                 var times='$times';
                 var rooms='$rooms';
                 var tutors='$tutors';
                 
                 </script>";
                ?>
    <script>
    $(document).ready(function() {
        $('#editable1').Tabledit({
            url: 'edittut.php',
            hideIdentifier: true,
            columns: {
                identifier: [0, "unit_id"],
                editable: [
                    [2, 'time', times],
                    [4, 'room', rooms],
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
    <a href="./Masterpage_uc.php" class="btn btn-outline-primary float-left ">Add lecturer</a>
    <a href="./uc_allocatelec.php" class="btn btn-outline-primary float-right">Allocate lecturer</a>
</body>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>