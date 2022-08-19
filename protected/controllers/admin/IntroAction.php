<?php

class IntroAction extends CAction {
    
    private $uri;
    private $manager;
    private $action;
    private $request;
    private $isPostRequest;
    private $purplePierManager;

    /**
     *
     * Intro;
     * Specific Class
     *
     */
    public function run() {
        
        Yii::import('application.extensions.dbuzz.AdminDBManager'); 
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        
        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->manager = new AdminDBManager();        
        $this->purplePierManager = new PurplePierManager();
        
        switch($this->action){
            case   ""  :
                $this->showLogin();
                break;
            
            case "logar":
                $this->logarAdmin();
                break;
            
            case "exibir":
                $this->displayBannerContent();
                break;
            
            case "concorda":
                $this->concorda();
                break;
            
            case "close_aviso":
                $this->closeAviso();
                break;
            
            case "update_statistics":
                $this->updateStatistics();
                break;
        }        
    }
    
    /*
     * Show login 
     * 
     * Default method, does the initial
     * login or initialise the admin system.
     * 
     */
    public function showLogin(){
        
        Yii::import('application.extensions.dbuzz.admin.EstatisticasManager');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.users.UserUtils');        
        Yii::import('application.extensions.utils.ActivityUtils');
        
        $avisos = new EstatisticasManager();            
        $session = MethodUtils::getSessionData();
        
        $result = array();

        
        $result['data'] = false;
        
        try{
            if($session['id'] != '') $result['data'] = $this->manager->getUserData($session['id']);
            if($session['id'] == '' || !$result['data']) $result['data'] = UserUtils::getClearDataUser();  
          
            $result['session'] = $session;
            //$result['componente'] = MethodUtils::getComponentPurpleStore('componente_site'); 
         
            $checkHash = false;
            $cookie = isset(Yii::app()->request->cookies['PP_Login']); 

            if(($cookie != NULL && $cookie != "" )|| $cookie == 1){ 
                $cookie = Yii::app()->request->cookies['PP_Login']->value;
                $checkHash = UserUtils::getUserByHash($cookie);
            }
            
            //Se estiver logado
            if(!Yii::app()->user->isGuest && $session['logado_admin'] == 1){
                
                //Yii::import('application.extensions.vendors.google.GoogleManager');
                //Yii::import('application.extensions.dbuzz.site.redessociais.FacebookManager');
                //$googleHandler = new GoogleManager();
                //$facebookHandler = new FacebookManager();

                $result['google'] = array();
                $result['facebook'] = array();
                
                $set = MethodUtils::SetSessionData('SES_PierAlertas', "");
                
                if($session['id'] != '') $result['data'] = $this->manager->getUserData($session['id']);
                if($session['id'] == '' || !$result['data']) $result['data'] = UserUtils::getClearDataUser();  

                $result['acessos'] = $this->manager->getAcessos();            
                $result['avisos'] = $avisos->getAllAvisosAdmin();
                $result['activity'] = ActivityUtils::getRecentActivity();
                $result['messages'] = PreferencesUtils::getMessages("desktop");
                
                $result['session'] = $session;

                //Logged in data and verification
                $result['usuario'] = $session['field1'] . " " . $session['field2'];

                $checkHash = false;
                $cookie = isset(Yii::app()->request->cookies['PP_Login']); 

                if(($cookie != NULL && $cookie != "" )|| $cookie == 1){ 
                    $cookie = Yii::app()->request->cookies['PP_Login']->value;
                    $checkHash = UserUtils::getUserByHash($cookie);
                }

                if($session["logado_admin"] != 1 && !$checkHash){           
                    $this->addScripts("login");
                }else{ 
                    $session['userSessionTimeout'] = time() + Yii::app()->params['sessionTimeout'];
                    $this->addScripts("logado");           
                } 

                $session->close();
                $this->controller->layout = "admin/admin";
                $this->controller->render("pages/intro/intro", $result);
            
                //Se não estiver logado
            }else{ 
   
                $this->addScripts("login");
                $this->controller->layout = "admin/login";
                $this->controller->render("pages/intro/login", $result);
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: IntroAction - showLogin() ' . $e->getMessage();
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
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest; 

        // Se é POST, é pq foi feita a submissão das credenciais
        if($isPostRequest){
            
            Yii::import('application.extensions.utils.HelperUtils');
            Yii::import('application.extensions.utils.users.UserUtils');
            Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
            
            $isValid = (isset($_POST['email']) && isset($_POST['password']));
            
            if($isValid){

                $email = $_POST["email"];
                $senha = md5($_POST["password"]);
                (isset($_POST["permitir"])) ? $permitir = $_POST["permitir"] : $permitir = false;

                $identity = new PurplePierUserIdentity($email, $senha);
                
                if($identity->authenticate($permitir, 'admin')){                    

                    Yii::app()->user->login($identity, Yii::app()->params['sessionTimeout']);
                    
                    $session = MethodUtils::getSessionData();
                    
                    //Gets permission level if it's different of admistrator
                    $profile_access = UserUtils::getAttribute("acessor", "texto", $session['id']);
                    
                    //If the user is an admin manager 
                    if($session['user_account_type'] == '2' || $profile_access == "permission_level" || $session['user_account_type'] == '3'){
                        $result["success"] = true;                   
                        $result['logado_admin'] = $session["logado_admin"] = 1;
                        $result['user'] = $session['field1'] . " " . $session['field2'];                  
                        $result['id'] = $session['id'];                 
                        $result['avatar'] = $session['avatar'] = HelperUtils::getAvatar($result['id']);                      
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
                    //$setPing = $this->purplePierManager->setPing($ping);
                    
                    $this->controller->redirect('/admin'); 
                    
                }else{ 
                    
                    $result = array('message' => 'Erro: Usuário ou Senha inválidos', 'email' => $_POST['email']);
                    
                    $result['componente'] = MethodUtils::getComponentPurpleStore('componente_site');
                    
                    $this->addScripts("login");
                    $this->controller->layout = "admin/login";
                    $this->controller->render("pages/intro/login", $result);                   
                }
                
                //echo json_encode($result);

            }else{

                $this->controller->redirect(Yii::app()->homeUrl);
            }
        }
    }
    
    /*
     * Shows the specific choose content
     * It could be any one of the banner listed
     * in the intro view. 
     * 
     */
    public function displayBannerContent(){
        $feature = "smartpayment";
        $this->addScriptsFeatures($feature);
        
        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/intro/features/" . $feature);        
    }
    
    /*
     * Shows agreement 
     * 
     */
    public function concorda(){
        $feature = "concorda";
        $this->addScriptsFeatures($feature);
        
        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/intro/features/" . $feature);        
    }
    
    /*
     * Close and set status avisos. 
     * 
     */
    public function closeAviso(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $id = $_POST[ 'id'];
        $close = PreferencesUtils::closeAviso($id);
        
        echo $close;
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
    
    /*
     * Update statistcs
     * 
     */
    public function updateStatistics(){
        
        Yii::import('application.extensions.vendors.google.GoogleManager');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $googleHandler = new GoogleManager();

        $analytics = $googleHandler->getAnalytics(); 
        $result = array();
        
        try{
            if($analytics){
                $save = PreferencesUtils::setAttributes('google_analytics_users', $analytics->totalsForAllResults['ga:users'], 'texto');
                $save = PreferencesUtils::setAttributes('google_analytics_pageviews', $analytics->totalsForAllResults['ga:pageviews'], 'texto');
                $save = PreferencesUtils::setAttributes('google_analytics_sessions', $analytics->totalsForAllResults['ga:sessions'], 'texto');
                
                $result = array('result' => 1, 'ga_users' =>  $analytics->totalsForAllResults['ga:users'], 'ga_pageviews' =>  $analytics->totalsForAllResults['ga:pageviews'], 'ga_sessions' => $analytics->totalsForAllResults['ga:sessions']);
            }
            
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - CronJobsActoin - checkGoogleAnalytics() ' . $e->getMessage();
        }    
    }
    
    /*
     * Adds the main files CSS and Javascript
     * The method bellow uses logged in or not
     * to  display a specific view.  
     * 
     */
    public function addScripts($status){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
        if($status == "login"){
           $cs->registerScriptFile($baseUrl . '/js/admin/login.js', CClientScript::POS_BEGIN);
        }else{
            $cs->registerScriptFile($baseUrl . '/js/admin/intro.js', CClientScript::POS_BEGIN);
        }       
    }
    
    /*
     * Adds the main files CSS and Javascript
     * for each feature needed. 
     * 
     */
    public function addScriptsFeatures($feature){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        //Special features to the ads.
        if($feature == 'concorda') $cs->registerScriptFile($baseUrl . '/js/admin/documentar/concorda.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl . '/css/admin/general/features/'. $feature .'.css', 'screen', CClientScript::POS_END);
    }
}
?>