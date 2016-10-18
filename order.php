<?php include_once "include/config.php"; ?>
<?php 
$wrapperClass = "order-page";
include_once "include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;
$errorString = "order_error";
$successString = "order_success";
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
				$_SESSION['PRD_ORDERS'][$editId] = serialize($_POST);
				setFlashMessage($successString,"Link has been updated successfully.");
			}
		}
		else{
			$_SESSION['PRD_ORDERS'][] = serialize($_POST);	
			setFlashMessage($successString,"Link has been added to your cart.");
		}
		unset($_POST);
		
	}
	
}

?>
        <?php 
        	if(checkFlashMessage($errorString)){
				include_once "include/message-error.php";
			}
			elseif(checkFlashMessage($successString)){
				include_once "include/message-success.php";
			}
        ?>
        <!-- Start Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner">
                            <h1>New Order</h1>
                            <div class="orders-made">
                            	<?php 
                            	if(!empty($_SESSION['PRD_ORDERS']) and is_array($_SESSION['PRD_ORDERS'])):  
                            		foreach($_SESSION['PRD_ORDERS'] as $oKey => $orders ):
                            		$orderList = unserialize($orders);
                            	?>
	                                <div class="order" id="list_num_<?php echo $oKey?>">
	                                	<input type="hidden" id="list_extra_info_<?php echo $oKey?>" class="list_extra_info" value="<?php echo $orderList['product_extras'] ?>" />
	                                	<input type="hidden" id="list_quant_info_<?php echo $oKey?>" class="list_quant_info" value="<?php echo $orderList['quant'] ?>" />
	                                	<input type="hidden" id="list_url_info_<?php echo $oKey?>" class="list_url_info" value="<?php echo $orderList['product_url'] ?>" />
	                                    <div class="row">
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
	                                            <button class="order-delete order-onl-del" id="did-<?php echo $oKey?>">
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
                            <div class="row">
                                <hr>
                            </div>
                            <div class="form-wrap">
                                <div class="row">
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
                                        <div class="btn-continue-container">
                                            <div class="promo">
                                                <a href="#">I have promo code</a>
                                                <input id="promo" name="promo_code" type="text" class="form-control">
                                            </div>
                                            <input type="submit" id="submit" name="process_order" value="Submit Order" class="btn-continue" data-loading-text="Loading..." />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /inner -->
                    </div>
                    <!-- /col-12-md -->
                </div>
            </div>
        </div>
        <!-- End content -->
        <div class="clearfix"></div>
    </div>
    <?php include_once "include/calculator-model.php" ?>
    <?php include_once "include/footer.php"; ?>
    <?php include_once "include/footer-social.php"; ?>
    
    <?php include_once "include/order-model.php"; ?>
    
    <?php include_once "include/footer-scripts.php"; ?>
</body>

</html>
