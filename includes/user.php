<?php

class User extends DatabaseObject {
    
    protected static $table_name = "users";
    protected static $db_fields = 
            array('id', 'username', 'password', 'firstName', 'lastName', 'privilege');
    public $id;
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $privilege;
    
    public static function authenticate($username="", $password="") {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        
        $sql  = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;        
    }
    
    public function full_name() {
        if(isset($this->firstName) && isset($this->lastName))
        {
            return $this->firstName . " " . $this->lastName;
        }
        return "";
    }
}
