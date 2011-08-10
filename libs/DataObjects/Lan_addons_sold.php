<?php
/**
 * Table Definition for lan_addons_sold
 */
require_once 'DB/DataObject.php';

class Lan_addons_sold extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_addons_sold';                 // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $lan_id;                          // int(11)  not_null group_by
    public $user_id;                         // int(11)  not_null group_by
    public $addon_id;                        // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_addons_sold',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
