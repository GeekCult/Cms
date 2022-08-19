<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController{

    public function beforeAction($action = ""){

        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;
        
        // Check only if the user is logged in
        if (!Yii::app()->user->isGuest){            
            $request = Yii::app()->request;
            $isAjaxRequest = $request->isAjaxRequest;

            $session = new CHttpSession;
            $session->open();

            if($session['userSessionTimeout'] < time()){ //timeout        
               $session['isSessionTimeOut'] = true;
               $session['logado'] = 0;
               $session['logado_admin'] = 0;
               $session['livechat'] = '';
                              
               //Verifica se está em uma das duas areas restritas
                if($controller == "admin"){
                  
                    if(!$isAjaxRequest){                                       
                        if($action != "index" && $action != 'intro' && $action != 'logout'){                            
                            $this->redirect("/admin");
                        }else{                               
                            $this->showFlashMessage();                                                     
                        }
                    }
                    
                    //Sets live chat to on
                    Yii::import('application.extensions.utils.admin.PreferencesUtils');
                    $setLiveChatON = PreferencesUtils::setPreferedItem('online_admin', 0);
                    $session->close();
                    
                    return true;
                    
                }else if($controller == "conta"){                            
                    
                    if($isAjaxRequest){
                        $session["logado"] = '2';
                        
                    }else{
                        if($action != "index" ){
                            $this->redirect("/home");
                        }else{
                            $this->showFlashMessage();
                        }
                    }                    
                    $session->close();                    
                    return true;                    
                   
                }else{                    
                    $this->showFlashMessage();
                    $session->close();
                    return true;
                }              
                
            }else{               
                //get a new chance to stay logged in
                $session['userSessionTimeout'] = time() + Yii::app()->params['sessionTimeout'];
                $session->close();
                return true;
            }
            
        }else{
           return true;
        }
    }
    
    //Shows the flash message
    public function showFlashMessage(){         
        $minutes = Yii::app()->params['sessionTimeout'] / 60;
        Yii::app()->user->setFlash('sessionTimeout', "A sua sessão expirou por inatividade ($minutes minutos). Por favor, faça o login novamente.");
    }
}