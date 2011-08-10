<?php
/**
 * Table Definition for lgsl
 */
require_once 'DB/DataObject.php';

class Lgsl extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lgsl';                            // table name
    public $id;                              // int(11)  not_null primary_key auto_increment group_by
    public $type;                            // varchar(50)  not_null
    public $ip;                              // varchar(255)  not_null
    public $c_port;                          // varchar(5)  not_null
    public $q_port;                          // varchar(5)  not_null
    public $s_port;                          // varchar(5)  not_null
    public $zone;                            // varchar(255)  not_null
    public $disabled;                        // tinyint(1)  not_null group_by
    public $comment;                         // varchar(255)  not_null
    public $status;                          // tinyint(1)  not_null group_by
    public $cache;                           // blob(65535)  not_null blob
    public $cache_time;                      // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lgsl',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
