<?php
	$object_category = new category();
	$category_list = $object_category->returnAllCategories();
?>
<h1 class="pageTitle">Category List</h1>
<div class="category-list">
	<div class="button-area">
            <a href="<?php print $configuration["path-bo"] ?>/0/category-add/" class="green"><i class="fa fa-plus"></i></a>	
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
				if ($category['published']) {$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_on.png" alt="on" />';}
					else {$published = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_off.png" alt="off" />';}
				print
				'<tr>'.
				'<td>'.$category['id'].'</td>'.
				'<td>'.$category['name_1'].'</td>'.
				'<td>'.$category['category_type'].'</td>'.
				'<td>'.$published.'</td>'.
				'<td><a href="'.$configuration["path-bo"].'/0/category-edit/'.$category['id'].'" onclick="return confirm(\''.$language["template"]["are-you-sure"].'\')" class="orange"><i class="fa fa-pencil-square-o"></i></a> <a href="'.$configuration["path-bo"].'/0/category-del/'.$category['id'].'" onclick="return confirm(\''.$language["template"]["are-you-sure"].'\')" class="red"><i class="fa fa-trash"></i></a></td>'.
				'</tr>';

			}
		?>
	</table>

	<div class="button-area">
            <a href="<?php print $configuration["path-bo"] ?>/0/category-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
</div>
