<?php
include "../../configuration.php";
include "../../connect.php";

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

					print
							"<form method=\"post\" enctype=\"multipart/form-data\">".
							"<label>Alt _1:</label>".
							"<input type=\"text\" name=\"alt_1\" maxlength=\"255\" />".
							"<div class=\"spacer30\"></div>".
							"<label>Code:</label>".
							"<textarea name=\"alt_2\"></textarea>".
							"<div class=\"spacer30\"></div>".
							"<label>File:</label>".
							"<input type=\"file\" name=\"file\" />".
							"<div class=\"spacer30\"></div>".
							"<button type=\"submit\" name=\"submit\" onclick=\"if ($('input[type=file]').val() != '' && $('input[name=alt_1]').val() != '') {return true;} else {alert('Preencha o campo ALT! Seleccione um Ficheiro!'); return false} return false;\">Submit</button>".
							"<blockquote>Alloowed Formats: ".$allowedFormats."</blockquote>".
							"</form>";
				} else {
					// verification if the file uploaded have permission to be save
					$query = sprintf(
						"SELECT * FROM %s_files_type WHERE upload_format = 'image' AND type = '%s'",
						$configuration["mysql-prefix"], $_FILES["file"]["type"]
					);
					$source = $mysqli->query($query);

					if ($source->num_rows > 0) {
						$alt_1 = $mysqli->real_escape_string(utf8_decode($_POST["alt_1"]));
						$alt_2 = $mysqli->real_escape_string(utf8_decode($_POST["alt_2"]));
						$data = $source->fetch_assoc();
						$time = time();
						$fileName = $time.".".$data["extension"];
						$filePath = "../../../u-img/".$fileName;

						$query = sprintf(
							"INSERT INTO %s_images (file, alt_1, alt_2, module, priority, id_ass, date) VALUES ('%s', '%s', '%s', '%s', '0', '%s', '%s')",
							$configuration["mysql-prefix"], $fileName, $alt_1, $alt_2, $module, $id, date("Y-m-d H:i:s", $time)
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
