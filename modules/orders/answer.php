<div class="article-add">
	<?php if (isset($_GET['i']) && !empty($_GET['i'])) { ?>
		<h1 class="pageTitle">Responder</h1>
		<?php if (!isset($_POST['save'])) {
			$template = file_get_contents("./modules/orders/templates/answer.html");
			
			$order = new orders();
			$order->setId($_GET["i"]);
			$data[0] = $order->returnOneOrder();
			
			$cart = $order->cartToArray($data[0]["cart"]);
			
			$template = str_replace(
				array("{c2r-user}", "{c2r-list}", "{c2r-total}"), 
				array($data[0]["user_id"], $cart["adress"][0], $cart["price"][2]),
				$template);
			
			print $template;
		} else {
			$article = new article();
			$article->setId(intval($_REQUEST['i']));
			if (isset($_POST['published']))
				$_POST['published'] = true;
			else
				$_POST['published'] = false;
			if (isset($_POST['onhome']))
				$_POST['onhome'] = true;
			else
				$_POST['onhome'] = false;


			$article->setContent(
					$_POST['title_1'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2'], $_POST['title_3'], $_POST['content_3'], $_POST['title_4'], $_POST['content_4'], $_POST['title_5'], $_POST['content_5'], $_POST['title_6'], $_POST['content_6'], $_POST['code']
			);
			$article->setCategory($_POST['category']);
			$article->setDateUpdate($_POST["date_update"]);
			$article->setPublished($_POST['published']);
			$article->setonHome($_POST['onhome']);

			if ($article->update()) {
				print $language["actions"]["success"];
			} else {
				print $language["actions"]["failure"];
			}
		}
	} else {
		print $language["actions"]["error"];
	}
	?>
</div>
