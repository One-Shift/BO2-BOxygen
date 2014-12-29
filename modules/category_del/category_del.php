<h1 class="pageTitle">Category Del</h1>
<?php
	if($id !== null){
		$object_category = new category();
		$object_category->setId($id);

		if ($object_category->delete()) {
			print $language["actions"]["success"];
		} else {
			print $language["actions"]["failure"];
		}
	}else{
		print $language["actions"]["error"];
	}
