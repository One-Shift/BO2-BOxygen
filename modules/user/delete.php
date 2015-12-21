<h1 class="pageTitle"><?= $language["mod_user"]["delete_title"]?></h1>
<?php
	if ($id !== null) {
		$user = new user();
		$user->setId($id);
		$user_data = $user->returnOneUser();

		if ($user_data["rank"] !== "owner") {
			if ($user->delete()) {
				print  $language["actions"]["success"];
			} else {
				print  $language["actions"]["failure"];
			}
		} else {
			print $language["mod_user"]["owner_delete_failure"];
		}
	}else{
		print  $language["actions"]["error"];
	}
