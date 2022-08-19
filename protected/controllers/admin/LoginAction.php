<?php

/**
 * Classe genérica de login
 * Esta classe é responsável por renderizar o formulário de login utilizado no
 * FancyBox.
 * 
 * O login default via component html também utiliza desta classe para
 * verificar se o usuário esta cadatrado.
 *
 *
 */

class LoginAction extends CAction{
    
    private $uri;
    private $action;
    private $request;
    private $isPostRequest;
    private $purplePierManager;

    public function run(){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        
        $this->request = Yii::app()->request;
        $this->uri = Yii::app()->request->requestUri;
        
        $this->isPostRequest = $this->request->isPostRequest;        
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        
        $this->purplePierManager = new PurplePierManager();
        
        switch($this->action){            
            case "logar":
            case "novo":
            case   ""  :
                $this->logar();
                break;
            
            case "avisos":
                $this->avisos();
                break;
            
            case "signin":
                $this->logarAdmin();
                break;
            
            case "app":
                $this->logarApp();
                break;
        }        
    }
    
    /*
     * Logar Admin
     * 
     * Main method to login a user admin.
     * It sets a 1 hour for session 
     * 
     * 
     */
    public function logarAdmin(){

        // Se é POST, é pq foi feita a submissão das credenciais
        if($this->isPostRequest){
            
            Yii::import('application.extensions.utils.HelperUtils');
            Yii::import('application.extensions.utils.users.UserUtils');
            Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
            
            $isValid = (isset($_POST['loginAcessoUser']) && isset($_POST['loginAcessoSenha']));
            
            if($isValid){

                $email = $_POST["loginAcessoUser"];
                $senha = $_POST["loginAcessoSenha"];
                (isset($_POST["loginPermitir"])) ? $permitir = $_POST["loginPermitir"] : $permitir = false;

                $identity = new PurplePierUserIdentity($email, $senha);

                if($identity->authenticate($permitir, 'admin')){

                    Yii::app()->user->login($identity, Yii::app()->params['sessionTimeout']);
                    
                    $session = new CHttpSession;
                    $session->open();
                    
                    //Gets permission level if it's different of admistrator
                    $profile_access = UserUtils::getAttribute("acessor", "texto", $session['id']);
                    
                    //If the user is an admin manager 
                    if($session['user_account_type'] == '2' || $profile_access == "permission_level" || $session['user_account_type'] == '3'){
                        $result["success"] = true;                   
                        $result['logado_admin'] = $session["logado_admin"] = 1;
                        $result['logado_app'] = $session["logado_app"] = 1;
                        $result['user'] = $session['field1'] . " " . $session['field2'];                  
                        $result['id'] = $session['id'];                 
                        $result['avatar'] = HelperUtils::getAvatar($result['id']); 
                        $result['creation']  = HelperUtils::getDateCreation($result['id']);  
                        $result['visits_admin'] = $this->addAdminVisitRecord();
                        $result['profile_access'] = $profile_access;
                        
                        //User master PurplePier
                        if($session['user_account_type'] == '3') MethodUtils::setSessionData('master_purple', 1);
                        
                        $setLastUpdate = UserUtils::setLastUpdate($session['id']);
                    
                        
                        //Sets admin access level
                        $acess_level = MethodUtils::setSessionData("acess_level", 4);
                        
                        //Sets access level for accessores
                        if($profile_access) MethodUtils::setSessionData("acess_level", 1);
                        
                    }else{
                        $result["success"] = false; 
                    } 
                    
                    //Set ping activity
                    $ping = array('titulo' => 'Login Admin', 'descricao' => "", 'tipo' => 'login_admin', 'plataforma' => $session['device']);
                    $setPing = $this->purplePierManager->setPing($ping);
                    
                    //Clear previouly data into session
                    $clearCache = MethodUtils::clearAllCache(); 
          
                    $session->close();
                    
                }else{
                    $result["success"] = false;                    
                }
                
                echo json_encode($result);

            }else{

                $this->controller->redirect(Yii::app()->homeUrl);
            }
        }
    }
    
