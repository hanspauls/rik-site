<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; ?>
<?php include_once "check-admin-login.php"; ?>
<?php include_once "include/header.php"; ?>
<?php 
$seletedPage = 'home';
include_once "include/sidebar.php"; 
?>
<?php 

if(!empty($_POST['update'])){
	$_POST = cleanData($_POST);
	if(empty($_POST['name']) or empty($_POST['email'])){
		setFlashMessage('error',"Please enter all the required fields.");
	}
	else{	
	
		$userUpdated = $adminObj->updateAdmin($_POST['name'],$_POST['email'],$_POST['password']);
		if(!$userUpdated){
			if(!empty($user->errors)){
				$errorMsgString = '';
				foreach($user->errors as $errorsUser){
					$errorString .= $errorsUser."<br>";
				}
				setFlashMessage('error',$errorMsgString);
			}		
		}
		else{
			setFlashMessage('success',"Profile updated successfully.");
			redirectToUrl("index.php");
		}
	
	}
}

?>
	<section id='main-content'>
		<header id='main-head-wrap'>
			<div class='bold18 left' id='user-st'>Happy Sunday, <?php echo $_SESSION['log_adminName'] ?></div>
			<div class='right' id='user-nav'>
				<span class='userIco'><img src="images/userIco.png"></span> 
				<span class='userText'><?php echo $_SESSION['log_adminEmail'] ?></span>
			</div>
		</header>
		<div id='content-wrap'>
			<div class='large-content'>
				<div class='content-head'>
					Account settings
				</div>
				<div class='contents'>
					<div class='content-box padding'>
                    	<?php if(checkFlashMessage('error')){ ?>
                                <div style="padding:10px;color:red;">
                                    <?php echo getFlashMessage("error"); ?> 
                                </div>
                        <?php } ?>
                    	<?php if(checkFlashMessage('success')){ ?>
                                <div style="padding:10px;color:green;">
                                    <?php echo getFlashMessage("success"); ?> 
                                </div>
                        <?php } ?>                        
						<form action='' class='full-width' method="post">
							<div class='field'>
								<label>Full name</label>
								<input type='text' name="name" value="<?php echo $_SESSION['log_adminName'] ?>" required placeholder='First Name' value=''>
							</div>
							<div class='field'>
								<label>Email</label>
								<input type='email' name="email" value="<?php echo $_SESSION['log_adminEmail'] ?>" required placeholder='name@example.com' value=''>
							</div>
							<div class='sep15'></div>
							<div class='field'>
								<label>Password</label>
								<input type='password' name="password" class='small-input hide' id='password'>
								<span id='pass-hint'>********* </span>
								<button onclick='showPassField()' type='button' class='btn btn-grey btn-smaller' id='pass-btn'>Change</button>
							</div>	
							<div class='sep25'></div>
							<div class='button-wrap'>
								<input type='submit' value="Save" name="update" class='btn btn-green' />
								<div class='clear'></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include_once "include/footer.php"; ?>
<script type="text/javascript">
	function showPassField()
	{
		$('#password').removeClass('hide');
		$('#pass-hint').addClass('hide');
		$('#pass-btn').addClass('hide');
	}
	function showFileField()
	{
		$('#file').removeClass('hide');
		$('#file-hint').addClass('hide');
		$('#file-btn').addClass('hide');
	}
	</script>