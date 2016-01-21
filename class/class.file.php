<?php

class file {
	protected $id;
	protected $file;
	protected $description;
	protected $type;
	protected $code;
	protected $module;
	protected $ordering;
	protected $id_ass;
	protected $user_id;
	protected $date;

	public function __construct() {}

	public function setId($i) {
		$this->id = (int)$i;
	}

	public function setFile ($f) {
		$this->file = $f;
	}

	public function setDescription ($d) {
		$this->description = $d;
	}

	public function setType ($t) {
		$this->type = $t;
	}

	public function setCode ($c) {
		$this->code = $c;
	}

	public function setModule ($m) {
		$this->module = $m;
	}

	public function setOrdering ($p) {
		$this->ordering = (int)$p;
	}

	public function setIdAss ($ia) {
		$this->id_ass = (int)$ia;
	}

	public function setUserId ($u) {
		$this->user_id = (int)$u;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert () {
		global $configuration, $mysqli;

		$query = sprintf(
			"INSERT INTO %s_files (file, description, type, code, module, ordering, id_ass, user_id, date) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$configuration["mysql-prefix"], $this->file, $this->description, $this->type, $this->code, $this->module, $this->ordering, $this->id_ass, $this->user_id, $this->date
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update () {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_files SET description = '%s', code = '%s', ordering = '%s', id_ass = '%s' WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->description, $this->code, $this->ordering, $this->id_ass, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete () {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_files WHERE id = '%s'",
			$configuration["mysql-prefix"], $this->id
		);

		return $mysqli->query($query);
	}

	public function returnFiles ($limit = null) {
		global $configuration, $mysqli;

		$query = null;

		if ($this->id_ass != null && $this->type != null && $this->module != null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass = '%s' AND type = '%s' AND module = '%s' %s",
				$configuration["mysql-prefix"], $this->id_ass, $this->type, $this->module, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass != null && $this->type != null && $this->module == null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass = '%s' AND type = '%s' %s",
				$configuration["mysql-prefix"], $this->id_ass, $this->type, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass != null && $this->type == null && $this->module != null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass = '%s' AND module = '%s' %s",
				$configuration["mysql-prefix"], $this->id_ass, $this->module, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass == null && $this->type != null && $this->module != null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE type = '%s' AND module = '%s' %s",
				$configuration["mysql-prefix"], $this->type, $this->module, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass != null && $this->type == null && $this->module == null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass = '%s' %s",
				$configuration["mysql-prefix"], $this->id_ass, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass == null && $this->type == null && $this->module != null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE module = '%s' %s",
				$configuration["mysql-prefix"], $this->module, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else if ($this->id_ass == null && $this->type != null && $this->module == null) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE type = '%s' %s",
				$configuration["mysql-prefix"], $this->type, ($limit != null) ? "LIMIT ".$limit : null
			);
		} else {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE TRUE %s",
				$configuration["mysql-prefix"], ($limit != null) ? "LIMIT ".$limit : null
			);
		}

		if ($query != null) {
			$source = $mysqli->query($query);

			$toReturn = array();
			$i = 0;

			while ($data = $source->fetch_assoc()) {
				$toReturn[$i] = $data;
				$i++;
			}

			return $toReturn;
		}
		return FALSE;
	}

}
