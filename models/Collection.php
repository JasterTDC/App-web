<?php

/**
 * Description of Collection
 *
 * @author Ismael Moral
 */
class Collection {
    /**
     * @var String Collection name.
     */
    var $name;
    
    /**
     * Class constructor. 
     * 
     * @param String $name collection name. 
     */
    public function __construct($name) {
        $this->name = $name;
    }
    
    /**
     * Name getter. 
     * 
     * @return String collection name. 
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * Name setter. 
     * 
     * @param String $name collection name. 
     */
    public function setName($name){
        $this->name = $name;
    }
}
