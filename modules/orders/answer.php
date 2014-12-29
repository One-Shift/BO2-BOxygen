<div class="article-add">
	<?php if ($id !== null) { ?>
		<h1 class="pageTitle">Responder</h1>
		<?php
		if (!isset($_POST['save'])) {
			$template = file_get_contents("./modules/orders/templates/answer.html");
			$tableTemplate = file_get_contents("./modules/orders/templates-e/answer-table.html");
			$itemTemplate = file_get_contents("./modules/orders/templates-e/answer-line.html");

			// pesquisar pela compra pretendida
			$order = new orders();
			$order->setId($id);
			$data[0] = $order->returnOneOrder();
			
			// transformar informação obtiva em ARRAY
			$cart = $order->cartToArray($data[0]["cart"]);

			// informação sobre o utilizador que efetuou a compra
			$user = new user();
			$user->setId($data[0]["user_id"]);
			$userData = $user->returnOneUser();
			$code = $user->codeToArray($userData["code"]);

			$codeToPrint = "";
			foreach ($code as $userItem) {
				$tmp = explode("[/]", $userItem);
				if ($tmp[0] === "company" || $tmp[0] === "phone" || $tmp[0] === "cellphone") {
					$codeToPrint .= isset($tmp[1]) ? $tmp[1] . "<br/>" : null;
				}
			}
			
			// adicionar e-mail às informações da encomenda
			$codeToPrint .= $userData["email"];
						
			// criar a lista de items selecionados para esta compra
			$list = "";
			foreach ($cart["list"] as $item) {
				// pesquisar por informções de produto
				$product = new product();
				$product->setId($item[0]);
				$product = $product->returnOneProduct();
				
				// calcular valor com IVA
				// valor na altura da compra
				$value_w_vat = $item[2] * (($product["vat"] / 100) + 1);
				
				$list .= str_replace(
						array("{c2r-id}", "{c2r-pathbo}", "{c2r-ref}", "{c2r-name}", "{c2r-qtd}", "{c2r-value}", "{c2r-vat}"), 
						array($item[0], $configuration["path-bo"], $product["reference"], $product["title_1"], $item[1], number_format($value_w_vat, 2, '.', ' '), $item[3]), $itemTemplate);
			}

			$tableTemplate = str_replace(
					array(
						"{c2r-user}", 
						"{c2r-code}", 
						"{c2r-address-1}", 
						"{c2r-address-2}", 
						"{c2r-payment}", 
						"{c2r-lines}", 
						"{c2r-vat}", 
						"{c2r-total}", 
						"{c2r-total2}"
						), 
					array(
						$userData["name"], 
						$codeToPrint, 
						$cart["address"][0], 
						$cart["address"][1], 
						$cart["store"],
						$list, 
						number_format($cart["price"][2], 2, '.', ' '), 
						number_format($cart["price"][1], 2, '.', ' '), 
						number_format($cart["price"][3], 2, '.', ' ')
						), 
					$tableTemplate
					);

			$template = str_replace(array("{c2r-list}"), array($tableTemplate), $template);

			print $template;
		} else {
			// save changes here
		}
	} else {
		print $language["actions"]["error"];
	}
	?>
</div>