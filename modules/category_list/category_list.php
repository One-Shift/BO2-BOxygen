<?php
	$object_category = new category();
	$category_list = $object_category->returnAllCategories();
?>
<h1 class="pageTitle">Category List</h1>
<div class="category-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/category-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>

	<table class="db-list">
		<tr>
			<th>#</th>
			<th>Categoria</th>
			<th>Secção</th>
			<th>Pub.</th>
			<th>Sel.</th>
		</tr>
		<?php
			foreach ($category_list as $category) {
				if ($category['published']) {
					$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_on.png\" alt=\"on\" />";
				} else {
					$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_off.png\" alt=\"off\" />";
				}

				print str_replace(
					array(
						"{c2r-id}",
						"{c2r-name}",
						"{c2r-type}",
						"{c2r-published}",
						"{c2r-path-bo}",
						"{c2r-confirm}"
					),
					array(
						$category["id"],
						$category["name_1"],
						$category["category_type"],
						$published,
						$configuration["path-bo"],
						$language["template"]["are-you-sure"]
					),
					file_get_contents($configuration["path-bo"]."/modules/category_list/templates-e/line.html");
				);
			}
		?>
	</table>

	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/category-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
