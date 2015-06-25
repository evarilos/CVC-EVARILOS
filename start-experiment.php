<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php"); ?>

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

		<h2>Your experiment is running...</h2>
		<div class="panel panel-default">
                   <div class="panel-body">
			Thank you for your contribution, your experiment is running at the moment.
			</br></br></br>
			<img src='img/loading.gif'/>
			</br></br></br>
			
			<?php
				set_include_path(get_include_path() . '/phpseclib/');
				include('Net/SSH2.php');

				$ssh = new Net_SSH2('ec.wilab2.ilabt.iminds.be');
				if (!$ssh->login('<USERNAME>', '<PASSWORD>')) {
				    exit('Login Failed');
				}

				if (ob_get_level() == 0) ob_start();

				function packet_handler($str)
				{
					echo $str . "</br>";
					ob_flush();
					flush();
				}

				$ssh->setTimeout(60);
				$ssh->exec('omf exec -N mwc2015/robot8.rb', 'packet_handler');

				ob_end_flush();
			?>
                    </div>
		</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<?php require_once("models/footerscripts.php"); ?>
</body>
</html>
