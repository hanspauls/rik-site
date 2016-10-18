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


if(!empty($_POST['confrim_order'])){
	$_POST = cleanData($_POST);
	//echo '<pre>';print_r($_POST);exit;
	if(empty($_POST['name']) or empty($_POST['building_street']) or empty($_POST['apartment']) or empty($_POST['phone_number'])){
		setFlashMessage($errorString,"Please enter all the required fields.");
	}
	else{	
	
		$userUpdated = $user->updateUserShipping($_POST['name'],$_POST['building_street'],$_POST['apartment'],$_POST['city'],$_POST['phone_number']);
		if(!$userUpdated){
			if(!empty($user->errors)){
				$errorMsgString = '';
				foreach($user->errors as $errorsUser){
					$errorString .= $errorsUser."<br>";
				}
				setFlashMessage($errorString,$errorMsgString);
			}		
		}
		else{
			$orderObj = new Orders();
			$confirmOrder = $orderObj->confirmOrder($currOrderId);
			setFlashMessage("order_history_success","Your Order is Confirmed successfully. Your Products will be shipped soon.");
			redirectToUrl(SITE_URL."account/order-history.php");
		}
	
	}
}

$userDetails = $user->getUserDetails($_SESSION['log_userId']);
if(empty($userDetails) or !is_array($userDetails)){
	redirectToUrl(SITE_URL."login.php");
}

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
			                        		<h3 class="profile-section-head">Complete Order #<?php echo $orderNumb ?></h3>
			                        		<h3 class="profile-section-head">Shipping Details</h3>
			                        		<div class="col-md-12 text-left">
				                        		<form id="signup" action="?order=<?php echo $currOrderId;?>" name="signup" method="post" >
				                                    <div class="form-group">
				                                        <label>
				                                            Full Name *
				                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
				                                        </label>
				                                        <input type="text" name="name" id="name" size="30" value="<?php echo $userDetails['name'] ?>" required class="text login_input form-control" placeholder="Your name">
				                                    </div>
				                                    <div class="form-group">
				                                        <label>
				                                            Building or Street Name *
				                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
				                                        </label>
				                                        <input type="text" name="building_street" id="building_street" size="30" value="<?php echo $userDetails['shipp_street'] ?>" required class="text login_input form-control" placeholder="Building or Street Name">
				                                    </div>
				                                    <div class="form-group">
				                                        <label>
				                                            Apartment or Floor Number *
				                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
				                                        </label>
				                                        <input type="text" name="apartment" id="apartment" size="30" value="<?php echo $userDetails['shipp_appartment'] ?>" required class="text login_input form-control" placeholder="Apartment or House or Floor Number">
				                                    </div>
				                                    <div class="form-group">
				                                        <label>
				                                            City
				                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
				                                        </label>
				                                        <select name="city" class="form-control">
				                                            <option <?php if($userDetails['city'] == 'Amman')echo "selected)" ?> value="Amman">Amman</option>
				                                            <option <?php if($userDetails['city'] == 'Irbed')echo "selected)" ?> value="Irbed">Irbed</option>
				                                        </select>
				                                        <div class="clearfix"></div>
				                                    </div>
				                                    <div class="form-group">
				                                        <label>
				                                            Mobile
				                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
				                                        </label>
				                                        <input type="text" required name="phone_number" id="mobile" value="<?php echo $userDetails['phone'] ?>" size="30" class="text login_input form-control" placeholder="Mobile number">
				                                    </div>
				                                    <div class="form-group">
				                                        <input id="submit" type="submit" name="confrim_order" value="Confirm Order" class="btn btn-primary" data-loading-text="Loading...">
				                                        <div class="clearfix"></div>
				                                    </div>
				                                </form>
				                        	</div>
			                        	</div>
			                        	<div class="col-md-4 col-xs-12 order-summary">
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
												endforeach;
				                        	?>
			                        		<?php $ordersVal = $ordersValOut[0]; ?>
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
