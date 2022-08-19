<?php
/*
 * This Class is used to controll all functions related the feature PurpleStore
 *
 * @author CarlosGarcia
 *
 */

class PurpleStoreManager{
    
    /**
     * Método para recuperar todos os items a venda
     *
     * @param string page
     *
    **/
    public function getAllItems($tipo, $both = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $select = "id, tipo, altura, largura, cool, titulo, descricao, thumb, valor, lancamento, promocao, date";
        $sql = "SELECT $select FROM conteudo_templates WHERE tipo = '$tipo' ORDER BY RAND()";
        if($both) $sql = "SELECT $select FROM conteudo_templates WHERE tipo IN ('bloco_pagina', 'componente_site', 'email_content', 'html_mainbanners') ORDER BY id DESC";
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                //$recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
                $recordset[$i]['promocao_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true);
                
            }
    
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar todos os items comprados de um tipo
     *
     * @param string
     *
    **/
    public function getAllPurchasedItems($tipo){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $select = "id, texto, descricao, inteiro, id_general";
        $sql = "SELECT ".$select." FROM preferencias_attribute WHERE name = '$tipo'";
        
        try{     
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['link'] = $this->getItemById($recordset[$i]['id_general'], 'link');
            }}
    
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os items a venda por categoria
     *
     * @param string page
     *
    **/
    public function getAllItemsByCategory($category){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $select = "id, tipo, altura, largura, cool, titulo, thumb, valor";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = '$category'";
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
            }
    
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar um item
     *
     * @param string
     * @param number
     *
    **/
    public function getItem($tipo, $qtd = 1, $order = 'ORDER BY RAND()'){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $select = "id, tipo, altura, largura, cool, titulo, thumb, valor, link";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = '$tipo' $order LIMIT $qtd";
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){for($i=0; $i < count($recordset); $i++)
                $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
            }
    
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar os matérias a venda
     *
     * @param string page
     *
    **/
    public function getAllArticlesByCategory($type){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        $select = "id, id_user, titulo, subtitulo, materia, data, valor";
        $sql = "SELECT ".$select." FROM conteudo_materias WHERE tipo = '$type'";
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor']);
                $recordset[$i]['user'] = UserSupportUtils::getUserPurplePierFullById($recordset[$i]['id_user']);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar o item pelo id
     *
     * @param number
     *
    **/
    public function getItemById($id, $isField = false){ 
        
        Yii::import('application.extensions.utils.DateTimeUtils');
    
        $sql = "SELECT * FROM conteudo_templates WHERE id = $id";   
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $recordset['date_string'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['date']);
            }
            
            if($isField && $recordset) return $recordset[$isField];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar o item pelo id
     *
     * @param number
     *
    **/
    public function getItemPPById($id, $type){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        
        switch($type){
            case "banner":
            case "empty html":
            case "topos":
            case "rodapes":
            case "render_partial":
            case "componente_site":
            case "bloco_pagina":
            case "bloco_email":
                $select = "id, tipo, altura, largura, cool, titulo, descricao, thumb, modelo, date, promocao, valor_total, valor";
                $sql = "SELECT ".$select." FROM conteudo_templates WHERE id = $id";
                break;
            case "article":
                $select = "id, tipo, titulo, subtitulo, materia";
                $sql = "SELECT ".$select." FROM conteudo_materias WHERE id = $id";
                break;
        }
        
        try{     
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset && ($type != 'article')) $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id'], true);

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }

    /**
     * Método para salvar os dados coletados da pesquisa 
     *
     * @param array
     *
    **/
    public function purchaseItem($item, $type){
        
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        
        $isPurchased = false;
        $session = MethodUtils::getSessionData();
        
        if($session['miniSiteUser'] != ""){$id_user = $session['miniSiteUser']; $mS = 1;}else{$id_user = 0; $mS = 0;}
        
        
        switch($type){
            case "banner":
            case "empty html":
            case "topos":
            case "rodapes":
            case "render_partial":
                $select = "nome, tipo, cool, altura, largura, modelo, titulo, id_user, minisite";        
                $values  = $item['titulo']."', '".$item['tipo']."', '".$item['cool']."', '".$item['altura']."', '".$item['largura']."', '".$item['modelo']."', '', '$id_user', '$mS";        
                $sql =  "INSERT INTO banners_data (". $select .") VALUES ('". $values . "')";
                break;
            case "article":
                $select = "titulo, subtitulo, materia, tipo, data, last_update";        
                $values  = $item['titulo']."', '".$item['subtitulo']."', '".$item['materia']."', '".$item['tipo']."', '".date("Ymd")."', '".date("Ymd");        
                $sql =  "INSERT INTO conteudo_materias (". $select .") VALUES ('". $values . "')";
                break;
            
            case "componente_site":
            case "bloco_pagina":
                if($type == "componente_site"){$isPurchased = PurpleStoreUtils::checkItemIsPurchased($item, $type);}else{$isPurchased = false;}
                $select = "id_general, plataforma, name, estampa, texto, descricao, tipo, inteiro";  
                $values  = $item['id'] ."', 'desktop', '{$item['tipo']}', '".date("Y-m-d H:i:s")."', '{$item['titulo']}', '{$item['descricao']}', '{$item['cool']}', '1";      
                $sql =  "INSERT INTO preferencias_attribute (". $select .") VALUES ('". $values . "')";
                break;
        }


        try{
            $comando = Yii::app()->db->createCommand($sql);
            (!$isPurchased) ? $control = $comando->execute() : $control = false;
            
            $id = Yii::app()->db->getLastInsertID();            
            if($type != 'article') BannersUtils::setBannersItemsLoop($item, $id);
            
            if(!$isPurchased && $session['miniSiteUser'] == '') MethodUtils::updateSettingsFile();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            $json_data = array ('ERROR'=>1,'message'=> $e->getMessage());
            echo json_encode($json_data);
        }
    }
    
    /**
     * Método para salvar: criar/editar um componente
     *      
     * @param array
     *
    */
    public function submitContent($data){

        if($data['action'] == 'novo' || $data['action'] == 'novo_template' || $data['action'] == 'nova_pagina'){$sql = "INSERT INTO conteudo_templates (titulo, descricao, tipo, modelo, valor, cool, thumb, valor_total, promocao, date, lancamento, tecnologia)  VALUES ('{$data['titulo']}', '{$data['descricao']}', '{$data['tipo']}', '{$data['modelo']}', '{$data['valor']}', '{$data['cool']}', '{$data['thumb']}','{$data['valor_total']}', '{$data['promocao']}', '{$data['date']}', '{$data['lancamento']}', 1)";
        }else{$sql = "UPDATE conteudo_templates SET titulo = '{$data['titulo']}', descricao = '{$data['descricao']}', valor = '{$data['valor']}', tipo = '{$data['tipo']}', modelo = '{$data['modelo']}', cool = '{$data['cool']}', thumb = '{$data['thumb']}', valor_total = '{$data['valor_total']}', promocao = '{$data['promocao']}', date = '{$data['date']}', lancamento = '{$data['lancamento']}' WHERE id = '{$data['id']}'";}
        
        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            //Atualiza online também
            $comando3 = Yii::app()->db3->createCommand($sql);
            $control2 = $comando3->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    } 
    
    /**
     * Método para obter as compras realizadas pelos usuários
     *      
     * @param array
     *
    */
    public function getAllPurchaseByUser($id, $month = false, $is_specific = false){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        Yii::import('application.extensions.dbuzz.admin.erp.FinanceiroManager');
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.MonthUtils');        
        
        $purplePierHandler = new PurplePierManager();
        $financeiroHandler = new FinanceiroManager();
        
        $month_prev = $month - 1; 
        $year = date('Y');
        if($month_prev <= 0){
            $month_prev = 12; 
            $year = date('Y') -1;
        }
        
        //Month string
        $recordset['month'] = MonthUtils::getMonth($month);
        $recordset['month_prev'] = MonthUtils::getMonth($month_prev);
        $date = DateTimeUtils::getMonthSequence($month_prev, $year);
        $date_prev = DateTimeUtils::getMonthSequence($month_prev, $year, 'current');

        try{   

            //Caso o PurplePier queira ver uma fatura
            if($is_specific){
                $recordset['contas']   = $financeiroHandler->getAllItemsFromDate($date['year_next'], $date['month_next'], $id, 0);//Tudo que é lançado no sistema, 
                $recordset['pedidos']  = $financeiroHandler->getAllItemsFromDate($date_prev['year_current'], $date_prev['month_current'], $id, 1);
                $recordset['pierhost'] = $financeiroHandler->getAllItemsFromDate($date['year_next'], $date['month_next'], $id, 2);
                $recordset['compras'] = $financeiroHandler->getAllItemsFromDate($date_prev['year_current'], $date_prev['month_current'], $id, 3);
                $piermail = $financeiroHandler->getAllItemsFromDate($date_prev['year_current'], $date_prev['month_current'], $id, 4);
            }
            
            //Caso o usuário queira ver a fatura dele
            if(!$is_specific){
                $recordset['contas']   = json_decode($purplePierHandler->requestClientInformation($id, C::USER_BILLS, array('year' => $date['year_next'], 'month' => $date['month_next'], 'area' => 0)), true);
                $recordset['pedidos']  = json_decode($purplePierHandler->requestClientInformation($id, C::USER_BILLS, array('year' => $date_prev['year_current'], 'month' => $date_prev['month_current'], 'area' => 1)), true);
                $recordset['pierhost'] = json_decode($purplePierHandler->requestClientInformation($id, C::USER_BILLS, array('year' => $date['year_next'], 'month' => $date['month_next'], 'area' => 2)), true);
                $recordset['compras'] = json_decode($purplePierHandler->requestClientInformation($id, C::USER_BILLS, array('year' => $date_prev['year_current'], 'month' => $date_prev['month_current'], 'area' => 3)), true);
                $piermail = json_decode($purplePierHandler->requestClientInformation($id, C::USER_BILLS, array('year' => $date_prev['year_current'], 'month' => $date_prev['month_current'], 'area' => 4)), true);
            }
            
            //Se não for encontrados registros no ERP busca na raiz
            if(!$recordset['pierhost']['items']){               
                if(!$is_specific) $hosts = $purplePierHandler->requestClientInformation($id, C::USER_HOST_VALUES);
                if( $is_specific) $hosts = $purplePierHandler->getClientAccountInfo($id);
                $recordset['pierhost'] = PurpleStoreUtils::organizeHostToInvoice($hosts);
            }
            
            //SUM PierMail sent
            $recordset['piermail'] = PurpleStoreUtils::calculatePierMail($piermail, $recordset['month_prev']);
            
            //TOTAL
            $recordset['total'] = CurrencyUtils::getPriceFormat($recordset['piermail']['total'] + $recordset['contas']['total'] + $recordset['pedidos']['total'] + $recordset['pierhost']['total'] + $recordset['compras']['total'], true, false);
            $recordset['sum'] = $recordset['piermail']['total'] + $recordset['contas']['total'] + $recordset['pedidos']['total'] + $recordset['pierhost']['total'] + $recordset['compras']['total'];
            
            return $recordset;


        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: PurpleStore - getAllPurchaseByUser() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um item comprado pelo id
     *
     * @param number
     *
    **/
    public function getItemPurchasedById($id){
    
        $sql = "SELECT * FROM erp_financeiro WHERE id = $id";   
        
        try{     
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
 
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para atualizar e editar uma compra
     *      
     * @param array
     *
    */
    public function updatePurchase($data){

        $sql = "UPDATE erp_financeiro SET titulo = '{$data['titulo']}', descricao = '{$data['descricao']}', desconto = '{$data['desconto']}' WHERE id = '{$data['id']}'";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar: criar/editar um componente
     *      
     * @param array
     *
    */
    public function getAllPurchaseByDate($day, $month, $year){

        $sql = "SELECT * FROM pierpurchases WHERE date >= '{$year}-{$month}-{$day} 00:00:01' AND date <= '{$year}-{$month}-{$day} 23:59:59' ORDER BY date ASC";

        try{           
            $valor = 0; $email_qtd = 0;
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
}

?>