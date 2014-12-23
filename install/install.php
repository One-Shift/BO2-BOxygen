<!DOCTYPE html>
<html>
	<head>
		<title>Install Me</title>
		<style>
			* {
				font: 13px/21px "Lucida Grande",Verdana,Arial,sans-serif;
			}

			h1 {
				font-size: 21px;
				text-align: center;
				color: rgba(255,255,255,0.5);
				margin: 0 0 25px;
				cursor: default;
			}

			html {
				background: url("./../site-assets/images/bg_02.jpg") repeat fixed center center rgba(0, 0, 0, 0);
				margin: 0 auto 50px;
			}

			body {
				background: rgba(0, 0, 0, 0.1);
				width: 340px;
				margin: 10px auto 0; padding: 118px 50px 0;
				border-radius: 3px;
				background-image: url("./../site-assets/images/logo.png");
				background-position: center top;
				background-repeat: no-repeat;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
			}

			form {
				width: 300px;
				margin: 0 auto;
			}

			label {
				display: block;
				text-align: center;
				color: #fff;
				padding: 0 0 20px;
			}

			input {
				display: block;
				width: 298px; height: 30px;
				border: none;
				border-radius: 3px;
				text-align: center;
			}

			button {
				background-color: transparent;
				border: medium none;
				color: #cccccc;
				cursor: pointer;
				font-size: 15pt;
				font-weight: bold;
				height: 85px;
				text-transform: uppercase;
				width: 100%;
				margin: 0 0 20px;
			}

			button:hover {
				color: #fff;
			}
		</style>
	</head>
	<body>
		<h1>Install Me</h1>
		<?php
		include "./../configuration.php";
		include "./../connect.php";
		include "./../class/class.user.php";

		if (isset($_POST["submit"])) {
			$c2r = "`prefix_";
			$structure = file_get_contents("./database_structure.sql");
			$data = file_get_contents("./database_data_base.sql");

			print str_replace($c2r, "`teste_", $structure);
			print str_replace($c2r, "`teste_", $data);
		} else {
			?>

			<form method="post">
				<label>
					<input type="text" name="username" placeholder="username" />
				</label>
				<label>
					<input type="email" name="email" placeholder="e-mail" />
				</label>
				<label>
					<input type="password" name="password" placeholder="password" />
				</label>
				<label>
					<input type="password" name="password2" placeholder="re-type password" />
				</label>
				<div>
					<button type="submit" name="submit">Submit</button>
				</div>
			</form>

			<?php
		}
		?>
	</body>
</html>
