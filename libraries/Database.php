<?php

// Is kind of a Wrapper class
class Database{
    
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
 
    // db handler
    private $dbh;
    private $error;
    private $stmt;
    
    
    public function __construct() {
        // Set DSN (Data Source Name)
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        
        // Set options
        $options = array(
            // Create a single Persistent Object, so that we can have multiple interactions with it
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        // Create a new PDO instance
        try{
            $this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
        
    }
    
    
    public function query($query = NULL) {
	$this->stmt = $this->dbh->prepare($query);
    }
	
    
    
    public function bind($param, $value, $type = NULL) {
        
        if(is_null($type)){
            
            switch (true){
                // Binding the place holder (:name) to accept only specific type values
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
            
        }
        $this->stmt->bindValue($param , $value, $type);
        
    }
    
    
    public function execute() {
        return $this->stmt->execute();
    }
    
    // Fetches all the rows, with columns as their property names
    public function resultSet() {
        
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Fetches single row
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
    
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
    
    
    public function beginTransaction() {
        return $this->dbh->beginTransaction();  
    }
    
    
    public function endTransaction() {
        return $this->dbh->commit();
    }
    
    
    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }
    
}
 