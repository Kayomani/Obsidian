<?php
$root = Config::$dir . '/files/';
$folder = '';



if(isset($_GET["folder"]))
{
	$folder = str_replace('..','',base64_decode(GETSafe('folder'))); 
}

include 'index.logic.php';

$header ='';
$headerhtml ='';
$inroot = (strlen($folder)==0 || streq('..',$folder) || streq('\\',$folder) || streq('/',$folder) );

include 'browse.php';

if($inroot){
	$headerhtml = $master->GetTemplate('fileshare.header.htm');
}



$master->Smarty->assign("fs_folder_raw",$folder);
$master->Smarty->assign("fs_folder",GETSafe('folder'));
$master->Smarty->assign("fs_header_html",$headerhtml);
$master->Smarty->assign("fs_header",$header);
$space = disk_free_space($root);
$master->Smarty->assign("fs_freespace",decodeSize($space));
?>