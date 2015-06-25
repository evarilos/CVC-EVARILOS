<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");
$dbtimeslots = getFreeTimeSlots();

$demo = isset($_POST["demos"]);

//Forms posted
if(!empty($_POST))
{
	if(isset($_POST["timeslot"])) $seltimeslot = $_POST["timeslot"];
	else $seltimeslot = '';

	$testbed = $_POST["testbed"];
	$approach = $_POST["approach"];
	$channel = $_POST["channel"];
	$txpower = $_POST["txpower"];
	$interference = $_POST["interference"];
	$robot = $_POST["robot"];

	if($seltimeslot == -1)
	{
		$errors[] = "Please select a timeslot";
	}

	if($testbed == -1)
	{
		$errors[] = "Please select a testbed";
	}

	if($approach == -1)
	{
		$errors[] = "Please select an approach";
	}

	if($channel == -1)
	{
		$errors[] = "Please select a channel";
	}

	if($txpower == -1)
	{
		$errors[] = "Please select a TX power";
	}

	if($interference == -1)
	{
		$errors[] = "Please select an interference pattern";
	}
	
	if($robot == -1)
	{
		$errors[] = "Please select an evaluation track";
	}

	if(count($errors) == 0) {
		//Reservate the timeslot
		//STORE DATA
		
		//Update existing experiment
		if($loggedInUser->experiment_ok)
		{
			$ok = updateExperimentToDB($loggedInUser->username, $testbed, $approach, $channel, $txpower, $interference, $robot);

			if($ok) {
				$successes[] = "The experiment was updated successfully";
			}
		}
		//Add new experiment
		else {
			$result = setTimeSlotToUser($_POST["timeslot"], $loggedInUser->username);
		
			$exp = new configexp($loggedInUser->username, $seltimeslot, $testbed, $approach, $channel, $txpower, $interference, $robot);

			$result = $exp->AddExperimentToDB();

			if($result) {
				$successes[] = "The configuration was stored succesfully!";
				$loggedInUser->experiment_ok = 1;
				setUserExperimentOk($loggedInUser->username);
			}
		}
	}
}
?>

<body>

    <div id="wrapper">

    <?php include("navigation.php");?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The <img src="img/evarilos.png"/> benchmarking platform <img src="img/empty.png"/> <a href="http://www.ict-fire.eu/home.html" target="_blank"><img src="img/fire.png" style="width:40px;"/></a> <a href="http://cordis.europa.eu/fp7/ict/home_en.html" target="_blank"><img src="img/eu.png" style="width:40px;"/></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

<?php if($loggedInUser->experiment_ok) {
			if(count($successes) == 0) { $successes[] = "Your experiment is already stored in our platform, you can modify your settings below:"; }
			$fullExp = getExperimentByName($loggedInUser->username);
			
			array_push($dbtimeslots, array('timestamp' => $fullExp['timeslot'], 'id' => $fullExp['timeslotId']));

			$seltimeslot = $fullExp['timeslotId'];
			$testbed = $fullExp['testbed'];
			$approach = $fullExp['approach'];
			$channel = $fullExp['channel'];
			$txpower = $fullExp['txpower'];
			$interference = $fullExp['interference'];
			$robot = $fullExp['path'];
}?>

