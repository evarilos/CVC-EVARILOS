<?php
/*
Author: Tom Van Haute
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("models/header.php");
$dbtimeslots = getFreeTimeSlots();

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
		<h2>Benchmark your own solution</h2>
		<div class="panel panel-default">
                   <div class="panel-body">
			<div class="panel panel-info">
                        <div class="panel-heading">
                            Benchmark your own SUT.
                        </div>
                        <div class="panel-body">
                            <p align='justify'>This section gives instructions for participants for adapting their SUT. A full description is available on the <a href="http://www.evarilos.eu/track2.php#instructions" target="_blank">EVARILOS Open Challenge page</a>.</p>
</br>
			<p align='justify'>The user must provide an HTTP URI on which their algorithm listens for requests for location estimation. Upon request, the algorithms must be able to provide the location estimate as a JSON response in the following format:</p>
			</br>
<pre>
			{ 
				"coordinate_x":   'Estimated location: coordinate x', 
				"coordinate_y":   'Estimated location: coordinate y', 
				"coordinate_z":   'Estimated location: coordinate z', 
				"room_label":     'Estimated location: room' 
			}
</pre>
			</br>
			<p align='justify'>JSON parameters <i>coordinate_x</i> and <i>coordinate_y</i> are required parameters and as such they must be reported upon request. Parameter <i>coordinate_z</i> is an optional parameter, due to the 2D evaluation environment. If this parameter is provided from a SUT, evaluation team will also calculate 3D localization error, although this information will not be used in final scoring. Finally, parameter room_label is an optional parameter and if it is not provided the EVARILOS Benchmarking Platform will automatically map the room estimate from the estimated coordinates x and y.</p>

			</br>
			<p align='justify'>Your SUT should contain a webserver that provides an URL that the EVARILOS engine can use to send a GET request. A java based example is shown in the panel below.</p>
			</br>
			<div class="panel panel-info">
		            <div class="panel-heading">
		                <h4 class="panel-title">
		                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >Java example</a>
		                </h4>
		            </div>
		            <div id="collapseOne" class="panel-collapse collapse">
		                <div class="panel-body">
<pre>
package positioninghttpserver;

import com.google.gson.Gson;
import com.sun.net.httpserver.Headers;
import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;
import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.InetSocketAddress;
import java.util.concurrent.Executors;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Tom Van Haute (tom.vanhaute@intec.ugent.be)
 */
public class PositioningHttpServer {

    public static void main(String[] args) {
        try {
            HttpServer server = HttpServer.create(new InetSocketAddress(80), 0);
            System.out.println("SUT HTTP server active.. Waiting for EVARILOS Engine for a location request...");
            server.createContext("/getLocationEstimate", new MyLocationEstimateHandler());
            server.setExecutor(Executors.newCachedThreadPool());
            server.start();
        } catch (IOException ex) {
            Logger.getLogger(PositioningHttpServer.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    static class MyLocationEstimateHandler implements HttpHandler {

        @Override
        public void handle(HttpExchange exchange) throws IOException {
            String requestMethod = exchange.getRequestMethod();
            try {
                if (requestMethod.equalsIgnoreCase("GET")) {
                    Headers responseHeaders = exchange.getResponseHeaders();
                    responseHeaders.add("Content-Type", "application/json");
                    
                    int xx = (int)Math.round(Math.random()*1000);
                    int yy = (int)Math.round(Math.random()*400);
                    
                    Location l = new Location(xx,yy);
                    Gson gson = new Gson();
                    String json = gson.toJson(l);

                    //For demo if delay
                    int delay = (int)Math.round(Math.random()*5000);
                    Thread.sleep(delay);
                    
                    //Send the JSON in bytes
                    byte[] outputBytes = json.getBytes("UTF-8");
                    exchange.sendResponseHeaders(HttpURLConnection.HTTP_OK, outputBytes.length);
                    OutputStream responseBody = exchange.getResponseBody();
                    responseBody.write(outputBytes);
                    responseBody.close();
                } else {
                    //All other requests will be blocked
                    Headers responseHeaders = exchange.getResponseHeaders();
                    responseHeaders.add("Content-Type", "application/octet-stream");
                    exchange.sendResponseHeaders(HttpURLConnection.HTTP_BAD_METHOD, 1);
                    OutputStream responseBody = exchange.getResponseBody();
                    responseBody.write(1);
                    responseBody.close();
                }

            } catch (Exception ex) {
                ex.printStackTrace();
            }
        }
    }
    
}

public class Location {
    private double coordinate_x;
    private double coordinate_y;

    public Location(double xcoord, double ycoord) {
        this.coordinate_x = xcoord;
        this.coordinate_y = ycoord;
    }
    
    public double getXcoord() {
        return coordinate_x;
    }

    public void setXcoord(double xcoord) {
        this.coordinate_x = xcoord;
    }

    public double getYcoord() {
        return coordinate_y;
    }

    public void setYcoord(double ycoord) {
        this.coordinate_y = ycoord;
    }
}
</pre>
				                        </div>
				                    </div>
				                </div>
				        </div>
                        </div>
                    </div>
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
