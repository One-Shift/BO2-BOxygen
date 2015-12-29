<script>
	function otherCategory(variable) {
		goTo('<?= $configuration["path-bo"] ?>/0/product/' + $(variable).val());
	}
</script>
<?php
	if($id == null) {
		$id = 0;
	}

	$object_product = new product();
	$product_list = $object_product->returnProducts(sprintf("WHERE category_id = %s ORDER BY %s ASC", $id, "title_1"));
?>
<h1 class="pageTitle"><?= $language["mod_product"]["list_title"]?></h1>
<div class="product-list">
	<div class="button-area">
		<select id="category" onchange="otherCategory(this);">
			<option><?= $language["form"]["label_category_sel"]?></option>
			<?php
				$object_category = new category();
				$category_list = $object_category->returnCategories(sprintf("WHERE category_type = '%s' ORDER BY %s", $configuration["category_sections"][0], "ordering ASC, id ASC"));

				foreach($category_list as $category){
					printf("<option value=\"%s\" %s>%s</option>", $category["id"], ($category["id"] == $id) ? "active" : null, $category["name_1"]);
				}
			?>

		</select>
		<a href="<?= $configuration["path-bo"] ?>/0/product/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
	<table class="db-list">
		<tr>
			<th><?= $language["mod_product"]["table_id"]?></th>
			<th><?= $language["mod_product"]["table_name"]?></th>
			<th><?= $language["mod_product"]["table_category"]?></th>
			<th><?= $language["mod_product"]["table_published"]?></th>
			<th><?= $language["mod_product"]["table_sel"]?></th>
		</tr>
		<?php
			$i_last = 0;
		if (count($product_list) != 0) {
		foreach($product_list as $product){
			$object_category = new category();
			$object_category->setId($product["category_id"]);
			$category = $object_category->returnOneCategory();

			if ($product["published"]) {
				$published = "<i class=\"fa fa-check-circle\"></i>";
			} else {
				$published = "<i class=\"fa fa-circle\"></i>";
			}

			print str_replace(
				array(
					"{c2r-id}",
					"{c2r-title}",
					"{c2r-category-name}",
					"{c2r-published}",
					"{c2r-path-bo}",
					"{c2r-confirm}"
				),
				array(
					$product["id"],
					$product["title_1"],
					strip_tags($category["name_1"]),
					$published,
					$configuration["path-bo"],
					$language["template"]["areyousure"]
				),
				file_get_contents("modules/product/templates-e/line.html")
			);

			  $i_last = $product["id"];
		  }
		}else {
			print str_replace(
					"{c2r-noresults}",
					$language["template"]["noresults"],
					file_get_contents("modules/product/templates-e/line-noresults.html")
				);
		}

	  ?>
	</table>
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/product/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
