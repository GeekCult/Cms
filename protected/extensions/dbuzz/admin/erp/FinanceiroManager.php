<?php

/*
 * This Class is used to controll all functions related the feature ERP Financeiro
 * Such as: Payment, receivement...
 *
 * @author CarlosGarcia
 *
 * Date: 18/08/2014
 *
 */

class FinanceiroManager {
    
    /**
     * Método para recuperar os registros de contas
     *
    */
    public function getAllContent($id_categoria, $session = null, $period = true, $arg = array()){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        
        //Add new items into query
        $query = "";
        ($session['financeiro_tipo_conta'] != '') ? $tipo_conta = "AND tipo = " .$session['financeiro_tipo_conta'] : $tipo_conta = "";
        if($session['id_subcategoria_financeiro'] != '' && $session['id_subcategoria_financeiro'] != 0) $query = "AND id_erp_subcategoria = " .$session['id_subcategoria_financeiro'];
        if($session['id_subitem_financeiro'] != '' && $session['id_subitem_financeiro'] != 0 && $session['id_subcategoria_financeiro'] != 0) $query = "AND id_erp_subcategoria = {$session['id_subcategoria_financeiro']} AND id_erp_subitem = {$session['id_subitem_financeiro']}";
        if($session['id_subelement_financeiro'] != '' && $session['id_subelement_financeiro'] != 0 && $session['id_subitem_financeiro'] != 0) $query = "AND id_erp_subcategoria = {$session['id_subcategoria_financeiro']} AND id_erp_subitem = {$session['id_subitem_financeiro']} AND id_erp_subelement = {$session['id_subelement_financeiro']}";
                
        if($period){
            $sql = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria";          
       
            $month_prev = $month - 1; $year_prev = $year;           
            if($month_prev < 0){ $month_prev = "12"; $year_prev = $year - 1;} 
            if($month_prev < 10) $month_prev = "0" . $month_prev;
           
            if($session){
                $sql  = "SELECT * FROM erp_financeiro WHERE ";
                $sql .= "id_categoria = $id_categoria ";
                $sql .= "AND (";
                $sql .= "((area = 1 OR area = 4 OR area = 3) AND date >= '$year_prev-$month_prev-01' AND date <= '$year_prev-$month_prev-31 23:59:59') ";
                $sql .= "OR (date >= '$year-$month-01' AND date <= '$year-$month-31 23:59:59' $tipo_conta $query AND (area != 1 AND area != 4 AND area != 3)) ";
                $sql .= "OR ((date <  '$year-$month-01' AND (area != 1 AND area != 4 AND area != 3) AND status = 0) OR (date < '$year-$month-01' $tipo_conta $query AND (area != 1 AND area != 4 AND area != 3) AND status = 0)) ";
                $sql .= ")";
                $sql .= "$tipo_conta $query ORDER BY id_entidade ASC"; // ORDER BY date ASC
            }
            
            if($session && (isset($arg['ignorar']) && $arg['ignorar'])){
                $sql  = "SELECT * FROM erp_financeiro WHERE ";
                $sql .= "id_categoria = $id_categoria ";                
                $sql .= "AND (date >= '$year-$month-01' AND date <= '$year-$month-31 23:59:59') ";             
                $sql .= "$tipo_conta $query ORDER BY id_entidade ASC"; // ORDER BY date ASC
            }
           
        }

       
        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll();          
            
            //if(date("Y-n-d") < "$year-$month-01") echo 'here';
            
            $valor = 0; $valor_liquido = 0; $valor_bruto = 0; $valor_total = 0; $valor_receber = 0; $valor_recebe = 0;
            $valor_desconto = 0; $desconto_aberto = 0; $desconto_fechado = 0; $total_final_fechado = 0; $total_final_aberto = 0; $total_final = 0;
            
            if($recordset['registros']){
                
                for($i = 0; $i < count($recordset['registros']); $i++){
                    //echo $recordset['registros'][$i]['titulo'] . ' ' .$recordset['registros'][$i]['nr_parcelas'] . '</br>';
                    $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                    $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                    $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']);
                    $recordset['registros'][$i]['status_string'] = StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                    $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);
                    
                    //Se for PierMail
                    if($recordset['registros'][$i]['area'] == 4){
                        $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat((ceil($recordset['registros'][$i]['nr_parcelas'] / 1000) * Yii::app()->params['dolar'] ), true, 0);
                        if($recordset['registros'][$i]['nr_parcelas'] > 10) $recordset['registros'][$i]['valor'] = (ceil($recordset['registros'][$i]['nr_parcelas'] / 1000) * Yii::app()->params['dolar']);
                    }
                    
                    $recordset['registros'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['desconto'], true, 0);
                    $recordset['registros'][$i]['valor_liquido'] = MathUtils::getPercentageValue($recordset['registros'][$i]['valor'], $recordset['registros'][$i]['comissao']);
                    $recordset['registros'][$i]['valor_liquido_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor_liquido'], true, 0);
                    $recordset['registros'][$i]['valor_final_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto'], true, 0);

                    //SUM closed
                    if($recordset['registros'][$i]['status'] == 1) $valor = $valor + $recordset['registros'][$i]['valor'];
                    if($recordset['registros'][$i]['status'] == 1) $valor_liquido = $valor_liquido + $recordset['registros'][$i]['valor_liquido'];
                    if($recordset['registros'][$i]['status'] == 1) $desconto_fechado = $desconto_fechado + $recordset['registros'][$i]['desconto'];
                    
                    //SUM open
                    if($recordset['registros'][$i]['status'] == 0) $valor_receber = $valor_receber + $recordset['registros'][$i]['valor_liquido'];
                    if($recordset['registros'][$i]['status'] == 0) $valor_recebe = $valor_recebe + $recordset['registros'][$i]['valor'];
                    if($recordset['registros'][$i]['status'] == 0) $desconto_aberto = $desconto_aberto + $recordset['registros'][$i]['desconto'];
                    
