<?php
/**
 * This Class is used to controll all functions related the feature Orcamenuts
 * @date 11/03/2015
 * @author CarlosGarcia
 *
 *
 */

class OrcamentusManager {
    
    /**
     * Método para recuperar todos os registros dos orcamentus no stage
     *
     * @param number
     * @param string
     *
     */
    public function getStageOrcamentus($status = 0, $sql_extra = ""){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');

        $select = "id, nome, tipo, titulo, descricao, data_final, data, id_worker, setor, id_general, id_usuario, valor, extra_3, progresso, last_update, cidade, estado";
        
        $sql = "SELECT $select FROM controle_pedidos WHERE status = $status AND tipo = 'orcamentus' $sql_extra ORDER BY id DESC";
        if($status == NULL) $sql = "SELECT $select FROM controle_pedidos WHERE tipo = 'orcamentus' $sql_extra ORDER BY id DESC";
       
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++ ){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['data_final'] = DateTimeUtils::getDateFormate($recordset[$i]['data_final']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                    $recordset[$i]['id_status'] = PedidosUtils::getStatusPedido($recordset[$i]['id']);
                    $recordset[$i]['assigned'] = UserUtils::getUserById($recordset[$i]['id_worker']);
                    $recordset[$i]['entidade'] = UserUtils::getUserById($recordset[$i]['id_general']);
                    $recordset[$i]['status'] = PedidosUtils::getStatusString($recordset[$i]['id_status']);
                    $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
                    $recordset[$i]['titulo_order'] = ProdutosUtils::getProdutoInformation($recordset[$i]['extra_3']);
                    
                }
            }

            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - OrdemServicoManager - getAllPedidos: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros dos pedidos feitos
     * Usado no Admin
     *
     *
     */
    public function getAllPedidos($year, $month, $status = 0, $sql_extra = "", $data = array()){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');

        $select = "id, nome, tipo, titulo, descricao, data_final, data, id_worker, setor, id_general, valor, extra_3, progresso";
        
        $sql = "SELECT $select FROM controle_pedidos WHERE (((data_final >= '{$year}-{$month}-01 00:00:00' AND data_final <= '{$year}-{$month}-31 00:00:00') OR data_final = '0000-00-00 00:00:00') AND status = $status) $sql_extra ORDER BY data_final ASC";
        if(isset($data['date_filter']) && !$data['date_filter']) $sql = "SELECT $select FROM controle_pedidos WHERE status = $status $sql_extra ORDER BY data_final ASC";
       
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++ ){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['data_final'] = DateTimeUtils::getDateFormate($recordset[$i]['data_final']);
                    $recordset[$i]['id_status'] = PedidosUtils::getStatusPedido($recordset[$i]['id']);
                    $recordset[$i]['assigned'] = UserUtils::getUserById($recordset[$i]['id_worker']);
                    $recordset[$i]['entidade'] = UserUtils::getUserById($recordset[$i]['id_general']);
                    $recordset[$i]['status'] = PedidosUtils::getStatusString($recordset[$i]['id_status']);
                    $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
                    $recordset[$i]['titulo_order'] = ProdutosUtils::getProdutoInformation($recordset[$i]['extra_3']);
                    
                }
            }

            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - OrdemServicoManager - getAllPedidos: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um determinado registro
     * Usado em editar conteúdo e nas features Pedidos
     *
     * @param number
     *
     */
    public function getPedidoById($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.dbuzz.admin.erp.OrdemPedidosManager');

        
        $ordemPedidosHandler = new OrdemPedidosManager();


        $select  = "id, id_usuario, nome, empresa, tipo, data, descricao, titulo, detalhes, last_update, id_general, status,";
        $select .= "documento, email, telefone, quantidade, estado, cidade, setor, especializacao, valor, extra_1, ";
        $select .= "data_final, extra_2, extra_4, id_worker, desconto, cobranca_tipo";

        $sql = "SELECT $select FROM controle_pedidos WHERE id = $id";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if ($recordset) {
                $recordset['data'] = DateTimeUtils::getDateFormate($recordset['data']);
                $recordset['data_values'] = DateTimeUtils::getDateValuesFromDate($recordset['data_final'], 'complex');
                $recordset['data_final'] = DateTimeUtils::getDateFormatCommon($recordset['data_final']);                
                $recordset['last_update'] = DateTimeUtils::getDateFormate($recordset['last_update']);
                $recordset['status_id'] = $recordset['status'];
                $recordset['status'] = PedidosUtils::getStatusString($recordset['status']);
                $recordset['chamado'] = PedidosUtils::getChamadosInfo($id);
                $recordset['funcionarios'] = UserUtils::getAllKindUsers("pedidos");
                $recordset['cliente'] = UserUtils::getUserFullById($recordset['id_general']);
                $recordset['tempo_estimado'] = PedidosUtils::getAttribute($id, 'tempo_estimado', 'number');
                $recordset['tempo_gasto'] = PedidosUtils::getAttribute($id, 'tempo_gasto', 'number');
                $recordset['items'] = $ordemPedidosHandler->getItemsByIdPedido($id, " AND name != 'tempo_gasto' AND name != 'tempo_estimado' AND name != 'hora_adicional'");
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - OrdemServicoManager - getPedidoById: ' . $e->getMessage();
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
            echo 'ERROR - OrdemServicoManager - getPedidosByIdUser: ' . $e->getMessage();
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
    public function createPedido($args, $isFilled = true){
        
        Yii::import('application.extensions.utils.PedidosUtils');
        
        if($isFilled){
            foreach ($args as $value) if ('' === $value)
                return array(
                    'STATUS' => false,
                    'STATUS_MSG' => 'Dados incompletos.'
                );
        }

        $date  = date("Y-m-d H:i:s");
        if (!isset($args['detalhes']))      $args['detalhes'] = '';
        if (!isset($args['id_cliente']))    $args['id_cliente'] = null;
        if (!isset($args['quantidade']))    $args['quantidade'] = 0;
        if (!isset($args['id_user']))       $args['id_user'] = $_SESSION['id'];
        if (!isset($args['estado']))        $args['estado'] = "";
        if (!isset($args['cidade']))        $args['cidade'] = "";
        if (!isset($args['data_final']))    $args['data_final'] = "0000-00-00 00:00:00";
        if (!isset($args['setor']))         $args['setor'] = 0;
        if (!isset($args['especializacao']))$args['especializacao'] = 0;
        if (!isset($args['valor']))         $args['valor'] = 0;
        if (!isset($args['extra_1']))       $args['extra_1'] = 0;
        if (!isset($args['extra_2']))       $args['extra_2'] = 0;
        if (!isset($args['extra_3']))       $args['extra_3'] = 0;
        if (!isset($args['extra_4']))       $args['extra_4'] = 0;
        if (!isset($args['status']))        $args['status'] = 0;
        if (!isset($args['id_general']))    $args['id_general'] = 0;
        if (!isset($args['tipo']))          $args['tipo'] = "orcamentus";
        if (!isset($args['cobranca_tipo'])) $args['cobranca_tipo'] = 0;
        if (!isset($args['data_final_usa'])) $args['data_final_usa'] = "0000-00-00";

        $content = array(
            $args['id_user'], $args['nome'], $args['email'], $args['celular'],
            $args['descricao'], $date, $date, $args['tipo'], $args['titulo'],
            $args['quantidade'], $args['estado'], $args['cidade'], $args['setor'],
            $args['especializacao'], $args['detalhes'], $args['id_general'], $args['valor'], 
            $args['extra_1'], $args['extra_2'], $args['data_final_usa'], $args['id_cliente'], $args['extra_3'],
            $args['extra_4'], $args['status'], $args['cobranca_tipo']
        );
       
        //add message in database
        $fields = "id_usuario, nome, email, telefone, descricao, data, last_update, tipo, ";
        $fields .= "titulo, quantidade, estado, cidade, setor, especializacao, detalhes, id_worker, ";
        $fields .= "valor, extra_1, extra_2, data_final, id_general, extra_3, extra_4, status, cobranca_tipo";
        $values = "'" . implode("','", $content) . "'";

        $query = "INSERT INTO controle_pedidos ( $fields ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($query);
            $pedido = $command->execute();

            $id = Yii::app()->db->getLastInsertID();
            $chamado = $this->createChamado($id, $args['nome'], $args['email'], $args['id_user'], $args['tipo']);
            

            if ($pedido && $chamado) return array('STATUS' => true, 'id' => $id);
            else return array('STATUS' => false, 'STATUS_MSGS' => 'Falha ao inserir.');

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: OrderServicoManager - createPedido ' . $e->getMessage();
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
        
        $values  = '';
        if (isset($data['nome'])) $values  .= "nome = '${data['nome']}',";
        if (isset($data['email'])) $values .= "email = '${data['email']}',";
        if (isset($data['telefone'])) $values .= "telefone = '${data['telefone']}',";
        if (isset($data['descricao'])) $values .= "descricao = '${data['descricao']}',";
        if (isset($data['id_user'])) $values .= "id_usuario = ${data['id_user']},";
        if (isset($data['id_cliente'])) $values .= "id_general = ${data['id_cliente']},";
        if (isset($data['titulo'])) $values .= "titulo = '${data['titulo']}',";
        if (isset($data['valor'])) $values .= "valor = '${data['valor']}',";
        if (isset($data['data_final_usa'])) $values .= "data_final = '${data['data_final_usa']}',";
        if (isset($data['status'])) $values .= "status = '${data['status']}',";
        
        if (isset($data['estado'])) $values .= "estado = '${data['estado']}',";
        if (isset($data['cidade'])) $values .= "cidade = '${data['cidade']}',";
        if (isset($data['setor'])) $values .= "setor = ${data['setor']},";
        if (isset($data['especializacao'])) $values .= "especializacao = ${data['especializacao']},";
        if (isset($data['quantidade'])) $values .= "quantidade = ${data['quantidade']},";
        if (isset($data['id_worker'])) $values .= "id_worker = ${data['id_worker']},";
        
        if (isset($data['extra_1'])) $values .= "extra_1 = '${data['extra_1']}',";        
        if (isset($data['extra_2'])) $values .= "extra_2 = '${data['extra_2']}',";
        if (isset($data['extra_3'])) $values .= "extra_3 = '${data['extra_3']}',";
        if (isset($data['extra_4'])) $values .= "extra_4 = '${data['extra_4']}',";
        if (isset($data['cobranca_tipo'])) $values .= "cobranca_tipo = '${data['cobranca_tipo']}',";
        if (isset($data['desconto'])) $values .= "desconto = '${data['desconto']}',";
        
        $values .= "last_update = '$date'";

        $query = "UPDATE controle_pedidos SET $values WHERE id = ${data['id_pedido']}";

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->execute();
            
            //More attributes
            if(isset($data['tempo_estimado'])) $setTime = PedidosUtils::setAttribute($data['id_pedido'], 'tempo_estimado', $data['tempo_estimado'], 'number');
            
            if ($result) return array('STATUS' => true);
            else return array('STATUS' => false, 'STATUS_MSGS' => 'Não houve atualizacao');

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - OrdemServicoManager - updatePedido: ' . $e->getMessage();
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
            echo 'ERROR - OrdemServicoManager - createChamado: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para criar uma proposta para um pedido
     *
     * @param $id
     * @param $nome
     * @param $email
     * @param $id_user
     * @param $type
     * @return mixed
     * @internal param $number
     */
    public function createProposta($data){

        $insert = "id_pedido, id_usuario, id_owner, id_produto, data, status, tipo, titulo, descricao, valor";
        $values  = "{$data['id_pedido']}, {$data['id_usuario']}, {$data['id_owner']}, {$data['id_produto']}, '{$data['date']}', {$data['status']}, '{$data['tipo']}', ";
        $values .= "'{$data['titulo']}', '{$data['descricao']}', {$data['valor']}";
        $sql = "INSERT INTO controle_propostas ( $insert ) VALUES ( $values )";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();

            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - OrcamentusManager - createProposta() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o registro de pedido 
     *
     * @param array
     *
    */
    public function updateStatus($data){

        $values = "nome = '{$data['nome']}', titulo = '{$data['titulo']}', " ."descricao = '{$data[ 'descricao']}', last_update = '{$data[ 'data']}', id_worker = '{$data[ 'id_worker']}', status = '{$data[ 'status']}', extra_4 = '{$data[ 'extra_4']}'";
        $sql =  "UPDATE controle_pedidos SET $values WHERE id = {$data['id']}";

        $values2 = "anotacao = '{$data['anotacao']}', status = '{$data[ 'status']}', id_worker = '{$data[ 'id_worker']}', prioridade = '{$data[ 'prioridade']}'";
        $sql2 =  "UPDATE controle_chamados SET $values2 WHERE id_pedido = {$data['id']}";

        try{            
            $command = Yii::app()->db->createCommand($sql);
            $control = $command->execute();
            
            $command2 = Yii::app()->db->createCommand($sql2);
            $control2 = $command2->execute();
            
            //More attributes
            $setTime = PedidosUtils::setAttribute($data['id'], 'tempo_gasto', $data['tempo_gasto'], 'number');
            
            if (isset($data['envia_email']) && $data['status'] == 1){

                Yii::import('application.extensions.dbuzz.site.email.EmailManager');
                Yii::import('application.extensions.utils.HelperUtils');
                Yii::import('application.extensions.utils.PedidosUtils');
                Yii::import('application.extensions.utils.EmailUtils');
                Yii::import('application.extensions.utils.ModulesUtils');
                Yii::import('application.extensions.utils.users.UserUtils');

                $emailHandler = new EmailManager();
                $dados = HelperUtils::getTitleSite();
                $data['user'] = UserUtils::getUserFullById($data['id_entidade']);
                if($data['user']) $data['cliente'] = $data['user']['nome']; else $data['cliente'] = '';
                $data['layout_reply'] = "task_done_erp";
                $data['email'] = PedidosUtils::getEmailSender($data['id']);
                $data['layout_template'] = EmailUtils::getEmailLayout();
                $data['logo'] = HelperUtils::getLogo("logos");
                $data['titulo_tarefa'] = $data['titulo'];
                $data['descricao_tarefa'] = $data['descricao'];
                $data['titulo'] = $dados['titulo'];
                $data['sender'] =  EmailUtils::getEmailSender();

                $data['tipo_pedido'] = $data['tipo'];
                $data['tipo'] = "chamado_fechado_erp";                
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
            echo 'ERROR - OrdemServicoManager - updateStatus: ' . $e->getMessage();
        }
    }

    /**
     * Método para excluir um registro existente
     *
     * @param array
     * @return bool
     */
    public function deleteContent($data){
        

        try {
            $comando = Yii::app()->db->createCommand("DELETE FROM controle_pedidos WHERE id = {$data['id']}")->execute();            
            $comando2 = Yii::app()->db->createCommand("DELETE FROM controle_chamados WHERE id_pedido = {$data['id']}")->execute();

            return ($comando);

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: OrcamentusManager - deleteContent() ". $e->getMessage();
        }
    }

    /**
     * Método para excluir um registro existente
     *
     * @param array
     * @return bool
     */
    public function requestOrcamentusContent($data){
        
        if($_SERVER['SERVER_NAME'] == 'dev.purplepier.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;
        
        Yii::import('application.extensions.utils.launchers.CurlUtils');
        
        try{
            $uri = "http://www.orcament.us/site/request_orcamentus/{$data['url']}/{$data['id_user']}";
            //if(!$local_place) $uri = "http://dev.purplepier.com.br/site/request_orcamentus/{$data['url']}/{$data['id_user']}";
            $request = CurlUtils::getFileContents($uri, $data);
            
            return $request;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: OrcamenutsManager - requestOrcamentusContent() ' . $e->getMessage();
        }
    }
}
?>