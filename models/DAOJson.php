<?php

require 'JsonFile.php';

/**
 * Description of DAOJson
 *
 * @author Ismael Moral
 */
class DAOJson{
    
    /**
     *
     * @var String 
     */
    var $host;
    
    /**
     * Class constructor. 
     * 
     * @param String host address. 
     */
    public function __construct($host) {
        $this->host = $host;
    }
    
    /**
     * Search in the api all information about one term. 
     * 
     * @param String $term keyword. 
     * @return \JsonFile json file with all info. 
     */
    public function searchGlobalTerm ($term){
        $json = new JsonFile ($this->host. '/api/key/' . $term );
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information with this polarity level. 
     * 
     * @param String $theme collection name.
     * @param Integer $polarity polarity level. 
     * @return \JsonFile json file with all info about polarity. 
     */
    public function searchPolarity ($theme, $polarity){
        $json = new JsonFile ($this->host . '/api/' . $theme . '/count/polarity?polarity=' . $polarity);
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in api the total numbers of tweets. 
     * 
     * @param String $theme collection name. 
     * @return \JsonFile json file with the tweets count.  
     */
    public function searchTotal ($theme){
        $json = new JsonFile ($this->host. '/api/' . $theme . '/count');
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information about one user. 
     * 
     * @param String $theme collection name. 
     * @param String $user user name.
     * @return \JsonFile json file with all info about the user. 
     */
    public function searchUser ($theme, $user){
        $json = new JsonFile ($this->host . '/api/'.$theme.'/user/' .$name);
        $json->parse();
        
        return $json; 
    }
    
    /**
     * Search in the api all information about one term. 
     * 
     * @param String $theme collection name.
     * @param String $term keyword.
     * @return \JsonFile json file with all info about the term. 
     */
    public function searchTerm ($theme, $term){
        $json = new JsonFile ($this->host . '/api/'.$theme.'/key/' . $term);
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information in this language. 
     * 
     * @param String $theme collection name.
     * @param String $lang language. 
     * @return \JsonFile json file with all info in the same language.
     */
    public function searchLang ($theme, $lang){
        $json = new JsonFile ($this->host . '/api/'.$theme.'/lang/'.$lang);
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information in this language, and related with the term. 
     * 
     * @param String $theme collection name. 
     * @param String $term keyword.
     * @param String $lang language. 
     * @return \JsonFile json file with all info about then term, in this language.
     */
    public function searchTermLang ($theme, $term, $lang){
        $json = new JsonFile ($this->host . '/api/' . $theme . '/tw/' . $term . '/' . $lang);
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information between the two dates. 
     * 
     * @param String $theme collection name.
     * @param String $from date.
     * @param String $to date.
     * @return \JsonFile json file with all the info. 
     */
    public function searchCountDate ($theme, $from, $to){
        $json = new JsonFile ($this->host . '/api/' . $theme . '/count/date?from='. $from . "&to=" . $to);
        $json->parse();
        
        return $json;
    }
    
    /**
     * Search in the api all information betweetn the two dates, and with this polarity level. 
     * 
     * @param String $theme collection name.
     * @param String $from date. 
     * @param String $to date. 
     * @param Integer $pol polarity level. 
     * @return \JsonFile json file with all the info. 
     */
    public function searchCountDatePol ($theme, $from, $to, $pol){
        $json = new JsonFile ($this->host . '/api/' . $theme . '/count/datepol?polarity=' . $pol . '&from=' . $from . '&to=' . $to);
        $json->parse();
        
        return $json;
    }
}
