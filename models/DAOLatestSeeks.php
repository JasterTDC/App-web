<?php

include 'DBMy.php';
include 'LatestSeeks.php';

/**
 * Description of DAOLatestSeeks
 *
 * @author Ismael Moral
 */
class DAOLatestSeeks {

    /**
     * @var DBMy DB connection. 
     */
    private $dbConnection;

    /**
     * Class constructor. 
     */
    public function __construct() {
        $this->dbConnection = new DBMy();
    }

    /**
     * Database insert method. 
     * 
     * @param LatestSeeks $lat Search into API. 
     */
    public function insertLS ($lat){
        $query = "INSERT INTO `latestSeeks` (`Name`,`Date`) VALUES ('".$lat->getName()."', '".$lat->getDate()."');";
        $this->dbConnection->dbQuery($query);
    }
    
    /**
     * Database search method.
     */
    public function searchLS (){
        $list = array ();
        
        $query = "SELECT * FROM `latestSeeks` ORDER BY `Date` DESC LIMIT 10;";
        $this->dbConnection->dbQuery($query);
        while (($ls = $this->dbConnection->nextRow()) != false){
            $newls = new LatestSeeks($ls["Name"]);
            $newls->setDate($ls["Date"]);
            $newls->setId($ls["Id"]);
            
            $list[] = $newls;
        }
        
        return $list;
    }
}
