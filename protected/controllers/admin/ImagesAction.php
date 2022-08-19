<?php

class ImagesAction extends CAction {

    public $id_page;
    public $controllerIDHandler;
    public $imageManager;
    public $imageHandler;
    public $categoriaHandler;
    
    private $action;

    /**
     *
     * Galeria e Imagens
     * Specific Admin Controller
     *
     */
    public function run() {

        $id_cat = "";
        
        if(isset ($_POST['id_categoria'])) $id_cat = $_POST['id_categoria'];

        $start = 0;//Valor inicial da paginação
        $title_controller = "";

        $idpag = "";//bug fix with page select it is used in the jquery.paginatin.js
        $title_controller = Yii::app()->controller->action->id;

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $start = Yii::app()->getRequest()->getQuery('id');
        $idpag = Yii::app()->getRequest()->getQuery('id_page');

        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.site.images.ImageHandler');
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->imageManager = new ImagesManager();
        $this->imageHandler = new ImageHandler();
        $this->controllerIDHandler = new PaginasManager();
        $this->categoriaHandler = new CategoriaManager();

        // print_r($this->action); exit;

        switch($this->action){

            case 'deletar':
                $this->deletar();
                break;

            case "novo":
            case   ""  :
                $this->novo($title_controller, "novo", 0);
                break;
            
            case "criar":
                $this->criar();
                break;
            
            case "editar":
                $this->novo($title_controller, "editar", $start);
                break;

            case "adicionar":
                $this->novo($title_controller, "adicionar", 0, $start);
                break;

            case "obter":
                $this->obter();
                break;

            case "listar":
            case "grid":
                $this->listar($start, $title_controller);
                break;

            case "paginar":
                $this->paginar($start, $idpag, false);
                break;

            case "paginar_fancy":
                $this->paginar($start, $idpag, true);
                break;

            case "definir":
                $this->exibir($start);
                break;

            case "anexar":
                $this->anexar($start);
                break;

            case "desanexar":
                $this->desanexar($start);
                break;

            case "recontar":
                $this->recontar();
                break;

            case "banner":
            case "galeria":
                $this->images($title_controller, "galeria");
                break;
            
            case "user_images":
                $this->images_playground($title_controller, "images", true);
                break;
            
            case "images":
                $this->images($title_controller, "images");
                break;            

            case "cadastrar":
            case "update":
                $this->cadastrar();
                break;

            case "recarregar":
                $this->recarregar($start, $id_cat);
                break;

            case "recarregar_fancy":
                $this->recarregar_fancy($start, $id_cat);
                break;

            case "paginar_fancy_images":
                //TODO: Eu não sei o que quebra se tiver esse true... verifique
                //os images slots dos paginas lá deve funcionar
                $this->paginar_fancy($start, $id_cat, "images", false);
                break;
            
            case "paginar_fancy_gallery":
            case "paginar_fancy_galeria":
                $this->paginar_fancy($start, $id_cat, "galeria");
                break;

            case "cool":
                $this->cool($start);
                break;
           
            case "set_image_type":
                $this->setUserImgType();
                break;
            
            case "upload_admin":                
                $this->upLoadImageAdmin();                
                break;

            default:
                echo 'Erro'; 
                break;
        }

    }

    /**
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar() {

        $get_post = array();
        $session = MethodUtils::getSessionData();

        $get_post[0] = $_POST['title'];
        $get_post[1] = $_POST['file'];
        $get_post[2] = $_POST['description'];
        $get_post[3] = $_POST['id_category'];
        $get_post[4] = $_POST['tipo'];
        $get_post[5] = date('Ymd');
        $get_post[6] = $_POST['id_image'];
        $get_post[7] = $session['id'];

        try{  
            if($this->action == "cadastrar"){
                $content = $this->imageManager->submitContent($get_post);
            }else{
                $content = $this->imageManager->updateContent($get_post); 
            }
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Novo
     * This method creates a new record in the database
     * The variable $title_controller is a current name controller
     * 
     * @param string
     *
     */
    public function novo($title_controller, $type, $id, $type_images = ""){

        $result = array();  

        try{
            $controller = $this->controllerIDHandler->getContentController($title_controller);
            $result['categorias'] = $this->categoriaHandler->getAllContentById($controller);
            $result['content']  = $this->imageManager->getContent($id);
            $result['id_controller'] = $controller;
            $result['type'] = $type;
            $result['id_image'] = $id;
            $result['type_images'] = $type_images;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }  
        
        $result['dicas'] = DicasUtils::getTips("list", "images");
        
        $this->addScript();

        if($type == "novo" || $type == "editar"){
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/images/novo", $result);
        }else{
            $this->controller->layout = "admin/admin_base";
            $this->controller->render("pages/images/adicionar", $result);
        }
    }
    
