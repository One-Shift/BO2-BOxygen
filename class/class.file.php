<?php

class image {

	protected $id;
	protected $file;
	protected $alt_1;
	protected $alt_2;
	protected $module;
	protected $priority;
	protected $id_ass;
	protected $user_id;
	protected $date;

	public function __construct() {}

	public function setId($i) {
		$this->id = $i;
	}

	public function setFile ($f) {
		$this->file = $f;
	}

	public function setDescription ($d) {
		$this->alt_1 = $d;
	}

	public function setCode ($c) {
		$this->alt_2 = $c;
	}

	public function setModule ($m) {
		$this->module = $m;
	}

	public function setPriority ($p) {
		$this->priority = $p;
	}

	public function setIdAss ($ia) {
		$this->id_ass = $ia;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert () {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_images (file, alt_1, alt_2, module, priority, id_ass, user_id, date) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->file, $this->alt_1, $this->alt_2, $this->priority, $this->id_ass, $this->user_id, $this->date
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update () {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_images SET file = '%s' AND alt_1 = '%s' AND alt_2 = '%s' AND module = '%s' AND priority = '%s' AND id_ass = '%s' AND user_id = '%s' AND date = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->file, $this->alt_1, $this->alt_2, $this->priority, $this->id_ass, $this->user_id, $this->date, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete () {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_images WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->id
		);

		return $mysqli->query($query);
	}

	public function returnOneImg() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_images WHERE id = '%s' LIMIT 1",
			$configuration["mysql-prefix"], $this->id
		);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function returnAllImgs () {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_images WHERE id_ass = '%s' AND module = '%s'",
			$configuration["mysql-prefix"], $this->id_ass, $this->module
		);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}
}

class document {

	protected $id;
	protected $file;
	protected $alt_1;
	protected $alt_2;
	protected $module;
	protected $priority;
	protected $id_ass;
	protected $user_id;
	protected $date;

	public function __construct() {}

	public function setId($i) {
		$this->id = $i;
	}

	public function setFile ($f) {
		$this->file = $f;
	}

	public function setDescription ($d) {
		$this->alt_1 = $d;
	}

	public function setCode ($c) {
		$this->alt_2 = $c;
	}

	public function setModule ($m) {
		$this->module = $m;
	}

	public function setPriority ($p) {
		$this->priority = $p;
	}

	public function setIdAss ($ia) {
		$this->id_ass = $ia;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert () {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_documents (file, alt_1, alt_2, module, priority, id_ass, user_id, date) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->file, $this->alt_1, $this->alt_2, $this->priority, $this->id_ass, $this->user_id, $this->date
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update () {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_documents SET file = '%s' AND alt_1 = '%s' AND alt_2 = '%s' AND module = '%s' AND priority = '%s' AND id_ass = '%s' AND user_id = '%s' AND date = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->file, $this->alt_1, $this->alt_2, $this->priority, $this->id_ass, $this->user_id, $this->date, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete () {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_documents WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->id
		);

		return $mysqli->query($query);
	}

	public function returnOneImg() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_documents WHERE id = '%s' LIMIT 1",
			$configuration["mysql-prefix"], $this->id
		);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function returnAllImgs () {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_documents WHERE id_ass = '%s' AND module = '%s'",
			$configuration["mysql-prefix"], $this->id_ass, $this->module
		);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}
}
