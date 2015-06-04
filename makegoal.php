<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'storedpassword.php';
session_start();
?>
<html>
  <head>
    <meta charset="UTF-8">
	 <meta http-equiv="refresh" content="0;url=mygoals.php"> <!--//auto redirect code from  http://stackoverflow.com/questions/5411538/redirect-from-an-html-page -->
	<title>Healthy Kids, Happy Adults</title>
  </head>
<body></body>
<?php

	if (isset($_POST['newname']) == TRUE){ //syntax from http://php.net/manual/en/function.isset.php
		$newname = $_POST['newname'];
		$newdesc = $_POST['newdesc'];
		$user = $_SESSION["username"];

		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bauerbr-db",$password,"bauerbr-db");

		if(!($stmt = $mysqli->prepare('INSERT INTO goals(goal_name,goal_descript) VALUES(?,?)'))){
									echo "Prepare Failed<br>";
				}
		if(!($stmt->bind_param('ss',$newname,$newdesc))){ //syntax from http://us2.php.net/manual/en/mysqli-stmt.bind-param.php
					echo "Bind Failed<br>";
				}
			if (!$stmt->execute()) {
					echo "Execute failed<br>";
			}
			
		if(!($stmt = $mysqli->prepare('INSERT INTO user_goals(gid,useid) VALUES((SELECT id FROM goals WHERE goal_name = ? AND goal_descript =? ),?)'))){
									echo "Prepare Failed<br>";
				}
		if(!($stmt->bind_param('sss',$newname,$newdesc,$user))){ //syntax from http://us2.php.net/manual/en/mysqli-stmt.bind-param.php
					echo "Bind Failed<br>";
				}
			if (!$stmt->execute()) {
					echo "Execute failed<br>";
			}
	}
	else {
		echo "<h2>Error: Please use my goals page</h2>";
	}
?>