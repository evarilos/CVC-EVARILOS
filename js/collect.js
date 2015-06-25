function testbedChange() {
	if (document.getElementById("testbed").value == "-1"){
		document.getElementById("testbedImage").src = "/img/empty.png";
		document.getElementById("testbedDescription").innerHTML = "";
		document.getElementById("testbedNodeDetails").innerHTML = "";
		document.getElementById("testbedNrOfNodes").innerHTML = "";
		document.getElementById("testbedNrOfFloors").innerHTML = "";
		document.getElementById("nodemapImage").src = "/img/empty.png";

		document.getElementById("interference").value = -1;
		document.getElementById("interference")[0].style.display = "block";
		document.getElementById("interference")[1].style.display = "none";
		document.getElementById("interference")[2].style.display = "none";
		document.getElementById("interference")[3].style.display = "none";
		document.getElementById("interference")[4].style.display = "none";
		document.getElementById("interference")[5].style.display = "none";
		document.getElementById("interference")[6].style.display = "none";
		document.getElementById("interference")[7].style.display = "none";
		document.getElementById("interference")[8].style.display = "none";

		document.getElementById("robot").value = -1;
		robotChange();
		document.getElementById("robot")[0].style.display = "block";
		document.getElementById("robot")[1].style.display = "none";
		document.getElementById("robot")[2].style.display = "none";
		document.getElementById("robot")[3].style.display = "none";
		document.getElementById("robot")[4].style.display = "none";
		document.getElementById("robot")[5].style.display = "none";
		document.getElementById("robot")[6].style.display = "none";
		document.getElementById("robot")[7].style.display = "none";

			}
	else if (document.getElementById("testbed").value == "twist"){
		document.getElementById("testbedImage").src = "/img/twistpic.png";
		document.getElementById("testbedDescription").innerHTML = "TKN testbed is located at the 2<sup>nd</sup>, 3<sup>rd</sup> and 4<sup>th</sup> floor of the Telecommunication Network Group building in Berlin. According to the EVARILOS Benchmarking Handbook, TKN testbed environment can be characterised as \"Big\" with \"Brick walls\", i.e. more than 1500 m<sup>2</sup> area with more than 50 rooms. TKN testbed is an office environment mostly comprising of three types of rooms, namely small offices (14m<sup>2</sup>), big offices (28m<sup>2</sup>) and laboratories (42m<sup>2</sup>). Furthermore, TKN testbed is a dynamic environment, meaning that there is a number of people moving in the premises, constant opening of doors or slight movement of infrastructure (chairs, tables, etc.) are expected and usual. Furthermore, uncontrolled wireless interference typical for office environments can be expected";
		document.getElementById("testbedNodeDetails").innerHTML = "102 eyesIFX and 102 Tmote Sky nodes";
		document.getElementById("testbedNrOfNodes").innerHTML = "It has 204 SUT sockets, currently populated with 102 eyesIFX and 102 Tmote Sky nodes";
		document.getElementById("testbedNrOfFloors").innerHTML = "The nodes are deployed in a 3D grid spanning 3 floors of an office building at the TUB campus, resulting in more than 1500 m<sup>2</sup> of instrumented office space.";
		document.getElementById("nodemapImage").src = "/img/twistplan.png";

		document.getElementById("interference").value = -1;
		interferenceChange();
		document.getElementById("interference")[0].style.display = "block";
		document.getElementById("interference")[1].style.display = "block";
		document.getElementById("interference")[2].style.display = "block";
		document.getElementById("interference")[3].style.display = "block";
		document.getElementById("interference")[4].style.display = "none";
		document.getElementById("interference")[5].style.display = "none";
		document.getElementById("interference")[6].style.display = "none";
		document.getElementById("interference")[7].style.display = "none";
		document.getElementById("interference")[8].style.display = "none";

		document.getElementById("robot").value = -1;
		robotChange();
		document.getElementById("robot")[0].style.display = "block";
		document.getElementById("robot")[1].style.display = "block";
		document.getElementById("robot")[2].style.display = "block";
		document.getElementById("robot")[3].style.display = "none";
		document.getElementById("robot")[4].style.display = "none";
		document.getElementById("robot")[5].style.display = "none";
		document.getElementById("robot")[6].style.display = "none";
		document.getElementById("robot")[7].style.display = "none";
	}     
	else if (document.getElementById("testbed").value == "wilab1"){
		document.getElementById("testbedImage").src = "/img/wilab1pic.jpg";
		document.getElementById("testbedDescription").innerHTML = "The office environment testbed is deployed in the iMinds office spaces, meeting rooms, student lab rooms, corridors, etc. The office testbed consists of three floors which are actively used during the day. The testbed is a dynamic environment, meaning that there is a number of people moving in the premises, constant opening of doors or slight movement of infrastructure (chairs, tables, etc.) are expected and usual. Furthermore, uncontrolled wireless interference typical for office environments can be expected, including Wi-Fi, DECT, etc.";
		document.getElementById("testbedNodeDetails").innerHTML = "Each node location is equipped with the following hardware:<ul><li>TMoteSky sensor node (programmable with TinyOS or Contiki);</li><li>Two IEEE 802.11 Wi-Fi A/B/G interfaces (programmable with Linux or windows);</li><li>USB slots to install additional hardware;</li><li>Power plugs to install additional hardware (limited to several per room).</li></ul>More information is available at the <a href=\"http://ilabt.iminds.be/wilabt/hardwarelayout/office/configuration\" target=\"_blank\">w-iLab.t office configuration web site.</a>";
		document.getElementById("testbedNrOfNodes").innerHTML = "The network consists of 200 Tmote Sky nodes";
		document.getElementById("testbedNrOfFloors").innerHTML = "The infrastructure is distributed on three floors (18x90m) of the iMinds office";
		document.getElementById("nodemapImage").src = "/img/wilab1plan.jpg";

		document.getElementById("interference").value = -1;
		interferenceChange();
		document.getElementById("interference")[0].style.display = "block";
		document.getElementById("interference")[1].style.display = "none";
		document.getElementById("interference")[2].style.display = "none";
		document.getElementById("interference")[3].style.display = "none";
		document.getElementById("interference")[4].style.display = "none";
		document.getElementById("interference")[5].style.display = "none";
		document.getElementById("interference")[6].style.display = "none";
		document.getElementById("interference")[7].style.display = "none";
		document.getElementById("interference")[8].style.display = "block";

		document.getElementById("robot").value = -1;
		robotChange();
		document.getElementById("robot")[0].style.display = "block";
		document.getElementById("robot")[1].style.display = "none";
		document.getElementById("robot")[2].style.display = "none";
		document.getElementById("robot")[3].style.display = "none";
		document.getElementById("robot")[4].style.display = "none";
		document.getElementById("robot")[5].style.display = "none";
		document.getElementById("robot")[6].style.display = "none";
		document.getElementById("robot")[7].style.display = "block";
	}
	else if (document.getElementById("testbed").value == "wilab2"){
		document.getElementById("testbedImage").src = "/img/wilab2pic.jpg";
		document.getElementById("testbedDescription").innerHTML = "The Zwijnaarde testbed is located in an unmanned utility room above a cleanroom.  Very little outside interference is present in this testbed. Due to the presence of many metal objects, the environment resembles certain manufacturing environments. No persons are present in the environment, and as such the environment is very stable.";
		document.getElementById("testbedNodeDetails").innerHTML = "The w-iLab.t Zwijnaarde hosts 60 infrastructure wireless nodes, each equipped with:<ul><li>RMoni sensor node (programmable with TinyOS or Contiki, <a href=\"http://ilabt.iminds.be/wilabt/hardwarelayout/rm090\" target=\"_blank\">RMoni details</a>);</li><li>Two IEEE 802.11 Wi-Fi a/b/g/n interfaces (programmable with Linux or windows);</li><li>USB slots to install additional hardware;</li><li>Power plugs to install additional hardware (limited to several locations).</li></ul> Mobile wireless nodes are available for repeated remote testing. More information is available on the <a href=\"http://ilabt.iminds.be/wilabt/hardwarelayout/zwijnaarde/configuration\" target=\"_blank\">ilabt website.</a>";
		document.getElementById("testbedNrOfNodes").innerHTML = "60 infrastructure nodes, 20 mobile nodes";
		document.getElementById("testbedNrOfFloors").innerHTML = "1 Floor (The cleanroom)";
		document.getElementById("nodemapImage").src = "/img/wilab2plan.jpg";

		document.getElementById("interference").value = -1;
		interferenceChange();
		document.getElementById("interference")[0].style.display = "block";
		document.getElementById("interference")[1].style.display = "none";
		document.getElementById("interference")[2].style.display = "none";
		document.getElementById("interference")[3].style.display = "none";
		document.getElementById("interference")[4].style.display = "block";
		document.getElementById("interference")[5].style.display = "block";
		document.getElementById("interference")[6].style.display = "block";
		document.getElementById("interference")[7].style.display = "block";
		document.getElementById("interference")[8].style.display = "none";

		document.getElementById("robot").value = -1;
		robotChange();
		document.getElementById("robot")[0].style.display = "block";
		document.getElementById("robot")[1].style.display = "none";
		document.getElementById("robot")[2].style.display = "none";
		document.getElementById("robot")[3].style.display = "block";
		document.getElementById("robot")[4].style.display = "block";
		document.getElementById("robot")[5].style.display = "block";
		document.getElementById("robot")[6].style.display = "block";
		document.getElementById("robot")[7].style.display = "none";
	}
}

