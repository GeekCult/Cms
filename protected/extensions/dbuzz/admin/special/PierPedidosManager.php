<?php
/**
 * This Class is used to controll all functions related the feature Pedidos PurplePier
 *
 * @author CarlosGarcia
 *
 *
 */

class PierPedidosManager {
    
    /**
     * Método para recuperar todos os registros dos pedidos feitos
     * Usado no Admin
     *
     *
     */
    public function getAllPedidos($cat = "all", $status = 0, $sql_extra = ""){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $sql = "SELECT * FROM controle_chamados WHERE status = $status ORDER BY id DESC";
       

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++ ){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['id_status'] = PedidosUtils::getStatusPedido($recordset[$i]['id']);
                    $recordset[$i]['assigned'] = UserUtils::getUserById($recordset[$i]['id_worker']);
                    $recordset[$i]['status'] = PedidosUtils::getStatusString($recordset[$i]['id_status']);
                }
            }

            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - PedidosManager - getAllPedidos: ' . $e->getMessage();
        }
    }
    
    
    /**
     * Método para recuperar todos os registros de referentes aos chamados em aberto
     *
     * @param string
     *
    */
    public function getAllChamados(){

        try{  
            $recordset['qtd_chamados'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_pedidos WHERE status = 0")->queryScalar();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR PierPedidosManager - getAllContentByAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros de referentes as comunicacões
     *
     * @param string
     *
    */
    public function getAllPierChamadosFromManager(){

        try{  
            $recordset = Yii::app()->db2->createCommand("SELECT * FROM controle_chamados WHERE status = 0")->queryAll();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR PierPedidosManager - getAllPierChamadosFromManager() ' . $e->getMessage();
        }
    }
     /**
     * Método para salvar todos os registros de comunicacões do Manager
     *
     * @param array
     *
    */
    public function savePierChamadosFromManager($data){

        $last_update = date("Y-m-d H:i:s");
        $control = false;

        try{
            
            foreach($data as $values){
                
                $isExist = $this->checkIfPedidoExist($values['titulo'], $values['tipo'], $values['dominio']);
                if(!$isExist){
                    $sql  = "INSERT INTO controle_pedidos (titulo, descricao, tipo, last_update, data, empresa, id_general, valor, quantidade, status, user_purplepier, nome, email) ";
                    $sql .= "VALUES ('{$values['titulo']}', '{$values['descricao']}', '{$values['tipo']}', '$last_update', '$last_update', '{$values['dominio']}', '{$values['id_general']}', {$values['valor']}, {$values['quantidade']}, 0, '{$values['cliente']}', '{$values['nome']}', '{$values['email']}') ON DUPLICATE KEY UPDATE last_update = '$last_update', titulo = '{$values['titulo']}', descricao = '{$values['descricao']}'";
                    $comando = Yii::app()->db->createCommand($sql);
                    $control = $comando->execute();

                    $id = Yii::app()->db->getLastInsertID();
                    $chamado = $this->createChamado($id, $values['dominio'], '', $values['id_usuario'], $values['tipo']);
                    
                }
            }
            
            return $control;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR PierPedidosManager - savePierChamadosFromManager() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros selecionado por
     * categoria
     *
     * @param $id
     * @param $nome
     * @param $email
     * @param $id_user
     * @param $type
     * @return mixed
    @internal param $number
     */
    public function createChamado($id, $nome, $email, $id_user, $type){

        $insert = "id_pedido, nome, email, id_user, tipo";
        $values = "'$id', '$nome', '$email', '$id_user', '$type'";
        $sql = "INSERT INTO controle_chamados ( $insert ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();

            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - PierPedidosManager - createChamado: ' . $e->getMessage();
        }
    }
    
     /**
     * Método para recuperar todos os registros de referentes as comunicacões
     *
     * @param string
     *
    */
    public function checkIfPedidoExist($titulo, $tipo, $dominio){

        try{  
            $recordset = Yii::app()->db->createCommand("SELECT id FROM controle_pedidos WHERE titulo = '$titulo' AND tipo = '$tipo' AND empresa = '$dominio'")->queryRow();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR PierPedidosManager - getAllPierChamadosFromManager() ' . $e->getMessage();
        }
    }
    
    
    /* ----------------------- */
    
    /**
     * Método para recuperar um determinado registro
     * Usado em editar conteúdo e nas features Pedidos
     *
     * @param number
     *
     */
    public function getPedidoById($id) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $select  = "id, id_usuario, id_worker, nome, empresa, tipo, data, descricao, titulo, detalhes, last_update,";
        $select .= " documento, email, telefone, quantidade, estado, cidade, setor, especializacao, valor, extra_1";

        $sql = "SELECT " . $select . " FROM controle_pedidos WHERE id = $id";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if ($recordset) {
                $recordset['data'] = DateTimeUtils::getDateFormate($recordset['data']);
                $recordset['last_update'] = DateTimeUtils::getDateFormate($recordset['last_update']);
                $recordset['status_id'] = PedidosUtils::getStatusPedido($id);
                $recordset['status'] = PedidosUtils::getStatusString($recordset['status_id']);
                $recordset['chamado'] = PedidosUtils::getChamadosInfo($id);
                $recordset['funcionarios'] = UserUtils::getAllKindUsers("pedidos");
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - PedidosManager - getPedidoById: ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar todos os registros de um determinado
     * usuario
     *
     * @param number
     * @param string $tipo
     * @param int $status
     * @return
     */
    public function getPedidosByIdUser($id_user, $tipo = '', $status = 0) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PropostasManager');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.PedidosUtils');

        $propostasHandler = new PropostasManager();
        $userHandler = new UsersManager();

        $query = "SELECT *, c.id as 'pid' FROM controle_pedidos as c ";
        if ($tipo == "") {
            $query .= "WHERE id_worker = $id_user OR id_worker = 0";
        } else {
            if ($id_user != "todos") {
                $query .= "INNER JOIN controle_chamados as cc ON c.id = cc.id_pedido WHERE cc.status = $status AND ";
                if ($tipo == "vaga")
                    $query .= "(c.id_usuario = $id_user) AND c.tipo = '$tipo' ORDER BY c.id DESC";
                else
                    $query .= "(c.id_worker = $id_user OR c.id_worker = 0) AND c.tipo = '$tipo'";
            } else {
                $query .= "WHERE tipo = '$tipo'";
            }
        }

        try {
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();
            
            if (count($recordset) > 0) {
                //It join the controle_pedidos attributes
                for ($i=0; $i < count($recordset); $i++) {
                    if ($recordset[$i]['id_empresa'])
                        $id = $recordset[$i]['id_empresa'];
                    else $id = $recordset[$i]['id_usuario'];
                    $complementData = $userHandler->getComplementData($id);
                    $recordset[$i]['empresa'] = $complementData['nome_fantasia'];
                    $recordset[$i]['data_inicio'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data_inicio']);
                    $recordset[$i]['data_final'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data_final']);
                    $recordset[$i]['valor'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor']);
                    $recordset[$i]['proposta'] = $propostasHandler->getNumPropostasByPedidoId($recordset[$i]['pid']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                    $recordset[$i]['id_status'] = PedidosUtils::getStatusPedido($recordset[$i]['pid']);
                    $recordset[$i]['status'] = PedidosUtils::getStatusString($recordset[$i]['id_status']);
                    $recordset[$i]['setor'] = PedidosUtils::setorById($recordset[$i]['setor']);
                    $recordset[$i]['especializacao'] = PedidosUtils::especializacaoById($recordset[$i]['especializacao']);
                }
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - PedidosManager - getPedidosByIdUser: ' . $e->getMessage();
        }
    }

    /**
     * Método para criar um pedido, este pode ser qualquer um
     * basta seguir os campos da tabela controle_pedidos ou utilizar
     * a tabela de apoio controle_attributes
     *
     * @param array
     *
     * @return bool
     */
    public function createPedido($args, $isFilled = true) {
        
        if($isFilled){
            foreach ($args as $value) if ('' === $value)
                return array(
                    'STATUS' => false,
                    'STATUS_MSG' => 'Dados incompletos.'
                );
        }

        $date  = date("Y-m-d H:i:s");
        if (!isset($args['detalhes']))      $args['detalhes'] = '';
        if (!isset($args['id_general']))    $args['id_general'] = null;
        if (!isset($args['quantidade']))    $args['quantidade'] = 0;
        if (!isset($args['id_user']))       $args['id_user'] = $_SESSION['id'];
        if (!isset($args['estado']))        $args['estado'] = "";
        if (!isset($args['cidade']))        $args['cidade'] = "";
        if (!isset($args['setor']))         $args['setor'] = 0;
        if (!isset($args['especializacao']))$args['especializacao'] = 0;
        if (!isset($args['detalhes']))      $args['detalhes'] = "";

        $content = array(
            $args['id_user'], $args['nome'], $args['email'], $args['telefone'],
            $args['descricao'], $date, $date, $args['tipo'], $args['titulo'],
            $args['quantidade'], $args['estado'], $args['cidade'], $args['setor'],
            $args['especializacao'], $args['detalhes'], $args['id_general']
        );
       
        //add message in database
        $fields = "id_usuario, nome, email, telefone, descricao, data, last_update, tipo, ";
        $fields .= "titulo, quantidade, estado, cidade, setor, especializacao, detalhes, id_worker";
        $values = "'" . implode("','", $content) . "'";
        
//        $values  = "'".$data['id_user']."', '".$data['nome']."', '".$data['email']."', '".$data['telefone']."', '".$data['descricao']."', '".$date."', '".$date."', '".$data['tipo']."',";
//        $values .= "'".$data['titulo']."', '".$data['quantidade']."', '".$data['detalhes']."', '".$data['id_general']."'";

        $query = "INSERT INTO controle_pedidos ( $fields ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($query);
            $pedido = $command->execute();

            // NOT RECOMMEND FOR SCALABLE APPS
            // IT CAN MIX RECORDS IF MULTIPLE ACCESS AT SAME TIME
            $id = Yii::app()->db->getLastInsertID();
            $chamado = $this->createChamado($id, $args['nome'], $args['email'], $args['id_user'], $args['tipo']);

            if ($pedido && $chamado) return array('STATUS' => true);
            else return array('STATUS' => false, 'STATUS_MSGS' => 'Falha ao inserir.');

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: PedidosManager - createPedido ' . $e->getMessage();
        }
    }

    /**
     * Método para atualizar um pedido, este pode ser qualquer um
     * basta seguir os campos da tabela controle_pedidos ou utilizar
     * a tabela de apoio controle_attributes
     *
     * @param array
     *
     * @return bool
     */
    public function updatePedido($data) {

        $date = date('Y-m-d H:i:s');
  
        if (isset($data['nome'])) $values  = "nome = '${data['nome']}',";
        if (isset($data['email'])) $values .= "email = '${data['email']}',";
        if (isset($data['telefone'])) $values .= "telefone = '${data['telefone']}',";
        if (isset($data['descricao'])) $values .= "descricao = '${data['descricao']}',";
        if (isset($data['id_user'])) $values .= "id_usuario = ${data['id_user']},";
        if (isset($data['titulo'])) $values .= "titulo = '${data['titulo']}',";
        if (isset($data['estado'])) $values .= "estado = '${data['estado']}',";
        if (isset($data['cidade'])) $values .= "cidade = '${data['cidade']}',";
        if (isset($data['setor'])) $values .= "setor = ${data['setor']},";
        if (isset($data['especializacao'])) $values .= "especializacao = ${data['especializacao']},";
        if (isset($data['quantidade'])) $values .= "quantidade = ${data['quantidade']},";
        if (isset($data['id_worker'])) $values .= "id_worker = ${data['id_worker']},";
        $values .= "last_update = '$date'";

        $query = "UPDATE controle_pedidos SET $values WHERE id = ${data['id_pedido']}";

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->execute();
            return $result;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - PedidosManager - updatePedido: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o registro de pedido 
     *
     * @param array
     *
    */
    public function updateStatus($data){

        $values = "nome = '" . $data['nome'] ."', titulo = '" . $data['titulo'] ."', " ."descricao = '" . $data[ 'descricao'] ."', last_update = '" . $data[ 'data'] ."', id_worker = '" . $data[ 'id_worker'] ."' ";
        $sql =  "UPDATE controle_pedidos SET ". $values ." WHERE id = " .$data['id'] . "";

        $values2 = "anotacao = '" . $data['anotacao'] ."', status = '" . $data[ 'status'] ."', id_worker = '" . $data[ 'id_worker'] ."', prioridade = '" . $data[ 'prioridade'] ."'";
        $sql2 =  "UPDATE controle_chamados SET ". $values2 ." WHERE id_pedido = " .$data['id'] . "";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
        
        try {
            $command2 = Yii::app()->db->createCommand($sql2);
            $control2 = $command2->execute();

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }

        try {
            if(isset($data['envia_email']) && $data['status'] == 1){

                Yii::import('application.extensions.dbuzz.site.email.EmailManager');
                Yii::import('application.extensions.utils.HelperUtils');
                Yii::import('application.extensions.utils.PedidosUtils');
                Yii::import('application.extensions.utils.EmailUtils');
                Yii::import('application.extensions.utils.ModulesUtils');

                $emailHandler = new EmailManager();
                $dados = HelperUtils::getTitleSite();
                $data['layout_reply'] = "task_done_common";
                $data['email'] = PedidosUtils::getEmailSender($data['id']);
                $data['layout_template'] = EmailUtils::getEmailLayout();
                $data['logo'] = HelperUtils::getLogo("logos");
                $data['titulo'] = $dados['titulo'];
                $data['sender'] =  EmailUtils::getEmailSender();

                $data['tipo_pedido'] = $data['tipo'];
                $data['tipo'] = "chamado_fechado";                
                $data['server'] = $_SERVER['SERVER_NAME'];

                //Gets social networks
                $network['facebook'] = HelperUtils::getSocialNetWorkProfile("facebook");
                $network['twitter']  = HelperUtils::getSocialNetWorkProfile("twitter");
                $network['rss']  = HelperUtils::getSocialNetWorkProfile("rss");
                $data['social_networks'] = ModulesUtils::getSocialNetworksForEmails($network);

                $send_notification = $emailHandler->submitReply($data);
            }

            echo Yii::t("messageStrings", "message_result_order_update");

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - PedidosManager - updateStatus: ' . $e->getMessage();
        }
    }

    /**
     * Método para excluir um registro existente
     *
     * @param array
     * @return bool
     */
    public function deleteContent($id){
        
        $sql  = "DELETE FROM controle_pedidos WHERE id = $id";
        $sql2 = "DELETE FROM controle_chamados WHERE id_pedido = $id";

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $result['control'] = $comando->execute();
            
            $comando2 = Yii::app()->db->createCommand($sql2);
            $result['control2'] = $comando2->execute();

            return ($result);

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: PedidosManager - deleteContent() ". $e->getMessage();
        }
    }

    /**
     * Método para contar a quantidade de pedidos
     *
     * @param atring
     *
    */
    public function countPedidos($type) {

        Yii::import('application.extensions.utils.DataBaseUtils');
        
        $to = date("Y")."-".date('m')."-".date('t');
        $from = date("Y")."-".date('m')."-"."01";

        try {
            $result['total'] = DataBaseUtils::getCountRecords("controle_pedidos", "tipo", $type);
            $result['month'] = DataBaseUtils::getCountRecordsPeriod("controle_pedidos", "tipo", $type, $from, $to);
            
            return $result;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR - PedidosManager - countPedidos: ' . $e->getMessage();
        }
    }

    public function getPedidosByArgs($args, $rand = false, $start = 0, $limit = 10) {
        
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $hierarquia = "(SELECT value_int FROM controle_properties WHERE name = 'hierarquia' AND parent = id)";
        $pretensao = "(SELECT value_int FROM controle_properties WHERE name = 'pretensao' AND parent = id)";
        $empresa = "(SELECT nome_fantasia FROM user_company WHERE id = id_empresa)";
        $where = "WHERE true";

        if (isset($args['cidade'])) $where .= " AND cidade = '${args['cidade']}'";
        if (isset($args['estado'])) $where .= " AND estado = '${args['estado']}'";
        if (isset($args['area'])) $where .= " AND setor = ${args['area']}";
        if (isset($args['especializacao'])) $where .= " AND especializacao = ${args['especializacao']}";
        if (isset($args['hierarquia'])) $where .= " AND $hierarquia = ${args['hierarquia']}";
        if (isset($args['pretensao'])) $where .= " AND $pretensao = ${args['pretensao']}";
        if (isset($args['keyword'])) $where .= " AND titulo LIKE '%${args['keyword']}%'";
        if (isset($args['tipo'])) $where .= " AND tipo = '${args['tipo']}'";
        if (isset($args['id'])) $where = "WHERE id = ${args['id']}";

        $query = "SELECT *, $hierarquia as 'hierarquia', $pretensao as 'pretensao',";
        $query .= "$empresa as 'empresa' FROM controle_pedidos $where ORDER BY ";
        $query .= $rand ? "RAND()" : 'id DESC';
        $query .= " LIMIT $start, $limit";

        try {
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();

            for ($i = count($recordset)-1; $i >= 0; $i--) {

                if ($recordset[$i]['especializacao'] != '')
                    $recordset[$i]['especializacao'] =
                        PedidosUtils::especializacaoById($recordset[$i]['especializacao']);

                if ($recordset[$i]['setor'] != '')
                    $recordset[$i]['setor'] =
                        PedidosUtils::setorById($recordset[$i]['setor']);
                
                $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
            }

            return $recordset;

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR - PedidosManager - getPedidosByArgs: ' . $e->getMessage();
        }
    }
}
?>