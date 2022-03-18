<?php
//starting session
session_start();

//if the session for username has not been set, initialise it
if(!isset($_SESSION['session_user'])){
	$_SESSION['session_user']="";
}
if(!isset($_SESSION['session_value'])){
	$_SESSION['session_value']="";
}
if(!isset($_SESSION['session_position'])){
	$_SESSION['session_position']="";
}
//save username in the session 
$session_user=$_SESSION['session_user'];
$session_value=$_SESSION['session_value'];
$session_position=$_SESSION['session_position'];
?>