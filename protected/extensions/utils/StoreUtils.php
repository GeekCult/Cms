<?php
/* 
 * This class contains common util functions regarding store 
 * and ecommerce, such as purchases and services. 
 * 
 */

class StoreUtils {

    /**
     * Change status and some changes into item payed
     *
     */
    public static function itemsManager($data){
        
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $select = "id, id_item, amount, tipo, valor, id_variante, id_user";
        $sql = "SELECT ".$select." FROM ecommerce_carrinho WHERE id_pedido = ".$data['id_pedido']."";
       
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            $i = 0;
            if($recordset){
                
                foreach($recordset as $values){
                    if($values['tipo'] == "banner"){
                        $bannerStatus = BannersUtils::setPaidItemAttributes($data, $values);
                    }
                    if($values['tipo'] == "produto"){
                        $produtoStatus = ProdutosUtils::updateInventory($data, $values);
                    }
                    if($values['tipo'] == "creditos"){
                        $creditsStatus = UserUtils::setPurchasedCreditsAttributes($data, $values);
                    }
                    if($values['tipo'] == "business_page"){
                        $creditsStatus = UserUtils::setBusinessPageCredits($data, $values);
                    }
                    if($values['tipo'] == "cobranca"){
                        $creditsStatus = UserUtils::setOrderPayment($data, $values);
                    }
                    if($values['tipo'] == "modulo"){
                        $creditsStatus = UserUtils::setAttribute("modulo", $values['id_item'], "inteiro", $values['id_user']);
                    }
                    $i++;
                }
                //echo $i;
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - itemsManager() '. $e->getMessage();
        }
        
        return $data['id_pedido'];
    }
    
    /**
     * Change cart status from ecommerce_carrinho
     * Se status for diferente de 0 a compra foi concluida.
     * E o carrinho é reiniciado.
     *
     */
    public static function shoppingCartManager($data){ 
        
        Yii::import('application.extensions.utils.StoreUtils');

        $values  = "status = " . $data['status'] ."";        
        if($data['status'] == 3){$values .= ", exibe = 1";}
        
        $sql = "UPDATE ecommerce_pedidos SET ". $values ." WHERE id = ". $data['id'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $name_id = StoreUtils::getTypePedidoSession("", false);
            $session = MethodUtils::setSessionData($name_id, "");
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: StoreUtils - shoppingCartManager() '. $e->getMessage();
        }
    }
    
