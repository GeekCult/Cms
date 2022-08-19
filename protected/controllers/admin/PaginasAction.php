<?php

class PaginasAction extends CAction {
    
    private $pageHandler;
    private $action;
    private $id;    
    private $LIST = "list";
    private $NEW = "new";
    private $EDIT = "edit";
    private $TYPE = "pages";

    /**
     *
     * Páginas
     * Specific Admin Controller
     *
     */
    public function run() {       
        
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');        
        $this->pageHandler = new PaginasManager();

        switch($this->action){
            case "novo_curso":
            case "novo":
            case   ""  :
                $this->novo();
                break;

            case "editar":
            case "editar_curso":
                $this->editar();
                break;
            
            case "listar_curso":
                $this->listar_curso();
                break;
            
            case "listar":
                $this->listar();
                break;
            
            case "ocultas":
                $this->listar(true);
                break;
            
            case "hide":
                $this->ocultarPagina();
                break;
            
            case "cadastrar":
                $this->cadastrar();
                break;

            case "trocar":
                $this->trocar();
                break;

            case "alterar":
                $this->cadastrar();
                break;

            case "remover":
                $this->remover();
                break;

            case "definir":
                $this->definir();
                break;
            
            case "update_menu_selection":
                $this->updateMenuSelection();
                break;
            
            case "update_category":
                $this->updateCategory();
                break;
            
        }
    }

    /**
     *
     * It gets the record defined using the id value.
     * 
     * @param number
     *
     */
    public function editar(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
               
        $result = array();        
        
        $result['id_page'] = $this->id;
        $result['action'] = $this->action;
        
        if($this->action == "editar_curso"){ $ids = explode("-", $this->id);  $result['id_page'] = $ids[0];  $result['id_curso'] = $ids[1]; }

        try{            
            $result['content'] = $this->pageHandler->getContentById($this->id);
            $result['slots'] = $this->pageHandler->getSlotsById($this->id);
            $result['templates'] = $this->pageHandler->getLayoutTemplates($result['content']['tipo']);
            $result['id_user'] = ProdutosUtils::getModuleInformation($result['content']['id_user'], "id");//I won't be updated
            
            //Special properties for pages types
            $result['page_prop'] = PaginasUtils::getPagesSpecialProperties($result['id_page'], $result['content']['tipo']);
            
            if($this->action != "editar_curso")$result['attributes'] = PaginasUtils::retrieveAttributes($this->id);
            if($this->action == "editar_curso")$result['attributes'] = PaginasUtils::retrieveAttributes($result['id_page']);
            
            $result['dicas'] = DicasUtils::getTips($this->NEW, $this->TYPE);
        
            $this->addScript($result['content']['tipo']);        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/paginas/novo", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - editar() " . $e->getMessage();
        }       
    }


