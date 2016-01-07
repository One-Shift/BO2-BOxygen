<?php

class history {
	protected $id;
	protected $module;
	protected $user_id;
	protected $description;
	protected $date;
	protected $date_update;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setModule($m) {
		$this->module = $m;
	}

	public function setUserId($u) {
		$this->user_id = $u;
	}

	public function setDescription($d) {
		$this->description = $d;
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
			"INSERT INTO %s_history (module, user_id, description, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->module, $this->user_id, $this->description, $this->date, $this->date_update
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_history SET module = '%s', user_id = '%s', description = '%s' WHERE id = '%s', date = '%s', date_update = '%s'",
			$configuration["mysql-prefix"], $this->module, $this->user_id, $this->description, $this->id, $this->date, $this->date_update
		);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_history WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->id
		);

		return $mysqli->query($query);
	}
}
