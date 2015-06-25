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

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">The <SPAN>EVARILOS</SPAN> benchmarking platform</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php include("left-nav.php"); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The <img src="img/evarilos.png"/> benchmarking platform <img src="img/empty.png"/> <a href="http://www.ict-fire.eu/home.html" target="_blank"><img src="img/fire.png" style="width:40px;"/></a> <a href="http://cordis.europa.eu/fp7/ict/home_en.html" target="_blank"><img src="img/eu.png" style="width:40px;"/></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            The EVARILOS FP7 EU Project <img src="img/empty.png"/> <a href="http://www.ict-fire.eu/home.html" target="_blank"><img src="img/fire.png" style="width:40px;"/></a> <a href="http://cordis.europa.eu/fp7/ict/home_en.html" target="_blank"><img src="img/eu.png" style="width:40px;"/></a>
                        </div>
                        <div class="panel-body">
                            <p align='justify'>The <a href='http://www.evarilos.eu' target='_blank'>EVARILOS</a> project addresses one of the major problems of indoor localization research: The pitfall to reproduce research results in real life scenarios suffering from uncontrolled RF interference and the weakness of numerous published solutions being evaluated under individual, not comparable and not repeatable conditions.
Accurate and robust indoor localization is a key enabler for context-aware Future Internet applications, whereby robust means that the localization solutions should perform well in diverse physical indoor environments under realistic RF interference conditions.</p>
                        </div>
                        <div class="panel-footer">
                            If you want to get started, please login. If you don't have your credentials yet, please register first.
                        </div>
                    </div>

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
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
