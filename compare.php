<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
require_once("models/class.data.php");
require_once("models/class.graphdata.php");
require_once("models/class.graphdata2.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$name = $_POST["name"];
	$apptype = $_POST["apptype"];
	$PA_weight = $_POST["pa_wei"];
	$PA_min = $_POST["pa_min"];
	$PA_max = $_POST["pa_max"];
	$PA_type = $_POST["pa_type"];
	$RA_weight = $_POST["ra_wei"];
	$RA_min = $_POST["ra_min"];
	$RA_max = $_POST["ra_max"];
	$LA_weight = $_POST["la_wei"];
	$LA_min = $_POST["la_min"];
	$LA_max = $_POST["la_max"];
	$LA_type = $_POST["la_type"];
	$EN_weight = $_POST["en_wei"];
	$EN_min = $_POST["en_min"];
	$EN_max = $_POST["en_max"];
	$EN_type = $_POST["en_type"];

	if(empty($name))
	{
		$errors[] = "Please fill in a name for the application profile";
	}

	if(count($errors) == 0) {
		//STORE DATA
		$ap = new appprof($name, $loggedInUser->displayname, $apptype,	$PA_weight, $PA_min, $PA_max,
										$RA_weight, $RA_min, $RA_max,
										$LA_weight, $LA_min, $LA_max,
										$EN_weight, $EN_min, $EN_max,
										$PA_type, $LA_type, $EN_type);

		$result = $ap->AddApplicationProfileToDB();

		if($result) {
			$successes[] = "The application profile was added succesfully!";
		}
	}
}

require_once("models/header.php");

$part1 = isset($_GET['profile']);
$part2 = isset($_GET['experiments']);

$expobj = null;
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
	<?php echo resultBlock($errors,$successes); ?>
		<h3>Compare results</h3>

