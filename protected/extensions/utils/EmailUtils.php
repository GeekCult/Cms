<?php

/**
 * Description of EmailUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class EmailUtils {
    
    /**
     * Método para o pegar o e-mail de contato
     *
    */
    public static function getEmailContato($tipo = 'email_contato'){       
            
        $select = "email_contato";
        $sql = "SELECT $select FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset[$tipo];

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para o pegar o e-mail de envio
     *
    */
    public static function getEmailSender(){       
            
        $select = "email_sender";
        $sql = "SELECT $select FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset['email_sender'];

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para o pegar o e-mail de contato
     *
    */
    public static function getEmailLayout() {       
            
        $select = "textura_topo_email, textura_rodape_email";
        $sql = "SELECT $select FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para o checar se um e-mail já
     * está previamente cadastrado
     *
    */
    public static function checkEmailExist($email){ 
        
        $select = "id, field1, field2, type, email, email_hash";
        $sql = "SELECT $select FROM user_data WHERE email = '$email'";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();           
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }  
    }
    
    /**
     * Método para o checar se um e-mail já
     * está previamente cadastrado em user_company
     *
    */
    public static function checkEmailCompanyExist($email, $isSimilar = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
    
        $select = "id, nome, telefone_1, cpf, email, profissao, data_aniversario";
        $sql = "SELECT ".$select." FROM user_company WHERE email = '$email'";
        if($isSimilar) $sql = "SELECT ".$select." FROM user_company WHERE email LIKE '%" . $email . "%'";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 
            
            if($recordset) $recordset['data_aniversario_format'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['data_aniversario']);
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o checar se um e-mail  já
     * está previamente cadastrado nas newsletter
     *
    */
    public static function checkEmailNewsletterExist($email, $isSimilar = false){
    
        $select = "id, nome, email, newsletter";
        $sql = "SELECT $select FROM general_newsletter WHERE email = '$email'";
        if($isSimilar) $sql = "SELECT $select FROM general_newsletter WHERE email LIKE '%$email%'";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o desbloquear email se estiver bloqueado
     *
    */
    public static function unblockEmail($data){

        $sql = "UPDATE user_data SET account_states_id = 1 WHERE email = '{$data['email']}'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para inscrever um e-mail na newsletter
     * 
     * @param array
     * @param date
     *
    */
    public static function acceptNewsLetter($data, $date){
        
        Yii::import('application.extensions.utils.special.NewsLetterUtils');
        
        if(!isset($data['ramo_atuacao'])) $data['ramo_atuacao'] = 0;
        if(!isset($data['abordagem'])) $data['abordagem'] = 1;
        
        $insert = "nome, email, newsletter, data, ramo_atuacao, abordagem";
        $values = "'".$data['nome']."', '".$data['email']."', '".$data['newsletter']."', '".$date."', '".$data['ramo_atuacao']."', '".$data['abordagem']. "'" ;
        $sql = "INSERT INTO general_newsletter (".$insert.") VALUES (".$values.")";
            
        $isExist = EmailUtils::checkEmailNewsletterExist($data['email']);
        //$checkMailGun =  MethodUtils::checkEmailValidation($data['email']);
        
        //if($checkMailGun) $defineAcceptance = NewsLetterUtils::insertPierMail($data, $date, false);
            
        try{           
            $command = Yii::app()->db->createCommand($sql);
            
            if(!$isExist){
                if($checkMailGun){$save = $command->execute();}else{$save = false;}
                
                $data_message['nome'] = $data['nome'];                   
                $data_message['email'] = $data['email'];
                $data_message['message'] = "";
                $data_message['layout'] = "newsletter_common";
                $data_message['tipo'] = $data_message['tipo_mensagem'] = "newsletter";
                $data_message['newsletter'] = false;
                
                if(isset($data['send_notification'])) $send_notification = MethodUtils::sendEmail($data_message);
                
            }else{
                $save = false;
            }
            
            return $save;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return "ERROR: EmailUtils - acceptNewsLetter() " . $e->getMessage();
        }  
    }
    
    /**
     * Método para salvar um contato por e-mail, ou pergunta ou ooutra interação
     * 
     * @param array
     * @param date
     *
    */
    public static function saveContact($data){
        
        $insert = "nome, email, telefone, mensagem, data, tipo, last_update";
        $values  = "'".$data['nome']."', '".$data['email']."', '".$data['telefone']."', '".$data['mensagem']."', '".$data['data']."',";
        $values .= "'".$data['tipo']."', '".$data['data']."'";
        $sql = "INSERT INTO general_contato (".$insert.") VALUES (".$values.")";
            
        try{           
            $command = Yii::app()->db->createCommand($sql);
            $save = $command->execute();
            
            return $save;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para obter o template que será usado para disparar o e-mail
     * 
     * @param string
     *
    */
    public static function getEmailTemplate($tipo){
        
        switch($tipo){
            case "pedido_reclamar":
                $result = "pedido_reclamar";
                break;
            
            case "contato":
                $result = "contato_common";
                break;
            
            default :
                $result = "contato_common";
                break;
        }
        
        return $result;
    }
    
    /**
     * Método para obter o template que será usado para disparar o e-mail
     * 
     * @param string
     *
    */
    public static function prepareEmail($email, $nome, $sobrenome, $domain){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        
        if($email != ''){
            $result = StringUtils::StringToLowerCase($email);
        }else{
            $nome = StringUtils::StringToLowerCase($nome, 'simple');
            $sobrenome = StringUtils::StringToLowerCase($sobrenome, 'simple');
            $contato = StringUtils::StringToUnderline($nome . "_" . $sobrenome, true);
            $ref =   $contato . '@' . $domain;
            
        }
        
        return $result;
    }
    
    /**
     * Método para obter o uma string com os email
     * 
     * @param string
     *
    */
    public static function organizeEmailToString($emails, $type = false){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        $result = ""; $p = 0;
        
        //Adiciona os emails em uma string dependendo do tipo
        for($i = 0; $i < count($emails); $i++){
            if($type == 'kind'){
                if($i < count($emails) -1) $result .= $emails[$i]['user']['email'] . ", ";
                if($i >= count($emails) -1) $result .= $emails[$i]['user']['email'];
            }
            $p++;
        }
        
        return $result;
    }
}
?>