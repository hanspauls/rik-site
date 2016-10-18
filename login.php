<?php include_once "include/config.php"; ?>
<?php 
$wrapperClass = "wrapper-flexi login-page";
include_once "include/header-home.php"; 
//echo '<pre>';print_r($_SESSION);exit;


$errorString = "login_error";
$successString = "login_success";

//$user->logoutUser();
if($user->isLoggedIn()){
	redirectToUrl("account/order-history.php");
}

if(!empty($_POST['login_process'])){
	if(empty($_POST['email']) or empty($_POST['password'])){
		setFlashMessage($errorString,"Please enter your email and password.");
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
			$userRegistered = $user->loginUser($_POST['email'],$_POST['password']);
			if(!$userRegistered){
				if(!empty($user->errors)){
					$errorMsgString = '';
					foreach($user->errors as $errorsUser){
						$errorMsgString .= $errorsUser."<br>";
					}
					setFlashMessage($errorString,$errorMsgString);
				}		
			}
			else{
				if(!empty($_POST['login_model'])){
					if(!empty($_SESSION['PRD_ORDERS']) and is_array($_SESSION['PRD_ORDERS'])):
				        $cart = new Cart();
				        $orderNumber = $cart->processCartData();
				        if(!$orderNumber){
				        	$errorMsgString = '';
							foreach($cart->errors as $errorsCart){
								$errorMsgString .= errorsCart."<br>";
							}
				        	setFlashMessage("$errorString",$errorMsgString);
						}
						else{
							redirectToUrl("order-placed.php");
						}
					else:
						redirectToUrl("account/order-history.php");
					endif;
				}
				else{
					redirectToUrl("account/order-history.php");	
				}
			}
		}
	}
}
?>
        <!-- Start Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="inner">
                        <div class="form-box">
                            <div class="top">
                                <h3>Login Below</h3>
                                <?php 
						        	if(checkFlashMessage($errorString)){
										include_once "include/message-error.php";
									}
									elseif(checkFlashMessage($successString)){
										include_once "include/message-success.php";
									}
						        ?>
                            </div>
                            
                            <div class="bottom">
                                <form id="Login" action="" name="signup" method="post" >
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
                                            Password
                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                        </label>
                                        <input type="password" name="password" id="password" required size="30" class="text login_input form-control" placeholder="Mobile number">
                                    </div>
                                    <div class="form-group">
                                        <input id="submit" type="submit" name="login_process" value="Login" class="btn btn-primary" data-loading-text="Loading...">
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="shadow"></div>
                        <div class="clearfix"></div>
						<div style="height: 40px;"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->
        <div class="clearfix"></div>
    </div>
    <?php include_once "include/calculator-model.php" ?>
    <?php include_once "include/login-model.php" ?>
    <?php include_once "include/footer.php"; ?>
    <?php include_once "include/footer-social.php"; ?>
    <?php include_once "include/footer-scripts.php"; ?>
</body>

</html>
