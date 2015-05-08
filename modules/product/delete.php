<h1 class="pageTitle"><?= $language["mod_product"]["delete_title"]?></h1>
<?php
	if($id !== null){
		$product = new product();
		$product->setId($id);

		if ($product->delete()) {
			print  $language["actions"]["success"];
		} else {
			print  $language["actions"]["failure"];
		}
	}else{
		print  $language["actions"]["error"];
	}
