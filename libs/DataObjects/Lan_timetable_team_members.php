<?php
/**
 * Table Definition for lan_timetable_team_members
 */
require_once 'DB/DataObject.php';

class Lan_timetable_team_members extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_timetable_team_members';      // table name
    public $tm_id;                           // int(11)  not_null primary_key auto_increment group_by
    public $user_id;                         // int(11)  not_null group_by
    public $team_id;                         // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_timetable_team_members',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

	/*
	 * Join a team
	 * @param timetable id
	 */
	public function JoinTeam($ttid){
		//Check not anonymous
		if($this->user_id==0){
			return "Anonymous users cannot join teams!";
		}

		if(null==$ttid){
			return "Programming error: No timetable ID passed!";
		}
		//Check allow signup
		$timetable = new Lan_timetable;
		$timetable->id = $ttid;
		//$timetable->allowsignups = 1;
		$timetable->teambased = 1;
		
		if(1!=$timetable->find()){
			return "This event does not allow joining teams.";
		}
		//Check not already in a team
		$team = new Lan_timetable_teams;
		$member = new Lan_timetable_team_members;
		
		$member->user_id = $this->user_id;
		
		$team->timetable_id = $ttid;
		$team->joinAdd($member);
		if($team->count()!=0){
			return "This user cannot join a team twice!";
		}
		
		//Check max team size
		$timetable->fetch();
		$team->team_id = $this->team_id;
		$team->PopulateMembers();
		$teamsize = count($team->members);
		if(!streq($teamsize,"0") && $timetable->teamsize < ($teamsize+1)){
			return "Max team size reached!";
		}
		
		
		
		//Join team
		if($this->insert()==0){
			return "This user is already in a team for this event!";
		}

		//Remove pug if needed.
		$signup = new Lan_timetable_signups;
		$signup->timetable_id =$ttid;
		$signup->user_id = $this->user_id;
		while($signup->fetch()){
			$signup->delete();
		}
		return false;
	}

	/**
	 * Remove a user from a team
	 * @param timetable id $ttid
	 */
	 public function RemoveMember($ttid){

		if(null==$ttid){
			return "Programming error: No timetable ID passed!";
		}

		//Find team
		$team = new Lan_timetable_teams;
		$team->timetable_id = $ttid;
		$team->team_id = $this->team_id;
		$team->find();
		while($team->fetch()){
			$member = new Lan_timetable_team_members;
			$member->user_id = $this->user_id;
			$member->team_id = $this->team_id;
			$userid = $member->user_id;
			if($member->count()!=0){
				$member->delete();
				//If there are no members left then remove the team
				$member = new Lan_timetable_team_members;
				$member->team_id = $team->team_id;
				if(0==$member->count()){
					$team->delete();
				}
				else{
					//There are team members left, check captain and adjust if needed.
					if(streq($team->owner, $userid))
					{
						$member = new Lan_timetable_team_members;
			            $member->team_id = $this->team_id;
			            $member->find();
						$member->fetch();
						$team->owner = $member->user_id;
						$team->update();
					}
				}
				return false;
			}
		}

		return "Failed to remove signup.";
	}
}
