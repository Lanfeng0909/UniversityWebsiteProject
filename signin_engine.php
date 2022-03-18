<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
//receive the username data from the form (in signin_form.php)
$user=$_POST['username'];
//receive the password data from the form (in signin_form.php)
$password=$_POST['password'];

//query to check whether username is in the table (check whether the user has been signed up)
$query = "SELECT * FROM student WHERE id='$user'";
$query1 = "SELECT * FROM staff1 WHERE id='$user'";

$result = $mysqli->query($query);
$result1 = $mysqli->query($query1);

//decide whether the user is student or staff
//convert the result to array (the key of the array will be the column names of the table)

if (mysqli_num_rows($result)){
	$row=$result->fetch_array(MYSQLI_ASSOC);
	$_SESSION['session_position']='student';
   } else if(mysqli_num_rows($result1)){
	$row=$result1->fetch_array(MYSQLI_ASSOC);
	$_SESSION['session_position']=$row['position'];

   } else {
	   echo "login failed";
   }

//if the username from table is not same as the username data from the form(from signin_form.php)
if($row['id']!=$user || $user=="")
{
	//automatically go back to signin_form and pass the error message
	header('Location: ./login.php?error=invalid_username');
}
//if the username is same as the username data from the form(from signin_form.php) 
else {

	//if the password from table is same as the password data from the form(from signin_form.php)
	//if($row['password'],==$password)
	if(hash_equals($row['password'],crypt($password,$row['password']))) {
		//save the username in the session
		$_SESSION['session_user']=$row['id'];
		//$_SESSION['session_position']= $row['position'];
		//automatically go to signin_success.php
		//if($_SESSION['session_value']=='student'){
			header('Location: ./homepage.php');
		//}else{
			//header('Location: ./homepage.php');
		//}

	}//if the password from table does not match with the password data from the signin form
	else{

		//automatically go back to signin_form and pass the error message
		header('Location: ./login.php?error=invalid_password');
	}
}

?>