<?php

/**
 * Description of SubmitUtils
 *
 * Here are some method to make easier the class banners
 *
 * @author CarlosGarcia
 */
class SubmitUtils{
    
    /**
     * Método para setar o envio do email
     *
     * @param POST
     *
    */
    public static function dispatchEmail(){
        
        Yii::import('application.extensions.dbuzz.site.email.EmailManager'); 
        $emailHandler = new EmailManager();
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        $data = SubmitUtils::getInfoDescription($params['tipo']);
        
        $result['nome'] =  $params['nome'];      
        $result['titulo_email'] = $data['titulo'];
        $result['titulo'] = $data['titulo'];
        

        $result['tipo'] =  $params['tipo'];
        $result['render'] =  false;
        $result['newsletter'] = false;
        $result['descricao'] = $params['descricao'];
        
        
        $result['logo'] = HelperUtils::getLogo("logos");
        $result['layout_template'] = "contato_common";
        
        //New render partial
        //$params['view'] = $this->controller->renderPartial("/templates/email/views/boleto", $params, true);
        
        $result['result'] = $emailHandler->submitSubscription($result);
        
        $result['message'] = Yii::t('messageStrings', 'message_result_sent_success');        
        $set = MethodUtils::returnMessage($result);
    }

    /**
     * Método para setar o envio do email
     *
     * @param POST
     *
    */
    public static function getInfoDescription($tipo){
        
        $result = array();
        
        switch($tipo){
            case "webmail":
                $result['titulo'] = "Dúvida de WebMail";                
                break;
            
            case "sob_consulta":
                $result['titulo'] = "Consulta de preço";                
                break;
        }
        
        return $result;
    }
}
?>