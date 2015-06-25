<?php
/*
Author: Tom Van Haute
Date: 02/04/2015
*/

class appprof {
	public $name;
	public $timestamp;
	public $createdBy;
	public $type;
	public $PA_weight;
	public $PA_min;
	public $PA_max;
	public $RA_weight;
	public $RA_min;
	public $RA_max;
	public $LA_weight;
	public $LA_min;
	public $LA_max;
	public $EN_weight;
	public $EN_min;
	public $EN_max;
	public $PA_type;
	public $LA_type;
	public $EN_type;

	public function __construct($name, $createdBy, $type,	$PA_weight, $PA_min, $PA_max,
								$RA_weight, $RA_min, $RA_max,
								$LA_weight, $LA_min, $LA_max,
								$EN_weight, $EN_min, $EN_max,
								$PA_type, $LA_type, $EN_type) {

		$datum = new DateTime();
		$now = $datum->format('Y-m-d H:i:s');
		$this->name = $name;
		$this->createdBy = $createdBy;
		$this->type = $type;
		$this->timestamp = $now;
		$this->PA_weight = $PA_weight;
		$this->PA_min = $PA_min;
		$this->PA_max = $PA_max;
		$this->RA_weight = $RA_weight;
		$this->RA_min = $RA_min;
		$this->RA_max = $RA_max;
		$this->LA_weight = $LA_weight;
		$this->LA_min = $LA_min;
		$this->LA_max = $LA_max;
		$this->EN_weight = $EN_weight;
		$this->EN_min = $EN_min;
		$this->EN_max = $EN_max;
		$this->PA_type = $PA_type;
		$this->LA_type = $LA_type;
		$this->EN_type = $EN_type;
	}

	public function AddApplicationProfileToDB()
	{
		global $mysqli;

		//Insert the application profile into the database providing no errors have been found.
		$stmt = $mysqli->prepare("INSERT INTO application_profiles (
			Name,
			type,
			createdBy,
			timestamp,
			PA_weight,
			PA_min,
			PA_max,
			RA_weight,
			RA_min,
			RA_max,
			LA_weight,
			LA_min,
			LA_max,
			EN_weight,
			EN_min,
			EN_max,
			PA_type,
			LA_type,
			EN_type
			)
			VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?)");
		
		$stmt->bind_param("ssssddddddddddddsss", $this->name, $this->type, $this->createdBy, $this->timestamp,	$this->PA_weight, $this->PA_min, $this->PA_max,
															$this->RA_weight, $this->RA_min, $this->RA_max,
															$this->LA_weight, $this->LA_min, $this->LA_max,
															$this->EN_weight, $this->EN_min, $this->EN_max,
															$this->PA_type, $this->LA_type, $this->EN_type);

		$stmt->execute();
		$stmt->close();
	}
}
?>
