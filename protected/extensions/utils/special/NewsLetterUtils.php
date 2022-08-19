<?php

/**
 * Description of NewsLetterUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 * 
 */
class NewsLetterUtils {
    
    /**
     * Método para o obter a lista de usuários da newsletter
     * 
     * @param string
     * @param boolean
     *
    */
    public static function setNewsLettersContact($data){
     
        $insert  = "nome, email, newsletter, data, ramo_atuacao, abordagem, cidade";
        $values  = "'{$data['nome']}', '{$data['email']}', '{$data['newsletter']}', '{$data['date']}', '{$data['ramo_atuacao']}', '{$data['abordagem']}', '{$data['cidade']}'";
        
        $sql = "INSERT INTO general_newsletter ({$insert}) VALUES ({$values}) ON DUPLICATE KEY UPDATE email = '{$data['email']}'";
        
        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->execute(); 
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o checar se um e-mail já
     * está previamente cadastrado no PierMail
     * 
     * @param string
     * @param boolean
     *
    */
    public static function checkEmailNewsletterExist($email, $isSimilar = false){ 
    
        $select = "id, nome, email, newsletter";
        $sql = "SELECT ".$select." FROM piermail WHERE email = '$email'";
        if($isSimilar) $sql = "SELECT ".$select." FROM general_newsletter WHERE email LIKE '%" . $email . "%'";

        try{          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow(); 
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para inscrever um e-mail no PierMail
     * 
     * @param array
     * @param date
     *
    */
    public static function insertPierMail($data, $date){
        
        $domain = $_SERVER['SERVER_NAME'];
        if(!isset($data['cidade'])) $data['cidade'] = '';
        if(!isset($data['ramo_atuacao'])) $data['ramo_atuacao'] = 0;
        if(!isset($data['abordagem'])) $data['abordagem'] = 0;
        
        $insert  = "nome, email, newsletter, data, ramo_atuacao, domain, abordagem, cidade";
        $values  = "'".$data['nome']."', '".$data['email']."', '".$data['newsletter']."', '".$date."', '".$data['ramo_atuacao']. "'," ;
        $values .= "'".$domain ."', '".$data['abordagem']."', '".$data['cidade']. "'";
        
        $sql = "INSERT INTO piermail ($insert) VALUES ($values)";
            
        $isExist = NewsLetterUtils::checkEmailNewsletterExist($data['email']);
            
        try{           
            $command = Yii::app()->db2->createCommand($sql);
            
            (!$isExist) ? $save = $command->execute() : $save = false;
            return $save;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para inscrever um e-mail no PierMail
     * 
     * @param array
     * @param date
     *
    */
    public static function removeFromPierMail($email){
        
        $sql = "DELETE FROM piermail WHERE email ='{$email}'";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();

            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para alterar o status de um cliente do PierMail
     * 
     * @param array
     * @param date
     *
    */
    public static function changeStatusFromPierMail($email, $status){
        
        $sql = "UPDATE piermail SET newsletter = $status WHERE email = '$email'";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();

            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }

    /**
     * Método para o obter a lista de usuários da newsletter
     * 
     * @param string
     * @param boolean
     *
    */
    public static function getNewsLettersData($email = false){
     
        $sql = "SELECT id, nome, email FROM general_newsletter WHERE newsletter = 1";
        if($email) $sql = "SELECT id, nome, email FROM general_newsletter WHERE newsletter = 1 AND email = '$email'";
        
        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o obter a lista de usuários da newsletter
     * 
     * @param string
     * @param boolean
     *
    */
    public static function getNewsLettersPierMail($email = false){
     
        $sql = "SELECT id, nome, email FROM piermail WHERE newsletter = 1";
        if($email) $sql = "SELECT id, nome, email FROM piermail WHERE newsletter = 1 AND email = '$email'";
        
        try{          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o obter a lista de usuários da newsletter
     * 
     * @param string
     * @param boolean
     *
    */
    public static function getUsersData($type, $isPurple = false){
     
        Yii::import('application.extensions.utils.users.UserUtils');
        
        try{          
            $recordset = UserUtils::getAllKindUsers($type, $isPurple); 

            if(!$recordset) $recordset = array();
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o remover um e-mail do Mailing
     * 
     * @param number
     *
    */
    public static function updateEmailStatus($id, $status = 0, $email = false){
     
        $sql = "UPDATE general_newsletter SET newsletter = $status WHERE id = $id";
        if($email) $sql = "UPDATE general_newsletter SET newsletter = $status WHERE email = '$email'";
        
        try{          
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            if($status == 0){
                $data = array('tipo' => 'unsubscribed');
                if($control) $organize = NewsLetterUtils::organizeActivity($data);
                if($email) $remove = NewsLetterUtils::removeFromPierMail($email);
                if(!$email){
                    $email = NewsLetterUtils::getEmailData($id);
                    if($email) $set = NewsLetterUtils::changeStatusFromPierMail($email['email'], 0);
                }
            }
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o obter os dados do email
     * 
     * @param string
     * @param boolean
     *
    */
    public static function getEmailData($id){
     
        $sql = "SELECT id, nome, email FROM general_newsletter WHERE id = $id";
        
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
     * Método para o adicionar uma atividade webhook vinda da API
     * 
     * @param array
     *
    */
    public static function setActivity($data){
        
        $insert  = "tipo, email, cidade, date, ip, message, codigo, error";
        
        $values  = "'{$data['tipo']}', '{$data['email']}', '{$data['cidade']}', '{$data['data']}', '{$data['ip']}', ";
        $values .= "'{$data['message']}', '{$data['codigo']}', '{$data['error']}'";
        
        $sql = "INSERT INTO general_newsletter_tracker (".$insert.") VALUES (".$values.")";
        try{          
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR: NewsLetterUtils - setActivity() ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
    /**
     * Método para o adicionar uma atividade webhook vinda da API
     * 
     * @param array
     *
    */
    public static function organizeActivity($data){
        
        Yii::import('application.extensions.dbuzz.admin.special.DatesManager');
        Yii::import('application.extensions.utils.special.DatesUtils');
        
        $datesHandler = new DatesManager();
        
        date_default_timezone_set("Brazil/East");
        $date = date("Ymd");
        
        try{
            $id_date = $datesHandler->getDateId($date);

            $item = DatesUtils::getDateItem($id_date['id'], 'desktop', $data['tipo']);
            if(!isset($data['sent_amount'])) $set = $datesHandler->setDateItem($id_date['id'], "desktop", $data['tipo'], "inteiro", $data['tipo'], $item['inteiro'] + 1, date("Y-m-d H:i:s"));
            if( isset($data['sent_amount'])) $set = $datesHandler->setDateItem($id_date['id'], "desktop", $data['tipo'], "inteiro", $data['tipo'], $item['inteiro'] + $data['sent_amount'], date("Y-m-d H:i:s"));

            return $set;
            
        }catch(CDbException $e){
            Yii::trace("ERROR: NewsLetterUtils - organizeActivity() ".$e->getMessage());
            return $e->getMessage();
        }  
    }
    
}
?>
