<?php

class ImagesAction extends CAction{

    private $action;
    private $coolHandler;
    private $imagesHandler;
    private $imageUploadHandler;
    

    /**
     *
     * Images
     * 
     * Helper class action it's the SITE part
     * It helps with get and set images from the front end
     *
     */
    public function run(){
        
        Yii::import('application.extensions.dbuzz.admin.CoolManager');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        Yii::import('application.extensions.dbuzz.admin.ImageUploadManager');
        Yii::import('application.extensions.dbuzz.site.images.ImageHandler');
        Yii::import('application.extensions.utils.StringUtils');

        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->coolHandler = new CoolManager();
        $this->imagesHandler = new ImagesManager();
        $this->imageUploadHandler = new ImageUploadManager();

        switch($this->action){            
            case "obter":                
                $this->getImage();                
                break;
            case "change":                
                $this->changeCategory();                
                break;
            case "salvar":                
                $this->saveImage();                
                break;
            case "upload":                
                $this->upLoadImage();                
                break;
            case "upload_admin":                
                $this->upLoadImageAdmin();                
                break;
        }   
    }
    
    /*
     * It uses a POST values to retrieve the correct
     * images, a type is passed for to help with the correct
     * image's type.
     * 
     * 
     */
    public function getImage(){
        
        $id = $_POST['id_image'];        
        $tipo = $_POST['tipo'];
        
        switch($tipo){            
            case "avatar":                
                $result = $this->coolHandler->getContentById($id);                
                break;
            
            case "user":                
                $result = $this->imagesHandler->getContentById($id);
                break;
        }
        echo json_encode($result);        
    }
    
    /*
     * Save
     * Saves the user avatar and others images
     * It can be events, products and avatars
     * 
     */
    public function saveImage(){
        
        //Get session
        $session = MethodUtils::getSessionData();
                    
        $get_post = array();
        $get_post['image'] = $_POST['image'];        
        $get_post['tipo'] = $_POST['tipo'];
        $get_post['id_categoria'] = 0;
        $get_post['id_user'] = $session['id'];
        $get_post['data'] = date('Ymd');
          
        $saveImage = $this->imagesHandler->addContent($get_post);
        
        echo json_encode($saveImage);
    }
    
    /*
     * It change the avatars category with
     * the new one choose. 
     * 
     */
    public function changeCategory(){
               
        $tipo = $_POST['tipo'];
        
        switch($tipo){            
            case "common":                
                $result['avatar'] = $this->coolHandler->getAllAvatars(0); 
                $this->controller->renderPartial("/site/pages/conta/avatar/items_common", $result);
                break;
            
            case "special":                
                $result['avatar'] = $this->coolHandler->getAllAvatars(1); 
                $this->controller->renderPartial("/site/pages/conta/avatar/items_common", $result);
                break; 
            
            case "geral":                
                $result['avatar'] = $this->coolHandler->getAllAvatars(3);
                $this->controller->renderPartial("/site/pages/conta/avatar/items_common", $result);
                break;
            
            case "user":                
                $result['avatar'] = $this->imagesHandler->getAllUserAvatars();
                $this->controller->renderPartial("/site/pages/conta/avatar/items_user", $result);
                break;
        }               
    }
    
