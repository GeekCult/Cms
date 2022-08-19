<?php

/**
 * Autor: CarlosGarcia
 * Date: 12/12/2010
 *
 * Matéria Class
 * Specific Class - Admin Controller
 *
 */
class MateriasAction extends CAction {
    
    public  $controllerIDHandler;
    public  $categoriaHandler;
    private $materiasHandler;   
    private $controllers;
    private $action;
    private $id;    

    /**
     * Run
     * Launcher method
     *
     */
    public function run() {
       
        Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils'); 
        Yii::import('application.extensions.utils.special.TemplatesUtils');
        Yii::import('application.extensions.dbuzz.admin.MateriasManager');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');        
        Yii::import('application.extensions.utils.MateriasUtils');
        Yii::import('application.extensions.utils.DicasUtils');
        
        //Verifica se é Notícia, Coluna ou Blog
        $this->controllers = explode("/", $_SERVER['REQUEST_URI']);        
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');        
        
        $this->materiasHandler = new MateriasManager();        
        $this->categoriaHandler = new CategoriaManager();        
        $this->controllerIDHandler = new PaginasManager();

        switch($this->action){
            
            case "":
            case "novo":            
            case "editar":
                $this->novo();
                break;

            case "listar":
                $this->listar();
                break;
            
            case "todos":
                $this->listar(true);
                break;
            
            case "cadastrar":
            case "alterar":
                $this->cadastrar();
                break;
            
            case "deletar":
                $this->deletar();
                break;
            
            case "createfeed":
                $this->createFeed();
                break;
            
            /* Templates */
            case "create_template":
                $this->createTemplate();
                break;
            
            case "apply_component":
                $this->applyComponent();
                break;
            
            case "load_block_templates":
                $this->loadBlockTemplates();
                break;
            
            case "exibe_row":
                $this->exibeRow();
                break;
            
            case "delete_block":
                $this->deleteBlock();
                break;
            
            case "save_content":
                $this->saveContent();
                break;
            
            case "comentarios":
                $this->comentarios(0);
                break;
            
            case "comentarios_aprovados":
                $this->comentarios(1);
                break;
            
            default:
                echo "ERROR: Action not found!";
                break;
        }
    }
    
    /**
     *
     * Novo
     * It adds a new record into database.
     * It uses a id 0 record to simulate some fake data.
     * It is used just to avoid unecessary codes.
     *
     */
    public function novo(){

        try{
            $result['page_attributes'] =  $this->controllerIDHandler->getContentControllerByLabel($this->controllers[2]);
            $result['categorias'] = $this->categoriaHandler->getAllContentById($result['page_attributes']);
            $result['session'] = MethodUtils::getSessionData();
            
            if($this->action == 'novo'){
                $result['content'] = $this->materiasHandler->getContentEmpty();
                $result['slots'] = $this->controllerIDHandler->getSlotsById("0");
                $result['attributes'] = MateriasUtils::getProperties($this->controllers[2], $this->action, $result['page_attributes'], '');
                $result['templates'] = false; 
            }
            
            if($this->action == 'editar'){                
                $result['content'] = $this->materiasHandler->getContentById($this->id);  
                $result['template_info'] = TemplatesUtils::getTemplatesInfo($this->id, 'materias');
                $result['slots'] = $this->materiasHandler->getPictureArticleById($this->id, true);
                $result['attributes'] = MateriasUtils::getProperties($this->controllers[2], "editar", $result['page_attributes'], $this->id);
                if($result['template_info']){$result['templates'] = TemplatesUtils::getLayoutBlockTemplates($result['template_info']['id']);}else{$result['templates'] = false;}
            }

            if($this->controllers[2] == "colunas"){
               $result['colunistas'] = $this->materiasHandler->getWriters();
            }
            
            //Materias avancadas
            $result['blocks'] = PaginasAdvancedUtils::getTemplateBlock(null, 'bloco_materia', true);  
            $result['sidemenu'] = HelperUtils::adminUtils("{$this->controllers[2]}/novo");
            
            $result['dicas'] = DicasUtils::getTips(C::VAR_NEW, C::ARTICLES);

            $this->addScript();        
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/materias/" . Yii::app()->params['admin_content'] . "novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - novo()', 'trace' => $e->getMessage()), true);
            echo "ERROR " . $e->getMessage();
        }       
    }
    