<!-- ***** PART I ***** -->
<?php if(!$part1) { ?>

	<ol class='progtrckr'>
	    <li class='progtrckr-current'>Select application profile</li><!--
	    --><li class='progtrckr-todo'>Select experiments</li><!--
	    --><li class='progtrckr-todo'>Compare results</li>
	</ol>
	<br />
	<br />
	<br />


	<h4>Select your application profile:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Application profile</th>
					<th>Type</th>
					<th>Created by</th>
					<th>Created on</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>

<?php
	$profiles = fetchAllApplicationProfiles();
	if(!empty($profiles)) {
		foreach ($profiles as $profile){
		    echo "<tr>\n";
		    echo "<td>" . $profile["name"] . "</td>\n";
		    echo "<td>" . $profile["type"] . "</td>\n";
		    echo "<td>" . $profile["createdBy"] . "</td>\n";
		    echo "<td>" . $profile["timestamp"] . "</td>\n";
		    echo "<td><a href='" . newURL_with_extra_parameter('profile', $profile["id"]) . "' type='button' class='btn btn-success'>Select</a></td>\n";
		    echo "</tr>";
		}
	}
	else {
		    echo "<tr colspan=\"5\">
				<td>No application profiles in our platform yet. Please add a new profile below.</td>
			   </tr>";
	}
?>
			</tbody>
		</table>

		<br/><br/>
	<h4>Create a new application profile:</h4>

	<div class="panel panel-default">
	   <div class="panel-body">
		<form class="form-horizontal" name='adminConfiguration' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
	            <fieldset>
	                <div class="form-group">
				<label class="control-label col-sm-2">Name:</label>
				<div  class="col-sm-10">
				<input class="form-control" type="text" name="name"  value="" />
				</div>
	                </div>
			<br/>
			<div class="form-group">
				<label class="control-label col-sm-2">Metric data:</label>
			    <div  class="col-sm-10">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Metric</th>
						<th>Weight factor</th>
						<th>Minimum points (0 or worse)</th>
						<th>Maximum points (10 or better)</th>
						<th>Metric type</th>
					</tr>
				</thead>
				<tbody>
			<tr>
				<td>Point accuracy [m]</td>
				<td><input class="form-control" type="text" name="pa_wei"  value="" /></td>
				<td><input class="form-control" type="text" name="pa_min"  value="" /></td>
				<td><input class="form-control" type="text" name="pa_max"  value="" /></td>
				<td><select class="form-control" name="pa_type" id="pa_type">
					<option value='-1'>-Select type -</option>
					<option value='rms'>RMS</option>
					<option value='minimum'>Minimum</option>
					<option value='maximum'>Maximum</option>
					<option value='average'>Average</option>
					<option value='median'>Median</option>
					<option value='variance'>Variance</option>
					<option value='75'>75 percentile</option>
					<option value='90'>90 percentile</option>
				</select></td>
			</tr>
			<tr>
				<td>Point accuracy [m]</td>
				<td><input class="form-control" type="text" name="pa_wei2"  value="" /></td>
				<td><input class="form-control" type="text" name="pa_min2"  value="" /></td>
				<td><input class="form-control" type="text" name="pa_max2"  value="" /></td>
				<td><select class="form-control" name="pa_type2" id="pa_type2">
					<option value='-1'>-Select type -</option>
					<option value='rms'>RMS</option>
					<option value='minimum'>Minimum</option>
					<option value='maximum'>Maximum</option>
					<option value='average'>Average</option>
					<option value='median'>Median</option>
					<option value='variance'>Variance</option>
					<option value='75'>75 percentile</option>
					<option value='90'>90 percentile</option>
				</select></td>
			</tr>
			<tr>
				<td>Room accuracy [%]</td>
				<td><input class="form-control" type="text" name="ra_wei"  value="" /></td>
				<td><input class="form-control" type="text" name="ra_min"  value="" /></td>
				<td><input class="form-control" type="text" name="ra_max"  value="" /></td>
				<td><select class="form-control" name="ra_type" id="ra_type">
					<option value='average'>Average</option>
				</select></td>
			</tr>
			<tr>
				<td>Latency [ms]</td>
				<td><input class="form-control" type="text" name="la_wei"  value="" /></td>
				<td><input class="form-control" type="text" name="la_min"  value="" /></td>
				<td><input class="form-control" type="text" name="la_max"  value="" /></td>
				<td><select class="form-control" name="la_type" id="la_type">
					<option value='-1'>-Select type -</option>
					<option value='rms'>RMS</option>
					<option value='minimum'>Minimum</option>
					<option value='maximum'>Maximum</option>
					<option value='average'>Average</option>
					<option value='median'>Median</option>
					<option value='variance'>Variance</option>
					<option value='75'>75 percentile</option>
					<option value='90'>90 percentile</option>
				</select></td>
			</tr>
			<tr>
				<td>Energy consumption [mW]</td>
				<td><input class="form-control" type="text" name="en_wei"  value="" /></td>
				<td><input class="form-control" type="text" name="en_min"  value="" /></td>
				<td><input class="form-control" type="text" name="en_max"  value="" /></td>
				<td><select class="form-control" name="en_type" id="en_type">
					<option value='-1'>-Select type -</option>
					<option value='rms'>RMS</option>
					<option value='minimum'>Minimum</option>
					<option value='maximum'>Maximum</option>
					<option value='average'>Average</option>
					<option value='median'>Median</option>
					<option value='variance'>Variance</option>
					<option value='75'>75 percentile</option>
					<option value='90'>90 percentile</option>
				</select></td>
			</tr>
				</tbody>
			</table>
			</div>
		    </div>
			<br/>
			<div class="form-group">
				<label class="control-label col-sm-2">Type:</label>
				<div  class="col-sm-10">
					<select class="form-control" name="apptype" id="apptype	">
						<option value='linear'>Linear</option>
						<option value='other'>Hyperbole</option>
					</select>
				</div>
	                </div>
			<div class="form-group">
				<label class="control-label col-sm-2">Upload custom profile:</label>
				<div  class="col-sm-10">
					<input  type="file">
				</div>
	                </div>
			<br/>
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Add application profile</button>
			    </div>
			</div>
                    </fieldset>
                </form>
            </div>
	</div>


<!-- ***** PART II ***** -->
<?php
 } elseif(!$part2) {?>

	<ol class='progtrckr'>
            <li class='progtrckr-done'>Select database</li><!--
            --><li class='progtrckr-current'>Select experiment</li><!--
            --><li class='progtrckr-todo'>View metric results</li>
        </ol>
	<br />
	<br />

	<div id="progress" class="progress"></div>
	<div id="information" style="width"></div>
	<br />
	<br />
	<a class="btn btn-danger disabled" type="button" id="compareButton" href=>0 experiments selected</a>
	<br />
	<br />

	<h4>Select your experiment:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Rank</th>
					<th>Experiment</th>
					<th>SUT Name</th>
					<th>Database</th>
					<th>Score</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>

<?php
	$exps = get_all_experiments();
	foreach($exps as $ex) {
	    echo "<tr>\n";
		    echo "<td>$ex->id</th>\n";
		    echo "<td>$ex->name</td>\n";
		    echo "<td>$ex->sutname</td>\n";
		    echo "<td>$ex->dbname</td>\n";
		    echo "<td><b>$ex->score</b></td>\n";
		    echo "<td><input type=\"checkbox\" name=\"check_list\" value=" . $ex->id . " onchange=\"checkBoxClick(this);\"></input></td>\n";
	    echo "</tr>";
	}
?>
			</tbody>
		</table>

		<script type="text/javascript">
			var count = 0;
			var ids = [];

			function checkBoxClick(src) {
				if(src.checked == true){
				 count++;
				 ids.push(src.value);
				}else{
				 count--;
				 var index = ids.indexOf(src.value);
				 ids.splice(index,1);
				}
				
				if(count > 2) {
					document.getElementById("compareButton").innerHTML =  count + ' experiments selected, compare details only';
					document.getElementById("compareButton").className = 'btn btn-danger';
					document.getElementById("compareButton").href = window.location.href + "&experiments=" + ids.join();
				}
				else if(count == 2) {
					document.getElementById("compareButton").className = 'btn btn-danger';
					document.getElementById("compareButton").innerHTML =  count + ' experiments selected, compare everything!';
					document.getElementById("compareButton").href = window.location.href + "&experiments=" + ids.join();
				}
				else if(count == 1) {
					document.getElementById("compareButton").innerHTML = '1 experiment selected';
					document.getElementById("compareButton").className = 'btn btn-danger disabled';
				}
				else {
					document.getElementById("compareButton").innerHTML = count + ' experiments selected';
					document.getElementById("compareButton").className = 'btn btn-danger disabled';
				}
			}

		</script>

<!-- ***** PART III ***** -->
<?} else {?>
	<ol class='progtrckr'>
	    <li class='progtrckr-done'>Select database</li><!--
	    --><li class='progtrckr-done'>Select experiment</li><!--
	    --><li class='progtrckr-current'>View metric results</li>
	</ol>
	<br />
	<br />
	<br />

	<h4>Data visualization:</h4>
	<br/>

<?php get_experiments_data(); ?>
<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseScoreDetails">Score details</a>
				</h4>
			</div>
			<div id="collapseScoreDetails" class="panel-collapse collapse in">
				<div class="panel-body">
					<?php printScoreDetails(); ?>
				</div>
			</div>
		</div>



		<?php if(substr_count($_GET['experiments'], ',') == 1) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseHeatmap">Heatmap</a>
					</h4>
				</div>
				<div id="collapseHeatmap" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php printHeatMaps(); ?>
					</div>
				</div>
			</div>


			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2derror">2D error</a>
					</h4>
				</div>
				<div id="collapse2derror" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php print2Derror(); ?>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseLatency">Latency</a>
					</h4>
				</div>
				<div id="collapseLatency" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php printLatency(); ?>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseRoomAccuracy">Room accuracy</a>
					</h4>
				</div>
				<div id="collapseRoomAccuracy" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php printRoomAccuracy(); ?>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseDetails">Details</a>
					</h4>
				</div>
				<div id="collapseDetails" class="panel-collapse collapse in">
					<div class="panel-body">
						<?php printDetails(); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php } ?>


 </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php require_once("models/footerscripts.php"); ?>
