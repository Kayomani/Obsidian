<?php

if(defined("LANMAN_AJAX"))
{
	include 'rpc.php';
	die();
}
/*
 * Seat types:
 * 0: Normal
 * 1: Staff only
 * 2: Disabled
 */


if(!isset($_GET["id"]))
{
        $master->Smarty->assign("msg","Unknown lan");
        $master->Smarty->display('error.tpl');
        return;
}
else
{
        $lan = new Lan_events;
        $success = $lan->get($lan->escape($_GET["id"]));
        if($success)
        {

                if(!file_exists($lan->layout) || streq($lan->layout,""))
                  $lan->layout = "images/no_seating_plan.png";
                $master->Smarty->assign("img",$lan->layout);
                $master->Smarty->assign("size",cssifysize($lan->layout));
        }
        else
        {
                $master->Smarty->assign("msg","Unknown lan");
                $master->Smarty->display('error.tpl');
                return;
        }
        $master->Smarty->assign("id",$lan->id);
}
?>