<?php

class nullQuery extends Exception {
    
}

class connectionFailed extends Exception {
    
}

/**
 * Description of DBMy
 *
 * @author Ismael Moral
 */
class DBMy {

    /**
     * @var String DB host. 
     */
    private $host;
    
    /**
     * @var String DB user.
     */
    private $user;
    
    /**
     * @var String DB's user password. 
     */
    private $pass;
    
    /**
     * @var String DB name. 
     */
    private $dbName;
    
    /**
     * @var Mysqli manage the connection with mysql server. 
     */
    private $mysqli;

    /**
     * @var Rows it contains the result of a query. 
     */
    private $res;

    /**
     * Class constructor. 
     * 
     * @throws connectionFailed
     */
    public function __construct($host = "localhost", $user="root", $pass="780026", $db="SocialMonitor") {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbName = $db;
        
        $this->mysqli = new mysqli($host, $user, $pass, $db);

        if (!isset($this->mysqli)) {
            throw new connectionFailed("Cannot establish a connection with mysql server. ");
        }
    }

    /**
     * Do a query to the database. 
     * 
     * @param String $query SQL query. 
     * @throws nullQuery
     */
    public function dbQuery($query) {
        if (isset($this->res)){
            mysqli_free_result($this->res);
        }
        
        if (isset($query)) {
            $this->res = $this->mysqli->query($query);
        }else{
            throw new nullQuery("SQL cannot be null. ");
        }
    }
    
    /**
     * Results table getter. 
     * 
     * @return Row table. 
     */
    public function nextRow (){
        $row = $this->res->fetch_array (MYSQL_ASSOC);
        
        if (isset ($row)){
            return $row;
        }else{
            return false;
        }
    }

    /**
     * Rows number getter. 
     * 
     * @return Integer Number of rows in the query. 
     */
    public function getNumRows (){
        if (isset ($this->res)){
            return $this->res->num_rows;
        }
    }
    
    /**
     * Close the db connection. 
     */
    public function closeConnection(){
        mysqli_close($this->mysqli);
    }
}
