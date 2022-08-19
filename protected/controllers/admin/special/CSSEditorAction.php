<?php

class CSSEditorAction extends CAction {
    
    private $pageHandler;
    private $action;

    /**
     *
     * CSS Editor
     * Specific Admin Controller
     *
     */
    public function run() {       
        
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->action = Yii::app()->getRequest()->getQuery('action');     
        $this->pageHandler = new PaginasManager();

        switch($this->action){
            
            case "gerenciar":
            case   ""  :
                $this->gerenciar();
                break;
            
            case "modelos":           
                $this->modelos();
                break;

            case "salvar":
                $this->salvar();
                break;

        }
    }

    /**
     *
     * Manager for CssEditor view
     * 
     *
     */
    public function gerenciar(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{ 
            $result['session'] = MethodUtils::getSessionData();
            $result['css'] = PreferencesUtils::getAttributes('css_editor_code', 'descricao');
            $result['css_define'] = PreferencesUtils::getPreferedItem('css_cliente');
            
            //Dicas
            $result['sidemenu'] = HelperUtils::adminUtils('css_editor', array('extra' => 'gerenciar'));
            $result['dicas'] = DicasUtils::getTips(C::GENERAL, C::CSS_EDITOR);
        
            $this->addScript();        
            $this->controller->layout = "admin/admin";
            $this->controller->render("/admin/pages/layoutsites/css_editor", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: CSSEditorAction - editar() " . $e->getMessage();
        }       
    }
    
    /**
     *
     * Modelos for CssEditor view
     * 
     *
     */
    public function modelos(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{ 
            $result['session'] = MethodUtils::getSessionData();
            $result['css'] = PreferencesUtils::getAttributes('css_editor_code', 'descricao');
            $result['css_define'] = PreferencesUtils::getPreferedItem('css_cliente');
            
            //Dicas
            $result['sidemenu'] = HelperUtils::adminUtils('css_editor', array('extra' => 'gerenciar'));
            $result['dicas'] = DicasUtils::getTips(C::GENERAL, C::CSS_EDITOR);
        
            $this->addScript();        
            $this->controller->layout = "admin/admin2";
            $this->controller->render("pages/layoutsites/css_editor_modelos", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: CSSEditorAction - editar() " . $e->getMessage();
        }       
    }

    /**
     *
     * Salvar
     * This method does the submit form using a jQuery request
     *
     */
    public function salvar(){

        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.admin.JsonSiteUtils');
        Yii::import('application.extensions.utils.special.SettingsFileUtils');
       

        try{
            $css = $_POST['css'];
            $css_define = MethodUtils::getBooleanNumber($_POST['css_define']);
            
            // Define pages properties
            $cssProperties = PreferencesUtils::setAttributes('css_editor_code', $css, 'descricao');
            $cssProperties = PreferencesUtils::setPreferedItem('css_cliente', $css_define);
            
            //Update JSON data_base infos
            $updateCSSFile = JsonSiteUtils::updateCSSEditor();
            $updateSettingsFile = SettingsFileUtils::updateSettingsFile();
            
            echo json_encode(array('message' => Yii::t("messageStrings", "message_result_css_update")));
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: CSSEditorAction - salvar() ' .$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - CSSEditorAction - salvar()', 'trace' => $e->getMessage()), true);
        }
    }
    
    
    
    /**
     * Method resposible to apply the CSS and Javascript layout into the View
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
        (Yii::app()->params['admin_versao'] == '2') ? $cs->registerScriptFile($baseUrl . '/js/admin/layout_site.js', CClientScript::POS_END) : $cs->registerScriptFile($baseUrl . '/js/admin/layout_site.js', CClientScript::POS_BEGIN);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
    
   
}

?>