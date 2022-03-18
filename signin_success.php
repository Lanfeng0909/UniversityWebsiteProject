<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");

$res=mysqli_query($mysqli, "SELECT * FROM users WHERE username LIKE '$session_user'"); 
if ($res) $rs = mysqli_fetch_array($res);

//if the session for username has not been saved, automatically go back to signin_form.php
if ($session_user==""){
	header('Location: login.php');
}
?>
<html>
<head>
<title>Success</title>
</head>

<body>
<b>You have successfully signed in.</b><br/>
Welcome!! 
<?php echo $session_user;?><br/>

	<!--if the user clicks "sign out" button, go to signout.php-->
	<form action="./signout.php" method="post">
		<input type="submit" name="submit" value="Sign out">
	</form>
</body>
</html>