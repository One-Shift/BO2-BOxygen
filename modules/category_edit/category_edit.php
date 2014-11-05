<div class="category-add">
<?php 
	if(isset($_GET['i']) && !empty($_GET['i'])){
?>
		<h1 class="pageTitle"><?php echo $language["mod-category-edit-title"]; ?></h1>
		<?php if (!isset($_POST['save'])) {
			$object_category = new category();
			$object_category->setId(intval($_GET['i']));
			$category = $object_category->returnOneCategory();
		?>
		<form action="" method="post">
			<div class="separator30"></div>

			<div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 1</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_1" value="<?php print $category['name_1']; ?>" />
				<span id="label">Descrição</span>
				<?php print returnEditor('description_1',$category['description_1']); ?>
				<div class="separator30"></div>
			</div>
			<div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 2</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_2" value="<?php print $category['name_2']; ?>"/>
				<span id="label">Descrição</span>
				<?php print returnEditor('description_2',$category['description_2']); ?>
				<div class="separator30"></div>
			</div>
			<div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 3</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_3" value="<?php print $category['name_3']; ?>"/>
				<span id="label">Descrição</span>
				<?php print returnEditor('description_3',$category['description_3']); ?>
				<div class="separator30"></div>
			</div>
			<div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 4</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_4" value="<?php print $category['name_4']; ?>"/>
				<span id="label">Descrição</span>
				<?php print returnEditor('description_4',$category['description_4']); ?>
				<div class="separator30"></div>
			</div>
			<div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 5</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_5" value="<?php print $category['name_5']; ?>"/>
				<span id="label">Descrição</span>
				<?php print returnEditor('description_5',$category['description_5']); ?>
				<div class="separator30"></div>
			</div>
			<div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
				<h2>Lingua 6</h2>
				<span id="label">Categoria</span>
				<input type="text" name="title_6" value="<?php print $category['name_6']; ?>"/>
				<span id="label">Descrição</span>
				<?php print returnEditor('description_6',$category['description_6']); ?>
				<div class="separator30"></div>
			</div>
			<div>
				<span id="label">Tipo</span>
				<select name="category_type">
				<option value="null">Selecione uma Type</option>
				<?php
					foreach($configuration['category_sections'] as $category_type){
						if($category['category_type'] == $category_type) {$selected = 'SELECTED';} else {$selected = null;}
						print '<option '.$selected.' value="'.$category_type.'">'.$category_type.'</option>';
						unset($category_type);
					}
				?>
				</select>

				<div class="separator30"></div>
			</div>

			<span id="label">Lista de ficheiros</span>
			<?php print returnFilesList($category['id'],'category'); ?>

			<div class="separator30"></div>

			<?php
				print returnImgUploader('IMG Uploader',$category['id'],'category','290',350);
				print ' ';
				print returnDocsUploader('DOCS Uploader',$category['id'],'category','290',350);
			?>


			<div class="separator30"></div>

			<div>
				<span id="label">Code</span>
				<textarea name="code"><?php print $category['code']; ?></textarea>
				<div class="separator30"></div>
			</div>

			<div class="bottom-area">
			  <input type="checkbox" <?php if($category['published']){ print 'checked="yes"';} ?> name="published"/> Publicado
			  </br>
			  <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
			  <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
			</div>
		</form>
        
<?php
		} else {
			if (isset($_POST['published'])) {
				$_POST['published'] = true;
			} else {
				$_POST['published'] = false;
			}

			$category = new category();
			$category->setId(intval($_GET['i']));
			$category->setContent(
				$_POST['title_1'],
				$_POST['description_1'],
				$_POST['title_2'],
				$_POST['description_2'],
				$_POST['title_3'],
				$_POST['description_3'],
				$_POST['title_4'],
				$_POST['description_4'],
				$_POST['title_5'],
				$_POST['description_5'],
				$_POST['title_6'],
				$_POST['description_6'],
				$_POST['code']
				);
			$category->setUserId($account["name"]);
			$category->setDateUpdate();
			$category->setPublished($_POST['published']);
			$category->setCategoryType($_POST['category_type']);

			if ($category->update()) {
				print 'sucess';
			} else {
				print 'failure';
			}
		}
	} else {
		print 'error';
	}
?>
</div>
