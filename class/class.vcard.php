<?php

class vcard {

	protected $id;
	protected $name;
	protected $data;
    protected $date;
    protected $date_update;
    protected $published;

	public function __construct() {}

	public function setName($n) {
		$this->name = $n;
	}

	public function setId($i) {
		$this->id = (int)$i;
	}

    public function setData($d) {
		$this->data = $d;
	}

    public function setPublished($p) {
		$this->published = $p;
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
			"INSERT INTO %s_vcard (`name`, `data`, `date`, `date_update`, `published`) VALUES ('%s','%s','%s','%s','%s')",
			$configuration['mysql-prefix'], $this->name, $this->data, $this->date, $this->date_update, $this->published
		);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf(
			"UPDATE %s_vcard SET `name` = '%s', `data` = '%s', `date` = '%s', `date_update` = '%s', `published` = '%s' WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->name, $this->data, $this->date, $this->date_update, $this->published, $this->id
		);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf(
			"DELETE FROM %s_vcard WHERE id = '%s'",
			$configuration['mysql-prefix'], $this->id
		);

		return $mysqli->query($query);
	}

	public function returnOneVcard() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_vcard WHERE id = '%s' LIMIT 1",
			$configuration['mysql-prefix'], $this->id
		);
		$source = $mysqli->query($query);

		$data = $source->fetch_assoc();
		// -- -- -- --
		$personal = getValueByTAG ("personal", $data["data"]);
		$personal = $personal[1][0];

		$employ = getValueByTAG ("employ", $personal);
		$phone = getValueByTAG ("phone", $personal);
		$skype = getValueByTAG ("skype", $personal);
		$viber = getValueByTAG ("viber", $personal);
		$whatsapp = getValueByTAG ("whatsapp", $personal);
		$email = getValueByTAG ("email", $personal);

		$social = getValueByTAG ("social", $personal);
		$social = $social[1][0];

		$fb = getValueByTAG ("fb", $social);
		$g = getValueByTAG ("g+", $social);
		$yt = getValueByTAG ("yt", $social);
		$pi = getValueByTAG ("pi", $social);
		$tw = getValueByTAG ("tw", $social);
		$in = getValueByTAG ("in", $social);

		// -- -- -- --

		return [
			"id" => $data["id"],
			"name" => $data["name"],
			"employ" => (isset($employ[1][0])) ? $employ[1][0] : null,
			"phone" => (isset($phone[1][0])) ? $phone[1][0] : null,
			"skype" => (isset($skype[1][0])) ? $skype[1][0] : null,
			"viber" => (isset($viber[1][0])) ? $viber[1][0] : null,
			"whatsapp" => (isset($whatsapp[1][0])) ? $whatsapp[1][0] : null,
			"email" => (isset($email[1][0])) ? $email[1][0] : null,
			"fb" => (isset($fb[1][0])) ? $fb[1][0] : null,
			"g" => (isset($g[1][0])) ? $g[1][0] : null,
			"yt" => (isset($yt[1][0])) ? $yt[1][0] : null,
			"pri" => (isset($pri[1][0])) ? $pri[1][0] : null,
			"tw" => (isset($tw[1][0])) ? $tw[1][0] : null,

			"published" => $data["published"],
			"date" => $data["date"],
			"date_update" => $data["date_update"]
		];
	}

	public function returnAllVcards() {
		global $configuration, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_vcard WHERE true",
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

	public function dataToArray($data) {
		$data = explode("[spr]", $data);

		return $data;
	}
}
