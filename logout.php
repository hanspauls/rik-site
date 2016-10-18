<?php include_once "include/config.php"; ?>
<?php 
$wrapperClass = "wrapper-flexi signup-page";
include_once "include/header-home.php"; 
//echo '<pre>';print_r($_SESSION);exit;

//$user->logoutUser();
if($user->logoutUser()){
	redirectToUrl(SITE_URL);
}
else{
	redirectToUrl(SITE_URL.'account/order-history.php');
}
?>