</body>

</html>
<div id='bottom'></div>
</div>
</body>
</html>



<?php
/*******************************************/
/*****************FUNCTIONS*****************/
/*******************************************/

function newURL_with_extra_parameter($key, $val) {
	$params = array_merge($_GET, array($key => $val));
	$new_query_string = http_build_query($params);

	return "compare.php?" . $new_query_string;
}


function get_all_experiments() {
	global $appProfDet;

	$appProfDet = fetchApplicationProfileById($_GET['profile']);
	$finalExpScore = array();

	$url = 'http://ebp.evarilos.eu:5001/evarilos/metrics/v1.0/database';
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$finalDbs = (array)json_decode($data);
	ksort($finalDbs);

	$i = 1;
	while (list($key, $value) = each($finalDbs)) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $value);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		$finalExps = (array)json_decode($data);

		while (list($key2, $value2) = each($finalExps)) {
			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $value2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$data = curl_exec($ch);
			curl_close($ch);
			$finaldata = json_decode($data);
			
			array_push($finalExpScore, new expscore($i, $key2, $finaldata->sut->sut_name, $key, calculateTotalScore($finaldata), $value2));

			echo '<script language="javascript">
				document.getElementById("progress").innerHTML="<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"80\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:'.$i.'%\"></div>";
				document.getElementById("information").innerHTML="<b>'.$i.' experiments processed.</b> Calculating scores...  <img src=\"img/loading.gif\" />";
				</script>';

			ob_flush(); 
			flush();
			$i++;
		}
		
	}

	//Sort array
	usort($finalExpScore, "sortByScore");
	//Redefine IDs
	$finalCount = 1;
	foreach ($finalExpScore as &$e) {
		$e->id = $finalCount++;
	}

	echo '<script language="javascript">
		document.getElementById("progress").innerHTML="<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"80\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:100%\"></div>";
		document.getElementById("information").innerHTML="'.$i.' experiments processed. <b>Everything done!</b>";
		</script>'; 
	ob_flush(); 
	flush();


	$_SESSION["experiments"] = $finalExpScore; 
	return $finalExpScore;
}

function calculateTotalScore($currentExperiment) {
	global $appProfDet;

	$totalScore = 0;

	//POINT ACCURACY
	// y = (10 / (PA_max - PA_min) ) * ( x - PA_min)
	$PA_score = 0;
if(($appProfDet['PA_max'] - $appProfDet['PA_min']) != 0) {

	if(strcasecmp($appProfDet['PA_type'],'RMS') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_rms - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Minimum') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_min - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Maximum') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_max - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Average') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_average - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Median') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_median - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Variance') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_variance - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'75th Percentile') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_75_percentile - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'90th percentile') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_90_percentile - $appProfDet['PA_min']);
	}

	if($PA_score > 10) $PA_score = 10;
	if($PA_score < 0) $PA_score = 0;
}
else {
	$PA_score = 0;
}

	//ROOM ACCURACY
	// y = (10 / (RA_max - RA_min) ) * ( x - RA_min)
if(($appProfDet['RA_max'] - $appProfDet['RA_min']) !=0) {
	$RA_score = (10 / ($appProfDet['RA_max'] - $appProfDet['RA_min']) ) * ( $currentExperiment->primary_metrics->room_accuracy_error_average*100 - $appProfDet['RA_min']);
	if($RA_score > 10) $RA_score = 10;
	if($RA_score < 0) $RA_score = 0;
}
else {
	$RA_score = 0;
}

	//LATENCY
	// y = (10 / (LA_max - LA_min) ) * ( x - LA_min)
