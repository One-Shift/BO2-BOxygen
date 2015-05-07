<?php
	$object_category = new category();
	$category_list = $object_category->returnAllCategories();
?>
<h1 class="pageTitle"><?= $language["mod_category"]["list_title"] ?></h1>
<div class="category-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/category/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>

	<table class="db-list">
		<tr>
			<th><?= $language["mod_category"]["table_id"]?></th>
			<th><?= $language["mod_category"]["table_category"]?></th>
			<th><?= $language["mod_category"]["table_section"]?></th>
			<th><?= $language["mod_category"]["table_published"]?></th>
			<th style="width: 120px;"><?= $language["mod_category"]["table_sel"]?></th>
		</tr>
		<?php
		if (count($category_list) != 0) {
			foreach ($category_list as $category) {
				if ($category['published']) {
					$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_on.png\" alt=\"on\" />";
				} else {
					$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_off.png\" alt=\"off\" />";
				}

				print str_replace(
					array(
						"{c2r-id}",
						"{c2r-category}",
						"{c2r-date}",
						"{c2r-section}",
						"{c2r-published}",
						"{c2r-path-bo}",
						"{c2r-confirm}"
					),
					array(
						$category["id"],
						$category["name_1"],
						$category["date_update"],
						$category["category_type"],
						$published,
						$configuration["path-bo"],
						$language["template"]["areyousure"]
					),
					file_get_contents("./modules/category/templates-e/line.html")
				);
			}
		}else {
		print str_replace(
				"{c2r-noresults}",
				$language["template"]["noresults"],
				file_get_contents("./modules/category/templates-e/line-noresults.html")
			);
		}
		?>
	</table>

	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/category/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
