<?php
/**
 * Controller of Users
 * @author Nadeem <www.webtechapps.com>
 */
class Cart {
    
    public $errors = array();
    protected $database;


    public function __construct() {
        $this->database = new Database();
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
    }
    public function processCartData(){
    	if(!empty($_SESSION['PRD_ORDERS']) and is_array($_SESSION['PRD_ORDERS'])):
    		$date = date("Y-m-d H:i:s");
    		$orderNumber = $_SESSION['log_userId'].rand(1111111,9999999);
    		
    		$query = "INSERT INTO `orders` 
    		(`id`, `order_number`, `user_id`, `quantity`, `url`, `about_product`, `promo_code`, `created_date`) 
    		VALUES";
		
    		foreach($_SESSION['PRD_ORDERS'] as $oKey => $orders ):
    			$orderList = unserialize($orders);
    			$orderList = cleanData($orderList);
    			$query .= " (NULL, '$orderNumber', '".$_SESSION['log_userId']."', '".$orderList['quant']."', '".$orderList['product_url']."', '".$orderList['product_extras']."', '".$_SESSION['PRD_PROMO_CODE']."', '$date'),";
    		endforeach;
    		$query = rtrim($query, ',');
    		unset($_SESSION['PRD_ORDERS']);
    	endif;
    	//echo $query;exit;
    	
		$insert = $this->database->insert($query);
        if(!$insert){
        	if(!empty($this->database->errors)){
            	$this->errors = $this->database->errors;
            	return FALSE;	
			}
            else
            	die("Something went wrong, Please try again later.");
        }
        else{
        	$_SESSION['orderNumber'] = $orderNumber;
        	return $orderNumber;
        }
	}
	
	public function processCartDataEdit($orderNumb){
		$Order = new Orders();
		$Order->cancelOrder($orderNumb);
    	if(!empty($_SESSION['PRD_ORDERS_SELECTED']) and is_array($_SESSION['PRD_ORDERS_SELECTED'])):
    		$date = date("Y-m-d H:i:s");
    		$orderNumber = $_SESSION['log_userId'].rand(1111111,9999999);
    		
    		$query = "INSERT INTO `orders` 
    		(`id`, `order_number`, `user_id`, `quantity`, `url`, `about_product`, `promo_code`, `created_date`) 
    		VALUES";
		
    		foreach($_SESSION['PRD_ORDERS_SELECTED'] as $oKey => $orders ):
    			$orderList = unserialize($orders);
    			$orderList = cleanData($orderList);
    			$query .= " (NULL, '$orderNumber', '".$_SESSION['log_userId']."', '".$orderList['quant']."', '".$orderList['product_url']."', '".$orderList['product_extras']."', '".$_SESSION['PRD_ORDERS_PROMO_CODE']."', '$date'),";
    		endforeach;
    		$query = rtrim($query, ',');
    		unset($_SESSION['PRD_ORDERS_SELECTED']);
    		unset($_SESSION['PRD_ORDERS_PROMO_CODE']);
    	endif;
    	//echo $query;exit;
    	
		$insert = $this->database->insert($query);
        if(!$insert){
        	if(!empty($this->database->errors)){
            	$this->errors = $this->database->errors;
            	return FALSE;	
			}
            else
            	die("Something went wrong, Please try again later.");
        }
        else{
        	$_SESSION['orderNumber'] = $orderNumber;
        	return $orderNumber;
        }
	}
}
