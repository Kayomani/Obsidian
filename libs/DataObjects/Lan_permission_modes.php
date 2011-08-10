<?php
/**
 * Table Definition for lan_permission_modes
 */
require_once 'DB/DataObject.php';

class Lan_permission_modes extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_permission_modes';            // table name
    public $mode_id;                         // int(11)  not_null primary_key auto_increment group_by
    public $mode_name;                       // varchar(50)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_permission_modes',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
