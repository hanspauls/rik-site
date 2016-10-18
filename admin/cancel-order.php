<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; ?>
<?php include_once "check-admin-login.php"; ?>
<?php 
if(empty($_GET['order'])){
	redirectToUrl("new-orders.php");
}
$currOrderId = cleanData($_GET['order']);

$cancel = $adminObj->cancelOrder($currOrderId);
if($cancel){
	setFlashMessage('success',"Order have been cancelled successfully.");
	redirectToUrl($_SERVER['HTTP_REFERER']);
}
else{
	setFlashMessage('error',"Order cannot be cancelled.");
	redirectToUrl($_SERVER['HTTP_REFERER']);
}
//print_r($ordersAll);


?>