    /*
     * It uploads an image. 
     * 
     */
    public function upLoadImage(){
        //Destination
        $path_folder = $_REQUEST['path'];
        $current_image = $_REQUEST['current_image'];
        $replace = $_REQUEST['replace'];
        $content = StringUtils::StringToLowerCase($_REQUEST['qqfile'], "simple");
        $save = isset($_REQUEST['save']);
        $client = isset($_REQUEST['client']);
        
        if($client){        
            //OPEN THE DIRECTORY             
            $session = MethodUtils::getSessionData();
            $oldumask = umask(0);
          
            $dirHandle = is_dir($path_folder);
            if(!$dirHandle){
                mkdir($path_folder, 0777, true);
                chmod($path_folder, 0777);
                umask($oldumask); 
            }
        }
        
        if(is_file($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_image)){
           unlink($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_image);
        }
        
        //list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array();
        //max file size in bytes
        $sizeLimit = 10 * 1024 * 1024;

        $uploader = new ImageHandler($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($path_folder, $replace);
        $result['current_image'] = $result['file_name'];
        $result['type'] = $this->imagesHandler->getTypeFile($content);
        
        if($save){
            $session = MethodUtils::getSessionData();
            $data = array("image" => $result['current_image'], "tipo" => 'playground', 'id_categoria' => 0, 'id_user' => $session['id'], 'data' => date('Ymd'));
            $result['save'] = $this->imagesHandler->addContent($data);  
        }
        
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/" . $path_folder;
        $targetFile =  str_replace('//','/',$targetPath) . $result['file_name']; 
        
        //Creates a thumb width and height
        if($path_folder == "media/user/images/purplecanvas/"){
            $this->createThumb($result['file_name'], 120, "purplecanvas/thumbs", $targetFile);
        }
        
        //to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    
    /*
     * It uploads an image. 
     * 
     */
    public function upLoadImageAdmin(){
        
        //Destination
        $path = $_REQUEST['path'];
        $path_folder = $_REQUEST['path'] ;
        if($path == "media/user/images") $path_folder = $_REQUEST['path'] . "/original/";
        $current_image = $_REQUEST['current_image'];
        $replace = $_REQUEST['replace'];
        $content = StringUtils::StringToLowerCase($_REQUEST['qqfile'], "simple");
        $save = isset($_REQUEST['save']);
        $client = isset($_REQUEST['client']);
        
        if($client){        
            //OPEN THE DIRECTORY             
            $session = MethodUtils::getSessionData();
            $oldumask = umask(0);
          
            $dirHandle = is_dir($path_folder);
            if(!$dirHandle){
                mkdir($path_folder, 0777, true);
                chmod($path_folder, 0777);
                umask($oldumask); 
            }
        }
        
        
        if(is_file($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_image)){
           unlink($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_image);
        }
        
        //list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array();
        //max file size in bytes
        $sizeLimit = 10 * 1024 * 1024;

        $uploader = new ImageHandler($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($path_folder, $replace);
        
        if(isset($result['file_name'])) $current_image = $result['file_name'];
        
        $result['current_image']= $current_image;
        $result['type'] = $this->imagesHandler->getTypeFile($content);
        
        if($save){
            $session = MethodUtils::getSessionData();
            $data = array("image" => $content, "tipo" => 'playground', 'id_categoria' => 0, 'id_user' => $session['id'], 'data' => date('Ymd'));
            $result['save'] = $this->imagesHandler->addContent($data);  
        }

        
        
        $isUser = true;
        $thumbnails = $_REQUEST['hasThumbs'];        
        if(isset($_REQUEST['isUser'])) $isUser = $_REQUEST['isUser'];
           

        if($isUser){
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/" . $path_folder;
            $targetFile =  str_replace('//','/',$targetPath) . $current_image; 
            
            //Creates a thumb width and height
            $this->createThumb($current_image, 50,  "thumbs_50",  $targetFile);
            $this->createThumb($current_image, 120, "thumbs_120", $targetFile);
            
            if($thumbnails) $this->createThumb($current_image, 200, "thumbs_200", $targetFile);
            if($thumbnails) $this->createThumb($current_image, 250, "thumbs_250", $targetFile);
            if($thumbnails) $this->createThumb($current_image, 350, "thumbs_350", $targetFile);
            if($thumbnails) $this->createThumb($current_image, 650, "thumbs_650", $targetFile);
        }

        //to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

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
    public function createThumb($filename, $new_width, $folder, $path_image){
        
        //Become it to lowercase
        $filename = StringUtils::StringToLowerCase($filename, 'simple');
        
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
            //$this->setTransparency($image_p, "png");
            // integer representation of the color black (rgb: 0,0,0)
            $background = imagecolorallocate($image_p, 255, 255, 255);
            // removing the black from the placeholder
            imagecolortransparent($image_p, $background);
            // turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
            imagealphablending($image_p, false);
            // turning on alpha channel information saving (to ensure the full range of transparency is preserved)
            imagesavealpha($image_p, true);

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
            imagejpeg($image_p, $targetFile, 100);
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
    public function setTransparency($new_image, $type){
       
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
}
?>
