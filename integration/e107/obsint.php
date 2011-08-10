<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Relative path to the files
$Path = '/intranet/';
$currentPath = getcwd();
$pagename = '';
if(isset($_GET["page"]))
 $pagename = ucwords($_GET["page"]);


require_once("class2.php");
define("e_PAGETITLE", $pagename);
require_once(HEADERF);

$caption = $pagename;
$message = "";
$caption = $tp->toHtml($caption);
$omgwtf ="unc";
{
        $original = ob_get_clean();
        ob_start();
        chdir($currentPath . $Path);
        define("_LANMAN_INTEGRATION","1");
        include ('index.php');
        chdir($currentPath);
        $omgwtf = ob_get_clean();
        if($original)
        echo $original;
}
$text =  $omgwtf;
$ns -> tablerender($caption, $text);
require_once(FOOTERF);
exit;
?>