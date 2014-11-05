<h1 class="pageTitle"><?php echo $language["mod-user-add-title"]; ?></h1>
	<?php
	if (!isset($_POST['save'])) {
	?>
	<form method="post">
		<span id="label">Rank</span>
		<select name="rank">
			<option value="null">Selecione um rank de utilizador</option>
			<option value="manager">Mananger</option>
			<option value="member">Member</option>
		</select>
		<span id="label">Nome</span>
		<input type="text" name="username" />
		<span id="label">E-Mail</span>
		<input type="email" name="email" />
		<span id="label">Password</span>
		<input type="password" name="password" />
		<span id="label">Confirme a password</span>
		<input type="password" name="confirm_password" />

		<div class="bottom-area">
			  <button class="green" title="save" type="submit" name="save" onclick="if ($('input[name=password]').val() == $('input[name=confirm_password]').val() && $('input[name=password]').val() != '' && $('input[name=confirm_password]').val() != '') {return true;} else {alert('Passowrds não coincidem!'); return false;}"><i class="fa fa-floppy-o"></i></button>
			  <button class="red" title="cancel" type="reset" name="cancel"><i class="fa fa-times"></i></button>
		</div>
	</form>
	<?php
	}else{
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$user = new user();
			$user->setUsername($_POST['username']);
			$user->setPassword($_POST['password']);
			$user->setEmail($_POST['email']);
			$user->setRank($_POST['rank']);

			if($user->existUserByName() == 0){
				if($user->insert()){
					print 'sucess';
				} else {
					print 'failure';
				}
			}else{
				print 'O username ja existe';
			}
		} else {
			print'Email invalido';
			print'<script type="text/javascript">setTimeout(goBack(),2000);</script>';
		}
	}
