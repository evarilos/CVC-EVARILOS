<?php
/*
UserCake Version: 2.0.2
http://usercake.com
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
		<div class="well">
			<h4>Welcome, <?php print $loggedInUser->displayname?></h4>
			<p>Please select one of the possible options below. Hover the tiles to have more information about each procedure.</p>
			<p align='justify'><ul>
				<li style="text-align:justify;"><b>Download &amp; Upload:</b> In this section, you can download environment-specific training datasets from the public repositories. These datasets are typically used for training a localization solution or for obtaining raw data traces as input for a localization algorithm. Data traces are available from multiple environments and multiple technologies.</li>
				<li style="text-align:justify;"><b>Collect data under specified conditions:</b> This experimentation phase provides automated execution of experiments to obtain the RF traces from multiple FIRE facilities, under different conditions and from different technologies.</li>
				<li style="text-align:justify;"><b>Benchmark your SUT:</b> This page contains all the necessary information that you need in order to benchmark and evaluate your own SUT.</li>
				<li style="text-align:justify;"><b>Visualize your results:</b> This section allows you to select and evaluate an executed experiment by using automatically generated heatmaps, graphs and tables.</li>
				<li style="text-align:justify;"><b>Compare &amp; Rank:</b> Finally, a comparison between multiple experiments can be performed in this step. Using application profiles, you can set weights to performance metrics and define their minimum and maximum values. Once the application profile is selected, the EVARILOS platform will start calculating the scores of all the experiments, based on this profile. A ranked list will show the best performing solution according to your requirements. Finally, you can make a thorough comparison between two selected experiments.</li>
			</ul></p>
		</div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row" data-toggle="tooltip" data-placement="top" title="Download RAW RSSI and ToA data from multiple sources">
                                <div class="col-xs-3">
                                    <i class="fa fa-download fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">7</div>
                                    <div>Download &amp; Upload</div>
                                </div>
                            </div>
                        </div>
                        <a href="download.php">
                            <div class="panel-footer">
                                <span class="pull-left">Click here to get started</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row" data-toggle="tooltip" data-placement="top" title="Configure a new experiment and collect your own data">
                                <div class="col-xs-3">
                                    <i class="fa fa-wrench fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
					</br></br></br>
                                    <div>Collect data under specified conditions</div>
                                </div>
                            </div>
                        </div>
                        <a href="collect.php">
                            <div class="panel-footer">
                                <span class="pull-left">Click here to get started</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-purple">
                        <div class="panel-heading">
                            <div class="row" data-toggle="tooltip" data-placement="top" title="Benchmark your blackbox solution">
                                <div class="col-xs-3">
                                    <i class="fa fa-eye fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
					</br></br></br>
                                    <div>Benchmark your SUT</div>
                                </div>
                            </div>
                        </div>
                        <a href="compare.php">
                            <div class="panel-footer">
                                <span class="pull-left">Click here to get started</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row" data-toggle="tooltip" data-placement="top" title="Visualize the results of an indoor localization solution">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">86</div>
                                    <div>Visualize results</div>
                                </div>
                            </div>
                        </div>
                        <a href="visualize.php">
                            <div class="panel-footer">
                                <span class="pull-left">Click here to get started</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row" data-toggle="tooltip" data-placement="top" title="Compare two solutions with each other and calculate scores">
                                <div class="col-xs-3">
                                    <i class="fa fa-trophy fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
					</br></br></br>
                                    <div>Compare &amp; rank</div>
                                </div>
                            </div>
                        </div>
			<div id="accountRed">
                        <a href="compare.php">
                            <div class="panel-footer">
                                <span class="pull-left">Click here to get started</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
			</div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
		<br/><br/><br/>
		<div class="panel panel-info">
                        <div class="panel-heading">
                            The project partners
                        </div>
                        <div class="panel-body">
                            <p align='justify'>	<a href="http://www.tu-berlin.de/" target="_blank"><img src="/img/logo/tub_logo.jpg" style="height: 40px; padding-right: 40px;"/></a>
						<a href="https://www.sics.se/" target="_blank"><img src="/img/logo/sics_logo.jpg" style="height: 40px; padding-right: 40px;"/></a>
						<a href="http://www.iminds.be/en" target="_blank"><img src="/img/logo/iminds_logo.jpg" style="height: 40px; padding-right: 40px;"/></a>
						<a href="http://www.televic-healthcare.com/en/" target="_blank"><img src="/img/logo/televic_logo.jpg" style="height: 40px; padding-right: 40px;"/></a>
						<a href="http://www.advanticsys.com/" target="_blank"><img src="/img/logo/adv_logo.jpg" style="height: 40px;"/></a>
			    </p>
                        </div>
                    </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require_once("models/footerscripts.php"); ?>

    <script>
    // tooltip
    $('.panel-heading').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
</body>

</html>
