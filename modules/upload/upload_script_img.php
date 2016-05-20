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
		<title>IMG Uploader</title>
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
		if (isset($_GET["mdl"]) && isset($_GET["i"]) && !empty($_GET["mdl"]) && !empty($_GET["i"])) {
			$module = $mysqli->real_escape_string($_GET["mdl"]);
			$id = $mysqli->real_escape_string(intval($_GET["i"]));

			if (isset($_COOKIE[$configuration["cookie"]])) {
				if (!isset($_POST["submit"])) {

					// search for allowed file types on Database
					$query = sprintf(
						"SELECT * FROM %s_files_type WHERE upload_format = 'image'",
						$configuration["mysql-prefix"]
					);
					$source = $mysqli->query($query);
					while ($data = $source->fetch_assoc()) {
						if (!isset($allowedFormats)) {
							$allowedFormats = $data["extension"];
						} else {
							$allowedFormats .= " ".$data["extension"];
						}
					}

					print str_replace(
						"{c2r-allowedFormats}",
						$allowedFormats,
						file_get_contents("templates-e/form-img.html")
					);

				} else {
					// verification if the file uploaded have permission to be save
					$query = sprintf(
						"SELECT * FROM %s_files_type WHERE upload_format = 'image' AND type = '%s'",
						$configuration["mysql-prefix"], $_FILES["file"]["type"]
					);
					$source = $mysqli->query($query);

					if ($source->num_rows > 0) {
						$description = $mysqli->real_escape_string(utf8_decode($_POST["description"]));
						$code = $mysqli->real_escape_string(utf8_decode($_POST["code"]));
						$data = $source->fetch_assoc();
						$time = time();
						$fileName = $time.".".$data["extension"];
						$filePath = "../../../u-files/".$fileName;

						$query = sprintf(
							"INSERT INTO %s_files (file, type, description, code, module, ordering, id_ass, user_id, date) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
							$configuration["mysql-prefix"], $fileName, "image", $description, $code, $module, intval($_POST["ordering"]), $id, $userData["id"], date("Y-m-d H:i:s", $time)
						);

						if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
							if ($mysqli->query($query)) {
								print "<p>File saved with sucess!</p>";
								print "<img class=\"thumb\" alt=\"thumb\" src=\"".$filePath."\" />";
								print "<button onclick=\"goTo('".$_SERVER["REQUEST_URI"]."');\">Adicionar Mais</button>";
							} else {
								print "<p>Error Announce! The system can't save this entry on BD for unkown reason</p>";
							}
						} else {
							print "<p>Error Announce! The system can't save this file for unkown reason!</p>";
						}
					} else {
						print "<p>File type are not allowed on ower system!</p>";
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
