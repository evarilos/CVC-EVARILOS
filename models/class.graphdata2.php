<?php
/*
Author: Tom Van Haute
Date: 23/02/2015
*/

class graphdata2 {
	public $name;
	public $sol1;
	public $sol2;

	public function __construct($x, $y, $testbed, $v1, $v2, $pi) {
		$this->name = Data::getIdForTestbed($x, $y, $testbed, $pi);
		$this->sol1 = round($v1, 2);
		$this->sol2 = round($v2, 2);
	}
}
?>
