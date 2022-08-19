<?php

class LogosAction extends CAction{
    
    private $logosHandler;
    private $action;

    /**
     *
     * Intro;
     * Specific Class
     *
     */
    public function run() {
        
        Yii::import('application.extensions.dbuzz.admin.LogosManager');
        Yii::import('application.extensions.utils.DicasUtils');
        
        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->logosHandler = new LogosManager();        
        
        switch($this->action){
            case "selecionar":
                $this->selecionarLogos();
                break;
            
            case "atualizar":
                $this->atualizarLogos();
                break;
        }        
    }
    
    /*
     * Select brands 
     * 
     * It selects or handles with all brands into web PurplePier 
     * application.
     * 
     */
    public function selecionarLogos(){
        
        try{           
            $result['logos'] = $this->logosHandler->getAllContent();
            
            $result['dicas'] = DicasUtils::getTips("list", "logos");
            
            $this->addScripts();   
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/logos/selecionar", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }  
    }
    
    /*
     * Updates brands 
     * 
     * It update all brands into web PurplePier 
     * application.
     * 
     */
    public function atualizarLogos(){
       
        $data = array();

        $data['logo_network'] = $_POST['logo_redes_sociais'];
        $data['logo_email'] = $_POST['logo_email'];
        if(isset($_POST['logo_email_image'])) $data['logo_email_image'] = $_POST['logo_email_image'];
        $data['logo_tablet_intro'] = $_POST['logo_tablet_intro'];
        $data['logo_tablet'] = $_POST['logo_tablet'];
        $data['logo_app'] = $_POST['logo_app'];
        $data['logo_mobile'] = $_POST['logo_mobile'];
        $data['logo_site'] = $_POST['logo_site'];
        $data['logo_site_image'] = $_POST['logo_site_image'];
        $data['logo_impressao'] = $_POST['logo_impressao'];

        try{            
            $content = $this->logosHandler->updateContent($data); 
            $content = HelperUtils::createCss();
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }       
    }
    
    /*
     * Adds the main files CSS and Javascript
     * The method bellow uses logged in or not
     * to  display a specific view.  
     * 
     */
    public function addScripts(){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Script view        
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/logos.js', CClientScript::POS_BEGIN);
    }
}
?>