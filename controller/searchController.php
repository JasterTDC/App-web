<?php

/**
 * Description of searchController
 *
 * @author Ismael Moral
 */
class searchController {
    
    /**
     * @var DAOLatestSeeks Search into the API. 
     */
    private $daoLs;
    
    /**
     * Class constructor. 
     */
    public function __construct() {
        $this->daoLs = new DAOLatestSeeks();
    }
    
    /**
     * Table constructor. 
     * 
     * @return String HTML code. 
     */
    public function getTable (){
        $table = "";
        
        $list = $this->daoLs->searchLS();
        for ($i = 0; $i < count($list); $i++){
            $table = $table . "<tr><td>".$list[$i]->getDate()."</td><td>".$list[$i]->getName()."</td></tr>";
        }
        return $table;
    }
}
