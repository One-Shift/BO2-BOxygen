<?php

class orders {

	protected $id;
	protected $user_id;
	protected $cart;
	protected $date;
	protected $date_update;
	protected $status = false;

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

			$total += (($item["discount"] !== 0) ? $item["price"] : $item["discount"]);
			$vat += (($item["discount"] !== 0) ? $item["price"] : $item["discount"]) * ($item["vat"] / 100);
		}

		// save info in var
		$this->cart = "<address>\n\t<invoice>$ba</invoice>\n\t<send>$da</send>\n</address>\n<shopping-list>$list</shopping-list>\n<bill>\n\t<total>$total</total>\n\t<vat>$vat</vat>\n</bill>\n<payment>$p</payment>";

		return true;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $configuration, $mysqli;

		$query[0] = sprintf("INSERT INTO %s_orders (user_id, cart, date, date_update) VALUES ('%s', '%s', '%s', '%s')", $configuration["mysql-prefix"], $this->user_id, $this->cart, $this->date, $this->date_update);

		return $mysqli->query($query[0]);
	}

	public function update() {
		global $configuration, $mysqli;
	}

	public function delete() {
		global $configuration, $mysqli;
	}

	public function returnObject() {
		return array();
	}

	public function returnOneOrder() {
		global $configuration, $mysqli;

		$query[0] = sprintf("SELECT * FROM %s_orders WHERE id = '%s'", $configuration["mysql-prefix"], $this->id);
		$source[0] = $mysqli->query($query[0]);

		return $source[0]->fetch_assoc();
	}

	public function returnAllOrders() {
		global $configuration, $mysqli;

		$query[0] = sprintf("SELECT * FROM %s_orders WHERE true ORDER BY id DESC", $configuration["mysql-prefix"]);
		$source[0] = $mysqli->query($query[0]);

		$toReturn = array();
		$i = 0;

		if ($source[0]->num_rows > 0) { // verificar se é returnado pelo menos 1
			while ($data[0] = $source[0]->fetch_assoc()) {
				$toReturn[$i] = $data[0];
				$i++;
			}
		} else {
			return [];
		}

		return $toReturn;
	}

	public function cartToArray($cart) {
		$tmp = explode("[spr]", $cart); // 0 - moradas, 1 - lista, 2 - preços, 3 - metodos de pagamento

		// criação da lista
		$tmpList = explode("\n", $tmp[1]);
		$i = 0;

		foreach ($tmpList as $line) {
			$toReturn["products"][$i] = explode("[/]", $line); // 0 - id, 1 - quantidade, 2 - valor, 3 - iva em %
			$i++;
		}

		$toReturn["address"] = explode("[/]", $tmp[0]); // 0 - morada faturação, 1 - morada entrega
		$toReturn["price"] = explode("[/]", $tmp[2]); // 0 - valor total s/ iva, 1 - valor do iva
		$toReturn["payment"] = $tmp["3"];

		return $toReturn;
	}

}
