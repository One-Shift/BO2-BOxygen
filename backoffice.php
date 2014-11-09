<?php
include("./header.php");

//get user
if (isset($_COOKIE[$configuration["cookie"]])) {
    $account = explode(".", $_COOKIE[$configuration["cookie"]]);

    $query = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s'", $configuration["mysql-prefix"], $account[0], $account[1]);
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

//logout
$logout = false;
if ($pg == 'logout') {
    if (isset($_COOKIE[$configuration["cookie"]])) {
        setcookie($configuration['cookie'], null, time() - 3600);
        $logout = true;
    }
}

include './languages/' . $configuration["language"] . '.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $configuration["BO2-name"]; ?></title>

        <!-- begin favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="57x57"   href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72"   href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_144.png" />

        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_16.png"  sizes="16x16"   type="image/png" />
        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_32.png"  sizes="32x32"   type="image/png" />
        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_48.png"  sizes="48x48"   type="image/png" />
        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_64.png"  sizes="64x64"   type="image/png" />
        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_128.png" sizes="128x128" type="image/png" />

        <link rel="icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_32.png" />
        <!--[if IE]><link rel="shortcut icon" href="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon.ico"><![endif]-->

        <meta name="msapplication-TileColor" content="#ebffe3" />
        <meta name="msapplication-TileImage" content="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_144.png" />
        <!-- end favicon -->

        <meta property="og:site_name" content="{c2r-sitename}" />
        <meta property="og:type" content="website" /> 
        <meta property="og:url" content="<?php print $configuration["path-bo"] ?>" /> 
        <meta property="og:image" content="<?php print $configuration["path-bo"] ?>/site-assets/favicon/favicon_128.png" />
        <meta property="og:title" content="{c2r-sitename}" />
        <meta property="og:description" content="{c2r-description}" />

        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta name="keywords" content="{c2r-keywords}" />
        <meta name="description" content="{c2r-description}" />
        <meta name="robots" content="index" />
        <meta name="author" content="NexuS-Pt, work team" />
        <meta name="author-code" content="#someone#" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link type="text/css" rel="stylesheet" href="<?php print $configuration["path-bo"] ?>/site-assets/css/style.css" />

        <link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css' />

        <script type="text/javascript">
            var path_bo = "<?php print $configuration["path-bo"] ?>";
        </script>
        <script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/nicEdit.js"></script>
        <script type="text/javascript" src="<?php print $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
    </head>
    <body>
        <iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
        <div id="site">
            <div id="header"></div>
            <div id="container">
                <div id="title-bar">
                    <div id="site-title"><a href="<?php print $configuration["path-bo"] ?>/0/"><?php echo $configuration["site-name"]; ?></a></div>
                    <div id="menu-title"><?php print $language["system"]["menu"]; ?></div>
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
            <div id="c"><span>©</span> <?php print date('Y'); ?></div>
        </div>
        <iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
    </body>
</html>
