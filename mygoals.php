<?php
error_reporting(E_ALL);
include 'storedpassword.php'; //This is for logging in to  ONID db without displaying the password as it is stored in a hidden folder
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Healthy Kids, Happy Adults</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="App to combat childhood obesity">
    <meta name="author" content="CS361 - Healthy Kids, Happy Adults">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/style1.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <a class="navbar-brand" href="../HealthyKids/mygoals.php" style="color:white">Healthy Kids, Happy Adults</a>
		  <ul class="nav navbar-nav">
		  <li><a href="../HealthyKids/daily_goal.html">Daily Goals</a></li>
		  <li><a href="../HealthyKids/logout.php">Logout</a></li>
		  </ul>
        </div>
      </div>
    </nav>
 <?php
 if (!$_SESSION["username"] == "1"){
	echo '<h2>Please log in to customize your items</h2>';
	echo '<h2><a href="../HealthyKids/login_v2.html">Click Here to Login</a></h2>';
		  
 }  
 else {
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bauerbr-db",$password,"bauerbr-db"); //my DB
		
		echo'<h2>            Welcome '.$_SESSION["username"].'!</h2>';
		
	 
		echo '<p><h2>Your Goals</h2><p>
			<div id = table12>
			<table>
		    <tr><td>Goal<td>Description';
		$out_checkpoint = '';
		$out_check_desc = '';
		$out_goal_name = ''; 
		$out_desc = '';
		
		if(!($stmt = $mysqli->prepare('	
			SELECT goals.goal_name, goals.goal_descript, c.check_name, c.check_descript FROM goals
			LEFT JOIN
			(
				SELECT checkpoints.id, checkpoints.check_name, checkpoints.check_descript, goal_check.checkid, goal_check.gid FROM checkpoints
				INNER JOIN goal_check ON goal_check.checkid = checkpoints.id
			)
			as c ON goals.id = c.gid
			INNER JOIN user_goals ON user_goals.gid = goals.id
			WHERE user_goals.useid = "'.$_SESSION["username"].'"
			ORDER BY goals.goal_name'))){
			echo "Prepare Failed";
	
		}
		if(!($stmt->execute())){
				echo "Execute failed";
		}
	
		if (!($stmt->bind_result($out_goal_name,$out_desc, $out_checkpoint,$out_check_desc))){
					echo "Binding failed";
				}
		
		while ($stmt->fetch()){
				echo '<tr> <td>  '.$out_goal_name.'<td> '.$out_desc.' 
				<br>'; 
		}
			echo "</table>";
		
		$stmt->close();
///////////////////////////////////////////////////
	 echo'<br><br><br><b>Add New Item</b><br><br>
	  <form name = "goal_new" method = "post">
	<label> Add Goal:</label> 
	  <input type = "text" id ="newName"> <br>
	  <label> Add Goal Description: </label> 
	  <input type = "text" id ="goal_description"> <br>
	  </select>
	</form>
	<p><input type="button" value = "Add Goal" onclick = "addItem()" /></p>';
	 //html coding for decimal constraints on Description from http://stackoverflow.com/questions/19011861/is-there-a-float-input-type-in-html5
 }
	  
?>
</div>

 <script type='text/javascript'>
function addItem() {
	var input_name = document.getElementById("newName");
	var input_desc= document.getElementById("goal_description");
	
	var name_entry = input_name.value;
	var desc_entry = input_desc.value;
	
	
	console.log(name_entry);
	console.log(desc_entry);
	
	
	input_area.innerHTML ="";
	
	if (name_entry == "" || desc_entry == ""){
		input_area.innerHTML = "<h2>ERROR: You must fill out all parts of the form</h2><br>";
	}
	else {
		
			input_area.innerHTML = '<form id = "post_newItem" action = "makegoal.php" method = "post" > <input type = "hidden" name = "newname" value ="'+name_entry+'"><input type = "hidden" name = "newdesc" value ="'+desc_entry+'"><input type = "submit" id = "add_items" action = "makegoal.php" ></form>';
			input_area = document.getElementById("add_items");
			input_area.click();
	}
	
	
	
}
	 //PHP variable transfer syntax from http://p2p.wrox.com/php-faqs/11606-q-how-do-i-pass-php-variables-javascript.html
</script>
		<div id = 'message'></div>
	</div>
	<div id = 'input_area'></div>
	</div>
	
  </body>