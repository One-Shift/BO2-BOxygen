<?php include "header.php"; ?>
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

		<!-- CACHE -->
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		
		<!-- FONT AWESOME -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css' />

		<link type="text/css" rel="stylesheet" href="<?= $configuration["path-bo"] ?>/site-assets/css/style.css" />
		<link type="text/css" rel="stylesheet" href="<?= $configuration["path-bo"] ?>/site-assets/css/custom.css" />

		<script type="text/javascript">
			var path_bo = "<?= $configuration["path-bo"] ?>";
		</script>
		<!-- JQUERY -->
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<!-- CKEDITOR -->
		<script src="<?= $configuration["path-bo"] ?>/site-assets/js/ckeditor/ckeditor.js"></script>
		<script>CKEDITOR.dtd.$removeEmpty['span'] = false;</script>

		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-36909778-11', 'auto');
			ga('send', 'pageview');
		</script>
	</head>
	<body style="background-image: url('<?= file_get_contents("http://api.nexus-pt.eu/bo2-image-server/") ?>');">
		<?php if ($configuration["pub"]) { ?>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
		<?php } ?>
		<div id="site">
			<div id="header"></div>
			<div id="container">
				<div id="title-bar">
					<div id="site-title"><a href="<?= $configuration["path-bo"] ?>/0/"><?= $configuration["site-name"] ?></a></div>
					<div id="menu-title"><?= $language["system"]["menu"] ?></div>
				</div>
				<div id="page">
					<?php
					include "includes.php";
					?>
				</div>
				<div id="menu">
					<?php
					if ($account["login"]) {
						$menu = file_get_contents("modules/menu/menu.php");
						$menu = str_replace(
								[
									"{c2r-menu-users}",
									"{c2r-menu-categories}",
									"{c2r-menu-articles}",
									"{c2r-menu-products}",
									"{c2r-menu-order}",
									"{c2r-menu-newsletters}",
									"{c2r-menu-controller-files}",
									"{c2r-menu-vcard}",
									"{c2r-menu-account}",
									"{c2r-menu-begin}",
									"{c2r-menu-logout}"
								],
							$language["menu"],
							$menu
						);

						print str_replace("{c2r-path-bo}", $configuration["path-bo"], $menu);
					}
					?>
				</div>
			</div>
			<div id="wrap"></div>
		</div>
		<div id="footer">
			<div id="copyright">
				<a href="http://www.nexus-pt.eu/" target="_blank">NexuS-Pt , work team</a> | <a target="_blank" href="https://github.com/NexuS-Pt/BO2-BOxygen">GitHub</a> | <a target="_blank" href="http://www.nexus-pt.eu/fm/">Fórum</a> | <a>You are using version <?= $configuration["BO2-version"]; ?> <?= $configuration["BO2-subversion"]; ?></a>
			</div>
			<div id="c">
				<span>©</span> <?= date('Y'); ?>
			</div>
		</div>
		<?php if ($configuration["pub"]) { ?>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
		<?php } ?>
	</body>
</html>
