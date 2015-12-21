<?php

include "../../configuration.php";
include "../../connect.php";

$language = parse_ini_file(sprintf("../../languages/%s.ini", $configuration["language"]), true);

header("Content-Type: text/html; charset=utf-8");

?>
<html>
	<head>
		<title>Files List</title>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
		<style type="text/css">
			* {
				font-family: Sans-Serif;
			}

			div#toolbar {
				position: fixed;
				bottom: 2px;
				right: 2px;
				height: 30px;
				background: rgba(0,0,0,0.85);
				color: white;
				line-height: 30px;
				padding: 0 5px 0 5px;
				border-radius: 2px;
				min-width: 20px;
				text-align: center;
			}

			div#toolbar a {
				background: transparent;
				border: none;
				color: white;
				cursor: pointer;
				line-height: 30px;
			}

			div#toolbar a i {
				 line-height: 31px;
			}

			table {
				font-size: 14px;
				width: 100%;
				border-spacing: 0;
			}

			table tr:hover td {
				background: rgb(240,240,240);
			}

			table img {
				cursor: pointer;
			}

			.spacer30 {
				height: 30px;
			}

			a.green, button.green {
				background: none repeat scroll 0 0 rgb(78, 189, 74);
				border: 0 none;
				border-radius: 2px;
				box-sizing: border-box;
				color: #fff;
				cursor: pointer;
				display: inline-block;
				height: 33px;
				line-height: 33px;
				padding: 0 16px;
				text-shadow: 0 1px rgba(0, 0, 0, 0.08);
			}

			a.red, button.red {
				background: none repeat scroll 0 0 rgb(238, 79, 61);
				border: 0 none;
				border-radius: 2px;
				box-sizing: border-box;
				color: #fff;
				cursor: pointer;
				display: inline-block;
				height: 33px;
				line-height: 33px;
				padding: 0 16px;
				text-shadow: 0 1px rgba(0, 0, 0, 0.08);
			}

			a.red i, button.red i, a.green i, button.green i {
				line-height: 250%
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

				print str_replace(
					array(
						"{c2r-module}",
						"{c2r-id}"
					),
					array(
						$module,
						$id
					),
					file_get_contents("templates-e/topbar.html")
				);

				if (!isset($_REQUEST["tp"]) && !isset($_REQUEST["vl"])) {

					print "<table>";
					// selecionar imagens na base de dados
					$query_i = sprintf(
						"SELECT * FROM %s_files WHERE id_ass = '%s' AND module = '%s'",
						$configuration["mysql-prefix"], $id, $_GET["mdl"]
					);
					$source_i = $mysqli->query($query_i);

					while ($data_i = $source_i->fetch_assoc()) {
						print str_replace(
							[
								"{c2r-module}",
								"{c2r-id}",
								"{c2r-file-id}",
								"{c2r-code}",
								"{c2r-alt}",
								"{c2r-file}",
								"{c2r-type}",
							],
							[
								$module,
								$id,
								$data_i['id'],
								$data_i['code'],
								$data_i['description'],
								"../../../u-files/".$data_i['file'],
								"img"
							],
							file_get_contents("templates-e/line.html")
						);
					}
					print '</table>';
				} else {
					if ($_GET["tp"] == "file") {
						$query_i_1 = sprintf(
							"SELECT * FROM %s_files WHERE id = '%s' AND module = '%s' LIMIT 1",
							$configuration['mysql-prefix'], intval($_REQUEST["vl"]), $_GET["mdl"]
						);
						$source_i_1 = $mysqli->query($query_i_1);
						$data_i_1 = $source_i_1->fetch_assoc();

						$query_i_2 = sprintf(
							"DELETE FROM %s_files WHERE id = '%s'",
							$configuration["mysql-prefix"],
							$data_i_1["id"]
						);
						if ($mysqli->query($query_i_2)) {
							unlink("../../../u-files/" . $data_i_1["file"]) or die();
							print "<p>Ficheiro Apagado com Sucesso</p>";
						} else {
							print "<p>Erro encontrado ao tentar imprimir</p>";
						}
					}
				}
			} else {
				print "<p>Please login first!</p>";
			}
		} else {
			print "<p>The module can\'t be initialized!</p>";
		}
		?>
		<div class="spacer30"></div>
		<script>
			$(document).ready(
				function() {
					$("a[alt=view]").on(
						"click",
						function() {
							popUp($(this).attr("href"), '640', '480');
							return false;
						}
					);
				}
			);
		</script>
	</body>
</html>
