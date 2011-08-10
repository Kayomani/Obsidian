<?php 
if(!CheckPermission("admin","view admin menu")){
	$master->AddError("You do not have permission to access this page!");
}


function convertDateOut($data)
{
	$date = strtotime($data);
    $fdate = strftime("%d/%m/%Y %H:%M", $date);
	return $fdate;
}

$lans = new Lan_events;
$lans->find();
$lanlist= array();
while ($lans->fetch()) {
	$lans->end = convertDateOut($lans->end);
	$lans->start = convertDateOut($lans->start);
	
	$seats = new Lan_seats;
	$seats->lan_id = $lans->id;
	$lans->true_seats = $seats->count();
	
	
    $lanlist[] = clone($lans);
}

$master->Smarty->assign("lans",$lanlist);
?>