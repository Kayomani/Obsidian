<?php
/**
 * Table Definition for e107_user
 */
require_once 'DB/DataObject.php';

class E107_user extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'e107_user';                       // table name
    public $user_id;                         // int(10)  not_null primary_key unsigned auto_increment group_by
    public $user_name;                       // varchar(100)  not_null unique_key
    public $user_loginname;                  // varchar(100)  not_null
    public $user_customtitle;                // varchar(100)  not_null
    public $user_password;                   // varchar(32)  not_null
    public $user_sess;                       // varchar(100)  not_null
    public $user_email;                      // varchar(100)  not_null
    public $user_signature;                  // blob(65535)  not_null blob
    public $user_image;                      // varchar(100)  not_null
    public $user_timezone;                   // varchar(3)  not_null
    public $user_hideemail;                  // tinyint(3)  not_null unsigned group_by
    public $user_join;                       // int(10)  not_null unsigned group_by
    public $user_lastvisit;                  // int(10)  not_null unsigned group_by
    public $user_currentvisit;               // int(10)  not_null unsigned group_by
    public $user_lastpost;                   // int(10)  not_null unsigned group_by
    public $user_chats;                      // int(10)  not_null unsigned group_by
    public $user_comments;                   // int(10)  not_null unsigned group_by
    public $user_forums;                     // int(10)  not_null unsigned group_by
    public $user_ip;                         // varchar(20)  not_null
    public $user_ban;                        // tinyint(3)  not_null multiple_key unsigned group_by
    public $user_prefs;                      // blob(65535)  not_null blob
    public $user_new;                        // blob(65535)  not_null blob
    public $user_viewed;                     // blob(65535)  not_null blob
    public $user_visits;                     // int(10)  not_null unsigned group_by
    public $user_admin;                      // tinyint(3)  not_null unsigned group_by
    public $user_login;                      // varchar(100)  not_null
    public $user_class;                      // blob(65535)  not_null blob
    public $user_perms;                      // blob(65535)  not_null blob
    public $user_realm;                      // blob(65535)  not_null blob
    public $user_pwchange;                   // int(10)  not_null unsigned group_by
    public $user_xup;                        // varchar(100)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('E107_user',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
