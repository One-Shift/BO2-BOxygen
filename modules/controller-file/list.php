<?php
	$object_file = new file();
	$files_list = $object_file->returnFiles();

	$line = file_get_contents("modules/controller-file/templates-e/line.html");
	$line_noresult = file_get_contents("modules/controller-file/templates-e/line-noresults.html");
?>
<h1 class="pageTitle"><?= $language["mod_files"]["list_title"]?></h1>
<div class="spacer15"></div>
<div class="article-list">
	<table class="db-list">
	  <tr>
		<th><?= $language["mod_files"]["table_id"] ?></th>
		<th><?= $language["mod_files"]["table_name"] ?></th>
		<th><?= $language["mod_files"]["table_module"] ?></th>
		<th><?= $language["mod_files"]["table_id_ass"] ?></th>
		<th style="width: 120px;"><?= $language["mod_files"]["table_sel"]?></th>
	  </tr>
	  <?php
		if ($files_list != FALSE && count($files_list) != 0) {
			foreach ($files_list as $file) {

				print str_replace(
						array(
							"{c2r-id}",
							"{c2r-date}",
							"{c2r-name}",
							"{c2r-module}",
							"{c2r-id-ass}",
							"{c2r-path-bo}",
							"{c2r-confirm}"
						),
						array(
							$file["id"],
							$file["date"],
							(!empty($file["file"])) ? strip_tags($file["file"]) : "# no-name #",
							$file["module"],
							$file["id_ass"],
							$configuration["path-bo"],
							$language["template"]["areyousure"]
						),
						$line
					);
			}
		}else {
			print str_replace(
					"{c2r-noresults}",
					$language["template"]["noresults"],
					$line_noresult
				);
		}

	  ?>
	</table>
</div>
