<?php

include "./../../configuration.php";
include "./../../connect.php";
include sprintf("./../../languages/%s.php", $configuration["language"]);

header("Content-Type: text/html; charset=utf-8");

?>
<html>
	<head>
		<title>Files List</title>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?= $configuration["path-bo"] ?>/site-assets/js/script.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= $configuration["path-bo"] ?>/site-assets/css/font-awesome.min.css" />
		<style type="text/css">
			* {
				font-family: Sans-Serif;
			}

			div#toolbar {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 30px;
				background: rgba(0,0,0,0.85);
				color: white;
				line-height: 30px;
				padding: 0 5px 0 5px;
			}

			div#toolbar button {
				background: transparent;
				border: none;
				color: white;
				cursor: pointer;
				line-height: 30px;
			}

			div#toolbar button:hover {
				color: orange;
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
		</style>
	</head>
	<body>

		<div class="spacer30"></div>
		<?php
		// SÓ ENTRA NO UPLOADER SE O COOKIE AINDA EXISTIR
		// O UTILIZADORE TERÁ DE TER CUIDADO COM O TEMPO DE SESSÃO
		if (isset($_GET["mdl"]) && isset($_GET["i"]) && !empty($_GET["mdl"]) && !empty($_GET["i"])) {
			$module = $mysqli->real_escape_string($_GET["mdl"]);
			$id = $mysqli->real_escape_string(intval($_GET["i"]));

			if (isset($_COOKIE[$configuration["cookie"]])) {

				print file_get_contents("./templates-e/topbar.html");

				if (!isset($_REQUEST["tp"]) && !isset($_REQUEST["vl"])) {

					print "<table>";
					// selecionar imagens na base de dados
					$query_i = sprintf("SELECT * FROM %s_images WHERE id_ass = '%s' AND module = '%s'", $configuration["mysql-prefix"], $id, $_GET["mdl"]);
					$source_i = $mysqli->query($query_i);

					while ($data_i = $source_i->fetch_assoc()) {
						print
								'<tr>' .
								'<td><input type="radio" name="item" value="' . $data_i['id'] . '.img"/></td>' .
								'<td title="Alt_2: ' . $data_i['alt_2'] . '">' . $data_i['alt_1'] . '</td>' .
								'<td>' . $data_i['file'] . '</td>' .
								'<td><img src="./../../site-assets/images/icon_computer.png" alt="see" onclick="popUp(\'./../../../u-img/' . $data_i['file'] . '\',\'640\',\'480\');"/></td>' .
								'</tr>';
					}

					// selecionar documentos na base de dados
					$query_d = sprintf("SELECT * FROM %s_documents WHERE id_ass = '%s' AND module = '%s'", $configuration['mysql-prefix'], $id, $_GET["mdl"]);
					$source_d = $mysqli->query($query_d);

					while ($data_d = $source_d->fetch_assoc()) {
						print
								'<tr>' .
								'<td><input type="radio" name="item" value="' . $data_d['id'] . '.doc"/></td>' .
								'<td>' . $data_d['alt'] . '</td>' .
								'<td>' . $data_d['file'] . '</td>' .
								'<td><img src="./../../site-assets/images/icon_computer.png" alt="see" onclick="popUp(\'./../../../u-docs/' . $data_d['file'] . '\',\'640\',\'480\');"/></td>' .
								'</tr>';
					}

					if ($source_i->num_rows == 0 && $source_d->num_rows == 0) {
						print "<tr><td>No results found</td></tr>";
					}

					print '</table>';
				} else {

					// em caso de ser imagem
					if ($_GET["tp"] == "img") {
						$query_i_1 = sprintf("SELECT * FROM %s_images WHERE id = '%s' AND module = '%s' LIMIT 1", $configuration['mysql-prefix'], intval($_REQUEST["vl"]), $_GET["mdl"]);
						$source_i_1 = $mysqli->query($query_i_1);
						$data_i_1 = $source_i_1->fetch_assoc();

						$query_i_2 = sprintf("DELETE FROM %s_images WHERE id = '%s'", $configuration["mysql-prefix"], $data_i_1["id"]);
						if ($mysqli->query($query_i_2)) {
							unlink("./../../../u-img/" . $data_i_1["file"]) or die();
							print "<p>Ficheiro Apagado com Sucesso</p>";
						} else {
							print "<p>Erro encontrado ao tentar imprimir</p>";
						}
					// em caso de ser documento (ex.: PDF)
					} else if ($_GET["tp"] == "doc") {
						$query_d_1 = sprintf("SELECT * FROM %s_documents WHERE id = '%s' AND module = '%s' LIMIT 1", $configuration['mysql-prefix'], intval($_REQUEST["vl"]), $_GET["mdl"]);
						$source_d_1 = $mysqli->query($query_d_1);
						$data_d_1 = $source_d_1->fetch_assoc();

						$query_d_2 = sprintf("DELETE FROM %s_documents WHERE id = '%s'", $configuration["mysql-prefix"], $data_d_1["id"]);
						if ($mysqli->query($query_d_2)) {
							unlink("./../../../u-docs/" . $data_d_1["file"]) or die();
							print "<p>Ficheiro Apagado com Sucesso</p>";
						} else {
							print "<p>Erro encontrado ao tentar imprimir</p>";
						}
					} else {
						print "<p>Erro encontrado ao tentar apagar o ficheiro pretendido!</p>";
					}
				}
			} else {
				print "<p>Please login first!</p>";
			}
		} else {
			print "<p>The module can\'t be initialized!</p>";
		}
		?>
		<script>
			var id = <?= $_GET["i"] ?>; // get ID
			var module = <?= $_GET["mdl"] ?>; // get MODULE

			$('#delete').on('click', function () {
				if ($('input[type=radio]:checked').val() != null) {
					if (confirm('Are You Sure?')) { // confirmar a ação
						var code = $('input[type=radio]:checked').val().split('.');
						goTo('<?= $_SERVER["REQUEST_URI"] ?>&tp=' + code[1] + '&vl=' + code[0]);
					}
				} else {
					alert('Seleccione um ficheiro!'); // aviso ao utilizador
					return false;
				}
			});
			$('#update').on('click', function () {
				goTo('./upload_list.php?mdl=' + module + '&i=' + id);
			});

		</script>
	</body>
</html>
