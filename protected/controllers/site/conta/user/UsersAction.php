<?php

class UsersAction extends CAction {
        
    private $cadastrarHandler;
    private $imagesHandler;
    private $coolHandler;
    private $preferences;    
    private $manager;
    private $action;
    private $event;
    private $id;

    /**
     *
     * User Action
     * Specific Controller
     *
     */
    public function run(){  
           
        $this->action = Yii::app()->getRequest()->getQuery('action');                  
        $this->event = Yii::app()->getRequest()->getQuery('event');
        $this->id = Yii::app()->getRequest()->getQuery('id');
         
        //Bug fix
        if($this->event == "obrigado")$this->action = 'obrigado'; 
        if($this->event == "atualizado")$this->action = 'atualizado';
        
        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PedidosManager');        
        Yii::import('application.extensions.dbuzz.admin.CoolManager');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        Yii::import('application.extensions.utils.TermsCondictionsUtils');
        Yii::import('application.extensions.utils.DicasUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $this->cadastrarHandler = new PedidosManager();
        $this->preferences = new MyPreferences();
        $this->manager = new DBManager(); 
        
        //Pega os avatars
        $this->coolHandler = new CoolManager();
        $this->imagesHandler = new ImagesManager();

        switch($this->action){

            case "pf": 
            case "pj":
                switch($this->event){
                    case "criar":
                    case "novo":
                    case "":
                        $this->criarUsuario();
                        break;

                    case "editar":                        
                        $this->editarUsuario();
                        break;
                    
                    case "listar":
                    case "listar_pj":
                    case "listar_pf":
                        $this->listarUsuarios();
                        break;

                    case "salvar":
                        $this->salvarUsuario();
                        break;
                    
                    case "company":
                        $this->dadosEmpresa();
                        break;
                    
                    case "adicionar_company":
                        $this->adicionarEmpresa();
                        break;
                    
                    case "pre_cadastro":
                        $this->preCadastro();
                        break;
                    
                    case "participar":
                        $this->participar();
                        break;
                } 
                break;
            
            case "admin":
                switch($this->event){
                    case "criar":
                    case "novo":
                    case "pf":
                    case "pj":
                    case "":
                        $this->criarUsuario();
                        break;
                   
                    case "listar": 
                        $this->listarUsuarios();
                        break;
                    
                    case "deletar":                        
                        $this->removerUsuario();
                        break;

                    case "salvar_pf":
                        $this->salvarUsuario();
                        break;
                    
                    case "salvar_pj":
                        $this->salvarUsuario();
                        break;
                    
                     case "aniversariantes":
                        $this->listarAniversariantes();
                        break;
                    
                    case "clientes": 
                        $this->listarClientesTipo('cliente');
                        break;
                    
                    case "parceiros": 
                        $this->listarClientesTipo('parceiros');
                        break;
                    
                    case "profissionais": 
                        $this->listarClientesTipo('profissional');
                        break;
                    
                    case "salvar_by_tag": 
                        $this->salvarClienteByTag();
                        break;
                    
                    case "salvar_detalhes_by_tag": 
                        $this->salvarDetalhesByTag();
                        break;
                }
                break;
            case "pre_cadastro":
                $this->preCadastro();
                break;
                    
            case "editar_pf":                        
                $this->editarUsuario();
                break; 
            
            case "editar_pj":                        
                $this->editarUsuario();
                break;

            case "obrigado":
            case "atualizado":
                $this->cadastroConfirmado($this->action);
                break;
            
            case "account_lock":
                $this->changeAccountLockStatus();
                break;
            
            case "account_status":
                $this->changeAccountLockStatus(true);
                break;
            
            case "salvar_endereco":
                $this->salvarEndereco();
                break;
            
            case "change_password":
                $this->alterarPassword();
                break;
            
            case "change_password_site":
                $this->alterarPassword(true);
                break;       
            
            case "cadastrar_rapido":
                $this->saveUserRapido();
                break;
            
            //PurplePier Only
            case "editar_cliente": 
                $this->editarClienteByTag('cliente');
                break;
            
            case "editar_parceiros": 
                $this->editarClienteByTag('parceiro');
                break;
            
            case "editar_profissional": 
                $this->editarClienteByTag('profissional');
                break;
            
            case "editar_funcionario": 
                $this->editarClienteByTag('funcionario');
                break;
            
            case "drill_account":      
                $this->getController()->forward( "/users/drill_account/". $this->event . "/" .  $this->id);
                break;
            
            //PurplePier Only
            case "detalhes_cliente": 
                $this->detalhesUserByTag('cliente');
                break;
            
               
            //Some actions are needed pass-trough this selector
            case "confirmar":
            case "nova_senha":
            case "buscar_pj":
            case "buscar_pf":
            case "buscar_pj_json":
            case "buscar_main_user_json":
            case "exibir_pf":
            case "exibir_pj":
            case "exibir":
            case "mapa_comercio":
            case "follow_user":
            case "check_cnpj":
                if($this->event != "c_104" && $this->event != "c_96") $this->getController()->forward( "/users/" . $this->action . "/". $this->event . "/" .  $this->id);
                break;
            case "":
                if(Yii::app()->params['nicho'] == "" ||  Yii::app()->params['nicho'] != "pj"){$user_type = "buscar_pj";}else{$user_type = "buscar_pf";};
                //$this->getController()->forward( "/users/".$user_type."/flor");             
                break;
            
            case "paginar_pf":
            case "paginar_pj":
                $this->listarUsuarios(true);
                break;
            
            case "rede_beneficios":
            case "associado":
            case "profissional":
            case "cliente":
            case "acessor":
            case "colunista":
            case "funcionario":        
            case "desenvolvedor":
            case "parceiro":
            case "representante":
            case "atendimento":
            case "administrador":
            case "prospectador":
            case "fornecedor":
            case "aluno":
                $this->listarKindOfUsers(true);
                break;
            
            case 'todos';
                $this->listarUsuarios(true);
                break;
            
            case 'remover_tag';
                $this->removerTag();
                break;
        }
    }
    
    /*
     * Criar pre cadastro
     * It creates a new pre record pessoa fisica
     *
     */
    public function preCadastro(){ 
        
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        $valida = new dbValidar();

        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;

        $session = new CHttpSession;
        $session->open();

        $data['ERROR'] = '0';
        $data['status'] = "";
        $data['type'] = $_POST['preType'];
        if(isset($_POST['behaviour'])) $data['behaviour'] = $_POST['behaviour'];
        if(isset($_POST['operadora'])) $data['operadora'] = $_POST['operadora'];
        

        if($isPostRequest){
            
            //Validates the data submited
            if(!isset($data['behaviour'])){
                if($data['type'] == "1"){                
                    if(isset($_POST['loginCadastradoCNPJ'])){$isCNPJValid = $valida->cnpj($_POST['loginCadastradoCNPJ']);}else{$isCNPJValid =true;}
                    if(!$isCNPJValid ? $error[1] = "CNPJ digitado inválido" : ""); 
                }else{                
                    if(isset($_POST['loginCadastradoCPF'])){$isCPFValid = $valida->cpf($_POST['loginCadastradoCPF']);}else{$isCPFValid = true;}
                    if(!$isCPFValid ? $error[1] = "CPF digitado inválido" : "");
                }
            }                     
            
            $isEmailValid = $valida->email($_POST['loginCadastradoEmail']); 
            if(!$isEmailValid ? $error[0] = "E-mail digitado inválido" : "");           
            
            if(isset($error) && count($error) > 0){
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
                //Repopular o Formulario
                foreach ($_POST as $key => $value){
                    $data[$key] = $value;
                }
            }else{
                $user = User::model()->find('email=:email', array(':email'=>$_POST['loginCadastradoEmail']));                
                if($user != NULL){                    
                    $data['ERROR'] = '1';
                    $data['id'] = $user->id;
                    $data['account_states'] = $user->account_states_id;   
                    $data['type'] = $user->type; 
                    $data['status'] = "Email já cadastrado"; 
                    ActivityLogger::log("Email já cadastrado");
                }else{
                    $data['email'] = $_POST['loginCadastradoEmail'];                    
                    //Put the values form form into the session
                    $session->add('pre_email', $_POST['loginCadastradoEmail']); 
                    $session->add('pre_type', $data['type']);  
                    if($data['type']=="1" && isset($_POST['loginCadastradoCNPJ']))$session->add('pre_numero', $_POST['loginCadastradoCNPJ']);
                    if($data['type']=="0" && isset($_POST['loginCadastradoCPF']))$session->add('pre_numero', $_POST['loginCadastradoCPF']);
                    if(isset($data['behaviour'])) $session->add('pre_celular', $_POST['loginCadastradoTelefone']);
                    if(isset($data['operadora'])) $session->add('pre_operadora', $_POST['operadora']);
                    ActivityLogger::log($_POST['loginCadastradoEmail']);
                }                               
            }
        }
        echo json_encode($data);       
    }
    
    /*
     * List users 
     * 
     * It lists all records from the user_data table
     * 
     *
     */
    public function listarUsuarios($isPaginar = false, $start = 0){
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');  
        Yii::import('application.extensions.utils.DataBaseUtils');
        $userHandler = new UsersManager();
        
        try{
            $tipo = 0; if($this->action == "pj" || $this->event == "listar_pj" || $this->action == "paginar_pj")$tipo = 1;
            
            $layout = $this->manager->getLayout();
            $result['menu_principal'] = $this->manager->getMenu();
            $result['plataform'] = $layout["plataform"];
            $result['preferences'] = $this->preferences->getPreferences();
            $result['isBanner'] = $this->manager->getBannerMainShow("users");
                
            if($this->event != ''){ $result['ind'] = 0; $start = $this->event; if($start <= 0) $start = 0;}else{$result['ind'] = 0;}
            $result['content'] = $userHandler->getAllContent($tipo, $start);
            
            $result['qtd_users'] = DataBaseUtils::getCountRecords("user_data", "", "", true);
            $result['qtd_cat'] = DataBaseUtils::getCountRecords("user_data", "type", $tipo, false);
            $result['type_account_string'] = $this->action;
            
            //Paginacao
            if($result['ind'] == 'listar_pf' || $result['ind'] == 'listar_pj') $result['ind'] = 0;
            $result['action'] = $this->action;$result['type'] = $tipo;
            $result['paginacao'] = MethodUtils::getPaginationAttributes($result, 'users');
            

            //Easy way to get if it's an admin or account
            if($this->event == "listar_pj" || $this->event == "listar_pf" || $isPaginar){            

                $result['dicas'] = DicasUtils::getTips("list", "user");

                $this->addScript2("user");        
                $this->controller->layout = "admin/admin";
                $this->controller->render("pages/users/listar", $result);

            }else{
                

                $this->addScript("criar_pf", $layout['layout_site']);        
                $this->controller->layout = "site/index";
                $this->controller->render("/site/pages/conta/users/listar", $result);
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /*
     * List users 
     * 
     * It lists all records from the user_data table
     * 
     *
     */
    public function listarAniversariantes(){ 
        
        try{
            //Pega os aniversariantes do mês
            $result['content'] = UserUtils::getBirthdays();
            $result['type_account_string'] = $this->action;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", 'aniversariantes');
        
        $this->addScript2("user");        
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/users/aniversariantes", $result);  
    }
       
    /*
     * List clients by tag
     * 
     * It lists all records from the user_data table
     * 
     *
     */
    public function listarClientesTipo($tipo){ 
        
        try{
            //Pega os clientes pela tag
            $result['content'] = UserUtils::getAllKindUsers($tipo);
            $result['tipo'] = $tipo;
        
            $result['dicas'] = DicasUtils::getTips("list", 'clientes_purplepier');

            $this->addScript2("user");        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/users/clientes_purplepier", $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserAction - listarClientesTipo() ' . $e->getMessage();
        }
    }
    
    /*
     * Edit client tipo pela tag 
     * 
     * It lists all records from the user_data table
     * 
     *
     */
    public function editarClienteByTag($tipo){
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.DBManager');

        $manager = new DBManager();
        $categoriasHandler = new CategoriaManager();
        
        $id_user = $this->event;
        
        try{
            //Edita o cliente de acordo com sua tag
            $result['content'] = UserSupportUtils::getUserByTag($tipo, $id_user);
            
            $result['dicas'] = DicasUtils::getTips("list", 'clientes_purplepier');
            
            if($tipo == "funcionario" || $tipo == "cliente"){
                //Categorias
                ($tipo == "funcionario") ? $erp_cat = 'erp_0' : $erp_cat = 'erp_1';
                $result['controller'] = $manager->getController($erp_cat);
                $result['categorias'] = $categoriasHandler->getAllContentById($result['controller']['id']);
            }
            
            //ERP
            (Yii::app()->params['erp_ramo'] == '') ? $path = "common" : $path = Yii::app()->params['erp_ramo'];
           
            $this->addScript2("user");        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/users/specific/$path/" . $result['content']['view'], $result); 
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserAction - editarClienteByTag() ' . $e->getMessage();
        }
    }
    
    /*
     * Salvar clientes by tag
     * 
     * Saves into user_data table* 
     *
     */
    public function salvarClienteByTag(){
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        try{            
            $result = UserSupportUtils::saveUserByTag();
            
            echo Yii::t('messageStrings', 'message_common_update');

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserAction - salvarClienteByTag() ' . $e->getMessage();
        }        
    }
    
    /*
     * Edit detalhes user tipo pela tag 
     * 
     * It edits user_attributes table
     * 
     *
     */
    public function detalhesUserByTag($tipo){
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.DBManager');

        $manager = new DBManager();
        $categoriasHandler = new CategoriaManager();
        
        try{
            //Edita o cliente de acordo com sua tag
            $result['id_user'] = $this->event;
            $result['content'] = UserSupportUtils::getUserDetailsByTag($tipo, $result['id_user']);            
            $result['dicas'] = DicasUtils::getTips("list", 'clientes_purplepier');      

            $this->addScript2("user");        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/users/details/" . $result['content']['view'], $result); 
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserAction - detalhesUserByTag() ' . $e->getMessage();
        }
    }
    
    /*
     * Salvar clientes by tag
     * 
     * Saves into user_data table* 
     *
     */
    public function salvarDetalhesByTag(){
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        try{            
            $result = UserSupportUtils::saveDetalhesByTag();
            
            echo Yii::t('messageStrings', 'message_common_update');

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserAction - salvarDetalhesByTag() ' . $e->getMessage();
        }        
    }
    
    /*
     * Criar Pessoa Jurídica e Física
     * Cria novo registro de pessoa jurídica e/ou pessoa jurídica
     *
     */
    public function criarUsuario(){    
  
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        
        $valida = new dbValidar();
        
        try{
            $layout = $this->manager->getLayout();
            $data['menu_principal'] = $this->manager->getMenu();
            $data['plataform'] = $layout["plataform"];
            $data['text'] = $this->manager->getText(C::CONTA);
            $data['preferences'] = $this->preferences->getPreferences();
            //$data['avatar'] = $this->coolHandler->getAllAvatars();
            $data['isBanner'] = $this->manager->getBannerMainShow("users");
            $data['menu_conta_active'] = 'profile';
            $data['menu_active'] = 'conta';
            
            //Get the current controller name
            $controllerSelector = $this->getController()->getId();

            //Termos de aceitação
            $termo = TermsCondictionsUtils::getTermos();
            $data['termos'] = $termo;

            $request = Yii::app()->request;
            $isPostRequest = $request->isPostRequest;       

            $session = MethodUtils::getSessionData();

            $data['ERROR'] = '0';

            if($data['ERROR'] == '0'){

                $data['loginCadastradoEmail'] = "";
                $data['loginCadastradoTipoNumero'] = "";

                $data['loginCadastradoEmail'] = $session['pre_email'];
                $data['loginCadastradoTipoNumero'] = $session['pre_numero']; 
                
                //$data['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();

                if($this->action == "pj"){
                    $data['formCadastroRazao'] = "";
                    $data['formCadastroFantasia'] = "";
                    $data['formCadastroInscricao'] = "";
                    $data['formCadastroResponsavel'] = "";
                    $data['formInfoFaxddd'] = "";
                    $data['formInfoFax'] = "";
                    
                    $data['formIdRamoAtuacao'] = 0;
                    $view = "criar_pj";
                    (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pj" : $view = "criar_pj_html5";
                }else{
                    $data['formCadastroNome'] = "";
                    $data['formCadastroSobrenome'] = "";
                    $data['formCadastroRg'] = "";
                    $data['formCadastroNascimento'] = "";
                    $data['formInfoCelddd'] = "";
                    $data['formInfoCel'] = "";
                    $data['profissao'] = '';
                    $data['formIdRamoAtuacao'] = 0;
                    $data['estado_civil'] = "";
                    $view = "criar_pf";
                    (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pf" : $view = "criar_pf_html5";
                }

                $data['formFrase'] = "";
                $data['keywords'] = "";

                $data['formCredencialSenha'] = "";
                $data['formCredencialConfirma'] = "";
                $data['formInfoSms'] = "1"; //Checkbox
                $data['formInfoTelddd'] = "";
                $data['formInfoTel'] = "";
                $data['formInfoTwitter'] = "";
                $data['formInfoFacebook'] = "";
                $data['formCodAfiliacao'] = "";
                $data['formInfoNewsletter'] = "1"; //Checkbox
                $data['formTermosAceito'] = "1"; //Checkbox

                //User_Address
                $data['formEnderecoCep'] = "";
                $data['formEnderecoBairro'] = "";
                $data['formEnderecoEndereco'] = "";
                $data['formEnderecoNumero'] = "";
                $data['formEnderecoComplemento'] = "";
                $data['formEnderecoCidade'] = "";
                $data['formEnderecoEstado'] = "";

                //INICIALIZAÇÃO DA FORM
                $data['formInfoNewsletterCHECKED'] = 1;
                $data['formInfoSmsCHECKED'] = 1;
                $data['formTermosAceitoCHECKED'] = 1;

                //Gets the avatar path image
                $data['formAvatar'] = "/media/images/avatar/avatar_profile.jpg";
                $data['pool_id'] = "";

                $data['title_dica'] = "Dica: Códico de afilicação";
                $data['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
                $data['link_dica']  = "/site/associese/";

                $data['user_id'] = "";
                $data['action'] = "novo";
                $data['type_account'] = UserUtils::getUserType($this->action);
                $data['type_account_string'] = $this->action;

                $data['user_attributes'] = UserUtils::getUserTypeAttr(0);

            }else{
                //if the request doesnt include a user email and number, redirect to home
                $this->controller->redirect(Yii::app()->homeUrl);
            }

            //TOKENIZER
            $data['token_cc_conta'] = uniqid("cc_conta_");
            $session->add('token_cc_conta', $data['token_cc_conta']);
            $data['session'] = $session;
            //NAO ALTERAR ACIMA

            $this->addScript($view, $layout['layout_site']);

            //Verifica se esta no admin
            if($controllerSelector == "admin"){
                $data['FORM_SUBMIT_TO'] = "/admin/users/". $this->action. "/salvar";
                $data['preferences']['design_site'] = "empty";
                $this->controller->layout = "admin/admin";    
                $this->controller->render('/admin/pages/users/'. $view, $data);
            }else{
                $data['FORM_SUBMIT_TO'] = "/conta/users/". $this->action. "/salvar";
                $this->controller->layout = $layout["plataform"]. "/index";
                $this->controller->render('/site/pages/conta/users/criar_pf', $data);
            }  
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
    }

    /*
     * Editar Pessoa Jurídica
     * Edita um registro de pessoa jurídica
     *
     */
    public function editarUsuario(){

        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;

        if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::CONTA);
        if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::CONTA);
        $data['menu_conta_active'] = 'profile';

        $valida = new dbValidar();
        
        //Termos de aceitação
        $termo = TermsCondictionsUtils::getTermos();
        $data['termos'] = $termo;

        $session = MethodUtils::getSessionData();
        $id_user = $session['id'];

        $this->controller->user_account_states_id = $session['user_account_states_id'];

        $data['ERROR'] = '0';

        //Form Token ID
        $tokenName = "token_cc_editar_conta";
        
        //Get the current controller name
        $controllerSelector = $this->getController()->getId();
        
        //Set the id user
        if($this->event != $session['id'] && $this->event != "editar"){
            $id_user = $this->event;
        }
        
        $sql = "id = '" . $id_user . "'";
        $user = User::model()->find($sql);

        $data['formCadastroNome'] = $user->field1;
        $data['formCadastroSobrenome'] = $user->field2;
        $data['loginCadastradoEmail'] = $user->email;
        
        //Get type account, and id account: it's a bug fix to work with Administrador 
        $type_user = UserUtils::getUserTypeString($this->action);
        $data['type_account_string'] = $type_user;

        $data['user_id'] = $id_user;
        
        $data['user_attributes'] = UserUtils::getUserTypeAttr($id_user);

        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');

        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id_user);
        
        $data['formInfoTelddd'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 0, 2);
        $data['formInfoTel'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 2, 8);
        $data['formCadastroInscricao'] = $ua->recuperar('usuario_InscricaoEstadual');
        $data['formCadastroResponsavel'] = $ua->recuperar('usuario_Responsavel');
        $data['formInfoTwitter'] = $ua->recuperar('usuario_Twitter');
        $data['formInfoFacebook'] = $ua->recuperar('usuario_Facebook');
        $data['formInfoCodAfiliacao'] = $ua->recuperar('usuario_CodAfiliacao');
        $data['formInfoNewsletterCHECKED'] = $user->receive_news;
        $data['formInfoSms'] = $ua->recuperar('usuario_SMS');
        $data['formInfoSmsCHECKED'] = ($ua->recuperar('usuario_SMS') == "Sim" ? true : false);
        $data['formInfoNewsletterCHECKED'] = ($user->receive_news == "1" ? true : false);

        $sql = "user_id = '" . $id_user . "' AND address_types_id = 1";
        $uAddress = UserAddress::model()->find($sql);
        
        if ($uAddress != null) {
            $data['formEnderecoCep'] = $uAddress->zip;
            $data['formEnderecoEndereco'] = $uAddress->address;
            $data['formEnderecoNumero'] = $uAddress->number;
            $data['formEnderecoComplemento'] = $uAddress->complement;
            $data['formEnderecoCidade'] = $uAddress->city;
            $data['formEnderecoEstado'] = $uAddress->state;
            $data['formEnderecoBairro'] = $uAddress->bairro;
        }else{
            $data['formEnderecoCep'] = "";
            $data['formEnderecoEndereco'] = "";
            $data['formEnderecoNumero'] = "";
            $data['formEnderecoComplemento'] = "";
            $data['formEnderecoCidade'] = "";
            $data['formEnderecoEstado'] = "";
            $data['formEnderecoBairro'] = "";
            $uAddress = new UserAddress();
        }

        $sql = "user_id = '" . $id_user . "' AND address_types_id = 2";
        $uAddress2 = UserAddress::model()->find($sql);

        if ($uAddress2 != null) {
            $data['formEndereco2CepInicio'] = substr($uAddress2->zip, 0, 5);
            $data['formEndereco2CepFim'] = substr($uAddress2->zip, 5, 3);
            $data['formEndereco2Endereco'] = $uAddress2->address;
            $data['formEndereco2Numero'] = $uAddress2->number;
            $data['formEndereco2Complemento'] = $uAddress2->complement;
            $data['formEndereco2Cidade'] = $uAddress2->city;
            $data['formEndereco2Estado'] = $uAddress2->state;
        } else {
            $data['formEndereco2CepInicio'] = "";
            $data['formEndereco2CepFim'] = "";
            $data['formEndereco2Endereco'] = "";
            $data['formEndereco2Numero'] = "";
            $data['formEndereco2Complemento'] = "";
            $data['formEndereco2Cidade'] = "";
            $data['formEndereco2Estado'] = "";
            $uAddress2 = new UserAddress();
        }
        
        if($this->action == "pj" || $this->action == "editar_pj"){
            $data['formCadastroRazao'] = $user->field1;
            $data['formCadastroFantasia'] = $user->field2;
            $data['formInfoTelddd'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 0, 2);
            $data['formInfoTel'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 2, 8);
            $data['formInfoCelddd'] = substr($ua->recuperar('usuario_Celular', 'texto'), 0, 2);
            $data['formInfoCel'] = substr($ua->recuperar('usuario_Celular', 'texto'), 2, 9);
            $data['formInfoFaxddd'] = substr($ua->recuperar('usuario_Fax', 'inteiro'), 0, 2);
            $data['formInfoFax'] = substr($ua->recuperar('usuario_Fax', 'inteiro'), 2, 8);
            $data['formCadastroInscricao'] = $ua->recuperar('usuario_InscricaoEstadual');
            $data['formCadastroResponsavel'] = $ua->recuperar('usuario_Responsavel');
            
            $data['loginCadastradoTipoNumero'] = $ua->recuperar('usuario_CNPJ'); 
            $view = "criar_pj";
            (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pj" : $view = "criar_pj_html5";
        }else{
            Yii::import('application.extensions.utils.DateTimeUtils');
            $data['formCadastroRg'] = $ua->recuperar('usuario_RG');
            $data['formCadastroNascimento'] = DateTimeUtils:: getDateFormatCommonNoTime($user->birthday);
            $data['formCadastroSexoCHECKED'] = $ua->recuperar('usuario_Sexo');
            $data['formInfoTelddd'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 0, 2);
            $data['formInfoTel'] = substr($ua->recuperar('usuario_Telefone', 'texto'), 2, 8);
            $data['formInfoCelddd'] = substr($ua->recuperar('usuario_Celular', 'texto'), 0, 2);
            $data['formInfoCel'] = substr($ua->recuperar('usuario_Celular', 'texto'), 2, 9);
            $data['operadoraCel'] = $ua->recuperar('usuario_operadora', 'inteiro');
            $data['loginCadastradoTipoNumero'] = $ua->recuperar('usuario_CPF');
            $data['profissao'] = $ua->recuperar('usuario_Profissao');
            $data['estado_civil'] = $ua->recuperar('usuario_EstadoCivil', 'inteiro');
            (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pf" : $view = "criar_pf_html5";
        }      
        
        $data['formAvatar'] = $user->avatar;
        //$data['avatar'] = $this->coolHandler->getAllAvatars();
        
        $data['formIdRamoAtuacao'] = $user->id_ramo_atuacao;
        //$data['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();
        
        $data['formCredencialSenha'] = "******";
        $data['formCredencialConfirma'] = "******";
        $data['formCodAfiliacao'] = $ua->recuperar('usuario_CodAfiliacao');
        $data['title_dica'] = "Dica: Códico de afilicação";
        $data['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
        $data['link_dica']  = "/site/associese/";
        $data['formFrase'] = $user->frase;
        $data['keywords'] = $user->keywords;

        $data['formInfoNewsletterCHECKED'] = $user->receive_news;
        $data['formInfoSmsCHECKED'] = 0;
        $data['formTermosAceitoCHECKED'] = 1;
        $data['formInfoNewsletter'] = 0;
        $data['formInfoSms'] = 0;
        $data['formTermosAceito'] = 0;
        $data['pool_id'] = "-1";
        $data['action'] = "editar";                

        //TOKENIZER
        $data['token_cc_conta'] = uniqid("cc_conta_");
        $session->add('token_cc_conta', $data['token_cc_conta']);
        $data['session'] = $session;
        //NAO ALTERAR ACIMA
        
        $this->addScript($view, $data['layout']['layout_site']);
        
        //Verifica se esta no admin
        if($controllerSelector == "admin"){
            $data['FORM_SUBMIT_TO'] = "/admin/users/".$type_user. "/salvar";
            $data['preferences']['design_site'] = "empty";
            $this->controller->layout = "admin/admin";
        }else{
            $data['FORM_SUBMIT_TO'] = "/conta/users/".$type_user. "/salvar";
            $this->controller->layout = "site/index";
        }              

        $this->controller->render('/site/pages/conta/users/' . $view, $data);       
    }

    /*
     * Salvar Pessoa Jurídica ou Pessoa Física
     *
     */
    public function salvarUsuario(){
       
        try{
            $layout = $this->manager->getLayout();
            $data['menu_principal'] = $this->manager->getMenu();
            $data['plataform'] = $layout["plataform"];
            $data['preferences'] = $this->preferences->getPreferences();
            $data['avatar'] = $this->coolHandler->getAllAvatars();
            $data['isBanner'] = $this->manager->getBannerMainShow("users");
            $data['menu_active'] = 'conta';
            $data['menu_conta_active'] = 'profile';

            if($this->event == 'savar_pf') $this->action =  $this->event;
            if($this->event == 'savar_pj') $this->action =  $this->event;

            Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
            Yii::import('application.extensions.utils.StringUtils');

            $valida = new dbValidar();

            //Termos de aceitação
            $termo = TermsCondictionsUtils::getTermos();
            $data['termos'] = $termo;

            $request = Yii::app()->request;
            $isPostRequest = $request->isPostRequest;

            $session = new CHttpSession;
            $session->open();

            $data['ERROR'] = '0';        

            if($isPostRequest){
                //Handler dos Checkbox e Handlers
                $data['formTermosAceitoCHECKED'] = (isset($_POST['formTermosAceito']) ? true : false);
                $data['formInfoNewsletterCHECKED'] = (isset($_POST['formInfoNewsletter']) ? true : false);

                $_POST['formTermosAceito'] = (isset($_POST['formTermosAceito']) ? "1" : "0");
                $_POST['formInfoNewsletter'] = (isset($_POST['formInfoNewsletter']) ? "1" : "0");

                //Adds the owner logo into session
                $session['avatar'] = $_POST['formAvatar'];

                //Gets the avatar path image
                $data['formAvatar'] = $_POST['formAvatar'];
                $data['formFrase'] = $_POST['formFrase']; //Frase
                $data['action'] = $this->event;

                $user = new User();
                //if we are editing an already existing user, this will be set
                if(isset($_POST['user_id']) && $_POST['user_id'] != ""){
                    $data['editar'] = true;
                    $user_id = $_POST['user_id'];
                    $user = User::model()->find('id=:userID', array(':userID'=>$_POST['user_id']));

                }else{
                    $data['editar'] = false;
                    $data['id_pool'] = "-1";
                }          

                // Barra campos obrigatórios que estejam vazios
                if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){
                    ($_POST['formCadastroRazao'] == "" ? $error[] = "É necessário preencher o campo Razão Social" : "");
                    ($_POST['formCadastroFantasia'] == "" ? $error[] = "É necessário preencher o campo Nome Fantasia" : "");
                    if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['loginCadastradoTipoNumero'] == "" ? $error[] = "É necessário preencher o campo CNPJ" : "");
                    if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formIdRamoAtuacao'] == "" ? $error[] = "É necessário preencher o campo Ramo de Atuação" : "");
                    ($_POST['formCadastroResponsavel'] == "" ? $error[] = "É necessário preencher o campo Responsável" : "");
                }else{

                    ($_POST['formCadastroNome'] == "" ? $error[] = "É necessário preencher o campo Nome" : "");
                    ($_POST['formCadastroSobrenome'] == "" ? $error[] = "É necessário preencher o campo Sobrenome" : "");
                    if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['loginCadastradoTipoNumero'] == "" ? $error[] = "É necessário preencher o campo CPF" : "");
                    if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formCadastroRg'] == "" ? $error[] = "É necessário preencher o campo Rg" : "");
                    ($_POST['formCadastroNascimento'] == "" ? $error[] = "É necessário preencher o campo data nascimento" : ""); 
                    if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formCadastroNascimento'] == "00/00/0000" ? $error[] = "É necessário preencher o campo data nascimento" : "");
                    ($_POST['formCadastroSexo'] == "" ? $error[] = "É necessário preencher o campo sexo" : ""); 
                }

                ($_POST['loginCadastradoEmail'] == "" ? $error[] = "É necessário preencher o campo E-mail" : "");            
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formEnderecoCep'] == "" ? $error[] = "É necessário preencher o campo CEP" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formEnderecoEndereco'] == "" ? $error[] = "É necessário preencher o campo Endereço" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formEnderecoNumero'] == "" ? $error[] = "É necessário preencher o campo Numero" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formEnderecoCidade'] == "" ? $error[] = "É necessário preencher o campo Cidade" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formEnderecoEstado'] == "" ? $error[] = "É necessário preencher o campo Estado" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3 && !$data['editar'])($_POST['formCredencialSenha'] == "" ? $error[] = "É necessário preencher o campo Senha" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formCredencialSenha'] != "" && strlen($_POST['formCredencialSenha']) < 6 ? $error[] = "A senha tem que ter pelo menos 6 caracteres" : "");
                if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($_POST['formCredencialConfirma'] != $_POST['formCredencialSenha'] ? $error[] = "A senha tem que ser a mesma nos dois campos" : "");
                ($_POST['formTermosAceito'] != "1" ? $error[] = "É necessário Ler e ACEITAR os Termos e Condições" : "");
                (strlen($_POST['formInfoTelddd']) < 2 || strlen($_POST['formInfoTel']) < 8 ? $error[] = "É necessário preencher o campo Tel. fixo com um número válido" : "");



                if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){
                    $data['usuario_Nome']  = StringUtils::StringToLowerCase($_POST['formCadastroResponsavel']);
                    
                }else{
                    $data['usuario_Nome']  = StringUtils::StringToLowerCase($_POST['formCadastroNome'] . " " . $_POST['formCadastroSobrenome']);;
                }
                
                $user->id_ramo_atuacao = $_POST['formIdRamoAtuacao'];
                $data['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();
                
                //Get the current controller name
                $controllerSelector = $this->getController()->getId();
                $type_user = UserUtils::getUserTypeString($this->action);

                //Handle with errors
                if(isset($error) && count($error) > 0){
                    foreach ($user->getErrors() as $key => $value) $error[] = $value[0];
                    $data['ERROR'] = '1'; $data['ERROR_MSG'] = $error;
                    //Repopular o Formulario
                    foreach ($_POST as $key => $value) $data[$key] = $value;
                    if($this->action == "pj" || $this->action == "editar_pj"){$view = "criar_pj";}else{$view = "criar_pf";}
                    if((Yii::app()->params['tecnologia'] == 1 && $controllerSelector != 'admin')) if($this->action == "pj" || $this->action == "editar_pj"){$view = "criar_pj_html5";}else{$view = "criar_pf_html5";}
                    $error = true;

                }else{ 
                    $error = false;
                    //Save User data
                    if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){$data['type_account'] = 1;}else{$data['type_account'] = 0;}

                    $user->email = $_POST['loginCadastradoEmail'];
                    $user->email_hash = md5($_POST['loginCadastradoEmail'] . $_POST['loginCadastradoTipoNumero']);

                    $user->avatar = $_POST['formAvatar']; //Avatar
                    $user->frase = $_POST['formFrase'];//Frase
                    $user->type = $data['type_account'];

                    if(!$data['editar']) {
                        $user->password = md5($_POST['formCredencialSenha']);
                        $user->account_states_id = 1; //Account Initial State
                    }

                    if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){
                        $user->field1 = StringUtils::StringToLowerCase($_POST['formCadastroRazao']);
                        $user->field2 = StringUtils::StringToLowerCase($_POST['formCadastroFantasia']);
                        
                        $view = "criar_pj";                        
                        (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pj" : $view = "criar_pj_html5";

                    }else{
                        Yii::import('application.extensions.utils.DateTimeUtils');
                        $user->field1 = StringUtils::StringToLowerCase($_POST['formCadastroNome']);
                        $user->field2 = StringUtils::StringToLowerCase($_POST['formCadastroSobrenome']);
                        $user->birthday = DateTimeUtils::setFormatDateNoTime($_POST['formCadastroNascimento']);
                        $view = "criar_pf";                       
                        (Yii::app()->params['tecnologia'] == 0 || $controllerSelector == 'admin') ? $view = "criar_pf" : $view = "criar_pf_html5";
                    }
                    
                    //keywords
                    if(isset($_POST['keywords'])) $user->keywords = $_POST['keywords'];
                    
                    $user->receive_news = $_POST['formInfoNewsletter'];
                    //For searching
                    $user->cidade = addslashes($_POST['formEnderecoCidade']);
                    $user->bairro = addslashes($_POST['formEnderecoBairro']);
                    
                    $user->save();

                    $user_id = $user->id;

                    //Save User Address
                    $userAddress = new UserAddress();                
                    $addressVerify = UserAddress::model()->find('user_id=:userID', array(':userID'=>$_POST['user_id']));
                    if($data['editar'] && $addressVerify)$userAddress = UserAddress::model()->find('user_id=:userID', array(':userID'=>$_POST['user_id']));

                    $userAddress->user_id = $user_id;
                    $userAddress->address = addslashes($_POST['formEnderecoEndereco']);
                    $userAddress->address_types_id = 1;
                    $userAddress->city = addslashes($_POST['formEnderecoCidade']);
                    
                    

                    if(isset($_POST['formEnderecoComplemento']))$userAddress->complement = $_POST['formEnderecoComplemento'];

                    $userAddress->number = $_POST['formEnderecoNumero'];
                    $userAddress->state_id = $_POST['formEnderecoEstado'];
                    $userAddress->zip = $_POST['formEnderecoCep'];
                    $userAddress->bairro = addslashes($_POST['formEnderecoBairro']);

                    $userAddress->save();

                    //Save User Attributes
                    Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');

                    $ua = new dbUserAttribute();
                    $ua->setCurrentUser($user_id);

                    if(isset($_POST['formInfoTwitter']) && $_POST['formInfoTwitter'] != '') $ua->adicionar("usuario_Twitter", $_POST['formInfoTwitter']);
                    if(isset($_POST['formInfoFacebook']) && $_POST['formInfoFacebook'] != '') $ua->adicionar("usuario_Facebook", $_POST['formInfoFacebook']);

                    if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){
                        $ua->adicionar("usuario_CNPJ", $_POST['loginCadastradoTipoNumero']);
                        $ua->adicionar("usuario_InscricaoEstadual", $_POST['formCadastroInscricao']);
                        $ua->adicionar("usuario_Responsavel", $data['usuario_Nome']);
                        if(isset($_POST['formInfoFaxddd']) && isset($_POST['formInfoFax']))$ua->adicionar("usuario_Fax", $valida->replace($_POST['formInfoFaxddd'] . $_POST['formInfoFax']), 'inteiro');

                    }else{
                        $ua->adicionar("usuario_CPF", $_POST['loginCadastradoTipoNumero']);
                        $ua->adicionar("usuario_RG", $_POST['formCadastroRg']);                        
                        $ua->adicionar("usuario_Sexo", $_POST['formCadastroSexo']);
                        if((isset($_POST['formInfoCelddd']) && isset($_POST['formInfoCel'])) && $_POST['formInfoCel'] != "") $ua->adicionar("usuario_Celular", $valida->replace($_POST['formInfoCelddd'] . $_POST['formInfoCel']), 'texto');
                        
                        if(isset($_POST['estado_civil'])) $ua->adicionar("usuario_EstadoCivil", $_POST['estado_civil'], 'inteiro');
                        if(isset($_POST['profissao'])) $ua->adicionar("usuario_Profissao", $_POST['profissao']);
                    }
                  
                    $ua->adicionar("usuario_Telefone", $valida->replace($_POST['formInfoTelddd'] . $_POST['formInfoTel']), 'texto');

                    if(isset($_POST['formCodAfiliacao']))$ua->adicionar("usuario_CodAfiliacao", $_POST['formCodAfiliacao']);

                    //Verifica se foi realizado alguma alteração nos atributos do usuário;
                    //Toda vez que for realizado alteração a conta fica bloqueada para avaliação
                    if($_POST['helper_check_update'] == 1){

                        $atrib = $_POST['user_attributes'];
                        $atributos_user = explode(", ", $atrib);
                        $countAttr = count($atributos_user);
                        //First it removes all prevously attributes
                        if($countAttr > 0 && $data['editar']) UserUtils::clearUserAttributes($user_id);

                        for($i = 0; $i < $countAttr; $i++){
                            if($atributos_user[$i] != "") $ua->adicionar($atributos_user[$i], "permission_level", "texto"); 
                        }
                        //Bloquea a conta para avaliação
                        $lockAccount = UserUtils::setLockedAccount("true", $user_id);
                        if($type_user == "pj"){$type_user = Yii::t("siteStrings", "label_pj");}else{$type_user = Yii::t("siteStrings", "label_pf");};
                        
                        $date = date('Ymd');
                        $data_email['nome'] =  $data['usuario_Nome'];                    
                        $data_email['newsletter'] =  0;
                        $data_email['email'] =  $user->email;
                        $data_email['layout'] =  "user_attribute";
                        $data_email['tipo'] =  "user_attribute";
                        $data_email['tipo_conta'] = $type_user;
                        $data_email['ramo_atuacao'] = 0;
                        $data_email['abordagem'] = 1;
                        
                        Yii::import('application.extensions.utils.special.NewsLetterUtils');
                        $defineAcceptance = NewsLetterUtils::insertPierMail($data_email, $date);
                        $sendEmail = MethodUtils::sendOrder($data_email);

                    }

                    //TODO: remover este lixo
                    $session->add('token_cc_conta', '');

                    //Faz parte do cadastro de usuário, não mexer
                    //Ele virifica se o usuário que está editando é o mesmo que logou
                    $session->add('pre_email', '');
                    $session->add('usuario_Nome', $data['usuario_Nome']);
                    if($user_id == $session['id'])$session->add('user_account_type', $data['type_account']);

                    /*
                     * Começa aqui o envio do e-mail de confirmação
                     * Somente envia e-mail se for criada a conta não se ela
                     * esta sendo editada
                     *
                     */
                    if(!$data['editar']){
                        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
                        $emailHandler = new EmailManager();

                        $data_account['nome'] =  $data['usuario_Nome'];
                        $data_account['cpf'] =  $_POST['loginCadastradoTipoNumero'];
                        $data_account['newsletter'] =  $user->receive_news;
                        $data_account['telefone'] =  $_POST['formInfoTelddd'] . $_POST['formInfoTel'];
                        $data_account['email'] =  $user->email;
                        $data_account['layout'] =  "cadastro_common";
                        $data_account['tipo'] =  "cadastro";
                        $data_account['tipo_conta'] =  UserUtils::getUserTypeString($type_user, true);
                        $data_account['hash'] = $user->email_hash;  
                        $data_account['type_account'] = $type_user;
                        
                        $sendEmail = $emailHandler->submitSubscription($data_account);
                    }

                    //Verifica se esta no admin
                    if($controllerSelector == "admin"){                   
                        if(!$data['editar']){
                            $this->controller->redirect(array("/admin/users/obrigado"));
                        }else{
                            $this->controller->redirect(array("/admin/users/atualizado"));
                        }

                    }else{
                        if(!$data['editar']){
                            $this->controller->redirect(array("/users/obrigado"));
                        }else{
                            $this->controller->redirect(array("/users/atualizado"));
                        }
                    }
                }
            }  

            //Infotip
            $data['title_dica'] = "Dica: Códico de afilicação";
            $data['text_dica'] = "O Códico de afilicação é fornecido por um parceiro e garante grandes descontos.";
            $data['link_dica']  = "/site/associese/";

            //TOKENIZER
            $data['token_cc_conta'] = uniqid("cc_conta_");
            $session->add('token_cc_conta', $data['token_cc_conta']);
            $data['session'] = $session;
            //NAO ALTERAR ACIMA

            $data['type_account_string'] = $type_user;
            $session->close();

            $this->addScript($view, $layout['layout_site']);

            //Verifica se esta no admin
            if($controllerSelector == "admin"){
                if($error){
                    $data['FORM_SUBMIT_TO'] = "/admin/users/".$type_user."/salvar";
                }else{
                    $data['FORM_SUBMIT_TO'] = "/admin/users/admin/salvar_".$type_user."";
                }

                $data['preferences']['design_site'] = "empty";
                $this->controller->layout = "admin/admin";
            }else{
                $data['FORM_SUBMIT_TO'] = "/conta/users/".$type_user. "/salvar";
                $this->controller->layout = $layout["plataform"]. "/index";
            }       

            $this->controller->render('/site/pages/conta/users/' . $view, $data);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: UsersAction - salvarUsuario() " . $e->getMessage();
        }
    }

