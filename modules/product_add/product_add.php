<div class="product-add">
	<h1 class="pageTitle"><?= $language["mod_product"]["add-title"]; ?></h1>
	<?php
	if (!isset($_POST["save"])) {
	?>
	<form action="" method="post">
		<div <?php if (!$configuration["lang_1_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 1</h2>
			<span id="label">Artigo</span>
			<input type="text" name="title_1"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_1"); ?>
			<div class="separator30"></div>
		</div>
		<div <?php if (!$configuration["lang_2_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 2</h2>
			<span id="label">Artigo</span>
			<input type="text" name="title_2"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_2"); ?>
			<div class="separator30"></div>
		</div>
		<div <?php if (!$configuration["lang_3_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 3</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_3"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_3"); ?>
			<div class="separator30"></div>
		</div>
		<div <?php if (!$configuration["lang_4_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 4</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_4"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_4"); ?>
			<div class="separator30"></div>
		</div>
		<div <?php if (!$configuration["lang_5_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 5</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_5"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_5"); ?>
			<div class="separator30"></div>
		</div>
		<div <?php if (!$configuration["lang_6_state"]) {echo "style=\"display: none;\"";} ?>>
			<h2>Lingua 6</h2>
			<span id="label">Titulo</span>
			<input type="text" name="title_6"/>
			<span id="label">Descrição</span>
			<?= returnEditor("content_6"); ?>
			<div class="separator30"></div>
		</div>

		<span id="label">Categoria</span>
		<select name="category">
			<option value="null">Selecione uma Categoria</option>
		<?php
			$category = new category();

			foreach($category->returnAllCategories() as $cat) {
				if ($cat["category_type"] === "products") {
					printf("<option value=\"%s\">%s</option>", $cat["id"], $cat["name_1"]);
				}
			}
		?>
		</select>

		<div class="separator30"></div>

		<div>
			<span id="label">Code</span>
			<textarea name="code"></textarea>
			<button id="code_spr" type="button">[spr]</button> <button id="code_slash" type="button">[/]</button>
			<div class="separator30"></div>
		</div>
		<div>
			<span id="label">Referencia</span>
			<input type="text" name="reference"/>
			<div class="separator30"></div>
		</div>
		<div>
			<span id="label">Price</span>
			<input type="text" step="any" placeholder="ex.: 1.23" name="price"/>
			<div class="separator30"></div>
		</div>

		<div>
			<span id="label">VAT</span>
			<input type="text" step="any" placeholder="ex.: 23.0" name="vat"/>
			<div class="separator30"></div>
		</div>

		<div>
			<span id="label">Discount</span>
			<input type="text" step="any" placeholder="ex.: 1.10" name="discount"/>
			<div class="separator30"></div>
		</div>

		<div class="bottom-area">
			<input type="checkbox" name="service" /> Serviço
			<br>
			<input type="checkbox" name="published" /> Publicado
			</br>
			<input type="checkbox" name="onhome" /> Pagina Inicial
			</br>
			<button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
			<button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
		</div>
	 </form>
	<?php
	} else {
		// convert to bool the service box
		if (isset($_POST["service"])) {
			$_POST["service"] = true;
		} else {
			$_POST["service"] = false;
		}
		// convert to bool the published box
		if (isset($_POST["published"])) {
			$_POST["published"] = true;
		} else {
			$_POST["published"] = false;
		}
		// convert to bool the onhome box
		if (isset($_POST["onhome"])) {
			$_POST["onhome"] = true;
		} else {
			$_POST["onhome"] = false;
		}

		$product = new product();
		$product->setReference($_POST["reference"]);
		$product->setContent(
			$_POST["title_1"], $_POST["content_1"],
			$_POST["title_2"], $_POST["content_2"],
			$_POST["title_3"], $_POST["content_3"],
			$_POST["title_4"], $_POST["content_4"],
			$_POST["title_5"], $_POST["content_5"],
			$_POST["title_6"], $_POST["content_6"],
			$_POST["code"]
		);

		$product->setService($_POST["service"]);
		$product->setPrice($_POST["price"]);
		$product->setVAT($_POST["vat"]);
		$product->setDiscount($_POST["discount"]);

		$product->setUserId($account["name"]);
		$product->setCategory($_POST["category"]);
		$product->setDate();
		$product->setDateUpdate();
		$product->setPublished($_POST["published"]);
		$product->setonHome($_POST["onhome"]);

		if ($product->insert()) {
			print $language["actions"]["success"];

			$id = $mysqli->insert_id;
	?>
			<div class="separator30"></div>

			<span id="label">Lista de ficheiros</span>
			<?= returnFilesList($id, "product"); ?>

			<div class="separator30"></div>

			<?php
				print returnImgUploader("IMG Uploader", $id, "product", 290, 350);
				print " ";
				print returnDocsUploader("DOCS Uploader", $id, "product", 290, 350);
			?>
	<?php
		} else {
			print $language["actions"]["failure"];
		}
	}
	?>
</div>