    /**
     * Check cart status
     * 
     * @param number
     *
     */
    public static function checkCartStatus($id_cart, $status){ 

        $sql = "SELECT id FROM ecommerce_pedidos WHERE id = $id_cart AND status = $status";
        
        try{
            if($id_cart != ""){
                $command = Yii::app()->db->createCommand($sql);
                $recordset = $command->queryRow();
            }else{
                $recordset = false;  
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - checkCartStatus() ' . $e->getMessage();
        }
    }
    
    /**
     * Returns the type of id_pedido session
     * 
     * @param string
     *
     */
    public static function getTypePedidoSession($tipo = "", $choice = true){
        
        $session = MethodUtils::getSessionData();
        $result = array();
        
        switch($tipo){
            case "produto_no_working":
                $result[0] = $session['PP_Id_Pedido'];
                $result[1] = 'PP_Id_Pedido';
                break;
            case "banner_no_working":
                $result[0] = $session['PP_Id_Banner'];
                $result[1] = 'PP_Id_Banner';
                break;
            case "business_no_working":
                $result[0] = $session['PP_Id_Business'];
                $result[1] = 'PP_Id_Business';
                break;
            default:
                $result[0] = $session['PP_Id_Pedido'];
                $result[1] = 'PP_Id_Pedido';
                break;
        }
        
        //Depends on choice return something diferent
        if($choice){
            return $result[0];
        }else{
            return $result[1];
        }
    }
    
    /**
     * Returns the values from the calcules between price, parcels
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function getItemsCart($id_pedido, $tipo = "", $id_item = "", $id_user = ""){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        if($id_pedido == "") $id_pedido = 0;
        
        $select = "id, nome, amount, valor, id_item, id_variante, extra";
        $sql = "SELECT ".$select.", SUM(amount), SUM(valor) FROM ecommerce_carrinho WHERE id_pedido = ".$id_pedido."";
        
        //More options
        if($tipo != "")$sql = "SELECT ".$select." FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND tipo = '$tipo' AND id_item = $id_item";
        if($id_user != "") $sql = "SELECT ".$select." FROM ecommerce_carrinho WHERE id_user = $id_user AND tipo = '$tipo' AND id_variante = $id_item";

        try{           
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['valor_format'] = CurrencyUtils::getPriceFormat($recordset[0]['valor'], true, false);
                }
                
                if($tipo == ""){
                    $recordset['valor_format'] = CurrencyUtils::getPriceFormat($recordset[0]['SUM(valor)'], true, false);
                    $recordset['total_format'] = CurrencyUtils::getPriceFormat($recordset[0]['SUM(valor)'], true, false);
                }
                
            }else{
                if($tipo != "programa"){
                    $recordset['valor_format'] = CurrencyUtils::getPriceFormat(0, true, false);
                    $recordset['total_format'] = CurrencyUtils::getPriceFormat(0, true, false);
                }else{
                    return false;
                }
            }         
          
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getItemsCart() '. $e->getMessage();
        }
    }
    
    /**
     * Returns the values from a record in ecommerce_carrinho
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function getItemCartSimple($id_pedido, $tipo = "produto", $isVariante = false, $isAll = false){
        
        $select = "id, nome, amount, valor, id_item, tipo";
        $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND tipo = '$tipo' OR tipo = 'elearn'";
        if($isVariante) $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido AND id_variante = $isVariante";
        if(!$isVariante && $tipo == 'all') $sql = "SELECT $select FROM ecommerce_carrinho WHERE id_pedido = $id_pedido ";

        try{           
            $command = Yii::app()->db->createCommand($sql);
            if(!$isAll) $recordset = $command->queryRow();
            if( $isAll) $recordset = $command->queryAll();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getItemCartSimple() '. $e->getMessage();
        }
    }
    
    /**
     * Sets a Ref id do pedido, algo como: SC_123_34
     * Onde SC é shopping cart, o primeiro id é do pedido e o segundo id
     * é do carrinho.
     * 
     * @param number
     * @param string
     *
     */
    public static function setRefPedido($id_pedido, $ref_pedido){
        
        $values  = "id_pedido = '" . $ref_pedido ."'";
        $sql =  "UPDATE ecommerce_pagamentos SET ". $values ." WHERE id = " .$id_pedido. "";   

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();   
            return true;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: StoreUtils - setRefPedido() '. $e->getMessage();
        }
    }
    
