<?php

class PaginasAdvancedAction extends CAction {
    
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
        
        Yii::import('application.extensions.utils.DicasUtils');
        Yii::import('application.extensions.utils.special.BlocksUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');        
        Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils');        

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
                $this->novo();
                break;
            
            case "mix":
                $this->novo(true);
                break;

            case "editar_mix":
                $this->novo(true);
                break;
            
            case "listar":
                $this->listar();
                break;
            
            case "apply_component":
                $this->applyComponent();
                break;
            
            case "load_block_properties":
                $this->loadBlockProperties();
                break;
            
            case "load_block_templates":
                $this->loadBlockTemplates();
                break;
            
            case "save_content":
                $this->saveContent();
                break;
            
            case "new_page":
                $this->newPage();
                break;
            
            case "exibe_row":
                $this->exibeRow();
                break;
            
            case "remove_block":
                $this->removeBlock();
                break;
            
            case "add_item_attribute":
                $this->addItemAttribute();
                break;
            
            case "load_item_attribute":
                $this->loadItemAttribute();
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
    public function novo($isMix = false){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
               
        $result = array();        
        
        $result['id_page'] = $this->id;
        $result['action'] = 'new_page';
        ($isMix) ? $result['modelo'] = 2 : $result['modelo'] = 1;
        
        try{            
             if($result['id_page'] != '') {
                $result['content'] = $this->pageHandler->getContentById($result['id_page']);
                $result['templates'] = $this->pageHandler->getLayoutBlockTemplates($result['content']['id']);
                $result['attributes'] = PaginasUtils::retrieveAttributes($result['content']['id']);
                $result['templates_paginas'] = $this->pageHandler->getLayoutTemplates($result['content']['tipo']);
                $result['slots'] = $this->pageHandler->getSlotsById($this->id);                
            }
            
            if($result['id_page'] == ''){
                $result['content'] = $this->pageHandler->getContentClear();
                $result['templates'] = false;
                $result['attributes'] = PaginasUtils::retrieveAttributes(0);
                $result['templates_paginas'] = $this->pageHandler->getLayoutTemplates('paginas');
                $result['slots'] = false; 
            }           
            
            $result['blocks'] = PaginasAdvancedUtils::getTemplateBlock(null, 'bloco_pagina', true);
            $result['page_prop'] = PaginasUtils::getPagesSpecialProperties($result['id_page'], $result['content']['tipo']);
                       
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - editar() " . $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips($this->NEW, $this->TYPE);
        
        $this->addScript();        
        $this->controller->layout = "admin/admin";
        
        if(!$isMix)$this->controller->render("pages/paginas/advanced", $result);
        if( $isMix)$this->controller->render("pages/paginas/mixed", $result);
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
        
        $data['id_pagina'] = $_POST['id_pagina'];
        $data['id_componente'] = $_POST['id_componente'];
        $data['message'] = Yii::t('messageStrings', 'message_result_component_added');
        
        $data['info'] = PaginasAdvancedUtils::getTemplateBlock($data['id_componente']);

        try{            
            $apply = PaginasAdvancedUtils::applyComponent($data);
            
            ($data['action'] == 'novo') ? $data['id'] = Yii::app()->db->getLastInsertID() : $data['id'] = '';
            
            $view = $this->controller->renderPartial('/admin/pages/paginas/content/item', $data, true);
            
            $result = array("message" => $data['message'], "result" => $apply, 'item' => $view, 'id' => $data['id']);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - applyComponent() " . $e->getMessage();
        }
    } 
    
    /**
     *
     * It applies a new component
     * 
     * @param number
     *
     */
    public function newPage(){
        
        $data = array();
        $data[0] = $_POST['name'];
        $data[2] = $_POST['frase'];
        $data[3] = $_POST['index'];

        $data[4] = addslashes($_POST['frase']);        
        
        (isset($_POST['titulo_01'])) ? $data[5] = addslashes($_POST['titulo_01']) : $data[5] = "";
        (isset($_POST['texto_01'])) ? $data[6] = addslashes($_POST['texto_01']) : $data[6] = "";
        (isset($_POST['titulo_02'])) ? $data[7] = addslashes($_POST['titulo_02']) : $data[7] = "";
        (isset($_POST['texto_02'])) ? $data[8] = addslashes($_POST['texto_02']) : $data[8] = "";
        (isset($_POST['titulo_03'])) ? $data[9] = addslashes($_POST['titulo_03']) : $data[9] = "";
        (isset($_POST['texto_03'])) ? $data[10] = addslashes($_POST['texto_03']) : $data[10] = "";
        (isset($_POST['titulo_04'])) ? $data[11] = addslashes($_POST['titulo_04']) : $data[11] = "";
        (isset($_POST['texto_04'])) ? $data[12] = addslashes($_POST['texto_04']) : $data[12] = "";
        (isset($_POST['titulo_05'])) ? $data[13] = addslashes($_POST['titulo_05']) : $data[13] = "";
        (isset($_POST['texto_05'])) ? $data[14] = addslashes($_POST['texto_05']) : $data[14] = "";
        (isset($_POST['titulo_06'])) ? $data[15] = addslashes($_POST['titulo_06']) : $data[15] = "";
        (isset($_POST['texto_06'])) ? $data[16] = addslashes($_POST['texto_06']) : $data[16] = "";
        
        (isset($_POST['subtitulo_01'])) ? $data['subtitulo_01'] = addslashes($_POST['subtitulo_01']) : $data['subtitulo_01'] = "";
        (isset($_POST['subtitulo_02'])) ? $data['subtitulo_02'] = addslashes($_POST['subtitulo_02']) : $data['subtitulo_02'] = "";
        (isset($_POST['subtitulo_03'])) ? $data['subtitulo_03'] = addslashes($_POST['subtitulo_03']) : $data['subtitulo_03'] = "";
        (isset($_POST['subtitulo_04'])) ? $data['subtitulo_04'] = addslashes($_POST['subtitulo_04']) : $data['subtitulo_04'] = "";
        (isset($_POST['subtitulo_05'])) ? $data['subtitulo_05'] = addslashes($_POST['subtitulo_05']) : $data['subtitulo_05'] = "";
        (isset($_POST['subtitulo_06'])) ? $data['subtitulo_06'] = addslashes($_POST['subtitulo_06']) : $data['subtitulo_06'] = "";
        
        (isset($_POST['label_link_01'])) ? $data['label_link_01'] = addslashes($_POST['label_link_01']) : $data['label_link_01'] = "";
        (isset($_POST['label_link_02'])) ? $data['label_link_02'] = addslashes($_POST['label_link_02']) : $data['label_link_02'] = "";
        (isset($_POST['label_link_03'])) ? $data['label_link_03'] = addslashes($_POST['label_link_03']) : $data['label_link_03'] = "";
        (isset($_POST['label_link_04'])) ? $data['label_link_04'] = addslashes($_POST['label_link_04']) : $data['label_link_04'] = "";
        (isset($_POST['label_link_05'])) ? $data['label_link_05'] = addslashes($_POST['label_link_05']) : $data['label_link_05'] = "";
        (isset($_POST['label_link_06'])) ? $data['label_link_06'] = addslashes($_POST['label_link_06']) : $data['label_link_06'] = "";
        
        (isset($_POST['link_01'])) ? $data['link_01'] =$_POST['link_01'] : $data['link_01'] = "";
        (isset($_POST['link_02'])) ? $data['link_02'] =$_POST['link_02'] : $data['link_02'] = "";
        (isset($_POST['link_03'])) ? $data['link_03'] =$_POST['link_03'] : $data['link_03'] = "";
        (isset($_POST['link_04'])) ? $data['link_04'] =$_POST['link_04'] : $data['link_04'] = "";
        (isset($_POST['link_05'])) ? $data['link_05'] =$_POST['link_05'] : $data['link_05'] = "";
        (isset($_POST['link_06'])) ? $data['link_06'] =$_POST['link_06'] : $data['link_06'] = "";
        
        (isset($_POST['banner'])) ? $data['banner'] = $_POST['banner'] : $data['banner'] = "";
        (isset($_POST['slot_1'])) ? $data['slot_1'] = $_POST['slot_1'] : $data['slot_1'] = "";
        (isset($_POST['slot_2'])) ? $data['slot_2'] = $_POST['slot_2'] : $data['slot_2'] = "";
        (isset($_POST['slot_3'])) ? $data['slot_3'] = $_POST['slot_3'] : $data['slot_3'] = "";
        (isset($_POST['slot_4'])) ? $data['slot_4'] = $_POST['slot_4'] : $data['slot_4'] = "";
        (isset($_POST['slot_5'])) ? $data['slot_5'] = $_POST['slot_5'] : $data['slot_5'] = "";
        (isset($_POST['slot_6'])) ? $data['slot_6'] = $_POST['slot_6'] : $data['slot_6'] = "";
        (isset($_POST['slot_7'])) ? $data['slot_7'] = $_POST['slot_7'] : $data['slot_7'] = "";
        (isset($_POST['slot_8'])) ? $data['slot_8'] = $_POST['slot_8'] : $data['slot_8'] = "";
        (isset($_POST['slot_9'])) ? $data['slot_9'] = $_POST['slot_9'] : $data['slot_9'] = "";
        (isset($_POST['slot_10'])) ? $data['slot_10'] =$_POST['slot_10'] : $data['slot_10'] = "";
        (isset($_POST['icon'])) ? $data['icon'] =$_POST['icon'] : $data['icon'] = "";
        
        //Facebook
        (isset($_POST['fb_titulo'])) ? $data['fb_titulo'] = $_POST['fb_titulo'] : $data['fb_titulo'] = "";
        (isset($_POST['fb_texto'])) ? $data['fb_texto'] = $_POST['fb_texto'] : $data['fb_texto'] = "";
        (isset($_POST['fb_slot_1'])) ? $data['slot_fb_1'] = $_POST['fb_slot_1'] : $data['slot_fb_1'] = "";
        
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
        
        $data['id_page'] = $_POST['id_page'];  
        $data['special_page'] = $_POST['special_page'];
        $data['id_user'] = $_POST['id_user'];
        
        $data['tipo'] = $_POST['tipo'];
        $data['modelo'] = $_POST['modelo'];
        
        (!isset($_POST['controller']) || $_POST['controller'] == "") ? $data['controller'] = "verticalbanner" : $data['controller'] = $_POST['controller'];
        (!isset($_POST['layout']) || $_POST['layout'] == "") ? $data['layout'] = "general_advanced_html5" : $data['layout'] = $_POST['layout'];
        
        $data['menu_principal'] = MethodUtils::getBooleanNumber($_POST['menu_principal']);
        $data['menu_2'] = MethodUtils::getBooleanNumber($_POST['menu_2']);
        $data['menu_3'] = MethodUtils::getBooleanNumber($_POST['menu_3']);
        $data['banner_exibe'] = MethodUtils::getBooleanNumber($_POST['banner_exibe']);
        $data['breadcrumb_exibe'] = MethodUtils::getBooleanNumber($_POST['breadcrumb_exibe']);
        $data['network_exibe'] = MethodUtils::getBooleanNumber($_POST['network_exibe']);
        $data['dica_exibe'] = MethodUtils::getBooleanNumber($_POST['dicas_exibe']);
        $data['video_1'] = "";
        $data['video_2'] = "";
        $data['video_3'] = "";
        $data['dica_titulo'] = $_POST['dica_titulo'];
        $data['dica_subtitulo'] = $_POST['dica_subtitulo'];
        $data['dica_texto'] = $_POST['dica_texto'];
        
        if(isset($_POST['link_special'])){$data['link_special'] = $_POST['link_special'];}else{$data['link_special'] = '';};
        if(isset($_POST['titulo_pagina'])){$data['titulo_pagina'] = $_POST['titulo_pagina'];}else{$data['titulo_pagina'] = '';};
        if(isset($_POST['galeria_usuarios'])){$data['galeria_usuarios'] = $_POST['galeria_usuarios'];}else{$data['galeria_usuarios'] = '';};
        
        $data['main_for_group'] = MethodUtils::getBooleanNumber($_POST['main_for_group']);
        $data['keywords'] = $_POST['keywords']; 
        $data['return'] = true;
        
        //Verifica se tem video cadastrado
        $data['video_exibe'] = 0;
        $data['message'] = Yii::t('messageStrings', 'message_result_page');
        
        (isset($_POST['id_hotsite'])) ? $data['id_hotsite'] = $_POST['id_hotsite'] : $data['id_hotsite'] = 0;
      

        try{
            if($_POST['id_page'] == "" || $_POST['id_page'] == "0"){
                $content = $this->pageHandler->submitContent($data);
            }else{                
                $content = $this->pageHandler->updateContent($data);
            }
            
            if($data['id_page'] == "") $data['id_page'] = Yii::app()->db->getLastInsertID();

            // Define pages properties
            $setAttributes = PaginasUtils::defineAttributes($data);
            $pageProperties = PaginasUtils::definePagesProperties($data['id_page']); 
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            $result = array("message" => $data['message'], "id_page" => $data['id_page']);
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: PaginasAction - cadastrar() ' .$e->getMessage();
        }
 
    } 
    
    /**
     *
     * It removes a record from the data base
     * 
     *
     */
    public function removeBlock(){      
        
        $id = $_POST['id'];

        try{            
             $remove = PaginasAdvancedUtils::deleteContent($id);            
            
             echo Yii::t('messageStrings', 'message_result_component_delete');
             
             $updateDataJson = MethodUtils::updateDominioData();
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - removeBlock() " . $e->getMessage();
        }
    } 
    
    
    /**
     *
     * It change status exibe row
     * 
     *
     */
    public function exibeRow(){      

        try{            
            $exibe = PaginasAdvancedUtils::updateRow($_POST['id'], $_POST['value'], $_POST['type']);
            
            echo Yii::t('messageStrings', 'message_result_component_updated'); 
            
            $updateDataJson = MethodUtils::updateDominioData();
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAction - exibeRow() " . $e->getMessage();
        }
    } 
    
    /**
     *
     * It saves the content for each block
     * 
     *
     */
    public function saveContent(){      
        
        $data['id_componente'] = $_POST['id_componente'];
        $data['id_page'] = $_POST['id_page'];
        $data['id_row'] = $_POST['id_row'];
        
        $data['info'] = PaginasAdvancedUtils::getTemplateBlock($data['id_componente']);

        try{ 
            $data['content'] = BlocksUtils::saveComponentContent($data);
            
            $updateDataJson = MethodUtils::updateDominioData();
            
            $result = array('message' => Yii::t('messageStrings', 'message_result_content_updated'));             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAdvancedAction - saveContent() " . $e->getMessage();
        }
    }
    
    /**
     *
     * It block template
     * 
     */
    public function loadBlockTemplates(){      
        
        $id = $_POST['id_row'];
        $data['id_page'] = $_POST['id_pagina'];
        
        try{ 
            if($id != '' && $id != 0){
                $data['item']     = PaginasAdvancedUtils::getItemContent($id);
                $data['detalhes'] = PaginasAdvancedUtils::getTemplateBlock($data['item']['id_componente']);
                $data['blocks']   = PaginasAdvancedUtils::getTemplateBlock($id, 'bloco_pagina', true);
            
            }else{ 
                $data['item'] = false;
                $data['detalhes'] = PaginasAdvancedUtils::getTemplateBlock(186);
                $data['blocks']   = PaginasAdvancedUtils::getTemplateBlock($id, 'bloco_pagina', true);
            }
            
            $data['templates'] = $this->controller->renderPartial('/admin/pages/paginas/content/item_blocks', $data, true);
            $data['detalhes'] = $this->controller->renderPartial('/admin/modulos/' . $data['detalhes']['modelo'] . '/' . $data['detalhes']['cool'], $data, true);
            
            $result = array('item' => $data['item'], 'view_template' => $data['templates'], 'view_detalhes' => $data['detalhes']);             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAdvancedAction - loadBlockTemplates() " . $e->getMessage();
        }
    }
    
    /**
     *
     * It adds a new attribute to a componente
     * 
     *
     */
    public function addItemAttribute(){      
        
        //More data
        if(isset($_POST['id'])) $data['id'] = $_POST['id'];else $data['id'] = 0;
        if(isset($_POST['n_index'])) $data['n_index'] = $_POST['n_index'];else $data['n_index'] = 0;
        if(isset($_POST['tipo_item'])) $data['tipo_item'] = $_POST['tipo_item'];else $data['tipo_item'] = 0;
        
        $data['tipo'] = $_POST['tipo'];
        $data['id_componente'] = $_POST['id_componente'];
        $data['id_pagina'] = $_POST['id_page'];
        $data['id_row'] = $_POST['id_row'];
        $data['action'] = $_POST['action'];
        $data['field1'] = $_POST['field1'];
        $data['field2'] = $_POST['field2'];
        $data['field3'] = $_POST['field3'];
        $data['field4'] = $_POST['field4'];
        $data['field5'] = $_POST['field5'];
        
        (isset($_POST['number1'])) ? $data['number1'] = $_POST['number1'] : $data['number1'] = 0;
        (isset($_POST['number2'])) ? $data['number2'] = $_POST['number2'] : $data['number2'] = 0;
        (isset($_POST['number3'])) ? $data['number3'] = $_POST['number3'] : $data['number3'] = 0;
        (isset($_POST['number4'])) ? $data['number4'] = $_POST['number4'] : $data['number4'] = 0;
        (isset($_POST['number5'])) ? $data['number5'] = $_POST['number5'] : $data['number5'] = 0;
        
        $view = "";

        try{ 
            $set = BlocksUtils::addItemAttribute($data);
            
            //$updateDataJson = MethodUtils::updateDominioData();
            if($data['tipo'] == 'tabela'){
                $recordset['items'] = PaginasAdvancedUtils::getItemsAttributes($data['id_componente'], $data['id_row'], $data['id_pagina']);
                $view = $this->controller->renderPartial("/admin/modulos/tabela/content/item_tabela", $recordset, true);
            }
            
            $result = array('message' => Yii::t('messageStrings', 'message_result_content_updated'), 'result' => $set, "view" => $view);             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAdvancedAction - addAttribute() " . $e->getMessage();
        }
    }
    
    /**
     *
     * It loads a new attribute to a componente
     * 
     *
     */
    public function loadItemAttribute(){      
        
        $data['id'] = $_POST['id'];
       
        try{       
            $recordset = PaginasAdvancedUtils::getItemAttribute($data['id']);
                
            $result = array('result' => $recordset);             
            echo json_encode($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: PaginasAdvancedAction - addAttribute() " . $e->getMessage();
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
        
        //Funcionalidades de components html
        $cs->registerScriptFile($baseUrl . '/js/admin/paginas_advanced.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        //$cs->registerScriptFile($baseUrl . '/js/admin/extremos.js', CClientScript::POS_BEGIN);
        //$cs->registerScriptFile($baseUrl . '/js/admin/bannerMaker.js', CClientScript::POS_BEGIN);
        
        $cs->registerCssFile($baseUrl . '/css/lib/cool/cool_html.css', 'screen', CClientScript::POS_BEGIN);  
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}

?>