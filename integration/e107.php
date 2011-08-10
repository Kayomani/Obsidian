<?php



// Implement the interface
// This will work
class FrontEnd implements iInterface
{
	private $link = null;
	private $connected = false;

	private $mySQLserver    = 'localhost';
	private $mySQLuser      = 'root';
	private $mySQLpassword  = '';
	private $mySQLdefaultdb = 'lan';
	private $mySQLprefix    = 'e107_';



	//++ SQL

	private function connect()
	{
		if(!$this->connected)
		{
			
			$this->connected = true;
			$this->link =  mysql_connect($this->mySQLserver,$this->mySQLuser,$this->mySQLpassword);
			@mysql_select_db($this->mySQLdefaultdb,$this->link) or die( "Unable to select database");
		}
	}


	private function runQueryResult($sql)
	{
		if(!$this->connected)
		$this->connect();
		$res = mysql_query($sql,$this->link) or die(mysql_error());
		return $res;
	}

	private function runQueryNoResult($sql)
	{
		if(!$this->connected)
		$this->connect();
		return mysql_query($sql,$this->link) or die(mysql_error());
	}

	private function getQuerySingleResult($sql)
	{
		$res = $this->runQueryResult($sql);
		$num = mysql_num_rows($res);
		if($num == 0)
		return false;
		else
		return mysql_fetch_row($res);
	}

	public function disconnect()
	{
		if($this->connected)
		{
			mysql_close($this->link);
			$this->connected = false;
		}
	}

	function __destruct() {
		if($this->connected)
		{
			mysql_close($this->link);
		}
	}

	private function getMysqlLink()
	{
		if(!$this->connected)
		$this->connect();
		return $this->link;
	}

	//--SQL

	public function encryptPassword($string)
	{
		return md5($string);
	}

	public function getName($id)
	{
		if('0' == $id)
		return false;
		
		$this->connect();
		$sql = "SELECT user_name from ".$this->mySQLprefix."user WHERE `user_id` = '".$id."';";

		$res = $this->getQuerySingleResult($sql);
		if($res == false)
		return false;
		else
		return $res[0];
	}

	public function findUserID($string){

		$this->connect();
		$sql = "SELECT user_id from ".$this->mySQLprefix."user WHERE `user_name` = '".$string."';";

		$res = $this->getQuerySingleResult($sql);
		if($res == false)
		return 0;
		else
		return $res[0];
	}

	/**public function checkIsAdmin($smarty)
	{
		if(!isset($currentUser))
		return false;
		$uid =  $currentUser['user_id'];
		if($uid == '0')
		return false;
		$this->connect();
		$sql = "SELECT user_admin from ".$this->mySQLprefix."user WHERE `user_id` = ".$id.";";
		$res = $this->getQuerySingleResult($sql);
		if($res == false)
		return false;
		else if ($res[0] = '1')
		return true;
		return false;
	}**/

	private function iCheckGroup($id,$lan, $gid, $ogid)
	{
		$products = new Lan_addons_sold;
		$products->lan_id = $lan;
		$products->user_id = $id;
		$products->addon_id = $ogid;
		if(0==$products->count())
		{
			$this->connect();
			$sql = "SELECT user_class from ".$this->mySQLprefix."user WHERE `user_id` = ".$id.";";
			$res = $this->getQuerySingleResult($sql);

			if($res != false)
			{
				$groups = explode(',',$res[0]);
				$inGroup = false;

				foreach ($groups as $group)
				{
					if(0==strcmp($group,$gid))
					{
						$inGroup = true;

					}
				}
				if($inGroup)
				{
					$product = new Lan_addons_sold;
					$product->addon_id = $ogid;
					$product->user_id = $id;
					$product->lan_id = $lan;
					$product->insert();
				}
			}
		}
	}

	public function checkGroups($id,$lan)
	{
		if($id ==0 || $lan ==0)
		return;
		//7  	LanOps 9 attendee
		$this->iCheckGroup($id, $lan, 7, 1);
		//8  	LanOps 9 spectator
		$this->iCheckGroup($id, $lan, 8, 2);
		//Check admin
		/*if($this->checkIsAdmin($id))
		{
			$products = new Lan_addons_sold;
			$products->lan_id = $lan;
			$products->user_id = $id;
			$products->addon_id = 5;
			if(0==$products->count())
			{
				$product = new Lan_addons_sold;
				$product->addon_id = 5;
				$product->user_id = $id;
				$product->lan_id = $lan;
				$product->insert();
			}
		}*/
	}

	public function getUserId()
	{
		global $currentUser;
		if(isset($currentUser))
		return $currentUser['user_id'];
		return '0';
	}


	public function getAllUsers()
	{
		$sql = "SELECT user_id,user_name from e107_user order by user_name ASC";
		$res = $this->runQueryResult($sql);
		$users = array();
		while ($row = mysql_fetch_array($res)) {
			$users[$row[1]] = $row[0];
		}
		return $users;
	}

	private function getProfileField($id)
	{
		$sql = "SELECT user_clantag from e107_user_extended where user_extended_id = " . $id;
		$res = $this->getQuerySingleResult($sql);
		if($res)
		return $res[0];
		return "";
	}

	public function pullUserInfo($id)
	{

		$sql = "SELECT user_id, user_name, user_password, user_email from e107_user where user_id = " . $id;
		$res = $this->getQuerySingleResult($sql);
		if($res)
		{
			$luser = new Lan_users;
			$luser->user_id = $id;

			if(0==$luser->count())
			{
				$luser->username = $res[1];
				$luser->user_id = $res[0];
				$luser->password = $res[2];
				$luser->email = $res[3];
				$luser->clan = $this->getProfileField($id);
				$luser->insert();
			}
			else
			{
				$luser->username = $res[1];
				$luser->user_id = $res[0];
				$luser->password = $res[2];
				$luser->email = $res[3];
				$luser->clan = $this->getProfileField($id);
				$luser->update();
			}
			return true;
		}
		return false;
	}
	
	
}
?>