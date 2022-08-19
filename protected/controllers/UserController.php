<?php

class UserController extends Controller {
    
    public $user_account_states_id;
    public $pageTitle;
    public $siteAuthor;
    public $pageMetatags;
    public $pageDescription;
    public $productTitle;
    public $productDescription;
    public $pageLogo;
    public $pageThumb1;
    public $pageThumb2;
    public $facebook_app_id;
    public $facebookProfile;
    public $twitterProfile;
    public $orkutProfile;
    public $linkedinProfile;
    public $iconApp;
    public $google_tag_manager;
    public $canalYoutubeProfile;
    public $instagram_profile;
    public $pinterest_profile;
    public $flickr_profile;
    
    public function actions() {
        
        $setTitle = $this->actionSetTitle();

        return array(
            'index'                         => 'application.controllers.site.conta.user.UsersAction',             
            'cadastrar_rapido'              => 'application.controllers.site.conta.user.UsersAction',

        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
        
        //Infos
        $error = Yii::app()->errorHandler->error;
        $error['info'] = $manager->getInfo();
        
        if(defined('Settings::PIER_BUGFREE') && Settings::PIER_BUGFREE)  $send_error = MethodUtils::sendError($error, true);
        
        $error = Yii::app()->errorHandler->error;
        $this->layout = "/site/message";
        $this->render('/site/error/error', $error);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
    }
    
    /**
     * Sets some addictional attributes on header.
     * Dynamic infos, Facebook, Orkut and others social networks 
     */
    public function actionSetTitle() {
        Yii::import('application.extensions.utils.HelperUtils');
        date_default_timezone_set("Brazil/East");
        $data_page = HelperUtils::getTitleSite();
        $this->pageTitle = $data_page['titulo'];
        $this->pageMetatags = $data_page['metatags'];
        $this->pageDescription = $data_page['descricao'];
        $this->productDescription = $data_page['descricao'];
        $this->pageLogo = "http://". $_SERVER['SERVER_NAME'] . "/media/user/images/thumbs_120/" . HelperUtils::getLogo();
        $this->facebookProfile = HelperUtils::getSocialNetWorkProfile("facebook");
        $this->twitterProfile = HelperUtils::getSocialNetWorkProfile("twitter");
        $this->orkutProfile = HelperUtils::getSocialNetWorkProfile("orkut");
        $this->linkedinProfile = HelperUtils::getSocialNetWorkProfile("linkedin");
        $this->google_tag_manager = $data_page['google_tags_manager'];
        $this->canalYoutubeProfile = HelperUtils::getPreferencesAttributes("canal_youtube");
        $this->flickr_profile = HelperUtils::getPreferencesAttributes("flicker");
        $this->instagram_profile = HelperUtils::getPreferencesAttributes("instagram");
        $this->pinterest_profile = HelperUtils::getPreferencesAttributes("pinterest");
    }
    
    /*
     * Filters
     * 
     */
    public function filters(){
        return array(
            'accessControl',
        );
    }
    
    /*
     * Rules access
     * 
     */
    public function accessRules(){        
        return array(                
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('downloads', 'videos', 'materias', 'blog','banners','eventos','pedidos','images','loja',
                                   'hiperlinks','paginas', 'galeria', 'topos', 'rodapes', 'htmlbanners', 'htmlspark',
                                   'htmlcorona','htmlmini', 'htmlblocks', 'texturas', 'detalhes', 'fontes', 'layoutsite',
                                   'categorias','howto', 'cool', 'produtos', 'configurar','curriculums', 'vagas',
                                   'documentacao','coolhtml', 'newsletter', 'pagamento', 'user', 'elearn','pesquisa', 'prospects',
                                   'curriculum', 'elearn'),
                  
                  'users'=>array('@'),
                  
                  
                  
            ),
            
            array('deny',  // deny all users
                  'actions'=>array('downloads', 'videos', 'materias', 'blog','banners','eventos','pedidos','images','loja',
                                   'hiperlinks','paginas', 'galeria', 'topos', 'rodapes', 'htmlbanners', 'htmlspark',
                                   'htmlcorona','htmlmini', 'htmlblocks', 'texturas', 'detalhes', 'fontes', 'layoutsite',
                                   'categorias','howto', 'cool', 'produtos', 'configurar','curriculums', 'vagas',
                                   'documentacao', 'newsletter', 'pagamento', 'elearn', 'pesquisa', 'prospects',
                                   'curriculum', 'elearn'),
                  'users'=>array('*'),
                  'deniedCallback'=> array($this, 'redirectToDeniedMethod'),
                  
                  
            ),
        );
    }
    
    /*
     * Rules access
     * 
     */
    public function redirectToDeniedMethod(){        
        $this->redirect("/login");
    }
}