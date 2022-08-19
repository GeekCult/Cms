<?php

class RelatarAction extends CAction {

    private $action;
    private $event;
    private $id;

    /**
     *
     * Pedidos;
     * Special Class
     * It uses a web controller together a HandlerAction and
     * some ajustments in ContentAction.
     *
     * PS: Don't forget, it's using the attributes sub and action from
     * <nr><sub><action> from config main.php
     *
     */
    public function run(){
 
        $this->action = Yii::app()->getRequest()->getQuery('action');  
        $this->event = Yii::app()->getRequest()->getQuery('event');
        $this->id = Yii::app()->getRequest()->getQuery('id');
       
        switch ($this->action){
            case "relatar_erro":
                $this->relatarErro();
                break;
            
            case "click":
                $this->relatarBannerAdvertiseClick();
                break;
            
            case "newsletter":
                $this->inscricaoNewsletter();
                break;
            
            case "click_user":
                $this->relatarClickUser();
                break;
            
            case "set_session_data":
                $this->setSessionData();
                break;
            
            case "open_livechat":
                $this->openLiveChat();
                break;
            
            case "add_wish_list":
                $this->addToWishList();
                break;
            
            case "add_comparison_list":
                $this->addToComparisonItems();
                break;            
            
            case "close_session":
                $this->closeSession();
                break;
            
            case "clear_credits":
                $this->clearBannerCredits();
                break;
            
            case "flutuante":
                $this->flutuante();
                break;
        }        
    }

    /**
     *
     * Relatar erro
     * This method saves the bug on the purplepier database
     *
     */
    public function relatarErro(){

        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';
        $data['SUCCESS'] = '0';

        if($isPostRequest){
            //add bug into database manager
            $insert = "tipo, user, titulo, detalhes, descricao, data";
            $values = $_POST['tipo'] . "', '" .$_POST['name_erro']. "', '" .$_POST['titulo_erro']."', '" .$_POST['prioridade'] . "', '".$_POST['descricao']. "', '" . date('Ymd');
            $sql = "INSERT INTO general_documentacao (".$insert.") VALUES ('".$values."')";

            try{
                $command = Yii::app()->db2->createCommand($sql);
                $command->execute();
                $local_dev = explode(".", $_SERVER['SERVER_NAME']);
                
                //If it's a local developement
                if($local_dev[0] == "dev"){
                    $command = Yii::app()->db3->createCommand($sql);
                    $command->execute();
                }
                
            }catch(CDbException $e){
                Yii::trace("ERROR " . $e->getMessage());
                echo "ERROR " . $e->getMessage();
            }

            $data['SUCCESS'] = '1';        
        }
        
        ActivityLogger::log("erro: relatar_erro");
        
        echo json_encode($data);
    }
    
    /**
     *
     * Relatar click
     * This method adds a click into a pressed advertise banner
     * It works together Extremos site
     *
     */
    public function relatarBannerAdvertiseClick(){
        
        $get_post = array();
        $get_post['id'] = $_POST['id'];
        $get_post['clicks'] = 1;

        Yii::import('application.extensions.dbuzz.admin.ExtremosManager');
        $bannerHandler = new ExtremosManager();
        
        $bannerHandler->updateClickBanner($get_post);
    }
    
    /**
     *
     * Add to wish list
     *
     */
    public function addToWishList(){
        
        $data['id'] = $_POST['id'];
        $data['type'] = $_POST['type'];

        Yii::import('application.extensions.utils.ProdutosUtils');
        $addHandler = ProdutosUtils::addToWishList($data['id'], $data['type']);
        
        ActivityLogger::log("loja: item_adicionado_lista_desejos" . $data['type'] . ' ' . $data['id']);
        
        echo json_encode($addHandler);
    }
    
    /**
     *
     * Add to comparison items
     *
     */
    public function addToComparisonItems(){
        
        $data['id'] = $_POST['id'];
        $data['type'] = $_POST['type'];

        Yii::import('application.extensions.utils.ProdutosUtils');
        $addHandler = ProdutosUtils::addToComparisonList($data['id'], $data['type']);
        
        ActivityLogger::log("loja: item_adicionado_comparacao" . $data['type'] . ' ' . $data['id']);
        
        echo json_encode($addHandler);
    }
    
