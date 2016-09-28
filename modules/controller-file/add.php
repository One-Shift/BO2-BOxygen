<div class="vcard-edit">

		<h1 class="pageTitle">Add File</h1>
        <div class="spacer30"></div>
		<?php if (!isset($_POST["save"])) { ?>
		<form method="post">
            <!-- -->
            <div>
        		<span id="label">File</span>
        		<input type="text" name="file" placeholder="name_of_file.jpg or other_file.doc"/>
        	</div>
            <div>
        		<span id="label">Description</span>
        		<input type="text" name="description" required="" />
        	</div>
            <div>
        		<span id="label">Code</span>
        		<textarea name="code" > </textarea>
        	</div>
            <div>
        		<span id="label">Ordering</span>
        		<input type="text" name="ordering" value="<?= $file["ordering"] ?>" />
        	</div>
            <div class="spacer15"></div>
            <div>
        		<span id="label">ID Association</span>
        		<input type="text" name="id_ass" required="" />
        	</div>
            <div class="spacer15"></div>
            <div>
        		<span id="label">Type</span>
                <select class="" name="type" required="">
                    <option value="">Choose One</option>
                    <option value="image">Image (jpg, png, gif)</option>
                    <option value="document">Document (doc, pdf, zip, others)</option>
                </select>
        	</div>
            <div class="spacer15"></div>
            <div>
        		<span id="label">Module</span>
                <select class="" name="module" required="">
                    <option value="">Choose One</option>
                    <option value="article">Article</option>
                    <option value="product">Product</option>
                    <option value="user">User</option>
                </select>
        	</div>
    		<div class="bottom-area">
                </br>
                </br>
                <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
                <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
    		</div>
		</form>
<?php
	} else {
		$file = new file();

		$file->setId($id);
		$file->setFile($_POST["file"]);
        $file->setDescription($_POST["description"]);
        $file->setCode($_POST["code"]);
        $file->setOrdering($_POST["ordering"]);
        $file->setIdAss($_POST["id_ass"]);

        $file->setType($_POST["type"]);
        $file->setModule($_POST["module"]);
        $file->setUserId($authData["id"]);
        $file->setDate();

		if ($file->insert()) {
			print $language["actions"]["success"];
		} else {
			print $language["actions"]["failure"];
		}
	}
?>
</div>
