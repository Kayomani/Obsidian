<?php
/**
 * Table Definition for lan_servers
 */
require_once 'DB/DataObject.php';
require_once 'libs/gameq/GameQ.php';

function ObjSafeGet($obj, $name){

	if(isset($obj[$name]))
	return $obj[$name];
	return "";
}

class Lan_servers_player {
	public $name;
	public $score;
	public $time;
}

class Lan_servers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_servers';                     // table name
    public $server_id;                       // int(11)  not_null primary_key auto_increment group_by
    public $address;                         // blob(65535)  not_null blob
    public $cport;                           // int(11)  not_null group_by
    public $qport;                           // int(11)  not_null group_by
    public $sport;                           // int(11)  not_null group_by
    public $ping;                            // int(11)  group_by
    public $game;                            // blob(65535)  not_null blob
    public $gamename;                        // varchar(50)  not_null
    public $protocol;                        // varchar(15)  not_null
    public $map;                             // blob(65535)  blob
    public $playerinfo;                      // blob(65535)  blob
    public $maxplayers;                      // int(11)  group_by
    public $playercount;                     // int(11)  group_by
    public $dedicated;                       // tinyint(1)  group_by
    public $password;                        // int(11)  not_null group_by
    public $servervars;                      // varchar(1000)  
    public $hostname;                        // blob(65535)  blob
    public $hostnameoverride;                // blob(65535)  blob
    public $comment;                         // blob(65535)  blob
    public $lastupdated;                     // datetime(19)  not_null
    public $type;                            // int(11)  not_null group_by
    public $user_id;                         // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_servers',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	public static $GQ_TIMEOUT = 1000;

	function getPlayers(){
		$info = unserialize($this->playerinfo);
		if(is_array($info))
		  return $info;
		else
		return array();
	}
	
	function setPlayers($info){
		$this->playerinfo = serialize($info);
	}
	
	function getServerVars()
	{
		$info = unserialize($this->servervars);
		if(is_array($info))
		  return $info;
		else
		return array();
	}
	
function setServerVars($info){
		$this->servervars = serialize($info);
	}

	function UpdateLastUpdated(){
		$this->lastupdated = strftime("%Y-%m-%d %H:%M:00", strtotime("now")); 
	}
}
