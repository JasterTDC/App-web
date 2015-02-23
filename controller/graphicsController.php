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
     * @var Text initial date. 
     */
    private $from;
    
    /**
     * @var Text end date. 
     */
    private $to;
    
    /**
     * @var JsonFile query results. 
     */
    private $res;
   
    /**
     * @var JsonFile news results. 
     */
    private $news;
    
    /**
     * Class constructor. 
     * 
     * @param String $keyword Palabra clave. 
     */
    public function __construct($keyword, $from, $to) {
        $this->daoJson = new DAOJson("http://localhost:1556");
        $this->keyword = $keyword;
        $this->from = $from;
        $this->to = $to;
    }
    
    /**
     * Search keyword into the API. 
     */
    public function searchKeyword (){
        $this->res = $this->daoJson->searchKeywordDate($this->keyword, $this->from, $this->to);
    }
    
    /**
     * Search keyword into the API. 
     */
    public function searchNews (){
        $this->news = $this->daoJson->searchFeedDate($this->keyword, "2014-09-01", "2014-11-30");
    }
    
    /**
     * Results getter. 
     * 
     * @return JsonFile json file with all info. 
     */
    public function getRes (){
        return $this->res;
    }
    
    /**
     * News getter. 
     * 
     * @return JsonFile json file with all info. 
     */
    public function getNews (){
        return $this->news;
    }
    
    /**
     * Keyword getter. 
     * 
     * @return String keyword. 
     */
    public function getKeyword (){
        return $this->keyword;
    }
}
