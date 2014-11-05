<h1 class="pageTitle">Article Del</h1>
<?php
	if (isset($_GET['i']) && !empty($_GET['i'])) {
		$object_article = new article();
		$object_article->setId($_REQUEST['i']);
		if($object_article->delete()) print $language["actions"]["success"]; else print $language["actions"]["failure"];
	}else{
		print $language["actions"]["error"];
	}
