<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; 

$isadminLoggedIn = $adminObj->logoutAdmin();
if($isadminLoggedIn){
	redirectToUrl("login.php");	
}
?>