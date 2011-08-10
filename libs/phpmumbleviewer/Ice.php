<?php
/*
 * move&rename to /index.php
 */

require('classes/PhpMumbleViewer.class.php');

// PARAMS
$port = filter_input(INPUT_GET, 'port', FILTER_VALIDATE_INT);
$view = filter_input(INPUT_GET, 'view', FILTER_DEFAULT);

// DEFAULT - PARAMS
if (!isset($port)) $port = 0;
if (!isset($view)) $view = 'xhtml';

// INIT
$phpmumbleviewer = new PhpMumbleViewer();

// SET INPUT
$phpmumbleviewer->configureInput('ice', array('port' => $port));

// DISPLAY
if (file_exists("views/$view/view.php")) {
    include("views/$view/view.php");
} else {
    die("view not exists");
}
?>
