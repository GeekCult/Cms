<?php
/*
 * This Class is used to controll all functions related the feature Forum
 *
 * @author CarlosGarcia
 *
 * Date: 12/12/2010
 * 
 * 
 * Tipos => 1:messages, 2:novidades, 3:atualizações, 4:termos, 5:revisoes
 *
 */
class CanalComunicacaoManager {

    /**
     * Método para recuperar todos os registros
     * da tabala materias.
     *
     * @param string
    */
    public function getAllContent() {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();

        $select = "id, titulo, descricao, tipo, data, last_update, container_1";
        $query = "SELECT ".$select." FROM general_messages WHERE tipo != 5";
        
        $query .= " ORDER BY data DESC";

        try {
            $command = Yii::app()->db2->createCommand($query);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                    $recordset[$i]['tipo_string'] = $this->getTipoByNumber($recordset[$i]['tipo']);
                }
            }else{
                $recordset = false;
            }  
            
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getAllContent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro vazio
     *
     * @param number id
     *
    */
    public function getContentEmpty(){
        
        $recordset['id'] = "";
        $recordset['titulo'] = "";
        $recordset['tipo'] = "";
        $recordset['descricao'] = "";       
        $recordset['data'] = "";
        $recordset['container_1'] = "";
        $recordset['last_update'] = "";
        $recordset['data_string'] = "";
        $recordset['last_update_string'] = "";
        $recordset['status'] = "";
        $recordset['link'] = "";
        return $recordset;
 
    }


    /**
     * Método para recuperar um determinado registro
     * Usado em editar conteúdo
     *
     * @param number
     *
    */
    public function getContentById($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.ShortUrlUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.ModulesUtils');
        Yii::import('application.extensions.utils.MateriasUtils');
        Yii::import('application.extensions.utils.StringUtils');

        $select = "id, titulo, descricao,tipo, data, last_update, container_1, link, status, cliente";
        $sql = "SELECT ".$select." FROM general_messages WHERE id = $id ";
       
        try{
    
            $command = Yii::app()->db2->createCommand($sql);            
            $recordset = $command->queryRow();

            if($recordset) {
                $recordset['data_parts'] = DateTimeUtils::getDateFormateNoTimeStampParts($recordset['data']);
                $recordset['url_title'] = StringUtils::StringToUrl($recordset['titulo']);
                $recordset['last_update_string'] = DateTimeUtils::getDateFormate($recordset['last_update']);
                $recordset['shorturl'] = ShortUrlUtils::getShortUrl($recordset['id']);
                $recordset['data_string'] = DateTimeUtils::getDateFormate($recordset['data']);
            }
              
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getContentById() ' . $e->getMessage();
        }
    }

