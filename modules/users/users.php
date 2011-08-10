<?php 

$userlist = array();

$user = new Lan_users;
$attendees = new Lan_attendees;
$arrived = new Lan_arrivals;
$seat = new Lan_seats;

$filter = "current";
if(isset($_GET["filter"])){
	$filter = $_GET["filter"];
	$master->Smarty->assign("filter",$filter);
}

switch($filter){
	default:
	case 'current':
		$lanid = getCurrentLID();
		$user->query("SELECT *, {$arrived->__table}.aid as arrived,{$seat->__table}.seat_name, {$seat->__table}.id as seat_id, {$user->__table}.user_id as userid  FROM {$user->__table} LEFT JOIN {$arrived->__table} on {$arrived->__table}.user_id ".
		             " = {$user->__table}.user_id LEFT JOIN {$seat->__table} on {$seat->__table}.user_id =  {$user->__table}.user_id  WHERE {$seat->__table}.lan_id = '$lanid' AND {$user->__table}.user_id IN (SELECT user_id FROM {$attendees->__table} WHERE `lan_id` = '$lanid') ORDER BY {$user->__table}.username");
		while($user->fetch()){
			if(strlen($user->arrived)==0)
			$user->arrived = "No";
			else
			$user->arrived = "Yes";
			//Pull tickets
			$sold = new Lan_addons_sold;
			$addon = new Lan_addons_groups;
			$sold->whereAdd("user_id = $user->user_id");
						//$sold->user_id ;
			$sold->lan_id =  getCurrentLID();
			$sold->joinAdd($addon);

			$sold->find();
			$tickets = array();
			while($sold->fetch()){
				$tickets[] = clone($sold);
			}
			$user->tickets = $tickets;
			$userlist[] = clone($user);
		}
		break;
	case 'none':
		$user->orderBy('username');
		//$user->groupBy('clan');
		$user->find();
		while($user->fetch()){
			$user->arrived = "n/a";
			$userlist[] = clone($user);
		}
		break;
}



$master->Smarty->assign("userlist",$userlist);

//$master->Smarty->assign("_page",file_get_contents("skins/" . Config::$theme . "/intranet/modules/users.tpl"));

?>