<?php 
$master->Smarty->assign("loginbox_address",$_SERVER["REMOTE_ADDR"]);
$master->RenderBlock('users','session','_login');
$master->RenderBlock('users','remaining','_remaining');
$master->Smarty->assign("admin_menu", "admin_menu.tpl");

?>