<?php


/**
 * 
 * Handle file uploads via regular form post
 * 
 * It's using the $_FILES array
 * 
 * 
 */
class ImageUploadedFileForm{  
    
    
    /**
     * Save the file to the specified path
     * 
     * @return boolean TRUE on success
     * 
     */
    public function save($path){
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    
    /**
     * Get name
     * 
     */
    public function getName(){
        Yii::import('application.extensions.utils.StringUtils');
        $name = StringUtils::StringToLowerCase($_FILES['qqfile']['name'], "simple");
        $name = StringUtils::removeAcentos($name);        
        return $name;
    }
    
    /**
     * Get size
     * 
     */
    public function getSize(){
        return $_FILES['qqfile']['size'];
    }
}
?>
