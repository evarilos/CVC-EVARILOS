<?php
/*
Author: Tom Van Haute
Date: 02/04/2015
*/

class configexp {
	public $username;
	public $timeslot;
	public $testbed;
	public $approach;
	public $channel;
	public $txpower;
	public $interference;
	public $path;

	public function __construct($username, $timeslot, $testbed, $approach, $channel, $txpower, $interference,
					$path) {
		$this->timeslot = $timeslot;
		$this->testbed = $testbed;
		$this->approach = $approach;
		$this->channel = $channel;
		$this->txpower = $txpower;
		$this->interference = $interference;
		$this->path = $path;
		$this->username = $username;
	}

	public function AddExperimentToDB()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;

		//Insert the user into the database providing no errors have been found.
		$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."experiments (
			username,
			timeslot,
			testbed,
			approach,
			channel,
			txpower,
			interference, 
			path
			)
			VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?)");

		$stmt->bind_param("ssssssss", $this->username, getTimeSlotById($this->timeslot), $this->testbed, $this->approach, $this->channel, $this->txpower, $this->interference, $this->path);
		$stmt->execute();
		$stmt->close();

		return true;
	}
}
?>