if(($appProfDet['LA_max'] - $appProfDet['LA_min']) !=0) {

	if(strcasecmp($appProfDet['LA_type'],'RMS') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_rms - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Minimum') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_min - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Maximum') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_max - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Average') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_average - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Median') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_median - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Variance') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_variance - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'75th Percentile') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_75_percentile - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'90th percentile') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_90_percentile - $appProfDet['LA_min']);
	}



	if($LA_score > 10) $LA_score = 10;
	if($LA_score < 0) $LA_score = 0;
}
else {
	$LA_score = 0;
}

	//ENERGY
	// y = (10 / (EN_max - EN_min) ) * ( x - EN_min)
if(($appProfDet['EN_max'] - $appProfDet['EN_min']) !=0) {
	
	if(strcasecmp($appProfDet['EN_type'],'RMS') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_rms - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'Minimum') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_min - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'Maximum') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_max - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'Average') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_average - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'Median') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_median - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'Variance') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_variance - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'75th Percentile') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_75_percentile - $appProfDet['EN_min']);
	}

	if(strcasecmp($appProfDet['EN_type'],'90th percentile') == 0) {
		$EN_score = (10 / ($appProfDet['EN_max'] - $appProfDet['EN_min']) ) * ( $currentExperiment->primary_metrics->latency_90_percentile - $appProfDet['EN_min']);
	}

	if($EN_score > 10) $EN_score = 10;
	if($EN_score < 0) $EN_score = 0;
}
else {
	$EN_score = 0;
}

	$totalScore = ($appProfDet['PA_weight'] * $PA_score) + ($appProfDet['RA_weight'] * $RA_score) + ($appProfDet['LA_weight'] * $LA_score);
	return number_format($totalScore, 2, '.', '');
}

function calculatePointAccuracy($currentExperiment)
{
	global $appProfDet;
	//POINT ACCURACY
	// y = (10 / (PA_max - PA_min) ) * ( x - PA_min)
	$PA_score = 0;
if(($appProfDet['PA_max'] - $appProfDet['PA_min']) != 0) {

	if(strcasecmp($appProfDet['PA_type'],'RMS') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_rms - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Minimum') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_min - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Maximum') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_max - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Average') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_average - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Median') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_median - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'Variance') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_variance - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'75th Percentile') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_75_percentile - $appProfDet['PA_min']);
	}

	if(strcasecmp($appProfDet['PA_type'],'90th percentile') == 0) {
		$PA_score = (10 / ($appProfDet['PA_max'] - $appProfDet['PA_min']) ) * ( $currentExperiment->primary_metrics->accuracy_error_2D_90_percentile - $appProfDet['PA_min']);
	}

	if($PA_score > 10) $PA_score = 10;
	if($PA_score < 0) $PA_score = 0;
}
else {
	$PA_score = 0;
}
	return number_format($PA_score, 2, '.', '');
}

function calculateRoomAccuracy($currentExperiment)
{
	global $appProfDet;
	//ROOM ACCURACY
	// y = (10 / (RA_max - RA_min) ) * ( x - RA_min)
if(($appProfDet['RA_max'] - $appProfDet['RA_min']) !=0) {
	$RA_score = (10 / ($appProfDet['RA_max'] - $appProfDet['RA_min']) ) * ( $currentExperiment->primary_metrics->room_accuracy_error_average*100 - $appProfDet['RA_min']);
	if($RA_score > 10) $RA_score = 10;
	if($RA_score < 0) $RA_score = 0;
}
else {
	$RA_score = 0;
}
	return number_format($RA_score, 2, '.', '');
}

function calculateLatency($currentExperiment)
{
	global $appProfDet;
	//LATENCY
	// y = (10 / (LA_max - LA_min) ) * ( x - LA_min)
if(($appProfDet['LA_max'] - $appProfDet['LA_min']) !=0) {

	if(strcasecmp($appProfDet['LA_type'],'RMS') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_rms - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Minimum') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_min - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Maximum') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_max - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Average') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_average - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Median') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_median - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'Variance') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_variance - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'75th Percentile') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_75_percentile - $appProfDet['LA_min']);
	}

	if(strcasecmp($appProfDet['LA_type'],'90th percentile') == 0) {
		$LA_score = (10 / ($appProfDet['LA_max'] - $appProfDet['LA_min']) ) * ( $currentExperiment->primary_metrics->latency_90_percentile - $appProfDet['LA_min']);
	}



	if($LA_score > 10) $LA_score = 10;
	if($LA_score < 0) $LA_score = 0;
}
else {
	$LA_score = 0;
}

	return number_format($LA_score, 2, '.', '');
}

function calculateEnergy($currentExperiment)
{
	global $appProfDet;
	return "0.00";
}

function get_experiments_data() {

	if(!isset($_SESSION["experiments"]))
	{
		echo	'<script language="javascript">
				window.location = "http://evarilos.intec.ugent.be/compare.php";
			</script>'; 
	}

	$ids = explode(",", $_GET['experiments']);
	$sessie = $_SESSION["experiments"] ;
	$timeout = 5;

	global $exp1;
	global $exp2;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $sessie[$ids[0]-1]->url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$exp1 = json_decode($data);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $sessie[$ids[1]-1]->url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$exp2 = json_decode($data);
}

