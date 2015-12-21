<?php

// CONFIGURAÇÕES
include "configuration.php";
include "connect.php";

// CLASSES
include "class/class.article.php";
include "class/class.cart.php";
include "class/class.category.php";
include "class/class.GibberishAES.php";
include "class/class.history.php";
include "class/class.newsletter.php";
include "class/class.order.php";
include "class/class.product.php";
include "class/class.search.php";
include "class/class.user.php";
include "class/class.vcard.php";
include "class/class.file.php";

//PHPMailer
include "class/PHPMailer/class.phpmailer.php";

// OUTROS
include "functions.php";

$language = parse_ini_file(
	sprintf("languages/%s.ini", $configuration["language"]),
	true
);

//get user
if (isset($_COOKIE[$configuration["cookie"]])) {
	$account = explode(".", $_COOKIE[$configuration["cookie"]]);

	$query = sprintf(
		"SELECT * FROM %s_users WHERE id = '%s' AND password = '%s' AND (rank = '%s' OR rank = '%s') AND status = '%s'",
		$configuration["mysql-prefix"], $account[0], $account[1], "owner", "manager", TRUE
	);
	$source = $mysqli->query($query);
	$nr = $source->num_rows;

	if ($nr == 1) {
		$account["name"] = $account[0];
		$account["password"] = $account[1];
		unset($account[0]);
		unset($account[1]);
		$account["login"] = true;
		$userData = $source->fetch_assoc();

		if($configuration["restricted"]){
			if($userData["rank"] == "owner"){
				$configuration["restricted"] = false;
			}
		}
		unset($userData);
	} else {
		$account["login"] = false;
		setcookie($configuration['cookie'], null, time() - 3600);
	}
} else {
	$account["login"] = false;
}

//get page
if (isset($_GET["pg"])) {
	$pg = $_GET["pg"];
} else {
	$pg = "home";
}

// controlador de ID
if (isset($_GET["i"]) && !empty($_GET["i"])) {
	$id = intval($_GET["i"]);
} else {
	$id = null;
}

// controlador de acção
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	$a = $mysqli->real_escape_string($_GET["a"]);
} else {
	$a = null;
}

//logout
$logout = false;
if ($pg == "logout") {
	if (isset($_COOKIE[$configuration["cookie"]])) {
		if(setcookie($configuration["cookie"], null, 0, $configuration["path-bo"])) {
			$logout = true;
		}
	}
}
