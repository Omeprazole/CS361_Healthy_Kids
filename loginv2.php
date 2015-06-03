<?php
session_start();
$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'bauerbr-db';
	$dbuser = 'bauerbr-db';
	$dbpass = 'M2whRxJMNGLI85Ki';

	$con = new mysqli("oniddb.cws.oregonstate.edu", "bauerbr-db", "M2whRxJMNGLI85Ki", "bauerbr-db");
	if ($con->connect_errno) {
		echo "Failed to connect to con: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	} else {
		
	}
	$username = $_GET['username'];
	 $password = $_GET['password'];

	$sort = "SELECT * FROM users WHERE '$username' = username AND password = '$password'";
		if(!$results = $con->query($sort)){
			quit(hi);
			echo json_encode(20);
		} 
		$results = $con -> query($sort);
		if(mysqli_num_rows($results) == 0){
				echo json_decode(10);
				$results->close();
		} else if(mysqli_num_rows($results) > 0) {
		$results->close();
		echo json_encode(15);
		$_SESSION["username"] = $username;
		}


?>
