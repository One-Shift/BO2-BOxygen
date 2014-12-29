<div class="article-add">
	<h1 class="pageTitle"><?php echo $language["mod-news-add-title"]; ?></h1>
	<?php if (!isset($_POST["save"])) { ?>
	<form action="" method="post">
	<div class="separator30"></div>

	<div <?php if (!$configuration["lang_1_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 1</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_1"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_1"); ?>

		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_2_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 2</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_2"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_2"); ?>

		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_3_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 3</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_3"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_3"); ?>

		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_4_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 4</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_4"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_4"); ?>

		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_5_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 5</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_5"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_5"); ?>

		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_6_state"]) {echo 'style="display: none;"';} ?>>
		<h2 class="sectionTitle">Lingua 6</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_6"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor("content_6"); ?>

		<div class="separator30"></div>
	</div>

	<div>
		<h2 class="sectionTitle">Data</h2>
		<span id="label">Data</span>
		<input type="date" name="date" value="<?php print date("Y-m-d H:i:s"); ?>"/>

		<div class="separator30"></div>
	</div>

	<span id="label">Categoria</span>
	<select name="category">
		<option value="null">Selecione uma Categoria</option>
	<?php
		$category = new category();

		foreach($category->returnAllCategories() as $cat) {
			if ($cat["category_type"] == "articles") {
				printf("<option value=\"%s\">%s</option>", $cat["id"], $cat["name_1"]);
			}
		}
		unset($category);
	?>
	</select>

	<div class="separator30"></div>

	<div>
		<span id="label">Code</span>
		<textarea name="code"></textarea>
		<div class="separator30"></div>
	</div>

	<div class="bottom-area">  
	  <input type="checkbox" name="published" value="1"/> Publicado
	  </br>
	  <input type="checkbox" name="onhome" value="1"/> Pagina Inicial
	  </br>
	  <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
	  <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
	</div>

	</form>
	<?php } else {

		if (isset($_POST["published"])) $_POST["published"] = true; else $_POST["published"] = false;
		if (isset($_POST["onhome"])) $_POST["onhome"] = true; else $_POST["onhome"] = false;

		$article = new article();
		$article->setContent(
			$_POST["title_1"], $_POST["content_1"],
			$_POST["title_2"], $_POST["content_2"],
			$_POST["title_3"], $_POST["content_3"],
			$_POST["title_4"], $_POST["content_4"],
			$_POST["title_5"], $_POST["content_5"],
			$_POST["title_6"], $_POST["content_6"],
			$_POST["code"]
		);
		$article->setUserId($account['name']);
		$article->setCategory($_POST['category']);
		$article->setDate($_POST['date']);
		$article->setDateUpdate($_POST['date']);
		$article->setPublished($_POST['published']);
		$article->setonHome($_POST['onhome']);

		if ($article->insert()) {
			print $language["actions"]["success"];

			$id = $mysqli->insert_id;
	?>
			<div class="separator30"></div>

			<span id="label">Lista de ficheiros</span>
			<?php print returnFilesList($id, "article"); ?>

			<div class="separator30"></div>

			<?php
				print returnImgUploader("IMG Uploader", $id, "article",290,350);
				print " ";
				print returnDocsUploader("DOCS Uploader", $id, "article",290,350);
			?>
	<?php
		} else {
			print $language["actions"]["failure"];
		}
	} ?>
</div>
