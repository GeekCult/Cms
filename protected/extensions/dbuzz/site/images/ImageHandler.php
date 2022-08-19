<?php

class ImageHandler {
    
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        //$this->checkServerSettings();       

        if(isset($_GET['qqfile'])){
            Yii::import('application.extensions.dbuzz.site.images.ImageUploadedFileXhr');
            $this->file = new ImageUploadedFileXhr();
            
        }elseif(isset($_FILES['qqfile'])){
            Yii::import('application.extensions.dbuzz.site.images.ImageUploadedFileForm');
            $this->file = new ImageUploadedFileForm();
            
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
    /**
     * Returns bytes
     * 
     */
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     * 
     * @param string
     * @param boolean 
     * 
     */
    function handleUpload($uploadDirectory, $replaceOldFile = true, $keepName = false){
        
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        
        Yii::import('application.extensions.utils.StringUtils');
        $filename = StringUtils::StringToUnderline($filename);
        if($keepName) $filename = $keepName;
     
        //echo $filename;
        //$filename = md5(uniqid());
        $ext = StringUtils::StringToLowerCase($pathinfo['extension'], 'simple');
        //$ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if($replaceOldFile == 'false'){
            /// don't overwrite previous files that were uploaded
            $filename .= "_" . StringUtils::getRandom();            
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
            return array('success'=>true, 'file_name' => $filename . '.' . $ext, 'keep' => 'dd');
        }else{
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }    
}