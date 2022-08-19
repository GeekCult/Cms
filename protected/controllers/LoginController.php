<?php

class LoginController extends Controller{   
    
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
    public $google_tag_manager;
    public $canalYoutubeProfile;
    public $instagram_profile;
    public $pinterest_profile;
    public $flickr_profile;
    
    public function actions(){

        return array(
            'index'             => 'application.controllers.site.login.LoginAction',
            'atualizar'         => 'application.controllers.site.login.LoginAction',
            'autenticacao'      => 'application.controllers.site.login.LoginAction',
            'cadastrar'         => 'application.controllers.site.login.LoginAction',
            'carregar'          => 'application.controllers.site.login.LoginAction',
            'logar_popup'       => 'application.controllers.site.login.LoginAction'
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
        
        //Infos
        $error = Yii::app()->errorHandler->error;
        $error['info'] = $manager->getInfo();
        
        if(Yii::app()->params['bug_free']) $send_error = MethodUtils::sendError($error, true);
        
        $error = Yii::app()->errorHandler->error;
        $this->layout = "/site/message";
        $this->render('/site/error/error', $error);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout(){
            Yii::app()->user->logout();
            $this->redirect("/home");
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
                                   'categorias','howto', 'cool', 'produtos', 'configurar','curriculums',
                                   'documentacao','coolhtml', 'newsletter', 'pagamento', 'user', 'prospects'),
                  'users'=>array('@'),
            ),
            
            array('deny',  // deny all users
                  'actions'=>array('downloads', 'videos', 'materias', 'blog','banners','eventos','pedidos','images','loja',
                                   'hiperlinks','paginas', 'galeria', 'topos', 'rodapes', 'htmlbanners', 'htmlspark',
                                   'htmlcorona','htmlmini', 'htmlblocks', 'texturas', 'detalhes', 'fontes', 'layoutsite',
                                   'categorias','howto', 'cool', 'produtos', 'configurar','curriculums',
                                   'documentacao', 'newsletter', 'pagamento', 'prospects'),
                  'users'=>array('*'),
            ),
        );
    }
}