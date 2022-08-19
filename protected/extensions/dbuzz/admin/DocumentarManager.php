<?php
/*
 * This Class is used to controll all functions related the feature Configurar
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */

class DocumentarManager {

    /**
     *
     * Returns all recorded apontamentos from the database.
     *
     */

    public function getAllApontamentos($month, $year) {
        
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $query = "SELECT * FROM general_apontamento WHERE data >= '$year-$month-01' AND data <= '$year-$month-31' ORDER BY worker_id";

        try {

            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();
            
            for($i = 0; $i < count ($result); $i++){
                $result[$i]['data'] = DateTimeUtils::getDateFormateNoTime($result[$i]['data']);
                $result[$i]['worker_id_string'] = UserUtils::getUserFullById($result[$i]['worker_id']);
            }
            
            $result[0]['total'] = DataBaseUtils::getSUMRecords('general_apontamento', 'quantidade_horas', 'worker_id', 254,'data', $year, $month);
            
            return $result;            
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Submits the post data received on the apontamento table.
     *
     */

    public function submitApontamento($get_post) {
        Yii::import('application.extensions.utils.DateTimeUtils');

        // Formats the user-received date compatible with the database type.
        $get_post[1] = DateTimeUtils::setFormatDateTime($get_post[1]);

        // Save the return message for latter use.
        $message = $get_post['message'];

        // Unset the message so we have user-only data on the post.
        unset($get_post['message']);

        // Creates a list of the values required by the database delimited by a comma.
        $values = '"' . implode('","', $get_post) . '"';

        $query = 'INSERT INTO general_apontamento(titulo, data, quantidade_horas,
        worker_id, descricao) VALUES (' . $values . ')';

        try {

            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->execute();
            
            // $prepare2 = Yii::app()->db3->createCommand($query);
            // $result2 = $prepare2->execute();

            echo $message;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     *
     * Return the default values to fill in the input boxes on the Apontamento view.
     *
     */

    public function getApontamentoById($id = 0) {

        Yii::import('application.extensions.utils.users.UserUtils');

        $query = 'SELECT * FROM general_apontamento WHERE id_apontamento = '. $id;

        try {

            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryRow();

            $result['funcionarios'] = UserUtils::getAllKindUsers("desenvolvedores");

        } catch(CDbException $e) {

            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();

        }

        return $result;
    }

    /**
     * Método para recuperar um registros de algum dos tipos criados
     * 
     * It's using the manager_purplepier to handle with these
     * records  
     *
     * @param string
     *
     */

    public function getAllContent($tipo) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        $select = "id, tipo, titulo, subtitulo, detalhes, descricao, data, user";
        $sql = "SELECT ".$select." FROM general_documentacao WHERE tipo = '$tipo' ORDER BY id DESC";

        try {
            $command = Yii::app()->db3->createCommand($sql);
            $recordset = $command->queryAll();
            
            for ($i = 0; $i < count($recordset); $i++) {
                $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros de bugs abertos
     * 
     * It's using the manager_purplepier to handle with these
     * records  
     *
     *
     */

    public function getAllContentBugs($tipo, $status) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        $select = "id, tipo, titulo, subtitulo, detalhes, descricao, data, user";
        $sql = "SELECT ".$select." FROM general_documentacao WHERE tipo = '$tipo' AND status = $status ORDER BY detalhes ASC";

        try {
            $command = Yii::app()->db3->createCommand($sql);
            $recordset = $command->queryAll();
            
            for ($i = 0; $i < count($recordset); $i++) {
                $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
            }

            return $recordset;

        } catch(CDbException $e) {

            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();

        }
    }
    
    /**
     * Método para recuperar um registros de bugs criados
     * It's using the manager_purplepier to handle with these
     * records  
     *
     *
     */

    public function getContentById($id) {
        
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, tipo, titulo, subtitulo, detalhes, descricao, data, last_update, status, anotacao, id_worker, user";
        $sql = "SELECT ".$select." FROM general_documentacao WHERE id = $id";

        try {
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            
            if ($recordset) {
                $recordset['data'] = DateTimeUtils::getDateFormateNoTime($recordset['data']);
                $recordset['last_update'] = DateTimeUtils::getDateFormate($recordset['last_update']);
                $recordset['status_id'] = $recordset['status'];
                $recordset['status'] = PedidosUtils::getStatusString($recordset['status_id']);
                $recordset['funcionarios'] = UserUtils::getAllKindUsers("desenvolvedores");
            
                
            } else {
                $recordset = false;
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro bug
     *
     * @param array
     *
     */

    public function submitBugContent($get_post) {

        $select = "titulo, descricao, tipo, data, user, detalhes, last_update";
        $values = $get_post[0]."', '".$get_post[1]."', '".$get_post[2]."', '".$get_post[3]."', '".$get_post['user']."', '".$get_post['prioridade']."', '".$get_post[3];
        $sql =  "INSERT INTO general_documentacao (". $select .") VALUES ('". $values . "')";

        try {
            $comando = Yii::app()->db3->createCommand($sql);
            $control = $comando->execute();
            echo $get_post['message'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro release
     *
     * @param array
     *
     */

    public function submitReleasesContent($get_post) {

        $select = "titulo, descricao, tipo, data";
        $values = $get_post[0]."', '".$get_post[1]."', '".$get_post[2]."', '".$get_post[3];
        $sql =  "INSERT INTO general_documentacao (". $select .") VALUES ('". $values . "')";

        try {
            $comando = Yii::app()->db3->createCommand($sql);
            $control = $comando->execute();
            echo $get_post['message'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para excluir um registro existente
     * TODO: It uses a GET http request: Change it!
     *
     * @param number
     *
     */

    public function deleteContent($get_post) {

        $sql = "DELETE FROM general_documentacao WHERE id ='" . $get_post['id']. "'";

        try {
            $comando = Yii::app()->db3->createCommand($sql);
            $control = $comando -> execute();
            echo $get_post['message'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o registro do bug, mais precisamente para
     * mudar seu status ou resolve-lo 
     *
     * @param array
     *
     */

    public function updateStatus($data) {

        $values  = "user = '" . $data['nome'] ."', titulo = '" . $data['titulo'] ."', " ."descricao = '" . $data[ 'descricao'] ."', " . "last_update = '" . $data[ 'data'] ."', ";
        $values .= "anotacao = '" . $data['anotacao'] ."', " ."status = '" . $data[ 'status'] ."', " . "id_worker = '" . $data[ 'id_worker'] ."', " . "detalhes = '" . $data[ 'prioridade'] ."' ";
        $sql =  "UPDATE general_documentacao SET ". $values ." WHERE id = " .$data['id'] . "";
        

        try {
            $command = Yii::app()->db3->createCommand($sql);
            $control = $command->execute();
            
            echo Yii::t("messageStrings", "message_result_bug_update");

        } catch(CDbException $e) {

            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();

        }
    } 
    
    /**
     * Método para atualizar o registro acordo de uso 
     *
     * @param array
     *
     */

    public function saveAgreement($id, $status) {

        $sql =  "UPDATE user_data SET concorda_purplepier = $status WHERE id = $id";
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();
            
            echo "Concorda com termos de uso!";

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    } 
}

?>