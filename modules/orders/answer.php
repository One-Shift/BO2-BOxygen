<div class="article-add">
	<?php if ($id !== null) { ?>
		<h1 class="pageTitle">Responder à Encomenda</h1>
		<?php
			/* -- */
			if (isset($_POST["orderstate"])) {
				$order = new orders();
				$order->setId($id);
				$order->setStatus($_POST["orderstate"]);
				$order->updateStatusById();
			}

			/* -- */
			$template = file_get_contents("modules/orders/templates/answer.html");
			$tableTemplate = file_get_contents("modules/orders/templates-e/answer-table.html");
			$itemTemplate = file_get_contents("modules/orders/templates-e/answer-line.html");

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
			foreach ($cart["products"] as $item) {
				// pesquisar por informções de produto
				$product = new product();
				$product->setId($item["id"]);
				$product = $product->returnOneProduct();

				// calcular valor com IVA
				// valor na altura da compra
				$value_w_vat = $item["price"] * (($item["vat"] / 100) + 1);

				$list .= str_replace(
						[
							"{c2r-id}",
							"{c2r-ref}",
							"{c2r-name}",
							"{c2r-qtd}",
							"{c2r-value}",
							"{c2r-vat}",
							"{c2r-pathbo}"
						],
						[
							$item["id"],
							$product["reference"],
							$product["title_1"],
							$item["quantity"],
							number_format($value_w_vat, 2, ".", " ")." €",
							$item["vat"]." %",
							$configuration["path-bo"]
						],
					$itemTemplate
				);
			}

			$tableTemplate = str_replace(
					[
						"{c2r-status}",
						"{c2r-user}",
						"{c2r-code}",
						"{c2r-address-1}",
						"{c2r-address-2}",
						"{c2r-payment}",
						"{c2r-lines}",
						"{c2r-vat}",
						"{c2r-total}",
						"{c2r-total2}"
					],
					[
						$language["mod_order"][$data[0]["status"]],
						$userData["name"],
						$codeToPrint,
						$cart["invoice"], //faturação
						$cart["send"], // entrega
						$cart["payment"],
						$list,
						number_format($cart["vat"], 2, ".", " "), // iva
						number_format($cart["total"], 2, ".", " "), // total
						number_format(($cart["total"] + $cart["var"]), 2, ".", " ") // total + iva
					],
					$tableTemplate
					);

			$template = str_replace(
				[
					"{c2r-list}"
				],
				[
					$tableTemplate
				],
				$template
			);

			print $template;
?>
			<br/>
			<form method="post">
				<div class="button-area">
					<button type="submit" name="orderstate" class="green" value="0"><?= $language["mod_order"][0] ?></button>
					<button type="submit" name="orderstate" class="green" value="1"><?= $language["mod_order"][1] ?></button>
					<button type="submit" name="orderstate" class="green" value="2"><?= $language["mod_order"][2] ?></button>
					<button type="submit" name="orderstate" class="green" value="3"><?= $language["mod_order"][3] ?></button>
					<button type="submit" name="orderstate" class="red" value="10"><?= $language["mod_order"][10] ?></button>
				</div>
			</form>
<?php
	} else {
		print $language["actions"]["error"];
	}
	?>
</div>
