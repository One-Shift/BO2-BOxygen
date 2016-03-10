<div class="vcard-edit">
	<?php if($id !== null) { ?>

		<h1 class="pageTitle"><?= $language["mod_files"]["edit_title"]; ?></h1>
		<?php if (!isset($_POST["save"])) { ?>
		<form method="post">
		<?php
		$object_file = new file();
		$object_file->setId($id);
		$file = $object_file->returnOneFile();

		if ($configuration["restricted"] && $account["name"] != $file["user_id"]) {
			print $language["actions"]["failure"];
		} else {
		?>
		<div class="spacer30"></div>

        <!-- -->
        <div>
            <center>
                <a href="<?= $configuration["path"]?>/u-files/<?= $file["file"] ?>" target="_blank">Open File</a>
            </center>
            <br>
            <br>
        </div>
        <div>
    		<span id="label">File</span>
    		<input type="text" name="file" value="<?= $file["file"] ?>" readonly="" />
    	</div>
        <div>
    		<span id="label">Description</span>
    		<input type="text" name="description" value="<?= $file["description"] ?>" />
    	</div>
        <div>
    		<span id="label">Code</span>
    		<textarea name="code" ><?= $file["code"] ?></textarea>
    	</div>
        <div>
    		<span id="label">Ordering</span>
    		<input type="text" name="ordering" value="<?= $file["ordering"] ?>" />
    	</div>
        <div>
    		<span id="label">ID Association</span>
    		<input type="text" name="id_ass" value="<?= $file["id_ass"] ?>" />
    	</div>
        <div>
    		<span id="label">Type</span>
    		<input type="text" name="type" value="<?= $file["type"] ?>" readonly="" />
    	</div>
        <div>
    		<span id="label">Module</span>
    		<input type="text" name="module" value="<?= $file["module"] ?>" readonly="" />
    	</div>

		<div class="bottom-area">
            </br>
            </br>
            <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
            <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
		</div>

		</form>
<?php
		}
		} else {
			if (isset($_POST["published"])) $_POST["published"] = true; else $_POST["published"] = false;

			$file = new file();

			$file->setId($id);
            $file->setDescription($_POST["description"]);
            $file->setCode($_POST["code"]);
            $file->setOrdering($_POST["ordering"]);
            $file->setIdAss($_POST["id_ass"]);

			if ($file->update()) {
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
