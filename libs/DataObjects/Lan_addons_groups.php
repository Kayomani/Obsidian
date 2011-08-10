<?php
/**
 * Table Definition for lan_addons_groups
 */
require_once 'DB/DataObject.php';

class Lan_addons_groups extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_addons_groups';               // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $name;                            // varchar(100)  not_null
    public $price;                           // decimal(11)  not_null
    public $allowSeating;                    // tinyint(1)  not_null group_by
    public $availible;                       // tinyint(1)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_addons_groups',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
