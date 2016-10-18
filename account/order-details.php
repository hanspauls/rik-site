<?php include_once "../include/config.php"; ?>
<?php 
$wrapperClass = "faq-page";
include_once "../include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;
$_SESSION['PRD_PROMO_CODE'] = '';

$errorString = "order_history_error";
$successString = "order_history_success";

if(!$user->isLoggedIn()){
	redirectToUrl(SITE_URL."signup.php");
}
if(empty($_GET['order'])){
	redirectToUrl(SITE_URL."account/order-history.php");
}

$currOrderId = cleanData($_GET['order']);


?>
        <!-- Start Content -->
        <div class="main-content" id="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<?php 
				        	if(checkFlashMessage($errorString)){
								include_once "../include/message-error.php";
							}
							elseif(checkFlashMessage($successString)){
								include_once "../include/message-success.php";
							}
				        ?>
				        <div class="col-md-2">
				        	<h3 class="profile-section-head">Your Account</h3>
				        	<ul class="nav nav-pills nav-stacked">
				        		<li class="active"><a href="<?php echo SITE_URL ?>account/order-history.php">Your Account</a></li>
				        		<li><a href="<?php echo SITE_URL ?>account/profile.php">Profile Settings</a>	</li>
				        		<li><a href="<?php echo  SITE_URL.'logout.php' ?>">Log Out</a></li>
							</ul>
				        </div>
				        <div class="col-md-10">
	                        <div class="inner" id="order-history-wrap">
	                        	
	                        	<?php 
	                        	$ordersObj = new Orders();
	                        	$ordersAll = $ordersObj->getOrderDetails($currOrderId);
	                        	if(!empty($ordersAll)):
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
		                        	
			                        	<div class="col-md-8 col-xs-12 product-details text-left">
			                        		<h3 class="profile-section-head">Details for Order #<?php echo $orderNumb ?></h3>
			                        		<h3 class="profile-section-head">Item Details</h3>
			                        		<?php
												$totalPriceWithoutSalesTx = 0;
												$totalPriceWithSalesTx = 0;
												$totalSalesTax = 0;
				                        		foreach($ordersValOut as $ordersVal):
													$productPriceWithoutSalesTx = (float)$ordersVal['total_price'];
													$productPriceWithSalesTx = (float)$ordersVal['total_price_after_sales_tax'];
													$productSalesTax = (float)$ordersVal['sales_tax'];
													
													$totalPriceWithoutSalesTx += $productPriceWithoutSalesTx;
													$totalPriceWithSalesTx += $productPriceWithSalesTx;
													$totalSalesTax += $productSalesTax;
														
													$orderImage = SITE_URL."images/icons/no-pic.png";
													if(!empty($ordersVal['image_url']))
														$orderImage = $ordersVal['image_url'];
				                        	?>
                        						<div class="col-md-12 col-xs-12 col-no-pad link-list">
                        							<div class="col-md-3 col-xs-1 ord-img">
                        								<img src="<?php echo $orderImage ?>" alt="no-image">
                        							</div>	
                        							<div class="col-md-9 col-xs-10 ord-link">
                        								<a href="<?php echo $ordersVal['url'] ?>" target="_blank"><?php echo $ordersVal['url'] ?></a>
                        								<div class="col-md-12 col-xs-12 col-no-pad">
                        									<div class="col-md-6 col-xs-12 col-no-pad">
                        										<?php if(!empty($ordersVal['store_price'])): ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-no-pad"><strong>Store Price: </strong> <?php echo $ordersVal['store_price'] ?></div>
                        										</div>
                        										<?php endif; ?>
                        										<?php if(!empty($ordersVal['shipping_charge'])): ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-xs-6 col-no-pad"><strong>Shipping Charges: </strong> <?php echo $ordersVal['shipping_charge'] ?></div>
                        										</div>
                        										<?php endif; ?>
                        										<?php if(!empty($ordersVal['clearance_charges'])): ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-xs-6 col-no-pad"><strong>Clearance Charges: </strong><?php echo $ordersVal['clearance_charges'] ?></div>
                        										</div>
                        										<?php endif; ?>
                        									</div>	
                        									<div class="col-md-6 col-xs-12 col-no-pad">
                        										<?php if(!empty($ordersVal['price'])): ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-xs-6 col-no-pad"><strong>Unit Price: </strong> <?php echo $ordersVal['price'] ?></div>
                        										</div>
                        										<?php endif; ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-xs-6 col-no-pad"><strong>Quantity: </strong> <?php echo $ordersVal['quantity'] ?></div>
                        										</div>
                        										<?php if(!empty($ordersVal['total_price'])): ?>
                        										<div class="row-sep">
	                        										<div class="col-md-12 col-xs-6 col-no-pad"><strong>Total Price: </strong> <?php echo $ordersVal['total_price'] ?></div>
                        										</div>
                        										<?php endif; ?>
                        									</div>	
                        								</div>	
                        							</div>
                        						</div>
                        					<?php endforeach; ?>
			                        	</div>
			                        	<div class="col-md-4 col-xs-12 order-summary">
											<h3 class="profile-section-head">Order Summary</h3>
											<div class="row-sep">
		    									<div class="col-md-12 col-xs-12 col-no-pad t-price-val	text-right"><span>Items: </span> <?php echo $totalPriceWithoutSalesTx.' '.$ordersVal['price_unit'] ?></div>
		    									<div class="col-md-12 col-xs-12 col-no-pad t-price-val	text-right"><span>Customs Sales Tax: </span> <?php echo $totalSalesTax.' '.$ordersVal['price_unit'] ?></div>
		    									<div class="col-md-12 col-xs-12 col-no-pad t-price-val	text-right"> <?php echo $totalPriceWithSalesTx.' '.$ordersVal['price_unit'] ?> Total</div>
		    									<div class="col-md-12 col-xs-12 col-no-pad t-price-total text-right"> 
		    										<span class="t-due">Total Due:</span>
		    										<span class="fin-price"><?php echo $totalPriceWithSalesTx.' '.$ordersVal['price_unit'] ?></span>
		    									</div>
											</div>
											<div class="col-md-12 col-xs-12 list-btn-wrap col-no-pad">
												<?php if($ordersValOut[0]['status'] != '3'): // cancelled ?>
													<?php if($ordersValOut[0]['status'] == '1'): ?>
	                        							<a href="<?php echo SITE_URL ?>account/confirm-checkout.php?order=<?php echo $orderNumb ?>" class="checkout-btn"> Complete Checkout</a>
	                        						<?php endif; ?>
	                        						<?php if($ordersValOut[0]['status'] != '2'): // if checkout not confirmed ?>
	                        							<a href="<?php echo SITE_URL ?>account/edit-order.php?order=<?php echo $orderNumb ?>" class="btn-blue"><i class="fa fa-pencil-square-o"></i> Edit Order</a>
	                        						<?php endif; ?>
                        						<?php endif; ?>
                        					</div>
			                        	</div>
			                        	
		                        	<?php 
		                        	endforeach; 
		                        endif; ?>
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
