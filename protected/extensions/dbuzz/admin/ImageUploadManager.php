<?php
/*
 * This Class is used to deal with Image Upload
 *
 * @author CarlosGarcia
 *
 * Date: 13/05/2010
 *
 */

class ImageUploadManager{
    
   /*
    * Upload Method
    *
    */
    public function uploadImage($fileS, $folder){
        
        if (!empty($fileS)){
        
            $isUser = false;
            $tempFile = $fileS['Filedata']['tmp_name']; 
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $folder;
            //Verify if is picture uploaded by user
            if($folder == "/media/user/images"){
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $folder . '/original/';
            $isUser = true;
            }

            $stringFile = $this->StringToFile($fileS['Filedata']['name']);

            $targetFile =  str_replace('//','/',$targetPath) . $stringFile;      

            $fileTypes  = str_replace('*.','', "*.jpg;*.jpeg;*.png;*.gif");
            $fileTypes  = str_replace(';','|',$fileTypes);
            $typesArray = split('\|',$fileTypes);
            $fileParts  = pathinfo($fileS['Filedata']['name']);

            if(in_array($fileParts['extension'], $typesArray)){	
                //uploads the file           
                move_uploaded_file($tempFile,$targetFile);           

                if($isUser){
                //Creates a thumb width and height
                //$this->createThumb($stringFile, 50,  "thumbs_50",  $targetFile);
                //$this->createThumb($stringFile, 120, "thumbs_120", $targetFile);
                //$this->createThumb($stringFile, 200, "thumbs_200", $targetFile);
                //$this->createThumb($stringFile, 250, "thumbs_250", $targetFile);
                //$this->createThumb($stringFile, 350, "thumbs_350", $targetFile);
                //$this->createThumb($stringFile, 650, "thumbs_650", $targetFile);
                }
                //Callback
                echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$stringFile);	

            }else{
                echo 'Invalid file type.';
            }
        }
    }
    
    /*
     * Creates the thumbs
     * 
     * Until this moment just 3 sizes is needed. Uses the m,ethod above to 
     * set new sizes;
     * See the parameters bellow to realize what it takes.
     * 
     * 
     */
    private function createThumb($filename, $new_width, $folder, $path_image){
        
        $system = explode('.',$filename);
            
       //pegando as dimensoes reais da imagem, largura e altura
        list($width, $height) = getimagesize($path_image);
        
        $new_height = ($height * $new_width ) / $width;

        //gerando a a miniatura da imagem
        $image_p = imagecreatetruecolor($new_width, $new_height);
        
        //Verifies the file type 
        if (preg_match('/jpg|jpeg/',$system[1])){
            $image = imagecreatefromjpeg($path_image);
	}
        
	if (preg_match('/png/',$system[1])){
            $this->setTransparency($image_p, "png"); 
            $image = imagecreatefrompng($path_image);	
	}
        
        if (preg_match('/gif/',$system[1])){
            $this->setTransparency($image_p, "gif");
            $image = imagecreatefromgif($path_image);		
	}
        
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
        //Avoid some problems with HTTP ERRROR 403 
        $targetFile =  $_SERVER['DOCUMENT_ROOT'] . '/media/user/images/'. $folder .'/' . $filename;        
        //$targetFile =  '/media/images/user/'. $folder .'/' . $filename;
        $targetFile = str_replace('//','/',$targetFile);
        
        if (preg_match("/png/",$system[1])){
            imagepng($image_p, $targetFile); 
        } 
        
        if(preg_match("/jpg|jpeg/",$system[1])){                
            imagejpeg($image_p, $targetFile, 60);
        }
        
        if(preg_match("/gif/",$system[1])){                
           imagegif($image_p, $targetFile);
        }
        
        chmod("$targetFile",0777);
    }
    
    /*
     * Trasnparent background
     * 
     * Transform the alpha filter in a background transparent
     * It's used into PNG and GIF
     * 
     */
    private function setTransparency($new_image, $type){
       
        switch ($type){
            case "png":
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($new_image, 255, 255, 255);
                // removing the black from the placeholder
                imagecolortransparent($new_image, $background);
                // turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
                imagealphablending($new_image, false);
                // turning on alpha channel information saving (to ensure the full range of transparency is preserved)
                imagesavealpha($new_image, true);
                break;
            case "gif":
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($simage,  255, 255, 255);
                // removing the black from the placeholder
                imagecolortransparent($simage, $background);
                break;
        }      
    } 

    /*
     * 
     * Converts a string to a proper format, ready to be used in URL's
     * 
     * @param string
     * 
     */
    private function StringToFile($str){
        
        $sufixo = substr($str, -3, 3);
        $file_name = substr($str, 0, -3);
        
        $file_name = strtolower($file_name);
        $file_name = str_replace(" ", "_", $file_name);
        $file_name = str_replace("-", "_", $file_name);
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,!,@,#,$,&,%,^,*,(,),[,],{,},=,+,.");
        $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,,,,,,,,,,,,");
        $file_name = str_replace($search, $replace, $file_name);
        $sufixo_rand = getRandom();
             
        if($_REQUEST['folder'] == "/media/user/images" || $_REQUEST['folder'] == "/media/user/curriculum/"){
        $file_name = $file_name . "_" . $sufixo_rand .  "." . $sufixo;
        }else{
        $file_name = $file_name . "." . $sufixo;
        }
        return $file_name;
    }
    
    /*
     * 
     * Random
     * It sorts a number betweem the elemnts bellow
     * It's used just to avoid some images with the same name.
     * 
     */
    private function getRandom(){
        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $num = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $sufixo_new_1 = $abc[rand(0,25)];
        $sufixo_new_2 = $num[rand(0,9)];
        $sufixo_new = $sufixo_new_1 . $sufixo_new_2;
        
        return $sufixo_new;
    }
}
?>