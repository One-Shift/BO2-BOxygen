<script>
	function otherCategory(variable) {
		goTo('<?= $configuration["path-bo"] ?>/0/product-list/' + $(variable).val());
	}
</script>
<?php
	if($id === null) {
		$id = 0;
	}

	$object_product = new product();
	$product_list = $object_product->returnProducts(sprintf("WHERE category_id = %s ORDER BY %s ASC", $id, "title_1"));
?>
<h1 class="pageTitle">Product List</h1>
<div class="product-list">
	<div class="button-area">
		<select id="category" onchange="otherCategory(this);">
			<option>Seleccionar uma categoria</option>
			<?php
				$object_category = new category();
				$category_list = $object_category->returnCategories(sprintf("WHERE category_type = '%s' ORDER BY %s ASC", $configuration["category_sections"][0], "name_1"));

				foreach($category_list as $category){
					printf("<option value=\"%s\">%s</option>", $category["id"], $category["name_1"]);
				}
			?>

		</select>
		<a href="<?= $configuration["path-bo"] ?>/0/product-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
	<table class="db-list">
		<tr>
			<th>#</th>
			<th>Produto</th>
			<th>Categoria</th>
			<th>Pub.</th>
			<th>Sel.</th>
		</tr>
		<?php
			$i_last = 0;

		foreach($product_list as $product){
			$object_category = new category();
			$object_category->setId($product["category_id"]);
			$category = $object_category->returnOneCategory();

			if ($product['published']) {
				$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_on.png\" alt=\"on\" />";
			} else {
				$published = "<img src=\"{c2r-path-bo}/site-assets/images/icon_off.png\" alt=\"off\" />";
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
					$category["name_1"],
					$published,
					$configuration["path-bo"],
					$language["template"]["are-you-sure"]
				),
				file_get_contents("./modules/product_list/templates-e/line.html")
			);

			  $i_last = $product["id"];
		  }
	  ?>
	</table>
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/product-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>

