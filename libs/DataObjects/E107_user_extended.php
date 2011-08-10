<?php
/**
 * Table Definition for e107_user_extended
 */
require_once 'DB/DataObject.php';

class E107_user_extended extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'e107_user_extended';              // table name
    public $user_extended_id;                // int(10)  not_null primary_key unsigned group_by
    public $user_hidden_fields;              // blob(65535)  not_null blob
    public $user_seatID;                     // varchar(255)  
    public $user_clantag;                    // varchar(255)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('E107_user_extended',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
