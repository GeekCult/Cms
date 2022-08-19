<?php
/**
 * This Class is used to controll all functions related the feature Pedidos
 *
 * @author CarlosGarcia
 *
 *
 */

class PedidosManager {
    
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

        $select = "controle_pedidos.id, controle_pedidos.nome, controle_pedidos.tipo, controle_pedidos.last_update, controle_pedidos.descricao, controle_pedidos.titulo, controle_pedidos.data, controle_pedidos.id_worker, controle_pedidos.setor";
        
        if($cat == "all"){
            $sql = "SELECT $select FROM controle_pedidos INNER JOIN controle_chamados ON controle_pedidos.id = controle_chamados.id_pedido AND controle_chamados.status = $status ORDER BY controle_pedidos.id DESC";
           
        }else{            
            $sql = "SELECT $select FROM controle_pedidos INNER JOIN controle_chamados ON controle_pedidos.id = controle_chamados.id_pedido AND controle_chamados.status = $status AND controle_pedidos.tipo = '$cat' $sql_extra ORDER BY controle_pedidos.id DESC";
        }

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++ ){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                    $recordset[$i]['id_status'] = PedidosUtils::getStatusPedido($recordset[$i]['id']);
                    $recordset[$i]['assigned'] = UserUtils::getUserById($recordset[$i]['id_worker']);
                    $recordset[$i]['status'] = PedidosUtils::getStatusString($recordset[$i]['id_status']);
                    if($cat == 'vaga'){
                        $recordset[$i]['setor'] = PedidosUtils::setorById($recordset[$i]['setor']);
                        $recordset[$i]['vaga'] = PedidosUtils::getVagasData($recordset[$i]['id']);
                    }
                }
            }

            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - getAllPedidos()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - PedidosManager - getAllPedidos: ' . $e->getMessage();
        }
    }
    
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

        $select  = "id, id_usuario, id_worker, id_general, nome, empresa, tipo, data, descricao, titulo, detalhes, last_update,";
        $select .= " documento, email, telefone, quantidade, estado, cidade, setor, especializacao, valor, extra_1, user_purplepier";

        $sql = "SELECT $select FROM controle_pedidos WHERE id = $id";

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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - getPedidoById()', 'trace' => $e->getMessage()), true);
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - getPedidosByIdUser()', 'trace' => $e->getMessage()), true);
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
        if (!isset($args['status']))        $args['status'] = 0;

        $content = array(
            $args['id_user'], $args['nome'], $args['email'], $args['telefone'],
            $args['descricao'], $date, $date, $args['tipo'], $args['titulo'],
            $args['quantidade'], $args['estado'], $args['cidade'], $args['setor'],
            $args['especializacao'], $args['detalhes'], $args['id_general'], $args['status']
        );
       
        //add message in database
        $fields = "id_usuario, nome, email, telefone, descricao, data, last_update, tipo, ";
        $fields .= "titulo, quantidade, estado, cidade, setor, especializacao, detalhes, id_worker, status";
        $values = "'" . implode("','", $content) . "'";
        
//        $values  = "'".$data['id_user']."', '".$data['nome']."', '".$data['email']."', '".$data['telefone']."', '".$data['descricao']."', '".$date."', '".$date."', '".$data['tipo']."',";
//        $values .= "'".$data['titulo']."', '".$data['quantidade']."', '".$data['detalhes']."', '".$data['id_general']."'";

        $query = "INSERT INTO controle_pedidos ( $fields ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($query);
            $pedido = $command->execute();

            $id = Yii::app()->db->getLastInsertID();
            $chamado = $this->createChamado($id, $args['nome'], $args['email'], $args['id_user'], $args['tipo']);

            if ($pedido && $chamado) return array('STATUS' => true);
            else return array('STATUS' => false, 'STATUS_MSGS' => 'Falha ao inserir.');

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - createPedido()', 'trace' => $e->getMessage()), true);
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
        if (isset($data['detalhes'])) $values .= "detalhes = '${data['detalhes']}',";
        if (isset($data['id_user'])) $values .= "id_usuario = ${data['id_user']},";
        if (isset($data['titulo'])) $values .= "titulo = '${data['titulo']}',";
        if (isset($data['estado'])) $values .= "estado = '${data['estado']}',";
        if (isset($data['cidade'])) $values .= "cidade = '${data['cidade']}',";
        if (isset($data['status'])) $values .= "status = '${data['status']}',";
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - updatePedido()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - PedidosManager - updatePedido: ' . $e->getMessage();
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
    public function createChamado($id, $nome, $email, $id_user, $type) {

        $insert = "id_pedido, nome, email, id_user, tipo";
        $values = "'$id', '$nome', '$email', '$id_user', '$type'";
        $sql = "INSERT INTO controle_chamados ( $insert ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();

            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - createChamado()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - PedidosManager - createChamado: ' . $e->getMessage();
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - updateStatus()', 'trace' => $e->getMessage()), true);
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - deleteContent()', 'trace' => $e->getMessage()), true);
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - countPedidos()', 'trace' => $e->getMessage()), true);
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - getPedidodArgs()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - PedidosManager - getPedidosByArgs: ' . $e->getMessage();
        }
    }
    
    /*
     * Create Job
     * 
     * @param number
     * @param array
     */
    public function createJob($id_usuario, $data){
        
        if(!isset($data['plataforma'])) $data['plataforma'] = 'desktop';
        
        $select  = "titulo, descricao, tipo, quantidade, valor, data, last_update, email, nome, id_general, detalhes, id_usuario, status";        
        
        $values  = "'{$data['titulo']}', '".$data['descricao']."', '".$data['tipo']."', '".$data['quantidade']. "',";        
        $values .= "'{$data['valor']}', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '{$data['email']}', '{$data['nome']}', {$id_usuario},";
        $values .= "'{$data['plataforma']}', '$id_usuario', 0";
        
        $sql =  "INSERT INTO controle_pedidos ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            $send_error = MethodUtils::sendError(array('message' => 'ERROR - PedidoManager - createJob()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: PedidosManager - createJob() ' . $e->getMessage();
        }
    }
}
?>