    /*
     * Verfica usuário
     * Verifica de um determinado email já esta cadastrado
     *
     * @param string
     *
     */
    function userExist($useremail){
        $user=User::model()->find('email=:email', array(':email'=>$useremail));
        if($user != NULL){
            return true;
        }else{
            return false;
        }
    }
    
    /*
     * Cadastro Confirmado
     * Exibe tela de boas vindas com mensagem de obrigado
     *
     */
    public function cadastroConfirmado($view){        
        $session = new CHttpSession;
        $session->open();

        $layout = $this->manager->getLayout();
        $data['preferences'] = $this->preferences->getPreferences();
        $data['text'] = $this->manager->getText(C::CONTA);
        $data['menu_principal'] = $this->manager->getMenu();
        $data['plataform'] = $layout["plataform"]; 
        $data['usuario_Nome'] = $session['usuario_Nome'];        
        $data['type_account'] = $session['user_account_type'];
        if($data['type_account'] == 0 || $data['type_account'] == 2){$data['type_user'] = "pf";}else{$data['type_user'] = "pj";}
        $data['type_account_string'] = UserUtils::getUserTypeString($session['user_account_type']);
        $data['isBanner'] = $this->manager->getBannerMainShow(C::CONTA);
        $data['editar'] = false; 
        $data['menu_active'] = 'conta';
        $data['menu_conta_active'] = 'profile';
        
        //The current controller name
        $controllerSelector = $this->getController()->getId();
        
        if(Yii::app()->params['tecnologia'] == 1 && $controllerSelector != 'admin') $view = $view . "_html5";
            
        //Verifica se esta no admin
        if($controllerSelector == "admin"){            
            $data['preferences']['design_site'] = "empty";
            $this->controller->layout = "admin/admin";
            $this->controller->render('/admin/pages/users/' . $view, $data);
            //TODO não esta funfando este else if abaixo
        }else if($controllerSelector == "conta"){
            $data['editar'] = true;
            //$this->addScript("main", $layout['layout_site']);
            $this->controller->layout = $layout["plataform"]. "/index";
            $this->controller->render('/site/pages/conta/users/' . $view, $data);
        } else{            
            $this->addScript("main", $layout['layout_site']);
            $this->controller->layout = $layout["plataform"]. "/index";
            $this->controller->render('/site/pages/conta/users/' . $view, $data);
        }      
    }
    
