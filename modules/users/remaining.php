<?php

function ExecBlock($master)
{
$lan = new Lan_events;
$lan->get(getCurrentLID());

$now = strtotime("now");
$start = strtotime($lan->start);
$end = strtotime($lan->end);
$diff = 0;
$ndiff = 1;
if($start<$end)
{
  $diff = $end - $start;
  $ndiff = $now -$start;
}

$percent =  round(($ndiff/$diff)*100);
if($percent<0)
 $percent = 0;
if($percent>100)
 $percent = 100;
$percent = 100 -$percent;

$master->Smarty->assign("percent",$percent);
}
//

//$master->Smarty->assign("_remaining",file_get_contents("skins/" . Config::$theme . "/intranet/modules/remaining.tpl"));
?>