<?php

class cart {
	protected $id;
	protected $product_id;
	protected $quantity;
	protected $user_id;
	protected $content;
	protected $date;
	protected $date_update;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setProductId($p) {
		$this->product_id = $p;
	}

	public function setQuantity($q = 1) {
		$this->quantity = $q;
	}

	public function setUser($u) {
		$this->user_id = $u;
	}

	public function setContent($c) {
		$this->content = $c;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_cart (user_id, product_id, quantity, content, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->user_id, $this->product_id, $this->quantity, $this->content, $this->date, $this->date_update
		);

		return $mysqli->query($query);
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_cart SET quantity = '%s', content = '%s', date_update = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->quantity, $this->content, $this->date_update, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_cart WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->id
		);

		return $mysqli->query($query);
	}

	public function sub($u, $i) {
		global $configuration, $mysqli;
		$query[1] = sprintf("SELECT id, quantity FROM %s_cart WHERE user_id = '%s' AND id = '%s'", $configuration["mysql-prefix"], $u, $i);
		$source[1] = $mysqli->query($query[1]);
		$data[1] = $source[1]->fetch_assoc();

		if ($data[1]["quantity"] > 1) {
			return $this->subQuantity($u, $i);
		} else {
			$query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s' AND id = '%s' AND quantity = '%s'", $configuration["mysql-prefix"], $u, $i, 1);

			return $mysqli->query($query[0]);
		}
	}

	public function addQuantity($u, $i) {
		global $configuration, $mysqli;

		$query[0] = sprintf("UPDATE %s_cart SET quantity = quantity + 1 WHERE user_id = '%s' AND id = '%s'", $configuration["mysql-prefix"], $u, $i);

		return $mysqli->query($query[0]);
	}

	public function subQuantity($u, $i) {
		global $configuration, $mysqli;

		$query[0] = sprintf("UPDATE %s_cart SET quantity = quantity - 1 WHERE user_id = '%s' AND id = '%s'", $configuration["mysql-prefix"], $u, $i);

		return $mysqli->query($query[0]);
	}

	public function remove($u, $i) {
		global $configuration, $mysqli;

		$query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s' AND id = '%s'", $configuration["mysql-prefix"], $u, $i);

		return $mysqli->query($query[0]);
	}

	public function emptyCart($u) {
		global $configuration, $mysqli;

		$query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s'", $configuration["mysql-prefix"], $u);

		return $mysqli->query($query[0]);
	}

}
