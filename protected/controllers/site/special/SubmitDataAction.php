<?php

class SubmitDataAction extends CAction {

    private $emailHandler;
    private $action;

    /**
     *
     * Submit main class for submit data;
     * Special Class
     *
     * 
     */
    public function run(){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
                    
        ActivityLogger::log("submit: " . $this->action, 'inscricao');
        
        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;
        
        $this->action = Yii::app()->getRequest()->getQuery('action');         
        $this->emailHandler = new EmailManager();
        $valida = new dbValidar();

        if(!isset($_POST['email']) || $_POST['email'] == "" || $_POST['email'] == "E-mail" ||
          (isset($_POST['email']) && !$valida->email($_POST['email']))){
           $data['STATUS'] = 0; $data['ERROR'][0]['ERROR_MSG'] = "E-mail vazio ou incorreto";
           echo json_encode($data); 
           return;
        }
        
        //TODO Não utilziar mais Actions para disparar ações estaticamente
        if($isPostRequest){
            try{
                
                switch ($this->action){
                    
                    case "promocao":
                        Yii::import('application.controllers.site.special.PromocaoAction');
                        $set = PromocaoAction::participarPromocao();
                        break;
                    
                    case "reserva":
                        Yii::import('application.controllers.site.special.ReservasAction');
                        $set = ReservasAction::fazerReserva();
                        break;
                    
                    case "webmail":
                        Yii::import('application.extensions.utils.special.SubmitUtils');
                        $send = SubmitUtils::dispatchEmail();
                        break;
                    
                    case "orcamentus_pedido":
                        Yii::import('application.extensions.utils.special.OrcamentusUtils');
                        $set = OrcamentusUtils::submitOrder();
                        break;
                    
                    case "orcamentus_proposta":
                        Yii::import('application.extensions.utils.special.OrcamentusUtils');
                        $set = OrcamentusUtils::submitProposta();
                        break;
                    
                    case "sob_consulta":
                        $this->sobConsulta();
                        break;
                    
                    default:
                        echo "error";
                        break;
                }  
            
            }catch(CDbException $e){
                Yii::trace("ERROR " . $e->getMessage());
                echo "ERROR: SubmitAction - run() " . $e->getMessage();
            }
        
        }
    }
    
    /*
     * 
     */
    public function sobConsulta(){        
        
        Yii::import('application.extensions.dbuzz.site.produtos.EcommerceManager');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.SubmitUtils');
        Yii::import('application.extensions.utils.EmailUtils');       
        
        $ecommerceHandler = new EcommerceManager();
        $session = MethodUtils::getSessionData();
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        $data = SubmitUtils::getInfoDescription('sob_consulta');      
        
        
        $params['name'] =  $params['nome'];
        $params['id_pedido'] = $session['PP_Id_Pedido'];
        
        $id = UserUtils::createDrillAccount($params);        
        $params['id_usuario'] = $id;
        
        $params['content'] = $ecommerceHandler->getFullItemsPayment($session['PP_Id_Pedido'], "produto");
        
        
        $params['titulo_email'] = $data['titulo'];
        $params['titulo'] = $data['titulo'];
        $params['dados'] = HelperUtils::getTitleSite();
        
        $params['tipo'] =  'cotacao';//Qualquer coisa
        $params['render'] =  true;
        $params['render_reply'] =  true;
        $params['newsletter'] = true;
        $params['descricao'] = $params['message'];        
        
        $params['logo'] = HelperUtils::getLogo("logos");
        $params['layout_template'] = EmailUtils::getEmailLayout();
        
        
        //New render partial
        $params['view'] = $this->controller->renderPartial("/templates/email/views/sob_consulta", $params, true);
        $params['view_reply'] = $this->controller->renderPartial("/templates/email/views_reply/sob_consulta", $params, true); 
        
        $result['result'] = MethodUtils::sendEmailDirectly($params);
        
        $result['message'] = Yii::t('messageStrings', 'message_result_sent_success');        
        $set = MethodUtils::returnMessage($result);
    }
   
}
?>