<?php
	if (isset($_REQUEST['i']) && !empty($_REQUEST['i'])) {
		$object_article = new article();
		$object_article->setId($_REQUEST['i']);
		if($object_article->delete()) print 'sucess'; else print 'error';
	}else{
		print 'error';
	}
?>
