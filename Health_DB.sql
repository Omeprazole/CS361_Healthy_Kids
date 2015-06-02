-- Replace tables if they already exist
DROP TABLE IF EXISTS `users`; 
DROP TABLE IF EXISTS `goals`; 
DROP TABLE IF EXISTS `user_goals`; 
DROP TABLE IF EXISTS `checkpoints`; 
DROP TABLE IF EXISTS `goal_check`; 


-- Create a table called users for storing user ids and names:
-- id - an auto incrementing integer which is the primary key
-- name - a varchar with a maximum length of 255 characters, cannot be null
-- the combinatino of a name and subcategory must be unique


CREATE TABLE users(
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
PRIMARY KEY(id)
) ENGINE = InnoDB;


-- Create a table called goals for storing goal ids, names, descriptions, and intensity (1-10)
-- id - an auto incrementing integer which is the primary key
-- goal_name - a varchar of maximum length 255
-- goal_descript - a varchar of maximum length 255
-- intensity - an integer to flag the intensity of a goal. Default is '1' for the easiest level

CREATE TABLE goals(
id int(11) NOT NULL AUTO_INCREMENT,
goal_name varchar(255) NOT NULL,
goal_descript varchar(255),
intensity int(11) NOT NULL DEFAULT 1,
PRIMARY KEY(id)
) ENGINE = InnoDB;


-- Create a table called user_goals to store user-goal pairs and goal completion status
-- useid - an integer which is a foreign key reference to user id
-- gid - an integer which is a foreign key reference to goal id
-- complete - an integer flagged '0' to show that the goal is incomplete, and '1' for complete Default is '0'
-- The primary key is a combination of useid and gid

CREATE TABLE user_goals(
useid int(11) NOT NULL,
gid int(11) NOT NULL,
complete int(11) NOT NULL DEFAULT 0,
PRIMARY KEY(useid, gid),
FOREIGN KEY(useid) REFERENCES users(id) ON UPDATE CASCADE,
FOREIGN KEY(gid) REFERENCES goals(id) ON UPDATE CASCADE
) ENGINE = InnoDB;


-- Create a table called checkpoints to store checkpoint ids, names, and descriptions
-- id - an auto incrementing integer which is the primary key
-- check_name - a varchar of maximum length 255 which cannot be null
-- check_descript - a varchar of maximum length 255
-- received - a date type (you can read about it here http://dev.mysql.com/doc/refman/5.0/en/datetime.html)
-- isbroken - a boolean

CREATE TABLE checkpoints(
id int(11) NOT NULL AUTO_INCREMENT,
check_name varchar(255) NOT NULL,
check_descript varchar(255),
PRIMARY KEY(id)
) ENGINE = InnoDB;

-- Create a table called goal_check to store gaol-checkpoint pairs 
-- checkid - an integer which is a foreign key reference to checkpoint id
-- gid - an integer which is a foreign key reference to goal id
-- The primary key is a combination of gid and checkid

CREATE TABLE goal_check(
gid int(11) NOT NULL,
checkid int(11) NOT NULL,
PRIMARY KEY(gid, checkid),
FOREIGN KEY(gid) REFERENCES goals(id) ON UPDATE CASCADE,
FOREIGN KEY(checkid) REFERENCES checkpoints(id) ON UPDATE CASCADE
) ENGINE = InnoDB;


