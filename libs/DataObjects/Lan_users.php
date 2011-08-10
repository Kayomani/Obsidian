<?php
/**
 * Table Definition for lan_users
 */
require_once 'DB/DataObject.php';
require_once 'libs/steamcommunityapi/SteamAPI.class.php';

class Lan_users extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_users';                       // table name
    public $user_id;                         // int(11)  not_null primary_key group_by
    public $username;                        // blob(65535)  not_null blob
    public $password;                        // blob(65535)  not_null blob
    public $email;                           // blob(65535)  blob
    public $clan;                            // blob(65535)  blob
    public $ip;                              // blob(65535)  blob
    public $netbios;                         // blob(65535)  blob
    public $avatar;                          // varchar(200)  not_null
    public $smallavatar;                     // varchar(200)  not_null
    public $steamdata;                       // varchar(65000)  not_null
    public $steamprofile;                    // varchar(50)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_users',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	/**
	 * Manually manage ID
	 */
	function sequenceKey(){
		return array(false,false);
	}


	function updateSteamData(){
		if(strlen($this->steamprofile)!=0){
			$steam = new SteamAPI($this->steamprofile);
			$steam->retrieveProfile();
			$this->smallavatar = $steam->getAvatarSmall();
			$this->avatar = $steam->getAvatarFull();
			$this->steamdata = $steam->getData();
		}
		else
		{
			$this->smallavatar = "";
			$this->avatar = "";
			$this->steamdata = "";
		}
	}

	function getSteamData(){
		if(strlen($this->steamprofile)!=0){
			$steam = new SteamAPI($this->steamprofile);
			$steam->setData($this->steamdata);
			return $steam;
		}
		return new SteamAPI($this->steamprofile);
	}
}
