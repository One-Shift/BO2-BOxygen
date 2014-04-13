<?php	
	$mysqli = mysqli_connect($configuration["mysql-host"], $configuration["mysql-user"], $configuration["mysql-password"], $configuration["mysql-database"]) or die("Error " . mysqli_error($link));
	$mysqli->set_charset("utf8");