function printScoreDetails() {
	global $appProfDet;

	$appProfDet = fetchApplicationProfileById($_GET['profile']);

	$ids = explode(",", $_GET['experiments']);
	$sessie = $_SESSION["experiments"] ;
	$timeout = 5;
	
	echo "
	<table class=\"table table-hover\">
		<thead>
			<tr>
				<th>SUT</th>
				<th colspan='2'>Point accuracy<br/><font size='-1' color='grey'>" . $appProfDet['PA_type'] . "</font></th>
				<th colspan='2'>Room accuracy<br/><font size='-1' color='grey'>Average</font></th>
				<th colspan='2'>Latency<br/><font size='-1' color='grey'>" . $appProfDet['LA_type'] . "</font></th>
				<th colspan='2'>Energy<br/><font size='-1' color='grey'>" . $appProfDet['EN_type'] . "</font</th>
				<th></th>
				<th><b>TOTAL</b></th>
			</tr>
		</thead>
		<tbody>";

		foreach($ids as $e)
		{

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $sessie[$e-1]->url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$data = curl_exec($ch);
				curl_close($ch);
				$ce = json_decode($data);

		echo "	<tr>
				<td style='vertical-align: middle;'>" . $ce->sut->sut_name . "</td>
				<td width='65px'  style='vertical-align: middle;'><font size='+2'>" . calculatePointAccuracy($ce) . "</font></td>
				<td width='100px' style='vertical-align: middle;'>x " . $appProfDet['PA_weight'] . "</td>
				<td width='65px'  style='vertical-align: middle;'><font size='+2'>" . calculateRoomAccuracy($ce) . "</font></td>
				<td width='100px' style='vertical-align: middle;'>x " . $appProfDet['RA_weight'] . "</td>
				<td width='65px'  style='vertical-align: middle;'><font size='+2'>" . calculateLatency($ce) . "</font></td>
				<td width='100px' style='vertical-align: middle;'>x " . $appProfDet['LA_weight'] . "</td>
				<td width='65px'  style='vertical-align: middle;'><font size='+2'>" . calculateEnergy($ce) . "</font></td>
				<td width='60px'  style='vertical-align: middle;'>x " . $appProfDet['EN_weight'] . "</td>
				<td width='10px'  style='vertical-align: middle;'><font size='+2'>=</font></td>
				<td width='100px' style='vertical-align: middle;'><font size='+3'><b>" . calculateTotalScore($ce) . "</b></font></td>
			</tr>";
		}

	echo "
		</tbody>
	</table>
	</br>";

}


