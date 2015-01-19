<?php

/**
 * Description of LatestSeeks
 *
 * @author Ismael Moral
 */
class LatestSeeks {
    /**
     * @var Integer Auto-incremental value. 
     */
    private $id;
    
    /**
     * @var String Keyword. 
     */
    private $name;
    
    /**
     * @var Date Published date of the seek. 
     */
    private $date;
    
    /**
     * Class constructor. 
     * 
     * @param String $name Keyword. 
     */
    public function __construct($name) {
        $this->name = $name;
        $this->date = date ("Y-m-d H:i:s");
    }
    
    /**
     * Id setter. 
     * 
     * @param Integer $id Search identifier. 
     */
    public function setId ($id){
        $this->id = $id;
    }
    
    /**
     * Date setter.
     * 
     * @param Date $date Published date. 
     */
    public function setDate ($date){
        $this->date = $date;
    }
    
    /**
     * Keyword setter. 
     * 
     * @param String $name keyword. 
     */
    public function setName ($name){
        $this->name = $name;
    }
    
    /**
     * Keyword getter. 
     * 
     * @return String keyword. 
     */
    public function getName (){
        return $this->name;
    }
    
    /**
     * Id getter. 
     * 
     * @return Integer Identifier search.
     */
    public function getId (){
        return $this->id;
    }
    
    /**
     * Date getter.
     * 
     * @return Date published date. 
     */
    public function getDate (){
        return $this->date;
    }
}
