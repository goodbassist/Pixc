<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
define(BASEURL,"http://localhost/pixc/");

// Define database constants ONLINE

define(DB_TYPE, "mysql");
define(DB_HOST, "localhost");
define(DB_USER, "root");
define(DB_PASS, "");
define(DB_NAME, "pixc");

// Define the default display class for errors
define(DEFAULT_DISPLAY_CLASS, 'alert error');

//autolader 
require_once 'autoloader.php';



?>