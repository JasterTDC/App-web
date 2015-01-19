<?php

/**
 * Description of graphicsController
 *
 * @author Ismael Moral
 */
class graphicsController {
    /**
     * @var DAOJsonGoogle Json parser from google collection. 
     */
    private $daoGoogle;
    
    /**
     * @var DAOJsonMicrosoft Json parser from microsoft collection. 
     */
    private $daoMicrosoft;
    
    /**
     * @var DAOJsonApple Json parser from apple collection. 
     */
    private $daoApple;

    /**
     * @var String Keyword.
     */
    private $keyword;
    
    /**
     * @var JsonFile Google results. 
     */
    private $google;
    
    /**
     * @var JsonFile Microsoft results.  
     */
    private $microsoft;
    
    /**
     * @var JsonFile Apple results. 
     */
    private $apple;
    /**
     * Class constructor. 
     * 
     * @param String $keyword Palabra clave. 
     */
    public function __construct($keyword) {
        $this->daoGoogle = new DAOJsonGoogle();
        $this->daoMicrosoft = new DAOJsonMicrosoft();
        $this->daoApple = new DAOJsonApple();
        $this->keyword = $keyword;
    }
    
    /**
     * Search keyword into the API. 
     */
    public function searchKeyword (){
        $this->apple = $this->daoApple->searchTerm($this->keyword);
        $this->google = $this->daoGoogle->searchTerm($this->keyword);
        $this->microsoft = $this->daoMicrosoft->searchTerm($this->keyword);
    }
    
    /**
     * JsonFile getter from Apple collection. 
     * 
     * @return JsonFile Apple json. 
     */
    public function getApple (){
        return $this->apple;
    }
    
    /**
     * JsonFile getter from Google collection. 
     * 
     * @return JsonFile Google json. 
     */
    public function getGoogle (){
        return $this->google;
    }
    
    /**
     * JsonFile getter from Microsoft collection. 
     * 
     * @return JsonFile Microsoft json. 
     */
    public function getMicrosoft (){
        return $this->microsoft;
    }
}
