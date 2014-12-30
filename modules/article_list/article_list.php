<?php
	$object_article = new article();
	$article_list = $object_article->returnAllArticles();
?>
<h1 class="pageTitle">Article List</h1>
<div class="article-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/article-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
	<table class="db-list">
	  <tr>
		<th>#</th>
		<th>Titulo</th>
		<th>Categoria</th>
		<th>Pub.</th>
		<th style="width: 120px;">Sel.</th>
	  </tr>
	  <?php
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
						"{c2r-published}",
						"{c2r-path-bo}",
						"{c2r-confirm}"
					), 
					array(
						$article["id"],
						$article["date_update"],
						$article["title_1"],
						$category["name_1"],
						$published,
						$configuration["path-bo"],
						$language["template"]["areyousure"]
					), 
					file_get_contents($configuration["path-bo"]."/modules/article_list/templats-e/line.html")
				);
		}

	  ?>
	</table>
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/article-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