    /*
     * Salva o endereco
     * 
     * This method saves the address and it can be a option one or two,
     * it's used inside ecommerce.
     *
     */
    public function salvarEndereco(){
        Yii::import('application.extensions.dbuzz.admin.UsersManager');        
        $userHandler = new UsersManager();
        
        //Declare variables address
        $id = $_POST['id'];
        $data_address['editar'] = true;
        $data_address['endereco'] = $_POST['endereco'];
        $data_address['cidade'] = addslashes($_POST['city']);
        $data_address['numero'] = $_POST['number'];
        $data_address['bairro'] = $_POST['bairro'];
        $data_address['complement'] = $_POST['complement'];
        $data_address['estado'] = $_POST['state'];
        $data_address['cep'] = $_POST['cep'];
        
        //Declare variables contacts
        $data_contact['telefone'] = $_POST['telefone'];
        
        $saveUserAddress = $userHandler->saveUserAddress($data_address, $id);        
        $saveUserContact = $userHandler->saveAttributtesPerson($data_contact, $id);
        
        $result['contact'] = $saveUserContact;
        $result['address'] = $saveUserAddress;
        echo json_encode($result);      
    }
    
    /*
     * Remove usuário
     * Remove um usuário existente
     * 
     * This method uses the ProdutosManager class to conclude
     * the request.
     *
     */
    public function removerUsuario(){
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');        
        $userHandler = new UsersManager();
        
        $id_user = $_POST['id'];
        
        try{
            $userHandler->removeContent($id_user);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }       
    }
    
