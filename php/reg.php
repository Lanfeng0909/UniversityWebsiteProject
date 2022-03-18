
 <?php
        include("../db_conn.php");

        echo "You have successfully registered your account "."<br>";
        echo "fname: ".$_POST["fname"]."<br>";
        echo "lname: ".$_POST["lname"]."<br>";
        echo "password: ".$_POST["password"]."<br>";
        echo "email: ".$_POST["studentemail"]."<br>";
        echo "phone: ".$_POST["Phone"]."<br>";
        echo "id: ".$_POST["studentid"]."<br>";
        echo "birthday: ".$_POST["Date of Birth"]."<br>";
        echo "address: ".$_POST["Address"]."<br>";
        echo "staffid: ".$_POST["SID"]."<br>";
        echo "staffpassword: ".$_POST["spassword"]."<br>";
        echo "staffemail: ".$_POST["staffemail"]."<br>";
        echo "exp: ".$_POST["Expertise"]."<br>";
        echo "staffphone: ".$_POST["sphone"]."<br>";
        echo "qual: ".$_POST["Qualification"]."<br>";



        $fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $password=crypt($_POST["password"],'st');
        //$password=crypt($_POST["password"],$password);
        $email=$_POST["studentemail"];
        $phone=$_POST["Phone"];
        $id=$_POST["studentid"];
        $birthday=$_POST["Date of Birth"];
        $address=$_POST["Address"];
        $staffid=$_POST["SID"];
        $staffpassword=crypt($_POST["spassword"],'st');
        $staffemail=$_POST["staffemail"];
        $exp=$_POST["Expertise"];
        $staffphone=$_POST["sphone"];
        $qual=$_POST["Qualification"];

        
    
        if ($id) {
          $query = "INSERT INTO `student` (`fname`,`lname`,`email`,`id`,`password`,`phone`,`birthday`,`address`,`position`) VALUES ('$fname','$lname','$email','$id','$password','$phone','$birthday','$address','student')";
          header('Location: ../login.php');
        } else {
          $query = "INSERT INTO `staff1` (`fname`,`lname`,`id`,`password`,`email`,`exp`,`qual`,`phone`,`position`) VALUES ('$fname','$lname','$staffid','$staffpassword','$staffemail','$exp','$qual','$staffphone','staff')";
          header('Location: ../login.php');
        }
        
      
        
       if( !$mysqli->query($query)){
          
       }
       
       
    ?>
<!DOCTYPE html>
<html>
<body>
   
</body>
</html>