<?php	
	$mysqli = mysqli_connect($configuration["mysql-host"], $configuration["mysql-user"], $configuration["mysql-password"], $configuration["mysql-database"]) or die("Errormessage: %s\n".$mysqli->error);
	$mysqli->set_charset("utf8");
