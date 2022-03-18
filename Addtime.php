<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

?>
<?php

if ($session_position!="UC"){
    echo '<script>alert("UC ACCESS is required");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src='./jquery.tabledit.min.js'></script>
     <script src='./jquery.tabledit.js'></script>
</head>
<body>
<!-- Navigation Bar --->
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
        <a href="./Masterpage_uc.php" class="navbar nav-font-white">Enrolled student</a>
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
    <div class="container">
        <h2 align="center">Allocate lecturer </h2>

        <table id="editable" class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>
                <thead>
                 <tr>
                 <th scope="col">ID</th>
                 <th scope="col">Unit Code</th>
                 <th scope="col">Unit Name</th>
                 <th scope="col">Lecturer</th>
                 <th scope="col">Semester</th>
                 <th scope="col">Unit Description</th>
                 <th scope="col">Campus</th>
                 <th scope="col">Consultation time</th>

                 </tr>
                </thead>
                <tbody>
                <?php
                 
                    //if ($_SERVER["REQUEST_METHOD"] == "GET") {
                   //  $query = "SELECT `id`, `unit_code`, `unit_name`, `lecturer`, `semester`, `unit_descript`, `cam` FROM `units` ORDER BY id;";
                   //$query=" SELECT * FROM `units`,`staff1` where `units`.`lecturer`=`staff1`.`id`";
                   //$query="SELECT * FROM `tutorial` WHERE `unit_id`=3"
                   //$query="SELECT `units`.`id` as `unitid`,`units`.`contime`, `units`.`unit_code`,`units`.`unit_name`,`staff1`.`fname`,`staff1`.`lname`,`units`.`semester`,`units`.`unit_descript`,`units`.`cam` FROM `units`,`staff1` where `units`.`lecturer`=`staff1`.`id`";
                   //SELECT `units`.`id` as `unit_id`,`units`.`unit_code`FROM `units`,`staff1` where `units`.`lecturer`=`staff1`.`id`
                   $result = $mysqli->query($query);
                    if ($result){
                         while($rows=mysqli_fetch_array($result))
                         {
                             ?>
                             <tr>    
                                        
                             <td><?php echo $rows['unitid']; ?></td>           
                             <td><?php echo $rows['unit_code']; ?></td>    
                             <td><?php echo $rows['unit_name']; ?></td>  
                             <td><?php echo $rows['fname']." ".$rows['lname']; ?></td>   
                             <td><?php echo $rows['semester']; ?></td>
                             <td><?php echo $rows['unit_descript']; ?></td>
                             <td><?php echo $rows['cam']; ?></td>
                             <td><?php echo $rows['contime']; ?></td></td>   
                             </tr>
                          
                             <?php
                         }
                     }
                 
                ?>
                </tbody>
            </table>
            <input type="submit" value="add tutor to time" name='addtutor'>
        <?php
        $query1="SELECT * FROM `lecturer`,`staff1` where `lecturer`.`lecturer_id`=`staff1`.`id`";

        $result1 = $mysqli->query($query1);

                 
                         while($rows1=mysqli_fetch_array($result1)){
                             $lecture_id=$rows1['lecturer_id'];
                             $lecturers[$lecture_id]=$rows1['fname']." ".$rows1['lname'];
                         }

                         
                         $lecturers=json_encode($lecturers);
                        
                         echo  "<script>
                         var lecturers='$lecturers'
                         
                         </script>";
                        ?>

                        <script>
                        $(document).ready(function() {
                        $("#search-button").click(function() {
                        var searchText = $("#search-field").serialize();

                        
                    })
                });
             

                        $(document).ready(function(){
                        $('#editable').Tabledit({
                        url:'edituc.php',
                        hideIdentifier: true,
                        columns:{
                        identifier:[0,"id"],
                        editable:[[3,'lecturer',lecturers],[7,'contime', contime]]
                    },

                    restoreButton:false,
                    onSuccess: function(data,textStatus,jqXHR){
                       
                        if(data.action == 'delete')
                        {
                            $('#'+data.id).remove();
                        }
                    }
                });
            });
            
        </script>

    </div>

</html>