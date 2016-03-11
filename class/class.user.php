<?php

class user {
	protected $id;
	protected $username;
	protected $password;
	protected $email;
	protected $rank;
	protected $code;
	protected $stringcode;
	protected $status;

	public function __construct() {}

	public function setUsername($u) {
		$this->username = $u;
	}

	public function setPassword($p) {
		$this->password = sha1(md5(sha1(md5($p))));
	}

	public function setOldPassword($p) {
		$this->password = $p;
	}

	public function setId($i) {
		$this->id = (int)$i;
	}

	public function setEmail($e) {
		$this->email = $e;
	}

	public function setStatus($s) {
		$this->status = (bool)$s;
	}

	public function setRank($r) {
		switch ($r) {
			case "manager": $this->rank = "manager";
				break;
			case "member": $this->rank = "member";
				break;
			default: $this->rank = "member";
		}
	}

	public function setCode($c) {
		$this->code = $c;
	}
	
	public function setStringCode($s) {
		$this->stringcode = $s;
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_users (name, password, email, rank, code, stringcode, status) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
			$configuration['mysql-prefix'], $this->username, $this->password, $this->email, $this->rank, $this->code, $this->stringcode, $this->status
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_users SET name = '%s', password = '%s', email = '%s', rank = '%s', code = '%s', stringcode = '%s', status = '%s' WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->username, $this->password, $this->email, $this->rank, $this->code, $this->stringcode, $this->status, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_users WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->id
		);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return [
			"id" => $this->id,
			"name" => $this->username,
			"password" => $this->password,
			"email" => $this->email,
			"rank" => $this->rank,
			"code" => $this->code,
			"stringcode" => $this->stringcode,
			"status" => $this->status
		];
	}

	public function returnOneUser() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE id = '%s' LIMIT 1",
			$configuration['mysql-prefix'], $this->id
		);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function existUserByName() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE name = '%s' LIMIT 1",
			$configuration['mysql-prefix'], $this->username
		);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function existUserByEmail() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE email = '%s' LIMIT 1",
			$configuration['mysql-prefix'], $this->email
		);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function returnAllUsers() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE true",
			$configuration['mysql-prefix']
		);
		$source = $mysqli->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function codeToArray($code) {
		$code = explode("[spr]", $code);

		return $code;
	}

	public function comparePasswords ($p1, $p2) {
		if ($p1 !== null && $p2 !== null) {
			if ($p1 == $p2) {
				return true;
			}
		}
		return false;
	}
}