    /**
     * Método para excluir um registro existente
     * TODO: It uses a GET http request: Change it!
     *
     * @param number
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM conteudo_forum WHERE id ='{$data['id']}'";
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR CanalComunicacaoManager - deleteContent() ' .  $e->getMessage();
        }
    }

    /**
     * Método para criar/atualizar um registro existente
     *
     * @param array
     *
    */
    public function saveContent($arr = array(), $isArg = false, $update = array()){
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        $last_update = date("Y-m-d H:i:s");
        $session = MethodUtils::getSessionData();
        $params['titulo'] = addslashes($params['titulo']);
        $params['descricao'] = addslashes($params['descricao']);
        if(!isset($params['cliente'])) $params['cliente'] = "";
        
        //Caso precise atualizar um registro invés de salvar outro
        if(isset($update['update'])){
            $check = $this->checkMessageExist($update['tipo'], $update['cliente']);
            if($check){
                $params['action'] = 'editar'; 
                $params['id'] = $check['id'];
            }
        }
        
        try{
            
            if($params['action'] != "editar"){
                $sql  = "INSERT INTO general_messages (titulo, descricao, tipo, last_update, data, status, container_1, link, cliente) ";
                $sql .= "VALUES ('{$params['titulo']}', '{$params['descricao']}', '{$params['tipo']}', '{$last_update}', '{$last_update}', {$params['status']}, '{$params['image_1']}', '{$params['link']}', '{$params['cliente']}')";

            }else{
                $sql  = "UPDATE general_messages SET titulo = '{$params['titulo']}', descricao = '{$params['descricao']}',  tipo = '{$params['tipo']}', ";
                $sql .= "last_update = '$last_update', status = '{$params['status']}', container_1 = '{$params['image_1']}', link = '{$params['link']}', cliente = '{$params['cliente']}' WHERE id = {$params['id']}";
            }

            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute(); 
            
            return $control;
            

        }catch(CDbException $e){
           $error = array("ERROR" =>  1, "message" => MethodUtils::getErrorMessage($e->getCode()), "id" => $e->getCode());
           echo json_encode($error);
        }
    }
    
    
    /**
     * Método para excluir um registro existente
     * TODO: It uses a GET http request: Change it!
     *
     * @param number
     *
    */
    public function clearContent($data){

        $sql = "UPDATE general_messages SET status = 1 WHERE id = {$data['id']}";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $qtd = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo = {$data['tipo']}")->queryScalar();
            $qtd_total = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0")->queryScalar();
            
            return array('message' => $data['message'], 'qtd' => $qtd, 'qtd_total' => $qtd_total);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR CanaComunicacaoManager - clearContent() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar a ultima comunicacao postada
     * 
     * @param string
     *
    */
    public function loadContent($data){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');        
        Yii::import('application.extensions.utils.ShortUrlUtils');
        
        $select = "id, titulo, descricao, tipo, container_1, last_update, data, link";        
        $sql = "SELECT $select FROM general_messages WHERE status = 0 AND tipo = {$data['tipo']} ORDER BY data ASC";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - loadContent() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros de referentes as comunicacões
     *
     * @param string
     *
    */
    public function getAllMessagesInfo(){
        
        return false;
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $sql1 = "SELECT id, titulo, descricao, container_1, link FROM general_messages WHERE (status = 0 AND tipo = 1) ORDER BY data ASC LIMIT 1";
        $sql2 = "SELECT id, titulo, descricao, container_1, link FROM general_messages WHERE (status = 0 AND tipo = 2) ORDER BY data ASC LIMIT 1";
        $sql3 = "SELECT id, titulo, descricao, container_1, link FROM general_messages WHERE (status = 0 AND tipo = 3) ORDER BY data ASC LIMIT 1";
        $sql4 = "SELECT id, titulo, descricao, container_1 FROM general_messages WHERE tipo = 5";
        
        $session = MethodUtils::getSessionData();
        if($session['SES_PierAlertas'] != '') return $session['SES_PierAlertas'];

        try{  
            $recordset['message'] = Yii::app()->db->createCommand($sql1)->queryRow();
            $recordset['novidade'] = Yii::app()->db->createCommand($sql2)->queryRow();
            $recordset['atualizacao'] = Yii::app()->db->createCommand($sql3)->queryRow();
            $recordset['qtd_all'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo NOT IN (5)")->queryScalar();
            $recordset['qtd_atualizacao'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo = 3")->queryScalar();
            $recordset['qtd_novidade'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo = 2")->queryScalar();
            $recordset['qtd_message'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo = 1")->queryScalar();
            $recordset['qtd_chamados'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_messages WHERE status = 0 AND tipo = 6")->queryScalar();
            
            $recordset['revisao'] = Yii::app()->db->createCommand($sql4)->queryRow();
        
            if(isset($recordset['revisao']['container_1'])){$recordset['revisao']['last_update'] = DateTimeUtils::getDateFormatFromWebHook($recordset['revisao']['container_1']);}else{$recordset['revisao']['last_update'] = "";}
            
            $set = MethodUtils::SetSessionData('SES_PierAlertas', $recordset);
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getAllContentByAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de referentes as comunicacões do Manager
     *
     * @param string
     *
    */
    public function checkNewMessagesFromManager(){
        
        $cliente = Yii::app()->params['cliente_spring'];
        $user = Yii::app()->params['userName'];
        
        
        $sql1 = "SELECT * FROM general_messages WHERE status = 1 AND (tipo IN (1,2,3,4) AND cliente = '') ORDER BY data ASC";
        $sql2 = "SELECT * FROM general_messages WHERE status = 1 AND (tipo = 5 AND (cliente = '$cliente' OR cliente = '$user'))";
        $sql3 = "SELECT * FROM general_messages WHERE status = 1 AND (cliente = '$user' AND tipo IN (1,2,3,4)) ORDER BY data ASC";

        try{                       
            $recordset = Yii::app()->db2->createCommand($sql1)->queryAll();
            $clientes = Yii::app()->db2->createCommand($sql2)->queryAll();
            $specific = Yii::app()->db2->createCommand($sql3)->queryAll();
            
            if($clientes) $recordset = array_merge ($clientes, $recordset);
            if($specific) $recordset = array_merge ($specific, $recordset);
            
            //Clear cache alertas
            $set = MethodUtils::SetSessionData('SES_PierAlertas', '');
            
            //var_dump($recordset);
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - checkNewMessagesFromManager() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar todos os registros de comunicacões do Manager
     *
     * @param array
     *
    */
    public function saveNewMessagesFromManager($data){

        $last_update = date("Y-m-d H:i:s");
        $control = false;

        try{
            
            foreach($data as $values){
                $sql  = "INSERT INTO general_messages (id, titulo, descricao, tipo, last_update, data, container_1, link) ";
                $sql .= "VALUES ('{$values['id']}', '{$values['titulo']}', '{$values['descricao']}', '{$values['tipo']}', '$last_update', '$last_update', '{$values['container_1']}', '{$values['link']}') ON DUPLICATE KEY UPDATE last_update = '$last_update', titulo = '{$values['titulo']}', descricao = '{$values['descricao']}', container_1 = '{$values['container_1']}'";
                $comando = Yii::app()->db->createCommand($sql);
                $control = $comando->execute();
            }
            
            return $control;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - checkNewMessagesFromManager() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para checar se um registro de cliente já existe
     *
     * @param string
     *
    */
    public function checkMessageExist($tipo, $cliente){

        $sql = "SELECT id FROM general_messages WHERE cliente = '$cliente' AND tipo = $tipo";

        try{                       
            $recordset = Yii::app()->db2->createCommand($sql)->queryRow();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - checkMessageExist() ' . $e->getMessage();
        }
    }
    
    /**
     * Método usado para retornar todos os anos em que há matérias
     * cadastradas.
     */
    public function getAllYears($tipo ='noticias') {

        $query = "SELECT year(data) as 'year' FROM conteudo_forum";
        $query .= " WHERE tipo = '$tipo' GROUP BY year";

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();
            
            if($result){
                if ($result[count($result)-1]['year'] != date('Y')) {
                    $current['year'] = 2014;
                    array_push($result, $current);
                }
            }

            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getAllYears() ' .$e->getMessage();
        }
    }

    /**
     * Método usado para retornar todos os meses de um determinado
     * ano em que há matérias cadastradas.
     * @param string
     */
    public function getAllMonths($year , $tipo ='noticias') {

        // Need to implement a way to set the locale everytime the application runs.
        $locale = "pt_BR";

        // Used to return formated date names.
        $format = "SET lc_time_names = '$locale';";
        $query = "SELECT month(data) as 'value', monthname(data) as 'name' FROM conteudo_forum ";
        $query .= " WHERE tipo = '$tipo' AND year(data) = $year GROUP BY value";

        try {
            $prepare = Yii::app()->db->createCommand($format);
            $result = $prepare->execute();

            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();

            if ($year == date('Y')) {
                if (isset($result[date('m')-1])) {
                    if(isset($result[date('m')-1]['month']) && $result[date('m')-1]['month'] != date('m')){
                        $current['value'] = date('m');
                        $current['name'] = strftime('%B', time());
                        array_push($result, $current);
                    }
                }
            }

            // print_r($result); exit;
            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getAllMonths() ' .$e->getMessage();
        }
    }
    

    /**
     * Método usado para retornar todos os meses de um determinado
     * mês e ano em que há matérias cadastradas
     */
    public function getAllDays($year, $month, $tipo ='noticias') {

        $query = "SELECT day(data) as 'day' FROM conteudo_forum WHERE month(data) = $month";
        $query .= " AND tipo = '$tipo' AND year(data) = $year GROUP BY day";

        // echo $query; exit;

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();

            $all['day'] = 'Todos';

            array_push($result, $all);

            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR CanalComunicacaoManager - getAllDays() ' . $e->getMessage();
        }
    }
    
    /**
     * Método transformar um tipo numero em string 
     *
     * @param string
     *
    */
    public function getTipoByNumber($tipo){
        
        $string = "";
        
        if($tipo == 1) $string = 'Mensagem';
        if($tipo == 2) $string = 'Novidade';
        if($tipo == 3) $string = 'Atualização';
        if($tipo == 4) $string = 'Termo e Condição';
        if($tipo == 5) $string = 'Revisão';
        
        return $string;
 
    }
}

?>