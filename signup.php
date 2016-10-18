<?php include_once "include/config.php"; ?>
<?php 
$wrapperClass = "wrapper-flexi signup-page";
include_once "include/header-home.php"; 
//echo '<pre>';print_r($_SESSION);exit;


$errorString = "signup_error";
$successString = "signup_success";

if(!empty($_POST['promo_code'])){
	$_POST['promo_code'] = cleanData($_POST['promo_code']);
	$_SESSION['PRD_PROMO_CODE'] = $_POST['promo_code'];
	//echo '<pre>';print_r($_POST);exit;
}
if(!isset($_SESSION['PRD_PROMO_CODE'])){
	$_SESSION['PRD_PROMO_CODE'] = '';
}

//$user->logoutUser();
if($user->isLoggedIn()){
	if(!empty($_SESSION['PRD_ORDERS']) and is_array($_SESSION['PRD_ORDERS'])):
        $cart = new Cart();
        $orderNumber = $cart->processCartData();
        if(!$orderNumber){
        	$errorMsgString = '';
			foreach($cart->errors as $errorsCart){
				$errorMsgString .= errorsCart."<br>";
			}
        	setFlashMessage("order_error",$errorMsgString);
		}
		else{
			redirectToUrl("order-placed.php");
		}
	endif;
	redirectToUrl("account/order-history.php");
}
if(!empty($_POST['signup_process'])){
	if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['password'])){
		setFlashMessage($errorString,"Please enter all the required fields.");
	}
	else{
		//echo '<pre>';print_r($_POST);exit;
		
		if(!empty($user->errors)){
			$errorMsgString = '';
			foreach($user->errors as $errorsUser){
				$errorMsgString .= $errorsUser."<br>";
			}
			setFlashMessage($errorString,$errorMsgString);
		}
		else{
			$userRegistered = $user->registerUser($_POST['name'],$_POST['email'],$_POST['password'],$_POST['city'],$_POST['phone_number']);
			if(!$userRegistered){
				if(!empty($user->errors)){
					$errorMsgString = '';
					foreach($user->errors as $errorsUser){
						$errorString .= $errorsUser."<br>";
					}
					setFlashMessage($errorString,$errorMsgString);
				}		
			}
			else{
				redirectToUrl("order-placed.php");
			}
		}
	}
}
?>
        <!-- Start Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner intro align-center">
                        <h1>Complete Your <span>Order</span> Now</h1>
                        <h2>Please fill the form below in order to contact you with an accurate cost of your package , You will recieve a full cost , No hidden or extra fees.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="inner">
                        <div class="form-box">
                            <div class="top">
                                <h3>Please complete the following form to complete your order.</h3>
                            </div>
                            <?php 
					        	if(checkFlashMessage($errorString)){
									include_once "include/message-error.php";
								}
								elseif(checkFlashMessage($successString)){
									include_once "include/message-success.php";
								}
					        ?>
                            <div class="bottom">
                                <div id="success">
                                    <span class="green textcenter">
								        <p>Your order was sent successfully!</p>
								    </span>
                                </div>
                                <div id="error">
                                    <span>
								        <p>Something went wrong. Please refresh and try again.</p>
								    </span>
                                </div>
                                <form id="signup" action="" name="signup" method="post" >
                                    <div class="form-group">
                                        <label>
                                            Name *
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <input type="text" name="name" id="name" size="30" value="" required class="text login_input form-control" placeholder="Your name">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Email *
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <input type="text" name="email" id="email" size="30" value="" required class="text login_input form-control" placeholder="Email Address">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            City
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <select name="city" class="form-control">
                                            <option value="Amman">Amman</option>
                                            <option value="Irbed">Irbed</option>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Mobile
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <input type="text" name="phone_number" id="mobile" size="30" class="text login_input form-control" placeholder="Mobile number">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Password
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <input type="password" name="password" id="password" required size="30" class="text login_input form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input id="submit" type="submit" name="signup_process" value="Register" class="btn btn-primary" data-loading-text="Loading...">
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                                <p>
                                	<a href="" data-toggle="modal" data-target="#login-modal"><strong>Already have an account? Click To Login.</strong></a>
                                </p>
                            </div>
                        </div>
                        <div class="shadow"></div>
                        <div class="clearfix"></div>
						<p class="padded align-center below-form">By clicking you agree to our Terms of Service, Privacy Policy & Refund Policy.</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->
        <div class="clearfix"></div>
    </div>
    <?php include_once "include/calculator-model.php" ?>
    <?php include_once "include/login-model.php" ?>
    <?php include_once "include/footer-social.php"; ?>
    <?php include_once "include/footer-scripts.php"; ?>
</body>

</html>
