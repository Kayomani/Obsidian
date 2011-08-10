<?php
/**
 * Table Definition for lan_timetable
 */
require_once 'DB/DataObject.php';

class Lan_timetable extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_timetable';                   // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $occurs;                          // datetime(19)  not_null
    public $type;                            // blob(65535)  not_null blob
    public $lan_id;                          // int(11)  not_null group_by
    public $owner;                           // int(11)  not_null group_by
    public $game;                            // int(11)  group_by
    public $eventname;                       // blob(65535)  not_null blob
    public $othergame;                       // blob(65535)  blob
    public $maxplayers;                      // int(11)  group_by
    public $minplayers;                      // int(11)  group_by
    public $userevent;                       // int(11)  not_null group_by
    public $details;                         // blob(65535)  blob
    public $allowsignups;                    // int(11)  not_null group_by
    public $teambased;                       // int(11)  not_null group_by
    public $teamsize;                        // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_timetable',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public function PopulateTeams(){
    	$teams = array();
    	$team = new Lan_timetable_teams;
    	$team->timetable_id = $this->id;
    	$team->find();
    	while($team->fetch()){
    		$teams[] = clone($team);
    	}
    	$this->teams = $teams;
    }
}