    /**
     *
     * Set Session data
     * Define uma session para ser setada antes
     *  
     *
     */
    public function setSessionData() {
      
        // print_r($_POST); exit;
        $label = $_POST['label'];
        $value = $_POST['value'];
        
        $setSession = MethodUtils::setSessionData($label, $value);
        
        $session = MethodUtils::getSessionData();
        
        $message = array("result" => false, "extra" => false);
        
        if ($session[$label] == $value) $message['result'] = true;
        
        echo json_encode($message);
    }
    
    /**
     *
     * Relatar inscricao na Newsletter
     * This method saves the email and name user
     *
     */
    public function inscricaoNewsletter(){
        
        Yii::import('application.extensions.utils.EmailUtils');
        
        $data['nome'] = $_POST['name_newsletter'];
        $data['email'] = $_POST['email_newsletter'];
        $data['message'] = Yii::t('messageStrings', 'message_result_apply_newsletter_success');;
        $data['newsletter'] = true;
        $data['send_notification'] = true;
        $date = date('Ymd');
        
        $data['SUCCESS'] = EmailUtils::acceptNewsLetter($data, $date);
        
        ActivityLogger::log("newsletter: nova_inscricao", 'inscricao_newsletter');
        
        $activity = array("title" => Yii::t("activityStrings","newsletter_submit"), "nome" => $data['nome'], "message" => Yii::t("activityStrings", "newsletter_submit_desc"), "tipo" => "newsletter", "id_general" => 0, "date" => date("Y-m-d H:i:s"), "last_update" => date("Y-m-d H:i:s"), "id_user" => 0);
        $setActivity = MethodUtils::setActivityRecent($activity);
  
        echo json_encode($data);
    }
    
    /**
     *
     * Relatar click
     * All kind of click with user logged in
     *
     */
    public function relatarClickUser(){
        
        $post = array();
        $post['message'] = $_POST['report'];
        $post['url'] = $_POST['url'];
        
        $session = MethodUtils::getSessionData();

        ActivityLogger::logId($session['id'], $post['message'], '', $post['url']);
    }
    
    /**
     *
     * Open Live Char
     * Create a record to provide a chatting action
     *
     */
    public function openLiveChat(){
        
        Yii::import('application.extensions.dbuzz.site.comentarios.InhamerManager');
        
        $session = MethodUtils::getSessionData();
        
        if($session['livechat'] == ''){
            
            $setLiveChat = MethodUtils::setSessionData('livechatLaunch', '1');
            if(!$session['livechatLaunchMessage']) $setSession = MethodUtils::setSessionData('livechatLaunchMessage' , true);
            
            $id = date("Ymds");
            $data = array('id_user'=> $id, 'nome' => '', 'comentario' => '', 'avatar' => '', 'date' => date('Y-m-d H:i:s') );
            $inhamerHandler = new InhamerManager();
            $inhamerHandler->submitComment($data, 1);
            
            $setSession = MethodUtils::setSessionData('livechat', $id);

        }

        ActivityLogger::log("livechat: aberto");
    }
    
    /**
     *
     * Closes Session
     * Closes session when users leaves site
     *
     */
    public function closeSession(){
        
        Yii::import('application.extensions.dbuzz.site.comentarios.InhamerManager');
        
        $session = MethodUtils::getSessionData();
        
        if($session['livechat'] != ''){
            $inhamerHandler = new InhamerManager();
            $inhamerHandler->setStatusInactivated($session['livechat'], 0);
            MethodUtils::setSessionData('livechat', '');
        }
        
        Yii::app()->session->destroy();

    }
    
    /**
     *
     * Remove os creditos do banner selecionado
     *
     */
    public function clearBannerCredits(){
        
        $data = array();
        $data['id'] = $_POST['id'];
        $data['status'] = 0;
        $data['creditos'] = 0;

        Yii::import('application.extensions.utils.BannersUtils');
        $bannerSet = BannersUtils::setBannerCredits($data['id'], null, $data['status'], $data['creditos'], true);
        
        echo $bannerSet;
    }
    
    /**
     *
     * Publicidade Flutuante
     *
     */
    public function flutuante(){

        Yii::import('application.extensions.utils.BannersUtils');
        $result['settings'] = BannersUtils::getFlutuanteSettings();
        
        if($result['settings']['flutuante_frequency'] == 'once') $set = MethodUtils::setSessionData('banner_flutuante', 'no_display_flutuante');
        
        echo json_encode(array('message' => 'done'));
    }
    
}
?>