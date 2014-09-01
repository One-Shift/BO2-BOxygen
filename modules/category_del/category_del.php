<?php
	if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){
		$object_category = new category();
		$object_category->setId($_REQUEST['i']);
		if($object_category->delete()) print 'sucess'; else print 'error';
	}else{
		print 'error';
	}
?>
