<?php
	$object_user = new user();
	$user_list = $object_user->returnAllUsers();
?>
<h1 class="pageTitle">User List</h1>
<div class="user-list">
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/user-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>
    
	<table class="db-list">
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Rank</th>
			<th>Sel.</th>
		</tr>
		<?php
			foreach($user_list as $user){
				print str_replace(
					array(
						"{c2r-id}",
						"{c2r-name}",
						"{c2r-email}",
						"{c2r-rank}",
						"{c2r-path-bo}",
						"{c2r-confirm}"
					),
					array(
						$user["id"],
						$user["name"],
						$user["email"],
						$user["rank"],
						$configuration["path-bo"],
						$language["template"]["areyousure"]
					),
					file_get_contents("./modules/user_list/templates-e/line.html")
				);
			}
		?>
	</table>
    
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/user-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>

</div>
