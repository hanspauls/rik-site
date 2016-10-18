<?php
/**
 * Database calss based on Mysqli
 * @author Nadeem <www.webtechapps.com>
 */

class Database {
    
    // db config CONSTANTS are defined in the included config file
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASSWORD;
    private $dbName = DB_NAME;
    
    private $dbConnectHandler;
    public $results;
    public $errors = array();
    
    /*
     * using construct to connect to the database
     * if error found, save the error in the errors array
     */
    public function __construct() {
        $this->dbConnectHandler = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        // Check connection
        if (mysqli_connect_errno()){
            $this->errors[] = mysqli_connect_error();
        }
    }
    public function select($query) {
        $result = mysqli_query($this->dbConnectHandler,$query);
        if(!mysqli_errno($this->dbConnectHandler)){
            $this->results = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $this->results[] = $row;
            }
            mysqli_free_result($result);
            return TRUE;
        }
        else{
            $this->errors[] = mysqli_error($this->dbConnectHandler);
            return FALSE;
        }
    }
    public function insert($query) {
        $result = mysqli_query($this->dbConnectHandler,$query);
        if(!mysqli_errno($this->dbConnectHandler)){
            return mysqli_insert_id($this->dbConnectHandler);
        }
        else{
            $this->errors[] = mysqli_error($this->dbConnectHandler);
            return FALSE;
        }
    }
    public function update($query) {
        $result = mysqli_query($this->dbConnectHandler,$query);
        if(!mysqli_errno($this->dbConnectHandler)){
            if(!mysqli_affected_rows($this->dbConnectHandler)){
                $this->errors[] = "Edit failed, Please try later.";
                return FALSE;
            }
            return TRUE;
        }
        else{
            $this->errors[] = mysqli_error($this->dbConnectHandler);
            return FALSE;
        }
    }
    public function delete($query) {
        $result = mysqli_query($this->dbConnectHandler,$query);
        if(!mysqli_errno($this->dbConnectHandler)){
            return TRUE;
        }
        else{
            $this->errors[] = mysqli_error($this->dbConnectHandler);
            return FALSE;
        }
    }
    /*
     * closing database connection
     */
    function __destruct() {
       mysqli_close($this->dbConnectHandler);
   }

}
