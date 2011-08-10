<?php
/**
 * Table Definition for lan_events
 */
require_once 'DB/DataObject.php';

class Lan_events extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_events';                      // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $name;                            // varchar(50)  not_null
    public $mode_id;                         // int(11)  not_null group_by
    public $start;                           // datetime(19)  not_null
    public $end;                             // datetime(19)  not_null
    public $places;                          // int(11)  not_null group_by
    public $layout;                          // blob(65535)  not_null blob
    public $text;                            // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_events',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
