<?php
//connect to mysql
$mysqli = new mysqli('localhost','lanfengs', "547644", "lanfengs");

if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
?>