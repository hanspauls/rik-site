<?php
/**
 * Controller of Users
 * @author Nadeem <www.webtechapps.com>
 */
class Orders {
    
    public $errors = array();
    protected $database;


    public function __construct() {
        $this->database = new Database();
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
    }
    public function getOrdersHistory($status = '-1'){
    	
        $sql = '';
        if($status != '-1'){
			$sql .= "AND status='$status'";
		}
        
        $query = "SELECT * FROM `orders` WHERE user_id = '".$_SESSION['log_userId']."' $sql ORDER BY id DESC ";
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
		$query = "SELECT * FROM `orders` WHERE order_number='$orderNumber' AND user_id = '".$_SESSION['log_userId']."' ";
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
	
	public function cancelOrder($orderNumb){
		$query = "SELECT * FROM `orders` WHERE order_number='$orderNumb' AND user_id = '".$_SESSION['log_userId']."' AND (status='0' OR status='1') ";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                $query = "UPDATE `orders` SET status='3' WHERE order_number='$orderNumb' AND user_id = '".$_SESSION['log_userId']."'";
            	return $this->database->update($query); 
            }
            else{
                return FALSE;
            }
        }
	}
	
	public function confirmOrder($orderNumb){
		$query = "UPDATE `orders` SET status='2' WHERE order_number='$orderNumb' AND user_id = '".$_SESSION['log_userId']."'";
        $this->database->update($query);
        return TRUE;
	}
	
	public function deleteOrderById($orderId){
		$query = "SELECT * FROM `orders` WHERE id='$orderId' AND user_id = '".$_SESSION['log_userId']."' LIMIT 1 ";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                $query = "DELETE FROM `orders` WHERE id='$orderId' AND user_id = '".$_SESSION['log_userId']."' LIMIT 1";
            	$this->database->delete($query); 
            	return TRUE;
            }
            else{
                return FALSE;
            }
        }
	}
}
