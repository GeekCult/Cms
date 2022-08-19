<?php

/**
 * Autor: CarlosGarcia
 * Date: 15/12/2010
 *
 * Texturas Class
 * Specific Class - Admin Action Texture
 *
 */
class TexturasAction extends CAction{
    
    private $textureHandler;
    private $loader;
    private $action;
    private $type;
    private $id;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run(){
        
        Yii::import('application.extensions.dbuzz.admin.TexturasManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.DicasUtils');
      
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->type = Yii::app()->getRequest()->getQuery('type');
        $this->id = Yii::app()->getRequest()->getQuery('id'); 
        $this->loader = explode("/", $_SERVER['REQUEST_URI']);
        
        $this->textureHandler = new TexturasManager();

        switch($this->action){

            case "novo":
            case   ""  :
                $this->novo();
                break;
            
            case "adicionar":
                $this->novo(true);
                break;
            
            case "cadastrar":
                $this->cadastrar();
                break;

            case "deletar":
                $this->deletar();
                break;

            case "editar":
                $this->editar();
                break;
            
            case "editar_user":
                $this->editar(true);
                break;

            case "listar":
                $this->listar();
                break;

            case "alterar":
                $this->cadastrar(true);
                break; 
            
            case "definir":
                $this->definir();
                break;
            
            case "exibir":
                $this->exibir();
                break;
            
            case "escolher":
                $this->escolher();
                break;
            
            case "salvar_escolher":
                $this->salvarEscolher();
                break;
            
            case "recarregar_fancy":
                $this->recarregar_fancy($this->id, $this->type);
                break;

            case "paginar_fancy_images":
                $this->paginar_fancy($this->id, $this->type);
                break;

            default :
                //$this->listar();
                break;
        }
    }

    /**
     *
     * Listar
     * List the main attributes and it opens the item list.
     *
     */
    public function listar(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        $result = array();
        $preferences = new MyPreferences();        

        //This if set a fake height to fix a bug with height
        //All textures are displayed with the same file view
        //The smaller ones have some problems with it.
        if($this->type != "menu" || $this->type != "botao"){
            $result['width_fake']= "120";
            $result['height_fake'] = "120";

        }else{
            $result['width_fake'] = "770";
            $result['height_fake'] = "80";
        }

        try{
            $settings = $preferences->getPreferences();
            $result['preferences'] = $settings;
            $type_choose = PreferencesUtils::getTextureSelected($this->type);
            $result['item_choose'] = PreferencesUtils::getPreferedItem($type_choose);
            
            $result['content'] = $this->textureHandler->getAllContent($this->type);            
            $result['content_user'] = $this->textureHandler->getAllContentUser($this->type);

            $result['title_texture'] = $this->type;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo  'ERROR: TExturasAction - listar() ' . $e->getMessage();
        } 
        
        $result['dicas'] = DicasUtils::getTips("list", "texturas");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/texturas/listar", $result);
    }

