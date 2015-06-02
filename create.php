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
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <a class="navbar-brand" style="color:white">Healthy Kids, Happy Adults</a>
        </div>
      </div>
    </nav>

<?php
$servername = "oniddb.cws.oregonstate.edu";
$username = "bauerbr-db";
$password = "M2whRxJMNGLI85Ki";
$dbname = "bauerbr-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table USERS
// $sql = "CREATE TABLE users(
// id int(11) NOT NULL AUTO_INCREMENT,
// name varchar(255) NOT NULL,
// PRIMARY KEY(id)
// )";

// sql to create table GOALS
$sql = "CREATE TABLE goals(
id int(11) NOT NULL AUTO_INCREMENT,
goal_name varchar(255) NOT NULL,
goal_descript varchar(255),
intensity int(11) NOT NULL DEFAULT 1,
PRIMARY KEY(id)
)";

// SQL to create table User Goals
$sql1 = "CREATE TABLE user_goals(
useid int(11) NOT NULL,
gid int(11) NOT NULL,
complete int(11) NOT NULL DEFAULT 0,
PRIMARY KEY(useid, gid),
FOREIGN KEY(useid) REFERENCES users(id) ON UPDATE CASCADE,
FOREIGN KEY(gid) REFERENCES goals(id) ON UPDATE CASCADE
)";

// SQL to create table Checkpoints
$sql2 = "CREATE TABLE checkpoints(
id int(11) NOT NULL AUTO_INCREMENT,
check_name varchar(255) NOT NULL,
check_descript varchar(255),
PRIMARY KEY(id)
)";

//Sql to create table Goal Check

$sql3 = "CREATE TABLE goal_check(
gid int(11) NOT NULL,
checkid int(11) NOT NULL,
PRIMARY KEY(gid, checkid),
FOREIGN KEY(gid) REFERENCES goals(id) ON UPDATE CASCADE,
FOREIGN KEY(checkid) REFERENCES checkpoints(id) ON UPDATE CASCADE
)";


if ($conn->query($sql) === TRUE) {
    echo "Table Goals created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql1) === TRUE) {
    echo "Table User Goals created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    echo "Table Checkpoints created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
    echo "Table User Goal_Check created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.1.4.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>