    /*
     * Remove tag de usuário
     * 
     *
     */
    public function removerTag(){
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');        
        $userHandler = new UsersManager();
        
        $id_user = $_POST['id'];
        $tag = $_POST['tag'];
        
        try{
            $remove = $userHandler->removeTagContent($id_user, $tag);
            $result = array('message' => Yii::t("messageStrings", "message_result_user_tag_delete"), 'result' => $remove);
            
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: UserAction - removerTag() " . $e->getMessage();
        }       
    }
    
    /*
     * Alterar password
     * 
     */
    public function alterarPassword($is_site = false){
        
        Yii::import('application.extensions.utils.users.UserUtils');        
        
        $session = MethodUtils::getSessionData();
        
        $data['senha'] = $_POST['senha'];
        
        if(!$is_site) $data['id'] = $session['id'];
        if( $is_site) $data['hash'] = $_POST['id'];        
        
        try{
            $changePassword = UserUtils::setNewPassword($data, true);
            echo Yii::t("messageStrings", "message_result_password_changed");

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }       
    }
    
    /*
     * Save User
     * Just a few fields
     * 
     */
    public function saveUserRapido(){     
        
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        $valida = new dbValidar();
        
        //Form data
        $data['field1'] = StringUtils::StringToLowerCase($_POST['field1']);
        $data['field2'] = StringUtils::StringToLowerCase($_POST['field2']);
        $data['email'] = $_POST['email'];
        $data['tipo_conta'] = $_POST['type'];
        
        if(isset($_POST['telefone'])){$data['telefone'] = $valida->replacePhone($_POST['telefone']);}else{$data['telefone'] = '';};
        if(isset($_POST['celular'])){$data['celular'] = $valida->replacePhone($_POST['celular']);}else{$data['celular'] = '';}; 
        if(isset($_POST['tag_user'])){$data['tag_user'] = $_POST['tag_user'];} 
        
        //Email data
        $data['nome'] = UserUtils::getUserNameString($data['field1'], $data['field2'], $data['tipo_conta']);
        $data['cpf'] = $_POST['documento'];
        $data['type_account'] = $data['tipo_conta'];
        $data['newsletter'] = 1;
        $data['tipo'] = "cadastro";
        $data['layout'] =  "cadastro_common"; 
        if(isset($_POST['operadora'])) $data['operadora'] = $_POST['operadora'];
        
        if($data['tipo_conta'] == 0)$data['birthday'] = DateTimeUtils::setFormatDateNoTime($_POST['extra']);
        if($data['tipo_conta'] == 0)$data['company'] = $_POST['company'];
        if($data['tipo_conta'] == 1)$data['contato'] = $_POST['extra'];
        
        //Form address
        if(isset($_POST['cep'])){
            $data_address['editar'] = false;
            $data_address['endereco'] = $_POST['endereco'];
            $data_address['cep'] = $_POST['cep'];
            $data_address['numero'] = $_POST['numero'];
            $data_address['bairro'] = $_POST['bairro'];
            $data_address['cidade'] = $_POST['cidade'];
            if(isset($_POST['complemento'])){$data_address['complement'] = $_POST['complemento'];}else{$data_address['complement'] = '';}
            $data_address['estado'] = $_POST['estado'];
        }
        
        $data['password'] = $_POST['password'];
        $data['documento'] = $_POST['documento'];
        
        $result['ERROR'] = 0;
        
        try{
            $id_account = UserUtils::createQuickUserAccount($data, true);
            $result['id_user'] = $id_account;
            
            //If there are address data
            if(isset($_POST['cep'])){
                Yii::import('application.extensions.dbuzz.admin.UsersManager');        
                $userHandler = new UsersManager();
                $saveUserAddress = $userHandler->saveUserAddress($data_address, $id_account);                
            }
            
            $session = MethodUtils::setSessionData('id', $id_account);
            $session = MethodUtils::setSessionData('field1', $data['field1']);
            $session = MethodUtils::setSessionData('field2', $data['field2']); 
            $session = MethodUtils::setSessionData('email', $data['email']);
            
            
            if(isset($_POST['company'])) $data['user'] = UserUtils::checkAttribute("texto", $_POST['company'], false);
            if(isset($_POST['cargo'])){UserUtils::setAttribute('usuario_Profissao', $_POST['cargo'], 'texto', $id_account);}
            if(isset($_POST['tag'])) {UserUtils::setAttributeComplete($_POST['tag'], $data['user']['user_id'], 1, 'permission_level', 'novo', $id_account);}
            
            if(isset($_POST['company']) && $_POST['company'] != "") {
                $isCNPJ = $valida->cnpj($_POST['company']);
                if($isCNPJ){
                    Yii::import('application.controllers.site.conta.user.BuscarUserAction');
                    $user = BuscarUserAction::checkCNPJ($_POST['company'], true);
                    $user_info = UserUtils::getUserById($user['user']['user_id']);
                    if($user_info) $data['user']['nome'] = $user_info;
                    $userHandler->saveCompany($data, $id_account);
                }
            }
            
            if(isset($data['operadora'])) UserUtils::setAttribute('usuario_operadora', $data['operadora'], 'inteiro', $id_account);
                
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: - UserAction -  saveUserRapido() " . $e->getMessage();
        }       
    }
    
