<?php

// Define the core paths for this application
// Use absolute paths to make sure the require_once statements function
// as expected.

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for windows, / for unix)
defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);

// Define the site root and path to includes
defined('SITE_ROOT') ? null : 
        define("SITE_ROOT", 'c:'.DS.'xampp'.DS.'htdocs'.DS.'gx');
defined('LIB_PATH') ? null : define("LIB_PATH", SITE_ROOT.DS.'includes');

// load the config file first
require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'functions.php');

// load the core objects
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php'); // uses database
require_once(LIB_PATH.DS.'user.php'); // database related, uses database_object
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'logger.php');

// load database related classes


