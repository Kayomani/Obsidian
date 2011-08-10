<?php

include_once('Var_Dump.php');
Var_Dump::displayInit(array('display_mode' => 'XHTML_Table'));

function var_dump2($obj)
{
	Var_Dump::display($obj);
}


/**
 * EndsWith
 * Tests whether a text ends with the given
 * string or not.
 *
 * @param     string
 * @param     string
 * @return    bool
 */
function EndsWith($Haystack, $Needle){
	// Recommended version, using strpos
	return strrpos($Haystack, $Needle) === strlen($Haystack)-strlen($Needle);
}

/**
 * Load Data Objects
 */
function LoadDataObjects(){
	$path = 'libs/DataObjects/';

	if ($handle = opendir($path)) {
		while (false !== ($file = readdir($handle))) {
			if (EndsWith($file,".php")) {
				require_once $path . $file;
			}
		}
		closedir($handle);
	}

}



//Utility functions
function cssifysize($img) {
	$dimensions = getimagesize( Config::$dir .$img);
	$dimensions = str_replace("=\"", ":", $dimensions['3']);
	$dimensions = str_replace("\"", "px;", $dimensions);
	return $dimensions;
}

function htmlspecialchars_m($s)
{
	if(get_magic_quotes_gpc())
	{
		if(ini_get('magic_quotes_sybase')=='1')
		return htmlspecialchars($s,ENT_QUOTES);
		else
		return htmlspecialchars(stripslashes($s),ENT_QUOTES);
	}
	else
	return htmlspecialchars($s,ENT_QUOTES);
}

function checkUserAdmin($smarty)
{
	$Frontend = new FrontEnd;
	if(!$Frontend->checkIsAdmin($smarty))
	{
		$smarty->assign("msg","You must be a logged in admin to view this page.");
		$smarty->display('error.tpl');
		return false;
	}
	return true;
}

function streq($str1,$str2){
	return 0 == strcmp($str1,$str2);
}

/*
 * ======================================================================================================
 *
 *                         Sesssion management
 *
 * ======================================================================================================
 */

//Always start a session on the intranet
session_start();

function getCurrentUID()
{
	if(isset($_SESSION["UID"]))
	{
		return $_SESSION["UID"];
	}
	return 0;
}

function setCurrentUser($id)
{
	$_SESSION["UID"] = $id;
}

function getCurrentLID()
{
	if(isset($_SESSION["LID"]))
	{
		return $_SESSION["LID"];
	}
	return 0;
}

function setCurrentLID($id)
{
	$_SESSION["LID"] = $id;
}


/**
 * @param $user 0 = Nobody
 * @param $type  0 = message, 1 = warning, 2 = error.
 * @param $message
 */
function logMessage($user, $type, $message){

	$log = new Lan_log;
	$log->user_id = $user;
	$log->type = $type;
	$log->message = $message;
	$log->insert();
}


function escape($str)
{
	$search=array("\\","\0","\n","\r","\x1a","'",'"');
	$replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
	return str_replace($search,$replace,$str);
}

function GETSafe($name){
	if(isset($_GET[$name]))
	return escape($_GET[$name]);
	return '';
}

function POSTSafe($name){
	if(isset($_POST[$name]))
	return escape($_POST[$name]);
	return '';
}

function decodeSize( $bytes )
{
	$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
	for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
	return( round( $bytes, 2 ) . " " . $types[$i] );
}


function getFileSize($filename)
{
	if(streq("windows",Config::$OS))
	{
		return exec("for %v in (\"".$filename."\") do @echo %~zv");
	}
	else
	{
		return exec(" perl -e 'printf \"%d\n\",(stat(shift))[7];' ".$filename."");
	}
}

class Benchmark{
	private $times = array();

	function getmicrotime() {
		// split output from microtime() on a space
		list($usec, $sec) = explode(" ",microtime());
			
		// append in correct order
		return ((float)$usec+(float)$sec);
	}

	public function StartTimer($name){

		$this->times["start-" .$name] = $this->getmicrotime();

	}

