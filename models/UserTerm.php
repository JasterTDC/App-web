<?php

/**
 * Description of UserTerm
 *
 * @author Ismael Moral
 */
class UserTerm {

    /**
     * @var String user e-mail.
     */
    var $email;
    
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
     * @param String $email user e-mail. 
     * @param String $cname collection name. 
     * @param String $termname keyword. 
     */
    public function __construct ($email, $cname, $termname){
        $this->email = $email;
        $this->cName = $cname;
        $this->termName = $termname;
    }
    
    /**
     * E-mail getter. 
     * 
     * @return String user e-mail. 
     */
    public function getEmail (){
        return $this->email;
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
    public function getTerm (){
        return $this->termName;
    }
}
