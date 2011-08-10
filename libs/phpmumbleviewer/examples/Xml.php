<?php
/*
 * move&rename to /index.php
 */

require('./classes/PhpMumbleViewer.class.php');

// PARAMS
$source	= 'http://ks20690.kimsufi.com/phpmumbleviewer/index.php?port=65101&view=xml';
$view	= 'xhtml';

// INIT
$phpmumbleviewer = new PhpMumbleViewer();

// SET INPUT
$phpmumbleviewer->configureInput('xml', array('xml' => $source));

// DISPLAY
if (file_exists("views/$view/view.php")) {
    include("views/$view/view.php");
} else {
    die("view not exists");
}
?>
