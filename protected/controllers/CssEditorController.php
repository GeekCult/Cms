<?php

class CssEditorController extends Controller{
    
    public $all;
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

        return array(
            'index'                 => 'application.controllers.admin.special.CSSEditorAction',
            'gerenciar'             => 'application.controllers.admin.special.CSSEditorAction',
            'modelos'               => 'application.controllers.admin.special.CSSEditorAction',
            
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
}