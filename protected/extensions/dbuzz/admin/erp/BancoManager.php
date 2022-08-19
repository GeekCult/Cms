<?php

/*
 * This Class is used to controll all functions related the feature ERP Banco
 *
 * @author CarlosGarcia
 *
 * Date: 18/11/2014
 *
 */

class BancoManager {
    
    /**
     * Método para recuperar os registros de contas
     *
    */
    public function getAllContent($session = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        
        if( $session) $sql = "SELECT * FROM erp_boletos WHERE vencimento >= '$year-$month-01' AND vencimento <= '$year-$month-31' ORDER BY vencimento ASC";
        if(!$session) $sql = "SELECT * FROM erp_boletos ORDER BY vencimento ASC";


        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll(); 
            
            if($recordset['registros'])for($i = 0; $i < count($recordset['registros']); $i++){
                $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['vencimento']);
                $recordset['registros'][$i]['status_string'] = StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);

            }
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getAllContent()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getAllContent() ". $e->getMessage();            
        }
    }
    
    /**
     * Método para recuperar o registro conta pelo ID
     *
    */
    public function getContentById($id, $action){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $sql = "SELECT * FROM erp_boletos WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow(); 
            
             if($recordset){
                 $recordset['date'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['vencimento']);
                 $recordset['entidade'] = UserUtils::getUserFullById($recordset['id_entidade']);
             }
            //Action
            $recordset['action'] = $action;
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getContentById()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getContentById() ". $e->getMessage();
        }
    }

    /**
     * Método para recuperar registros das contas pelo IDs
     *
     */
    public function getContentByIds($ids, $action){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $sql = "SELECT * FROM erp_boletos WHERE id in ($ids)";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset['registros'] = $command->queryAll();

            if($recordset['registros'])for($i = 0; $i < count($recordset['registros']); $i++){
                $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['vencimento']);
                $recordset['registros'][$i]['status_string'] = StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);

            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getContentById()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getContentById() ". $e->getMessage();
        }
    }

    /**
     * Método para adicionar uma vez a mais no envio de boletos
     *
    */
    public function oneMore($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $sql = "SELECT qtd FROM erp_boletos WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow(); 
            $set = false;
            
            if($recordset){
                 $qtd = $recordset['qtd'] + 1;
                 $set = $this->updateBoleto($id, 'qtd', $qtd);
            }
            
            return $set;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - oneMore()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - oneMore() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o registro vazio
     *
    */
    public function getContentClear($action = 'novo'){
                  
        $recordset = array('action' => 'novo', 'titulo' => '', 'valor' => '', 'tipo' => '', 'id_entidade' => 0, 'id_pedido' => 0,
                           'descricao' => '', 'date' => '', 'id' => '', 'id_general' => '', 'instituicao' => 0, 'status' => 0,
                           'entidade' => array('nome' => ''));            
        return $recordset;     
    }

    /**
     * Método para manusear edição e cadastro de boleto
     * TODO: data_ready: são data já formatadas, pois senão vira 0000-00-00
     *
     * @param POST 
     *
    */
    public function saveBoleto($arr = array(), $isArg = false){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.dbuzz.admin.erp.BancoManager');
        Yii::import('application.extensions.dbuzz.site.shorturl.ShortUrlManager');       
        
        $shortUrlHandler = new ShortUrlManager();
        $financeiroHandler = new BancoManager();
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        if(isset($params['titulo'])) $titulo = $params['titulo'];
        if(isset($params['descricao'])) $descricao = $params['descricao'];
        if(isset($params['valor'])) $valor = CurrencyUtils::checkFloatFormat($params['valor']);
        if(isset($params['tipo'])) $tipo = $params['tipo'];//Era fatura mensal e fatura comum... não existe mais
        if(isset($params['action'])) $action = $params['action'];
        (isset($params['id_entidade'])) ? $id_entidade = $params['id_entidade'] : $id_entidade = 0;
        if(isset($params['id'])) $id = $params['id'];
        if(isset($params['vencimento'])) $vencimento = DateTimeUtils::setFormatDateNoTime($params['vencimento'], true);
        if(isset($params['vencimento_ready'])) $vencimento = $params['vencimento'];//Caso seja uma conta parcelada, ready porque já está formatado
        (isset($params['status'])) ? $status = $params['status'] :  $status = 0;
        if(isset($params['id_pedido'])){ $id_pedido = $params['id_pedido'];} else{ $id_pedido = 0;}
        if(isset($params['cod_pedido'])){ $cod_pedido = $params['cod_pedido'];} else {$cod_pedido = $id_entidade . "_". md5(uniqid(rand(), true));}
        if(isset($params['erp_conta'])){ $erp_conta = MethodUtils::getBooleanNumber($params['erp_conta']);} else {$erp_conta = 0;}
        $last_update = date("Y-m-d H:i:s");
        
        if($tipo == 1){ 
            //echo $id_entidade . ' ' . $tipo . ' ' . $titulo . ' ' . $vencimento;            
            $id_boleto = $this->checkIfBoletoExist($id_entidade, $tipo, $titulo, $vencimento, $params);
            if( $id_boleto){$id = $id_boleto['id']; $action = "editar";}
            if(!$id_boleto){$id = 0; $action = "novo";}
            if(isset($params['id_boleto'])){ $id = $params['id_boleto'];$action = "editar";}//Se estiver editando um boleto
        }
        
        try{            

            if($action != "editar"){
                $sql  = "INSERT INTO erp_boletos (titulo, valor, tipo, last_update, descricao, vencimento, id_entidade, status, id_pedido, cod_pedido) ";
                $sql .= "VALUES ('$titulo', '$valor', '$tipo','$last_update', '$descricao', '$vencimento', $id_entidade, $status, $id_pedido, '$cod_pedido')";

            }else{
                $sql  = "UPDATE erp_boletos SET titulo = '$titulo', valor = '$valor', tipo = '$tipo', descricao = '$descricao', last_update = '$last_update', ";
                $sql .= "id_entidade = $id_entidade, status = $status, id_pedido = $id_pedido, vencimento = '$vencimento' WHERE id = $id";
            }

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();                       
            
            $message = Yii::t('messageStrings', 'message_result_not_altered');
            
            if($control && $action == 'novo'){
                $message = Yii::t('messageStrings', 'message_result_billet_submited');
                //$setPing = MethodUtils::setPing("Boleto gerado", "pierboletos");
                //Create short url
                $id = Yii::app()->db->getLastInsertID();
                $url = $shortUrlHandler->submitShortUrl('boletos');                
                $setShortUrl = $this->updateBoleto($id, 'shorturl', $url);
            }
            
            //Cria uma conta a receber no ERP
            if($action == 'novo'){ $set_action = 'r_novo';}else{$set_action = 'r_editar';}
            $data = array('type_account' => 0, 'id_categoria' => 1, 'title' => $titulo, 'description' => $descricao, 'value' => $valor, 'type' => 0, 'action' => $set_action, 'id_general' => 0, 'id_entidade' => $id_entidade, 'date_ready' => $vencimento, 'cod_pedido' => $cod_pedido, 'cod_pedido_boleto' => $cod_pedido, 'status' => $status, 'id' => 0);
            //$data['id_erp_categoria'] = 1; $data['subcategoria'] = 4; $data['subitem'] = 13; $data['area'] = 2; $data['tipo'] = 0;            
            if(!isset($params['ignore_erp'])){
                
                $updateFinanceiro = $financeiroHandler->savePayment($data, true);
            }
            
            if($control && $action == 'editar') $message = Yii::t('messageStrings', 'message_result_billet_updated');
            
            if($action == 'novo')   $result = array('message' => $message, 'id' => $id, 'result' => $control, 'cod_pedido' => $cod_pedido, 'status' => 0);
            if($action == 'editar') $result = array('message' => $message, 'id' => $id, 'result' => $control, 'cod_pedido' => $cod_pedido, 'status' => $status);
            
            //Se for pago!
            $close = $this->checkPedidoAndCloseItems($id, $status);
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getBoleto()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletosManager - saveBoleto() ". $e->getMessage();
        }
    }
    
    /**
     * Método para manusear edição e cadastro de boleto
     * TODO: data_ready: são data já formatadas, pois senão vira 0000-00-00
     *
     * @param POST 
     *
    */
    public function saveBoletoFatura($arr = array(), $isArg = false){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.dbuzz.admin.erp.BancoManager');
        Yii::import('application.extensions.dbuzz.site.shorturl.ShortUrlManager');       
        
        $shortUrlHandler = new ShortUrlManager();
        $financeiroHandler = new BancoManager();
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        if(isset($params['titulo'])) $titulo = $params['titulo'];
        if(isset($params['descricao'])) $descricao = $params['descricao'];
        if(isset($params['valor'])) $valor = CurrencyUtils::checkFloatFormat($params['valor']);
        if(isset($params['tipo'])) $tipo = $params['tipo'];//Era fatura mensal e fatura comum... não existe mais
        if(isset($params['action'])) $action = $params['action'];
        (isset($params['id_entidade'])) ? $id_entidade = $params['id_entidade'] : $id_entidade = 0;
        if(isset($params['id'])) $id = $params['id'];
        
        if(isset($params['vencimento'])) $vencimento = DateTimeUtils::setFormatDateNoTime($params['vencimento'], true);
        if(isset($params['vencimento_ready'])) $vencimento = $params['vencimento'];//Caso seja uma conta parcelada, ready porque já está formatado
        
        (isset($params['status'])) ? $status = $params['status'] :  $status = 0;
        if(isset($params['id_pedido'])){ $id_pedido = $params['id_pedido'];} else{ $id_pedido = 0;}
        if(isset($params['cod_pedido']) && $params['cod_pedido'] != ''){ $cod_pedido = $params['cod_pedido'];} else {$cod_pedido = $id_entidade . "_". md5(uniqid(rand(), true));}
    
        $last_update = date("Y-m-d H:i:s");
        
        //E se checar pela data de craição ao inves da data de vencimento, que pode ser sempre diferente???!!!
        if($tipo == 1){ //TODO - O que acontece aqui!!!!           
            //echo $id_entidade . ' ' . $tipo . ' ' . $titulo . ' ' . $vencimento;            
            $id_boleto = $this->checkIfBoletoExist($id_entidade, $tipo, $titulo, $vencimento, $params);
            if( $id_boleto){$id = $id_boleto['id']; $action = "editar";}
            if(!$id_boleto){$id = 0; $action = "novo";}
        }

        
        try{            

            if($action != "editar"){
                $sql  = "INSERT INTO erp_boletos (titulo, valor, tipo, last_update, descricao, vencimento, id_entidade, status, id_pedido, cod_pedido) ";
                $sql .= "VALUES ('$titulo', '$valor', '$tipo','$last_update', '$descricao', '$vencimento', $id_entidade, $status, $id_pedido, '$cod_pedido')";

            }else{
                $sql  = "UPDATE erp_boletos SET titulo = '$titulo', valor = '$valor', tipo = '$tipo', descricao = '$descricao', last_update = '$last_update', ";
                $sql .= "id_entidade = $id_entidade, status = $status, id_pedido = $id_pedido, vencimento = '$vencimento' WHERE id = $id";
            }

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();                       
            
            $message = Yii::t('messageStrings', 'message_result_not_altered');
            
            if($control && $action == 'novo'){
                $message = Yii::t('messageStrings', 'message_result_billet_submited');
                $setPing = MethodUtils::setPing("Boleto gerado", "pierboletos");
                //Create short url
                $id = Yii::app()->db->getLastInsertID();
                $url = $shortUrlHandler->submitShortUrl('boletos');                
                $setShortUrl = $this->updateBoleto($id, 'shorturl', $url);
            }
            
            if($control && $action == 'editar') $message = Yii::t('messageStrings', 'message_result_billet_updated');
            
            if($action == 'novo')   $result = array('message' => $message, 'id' => $id, 'result' => $control, 'cod_pedido' => $cod_pedido, 'status' => 0);
            if($action == 'editar') $result = array('message' => $message, 'id' => $id, 'result' => $control, 'cod_pedido' => $cod_pedido, 'status' => $status);
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - saveBoletoFatura()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletosManager - saveBoletoFatura() ". $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para remover um registro
     *
     * @param array
     *
    */
    public function remove($id){
      
        $sql = "DELETE FROM erp_boletos WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - remove()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletoManager - remove() ". $e->getMessage();
        }
    }
    
    
    /**
     * Método para recuperar os dados do settings
     * 
     * @param number
     *
    */
    public function getClienteData($id_entidade){
        
        Yii::import('application.extensions.utils.users.UserUtils');       

        try{          
            $recordset['user'] = UserUtils::getUserFullById($id_entidade);
            $recordset['location'] = UserUtils::getAddress($id_entidade);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getClientData()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getClientData() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os dados do settings
     *
    */
    public function getSettingsData(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
       

        try{          
            $recordset['banco'] = PreferencesUtils::getAttributes('banco', 'inteiro');
            $recordset['taxa_boleto'] = PreferencesUtils::getAttributes('taxa_boleto', 'number');
            $recordset['agencia'] = PreferencesUtils::getAttributes('nr_agencia', 'inteiro');
            $recordset['agencia_digito'] = PreferencesUtils::getAttributes('nr_agencia_digito', 'inteiro');
            
            $recordset['conta'] = PreferencesUtils::getAttributes('nr_conta', 'inteiro');
            $recordset['conta_digito'] = PreferencesUtils::getAttributes('nr_conta_digito', 'inteiro');
            
            $recordset['cedente'] = PreferencesUtils::getAttributes('nr_cedente', 'inteiro');
            $recordset['cedente_digito'] = PreferencesUtils::getAttributes('nr_cedente_digito', 'inteiro');
            $recordset['carteira'] = PreferencesUtils::getAttributes('nr_carteira', 'texto');
            
            $recordset['informativo'] = PreferencesUtils::getAttributes('boleto_informativo', 'texto');
            $recordset['documento'] = PreferencesUtils::getAttributes('boleto_documento', 'texto');
            $recordset['razao_social'] = PreferencesUtils::getAttributes('boleto_razao_social', 'texto');
            $recordset['endereco'] = PreferencesUtils::getAttributes('boleto_endereco', 'texto');
            
            $recordset['cidade'] = PreferencesUtils::getAttributes('boleto_cidade', 'texto');
            $recordset['uf'] = PreferencesUtils::getAttributes('boleto_uf', 'texto');
            
            //Instruções
            $recordset['instrucao1'] = PreferencesUtils::getAttributes('boleto_instrucao1', 'texto');
            $recordset['instrucao2'] = PreferencesUtils::getAttributes('boleto_instrucao2', 'texto');
            $recordset['instrucao3'] = PreferencesUtils::getAttributes('boleto_instrucao3', 'texto');
            $recordset['instrucao4'] = PreferencesUtils::getAttributes('boleto_instrucao4', 'texto');
            
            $recordset['logo_empresa'] = '/media/user/images/original/logo_purplepier_horizontal_b0.png';
            $recordset['logo_empresa_simple'] = 'media/user/images/original/logo_purplepier_horizontal_b0.png';
 
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getSettingsData()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getSettingsData() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar os settings
     *
     * @param POST 
     *
    */
    public function saveSettings($arr = array(), $isArg = false){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        try{
            if(isset($params['taxa_boleto'])) $result['taxa_boleto'] = PreferencesUtils::setAttributes('taxa_boleto', CurrencyUtils::checkFloatFormat($params['taxa_boleto']), 'number');
            if(isset($params['nr_conta'])) $result['nr_conta'] = PreferencesUtils::setAttributes('nr_conta',$params['nr_conta'], 'inteiro');
            if(isset($params['nr_conta_digito'])) $result['nr_conta_digito'] = PreferencesUtils::setAttributes('nr_conta_digito',$params['nr_conta_digito'], 'inteiro');
            
            if(isset($params['nr_agencia'])) $result['nr_agencia'] = PreferencesUtils::setAttributes('nr_agencia',$params['nr_agencia'], 'inteiro');
            if(isset($params['nr_agencia_digito'])) $result['nr_agencia_digito'] = PreferencesUtils::setAttributes('nr_agencia_digito',$params['nr_agencia_digito'], 'inteiro');
            
            if(isset($params['nr_cedente'])) $result['nr_cedente'] = PreferencesUtils::setAttributes('nr_cedente',$params['nr_cedente'], 'inteiro');
            if(isset($params['nr_cedente_digito'])) $result['nr_cedente_digito'] = PreferencesUtils::setAttributes('nr_cedente_digito',$params['nr_cedente_digito'], 'inteiro');
            
            if(isset($params['nr_carteira'])) $result['nr_carteira'] = PreferencesUtils::setAttributes('nr_carteira',$params['nr_carteira'], 'texto');
            
            if(isset($params['boleto_documento'])) $result['documento'] = PreferencesUtils::setAttributes('boleto_documento',$params['boleto_documento'], 'texto');
            if(isset($params['boleto_razao_social'])) $result['razao'] = PreferencesUtils::setAttributes('boleto_razao_social',$params['boleto_razao_social'], 'texto');
            if(isset($params['boleto_endereco'])) $result['endereco'] = PreferencesUtils::setAttributes('boleto_endereco',$params['boleto_endereco'], 'texto');
            if(isset($params['boleto_informativo'])) $result['informativo'] = PreferencesUtils::setAttributes('boleto_informativo',$params['boleto_informativo'], 'texto');
            if(isset($params['boleto_cidade'])) $result['cidade'] = PreferencesUtils::setAttributes('boleto_cidade',$params['boleto_cidade'], 'texto');
            if(isset($params['boleto_uf'])) $result['uf'] = PreferencesUtils::setAttributes('boleto_uf',$params['boleto_uf'], 'texto');
            
            if(isset($params['boleto_instrucao1'])) $result['instrucao1'] = PreferencesUtils::setAttributes('boleto_instrucao1',$params['boleto_instrucao1'], 'texto');
            if(isset($params['boleto_instrucao2'])) $result['instrucao2'] = PreferencesUtils::setAttributes('boleto_instrucao2',$params['boleto_instrucao2'], 'texto');
            if(isset($params['boleto_instrucao3'])) $result['instrucao3'] = PreferencesUtils::setAttributes('boleto_instrucao3',$params['boleto_instrucao3'], 'texto');
            if(isset($params['boleto_instrucao4'])) $result['instrucao4'] = PreferencesUtils::setAttributes('boleto_instrucao4',$params['boleto_instrucao4'], 'texto');
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - saveSettings()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletosManager - saveSettings() ". $e->getMessage();
        }
    }
    
    /**
     * Atualiza um boleto
     * 
     * @param type $id
     * @param type $field
     * @param type $value
     * @return type
     * 
     */
    public function updateBoleto($id, $field, $value){
        
        $sql = "UPDATE erp_boletos SET $field = '$value' WHERE id = $id";

        $comando = Yii::app()->db->createCommand($sql);
        $control = $comando->execute();

        return $control;
    }
    
    /**
     * Atualiza um boleto pelo código do pedido gerado
     * 
     * @param type $cod_pedido
     * @param type $field
     * @param type $value
     * @return type
     */
    public function updateBoletoByCodPedido($cod_pedido, $field, $value){
        
        $sql = "UPDATE erp_boletos SET $field = '$value' WHERE cod_pedido = '$cod_pedido'";

        $comando = Yii::app()->db->createCommand($sql);
        $control = $comando->execute();

        return $control;
    }
    
    /*
     * Check if boleto exis
     * 
     */
    public function checkIfBoletoExist($id_entidade, $tipo, $titulo, $vencimento, $arg = array()){
        
        $sql = "SELECT id, status, shorturl FROM erp_boletos WHERE id_entidade = $id_entidade AND tipo = $tipo AND titulo = '$titulo' AND vencimento = '$vencimento'";
        if(isset($arg['tipo_checagem']) && $arg['tipo_checagem'] == 3){ $sql = "SELECT id, status, shorturl FROM erp_boletos WHERE id_entidade = $id_entidade AND tipo = $tipo AND titulo = '$titulo'";}
        
        $recordset = Yii::app()->db->createCommand($sql)->queryRow();
        
        return $recordset;
    }
    
    /*
     * Check if boleto exis
     * 
     */
    public function checkPedidoAndCloseItems($id, $status = 1){
        
        Yii::import('application.extensions.dbuzz.site.produtos.EcommerceManager');  
        Yii::import('application.extensions.dbuzz.admin.erp.BancoManager');
        
        $ecommerceHandler = new EcommerceManager();
        $financeiroHandler = new BancoManager();
        
        $cod_pedido = $this->getBoletoCodPedido($id);
        
        $set = false;
        if($cod_pedido){
            //Não pode ser 0 de jeito nenhum
            if($cod_pedido['cod_pedido'] != 0)$set = $financeiroHandler->updateStatusByCodPedido($cod_pedido['cod_pedido'] , $status);            
        }
        
        return $set;
    }
    
    /*
     * Add some extra numbers intro our number
     * 
     */
    public function getOurNumber($id){
        
        $num_length = strlen((string)$id);
        
        switch ($num_length){
            
            case 1:
                $number = "0000000000" . $id;
                break;
            case 2:
                $number = "000000000" . $id;
                break;
            case 3:
                $number = "00000000" . $id;
                break;
            case 4:
                $number = "0000000" . $id;
                break;
            case 5:
                $number = "000000" . $id;
                break;
            case 6:
                $number = "00000" . $id;
                break;
            case 7:
                $number = "0000" . $id;
                break;
            case 8:
                $number = "000" . $id;
                break;
            case 9:
                $number = "00" . $id;
                break;
            case 10:
                $number = "0" . $id;
                break;
            default:
                $number = $id;
                break;
        }
        
        return $number;
    }
    
    /**
     *
     * Ver
     * This method see the billet
     *
     */
    public function generateBoleto($id, $action, $is_web = true, $file_name = 'boleto.pdf'){ 
         
        Yii::import('application.extensions.utils.special.HtmlToPDF');
        
        //Choose bank
        include_once("protected/extensions/vendors/boletos/include/funcoes_bradesco.php");
        
 

        try{
            $content = $this->getContentById($id, $action);
            $info = $this->getSettingsData();
            $cliente = $this->getClienteData($content['id_entidade']);
            
            if($is_web){$image = "/media/images/layout/boletos/";}else{$image = "media/images/layout/boletos/";} 
            
            $dadosboleto = array('valor' => $content['valor'], 
                                 'titulo_boleto' => $content['titulo'],
                                 'vencimento' => $content['date'],
                                 'taxa_boleto' => $info['taxa_boleto'],
                                 'prazo_pagamento' => 5, 
                                 'id_ref' => $this->getOurNumber($content['id']),
                                 'quantidade' => '1',
                                 'especie' => 'R$',
                                 'agencia' => $info['agencia'],
                                 'agencia_digito' => $info['agencia_digito'],
                                 'conta' => $info['conta'],
                                 'conta_digito' => $info['conta_digito'],
                                 'cedente' => $info['cedente'],
                                 'cedente_digito' => $info['cedente_digito'],
                                 'carteira' => $info['carteira'],
                                 'documento' => $info['documento'],
                                 'razao_social' => $info['razao_social'],
                                 'endereco' => $info['endereco'],
                                 'cidade' => $info['cidade'],
                                 'uf' => $info['uf'],
                                 'image' => $image,
                                 'informativo' => $info['informativo'],
                                 'instrucao1' => $info['instrucao1'],
                                 'instrucao2' => $info['instrucao2'],
                                 'instrucao3' => $info['instrucao3'],
                                 'instrucao4' => $info['instrucao4'],
                                 'is_web' => $is_web);
            
            $dadoscliente = array(
                                 'nome' => $cliente['user']['nome'],
                                 'endereco' => $cliente['location']['endereco'] . ', '. $cliente['location']['numero'] . ' - ' . $cliente['location']['bairro'],
                                 'cidade' => $cliente['location']['cidade'],
                                 'uf' => $cliente['location']['estado'],
                                 'cep' => (isset($cliente['location']['cep_string'])) ? $cliente['location']['cep_string'] : '',
                
            );

            // NãO ALTERAR!
            if(!$is_web) ob_start();
            include("protected/extensions/vendors/boletos/autoload/bradesco.php"); 
            if(!$is_web) $content = ob_get_clean();
            
            //if(!$is_web) $pdf = $this->htmlToPDF($content, 'file', $file_name);
            if(!$is_web) $pdf = HtmlToPDF::createPDF($content, 'file', $file_name, 'boletos');
            
            if($action == 'ajax') echo json_encode(array('message' => Yii::t('messageStrings', 'message_result_success'), 'result' => $pdf));
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - generateBoleto()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletosManager - generateBoleto() " . $e->getMessage();
        }
    }
     
    
    /**
     * Método para recuperar os registros de contas
     *
    */
    public function getAllBoletosByStatus($status = 0){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $sql = "SELECT * FROM erp_boletos WHERE status = $status ORDER BY vencimento ASC";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll(); 
            
            if($recordset['registros'])for($i = 0; $i < count($recordset['registros']); $i++){
                $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['vencimento']);
                $recordset['registros'][$i]['status_string'] = StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);

            }
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getAllBoletosByStatus()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancoManager - getAllBoletosByStatus() ". $e->getMessage();
        }
    }
    
    /**
     * Método para obter o código do pedido md5(randow(), true) 32 chars
     * @params number
     *
    */
    public function getBoletoCodPedido($id){
        
        $sql = "SELECT id, cod_pedido FROM erp_boletos WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow(); 
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoManager - getBoletoCodPedido()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BoletoManager - getBoletoCodPedido() ". $e->getMessage();
        }
    }
}


?>