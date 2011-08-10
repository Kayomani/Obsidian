<?php
class Config
{
	public static $theme="default";
	// DB.
	public static $username="root";
	public static $password="";
	public static $database="lan";
	public static $host="127.0.0.1";
	//Front end.
	public static $system="e107";
	//System paths, terminate with a trailing slash
	public static $dir="C:/xampp/htdocs/Obsidian/";
	public static $webPath="http://localhost/Obsidian/";
	// Remote pass key [AlphaNumeric!]
	public static $intpass="NUJ83n8da8NSjdnfn387";
	// Current OS = windows or linux
	public static $OS="windows";
}

ini_set('include_path',Config::$dir . ";" .  ini_get('include_path'));
//include dataobject classes
include_once('DB/DataObject.php' );
include_once('DB/DataObject/Cast.php');


//define database configuration values
$options = &PEAR::getStaticProperty('DB_DataObject','options');

$options = array(
'database' => "mysqli://" . Config::$username . ":".Config::$password . "@". Config::$host. "/" . Config::$database,
'schema_location' => Config::$dir .'/libs/DataObjects/',
'class_location' =>  Config::$dir .'/libs/DataObjects/',
'require_prefix' => 'LAN/DataObjects/',
'class_prefix' => '',
'db_driver'        => 'MDB2'
);



//DB_DataObject::debugLevel(5);






/*
 * You might need to set the below depending on your config.
 */
//define absolute server path, for windows
//define('ABS_SERVER', 'C:/Files/xampplite/htdocs/obsidian/libs/DataObjects/'); //absoulte server path
//set include path for windows
//ini_set('include_path', ABS_SERVER . ';' . ABS_SERVER . 'includes/pear/;' . ABS_SERVER . 'includes/;C:/Files/xampplite/php/PEAR/');
//set include path for linux
//ini_set('include_path', '.:./includes/pear:./includes');
?>