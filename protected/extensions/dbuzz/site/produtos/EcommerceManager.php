<?php
/*
 * This Class is used to controll all functions related the feature Ecommerce
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */

class EcommerceManager{

   /**
    * Método para recuperar os registros da tabela em pauta
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    */
    public function getAllContent($isAdmin = false, $tipo = "produto"){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real,".
                  "cidade, pais, parcelas, unidades_current, marca, data, last_update, tipo, url";

        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE exibe_ecommerce = 1 ORDER BY id_categoria ASC";
        if(!$isAdmin)$sql = "SELECT ".$select." FROM ecommerce_produtos WHERE tipo = '$tipo' ORDER BY id_categoria ASC";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();       
            
            for($i = 0; $i < count($recordset); $i++){
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                
                $recordset[$i]['preco_real_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);            
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                
                for($f = 0; $f < 6; $f++){                                          
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }
            }  
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR " . $e->getMessage();
        }   
        
    }

    /**
     * Método para recuperar um registro organizados por id
     * Neste método recebe o nome da view que será exibido os dados
     * pode ser editar, detalhes entre outros.
     * 
     *
     * @param number
     * @param string
     *
    */
    public function getContentById($id, $view, $id_variante = false){        
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select  = "id, id_categoria, descricao, data, nome, keywords, preco, status, parcelas, unidades_current, embrulho, ";
        $select .= "preco_real, date_start, date_end, marca, entrega, cidade, pais, id_pedido, tipo, url, frete_gratis, descricao_resumo";

        $sql = "SELECT $select FROM ecommerce_produtos WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();          
            $foto = ProdutosUtils::getProdutoImageAttribute($recordset['id'], false);            
            
            for($i = 0; $i < 6; $i++ ){                
                if($foto[$i]){                  
                    $recordset['image_' . $i] = $foto[$i];              
                }else{                   
                    $recordset['image_' . $i] = "missing_50x50.jpg";                  
                }
            } 
            
            $recordset['status'] = ProdutosUtils::getStatusImage($recordset['status']);         
            $recordset['valores'] = ProdutosUtils::getCalculatesValues($recordset['preco_real'], $recordset['parcelas'], 0);           
            $recordset['preco_real_prefix'] = CurrencyUtils::getPriceFormat($recordset['preco_real'], true); 
            $recordset['preco_real_float'] = CurrencyUtils::getFloatFormat($recordset['preco_real']);
            $recordset['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset['valores']['parcel'], true);           
            
            //Verifica onde será exibido o resultado e formata o resultado
            if($view == 'detalhes'){           
                $recordset['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset['date_start']);  
                $recordset['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset['date_end']);
            }else{
                $recordset['date_start'] = DateTimeUtils::getDateFormatCommon($recordset['date_start']);
                $recordset['date_end'] = DateTimeUtils::getDateFormatCommon($recordset['date_end']);
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados por
     * categoria
     *
     * @param number
     *
    */
    public function getContentByCat($id_cat){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        $session = MethodUtils::getSessionData();
        
        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real,".
                  "cidade, pais, parcelas, unidades_current, marca, data, last_update, tipo, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE exibe_ecommerce = 1 AND  id_categoria = $id_cat";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                
                $recordset[$i]['preco_real_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);            
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                $recordset[$i]['purchased'] = UserSupportUtils::verifyPurchasedItem("modulo", "inteiro", $recordset[$i]['id'], $session['id']);
               
                for($f = 0; $f < 6; $f++){                                          
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }
            }
                
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados 
     * pelo tipo e id, inicalmente este é exclusivo ao cliente 1,2,3 viajá
     *
     * @param number
     *
    */
    public function getContentByIdType($id, $type){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');

        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, url";
        
        switch($type){
            case "users":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_user = $id ";
                break;
            
            case "pedido":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_pedido = $id ";
                break;
            
            case "categoria":
                $sql = "SELECT $select FROM ecommerce_produtos WHERE id_categoria = $id AND tipo = 'produto' AND (exibe_produtos = 1)";
                break;
            
            case "cursos":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE tipo = 'produto' OR tipo = 'programa' ORDER BY id_categoria ASC";
                break;
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['preco_real'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function getContentByIdAttribute($attribute, $id){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
   
        $select = "A.id, A.id_categoria, A.descricao, A.descricao_resumo, A.date_start, A.date_end, A.nome, A.preco_real, A.cidade, A.frete_gratis, " .
                  "A.pais, A.parcelas, A.unidades_current, A.marca, A.data, A.tipo, A.lancamento, A.promocao, A.url, B.id_produto, B.id AS id_estoque";
        $sql = "SELECT * FROM (SELECT ".$select." FROM ecommerce_produtos AS A INNER JOIN ecommerce_estoque as B ON A.id = B.id_produto WHERE A.$attribute = 1 AND A.id_categoria = $id AND B.qtd > 0 ORDER BY B.n_index ASC) AS T GROUP BY id_produto";
        
        
        $type_price = ProdutosUtils::checkKindOfPrice();
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true, $type_price);
                $recordset[$i]['promocao'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['tipo'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria']);
                $recordset[$i]['valores'] = ProdutosUtils::getCalculatesValues($recordset[$i]['preco_real'], $recordset[$i]['parcelas'], 0);                                 
                $recordset[$i]['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset[$i]['valores']['parcel'], true);
                (isset($recordset[$i]['id_estoque'])) ? $recordset[$i]['id_variante'] = $recordset[$i]['id_estoque'] : $recordset[$i]['id_variante'] = 0;
                
                if(Yii::app()->params['ramo'] == "ecommerce"){
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id'], $recordset[$i]['id_variante']);
                    $recordset[$i]['categoria_string'] = ProdutosUtils::getCategoriaLabel($recordset[$i]['id_categoria']);
                }else{
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                }   
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getContentByIdAttribute() '. $e->getMessage();
        }
    }
    
    /**
     * Método para abrir um pedido de compra
     * Se status for diferente de 0 a compra foi concluida.
     * E o carrinho é reiniciado, isso não garante o pagamento.
     * 
     * Apenas abre e fecha os carrinhos
     *
     * @param array
     *
    */
    public function checkIfExistPedido($referente, $id_user, $tipo = 0){

        $sql = "SELECT id FROM ecommerce_pedidos WHERE tipo = $tipo AND referente = '$referente' AND id_user = $id_user";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            
            if(!$recordset) return false;
            return $recordset['id'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: EcommerceManager - checkIfExistPedido() " . $e->getMessage();
        }
    }

    /**
     * Método para abrir um pedido de compra
     * Se status for diferente de 0 a compra foi concluida.
     * E o carrinho é reiniciado, isso não garante o pagamento.
     * 
     * Apenas abre e fecha os carrinhos
     *
     * @param array
     *
    */
    public function createFirstItemCart($data){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $select = "data, last_update, ip";
        $values = $data['data']."', '".$data['last_update']."', '".$ip;
        
        $sql = "INSERT INTO ecommerce_pedidos (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();            
            
            $id_pedido = Yii::app()->db->getLastInsertID();
            
            $name_id = StoreUtils::getTypePedidoSession($data['tipo'], false);            
            $setData = MethodUtils::setSessionData($name_id, $id_pedido);
        
            return $id_pedido;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: EcommerceManager - createFirstItemCart() " . $e->getMessage();
        }
    }
    
    /**
     * Método para abrir um pedido de compra
     * Se status for diferente de 0 a compra foi concluida.
     * E o carrinho é reiniciado, isso não garante o pagamento.
     * 
     * Apenas abre e fecha os carrinhos
     *
     * @param array
     *
    */
    public function createFirstItemCartSpecial($data, $tipo = 0, $referente = '', $id_user = 0){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $select = "data, last_update, ip, id_user, tipo, referente";
        $values = "'{$data['data']}', '{$data['last_update']}', '{$ip}', $id_user, $tipo, '$referente'";
        
        $sql = "INSERT INTO ecommerce_pedidos ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();            
            
            $id_pedido = Yii::app()->db->getLastInsertID();
            
            $name_id = StoreUtils::getTypePedidoSession($data['tipo'], false);            
            $setData = MethodUtils::setSessionData($name_id, $id_pedido);
        
            return $id_pedido;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: EcommerceManager - createFirstItemCart() " . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar um item na lista de itens do carrinho de 
     * compras
     *
     * @param array
     *
    */
    public function addItemShoppingCart($data){
        $date = date("Y-m-d H:i:s");
        $select = "id_pedido, id_item, tipo, nome, amount, valor, valor_total, id_variante, id_user, mes, data";
        
        $values  = "{$data['id_pedido']}, {$data['id_item']}, '{$data['tipo']}',";
        $values .= "'{$data['nome']}', {$data['amount']},'{$data['valor_unid']}', '{$data['valor']}', ";
        $values .= "'{$data['id_variante']}', '{$data['id_user']}', '{$data['mes']}', '$date'";
        
        $sql =  "INSERT INTO ecommerce_carrinho ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();            
        
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - addItemShoppingCart() " . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os items na lista da itens do carrinho de 
     * compras
     *
     * @param array
     *
    */
    public function getItemsShoppingCart($id_pedido, $tipo = 'produto'){

        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        $isCartOpen = StoreUtils::checkCartStatus($id_pedido, 0);
      
        if($tipo == "servicos" || $tipo == "hospedagem" || $tipo == "desenvolvimento") $tipo = "todos";
        
        $select = "id, id_pedido, id_item, tipo, nome, amount, valor";
        $sql = "SELECT ".$select." FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND tipo = '$tipo'";
        if($tipo == "produto" || $tipo == "elearn" || $tipo == "embrulho" || $tipo == "transporte") $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND (tipo = 'produto' OR tipo ='embrulho' OR tipo = 'transporte' OR tipo = 'modulo' OR tipo = 'elearn')";
        if($tipo == "banner" || $tipo == "creditos" || $tipo == "business_page"){ $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND tipo = '$tipo'";}
        if($tipo == "todos")$sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido";
        //$sql = "SELECT ".$select." FROM ecommerce_carrinho sc INNER JOIN ecommerce_pedidos ord ON sc.id_pedido = $id_pedido AND sc.tipo = '$tipo' AND ord.status = 0";

        try{
            if($isCartOpen){
                
                $command = Yii::app()->db->createCommand($sql);
                $recordset = $command->queryAll();                       

                if(count($recordset) > 0){
                    $total = 0;
                    for($i = 0; $i < count($recordset); $i++){ 
                        $recordset[$i]['valor_unid_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'] , true);
                        $recordset[$i]['valor_subtotal'] = $recordset[$i]['valor'] * $recordset[$i]['amount'];
                        $recordset[$i]['valor_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor_subtotal'], true); 
                        $total = $total + $recordset[$i]['valor_subtotal'];
                    }
                    $recordset[0]['total'] = CurrencyUtils::getPriceFormat($total);
                    $recordset[0]['total_no_prefix'] = $total;
                }else{
                    $recordset = false;
                }
                
            }else{
                $recordset = false;
            }
            //var_dump($recordset);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - getItemShoppingCart() " . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os items na lista da itens do carrinho de 
     * compras
     *
     * @param array
     *
    */
    public function getFullItemsPayment($id_pedido, $tipo = "todos"){
        
       if($id_pedido == "") $id_pedido = 0; 
        
       Yii::import('application.extensions.utils.CurrencyUtils');
       
       $select = "id, tipo, id_pedido, id_variante, id_item, nome, amount, valor";
       $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND (tipo = 'produto' OR tipo = 'elearn' OR tipo = 'embrulho' OR tipo = 'transporte' OR tipo = 'modulo' OR tipo = 'evento')";
       if($tipo == "todos" || $tipo == "cobranca" || $tipo == "recuperacao") $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido ";
       if($tipo == "banner" || $tipo == "creditos" || $tipo == "business_page"){ $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND tipo = '$tipo'";}
        
       try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            if($recordset){
                $total = 0;
                $recordset[0]['embrulho'] = false;
                $recordset[0]['transporte'] = false;
                
                for($i = 0; $i < count($recordset); $i++){

                    if($recordset[$i]['tipo'] == "produto" || $recordset[$i]['tipo'] == "modulo" || $recordset[$i]['tipo'] == "elearn" || $recordset[$i]['tipo'] == "simples"){
                        ($recordset[$i]['id_variante'] == 0 ) ? $id_variante = false : $id_variante = $recordset[$i]['id_variante'];
                        $recordset[$i]['product'] = $this->getContentById($recordset[$i]['id_item'], "detalhes", $id_variante);
                        $recordset[$i]['product']['preco_real'] = CurrencyUtils::getFloatFormat($recordset[$i]['valor']);
                        $recordset[$i]['product']['preco_real_prefix'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor']);
                        $soma_values = $recordset[$i]['product']['preco_real'] * $recordset[$i]['amount'];
                        $recordset[$i]['valor_qtd'] = CurrencyUtils::getPriceFormat($soma_values);
                        $recordset[$i]['debug'] = $recordset[$i]['tipo'];
                        $recordset[0]['embrulho_valor'] = $recordset[$i]['product']['embrulho'];
                        $recordset[0]['embrulho_valor_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['product']['embrulho']);
                        $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true, false);
                        
                        $total = $total + $soma_values;
                    }                   
                }
                
                $recordset[0]['total'] = CurrencyUtils::getPriceFormat($total);
                $recordset[0]['total_no_prefix'] = $total;
                
            }else{
                $recordset = false;
            }
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: EcommerceManager - getFullItemsPayment() " . $e->getMessage();
        }
    }
    
    /**
     * Método para remover um determinado registro
     *
     * @param number
     *
    */
    public function removeFromCart($id){

        $sql = "DELETE FROM ecommerce_carrinho WHERE id = $id";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - removeItemFromCart() " . $e->getMessage();
        }
    }
    
    /**
     * Método para remover um determinado registro
     *
     * @param number
     *
    */
    public function removeFromCartByType($id_user, $id_pedido, $type){

        $sql = "DELETE FROM ecommerce_carrinho WHERE id_user = $id_user AND id_pedido = $id_pedido AND tipo = '$type'";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - removeFromCartByType() " . $e->getMessage();
        }
    }
    
    /**
     * Método para remover todos os registros via id_pedido e id_user
     *
     * @param number
     *
    */
    public function removeAllFromCartByIdPedido($id_pedido, $id_user){

        $sql = "DELETE FROM ecommerce_carrinho WHERE id_user = $id_user AND id_pedido = $id_pedido";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - removeFromCartByType() " . $e->getMessage();
        }
    }
    
    /**
     * Método para remover todos os items do carrinho de compra
     *
     * @param number
     *
    */
    public function clearShoppingCartList($id){

        $sql = "DELETE FROM ecommerce_carrinho WHERE id_pedido = $id";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - clearShoppingCartList() " . $e->getMessage();
        }
    }

    /**
     * Método para remover um determinado registro
     *
     * @param number
     *
    */
    public function removeContent($id){

        $sql = "DELETE FROM ecommerce_produtos WHERE id = $id";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo "Produto removido com sucesso";

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - removeContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o status do produto
     *
     * @param array
     *
    */
    public function updateStatus($data){
        
        $status = $data['status'];
        $id_produto = $data['id_produto'];

        $sql = "UPDATE ecommerce_produtos SET status = '$status' WHERE id = $id_produto";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return Yii::t('commonForm', 'product_status_updated');

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: EcommerceManager - updateStatus() " . $e->getMessage();
        } 
    }
    
    /**
     * Método para obter as compras realizadas pelos usuários.
     * Possivelmente esse método é diferente do usado no Admin. 
     *
     * @param array
     *
    */
    public function getShoppingData($id_user, $tipo= "", $isAdministrator = false){
        
        $session = MethodUtils::getSessionData();
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.PedidosUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        //If it's a special business
        if(defined('Settings::PIER_ELEARN') && Settings::PIER_ELEARN){
            Yii::import('application.extensions.utils.lib.MathUtils');
            Yii::import('application.extensions.utils.special.PesquisaUtils');
            Yii::import('application.extensions.utils.ElearnUtils');
            Yii::import('application.extensions.dbuzz.site.special.PesquisaManager');
            $pesquisaHandler = new PesquisaManager();
        } 
        
        $select = "id, nome, id_pedido, tipo, descricao, last_update, valor, status, cod_pagamento, data";
        $sql = "SELECT $select FROM ecommerce_pagamentos WHERE id_user = $id_user ";
        if($tipo != "") $sql = "SELECT $select FROM ecommerce_pagamentos WHERE id_user = $id_user AND tipo = '$tipo'";
        if($isAdministrator) $sql = "SELECT $select FROM ecommerce_pagamentos WHERE id_user = $id_user AND tipo = '$tipo'";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){                  
                    
                    $recordset[$i]['status_string'] = ProdutosUtils::getStatusPayment($recordset[$i]['status']);
                    $recordset[$i]['valor'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                    $recordset[$i]['string_pedido'] = $recordset[$i]['id_pedido'];
                    $recordset[$i]['id_pedido'] = PedidosUtils::getIdPedido($recordset[$i]['id_pedido']);
                    
   
                    //This method uses the bought (ecommerce_carrinho) items to seek its information
                    if(defined('Settings::PIER_ELEARN') && Settings::PIER_ELEARN){
                        
                        $items = ProdutosUtils::getCartItems($recordset[$i]['id_pedido'], 'elearn');
                        
                        if($items){
                            for($p = 0; $p < count($items); $p++){
                                
                                $recordset[$i]['cursos'][$p]['avaliacao'] = $pesquisaHandler->getPesquisa($items[$p]['id_item'], 1);
                                $recordset[$i]['cursos'][$p]['recuperacao'] = $pesquisaHandler->getPesquisa($items[$p]['id_item'], 2);
                                
                                //var_dump($recordset[$i]['cursos'][$p]['avaliacao']);
                                
                                if($recordset[$i]['cursos'][$p]['avaliacao']){$id_avaliacao = $recordset[$i]['cursos'][$p]['avaliacao']['id'];}else{$id_avaliacao =0;}
                                if($recordset[$i]['cursos'][$p]['recuperacao']){$id_recuperacao = $recordset[$i]['cursos'][$p]['recuperacao']['id'];}else{$id_recuperacao =0;}
                                
                                $recordset[$i]['cursos'][$p]['prova'] = $pesquisaHandler->getParticipantById($items[$p]['id_item'], $id_avaliacao, $id_user);                                
                                
                                $recordset[$i]['cursos'][$p]['produto'] = ProdutosUtils::getProdutoInformation($items[$p]['id_item']);                                
                                
                                if(isset($recordset[$i]['cursos'][$p]['produto'])){
                                    $recordset[$i]['cursos'][$p]['progress'] = MathUtils::getProgressBar($items[$p]['extra'], DateTimeUtils::transformHourToMinutes($recordset[$i]['cursos'][$p]['produto']['unidades_min']));
                                    $recordset[$i]['cursos'][$p]['extra'] = ElearnUtils::getExtraResources($recordset[$i]['cursos'][$p]['produto']['id']);
                                }else{
                                    $recordset[$i]['cursos'][$p]['progress'] = 0;                                     
                                }

                                //Find the linked programs
                                //if($recordset[$i]['cursos'][$p]['produto']['tipo'] == "modular") $recordset[$i]['cursos'][$p]['linked'] = ProdutosUtils::getProdutoInformation($recordset[$i]['cursos'][$p]['produto']['id'], 'id_master', true);
                                if(isset($recordset[$i]['cursos'][$p]['produto']) && $recordset[$i]['cursos'][$p]['produto']['tipo'] == "modular") $recordset[$i]['cursos'][$p]['linked'] = StoreUtils::getItemsCart($recordset[$i]['id_pedido'], 'programa', $recordset[$i]['cursos'][$p]['produto']['id']);
                                
                                if(isset($recordset[$i]['cursos'][$p]['id'])){
                                    
                                    //Verifica se tem recuperação também 
                                    if(isset($recordset[$i]['cursos'][$p]['produto']) && $recordset[$i]['cursos'][$p]['produto']['tipo'] != "modular") $recordset[$i]['cursos'][$p]['prova'] = PesquisaUtils::getInfoAvaliation($recordset[$i]['cursos'][$p]['id'], $recordset[$i]['cursos'][$p]['produto']['id'], true);
                                    if(isset($recordset[$i]['cursos'][$p]['produto']) && $recordset[$i]['cursos'][$p]['produto']['tipo'] == "modular") $recordset[$i]['cursos'][$p]['prova'] = PesquisaUtils::getModularAverage($recordset[$i]['cursos'][$p]['produto']['id'], $session['id']);
                                    
                                    //Find the linked programs attributes
                                    if(isset($recordset[$i]['cursos'][$p]['linked'])){if(count($recordset[$i]['cursos'][$p]['linked']) > 0){ for($v = 0; $v < count($recordset[$i]['cursos'][$p]['linked']); $v++){

                                        //Verifica se já tem a referência no carrinho de compras
                                        if(isset($recordset[$i]['cursos'][$p]['linked'][$v]['id_variante'])){
                                        $recordset[$i]['cursos'][$p]['linked'][$v]['produto'] = ProdutosUtils::getProdutoInformation($recordset[$i]['cursos'][$p]['linked'][$v]['id_variante']);
                                        $recordset[$i]['cursos'][$p]['linked'][$v]['attr'] = $pesquisaHandler->getPesquisa($recordset[$i]['cursos'][$p]['linked'][$v]['id_variante']);

                                        $recordset[$i]['cursos'][$p]['linked'][$v]['prova'] = PesquisaUtils::getInfoAvaliation($recordset[$i]['cursos'][$p]['linked'][$v]['attr']['id'], $recordset[$i]['cursos'][$p]['linked'][$v]['id_variante'], true); 
                                        $recordset[$i]['cursos'][$p]['linked'][$v]['progress'] = MathUtils::getProgressBar($recordset[$i]['cursos'][$p]['linked'][$v]['extra'], DateTimeUtils::transformHourToMinutes($recordset[$i]['cursos'][$p]['linked'][$v]['produto']['unidades_min']));
                                        }
                                    }}}

                                }
                            }
                        }
                    }
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
             echo "ERROR: EcommerceManager - getShoppingData() " . $e->getMessage();
        }
    }
}
?>