<?php

class ImageController extends Controller{
    
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
    public $iconApp;
    public $flickr_profile;
    
    public function actions(){
        
        date_default_timezone_set("Brazil/East");
        
        return array(                
            'index'                 => 'application.controllers.site.ImagesAction',
            'upload_admin'          => 'application.controllers.site.ImagesAction',
            'upload'                => 'application.controllers.site.ImageAction',
          
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
        
        //Infos
        $error = Yii::app()->errorHandler->error;
        $error['info'] = $manager->getInfo();
        
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