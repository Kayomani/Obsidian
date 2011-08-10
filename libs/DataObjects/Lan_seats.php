<?php
/**
 * Table Definition for lan_seats
 */
require_once 'DB/DataObject.php';

class Lan_seats extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_seats';                       // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $lan_id;                          // int(11)  not_null group_by
    public $seat_name;                       // varchar(20)  
    public $user_id;                         // int(11)  not_null group_by
    public $x;                               // int(4)  not_null group_by
    public $y;                               // int(4)  not_null group_by
    public $type;                            // int(11)  not_null group_by

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_seats',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
