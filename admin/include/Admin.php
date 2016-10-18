<?php
/**
 * Controller of Users
 * @author Nadeem <www.webtechapps.com>
 */
class Admin {
    
    public $userId, $name, $email;
    public $errors = array();
    protected $database;


    public function __construct() {
        $this->database = new Database();
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
    }
	
	public function getOrders($status = '-1'){
    	
        $sql = '';
        if($status != '-1'){
			$sql .= "WHERE status='$status'";
		}
		
		// if status is confirmed, then dont show sipped or out for deliver orders
		if($status == '2'){
			$sql .= " AND shipping_status='0'";
		}
        
        $query = "SELECT * FROM `orders` $sql ORDER BY id DESC ";
		
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){ 
            	$final = array();
            	foreach($this->database->results as $orders){
					$final[$orders['order_number']][] = $orders;
				}            
				//print_r($final);exit;  
                return $final;
            }
            else{
                return array();
            }
        }
	}
	public function getShippedOrders($status = '1'){
    	
        $sql = " shipping_status='1' ";
        if($status != '1'){
			$sql = " shipping_status='$status'";
		}
        
        $query = "SELECT * FROM `orders` WHERE $sql ORDER BY id DESC ";
		
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){ 
            	$final = array();
            	foreach($this->database->results as $orders){
					$final[$orders['order_number']][] = $orders;
				}            
				//print_r($final);exit;  
                return $final;
            }
            else{
                return array();
            }
        }
	}
	public function getOrderDetails($orderNumber){
		$query = "SELECT * FROM `orders` WHERE order_number='$orderNumber'";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                $final = array();
            	foreach($this->database->results as $orders){
					if(empty($userDetails)){
						$user = new Users();
						$userDetails = $user->getUserDetails($orders['user_id']);
						$orders['user_details'] = $userDetails;
					}					
					$final[$orders['order_number']][] = $orders;
				}            
				//print_r($final);exit;  
                return $final;
            }
            else{
                return array();
            }
        }
	}
	public function updateOrderDetails($linkId, $image_url, $store_price, $price, $price_unit, $shipping_charge, $clearance_charges, $total_price, $sales_tax, $total_price_after_sales_tax, $status){
		if(empty($price_unit)){
			$price_unit = 'EGP';
		}
		$query = "UPDATE `orders` SET 
			image_url='$image_url',  
			store_price='$store_price',  
			price='$price',  
			price_unit='$price_unit',  
			shipping_charge='$shipping_charge',  
			clearance_charges='$clearance_charges',  
			total_price='$total_price',  
			sales_tax='$sales_tax',  
			total_price_after_sales_tax='$total_price_after_sales_tax',  
			status='$status' 
			WHERE id='$linkId' LIMIT 1";
        return $this->database->update($query);
	}
	public function updateOrderStatus($orderId, $status){

		$query = "UPDATE `orders` SET 
			shipping_status='$status'  
			WHERE order_number='$orderId'";

        return $this->database->update($query);
	}

	public function cancelOrder($orderNumb){
		$query = "SELECT * FROM `orders` WHERE order_number='$orderNumb' ";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                $query = "UPDATE `orders` SET status='3' WHERE order_number='$orderNumb'";
            	return $this->database->update($query); 
            }
            else{
                return FALSE;
            }
        }
	}
	public function updateAdmin($name, $email, $password){
		$sql ='';
		if(!empty($password)){
    		$password = md5($password);
			$sql = ",password='$password'";
		}
		$query = "UPDATE `admin` SET name='$name',email='$email' $sql WHERE id='".$_SESSION['log_adminId']."' LIMIT 1";
		
		$insert = $this->database->update($query);
    
    	$_SESSION['log_adminName'] = $name;
    	$_SESSION['log_adminEmail'] = $email;
		return TRUE;    
	}
	
    public function getAdminDetails($userId){
		$userId = cleanData($userId);
        $query = "SELECT * FROM `admin` WHERE id='$userId' LIMIT 1";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                return $this->database->results[0];
            }
            else{
                $this->errors[] = "User Not Found.";
                return FALSE;
            }
        }
	}
    public function checkAdminLogin(){
        if(!empty($_SESSION['log_adminId']) and !empty($_SESSION['log_adminEmail']) and !empty($_SESSION['log_adminName'])){
            return TRUE;
        }
        return FALSE;
    }
    public function loginAdmin($email, $password) {
        $email = cleanData($email);
        $password = md5(cleanData($password));
        
        $query = "SELECT * FROM `admin` WHERE email='$email' and password='". $password."' LIMIT 1";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                /*print_r($_SESSION);
                print_r($this->database->results);exit;*/
                $this->email = $email;
                $this->userId = $this->database->results[0]['id'];
                $this->name = $this->database->results[0]['name'];
                
                return $this->setAdimSession();
            }
            else{
                $this->errors[] = "Incorrect Email or Password";
                return FALSE;
            }
        }
    }
    private function setAdimSession() {
    	$_SESSION['log_adminId'] = $this->userId;
    	$_SESSION['log_adminEmail'] = $this->email;
    	$_SESSION['log_adminName'] = $this->name;
        return TRUE;
    }
    public function logoutAdmin() {
    	unset($_SESSION['log_adminId']);
    	unset($_SESSION['log_adminEmail']);
    	unset($_SESSION['log_adminName']);
        return TRUE;
    }
}