    /**
     *
     * Listar
     * List the main atrributes and it opens the select item list.
     * Just select one of it to edit.
     *
     */
    public function listar($isAll = false) {

        $session = MethodUtils::getSessionData();

        $result['year'] = date('Y');
        if (isset($session['materias_year'])) $result['year'] = $session['materias_year'];
        $result['month'] = date('m');
        if (isset($session['materias_month'])) $result['month'] = $session['materias_month'];
        $result['day'] = date('d');
        if (isset($session['materias_day'])) $result['day'] = $session['materias_day'];

        try {
            $result['years'] =  $this->materiasHandler->getAllYears($this->controllers[2]);
            $result['months'] = $this->materiasHandler->getAllMonths($result['year'], $this->controllers[2]);
            $result['days'] =   $this->materiasHandler->getAllDays($result['year'], $result['month'], $this->controllers[2]);
            
            if(!$isAll) $result['content'] = $this->materiasHandler->getAllContent($this->controllers[2], false, $result['year'], $result['month'], $result['day']);
            if( $isAll) $result['content'] = $this->materiasHandler->getAllContent($this->controllers[2], null, null, null, null, true);
            
            $result['attributes'] = MateriasUtils::getAttributes($this->controllers[2]);
            $result['status'] = $isAll;
            $result['session'] = $session;
            
            $result['sidemenu'] = HelperUtils::adminUtils("{$this->controllers[2]}/listar");
            $result['dicas'] = DicasUtils::getTips(C::VAR_LIST, C::ARTICLES);

            $this->addScript();
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/materias/". Yii::app()->params['admin_content'] . "listar", $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - listar()', 'trace' => $e->getMessage()), true);
            echo "ERROR " . $e->getMessage();
        }
    }


