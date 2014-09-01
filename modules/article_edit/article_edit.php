<div class="article-add">
	<?php if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){ ?>
		<h1>Edit Article</h1>
		<?php if (!isset($_REQUEST['save'])) { ?>
		<form method="post">
		<?php
		$object_article = new article();
		$object_article->setId(intval($_REQUEST['i']));
		$article = $object_article->returnOneArticle();
		?>
		<div class="separator30"></div>

		<div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 1</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_1" value="<?php print $article['title_1']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_1',$article['content_1']); ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 2</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_2" value="<?php print $article['title_2']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_2',$article['content_2']); ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 3</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_3" value="<?php print $article['title_3']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_3',$article['content_3']); ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 4</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_4" value="<?php print $article['title_4']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_4',$article['content_4']); ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 5</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_5" value="<?php print $article['title_5']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_5',$article['content_5']); ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
			<h2>Lingua 6</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_6" value="<?php print $article['title_6']; ?>"/>
			<span id="label">Conteudo</span>
			<?php print returnEditor('content_6',$article['content_6']); ?>

			<div class="separator30"></div>
		</div>

		<span id="label">Categoria</span>
		<?php

		?>

		<select name="category">
			<option value="null">Selecione uma Categoria</option>
		<?php
			$category = new category();

			foreach($category->returnAllCategories() as $cat) {
				if ($cat['category_type'] == 'articles') {
					if($article['category_id'] == $cat['id']) {$selected = 'SELECTED';} else {$selected = null;}
					print '<option '.$selected.' value="'.$cat['id'].'">'.$cat['name_1'].'</option>';
				}
			}
		?>
		</select>

		<div class="separator30"></div>

		<span id="label">Lista de ficheiros</span>
		<?php print returnFilesList($article['id'],'article'); ?>

		<div class="separator30"></div>

		<?php
			print returnImgUploader('IMG Uploader',$article['id'],'article','290',350);
			print ' ';
			print returnDocsUploader('DOCS Uploader',$article['id'],'article','290',350);
		?>

		<?php unset($category); ?>
		<div class="separator30"></div>

		<div>
		<span id="label">Code</span>
		<textarea name="code"><?php print $article['code']; ?></textarea>
		<div class="separator30"></div>
		</div>

		<div class="bottom-area">
		  <input type="checkbox" <?php if($article['published']){ print 'checked="yes"';} ?> name="published"/> Publicado
		  </br>
		  <input type="checkbox" <?php if($article['onhome']){ print 'checked="yes"';} ?>  name="onhome"/> Pagina Inicial
		  </br>
		  <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
		  <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
		</div>

		</form>
<?php 
		} else {
			$article = new article();
			$article->setId(intval($_REQUEST['i']));
			if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
			if (isset($_REQUEST['onhome'])) $_REQUEST['onhome'] = true; else $_REQUEST['onhome'] = false;


			$article->setContent(
				$_REQUEST['title_1'], $_REQUEST['content_1'],
				$_REQUEST['title_2'], $_REQUEST['content_2'],
				$_REQUEST['title_3'], $_REQUEST['content_3'],
				$_REQUEST['title_4'], $_REQUEST['content_4'],
				$_REQUEST['title_5'], $_REQUEST['content_5'],
				$_REQUEST['title_6'], $_REQUEST['content_6'],
				$_REQUEST['code']
			);
			$article->setCategory($_REQUEST['category']);
			$article->setDateUpdate();
			$article->setPublished($_REQUEST['published']);
			$article->setonHome($_REQUEST['onhome']);

			if ($article->update()) {
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
