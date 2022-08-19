<?php
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
    if (!empty($_FILES)){
        
        $isUser = false;
	$tempFile = $_FILES['Filedata']['tmp_name']; 
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'];
        //Verify if is picture uploaded by user
        if($_REQUEST['folder'] == "/media/user/images"){
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/original/';
        $isUser = true;
        }
        
        $thumbnails = $_REQUEST['thumbnails'];
        
        $stringFile = StringToFile($_FILES['Filedata']['name']);
        
	$targetFile =  str_replace('//','/',$targetPath) . $stringFile;      

	$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	$fileTypes  = str_replace(';','|',$fileTypes);
	$typesArray = split('\|',$fileTypes);
	$fileParts  = pathinfo($_FILES['Filedata']['name']);
	
        if(in_array($fileParts['extension'], $typesArray)){	
            //uploads the file           
            move_uploaded_file($tempFile,$targetFile);           
            
            if($isUser){
            //Creates a thumb width and height
            createThumb($stringFile, 50,  "thumbs_50",  $targetFile);
            createThumb($stringFile, 120, "thumbs_120", $targetFile);
            if($thumbnails)createThumb($stringFile, 200, "thumbs_200", $targetFile);
            if($thumbnails)createThumb($stringFile, 250, "thumbs_250", $targetFile);
            if($thumbnails)createThumb($stringFile, 350, "thumbs_350", $targetFile);
            if($thumbnails)createThumb($stringFile, 650, "thumbs_650", $targetFile);
            }
            //Callback
            echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$stringFile);	
               
	}else{
            echo 'Invalid file type.';
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
    function createThumb($filename, $new_width, $folder, $path_image){
        
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
            setTransparency($image_p, "png"); 
            $image = imagecreatefrompng($path_image);	
	}
        
        if (preg_match('/gif/',$system[1])){
            setTransparency($image_p, "gif");
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
    function setTransparency($new_image, $type){
       
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
    function StringToFile($str){
        
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
        $file_name = $file_name . "_" . $sufixo_rand .  "." . strtolower($sufixo);
        }else{
        $file_name = $file_name . "." . strtolower($sufixo);
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
    function getRandom(){
        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $num = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $sufixo_new_1 = $abc[rand(0,25)];
        $sufixo_new_2 = $num[rand(0,9)];
        $sufixo_new = $sufixo_new_1 . $sufixo_new_2;
        
        return $sufixo_new;
    }

?>