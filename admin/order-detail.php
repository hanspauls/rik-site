<?php include_once "../include/config.php"; ?>
<?php include_once "include/admin-config.php"; ?>
<?php include_once "check-admin-login.php"; ?>
<?php include_once "include/header.php"; ?>
<?php 
$seletedPage = 'new-orders';
include_once "include/sidebar.php"; 

if(empty($_GET['order'])){
	redirectToUrl("new-orders.php");
}
$currOrderId = cleanData($_GET['order']);

$ordersAll = $adminObj->getOrderDetails($currOrderId);
//print_r($ordersAll);
if(empty($ordersAll)){
	setFlashMessage('error',"Order cannot be retrieved.");
	redirectToUrl("new-orders.php");
}
if(isset($_POST['save_confirm']) or isset($_POST['save_only'])){
	//echo '<pre>';print_r($_POST);exit;
	$status = 0;	
	if(isset($_POST['save_confirm'])){
		$status = 1;
	}
	foreach($_POST['image_url'] as $linkId => $postimages){
		$imageUrl = $postimages;
		$store_price = $_POST['store_price'][$linkId];
		$price = $_POST['price'][$linkId];
		$price_unit = $_POST['price_unit'][$linkId];
		$shipping_charge = $_POST['shipping_charge'][$linkId];
		$clearance_charges = $_POST['clearance_charges'][$linkId];
		$total_price = $_POST['total_price'][$linkId];
		$sales_tax = $_POST['sales_tax'][$linkId];
		$total_price_after_sales_tax = $_POST['total_price_after_sales_tax'][$linkId];
		
		$update = $adminObj->updateOrderDetails($linkId, $imageUrl, $store_price, $price, $price_unit, $shipping_charge, $clearance_charges, $total_price, $sales_tax, $total_price_after_sales_tax, $status);
	}
	if($update){
		if($status == 0)
			setFlashMessage('success',"Order has been saved successfully.");
		else
			setFlashMessage('success',"Order has been confirmed successfully.");
		redirectToUrl("new-orders.php");
	}
}
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
				<div class='content-head center'>
					Product Details
				</div>
				<div class='contents'>
					<div class='content-box padding'>
						<form action='?order=<?php echo $currOrderId ?>' class='full-width card-form' method="post">
                        	<?php foreach($ordersAll as $orderNumb => $ordersValOut): ?>
							<div class='field'>
								<table width='100%'>
									<tr>
										<td ><label>Order Number: </label>
                                        	<?php echo $orderNumb ?>
                                        </td>
									</tr>    
                                    <tr>
                                        <td ><label>Promo Code: </label>
                                        	<?php echo $ordersValOut[0]['promo_code']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer Name: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['name'] ?>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td ><label>Customer Email: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['email'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer Phone: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['phone'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label>Customer City: </label>
                                        	<?php echo $ordersValOut[0]['user_details']['city'] ?>
                                        </td>
                                    </tr>
								</table>
							</div>
                            <h1>Order Links Details</h1>
							<div class='sep20'></div>
							<div class='gre-line'></div>
							<div class='sep20'></div>
                            <?php
								$i = 1;
								foreach($ordersValOut as $ordersVal):
							?>
							<div class='field'>
                            	<h2 style="padding-bottom:10px;">Link no. <?php echo $i++?></h2>
								<table width='100%'>
                                    <tr>
                                        <td ><label>Product Link: </label>
                                        	<a style="word-break:break-all" href="<?php echo $ordersVal['url']; ?>" target="_blank"><?php echo substr($ordersVal['url'],0,30); ?>...</a>
                                        </td>
                                    </tr>   
                                    <tr>
                                        <td ><label>Quantity: </label>
                                        	<?php echo count($ordersValOut) ?>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td ><label>Product Details: </label>
                                        	<?php echo $ordersVal['about_product']; ?>
                                        </td>
                                    </tr>
									<tr>
										<td width=''><label>Product image</label> 
                                        	<?php if($ordersVal['image_url'] != ''): ?>
                                            	<a href="<?php echo $ordersVal['image_url'] ?>" target="_blank">
	                                                <img src="<?php echo $ordersVal['image_url'] ?>" width="50px" height="auto">
                                                </a>
                                            <?php endif; ?>
                     					</td>
									</tr>
                                    <tr>
										<td ><label>Store Price</label>
											<?php echo $ordersVal['store_price'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Unit Price</label>
											<?php echo $ordersVal['price'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Currency Unit</label>
											<?php echo $ordersVal['price_unit'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Shipping Charges</label>
											<?php echo $ordersVal['shipping_charge'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Clearance Charges</label>
											<?php echo $ordersVal['clearance_charges'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Total Price witout Sales Tax</label>
											<?php echo $ordersVal['total_price'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Sales Tax</label>
											<?php echo $ordersVal['sales_tax'] ?>
										</td>
									</tr>
                                    <tr>
										<td ><label>Total Price with Sales Tax</label>
											<?php echo $ordersVal['total_price_after_sales_tax'] ?>
										</td>
									</tr>
								</table>
							</div>
							<div class='sep20'></div>
							<div class='gre-line'></div>
							<div class='sep20'></div>
                            <?php 
							endforeach;
							?>
                         <?php endforeach; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include_once "include/footer.php"; ?>