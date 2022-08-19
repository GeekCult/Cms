<?php

class ContatoAction extends CAction{

    /**
     *
     * Contato
     * Generic Class
     *
     */    
    public function run(){
        
        try{  
            if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle(C::CONTATO);
            if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme(C::CONTATO);
            
            $this->addScript($result);
            $this->controller->layout = $result['layout']["plataform"]. "/index";
            $this->controller->render("pages/contato/" . $result['page']['layout'], $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
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
        
        //Funcionalidades de components html
        if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; 
        if($local_place){$css= 'http://dev.purplepier.com.br/media/user/css/page_';}else{$css = 'https://www.purplepier.com.br/media/user/css/page_';}
        if($result['page']['modelo'] != 0) $cs->registerCssFile($css . "{$result['page']['id']}.css", 'screen', CClientScript::POS_HEAD);
        
        //Funcionalidades de components html        
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.maskedinput-1.2.2.min.js', CClientScript::POS_END);
        
        //Funcionalidades de controle e comportamento default desta view
        $cs->registerScriptFile($baseUrl . '/js/site/contato/contato.js', CClientScript::POS_END);
        
        //Dublin Core and Metadata
        include Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        //require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';        
    }
}
?>