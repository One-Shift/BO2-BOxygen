<script>
	function otherCategory(variable) {
		goTo('<?php print $configuration["path-bo"] ?>/0/product-list/' + $(variable).val());
	}
</script>
<?php
	if(!isset($_GET["i"]) || empty($_GET["i"])) {
		$_GET["i"] = 0;
	}
	$object_product = new product();
	$product_list = $object_product->returnProducts(sprintf("WHERE category_id = %s ORDER BY %s ASC", intval($_GET["i"]), 'title_1'));
?>
<h1 class="pageTitle">Product List</h1>
<div class="product-list">
	<div class="button-area">
		<select id="category" onchange="otherCategory(this);">
			<option>Seleccionar uma categoria</option>
			<?php
				$object_category = new category();
				$category_list = $object_category->returnCategories(sprintf("WHERE category_type = '%s' ORDER BY %s ASC", $configuration['category_sections'][0], 'name_1'));

				foreach($category_list as $category){
					printf('<option value="%s">%s</option>', $category['id'], $category['name_1']);
				}
			?>

		</select>
		<a href="<?php print $configuration["path-bo"] ?>/0/product-add" class="green"><i class="fa fa-plus"></i></a>
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
				$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_on.png" alt="on" />';
			} else {
				$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_off.png" alt="off" />';
			}

			print
			'<tr>'.
				'<td>'.$product['id'].'</td>'.
				'<td>'.$product['title_1'].'</td>'.
				'<td>'.$category['name_1'].'</td>'.
				'<td>'.$published.'</td>'.
				'<td><a href="'.$configuration["path-bo"].'/0/product-edit/'.$product['id'].'" onclick="return confirm(\''.$language["template"]["are-you-sure"].'\')" class="orange"><i class="fa fa-pencil-square-o"></i></a> <a href="'.$configuration["path-bo"].'/0/product-del/'.$product['id'].'" onclick="return confirm(\''.$language["template"]["are-you-sure"].'\')" class="red"><i class="fa fa-trash"></i></a></td>'.
			'</tr>';

			  $i_last = $product['id'];
		  }

	  ?>
	</table>
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/product-add" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>

