<?php include_once "../include/config.php"; ?>
<?php 
$wrapperClass = "faq-page";
include_once "../include/header.php"; 
//echo '<pre>';print_r($_SESSION);exit;

$errorString = "profile_error";
$successString = "profile_success";

if(!$user->isLoggedIn()){
	redirectToUrl(SITE_URL."signup.php");
}
if(isset($_POST['passchange'])){
	$_POST = cleanData($_POST);
	//echo '<pre>';print_r($_POST);exit;
	if(!empty($_POST['oldpassword']) and !empty($_POST['newpassword']) and !empty($_POST['confrimpassword'])){
		if($_POST['newpassword'] != $_POST['confrimpassword']){
			setFlashMessage($errorString,"Password and confirm password doesn't match.");
		}
		else{
			if($_POST['oldpassword'] == $_POST['newpassword']){
				setFlashMessage($errorString,"You have entered the same old and new password.");
			}
			else{
				$result = $user->changeUserPassword($_POST['oldpassword'],$_POST['newpassword']);
				if($result){
					setFlashMessage($successString,"Your password is changed successfully.");
				}
				else{
					setFlashMessage($errorString,"You have entered wrong old password.");
				}		
			}
		}
		redirectToUrl(SITE_URL."account/profile.php");
	}
	else{
		setFlashMessage($errorString,"Please enter all  the required fields.");
	}
}

$userDetails = $user->getUserDetails($_SESSION['log_userId']);
if(empty($userDetails) or !is_array($userDetails)){
	redirectToUrl(SITE_URL."login.php");
}
//echo '<pre>';print_r($userDetails);exit;


if(!empty($_POST['signup_process'])){
	$_POST = cleanData($_POST);
	if(empty($_POST['name']) or empty($_POST['email'])){
		setFlashMessage($errorString,"Please enter all the required fields.");
	}
	else{	
	
		$userUpdated = $user->updateUser($_POST['name'],$_POST['email'],$_POST['city'],$_POST['phone_number']);
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
			setFlashMessage($successString,"Profile updated successfully.");
			redirectToUrl(SITE_URL."account/profile.php");
		}
	
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
				        		<li><a href="<?php echo SITE_URL ?>account/order-history.php">Your Account</a></li>
				        		<li class="active"><a href="<?php echo SITE_URL ?>account/profile.php">Profile Settings</a>	</li>
				        		<li><a href="<?php echo  SITE_URL.'logout.php' ?>">Log Out</a></li>
							</ul>
				        </div>
				        <div class="col-md-10">
				        	<h3 class="profile-section-head">Edit your information</h3>
				        	<?php 
					        	if(checkFlashMessage($errorString)){
									include_once "../include/message-error.php";
								}
								elseif(checkFlashMessage($successString)){
									include_once "../include/message-success.php";
								}
					        ?>
	                        <div class="inner" id="order-history-wrap">
	                        	<div class="col-md-8 text-left col-md-offset-2">
	                        		<form id="signup" action="" name="signup" method="post" >
	                                    <div class="form-group">
	                                        <label>
	                                            Name *
	                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
	                                        </label>
	                                        <input type="text" name="name" id="name" size="30" value="<?php echo $userDetails['name'] ?>" required class="text login_input form-control" placeholder="Your name">
	                                    </div>
	                                    <div class="form-group">
	                                        <label>
	                                            Email *
	                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
	                                        </label>
	                                        <input type="text" name="email" id="email" size="30" value="<?php echo $userDetails['email'] ?>" required class="text login_input form-control" placeholder="Email Address">
	                                        <div class="clearfix"></div>
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
	                                        <input type="text" name="phone_number" id="mobile" value="<?php echo $userDetails['phone'] ?>" size="30" class="text login_input form-control" placeholder="Mobile number">
	                                    </div>
	                                    <div class="form-group">
	                                        <input id="submit" type="submit" name="signup_process" value="Update" class="btn btn-primary" data-loading-text="Loading...">
	                                        <div class="clearfix"></div>
	                                    </div>
	                                </form>
	                        	</div>
	                        </div>
	                        <h3 class="profile-section-head">Edit your Password</h3>
	                        <div class="inner" id="order-history-wrap">
	                        	<form id="signup" name="" action="" method="post">
	                        		<div class="col-md-8 text-left col-md-offset-2">
	                        		
	                                    <div class="form-group">
	                                        <label>
	                                            Old Password
	                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
	                                        </label>
	                                        <input type="password" name="oldpassword" id="password" required size="30" class="text login_input form-control" placeholder="Old Password" />
	                                    </div>
	                                    <div class="form-group">
	                                        <label>
	                                            New Password
	                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
	                                        </label>
	                                        <input type="password" name="newpassword" id="newpassword" pattern=".{4,}" required size="30" class="text login_input form-control" placeholder="Min 4 Character" />
	                                    </div>
	                                    <div class="form-group">
	                                        <label>
	                                            Confirm Password
	                                            <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
	                                        </label>
	                                        <input type="password" name="confrimpassword" id="confrimpassword" pattern=".{4,}" required size="30" class="text login_input form-control" placeholder="Min 4 Character" />
	                                    </div>
	                                    
	                                    <div class="form-group">
	                                        <input id="submit" type="submit" name="passchange" value="Save" class="btn btn-primary" data-loading-text="Loading...">
	                                        <div class="clearfix"></div>
	                                    </div>
	                        		</div>
	                        	</form>
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
    <script>
    		var password = document.getElementById("newpassword")
		  , confirm_password = document.getElementById("confrimpassword");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
		    confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
    </script>
</body>

</html>
