<?php
/*
Author: Tom Van Haute
Date: 10/02/2015
*/

class data {
	public $id;
	public $x;
	public $y;
	public $errorDistance;
	public $latency;

	public function __construct() {
	}

	public static function TestbedErrorLatency($ii, $testbed, $ed, $ly) {
		$this->id = $ii;
		$this->x = $xx;
		$this->y = $yy;
		$this->errorDistance = $ed;
		$this->latency = $ly;
	}

	public static function TestBedError($x, $y, $testbed, $ed, $pi) {
		$instance = new self();
		$coord = $instance->getCoordinatesForTestbed($x, $y, $testbed);
		$instance->id = Data::getIdForTestbed($x, $y, $testbed, $pi);
		$instance->x = $coord[0];
		$instance->y = $coord[1];
		$instance->errorDistance = round($ed, 2);

		return $instance;
	}

	public static function getIdForTestbed($x, $y, $testbed, $pi) {
		//Hospital televic
		if($testbed == 8) {
			if(	$x ==	0.53	&&	$y ==	0.1	) { return  	1	; }
			if(	$x ==	1.53	&&	$y ==	0.1	) { return  	2	; }
			if(	$x ==	2.53	&&	$y ==	0.1	) { return  	3	; }
			if(	$x ==	0.53	&&	$y ==	1.1	) { return  	4	; }
			if(	$x ==	1.53	&&	$y ==	1.1	) { return  	5	; }
			if(	$x ==	2.53	&&	$y ==	1.1	) { return  	6	; }
			if(	$x ==	0.53	&&	$y ==	2.1	) { return  	7	; }
			if(	$x ==	1.53	&&	$y ==	2.1	) { return  	8	; }
			if(	$x ==	2.53	&&	$y ==	2.1	) { return  	9	; }
			if(	$x ==	0.53	&&	$y ==	3.1	) { return  	10	; }
			if(	$x ==	1.53	&&	$y ==	3.1	) { return  	11	; }
			if(	$x ==	2.53	&&	$y ==	3.1	) { return  	12	; }
			if(	$x ==	0.53	&&	$y ==	4.1	) { return  	13	; }
			if(	$x ==	1.53	&&	$y ==	4.1	) { return  	14	; }
			if(	$x ==	2.53	&&	$y ==	4.1	) { return  	15	; }
			if(	$x ==	0.53	&&	$y ==	5.1	) { return  	16	; }
			if(	$x ==	1.53	&&	$y ==	5.1	) { return  	17	; }
			if(	$x ==	2.53	&&	$y ==	5.1	) { return  	18	; }
			if(	$x ==	3.53	&&	$y ==	0.1	) { return  	19	; }
			if(	$x ==	4.53	&&	$y ==	0.1	) { return  	20	; }
			if(	$x ==	5.53	&&	$y ==	0.1	) { return  	21	; }
			if(	$x ==	6.53	&&	$y ==	0.1	) { return  	22	; }
			if(	$x ==	3.53	&&	$y ==	1.1	) { return  	23	; }
			if(	$x ==	4.53	&&	$y ==	1.1	) { return  	24	; }
			if(	$x ==	5.53	&&	$y ==	1.1	) { return  	25	; }
			if(	$x ==	6.53	&&	$y ==	1.1	) { return  	26	; }
			if(	$x ==	3.53	&&	$y ==	2.1	) { return  	27	; }
			if(	$x ==	4.53	&&	$y ==	2.1	) { return  	28	; }
			if(	$x ==	5.53	&&	$y ==	2.1	) { return  	29	; }
			if(	$x ==	6.53	&&	$y ==	2.1	) { return  	30	; }
			if(	$x ==	3.53	&&	$y ==	3.1	) { return  	31	; }
			if(	$x ==	4.53	&&	$y ==	3.1	) { return  	32	; }
			if(	$x ==	5.53	&&	$y ==	3.1	) { return  	33	; }
			if(	$x ==	6.53	&&	$y ==	3.1	) { return  	34	; }
			if(	$x ==	3.53	&&	$y ==	4.1	) { return  	35	; }
			if(	$x ==	4.53	&&	$y ==	4.1	) { return  	36	; }
			if(	$x ==	5.53	&&	$y ==	4.1	) { return  	37	; }
			if(	$x ==	6.53	&&	$y ==	4.1	) { return  	38	; }
			if(	$x ==	4.53	&&	$y ==	5.1	) { return  	39	; }
			if(	$x ==	5.53	&&	$y ==	5.1	) { return  	40	; }
			if(	$x ==	6.53	&&	$y ==	5.1	) { return  	41	; }
			if(	$x ==	7.53	&&	$y ==	0.1	) { return  	42	; }
			if(	$x ==	7.53	&&	$y ==	1.1	) { return  	43	; }
			if(	$x ==	7.53	&&	$y ==	2.1	) { return  	44	; }
			if(	$x ==	7.53	&&	$y ==	3.1	) { return  	45	; }
			if(	$x ==	7.53	&&	$y ==	4.1	) { return  	46	; }
			if(	$x ==	7.53	&&	$y ==	5.1	) { return  	47	; }
			if(	$x ==	0.53	&&	$y ==	6.1	) { return  	48	; }
			if(	$x ==	1.53	&&	$y ==	6.1	) { return  	49	; }
			if(	$x ==	2.53	&&	$y ==	6.1	) { return  	50	; }
			if(	$x ==	3.53	&&	$y ==	6.1	) { return  	51	; }
			if(	$x ==	4.53	&&	$y ==	6.1	) { return  	52	; }
			if(	$x ==	5.53	&&	$y ==	6.1	) { return  	53	; }
			if(	$x ==	6.53	&&	$y ==	6.1	) { return  	54	; }
			if(	$x ==	7.53	&&	$y ==	6.1	) { return  	55	; }
			if(	$x ==	8.53	&&	$y ==	6.1	) { return  	56	; }
			if(	$x ==	0.53	&&	$y ==	7.1	) { return  	57	; }
			if(	$x ==	1.53	&&	$y ==	7.1	) { return  	58	; }
			if(	$x ==	2.53	&&	$y ==	7.1	) { return  	59	; }
			if(	$x ==	3.53	&&	$y ==	7.1	) { return  	60	; }
			if(	$x ==	4.53	&&	$y ==	7.1	) { return  	61	; }
			if(	$x ==	5.53	&&	$y ==	7.1	) { return  	62	; }
			if(	$x ==	6.53	&&	$y ==	7.1	) { return  	63	; }
			if(	$x ==	7.53	&&	$y ==	7.1	) { return  	64	; }
			if(	$x ==	0.53	&&	$y ==	8.1	) { return  	65	; }
			if(	$x ==	1.53	&&	$y ==	8.1	) { return  	66	; }
			if(	$x ==	2.53	&&	$y ==	8.1	) { return  	67	; }
			if(	$x ==	3.53	&&	$y ==	8.1	) { return  	68	; }
			if(	$x ==	4.53	&&	$y ==	8.1	) { return  	69	; }
			if(	$x ==	5.53	&&	$y ==	8.1	) { return  	70	; }
			if(	$x ==	6.53	&&	$y ==	8.1	) { return  	71	; }
			if(	$x ==	7.53	&&	$y ==	8.1	) { return  	72	; }
			if(	$x ==	8.53	&&	$y ==	8.1	) { return  	73	; }
		}

		//wilab1
		if($testbed == 2) {
			switch($x) {
				case 5.5:
					return 1; break;
				case 11:
					return 2; break;
				case 16.5:
					return 3; break;
				case 22:
					return 4; break;
				case 27.5:
					return 5; break;
				case 33:
					return 6; break;
				case 38.5:
					return 7; break;
				case 44:
					return 8; break;
				case 49.5:
					return 9; break;
				case 55:
					return 10; break;

				case 13.75:
					return 11; break;
				case 24.75:
					return 12; break;
				case 35.75:
					return 13; break;
				case 41.25:
					return 14; break;
				case 46.75:
					return 15; break;
				case 52.25:
					return 16; break;
			}
		}

		//wilab2
		if($testbed == 3) {
			switch($x) {
				case 35.5:
					return 1; break;
				case 41.5:
					return 2; break;
				case 47.5:
					return 3; break;
				case 53.5:
					return 4; break;
				case 38.5:
					return 5; break;
				case 44.5:
					return 6; break;
				case 47.5:
					return 7; break;
				case 53.5:
					return 8; break;
				case 23.5:
					return 9; break;
				case 26.5:
					return 10; break;
				case 29.66:
				case 29.5:
					return 11; break;
				case 41.5:
					return 12; break;
				case 11.5:
					return 13; break;
				case 14.5:
					return 14; break;
				case 18.25:
					return 15; break;
				case 2.5:
					return 16; break;
				case 4.25:
					return 17; break;
				case 5.5:
					return 18; break;
				case 51:
					return 19; break;
			}
		}

		
		return $pi;
	}

