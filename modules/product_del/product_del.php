<h1 class="pageTitle">Product Del</h1>
<?php
	if(isset($_GET['i']) && !empty($_GET['i'])){
		$product = new product();
		$product->setId($_REQUEST['i']);
		if($product->delete()) print 'sucess'; else print 'error';
	}else{
		print 'error';
	}
?>
