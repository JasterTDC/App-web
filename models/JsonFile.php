<?php

class outOfJson extends Exception {}
class nullAttribute extends Exception {}
/**
 * Description of jsonFile
 *
 * @author Ismael Moral. 
 */
class JsonFile {

    /**
     * @var String file path. 
     */
    var $path;
    
    /**
     * @var String content of the file. 
     */
    var $content; 
    
    /**
     * @var String parse json from content. 
     */
    var $json;
    
    /**
     * @var Integer number of documents inside json. 
     */
    var $numItems; 
    
    /**
     * Class constructor.  
     * @param String $nPath Path file. 
     */
    public function __construct($nPath) {
        $this->path = $nPath;
        $this->content = file_get_contents($nPath);
    }
    
    /**
     * Path getter. 
     * @return String path file. 
     */
    public function getPath (){
        return $this->path;
    }
    
    /**
     * Content file. 
     * @return String content file. 
     */
    public function getContent (){
        return $this->content;
    }
    
    /**
     * It returns the number of items inside of json file. 
     * @return Integer Number of items. 
     */
    public function getNumItems (){
        return $this->numItems;
    }
    
    /**
     * Parse json from content file. 
     */
    public function parse (){
        $this->json = json_decode($this->content, true);
        $this->numItems = count ($this->json);
    }
    
    /**
     * Document getter. 
     * 
     * @param Integer $numDoc Document index. 
     * @return Document
     * @throws outOfJsonException Index out of the json array. 
     */
    public function getDoc ($numDoc){
        if ($numDoc < 0 || $numDoc > $this->numItems){
            throw new outOfJson('Out of bounds of the json array. ');
        }else{
            return $this->json[$numDoc];
        }
    }
    
    /**
     * Document getter with an attribute.
     * 
     * @param Integer $numDoc Document index. 
     * @param String $att Attribute name
     * @return Object Json object
     * @throws outOfJsonException
     * @throws nullAttributeException
     */
    public function getDocAttribute ($numDoc, $att){
        if ($numDoc < 0 || $numDoc > $this->numItems){
            throw new outOfJson('Out of bounds of the json array. ');
        }else{
            if (isset($att)){
                return $this->json[$numDoc][$att];
            }else{
                throw new nullAttribute ('Attribute cannot be null. ');
            }
        }
    }
}
