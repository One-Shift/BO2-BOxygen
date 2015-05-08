<?php if ($id !== null) { ?>
<h1 class="pageTitle"><?= $language["mod_user"]["edit_title"]; ?></h1>
	<?php
		if (!isset($_POST["save"])) {
			$user_edit= new user();
			$user_edit->setId($id);
			$tmp = $user_edit->returnOneUser();
	?>
	<form method="post">
		<span id="label"><?= $language["form"]["label_rank"]; ?></span>
		<select name="rank">
			<option value="null"><?= $language["form"]["label_rank_sel"]; ?></option>
			<option value="manager" <?php if($tmp["rank"] == "manager") print "SELECTED";?> ><?= $language["form"]["label_rank_sel_manager"]; ?></option>
			<option value="member" <?php if($tmp["rank"] == "member") print "SELECTED";?> ><?= $language["form"]["label_rank_sel_member"]; ?></option>
		</select>
		<span id="label"><?= $language["form"]["label_name"]; ?></span>
		<input type="text" name="username" readonly="readonly" value="<?= $tmp["name"]; ?>"/>
		<span id="label"><?= $language["form"]["label_email"]; ?></span>
		<input type="email" name="email" value="<?= $tmp["email"]; ?>"/>
		<span id="label"><?= $language["form"]["label_password"]; ?></span>
		<input type="password" name="password"/>
		<span id="label"><?= $language["form"]["label_password_re"]; ?></span>
		<input type="password" name="confirm_password"/>
		<span id="label"><?= $language["form"]["label_status"]; ?></span>
		<select name="status">
			<option value="null"><?= $language["form"]["label_status_sel"]; ?></option>
			<option value="1" <?php if($tmp["status"] == true) print "SELECTED"; ?>><?= $language["form"]["label_status_sel_enable"]; ?></option>
			<option value="0" <?php if($tmp["status"] == false) print "SELECTED"; ?>><?= $language["form"]["label_status_sel_disable"]; ?></option>
		</select>

		<div class="separator30"></div>

		<span id="label"><?= $language["form"]["label_file_list"]; ?></span>
		<?= returnFilesList($id, "user"); ?>

		<div class="separator30"></div>

		<?php
			print returnImgUploader("IMG Uploader", $id, "user", 290, 350);
			print " ";
			print returnDocsUploader("DOCS Uploader", $id, "user", 290, 350);
		?>
		<div class="separator30"></div>

		<div class="bottom-area">
			<button class="green" title="save" type="submit" name="save" onclick="if ($('input[name=password]').val() != '') {if ($('input[name=password]').val() == $('input[name=confirm_password]').val()) {return true;} else {alert('<?= $language["form"]["label_password_error"]; ?>'); return false;}} else {return true;}"><i class="fa fa-floppy-o"></i></button>
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
			$user->setRank(($tmp["rank"] === "owner") ? $tmp["rank"] : $_POST["rank"]);

			if (!empty($_POST["password"]) || !empty($_POST["confirm_password"])) { // verificar se pelo menos um dos campos foi preenchido
				if ($_POST["password"] === $_POST["confirm_password"]){
					$user->setPassword($_POST["password"]);
				} else {
					print $language["form"]["label_password_error"];
				}

			} else if (empty($_POST["password"]) && empty($_POST["confirm_password"])) { // verificar se ambos os campos estão vazios
				$user->setOldPassword($tmp["password"]);
			} else {
				print "ola";
			}

			$user->setEmail($_POST["email"]);
			$user->setRank($_POST["rank"]);
			$user->setStatus((bool)$_POST["status"]);

			if ($user->update()) {
				print $language["actions"]["success"];
			} else {
				print $language["actions"]["failure"];
			}
		} else {
			print $language["form"]["label_email_invalid"];
			print"<script type=\"text/javascript\">setTimeout(goBack(),2000);</script>";
		}
	}
} else {
	print $language["actions"]["error"];
}