    /**
     *
     * Cadastrar and alterar method
     * 
     * This method does the submit and update the articles form using a jQuery request
     *
     */
    public function cadastrar(){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        $data = array();
        
        $data['id_article'] = $_POST['id_article'];
        $data['local'] = $_POST['local'];
        $data[0] = addslashes($_POST['title']);
        $data[1] = addslashes($_POST['materia']);
        $data[2] = $_POST['keywords'];
        $data[3] = date('Ymd');        
        $data[4] = $_POST['slot_1'];        
        $data[5] = addslashes($_POST['subtitulo']);        
        $data[6] = $_POST['tipo'];        
        $data[7] = $_POST['id_colunista'];
        $data[8] = $_POST['id_categoria'];  
        $data[9] = date('Ymd');
        $data[10] = $_POST['link_special'];
        $data['url'] = StringUtils::StringToUrl($_POST['title'], true, '-');
        
        //Facebook
        (isset($_POST['fb_titulo'])) ? $data['fb_titulo'] = $_POST['fb_titulo'] : $data['fb_titulo'] = "";
        (isset($_POST['fb_texto'])) ? $data['fb_texto'] = $_POST['fb_texto'] : $data['fb_texto'] = "";
        (isset($_POST['fb_slot_1'])) ? $data['slot_fb_1'] = $_POST['fb_slot_1'] : $data['slot_fb_1'] = "";
        
        //News
        $data['destaque'] = $_POST['destaque'];
        $data['chamada'] = $_POST['chamada'];
        $data['modelo'] = $_POST['modelo'];
        $data['cor'] = $_POST['cor'];
        $data['exibe'] = MethodUtils::getBooleanNumber($_POST['exibe']);
        
        //If it's a 'novidade'
        if($_POST['data_article'] != "")$data[9] = DateTimeUtils::setFormatDateNoTime($_POST['data_article']);   

        try{
            if($_POST['id_article'] == "" || $_POST['id_article'] == "0"){                
                $data['message'] = Yii::t("messageStrings", 'message_result_article');
                $content = $this->materiasHandler->submitContent($data);
            }else{  
                $data['message'] = Yii::t("messageStrings", 'message_result_article_update');
                $content = $this->materiasHandler->updateContent($data);
            }
                    
            $createRSSFeed = HelperUtils::createFeed(C::ARTICLES);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            $error = array("ERROR" =>  1, "message" => $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - cadastrar()', 'trace' => $e->getMessage()), true);
            echo json_encode($error);
        }
    }

    /**
     *
     * Deletar
     * This method deletes the selected record using a jQuery request
     *
     */
    public function deletar(){
        $data = array();
        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t("messageStrings", 'message_result_article_delete');

        try{
            $content = $this->materiasHandler->deleteContent($data);
            
            //Clear from porpular
            $clearPoPular = ActivityLogger::removeFromLog(null, null, '/noticias/listar/' . $data['id']);
            $clearPoPular = ActivityLogger::removeFromLog(null, null, '/blog/listar/' . $data['id']);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - deletar()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }
    }  
  
    
    /**
     *
     * It applies a new component
     * 
     * @param number
     *
     */
    public function applyComponent(){
               
        $result = array();
        
        $data['slots'] = $_POST['slots'];
        $data['action'] = $_POST['action'];
        $data['layout'] = $_POST['layout'];
        $data['n_index'] = $_POST['n_index'];        
        
        $data['id_template'] = $_POST['id_template'];
        $data['id_componente'] = $_POST['id_componente'];
        $data['message'] = Yii::t('messageStrings', 'message_result_component_added');
        
        $data['info'] = TemplatesUtils::getTemplateBlock($data['id_componente']);

        try{            
            $apply = TemplatesUtils::applyComponent($data);
            
            ($data['action'] == 'novo') ? $data['id'] = Yii::app()->db->getLastInsertID() : $data['id'] = '';
            
            $view = $this->controller->renderPartial('/admin/pages/paginas/content/item', $data, true);
            
            $result = array("message" => $data['message'], "result" => $apply, 'item' => $view, 'id' => $data['id']);
             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - applyComponent()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - applyComponent() " . $e->getMessage();
        }
    } 
    
    /**
     *
     * It block template
     * 
     */
    public function loadBlockTemplates(){      
        
        $id = $_POST['id_row'];
        $data['id_template'] = $_POST['id_template'];
        $data['template_type'] = 'bloco_materia';
        
        try{ 
            if($id != '' && $id != 0){
                $data['item']     = TemplatesUtils::getItemContent($id);
                $data['detalhes'] = TemplatesUtils::getTemplateBlock($data['item']['id_componente']);
                $data['blocks']   = TemplatesUtils::getTemplateBlock($id, $data['template_type'], true);
            
            }else{ 
                $data['item'] = false;
                $data['detalhes'] = TemplatesUtils::getTemplateBlock(235);
                $data['blocks']   = TemplatesUtils::getTemplateBlock($id, 'bloco_materia', true);
            }
            
            $data['templates'] = $this->controller->renderPartial('/admin/modulos/materias/item_blocks', $data, true);
            $data['detalhes'] = $this->controller->renderPartial('/admin/modulos/' . $data['detalhes']['modelo'] . '/' . $data['detalhes']['cool'], $data, true);
            
            $result = array('item' => $data['item'], 'view_template' => $data['templates'], 'view_detalhes' => $data['detalhes']);             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - loadBlocktemplates()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - loadBlockTemplates() " . $e->getMessage();
        }
    }
    
    /**
     *
     * It saves the content for each block
     * 
     *
     */
    public function saveContent(){ 
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');
        
        $data['id_componente'] = $_POST['id_componente'];
        $data['id_template'] = $_POST['id_template'];
        $data['id_row'] = $_POST['id_row'];
        
        $data['info'] = TemplatesUtils::getTemplateBlock($data['id_componente']);

        try{ 
            $data['content'] = BlocksTemplatesUtils::saveComponentContent($data);
            
            $result = array('message' => Yii::t('messageStrings', 'message_result_content_updated'));             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - saveContent()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - saveContent() " . $e->getMessage();
        }
    }
    
    /**
     * It removes a record from the data base
     * 
     */
    public function deleteBlock(){      
       
        try{            
            $remove = TemplatesUtils::deleteComponent($_POST['id']);
            echo Yii::t('messageStrings', 'message_result_component_delete');     
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - deleteBlock()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - deleteBlock() " . $e->getMessage();
        }
    } 
    
    /**
     * It change status exibe row
     * 
     */
    public function exibeRow(){      

        try{            
            $exibe = TemplatesUtils::updateRow($_POST['id'], $_POST['value'], $_POST['type']);
            echo Yii::t('messageStrings', 'message_result_component_updated');     
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - exibeRow()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - exibeRow() " . $e->getMessage();
        }
    } 
    
    /**
     * It creates a new template
     * 
     */
    public function createTemplate(){     

        try{            
            $id = TemplatesUtils::createTemplate($_POST['id_article'], 'materias');
            echo json_encode(array('id' =>$id));     
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - createTemplate()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MateriasAction - createTemplate() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Comentarios
     * 
     * This method list the comments from de database
     *
     */
    public function comentarios($status = 0){  
        
        Yii::import('application.extensions.utils.CommentsUtils');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
          
        $commentsHandler = new ComentariosManager(); 

        $result = array();
        
        $data['id'] = 0;     
        $data['categoria'] = $status;       
        $data['tipo'] = 'materias';
        $tipo = "materias' OR tipo = 'blog' OR tipo = 'materia' OR tipo = 'wiki' OR tipo = 'novidades";
        
        try{
            $result['content'] = $commentsHandler->getAllAdminComments($data, $tipo);
            $result['tipo'] = $tipo;
            $result['status'] = $status;
            
            $result['session'] = MethodUtils::getSessionData();
            $result['sidemenu'] = HelperUtils::adminUtils("materias/comentarios");
            $result['dicas'] = DicasUtils::getTips(C::VAR_LIST, C::ARTICLES);
        
            $this->addScript("comentarios");
            $this->controller->layout = "admin/admin"  . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/materias/". Yii::app()->params['admin_content'] . "comentarios", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - MateriasAction - comentarios()', 'trace' => $e->getMessage()), true);
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
    public function addScript($type = 'materias'){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();        
        
        //Funcionalidades javascript
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END);
        
        if($type == 'materias'){ (Yii::app()->params['admin_versao'] == '2') ? $cs->registerScriptFile($baseUrl . '/js/admin/materias.js', CClientScript::POS_END) : $cs->registerScriptFile($baseUrl . '/js/admin/materias.js', CClientScript::POS_BEGIN); }
        if($type == 'comentarios'){ (Yii::app()->params['admin_versao'] == '2') ? $cs->registerScriptFile($baseUrl . '/js/admin/comentarios.js', CClientScript::POS_END) : $cs->registerScriptFile($baseUrl . '/js/admin/comentarios.js', CClientScript::POS_BEGIN);}
        
        if(Yii::app()->params['admin_versao'] == '2'){            
            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);
        }
        
        $cs->registerCssFile($baseUrl . '/css/lib/cool/cool_html.css', 'screen', CClientScript::POS_HEAD);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>