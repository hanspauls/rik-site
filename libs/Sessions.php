<?php
/**
 * handling sessions
 * @author Nadeem <www.webtechapps.com>
 */
class Sessions {
        
    public static $errors = array();
    public static $userId;


    public function __construct() {
        if(!is_session_started())
            session_start();
    }
    /*
     * set the session variables and store these variables in the database
     */
    public static function registerSession($key, $value, $encrypted=FALSE) {
        if($encrypted)
            $value = encrypt($value);
        
        // register session variable by enrypting
        $_SESSION[$key] = $value;
    }
    public static function registerDbSession($key, $value) {
        $database = new Database();
        $date = date("Y-m-d H:i:s");
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return false;
        }
        // deleting previous session data related to the current user
        $query = "DELETE FROM `sessions` WHERE user_id='".self::$userId."' AND _key='$key' LIMIT 1";
        $database->delete($query);
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return FALSE;
        }
        else{
            // saving the session data in database
            $query = "INSERT INTO `sessions` (`id`, `user_id`, `_key`, `value`, `created_date`, `end_date`, `user_agent`) "
                    . "VALUES (NULL, '".self::$userId."', '$key', '$value', '$date', '', '".cleanData($_SERVER['HTTP_USER_AGENT'])."')";
            $database->insert($query);
            if(!empty($database->errors)){
                self::$errors = $database->errors;
                return FALSE;
            }
            else{
                return TRUE;
            }
        }
    }
    public static function isDbSession($key, $userId) {
        $userId = cleanData($userId);
        $database = new Database();
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return false;
        }
        // deleting previous session data related to the current user
        $query = "SELECT * FROM `sessions` WHERE user_id='$userId' AND _key='$key' LIMIT 1";
        
        $database->select($query);
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return FALSE;
        }
        else{
            return $database->results;
        }
    }
    public static function isSetSession($key) {
        if(isset($_SESSION[$key]))
            return TRUE;
        return FALSE;
    }
    public static function getSession($key, $decrypt = FALSE) {
        if($decrypt)
            return decrypt($_SESSION[$key]);
        return $_SESSION[$key];
    }
    /*
     * functions: unserialize session data before returning
     * @param $key = is the key of the session array
     * @param $keyval = is the key of the value to be returned
     */
    public static function getSessionUnsrliz($key,$keyVal) {
        $unSrlzd = unserialize($_SESSION[$key]);
        return $unSrlzd[$keyVal];
    }
    public static function destroySession($all = true, $key="") {
        if($all){
            session_destroy();
        }
        if($key and isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
        return TRUE;
    }
    public static function destroyDbSession($key) {
        if(empty(self::$userId))
            return FALSE;
        $database = new Database();
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return false;
        }
        // deleting previous session data related to the current user
        $query = "DELETE FROM `sessions` WHERE user_id='".self::$userId."' AND _key='$key'";
        $database->delete($query);
        if(!empty($database->errors)){
            self::$errors = $database->errors;
            return FALSE;
        }
        return TRUE;
    }
    public static function registerCookies($key, $value, $encrypted = FALSE) {
        if($encrypted)
            $value = encrypt($value);
        // register session variable by enrypting
        setcookie($key, $value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    public static function isSetCookies($key) {
        if(isset($_COOKIE[$key]))
            return TRUE;
        return FALSE;
    }
    public static function getCookies($key, $decrypt = FALSE) {
        if($decrypt)
            return decrypt($_COOKIE[$key]);
        return $_COOKIE[$key];
    }
    public static function destroyCookies($key) {
        if(isset($_COOKIE[$key])){
            setcookie("$key", "", time() - 3600,"/");
        }
        return TRUE;
    }
}