    /**
     * Criar
     * This method creates a new record in the database
     * The variable $title_controller is a current name controller
     * 
     * @param string
     *
     */
    public function criar(){
        
        Yii::import('application.extensions.dbuzz.admin.special.BannerMakerManager');              
        $bannersHandler = new BannerMakerManager();
        
        $result = array();  

        try{
            $result['type'] = "oo"; 
            $result['dicas'] = DicasUtils::getTips("list", "images");
            $result['arts'] = $bannersHandler->getAllContent("playground", 'desktop', 30);
        
            $this->addScript(true);

            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/images/criar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ImagesAction - criar() " . $e->getMessage();
        }  
    }
    
    /**
     * Listar
     * This method list all images.
     *
     * @param $start
     * @param titleC-controller
     *
     */
    public function listar($nr, $title_controller){

        $result = array();
        
        $start = ($nr - 1) * 10;
        if($start <= 0) $start = 0;

        try{
            $result['content'] = $this->imageManager->getPictureContent($this->action, NULL, 'noplayground', $start);
            $result['id_controller'] = $this->controllerIDHandler->getContentController($title_controller);
            $result['categorias'] = $this->categoriaHandler->getAllContentById($result['id_controller']);
            $result['id_page'] = 0;
            
            //Paginacao
            $result['ind'] = $nr;
            $result['paginacao'] = MethodUtils::getPaginationAttributes($result, 'images');
            
            $result['dicas'] = DicasUtils::getTips("list", "images");
            
            $setSession = MethodUtils::setSessionData('imageViewType', $this->action);
            
            $this->addScript();        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/images/".$this->action, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ImagesAction - listar() " . $e->getMessage();
        } 
    }

