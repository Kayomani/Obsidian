<?php
/**
 * Table Definition for lan_timetable_teams
 */
require_once 'DB/DataObject.php';
require_once 'Lan_timetable_team_members.php';

class Lan_timetable_teams extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_timetable_teams';             // table name
    public $team_id;                         // int(11)  not_null primary_key auto_increment group_by
    public $timetable_id;                    // int(11)  not_null group_by
    public $name;                            // varchar(50)  not_null
    public $owner;                           // int(11)  not_null group_by
    public $tag;                             // varchar(30)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_timetable_teams',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	
	public function PopulateMembers(){
		 $memberlist = array();
		 $members = new Lan_timetable_team_members;
		 $members->team_id = $this->team_id;
		 $user = new Lan_users;
		 $members->joinAdd($user);
		 $members->find();
		 while($members->fetch()){		 	
		 	$memberlist[] = clone($members);
		 }
		 
		 $this->members = $memberlist;
	}
	
	
	
	/**
	 * Create a team
	 * @param $name
	 * @param $tag
	 */
	public function CreateTeam(){
		//Anonymous users cannot register.
		if(streq($this->owner,"0")){
			return "Anonymous users cannot register teams!";
		}
		 
		//Validate against team name being in use.
		$test = new Lan_timetable_teams;
		$test->name = $this->name;
		$test->tag = $this->tag;
		$test->timetable_id = $this->timetable_id;
		if($test->count()!=0){
			return "A team with this name already exists!";
		}
		 
		//Validate against the captain already being in a team
		$tm = new Lan_timetable_team_members;
		$tm->user_id = $this->owner;
		$test = new Lan_timetable_teams;
		$test->joinAdd($tm, "CENTER");
		if($test->count()!=0){
			return "You cannot create a team whilst you are in a team!";
		}
		 
		//Check that teams are being used
		$tt = new Lan_timetable;
		$tt->id = $this->timetable_id;
		$tt->teambased = 1; 
		if($tt->find()!=1){
			return "This event is not team based!";
		}
		
		$tt->fetch();
		$test = new Lan_timetable_teams;
		$test->timetable_id = $this->timetable_id;
		
		if(!streq("0",$tt->maxplayers) && $tt->maxplayers< $test->count() +1){
			return "Max team count reached for this event.";
		}
		
		 
		//All is ok, so insert the team
		if(0==$this->insert()){
			return "Team creation failed!";
		}
		
		//Add the captain as a member
		$tm = new Lan_timetable_team_members;
		$tm->team_id = $this->team_id;
		$tm->user_id = $this->owner;
		if(0==$tm->insert()){
			return "Error adding captain as team member!";
		}
		
		 
		//If the player is a PUG player then remove them from the list.
		$signup = new Lan_timetable_signups;
		$signup->timetable_id = $this->timetable_id;
		$signup->user_id = $this->owner;
		while($signup->fetch()){
			$signup->delete();
		} 
		return false;
	}

}
