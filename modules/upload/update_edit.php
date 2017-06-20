<?php
include "../../configuration.php";
include "../../connect.php";

//get user
if (isset($_COOKIE[$configuration["cookie"]])) {
	$account = explode(".", $_COOKIE[$configuration["cookie"]]);

	$query = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s' AND (rank = '%s' OR rank = '%s') AND status = '%s'", $configuration["mysql-prefix"], $account[0], $account[1], "owner", "manager", '1');
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

$language = parse_ini_file(
	sprintf("../../languages/%s.ini", $configuration["language"]),
	true
);

header("Content-Type: text/html; charset=utf-8");
?>
<html>
	<head>
		<title>File Editor</title>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<?= file_get_contents("http://nexus-pt.github.io/BO2/bootstrap.html") ?>
		<style type="text/css">
			* {
				font-family: Sans-Serif;
			}

			label {
				display: block;
			}

			input {
				display: block;
				border: 1px solid lightGrey;
				width: 100%;
				height: 30px;
			}

			button {
				background: url("../../site-assets/images/bg-shade-light.png");
				border: 1px solid rgb(221, 221, 221);
				line-height: 25px;
				padding-left: 5px;
				padding-right: 5px;
			}

			blockquote {
				border: 1px solid lightGrey;
				padding: 5px;
				font-size: 13px;
				color: grey;
				margin: 0;
				display: inline-block;
			}

			img.thumb {
				max-width: 100%;
				max-height: 150px;
				margin: auto;
				display: block;
			}

			.spacer30 {
				height: 30px;
			}
		</style>
	</head>
	<body>
		<?php
		// SÓ ENTRA NO UPLOADER SE O COOKIE AINDA EXISTIR
		// O UTILIZADORE TERÁ DE TER CUIDADO COM O TEMPO DE SESSÃO
		if (isset($_GET["tp"]) && isset($_GET["vl"]) && !empty($_GET["tp"]) && !empty($_GET["vl"])) {
			$file_id = $mysqli->real_escape_string(intval($_GET["vl"]));

			if (isset($_COOKIE[$configuration["cookie"]])) {
				if (!isset($_POST["submit"])) {

					$query = sprintf(
						"SELECT * FROM 	%s_files WHERE id = %s",
						$configuration["mysql-prefix"], $file_id
					);

					$source = $mysqli->query($query);

					$data = $source->fetch_object();

					print str_replace(
						[
							"{c2r-value-description}",
							"{c2r-value-code}",
							"{c2r-value-sort}"
						],
						[
							$data->description,
							$data->code,
							$data->ordering
						],
						file_get_contents("templates-e/form-edit.html")
					);

				} else {

					$description = $mysqli->real_escape_string(utf8_decode($_POST["description"]));
					$code = $mysqli->real_escape_string(utf8_decode($_POST["code"]));

					$query = sprintf(
						"UPDATE %s_files SET description = '%s', code = '%s', ordering = '%s' WHERE id = '%s'",
						$configuration["mysql-prefix"], $description, $code, $_POST["ordering"], $file_id
					);

					if($mysqli->query($query)) {
						print "<p>File saved with sucess!</p>";
					} else {
						print "<p>Error Announce! The system can't save this entry on BD for unkown reason</p>";
					}
				}
			} else {
				print "<p>Please login first!</p>";
			}
		} else {
			print "<p>The module can't be initialized!</p>";
		}
		?>
	</body>
</html>
