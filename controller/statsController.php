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
     * @var Array result array.
     */
    private $res;

    /**
     * Class constructor. 
     */
    public function __construct() {
        $this->dao = new DAOJson("http://localhost:1556");
        $this->res = array();
    }

    /**
     * Tweets count between two dates. 
     * 
     * @param String $from yyyy-mm-dd date.
     * @param String $to yyyy-mm-dd date. 
     * @return String Number of tweets. 
     */
    public function getCountDate($from, $to) {
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
    public function getCountDatePol($pol, $from, $to) {
        return $this->dao->searchCountDatePol("microsoft", $from, $to, $pol)->getDocAttribute(0, "Num");
    }
    
    /**
     * It gets all info about one month. 
     * 
     * @param Integer $month Year month. 
     */
    public function loadMonthInfo($month) {
        $from = "2014-".$month."-01";
        $to = "2014-".$month."-30";
        
        $this->res["total"] = $this->getCountDate($from, $to);
        $this->res["pos"] = $this->getCountDatePol(1, $from, $to);
        $this->res["neg"] = $this->getCountDatePol(-1, $from, $to);
        $this->res["neu"] = $this->getCountDatePol(0, $from, $to);
        $this->res["ppos"] = round (($this->res["pos"]/$this->res["total"])*100, 2, PHP_ROUND_HALF_UP);
        $this->res["pneg"] = round (($this->res["neg"]/$this->res["total"])*100, 2, PHP_ROUND_HALF_UP);
        $this->res["pneu"] = round (($this->res["neu"]/$this->res["total"])*100, 2, PHP_ROUND_HALF_UP);
    }
    
    /**
     * Total getter. 
     * 
     * @return Integer model info. 
     */
    public function getTotal(){
        return number_format($this->getRes("total"));
    }

    /**
     * Positives getter. 
     * 
     * @return Integer model info. 
     */
    public function getPos (){
        return number_format($this->getRes("pos"));
    }
    
    /**
     * Negatives getter. 
     * 
     * @return Integer model info. 
     */
    public function getNeg (){
        return number_format($this->getRes ("neg"));
    }
    
    /**
     * Neutres getter. 
     * 
     * @return Integer model info. 
     */
    public function getNeu (){
        return number_format($this->getRes("neu"));
    }
    
    /**
     * Positives percentual getter. 
     * 
     * @return Integer model info. 
     */
    public function getPositivesPerc (){
        return number_format($this->getRes("ppos"));
    }
    
    /**
     * Negatives percentual getter. 
     * 
     * @return Integer model info. 
     */
    public function getNegativesPerc (){
        return number_format($this->getRes ("pneg"));
    }
    
    /**
     * Neutres percentual getter. 
     * 
     * @return Integer model info. 
     */
    public function getNeutresPerc (){
        return number_format($this->getRes ("pneu"));
    }
    
    /**
     * Private function that obtains information about the model. 
     * 
     * @param String $string S
     * @return Integer. 
     */
    private function getRes ($string){
        return $this->res[$string];
    }
}