<?php if(!$demo) { ?>
		<h2>Configure your experiment</h2>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>

			<form class="form-horizontal" name='experiment' action=" <?php $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data">
                            <fieldset>

				
<?php
				if($loggedInUser->experiment_ok) echo "<h3>1. Your selected timeslot:</h3>"; else echo "<h3>1. Select a timeslot</h3>";

				if(count($dbtimeslots) > 0)  {
					echo "<select style=\"width: 300px\" name=\"timeslot\" id='timeslot'";
					if($loggedInUser->experiment_ok) echo " disabled>"; else echo " >";

					echo "<option value=\"-1\">- Select a timeslot -</option>";
					foreach ($dbtimeslots as $timeslot){
						$date = new DateTime($timeslot["timestamp"]);
						$dateShow = date_format($date, 'l jS F Y\, H:i');
						echo "<option value=" . $timeslot["id"] . ">" . $dateShow . "</option>";
					}

					echo "</select>";

				}
				else {
					echo "At the moment, no timeslots are available. Please contact Tom Van Haute (tom.vanhaute@intec.ugent.be).";
				}
				?>

				<br/><br/>
				<h3>2. Select a testbed</h3>
				<select style='width: 300px;' id="testbed" onchange="testbedChange()" name="testbed">
					  <option value="-1">- Select a testbed -</option>
					  <option value="twist">TWIST (TUB Berlin)</option>
					  <option value="wilab1">w.iLab-t I (iMinds Ghent)</option>
					  <option value="wilab2">w.iLab-t II (iMinds Zwijnaarde)</option>
				</select>
				<br/><br/>
				<table class="table table-hover">
					<tr>
						<td width="150" valign="top"><label for="testbedImage">Image</label></td>
						<td>
							<img id='testbedImage'/>
						</td>
					</tr>
					<tr>
						<td width="150" valign="top"><label for="testbedDescription">Description</label></td>
						<td>
							<div align="justify" id="testbedDescription"></div>
						</td>
					</tr>
					<tr>
						<td valign="top"><label for="testbedNodeDetails">Node details</label></td>
						<td>
							<div align="justify" id="testbedNodeDetails"></div>
						</td>
					</tr>
					<tr>
						<td valign="top"><label for="testbedNrOfNodes">Number of nodes</label></td>
						<td>
							<div align="justify" id="testbedNrOfNodes"></div>
						</td>
					</tr>
					<tr>
						<td valign="top"><label for="testbedNrOfFloors">Floors</label></td>
						<td>
							<div align="justify" id="testbedNrOfFloors"></div>
						</td>
					</tr>
					<tr>
						<td width="150" valign="top"><label for="nodemapImage">Map of the nodes</label></td>

						<td>
							<img id='nodemapImage'/>
						</td>
					</tr>
				</table>
				<br/>
				<h2>3. Configure approach</h2>
				<div class="form-group">
					<label class="control-label col-sm-2">Approach</label>
					<div  class="col-sm-10">
					<select style='width: 190px;' id="approach" name="approach">
						  <option value="-1">- Select an approach -</option>
						  <option value="wifi">WiFi</option>
						  <option value="radio">IEEE 802.15.4</option>
					</select>
					</div>
                                </div>

				<div class="form-group">
					<label class="control-label col-sm-2">Channel</label>
					<div  class="col-sm-10">
					<select style='width: 190px;' id="channel" name="channel">
						  <option value="-1">- Select a channel -</option>
						  <option value="1">Channel 1</option>
						  <option value="6">Channel 6</option>
						  <option value="11">Channel 11</option>
					</select>
					</div>
                                </div>
				<div class="form-group">
					<label class="control-label col-sm-2">TX power</label>
					<div  class="col-sm-10">
					<select style='width: 190px;' id="txpower" name="txpower">
						  <option value="-1">- Select a TX power -</option>
						  <option value="-2">-2 dBm</option>
						  <option value="0">0 dBm</option>
						  <option value="2">2 dBm</option>
						  <option value="8">8 dBm</option>
					</select>
					</div>
                                </div>
				<br/><br/>
				<h2>4. Select an interference pattern.</h2>
				<select style='width: 300px;' id="interference" onchange="interferenceChange()" name="interference">
					  <option value="-1">- Select an interference -</option>
					<!-- TUB INTERFERENCE OPTIONS -->
					  <option value="tref" style="display:none;">Reference Scenario</option>
					  <option value="tinsc1" style="display:none;">Interference scenario 1</option>
					  <option value="tinsc2" style="display:none;">Interference scenario 2</option>
					<!-- TUB INTERFERENCE OPTIONS -->
					<!-- WILAB2 INTERFERENCE OPTIONS -->
					  <option value="w2none" style="display:none;">No interference</option>
					  <option value="w2home" style="display:none;">Home environment interference</option>
					  <option value="w2wifi" style="display:none;">Wifi interference</option>
					  <option value="w2synthetic" style="display:none;">Synthetic interference</option>
					<!-- WILAB2 INTERFERENCE OPTIONS -->
					<!-- WILAB1 INTERFERENCE OPTIONS -->
					  <option value="w1none" style="display:none;">No interference</option>
					<!-- WILAB1 INTERFERENCE OPTIONS -->
				</select>
				<br/><br/>			
				<table class="table table-hover">
					<tr>
						<td valign="top"><label for="interferenceDescription">Description</label></td>
						<td>
							<div align="justify" id="interferenceDescription"></div>
						</td>
					</tr>
					<tr>
						<td><label for="interferenceImage">Map</label></td>
						<td valign="top">
							<img id="interferenceImage" />
						</td>
					</tr>
				</table>
				<br/>

				<h2>5. Select your evaluation path.</h2>
				<select style='width: 300px;' id="robot" name="robot" onchange="robotChange()">
				  <option value="-1">- Select a track -</option>
					<!-- TWIST TRACK OPTIONS -->
				  <option value="ttr1" style="display:none;">Track 1 (Big track)</option>
				  <option value="ttr2" style="display:none;">Track 2 (Test track)</option>
					<!-- TWIST TRACK OPTIONS -->
					<!-- WILAB2 TRACK OPTIONS -->
				  <option value="w2tr1" style="display:none;">Track 1 (Large, fine grid)</option>
				  <option value="w2tr2" style="display:none;">Track 2 (Large random track)</option>
				  <option value="w2tr3" style="display:none;">Track 3 (Small random track)</option>
				  <option value="w2tr4" style="display:none;">Track 4 (Open Challenge)</option>
					<!-- WILAB2 TRACK OPTIONS -->
					<!-- WILAB1 TRACK OPTIONS -->
				  <option value="w1tr" style="display:none;">No tracks available</option>
					<!-- WILAB1 TRACK OPTIONS -->
				</select>
				
				<br/><br/><br/>
				<div align="justify" id="trackDetails" style='max-width: 60%;'></div>
				<br/>

				<img id='robotTrackimg' />
				</br></br></br>

				<table>
				<tr>
					<td style="width: 150px;"><input type='submit' name='Submit' value='Send configuration' /></td>
					<td style="width: 25px;"><input type='checkbox' name='demos' id='demos' /></td>
					<td> Demo</td>
				</tr>
				</table>
				</fieldset>
                        </form>
                    </div>
		</div>
            </div>
            <!-- /.row -->
<?php } else { demoStarted($loggedInUser->username, date("Y-m-d H:i:s")); ?>
		
		<script type="text/javascript">
			(function () {
				var timeLeft = 10,
				cinterval;

				var timeDec = function (){
					timeLeft--;
					document.getElementById('countdown').innerHTML = timeLeft;
					if(timeLeft === 0){
						clearInterval(cinterval);
						window.location = "start-experiment.php"
					}
				};

				cinterval = setInterval(timeDec, 1000);
			})();
		</script>

		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Thank you for your contribution.</h3></br></br></br>
				<font size="+8">Your experiment will start in <font color="red" id="countdown">10</font>.</font>
			</div>
		</div>

<?php } ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<?php
echo "<script type='text/javascript'>";

if(isset($seltimeslot)) echo "document.getElementById('timeslot').value = \"" . $seltimeslot . "\";";
if(isset($approach)) echo "document.getElementById('approach').value = \"" . $approach . "\";";
if(isset($channel)) echo "document.getElementById('channel').value = \"" . $channel . "\";";
if(isset($txpower)) echo "document.getElementById('txpower').value = \"" . $txpower . "\";";

echo "window.onload = function() {";
	if(isset($testbed)) echo "document.getElementById('testbed').value = \"" . $testbed . "\";";
	if(isset($testbed)) echo "testbedChange();";
	
	if(isset($interference)) echo "document.getElementById('interference').value = \"" . $interference . "\";";
	if(isset($interference)) echo "interferenceChange();";
	
	if(isset($robot)) echo "document.getElementById('robot').value = \"" . $robot . "\";";
	if(isset($robot)) echo "robotChange();";
echo "};";

echo "</script>";
?>

<?php require_once("models/footerscripts.php"); ?>
</body>
</html>
