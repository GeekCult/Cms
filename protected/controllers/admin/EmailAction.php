<?php

/**
 * Autor: CarlosGarcia
 * Date: 12/07/2011
 *
 * Email Class
 * Specific Class - Admin Controller
 *
 */
class EmailAction extends CAction {

    private $action;
    private $id;
    private $emailHandler;
    private $LIST = "list";
    private $TYPE = "pages";

    /**
     *
     * Emails;
     * 
     * Handle with Admin acton email, e-mail marketing
     * Order and further.
     *
     */
    public function run(){ 

        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
        Yii::import('application.extensions.utils.special.NewsLetterUtils');
        Yii::import('application.extensions.utils.DicasUtils');
        
        $this->action = Yii::app()->getRequest()->getQuery('action'); 
        $this->id = Yii::app()->getRequest()->getQuery('id'); 
        
        $this->emailHandler = new EmailManager();

        switch ($this->action){
            case "listar":
                $this->listar();
                break; 
            
            case "templates":
                $this->templates();
                break;
            
            case "template":
                $this->template();
                break;
            
            case "remover_template":
                $this->removerTemplate();
                break;
            
            case "cadastrar":
                $this->cadastrar();
                break;
            
            case "enviar":
                $this->enviar();
                break;
            
            case "enviar_emkt":
                $this->enviarMKT();
                break;
            
            case "novo":
                $this->novo();
                break;
            
            case "editar":
                $this->editar();
                break;
            
            case "listar_enviados":
                $this->listar(false);
                break;
            
            case "remover":
                $this->remover();
                break;
            
            case "topo":
                $this->extremos("topo_email");
                break;
            
            case "rodape":
                $this->extremos("rodape_email");
                break;
            
            case "mailing_upload":
                $this->mailingUpload();
                break;
            
            case "mailing_upload_csv":
                $this->mailingUpload('upload_csv');
                break;
            
            case "mailing_testar_gmail":
                $this->testar_gmail();
                break;
            
            case "upload":
                $this->upload();
                break;
            
            default:
                break;
        }        
    }
    
