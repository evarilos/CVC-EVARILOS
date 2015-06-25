<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
require_once("models/class.data.php");
require_once("models/class.graphdata.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

$part1 = isset($_GET['database']);
$part2 = isset($_GET['experiment']);

$expobj = null;
$experiments = null;
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
		<h3>Visualize the results</h3>

<!-- ***** PART I ***** -->
<?php if(!$part1) { ?>
	<ol class='progtrckr'>
	    <li class='progtrckr-current'>Select database</li><!--
	    --><li class='progtrckr-todo'>Select experiment</li><!--
	    --><li class='progtrckr-todo'>View metric results</li>
	</ol>
	<br />
	<br />
	<br />


	<h4>Select your database:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Database</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>

<?php
	$dbs = get_databases();
	while (list($key, $value) = each($dbs)) {
	    echo "<tr>\n";
	    echo "<td>$key</td>\n";
	    echo "<td><a href='" . newURL_with_extra_parameter('database' , $key) ."' type='button' class='btn btn-success'>Select</a><br />\n";
	    echo "</tr>";
	}
?>
			</tbody>
		</table>

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
	<br />
	<h4>Select your experiment:</h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Experiment</th>
					<th>SUT name</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>

<?php
	$exps = get_experiments();
	while (list($key, $value) = each($exps)) {
	    echo "<tr>\n";
	    echo "<td>$key</td>\n";
	    echo "<td>" . get_description_of_experiment($key) . "</td>\n";
	    echo "<td><a href='" . newURL_with_extra_parameter('experiment' , $key) ."' type='button' class='btn btn-success'>Select</a></td>\n";
	    echo "</tr>";
	}
?>
			</tbody>
		</table>

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

<?php get_experiment_data(); ?>
<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseGeneral">General info</a>
				</h4>
			</div>
			<div id="collapseGeneral" class="panel-collapse collapse in">
				<div class="panel-body">
					<?php printGeneralInfo(); ?>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseHeatmap">Heatmap</a>
				</h4>
			</div>
			<div id="collapseHeatmap" class="panel-collapse collapse in">
				<div class="panel-body">
					<?php printHeatMap(); ?>
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
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseDetails">Scenario and metric details</a>
				</h4>
			</div>
			<div id="collapseDetails" class="panel-collapse collapse in">
				<div class="panel-body">
					<?php printDetails(); ?>
				</div>
			</div>
		</div>
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

	return "visualize.php?" . $new_query_string;
}

function get_databases() {
	$experiments = null;
	$url = 'http://ebp.evarilos.eu:5001/evarilos/metrics/v1.0/database';
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$finaldata = (array)json_decode($data);
	ksort($finaldata);
	return $finaldata;
}

function get_experiments() {
	if(empty($experiments))
	{
		$dbname = $_GET['database'];

		$urlExperiments = get_databases()[$dbname];
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $urlExperiments);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		$finaldata = (array)json_decode($data);
		ksort($finaldata);
		$experiments = $finaldata;
	}

	return $experiments;
}

function get_experiment_data() {
	global $expobj;

	$expname = $_GET['experiment'];
	$urlExperimentData = get_experiments()[$expname];
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $urlExperimentData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$expobj = json_decode($data);
}

function get_description_of_experiment($name) {
	$urlExperimentData = get_experiments()[$name];
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $urlExperimentData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$temp = json_decode($data);

	return $temp->sut->sut_name;
}


function printHeatMap() {
	global $expobj;
	global $testbedId;

	if(strpos(strtolower($expobj->scenario->testbed_label), 'hospital') !== FALSE) {
		echo "<div id='heatmapContainerWrapperT'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/televic.png);'></div>";
		$testbedId = 8;
	}

	if(strpos(strtolower($expobj->scenario->testbed_label), 'tkn testbed') !== FALSE ||
		strpos(strtolower($expobj->scenario->testbed_label), 'twist') !== FALSE) {
		echo "<div id='heatmapContainerWrapperTwist'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/twist.png);'></div>";
		$testbedId = 1;
	}

	if(strpos(strtolower($expobj->scenario->testbed_label), 'wilabt1') !== FALSE ||
		strpos(strtolower($expobj->scenario->testbed_label), 'w-ilab.t1') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW1'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/wilab1.png);'></div>";
		$testbedId = 2;
	}

	if(strpos(strtolower($expobj->scenario->testbed_label), 'wilabt2') !== FALSE ||
		strpos(strtolower($expobj->scenario->testbed_label), 'w-ilab.t2') !== FALSE) {
		echo "<div id='heatmapContainerWrapperW2'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/wilab2.png);'></div>";
		$testbedId = 3;
	}

	if(strpos(strtolower($expobj->scenario->testbed_label), 'mine') !== FALSE) {
		echo "<div id='heatmapContainerWrapperM'>
		<div id='heatmapContainer1' style='background-image: url(/img/heatmapback/mine.png);'></div>";
		$testbedId = 7;
	}


	echo "	<div id='heatmapLegend1'>
			<h4>Error distance [m]</h4>

			<span id='min1'></span>
			<span id='max1'></span>
			<img id='gradient1' src='' style='width:100%' />
		</div>

	</div>";


	if($testbedId == 8) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId == 1) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId == 2) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId == 3) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}

	if($testbedId == 7) {
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}
	

	$allData1 = array();
	foreach ($expobj->locations as $loc) {
		array_push($allData1, Data::TestBedError($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId, $loc->localization_error_2D, $loc->point_id));
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

				var generate = function() {
					var t1 = [];";

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

				echo "
					var max = $max;
					var min = $min;

					// the generated dataset
					heatmap1.setData({
						min: min,
						max: max,
						data: t1
					});
				};

				// initial generate
				generate();
			};
		</script>";
}