                    //SUM - Total final
                    if($recordset['registros'][$i]['status'] == 0) $total_final_aberto = $total_final_aberto + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    if($recordset['registros'][$i]['status'] == 1) $total_final_fechado = $total_final_fechado + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    
                    $valor_total = $valor_total + $recordset['registros'][$i]['valor'];
                    $valor_bruto = $valor_bruto + $recordset['registros'][$i]['valor_liquido'];
                    $total_final = $total_final + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    $valor_desconto = $valor_desconto + $recordset['registros'][$i]['desconto'];
                    
                }
            }
            
            $recordset['total'] = CurrencyUtils::getPriceFormat($valor, true, 0);
            $recordset['total_liquido'] = CurrencyUtils::getPriceFormat($valor_liquido, true, 0);
            $recordset['total_bruto'] = CurrencyUtils::getPriceFormat($valor_bruto, true, 0);
            $recordset['total_limpo'] = CurrencyUtils::getPriceFormat($valor_total, true, 0);
            $recordset['total_receber'] = CurrencyUtils::getPriceFormat($valor_receber, true, 0);
            $recordset['total_recebe'] = CurrencyUtils::getPriceFormat($valor_recebe, true, 0);
            
            $recordset['total_desconto'] = CurrencyUtils::getPriceFormat($valor_desconto, true, 0);
            $recordset['total_desconto_aberto'] = CurrencyUtils::getPriceFormat($desconto_aberto, true, 0);
            $recordset['total_desconto_fechado'] = CurrencyUtils::getPriceFormat($desconto_fechado, true, 0);
            $recordset['total_final_aberto'] = CurrencyUtils::getPriceFormat($total_final_aberto, true, 0);
            $recordset['total_final_fechado'] = CurrencyUtils::getPriceFormat($total_final_fechado, true, 0);
            $recordset['total_final'] = CurrencyUtils::getPriceFormat($total_final, true, 0);
            
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllContent() ". $e->getMessage();
        }
    }
    
    
    
    
    
    /**
     * Método para recuperar os registros de contas
     *
    */
    public function getAllContent3333($id_categoria, $session = null, $period = true){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        
        //Add new items into query
        $query = "";
        ($session['financeiro_tipo_conta'] != '') ? $tipo_conta = "AND tipo = " .$session['financeiro_tipo_conta'] : $tipo_conta = "";
        if($session['id_subcategoria_financeiro'] != '' && $session['id_subcategoria_financeiro'] != 0) $query = "AND id_erp_subcategoria = " .$session['id_subcategoria_financeiro'];
        if($session['id_subitem_financeiro'] != '' && $session['id_subitem_financeiro'] != 0 && $session['id_subcategoria_financeiro'] != 0) $query = "AND id_erp_subcategoria = {$session['id_subcategoria_financeiro']} AND id_erp_subitem = {$session['id_subitem_financeiro']}";
        if($session['id_subelement_financeiro'] != '' && $session['id_subelement_financeiro'] != 0 && $session['id_subitem_financeiro'] != 0) $query = "AND id_erp_subcategoria = {$session['id_subcategoria_financeiro']} AND id_erp_subitem = {$session['id_subitem_financeiro']} AND id_erp_subelement = {$session['id_subelement_financeiro']}";
        
        if($period){
            $sql = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria AND (area != 1 AND area != 4 AND area != 3)";
            if($session)$sql = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria AND date >= '$year-$month-01' AND date <= '$year-$month-31 23:59:59' $tipo_conta $query AND (area != 1 AND area != 4 AND area != 3) ORDER BY id_entidade ASC"; //ORDER BY date ASC
        }
        
        if($period){
            $month_prev = $month - 1; $year_prev = $year;           
            if($month_prev < 0){ $month_prev = "12"; $year_prev = $year - 1;} 
            if($month_prev < 10) $month_prev = "0" . $month_prev;
            $sql2 = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria AND (area = 1 OR area = 4 OR area = 3)";
            if($session)$sql2 = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria AND (area = 1 OR area = 4 OR area = 3) AND date >= '$year_prev-$month_prev-01' AND date <= '$year_prev-$month_prev-31 23:59:59' $tipo_conta $query ORDER BY id_entidade ASC"; // ORDER BY date ASC
        }
       
        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll();
            
            $command2 = Yii::app()->db->createCommand($sql2);            
            $recordset['registros2'] = $command2->queryAll();
            
            if($recordset['registros2']) $recordset['registros'] = array_merge ($recordset['registros'], $recordset['registros2']);
            
            //if(date("Y-n-d") < "$year-$month-01") echo 'here';
            
            $valor = 0; $valor_liquido = 0; $valor_bruto = 0; $valor_total = 0; $valor_receber = 0; $valor_recebe = 0;
            $valor_desconto = 0; $desconto_aberto = 0; $desconto_fechado = 0; $total_final_fechado = 0; $total_final_aberto = 0; $total_final = 0;
            
            if($recordset['registros']){
                
                for($i = 0; $i < count($recordset['registros']); $i++){
                    $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                    $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                    $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']);
                    $recordset['registros'][$i]['status_string'] = StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                    $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);
                    $recordset['registros'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['desconto'], true, 0);
                    $recordset['registros'][$i]['valor_liquido'] = MathUtils::getPercentageValue($recordset['registros'][$i]['valor'], $recordset['registros'][$i]['comissao']);
                    $recordset['registros'][$i]['valor_liquido_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor_liquido'], true, 0);
                    $recordset['registros'][$i]['valor_final_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto'], true, 0);

                    //SUM closed
                    if($recordset['registros'][$i]['status'] == 1) $valor = $valor + $recordset['registros'][$i]['valor'];
                    if($recordset['registros'][$i]['status'] == 1) $valor_liquido = $valor_liquido + $recordset['registros'][$i]['valor_liquido'];
                    if($recordset['registros'][$i]['status'] == 1) $desconto_fechado = $desconto_fechado + $recordset['registros'][$i]['desconto'];
                    
                    //SUM open
                    if($recordset['registros'][$i]['status'] == 0) $valor_receber = $valor_receber + $recordset['registros'][$i]['valor_liquido'];
                    if($recordset['registros'][$i]['status'] == 0) $valor_recebe = $valor_recebe + $recordset['registros'][$i]['valor'];
                    if($recordset['registros'][$i]['status'] == 0) $desconto_aberto = $desconto_aberto + $recordset['registros'][$i]['desconto'];
                    
                    //SUM - Total final
                    if($recordset['registros'][$i]['status'] == 0) $total_final_aberto = $total_final_aberto + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    if($recordset['registros'][$i]['status'] == 1) $total_final_fechado = $total_final_fechado + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    
                    $valor_total = $valor_total + $recordset['registros'][$i]['valor'];
                    $valor_bruto = $valor_bruto + $recordset['registros'][$i]['valor_liquido'];
                    $total_final = $total_final + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    $valor_desconto = $valor_desconto + $recordset['registros'][$i]['desconto'];
                    
                }
            }
            
            $recordset['total'] = CurrencyUtils::getPriceFormat($valor, true, 0);
            $recordset['total_liquido'] = CurrencyUtils::getPriceFormat($valor_liquido, true, 0);
            $recordset['total_bruto'] = CurrencyUtils::getPriceFormat($valor_bruto, true, 0);
            $recordset['total_limpo'] = CurrencyUtils::getPriceFormat($valor_total, true, 0);
            $recordset['total_receber'] = CurrencyUtils::getPriceFormat($valor_receber, true, 0);
            $recordset['total_recebe'] = CurrencyUtils::getPriceFormat($valor_recebe, true, 0);
            
            $recordset['total_desconto'] = CurrencyUtils::getPriceFormat($valor_desconto, true, 0);
            $recordset['total_desconto_aberto'] = CurrencyUtils::getPriceFormat($desconto_aberto, true, 0);
            $recordset['total_desconto_fechado'] = CurrencyUtils::getPriceFormat($desconto_fechado, true, 0);
            $recordset['total_final_aberto'] = CurrencyUtils::getPriceFormat($total_final_aberto, true, 0);
            $recordset['total_final_fechado'] = CurrencyUtils::getPriceFormat($total_final_fechado, true, 0);
            $recordset['total_final'] = CurrencyUtils::getPriceFormat($total_final, true, 0);
            
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllContent() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o registro conta pelo ID
     *
    */
    public function getContentById($id, $action){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $sql = "SELECT * FROM erp_financeiro WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow(); 
            
             if($recordset){
                 $recordset['date'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['date']);
                 $recordset['entidade'] = UserUtils::getUserFullById($recordset['id_entidade']);
             }
            //Action
            $recordset['action'] = $action;
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getContentById() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o registro vazio
     *
    */
    public function getContentClear($action){
                  
        $recordset = array('action' => $action, 'titulo' => '', 'valor' => '', 'desconto' => '', 'tipo' => '', 'id_entidade' => 0, 'area' => 0,
                           'descricao' => '', 'date' => '', 'id' => '', 'id_general' => '', 'instituicao' => 0, 'status' => 0,
                           'id_erp_categoria' => 0, 'id_erp_subcategoria' => 0, 'id_erp_subitem' => 0, 'id_erp_subelement' => 0,
                           'nr_parcelas' => 0, 'entidade' => array('nome' => ''));            
        return $recordset;     
    }

    /**
     * Método para manusear edição e cadastro de Contas
     * 
     * TODO: CASO altere aqui alterar também em FinanceirosUtils::HandleParcels
     * 
     * AREA: 0 = conta
     *       1 = servicos
     *       2 = hospedagem
     *       3 = compra
     *       4 = disparo
     *
     * @param POST 
     *
    */
    public function savePayment($arr = array(), $isArg = false){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.erp.FinanceiroUtils');
        Yii::import('application.extensions.dbuzz.admin.erp.BoletoManager');

        $boletoHandler = new BoletoManager();
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        if(isset($params['type_account'])) $tipo_conta = $params['type_account'];
        (isset($params['id_categoria'])) ? $id_categoria = $params['id_categoria'] :  $id_categoria = 0;
        if(isset($params['title'])) $titulo = $params['title'];
        if(isset($params['value'])) $valor = CurrencyUtils::checkFloatFormat($params['value']);
        if(isset($params['value_desconto'])) $desconto = CurrencyUtils::checkFloatFormat($params['value_desconto']);else $desconto = 0;
        if(isset($params['type'])) $tipo = $params['type'];
        if(isset($params['description'])) $descricao = $params['description'];
        if(isset($params['action'])) $action = $params['action'];
        if(isset($params['id_general'])){$id_general = $params['id_general'];}else{$id_general = 0;}//Não está usando no momento, substituido por id_erp_categoria
        (isset($params['id_entidade'])) ? $id_entidade = $params['id_entidade'] : $id_entidade = 0;
        if($id_general == "") $id_general = 0;
        (isset($params['id_order'])) ? $id_order = $params['id_order'] : $id_order = 0;
        if(isset($params['id'])) $id = $params['id'];
        if(isset($params['date'])) $date = DateTimeUtils::setFormatDateNoTime($params['date'], true);
        if(isset($params['date_ready'])) $date = $params['date_ready'];
        (isset($params['instituicao'])) ? $instituicao = $params['instituicao'] :  $instituicao = 0;
        (isset($params['status'])) ? $status = $params['status'] :  $status = 0;
        (isset($params['comissao'])) ? $comissao = $params['comissao'] :  $comissao = 0;
        (isset($params['area'])) ? $area = $params['area'] : $area = 0;
        if(isset($params['tipo'])){if(($params['tipo'] == 'compra') && ($area != 2 && $area != 3 && $area != 4))$area = 5;}
        
        //Plano de contas
        (isset($params['id_erp_categoria'])) ? $id_erp_categoria = $params['id_erp_categoria'] :  $id_erp_categoria = 0;
        (isset($params['subcategoria'])) ? $id_erp_subcategoria = $params['subcategoria'] :  $id_erp_subcategoria = 0;
        (isset($params['subitem'])) ? $id_erp_subitem = $params['subitem'] :  $id_erp_subitem = 0;
        (isset($params['subelement'])) ? $id_erp_subelement = $params['subelement'] :  $id_erp_subelement = 0;
        (isset($params['parcels']) && $params['parcels'] != '') ? $parcels = $params['parcels'] :  $parcels = 0;
        (isset($params['cod_pedido'])) ? $cod_pedido = $params['cod_pedido'] : $cod_pedido = $id_entidade . "_". md5(uniqid(rand(), true));
        (isset($params['boleto_enviar'])) ? $boleto_enviar = MethodUtils::getBooleanNumber($params['boleto_enviar']) : $boleto_enviar = 0;
        
        $last_update = date("Y-m-d H:i:s");
        
        try{
            //Caso seja uma conta parcelada
            if($tipo_conta == 1 && ($action != "p_editar" && $action != "r_editar")){
                $control = FinanceiroUtils::handleParcels($params, $boleto_enviar, $cod_pedido);
            
            //Caso seja uma conta a vista e deseje parcelar, uma vez feito, não tem mais jeito de voltar!
            }else if($tipo_conta == 1 && ($action == "p_editar" || $action == "r_editar")){
                $params['remove_item'] = true;
                $control = FinanceiroUtils::handleParcels($params, $boleto_enviar, $cod_pedido);
            
            }else{

                if($action != "p_editar" && $action != "r_editar"){
                    $sql  = "INSERT INTO erp_financeiro (titulo, valor, desconto, tipo, last_update, descricao, id_categoria, date, id_general, id_order, id_entidade, instituicao, status, comissao, id_erp_categoria, id_erp_subcategoria, id_erp_subitem, id_erp_subelement, area, nr_parcelas, cod_pedido) ";
                    $sql .= "VALUES ('$titulo', '$valor', '$desconto', '$tipo','$last_update', '$descricao', '$id_categoria', '$date', $id_general, $id_order, $id_entidade, $instituicao, $status, $comissao, $id_erp_categoria, $id_erp_subcategoria, $id_erp_subitem, $id_erp_subelement, $area, $parcels, '$cod_pedido')";

                }else{
                    $sql  = "UPDATE erp_financeiro SET titulo = '$titulo', valor = '$valor',  desconto = '$desconto', tipo = '$tipo', descricao = '$descricao', last_update = '$last_update', comissao = '$comissao', ";
                    $sql .= "date = '$date', id_general = '$id_general', id_order = '$id_order', id_entidade = '$id_entidade', instituicao = '$instituicao', status = '$status', ";
                    $sql .= "id_erp_categoria = $id_erp_categoria, id_erp_subcategoria = $id_erp_subcategoria, id_erp_subitem = $id_erp_subitem, id_erp_subelement = $id_erp_subelement, area = $area WHERE id = $id";
                }
              
                $comando = Yii::app()->db->createCommand($sql);
                $control = $comando->execute();
            }            
            
            //Caso precise enviar o boleto, lembre que em FinanceiroUtils::handleParcels() 
            //ele também salva boletos
            if($boleto_enviar){
                if($action == "p_editar" || $action == "r_editar"){
                    $set_action = 'editar';
                    
                }else{
                    $set_action = 'novo';
                    //Se for parcelado ele divide o valor
                    if($tipo_conta == 1){$amount = $params['value_total'] / $parcels; $valor = CurrencyUtils::checkFloatFormat($amount);}
                }
                
                $boleto_arg = array('titulo' => $titulo, 'descricao' => $descricao, 'valor' => $valor, 'tipo' => 1, 'action' => $set_action, 'id_entidade' => $id_entidade, 'vencimento' => $params['date'], $status => 0, $id_pedido = 0, 'cod_pedido' => $cod_pedido, 'ignore_erp' => true, 'id' => 0);
                $boleto = $boletoHandler->saveBoleto($boleto_arg, true);
   
            }else{
                $boleto = array('id' => 0);
            }
            
            //Atualiza o status do boleto
            if($action == "r_editar"){               
                if(isset($params['cod_pedido']) && $params['cod_pedido'] != '' && $params['cod_pedido'] != 0){
                    //Não pode ser zero de jeito nenhum
                    if($params['cod_pedido'] != 0 && $params['cod_pedido'] !== 0 && $params['cod_pedido'] != '0'){
                        $update_boleto = $boletoHandler->updateBoletoByCodPedido($params['cod_pedido'], 'status', $status); 
                    }
                } 
            }
                    
            $result = Yii::t('messageStrings', 'message_result_not_altered');
            if($control && $action == 'p_novo') $result = array('message' => Yii::t('messageStrings', 'message_result_payment_submited'), 'id_boleto' => $boleto['id'], 'id_entidade' => $id_entidade);
            if($control && $action == 'p_editar') $result = array('message' => Yii::t('messageStrings', 'message_result_payment_udpated'), 'id_boleto' => $boleto['id'], 'id_entidade' => $id_entidade);
            
            if($control && $action == 'r_novo') $result = array('message' => Yii::t('messageStrings', 'message_result_received_submited'), 'id_boleto' => $boleto['id'], 'id_entidade' => $id_entidade);
            if($control && $action == 'r_editar') $result = array('message' => Yii::t('messageStrings', 'message_result_received_updated'), 'id_boleto' => $boleto['id'], 'id_entidade' => $id_entidade);

            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: FinanceiroManager - savePayment() ". $e->getMessage();
        }
    }
    
    /**
     * Método para calcular o fluxo de caixa
     *
    */
    public function getAllFluxo($session = null){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        $saldo = 0;        
        
        $sql = "SELECT * FROM erp_financeiro";
        if($session)$sql = "SELECT * FROM erp_financeiro WHERE date >= '$year-$month-01' AND date <= '$year-$month-31' ORDER BY date ASC";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll(); 
            $valor_recebido = 0; $valor_pago = 0; $valor_liquido_recebido = 0; $valor_liquido_pago = 0; $valor_liquido_pago_parcial = 0; $valor_liquido_recebido_parcial = 0; $date_saldo = NULL;
            
            if($recordset['registros'])for($i = 0; $i < count($recordset['registros']); $i++){
                //Dados das finanças
                $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                $recordset['registros'][$i]['date_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']);
                $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);
                $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                
                if($recordset['registros'][$i]['id_categoria'] == 1)$valor_recebido = $valor_recebido + $recordset['registros'][$i]['valor'];
                if($recordset['registros'][$i]['id_categoria'] == 0)$valor_pago = $valor_pago + $recordset['registros'][$i]['valor'];
                
                //SUM
                if($recordset['registros'][$i]['id_categoria'] == 0 && $recordset['registros'][$i]['status'] == 1){$valor_liquido_pago = $valor_liquido_pago + $recordset['registros'][$i]['valor']; $saldo = $saldo - $recordset['registros'][$i]['valor'];}
                if($recordset['registros'][$i]['id_categoria'] == 1 && $recordset['registros'][$i]['status'] == 1){$valor_liquido_recebido = $valor_liquido_recebido + $recordset['registros'][$i]['valor']; $saldo = $saldo + $recordset['registros'][$i]['valor'];}
                
                //Parcial
                if($recordset['registros'][$i]['id_categoria'] == 0 && $recordset['registros'][$i]['status'] == 0) $valor_liquido_pago_parcial = $valor_liquido_pago_parcial + $recordset['registros'][$i]['valor'];
                if($recordset['registros'][$i]['id_categoria'] == 1 && $recordset['registros'][$i]['status'] == 0) $valor_liquido_recebido_parcial = $valor_liquido_recebido_parcial + $recordset['registros'][$i]['valor'];
        
                //Saldo               
                $recordset['registros'][$i]['saldo'] = CurrencyUtils::getPriceFormat($saldo, true, 0);
            }
            
            $recordset['total_pago'] = CurrencyUtils::getPriceFormat($valor_pago, true, 0);
            $recordset['total_recebido'] = CurrencyUtils::getPriceFormat($valor_recebido, true, 0);
            $recordset['total_previsao'] = $valor_recebido - $valor_pago;
            $recordset['total_real'] = $valor_liquido_recebido - $valor_liquido_pago;
            $recordset['total_previsao_string'] = CurrencyUtils::getPriceFormat($valor_recebido - $valor_pago, true, 0);
            $recordset['total_real_string'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido - $valor_liquido_pago, true, 0);
            $recordset['total_saldo'] = CurrencyUtils::getPriceFormat($saldo, true, 0);
            
            //Liquido
            $recordset['total_liquido_recebido'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido, true, 0);
            $recordset['total_liquido_pago'] = CurrencyUtils::getPriceFormat($valor_liquido_pago, true, 0);
            
            //Parcial
            $recordset['total_liquido_pago_parcial'] = CurrencyUtils::getPriceFormat($valor_liquido_pago_parcial, true, 0);
            $recordset['total_liquido_recebido_parcial'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido_parcial, true, 0);
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllContent() ". $e->getMessage();
        }
    }
    
    /**
     * Método para calcular o fluxo de caixa
     *
    */
    public function getAllBalanceAccounts($session = null){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.erp.FinanceiroUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        $instituicao = $session['instituicao_financeiro'];
        
        
        $sql = "SELECT * FROM erp_financeiro";
        $sql = "SELECT * FROM erp_financeiro WHERE date >= '$year-$month-01' AND date <= '$year-$month-31' ORDER BY date ASC";
        if($instituicao != '') $sql = "SELECT * FROM erp_financeiro WHERE instituicao = $instituicao AND (date >= '$year-$month-01' AND date <= '$year-$month-31') ORDER BY date ASC";


        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll(); 
            $valor_recebido = 0; $valor_pago = 0; $valor_liquido_recebido = 0; $valor_liquido_pago = 0; $valor_liquido_pago_parcial = 0; $valor_liquido_recebido_parcial = 0; 
            
            if($recordset['registros'])for($i = 0; $i < count($recordset['registros']); $i++){
                $recordset['registros'][$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset['registros'][$i]['last_update']);
                $recordset['registros'][$i]['date'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']);
                $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, 0);
                $recordset['registros'][$i]['entidade'] = UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']);
                
                if($recordset['registros'][$i]['id_categoria'] == 1)$valor_recebido = $valor_recebido + $recordset['registros'][$i]['valor'];
                if($recordset['registros'][$i]['id_categoria'] == 0)$valor_pago = $valor_pago + $recordset['registros'][$i]['valor'];
                
                //SUM
                if($recordset['registros'][$i]['id_categoria'] == 0 && $recordset['registros'][$i]['status'] == 1) $valor_liquido_pago = $valor_liquido_pago + $recordset['registros'][$i]['valor'];
                if($recordset['registros'][$i]['id_categoria'] == 1 && $recordset['registros'][$i]['status'] == 1) $valor_liquido_recebido = $valor_liquido_recebido + $recordset['registros'][$i]['valor'];
                
                //Parcial
                if($recordset['registros'][$i]['id_categoria'] == 0 && $recordset['registros'][$i]['status'] == 0) $valor_liquido_pago_parcial = $valor_liquido_pago_parcial + $recordset['registros'][$i]['valor'];
                if($recordset['registros'][$i]['id_categoria'] == 1 && $recordset['registros'][$i]['status'] == 0) $valor_liquido_recebido_parcial = $valor_liquido_recebido_parcial + $recordset['registros'][$i]['valor'];
                
                //Instituicao
                $recordset['registros'][$i]['icon_instituicao'] = FinanceiroUtils::getInstituicaoIcon($recordset['registros'][$i]['instituicao']);
                
            }
            
            $recordset['total_pago'] = CurrencyUtils::getPriceFormat($valor_pago, true, 0);
            $recordset['total_recebido'] = CurrencyUtils::getPriceFormat($valor_recebido, true, 0);
            $recordset['total_previsao'] = $valor_recebido - $valor_pago;
            $recordset['total_real'] = $valor_liquido_recebido - $valor_liquido_pago;
            $recordset['total_previsao_string'] = CurrencyUtils::getPriceFormat($valor_recebido - $valor_pago, true, 0);
            $recordset['total_real_string'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido - $valor_liquido_pago, true, 0);
            
            //Liquido
            $recordset['total_liquido_recebido'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido, true, 0);
            $recordset['total_liquido_pago'] = CurrencyUtils::getPriceFormat($valor_liquido_pago, true, 0);
            
            //Parcial
            $recordset['total_liquido_pago_parcial'] = CurrencyUtils::getPriceFormat($valor_liquido_pago_parcial, true, 0);
            $recordset['total_liquido_recebido_parcial'] = CurrencyUtils::getPriceFormat($valor_liquido_recebido_parcial, true, 0);
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllContent() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o registro conta pelo ID da Ordem de Servico
     * 
     * @param number
     *
    */
    public function getContentByIdOrder($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $sql = "SELECT * FROM erp_financeiro WHERE id_order = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow(); 
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getContentByIdOrder() ". $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para remover um registro
     *
     * @param array
     *
    */
    public function removePayment($id){
      
        $sql = "DELETE FROM erp_financeiro WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $result = Yii::t('messageStrings', 'message_result_removed');
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: FinanceiroManager - removePayment() ". $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para definir as contas a pagar e receber do mês
     *
     * @param number
     * 
     * 
     *
    */
    public function setFinancesForMonth($month, $year){
        
        Yii::import('application.extensions.utils.erp.FinanceiroUtils');
        
        
        $bills = $this->getContentByType(1, $month, $year);
        $clients = $this->getUsersByType("cliente");
        $employees = $this->getUsersByType("funcionario");
        
        $date = DateTimeUtils::getMonthSequence($month, $year);

        try{
            if($bills){
                foreach ($bills as $value){
                    $isExist = FinanceiroUtils::checkIfExist($value['title'], $value['value'], $date['month_next'], $date['year_next']);
                    if(!$isExist) $set = $this->savePaymentCronJob($value, true);
                    //echo $value['date'] . '</br>';                
                }
            }
            
            if($clients){
                foreach ($clients as $value2){
                    $isExist2 = FinanceiroUtils::checkIfExist($value2['title'], $value2['value'], $date['month_next'], $date['year_next']);
                    
                    if(!$isExist2) $set = $this->savePaymentCronJob($value2, true);
                    //echo $value2['title'] . '</br>';
                
                }
            }
            
            if($employees){
                foreach ($employees as $value3){
                    $isExist3 = FinanceiroUtils::checkIfExist($value3['title'], $value3['value'], $date['month_next'], $date['year_next']);
                    if(!$isExist3) $set = $this->savePaymentCronJob($value3, true);
                    //echo $value3['title'] . '</br>';
                }
            }
            //var_dump($result);
            //$result = Yii::t('messageString', 'message_result_payment_removed');
            //return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: FinanceiroManager - setFinancesForMonth() ". $e->getMessage();
        }
    }
    
    /**
     * Método para manusear edição e cadastro de Contas do CronJob
     * 
     * TODO: CASO altere aqui alterar também em FinanceirosUtils::HandleParcels
     * 
     * AREA: 0 = conta
     *       1 = servicos
     *       2 = hospedagem
     *       3 = compra
     *       4 = disparo
     *
     * @param POST 
     *
    */
    public function savePaymentCronJob($arr = array(), $isArg = false){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.erp.FinanceiroUtils');
        
        $params = array();
        if(!$isArg) parse_str($_POST['data'], $params);
        if( $isArg) $params = $arr;
        
        if(isset($params['type_account'])) $tipo_conta = $params['type_account'];
        (isset($params['id_categoria'])) ? $id_categoria = $params['id_categoria'] :  $id_categoria = 0;
        if(isset($params['title'])) $titulo = $params['title'];
        if(isset($params['value'])) $valor = CurrencyUtils::checkFloatFormat($params['value']);
        if(isset($params['type'])) $tipo = $params['type'];
        if(isset($params['description'])) $descricao = $params['description'];
        if(isset($params['action'])) $action = $params['action'];
        if(isset($params['id_general'])){$id_general = $params['id_general'];}else{$id_general = 0;}//Não está usando no momento, substituido por id_erp_categoria
        (isset($params['id_entidade'])) ? $id_entidade = $params['id_entidade'] : $id_entidade = 0;
        if($id_general == "") $id_general = 0;
        (isset($params['id_order'])) ? $id_order = $params['id_order'] : $id_order = 0;
        if(isset($params['id'])) $id = $params['id'];
        if(isset($params['date'])) $date = DateTimeUtils::setFormatDateNoTime($params['date'], true);
        if(isset($params['date_ready'])) $date = $params['date_ready'];
        (isset($params['instituicao'])) ? $instituicao = $params['instituicao'] :  $instituicao = 0;
        (isset($params['status'])) ? $status = $params['status'] :  $status = 0;
        (isset($params['comissao'])) ? $comissao = $params['comissao'] :  $comissao = 0;
        (isset($params['area'])) ? $area = $params['area'] : $area = 0;
        if(isset($params['tipo']) && $params['tipo'] == 'compra') $area = 5;
        
        //Plano de contas
        (isset($params['id_erp_categoria'])) ? $id_erp_categoria = $params['id_erp_categoria'] :  $id_erp_categoria = 0;
        (isset($params['subcategoria'])) ? $id_erp_subcategoria = $params['subcategoria'] :  $id_erp_subcategoria = 0;
        (isset($params['subitem'])) ? $id_erp_subitem = $params['subitem'] :  $id_erp_subitem = 0;
        (isset($params['subelement'])) ? $id_erp_subelement = $params['subelement'] :  $id_erp_subelement = 0;
        (isset($params['parcels']) && $params['parcels'] != '') ? $parcels = $params['parcels'] :  $parcels = 0;
        (isset($params['cod_pedido'])) ? $cod_pedido = $params['cod_pedido'] : $cod_pedido = $id_entidade . "_". md5(uniqid(rand(), true));
        
        $last_update = date("Y-m-d H:i:s");
        
        try{
            
            if($action != "p_editar" && $action != "r_editar"){
                $sql  = "INSERT INTO erp_financeiro (titulo, valor, tipo, last_update, descricao, id_categoria, date, id_general, id_order, id_entidade, instituicao, status, comissao, id_erp_categoria, id_erp_subcategoria, id_erp_subitem, id_erp_subelement, area, nr_parcelas, cod_pedido) ";
                $sql .= "VALUES ('$titulo', '$valor', '$tipo','$last_update', '$descricao', '$id_categoria', '$date', $id_general, $id_order, $id_entidade, $instituicao, $status, $comissao, $id_erp_categoria, $id_erp_subcategoria, $id_erp_subitem, $id_erp_subelement, $area, $parcels, '$cod_pedido')";

            }else{
                $sql  = "UPDATE erp_financeiro SET titulo = '$titulo', valor = '$valor', tipo = '$tipo', descricao = '$descricao', last_update = '$last_update', comissao = '$comissao', ";
                $sql .= "date = '$date', id_general = '$id_general', id_order = '$id_order', id_entidade = '$id_entidade', instituicao = '$instituicao', ";
                $sql .= "id_erp_categoria = $id_erp_categoria, id_erp_subcategoria = $id_erp_subcategoria, id_erp_subitem = $id_erp_subitem, id_erp_subelement = $id_erp_subelement, area = $area WHERE id = $id";
            }

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: FinanceiroManager - savePaymentCronJob() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros que serão adicionados no próximo mês
     * 
     * @param number
     *
    */
    public function getContentByType($tipo = 1, $month, $year){
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        try{          
            $command = Yii::app()->db->createCommand("SELECT * FROM erp_financeiro WHERE tipo = $tipo AND date >= '$year-$month-01' AND date <= '$year-$month-31' ORDER BY date ASC");  
            
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++) {
                $recordset[$i]['date'] = DateTimeUtils::getDateSequence($recordset[$i]['date'], false, 'increase');
                $recordset[$i]['date'] = DateTimeUtils::getDateFormatCommonNoTime($recordset[$i]['date']);
                $recordset[$i]['type_account'] = 0; //0 comum, 1 parcelado
                $recordset[$i]['parcels'] = $recordset[$i]['nr_parcela'];
                $recordset[$i]['title'] = $recordset[$i]['titulo'];
                $recordset[$i]['value'] = $recordset[$i]['valor']; 
                $recordset[$i]['type'] = $recordset[$i]['tipo'];
                $recordset[$i]['description'] = $recordset[$i]['descricao']; 
                
                //Set action value
                ($recordset[$i]['id_categoria'] == 1) ? $action = "r_novo" : $action = "p_novo";
                $recordset[$i]['action'] = $action; 
            }
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getContentByType() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros que serão adicionados no próximo mês
     * 
     * @param number
     *
    */
    public function getUsersByType($type){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        //$userHandler = new UsersManager();

        try{   
            $recordset = UserUtils::getAllKindUsers($type);
            $result = false;
            
            if($type == 'cliente'){$p = 0; 
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i][$type] = UserSupportUtils::getUserByTag($type, $recordset[$i]['id']);
                    //echo $recordset[$i][$type]['mensalidade'] . $recordset[$i][$type]['cobrar'] . "</br>";
                    if($recordset[$i][$type]['incluir_conta_fixa']){
                        $vencimento = DateTimeUtils::setFormatDateNoTime($recordset[$i][$type]['vencimento']);
                        $result[$p]['date'] = DateTimeUtils::getDateSequence($vencimento, false, 'increase');
                        $result[$p]['date'] = DateTimeUtils::getDateFormatCommonNoTime($result[$p]['date']);
                        $result[$p]['type_account'] = 0; 
                        $result[$p]['id_categoria'] = 1; 
                        $result[$p]['parcels'] = 0;
                        $result[$p]['title'] = $recordset[$i][$type]['titulo_servico'] . " - " . $recordset[$i]['nome'];
                        $result[$p]['value'] = $recordset[$i][$type]['mensalidade']; 
                        $result[$p]['type'] = 0; //0 comum, 1 parcelado;
                        $result[$p]['description'] = "";
                        $result[$p]['id_general'] = $recordset[$i][$type]['erp_categoria'];

                        //Set action value
                        $result[$p]['action'] = "r_novo"; 
                        $p++;
                    }
                }
            }
            
            
            if($type == 'funcionario'){$j = 0;
                for($c = 0; $c < count($recordset); $c++){
                    $recordset[$c][$type] = UserSupportUtils::getUserByTag($type, $recordset[$c]['id']);
                    //echo $recordset[$c][$type]['mensalidade'] . $recordset[$c][$type]['cobrar'] . "</br>";
                    if($recordset[$c][$type]['incluir_conta_fixa']){
                        $vencimento = DateTimeUtils::setFormatDateNoTime($recordset[$c][$type]['vencimento']);
                        $result[$j]['date'] = DateTimeUtils::getDateSequence($vencimento, false, 'increase');
                        $result[$j]['date'] = DateTimeUtils::getDateFormatCommonNoTime($result[$j]['date']);
                        $result[$j]['type_account'] = 0; 
                        $result[$j]['id_categoria'] = 0; 
                        $result[$j]['parcels'] = 0;
                        $result[$j]['title'] = "Salário - " . $recordset[$c]['nome'];
                        $result[$j]['value'] = $recordset[$c][$type]['salario']; 
                        $result[$j]['type'] = 1; //0 comum, 1 parcelado;
                        $result[$j]['description'] = "";
                        $result[$j]['id_general'] = $recordset[$c][$type]['erp_categoria'];

                        //Set action value
                        $result[$j]['action'] = "p_novo"; 
                        $j++;
                    }
                }
                
                
            }
      
            //var_dump($result);
            
            return $result;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getContentByType() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de um determinado usuário em um 
     * determinado periodo
     * 
     * @param number
     * @param number
     * @param tipo = 0 - Receita
     *
    */
    public function getAllItemsFromDate($year, $month, $id_entidade, $area = 0){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');

        try{ 
            $sql = "SELECT * FROM erp_financeiro WHERE tipo = 0 AND (date >= '{$year}-{$month}-01' AND date < '{$year}-{$month}-31') AND id_entidade = $id_entidade AND status = 0 AND area = $area ORDER BY date ASC";
            $command = Yii::app()->db->createCommand($sql);
            $recordset['items'] = $command->queryAll();
            
            $valor = 0;            
            $recordset['total'] = 0;
            
            if($recordset['items'] && count($recordset['items']) > 0){
                for($i = 0; $i < count($recordset['items']); $i++) {                    
                    $recordset['items'][$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['items'][$i]['date']);
                    $recordset['items'][$i]['data_referente'] = DateTimeUtils::getMonth($recordset['items'][$i]['date'], false);
                    $recordset['items'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['valor'], true, false); 
                    $recordset['items'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['desconto'], true, false); 
                    $result = $recordset['items'][$i]['valor'] - $recordset['items'][$i]['desconto'];
                    $recordset['items'][$i]['valor_final_string'] = CurrencyUtils::getPriceFormat($result , true, false);
                    $recordset['items'][$i]['valor'] = $recordset['items'][$i]['valor'];
                    
                    if($recordset['items'][$i]['nr_parcela'] > 0) $recordset['items'][$i]['titulo'] = $recordset['items'][$i]['titulo'] . ' - ' . $recordset['items'][$i]['nr_parcela'] . "/" . $recordset['items'][$i]['nr_parcelas'];
                    $valor = $valor + $result;

                    $recordset['total'] = $valor;
                }
            }
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllItemsFromDate() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de um determinado usuário que estão em aberto
     * 
     * @param number
     * @param number
     * @param tipo = 0 - Receita
     *
    */
    public function getAllItemsNotPayed($id_entidade, $month, $year){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');

        try{ 
            $sql = "SELECT * FROM erp_financeiro WHERE tipo = 0 AND id_entidade = $id_entidade ";            
            $sql .= "AND ((date <  '$year-$month-01' AND (area != 1 AND area != 4 AND area != 3) AND status = 0) OR (date < '$year-$month-01' AND (area != 1 AND area != 4 AND area != 3) AND status = 0)) ";
            $sql .= "ORDER BY date ASC";
            
            $command = Yii::app()->db->createCommand($sql);
            $recordset['items'] = $command->queryAll();
            
            $valor = 0;            
            $recordset['total'] = 0;
            
            if($recordset['items'] && count($recordset['items']) > 0){
                for($i = 0; $i < count($recordset['items']); $i++) {                    
                    $recordset['items'][$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['items'][$i]['date']);
                    $recordset['items'][$i]['data_referente'] = DateTimeUtils::getMonth($recordset['items'][$i]['date'], false);
                    $recordset['items'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['valor'], true, false); 
                    $recordset['items'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['desconto'], true, false); 
                    $result = $recordset['items'][$i]['valor'] - $recordset['items'][$i]['desconto'];
                    $recordset['items'][$i]['valor_final_string'] = CurrencyUtils::getPriceFormat($result , true, false);
                    $recordset['items'][$i]['valor'] = $recordset['items'][$i]['valor'];
                    
                    if($recordset['items'][$i]['nr_parcela'] > 0) $recordset['items'][$i]['titulo'] = $recordset['items'][$i]['titulo'] . ' - ' . $recordset['items'][$i]['nr_parcela'] . "/" . $recordset['items'][$i]['nr_parcelas'];
                    $valor = $valor + $result;

                    $recordset['total'] = $valor;
                }
            }
            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllItemsFromDate() ". $e->getMessage();
        }
    }
    
    /**
     * Método para definir status
     * 
     * @param number
     *
    */
    public static function updateStatus($id, $status, $field = 'status'){
        
        $sql = "UPDATE erp_financeiro SET $field = $status WHERE id = $id";
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return 'ERROR: FinanceiroManager - updateStatus() '. $e->getMessage();
        }
    }
    
    /**
     * Método para definir status via cod pedido 32 chars
     * 
     * @param number
     *
    */
    public static function updateStatusByCodPedido($cod_pedido, $status, $field = 'status'){
        
        $sql = "UPDATE erp_financeiro SET $field = $status WHERE cod_pedido = '$cod_pedido'";
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return 'ERROR: FinanceiroManager - updateStatusByCodPedido() '. $e->getMessage();
        }
    }
    
    /**
     * Método para manusear conta
     *
     * @param POST 
     *
    */
    public function updateAccountValues($data){
        
        $sql = "UPDATE erp_financeiro SET status = {$data['status']}, desconto = {$data['desconto']}, descricao = '{$data['descricao']}' WHERE id = {$data['id']}";  
        if(isset($data['just_status']) && $data['just_status']) $sql = "UPDATE erp_financeiro SET status = {$data['status']} WHERE id = {$data['id']}"; 
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return 'ERROR: FinanceiroManager - updateAccountValues() '. $e->getMessage();
        }
    }
    
    /**
     * Método para checar se uma conta já existe
     * 
     * @param number
     *
    */
    public function checkIfExist($titulo, $id_entidade){
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        try{   
            $sql = "SELECT id FROM erp_financeiro WHERE titulo = '$titulo' AND id_entidade = $id_entidade";
            $command = Yii::app()->db->createCommand($sql);  
            
            $recordset = $command->queryRow();            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - checkIfExist() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de contas e justar em usuário
     *
    */
    public function getAllContentColapse($id_categoria, $session = null, $period = true){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];      
        
        if($period){
            $month_prev = $month - 1; $year_prev = $year;           
            if($month_prev < 0){ $month_prev = "12"; $year_prev = $year - 1;} 
            if($month_prev < 10) $month_prev = "0" . $month_prev;
            $sql = "SELECT *, SUM(valor) FROM erp_financeiro WHERE id_categoria = $id_categoria GROUP BY id_entidade";
            //if($session)$sql = "SELECT *, SUM(valor) FROM erp_financeiro WHERE id_categoria = $id_categoria AND ((area = 1 OR area = 4 OR area = 3) AND date >= '$year_prev-$month_prev-01' AND date <= '$year_prev-$month_prev-31 23:59:59') OR (date >= '$year-$month-01' AND date <= '$year-$month-31' AND (area != 1 AND area != 4 AND area != 3)) GROUP BY id_entidade ORDER BY id_entidade ASC"; // ORDER BY date ASC
            if($session)$sql = "SELECT * FROM erp_financeiro WHERE id_categoria = $id_categoria AND (((area = 1 OR area = 4 OR area = 3) AND date >= '$year_prev-$month_prev-01' AND date <= '$year_prev-$month_prev-31 23:59:59') OR (date >= '$year-$month-01' AND date <= '$year-$month-31' AND (area != 1 AND area != 4 AND area != 3))) ORDER BY id_entidade ASC"; // ORDER BY date ASC
        }
       
        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll();
            
            //if(date("Y-n-d") < "$year-$month-01") echo 'here';
            
            $valor = 0; $valor_liquido = 0; $valor_bruto = 0; $valor_total = 0; $valor_receber = 0; $valor_recebe = 0;
            $valor_desconto = 0; $desconto_aberto = 0; $desconto_fechado = 0; $total_final_fechado = 0; $total_final_aberto = 0; $total_final = 0; $id_entidade = 0; 
            $p=0; $vlor = 0; $pg_partial = 0;
            
            if($recordset['registros']){
                
                    
                for($i = 0; $i < count($recordset['registros']); $i++){
                    
                    //Se for PierMail
                    if($recordset['registros'][$i]['area'] == 4){
                        $recordset['registros'][$i]['valor'] = (ceil($recordset['registros'][$i]['nr_parcelas'] / 1000) * Yii::app()->params['dolar']);
                    }
                    
                    if($i == 0) $id_entidade = $recordset['registros'][0]['id_entidade'];
                    
                    if($id_entidade == $recordset['registros'][$i]['id_entidade']){
                        $vlor = $vlor + $recordset['registros'][$i]['valor'];
                        if($recordset['registros'][$i]['status'] == 0 && $pg_partial < 100){if($pg_partial == 1){$status = 0; $pg_partial = 1;}else{$status = 0; $pg_partial = 2;}}else if($recordset['registros'][$i]['status'] == 1 && $pg_partial < 100){if($pg_partial == 2){$status = 1; $pg_partial = 2;}else{$status = 1; $pg_partial = 1;}}
                        if(($recordset['registros'][$i]['status'] == 0 && $pg_partial == 1) || $pg_partial == 100){$status = 100; $pg_partial = 100;}
                        if(($recordset['registros'][$i]['status'] == 1 && $pg_partial == 2) || $pg_partial == 100){$status = 100; $pg_partial = 100;}
                        
                        $vl_String = CurrencyUtils::getPriceFormat($vlor, true, 0);
                        $final['registros'][$p] = array('entidade' => UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']), 'valor_final_string' => $vl_String, 'date' => DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']), 'status_string' => StatusUtils::getPaymentStatus($status), 'id' => 1, 'id_entidade' => $recordset['registros'][$i]['id_entidade']);
                    }else{
                        $p++; $vlor = 0; $pg_partial = 0;
                        $vlor = $vlor + $recordset['registros'][$i]['valor'];
                        if($recordset['registros'][$i]['status'] == 1){$status = 1; $pg_partial = 1;}else{$status = 0; $pg_partial = 2;}
                        $vl_String = CurrencyUtils::getPriceFormat($vlor, true, 0);
                        $final['registros'][$p] = array('entidade' => UserUtils::getUserFullById($recordset['registros'][$i]['id_entidade']), 'valor_final_string' => $vl_String, 'date' => DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']), 'status_string' => StatusUtils::getPaymentStatus($status), 'id' => 1, 'id_entidade' => $recordset['registros'][$i]['id_entidade']);                        
                    }
                    
                    $id_entidade = $recordset['registros'][$i]['id_entidade'];
                    //echo $recordset['registros'][$i]['id_entidade'] . " " . $recordset['registros'][$i]['valor'] . "</br>";
                    
                    
                    $recordset['registros'][$i]['valor_liquido'] = MathUtils::getPercentageValue($recordset['registros'][$i]['valor'], $recordset['registros'][$i]['comissao']);
                    
                    //SUM - Total final
                    if($recordset['registros'][$i]['status'] == 0) $total_final_aberto = $total_final_aberto + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    if($recordset['registros'][$i]['status'] == 1) $total_final_fechado = $total_final_fechado + ($recordset['registros'][$i]['valor_liquido'] - $recordset['registros'][$i]['desconto']);
                    $total_final = $total_final + ($recordset['registros'][$i]['valor'] + $valor);
                }
            }
            
          
            
            $final['total_final_aberto'] = CurrencyUtils::getPriceFormat($total_final_aberto, true, 0);
            $final['total_final_fechado'] = CurrencyUtils::getPriceFormat($total_final_fechado, true, 0);
            $final['total_final'] = CurrencyUtils::getPriceFormat($total_final, true, 0);
            
            //var_dump($final);
            return $final;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getAllContent() ". $e->getMessage();
        }
    }
    
    /*
     * 
     * Get payments by id entity
     * 
     * @params array
     */
    public function getContentByIdEntidade($data = array(), $session = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $year = $session['year_financeiro'];
        $month = $session['month_financeiro'];
        
        $month_prev = $month - 1; $year_prev = $year;           
        if($month_prev < 0){ $month_prev = "12"; $year_prev = $year - 1;} 
        if($month_prev < 10) $month_prev = "0" . $month_prev;
        
        try{
            $sql = "SELECT * FROM erp_financeiro WHERE id_categoria = {$data['id_categoria']} AND id_entidade = {$data['id_entidade']}";
            if($session) $sql = "SELECT * FROM erp_financeiro WHERE id_categoria = {$data['id_categoria']} AND id_entidade = {$data['id_entidade']} AND (((area = 1 OR area = 4 OR area = 3) AND date >= '$year_prev-$month_prev-01' AND date <= '$year_prev-$month_prev-31 23:59:59') OR (date >= '$year-$month-01' AND date <= '$year-$month-31' AND (area != 1 AND area != 4 AND area != 3)))"; //ORDER BY date ASC
                
            $command = Yii::app()->db->createCommand($sql);            
            $recordset['registros'] = $command->queryAll();
            
            if($recordset['registros']){
                $valor = $desconto = 0; $total = 0;
                for($i = 0;$i<count($recordset['registros']); $i++){
                    
                    //PierMail
                    if($recordset['registros'][$i]['area'] == 4){
                        if($recordset['registros'][$i]['nr_parcelas'] > 10)$recordset['registros'][$i]['valor'] = (ceil($recordset['registros'][$i]['nr_parcelas'] / 1000) * Yii::app()->params['dolar']);
                    }
                    
                    $recordset['registros'][$i]['data_string'] =  DateTimeUtils::getDateFormateNoTimeStamp($recordset['registros'][$i]['date']);
                    $recordset['registros'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['valor'], true, false);
                    $recordset['registros'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['registros'][$i]['desconto'], true, false);
                    $recordset['registros'][$i]['total_string'] = CurrencyUtils::getPriceFormat(($recordset['registros'][$i]['valor'] - $recordset['registros'][$i]['desconto']), true, false);
                    $recordset['registros'][$i]['status_string'] =StatusUtils::getPaymentStatus($recordset['registros'][$i]['status']);
                    
                    //SUM
                    $valor = $valor + $recordset['registros'][$i]['valor'];
                    $desconto = $desconto + $recordset['registros'][$i]['desconto'];
                    $total =  $valor - $desconto;
                } 
                
                $recordset['total_valor'] = CurrencyUtils::getPriceFormat($valor, true, false);
                $recordset['total_desconto'] = CurrencyUtils::getPriceFormat($desconto, true, false);
                $recordset['total_final'] = CurrencyUtils::getPriceFormat($total, true, false);
            }
            
            return $recordset;
            
        }catch(Exception $ex){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: FinanceiroManager - getContentByIdEntidade() ". $e->getMessage();
        }
    }
    
}
?>