    /**
     * It saves the url callback from the payment gateway 
     * 
     * @param number
     * @param string
     *
     */
    public static function saveUrlPagamento($url, $id_pagamento){
        
        $values  = "url = '" . $url ."'";
        $sql =  "UPDATE ecommerce_pagamentos SET ". $values ." WHERE id = " .$id_pagamento. "";   

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();   
            return true;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: StoreUtils - saveUrlPayment() '. $e->getMessage();
        }
    }
    
    /**
     * Gets the gateway payment.
     * 
     * @param string
     *
     */
    public static function getGateWayPayment($tipo){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $result = array();

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        $result['email_gateway'] = $pA->recuperar("email_" . $tipo, "texto");
        $result['token_gateway'] = $pA->recuperar("token_" . $tipo, "texto");

        
        return $result;
    }
    
    /**
     * Get categories items.
     * 
     * @param number
     *
     */
    public static function getCategoriasByValue($value, $field = 'categoria_url', $type = 'categorias', $callback = false){
  
        if($type == 'produtos') $sql = "SELECT id, url, nome FROM ecommerce_produtos WHERE $field = '$value' AND (tipo = 'produto' OR tipo = 'elearn' OR tipo = 'modular')";
        if($type == 'categorias') $sql = "SELECT id_categoria, categoria_label, categoria_url FROM ecommerce_categorias WHERE (tipo = 0 OR tipo = 3) AND $field = '$value'";
        if($type == 'subcategorias') $sql = "SELECT id_subcategoria, subcategoria_label, subcategoria_url FROM ecommerce_subcategorias WHERE $field = '$value' AND (tipo = 0 OR tipo = 3)";
        if($type == 'subitem') $sql = "SELECT id_subitem, subitem_label, subitem_url FROM ecommerce_subitems WHERE $field = '$value' AND (tipo = 0 OR tipo = 3)";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryRow();
            
            if($callback) return $recordset[$callback];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getCategoriasByValue() '.$e->getMessage();
        }
    }
    
    /**
     * Método econtrar o id de uma determinada categoria, subcategoria,
     * subitem ou id
     *
     * @param number
     *
    */
    public static function getCategoriasId($categoria, $sub, $subitem){
        
        if($sub == "" && $subitem == ""){
            $select = "id_categoria, categoria_label, categoria_url";
            $sql = "SELECT $select FROM ecommerce_categorias WHERE categoria_url = '$categoria' AND (tipo = 0 OR tipo = 3)";
        }
        
        if($sub != "" && $subitem == ""){
            $select = "id_categoria, id_subcategoria, subcategoria_label, subcategoria_url";
            $sql = "SELECT $select FROM ecommerce_subcategorias WHERE subcategoria_url = '$sub' AND (tipo = 0 OR tipo = 3)";
        }
        
        if($sub != "" && $subitem != ""){
            $select = "id_categoria, id_subcategoria, subitem_label, id_subitem, subitem_url";
            $sql = "SELECT $select FROM ecommerce_subitems WHERE subitem_url = '$subitem' AND (tipo = 0 OR tipo = 3)";
        }

        try{
            
            //If strange valus
            if(!isset($sql)) return false;            
            
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();  

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCategoriasId() ' . $e->getMessage();
        }
    }
    
    /**
     * Get subcategories items.
     * 
     * @param number
     *
     */
    public static function getSubCategoriaItemsById($id_categoria){
        
        Yii::import('application.extensions.utils.StoreUtils');
        
        $select  = "id_categoria, id_subcategoria, subcategoria_label, subcategoria_url";        
        $sql = "SELECT ".$select." FROM ecommerce_subcategorias WHERE id_categoria = $id_categoria";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['menu_subitem'] = StoreUtils::getSubItemsByIdSubCategoria($recordset[$i]['id_subcategoria']);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getSubCategoriaItemById() '.$e->getMessage();
        }
    }
    
    /**
     * Get subcategories items.
     * 
     * @param number
     *
     */
    public static function getSubItemsByIdSubCategoria($id_subcategoria){
        
        $select  = "id_categoria, id_subcategoria, subitem_label, subitem_url";        
        $sql = "SELECT ".$select." FROM ecommerce_subitems WHERE id_subcategoria = $id_subcategoria";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getSubItemCategoria() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter as informações básicas do produto
     * 
     *
     * @param number
     *
    */
    public static function updateCarrinhoUser($id_user, $id_pedido){
        
        $values  = "id_user = " . $id_user ."";
        $sql = "UPDATE ecommerce_carrinho SET ". $values ." WHERE id_pedido = ". $id_pedido . "";  
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return 'ERROR: StoreUtils - updateCarrinhoUser() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar uma inforamção do carrinho de comprar
     * é utilizado principalmente para adicionar horas na carga horario já
     * que para listar os cursos ele usa do proprio carrinho
     * 
     *
     * @param number
     *
    */
    public static function setCarrinhoExtraValue($id_user, $id_item, $value, $field){
    
        $values  = "extra = " . $value ."";
        $sql = "UPDATE ecommerce_carrinho SET ". $values ." WHERE $field = ". $id_item . " AND id_user = $id_user";  
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - setCarrinhoExtraValue() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar uma inforamção do carrinho de comprar
     * é utilizado principalmente para adicionar horas na carga horario já
     * que para listar os cursos ele usa do proprio carrinho
     * 
     *
     * @param number
     *
    */
    public static function getItemsRelatedPayment($id_user, $id_produto, $tipo){
        
        Yii::import('application.extensions.utils.StoreUtils');
    
        $select  = "id_pedido, status";        
        $sql = "SELECT ".$select." FROM ecommerce_pagamentos WHERE id_user = $id_user AND extra1 = $id_produto AND tipo = '$tipo'";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            //Deve ser utilizado um para cada item necessário
            if($recordset && $tipo == 'recuperacao'){
                Yii::import('application.extensions.utils.special.PesquisaUtils');
                Yii::import('application.extensions.dbuzz.site.special.PesquisaManager');
                $pesquisaHandler = new PesquisaManager();
                
                if($recordset){
                    foreach($recordset as $values){
                        
                        //Get items shopping cart
                        $id_pedido = explode("_", $values['id_pedido']);
                        
                        $itemsCarrinho = StoreUtils::getItemsCart($id_pedido[2], $tipo, $id_produto);
                        
                        //Get pesquisa data: Tem informações do produto nesta variavel data também
                        isset($itemsCarrinho[0]['id_item']) ? $itemNr = $itemsCarrinho[0]['id_item'] : $itemNr = 0; 
                        
                        $pesquisa = array();
                        $pesquisa = $pesquisaHandler->getPesquisa($itemNr, 1);
                            
                        //Verifica se o usuário já respondeu a pesquisa ou fez a recuperação
                        isset($pesquisa['id']) ? $nrId = $pesquisa['id'] : $nrId = 0;
                        $pesquisa['participante'] = PesquisaUtils::getInfoAvaliation($nrId, $id_produto, false);
                        
                        $pesquisa['status_payment'] = $values['status'];
                        return $pesquisa;
                    }
                }
            }else {
                return false;
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getItemsRelatedPayment() '. $e->getMessage();
        }
    }
    
    /**
     * Método para criar registros no carrinho de compra do usuário
     * usado inicialmente por e-learn
     *
     * @param array
     *
    */
    public static function createRecordsShoppingCart($data, $info){
        
        Yii::import('application.extensions.utils.StoreUtils');
        
        $id_pedido = explode("_", $info['id_pedido']);
        
        $id_master = StoreUtils::getItemCartSimple($id_pedido[2]);
        
        //Verify if this record was not saved before
        $findRecord = StoreUtils::getItemCartSimple($id_pedido[2], "programa", $data['id']);
        
        $select = "nome, tipo, id_item, id_user, id_pedido, id_variante, amount, extra";
        
        $values  = $data['nome']."', '".$data['tipo']."', '".$id_master['id_item']."', '".$info['id_user']."', '";
        $values .= $id_pedido[2]."', '" . $data['id'] . "', '1', '0"; 
        
        $sql =  "INSERT INTO ecommerce_carrinho (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            
            if(!$findRecord){
                $control = $comando->execute();
                return $control;
            }else{
                return false;
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: StoreUtils - createRecordsShoppingCart() '. $e->getMessage();
        }
    }
    
    /**
     * Método ver se um item existe no ecommerce, esse metodo para ajudar com url friendly
     * ele transforma um link como /loja/detalhes/102 em /loja/curso_de_ferias
     *
     * @param string
     *
    */
    public static function getUrlFriendly($url){

        //Se tiver parametros remove
        //$url = substr($url, 0, strpos($url, "?"));
        $sql = "SELECT id FROM ecommerce_produtos WHERE url = '$url'";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryRow();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - setCarrinhoExtraValue() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados relativos ao shipping
     *
     * @param array
     *
    */
    public static function getShippingContent($id, $cep_to = '13088300'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
      
        try{
            $result['cep_origem'] = PreferencesUtils::getAttributes("cep_origem", "texto");
            $result['destino'] = $cep_to;
            $result['info'] = ProdutosUtils::getProdutoInformation($id);
            
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - getShippingContent() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados relativos a venda de produtos
     *
     * @param array
     *
    */
    public static function getVendas($month, $status = 1, $items = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month);

        try{    
            if(!$items) $sqlRowsVendas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ecommerce_pagamentos WHERE data >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND data < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND status = $status")->queryScalar();
            if( $items) {
               
                $sqlRowsVendas = Yii::app()->db->createCommand("SELECT * FROM ecommerce_pagamentos WHERE data >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND data < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND status = $status")->queryAll();
                
                if($sqlRowsVendas){
                    //for($i = 0; $i < count($sqlRowsVendas); $i++){
                        //echo $sqlRowsVendas[$i]['id_pedido'];
                    //}
                    
                    $sqlRowsVendas = count($sqlRowsVendas);
                }else{
                    $sqlRowsVendas = 0;
                }
            }
            
            return $sqlRowsVendas;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados relativos a venda de produtos em Estatísticas
     *
     * @param array
     *
    */
    public static function getItemsVendidos($month, $year, $status = 1, $items = false){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month, $year);

        try{    
            if(!$items) $sqlRowsVendas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ecommerce_pagamentos WHERE data >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND data < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND status = $status")->queryScalar();
            if( $items) {
               
                $sqlRowsVendas = Yii::app()->db->createCommand("SELECT * FROM ecommerce_pagamentos WHERE data >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND data < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND status = $status")->queryAll();
                
                if($sqlRowsVendas){
                    //for($i = 0; $i < count($sqlRowsVendas); $i++){
                        //echo $sqlRowsVendas[$i]['id_pedido'];
                    //}
                    
                    $sqlRowsVendas = count($sqlRowsVendas);
                }else{
                    $sqlRowsVendas = 0;
                }
            }
            
            return $sqlRowsVendas;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados relativos aos items adicionados ao carrinho
     * Usado em Estatísticas
     *
     * @param array
     *
    */
    public static function getItemsFromCarrinho($month, $year){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month, $year);

        try{    
            $sql ="SELECT * FROM ecommerce_carrinho WHERE data >= '{$date['year_current']}-{$date['month_current']}-01 00:00:00' AND data < '{$date['year_next']}-{$date['month_next']}-01 00:00:00'";
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para salvar os dados de rastreio
     *
     * @param array
     *
    */
    public static function saveRastreio($data){
        
        $values  = "nr_rastreio = '" . $data['nr_rastreio'] ."', nr_rastreio_transportadora = '" . $data['nr_rastreio_transportadora'] . "'";
        $sql = "UPDATE ecommerce_pagamentos SET ". $values ." WHERE id = ". $data['id'] . "";  
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - saveRastreio() '. $e->getMessage();
        }
    }
    
    /**
     * Método para salvar os dados de rastreio
     *
     * @param array
     *
    */
    public static function getPagamentoInfo($id_pagamento){
        
        $sql = "SELECT id, id_pedido, id_user, metodo_pagamento, url, status FROM ecommerce_pagamentos WHERE id = $id_pagamento";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryRow();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - getPagamentoInfo() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter as imagens do estoque
     *
     * @param number
     *
    */
    public static function getImageEstoque($id, $id_variante, $variante){
        
        $sql = "SELECT id_produto, texto FROM ecommerce_attribute WHERE (id_produto = $id AND id_variante = $id_variante) AND name='produto_VAR_$variante'";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryRow();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo  'ERROR: StoreUtils - getImagesEstoque() '. $e->getMessage();
        }
    }
    
    
    /**
     * Método para enviar o email de acompanhamento da compra
     *
     * @param number
     *
    */
    public static function sendEmailAcompanhamento($data){
        
        Yii::import('application.extensions.dbuzz.site.email.EmailEcommerceManager');
        $emailHandler = new EmailEcommerceManager();  

        $sendController = $emailHandler->submitEmail($data);
        return $sendController;
    }
    
    /**
     * Método para enviar o email de acompanhamento da compra
     *
     * @param number
     *
    */
    public static function sendEmailAcompanhamentoElearn($data){
        
        Yii::import('application.extensions.dbuzz.site.email.EmailElearnManager');
        $emailHandler = new EmailElearnManager();  

        $sendController = $emailHandler->submitEmail($data);
        return $sendController;
    }
    
    /**
     * Método para enviar o email de acompanhamento da compra
     *
     * @param number
     *
    */
    public static function sendEmailCompraRealizada($data){
        
        Yii::import('application.extensions.dbuzz.site.email.EmailEcommerceManager');
        $emailHandler = new EmailEcommerceManager();  

        $sendController = $emailHandler->submitEmailVenda($data);
        return $sendController;
    }
}
?>