    /*
     * Change status lock account
     * 
     * @param numer
     */
    public function changeAccountLockStatus($isStatus = false){
        
        Yii::import('application.extensions.utils.users.UserUtils'); 
        $status = $_POST['status'];
        $id_user = $_POST['id'];
        
        if(!$isStatus){
            if($status != 2){
                $lockAccount = UserUtils::setLockedAccount($status, $id_user);
            }else{
                //Re-send an e-mail with a new password
                $lockAccount = UserUtils::resetLockedAccount(0, $id_user); 
            }
            if($lockAccount) echo Yii::t("messageStrings", "message_result_user_locked_update");
            if(!$lockAccount) echo Yii::t("messageStrings", "message_result_user_locked_no_update");
            
        }else{
            $changeAccount = UserUtils::setUserAccountState($id_user, $status); 
            echo Yii::t("messageStrings", "message_result_user_account_status_update");
        }        
    } 
    
    /*
     * Dados Empresa
     * Exibe a tela de cadastro dos dados de empresa.
     *
     */
    public  function dadosEmpresa(){
        
        $layout = $this->manager->getLayout();
        $data['menu_principal'] = $this->manager->getMenu();
        $data['plataform'] = $layout["plataform"];
        $data['preferences'] = $this->preferences->getPreferences();
        $data['isBanner'] = $this->manager->getBannerMainShow("users");
        $data['profile_level'] = 0;
      
        $this->addScript("", $layout['layout_site']);
        
        $this->controller->layout = $layout["plataform"]. "/index";        
        $this->controller->render('/site/pages/conta/users/dados_empresa', $data);
    }
    
