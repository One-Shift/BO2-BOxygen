<?php
	$object_article = new article();
	$article_list = $object_article->returnAllArticles();

	$line = file_get_contents("modules/article/templates-e/line.html");
	$line_noresult = file_get_contents("modules/article/templates-e/line-noresults.html");
?>
<h1 class="pageTitle"><?= $language["mod_article"]["list_title"]?></h1>
<div class="article-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/article/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
	<table class="db-list">
	  <tr>
		<th><?= $language["mod_article"]["table_id"]?></th>
		<th><?= $language["mod_article"]["table_title"]?></th>
		<th><?= $language["mod_article"]["table_category"]?></th>
		<th><?= $language["mod_article"]["table_published"]?></th>
		<th style="width: 120px;"><?= $language["mod_article"]["table_sel"]?></th>
	  </tr>
	  <?php
		if (count($article_list) != 0) {
			foreach ($article_list as $article) {
				$object_category = new category();
				$object_category->setId($article["category_id"]);
				$category = $object_category->returnOneCategory();

				if ($article["published"]) {
					$published = sprintf("<img src=\"%s/site-assets/images/icon_on.png\" alt=\"on\" title=\"publicado\"/>", $configuration["path-bo"]);
				} else {
					$published = sprintf("<img src=\"%s/site-assets/images/icon_off.png\" alt=\"off\"  title=\"não publicado\"/>", $configuration["path-bo"]);
				}

				print str_replace(
						array(
							"{c2r-id}",
							"{c2r-date}",
							"{c2r-title}",
							"{c2r-category}",
							"{c2r-published}",
							"{c2r-path-bo}",
							"{c2r-confirm}"
						),
						array(
							$article["id"],
							$article["date_update"],
							strip_tags($article["title_1"]),
							$category["name_1"],
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
		<a href="<?= $configuration["path-bo"] ?>/0/article/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
