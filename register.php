<?php
//create connection
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'bauerbr-db';
	$dbuser = 'bauerbr-db';
	$dbpass = 'M2whRxJMNGLI85Ki';

	$con = new mysqli("oniddb.cws.oregonstate.edu", "bauerbr-db", "M2whRxJMNGLI85Ki", "bauerbr-db");
	if ($con->connect_errno) {
		echo "Failed to connect to con: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	} else {
	}
	
     $username = htmlspecialchars($_GET['username']);
	 $password = htmlspecialchars($_GET['password']);
	$sql = "INSERT INTO users (username,password) VALUES('$username','$password')";
	if(!$result = $con->query($sql)){
		echo json_encode(10);
		
	} else {
	echo json_encode(11);
	session_start();
	$_SESSION["username"] = $username;
	}
	
	
	
?>