    /*
     * Salvar Pessoa Física
     * Salva um registro de pessoa física
     *
     */
    public  function adicionarEmpresa($dataCompany = false){
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        $userHandler = new UsersManager();
        
        if(!$dataCompany){
            $session = MethodUtils::getSessionData();
            $id_user = $session['id'];

            $get_post = array();
            $get_post['type'] = "company";
            $get_post['nome_fantasia'] = $_POST['nome_fantasia'];
            $get_post['razao_social'] = $_POST['razao_social'];
            $get_post['data_fundacao'] = $_POST['data_fundacao'];
            $get_post['endereco'] = $_POST['endereco_business'];
            $get_post['numero'] = $_POST['numero_business'];
            $get_post['bairro'] = $_POST['bairro_business'];
            $get_post['cidade'] = $_POST['cidade_business'];
            $get_post['cep'] = $_POST['cep_business'];
            $get_post['estado'] = $_POST['estado_business'];
            $get_post['ramo_atividade'] = $_POST['ramo_atividade'];
            $get_post['num_funcionarios'] = $_POST['num_funcionarios'];
            $get_post['porte_empresa'] = $_POST['porte_empresa'];
            $get_post['cnpj'] = $_POST['cnpj'];
            $get_post['email'] = $_POST['email_business'];
            $get_post['telefone_1'] = $_POST['telefone_1'];
            $get_post['telefone_2'] = $_POST['telefone_2'];
            $get_post['id_user'] = $id_user;
            
        }else{
            $get_post = $dataCompany;
        }
        
        try{
            $content = $userHandler->saveComplementData($get_post);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /*
     * Participar
     * Cria um registro de pessoa física
     *
     */
    public  function participar(){
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $userHandler = new UsersManager();
        
        $session = MethodUtils::getSessionData();
        $id_user = $session['id'];

        $post = array();
        $post['tag'] = $_POST['tag'];
        $post['documento'] = $_POST['documento'];
        $post['id_user'] = $_POST['id_user'];
        $post['type'] = $_POST['type'];
        
        $id_company = UserUtils::checkAttribute('texto', $post['documento'], false, false);        
        
        try{
            if($post['type'] == "rede_beneficios"){
                $content = UserUtils::setAttributeComplete('rede_beneficios', $id_company['user_id'], '1', 'permission_level', 'novo', $post['id_user']);
             
            }else{
                $content = $userHandler->saveComplementData($post);
            }
            
            $result = array("result" => $content, "message" => Yii::t('messageStrings', 'message_profile_update'));
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /*
     * List os tipos de usuarios 
     * 
     * It lists all records from the user_data with a specific tag
     * 
     *
     */
    public function listarKindOfUsers($isPaginar = false){ 
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');  
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $userHandler = new UsersManager();
        
        try{
            $tipo = $this->action;
            
            //echo $this->action . ' ' . $this->event;
            
            ($this->event != '' || is_int($this->event)) ? $result['ind'] = $this->event : $result['ind'] = 0;
            $result['content'] = $userHandler->getAllKindUsers($tipo, $result['ind']);
            
            $result['qtd_cat'] = DataBaseUtils::getCountRecords("user_attribute", "name", $tipo, false);
            $result['type'] = $this->action;
            
            //Paginacao
            if($result['ind'] == 'listar_pf' || $result['ind'] == 'listar_pj') $result['ind'] = 0;
            $result['action'] = $this->action;$result['type'] = $tipo;
            $result['paginacao'] = MethodUtils::getPaginationAttributes($result, 'users_attribute');
            

            $result['dicas'] = DicasUtils::getTips("list", "user");

            $this->addScript2("user");        
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/users/listar_tags", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /*
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($layout, $model){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        if($layout != ''){
            $cs->registerCssFile($baseUrl . '/css/site/content/conta/'. $layout .'.css', 'screen', CClientScript::POS_HEAD);
        }
        
        
        $cs->registerCssFile($baseUrl . '/css/site/content/conta/avatar.css', 'screen', CClientScript::POS_HEAD);
        
        //Uploadfy: don't touch!
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);
        
        //Funcionalidades de comportamento javascript default desta view        
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.maskedinput-1.2.2.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/site/conta/users/user.js', CClientScript::POS_END);
        
        //Funcionalidades do avatar handler
        $cs->registerScriptFile($baseUrl . '/js/site/conta/avatar.js', CClientScript::POS_END);  
        $cs->registerScriptFile($baseUrl . '/js/site/conta/atributos_clientes.js', CClientScript::POS_END);
       
        
        //Apply the files to be shown on the conta session
        if($this->getController()->getId() != "admin"){
            $cs->registerCssFile($baseUrl . '/css/site/layout/layout_'. $model .'.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerCssFile($baseUrl . '/css/site/content/conta/main.css', 'screen', CClientScript::POS_BEGIN);
            $cs->registerScriptFile($baseUrl . '/js/site/conta/main.js', CClientScript::POS_END);
        }
        
        if($layout == ''){
            $cs->registerScriptFile($baseUrl . '/js/modulos/form/inscricao_business.js', CClientScript::POS_END);
        }
    }
    
    /*
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript2($layout){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Funcionalidades de comportamento javascript default desta view
        $cs->registerScriptFile($baseUrl . '/js/admin/'. $layout .'.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END); 
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.maskedinput-1.2.2.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.pagination.js', CClientScript::POS_END);
       
    }

}
?>