<?php 
error_reporting(E_ALL);

$s = simplexml_load_file('newSms.xml');

$cxml = simplexml_load_file('contacts.xml');

foreach ($s->sms as $sms) {

echo '<div class="textmessage">' . "\n" . '<h3>' . "\n";
// Compare to contacts.

$isNumberPrinted = false;
	foreach ($cxml->contact as $contact) {
		// This isn't hugely efficient
		
		// echo 'Checking '. $contact->name . ' with number ' . $contact->number . ' against ' . $sms->number . '<br />';
		
/*		NOT SURE WHY THIS DIDNT WORK…

		if ($contact->number == $sms->number) {
			echo $contact->name;
			echo '<br />FOUND MATCH<br />';
			$isNumberPrinted = true;
		}
*/

		if (strcmp ( $contact->number , $sms->number ) == 0) {
			echo $contact->name;
			//echo '<br />FOUND MATCH<br />';
			$isNumberPrinted = true;
		}

	}
	
	if (!$isNumberPrinted) {
		echo $sms->number;
	}
	
echo '</h3>' . "\n" . '<h4>' . "\n";
echo $sms->time;
echo '</h4>' . "\n" . '<p>' . "\n";
echo $sms->message;
echo '</p>' . "\n" . '</div>' . "\n";
}


?>