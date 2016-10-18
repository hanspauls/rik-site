<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; ?>
<?php include_once "check-admin-login.php"; ?>
<?php include_once "include/header.php"; ?>
<?php 
$seletedPage = 'confirmed-orders';
include_once "include/sidebar.php"; 

if(empty($_GET['order'])){
	redirectToUrl("new-orders.php");
}
$currOrderId = cleanData($_GET['order']);

$ordersAll = $adminObj->getOrderDetails($currOrderId);
//print_r($ordersAll);
if(empty($ordersAll)){
	setFlashMessage('error',"Order cannot be retrieved.");
	redirectToUrl("new-orders.php");
}
if(isset($_POST['change_status'])){
	//echo '<pre>';print_r($_POST);exit;

	if(!isset($_POST['shipping_status'])){
		setFlashMessage('error',"Please select the status to change.");
		redirectToUrl("shipping-status.php?order=$currOrderId");
	}
	$status = cleanData($_POST['shipping_status']);
	//echo $status;exit;
	$update = $adminObj->updateOrderStatus($currOrderId, $status);
	
	if($update){
		setFlashMessage('success',"Shipping status has been changed successfully.");
		redirectToUrl("shipping-status.php?order=$currOrderId");
	}
	else{
		setFlashMessage('error',"Status cannot be changed, Please try again.");
		redirectToUrl("shipping-status.php?order=$currOrderId");
	}
}
?>
	<section id='main-content'>
		<header id='main-head-wrap'>
			<div class='bold18 left' id='user-st'>Happy Sunday, <?php echo $_SESSION['log_adminName'] ?>!</div>
			<div class='right' id='user-nav'>
				<span class='userIco'><img src="images/userIco.png"></span> 
				<span class='userText'><?php echo $_SESSION['log_adminEmail'] ?></span>
			</div>
		</header>
		<div id='content-wrap'>
			<div class='large-content'>
				<div class='content-head center'>
					Product Details Shipping Status
				</div>
				<div class='contents'>
					<div class='content-box padding'>
						<?php if(checkFlashMessage('error')){ ?>
                                <div style="padding:10px;color:red;">
                                    <?php echo getFlashMessage("error"); ?> 
                                </div>
                        <?php } ?>
                        <?php if(checkFlashMessage('success')){ ?>
                                <div style="padding:10px;color:green;">
                                    <?php echo getFlashMessage("success"); ?> 
                                </div>
                        <?php } ?>
						<form action='?order=<?php echo $currOrderId ?>' class='full-width card-form' method="post">
                        	<?php foreach($ordersAll as $orderNumb => $ordersValOut): ?>
							<div class='field'>
								<table width='100%'>
									<tr>
										<td ><label>Order Number: </label>
                                        	<?php echo $orderNumb ?>
                                        </td>
									</tr>    
                                    <tr>
                                        <td ><label>Promo Code: </label>
                                        	<?php echo $ordersValOut[0]['promo_code']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer Name: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['name'] ?>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td ><label>Customer Email: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['email'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer Phone: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['phone'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer City: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['city'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Total Products: </label>
                                        	<?php echo count($ordersValOut) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Shipping Status: </label>
                                        	<?php
											$ordStatus = "N/A";
											if($ordersValOut[0]['shipping_status'] == '1'){
												$ordStatus = "SHIPPED";
											}
											elseif($ordersValOut[0]['shipping_status'] == '2'){
												$ordStatus = "OUT FOR DELIVERY";
											}	
											echo $ordStatus;
											?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                        <form action="?order=<?php echo $currOrderId ?>" >
	                                        <label>Change Shipping Status: </label>
                                        	<select name="shipping_status" required>
                                            	<option value="0">Select Status</option>
                                                <option value="1">Shipped</option>
                                                <option value="2">Out For Delivery</option>
                                            </select>
                                            <input type="submit" name="change_status" value="Change Status" class="btn btn-grey btn-smaller">
                                        </form>
                                        </td>
                                    </tr>
								</table>
							</div>
							<div class='sep20'></div>
							<div class='gre-line'></div>
							<div class='sep20'></div>
                            <a class="btn btn-grey btn-small" href="cancel-order.php?order=<?php echo $currOrderId ?>" onClick="return confirm('Are you sure you want to cancel this?')">Cancel Order</a>
							<a class="btn btn-grey btn-small" href="order-detail.php?order=<?php echo $orderNumb ?>">Order Details</a>
                         <?php endforeach; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include_once "include/footer.php"; ?>