	protected function getCoordinatesForTestbed($x, $y, $testbed) {
		$result = array();

		//Televice Hospital: testbed_id = 8
		if($testbed == 8) {
			switch($x) {
				case 0.53:
					array_push($result, 102); break;
				case 1.53:
					array_push($result, 171); break;
				case 2.53:
					array_push($result, 244); break;
				case 3.53:
					array_push($result, 318); break;
				case 4.53:
					array_push($result, 382); break;
				case 5.53:
					array_push($result, 441); break;
				case 6.53:
					array_push($result, 506); break;
				case 7.53:
					array_push($result, 566); break;
				case 8.53:
					array_push($result, 634); break;
			}

			switch($y) {
				case 0.1:
					array_push($result, 63); break;
				case 1.1:
					array_push($result, 136); break;
				case 2.1:
					array_push($result, 212); break;
				case 3.1:
					array_push($result, 276); break;
				case 4.1:
					array_push($result, 340); break;
				case 5.1:
					array_push($result, 404); break;
				case 6.1:
					array_push($result, 468); break;
				case 7.1:
					array_push($result, 532); break;
				case 8.1:
					array_push($result, 596); break;
			}
		}

		//iMinds wilab1: testbed_id = 2
		if($testbed == 2) {
			switch($x) {
				case 5.5:
					array_push($result, 55); break;
				case 11:
					array_push($result, 115); break;
				case 13.75:
					array_push($result, 145); break;
				case 16.5:
					array_push($result, 175); break;
				case 22:
					array_push($result, 230); break;
				case 24.75:
					array_push($result, 258); break;
				case 27.5:
					array_push($result, 285); break;
				case 33:
					array_push($result, 342); break;
				case 35.75:
					array_push($result, 369); break;
				case 38.5:
					array_push($result, 397); break;
				case 41.25:
					array_push($result, 427); break;
				case 44:
					array_push($result, 457); break;
				case 46.75:
					array_push($result, 486); break;
				case 49.5:
					array_push($result, 516); break;
				case 52.25:
					array_push($result, 543); break;
				case 55:
					array_push($result, 571); break;
			}

			switch($y) {
				case 2.9:
					array_push($result, 220); break;
				case 8.7:
					array_push($result, 164); break;
				case 11.6:
					array_push($result, 136); break;
				case 14.5:
					array_push($result, 107); break;
				case 5.8:
					array_push($result, 190); break;
			}
		}


		//iMinds wilab2: testbed_id = 3
		if($testbed == 3) {
			switch($x) {
				case 0:
					array_push($result, 115); break;
				case 2.5:
					array_push($result, 148); break;
				case 3:
					array_push($result, 155); break;
				case 6:
					array_push($result, 195); break;
				case 9:
					array_push($result, 236); break;
				case 12:
					array_push($result, 276); break;
				case 15:
					array_push($result, 316); break;
				case 18:
					array_push($result, 356); break;
				case 24:
					array_push($result, 437); break;
				case 27:
					array_push($result, 477); break;
				case 30:
					array_push($result, 517); break;
				case 35.25:
					array_push($result, 591); break;
				case 36:
					array_push($result, 594); break;
				case 39:
					array_push($result, 638); break;
				case 42:
					array_push($result, 678); break;
				case 48:
					array_push($result, 758); break;
				case 49.25:
					array_push($result, 769); break;
				case 51:
					array_push($result, 785); break;

				case 35.5:
					array_push($result, 460); break;
				case 41.5:
					array_push($result, 294); break;
				case 47.5:
					array_push($result, 145); break;
				case 53.5:
					array_push($result, 175); break;
				case 38.5:
					array_push($result, 230); break;
				case 44.5:
					array_push($result, 258); break;
				case 47.5:
					array_push($result, 285); break;
				case 53.5:
					array_push($result, 342); break;
				case 23.5:
					array_push($result, 369); break;
				case 26.5:
					array_push($result, 397); break;
				case 29.66:
				case 29.5:
					array_push($result, 427); break;
				case 41.5:
					array_push($result, 457); break;
				case 11.5:
					array_push($result, 486); break;
				case 14.5:
					array_push($result, 516); break;
				case 18.25:
					array_push($result, 543); break;
				case 2.5:
					array_push($result, 571); break;
				case 4.25:
					array_push($result, 571); break;
				case 5.5:
					array_push($result, 571); break;
				case 51:
					array_push($result, 571); break;
			}

			switch($y) {
				case 0:
					array_push($result, 35); break;
				case 3:
					array_push($result, 78); break;
				case 5.5:
					array_push($result, 115); break;
				case 6:
					array_push($result, 121); break;
				case 9:
					array_push($result, 164); break;
				case 10:
					array_push($result, 170); break;
				case 12:
					array_push($result, 207); break;
				case 15:
					array_push($result, 250); break;

				case 6.5:
					array_push($result, 42); break;
				case 3.4:
				case 3.5:
					array_push($result, 164); break;
				case 9.5:
					array_push($result, 136); break;
				case 12.5:
					array_push($result, 107); break;
				case 18.5:
					array_push($result, 190); break;
				case 15.5:
					array_push($result, 220); break;
				case 6.5:
					array_push($result, 164); break;
				case 9.5:
					array_push($result, 136); break;
				case 9:
					array_push($result, 107); break;
			}
		}

		//ADV Mine: testbed_id = 7
		if($testbed == 7) {
			switch($x) {
				case 1:
					array_push($result, 190); break;
				case 2:
					array_push($result, 268); break;
				case 3:
					array_push($result, 348); break;
			}

			switch($y) {
				case 0:
					array_push($result, 771); break;
				case 1:
					array_push($result, 735); break;
				case 2:
					array_push($result, 699); break;
				case 3:
					array_push($result, 664); break;
				case 4:
					array_push($result, 628); break;
				case 5:
					array_push($result, 592); break;
				case 6:
					array_push($result, 556); break;
				case 7:
					array_push($result, 521); break;
				case 8:
					array_push($result, 486); break;
				case 9:
					array_push($result, 596); break;
				case 10:
					array_push($result, 450); break;
				case 11:
					array_push($result, 414); break;
				case 12:
					array_push($result, 378); break;
				case 13:
					array_push($result, 342); break;
				case 14:
					array_push($result, 307); break;
			}
		}

		//TWIST testbed id = 1
		if($testbed == 1)
		{
			switch($x) {
				case 5.16:
				case 5.39:
					array_push($result, 198); break;
				case 20.54:
				case 20.71:
					array_push($result, 550); break;
				case 11.57:
					array_push($result, 330); break;
				case 17.56:
				case 17.59:
					array_push($result, 486); break;
				case 14.48:
					array_push($result, 400); break;
				case 8.48:
					array_push($result, 272); break;
				case 2.02:
				case 2.17:
					array_push($result, 94); break;
				case 23.9:
					array_push($result, 628); break;
				case 26.53:
				case 26.28:
				case 26.68:
					array_push($result, 700); break;
				case 30.28:
					array_push($result, 804); break;
				case 22.08:
					array_push($result, 589); break;
				case 16.12:
					array_push($result, 458); break;
				case 9.81:
					array_push($result, 295); break;
				case 3.51:
					array_push($result, 153); break;
			}

			switch($y) {
				case 10.94:
				case 10.95:
				case 10.98:
					array_push($result, 144); break;
				case 1.65:
				case 1.67:
					array_push($result, 374); break;
				case 1.89:
				case 1.93:
					array_push($result, 368); break;
				case 5.06:
				case 4.98:
					array_push($result, 287); break;
				case 5.39:
					array_push($result, 277); break;
				case 9.02:
				case 9.03:
					array_push($result, 188); break;
				
			}

		}

		return $result;
	}
}
?>
