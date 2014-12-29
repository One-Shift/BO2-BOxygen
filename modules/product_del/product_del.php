<h1 class="pageTitle">Product Del</h1>
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
