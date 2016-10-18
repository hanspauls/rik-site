<?php

// Including required libraries and functions
if(file_exists("include/Admin.php"))
	include_once "include/Admin.php";
elseif(file_exists("../include/Admin.php"))
	include_once "../include/Admin.php";

$adminObj = new Admin();

?>