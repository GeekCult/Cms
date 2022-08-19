<?php

class EmailAction extends CAction {

    private $emailHandler;
    private $pedidos;
    private $action;

    /**
     *
     * Email - Pedidos via web site;
     * Special Class
     *
     * This class sends a e-mail and open a order and chamado!
     * 
     */
    public function run(){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
  
        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->emailHandler = new EmailManager();
        
        switch ($this->action){
            
            case "indiqueamigo":
                $this->indiqueAmigo();
                break;
            
             case "submitemail":
                $this->submitEmail();
                break;

            case "submitorcamento":
                $this->submitOrcamento();
                break;
            
            case "submitorcamentoweb":
                $this->submitOrcamentoWeb();
                break;
            
            case "newsletter":
                $this->submitNewsletter();
                break;
            
            case "orcamentus":
                $this->openOrcamentus();
                break;
            
            default:
                echo "error";
                break;
        }        
    }
    
    /*
     * Indique para um amigo
     * Esse método envia um certo link para um e-mail informado no 
     * campo e-mail amigo
     * 
     */
    public function indiqueAmigo(){
        
        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';

        if($isPostRequest){

            Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
            $valida = new dbValidar();

            $isValid = true;

            if (!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
               (isset($_POST['email']) && !$valida->email($_POST['email']))){
                $error[] = "email";
                $isValid = false;
            }
            
            if($isValid){                
                
                $date = date('Ymd');
                $name_string = strip_tags($_POST['nome']);
                $name = StringUtils::StringToLowerCase($name_string, "name");
                $emailadress = strip_tags($_POST['email']);
                $message = strip_tags($_POST['mensagem']);
                
                // Interested in
                (isset($_POST['titulo_interesse'])) ? $titulo_interesse = strip_tags($_POST['titulo_interesse']) : $titulo_interesse = '';
                (isset($_POST['texto_interesse'])) ? $texto_interesse = strip_tags($_POST['texto_interesse']) : $texto_interesse = '';
                (isset($_POST['link_interesse'])) ? $link_interesse = strip_tags($_POST['link_interesse']) : $link_interesse = '';
                
                try{ 
                    $data_message['nome'] =  $name;                   
                    $data_message['email'] =   $emailadress;
                    $data_message['mensagem'] = nl2br($message);
                    
                    $data_message['titulo_interesse'] = $titulo_interesse;
                    $data_message['texto_interesse'] = $texto_interesse;
                    $data_message['link_interesse'] = $link_interesse;
                    
                    $data_message['layout'] =  "indique_amigo_common";
                    $data_message['tipo'] =  "indique_amigo";
                    $data_message['newsletter'] = true;

                    $sendController = $this->emailHandler->submitSubscription($data_message);
                    if($sendController)$data['SUCCESS'] = '1';                    
            
                }catch(CDbException $e){
                    Yii::trace("ERROR " . $e->getMessage());
                    echo "ERROR " . $e->getMessage();
                } 
                
                $activity = array("title" => Yii::t("activityStrings","indicate_friend"),"nome" => $name, "message" => Yii::t("activityStrings", "indicate_friend_desc"), "tipo" => "indicate", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
                $setActivity = MethodUtils::setActivityRecent($activity);
                
            }else{
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
            }
        }
        
        echo json_encode($data);   
    }
    
    /*
     * Submit e-mail from contact,
     * Re-use this stament for another e-mails request
     * 
     */
    public function submitEmail(){        

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        $name = "";

        if($isPostRequest){
            
            Yii::import('application.extensions.utils.special.NewsLetterUtils');
            Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
            Yii::import('application.extensions.utils.EmailUtils');
            
            $valida = new dbValidar();

            $isValid = true;

            if (!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
               (isset($_POST['email']) && !$valida->email($_POST['email']))){
                $error[] = "email";
                $isValid = false;
            }
            
            $name_string = strip_tags($_POST['nome']);
            $name = StringUtils::StringToLowerCase($name_string, "name");

            if($isValid){                
                $session = MethodUtils::getSessionData();
                $date = date('Ymd');
                
                $emailadress = strip_tags($_POST['email']);
                $telefone = strip_tags($_POST['telefone']);
                $message = strip_tags($_POST['mensagem']);
                $tipo = $_POST['tipo'];
                
                //Getsß template for each page
                if(!isset($_POST['layout'])){ 
                    $layout = 'contato_common';
                }else{
                    $layout = $_POST['layout'];
                }
                
                try{                                        
                    $data_message['nome'] =  $name;
                    $data_message['telefone'] =  $telefone;
                    $data_message['email'] =   $emailadress;
                    $data_message['mensagem'] = $message;
                    $data_message['descricao'] = $message;
                    $data_message['layout'] =  EmailUtils::getEmailTemplate($tipo);
                    $data_message['tipo'] =  $tipo;
                    $data_message['newsletter'] = false;
            
                    $data_message['data'] = date('Y-m-d H:i:s');               
                    $data_message['id_user'] = $session['id'];
                    $data_message['quantidade'] = 0;
                    $data_message['ramo_atuacao'] = 0;
                    $data_message['abordagem'] = 1;
                    $data_message['titulo'] = "Contato Site";                    

                    $sendController = $this->emailHandler->submitSubscription($data_message);      
                    
                    if(Yii::app()->params['site_type']) {
                        $saveContact = EmailUtils::saveContact($data_message);
                        $defineAcceptance = NewsLetterUtils::insertPierMail($data_message, $date);
                    }
                    
                    if($sendController)$data['SUCCESS'] = '1';

                }catch(CDbException $e){
                    Yii::trace("ERROR " . $e->getMessage());
                    echo "ERROR " . $e->getMessage();
                } 
                
            }else{
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
            }
        }
        
        $activity = array("title" => Yii::t("activityStrings","contact"),"nome" => $name, "message" => Yii::t("activityStrings", "contact_desc"), "tipo" => "contato", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
        if(Yii::app()->params['site_type']) $setActivity = MethodUtils::setActivityRecent($activity);
        
        echo json_encode($data);
    }
    
    /*
     * Submit e-mail from contact,
     * Re-use this stament for another e-mails request
     * 
     */
    public function submitNewsletter(){  

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        $name = "";
        $date = date("Y-m-d H:i:s");

        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.utils.EmailUtils');

        $valida = new dbValidar();

        $isValid = true;

        if (!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
           (isset($_POST['email']) && !$valida->email($_POST['email']))){
            $error[] = "email";
            $isValid = false;
        }

        if($isValid){                
            $emailadress = strip_tags($_POST['email']);
            $nome = strip_tags($_POST['nome']);

            try{                                        
                $data_message['nome'] =  $nome;
                $data_message['email'] =   $emailadress;
                $data_message['layout'] =  'newsletter_common';
                $data_message['tipo'] =  'newsletter';
                if(Yii::app()->params['site_type']){ $data_message['newsletter'] = true;} else {$data_message['newsletter'] = false;}

                $data_message['data'] = date('Y-m-d H:i:s');               
                $data_message['titulo'] = "Contato Site";

                $sendController = $this->emailHandler->submitSubscription($data_message);                    

                Yii::import('application.extensions.utils.special.NewsLetterUtils');
                if(Yii::app()->params['site_type']) $defineAcceptance = NewsLetterUtils::insertPierMail($data_message, $date);

                if($sendController){
                    $data['SUCCESS'] = '1';
                    $data['message'] = Yii::t("messageStrings", "message_result_sent_success");                         
                }else{
                    $data['ERROR'] = '1';
                    $data['message'] = Yii::t("messageStrings", "message_result_sent_error");
                }
                
                $activity = array("title" => Yii::t("activityStrings", "newsletter"),"nome" => $nome, "message" => Yii::t("activityStrings", "newsletter_desc"), "tipo" => "newsltter", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
                if(Yii::app()->params['site_type']) $setActivity = MethodUtils::setActivityRecent($activity);

            }catch(CDbException $e){
                Yii::trace("ERROR " . $e->getMessage());
                echo "ERROR " . $e->getMessage();
            } 

        }else{
            $data['ERROR'] = '1';
            $data['ERROR_MSG'] = $error;
        }
        
 
        echo json_encode($data);
    }
    
    /*
     * Submit e-mail from contact,
     * Re-use this stament for another e-mails request
     * 
     */
    public function openOrcamentus(){  

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        $date = date("Y-m-d H:i:s");
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        Yii::import('application.extensions.dbuzz.site.special.OrcamentusManager'); 
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.utils.EmailUtils');

        $valida = new dbValidar();

        $isValid = true;

        if (!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
           (isset($_POST['email']) && !$valida->email($_POST['email']))){
            $error[] = "email";
            $isValid = false;
        }

        if($isValid){                
            $emailadress = strip_tags($_POST['email']);
            $nome = strip_tags($params['nome']); 

            try{ 
                //Post to Orcamentus Stage
                $orcamentusHandler = new OrcamentusManager();
                $params['url'] = "insert_pedido_full";
                $params['id_user'] = 0;        
                $set = $orcamentusHandler->requestOrcamentusContent($params);
                
                $data_message['nome'] =  $nome;
                $data_message['email'] =   $emailadress;
                $data_message['cidade'] =   '';
                $data_message['titulo_orcamentus'] =   $params['titulo'];
                $data_message['descricao_orcamentus'] =   $params['descricao'];
                $data_message['celular'] =   $params['celular'];
                $data_message['layout'] =  'orcamentus_common';
                $data_message['tipo'] =  'orcamentus';
                $data_message['newsletter'] = false;

                $data_message['data'] = date('Y-m-d H:i:s');               
                $data_message['titulo'] = "Contato Site";

                $sendController = $this->emailHandler->submitSubscription($data_message);                    

                Yii::import('application.extensions.utils.special.NewsLetterUtils');
                if(Yii::app()->params['site_type'])$defineAcceptance = NewsLetterUtils::insertPierMail($data_message, $date);

                if($sendController){
                    $data['SUCCESS'] = '1';
                    $data['message'] = Yii::t("messageStrings", "message_result_sent_success");                         
                }else{
                    $data['ERROR'] = '1';
                    $data['message'] = Yii::t("messageStrings", "message_result_sent_error");
                }

            }catch(CDbException $e){
                Yii::trace("ERROR " . $e->getMessage());
                echo "ERROR " . $e->getMessage();
            } 

        }else{
            $data['ERROR'] = '1';
            $data['ERROR_MSG'] = $error;
        }
        
 
        echo json_encode($data);
    }
    
    /*
     * Todo: Make it better
     * 
     */
    public function submitOrcamento(){
        
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.dbuzz.site.special.OrcamentusManager');

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        $date = date("Y-m-d H:i:s");
        
        $params = array();
        parse_str($_POST['data'], $params);

        if($isPostRequest){

            $valida = new dbValidar();
            $isValid = true;

            if (!isset($params['nome']) || $params['nome'] == "" || $params['nome'] == "Nome"){
                $error[] = "nome";
                $isValid = false;
            }

            if (!isset($params['email']) || $params['email'] == "" || $params['email'] == "E-mail" ||
               (isset($params['email']) && !$valida->email($params['email']))){
                $error[] = "email";
                $isValid = false;
            }

            if (!isset($params['numero_telefone']) || $params['numero_telefone'] == "" || $params['numero_telefone'] == "Fone"){
                $error[] = "telefone";
                $isValid = false;
            }

            if (!isset($params['descricao']) || $params['descricao'] == "" || $params['descricao'] == "Mensagem"){
                $error[] = "mensagem";
                $isValid = false;
            }
            
            $name_string = strip_tags($params['nome']);
            $name = StringUtils::StringToLowerCase($name_string, "name");
            
            $params['telefone'] = $params['ddd_telefone'].$params['numero_telefone'];
            $params['celular'] = $params['ddd_celular'].$params['numero_celular'];

            if ($isValid){
                
                //Post to Orcamentus Stage
                $orcamentusHandler = new OrcamentusManager();
                $params['url'] = "insert_pedido_full";
                $params['id_user'] = 0;        
                $set = $orcamentusHandler->requestOrcamentusContent($params);
                
                $session = MethodUtils::getSessionData();                
                
                $data['nome'] = $name;
                
                $data['data'] = date('Y-m-d H:i:s');     
                $data['contato'] = $params['contato'];
                $data['email'] = $params['email'];
                $data['telefone'] = $params['telefone'];
                $data['celular'] = $params['celular'];
                $data['tipo_contato'] = $params['tipo_contato'];
                $data['endereco'] = $params['endereco'];
                $data['cidade'] = $params['cidade'];
                $data['estado'] = $params['estado'];
                $data['bairro'] = $params['bairro'];
                $data['cep'] = $params['cep'];
                $data['message'] = $params['descricao'];
                $data['descricao_orcamento'] = $params['descricao'];
                $data['titulo_orcamento'] = $params['titulo'];
                
                $data['id_user'] = $session['id'];
                $data['quantidade'] = 0;
                $data['titulo'] = "Orçamento Site";
                
                //Main data
                $data['tipo'] = "orcamento";
                $data['layout'] = "orcamento_common";
                $data['newsletter'] = false;                
                
                $sendController = $this->emailHandler->submitSubscription($data);
               
                $data['SUCCESS'] = $sendController;
                
                $activity = array("title" => Yii::t("activityStrings", "budget_order"),"nome" => $name, "message" => Yii::t("activityStrings", "budget_order_desc"), "tipo" => "pedido_orcamento", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
                if(Yii::app()->params['site_type']) $setActivity = MethodUtils::setActivityRecent($activity);

            }else{
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
            }
        }
        
        echo json_encode($data);
    }
    
    /*
     * Todo: Make it better
     * 
     */
    public function submitOrcamentoWeb(){
        
        Yii::import('application.extensions.dbuzz.site.special.OrcamentusManager');
        $orcamentusHandler = new OrcamentusManager();

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';
        $date = date("Y-m-d H:i:s");
        
        $params = array();
        parse_str($_POST['data'], $params);
        $params['url'] = "insert_pedido_full";
        $params['id_user'] = 0;
        
        if($isPostRequest){

            Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
            $valida = new dbValidar();
            $isValid = true;

            if (!isset($params['nome']) || $params['nome'] == "" || $params['nome'] == "Nome"){
                $error[] = "nome";
                $isValid = false;
            }

            if (!isset($params['email']) || $params['email'] == "" || $params['email'] == "E-mail" ||
               (isset($params['email']) && !$valida->email($params['email']))){
                $error[] = "email";
                $isValid = false;
            }

            if (!isset($params['telefone']) || $params['telefone'] == "" || $params['telefone'] == "Fone"){
                $error[] = "telefone";
                $isValid = false;
            }
            
            if (!isset($params['dominio']) || $params['dominio'] == ""){
                $error[] = "dominio";
                $isValid = false;
            }
            
            $name_string = strip_tags($params['nome']);
            $name = StringUtils::StringToLowerCase($name_string, "name");
            
            $set = $orcamentusHandler->requestOrcamentusContent($params);

            if ($isValid){
                
                $session = MethodUtils::getSessionData();                
                
                $data['nome'] = $name_string;                
                $data['data'] = date('Y-m-d H:i:s');     
                $data['contato'] = $params['contato'];
                $data['dominio'] = $params['dominio'];
                $data['email'] = $params['email'];
                $data['telefone'] = $params['telefone'];
                $data['cpf'] = $params['cpf'];
                $data['tipo_contato'] = $params['tipo_contato'];
                $data['endereco'] = $params['endereco'];
                $data['cidade'] = $params['cidade'];
                $data['bairro'] = $params['bairro'];
                $data['estado'] = $params['estado'];
                $data['cep'] = $params['cep'];
                $data['plano'] = $params['hospedagem'];
                $data['registro'] = $params['registro'];
                $data['cupom'] = $params['cupom'];
     
                $data['message'] = $data['descricao'] = $params['descricao'];
                $data['descricao_orcamento'] = $params['descricao'];
                $data['titulo_orcamento'] = $params['titulo'];
                
                $data['id_user'] = $session['id'];
                $data['quantidade'] = 0;
                $data['titulo'] = "Orçamento Site";
                
                //Main data
                $data['tipo'] = "orcamento_web";
                $data['layout'] = "orcamento_web";
                $data['newsletter'] = false;                
                
                $sendController = $this->emailHandler->submitSubscription($data);
               
                $data['SUCCESS'] = '1';
                
                $activity = array("title" => Yii::t("activityStrings","budget_order"),"nome" => $name, "message" => Yii::t("activityStrings", "budget_order_desc"), "tipo" => "pedido_orcamento", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
                if(Yii::app()->params['site_type']) $setActivity = MethodUtils::setActivityRecent($activity);                 

            }else{
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
            }
        }

        echo json_encode($data);
    }
    
    /*
     * Submit propaganda from newsletter propaganda
     * It saves the e-mail into general newsletter and sends an advertise
     * default as an e-mail marketing
     * 
     */
    public function submitPropaganda(){  
        
        Yii::import('application.extensions.dbuzz.site.email.EmailMarketingManager'); 
        $emailMarketing = new EmailMarketingManager();

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';

        if($isPostRequest){

            Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
            Yii::import('application.extensions.utils.EmailUtils');
            
            $valida = new dbValidar();

            $isValid = true;

            if (!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
               (isset($_POST['email']) && !$valida->email($_POST['email']))){
                $error[] = "email";
                $isValid = false;
            }

            if($isValid){ 
                
                $template_emkt = $emailMarketing->getAdvertiseEmail();
                
                $session = MethodUtils::getSessionData();
                $date = date('Ymd');
                $name_string = strip_tags($_POST['nome']);
                $name = StringUtils::StringToLowerCase($name_string, "name");
                $title = $_POST['content'];
                
                $email_adress = strip_tags($_POST['email']);
                $tipo = $_POST['tipo'];

                try{   
                    $data_message['nome'] =  $name;
                    $data_message['telefone'] =  "";
                    $data_message['email'] =   $email_adress;
                    $data_message['mensagem'] = "";
                    $data_message['descricao'] = "";
                    $data_message['layout'] =  "email_mkt_full_image";
                    $data_message['tipo'] =  "emkt";
                    $data_message['newsletter'] = true;
            
                    //Templates information
                    $data_message['image'] = $template_emkt['container_1'];
                    $data_message['link'] = $template_emkt['link'];
            
                    $data_message['data'] = date('Y-m-d H:i:s');               
                    $data_message['id_user'] = $session['id'];
                    $data_message['quantidade'] = 0;
                    $data_message['titulo_email'] = $title;
                    $data_message['titulo'] = $title;
                    $data_message['receiver'] = $email_adress;

                    $sendController = $emailMarketing->submitEmail($data_message);                    
                    $createOrder = $this->pedidos->createPedido($data_message);
                    
                    //If email is not recorded previously, record it
                    $isEmailExist = EmailUtils::checkEmailNewsletterExist($email_adress, false);
                    if(!$isEmailExist) $record = EmailUtils::acceptNewsLetter($data_message, $date);
                    
                    if($sendController)$data['SUCCESS'] = '1';

                }catch(CDbException $e){
                    Yii::trace("ERROR " . $e->getMessage());
                    echo "ERROR " . $e->getMessage();
                } 
                
            }else{
                $data['ERROR'] = '1';
                $data['ERROR_MSG'] = $error;
            }
        }
        
        $activity = array("title" => Yii::t("activityStrings","propaganda"),"nome" => $name, "message" => Yii::t("activityStrings", "propaganda_desc"), "tipo" => "propaganda", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
        $setActivity = MethodUtils::setActivityRecent($activity);
        
        echo json_encode($data);
    }
}
?>