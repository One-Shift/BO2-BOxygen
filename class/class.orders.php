<?php

class orders {

	protected $id;
	protected $user_id;
	protected $cart;
	protected $code;
	protected $date;
	protected $date_update;
	protected $status = 0;

	public function __construct() {

	}

	public function setContent() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setUserId($w) {
		$this->user_id = $w;
	}

	public function setCart($ba = null, $da = null, $l = [], $p = null) {
		if (count($l) <= 0) {
			return false;
		}

		$total = 0;
		$vat = 0;
		$list = null; // compiled list
		foreach ($l as $item) {
			$list .= "\n\t<product>\n\t\t<id>".$item["id"]."</id>\n\t\t<quantity>".$item["quantity"]."</quantity>\n\t\t<content>".$item["content"]."</content>\n\t\t<price>".$item["id"]."</price>\n\t\t<vat>".$item["vat"]."</vat>\n\t\t<discount>".(($item["discount"] !== 0) ? $item["price"] : $item["discount"])."</discount>\n\t</product>";

			$total += (($item["discount"] != 0) ? $item["price"] : $item["discount"]);
			$vat += (($item["discount"] != 0) ? $item["price"] : $item["discount"]) * ($item["vat"] / 100);
		}

		// save info in var
		$this->cart = "<address>\n\t<invoice>$ba</invoice>\n\t<send>$da</send>\n</address>\n<shopping-list>$list</shopping-list>\n<bill>\n\t<total>$total</total>\n\t<vat>$vat</vat>\n</bill>\n<payment>$p</payment>";

		return true;
	}

	public function setCode ($c) {
		$this->code = $c;
	}

	public function setDate($d = null) {
		$this->date = ($d != null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d != null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setStatus($s) {
		$this->status = (int)$s;
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_orders (user_id, cart, code, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->user_id, $this->cart, $this->code, $this->date, $this->date_update
		);

		return $mysqli->query($query);
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_orders SET user_id = '%s', cart = '%s', code = '%s', date = '%s', date_update = '%s', status = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->user_id, $this->cart, $this->code, $this->date, $this->date_update, $this->status
		);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_orders WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->id
		);

		return $mysqli->query($query);
	}

	public function updateStatusById() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_orders SET status = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->status,  $this->id
		);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return [];
	}

	public function returnOneOrder() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_orders WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->id
		);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function returnAllOrders() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_orders WHERE true ORDER BY id DESC",
			$configuration["mysql-prefix"]
		);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		if ($source->num_rows > 0) { // verificar se é returnado pelo menos 1
			while ($data = $source->fetch_assoc()) {
				$toReturn[$i] = $data;
				$i++;
			}
		} else {
			return [];
		}

		return $toReturn;
	}

	public function cartToArray($cart) {
		$toReturn = null;

		/* ADDRESS BEGIN */
		$address = getValueByTAG("address", $cart);

		$invoice = getValueByTAG("invoice", $address[1][0]);
		$send = getValueByTAG("send", $address[1][0]);

		$toReturn["invoice"] = $invoice[1][0];
		$toReturn["send"] = $send[1][0];
		/* ADDRESS END */
		/* PRODUCT LIST BEGIN */
		$shopping_list = getValueByTAG("shopping-list", $cart);
		$shopping_list = $shopping_list[0][0];

		$tmp = getValueByTAG("product", $shopping_list);

		$products = null;
		$i = 0;

		foreach ($tmp[1] as $product) {
			$tmp_id = getValueByTAG("id", $product);
			$tmp_quantity = getValueByTAG("quantity", $product);
			$tmp_content = getValueByTAG("content", $product);
			$tmp_price = getValueByTAG("price", $product);
			$tmp_vat = getValueByTAG("vat", $product);
			$tmp_discount = getValueByTAG("discount", $product);

			$products[$i] = [
				"id" => $tmp_id[1][0],
				"quantity" => (int)$tmp_quantity[1][0],
				"content" => $tmp_content[1][0],
				"price" => $tmp_price[1][0],
				"vat" => $tmp_vat[1][0],
				"discount" => $tmp_discount[1][0]
			];

			$i++;
		}
		$toReturn["products"] = $products;
		/* PRODUCT LIST END */
		/* FINAL DATA BEGIN */
		$bill = getValueByTAG("bill", $buy);
		$total = getValueByTAG("total",$bill[1][0]);
		$vat = getValueByTAG("vat",$bill[1][0]);

		$toReturn["total"] = $total[1][0];
		$toReturn["vat"] = $vat[1][0];
		/* FINAL DATA END */
		/* PAYMENT BEGIN*/
		$payment = getValueByTAG("payment", $buy);
		$toReturn["payment"] = $payment[1][0];
		/* PAYMENT END */

		return $toReturn;
	}

}
