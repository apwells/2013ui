	<!DOCTYPE HTML>
<html>
<head>
<title>Networked Vehicles v1</title>
<script src="jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
<div id="wrapper">
	<div id="leftpanel" class="panel toppanel">
		<h3>Send SMS</h3>
		<form name="sms" action="editfile.php" method="post">
			Phone Number : <input type="tel" class="textfield" name="number">
			<textarea type="text" name="message" id ="msg"></textarea>
			<input type="submit" value="Submit">
		</form>
		<h3>HTTP request</h3>
		<form name="website" action="#" method="get">
			Website : <input type="url" class="textfield" name="websiteurl">
			<input type="submit" value="Submit">
		</form>
		
	</div>
	<div id="middlepanel" class="panel toppanel">
		<a href="#" trackgps="yes" id="gpsbtn" class="mybutton">GPS on</a>
		<a href="#" trackcamera="yes" id="camerabtn" class="mybutton">Camera on</a>
		<a href="#" trackcontacts="yes" class="mybutton">Contacts</a>
		<a href="#" tracksms="yes" class="mybutton">Messages</a>
	</div>
	<div id="rightpanel" class="panel toppanel">
		<?php include('loadsms.php');?>
	</div>
	<div class="clear"></div>
	<div id="bottompanel" class="panel">
		<div id="status"><p>System running...</p></div>
		<div id ="maps"></div>
	</div>
<div id="microsoft"><img src="poweredby-black.png" alt="microsoft" /></div>
</div>


</body>
</html>

<script>

var gps = 0;
var camera = 0;

$("a[trackgps='yes']").click(function(e){
  // alert('button clicked');
  if (gps == 0) {
  	$("#status").load("editfile.php?sensor=gps&activate=on");
  	$("#gpsbtn").html("GPS off");
  	$("#maps").html('<iframe src="map.html" seamless width="100%" height="100%" style="border: none; margin: 0px !important; padding: 0px !important; height: 150px; "></iframe>');
  	gps = 1;
  } else {
  	$("#status").load("editfile.php?sensor=gps&activate=off");
  	$("#gpsbtn").html("GPS on");
  	gps = 0;
  	$("#maps").html('');
  }
  
});
  
$("a[trackcamera='yes']").click(function(e){
  // alert('button clicked');
  if (camera == 0) {
  	$("#status").load("editfile.php?sensor=camera&activate=on");
  	$("#camerabtn").html("Camera off");
  	camera = 1;
  } else {
  	$("#status").load("editfile.php?sensor=camera&activate=off");
  	$("#camerabtn").html("Camera on");
  	camera = 0;
  }
  
});

$("a[trackcontacts='yes']").click(function(e){
	$("#rightpanel").html('<iframe src="contacts.php" seamless width="100%" height="100%" border="0" style="border: none; margin: 0px !important; padding: 0px !important; height: 286px; "></iframe>');
	$("#rightpanel").css('overflow','hidden');
});

$("a[tracksms='yes']").click(function(e){
	$("#rightpanel").load("loadsms.php");
	$("#rightpanel").css('overflow','scroll');
});

// Change vertical alignment...

window.onload = checkAvailableHeight;

window.onresize = checkAvailableHeight;

function checkAvailableHeight(){
    var yourDiv = document.getElementById("wrapper");
    yourDiv.style.marginTop = (($(window).height() - 670) / 2) + "px";
}

</script>