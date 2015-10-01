<h1 class="pageTitle"><?= $language["mod_vcard"]["delete_title"]; ?></h1>
<?php
if ($id !== null) {
	$object_vcard = new vcard();
	$object_vcard->setId($id);

	if ($object_vcard->delete()) {
		print $language["actions"]["success"];
	} else {
		print $language["actions"]["failure"];
	}
}else{
	print $language["actions"]["error"];
}
