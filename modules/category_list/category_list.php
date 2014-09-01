<?php
	$object_category = new category();
	$category_list = $object_category->returnAllCategories();
?>
<div class="category-list">
	<div class="button-area">
		<button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["add"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','category-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','category-del');" class="red"><?php print $language["template"]["del"] ?></button>
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
			foreach($category_list as $category){
				if ($category['published']) {$published = '<img src="./site-assets/images/icon_on.png" alt="on" />';}
					else {$published = '<img src="./site-assets/images/icon_off.png" alt="off" />';}
				print
				'<tr>'.
				'<td>'.$category['id'].'</td>'.
				'<td>'.$category['name_1'].'</td>'.
				'<td>'.$category['category_type'].'</td>'.
				'<td>'.$published.'</td>'.
				'<td><input type="radio" name="category" value="'.$category['id'].'"/></td>'.
				'</tr>';

			}
		?>
	</table>

	<div class="button-area">
		<button onclick="goTo('./backoffice.php?pg=category-add');" class="green"><?php print $language["template"]["add"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','category-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('<?php print $language["template"]["are-you-sure"]; ?>','category-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>
</div>