    /**
     *
     * It gets the pages content defined using the id product value.
     * 
     * @param number
     *
     */
    public function listar_curso(){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $result = array();  
        
        //Define wich of device must be work on.
        $session = MethodUtils::getSessionData();
        if($session['device'] == "") $session['device'] = 'desktop';
        $result['session'] = $session;
        
        $result['id_page'] = $this->id;
        $result['action'] = $this->action;

        try{    
            $result['curso'] = ProdutosUtils::getModuleInformation($this->id, "all");
            $result['content'] = PaginasUtils::getPagesContent($this->id, false, 0, true);
            
            $pack_info = ProdutosUtils::getViewByTypeBusiness(); 
            $result['dicas'] = DicasUtils::getTips($pack_info['list_tip'], $pack_info['tipo']);

            $this->addScript();        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/paginas/listar_elearn_pages", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /*
     * Nova página
     * 
     */
    public function novo(){

        $result = array();

        try{
            $result['content'] = $this->pageHandler->getContentClear();
            $result['action'] = $this->action;
            $result['slots'] = $this->pageHandler->getSlotsById($this->id);
            $result['id_page'] = $result['id_user'] = "";
            
            if($this->action == "novo_curso") {$result['content']['tipo'] = "elearn"; $result['id_user'] = $this->id;}
            
            $result['templates'] = $this->pageHandler->getLayoutTemplates($result['content']['tipo']);
            $result['attributes'] = PaginasUtils::retrieveAttributes($this->id);
            
            $result['page_prop'] = PaginasUtils::getPagesSpecialProperties($result['id_page'], $result['content']['tipo']);
            
            $result['dicas'] = DicasUtils::getTips($this->NEW, $this->TYPE);
        
            $this->addScript($result['content']['tipo']);        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/paginas/novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Listar
     * This method list all pages created.
     * There are simple pages and also blocked pages, this one can't
     * be deleted just edited.
     *
     */
    public function listar($isHidden = false){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        
        //Define wich of device must be work on.
        $session = MethodUtils::getSessionData();
        if($session['device'] == "") $session['device'] = 'desktop';
        
        $result = array();       
        $imagesHandler = new ImagesManager();
        $categoriasHandler = new CategoriaManager();

        try{
           $result['content'] = $this->pageHandler->getPagesInfoEdit($session, $isHidden);
           $result['categorias'] = $categoriasHandler->getAllContentById(2);
           
           //Handles visibility
            $result['is_hidden'] = $isHidden;

            $result['session'] = $session;
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);       

            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/paginas/listar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - listar() " . $e->getMessage();
        }       
    }

    /**
     *
     * Trocar
     * This method prepares the page's layout to be swamp
     * It doesn' has a table controlling the differents layout
     *
     */
    public function trocar(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
        $result = array();
  
        $result['item_choose'] = PreferencesUtils::getPageSelected($this->id);
        $result["id_page"] = $this->id;
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/paginas/trocar", $result);
    }

    /**
     *
     * Alterar
     * This method define a new layout into counteudo_paginas, it uses a
     * submited form from a jQuery request
     *
     */
    public function definir(){
        
        $data = array();
        $data[0] = $_POST['selected'];
        $data[1] = $_POST['id_page'];
        $data[2] = $_POST['controller'];         
        $data[3] = $_POST['special_page'];  

        $data['message'] = Yii::t("messageStrings", "message_result_layout_page_update");

        try{
            $content = $this->pageHandler->defineContent($data);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }


    /**
     *
     * Remover
     * This method removes the page's layout permanently
     *
     */
    public function remover(){

        $result = array();

        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t("messageStrings", "message_result_page_delete");
        
        try{
            $content = $this->pageHandler->deleteContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Ocultar
     * This method hides the page's layout
     *
     */
    public function ocultarPagina(){
        
        Yii::import('application.extensions.utils.HelperUtils');

        $result = array();

        $data['id'] = $_POST['id'];
        $data['status'] = $_POST['status'];
        
        try{
            $content = $this->pageHandler->setAttributeData('exibe', $data['status'], $data['id']);
            
            //$updateSiteMap = HelperUtils::createFeed('sitemap');
            echo $content;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar(){

        $data = array();
        $data[0] = $_POST['name'];
        $data[2] = $_POST['frase'];
        $data[3] = $_POST['index'];

        $data[4] = addslashes($_POST['frase']);

        $data[5] = addslashes($_POST['titulo_01']);
        $data[6] = addslashes($_POST['texto_01']);
        $data[7] = addslashes($_POST['titulo_02']);
        $data[8] = addslashes($_POST['texto_02']);
        $data[9] = addslashes($_POST['titulo_03']);
        $data[10] = addslashes($_POST['texto_03']);
        $data[11] = addslashes($_POST['titulo_04']);
        $data[12] = addslashes($_POST['texto_04']);
        $data[13] = addslashes($_POST['titulo_05']);
        $data[14] = addslashes($_POST['texto_05']);
        $data[15] = addslashes($_POST['titulo_06']);
        $data[16] = addslashes($_POST['texto_06']);
        
        $data['subtitulo_01'] = addslashes($_POST['subtitulo_01']);     
        $data['subtitulo_02'] = addslashes($_POST['subtitulo_02']);     
        $data['subtitulo_03'] = addslashes($_POST['subtitulo_03']);    
        $data['subtitulo_04'] = addslashes($_POST['subtitulo_04']);      
        $data['subtitulo_05'] = addslashes($_POST['subtitulo_05']);      
        $data['subtitulo_06'] = addslashes($_POST['subtitulo_06']);
        
        $data['label_link_01'] = $_POST['label_link_01'];      
        $data['label_link_02'] = $_POST['label_link_02'];      
        $data['label_link_03'] = $_POST['label_link_03'];
        $data['label_link_04'] = $_POST['label_link_04']; 
        $data['label_link_05'] = $_POST['label_link_05'];   
        $data['label_link_06'] = $_POST['label_link_06'];
        
        $data['link_01'] = $_POST['link_01'];       
        $data['link_02'] = $_POST['link_02'];      
        $data['link_03'] = $_POST['link_03'];      
        $data['link_04'] = $_POST['link_04'];      
        $data['link_05'] = $_POST['link_05'];      
        $data['link_06'] = $_POST['link_06'];
        $data['banner'] = $_POST['banner'];

        $data['slot_1'] = $_POST['slot_1'];        
        $data['slot_2'] = $_POST['slot_2'];        
        $data['slot_3'] = $_POST['slot_3'];        
        $data['slot_4'] = $_POST['slot_4'];        
        $data['slot_5'] = $_POST['slot_5'];        
        $data['slot_6'] = $_POST['slot_6'];        
        $data['slot_7'] = $_POST['slot_7'];        
        $data['slot_8'] = $_POST['slot_8'];        
        $data['slot_9'] = $_POST['slot_9'];        
        $data['slot_10'] = $_POST['slot_10']; 
        $data['icon'] = $_POST['icon'];
        
        //Dublin Core
        $data['dc_identificator'] = $_POST['dc_identificator']; 
        $data['dc_format'] = $_POST['dc_format']; 
        $data['dc_language'] = $_POST['dc_language']; 
        $data['dc_creator'] = $_POST['dc_creator']; 
        $data['dc_subject'] = $_POST['dc_subject']; 
        $data['dc_publisher'] = $_POST['dc_publisher']; 
        $data['dc_email'] = $_POST['dc_email']; 
        $data['dc_contributor'] = $_POST['dc_contributor']; 
        $data['dc_date'] = $_POST['dc_date']; 
        $data['dc_relation'] = $_POST['dc_relation']; 
        $data['dc_coverage'] = $_POST['dc_coverage']; 
        $data['dc_copyright'] = $_POST['dc_copyright']; 
        
        //Facebook
        (isset($_POST['fb_titulo'])) ? $data['fb_titulo'] = $_POST['fb_titulo'] : $data['fb_titulo'] = "";
        (isset($_POST['fb_texto'])) ? $data['fb_texto'] = $_POST['fb_texto'] : $data['fb_texto'] = "";
        (isset($_POST['fb_slot_1'])) ? $data['slot_fb_1'] = $_POST['fb_slot_1'] : $data['slot_fb_1'] = "";
        
        
        $data['id_page'] = $_POST['id_page'];  
        $data['special_page'] = $_POST['special_page'];
        $data['id_user'] = $_POST['id_user'];
        
        $data['controller'] = $_POST['controller'];  
        $data['layout'] = $_POST['layout'];
        (isset($_POST['modelo'])) ? $data['modelo'] = $_POST['modelo'] : $data['modelo'] = 0;
        $data['tipo'] = $_POST['tipo'];
        
        if($_POST['controller'] == "") $data['controller'] = "verticalbanner";
        if($_POST['layout'] == ""){if(Yii::app()->params['tecnologia'] == 0){$data['layout'] = "horizontal_banner";}else{$data['layout'] = "horizontal_banner_html5";}}
        
        $data['menu_principal'] = MethodUtils::getBooleanNumber($_POST['menu_principal']);
        $data['menu_2'] = MethodUtils::getBooleanNumber($_POST['menu_2']);
        $data['menu_3'] = MethodUtils::getBooleanNumber($_POST['menu_3']);
        $data['banner_exibe'] = MethodUtils::getBooleanNumber($_POST['banner_exibe']);
        $data['breadcrumb_exibe'] = MethodUtils::getBooleanNumber($_POST['breadcrumb_exibe']);
        $data['network_exibe'] = MethodUtils::getBooleanNumber($_POST['network_exibe']);
        $data['dica_exibe'] = MethodUtils::getBooleanNumber($_POST['dicas_exibe']);
        $data['video_1'] = $_POST['video_1'];
        $data['video_2'] = $_POST['video_2'];
        $data['video_3'] = $_POST['video_3'];
        $data['dica_titulo'] = $_POST['dica_titulo'];
        $data['dica_subtitulo'] = $_POST['dica_subtitulo'];
        $data['dica_texto'] = $_POST['dica_texto'];
        if(isset($_POST['link_special'])){$data['link_special'] = $_POST['link_special'];}else{$data['link_special'] = '';};
        if(isset($_POST['titulo_pagina'])){$data['titulo_pagina'] = $_POST['titulo_pagina'];}else{$data['titulo_pagina'] = '';};
        if(isset($_POST['galeria_usuarios'])){$data['galeria_usuarios'] = $_POST['galeria_usuarios'];}else{$data['galeria_usuarios'] = '';};
        
        $data['main_for_group'] = MethodUtils::getBooleanNumber($_POST['main_for_group']);
        $data['keywords'] = $_POST['keywords'];  
        
        //Verifica se tem video cadastrado
        $data['video_exibe'] = 0;
        if($_POST['video_1'] != "" || $_POST['video_2'] != "" || $_POST['video_3'] != "" )$data['video_exibe'] = 1;
        
        (isset($_POST['id_hotsite'])) ? $data['id_hotsite'] = $_POST['id_hotsite'] : $data['id_hotsite'] = 0;

        try{
            if($_POST['id_page'] == "" || $_POST['id_page'] == "0"){
                $data['return'] = true;
                $content = $this->pageHandler->submitContent($data);
            } else {   
                $content = $this->pageHandler->updateContent($data);
            }
            
            if($data['id_page'] == "") $data['id_page'] = Yii::app()->db->getLastInsertID();
            $setAttributes = PaginasUtils::defineAttributes($data);
     
            // Define pages properties
            $pageProperties = PaginasUtils::definePagesProperties($data['id_page']);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            echo Yii::t("messageStrings", "message_result_page_update");
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: PaginasAction - cadastrar() ' .$e->getMessage();
        }
    }
    
    /**
     *
     * Update menu selection
     * It's doing the same thing as banner_html does!
     *
     */
    public function updateMenuSelection(){

        $menu_type = $_POST['menu_type'];
        $status = $_POST['status'];
        $id_page = $_POST['id_page'];

        try{     
            $content = $this->pageHandler->setAttributeData($menu_type, $status, $id_page); 
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        echo $content;
    }
    
    /**
     *
     * Update category
     * It's doing the same method as banner_html does!
     *
     */
    public function updateCategory(){        
         
        $id_category = $_POST['id_category'];
        if($id_category == '') $id_category = 0;
        $id_page = $_POST['id_page'];
        $field = C::STR_ID_CATEGORY;

        try{             
            $content = $this->pageHandler->setAttributeData($field, $id_category, $id_page); 
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            echo $content;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
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
    public function addScript($tipo = false){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Funcionalidades de components html
        $cs->registerScriptFile($baseUrl . '/js/admin/paginas.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/extremos.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/bannerMaker.js', CClientScript::POS_BEGIN);
        
        if($tipo == 'fornecedor') $cs->registerScriptFile($baseUrl . '/js/admin/seja_fornecedor.js', CClientScript::POS_BEGIN);
        
        $cs->registerCssFile($baseUrl . '/css/lib/cool/cool_html.css', 'screen', CClientScript::POS_BEGIN); 
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}

?>