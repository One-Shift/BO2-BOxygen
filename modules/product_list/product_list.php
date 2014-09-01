<script>
	function teste(variable) {
		goTo('./backoffice.php?pg=product-list&i=' + $(variable).val());
	}
</script>
<?php
	if(!isset($_GET["i"]) || empty($_GET["i"])) {
		$_GET["i"] = 0;
	}
	$object_product = new product();
	$product_list = $object_product->returnProducts(sprintf("WHERE category_id = %s ORDER BY %s ASC", intval($_GET["i"]), 'title_1'));
?>
<div class="product-list">
	<div class="button-area">
		<select id="category" onchange="teste(this);">
			<option>Seleccionar uma categoria</option>
			<?php
				$object_category = new category();
				$category_list = $object_category->returnCategories(sprintf("WHERE category_type = '%s' ORDER BY %s ASC", $configuration['category_sections'][0], 'name_1'));

				foreach($category_list as $category){
					printf('<option value="%s">%s</option>', $category['id'], $category['name_1']);
				}
			?>

		</select>
		<button onclick="goTo('./backoffice.php?pg=product-add');" class="green"><?php print $language["template"]["add"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','product-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','product-del');" class="red"><?php print $language["template"]["del"] ?></button>
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
			$object_category->setId($product['category_id']);
			$category = $object_category->returnOneCategory();

			if ($product['published']) {
				$published = '<img src="./site-assets/images/icon_on.png" alt="on" />';
			} else {
				$published = '<img src="./site-assets/images/icon_off.png" alt="off" />';
			}

			print
			'<tr>'.
				'<td>'.$product['id'].'</td>'.
				'<td>'.$product['title_1'].'</td>'.
				'<td>'.$category['name_1'].'</td>'.
				'<td>'.$published.'</td>'.
				'<td><input type="radio" name="product" value="'.$product['id'].'"/></td>'.
			'</tr>';

			  $i_last = $product['id'];
		  }

	  ?>
	</table>
	<div class="button-area">
		<button onclick="goTo('./backoffice.php?pg=product-add');" class="green"><?php print $language["template"]["add"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','product-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','product-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>
</div>

