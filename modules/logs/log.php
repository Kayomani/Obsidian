<?php


function convertDateOut($data)
{
	$date = strtotime($data);
	$fdate = strftime("%d/%m/%Y %H:%M", $date);
	return $fdate;
}
$logs = new Lan_log;
$user = new Lan_users;
$logs->joinAdd($user);
$logs->orderBy('id DESC');

$logs->find();
$loglist= array();

$count =0;
while ($logs->fetch()) {
	if($count>200)
	  break;
	$count++;
	
	if(streq('0',$logs->user_id))
	 $logs->username = "SYSTEM";
	
	
	switch($logs->type)
	{
		case '0':
			$logs->type = "Message";
			break;
		
	}
	 
	$loglist[] = clone($logs);
}

$master->Smarty->assign("logs",$loglist);
?>