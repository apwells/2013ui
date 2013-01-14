<!DOCTYPE HTML>
<html>
<head>
<title>Networked Vehicles v0.1</title>
<script src="jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body style="background: #e9eaee;">

<form name="sms" id="contactsform" action="contacts.php" method="post">
	<div id = "contactsnameform">Name :<input type="text" class="textfield" name="name"></div>
	<div id="contactsnumberform">Number :<input type="tel" class="textfield" name="number"></div>
	<input type="submit" class="submit" value="Submit">
</form>

<?php 
error_reporting(E_ALL);


if (isset($_GET['delete'])) {
	// User wants to delete a contact.
	
	$name = $_GET['delete'];
	
	$xml = simplexml_load_file('contacts.xml');
	
	$doc = new DOMDocument('1.0');
	$doc->loadXML($xml->asXML());
	
	$contacts = $doc->getElementsByTagName('contact');	
	
	foreach ($contacts as $contact) {
	
		// echo 'Checking ' . $contact->firstChild->nodeValue;
	
		if ($contact->firstChild->nodeValue == $name) {
			//echo '<h4>Removing ' . $name . '</h4>';
			$contact->parentNode->removeChild($contact);
		}
	}
	
	$doc->formatOutput = true;
	$doc->save('contacts.xml');
	//echo '<br /><br />'. $doc->saveXML();

}

/*
 *	Adding new contact
 */
 
if (isset($_POST['name'])&&isset($_POST['number'])) {
	
	$name = $_POST['name'];
	$number = $_POST['number'];
	
	$firstnum = substr($number, 0, 1);
	//echo 'First number = ' . $firstnum;
	
	if ($firstnum == "0") {
		// We need to change the 0 to a 44
		$number = '44' . substr($number, 1);
		//echo "number changed to " . $number;
	}
	
	// We need to check if this contact already exists.
	
	$xml = simplexml_load_file('contacts.xml');
	
	foreach ($xml->contact as $contact) {
		if ($contact->name == $name) {
			exit ('<h3>CONTACT ALREADY EXISTS</h3><a href="contacts.php">return</a>');
		}
	}
	
	$newcontact = $xml->addChild('contact');
	$newcontact->addChild('name', $name);
	$newcontact->addChild('number', $number);

	$doc = new DOMDocument('1.0');
	
	$doc->loadXML($xml->asXML());
	$doc->formatOutput = true;
	$doc->save('contacts.xml');

}


$s = simplexml_load_file('contacts.xml');

foreach ($s->contact as $contact) {
	echo '<div class="contact">' . "\n" . '<h3>' . "\n";
	echo $contact->name;
	echo '</h3>' . "\n" . '<h4>' . "\n";
	echo $contact->number;
	echo '</h4>' . "\n";
	echo '<a id ="delete" href="contacts.php?delete=' . $contact->name . '">delete</a>';
	echo '<div class="clear"></div></div>' . "\n";
}


?>
</body>
</html>