<?php

include_once ('core.php');
include ("libs/phprpc/phprpc_client.php");

class RPC {

	private $client = NULL;


	private function init(){
		if($this->client==NULL)
		{
			$this->client = new PHPRPC_Client('http://127.0.0.1/work/obsidian/rpc.php?key=' . Config::$intpass);
			$this->client->setTimeout(5);
			$this->client->setEncryptMode(3);
		}
	}
	private function CheckForError($output)
	{
		
		if(is_object($output) && streq(get_class($output),'PHPRPC_Error'))
		 throw new Exception ($output);
	}


	function CheckLogin($user,$pass) {
		try {
			$this->init();
			$out = $this->client->CheckLogin($user,$pass);
			$this->CheckForError($out);
			if(streq('1',$out))
			return true;
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		return false;
	}

	function GetUsers()
	{
		$this->init();
		$userList = $this->client->GetUsers();
        $this->CheckForError($userList);
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
}


?>