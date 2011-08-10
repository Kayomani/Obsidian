<?php
/**
 * Table Definition for lan_permission_groups
 */
require_once 'DB/DataObject.php';

class Lan_permission_groups extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_permission_groups';           // table name
    public $permgroup_id;                    // int(11)  not_null primary_key auto_increment group_by
    public $group_name;                      // varchar(50)  not_null
    public $user_group;                      // tinyint(1)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_permission_groups',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    
    function FindGroupID($name){
	$group = new Lan_permission_groups;
	$group->group_name = $name;
	$group->find();
	if($group->fetch()){
		return $group->permgroup_id;
	}
}
    
}
