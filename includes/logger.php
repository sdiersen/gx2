<?php

defined('LOG_DIR') ? NULL : define('LOG_DIR', SITE_ROOT . DS . 'logs');
defined('LOG_FILE') ? NULL : define('LOG_FILE', LOG_DIR . DS . "log_file.log");

class Logger {
    private static $log_name = "log_file.log";
    private static $actions = array('Login', 'Logout', 'Clear');
    
    public static function log_action($action, $message="") {
        if (!in_array($action, static::$actions)) {
            return "Action: " . static::$action . ", not recognized.";
        }
        if ($handle = fopen(LOG_FILE, "a")) {
            $datetime = strftime("%Y-%m-%d %H:%M:%S", time());
            $output = "{$datetime} | {$action} : {$message}\n";
            
            if (!fwrite($handle, $output)) {
                return "File: " . LOG_FILE . "=> unable to write: " . $output;
            }
            if (!fclose($handle)) {
                return "File: " . LOG_FILE . ", unable to be closed.";
            }
            return "OK";
        } else {
            return "File: " . LOG_FILE . ", unable to be opened.";
        }
    }
    public static function log_exists() {
        if(is_dir(LOG_DIR)) {
            $dir_array = scandir(LOG_DIR);
            foreach($dir_array as $file) {
                if($file == static::$log_name) {
                    return "OK";
                }                
            }
            return "File: " . static::$log_name . " => does not exist.";
        }
        return "Directory: " . LOG_DIR . " => does not exist.";
    }
    public static function read_log() {
        if($handle = fopen(LOG_FILE, 'r')) {
            $content = fread($handle, filesize(LOG_FILE));
            fclose($handle);
            $message = n12br($content);
            return $message;
        }
        return false;
    }
    public static function clear_log() {
        if ($handle = fopen(LOG_FILE, 'w')) {
            fclose($handle);
            return true;
        }
        return false;
    }
    public static function read_log_formatted() {
        if($handle = fopen(LOG_FILE, 'r')) {
            $content = "<ul class=\"log-entries\">";
            while(!feof($handle)) {
                $entry = fgets($handle);
                if(trim($entry) != "") {
                    $content .= "<li>{$entry}</li>";
                }
            }
            $content .="</ul>";
            return $content;
        }
        return false;
    }
}