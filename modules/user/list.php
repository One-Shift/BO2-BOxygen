<?php
	$object_user = new user();
	$user_list = $object_user->returnAllUsers();
?>
<h1 class="pageTitle"><?= $language["mod_user"]["list_title"]?></h1>
<div class="user-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/user/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>

	<table class="db-list">
		<tr>
			<th><?= $language["mod_user"]["table_id"]?></th>
			<th><?= $language["mod_user"]["table_name"]?></th>
			<th><?= $language["mod_user"]["table_email"]?></th>
			<th><?= $language["mod_user"]["table_rank"]?></th>
			<th><?= $language["mod_user"]["table_status"]?></th>
			<th><?= $language["mod_user"]["table_sel"]?></th>
		</tr>
		<?php
		if (count($user_list) != 0) {
			foreach($user_list as $user){
				if ($user["status"]) {
					$enable = "<i class=\"fa fa-check-circle\"></i>";
				} else {
					$enable = "<i class=\"fa fa-circle\"></i>";
				}
				print str_replace(
					array(
						"{c2r-id}",
						"{c2r-name}",
						"{c2r-email}",
						"{c2r-rank}",
						"{c2r-status}",
						"{c2r-path-bo}",
						"{c2r-confirm}"
					),
					array(
						$user["id"],
						$user["name"],
						$user["email"],
						$user["rank"],
						$enable,
						$configuration["path-bo"],
						$language["template"]["areyousure"]
					),
					file_get_contents("modules/user/templates-e/line.html")
				);
			}
		}else {
			print str_replace(
					"{c2r-noresults}",
					$language["template"]["noresults"],
					file_get_contents("modules/user/templates-e/line-noresults.html")
				);
		}
		?>
	</table>

	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/user/0/add" class="green"><i class="fa fa-plus"></i></a>
	</div>

</div>
