<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; ?>
<?php include_once "check-admin-login.php"; ?>
<?php include_once "include/header.php"; ?>
<?php 
$seletedPage = 'new-orders';
include_once "include/sidebar.php"; 

$ordersAll = $adminObj->getOrders(0);
//print_r($ordersAll);
?>

	<section id='main-content'>
		<header id='main-head-wrap'>
			<div class='bold18 left' id='user-st'>Happy Sunday, <?php echo $_SESSION['log_adminName'] ?>!</div>
			<div class='right' id='user-nav'>
				<span class='userIco'><img src="images/userIco.png"></span> 
				<span class='userText'><?php echo $_SESSION['log_adminEmail'] ?></span>
			</div>
		</header>
		<div id='content-wrap'>
			<div class='large-content'>
				<div class='content-head'>
					New Orders
				</div>
				<div class='contents'>
					<div class='sep15'></div>
					<div class='content-box'>
						<div class='questions-list'>
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
	                        <?php if(!empty($ordersAll)): ?>
							<table width='100%' cellpadding='0' cellspacing='0' class='question-table'>
                            	<?php $i=1; 
								foreach($ordersAll as $orderNumb => $ordersValOut):  ?>
								<tr>
									<td class='col1'><span class='m-number'><?php echo $i++; ?></span></td>
									<td class='col2'>
                                    	<span class='m-text'>
                                            <strong>Order #</strong><?php echo $orderNumb ?> &ensp; &ensp; &ensp; 
                                            <strong>Links Added:</strong> <?php echo count($ordersValOut) ?>  &ensp; &ensp; &ensp; 
                                            <strong>Added Date:</strong> <?php echo date("Y/m/d H:i",strtotime($ordersValOut[0]['created_date'])) ?> 
                                        </span>
                                    </td>
									<td class='col3'>
										<div class='right'>
                                        <a href="confirm-order.php?order=<?php echo $orderNumb ?>" onclick="document.location.href='confirm-order.php?order=<?php echo $orderNumb ?>';" title="Add Price & Confirm" class="option-edit"> &ensp; </a> 
                                        <a href="cancel-order.php?order=<?php echo $orderNumb ?>" class='option-delete' onClick="return confirm('Are you sure you want to cancel this order?')" title="Cancel Order">&ensp;</a>
                                        </div>
									</td>
								</tr>
                                <?php endforeach; ?>
							</table>
                            <?php else: ?>
                            	<h3>No Order Found.</h3>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include_once "include/footer.php"; ?>