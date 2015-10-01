<?php
	$object_article = new vcard();
	$vcard_list = $object_article->returnAllVcards();

	$line = file_get_contents("modules/vcard/templates-e/line.html");
	$line_noresult = file_get_contents("modules/vcard/templates-e/line-noresults.html");
?>
<h1 class="pageTitle"><?= $language["mod_vcard"]["list_title"]?></h1>
<div class="article-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/vcard/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
	<table class="db-list">
	  <tr>
		<th><?= $language["mod_vcard"]["table_id"]?></th>
		<th><?= $language["mod_vcard"]["table_name"]?></th>
		<th><?= $language["mod_vcard"]["table_published"]?></th>
		<th style="width: 120px;"><?= $language["mod_vcard"]["table_sel"]?></th>
	  </tr>
	  <?php
		if (count($vcard_list) != 0) {
			foreach ($vcard_list as $vcard) {

				if ($vcard["published"]) {
					$published = sprintf("<img src=\"%s/site-assets/images/icon_on.png\" alt=\"on\" title=\"publicado\"/>", $configuration["path-bo"]);
				} else {
					$published = sprintf("<img src=\"%s/site-assets/images/icon_off.png\" alt=\"off\"  title=\"não publicado\"/>", $configuration["path-bo"]);
				}

				print str_replace(
						array(
							"{c2r-id}",
							"{c2r-date}",
							"{c2r-name}",
							"{c2r-published}",
							"{c2r-path-bo}",
							"{c2r-confirm}"
						),
						array(
							$vcard["id"],
							$vcard["date_update"],
							(!empty($vcard["name"])) ? strip_tags($vcard["name"]) : "# no-name #",
							$published,
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
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/vcard/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
