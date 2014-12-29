<?php if ($id !== null) { ?>
<h1 class="pageTitle"><?= $language["mod_user"]["edit-title"]; ?></h1>
	<?php
		if (!isset($_POST["save"])) {
			$user_edit= new user();
			$user_edit->setId($id);
			$tmp = $user_edit->returnOneUser();
	?>
	<form method="post">
		<span id="label">Rank</span>
		<select name="rank">
			<option value="null">Selecione um rank de utilizador</option>
			<option value="owner" <?php if($tmp["rank"] == "owner") print "SELECTED";?> >Owner</option>
			<option value="manager" <?php if($tmp["rank"] == "manager") print "SELECTED";?> >Manager</option>
			<option value="member" <?php if($tmp["rank"] == "member") print "SELECTED";?> >Member</option>
		</select>
		<span id="label">Nome</span>
		<input type="text" name="username" readonly="readonly" value="<?= $tmp["name"]; ?>"/>
		<span id="label">E-Mail</span>
		<input type="email" name="email" value="<?= $tmp["email"]; ?>"/>
		<span id="label">Password</span>
		<input type="password" name="password"/>
		<span id="label">Confirme a password</span>
		<input type="password" name="confirm_password"/>

		<div class="separator30"></div>

		<span id="label">Lista de ficheiros</span>
		<?= returnFilesList($id, "user"); ?>

		<div class="separator30"></div>

		<?php
			print returnImgUploader("IMG Uploader", $id, "user", 290, 350);
			print " ";
			print returnDocsUploader("DOCS Uploader", $id, "user", 290, 350);
		?>
		<div class="separator30"></div>

		<div class="bottom-area">
			<button class="green" title="save" type="submit" name="save" onclick="if ($('input[name=password]').val() != '') {if ($('input[name=password]').val() == $('input[name=confirm_password]').val()) {return true;} else {alert('Passowrds não coincidem!'); return false;}} else {return true;}"><i class="fa fa-floppy-o"></i></button>
			<button class="red" title="cancel" type="reset" name="cancel"><i class="fa fa-times"></i></button>
		</div>
	</form>
	<?php

	} else {

		if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$user = new user();
			$user->setId($id);
			$tmp = $user->returnOneUser();
			$user->setUsername($tmp["name"]);

			if (!empty($_POST["password"]) || !empty($_POST["confirm_password"])) { // verificar se pelo menos um dos campos foi preenchido
				if ($_POST["password"] == $_POST["confirm_password"]){
					$user->setPassword($_POST["password"]);
				} else {
					print "Passwords erradas";
				}

			} else if (empty($_POST["password"]) && empty($_POST["confirm_password"])) { // verificar se ambos os campos estão vazios
				$user->setOldPassword($tmp["password"]);
			} else {
				print "ola";
			}

			$user->setEmail($_POST["email"]);
			$user->setRank($_POST["rank"]);

			if ($user->update()) {
				print $language["actions"]["success"];
			} else {
				print $language["actions"]["failure"];
			}
		} else {
			print "Email invalido";
			print"<script type=\"text/javascript\">setTimeout(goBack(),2000);</script>";
		}
	}
} else {
	print $language["actions"]["error"];
}
