<h1 class="pageTitle"><?= $language["mod_article"]["delete_title"]; ?></h1>
<?php
if ($id !== null) {
	$object_article = new article();
	$object_article->setId($id);

	$article = $object_article->returnOneArticle();

	if($configuration["restricted"] && $account["name"] != $article["user_id"]){
		print $language["actions"]["failure"];
	}else{


		if ($object_article->delete()) {
			print $language["actions"]["success"];
		} else {
			print $language["actions"]["failure"];
		}
	}
}else{
	print $language["actions"]["error"];
}
