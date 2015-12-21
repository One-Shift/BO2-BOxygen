<h1 class="pageTitle"><?= $language["mod_user"]["add_title"]; ?></h1>
	<?php
	if (!isset($_POST["save"])) {
	?>
	<form method="post">
		<span id="label"><?= $language["form"]["label_rank"]; ?></span>
		<select name="rank">
			<option value="null"><?= $language["form"]["label_rank_sel"]; ?></option>
			<option value="manager"><?= $language["form"]["label_rank_sel_manager"]; ?></option>
			<option value="member"><?= $language["form"]["label_rank_sel_member"]; ?></option>
		</select>
		<span id="label"><?= $language["form"]["label_name"]; ?></span>
		<input type="text" name="username" />
		<span id="label"><?= $language["form"]["label_email"]; ?></span>
		<input type="email" name="email" />
		<span id="label"><?= $language["form"]["label_password"]; ?></span>
		<input type="password" name="password" />
		<span id="label"><?= $language["form"]["label_password_re"]; ?></span>
		<input type="password" name="confirm_password" />
		<span id="label"><?= $language["form"]["label_status"]; ?></span>
		<select name="status">
			<option value="null"><?= $language["form"]["label_status_sel"]; ?></option>
			<option value="1"><?= $language["form"]["label_status_sel_enable"]; ?></option>
			<option value="0"><?= $language["form"]["label_status_sel_disable"]; ?></option>
		</select>
		<span id="label"><?= $language["form"]["label_code"]; ?></span>
		<textarea name="code"></textarea>
		<div class="spacer30"></div>

		<div class="bottom-area">
			  <button class="green" title="save" type="submit" name="save" onclick="if ($('input[name=password]').val() == $('input[name=confirm_password]').val() && $('input[name=password]').val() != '' && $('input[name=confirm_password]').val() != '') {return true;} else {alert('<?= $language["form"]["label_password_error"]; ?>'); return false;}"><i class="fa fa-floppy-o"></i></button>
			  <button class="red" title="cancel" type="reset" name="cancel"><i class="fa fa-times"></i></button>
		</div>
	</form>
	<?php
	} else {
		if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$user = new user();
			$user->setUsername($_POST["username"]);
			$user->setPassword($_POST["password"]);
			$user->setEmail($_POST["email"]);
			$user->setRank($_POST["rank"]);
			$user->setStatus((bool)$_POST["status"]);
			$user->setCode($_POST["code"]);

			if ($user->existUserByName() == 0){
				if ($user->insert()){
					print $language["actions"]["success"];

					$id = $mysqli->insert_id;
	?>
			<div class="spacer30"></div>

			<span id="label"><?= $language["form"]["label_file_list"]; ?></span>
			<?= returnFilesList($id, "user"); ?>

			<div class="spacer30"></div>

			<?php
				print returnImgUploader("IMG Uploader", $id, "user",290,350);
				print " ";
				print returnDocsUploader("DOCS Uploader", $id, "user",290,350);

				} else {
					print $language["actions"]["failure"];
				}
			} else {
				print $language["form"]["label_name_duplicated"];
			}
		} else {
			print $language["form"]["label_email_invalid"];
			print "<script type=\"text/javascript\">setTimeout(goBack(),2000);</script>";
		}
	}
