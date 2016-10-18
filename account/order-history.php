<?php include_once "../include/config.php"; ?>
<?php 
$wrapperClass = "faq-page";
include_once "../include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;

$errorString = "order_history_error";
$successString = "order_history_success";

if(!$user->isLoggedIn()){
	redirectToUrl(SITE_URL."signup.php");
}
if(!empty($_GET['order']) and isset($_GET['action'])){
	if($_GET['action'] == 'cancel'){
		$currOrderId = cleanData($_GET['order']);
		
		$orderObj = new Orders();
		$result = $orderObj->cancelOrder($currOrderId);
		if($result){
			setFlashMessage($successString,"Your Order has deleted.");
		}
		else{
			setFlashMessage($errorString,"Your Order cannot be deleted. Please try later.");
		}
		redirectToUrl(SITE_URL."account/order-history.php");
	}
}
?>
        <!-- Start Content -->
        <div class="main-content" id="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
				        <div class="col-md-2">
				        	<h3 class="profile-section-head">Your Account</h3>
				        	<ul class="nav nav-pills nav-stacked">
				        		<li class="active"><a href="<?php echo SITE_URL ?>account/order-history.php">Your Account</a></li>
				        		<li><a href="<?php echo SITE_URL ?>account/profile.php">Profile Settings</a>	</li>
				        		<li><a href="<?php echo  SITE_URL.'logout.php' ?>">Log Out</a></li>
							</ul>
				        </div>
				        <div class="col-md-10">
				        	<h3 class="profile-section-head">Orders History</h3>
				        	<?php 
					        	if(checkFlashMessage($errorString)){
									include_once "../include/message-error.php";
								}
								elseif(checkFlashMessage($successString)){
									include_once "../include/message-success.php";
								}
					        ?>
	                        <div class="inner" id="order-history-wrap">
	                        	<?php 
	                        	$ordersObj = new Orders();
	                        	$ordersAll = $ordersObj->getOrdersHistory();
	                        	if(!empty($ordersAll)):
	                        	?>
		                        	<ul class="orders-list-ul">
		                        	<?php 
		                        	foreach($ordersAll as $orderNumb => $ordersValOut): 
		                        	if($ordersValOut[0]['status'] == '0'){
										$ordStatus = "PENDING REVIEW";
										$ordClass = "pending";
									}
									elseif($ordersValOut[0]['status'] == '1'){
										$ordStatus = "PENDING CHECKOUT";
										$ordClass = "";
									}
									elseif($ordersValOut[0]['status'] == '2'){
										$ordStatus = "CONFIRMED";
										if($ordersValOut[0]['shipping_status'] == '1'){
											$ordStatus .= " & SHIPPED";
										}
										elseif($ordersValOut[0]['shipping_status'] == '0'){
											$ordStatus .= " BUT NOT SHIPPED";
										}
										elseif($ordersValOut[0]['shipping_status'] == '2'){
											$ordStatus = "OUT FOR DELIVERY";
										}						
										$ordClass = "confirmed";
									}
									elseif($ordersValOut[0]['status'] == '3'){
										$ordStatus = "CANCELLED";					
										$ordClass = "cancelled";
									}
		                        		
		                        	?>
		                        		<li class="col-md-12">
		                        			<div class="order-contain">
		                        				<div class="col-md-2 col-xs-12 col-no-pad list-left">
		                        					<div class="col-md-12 col-xs-6 ord-num <?php echo $ordClass ?>">
		                        						<strong>#<?php echo $orderNumb ?></strong><br>
		                        						<span><?php echo $ordStatus ?></span>
		                        					</div>
		                        					<div class="col-md-12 col-xs-6 ord-date">
		                        						<strong class="day-month"><?php echo date("d M",strtotime($ordersValOut[0]['created_date'])) ?></strong><br>
		                        						<span class="year"><?php echo date("Y",strtotime($ordersValOut[0]['created_date'])) ?></span>
		                        					</div>
		                        				</div>
		                        				<div class="col-md-10 col-xs-12 list-right col-no-pad">
		                        					<div class="col-md-10 col-xs-12 col-no-pad">
						                        	<?php
						                        		foreach($ordersValOut as $ordersVal):
						                        		$orderImage = SITE_URL."images/icons/no-pic.png";
						                        		if(!empty($ordersVal['image_url']))
						                        			$orderImage = $ordersVal['image_url'];
						                        	?>
		                        						<div class="col-md-6 col-xs-12 col-no-pad link-list">
		                        							<div class="col-md-2 col-xs-1 col-no-pad ord-img">
		                        								<img src="<?php echo $orderImage ?>" alt="no-image">
		                        							</div>	
		                        							<div class="col-md-10 col-xs-10 ord-link">
		                        								<a href="<?php echo $ordersVal['url'] ?>" target="_blank"><?php echo $ordersVal['url'] ?></a>
		                        							</div>
		                        						</div>
		                        					<?php endforeach; ?>
		                        					</div>
		                        					<div class="col-md-2 col-xs-12 list-btn-wrap col-no-pad">
		                        						<?php if($ordClass == ''): ?>
		                        							<a href="<?php echo SITE_URL ?>account/confirm-checkout.php?order=<?php echo $orderNumb ?>" class="checkout-btn"> Confirm Checkout</a>
		                        						<?php endif; ?>
		                        						<a href="<?php echo SITE_URL ?>account/order-details.php?order=<?php echo $orderNumb ?>"><i class="fa fa-list-alt"></i> Order Details</a>
		                        						<?php if($ordersValOut[0]['status'] != '2'): ?>
		                        						<a href="<?php echo SITE_URL ?>account/edit-order.php?order=<?php echo $orderNumb ?>"><i class="fa fa-pencil-square-o"></i> Edit Order</a>
		                        						<a href="<?php echo SITE_URL ?>account/order-history.php?order=<?php echo $orderNumb ?>&action=cancel" onclick="return confirm('Are you sure you want to deleted this?')"><i class="fa fa-times-circle"></i> Cancel</a>
		                        						<?php endif; ?>
		                        					</div>
		                        				</div>
		                        			</div>
		                        		</li>
		                        	<?php 
		                        	endforeach; 
		                        	?>
		                        	</ul>
								<?php endif; ?>
	                        </div>
	                        <!-- /inner -->
				        	
				        </div>
                    </div>
                    <!-- /col-12-md -->
                </div>
            </div>
        </div>
        <!-- End content -->
        <div class="clearfix"></div>
    </div>
    
    <?php include_once "../include/calculator-model.php" ?>
    <?php include_once "../include/footer.php" ?>
    <?php include_once "../include/footer-social.php"; ?>
    <?php include_once "../include/order-model.php" ?>
    <?php include_once "../include/footer-scripts.php"; ?>
</body>

</html>
