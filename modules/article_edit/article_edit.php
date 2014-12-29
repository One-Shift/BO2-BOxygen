<div class="article-add">
	<?php if($id !== null){ ?>
		
		<h1 class="pageTitle">Edit Article</h1>
		<?php if (!isset($_POST["save"])) { ?>
		<form method="post">
		<?php
		$object_article = new article();
		$object_article->setId($id);
		$article = $object_article->returnOneArticle();
		?>
		<div class="separator30"></div>

		<div <?php if (!$configuration["lang_1_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 1</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_1" value="<?= $article["title_1"] ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_1",$article["content_1"]) ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration["lang_2_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 2</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_2" value="<?php print $article["title_2"]; ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_2", $article["content_2"]) ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration["lang_3_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 3</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_3" value="<?php print $article["title_3"]; ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_3", $article["content_3"]) ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration["lang_4_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 4</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_4" value="<?= $article["title_4"]; ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_4", $article["content_4"]) ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration["lang_5_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 5</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_5" value="<?= $article["title_5"] ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_5", $article["content_5"]) ?>

			<div class="separator30"></div>
		</div>

		<div <?php if (!$configuration["lang_6_state"]) {print "style=\"display: none;\"";} ?>>
			<h2>Lingua 6</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_6" value="<?= $article["title_6"] ?>"/>
			<span id="label">Conteudo</span>
			<?= returnEditor("content_6", $article["content_6"]) ?>

			<div class="separator30"></div>
		</div>

		<div>
			<span id="label">Data</span>
			<input type="date" name="date_update" value="<?= $article["date_update"] ?>"/>

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
				if ($cat["category_type"] == "articles") {
					if($article["category_id"] == $cat["id"]) {$selected = "SELECTED";} else {$selected = null;}
					printf("<option %s value=\"%s\">%s</option>", $selected, $cat["id"], $cat["name_1"]);
				}
			}
		?>
		</select>

		<div class="separator30"></div>

		<span id="label">Lista de ficheiros</span>
		<?= returnFilesList($article["id"], "article"); ?>

		<div class="separator30"></div>

		<?php
			print returnImgUploader("IMG Uploader", $article["id"], "article", 290, 350);
			print " ";
			print returnDocsUploader("DOCS Uploader", $article["id"], "article", 290, 350);
		?>

		<?php unset($category); ?>
		<div class="separator30"></div>

		<div>
		<span id="label">Code</span>
		<textarea name="code"><?= $article["code"]; ?></textarea>
		<div class="separator30"></div>
		</div>

		<div class="bottom-area">
		  <input type="checkbox" <?php if ($article["published"]) { print "checked=\"yes\"";} ?> name="published"/> Publicado
		  </br>
		  <input type="checkbox" <?php if ($article["onhome"]) { print "checked=\"yes\"";} ?>  name="onhome"/> Pagina Inicial
		  </br>
		  <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
		  <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
		</div>

		</form>
<?php 
		} else {
			$article = new article();
			$article->setId($id);
			if (isset($_POST["published"])) $_POST["published"] = true; else $_POST["published"] = false;
			if (isset($_POST["onhome"])) $_POST["onhome"] = true; else $_POST["onhome"] = false;


			$article->setContent(
				$_POST["title_1"], $_POST["content_1"],
				$_POST["title_2"], $_POST["content_2"],
				$_POST["title_3"], $_POST["content_3"],
				$_POST["title_4"], $_POST["content_4"],
				$_POST["title_5"], $_POST["content_5"],
				$_POST["title_6"], $_POST["content_6"],
				$_POST["code"]
			);
			$article->setCategory($_POST["category"]);
			$article->setDateUpdate($_POST["date_update"]);
			$article->setPublished($_POST["published"]);
			$article->setonHome($_POST["onhome"]);

			if ($article->update()) {
				print $language["actions"]["success"];
			} else {
				print $language["actions"]["failure"];
			}
		}
	} else {
		print $language["actions"]["error"];
	}
?>
</div>
