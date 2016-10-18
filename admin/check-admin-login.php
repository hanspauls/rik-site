<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; 

$isadminLoggedIn = $adminObj->checkAdminLogin();
if(!$isadminLoggedIn){
	redirectToUrl("login.php");	
}
$adminData = $adminObj->getAdminDetails($_SESSION['log_adminId']);
if(empty($adminData) or !is_array($adminData)){
	redirectToUrl("login.php");
}
?>
