<?php

/**
 * Description of graphicsController
 *
 * @author Ismael Moral
 */
class graphicsController {

    /**
     * @var DAOJson json management.
     */
    private $daoJson;

    /**
     * @var String Keyword.
     */
    private $keyword;
    
    /**
     * @var JsonFile query results. 
     */
    private $res;
   
    /**
     * Class constructor. 
     * 
     * @param String $keyword Palabra clave. 
     */
    public function __construct($keyword) {
        $this->daoJson = new DAOJson("http://localhost:1556");
        $this->keyword = $keyword;
    }
    
    /**
     * Search keyword into the API. 
     */
    public function searchKeyword (){
        $this->res = $this->daoJson->searchGlobalTerm($this->keyword);
    }
    
    /**
     * Results getter. 
     * 
     * @return JsonFile json file with all info. 
     */
    public function getRes (){
        return $this->res;
    }
}
