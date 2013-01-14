<?php

// $_GET["fname"];
// variables - sensor, activate,

// Format = <gps>on</gps>

$xmltop = '<?xml version="1.0" encoding="utf-8" ?>'."\n".'<req>' . "\n";
$xmlbottom = '</req>';

$filename = 'request.xml';

//$content = '<gps>on</gps-test>';
if (isset($_GET["sensor"])) {
    $content = '<' . $_GET["sensor"] . '>' . $_GET["activate"] . '</' . $_GET["sensor"] . '>';
    echo '<p>' . $_GET["sensor"] . ' set to ' . $_GET["activate"] . '</p>';
} else if (isset($_POST["number"])) {
	$content = '<sms><number>' . $_POST["number"] . '</number>' . '<message>' . $_POST["message"] . '</message></sms>';
	echo 'SMS sent to gadgeteer';
} else {
	// THERE HAS BEEN A PROBLEM. ECHO?
	echo "problem";
}


$string = $xmltop . $content . "\n" . $xmlbottom;

$fp = fopen($filename, 'w');
fwrite($fp, $string);
fclose($fp);
?>