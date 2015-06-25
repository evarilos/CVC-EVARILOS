<?php
/*
Author: Tom Van Haute
Date: 10/02/2015
*/

class graphdata {
	public $name;
	public $value;

	public function __construct($x, $y, $testbed, $v, $pi) {
		$this->name = Data::getIdForTestbed($x, $y, $testbed, $pi);
		$this->value = round($v, 2);
	}
}
?>
