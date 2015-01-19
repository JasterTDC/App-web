<?php

/**
 * Description of statsController
 *
 * @author Ismael Moral 
 */
class statsController {
    
    /**
     * @var DAOJson Manage Json. 
     */
    private $dao;
    
    /**
     * Class constructor. 
     */
    public function __construct() {
        $this->dao = new DAOJson ("http://localhost:1556");
    }
    
    /**
     * Tweets count between two dates. 
     * 
     * @param String $from yyyy-mm-dd date.
     * @param String $to yyyy-mm-dd date. 
     * @return String Number of tweets. 
     */
    public function getCountDate ($from, $to){
        return $this->dao->searchCountDate("microsoft", $from, $to)->getDocAttribute(0, "Num");
    }
    
    /**
     * Tweets count betweetn two dates, and with a static polarity level. 
     * 
     * @param String $pol polarity level. 
     * @param String $from date. 
     * @param String $to date. 
     * @return String Number of tweets. 
     */
    public function getCountDatePol ($pol, $from, $to){
        return $this->dao->searchCountDatePol("microsoft", $from, $to, $pol)->getDocAttribute(0, "Num");
    }
}
