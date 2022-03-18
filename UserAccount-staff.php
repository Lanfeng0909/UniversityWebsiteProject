
<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");



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
<body>
    <div class="container">
        <h2 align="center">User account</h2>


        <table id="editable" class="table table-bordered" border: 1px solid black; width:100%; vertical-align: center;>
                <thead>
                 <tr>
                 <th scope="col">ID</th>
                 <th scope="col">First name</th>
                 <th scope="col">Last name</th>
                 <th scope="col">Email</th>
                 <th scope="col">Phone</th>
                 <th scope="col">Expertise</th>
                 <th scope="col">Qualification</th>
                 <th scope="col">Availability</th>
                        
                        </tr>
                     <?php
                   ?>  
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM `staff1` WHERE `id`='$session_user'";
                $result = $mysqli->query($query);
                    
               
                        $rows=mysqli_fetch_array($result);
                      
                             ?>
                             <tr> 
                             <td><?php echo $rows['id']; ?></td>                  
                             <td><?php echo $rows['fname']; ?></td>           
                             <td><?php echo $rows['lname']; ?></td>    
                             <td><?php echo $rows['email']; ?></td>  
                             <td><?php echo $rows['phone']; ?></td>           
                             <td><?php echo $rows['exp']; ?></td>           
                             <td><?php echo $rows['qual']; ?></td>    
                             <td><?php echo $rows['ava_time']; ?></td>  
                        
                        </tr>
                     <?php
                   
                   ?>     
                      
                </tbody>
            </table>


        <script>
            
            $(document).ready(function(){
                $('#editable').Tabledit({
                    url:'editstaff.php',
                    columns:{
                        identifier:[0,"id"],
                        editable:[[1,'fname'],[2,'lname'],[3,'email'],[4,'phone'],[5,'exp'],[6,'qual'],[7,'ava_time']]
                    },
                    restoreButton:false,
                    onSuccess: function(data,textStatus,jqXHR){
                        if(data.action == 'delete')
                        {
                            $('#'+data.id).remove();
                        }
                    }
                });
                
                }).done(function(data){
                    alert(data);
                });
            
        </script>

    </div>
    
</body>
<footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>