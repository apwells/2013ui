<!DOCTYPE HTML>
<html>
<head>
<title>Networked Vehicles v0.1</title>
<script src="jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />

</head>

<body>
<div id="wrapper">
	<div id="leftpanel" class="panel">
		<form name="sms" action="editfile.php" method="post">
			Phone Number : <input type="tel" name="number">
			<input type="text" name="message">
			<input type="submit" value="Submit">
		</form>
		
		<form name="website" action="getwebsite.php" method="get">
			Website : <input type="url" name="websiteurl">
			<input type="submit" value="Submit">
		</form>
		
	</div>
	<div id="middlepanel">
		<form name="gps" action="editfile.php?sensor=gps&activate=on" method="get">
			<input type="submit" value="GPS">
		</form>
		
		<a href="editfile.php?sensor=gps&activate=on">GPS ON</a>
		
		<form name="camera" action="editFile.php" method="get">
			<input type="submit" value="Camera">
		</form>
		
		<a href="editfile.php?sensor=camera&activate=on">CAMERA ON</a>
		
		<form name="contacts" action="contacts.php" method="get">
			<input type="submit" value="View/Edit Contacts">
		</form>
	</div>
	<div id="rightpanel">
		<?php include('loadsms.php');?>
	</div>
	<div class="clear"></div>
	<div id="bottompanel">
		<p>Error message code 2223: "Contact not found" etc.etc.</p>
	</div>
</div>
</body>
</html>