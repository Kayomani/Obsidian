<?php
/**
 * Table Definition for lan_schedule
 */
require_once 'DB/DataObject.php';

class Lan_schedule extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_schedule';                    // table name
    public $id;                              // int(11)  not_null primary_key group_by
    public $lan_id;                          // int(11)  not_null group_by
    public $when;                            // date(10)  not_null
    public $name;                            // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_schedule',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