function interferenceChange() {
	if (document.getElementById("interference").value == "-1"){
		document.getElementById("interferenceDescription").innerHTML = "";
		document.getElementById("interferenceImage").src = "/img/empty.png";
	}
	else if (document.getElementById("interference").value == "w2none"){
		document.getElementById("interferenceDescription").innerHTML = "No (extra, controlled) interference will be generated in the testbed.";
		document.getElementById("interferenceImage").src = "/img/interference_none.png";
	}     
	else if (document.getElementById("interference").value == "w2home"){
		document.getElementById("interferenceDescription").innerHTML = "The home Environment is emulated using 4 WiFi embedded PCs. A server, email client, data client, and video client. The server acts as a WiFi access point and a gateway for the emulated services. The email client will 'check email' once every 15 seconds for a duration of one second. The data client is emulated via TCP streams one starting at 45 seconds for a duration of 22.5 seconds and the other starting at 105 seconds for a duration of 45 seconds. The video client is emulated as a UDP stream of 100 kbps for half the experiment cycle and it will start at the middle of the experiment.";
		document.getElementById("interferenceImage").src = "/img/homeEnvironment.png";
	}
	else if (document.getElementById("interference").value == "w2wifi"){
		document.getElementById("interferenceDescription").innerHTML = "In the first interference scenario, four WiFi APs are communicating. In this scenario, there are two clients (sending the data) and two servers (receiving the data). The locations of the nodes can be found in the figure below. Both clients are non-stop streaming with a bitrate of 24 MBit/s. The arrows in the figure mention the dataflow. The selected channel depends on the SUT, by default, channel 11 is used.";
		document.getElementById("interferenceImage").src = "/img/interference_wifi.png";
	}
	else if (document.getElementById("interference").value == "w2synthetic"){
		document.getElementById("interferenceDescription").innerHTML = "This interference scenario is using an Universal Software Radio Peripheral (USRP) radio to generate a synthetic signal. This synthetic signal is expected that it can block a certain channel completely. The location of this USRP radio is in the center of the test environment, as shown in the figure below. This source of interference is powerful enough to have an impact on the whole testbed environment.";
		document.getElementById("interferenceImage").src = "/img/interference_synth.png";
	}
	else if (document.getElementById("interference").value == "tref"){
		document.getElementById("interferenceDescription").innerHTML = "The name reflects the fact that in this scenario no artificial interference is generated and the presence of uncontrolled interference is minimized.";
		document.getElementById("interferenceImage").src = "/img/empty.png";
	}
	else if (document.getElementById("interference").value == "tinsc1"){
		document.getElementById("interferenceDescription").innerHTML = "This interference scenario is comprised of several interference sources that are typical for office or home environments. Interference is emulated using 4 WiFi embedded PCs (AlixD2D) having the roles of a server, access point, data client, and video client. In this scenario, the server acts as a gateway for the emulated services. The data client is represented by a TCP client continuously sending data over the AP to the server. Similarly, the video client is emulated as a continuous UDP stream source of 500 kbps with bandwidth of 50 Mbps. The AP is working on a WiFi channel overlapping with the SUT’s operating channel and with the transmission power set to 20 dBm (100 mW). The wireless channel on which the interference is generated depends on a particular evaluated SUT.";
		document.getElementById("interferenceImage").src = "/img/tub_scen1.png";
	}
	else if (document.getElementById("interference").value == "tinsc2"){
		document.getElementById("interferenceDescription").innerHTML = "In this interference scenario, a signal generator is used to generate synthetic interference with an envelope that reflects WiFi modulated signals, but without Carrier Sensing (CS). The transmission power was set to 20 dBm, while the wireless channel on which the interference is performed depends on a particular evaluated SUT.";
		document.getElementById("interferenceImage").src = "/img/tub_scen2.png";
	}
	else if (document.getElementById("interference").value == "w1none"){
		document.getElementById("interferenceDescription").innerHTML = "Due to policy issues, we are not allowed to generate additional interference in the w-iLab.t I testbed.";
		document.getElementById("interferenceImage").src = "/img/empty.png";
	}
}

