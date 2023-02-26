<?php
require_once(BASEDIR .'/Data/UserDataService.Class.php');

class User 
{
    private $UserID;
    private $user_name;
    private $password;

    public function __construct($UserID, $user_name, $password)
    {
        $this->UserID = $UserID;
        $this->user_name = $user_name;
        $this->password = $password;
    }

    public function getUserID()
    {
        return $this->UserID;
    }
    public function getUserName()
    {
        return $this->user_name;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public static function getUserFromDBByUserName($user_name)
    {
        return UserDataService::getUserFromDBByUserName_service($user_name);
    }
}

?>