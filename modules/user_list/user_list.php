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
				print
				'<tr>'.
				'<td>'.$user['id'].'</td>'.
				'<td>'.$user['name'].'</td>'.
				'<td>'.$user['email'].'</td>'.
				'<td>'.$user['rank'].'</td>'.
				'<td><a  class="orange" href="'.$configuration["path-bo"].'/0/user-edit/'.$user['id'].'" title="edit"><i class="fa fa-pencil-square-o"></i></a> <a  class="red" href="'.$configuration["path-bo"].'/0/user-edit/'.$user['id'].'" title="delete"><i class="fa fa-trash"></i></a>
</td>'.
				'</tr>';
			}
		?>
	</table>
    
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/user-add/" class="green"><i class="fa fa-plus"></i></a>
	</div>

</div>
