<h1 class="pageTitle">User Del</h1>
<?php
	if ($id !== null) {
		$user = new user();
		$user->setId($id);

		if ($user->delete()) {
			print  $language["actions"]["success"];
		} else {
			print  $language["actions"]["failure"];
		}
	}else{
		print  $language["actions"]["error"];
	}