function printHeatMaps() {
	global $exp1;
	global $exp2;
	global $testbedId1;
	global $testbedId2;

	//1st HEATMAP
	if(strpos(strtolower($exp1->scenario->testbed_label), 'hospital') !== FALSE) {
		echo "<div id='heatmapContainerWrapperT'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/televic.png);'></div>";
		$testbedId1 = 8;
	}

	if(strpos(strtolower($exp1->scenario->testbed_label), 'tkn testbed') !== FALSE ||
		strpos(strtolower($exp1->scenario->testbed_label), 'twist') !== FALSE) {
		echo "<div id='heatmapContainerWrapperTwist'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/twist.png);'></div>";
		$testbedId1 = 1;
	}

	if(strpos(strtolower($exp1->scenario->testbed_label), 'wilabt1') !== FALSE ||
		strpos(strtolower($exp1->scenario->testbed_label), 'w-ilab.t1') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW1'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/wilab1.png);'></div>";
		$testbedId1 = 2;
	}

	if(strpos(strtolower($exp1->scenario->testbed_label), 'wilabt2') !== FALSE ||
		strpos(strtolower($exp1->scenario->testbed_label), 'w-ilab.t2') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW2'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/wilab2.png);'></div>";
		$testbedId1 = 3;
	}

	if(strpos(strtolower($exp1->scenario->testbed_label), 'mine') !== FALSE) {
		echo "<div id='heatmapContainerWrapperM'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/mine.png);'></div>";
		$testbedId1 = 7;
	}


	echo "	<div id='heatmapLegend1'>
			<h4>Error distance [m]</h4>

			<span id='min1'></span>
			<span id='max1'></span>
			<img id='gradient1' src='' style='width:100%' />
		</div>
	</div>";


	if($testbedId1 == 8) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId1 == 1) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId1 == 2) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId1 == 3) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId1 == 7) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}
	
	
	//2nd HEATMAP
	if(strpos(strtolower($exp2->scenario->testbed_label), 'hospital') !== FALSE) {
		echo "<div id='heatmapContainerWrapperT'>
		<div id='heatmapContainer2' style='background-image: url(/img/heatmapback/televic.png);'></div>";
		$testbedId2 = 8;
	}

	if(strpos(strtolower($exp2->scenario->testbed_label), 'tkn testbed') !== FALSE ||
		strpos(strtolower($exp2->scenario->testbed_label), 'twist') !== FALSE) {
		echo "<div id='heatmapContainerWrapperTwist'>
		<div id='heatmapContainer2' style='background-image: url(/img/heatmapback/twist.png);'></div>";
		$testbedId2 = 1;
	}

	if(strpos(strtolower($exp2->scenario->testbed_label), 'wilabt1') !== FALSE ||
		strpos(strtolower($exp2->scenario->testbed_label), 'w-ilab.t1') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW1'>
		<div id='heatmapContainer2' style='background-image: url(/img/heatmapback/wilab1.png);'></div>";
		$testbedId2 = 2;
	}

	if(strpos(strtolower($exp2->scenario->testbed_label), 'wilabt2') !== FALSE ||
		strpos(strtolower($exp2->scenario->testbed_label), 'w-ilab.t2') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW2'>
		<div id='heatmapContainer2' style='background-image: url(/img/heatmapback/wilab2.png);'></div>";
		$testbedId2 = 3;
	}

	if(strpos(strtolower($exp2->scenario->testbed_label), 'mine') !== FALSE) {
		echo "<div id='heatmapContainerWrapperM'>
		<div id='heatmapContainer2' style='background-image: url(/img/heatmapback/mine.png);'></div>";
		$testbedId2 = 7;
	}


	echo "	<div id='heatmapLegend2'>
			<h4>Error distance [m]</h4>

			<span id='min2'></span>
			<span id='max2'></span>
			<img id='gradient2' src='' style='width:100%' />
		</div>
	</div>";


	if($testbedId2 == 8) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId2 == 1) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId2 == 2) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId2 == 3) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId2 == 7) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}
	


	$allData1 = array();
	foreach ($exp1->locations as $loc) {
		array_push($allData1, Data::TestBedError($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId1, $loc->localization_error_2D, $loc->point_id));
	}

	$allData2 = array();
	foreach ($exp2->locations as $loc) {
		array_push($allData2, Data::TestBedError($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId2, $loc->localization_error_2D, $loc->point_id));
	}

	echo "
		 <script>
			window.onload = function() {
				// helper function
				function $(id) {
					return document.getElementById(id);
				};

				/* legend code 1*/
				var legendCanvas1 = document.createElement('canvas');
				legendCanvas1.width = 100;
				legendCanvas1.height = 10;
				var legendCtx1 = legendCanvas1.getContext('2d');
				var gradientCfg1 = {};

				function updateLegend1(data) {

					$('min1').innerHTML = data.min;
					$('max1').innerHTML = data.max;
					// regenerate gradient image
					if (data.gradient != gradientCfg1) {
						gradientCfg1 = data.gradient;

						var gradient1 = legendCtx1.createLinearGradient(0, 0, 100, 1);
						for (var key in gradientCfg1) {
							gradient1.addColorStop(key, gradientCfg1[key]);
						}

						legendCtx1.fillStyle = gradient1;
						legendCtx1.fillRect(0, 0, 100, 10);
						$('gradient1').src = legendCanvas1.toDataURL();
					}
				};
				/* legend code end */

				/* legend code 2*/
				var legendCanvas2 = document.createElement('canvas');
				legendCanvas2.width = 100;
				legendCanvas2.height = 10;
				var legendCtx2 = legendCanvas2.getContext('2d');
				var gradientCfg2 = {};

				function updateLegend2(data) {
					$('min2').innerHTML = data.min;
					$('max2').innerHTML = data.max;
					// regenerate gradient image
					if (data.gradient != gradientCfg2) {
						gradientCfg2 = data.gradient;
						var gradient2 = legendCtx2.createLinearGradient(0, 0, 100, 1);
						for (var key in gradientCfg2) {
							gradient2.addColorStop(key, gradientCfg2[key]);
						}

						legendCtx2.fillStyle = gradient2;
						legendCtx2.fillRect(0, 0, 100, 10);
						$('gradient2').src = legendCanvas2.toDataURL();
					}
				};
				/* legend code end */


				// create a heatmap instance
				var heatmap1 = h337.create({
					container: document.getElementById('heatmapContainer1'),
					maxOpacity: .5,
					radius: 10,
					blur: .75,
					onExtremaChange: function onExtremaChange(data) {
						updateLegend1(data);
					}
				});

				var heatmap2 = h337.create({
					container: document.getElementById('heatmapContainer2'),
					maxOpacity: .5,
					radius: 10,
					blur: .75,
					// update the legend whenever there's an extrema change
					onExtremaChange: function onExtremaChange(data) {
						updateLegend2(data);
					}
				});

				var generate = function() {
					var t1 = [];
					var t2 = [];";

					$min = 9000;
					$max = -1;
					foreach ($allData1 as $singleData) {
						$x = $singleData->x;
						$y = $singleData->y;
						$c = $singleData->errorDistance;

						if($c > $max) {
							$max = $c;
						}
						if($c < $min) {
							$min = $c;
						}

						$r = 85;
						echo "t1.push({ x: $x, y: $y, value: $c, radius: $r});\n";
					}

					foreach ($allData2 as $singleData) {
						$x = $singleData->x;
						$y = $singleData->y;
						$c = $singleData->errorDistance;

						if($c > $max) {
							$max = $c;
						}
						if($c < $min) {
							$min = $c;
						}

						$r = 85;
						echo "t2.push({ x: $x, y: $y, value: $c, radius: $r});\n";
					}

				echo "
					var max = $max;
					var min = $min;

					// the generated dataset
					heatmap1.setData({
						min: min,
						max: max,
						data: t1
					});

					// the generated dataset
					heatmap2.setData({
						min: min,
						max: max,
						data: t2
					});
				};

				// initial generate
				generate();
			};
		</script>";
}


