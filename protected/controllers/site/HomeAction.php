<?php

class HomeAction extends CAction{
    
    /**
     * Home
     *
     */
    public function run(){

        if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle(C::HOME); 
        if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme(C::HOME);
        
        try{           
            switch($result['preferences']["status"]){               

                case "ok":
                case "1":  
                    
                    //Se a home for de exibir produtos
                    if($result['page']['layout'] == 'home_ecommerce_easy'){                        
                      
                        Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');
                        Yii::import('application.extensions.utils.ProdutosUtils'); 
                        
                        $produtosHandler = new ProdutosManager();
                        $result['bread_crumb'] = ProdutosUtils::getBreadCrumb("", "", "", "");  
                        $result['vitrine'] = $produtosHandler->getContentByIdAttribute('vitrine');
                        $result['lancamentos'] = $produtosHandler->getContentByIdAttribute('lancamento');
                        $result['menu_ecommerce'] = $produtosHandler->getMenu();
                        $result['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');  
                    }
                    
                    $addScript = $this->addScript($result);
                    //Se tudo tranquilo no mamilo!
                   
                    $this->controller->layout = 'site/index';                    
                    if($result['page']['modelo'] != 1 ) $this->controller->render('pages/home/' . $result['page']['layout'], $result);
                    if($result['page']['modelo'] == 1 ) $this->controller->render('pages/home/home_advanced_html5', $result);
                    break;

                default:                    
                    Yii::import('application.extensions.dbuzz.DBManager');       
                    $manager = new DBManager();
                    
                    $session = MethodUtils::getSessionData();
                    
                    //Mesmo se o status for construção, falta pagamento, manutenção
                    //Se o usuário logar no admin, o site aparece normal
                    if($session["logado_admin"] != 1 && $session["logado"] != 1){ 
                        
                        $result = HelperUtils::getPageBundle(C::INTRO);
                        $result['info'] = $manager->getIntro();
                        $result['construcao'] = true;
                        $addScript = $this->addScript($result);
                        $this->controller->layout = 'site/message';
                        $this->controller->render('pages/intro/countdown', $result);

                    }else{                        
                        
                        $addScript = $this->addScript($result);                        
                        $this->controller->layout = $result['layout']["plataform"].'/index';                        
                        if($result['page']['modelo'] != 1)$this->controller->render('pages/home/' . $result['page']['layout'], $result);
                        if($result['page']['modelo'] == 1)$this->controller->render('pages/home/home_advanced_html5', $result);                        
                    } 
                    
                    break;
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: HomeAction - run() " . $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param array
     *
     */
    public function addScript($result){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        if(!isset($result['construcao'])){
            
            //Funcionalidades de components html
            if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; 
            if($local_place){$css= 'http://dev.purplepier.com.br/media/user/css/page_';}else{$css = 'https://www.purplepier.com.br/media/user/css/page_';}
            if( Yii::app()->params['site_type']) $css= '/media/user/css/page_';
            if($result['page']['modelo'] != 0) $cs->registerCssFile($css . "{$result['page']['id']}.css", 'screen', CClientScript::POS_HEAD);

            //Dublin Core and Metadata
            require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
            //require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';
            
        }else{
            //Intro
            $cs->registerCssFile($baseUrl . '/css/site/content/special/others/intro.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/site/special/others/intro.js', CClientScript::POS_END); 
        }
    }
}
?>