    /**
     * Novo
     *
     * It ignores the null id and it not retrieve data.
     *
     */
    public function novo($isUser = false){

        $result = array();         

        try{
            $result['content'] = $this->textureHandler->getContent(null);
            $result['title_texture'] = $this->type;
            $result['local'] = $this->type;
            $result['action'] = 'novo';
            $result['is_user'] = $isUser;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "texturas");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/texturas/novo", $result);
    }

    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar($isAlterar = false){

        $data = array();
        $data[0] = $_POST['title'];
        $data[1] = $_POST['file'];
        $data[2] = $_POST['tipo'];
        $data[3] = $_POST['color'];
        $data[4] = $_POST['local'];
        $data[5] = $_POST['action'];
        if($isAlterar) $data[5] = 'alterar';
        $data[6] = $_POST['id'];
        $data[7] = $_POST['is_user'];
        $data['message'] = Yii::t("messageStrings", "message_result_texture");
        
        if($data[5] == "alterar")$data['message'] = Yii::t("messageStrings", "message_result_texture_update");

        try{
            if(!$data[7] || $data[7] == '') $content = $this->textureHandler->submitContent($data);
            if( $data[7]) {
                $data_image = array("titulo" =>  $data[0], "foto"=> $data[1], "descricao" => 'Textura', 
                                    "id_categoria" => 0, "tipo" => 'textura', "data" => date('Ymd'), "id_user" => 0,
                                    "action" => $data[5], "local" => $data[4],"type_repeat" => $data[2], "cor" => $data[3], 'id' => $data[6]);
                
                $content = $this->textureHandler->submitUserContent($data_image);
            }

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Deletar
     * This method deletes the record using a jQuery request
     *
     */
    public function deletar(){

        $data = array();
        $data['id'] = $_POST['id'];
        $data['image_name'] = $_POST['image_name'];
        $data['local'] = $_POST['local'];
        $data['message'] = Yii::t("messageStrings", "message_result_texture_delete");

        try{
            $content = $this->textureHandler->deleteContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Editar
     * This method edits the record using a jQuery request
     *
     */
    public function editar($isUser = false){

        $result = array();        

        try{
            if(!$isUser) $result['content'] = $this->textureHandler->getContent($this->id);
            if( $isUser) $result['content'] = $this->textureHandler->getContentUser($this->id);
            $result['title_texture'] = $this->type;
            $result['local'] = $this->type;
            $result['action'] = 'editar';
            $result['is_user'] = $isUser;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "texturas");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/texturas/novo", $result);
    }

    /**
     *
     * Exibir
     * 
     * This method shows a textures into a fancybox display
     * 
     *
     */
    public function exibir(){
        
        Yii::import('application.extensions.utils.admin.TexturasUtils');

        try{
            $result['content'] = $this->textureHandler->getAllContentLimited($this->type);
            $result['attributes'] = TexturasUtils::getAttributes($this->type); 
            $result['local'] = $this->type;
            
            $this->controller->layout = "admin/admin_base";
            $this->controller->render("pages/texturas/exibir", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }       
    }
    
    /**
     *
     * Alterar
     * This method update the preferences table, it uses a
     * submited form using a jQuery request
     *
     */
    public function definir(){

        $data = array();
        $data[0] = $this->type;
        $data[1] = $_POST['selected'];
        $data[2] = $_POST['tipo'];
        $data[3] = $_POST['color'];
        $data['path'] = $_POST['path'];
        
        $data['message'] = Yii::t("messageStrings", "message_result_texture_update");

        try{
            $content = $this->textureHandler->updateContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Paginar Fancy
     * This method does the reloading items.
     * It loads a new sequency of images from the database
     *
     *
     * @param start number
     * @param idpag  number
     *
     */
    public function paginar_fancy($start, $type){
        
        Yii::import('application.extensions.utils.admin.TexturasUtils');

        $result = array();
        $result['id_page'] = 20;
        $result['init'] = true;
        $result['local'] = $type;

        try{
           $result['content'] = $this->textureHandler->getTransformedContent($start, $type);
           $result['attributes'] = TexturasUtils::getAttributes($type);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        $this->controller->renderPartial("pages/texturas/content/item_simples", $result);
    }
    
    /**
     *
     * Recarregar Fancy
     *
     * Igual ao de cima porem com algumas peculiaridades para funcionar em
     * um fancybox
     *
     * It lists the all records with a specific category ID
     *
     * @param number
     * @param number
     *
     */
    public function recarregar_fancy($id, $id_cat){

        $result = array();

        try{            
            $result['content'] = $this->textureHandler->getAllContentLimited($id_cat);
            $result['init'] = false;            

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        $this->controller->renderPartial("pages/texturas/content/item_simples", $result);
    }
    
    /**
     *
     * Escolher
     * Escolhe botoes para todos os tipos de usos.
     * São criado via css
     *
     */
    public function escolher(){

        $result = array();        

        try{
            
            $result['content'] = $this->textureHandler->getContentSpecial('button');
            $result['title_texture'] = $this->type;
            $result['local'] = $this->type;
            
            $result['dicas'] = DicasUtils::getTips("list", "texturas");
        
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/texturas/escolher_botao", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }       
    }
    
    /**
     *
     * Salvar Escolher
     *
     */
    public function salvarEscolher(){
       

        try{
            $data = array();   
            $data['type'] = $_POST['type'];
            $data['type_special'] = $_POST['type_special'];
            $data['main_button'] = $_POST['main_button'];
            $data['success_button'] = $_POST['success_button'];
            $data['second_button'] = $_POST['second_button'];
            
            $content = $this->textureHandler->updateContentSpecial($data);
            
            echo json_encode(array('MESSAGE' => Yii::t('messageStrings', 'message_result_success')));
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }       
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
    public function addScript(){
     
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Uploadfy: don't touch!
        //$cs->registerScriptFile($baseUrl . '/js/lib/jquery.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/texturas.js', CClientScript::POS_BEGIN);
          
    }
}
?>