<?php

class Session {
    private $logged_in = false;
    public $user_id;
    public $message;
    public $first_name;
    public $last_name;
    public $base_priv;
    public $set_priv;
    
    function __construct() {
        session_start();
        $this->check_message();
        $this->check_login();
    }
    
    public function is_logged_in() {
        return $this->logged_in;
    }
    
//    public function login($user) {
//        if ($user) {
//            $this->user_id = $_SESSION['user_id'] = $user->id;
//            $this->logged_in = true;
//            $this->first_name = $user->firstName;
//            $this->last_name = $user->lastName;
//            $this->base_priv = $this->set_priv = $user->privilege;
//        }
//    }
    public function login($user, $priv = NULL) {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
            $this->first_name = $user->firstName;
            $this->last_name = $user->lastName;
            if (!$priv)
            $this->base_priv = $user->privilege;
            $this->set_priv = $priv;
        }
    }
    
    public function get_session_priv() {
        if ($this->base_priv == $this->set_priv || $this->set_priv == "default") {
            return $this->base_priv;
        }
        if ($this->base_priv == "admin") {
            return $this->set_priv;
        }
        if ($this->set_priv == "admin") {
            return $this->base_priv;
        }
        return "guest";        
    }
    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
    }
    
    private function check_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
    
    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
    
    public function message($msg="") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;            
        } else {
            return $this->message;
        }
    }
        
}

$session = new Session();
$message = $session->message();

?>