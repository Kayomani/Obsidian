<?php
/**
 * Table Definition for lan_games
 */
require_once 'DB/DataObject.php';

class Lan_games extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'lan_games';                       // table name
    public $game_id;                         // int(11)  not_null primary_key auto_increment group_by
    public $name;                            // blob(65535)  not_null blob
    public $picture;                         // blob(65535)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Lan_games',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