function print2Derror() {
	global $exp1;
	global $exp2;
	global $testbedId1;
	global $testbedId2;

	//var_dump($exp1->locations);
	if($testbedId1 == $testbedId2) {
		$array2derror = [];
		for ($i = 0; $i < count($exp1->locations); $i++) {
			array_push($array2derror, new graphdata2($exp1->locations[$i]->true_coordinate_x, $exp1->locations[$i]->true_coordinate_y, $testbedId1, $exp1->locations[$i]->localization_error_2D, $exp2->locations[$i]->localization_error_2D, $exp1->locations[$i]->point_id));
		}

		usort($array2derror, "sortById");
		$json2derror = json_encode($array2derror);

		echo "<div id=\"morris-bar-2derror\"></div>";

		echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";
		echo "<script>";

		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-2derror',
			data:" . $json2derror . ",
			xkey: 'name',
			ykeys: ['sol1', 'sol2'],
			labels: ['Triangulation [m]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#555753', '#CC0000'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.sol1 + \"m & \" + row.sol2 + \"m\";
				}
		    });
			});";

		echo "</script>";
	}

	else {
		$array2derror1 = [];
		foreach ($exp1->locations as $loc) {
			array_push($array2derror1, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId1, $loc->localization_error_2D, $loc->point_id));
		}
		usort($array2derror1, "sortById");

		$json2derror1 = json_encode($array2derror1);

		$array2derror2 = [];
		foreach ($exp2->locations as $loc) {
			array_push($array2derror2, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId2, $loc->localization_error_2D, $loc->point_id));
		}
		usort($array2derror2, "sortById");

		$json2derror2 = json_encode($array2derror2);

		echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";

		echo "<div id=\"morris-bar-2derror1\"></div>";

		echo "<script>";
		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-2derror1',
			data:" . $json2derror1 . ",
			xkey: 'name',
			ykeys: ['value'],
			labels: ['Triangulation [m]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#555753'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.value + \"m\";
				}
		    });
			});";
		echo "</script>";

		echo "<div id=\"morris-bar-2derror2\"></div>";
		echo "<script>";
		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-2derror2',
			data:" . $json2derror2 . ",
			xkey: 'name',
			ykeys: ['value'],
			labels: ['Triangulation [m]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#CC0000'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.value + \"m\";
				}
		    });
			});";
		echo "</script>";
	}
}

function printLatency() {
	global $exp1;
	global $exp2;
	global $testbedId1;
	global $testbedId2;

	if($testbedId1 == $testbedId2) {
		$arrayLatency = [];
		for ($i = 0; $i < count($exp1->locations); $i++) {
			array_push($arrayLatency, new graphdata2($exp1->locations[$i]->true_coordinate_x, $exp1->locations[$i]->true_coordinate_y, $testbedId1, $exp1->locations[$i]->latency, $exp2->locations[$i]->latency, $exp1->locations[$i]->point_id));
		}
		usort($arrayLatency, "sortById");
		$jsonLatency = json_encode($arrayLatency);

		echo "<div id=\"morris-bar-latency\"></div>";

		echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";
		echo "<script>";

		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-latency',
			data:" . $jsonLatency . ",
			xkey: 'name',
			ykeys: ['sol1', 'sol2'],
			labels: ['Triangulation [ms]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#555753', '#CC0000'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.sol1 + \"ms & \" + row.sol2 + \"ms\";
				}
		    });
			});";

		echo "</script>";
	}

	else {
		$arrayLatency1 = [];
		foreach ($exp1->locations as $loc) {
			array_push($arrayLatency1, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId1, $loc->latency, $loc->point_id));
		}
		usort($arrayLatency1, "sortById");
		$jsonLatency1 = json_encode($arrayLatency1);

		$arrayLatency2 = [];
		foreach ($exp2->locations as $loc) {
			array_push($arrayLatency2, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId2, $loc->latency, $loc->point_id));
		}
		usort($arrayLatency2, "sortById");
		$jsonLatency2 = json_encode($arrayLatency2);

		echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";

		echo "<div id=\"morris-bar-latency1\"></div>";
		echo "<script>";
		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-latency1',
			data:" . $jsonLatency1 . ",
			xkey: 'name',
			ykeys: ['value'],
			labels: ['Triangulation [ms]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#555753'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.value + \"ms\";
				}
		    });
			});";
		echo "</script>";

		echo "<div id=\"morris-bar-latency2\"></div>";
		echo "<script>";
		echo "$(function() {
			Morris.Bar({
			element: 'morris-bar-latency2',
			data:" . $jsonLatency2 . ",
			xkey: 'name',
			ykeys: ['value'],
			labels: ['Triangulation [ms]'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#CC0000'],
			hoverCallback: function (index, options, content, row) {
				  return \"Location \" + row.name + \":  \" + row.value + \"ms\";
				}
		    });
			});";
		echo "</script>";
	}
}

