<?php

class ContaAction extends CAction {

    private $produtosHandler;
    private $pedidosHandler;
    private $type_account;
    private $preferences;
    private $id_usuario; 
    private $user_name;
    private $avatar;
    private $frase;
    private $manager;
    private $action;
    private $avisos;
    private $event;
    private $user;
    private $id;    

    /**
     *
     * Profile Action
     * Specific Action
     * 
     * It handles with all action related with the user conta
     *
     */
    public function run() {

        $this->action = Yii::app()->getRequest()->getQuery('tipo');
        $this->user = Yii::app()->getRequest()->getQuery('action');
        $this->event = Yii::app()->getRequest()->getQuery('event');
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PedidosManager');
        Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');

        $this->produtosHandler = new ProdutosManager();
        $this->pedidosHandler = new PedidosManager();
        $this->preferences = new MyPreferences();
        $this->manager = new DBManager();
        
        //Get session data
        $session = MethodUtils::getSessionData();
        
        $this->id_usuario = $session['id'];        
        $this->type_account = $session['user_account_type'];
        $this->user_name = $session['field1'] . " " . $session['field2'];
        $this->frase = $session['frase'];
        $this->avatar = $session['avatar'];

        //Verifica se o cliente esta logado ou não, se for novo cadastro sera permitido parcial
        if (Yii::app()->user->isGuest && ($this->event != "obrigado" || $this->event != "confirmar"))  $this->action = "isGuest";

        switch($this->action) {            
            case 'home':
            case 'avisos': 
            case '':           
                $this->home();
                break;
            
            case 'users': 
                $this->getController()->forward('/users/'. $this->user .'/editar');
                ActivityLogger::log('/users/'. $this->user .'/editar');
                break;                
            case 'userssupport':
            case 'users_support':
                $this->getController()->forward('/conta/userssupport/'. $this->user .'/'. $this->event .'');
                ActivityLogger::log('/conta/users_support/'. $this->user .'/editar');
                break;
            
            case 'curriculum': 
            case 'vagas':
            case 'noticias':
            case 'colunas':
            case 'publicidade':
            case 'elearn':
            case 'prospects':
            case 'permissao_negada':
                $this->getController()->forward( '/conta/'. $this->action .'/'. $this->event .'/'. $this->id);
                ActivityLogger::log('/conta/'. $this->action .'/'. $this->event .'/'. $this->id);
                break;
            
            case 'business_page':
            case 'banners':
            case 'html_banners': 
            case 'html_corona':
            case 'html_blocks':
            case 'html_mini':
            case 'html_spark':
                $this->getController()->forward('/banners/'. $this->user .'/' . $this->event);
                ActivityLogger::log('/banners/'. $this->user .'/' . $this->event);
                break;
            
            case 'regiao':            
            case 'propostas':
            case 'produtos':
            case 'chamados':
            case 'reputacao':
            case 'inscricao':            
                $this->getController()->forward('/' . $this->action . '/'. $this->event .'/'. $this->id);
                ActivityLogger::log('/conta/' . $this->action . '/'. $this->event);
                break;
            
            case 'eventos':
            case 'users_selection':
            
                $this->getController()->forward('/conta/' . $this->action . '/'. $this->event .'/'. $this->id);
                ActivityLogger::log('/conta/' . $this->action . '/'. $this->event);
                break;
            
            case 'pedidos':              
                $this->getController()->forward( '/' . $this->action . '/'. $this->event);
                ActivityLogger::log('/conta/' . $this->action . '/'. $this->event);
                break;
            
            case 'publicidade':
            case 'modulos':
            case 'vitrine':
            case 'acbeneficios':
            case 'forum':
                $this->getController()->forward( '/conta/' . $this->action . '/'. $this->id);
                ActivityLogger::log('/conta/' . $this->action . '/'. $this->id);
                break;
            
            case 'pagamento':
                $this->getController()->forward( '/' . $this->action . '/'. $this->user. '/'. $this->event);
                 ActivityLogger::log('/conta/' . $this->action . '/'. $this->user. '/'. $this->event);
                break;
            
            case 'loja':
            case 'calendario':
                $this->getController()->forward( '/conta/' . $this->action . '/'. $this->user. '/'. $this->event);
                 ActivityLogger::log('/conta/' . $this->action . '/'. $this->user. '/'. $this->event);
                break;
            
            case 'isGuest':
                if($session['pre_email'] != '') {
                     $this->getController()->redirect('/conta/users_support/cadastro_rapido'); 
                     //$this->cadastrarUser();
                }else{
                    $this->getController()->redirect("/login"); 
                }
                break;
                
            case 'sair':
                $this->logout();
                break;
            
            default:
                throw new CHttpException(404);
                break;
        }
    }
    
