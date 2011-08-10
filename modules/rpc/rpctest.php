<?php
include ('core.php');
include ("libs/phprpc/phprpc_client.php");
$client = new PHPRPC_Client('http://127.0.0.1/work/obsidian/rpc.php?key=' . Config::$intpass);
$client->setTimeout(5);
$client->setEncryptMode(3);
try {
	
	print_r($client->CheckLogin('kayomani','2dbf2c8b82421856957e4469a7834d86'));
	return;
	
	$userList = $client->GetUsers();

	foreach ($userList as $user)
	{
		$luser = new Lan_users;
		$luser->id = $user->id;
		 
		if(0==$luser->count())
		{
			$luser->username = $user->username;
			$luser->id = $user->id;
			$luser->password = $user->password;
			$luser->email = $user->email;
			$luser->role = $user->role;
			$luser->clan = $user->clan;
			$luser->insert();
			echo "insert";
		}
		else
		{
			$luser->username = $user->username;
			$luser->id = $user->id;
			$luser->password = $user->password;
			$luser->email = $user->email;
			$luser->role = $user->role;
			$luser->clan = $user->clan;
			$luser->update();
			echo "update";
		}
	}
}
catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
