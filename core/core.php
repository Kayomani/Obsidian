<?php
//Load System functions
require_once ('util.php');
require_once ('integration/integration.php');
$benchmark = new Benchmark;
$benchmark->StartTimer("gen");

//Load system config
require_once ('config.php');
//require_once ('integration/integration.php');
//Load template libary
require_once('libs/smarty/Smarty.class.php');
//Load Data objects
LoadDataObjects();
//Load Master
$master = new Master;







// Check LAN ID
if(getCurrentLID()=="0" || isset($_GET["lanid"])){

	if(isset($_GET["lanid"]))
	{
		$lan = new Lan_events;
		$lan->id = $lan->escape($_GET["lanid"]);

		$lan->find();
		if(!$lan->fetch())
		{
			die("Unknown LAN :-O");
		}
		$_SESSION["lanmode"] = $lan->mode_id;
		setCurrentLID($_GET["lanid"]);
		$master->Smarty->assign("lan",$lan);
	}
	else
	{
		die("Unknown LAN :-(");
	}
}

if(!isset($_SESSION["UID"]))
$_SESSION["UID"] = '0';


/*
 * ======================================================================================================
 *
 *                        Other stuff
 *
 * ======================================================================================================
 */

global $error;

function checkLogin($user,$pass){
	$Frontend = new FrontEnd;
	$pass = $Frontend->encryptPassword($pass);
	$dbuser = new Lan_users;
	$dbuser->username = $dbuser->escape($user);
	$dbuser->password = $pass;
	$dbuser->find();
	if(0==$dbuser->count())
	return null;
	$dbuser->fetch();
	return $dbuser;
}

function SetupGroups(){

	//Get groups
	$groups = array();
	$group = new Lan_permission_groups;
	//Setup system groups

	//Anonymous == everyone
	$groups[] = $group->FindGroupID("Anonymous");
	//Are we logged in?
	if(!streq(getCurrentUID(),"0"))
	$groups[] = $group->FindGroupID("Registered");
	//Attending this lan?
	$attendee = new lan_attendees;
	$attendee->user_id = getCurrentUID();
	$attendee->lan_id = getCurrentLID();
	if($attendee->count()!=0)
	$groups[] = $group->FindGroupID("Attending");

	//Booked a place at this lan?
	$booked = false;
	$sold = new Lan_addons_sold;
	$addon = new Lan_addons_groups;
	$sold->joinAdd($addon);
	$sold->user_id = getCurrentUID();
	$sold->lan_id =  getCurrentLID();
	$sold->find();
	while($sold->fetch()){
		if(streq($sold->allowSeating,"1")){
			$groups[] = $group->FindGroupID("Booked");
			break;
		}

	}

	//Integration mode flag group.
	//if(defined("_LANMAN_INTEGRATION"))

	//$groups[] = $group->FindGroupID("Integration");
	
	//Membership based groups
	if(!streq(getCurrentUID(),"0")){
		$group = new lan_permission_groups;
		$membership = new lan_permission_membership;
		$group->user_group = 1;
		$membership->user_id = getCurrentUID();
		$group->joinAdd($membership);
		$group->find();
		while($group->fetch()){
			$groups[] = $group->permgroup_id;
		}
	}
	$_SESSION['groups']=$groups;
}

function CheckPermission($module,$action){
	$settings = new Lan_permission_settings;
	$permission = new Lan_permission;
	/**

	$permission->whereAdd("module = '$module'");
	$permission->whereAdd("action = '$action'");
	$settings->mode_id = $_SESSION["lanmode"];
	$addedGroup = false;
	if(isset($_SESSION['groups'])){
	foreach($_SESSION['groups'] as $k => $v)
	{
	$settings->whereAdd("group_id = " . $v, "OR");
	$addedGroup = true;
	}
	}
	if(!$addedGroup)
	return false;

	$settings->joinAdd($permission,"LEFT");**/
	if(isset($_SESSION['groups'])){


		$groups = "";//"( group_id = 1 ) OR ( group_id = 2 ) OR ( group_id = 3 ) OR ( group_id = 4 ) OR ( group_id = 6 )";
		
		$list = $_SESSION['groups'];
		for($i = count($list)-1;$i>=0;$i--){
             if($i==0)
             {
             	$groups .= "( group_id = $list[$i] )"; 
             }
             else
             {
             	$groups .= "( group_id = $list[$i] ) OR"; 
             }
		}
		

		$modeid = $_SESSION["lanmode"];
		$settings->query("SELECT count(lan_permission_settings.perset_id) as perset_id FROM {$settings->__table} " .
	                 "LEFT JOIN {$permission->__table} ON ({$permission->__table}.permission_id={$settings->__table}.permission_id) ".
	                 "WHERE ( $groups ) AND ( ( module = '$module' ) AND ( action = '$action' ) ) AND ( {$settings->__table}.mode_id = $modeid )");
		if(0==$settings->fetch())
		 return false;

		return !streq("0",$settings->perset_id);
	}
	return false;
}




function startSession($id,$username){

	setCurrentUser($id);
	$_SESSION['username']=$username;
	

	// Store User IP
	$user = new Lan_users;
	if(0!=$user->get($id))
	{
		$user->ip = $_SERVER['REMOTE_ADDR'];
		$_SESSION['steamprofile']=$user->steamprofile;
		$_SESSION['profilepic']=$user->smallavatar;
		$user->update();
	}
	SetupGroups();
}



?>