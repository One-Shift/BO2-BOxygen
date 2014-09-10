<?php
	$object_article = new article();
	$article_list = $object_article->returnAllArticles();
?>
<div class="article-list">
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/article-add/" class="green"><?php print $language["template"]["add"] ?></a>
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
			$object_category->setId($article['category_id']);
			$category = $object_category->returnOneCategory();

			if ($article['published']) {$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_on.png" alt="on" title="publicado"/>';}
			else {$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_off.png" alt="off"  title="não publicado"/>';}

			print
			'<tr>'.
			'<td>'.$article['id'].'</td>'.
			'<td>'.$article['title_1'].'</td>'.
			'<td>'.$category['name_1'].'</td>'.
			'<td>'.$published.'</td>';
			printf("<td style=\"text-align: right;\"><a href=\"%s/0/article-edit/%s\" onclick=\"return confirm('%s')\" class=\"orange\">%s</a> <a href=\"%s/0/article-del/%s\" onclick=\"return confirm('%s')\" class=\"red\">%s</a></td>",
				$configuration["path-bo"], $article['id'], $language["template"]["are-you-sure"], $language["template"]["edit"],
				$configuration["path-bo"], $article['id'], $language["template"]["are-you-sure"], $language["template"]["del"]
				  );

			print '</tr>';
		}

	  ?>
	</table>
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/article-add/" class="green"><?php print $language["template"]["add"] ?></a>
	</div>
</div>