function printRoomAccuracy() {
	global $exp1;
	global $exp2;

	echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";

	echo "<h2>" . $exp1->sut->sut_name . "</h2>";
	echo "<div id=\"morris-donut-room1\"></div>";
	echo "<script>";
	echo "$(function() {
		Morris.Donut({
		  element: 'morris-donut-room1',
		  data: [
		    {label: \"Correct room\", value: " . round($exp1->primary_metrics->room_accuracy_error_average*100,2) . "},
		    {label: \"Wrong room\", value: " . round((1-$exp1->primary_metrics->room_accuracy_error_average)*100,2) . "},
		  ],
		  colors: ['#6dc066','#ff4040'],
		  formatter: function (y, data) { return y + '%' } 
		});
		});";
	echo "</script>";

	echo "<h2>" . $exp2->sut->sut_name . "</h2>";
	echo "<div id=\"morris-donut-room2\"></div>";
	echo "<script>";
	echo "$(function() {
		Morris.Donut({
		  element: 'morris-donut-room2',
		  data: [
		    {label: \"Correct room\", value: " . round($exp2->primary_metrics->room_accuracy_error_average*100,2) . "},
		    {label: \"Wrong room\", value: " . round((1-$exp2->primary_metrics->room_accuracy_error_average)*100,2) . "},
		  ],
		  colors: ['#6dc066','#ff4040'],
		  formatter: function (y, data) { return y + '%' } 
		});
		});";
	echo "</script>";
}

function printDetails() {
	global $exp1;
	global $exp2;

	$array1 = [];
	$array2 = [];

	foreach ($exp1->locations as $loc) {
		array_push($array1, "1");
	}	

	foreach ($exp2->locations as $loc) {
		array_push($array2, "1");
	}
	
	echo "
	<div>
	<table class=\"table table-hover\">
		<thead>
			<tr>
				<td colspan='3' align='center'>General details</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width='200px'>Timestamp</td>
				<td>" . gmdate("d/m/Y  H:i:s", $exp1->timestamp_utc/1000) . "</td>
				<td>" . gmdate("d/m/Y  H:i:s", $exp2->timestamp_utc/1000) . "</td>
			</tr>
			<tr>
				<td>SUT</td>
				<td>" . $exp1->sut->sut_name . "</td>
				<td>" . $exp2->sut->sut_name . "</td>
			</tr>
		</tbody>
	</table>
	</br>
	<table  class=\"table table-hover\">
		<tr>
			<td colspan='3' align='center'>Scenario details</td>
		</tr>
		<tr>
			<td width='200px'>Testbed label</td>
			<td>" . $exp1->scenario->testbed_label . "</td>
			<td>" . $exp2->scenario->testbed_label . "</td>
		</tr>
		<tr>
			<td>Testbed description</td>
			<td>" . $exp1->scenario->testbed_description . "</td>
			<td>" . $exp2->scenario->testbed_description . "</td>
		</tr>
		<tr>
			<td>Experiment description</td>
			<td>" . $exp1->scenario->experiment_description . "</td>
			<td>" . $exp2->scenario->experiment_description . "</td>
		</tr>
		<tr>
			<td>Sender description</td>
			<td>" . $exp1->scenario->sender_description . "</td>
			<td>" . $exp2->scenario->sender_description . "</td>
		</tr>
		<tr>
			<td>Receiver description</td>
			<td>" . $exp1->scenario->receiver_description . "</td>
			<td>" . $exp2->scenario->receiver_description . "</td>
		</tr>
		<tr>
			<td>Interference description</td>
			<td>" . $exp1->scenario->interference_description . "</td>
			<td>" . $exp2->scenario->interference_description . "</td>
		</tr>
		<tr>
			<td>Number of measurement locations</td>
			<td>" . count($array1) . "</td>
			<td>" . count($array2) . "</td>
		</tr>
	</table>
	</br>
	<table  class=\"table table-hover\">
		<tr>
			<td colspan='7' align='center'>Primary metrics</td>
		</tr>
		<tr>
			<td width='200px'><b>Metric</b></td>
			<td colspan='2' align=\"right\"><b>Point accuracy 2D</b></td>
			<td colspan='2' align=\"right\"><b>Point accuracy 3D</b></td>
			<td colspan='2' align=\"right\"><b>Latency</b></td>
		</tr>
		<tr>
			<td>Minimum</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_min, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Maximum</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_max, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_max, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_max, 2, '.', ' '). "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_max, 2, '.', ' '). "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_max, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_max, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Average</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_average, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Median</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_median, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Variance</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_variance, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>RMS</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_rms, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>75 percentile</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_75_percentile, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>90 percentile</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_2D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_2D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->accuracy_error_3D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->accuracy_error_3D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp1->primary_metrics->latency_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($exp2->primary_metrics->latency_90_percentile, 2, '.', ' ') . "</td>
		</tr>
	</table>
	</div>";
}


####### HELPER FUNCTIONS #######
function sortById($a, $b)
{
	#return strcmp($a->name, $b->name);
	return $a->name > $b->name;
}

function sortByScore($a, $b)
{
	#return strcmp($a->name, $b->name);
	return $a->score < $b->score;
}
?>
