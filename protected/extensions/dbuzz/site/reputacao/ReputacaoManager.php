<?php
/*
 * This Class is used to controll all functions related the feature Reputacao
 *
 * @author CarlosGarcia
 *
 *
 */

class ReputacaoManager{
    
    /**
     * Método para recuperar os usuarios que devem ser avaliados por um 
     * determinado outro usuário
     *
     *
    */
    public function getContentToAvaliate($id){
        
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        
        $userHandler = new UsersManager();
        
        $select = "id, id_owner, id_user, nota, comentario";
        $sql = "SELECT ".$select." FROM general_reputation WHERE id_user = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            //It join the pedidos_usuarios attributes
            for($i=0; $i < count($recordset); $i++){              
                $recordset[$i]['avatar'] = HelperUtils::getAvatar($recordset[$i]['id_user']);
                $recordset[$i]['user'] = $userHandler->getContentById($recordset[$i]['id_user']);
            } 

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }   
    
    /**
     * Método para salvar um voto
     *
     * @param array
     *
    */
    public function saveVote($data, $isMessage = true){        
        
        $select = "id, id_general, tipo, number";
        $sql = "SELECT ".$select." FROM general_reputation WHERE id_general = ".$data['id']. " AND tipo = '" . $data['tipo'] ."'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $data['votos'] = $recordset['number'] + $data['voto'];
                $update = "number = '".$data['votos']."'";
                $sql = "UPDATE general_reputation SET $update WHERE id_general = ".$data['id']. " AND tipo = '" . $data['tipo'] ."'";
            }else{
                $data['votos'] = $data['voto'];
                $select = "id_general, tipo, number";
                $values = $data['id']."', '".$data['tipo']."', '" . $data['voto']. "";
                $sql =  "INSERT INTO general_reputation (". $select .") VALUES ('". $values . "')";
            }
        
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
        
        $setNewLevel = $this->updateReputationLevel($data, $isMessage);
        
    }
    
    /**
     * Método para salvar um voto
     *
     * @param array
     *
    */
    public function updateReputationLevel($data, $isMessage){
        
        Yii::import('application.extensions.utils.ReputationUtils');
        
        try{
            
            $level  = ReputationUtils::getLevelReputation($data);
            
            if($data['tipo'] == "user_vote"){               
                $update = "reputation = '$level'";
                $sql = "UPDATE user_data SET $update WHERE id = ".$data['id']."";
            }
            
            if($data['tipo'] == "produto_vote"){               
                $update = "reputation = '$level'";
                $sql = "UPDATE ecommerce_produtos SET $update WHERE id = ".$data['id']."";
            }
            
            if($data['tipo'] == "promocao_vote" || $data['tipo'] == "promocao_diadasmaes"){               
                $update = "reputacao = '". $data['votos']."'";
                $sql = "UPDATE promocao_participantes SET $update WHERE id = ".$data['id']."";
            }
        
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
        
        if($isMessage) echo Yii::t('messageStrings', 'message_result_vote_success');
    }

    /**
     * Método para recuperar as informações de reputação de um determinado
     * usuário a partir do id deste indivíduo
     *
     * @param number
     *
    */
    public function getContentById($id){

        $select = "id, id_owner, id_user, nota, comentario";
        $sql = "SELECT ".$select." FROM general_reputation WHERE id_user = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }   
}
?>