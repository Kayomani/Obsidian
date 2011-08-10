<?php
/**
 * Table Definition for lan_permission
 */
require_once 'DB/DataObject.php';

class Lan_permission extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_permission';                  // table name
    public $permission_id;                   // int(11)  not_null primary_key auto_increment group_by
    public $module;                          // varchar(50)  not_null
    public $action;                          // varchar(50)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_permission',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
