<?php
//define absolute server path, for windows
define('ABS_SERVER', 'C:/WLMP/HTDOCS/work/obsidian/libs/DataObjects/'); //absoulte server path

//set include path for windows
ini_set('include_path', ABS_SERVER . ';' . ABS_SERVER . 'includes/pear/;' . ABS_SERVER . 'includes/' .';C:/Files/xampplite/php/PEAR');

//set include path for linux
//ini_set('include_path', '.:./includes/pear:./includes');

$_SERVER['argv'][1] = "dbconfig.php";
require_once("DB/DataObject/createTables.php");

?>