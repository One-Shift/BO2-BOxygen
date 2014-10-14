<?php
	include("./header.php");
	
	//get user
	if (isset($_COOKIE[$configuration["cookie"]])) {
		$account = explode(".",$_COOKIE[$configuration["cookie"]]);
		
		$query = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s'", $configuration["mysql-prefix"], $account[0], $account[1]);
		$source = $mysqli->query($query);
		$nr = $source->num_rows;
		if ($nr == 1) {
			$account["name"] = $account[0];
			$account["password"] = $account[1];
			unset($account[0]); unset($account[1]);
			$account["login"] = true;
		} else {
			$account["login"] = false;
			setcookie($configuration['cookie'], null, time() - 3600);
		}
	} else {$account["login"] = false;}
	
	//get page
	if (isset($_GET["pg"])) {$pg = $_GET["pg"];} else {$pg = "home";}
    
	//logout
	$logout = false;
	if ($pg == 'logout') {
		if (isset($_COOKIE[$configuration["cookie"]])) {
			setcookie($configuration['cookie'], null, time() - 3600);
			$logout = true;
		}
	}
    
	include './languages/'.$configuration["language"].'.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<link type="text/css" rel="stylesheet" href="<?php print $configuration["path-bo"] ?>/site-assets/css/style.css" />
               
		<link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css' />
                
		<script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/nicEdit.js"></script>
		<script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
		<link href="<?php print $configuration["path-bo"] ?>/site-assets/images/favicon.ico" rel="shortcut icon" />
		<title><?php echo $configuration["BO2-name"]; ?></title>
	</head>
	<body>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
		<div id="site">
			<div id="header"></div>
			<div id="container">
				<div id="title-bar">
					<div id="site-title"><a href="<?php print $configuration["path-bo"] ?>/0/"><?php echo $configuration["site-name"]; ?></a></div>
					<div id="menu-title"><?php echo $language["menu"]; ?></div>
				</div>
				<div id="page">
					<?php include "./includes.php"; ?>
				</div>
				<div id="menu">
					<?php include "./modules/menu/menu.php"; ?>
				</div>
			</div>
			<div id="wrap"></div>
		</div>
		<div id="footer">
			<div id="copyright"><a href="http://www.nexus-pt.eu/" target="_blank">NexuS-Pt , work team</a> | <a target="_blank" href="https://github.com/NexuS-Pt/BO2-BOxygen">GitHub</a> | <a target="_blank" href="http://www.nexus-pt.eu/fm/">Fórum</a></div>
			<div id="c"><span>©</span><?php print date('Y'); ?></div>
		</div>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
	</body>
</html>