    /*
     * Submit e-mail marketing
     * 
     */
    public function enviarMKT(){
        
        Yii::import('application.extensions.utils.special.TemplatesUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        
        $session = MethodUtils::getSessionData();
          
        $date = date('Ymd');
        $update = date('Y-m-d H:i:s');
        $name = StringUtils::StringToLowerCase($_POST['nome'], 'name');
        $emailadress = StringUtils::StringToLowerCase($_POST['email'], 'simple');
        $email_title = $_POST['titulo_email'];
        $message = addslashes(strip_tags($_POST['mensagem']));
        $tipo = $_POST['tipo'];
        $template = $_POST['template'];
        $data['ramo_atuacao'] = $ramo_atuacao = $_POST['ramo_atuacao'];
        $data['abordagem'] = $abordagem = $_POST['abordagem'];
        $chamado = $_POST['chamado'];
        $newsletter = $_POST['newsletter'];
        $link = $_POST['link'];
        $padrao = $_POST['padrao'];
        $id_template = $_POST['id_template'];        
        
        //Set
        $data['nome'] = $name;
        $data['email'] = StringUtils::StringToLowerCase($emailadress, "simple");

        if(isset($_POST['image']) & $_POST['image'] != ""){$image = explode("/", $_POST['image']);}else{$image[5] = "";}
        (isset($_POST['open_prospect'])) ? $data['abrir_prospect'] = MethodUtils::getBooleanNumber($_POST['open_prospect']) : $data['abrir_prospect'] = 1;
        
        //add message in database
        $insert = "nome, email, titulo, mensagem, data, last_update, tipo, container_1, link";
        $values = "'".$name."', '".$emailadress."', '".$email_title."', '".$message."', '".$date."', '".$update."', '".$tipo."', '".$image[5]."', '".$link."'";
        $sql = "INSERT INTO general_contato (".$insert.") VALUES (".$values.")";
        
        //$setNewsLetterUser = NewsLetterUtils::insertIntoNewsLetter();
        
        try{ 
            if($template || $id_template != 0){
                $command = Yii::app()->db->createCommand($sql);
                $command->execute();
            }
            
            if($chamado){
                
                Yii::import('application.extensions.dbuzz.site.pedidos.common.PedidosManager');  
                
                $pedidos = new PedidosManager();
                
                $name_string = $_POST['titulo_chamado']; 
                $id_usuario = $session['id'];
                
                $data['data'] = $date;
                $data['titulo'] = StringUtils::StringToLowerCase($name_string);            
                $data['data_final'] = DateTimeUtils::setFormatDateTime($_POST['data_final']);
                
                $data['telefone'] = "";
                $data['prioridade'] = $_POST['prioridade'];
                
                //Main data
                $data['tipo'] = "tarefa";
                $data['layout'] = "pedido_tarefa";
                $data['newsletter'] = false;
                $data['descricao'] = StringUtils::StringToLowerCase($_POST['descricao'], "texto");
                
                $insert  = "tipo, telefone, email, data, data_final, titulo, descricao, id_usuario, nome, last_update";
                $values  = "'" . $data['tipo'] . "', '" .$data['telefone']."', '" .$data['email']. "', '" . $data['data'] . "', '" . $data['data_final'] . "', '" . $data['titulo'] . "', '" . $data['descricao'] . "', ";
                $values .= "'" . $id_usuario . "', '" .$data['nome']."', '" . $data['data'] . "'";
                $sql_pedidos = "INSERT INTO controle_pedidos (".$insert.") VALUES (".$values.")";
                
                $command = Yii::app()->db->createCommand($sql_pedidos);
                $save =$command->execute();
                
                $create_chamado = $pedidos->createChamado(Yii::app()->db->getLastInsertID(), $data['nome'], $data['email'], $id_usuario, $data['tipo']);
                
                
            }
            
            if($newsletter){
                Yii::import('application.extensions.utils.EmailUtils');
                $data['newsletter'] = true;
                $submit_email = EmailUtils::acceptNewsLetter($data, $date);
            }
            
            if($padrao){
                Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
                $pA = new PreferencesAttribute();
                $pA->setCurrentUser(0);
                
                if($id_template == ""){
                    $pA->adicionar("emkt_padrao", Yii::app()->db->getLastInsertID(), "inteiro");
                }else{
                    $pA->adicionar("emkt_padrao", $id_template, "inteiro");
                }
            }
            
            

            Yii::import('application.extensions.dbuzz.site.email.EmailMarketingManager');
            $emailHandler = new EmailMarketingManager(); 
            
            //Properties
            $data['data'] = DateTimeUtils::getDateFormate(date("Y-m-d H:i:s"));
            $data['dados'] = HelperUtils::getTitleSite();        
            $data['properties'] = TemplatesUtils::getTemplateProperties($id_template);
            $data['info_template'] = TemplatesUtils::getTemplateById($id_template);
                        
            //Apply the components into view
            $data['content'] = TemplatesUtils::getModule($id_template, $data); 
            
            //Set some more data
            $recordAction = $this->recordAction($data);
            
            $data_message['nome'] =  $name;
            $data_message['link'] =  $link;
            $data_message['receiver'] =  "nohaw@terra.com.br";
            $data_message['email'] =   $data['email'];
            $data_message['mensagem'] = nl2br($message);
            $data_message['layout'] =  "email_mkt_common";
            $data_message['tipo'] =  "emkt";
            $data_message['newsletter'] = false;
            $data_message['titulo_email'] = $data['info_template']['titulo'];
            $data_message['image'] = $image[5];
            $data_message['render'] = true;
            $data_message['view'] = $this->controller->renderPartial("/templates/email/views/empty", $data, true);

            $sendController = $emailHandler->submitEmail($data_message);  

            if($sendController) $data['SUCCESS'] = '1';
            
            echo json_encode(array("message" => "E-mail enviado com sucesso", 'result' => $sendController, 'STATUS' => $sendController));

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            $data['ERROR'] = '1';
            echo "ERROR: EmailAction - enviarEmail() " . $e->getMessage();
        }         
        
    }
    
    /*
     * It lists the main e-mail submited previously
     * 
     */
    public function listar($is_received = true){

        try{
            if( $is_received) {
                $result['content'] = $this->emailHandler->getAllContent();
                $view = 'listar'; $tp = 'email/listar';
            }
            
            if(!$is_received) {
                $result['content'] = $this->emailHandler->getAllContentBySql("template", " GROUP BY email, titulo ");
                $view = 'listar_enviados'; $tp = 'emailprospect';
            }
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils($tp, array('extra' => 'listar_enviados'));
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
            
            $this->addScript("email");
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/email/". Yii::app()->params['admin_content'] . "$view", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: EmailAction - listar() " . $e->getMessage();
        }
    }
    
    /*
     * It lists the templates saved previously
     * 
     */
    public function templates(){
        
        Yii::import('application.extensions.dbuzz.admin.special.EmailMarketingManager');
        $emktHandler = new EmailMarketingManager();

        try{
            $result['content'] = $emktHandler->getAllTemplates('prospect');            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('emailprospect', array('extra' => 'listar_templates'));           
           
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
            $this->addScript("email");
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/email/". Yii::app()->params['admin_content'] ."templates", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            "ERROR: EmailAction - templates() " . $e->getMessage();
        }       
    }
    
    /*
     * It uses a templates saved previously
     * 
     */
    public function template(){
        
        Yii::import('application.extensions.utils.users.UserUtils');

        try{
           $result['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();
           $result['content'] = $this->emailHandler->getContent($this->id);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
        $this->addScript("email");
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/email/enviar", $result);
    }
    
    /*
     * It shows the header to selected
     * 
     */
    public function extremos($local){
        
        Yii::import('application.extensions.dbuzz.admin.TexturasManager');                
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.dbuzz.MyPreferences');

        $result = array();
        $preferences = new MyPreferences(); 
        $texturas = new TexturasManager();

        //This if set a fake height to fix a bug with height
        //All textures are displayed with the same file view
        //The smaller ones have some problems with it.        
        $result['width_fake'] = "770";
        $result['height_fake'] = "80";

        try{
            $settings = $preferences->getPreferences();
            $result['preferences'] = $settings;
            $type_choose = PreferencesUtils::getTextureSelected($local);
            $result['item_choose'] = PreferencesUtils::getPreferedItem($type_choose);
            $result['content'] = $texturas->getAllContent($local);
            $result['title_texture'] = $local;
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils("email/$local", array('extra' => $local));
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
            
            $this->addScript("email");
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/email/". Yii::app()->params['admin_content'] . "topos", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo  $e->getMessage();
        } 
    }
    
    /**
     *
     * Novo
     * This method creates a new newsletter register.
     *
     */
    public function novo(){
        
        $result['session'] = MethodUtils::getSessionData(); 
        $result['sidemenu'] = HelperUtils::adminUtils('email/listar');
        $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
        $this->addScript("email");
        $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
        $this->controller->render("pages/email/". Yii::app()->params['admin_content'] . "novo");
    }
    
    /**
     *
     * Editar
     * This method edit a register.
     *
     */
    public function editar(){
        
        $result['content'] = $this->emailHandler->getContent($this->id);
        $result['session'] = MethodUtils::getSessionData(); 
        $result['sidemenu'] = HelperUtils::adminUtils('email/listar');
        $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
        $this->addScript("email");
        $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
        $this->controller->render("pages/email/". Yii::app()->params['admin_content'] . "novo", $result);
    }
    
    /**
     *
     * Enviar
     * This method send a email to specifi client.
     *
     */
    public function enviar(){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.dbuzz.admin.special.EmailMarketingManager');
        $emktHandler = new EmailMarketingManager();
        
        $result['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();
        $result['templates'] = $emktHandler->getAllTemplates('prospect');        
         
        $result['session'] = MethodUtils::getSessionData(); 
        $result['sidemenu'] = HelperUtils::adminUtils('emailprospect', array('extra' => 'enviar'));       
        $result['dicas'] = DicasUtils::getTips(C::SEND, C::EMAIL_MKT);
        
        $this->addScript("email");
        $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
        $this->controller->render("pages/email/". Yii::app()->params['admin_content'] ."enviar", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar(){

        $get_post = array();

        $get_post['email'] = $_POST['email'];
        $get_post['data'] = date('Ymd');        
        $get_post['agree'] = '1';
        $get_post['message'] = Yii::t('messageStrings', 'message_result_newsletter_complete');

        try{
            $content = $this->emailHandler->submitContentSimple($get_post);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Remover
     * This method deletes the selected record using a jQuery request
     *
     */
    public function remover(){

        $get_post['id_email'] = $_POST['id_email'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_newsletter_remove');

        try{
            $content = $this->emailHandler->deleteContent($get_post);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Remover Template
     * This method deletes the selected record using a jQuery request
     *
     */
    public function removerTemplate(){
        
        Yii::import('application.extensions.dbuzz.admin.special.EmailMarketingManager');
        $emktHandler = new EmailMarketingManager();

        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t('messageStrings', 'message_result_template_delete');

        try{
            $content = $emktHandler->deleteContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Mailing Upload
     * This method uploads a new mailing
     *
     */
    public function mailingUpload($view = 'upload'){
        
        $result['session'] = MethodUtils::getSessionData(); 
        $result['sidemenu'] = HelperUtils::adminUtils('email/subir_mailing');
        $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
        $this->addScript("newsletter");
        $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
        $this->controller->render("pages/email/". Yii::app()->params['admin_content'] . $view, $result);
    }
    
    /*
     * TODO: Hoje este method é compartilhado pelo PurplStore, separa-los
     * 
     */
    public function upload(){
        
        Yii::import('application.extensions.dbuzz.site.images.ImageHandler');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        
        try{
            $imagesHandler = new ImagesManager();

            //Destination
            $path_folder = $_REQUEST['path'];
            $current_file = $_REQUEST['current_file'];
            $replace = $_REQUEST['replace'];
            $content = $_REQUEST['qqfile'];
            $save = isset($_REQUEST['save']);
            $client = isset($_REQUEST['client']);
            $keep_name_file = $_REQUEST['keep_name'];

            if($client){        
                //OPEN THE DIRECTORY             
                $session = MethodUtils::getSessionData();
                $oldumask = umask(0);

                $dirHandle = is_dir($path_folder);
                if(!$dirHandle){
                    mkdir($path_folder, 0777, true);
                    chmod($path_folder, 0777);
                    umask($oldumask); 
                }
            }

            if(is_file($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_file)){
               unlink($_SERVER['DOCUMENT_ROOT'].'/'.$path_folder. $current_file);
            }

            //list of valid extensions, ex. array("jpeg", "xml", "bmp")
            $allowedExtensions = array();
            //max file size in bytes
            $sizeLimit = 10 * 1024 * 1024;

            $uploader = new ImageHandler($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($path_folder, $replace, $keep_name_file);
            $result['current_file']= $result['file_name'];
            $result['type'] = $imagesHandler->getTypeFile($content);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

            //to pass data through iframe you will need to encode all html tags
            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DownloadsAction - updload() ' . $e->getMessage();
        }
        
    }
    
    /**
     * REcord Action
     *
     * @param string
     *
     */
    public function recordAction($data){

        //Set Prospect        
        Yii::import('application.extensions.dbuzz.admin.ProspectsManager');
        Yii::import('application.extensions.dbuzz.admin.special.CalendarManager'); 
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        
        $calendarHandler = new CalendarManager();
        $prospectsHandler = new ProspectsManager();
        $comentarioHandler = new ComentariosManager();
        
        $session = MethodUtils::getSessionData();
        
        try{
            ($session['id'] != "") ? $id_user = $session['id'] : $id_user = 0;

            $date_retorno = date('Y-m-d H:i:s', strtotime('+5 days'));
            //Adds some extra values
            $prospect = array('nome' => $data['nome'], 'email' => $data['email'], 'ramo_atividade' => $data['ramo_atuacao'], 'cidade' => '', 'telefone' => '', 'data_retorno' => $date_retorno, 'tipo' => 'prospects', 'id_user' => $id_user) ;
            $checkExist = $prospectsHandler->checkProspectExist($data['email']);
            
            $setProspect = false;
            if($data['abrir_prospect']){                
                if(!$checkExist){
                    $setProspect = $prospectsHandler->createQuickProspect($prospect);
                    $id_prospect = Yii::app()->db->getLastInsertID();
                }else{
                    $id_prospect = $checkExist['id'];
                }                
            }else{
                if(!$checkExist) $id_prospect =0;
                if( $checkExist) $id_prospect = $checkExist['id'];
            }            

            //Set Calendar
            $data_calendar['title'] = "{$data['nome']} - Prospecção (5 dias)";
            $data_calendar['description'] = "Entrar em contato com prospect - (5 dias passados)";
            $data_calendar['id_user'] = $id_user;
            $data_calendar['hour'] = 8;
            $data_calendar['day'] = date('d');
            $data_calendar['month'] = date('m');
            $data_calendar['invites'] = 0;
            $data_calendar['tipo_calendar'] = 'prospect';
            $data_calendar['id_general'] = $id_prospect;
            $setAct = false;

            if($setProspect){
                $setRecord = $calendarHandler->saveRecord($data_calendar, $date_retorno);
                $setAct = true;
            }

            if(!$setProspect){                
                if($checkExist){$id_prospect = $checkExist['id']; $setAct = true;}else{$id_prospect = 0;}
            }

            //Add to history activity
            $act = array("id_general" => $id_prospect, "title" => 'Envio prospecção', "nome" => $data['nome'], "email"=> $data['email'], "comentario" => "Envio: " . $data['info_template']['titulo'], "data"=> date("Y-m-d H:i:s"), "tipo_comentario" => 'forca_vendas', "id_user"=> $id_user, "resposta"=> '', "file"=> '', "exibe" =>0, 'tipo_user' => 1); 
            if($setAct) $setActivity = $comentarioHandler->submitComment($act);

            $activity = array("title" => Yii::t("activityStrings","prospect_submit"), "nome" => $data['nome'], "message" => Yii::t("activityStrings", "prospect_submit_desc"), "tipo" => "new_prospect","id_general" => 0,"date" => date("Y-m-d H:i:s"),"last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
            $setActivity = MethodUtils::setActivityRecent($activity);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DownloadsAction - updload() ' . $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($layout){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
 
        $cs->registerScriptFile($baseUrl . '/js/admin/' . $layout .'.js', CClientScript::POS_END); 
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END);
        
        if($layout == 'newsletter'){
            //Uploadfy: don't touch!
            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);       
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);
        }
    } 
}
?>