    /*
     * Logar
     * 
     * Main method to log in a user and owner site.
     * It sets a 1 hour for session 
     * 
     * 
     */
    public function logar(){

        // Se é POST, é pq foi feita a submissão das credenciais
        if($this->isPostRequest){
            
            Yii::import('application.extensions.utils.ContadorVisitasUtils');
            Yii::import('application.extensions.utils.users.UserUpdateUtils'); 
            Yii::import('application.extensions.utils.users.UserSupportUtils');
            Yii::import('application.extensions.utils.users.UserUtils');
            
            $isValid = (isset($_POST['loginAcessoUser']) && isset($_POST['loginAcessoSenha']));
            
            if($isValid){

                $email = $_POST["loginAcessoUser"];
                $senha = $_POST["loginAcessoSenha"];
                $next_action = $_POST["loginNextAction"];
                
                //Permancer logado
                $login_permanecer = false;
                if(isset($_POST['loginPermitir'])) $login_permanecer = $_POST['loginPermitir'];
                

                $identity = new PurplePierUserIdentity($email, $senha, $login_permanecer);

                if($identity->authenticate()){

                    Yii::app()->user->login($identity, Yii::app()->params['sessionTimeout']);
                    $result["success"] = true;

                    $session = new CHttpSession;
                    $session->open();
                    
                    $result['logado'] = $session["logado"];
                    $result['next_action'] = $next_action;                    
                    $result['user'] = $session['user'] = $session['field1'] . " " . $session['field2'];                    
                    $result['id'] = $session['id'];                    
                    $result['avatar'] = $session['avatar'] = HelperUtils::getAvatar($result['id']);
                    $result['profile_level']  = HelperUtils::getProfileLevel($result['id']);
                    $result['tipo'] = $session['tipo'] = HelperUtils::getTipo($result['id']); 
                    
                    //Verifica se é associado
                    if(Yii::app()->params['ramo'] == 'associacao') $session['associado'] = UserUtils::checkAttribute("name", 'associado', false, $session['id']);
                    if($session['associado']['name'] == 'associado') $session['associado'] = 1;
                 
                    $session->close();
                    
                    $verifyModules = UserSupportUtils::setUserModules($result['id']);
                    
                    //Add a visit into counter
                    $addVisit = ContadorVisitasUtils::setVisit("conta");
                    $setAction = MethodUtils::setActionDone("acesso_conta", $result['id']);
                    
                    $setLastUpdate = UserUtils::setLastUpdate($result['id']);
                    
                    //Some updates can be called from this method
                    $updateUser = UserUpdateUtils::dispatchUserUpdates($result['id']);
                    
                    //Set ping activity
                    $ping = array('titulo' => 'Login Conta', 'descricao' => "", 'tipo' => 'login_conta', 'plataforma' => $session['device']);
                    $setPing = $this->purplePierManager->setPing($ping);

                }else{
                    $result["success"] = false;                    
                }
                
                echo json_encode($result);

            }else{
                $this->controller->redirect(Yii::app()->homeUrl);
            }
        }
    }
    
    /*
     * Logar App
     * 
     * Main method to login a user to use app.
     * 
     * 
     */
    public function logarApp(){

        // Se é POST, é pq foi feita a submissão das credenciais
        if($this->isPostRequest){
            
            Yii::import('application.extensions.utils.HelperUtils');
            Yii::import('application.extensions.utils.users.UserUtils');
            Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
            
            $isValid = (isset($_POST['loginAcessoUser']) && isset($_POST['loginAcessoSenha']));
            
            if($isValid){

                $email = $_POST["loginAcessoUser"];
                $senha = $_POST["loginAcessoSenha"];
                (isset($_POST["loginPermitir"])) ? $permitir = $_POST["loginPermitir"] : $permitir = false;

                $identity = new PurplePierUserIdentity($email, $senha);

                if($identity->authenticate($permitir, 'app')){

                    Yii::app()->user->login($identity, Yii::app()->params['sessionTimeout']);
                    
                    $session = new CHttpSession;
                    $session->open();
                    
                    //Gets permission level if it's different of admistrator
                    $profile_access = UserUtils::getAttribute("acessor", "texto", $session['id']);
                    
                    //If the user is an admin manager 
                    if($session['user_account_type'] == '2' || $profile_access == "permission_level"){
                        $result["success"] = true;                   
                        $result['logado_app'] = $session["logado_app"] = 1;
                        $result['user'] = $session['field1'] . " " . $session['field2'];                  
                        $result['id'] = $session['id'];                 
                        $result['avatar'] = HelperUtils::getAvatar($result['id']); 
                        $result['creation']  = HelperUtils::getDateCreation($result['id']);  
                        $result['visits_admin'] = $this->addAdminVisitRecord();
                        $result['profile_access'] = $profile_access;
                        
                        $setLastUpdate = UserUtils::setLastUpdate($session['id']);                    
                        
                        //Sets admin access level
                        $acess_level = MethodUtils::setSessionData("acess_level", 4);
                        
                        //Sets access level for accessores
                        if($profile_access) MethodUtils::setSessionData("acess_level", 1);
                        
                    }else{
                        $result["success"] = false; 
                    } 
                    
                    //Set ping activity
                    $ping = array('titulo' => 'Login App', 'descricao' => "", 'tipo' => 'login_app', 'plataforma' => $session['device']);
                    $setPing = $this->purplePierManager->setPing($ping);
                    
                    //Clear previouly data into session
                    $clearCache = MethodUtils::clearAllCache(); 
          
                    $session->close();
                    
                }else{
                    $result["success"] = false;
                    $result["MESSAGE"] = Yii::t("messageStrings", "message_result_not_allowed");
                }
                
                echo json_encode($result);

            }else{

                $this->controller->redirect(Yii::app()->homeUrl);
            }
        }
    }
    
    /*
     * 
     * Add visit
     * Adiciona uma visita no registro de visitas
     * 
     */
    public function addAdminVisitRecord(){        
        Yii::import('application.extensions.utils.ContadorVisitasUtils');
        $addVisit = ContadorVisitasUtils::setVisit("admin");
        return $addVisit;        
    }

}
?>