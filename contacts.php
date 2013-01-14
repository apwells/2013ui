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
			echo '<h2>Removing ' . $name . '</h2>';
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
		echo "number changed to " . $number;
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
	echo '</h4>' . "\n" . '</div>' . "\n";
	echo '<a id ="delete" href="contacts.php?delete=' . $contact->name . '">delete</a>';
}


?>

<form name="sms" action="contacts.php" method="post">
	Name :<input type="text" name="name">
	Number :<input type="tel" name="number">
	<input type="submit" value="Submit">
</form>