    /*
     * Avisos
     * It opens the homepage from conta
     *
     * Ajax method: Pay Attention on layout['plat...'].simple
     * In simple layout np there are shadowns and overlay
     *
     */
    public function home() {
        
        $result = array();
        $session = MethodUtils::getSessionData();
        
        Yii::import('application.extensions.dbuzz.site.pedidos.common.AvisosManager');
        //Yii::import('application.extensions.dbuzz.site.comentarios.InhamerManager');
        Yii::import('application.extensions.utils.admin.PreferencesViewUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.ContadorVisitasUtils');
        
        
        //$inhamerHandler = new InhamerManager();

        $this->avisos = new AvisosManager();
        
        $result = HelperUtils::getPageBundleSupreme(C::CONTA);
  
        //PF = 0 and PJ = 1
        if($this->type_account == '0') {
            $result['avisos'] = $this->avisos->getAllAvisos($this->id_usuario, "0");
            $result['label_message_1'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_meus_pedidos');
            $result['label_message_2'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_minhas_propostas_recebidas');
            $result['label_message_3'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_avaliar_owner');
            $result['label_message_4'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_my_posts');
            $result['label_message_5'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_events');
        
        }else{
            $result['avisos'] = $this->avisos->getAllAvisos($this->id_usuario, "1");
            $result['label_message_1'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_minhas_propostas_criadas');
            $result['label_message_2'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_meus_produtos');
            $result['label_message_3'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_avaliar_user');
            $result['label_message_4'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_my_posts');
            $result['label_message_5'] = Yii::t('clientes/'.Yii::app()->params['ramo'].'/labelForm', 'title_conta_events');
        }
        
        //Some additional info
        $result['type_account'] = $this->type_account; 
        $result['tipo_conta'] = UserUtils::getUserTypeString($this->type_account); 
        $result['avatar'] = $this->avatar;
        $result['user_name'] = $this->user_name;
        $result['frase'] = $this->frase;
        
        $result['acessos'] = ContadorVisitasUtils::getActionsDone("simples", "acesso_conta", "", "", $this->id_usuario);
        $result['user'] = UserUtils::getAccountCredits($this->id_usuario);
        $result['background'] = PreferencesViewUtils::getView("conta_avisos");
        $result['banner_avisos'] = PreferencesViewUtils::getAttributesByType("banner_avisos", $result['type_account']);
        $result['link_avisos'] = PreferencesViewUtils::getAttributesByType("link_avisos", $result['type_account']);
        $result['menu_conta_active'] = 'avisos';
        
        $result['inhamers'] = array();
        
        (Yii::app()->params['tecnologia'] == 0) ? $view = 'home' : $view = 'home_html5';
        
        $this->addScript("conta/main_html5", $result['layout']['layout_site']);
        $this->controller->layout = 'site/index';
        $this->controller->render("/site/pages/conta/profile/" . $view, $result);
    }
    
    /*
     * Logout 
     * 
     */
    public function logout(){
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
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
        
        $_SESSION = array();
        
        // Redireciona para a homepage do admin
        $assigned_roles = Yii::app()->authManager->getRoles(Yii::app()->user->id); //obtains all assigned roles for this user id
        if (!empty($assigned_roles)) { //checks that there are assigned roles
            $auth = Yii::app()->authManager; //initializes the authManager
            foreach ($assigned_roles as $n => $role) {
                if ($auth->revoke($n, Yii::app()->user->id)) //remove each assigned role for this user
                    Yii::app()->authManager->save(); //again always save the result

            }
        }
        
        $this->controller->redirect("/login");
    }

    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param $layout
     * @param $model
     * @internal param $string
     */
    public function addScript($layout, $model) {

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . '/css/site/content/'. $layout .'.css', 'screen', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl . '/css/site/layout/layout_'. $model .'.css', 'screen', CClientScript::POS_BEGIN);
        
        //Funcionalidades de comportamento só para a home do conta.
        //Para cada vez que esse Javascript for adicionado uma vez a mais será atachado listeners nos
        //$cs->registerScriptFile($baseUrl . '/js/site/' . $layout .'.js', CClientScript::POS_END);  
    }
}
?>