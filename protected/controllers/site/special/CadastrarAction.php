<?php

class CadastrarAction extends CAction{
    
    private $action;
    private $id;
    
    /**
     *
     * Cadastrar
     * Specific Controller
     *
     */
    public function run(){
        
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        switch($this->action){

            case "":
            case "pf":
                $this->formularioUser(0);
                break;
            case "pj":
                $this->formularioUser(1);
                break;
            
        }
    }
    
    /*
     * Formulário de cadastro de usuário
     * 
     */
    public function formularioUser($type = 0){
              
        Yii::import('application.extensions.utils.TermsCondictionsUtils');
        
        $result = HelperUtils::getPageBundleSUPREME(C::SIGNINIT);
        
        $result['session'] = array('pre_type' => $type, 'pre_email' => '');
        
        if($type == 0) $result['attribute'] = array('field1' => 'Nome', 'field2' => 'SobreNome', 'extra' => 'Data nascimento', 'documento' => 'CPF');
        if($type == 1) $result['attribute'] = array('field1' => 'Nome Fantasia', 'field2' => 'Razão Social', 'extra' => 'Responsável', 'documento' => 'CNPJ');
        
        $result['termos'] = TermsCondictionsUtils::getTermos();
        
        try{            
            ActivityLogger::log(C::STR_ACCESS_PAGE . C::SIGNINIT);
        
            $this->addScript($result);
            $this->controller->layout = "site/index";        
            $this->controller->render("/site/pages/conta/users/formularios/{$result['page']['layout']}", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        } 
    }

    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($result){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . "/css/site/layout/layout_{$result['layout']['layout_site']}.css", 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/site/conta/formularios/cadastrar_user.js', CClientScript::POS_END);
        
        //Dublin Core and Metadata
        require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';
        
    }
}
?>
