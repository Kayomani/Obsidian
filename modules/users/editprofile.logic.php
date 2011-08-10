<?php

if(isset($_POST["Update"])){

	$frontend = new FrontEnd;
	$user = new Lan_users;
	$id = POSTSafe("userid");
	if($user->get($id)){
		$currentpassword = $frontend->encryptPassword(POSTSafe("currentpass"));
		if(streq($currentpassword,$user->password)){
			if(strlen(POSTSafe("newpass"))>0)
			{
				$user->password = $frontend->encryptPassword(POSTSafe("newpass"));
			}

			$user->steamprofile = POSTSafe("steamprofile");
			$user->updateSteamData();
			$user->update();
			
			//Reset session if we are changing the current user, so we make sure the session has the latest data.
			if(streq(getCurrentUID(),$user->user_id)){
				startSession($user->user_id,$user->username);
			}
		}
		else
		{
			$master->AddWarning("Incorrect current password!");
		}

	}
}


?>