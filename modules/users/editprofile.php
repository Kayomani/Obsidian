<?php

include 'editprofile.logic.php';

$userid = getCurrentUID();

if(isset($_GET["uid"])){
	$userid =GETSafe("uid");
}

if(streq("0",$userid)){
	$master->AddError("You must login to edit your profile!");
}
else
{
    $user = new Lan_users;
    if($user->get($userid))
    {
      $master->Smarty->assign("theuser",$user);	
    }
    else
    {
    	$master->AddError("Unknown user!");
    }
}


?>