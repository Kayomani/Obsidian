<?php
//Login

$displayError = false;

if(isset($_GET["user-session-login"]))
{
	if(streq($_GET["user-session-login"], "1"))
	{
		if(isset($_POST["Register"]))
		{
			//Register button clicked
			global $master;
			$master->AddWarning("Register on the <a href=\"http://lanops.co.uk/signup.php\">main web site *click here*</a>.");
			return;
		}
		$login = $_POST["user"];
		$password = $_POST["password"];

		$loginOK = checkLogin($login,$password);

		if($loginOK)
		{
			startSession($loginOK->user_id,$loginOK->username);
			//header( 'Location: intranet.php' ) ;
		}
		else
		{
			$Frontend = new FrontEnd;
		
			if(!streq("0",$Frontend->getUserId())){
					
				$Frontend->pullUserInfo($Frontend->getUserId());
				$loginOK = checkLogin($login,$password);
				
				if($loginOK)
				{
					startSession($loginOK->user_id,$loginOK->username);
					//header( 'Location: intranet.php' ) ;
				}
				else 
			     $displayError = true;
			}
			else 
			 $displayError = true;
				
				
			/**
			 echo "nok";
			 //Login failed, so check remote site.
			 $rpc = new RPC;
			 $Frontend = new FrontEnd;
			 $loginOK = $rpc->CheckLogin($login,$Frontend->encryptPassword($password));
			 if($loginOK)
			 {
				//Oops we must be out of date, update the users table!
				$rpc->GetUsers();
				$loginOK = checkLogin($login,$password);
				startSession($loginOK->id,$loginOK->username);
				//header( 'Location: intranet.php' ) ;
				}
				else
				{
				echo "nok";
				}**/
		}
		if($displayError)
		{
			global $master;
			$master->AddWarning("Incorrect username or password.");
		}
	}

}
//Logout
if(isset($_GET["user-session-logout"]))
{
	$lanid = getCurrentLID();
	session_unset();
	setCurrentLID($lanid);
	setCurrentUser(0);
}
?>