	public function EndTimer($name){

		$this->times["end-" .$name] = $this->getmicrotime();

	}

	public function GetTime($name){

		$this->times["end-" .$name] = $this->getmicrotime();

	}

	public function GetBenchmark($name){
		return sprintf("%.3f", $this->times["end-".$name] - $this->times["start-".$name]);
	}

	public function GetBenchmarkMilliSeconds($name){
		return sprintf("%.0f", 1000*($this->times["end-".$name] - $this->times["start-".$name]));
	}
}

class Error {
	public $type;
	public $message;
}

class Master {

	public $Smarty;
	private $errors;

	function __construct() {
			
		$this->Smarty = new Smarty;
		$this->Smarty->force_compile = true;
		$this->Smarty->debugging = false;
		$this->Smarty->cache_lifetime = 120;
		$this->Smarty->caching = false;
		$this->Smarty->template_dir = Config::$dir . 'skins/' .Config::$theme .'/';
		$this->Smarty->cache_dir = Config::$dir . 'cache/cache/';
		$this->Smarty->compile_dir =  Config::$dir . 'cache/compiled/';
		$this->Smarty->assign("webPath",Config::$webPath);

		$this->errors = array();
	}


	public function AddError($message){
		$error = new Error;
		$error->message = $message;
		$error->type = 'error';
		$this->errors[] = $error;
	}

	public function AddWarning($message){
		$error = new Error;
		$error->message = $message;
		$error->type = 'warning';
		$this->errors[] = $error;
	}

	public function HasFatalError(){

		foreach($this->errors as $error){

			if(streq($error->type,'error')){

				return true;
			}
		}
		return false;
	}

	public function RenderBlock($module,$file,$variable){

		$include = 'modules/' . $module . '/' .$file . '.php';
		$templatefile = 'skins/'. Config::$theme . '/' . $module .'.'. $file . '.htm' ;
		$defaultfile = 'skins/default/' . $module .'.'. $file . '.htm' ;
		//var_dump($defaultfile);
		//	die();
		if(file_exists($include)){
			include $include;
			
			if(function_exists('ExecBlock'))
			  ExecBlock($this);
			$page = '';

			if(file_exists($templatefile)){
				$page = file_get_contents($templatefile);
				$this->Smarty->assign($variable, $page);
				return true;
			}
			else if(file_exists($defaultfile)){
				$page = file_get_contents($defaultfile);
				$this->Smarty->assign($variable, $page);
				return true;
			}
			else
			{
				$this->Smarty->assign($variable, 'Template ' . $file .' not found.' );
			}

		}
		else
		{
			$this->Smarty->assign($variable, 'Code for ' . $include. ' not found!');
		}
		return false;
	}

	public function RenderPage($name){
		$page = '';
		$file = 'skins/'. Config::$theme . '/' . $name;
		$defaultfile = 'skins/default/' . $name;
		if(file_exists($file)){
		 $page = file_get_contents($file);
		 $this->Smarty->assign("master_page", $page);
		}
		else if(file_exists($defaultfile)){
			$page = file_get_contents($defaultfile);
		 $this->Smarty->assign("master_page", $page);
		}
		else
		{
			$this->Smarty->assign("master_page", "Template Page ". $name . " does not exist!");
		}
	}

	public function RenderSite($name){
		global $benchmark;
		$benchmark->StartTimer("smarty");
		$errortxt = '';

		foreach($this->errors as $error){
			$errortxt .= "<div class=\"error\">".$error->message."</div>";
		}

		$this->Smarty->assign('master_errors',$errortxt);
		$this->Smarty->assign('session', $_SESSION);
		$page = $this->Smarty->fetch($name);
		$benchmark->EndTimer("smarty");
		$benchmark->EndTimer("gen");
		$timer = $benchmark->GetBenchmark("gen") . " seconds (Smarty " . $benchmark->GetBenchmark("smarty") . ")";
		echo str_replace("%%REPLACE%%",$timer,$page);
	}


