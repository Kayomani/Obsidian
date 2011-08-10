<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');
$phpmumbleviewer->configureOutput('xml');

header("content-type: text/xml");
$phpmumbleviewer->render();
?>
