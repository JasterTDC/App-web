<?php

/**
 * Description of summaryController
 *
 * @author Ismael Moral
 */
class summaryController {
    
    /**
     * @var DAOJson Json reader. 
     */
    private $daoJson; 
    
    /**
     * Contains all the info. 
     * 
     * @var String Summary. 
     */
    private $summary; 
    
    /**
     * Class constructor. 
     */
    public function __construct() {
        $this->daoJson = new DAOJson ("http://localhost:1556");
    }
    
    /**
     * Get the summary info. 
     * 
     * @param String $from Initial date. 
     * @param String $to End date. 
     */
    public function calculateSummary ($from, $to){
        $this->summary = $this->daoJson->searchKeywordDate("Google", $from, $to);
    }
    
    /**
     * Summary getter. 
     * 
     * @return String Summary info. 
     */
    public function getSummary (){
        return $this->summary;
    }
}
