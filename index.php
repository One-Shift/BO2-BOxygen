<?php
include "header.php";

$showForm = true;
$showError = false;
$showSucess = false;

// verificar existência de cookie
if (!isset($_COOKIE[$configuration["cookie"]])) {
	// verificar se o botão loginSubmit foi clicado
	if (isset($_POST["loginSubmit"])) {
		// codigo para efectuar o login
		// verifica se o loginUsername e loginPassword foram preenchidos correctamente
		if (!empty($_POST["email"]) && !empty($_POST["password"])) {
			// procurar na base de dados se existe uma entrada com os dados introduzidos
			$query = sprintf(
				"SELECT * FROM %s_users WHERE email = '%s' AND password = '%s' AND (rank = 'owner' OR rank = 'manager') AND status = '%s'",
				$configuration["mysql-prefix"], $mysqli->real_escape_string($_POST["email"]), sha1(md5(sha1(md5($_POST["password"])))), '1'
			);
			$source = $mysqli->query($query);
			$nr = $source->num_rows;

			// caso exista 1 registo, inicia o processo de criação de sessão
			if ($nr == 1) {
				$data = $source->fetch_assoc();

				$cookieData = sprintf(
					"%s.%s",
					$data["id"], $data["password"]
				);
				$time = time() + ($configuration["cookie-time"] * 60);

				// criar o cookie com os dados de sessão
				if (
					setcookie($configuration["cookie"], $cookieData, $time, $configuration["path-bo"])
				) {
					// login efectuado com sucesso
					$showForm = false;
					$showError = false;
					$showSucess = true;
				} else {
					// erro ao iniciar sessão por causa do cookie
					$showError = true;
					$showForm = true;
				}
			} else {
				// não existe nenhum registo na base de dados, com os dados introduzidos
				$showError = true;
				$showForm = true;
			}
		} else {
			// caso o username ou password não sejam preenchidos
			$showError = true;
			$showForm = true;
		}
	}
} else {
	// caso o botão loginSubmit não tenha sido clicado
	$showForm = false;
	$showError = false;
	$showSucess = true;
}

if (isset($_COOKIE[$configuration["cookie"]])) {
	$data = explode(".", $_COOKIE[$configuration["cookie"]]);
	$account["id"] = $data[0];
	unset($data);
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
		<meta property="og:description" content="<?= $language["system"]["description"] ?>" />

		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="description" content="<?= $language["system"]["description"] ?>" />
		<meta name="robots" content="index" />
		<meta name="author" content="NexuS-Pt, work team" />

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
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/nicEdit.js"></script>
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
		<!-- SPACER - ESPAÇO DEIXADO ACIMA DO LOGIN -->
		<div id="wrapper"></div>
		<div id="login">
			<div id="header"></div>
			<div id="container">
				<?php
				if ($showSucess) {
					printf(
						"<div id=\"sucess\"><i class=\"fa fa-thumbs-up\"></i> %s</div><script>setTimeout(function(){goTo('./0/');}, 1500);</script>",
						$language["login"]["sucess"]
					);
				}
				if ($showError) {
					printf(
						"<div id=\"error\"><i class=\"fa fa-thumbs-down\"></i> %s</div>",
						$language["login"]["error"]
					);
				}
				?>
				<?php if ($showForm) { ?>
					<form action="./index.php" method="post" name="loginForm">
						<div id="fields">
							<div id="username"><input type="email" name="email" placeholder="Email Address" required="" autofocus></div>
							<div id="password"><input type="password" name="password" placeholder="password" required=""></div>
						</div>
						<div id="buttons">
							<div id="buttonlogin"><button type="submit" name="loginSubmit"><?= $language["login"]["b_login"]; ?></button></div>
							<div id="buttonreset"><button type="reset" name="loginReset"><?= $language["login"]["b_reset"]; ?></button></div>
						</div>
					</form>
				<?php } ?>
			</div>
		</div>
		<?php if ($configuration["pub"]) { ?>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
		<?php } ?>
	</body>
</html>
<?php $mysqli->close(); ?>
