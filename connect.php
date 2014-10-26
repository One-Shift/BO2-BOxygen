<?php
	$mysqli = mysqli_connect($configuration["mysql-host"], $configuration["mysql-user"], $configuration["mysql-password"], $configuration["mysql-database"]);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	$mysqli->set_charset("utf8");
