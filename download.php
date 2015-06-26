<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");

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
		<h3>Download &amp; Upload your datasets</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<h4>Download</h4>
				<div class="panel panel-red">
				        <div class="panel-heading">
				            <h4 class="panel-title">Python and Matlab SDK for interacting with raw data.</h4>
				        </div>
				        <div class="panel-body">
						<p>
SDKs (wrappers) for using the EVARILOS services for using the services from Python and MATLAB programming languages.</br>The SDKs can be found <a href="https://github.com/evarilos/SDKs-EVARILOS" target="_blank">here</a>. A demonstration and extra information is <a href="http://ebp.evarilos.eu/page/ewsn_demo.html" target="_blank">here</a> available.
						</p>
				        </div>
				</div>
				<table class="table table-hover">
				<thead>
					<tr>
						<th>Timestamp</th>
						<th>Testbed</th>
						<th>Interference</th>
						<th>Type data</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>28/10/2014 15:00</td>
						<td>w-iLab.t I</td>
						<td>No Interference</td>
						<td>Sensor: RSSI, ToA</td>
						<td><a href='data/wilab1SensorData.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
					<tr>
						<td>02/11/2014 11:00</td>
						<td>w-iLab.t II</td>
						<td>No Interference</td>
						<td>Sensor: RSSI, ToA</td>
						<td><a href='data/wilab2SensorData.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
					<tr>
						<td>11/03/2015 09:00</td>
						<td>Hospital</td>
						<td>No Interference</td>
						<td>Bluetooth: RSSI</td>
						<td><a href='data/hospitalBluetooth.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
					<tr>
						<td>11/03/2015 09:00</td>
						<td>Hospital</td>
						<td>No Interference</td>
						<td>Sensor: RSSI, ToA</td>
						<td><a href='data/hospitalSensor.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
					<tr>
						<td>11/03/2015 09:00</td>
						<td>Hospital</td>
						<td>No Interference</td>
						<td>WiFi: RSSI</td>
						<td><a href='data/hospitalWifi.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
					<tr>
						<td>15/04/2015 12:30</td>
						<td>Mine</td>
						<td>No Interference</td>
						<td>Sensor: RSSI, ToA</td>
						<td><a href='data/mineSensor.rawData' type="button" class="btn btn-primary">Download</a></td>
					</tr>
<?php $exps = fetchAllExperiments();

$tb = "";
$if = "";
$dt = "";

			if($exps != null) {
				foreach ($exps as $exp) {

$phpdate = strtotime( $exp['timestamp'] );
$da = date( 'd/m/Y H:i', $phpdate );

if($exp['testbed'] == "twist") $tb = "TWIST";
if($exp['testbed'] == "wilab1") $tb = "w-iLab.t I";
if($exp['testbed'] == "wilab2") $tb = "w-iLab.t II";

if($exp['interference'] == "tref") $if = "Reference scenario";
if($exp['interference'] == "tinsc1") $if = "Interference scenario 1";
if($exp['interference'] == "tinsc2") $if = "Interference scenario 2";
if($exp['interference'] == "w2none") $if = "No interference";
if($exp['interference'] == "w2home") $if = "Home interference";
if($exp['interference'] == "w2wifi") $if = "WiFi interference";
if($exp['interference'] == "w2synthetic") $if = "Synthetic interference";
if($exp['interference'] == "w1none") $if = "No interference";

if($exp['approach'] == "wifi") $dt = "WiFi: RSSI";
if($exp['approach'] == "radio") $dt = "Sensor: RSSI, ToA";


				echo "<tr>
					<td>" . $da . "</td>
					<td>" . $tb . "</td>
					<td>" . $if . "</td>
					<td>" . $dt . "</td>
					<td><a href='data/data.rawData' type='button' class='btn btn-primary'>Download</a></td>
				</tr>";
				}
			} ?>
			

				</tbody>
			</table>

			<h4>Upload</h4>
				<div class="panel panel-red">
				        <div class="panel-heading">
				            <h4 class="panel-title">Instructions for interpreting the RAW data format</h4>
				        </div>
				        <div class="panel-body">
						<p>
The datasets that are listed above, are stored and compressed using the Google Protocol buffer technology. Protocol buffers are Google's language-neutral, platform-neutral, extensible mechanism for serializing structured data – think XML, but smaller, faster, and simpler. You define how you want your data to be structured once, then you can use special generated source code to easily write and read your structured data to and from a variety of data streams and using a variety of languages – Java, C++, or Python. More information about the Protocol buffers can be found <a href="https://developers.google.com/protocol-buffers/" target="_blank">here</a>.
						</p>
						<p>
							The structure that EVARILOS used to store and distribute its RAW data can be found in the collapsable panel below. A structured Howto for the Protocol buffers in this benchmarking platform can be found <a href="http://www.evarilos.eu/deliverables/D2.5_EVARILOS_benchmarking_suite.pdf" target="_blank">here</a> on page 54.
						</p>
				            <div class="panel panel-red">
				                    <div class="panel-heading">
				                        <h4 class="panel-title">
				                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >Protobuffer structure</a>
				                        </h4>
				                    </div>
				                    <div id="collapseOne" class="panel-collapse collapse">
				                        <div class="panel-body">
<pre>
package evarilos;
	
message RawRFReading {
  optional string sender_id = 1;                 // ID of the sender
  optional string sender_bssid = 2;              // BSSID of the sender
  optional string receiver_id = 3;               // ID of the receiver
  optional string receiver_bssid = 4;            // BSSID of the receiver
  optional string frequency = 5;                 // Frequency of the received signal
  optional int32 rssi = 6;                       // RSSI (Received Signal Strength)
  optional float lqi = 7;                        // LQI (Link Quality Indication)
  optional float ToA = 8;                        // ToA (Time of Arrival)
  optional float AoA = 9;                        // AoA (Angle of Arrival)
  optional int64 timestamp_utc = 10;             // Milliseconds from 1.1.1970. time
  required int32 run_nr = 11;                    // Run number
  optional bool is_ack = 12 [default = false];   // Is message an ACK?
  optional Location sender_location = 13;        // Location of the sender
  optional Location receiver_location = 14;      // Location of the receiver

  message Location {
    optional double coordinate_x = 1;            // x-coordinate
    optional double coordinate_y = 2;            // y-coordinate
    optional double coordinate_z = 3;            // z-coordinate
    optional string room_label = 4;              // Room label
    optional string node_label = 5;              // Additional label
  }
} 

message RawRFReadingCollection {
  required string metadata_id = 1;               // Connection to the metadata
  optional string receiver_id = 2;               // ID of the receiver
  optional string sender_id = 3;                 // ID of the sender
  repeated RawRFReading rawRF = 4;               // Collections of raw RSSI data
  required string data_id = 5;                   // ID of the measurement
  optional int32 seq_nr = 6 [default = 1];       // Sequence number
  optional bytes _id = 7;                        // Internal ID given by the MongoDB 
  optional int64 timestamp_utc_start = 8;        // Milliseconds from 1.1.1970. start time
  optional int64 timestamp_utc_stop = 9;         // Milliseconds from 1.1.1970. stop time
}
</pre>
				                        </div>
				                    </div>
				                </div>
				        </div>

					
				</div>
			<?php echo resultBlock($errors,$successes); ?>
			<form class="form-horizontal" name='downupload' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
				<div class="form-group">
					<div class="col-sm-10">
					<input  type="file">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-10">
					<button type="submit" class="btn btn-default">Upload</button>
					</div>
                                </div>
			    </fieldset>
                        </form>
                    </div>
		</div>

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
