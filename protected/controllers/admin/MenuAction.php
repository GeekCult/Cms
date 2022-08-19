<?php

class MenuAction extends CAction{
    
    private $action;
    private $menuHandler;
    private $id;

    /**
     * Downloads
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        Yii::import('application.extensions.dbuzz.admin.special.MenuManager');
        Yii::import('application.extensions.utils.DicasUtils');
        Yii::import('application.extensions.dbuzz.DBManager');
        
        $this->menuHandler = new MenuManager();

        switch($this->action){

            case "editar":
            case   ""  :
                $this->editar();
                break;
            
            case "salvar":
                $this->salvar();
                break;
            
            case "salvar_preferences":
                $this->salvarPreferencias();
                break;
            
            //Menu special
            case "criar_menu":
                $this->criar();
                break;
            
            case "editar_menu":
                $this->criar('editar');
                break;
            
            case "criar_categoria":
                $this->criar();
                break;
            
            case "editar_categoria":
                $this->criar('editar');
                break;
            
            case "criar_item":
                $this->criar();
                break;
            
            case "editar_item":
                $this->criar('editar');
                break;
            
            case "listar_menu"  :
                $this->listar('menu_container');
                break;
            
            case "listar_categorias"  :
                $this->listar('menu_categoria');
                break;
            
            case "listar_items"  :
                $this->listar('menu_item');
                break;
            
            case "salvar_menu"  :
                $this->salvarMenu();
                break;
            
            case "remover_menu"  :
                $this->deletar();
                break;
        }
    }
    
    /**
     *
     * Criar
     * Edits the Menu properties.
     *
     */
    public function criar($action = 'novo'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{
            if($action == 'novo') $result['content'] = array('id_row' => $this->id, 'id_menu' => $this->id, 'tipo' => 'menu_container', 'titulo' => '', 'descricao' => '', 'id' => '', 'link_special' => '');
            if($action == 'editar') $result['content'] = $this->menuHandler->getContentById($this->id);;
            
            $view = $this->menuHandler->getView($this->action);
            $result['action'] = $action;
            
            $result['id'] = $this->id;
            $result['session'] = MethodUtils::getSessionData();
            
            $result['dicas'] = DicasUtils::getTips("new", "menu_special");
        
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/menu/" . $view, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        } 
    }
    
    /**
     *
     * Listar
     *
     * @param string
     *
     */
    public function listar($type) {


        try{
            $result['content'] = $this->menuHandler->getAllContentByType($type, $this->id);
            $result['id'] = $this->id;
            
            if($type == 'menu_categoria') MethodUtils::setSessionData('id_Mcontainer', $this->id);
            $result['session'] = MethodUtils::getSessionData();
            
            $result['dicas'] = DicasUtils::getTips("list", "menu_special");

            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/menu/" . $this->action, $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: MenuAction - listar() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar Menu
     *
     */
    public function salvarMenu(){

        try{
            $result = $this->menuHandler->submitMenuSpecialContent();
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();


        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        } 
    }

    /**
     *
     * Editar
     * Edits the Menu properties.
     *
     */
    public function editar(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        $result = array();
        $manager = new DBManager();

        try{
            $result['menu_principal'] = $manager->getMenu('desktop');
            $result['content'] = PreferencesUtils::getMenuAttributes();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("edit", "menu");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/menu/editar", $result);
    }

    /**
     *
     * Salvar
     * This method does the submit form using a jQuery request
     *
     */
    public function salvar(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.HelperUtils');

        $data = array();

        $data['menu_exibe'] = MethodUtils::getBooleanNumber($_POST['exibe']);
        
        $data['menu_background_exibe'] = MethodUtils::getBooleanNumber($_POST['background_color_exibe']);
        $data['menu_active_exibe'] = MethodUtils::getBooleanNumber($_POST['background_active_exibe']);
        $data['textura_background_full'] = MethodUtils::getBooleanNumber($_POST['textura_background_full']);
        
        ($data['menu_background_exibe']) ? $data['background_color'] = $_POST['background_color'] : $data['background_color'] = "";
        ($data['menu_active_exibe']) ? $data['background_active'] = $_POST['background_active'] : $data['background_active'] = "";        
        
        $data['device'] = MethodUtils::getDeviceType();
        $data['message'] = Yii::t("messageStrings", "message_result_menu_update");       
        
        try{
            $menuHandler = new MenuManager();
            $content = $menuHandler->submitContent($data);
            
            $content2 = PreferencesUtils::setAttributes('menu_background_color', $data['background_color'], 'texto');
            $content2 = PreferencesUtils::setAttributes('menu_background_active', $data['background_active'], 'texto');
            $content2 = PreferencesUtils::setAttributes('margin_menu_pos_x', $_POST['margin_menu_pos_x'], 'inteiro');
            $content2 = PreferencesUtils::setAttributes('menu_margin_baixo', $_POST['menu_margin_baixo'], 'inteiro');
            
            $content2 = PreferencesUtils::setAttributes('menu_background_exibe', $data['menu_background_exibe'], 'inteiro');
            $content2 = PreferencesUtils::setAttributes('menu_active_exibe', $data['menu_active_exibe'], 'inteiro');
            
            $content2 = PreferencesUtils::setAttributes('menu_cor_divider', $_POST['menu_cor_divider'], 'texto');
            $content2 = PreferencesUtils::setAttributes('textura_background_full', $data['textura_background_full'], 'inteiro');
            $content2 = PreferencesUtils::setAttributes('menu_fonte', $_POST['menu_fonte'], 'texto');
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            $update = HelperUtils::createCss();
            
        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar
     * This method does the submit form using a jQuery request
     *
     */
    public function salvarPreferencias() {
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        try{
            $content = PreferencesUtils::setAttributes($_POST['label'], $_POST['value'], 'texto');
            $update = HelperUtils::createCss();
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 
            
            echo Yii::t("messageStrings", "message_result_menu_update");

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Deletar
     * This method deletes the selected record using a jQuery request
     *
     */
    public function deletar(){

        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t("messageStrings", "message_result_download_delete");

        try{
            $content = $this->menuHandler->deleteContent($data);
            

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: MenuAction - deletar() ' . $e->getMessage();
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

        $cs->registerScriptFile($baseUrl . '/js/admin/menu.js', CClientScript::POS_BEGIN);  
        $cs->registerCssFile($baseUrl . '/media/user/css/main.css', 'screen', CClientScript::POS_END);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}

?>