	public function GetTemplate($filename){

		$fileName = 'skins/' . Config::$theme . '/' . $filename;
		// Check to see if there is a themed specific version
		if(file_exists($fileName))
		{
			return file_get_contents($fileName);
		}
		// Try to return a unthemed version.
		$fileName = 'skins/default/' . $filename;
		if(file_exists($fileName))
		{
			return file_get_contents($fileName);
		}
		return false;
	}

	public function checkUserIsAdmin(){
		if(!isset($_SESSION["groups"]))
		  return false;
		return in_array('6',$_SESSION["groups"]);
	}
}



class ModuleHelper {

	private $pretext = null;

	function StartCapture(){
		//$this->pretext = ob_get_clean();
		ob_start();
	}

	function StopCapture(){
		$out = ob_get_clean();
		//ob_end_clean();
		//echo $this->pretext;
		return $out;
	}
}

/**
 * Thanks to http://github.com/maxim/smart_resize_image
 * @param $file
 * @param $width
 * @param $height
 * @param $proportional
 * @param $output
 * @param $delete_original
 * @param $use_linux_commands
 */
function smart_resize_image($file,
$width = 0,
$height = 0,
$proportional = false,
$output = 'file',
$delete_original = false,
$use_linux_commands = false ) {

	if ( $height <= 0 && $width <= 0 ) return false;

	# Setting defaults and meta
	$info = getimagesize($file);
	$image = '';
	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;

	# Calculating proportionality
	if ($proportional) {
		if ($width == 0) $factor = $height/$height_old;
		elseif ($height == 0) $factor = $width/$width_old;
		else $factor = min( $width / $width_old, $height / $height_old );

		$final_width = round( $width_old * $factor );
		$final_height = round( $height_old * $factor );
	}
	else {
		$final_width = ( $width <= 0 ) ? $width_old : $width;
		$final_height = ( $height <= 0 ) ? $height_old : $height;
	}

	# Loading image to memory according to type
	switch ( $info[2] ) {
		case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
		case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
		case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
		default: return false;
	}


	# This is the resizing/resampling/transparency-preserving magic
	$image_resized = imagecreatetruecolor( $final_width, $final_height );
	if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
		$transparency = imagecolortransparent($image);

		if ($transparency >= 0) {
			$transparent_color = imagecolorsforindex($image, $trnprt_indx);
			$transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
			imagefill($image_resized, 0, 0, $transparency);
			imagecolortransparent($image_resized, $transparency);
		}
		elseif ($info[2] == IMAGETYPE_PNG) {
			imagealphablending($image_resized, false);
			$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
			imagefill($image_resized, 0, 0, $color);
			imagesavealpha($image_resized, true);
		}
	}
	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

	# Taking care of original, if needed
	if ( $delete_original ) {
		if ( $use_linux_commands ) exec('rm '.$file);
		else @unlink($file);
	}

	# Preparing a method of providing result
	switch ( strtolower($output) ) {
		case 'browser':
			$mime = image_type_to_mime_type($info[2]);
			header("Content-type: $mime");
			$output = NULL;
			break;
		case 'file':
			$output = $file;
			break;
		case 'return':
			return $image_resized;
			break;
		default:
			break;
	}

	# Writing image according to type to the output destination
	switch ( $info[2] ) {
		case IMAGETYPE_GIF: imagegif($image_resized, $output); break;
		case IMAGETYPE_JPEG: imagejpeg($image_resized, $output,95); break;
		case IMAGETYPE_PNG: imagepng($image_resized, $output,9); break;
		default: return false;
	}

	return true;
}

function resizeimage($source,$x,$y){
	$cachedir = "cache/images/";
	$path= pathinfo($source);
	$ext = strtolower($path["extension"]);
	$cachefile = md5($source .$x .$y).'.'.$ext;
	
	if(!file_exists($cachedir . $cachefile))
	{
		if(!is_dir($cachedir))
		mkdir($cachedir,0777);

		smart_resize_image($source,$x,$y,false,$cachedir.$cachefile,false,false);
	}
	return Config::$webPath . "cache/images/" . $cachefile;
}

function smarty_modifier_concat($string, $concat)
{

return $string.$concat;
}


?>