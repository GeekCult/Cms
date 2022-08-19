<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Handle file uploads via XMLHttpRequest
 */
class ImageUploadedFileXhr{
    
    /**
     * Save the file to the specified path
     * 
     * @return boolean TRUE on success
     * 
     */
    public function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    
    /**
     * Get name
     * 
     */
    public function getName() {
        Yii::import('application.extensions.utils.StringUtils');
        $name  = html_entity_decode($_GET['qqfile']);
        $name = StringUtils::StringToLowerCase($name, "simple");
        $name = StringUtils::removeAcentos($name);
        return $name;
    }
    
    /**
     * Get size
     * 
     */
    public function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}
?>
