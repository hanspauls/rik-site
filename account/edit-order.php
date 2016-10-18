<?php include_once "../include/config.php"; ?>
<?php 
$wrapperClass = "order-page";
include_once "../include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;

$errorString = "order_history_error";
$successString = "order_history_success";

if(!$user->isLoggedIn()){
	redirectToUrl(SITE_URL."signup.php");
}
if(empty($_GET['order'])){
	redirectToUrl(SITE_URL."account/order-history.php");
}

$currOrderId = cleanData($_GET['order']);
$ordersObj = new Orders();
$ordersAll = $ordersObj->getOrderDetails($currOrderId);
if(empty($ordersAll)){
	setFlashMessage("order_history_error","Cannot findthe details about the selected order");
	redirectToUrl(SITE_URL."account/order-history.php");
}

if(!empty($_POST['product_url'])){
	//echo '<pre>';print_r($_POST);exit;
	$_POST = cleanData($_POST);
	$prod_url = $_POST['product_url'];
	$quantity = $_POST['quant'];
	$prod_extra = $_POST['product_extras'];
	
	// Validate url
	if (filter_var($prod_url, FILTER_VALIDATE_URL) === false) {
	     setFlashMessage($errorString,"Link is invalid");
	}
	else{
		if(isset($_POST['edit']) and $_POST['edit'] != '0'){
			if(isset($_POST['edit_id']) and $_POST['edit_id'] != ''){
				$editId = cleanData($_POST['edit_id']);
				$_SESSION['PRD_ORDERS_SELECTED'][$editId] = serialize($_POST);
			}
		}
		else{
			$_SESSION['PRD_ORDERS_SELECTED'][] = serialize($_POST);
		}
		$cartIs = new Cart();
		$orderAdded = $cartIs->processCartDataEdit($currOrderId);
		if($orderAdded)
			setFlashMessage("order_history_success","Your Order is updated successfully.");
		else
			setFlashMessage("order_history_error","Error occured, Please try again later.");
		redirectToUrl(SITE_URL."account/order-history.php");
		
	}
	
}


$_SESSION['PRD_ORDERS_SELECTED'] = array();
foreach($ordersAll as $orderNumb => $ordersValOut): 
	foreach($ordersValOut as $ordersVal):
		$final['product_url'] = $ordersVal['url'];
		$final['quant'] = $ordersVal['quantity'];
		$final['product_id'] = $ordersVal['id'];
		$final['product_extras'] = $ordersVal['about_product'];
		$_SESSION['PRD_ORDERS_PROMO_CODE'] = $ordersVal['promo_code'];
		$_SESSION['PRD_ORDERS_SELECTED'][] = serialize($final);
	endforeach;	
endforeach;
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
				        	<h3 class="profile-section-head">Added items in Order #<?php echo $currOrderId ?></h3>
				        	<?php 
					        	if(checkFlashMessage($errorString)){
									include_once "../include/message-error.php";
								}
								elseif(checkFlashMessage($successString)){
									include_once "../include/message-success.php";
								}
					        ?>
	                        <div class="inner" id="order-history-wrap">
	                        	<div class="orders-made">
	                            	<?php 
	                            	if(!empty($_SESSION['PRD_ORDERS_SELECTED']) and is_array($_SESSION['PRD_ORDERS_SELECTED'])):  
	                            		foreach($_SESSION['PRD_ORDERS_SELECTED'] as $oKey => $orders ):
	                            		$orderList = unserialize($orders);
	                            	?>
		                                <div class="order" id="list_num_<?php echo $oKey?>">
		                                	<input type="hidden" id="list_extra_info_<?php echo $oKey?>" class="list_extra_info" value="<?php echo $orderList['product_extras'] ?>" />
		                                	<input type="hidden" id="list_quant_info_<?php echo $oKey?>" class="list_quant_info" value="<?php echo $orderList['quant'] ?>" />
		                                	<input type="hidden" id="list_url_info_<?php echo $oKey?>" class="list_url_info" value="<?php echo $orderList['product_url'] ?>" />
		                                	<input type="hidden" id="list_prodcut_id_<?php echo $oKey?>" class="list_prodcut_id" value="<?php echo $orderList['product_id'] ?>" />
		                                    <div class="row-sep row">
		                                        <div class="col-md-2 one-col qnt">
		                                            Quantity: <span><?php echo $orderList['quant'] ?></span>
		                                        </div>
		                                        <div class="col-md-8 one-col link-content">
		                                            <a href="<?php echo $orderList['product_url'] ?>" target="_blank"><?php echo $orderList['product_url'] ?></a>
		                                        </div>
		                                        <div class="col-md-2 one-col actions">
		                                            <button class="order-edit"  id="eid-<?php echo $oKey?>">
		                                                <i class="fa fa-pencil" aria-hidden="true"></i>
		                                            </button>
		                                            <button class="order-delete edit-del" id="did-<?php echo $oKey?>">
		                                                <i class="fa fa-close" aria-hidden="true"></i>
		                                            </button>
		                                        </div>
		                                    </div>
		                                </div>
	                                <?php 
	                                	endforeach;
	                                 
	                                else:
	                                	$info = "No links added yet! Add one below.";
	                                	include_once "include/message-info.php";
	                                endif;
	                                ?>
	                            </div>
	                            <div class="form-wrap" style="padding-top: 35px;">
	                            	<h3 class="profile-section-head text-left">Add New Item to your order</h3>
	                                <div class="row row-sep">
	                                    <form id="subscribe" action="signup.php" class="no-validate" name="" method="post" >
	                                        <div class="form-row">
	                                            <div class="input-group">
	                                                <input type="text" name="url" id="subscribe_email" size="20" class="text login_input url_data" placeholder="Paste the link to a product you like (e.g. http://www.amazon.com/gp/product/B00ZB9AX1G)">
	                                                <span class="input-group-btn">
				                                        <button class="btn btn-default btn-add" data-toggle="modal" data-target="#add-modal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
				                                      </span>
	                                            </div>
	                                            <div class="clearfix"></div>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
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
    <?php include_once "../include/order-model-edit.php" ?>
    <?php include_once "../include/footer-scripts.php"; ?>
</body>

</html>
