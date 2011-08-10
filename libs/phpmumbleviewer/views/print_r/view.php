<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');
$phpmumbleviewer->configureOutput('print_r');

header("Content-Type: text/plain" );
$phpmumbleviewer->render();
?>

