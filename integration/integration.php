<?php

require_once("config.php");

interface iInterface
{
	//Return FALSE if not found
  //  public function getName($id);
  //  public function checkIsAdmin($smarty);
    //This function is called to see if there are groups to be imported from the host system.
    public function checkGroups($id,$lan);
    public function getUserId();
  //  public function getProfileField($id);
    public function getAllUsers();
    public function pullUserInfo($id);
    public function encryptPassword($string);
    //public function findUserID($string);
}

require_once(Config::$system .".php");

?>