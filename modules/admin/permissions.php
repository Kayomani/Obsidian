<?php

include 'permissions.logic.php';





//Handle current permission mode
$mode = new Lan_permission_modes;
if(isset($_POST["mode"])){
	if($mode->get(escape($_POST["mode"]))){
		$master->Smarty->assign("mode",$mode);
	}
	else
	{
		$master->AddError("Unknown permission group passed!");
	}
}
else
{
	$mode->find();
	if($mode->fetch()){
		$master->Smarty->assign("mode",$mode);
	}
	else
	{
		$master->AddError("Could not find any groups to display!");
	}
}



//Find groups
$groups = array();
$group = new Lan_permission_groups;
$group->find();
while($group->fetch()){
	$groups[] = clone($group);
}
$master->Smarty->assign("grouplist",$groups);

//Find permissions for each mode and group
$permissionlist = array();

$permission = new Lan_permission;
$permission->orderBy("module");
$permission->find();
while($permission->fetch()){
	
	$disallowedlist = array();
	foreach($groups as $group){
		$setting = new Lan_permission_settings;
		$setting->permission_id = $permission->permission_id;
		$setting->mode_id = $mode->mode_id;
		$setting->group_id = $group->permgroup_id;
		if($setting->find()!=0){
			$disallowedlist[] = $setting->group_id;
		}
	}
	$permission->disallowed = $disallowedlist;
	$permissionlist[] = clone($permission);
}

//Mode list

$modelist = array();
$mode = new Lan_permission_modes;
$mode->orderBy("mode_name");
$mode->find();
while($mode->fetch()){
	$modelist[] = clone($mode);
}
$master->Smarty->assign("modelist",$modelist);

$master->Smarty->assign("permissionlist",$permissionlist);
?>