    /**
     * Obter
     *
     * This method is used from the view paginas editar.
     * It retrieve from a string as f_234,  where f means it is a
     * foto and the number is a id from the conteudo_imagens table
     *
     * It's used from an ajax request
     *
     * @param number
     *
     */
    public function obter(){

        $result = array();
        $id_photo = $_POST['id_photo'];

        try{
            $result['content'] = $this->imageManager->getPicture($id_photo);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        echo json_encode($result);
    }

    /**
     * Definir
     * This method is similar the list method.
     * 
     *
     * The id is a page that will receive the picture selected
     *
     * @param result
     * @param id
     *
     */
    public function exibir($id){

        $result = array();
        $result['id_page'] = $id;
        $this->id_page = $id;

        try{
            $result['content'] = $this->imageManager->getAllContent($id);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/images/definir", $result);
    }

    /**
     * Paginar
     * This method does the reloading items.
     * It loads a new sequency of images from the database
     *
     *
     * @param start number
     * @param idpag  number
     *
     */
    public function paginar($start, $idpag, $type){

        $result = array();
        $session = MethodUtils::getSessionData();

        try{
            $result['content'] = $this->imageManager->getTransformedContent($start, $idpag);
            $result['id_page'] = $start;
            $result['init'] = true;
            
            if(!$type){
                $this->controller->renderPartial("pages/images/content/item_" . $session['imageViewType'], $result);
            
            }else{
                $this->controller->renderPartial("pages/images/content/item_simples", $result);
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ImagesAction - paginar() " . $e->getMessage();
        }
    }

    /**
     * Paginar_fancy
     * This method does the reloading items.
     * It loads a new sequency of images from the database
     *
     *
     * @param start number
     * @param idpag  number
     *
     */
    public function paginar_fancy($start, $idpag, $type, $isUser = false){
        
        $session = MethodUtils::getSessionData();
        
        $result = array();
        $result['id_page'] = false;
        $result['init'] = false;
        $result['type_images'] = $type;
        $result['is_user'] = $isUser;
        
        if($session['userImgType'] == "single") $isUser = $session['id'];

        try{
           $result['content'] = $this->imageManager->getTransformedContent($start, $idpag, $isUser);

        }catch(CDbException $e){
           Yii::trace("ERROR " . $e->getMessage());
           echo "ERROR " . $e->getMessage();
        }
        
        echo $this->controller->renderPartial("pages/images/content/item_simples", $result);
    }

    /**
     *
     * Images
     * This method gets the content to be shown in the fancybox.
     *
     *
     * @param string
     * @param string
     *
     */
    public function images($title_controller, $type, $isUser = false){ 
        
        $session = MethodUtils::getSessionData();
        
        if($session['userImgType'] == "single") $isUser = $session['id'];
            
        try{
            if(!$isUser)$result['content'] = $this->imageManager->getPictureContent();
            if($isUser)$result['content'] = $this->imageManager->getPictureContent("", $session['id'], "playground");
            $controller = $this->controllerIDHandler->getContentController($title_controller);
            $categorais = $this->categoriaHandler->getAllContentById($controller);

            $result['id_controller'] = $controller;
            $result['categorias'] = $categorais;
            $result['id_page'] = false;            
            $result['type_images'] = $type;
            $result['is_user'] = $isUser;
            $result['type_user'] = $session['userImgType'];
            $result['path_small'] = '/media/user/images/thumbs_120/';

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/images/exibir", $result);
    }
    
    /**
     *
     * Images Playground
     * This method gets the content to be shown in the fancybox.
     *
     *
     * @param string
     * @param string
     *
     */
    public function images_playground($title_controller, $type){ 
        
        $session = MethodUtils::getSessionData();        
        
        //Get id_user, if it's a AdminPlayground or PierPlayground
        ($session['id_purple'] != '') ? $id_user = $session['id_purple'] : $id_user = $session['id'];
            
        try{
            $result['content'] = $this->imageManager->getPictureContent("", $id_user, "playground");
            $controller = $this->controllerIDHandler->getContentController($title_controller);
            $categorais = $this->categoriaHandler->getAllContentById($controller);

            $result['id_controller'] = $controller;
            $result['categorias'] = $categorais;
            $result['id_page'] = false;            
            $result['type_images'] = $type;
            $result['is_user'] = $id_user;
            $result['path_small'] = '/media/user/images/thumbs_120/';
            
            $this->controller->layout = "admin/admin_base";
            $this->controller->render("/admin/pages/images/exibir_playground", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * 
     * Sets user image display type
     * It migth be Single or Group/All
     * 
     * @param result array
     *
     */
    public function setUserImgType(){

        $data = array();
        $data['type'] = $_POST['type'];
        $data['message'] = Yii::t('messageStrings', 'message_result_images_type');

        try{
           $data['result'] = MethodUtils::setSessionData('userImgType', $data['type']);
           
           MethodUtils::returnMessage($data); 

        }catch(CDbException $e) {
           Yii::trace("ERROR " . $e->getMessage());
           echo $e->getMessage();
        }
    }

    /**
     *
     * Anexar
     * This method does the link bettewen page and a specifi
     * image it uses a jQuery request
     *
     * The id is a page that will receive the picture selected
     * 
     * @param result array
     *
     */
    public function anexar(){

        $get_post = array();
        $get_post[0] = $_POST['slot'];
        $get_post[1] = $_POST['image'];
        $get_post['id'] = $_POST['id_page'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_gallery_update');

        try{
           $content = $this->imageManager->attachContent($get_post);

        }catch(CDbException $e) {
           Yii::trace("ERROR " . $e->getMessage());
           echo $e->getMessage();
        }
    }

    /**
     *
     * Desanexar
     * This method does the unlink bettewen page and a specifis
     * image it uses a jQuery request
     *
     * The id is a page that will receive the picture selected
     *
     * @param result array
     *
     */
    public function desanexar(){

        $get_post = array();
        $get_post[0] = $_POST['slot'];
        $get_post['id'] = $_POST['id_page'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_gallery_update');

        try{
            $content = $this->imageManager->desattachContent($get_post);
        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Recontar
     * This method does a couting to retrieve a first slot empty
     * it uses a jQuery request
     *
     * The id_page is a page that will be counted
     *
     *
     */
    public function recontar(){

        $id = $_POST['id_page'];

        try{
            $content = $this->imageManager->getImageContent($id);
            $slot_empty[0] = $this->imageManager->verifyLastSlots($content);
            $slot_empty[1] = Yii::t('messageStrings', 'message_result_gallery_update');
            echo json_encode($slot_empty);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Recarregar
     *
     * It lists the all records with a specific category ID
     *
     * @param number id
     *
     */
    public function recarregar($id, $id_cat){

        $result = array();

        try{
            if($id_cat == ""){
                $result['content'] = $this->imageManager->getAllContent($id);
                $result['init'] = true;

            }else{
                $result['content'] = $this->imageManager->getContentByCat($id_cat);
                $result['init'] = false;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        $this->controller->renderPartial("pages/images/content/item_edit", $result);
    }


    /**
     *
     * RecarregarFancy
     *
     * Igual a de cima porem com algumas peculiaridades para funcionar em
     * um fancybox
     *
     * It lists the all records with a specific category ID
     *
     * @param number id
     *
     */
    public function recarregar_fancy($id, $id_cat, $isUser = true){

        $result = array();
        $session = MethodUtils::getSessionData();
        
        if($session['userImgType'] == "single") $isUser = $session['id'];

        try{
            if ($id_cat == ""){
                $result['content'] = $this->imageManager->getAllContent($id);
                $result['init'] = false;
                
            }else{
                $result['content'] = $this->imageManager->getContentByCat($id_cat);
                $result['init'] = true;
            }
            
            $result['id_page'] = false;
            $result['type_images'] = $_POST['type_images'];
            $result['is_user'] = $isUser;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        $this->controller->renderPartial("pages/images/content/item_simples", $result);
    }

    /*
     * Cool
     *
     * Mostra todas as imagens que já foram editadas
     * It's shows on the coolImages link from imagens listar
     *
     */
    public function cool($start){

        $result = array();

        $result['link'] = "";
        $result['stage_size'] = "img_landscape";
        $result['local'] = "img_landscape";
        $result['size'] = "";//t250 - t400 - t150
        $result['id_banner'] = "";
        $result['id_page'] = false;

        $result['title_dica'] = "Dica 21";
        $result['text_dica'] = "Dica 21";
        $result['link_dica'] = "Dica 21";     

        try{
            $result['content'] = $this->imageManager->getCoolContent();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/images/cool", $result);
    }

   /**
     *
     * Deletar
     * This method deletes the record using a jQuery request
     *
     */
    public function deletar() {

        $get_post = array();

        $get_post['id'] = $_POST['id'];        
        $get_post['image_name'] = $_POST['image_name'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_images_delete');

        try {
            $content = $this->imageManager->deleteContent($get_post);

        } catch(CDbException $e) {
          Yii::trace("ERROR " . $e->getMessage());
          echo $e->getMessage();
        }
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
        $result['type'] = $this->imageManager->getTypeFile($content);
        
        if($save){
            $session = MethodUtils::getSessionData();
            $data = array("image" => $content, "tipo" => 'playground', 'id_categoria' => 0, 'id_user' => $session['id'], 'data' => date('Ymd'));
            $result['save'] = $this->imageManager->addContent($data);  
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
    
    /**
     * Method resposible to apply the CSS and JAvascript layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($is_banner_maker = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Uploadfy: don't touch!
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.js', CClientScript::POS_BEGIN);
       
        //$cs->registerScriptFile($baseUrl . '/js/lib/upload/jquery.uploadify.v2.1.4.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/images.js', CClientScript::POS_BEGIN);
       
        //Funcionalidades de components html
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        
        if($is_banner_maker) $cs->registerCssFile($baseUrl    . '/css/site/content/special/purple/bannerMaker.css', 'screen', CClientScript::POS_HEAD);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>