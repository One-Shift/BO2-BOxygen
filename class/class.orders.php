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

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert($u, $c) {
		global $configuration;
		global $mysqli;

		$query[0] = sprintf("INSERT INTO %s_order (user_id, cart, date, date_update) VALUES ('%s', '%s', '%s', '%s')", $configuration["mysql-prefix"], $u, $c, $this->date, $this->date_update);

		return $mysqli->query($query[0]);
	}

	public function update() {
		global $configuration;
		global $mysqli;
	}

	public function delete() {
		global $configuration;
		global $mysqli;
	}

	public function returnObject() {
		return array();
	}

	public function returnOneOrder() {
		global $configuration;
		global $mysqli;

		$query[0] = sprintf("SELECT * FROM %s_orders WHERE id = '%s'", $configuration["mysql-prefix"], $this->id);
		$source[0] = $mysqli->query($query[0]);

		return $source[0]->fetch_assoc();
	}

	public function returnAllOrders() {
		global $configuration;
		global $mysqli;

		$query[0] = sprintf("SELECT * FROM %s_orders WHERE true", $configuration["mysql-prefix"]);
		$source[0] = $mysqli->query($query[0]);

		$toReturn = array();
		$i = 0;

		while ($data[0] = $source[0]->fetch_assoc()) {
			$toReturn[$i] = $data[0];
			$i++;
		}

		return $toReturn;
	}

	public function cartToArray($cart) {
		// seprador por áreas
		$tmp = explode("[spr]", $cart);

		// seprador de endereços
		$toReturn["address"] = explode("\n", $tmp[0]);

		// separador de compras
		$toReturn["list"] = explode("\n", $tmp[1]);

		$toReturn["list"][0] = null; // evitar conteudo desconhecido do index 0
		$toReturn["list"] = array_filter($toReturn["list"]); // filtro para eliminar todos os elementos desnecessários do array

		$i = 0;
		$tmpList = null;

		foreach ($toReturn["list"] as $item) {
			$tmpList[$i] = explode("[/]", $item); // separação do item pelo [/]
			$i++;
		}

		$toReturn["list"] = $tmpList; // 0 -> id do produto, 1 -> quantidade, 2 -> valor, 3 -> iva
		// separador de valores
		$toReturn["price"] = explode("\n", $tmp[2]); // 0 -> valor sem iva, 1 -> valor do iva
		$toReturn["price"][3] = $toReturn["price"][1] + $toReturn["price"][2]; // soma de valor + iva

		return $toReturn;
	}

}
