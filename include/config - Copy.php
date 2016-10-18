<?php

error_reporting(E_ALL); ini_set('display_errors', 1); 
session_start();
define('SITE_URL',"http://127.0.0.1/begeeb/site/");
define('ADMIN_EMAIL',"mnadee123@gmail.com");
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_NAME",'begeeb');

/*
session_start();
define('SITE_URL',"http://begeeb.com/");
define('ADMIN_EMAIL',"admin@begeeb.com");
define("DB_HOST","localhost");
define("DB_USER","begeeb_main_user");
define("DB_PASSWORD","bege!2Di14N)User");
define("DB_NAME",'begeeb_main');

*/
// Including required libraries and functions

if(file_exists("libs/functions.php"))
	include_once "libs/functions.php";
elseif(file_exists("../libs/functions.php"))
	include_once "../libs/functions.php";

if(file_exists("libs/Database.php"))
	include_once "libs/Database.php";
elseif(file_exists("../libs/Database.php"))
	include_once "../libs/Database.php";
	
if(file_exists("libs/Users.php"))
	include_once "libs/Users.php";
elseif(file_exists("../libs/Users.php"))
	include_once "../libs/Users.php";
	
if(file_exists("libs/Cart.php"))
	include_once "libs/Cart.php";
elseif(file_exists("../libs/Cart.php"))
	include_once "../libs/Cart.php";
	
if(file_exists("libs/Orders.php"))
	include_once "libs/Orders.php";
elseif(file_exists("../libs/Orders.php"))
	include_once "../libs/Orders.php";

$user = new Users();

?>