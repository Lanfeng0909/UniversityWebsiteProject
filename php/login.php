<?php
//include the file session.php
include("session.php");

//if there is any received error message 
if(isset($_GET['error']))
{
	$errormessage=$_GET['error'];
	//show error message using javascript alert
	echo "<script>alert('$errormessage');</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/login.css">
    
</head>

<body>
    <!-- Navigation Bar --->
    <nav class="navbar navbar-expand-lg" >
        <img src="logo.jpg" id="logo">
        <a href="./homepage.html" class="navbar-brand nav-font-white" >Course Management System</a>
        <!--<a href="./login.html" class="navbar">Login/logout</a>-->
        <!--<a href="./registration.html" class="navbar">Registration</a>-->
        <!--<a href="./unit-details.html" class="navbar nav-font-white" >Unit Details</a>
        <a href="./unit-enrolment.html" class="navbar nav-font-white" >Unit Enrolment</a>
        <a href="./individual-timetable.html" class="navbar nav-font-white" >Individual Timetable</a>-->
    <!--<a href="./tutorial-allocation-system.html" class="navbar">Tutorial allocation system</a>
        <a href="./academic-staff.html" class="navbar">Master page for Academic Staff</a>-->
    </nav>

    <!-- Heading --->
    <div class="container text-center my-5">
        <h1>University of Dowell in Wonderland</h1>
    </div>

    <!-- Homepage --->
    <div class="container text-center my-5" id="welcome">
        <div class="row justify-content-around">
            <div class="col-4">
                <!-- <h2>Please log in</h2> -->
                <form action="./signin_engine.php" method="post">
                <div class="log-in" id="login-tab">
                    <div class="log-in-usr">
                        <label for="usr">Username</label>
                        <input type="username" name="username" class="form-control" id="usr" placeholder="Enter username" />
                    </div>
                    <div class="log-in-pwd">
                        <label for="pwd" id="label-font">Password</label>
                        <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" />
                    </div>
                    <!--<form id="form-font" >
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioStudent" value="student">
                            <label class="form-check-label" for="radioStudent">Student</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioStaff" value="staff">
                            <label class="form-check-label" for="radioStaff">Academic Staff</label>
                        </div>
                      
                    </form>-->
                    <button type="submit" class="btn btn-outline-primary" id="loginbtn">Login</button>
                    </form>
                    
                  
                    <a class="nav-link" href="./registration.html" >Don't have an account? Register here!</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script --->
    <script type="text/javascript" src="./js/login.js"></script>
</body>

</html>
