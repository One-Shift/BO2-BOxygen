<div class="category-add">
	<h1 class="pageTitle"><?= $language["mod_category"]["add_title"]; ?></h1>
	<?php if (!isset($_POST["save"])) { ?>
	<form action="" method="post">

	<div <?php if (!$configuration["lang_1_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_1_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_1"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_1"); ?>
		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_2_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_2_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_2"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_2"); ?>
		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_3_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_3_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_3"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_3"); ?>
		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_4_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_4_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_4"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_4"); ?>
		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_5_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_5_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_5"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_5"); ?>
		<div class="separator30"></div>
	</div>

	<div <?php if (!$configuration["lang_6_state"]) {echo "style=\"display: none;\"";} ?>>
		<h2 class="sectionTitle"><?= $configuration["lang_6_name"] ?></h2>
		<span id="label"><?= $language["form"]["label_category"]; ?></span>
		<input type="text" name="title_6"/>
		<span id="label"><?= $language["form"]["label_description"]; ?></span>
		<?php print returnEditor("content_6"); ?>
		<div class="separator30"></div>
	</div>

	<div>
		<span id="label"><?= $language["form"]["label_section"]; ?></span>
		<select name="section">
		<option value="null"><?= $language["form"]["label_sel_section"]; ?></option>
		<?php
			foreach ($configuration["category_sections"] as $section){
				printf("<option value=\"%s\">%s</option>", $section, $language["sections"][$section]);
			}
		?>
		</select>
		<div class="separator30"></div>
	</div>
	<div>
		<span id="label"><?= $language["form"]["label_date"]; ?></span>
		<input type="text" name="date" value="<?= date("Y-m-d H:i:s"); ?>"/>

		<div class="separator30"></div>
	</div>

	<div>
		<span id="label"><?= $language["form"]["label_order"]; ?></span>
		<input type="text" name="order"/>

		<div class="separator30"></div>
	</div>

	<div>
		<span id="label"><?= $language["form"]["label_code"]; ?></span>
		<textarea name="code"></textarea>
		<div class="separator30"></div>
	</div>

	<div class="bottom-area">
		<input type="checkbox" name="published" value="1"/> <?= $language["form"]["label_published"]; ?>

		<div class="separator30"></div>

		<button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
		<button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
	</div>

	</form>

	<?php
	} else {

		if (isset($_POST["published"])) $_POST["published"] = true; else $_POST["published"] = false;

		$object_category = new category();
		$object_category->setContent(
			$_REQUEST["title_1"],
			$_REQUEST["content_1"],
			$_REQUEST["title_2"],
			$_REQUEST["content_2"],
			$_REQUEST["title_3"],
			$_REQUEST["content_3"],
			$_REQUEST["title_4"],
			$_REQUEST["content_4"],
			$_REQUEST["title_5"],
			$_REQUEST["content_5"],
			$_REQUEST["title_6"],
			$_REQUEST["content_6"],
			$_REQUEST["code"]
		);

		$object_category->setUserId($account["name"]);
		$object_category->setDate($_POST["date"]);
		$object_category->setDateUpdate($_POST["date"]);
		$object_category->setPublished($_POST["published"]);
		$object_category->setCategoryType($_POST["section"]);
		$object_category->setOrdering($_POST['order']);

		if ($object_category->insert()) {
			print $language["actions"]["success"];
			$id = $mysqli->insert_id;
	?>
			<div class="separator30"></div>

			<span id="label"><?= $language["form"]["label_file_list"]; ?></span>
			<?= returnFilesList($id, "category"); ?>

			<div class="separator30"></div>

			<?php
				print returnImgUploader("IMG Uploader", $id, "category",290,350);
				print " ";
				print returnDocsUploader("DOCS Uploader", $id, "category",290,350);
			?>
	<?php
		} else {
			print $language["actions"]["failure"];
		}
	}
	?>
</div>
