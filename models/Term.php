<?php

/**
 * Description of Term
 *
 * @author Ismael Moral
 */
class Term {
    
    /**
     * @var String collection name. 
     */
    var $cName;
    
    /**
     * @var String keyword. 
     */
    var $termName;
    
    /**
     * Class constructor. 
     * 
     * @param String $cname collection name. 
     * @param String $termName keyword. 
     */
    public function __construct ($cname, $termName){
        $this->cName = $cname;
        $this->termName = $termName;
    }
    
    /**
     * Collection name getter. 
     * 
     * @return String collection name. 
     */
    public function getCName(){
        return $this->cName;
    }
    
    /**
     * Keyword getter. 
     * 
     * @return String keyword. 
     */
    public function getTerm(){
        return $this->termName;
    }
    
    
}
