<?php
/*
 * This Class is used to controll all functions related PUT feature PurplePier
 * Just use it to SET values, if you need GET, UPDATE, DELETE some value, 
 * please use a support class
 *
 * @author CarlosGarcia
 *
 */

class PurplePierManager{

    /**
     * Método para salvar os dados coletados da pesquisa 
     *
     * @param array
     *
    **/
    public function savePedido($data){
        
        (Yii::app()->params['id_user'] != '') ? $id_usuario = Yii::app()->params['id_user'] : $id_usuario = 0;
        if(!isset($data['plataforma'])) $data['plataforma'] = 'desktop';
        
        $select  = "titulo, descricao, tipo, quantidade, valor, data, last_update, email, nome, id_general, dominio, detalhes, id_usuario, cliente";        
        
        $values  = "'{$data['titulo']}', '".$data['descricao']."', '".$data['tipo']."', '".$data['quantidade']. "',";        
        $values .= "'{$data['valor']}', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '{$data['email']}', '{$data['nome']}', {$id_usuario},";
        $values .= "'{$data['dominio']}', '{$data['plataforma']}', '$id_usuario', '{$data['cliente']}'";
        
        $sql =  "INSERT INTO controle_chamados ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            //$control = $comando->execute();
            
            $setToPurple = $this->setClientInformation($id_usuario, 'job', $data);
     
            //Main data
            $data['telefone'] = "";
            $data['tipo'] = "erp_publicidade";
            $data['layout'] = "erp_publicidade";
            $data['layout_reply'] = "reply_erp_publicidade";
            $data['newsletter'] = false;
            $data['tipo_conta'] = 1;
            $data['titulo_job'] = $data['titulo'];
            $data['email_reply'] = $data['email_reply'];
            $data['email'] = 'publicidade.exe@gmail.com';
            
            //$id = Yii::app()->db->getLastInsertID(); 
            $sendEmail = MethodUtils::sendOrder($data);
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - savePedidoPublicidade() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma visita ao Manager DB 
     *
     * @param array
     *
    **/
    public function setPing($data){
               
        $date = date("Y-m-d H:i:s");        
        $dominio = $_SERVER['SERVER_NAME'];
        isset($data['inteiro']) ? $inteiro = $data['inteiro'] : $inteiro = 0;
        
        $values  = "'{$data['titulo']}', '{$data['descricao']}', '{$data['tipo']}', '";        
        $values .= "{$date}', '{$date}', '{$dominio}', '{$data['plataforma']}', $inteiro";
        
        $sql =  "INSERT INTO controle_ping (titulo, descricao, tipo, date, last_update, dominio, plataforma, inteiro) VALUES ({$values})";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - setVisita() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um usuário 
     *
     * @param array
     *
    **/
    public function setPierProfile($data, $isEcho = false){
               
        $date = date("Ymd");        
        $dominio = $_SERVER['SERVER_NAME'];
        
        $values  = "'{$data['field1']}', '{$data['field2']}', '{$data['email']}', "; 
        $values .= "'{$data['avatar']}', '{$data['tipo_conta']}', '{$data['ramo_atuacao']}', "; 
        $values .= "'{$date}', '{$dominio}', '{$data['estado']}',  '{$data['cidade']}', ";
        $values .= "'{$data['bairro']}', '{$data['extra_1']}'";
        
        $sql = "INSERT INTO pierprofile (field1, field2, email, avatar, type, ramo_atuacao, creation, dominio, estado, cidade, bairro, extra_1) VALUES ({$values})";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            //Don't touch here, use return due subscription detais
            return 'ERROR: PurplePierManager - setPierProfile() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar uma compra 
     *
     * @param array
     *
    **/
    public function setPurchase($data){
        
        Yii::import('application.extensions.dbuzz.site.special.PurpleStoreManager');
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        
        $purpleStoreHandler = new PurpleStoreManager();
               
        $date = date("Y-m-d H:i:s");        
        $dominio = $_SERVER['SERVER_NAME'];
        $id_user = Yii::app()->params['id_user'];//Set alllllllll user on 
        (isset($data['inteiro'])) ? $inteiro = $data['inteiro'] : $inteiro = 1;
        
        //Get item, so check before invoice
        $item = $purpleStoreHandler->getItemById($data['id_item']);
        $item = PurpleStoreUtils::checkItemBeforeInvoice($item);
        
        //ESPECIAL
        if($data['tipo'] == 'disparo_email'){$item['valor'] = 0; $item['descricao'] = $data['descricao'];} 
        
        $values  = "'{$data['titulo']}', '{$item['descricao']}', '{$data['tipo']}', '";        
        $values .= "{$date}', '{$date}', '{$dominio}', '{$data['plataforma']}', $id_user, {$data['id_item']}, {$item['valor']}, ";
        $values .= "$inteiro";
        
        $sql = "INSERT INTO pierpurchases (titulo, descricao, tipo, date, last_update, dominio, plataforma, id_user, id_item, valor, qtd) VALUES ({$values})";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - setPurchase() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter as informaçoes do usuário
     *
     * @param array
     *
    **/
    public function requestClientInformation($id_user, $url, $data = array()){
        
        Yii::import('application.extensions.utils.launchers.CurlUtils');
        
        try{
            $uri = "https://www.purplepier.com.br/site/request/{$url}/{$id_user}";
            $request = CurlUtils::getFileContents($uri, $data);
            
            return $request;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - requestClientInformation() ' . $e->getMessage();
        }
    } 
    
    /**
     * Método para setar informaçoes do usuário
     *
     * @param array
     *
    **/
    public function setClientInformation($id_user, $url, $data = array()){
        
        Yii::import('application.extensions.utils.launchers.CurlUtils');
        
        try{
            $uri = "https://www.purplepier.com.br/site/request/{$url}/{$id_user}";
            $request = CurlUtils::getFileContents($uri, $data);
            
            return $request;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - setClientInformation() ' . $e->getMessage();
        }
    } 
    
    /**
     * Método para setar informaçoes do usuário
     *
     * @param array
     *
    **/
    public function getClientAccountInfo($id_user){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        
        try{
            $result['dados'] = UserUtils::getClientAttributes($id_user);

            //Pega os clientes integrados aos cliente principal
            $getIntegrados = UserUtils::getIntegrados($id_user);
            if($getIntegrados && count($getIntegrados) > 0){
                foreach($getIntegrados as $dados){
                    $result['integrados'][] = UserUtils::getClientAttributes($dados['user_id']);               
                }
            }
            
            return json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PurplePierManager - getClientAccountInfo() ' . $e->getMessage();
        }
    }
}

?>