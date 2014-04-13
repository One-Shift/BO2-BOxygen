<?php
    class category {
        protected $id;
        protected $name_1;
        protected $name_2;
        protected $name_3;
        protected $name_4;
        protected $name_5;
        protected $name_6;
        protected $category_type;
        protected $user_id;
        protected $code;
        protected $description;
        protected $published = false;
        
        public function __construct() {}
        
        public function setId($i) {
            $this->id = $i;
        }
        
        public function setContent($n_1, $n_2, $n_3, $n_4, $n_5, $n_6, $c, $des) {
            $this->name_1 = $n_1;
            $this->name_2 = $n_2;
            $this->name_3 = $n_3;
            $this->name_4 = $n_4;
            $this->name_5 = $n_5;
            $this->name_6 = $n_6;
            $this->code = $c;
            $this->description = $des;
        }
        
        public function setUser($u) {
            $this->user_id = $u;
        }
        
        public function setCategoryType($s) {
            $this->category_type = $s;
        }
        
        public function setPublished($p) {
            $this->published = $p;
        }
        
        public function insert() {
            global $configuration;
        	global $mysqli;
            
            $query = sprintf("INSERT INTO %s_categories (name_1,name_2, name_3, name_4, name_5, name_6, code, description, category_type, user_id, published) VALUES ('%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s')",
			$configuration['mysql-prefix'], $mysqli->real_escape_string($this->name_1), $mysqli->real_escape_string($this->name_2), $mysqli->real_escape_string($this->name_3), $mysqli->real_escape_string($this->name_4), $mysqli->real_escape_string($this->name_5), $mysqli->real_escape_string($this->name_6), $mysqli->real_escape_string($this->code), $mysqli->real_escape_string($this->description), $this->category_type, $this->user_id, $this->published);
            
			$toReturn = $mysqli->query($query);
			
            $this->id = $mysqli->insert_id;
            
            return $toReturn;
        }
        
        public function update() {
            global $configuration;
        	global $mysqli;
            
            $query = sprintf("UPDATE %s_categories SET name_1 = '%s', name_2 = '%s', name_3 = '%s', name_4 = '%s', name_5 = '%s', name_6 = '%s', category_type = '%s', user_id = '%s', code = '%s', description = '%s', published = '%s' WHERE id = '%s'",
			$configuration['mysql-prefix'], $mysqli->real_escape_string($this->name_1), $mysqli->real_escape_string($this->name_2), $mysqli->real_escape_string($this->name_3), $mysqli->real_escape_string($this->name_4), $mysqli->real_escape_string($this->name_5), $mysqli->real_escape_string($this->name_6), $mysqli->real_escape_string($this->category_type), $mysqli->real_escape_string($this->user_id), $mysqli->real_escape_string($this->code), $mysqli->real_escape_string($this->description), $this->published, $this->id);
            
            return $mysqli->query($query);
        }
        
        public function delete() {
            global $configuration;
        	global $mysqli;
            
            $query = sprintf("DELETE FROM %s_categories WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);
			   
            return $mysqli->query($query);
        }
        
        public function returnOneCategory() {
            global $configuration;
        	global $mysqli;
        	
        	$query = sprintf("SELECT * FROM %s_categories WHERE id = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->id);
        	$source = $mysqli->query($query);
        	
        	return $source->fetch_array(MYSQLI_ASSOC);
        }
        
        public function returnAllCategories() {
            global $configuration;
        	global $mysqli;
			
        	$query = sprintf("SELECT * FROM %s_categories WHERE true", $configuration['mysql-prefix']);
        	$source = $mysqli->query($query);
        	
        	$toReturn = array();
        	$i = 0;
        	
        	while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
        		$toReturn[$i] = $data;
        		$i++;
        	}
        	return $toReturn;
        }
        
        public function returnCategories($part_of_category) {
            global $configuration;
        	global $mysqli;
        	
        	$query = sprintf("SELECT * FROM %s_categories %s", $configuration['mysql-prefix'], $part_of_category);
        	$source = $mysqli->query($query);
        	
        	$toReturn = array();
        	$i = 0;
        	
			while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
				$toReturn[$i] = $data;
        		$i++;
			}
        	
        	return $toReturn;
        }
    }
?>