function print2Derror() {
	global $expobj;
	global $testbedId;

	$array2derror = [];
	foreach ($expobj->locations as $loc) {
		array_push($array2derror, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId, $loc->localization_error_2D, $loc->point_id));
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
		ykeys: ['value'],
		labels: ['Triangulation [m]'],
		hideHover: 'auto',
		resize: true,
		hoverCallback: function (index, options, content, row) {
			  return \"Location \" + row.name + \":  \" + row.value + \"m\";
			}
	    });
		});";

	echo "</script>";


}

function printLatency() {
	global $expobj;
	global $testbedId;

	$arrayLatency = [];
	foreach ($expobj->locations as $loc) {
		array_push($arrayLatency, new graphdata($loc->true_coordinate_x, $loc->true_coordinate_y, $testbedId, $loc->latency, $loc->point_id));
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
		ykeys: ['value'],
		labels: ['Triangulation [ms]'],
		hideHover: 'auto',
		resize: true,
		hoverCallback: function (index, options, content, row) {
			  return \"Location \" + row.name + \":  \" + row.value + \"ms\";
			}
	    });
		});";

	echo "</script>";
}

function printRoomAccuracy() {
	global $expobj;

	echo "<div id=\"morris-donut-room\"></div>";

	echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>";
	echo "<script>";

	echo "$(function() {
		Morris.Donut({
		  element: 'morris-donut-room',
		  data: [
		    {label: \"Correct room\", value: " . round($expobj->primary_metrics->room_accuracy_error_average*100,2) . "},
		    {label: \"Wrong room\", value: " . round((1-$expobj->primary_metrics->room_accuracy_error_average)*100,2) . "},
		  ],
		  colors: ['#6dc066','#ff4040'],
		  formatter: function (y, data) { return y + '%' } 
		});
		});";

	echo "</script>";
}

function printGeneralInfo() {
	global $expobj;

 	echo "<table class=\"table table-hover\">
		<thead>
			<tr>
				<td colspan='2' align='center'>General information</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width='200px'>Timestamp</td>
				<td>" . gmdate("d/m/Y  H:i:s", $expobj->timestamp_utc/1000) . "</td>
			</tr>
			<tr>
				<td>SUT</td>
				<td>" . $expobj->sut->sut_name . "</td>
			</tr>
		</tbody>
	</table>
	</br>";
}

function printDetails() {
	global $expobj;

	$array = [];

	foreach ($expobj->locations as $loc) {
		array_push($array, "1");
	}
	
	echo "
	<div>
	<table  class=\"table table-hover\">
		<tr>
			<td colspan='2' align='center'>Scenario details</td>
		</tr>
		<tr>
			<td width='200px'>Testbed label</td>
			<td>" . $expobj->scenario->testbed_label . "</td>
		</tr>
		<tr>
			<td>Testbed description</td>
			<td>" . $expobj->scenario->testbed_description . "</td>
		</tr>
		<tr>
			<td>Experiment description</td>
			<td>" . $expobj->scenario->experiment_description . "</td>
		</tr>
		<tr>
			<td>Sender description</td>
			<td>" . $expobj->scenario->sender_description . "</td>
		</tr>
		<tr>
			<td>Receiver description</td>
			<td>" . $expobj->scenario->receiver_description . "</td>
		</tr>
		<tr>
			<td>Interference description</td>
			<td>" . $expobj->scenario->interference_description . "</td>
		</tr>
		<tr>
			<td>Number of measurement locations</td>
			<td>" . count($array) . "</td>
		</tr>
	</table>
	</br>
	<table  class=\"table table-hover\">
		<tr>
			<td colspan='5' align='center'>Primary metrics</td>
		</tr>
		<tr>
			<td width='200px'><b>Metric</b></td>
			<td align=\"right\"><b>Point accuracy 2D</b></td>
			<td align=\"right\"><b>Point accuracy 3D</b></td>
			<td align=\"right\"><b>Latency</b></td>
		</tr>
		<tr>
			<td>Minimum</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_min, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_min, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Maximum</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_max, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_max, 2, '.', ' '). "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_max, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Average</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_average, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_average, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Median</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_median, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_median, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>Variance</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_variance, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_variance, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>RMS</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_rms, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_rms, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>75 percentile</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_75_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_75_percentile, 2, '.', ' ') . "</td>
		</tr>
		<tr>
			<td>90 percentile</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_2D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->accuracy_error_3D_90_percentile, 2, '.', ' ') . "</td>
			<td align=\"right\">" . number_format($expobj->primary_metrics->latency_90_percentile, 2, '.', ' ') . "</td>
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
?>
