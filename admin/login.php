<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; 
$isadminLoggedIn = $adminObj->checkAdminLogin();
if($isadminLoggedIn){
	redirectToUrl("index.php");	
}

if(!empty($_POST['login'])){
	if(empty($_POST['email']) or empty($_POST['password'])){
		setFlashMessage("error","Please enter your email and password.");
	}
	else{
		//echo '<pre>';print_r($_POST);exit;		
		$adminLogin = $adminObj->loginAdmin($_POST['email'],$_POST['password']);
		if(!$adminLogin){
			if(!empty($user->errors)){
				$errorMsgString = '';
				foreach($user->errors as $errorsUser){
					$errorMsgString .= $errorsUser."<br>";
				}
				setFlashMessage("error",$errorMsgString);
			}
			else{
				setFlashMessage("error","Incorrect email or password.");
			}
		}
		else{
			redirectToUrl("index.php");	
		}
	
	}
}
?>
<html>
<head>
	<title>Begeeb</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<section id='signup-content'>
		<div class='signup-wrap'>
			<div class='signup-head center extra-height'>
				Welcome back to Begeeb
			</div>
			<div class='contents no-padding'>
            	<?php if(checkFlashMessage('error')){ ?>
						<div style="padding:10px;color:red;">
                        	<?php echo getFlashMessage("error"); ?> 
                        </div>
				<?php } ?>
				<form class='full-width signup-form' action="" method="post">
					<div class='content-box no-border content-padding' id='help-wrap'>
						<div class='field'>
							<label>Email</label>
							<input type='email' name="email" required placeholder=''>
						</div>
						<div class='field' style='padding-bottom:8px !important'>
							<label>Password</label>
							<input type='password' name="password" required placeholder=''>
						</div>
						<div class='field center-480'>
							<label class='hide-480'>&ensp;</label>
							<input type='submit' name="login" class='btn btn-green' value='Login' >
						</div>
						<!-- 
						<div class='field'>
							<span class='right font14'><a href="">Forgot Password?</a></span>
							<div class='clear'></div>
						</div>
						-->
					</div>
				</form>
			</div>
		</div>
	</section>
	<footer></footer>
</body>
</html>