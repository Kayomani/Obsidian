<?php

$allowed = true;

if(!CheckPermission("admin","change permissions")){
	$master->AddError("You do not have permission to access this page!");
	$allowed = false;
}


if($allowed && isset($_POST["update"]))
{

	$mode = new Lan_permission_modes;
	if($mode->get(GETSafe("mode"))){

		//Clear down settings for the current mode
		$settings = new Lan_permission_settings;
		$settings->mode_id = $mode->mode_id;
        $settings->find();
        while($settings->fetch()){
        	$settings->delete();
        }
        
		//Add settings for the current mode
		foreach($_POST as $k => $v){

			if(!streq("update",$k) || streq("1",$v)){
				$values = explode("-",$k);
				if(2==count($values)){
				//	echo "perm " . $values[0] . " group " . $values[1];
					$settings = new Lan_permission_settings;
					$settings->group_id = $values[1];
					$settings->mode_id = $mode->mode_id;
					$settings->permission_id = $values[0];
					$settings->insert();
				}
			}

		}

	}
	else
	{
      $master->AddError("Progamtic error, no mode passed?");
	}


}

?>