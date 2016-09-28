<div class="product-edit">
	<?php if($id !== null){ ?>
		<h1 class="pageTitle"><?= $language["mod_product"]["edit_title"]; ?></h1>
		<?php if (!isset($_POST["save"])) {
			$product = new product();
			$product->setId($id);
			$item = $product->returnOneProduct();
		?>
		<form action="" method="post">
			<div <?php if (!$configuration["lang_1_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_1_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_1" value="<?= $item["title_1"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_1", $item["content_1"]); ?>
				<div class="spacer30"></div>
			</div>
			<div <?php if (!$configuration["lang_2_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_2_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_2" value="<?= $item["title_2"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_2", $item["content_2"]); ?>
				<div class="spacer30"></div>
			</div>
			<div <?php if (!$configuration["lang_3_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_3_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_3" value="<?= $item["title_3"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_3", $item["content_3"]); ?>
				<div class="spacer30"></div>
			</div>
			<div <?php if (!$configuration["lang_4_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_4_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_4" value="<?= $item["title_4"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_4", $item["content_4"]); ?>
				<div class="spacer30"></div>
			</div>
			<div <?php if (!$configuration["lang_5_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_5_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_5" value="<?= $item["title_5"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_5", $item["content_5"]); ?>
				<div class="spacer30"></div>
			</div>
			<div <?php if (!$configuration["lang_6_state"]) {echo "style=\"display: none;\"";} ?>>
				<h2 class="sectionTitle"><?= $configuration["lang_6_name"] ?></h2>
				<span id="label"><?= $language["form"]["label_product"]; ?></span>
				<input type="text" name="title_6" value="<?= $item["title_6"] ?>"/>
				<span id="label"><?= $language["form"]["label_description"]; ?></span>
				<?= returnEditor("content_6", $item["content_6"]); ?>
				<div class="spacer30"></div>
			</div>

			<span id="label"><?= $language["form"]["label_category"]; ?></span>
			<select name="category">
				<option value="null"><?= $language["form"]["label_category_sel"]; ?></option>
			<?php
				$category = new category();

				foreach($category->returnAllCategories() as $cat) {
					$selected = null;
					if ($cat["id"] === $item["category_id"]) {
						$selected = "selected=\"\"";
					}

					if ($cat["category_type"] === "products") {
						printf("<option value=\"%s\" %s>%s</option>", $cat["id"], $selected, $cat["name_1"]);
					}
				}
			?>
			</select>

			<div class="spacer30"></div>

			<span id="label"><?= $language["form"]["label_file_list"]; ?></span>
			<?= returnFilesList($item["id"],"product"); ?>

			<div class="spacer30"></div>

			<?php
				print returnImgUploader("IMG Uploader",$item["id"],"product","290",350);
				print " ";
				print returnDocsUploader("DOCS Uploader",$item["id"],"product","290",350);
			?>

			<div class="spacer30"></div>
			<div>
				<span id="label"><?= $language["form"]["label_code"]; ?></span>
				<textarea name="code"><?= $item["code"]; ?></textarea>
				<button id="code_spr" type="button">[spr]</button> <button id="code_slash" type="button">[/]</button>
				<div class="spacer30"></div>
			</div>
			<div>
				<span id="label"><?= $language["form"]["label_reference"]; ?></span>
				<input type="text" name="reference" value="<?= $item["reference"] ?>" />
				<div class="spacer30"></div>
			</div>

			<div style="<?= (!$configuration["store"]) ? "display:none" : null ?>">
				<span id="label"><?= $language["form"]["label_price"]; ?></span>
				<input type="number" step="any" placeholder="ex.: 1.23" name="price" value="<?= $item["price"]; ?>" />
				<div class="spacer30"></div>
			</div>

			<div style="<?= (!$configuration["store"]) ? "display:none" : null ?>">
				<span id="label"><?= $language["form"]["label_vat"]; ?></span>
				<input type="number" step="any" placeholder="ex.: 23.0" name="vat" value="<?= $item["vat"]; ?>" />
				<div class="spacer30"></div>
			</div>

			<div style="<?= (!$configuration["store"]) ? "display:none" : null ?>">
				<span id="label"><?= $language["form"]["label_discount"]; ?></span>
				<input type="number" step="any" placeholder="ex.: 1.10" name="discount" value="<?= $item["discount"]; ?>"/>
				<div class="spacer30"></div>
			</div>

			<div>
		<span id="label"><?= $language["form"]["label_date"]; ?></span>
		<input type="text" name="date" value="<?= $item["date"]; ?>"/>

		<div class="spacer30"></div>
	</div>

	<div>
		<span id="label"><?= $language["form"]["label_order"]; ?></span>
		<input type="text" name="order" value="<?= $item["ordering"]; ?>"/>

		<div class="spacer30"></div>
	</div>

			<div class="bottom-area">
				<label><input type="checkbox" <?php if ($item["service"]) { print "checked=\"yes\"";} ?> name="service" /> <?= $language["form"]["label_service"]; ?></label>
				<br />
				<label><input type="checkbox" <?php if ($item["published"]) { print "checked=\"yes\"";} ?> name="published" /> <?= $language["form"]["label_published"]; ?></label>
				<br />
				<label><input type="checkbox" <?php if ($item["onhome"]) { print "checked=\"yes\"";} ?>  name="onhome" /> <?= $language["form"]["label_on_home"]; ?></label>

				<div class="spacer30"></div>

				<button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
				<button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
			</div>
		</form>
		<?php

		} else {
			$product = new product();
			$product->setId($id);

			// convert to bool the service box
			if (isset($_POST["service"])) {
				$service = true;
			} else {
				$service = false;
			}
			// convert to bool the published box
			if (isset($_POST["published"])) {
				$published = true;
			} else {
				$published = false;
			}
			// convert to bool the onhome box
			if (isset($_POST["onhome"])) {
				$onhome = true;
			} else {
				$onhome = false;
			}

			$product->setContent(
				$_POST["title_1"], $_POST["content_1"],
				$_POST["title_2"], $_POST["content_2"],
				$_POST["title_3"], $_POST["content_3"],
				$_POST["title_4"], $_POST["content_4"],
				$_POST["title_5"], $_POST["content_5"],
				$_POST["title_6"], $_POST["content_6"],
				$_POST["code"]
			);

			$product->setReference($_POST["reference"]);
			$product->setPrice($_POST["price"]);
			$product->setVAT($_POST["vat"]);
			$product->setDiscount($_POST["discount"]);

			$product->setCategory($_POST["category"]);
			$product->setDate($_POST["date"]);
			$product->setDateUpdate(date("Y-m-d H:i:s", time()));
			$product->setService($service);
			$product->setPublished($published);
			$product->setonHome($onhome);
			$product->setOrdering($_POST["order"]);

			if ($product->update()) {
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