function robotChange() {
	if (document.getElementById("robot").value == "-1"){
		document.getElementById("robotTrackimg").src = "/img/empty.png";
		document.getElementById("trackDetails").innerHTML = "";

	}
	else if (document.getElementById("robot").value == "w2tr1"){
		document.getElementById("robotTrackimg").src = "/img/track1.png";
		document.getElementById("trackDetails").innerHTML = "This track contains around 200 evaluation points, aligned on a dense grid mapped on the entire testbed. This track is perfect for fingerprinting (offline training phase) or exhaustive evaluation.";
	}
	else if (document.getElementById("robot").value == "w2tr2"){
		document.getElementById("robotTrackimg").src = "/img/track2.png";
		document.getElementById("trackDetails").innerHTML = "In this track, 28 evaluation points are selected randomly over the entire testbed.";
	}
	else if (document.getElementById("robot").value == "w2tr3"){
		document.getElementById("robotTrackimg").src = "/img/track3.png";
		document.getElementById("trackDetails").innerHTML = "In this track, 7 evaluation points are selected randomly over a small part of the testbed.";
	}
	else if (document.getElementById("robot").value == "w2tr4"){
		document.getElementById("robotTrackimg").src = "/img/track4.png";
		document.getElementById("trackDetails").innerHTML = "The information of the evaluation points in this track are hidden, this track is also used during the open challenges. In this way, evaluation results can be compared with other solutions without being biased.";
	}
	else if (document.getElementById("robot").value == "ttr1"){
		document.getElementById("robotTrackimg").src = "/img/tub_track1.png";
		document.getElementById("trackDetails").innerHTML = "This track contains 20 evaluation points spread over the entire floor.";
	}
	else if (document.getElementById("robot").value == "ttr2"){
		document.getElementById("robotTrackimg").src = "/img/tub_track2.png";
		document.getElementById("trackDetails").innerHTML = "This is a small track for evaluation purposes.";
	}
	else if (document.getElementById("robot").value == "w1tr"){
		document.getElementById("robotTrackimg").src = "/img/empty.png";
		document.getElementById("trackDetails").innerHTML = "At the moment, it is not possible to use a robot in the w-iLab.t I testbed.";
	}
}
