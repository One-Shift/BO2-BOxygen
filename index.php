<?php
	include("./header.php");
	
	$showForm = true;
	$showError = false;
	$showSucess = false;
	
	// verificar existência de cookie
	if (!isset($_COOKIE[$configuration["cookie"]])) {
		// verificar se o botão loginSubmit foi clicado
		if (isset($_POST["loginSubmit"])) {
			// codigo para efectuar o login
			// verifica se o loginUsername e loginPassword foram preenchidos correctamente
			if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])) {
				// procurar na base de dados se existe uma entrada com os dados introduzidos
				$query = sprintf("SELECT * FROM %s_users WHERE name = '%s' AND password = '%s' AND (rank = 'owner' OR rank = 'manager')", $configuration["mysql-prefix"], $_POST["loginUsername"], sha1(md5(sha1(md5($_POST["loginPassword"])))));
				$source = $mysqli->query($query);
				$nr = $source->num_rows;
				
				// caso exista 1 registo, inicia o processo de criação de sessão
				if ($nr == 1) {
					$data = $source->fetch_array(MYSQLI_ASSOC);
					// criar o cookie com os dados de sessão
					if (setcookie($configuration["cookie"],$data["id"].".".$data["password"],time() + ($configuration["cookie-time"] * 60))) {
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
        $data = explode('.',$_REQUEST[$configuration["cookie"]]);
        $account['id'] = $data[0];
        unset($data);
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<link type="text/css" rel="stylesheet" href="./site-assets/css/style.css">
        
		<script type="text/javascript" src="./site-assets/js/script.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet' type='text/css'>
		<title><?php echo $configuration["BO2-name"]; ?></title>
	</head>
	<body>
		<!-- SPACER - ESPAÇO DEIXADO ACIMA DO LOGIN -->
		<div id="wrapper"></div>
		<div id="login">
			<div id="header"></div>
			<div id="container">
				<?php
				if ($showSucess)
					echo "<div id=\"sucess\" onClick=\"goTo('./backoffice.php');\">".$language["login-sucess"]."</div><script>setTimeout(function(){goTo('./backoffice.php');},1000);</script>";
				if ($showError)
					echo "<div id=\"error\">".$language["login-error"]."</div>";
				?>
				<?php if ($showForm) { ?>
				<form action="./index.php" method="post" name="loginForm">
					<div id="fields">
						<div id="username"><input type="text" name="loginUsername" placeholder="username"></div>
						<div id="password"><input type="password" name="loginPassword" placeholder="password"></div>			
					</div>
					<div id="buttons">
						<div id="buttonlogin"><button type="submit" name="loginSubmit"><?php echo $language["login-b-login"]; ?></button></div>
						<div id="buttonreset"><button type="reset" name="loginReset"><?php echo $language["login-b-reset"]; ?></button></div>
					</div>
				</form>
				<?php } ?>
			</div>
		</div>
		<iframe class="ads" src="http://www.nexus-pt.eu/ads.php"></iframe>
	</body>
</html>
<?php $mysqli->close(); ?>
