<?php

/**
 * Description of user
 *
 * @author Ismael Moral
 */
class User {
    /**
     * @var String user e-mail. 
     */
    var $email;
    
    /**
     * @var String user name.
     */
    var $name;
    
    /**
     * @var String user password. 
     */
    var $password;
    
    /**
     * Class constructor. 
     * 
     * @param String user e-mail.
     * @param String user name.
     * @param String user password. 
     */
    public function __construct($email, $name, $password) {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
    
    /**
     * Email getter. 
     * @return String user e-mail. 
     */
    public function getEmail (){
        return $this->email;
    }
    
    /**
     * Name getter. 
     * @return String user name.
     */
    public function getName (){
        return $this->name;
    }
    
    /**
     * Password getter. 
     * @return String user password. 
     */
    public function getPass (){
        return $this->password;
    }
    
    /**
     * Email setter. 
     * @param String $email user e-mail. 
     */
    public function setEmail ($email){
        $this->email = $email;
    }
    
    /**
     * Password setter. 
     * @param String $password user password. 
     */
    public function setPass ($password){
        $this->password = $password;
    }
    
    /**
     * Name setter. 
     * @param String $name user name. 
     */
    public function setName ($name){
        $this->name = $name;
    }
    
    /**
     * Validate the password. 
     * 
     * @param String $password password to check. 
     * @return boolean if both pass are equal returns true, else false. 
     */
    public function checkPass ($password){
        if (strcmp($this->password, $password) == 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Calculate the password hash. 
     * 
     * @param String $pass user password. 
     */
    public function hashPass ($pass){
        $this->password = sha1 ($pass);
    }
}
