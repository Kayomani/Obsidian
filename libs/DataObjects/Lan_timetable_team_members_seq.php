<?php
/**
 * Table Definition for lan_timetable_team_members_seq
 */
require_once 'DB/DataObject.php';

class Lan_timetable_team_members_seq extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_timetable_team_members_seq';    // table name
    public $sequence;                        // int(11)  not_null primary_key auto_increment group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_timetable_team_members_seq',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
