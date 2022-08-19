<?php

class VerticalBannerAction extends CAction{

    /**
     * Content Profile, Text and a simple picture like banner
     * Specific Controller
     *
     */
    public function run(){

        $page = $_GET['nr'];                
        
        try{            
            if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle($page);
            if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme($page);
            
            if($result['page']['modelo'] == 1) $result['page']['layout'] = 'general_advanced_html5';
            
            $this->addScript($result);
            $this->controller->layout = $result['layout']["plataform"] . "/index";
            $this->controller->render("pages/general/" . $result['page']['layout'], $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR VerticalBannerAction - run() " . $e->getMessage();
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
        (Yii::app()->params['ssl']) ? $http = 'https://' : $http = 'http://';
        
        //Layout page
        $cssView = $baseUrl . "/css/site/content/general/{$result['page']['layout']}.css";        
        $cs->registerCssFile($cssView, 'screen', CClientScript::POS_HEAD);
            
        //Funcionalidades de components html
        if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; 
        if($local_place){$css= 'http://dev.purplepier.com.br/media/user/css/page_';}else{$css = 'https://www.purplepier.com.br/media/user/css/page_';}
        if( Yii::app()->params['site_type']) $css= '/media/user/css/page_';
        if($result['page']['modelo'] != 0) $cs->registerCssFile($css . "{$result['page']['id']}.css", 'screen', CClientScript::POS_HEAD);
        
        
        //Dublin Core and Metadata
        require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        //require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';

    }

}
?>
