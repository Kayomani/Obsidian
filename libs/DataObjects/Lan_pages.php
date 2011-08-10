<?php
/**
 * Table Definition for lan_pages
 */
require_once 'DB/DataObject.php';

class Lan_pages extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_pages';                       // table name
    public $page_id;                         // int(11)  not_null primary_key auto_increment group_by
    public $module;                          // varchar(30)  not_null
    public $file;                            // varchar(30)  not_null
    public $name;                            // varchar(30)  not_null
    public $template;                        // varchar(50)  
    public $friendlyname;                    // varchar(50)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_pages',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
