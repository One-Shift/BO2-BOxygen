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

	public function insert() {
		global $configuration;
		global $mysqli;

		$query[0] = sprintf("INSERT INTO %s_orders () VALUES ()", $configuration["mysql-prefix"]);
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
		$tmp = explode("[spr]", $cart);

		$toReturn["adress"] = explode("\n", $tmp[0]);
		
		$toReturn["list"] = "";
		
		$toReturn["price"] = explode("\n", $tmp[2]);
		$toReturn["price"][2] = $toReturn["price"][0] + $toReturn["price"][0];
		
		return $toReturn;
	}

}
