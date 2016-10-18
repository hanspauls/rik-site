<?php include_once "include/config.php"; ?>
<?php 
$wrapperClass = "faq-page";
include_once "include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;
$_SESSION['PRD_PROMO_CODE'] = '';
$errorString = "order_error";
$successString = "order_success";

if(!$user->isLoggedIn()){
	redirectToUrl("signup.php");
}
elseif(!isset($_SESSION['orderNumber'])){
	redirectToUrl("account/order-history.php");
}

?>
        <!-- Start Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<?php 
				        	if(checkFlashMessage($errorString)){
								include_once "include/message-error.php";
							}
							elseif(checkFlashMessage($successString)){
								include_once "include/message-success.php";
							}
				        ?>
                        <div class="inner">
                            <h1 class="text-center">Thank You!</h1>
                            <div class="row">
                                <div class="col-md-12">
                                   <h2 class="text-center" style="padding-top: 30px"><strong>Your order #<?php echo $_SESSION['orderNumber']; ?> has been placed and will be reviewed shortly!<br>
                                   A quote with the total price will be sent to your email address.</strong></h2>
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
    <?php include_once "include/footer.php" ?>
    <?php include_once "include/footer-social.php"; ?>
    <?php include_once "include/order-model.php" ?>
    <?php include_once "include/footer-scripts.php"; ?>
</body>

</html>
