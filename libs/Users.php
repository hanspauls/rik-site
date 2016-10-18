<?php
/**
 * Controller of Users
 * @author Nadeem <www.webtechapps.com>
 */
class Users {
    
    public $userId, $name, $email;
    public $errors = array();
    protected $database;


    public function __construct() {
        $this->database = new Database();
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
    }
    public function registerUser($name, $email, $password, $city, $phone){
    	$date = date("Y-m-d H:i:s");
    	$password = md5($password);
		$query = "INSERT INTO `users` (`id`, `name`, `email`, `city`, `phone`, `password`, `created_date`) 
		VALUES (NULL, '$name', '$email', '$city', '$phone', '$password', '$date')";
		
		$insert = $this->database->insert($query);
        if(!$insert){
        	if(!empty($this->database->errors))
            	$this->errors = $this->database->errors;
            else
            	die("Something went wrong, Please try again later.");
        }
        else{
        	$this->userId = $insert;
        	$this->email = $email;
        	$this->name = $name;
            $this->setUserSession();
            
            // process cart data if not empty
            if(!empty($_SESSION['PRD_ORDERS']) and is_array($_SESSION['PRD_ORDERS'])):
	            $cart = new Cart();
	            $orderNumber = $cart->processCartData();
	            if(!$orderNumber){
	            	$this->errors = $cart->errors;
					return FALSE;
				}
			endif;
			return TRUE;
        }
	}
	public function updateUser($name, $email, $city, $phone){
    	
		$query = "UPDATE `users` SET name='$name',email='$email',city='$city',phone='$phone' WHERE id='".$_SESSION['log_userId']."' LIMIT 1";
		
		$insert = $this->database->update($query);
    
    	$_SESSION['log_email'] = $name;
    	$_SESSION['log_name'] = $email;
		return TRUE;    
	}
	public function updateUserShipping($name, $building_street, $apartment, $city, $phone){
    	
		$query = "UPDATE `users` SET name='$name',shipp_street='$building_street',shipp_appartment='$apartment',city='$city',phone='$phone' WHERE id='".$_SESSION['log_userId']."' LIMIT 1";
		
		$insert = $this->database->update($query);
    
    	$_SESSION['log_email'] = $name;
		return TRUE;    
	}
    public function changeUserPassword($oldPass, $newPass){
        $oldPass = md5($oldPass);
        $query = "SELECT * FROM `users` WHERE password='$oldPass' and id='".$_SESSION['log_userId']."' LIMIT 1";
        $this->database->select($query);
        if(!empty($this->database->errors)){
            $this->errors = $this->database->errors;
        }
        else{
            if(!empty($this->database->results)){
                $newPass = md5($newPass);
                $query = "UPDATE `users` SET password='$newPass' WHERE id='".$_SESSION['log_userId']."' LIMIT 1";
        		return $this->database->update($query);
            }
            else{
                $this->errors[] = "Incorrect Old Password";
                return FALSE;
            }
        }
    }
    public function getUserDetails($userId){
		$userId = cleanData($userId);
        $query = "SELECT * FROM `users` WHERE id='$userId' LIMIT 1";
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
    public function isLoggedIn(){
        if(!empty($_SESSION['log_userId']) and !empty($_SESSION['log_email']) and !empty($_SESSION['log_name'])){
            return TRUE;
        }
        return FALSE;
    }
    public function loginUser($email, $password) {
        $email = cleanData($email);
        $password = md5(cleanData($password));
        
        $query = "SELECT * FROM `users` WHERE email='$email' and password='". $password."' LIMIT 1";
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
                
                return $this->setUserSession();
            }
            else{
                $this->errors[] = "Incorrect Email or Password";
                return FALSE;
            }
        }
    }
    private function setUserSession() {
    	$_SESSION['log_userId'] = $this->userId;
    	$_SESSION['log_email'] = $this->email;
    	$_SESSION['log_name'] = $this->name;
        return TRUE;
    }
    public function logoutUser() {
    	unset($_SESSION['log_userId']);
    	unset($_SESSION['log_email']);
    	unset($_SESSION['log_name']);
        return TRUE;
    }
}
