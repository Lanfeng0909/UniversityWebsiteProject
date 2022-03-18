<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

?>
<?php

if ($session_position!="DC"){
    echo '<script>alert("DC ACCESS is required");
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

    <body>
        <div class="container">
            <h2 align="center">Manage Unit details</h2>
            <!--create a editable units table-->
            <table id="editable" class="table table-bordered" border: 1px solid black; width:100%; vertical-align:
                center;>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Unit Code</th>
                        <th scope="col">Unit Name</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Unit Description</th>
                        <th scope="col">Campus</th>
                        <th scope="col">Unit Coordinator</th>

                    </tr>
                </thead>
                <tbody>
                    <!--select unit data from table units in database-->
                    <?php
                     
                 $query="SELECT `units`.`id` as `unitid`, `units`.`unit_code`,`units`.`unit_name`,`units`.`semester`,`units`.`unit_descript`,`units`.`cam`,`units`.`lecturer`,`units`.`uc` FROM `units` left join `staff1` on `staff1`.`id`=`units`.`id` ";
                   $result = $mysqli->query($query);
                    if ($result){
                         while($rows=mysqli_fetch_array($result))
                         {
                            $lecturer=$rows['lecturer'];
                            $query2="select * from `staff1`,`units` where `units`.`lecturer`=`staff1`.`id` and `units`.`lecturer`='$lecturer' ";
                            $result2 = $mysqli->query($query2);
                            $rows2=mysqli_fetch_array($result2);

                            $uc=$rows['uc'];
                            $query4="select * from `staff1`,`units` where `units`.`uc`=`staff1`.`id` and `units`.`uc`='$uc' ";
                            $result4 = $mysqli->query($query4);
                            $rows4=mysqli_fetch_array($result4);

                             ?>
                    <tr>

                        <td><?php echo $rows['unitid']; ?></td>
                        <td><?php echo $rows['unit_code']; ?></td>
                        <td><?php echo $rows['unit_name']; ?></td>
                        <td><?php echo $rows2['fname']." ".$rows2['lname']; ?></td>
                        <td><?php echo $rows['semester']; ?></td>
                        <td><?php echo $rows['unit_descript']; ?></td>
                        <td><?php echo $rows['cam']; ?></td>
                        <td><?php echo $rows4['fname']." ".$rows4['lname']; ?></td>


                    </tr>

                    <?php
                         }
                     }
                 
                ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Add New
                Unit</button>
            <button type="button" class="btn btn-primary float-left"
                onclick="window.location.href='./academic-staff.php'">Staff management</button>
            <!-- Add Modal -->
            <div class="modal fade" id="add" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Unit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal-body">
                            <form method="GET" id="add-form">
                                <div class="form-group">
                                    <label for="unit_code">Unit Code</label>
                                    <input type="text" id="unit_code" class="form-control" name="unit_code">
                                    <label for="unit_name">Unit Name</label>
                                    <input type="text" id="unit_name" class="form-control" name="unit_name">
                                    <label for="semester">Semester</label>
                                    <input type="text" id="semester" class="form-control" name="semester">
                                    <label for="unitdescription">Unit Description</label>
                                    <input type="text" id="unit_descript" class="form-control" name="unit_descript">
                                    <label for="cam">Campus</label>
                                    <input type="text" id="cam" class="form-control" name="cam">
                                </div>
                            </form>
                            <button type="button" id="add-button" class="btn btn-success">Add</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        $query1="SELECT * FROM `lecturer`,`staff1` where `lecturer`.`lecturer_id`=`staff1`.`id`";

        $result1 = $mysqli->query($query1);

                 
                         while($rows1=mysqli_fetch_array($result1)){
                             $lecture_id=$rows1['lecturer_id'];
                             $lecturers[$lecture_id]=$rows1['fname']." ".$rows1['lname'];
                         }

                         $query3="SELECT * FROM `UC`,`staff1`WHERE`UC`.`uc_id`=`staff1`.`id`";
                         $result3 = $mysqli->query($query3);

                 
                         while ($rows3=mysqli_fetch_array($result3)) {
                             $ucname=$rows3['uc_id'];
                             $ucnames[$ucname]= $rows3['fname']." ".$rows3['lname'];
                         }
                         $lecturers=json_encode($lecturers);
                         $ucnames=json_encode($ucnames);

                         echo  "<script>
                         var lecturers='$lecturers';
                         var ucnames='$ucnames';
                         </script>";
                        ?>

            <script>
            $("#add-button").click(function() {
                if ($("#unit_code").val().length == 0) {
                    alert("Unit Code is required");
                } else if ($("#unit_name").val().length == 0) {
                    alert("Unit Name is required");
                } else if ($("#semester").val().length == 0) {
                    alert("Semester is required");
                } else if ($("#unit_descript").val().length == 0) {
                    alert("Description is required");
                } else if ($("#cam").val().length == 0) {
                    alert("Cam is required");
                } else {
                    var add_unit = $("#add-form").serialize();

                    $.ajax({
                        url: "add.php",
                        method: "GET",
                        data: add_unit,
                        dataType: "html",
                        success: function(data) {
                            alert("You have added a unit successfully!");
                        }
                    })
                }
            });


            $(document).ready(function() {
                $('#editable').Tabledit({
                    url: 'edit.php',
                    hideIdentifier: true,
                    columns: {
                        identifier: [0, "id"],
                        editable: [
                            [1, 'unit_code'],
                            [2, 'unit_name'],
                            [3, 'lecturer', lecturers],
                            [4, 'semester',
                                '{"Semester 1": "Semester 1", "Semester 2": "Semester 2", "Spring school": "Spring school","Winter school": "Winter school"}'
                            ],
                            [5, 'unit_descript'],
                            [6, 'cam',
                                '{"Pandora": "Pandora", "Rivendell": "Rivendell", "Neverland": "Neverland"}'
                            ],
                            [7, 'uc', ucnames]
                        ]
                    },
                    onDraw: function() {
                        console.log('onDraw()');
                    },
                    onSuccess: function(data, textStatus, jqXHR) {
                        console.log('onSuccess(data, textStatus, jqXHR)');
                        console.log(data);
                        console.log(textStatus);
                        console.log(jqXHR);
                    },
                    onFail: function(jqXHR, textStatus, errorThrown) {
                        console.log('onFail(jqXHR, textStatus, errorThrown)');
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    },
                    onAlways: function() {
                        console.log('onAlways()');
                    },
                    onAjax: function(action, serialize) {
                        console.log('onAjax(action, serialize)');
                        console.log(action);
                        console.log(serialize);
                    },
                    restoreButton: false,
                    onSuccess: function(data, textStatus, jqXHR) {

                        if (data.action == 'delete') {
                            $('#' + data.id).remove();
                        }
                    }
                });
            });
            </script>

        </div>
    </body>
    <footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>

</html>