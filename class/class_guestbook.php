<?php
    class guestbook {
        protected $id;
        protected $title;
        protected $content;
        protected $writer;
        protected $type;
        protected $id_ass;
        protected $date_creation;
        protected $date_update;
        
         public function __construct() {}
         
         public function setContent($t, $c) {
            $this->title = $t;
            $this->content = $c;
        }
        
        public function setId($i) {
            $this->id = $i;
        }
        
        public function setWriter($w) {
            $this->writer = $w;
        }
        
        public function insert() {
            global $configuration;
            
            $query = "INSERT INTO ".$configuration['mysql-prefix']."_guestbook (title, content, writer, type, id_ass, date_creation, date_update) VALUES ('".$this->title."','".$this->content."','".$this->writer."','".$this->type."','".$this->id_ass."','".$this->date_creation."','".$this->date_update."')";
            
            $this->id = mysql_insert_id();
            
            return mysql_query($query);
        }
        
        public function update() {
            global $configuration;
            
            $query = "UPDATE ".$configuration['mysql-prefix']."_guestbook SET";
            
            return mysql_query($query);
        }
        
        public function delete() {
            global $configuration;
            
            $query = "DELETE FROM ".$configuration['mysql-prefix']."_guestbook WHERE id = '".$this->id."'";
            
            return mysql_query($query);
        }
        
        public function returnObject() {
            return array(
        		'title' => $this->title,
        		'content' => $this->content,
                'writer' => $this->writer,
                'type' =>  $this->type,
                'id_ass' => $thi->id_ass,
                'date_creation' => $this->date_creation,
                'date_update' => $this->date_update
        	);
        }
        
        public function returnOneArticle() {
        	global $configuration;
        	
        	$query = "SELECT * FROM ".$configuration['mysql-prefix']."_guestbook WHERE id = '".$this->id."' LIMIT 1";
        	$source = mysql_query($query);
        	
        	return mysql_fetch_array($source);
        }
        
        public function returnAllArticles() {
        	global $configuration;
        	
        	$query = "SELECT * FROM ".$configuration['mysql-prefix']."_guestbook WHERE true AND type = 'topic'";
        	$source = mysql_query($query);
        	
        	$toReturn = array();
        	$i = 0;
        	
        	while ($data = mysql_fetch_array($source)) {
        		$toReturn[$i] = $data;
        		$i++;
        	}
        	return $toReturn;
        }
    }
?>