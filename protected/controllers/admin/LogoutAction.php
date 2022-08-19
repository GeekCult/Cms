<?php

class LogoutAction extends CAction {

    public function run(){
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;

        //where the user was before logout
        $referer = $_SERVER['HTTP_REFERER'];
        
        //Sets live chat to on
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
        $session = MethodUtils::getSessionData();
        if($session['logado_admin'] == 1) $setLiveChatON = PreferencesUtils::setPreferedItem('online_admin', 0);
        
        //Clear cookie
        $id_cookie = "PP_Login";            
        $doCookie = new CHttpCookie($id_cookie, "deslogado");
        $doCookie->expire = time() + 30;
        Yii::app()->request->cookies[$id_cookie] = $doCookie;
        
        unset(Yii::app()->request->cookies['PP_Login']);

        // Limpa a sessao
        $session = new CHttpSession;
        $session->open();
        $session->clear();
        $session->destroy();
        $session->close();

        // Logout
        Yii::app()->user->logout();       

        // Redireciona para a homepage do admin
        $assigned_roles = Yii::app()->authManager->getRoles(Yii::app()->user->id); //obtains all assigned roles for this user id
        if (!empty($assigned_roles)) { //checks that there are assigned roles
            $auth = Yii::app()->authManager; //initializes the authManager
            foreach ($assigned_roles as $n => $role) {
                if ($auth->revoke($n, Yii::app()->user->id)) //remove each assigned role for this user
                    Yii::app()->authManager->save(); //again always save the result

            }
        }
        
        $_SESSION = array();
        
        if($isAjaxRequest){
            
            if(isset($_POST['action'])){                
                if($_POST['action'] == "conta"){
                    echo "Logout redirect";
                }else{
                    echo "Logout kepp";
                }            
            }            
        }else{
            $this->controller->redirect("/admin");
        }
    }
}

?>