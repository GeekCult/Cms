<?php

class CadastrarController extends Controller{
    
    public $pageTitle;
    public $siteAuthor;
    public $pageMetatags;
    public $pageDescription;
    public $productTitle;
    public $productDescription;
    public $iconApp;
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
            'index'      => 'application.controllers.site.special.CadastrarAction',
            'pj'         => 'application.controllers.site.special.CadastrarAction',
            'pf'         => 'application.controllers.site.special.CadastrarAction'
        );
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
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
                  'actions'=>array('erp'),
                  
                  'users'=>array('@'),
                  
                  
                  
            ),
            
            array('deny',  // deny all users
                  'actions'=>array('erp'),
                
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
        $this->redirect("/home");
    }
}