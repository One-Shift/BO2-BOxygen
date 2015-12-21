<h1 class="pageTitle"><?= $language["mod_files"]["delete_title"]; ?></h1>
<?php
if ($id !== null) {
	$object_file = new file();
	$object_file->setId($id);
    $file = $object_file->returnFiles(1);
    $file = $file[0];

	if ($object_file->delete()) {
        unlink("../u-files/".$file["file"]);
		print $language["actions"]["success"];
	} else {
		print $language["actions"]["failure"];
	}
}else{
	print $language["actions"]["error"];
}
