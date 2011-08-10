<?php
/**
 * Table Definition for lan_permission_settings
 */
require_once 'DB/DataObject.php';

class Lan_permission_settings extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_permission_settings';         // table name
    public $perset_id;                       // int(11)  not_null primary_key auto_increment group_by
    public $mode_id;                         // int(11)  not_null group_by
    public $permission_id;                   // int(11)  not_null group_by
    public $group_id;                        // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_permission_settings',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
