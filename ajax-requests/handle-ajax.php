<?php
	include_once "../include/config.php";
	if(isset($_POST['updatecart']) and isset($_POST['orderId'])){
		$orderId = $_POST['orderId'];
		if(isset($_SESSION['PRD_ORDERS'][$orderId])){
			unset($_SESSION['PRD_ORDERS'][$orderId]);
			echo 'ok';
		}else{
			echo 'error';
		}
	}
	else{
		echo 'Error: Request cannot be identified.';
	}
	
	if(isset($_POST['updatecartEdit']) and isset($_POST['orderId']) and isset($_POST['orderIdOrig'])){
		$orderId = $_POST['orderId'];
		$orderId_db = $_POST['orderIdOrig'];
		$orderObj = new Orders();
		$deleted = $orderObj->deleteOrderById($orderId_db);
		
		if(isset($_SESSION['PRD_ORDERS_SELECTED'][$orderId]) and $deleted){
			unset($_SESSION['PRD_ORDERS_SELECTED'][$orderId]);
			echo 'ok';
		}else{
			echo 'error';
		}
	}
	else{
		echo 'Error: Request cannot be identified.';
	}
?>