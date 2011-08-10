<?php
/**
 * Table Definition for lan_permission_membership
 */
require_once 'DB/DataObject.php';

class Lan_permission_membership extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_permission_membership';       // table name
    public $group_member_id;                 // int(11)  not_null primary_key auto_increment group_by
    public $user_id;                         // int(11)  not_null group_by
    public $permgroup_id;                    // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_permission_membership',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
