<?php
$frontend = new Frontend;
$allusers = $frontend->getAllUsers();
foreach($allusers as $key => $value){
	if($frontend->pullUserInfo($value))
	  $master->AddWarning("Pulled info for $key");
	 else
	 $master->AddWarning("Failed to pull info for $key");
}

?>