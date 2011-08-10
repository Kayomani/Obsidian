<?php
function GetUsers() {
	$userList = array();
	$users = new Lan_users;
	$users->find();
	while($users->fetch())
	{

		$userList[] = clone($users);
	}
	return $userList;
}

function CheckLogin($user,$pass) {
	$Frontend = new FrontEnd;
 
	//Manually pull updated info
	$uid = $Frontend->findUserID($user); 
	if(streq($uid,'0'))
	 return false;

	$Frontend->pullUserInfo($uid);

	$dbuser = new Lan_users;
	$dbuser->username = $dbuser->escape($user);
	$dbuser->password = $pass;
	$dbuser->find();
	return 0!=$dbuser->count();
}

?>