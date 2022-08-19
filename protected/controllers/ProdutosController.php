<?php

class ProdutosController extends Controller{

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
    public $iconApp;
    public $linkedinProfile;
    public $google_tag_manager;
    public $canalYoutubeProfile;
    public $instagram_profile;
    public $pinterest_profile;
    public $flickr_profile;

    public function actions(){
        
        $setTitle = $this->actionSetTitle();

        return array(
            'index'                 => 'application.controllers.site.produtos.ProdutosAction',
            'listar'                => 'application.controllers.site.produtos.ProdutosAction',
            'detalhes'              => 'application.controllers.site.produtos.ProdutosAction',
            'status'                => 'application.controllers.site.produtos.ProdutosAction',
            'editar'                => 'application.controllers.site.produtos.ProdutosAction',
            'compra_realizada'      => 'application.controllers.site.produtos.ProdutosAction'
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
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Sets some addictional attributes on header.
     * Dynamic infos, Facebook, Orkut and others social networks 
     */
    public function actionSetTitle(){
        date_default_timezone_set("Brazil/East");
        Yii::import('application.extensions.utils.HelperUtils');
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
}