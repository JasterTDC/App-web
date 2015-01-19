<?php

class nullQuery extends Exception {}
class connectionFailed extends Exception {}

/**
 * Description of DB
 *
 * @author Ismael Moral.
 */
class DB {
    
    /**
     * @var String Db host. 
     */
    var $host;
    
    /**
     * @var String Db user.
     */
    var $user;
    
    /**
     * @var String DB's user password. 
     */
    var $pass;
    
    /**
     * @var String DB name. 
     */
    var $db;
    
    /**
     * @var Link Db connection. 
     */
    var $link;
    
    /**
     * @var Results Db results. 
     */
    var $res;
    
    /**
     * Class constructor. 
     * 
     * @param String $host Db host. 
     * @param String $user Db user. 
     * @param String $pass Db's user password. 
     */
    public function __construct($host = "localhost", $user = "root", $pass = "780026") {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        
        $this->link = mysql_connect ($host, $user, $pass);
        
        if (!isset($this->link)){
            throw new connectionFailed('Cannot establish a connection with mysql server. ');
        }
    }
    
    /**
     * Select db to start working. 
     * 
     * @param String $db database name. 
     */
    public function dbSelect ($db){
        $this->db = $db;
        
        mysql_select_db($db, $this->link);
    }
    
    /**
     * Do a query to the database. 
     * 
     * @param String $query sql query.
     * @throws nullQuery 
     */
    public function dbQuery ($query){
        
        if (isset ($query)){
            $this->res = mysql_query($query, $this->link);
        }else{
            throw new nullQuery ('Sql query cannot be null. ');
        }
    }
    
    /**
     * It returns one row, once query is done. 
     * 
     * @pre    Previously you have to do a query first. 
     * @return Row table row. 
     */
    public function nextRow (){
        $row = mysql_fetch_array($this->res);
        
        if (isset ($row)){
            return $row;
        }else{
            false;
        }
    }
    
    /**
     * Rows number getter. 
     * 
     * @return Integer Number of rows in the query. 
     */
    public function getNumRows(){
        return mysql_num_rows($this->res);
    }
    
    /**
     * Close the db connection. 
     */
    public function closeConnection(){
        mysql_close($this->link);
    }
}
