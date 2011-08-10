<?php
/**
 * Table Definition for lan_log
 */
require_once 'DB/DataObject.php';

class Lan_log extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_log';                         // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $when;                            // timestamp(19)  not_null unsigned zerofill timestamp
    public $user_id;                         // int(11)  not_null group_by
    public $type;                            // int(11)  not_null group_by
    public $message;                         // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_log',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
