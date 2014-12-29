<?php

include("./header.php");

//get user
if (isset($_COOKIE[$configuration["cookie"]])) {
	$account = explode(".", $_COOKIE[$configuration["cookie"]]);

	$query = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s' AND (rank = '%s' OR rank = '%s')", $configuration["mysql-prefix"], $account[0], $account[1], "owner", "manager");
	$source = $mysqli->query($query);
	$nr = $source->num_rows;
	
	if ($nr == 1) {
		$account["name"] = $account[0];
		$account["password"] = $account[1];
		unset($account[0]);
		unset($account[1]);
		$account["login"] = true;
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
		setcookie($configuration["cookie"], null, time() - 3600);
		$logout = true;
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $configuration["BO2-name"]; ?></title>

        <!-- begin favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="57x57"   href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72"   href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_144.png" />

        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_16.png"  sizes="16x16"   type="image/png" />
        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_32.png"  sizes="32x32"   type="image/png" />
        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_48.png"  sizes="48x48"   type="image/png" />
        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_64.png"  sizes="64x64"   type="image/png" />
        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_128.png" sizes="128x128" type="image/png" />

        <link rel="icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_32.png" />
        <!--[if IE]><link rel="shortcut icon" href="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon.ico"><![endif]-->

        <meta name="msapplication-TileColor" content="#ebffe3" />
        <meta name="msapplication-TileImage" content="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_144.png" />
        <!-- end favicon -->

        <meta property="og:site_name" content="<?= $configuration["BO2-name"]; ?>" />
        <meta property="og:type" content="website" /> 
        <meta property="og:url" content="<?= $configuration["path-bo"] ?>" /> 
        <meta property="og:image" content="<?= $configuration["path-bo"] ?>/site-assets/favicon/favicon_128.png" />
        <meta property="og:title" content="<?= $configuration["BO2-name"]; ?>" />

        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta name="robots" content="index" />
        <meta name="author" content="NexuS-Pt, work team" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link type="text/css" rel="stylesheet" href="<?= $configuration["path-bo"] ?>/site-assets/css/style.css" />

        <link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css' />

        <script type="text/javascript">
			var path_bo = "<?= print $configuration["path-bo"] ?>";
        </script>
        <script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/nicEdit.js"></script>
        <script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
    </head>
    <body>
        <iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
        <div id="site">
            <div id="header"></div>
            <div id="container">
                <div id="title-bar">
                    <div id="site-title"><a href="<?= $configuration["path-bo"] ?>/0/"><?= $configuration["site-name"]; ?></a></div>
                    <div id="menu-title"><?= $language["system"]["menu"]; ?></div>
                </div>
                <div id="page">
					<?php
					include "./includes.php";
					?>
                </div>
                <div id="menu">
					<?php
					if ($account["login"]) {
						$menu = file_get_contents("./modules/menu/menu.php");
						$menu = str_replace(
								array("{c2r-menu-users}", "{c2r-menu-categories}", "{c2r-menu-articles}", "{c2r-menu-products}", "{c2r-menu-order}", "{c2r-menu-newsletters}", "{c2r-menu-account}", "{c2r-menu-begin}", "{c2r-menu-logout}"), $language["menu"], $menu
						);

						print str_replace("{c2r-path-bo}", $configuration["path-bo"], $menu);
						//include "./modules/menu/menu.php";
					}
					?>
                </div>
            </div>
            <div id="wrap"></div>
        </div>
        <div id="footer">
            <div id="copyright"><a href="http://www.nexus-pt.eu/" target="_blank">NexuS-Pt , work team</a> | <a target="_blank" href="https://github.com/NexuS-Pt/BO2-BOxygen">GitHub</a> | <a target="_blank" href="http://www.nexus-pt.eu/fm/">Fórum</a></div>
            <div id="c"><span>©</span> <?= date('Y'); ?></div>
        </div>
        <iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
    </body>
</html>
