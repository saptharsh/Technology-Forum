<?php
// Start Session
session_start();

// Include configuration
require_once ( _root.'/Forum/config/config.php');

// Autoload Classes
function __autoload($class_name){
    
    require_once ( _root.'/Forum/libraries/'.$class_name.'.php');
    
}

// Helper Function Files
require_once ( _root.'/Forum/helpers/db_helper.php');
require_once ( _root.'/Forum/helpers/format_helper.php');
require_once ( _root.'/Forum/helpers/system_helper.php');



