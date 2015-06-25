<?php
/*
Author: Tom Van Haute
Date: 10/02/2015
*/

class expscore {
	public $id;
	public $name;
	public $sutname;
	public $dbname;
	public $score;
	public $url;

	public function __construct($id, $na, $su, $db, $sc, $url) {
		$this->id = $id;
		$this->name = $na;
		$this->sutname = $su;
		$this->dbname = $db;
		$this->score = $sc;
		$this->url = $url;
	}
}
?>
