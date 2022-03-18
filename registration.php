<?php

include("session.php");
include('db_conn.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="./css/registration.css" />
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg" >
      <img src="logo.jpg" id="logo">
      <a href="./homepage.php" class="navbar-brand nav-font-white" >Course Management System</a>
      <!--<a href="./login.html" class="navbar">Login/logout</a>-->
      <!--<a href="./registration.html" class="navbar">Registration</a>-->
      <!--
      <a href="./unit-details.html" class="navbar">Unit Details</a>
      <a href="./unit-enrolment.html" class="navbar">Unit Enrolment</a>
      <a href="./individual-timetable.html" class="navbar">Individual Timetable</a>
      <a href="./tutorial-allocation-system.html" class="navbar">Tutorial allocation system</a>
      <a href="./academic-staff.html" class="navbar">Master page for Academic Staff</a>
    -->
    </nav>

    <div class="container my-5" id="registration">
      <div class="row justify-content-around">
        <div class="col-4">
          <form id="reg-form" action="./php/reg.php" method="POST">
            <div class="form-group">
              <label for="fname">First name *</label>
              <input class="form-control" type="text" name="fname" id="fname" placeholder="Lanfeng" />
            </div>
            <div class="form-group">
              <label for="lname">Last name *</label>
              <input class="form-control" type="text" name="lname" id="lname" placeholder="Shi" />
            </div>
            <div class="form-group" id="user-role">
              <label class="user-role-margin" >User role</label>
              <div class="form-check user-role-margin">
                <input
                  class="form-check-input"
                  type="radio"
                  name="role"
                  id="role-student"
                  value="student"
                  checked
                  onchange="onRoleValueChange(event)"
                />
                <label class="form-check-label" for="role-student">
                  Student
                </label>
              </div>
              <div class="form-check user-role-margin">
                <input
                  class="form-check-input"
                  type="radio"
                  name="role"
                  id="role-staff"
                  value="staff"
                  onchange="onRoleValueChange(event)"
                />
                <label class="form-check-label" for="role-staff">
                  Staff
                </label>
              </div>
            </div>

            <!--student reg form-->
            <fieldset id="student-fields" class="form-group">
              <div class="form-group">
                <label for="email">Email *</label>
                <input class="form-control" type="text" name="studentemail" placeholder="Your email address" id="studentemail" />
              </div>
              
              <div class="form-group">
              <label for="Student ID">Student ID *</label>
                <input class="form-control" type="text" name="studentid" placeholder="Your student id" id="studentid" />
              </div>

              <div class="form-group">
                <label for="password">Password *</label>
                <input class="form-control" type="password" name="password" placeholder="Your password" id="password" />
              </div>

              <div class="form-group">
                <label for="cpassword">Confirm Password *</label>
                <input class="form-control" type="password" name="cpassword" placeholder="Your password" id="cpassword" />
              </div>
              <div class="form-group">
                <label for="Phone">Phone number</label>
                <input class="form-control" type="tel" name="Phone" id="Phone" placeholder="Your Phone number" />
              </div>
              <div class="form-group">
                <label for="Date of Birth">Date of Birth</label>
                <input class="form-control" type="date" name="Date of Birth" placeholder="Your Birthday"/>
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <input class="form-control" type="text" name="Address" id="Address" placeholder="Your Address" />
              </div>
            </fieldset>

            <!--staff reg form-->
            <fieldset id="staff-fields" class="form-group form-hidden">
              <div class="form-group">
                <label for="SID">Staff ID *</label>
                <input class="form-control" type="text" name="SID" id="SID" placeholder="Your staff ID" />
              </div>
              <div class="form-group">
                <label for="password">Password *</label>
                <input class="form-control" type="password" name="spassword" placeholder="Your password" id="spassword" />
              </div>

              <div class="form-group">
                <label for="cpassword">Confirm Password *</label>
                <input class="form-control" type="password" name="scpassword" placeholder="Your password" id="scpassword" />
              </div>
              <div class="form-group">
                <label for="email">Email *</label>
                <input class="form-control" type="text" name="staffemail" placeholder="Your email address" id="staffemail" />
              </div>
              <div class="form-group">
                <label for="EXP">Expertise *</label>
                <input class="form-control" type="text" name="Expertise" id="EXP" placeholder="Your Expertise" />
              </div>

              <div class="form-group">
                <label for="Qua">Qualification *</label>
                <input class="form-control" type="text" name="Qualification" id="Qua" placeholder="Your Qualification" />
              </div>

              <div class="form-group">
                <label for="Phone">Phone number *</label>
                <input class="form-control" type="tel" name="sphone" id="sphone" placeholder="Your Phone number" />
              </div>
            </fieldset>

            <input type="submit" id="b_submit" value="submit" class="btn btn-primary" name="submit" onclick="insert()"/>
          </form>
          <div id="error"></div>
          
        </div>
      </div>
    </div>
    <?php
      if($_POST['insert'] and $_SERVER['REQUEST_METHOD'] == "POST"){
        insert();
      }

      function insert(){

        $fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $password=$_POST["password"];
        $email=$_POST["studentemail"];
        $phone=$_POST["Phone"];
        $id=$_POST["studentid"];
        $birthday=$_POST["Date of Birth"];
        $address=$_POST["Address"];
        $staffid=$_POST["SID"];
        $staffpassword=$_POST["spassword"];
        $staffemail=$_POST["staffemail"];
        $exp=$_POST["Expertise"];
        $staffphone=$_POST["sphone"];
        $qual=$_POST["Qualification"];


        if ($id) {
          $query = "INSERT INTO `student` (`fname`,`lname`,`email`,`id`,`password`,`phone`,`birthday`,`address`) VALUES ('$fname','$lname','$email','$id','$password','$phone','$birthday','$address'，'student')";
        } else {
          $query = "INSERT INTO `staff1` (`fname`,`lname`,`id`,`password`,`email`,`exp`,`qual`,`phone`,`position`) VALUES ('$fname','$lname','$staffid','$staffpassword','$staffemail','$exp','$qual','$staffphone','staff')";
        }

        $mysqli->query($query);

      }

    ?>
    <!-- Script --->
    <script type="text/javascript" src="./js/registration.js">
    </script>
    <script type="text/javascript" src="./js/homepage.js"></script>
  </body>
  <footer class="footer">
        <p>&copy; Designed by Lanfeng Shi (547644) 2020</p>
      </footer>
</html>
