<?php
/* 
 * This class contains common util functions regarding products
 * 
 */

class ProdutosUtils {

    /**
     * Converte o nome do Produto para o formato de URL
     *
     * @param String $nameStr Nome do Pool
     * @return String Nome convertido
     */
    public static function getNameReplaced($nameStr){
        $stub = strtolower($nameStr);
        $stub = str_replace(" ", "-", $stub);
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,!,@,#,$,%,^,*,(,),[,],{,},_,=,+,.");
        $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,,,,,,,,,,,");
        $stub = str_replace($search, $replace, $stub);
        return $stub;
    }

    /**
     * Returns the level for the visual demonstration of how many participants a product has
     */
    public static function getLevelMeter($max, $bought){

        if($bought == 0){
            $level = 1;
        }else{
            $level = ($bought / $max) * 100;
        }

        $levelTMP = explode(".", $level);
        return "progress_" . $levelTMP[0] . ".jpg";
    }

    public static function getActivateLimitMargin($min, $max){

        if($min == 0){
           $margin = 4;
        }else{
           $margin = ($min/$max)*200;
        }

        //to compensate for the other margins
        $margin += 8;
        if($margin<12){
            $margin = 12;
        } else if($margin > 205){
            $margin = 205;
        }
        
        return $margin;
    }

    /*
     * Returns status payment string
     * 
     *  //Código de pagamento
     *  //101 	Cartão de crédito Visa.
     *  //102 	Cartão de crédito MasterCard.
     *  //103 	Cartão de crédito American Express.
     *  //104 	Cartão de crédito Diners.
     *  //105 	Cartão de crédito Hipercard.
     *  //106 	Cartão de crédito Aura.
     *  //107 	Cartão de crédito Elo.
     *  //201 	Boleto Bradesco. *
     *  //202 	Boleto Santander.
     *  //301 	Débito online Bradesco.
     *  //302 	Débito online Itaú.
     *  //303 	Débito online Unibanco. *
     *  //304 	Débito online Banco do Brasil.
     *  //305 	Débito online Banco Real. *
     *  //306 	Débito online Banrisul.
     *  //307 	Débito online HSBC.
     *  //401 	Saldo PagSeguro.
     *  //501 	Oi Paggo.
     *
     */
    public static function getStatusPayment($id_status){
        
        $status_payment = "";
        
        switch($id_status){
            case 0:
                $status_payment = "Aberto";
                break;
            case 1:
                $status_payment = "Aguardando";
                break;
            case 2:
                $status_payment = "Em análise";
                break;
            case 3:
                $status_payment = "Efetuado";
                break;
            case 4:
                $status_payment = "Disponível";
                break;
            case 5:
                $status_payment = "Em disputa";
                break;
            case 6:
                $status_payment = "Devolvida";
                break;
            case 7:
                $status_payment = "Cancelada";
                break;
        }        
        return $status_payment; 
    }
    
    /*
     * Returns status payment string
     *  //Tipo pagamento
     *  //1 	Cartão de crédito: o comprador escolheu pagar a transação com cartão de crédito.
     *  //2 	Boleto: o comprador optou por pagar com um boleto bancário.
     *  //3 	Débito online (TEF): o comprador optou por pagar a transação com débito online de algum dos bancos conveniados.
     *  //4 	Saldo PagSeguro: o comprador optou por pagar a transação utilizando o saldo de sua conta PagSeguro.
     *  //5 	Oi Paggo: o comprador escolheu pagar sua transação através de seu celular Oi. 
     *
     */
    public static function getPaymentMethod($id_method){
        
        $status_method = "";
        
        switch($id_method){
            case 1:
                $status_method = "Cartão de crédito";
                break;
            case 2:
                $status_method = "Boleto";
                break;
            case 3:
                $status_method = "Débito online";
                break;
            case 4:
                $status_method = "Saldo PagSeguro";
                break;
            case 5:
                $status_method = "Oi Paggo";
                break;
            case 7:
                $status_method = "Depósito em conta";
                break;
        } 
        
        return $status_method; 
    }
    
    /*
     * Returns status payment string
     * 
     * //11001 	receiverEmail is required.
     * //11002 	receiverEmail invalid length: {0}
     * //11003 	receiverEmail invalid value.
     * //11004 	Currency is required.
     * //11005 	Currency invalid value: {0}
     * //11006 	redirectURL invalid length: {0}
     * //11007 	redirectURL invalid value: {0}
     * //11008 	reference invalid length: {0}
     * //11009 	senderEmail invalid length: {0}
     * //11010 	senderEmail invalid value: {0}
     * //11011 	senderName invalid length: {0}
     * //11012 	senderName invalid value: {0}
     * //11013 	senderAreaCode invalid value: {0}
     * //11014 	senderPhone invalid value: {0}
     * //11015 	ShippingType is required.
     * //11016 	shippingType invalid type: {0}
     * //11017 	shippingPostalCode invalid Value: {0}
     * //11018 	shippingAddressStreet invalid length: {0}
     * //11019 	shippingAddressNumber invalid length: {0}
     * //11020 	shippingAddressComplement invalid length: {0}
     * //11021 	shippingAddressDistrict invalid length: {0}
     * //11022 	shippingAddressCity invalid length: {0}
     * //11023 	shippingAddressState invalid value: {0}, must fit the pattern: \w\{2\} (e. g. "SP")
     * //11024 	Itens invalid quantity.
     * //11025 	Item Id is required.
     * //11026 	Item quantity is required.
     * //11027 	Item quantity out of range: {0}
     * //11028 	Item amount is required. (e.g. "12.00")
     * //11029 	Item amount invalid pattern: {0}. Must fit the patern: \d+.\d\{2\}
     * //11030 	Item amount out of range: {0}
     * //11031 	Item shippingCost invalid pattern: {0}. Must fit the patern: \d+.\d\{2\}
     * //11032 	Item shippingCost out of range: {0}
     * //11033 	Item description is required.
     * //11034 	Item description invalid length: {0}
     * //11035 	Item weight invalid Value: {0}
     * //11036 	Extra amount invalid pattern: {0}. Must fit the patern: -?\d+.\d\{2\}
     * //11037 	Extra amount out of range: {0}
     * //11038 	Invalid receiver for checkout: {0}, verify receiver's account status.
     * //11039 	Malformed request XML: {0}.
     * //11040 	maxAge invalid pattern: {0}. Must fit the patern: \d+
     * //11041 	maxAge out of range: {0}
     * //11042 	maxUses invalid pattern: {0}. Must fit the patern: \d+
     * //11043 	maxUses out of range.
     * //11044 	initialDate is required.
     * //11045 	initialDate must be lower than allowed limit.
     * //11046 	initialDate must not be older than 6 months.
     * //11047 	initialDate must be lower than or equal finalDate.
     * //11048 	search interval must be lower than or equal 30 days.
     * //11049 	finalDate must be lower than allowed limit.
     * //11050 	initialDate invalid format, use 'yyyy-MM-ddTHH:mm' (eg. 2010-01-27T17:25).
     * //11051 	finalDate invalid format, use 'yyyy-MM-ddTHH:mm' (eg. 2010-01-27T17:25).
     * //11052 	page invalid value.
     * //11053 	maxPageResults invalid value (must be between 1 and 1000).
     * //11157 	senderCPF invalid value: {0}
     *
     */
    public static function checkResult($url){
        
        Yii::import('application.extensions.utils.StringUtils');
                
        $string = str_replace("[HTTP 400] - BAD_REQUEST", "", $url);
        $error = StringUtils::get_string_between($string, '[', ']');
        if(!$error) return false;
        
        switch($error){
            case 11012://remove um digit pois é utilizado no betweem
                $data['error'] = 'senderName invalid value: {0}';
                $data['message'] = 'Nome de usuário inválido';
                break;
           
        }
        
        $data['titulo_email'] = "ERROR - API Compra";
        $data['titulo_mensagem'] = 'Ocorreu um erro na tentativa de compra de: ' . "http://" . $_SERVER['SERVER_NAME'];
        $data['mensagem'] = $url;
        $sendMessage = MethodUtils::sendError($data);
        
        return $data; 
    }


    /**
     * Returns the weight format
     *
     * Into database the collumn weight is set as
     * a DOUBLE, so it's needed to be replace(from , to .);
     *
     */
    public static function getWeightCode($weight){

        $weightTMP = $weight; 
        $weight = explode(",", $weight); 

        //It fixes a bug with the DOUBLE in database
        if(count($weight) > 1 ){
             $weightTMP = $weight[0] . "." . $weight[1];
        }
        return $weightTMP;
    }

    /**
     * Returns the weight format
     *
     * Into database the collumn weight is set as
     * a DOUBLE, so it's needed to be replace(from . to ,);
     *
     */
    public static function getWeightDecode($weight){

        $weightTMP = $weight;
        $weight = explode(".", $weight);

        //It fixes a bug with the DOUBLE in database
        if(count($weight) > 1 ){
            switch(strlen($weight[1])){
                case 1:
                    $weightTMP = $weight[0] . "," . $weight[1] . "00";
                    break;

                case 2:
                    $weightTMP = $weight[0] . "," . $weight[1] . "0";
                    break;

                case 3:
                    $weightTMP = $weight[0] . "," . $weight[1];
                    break;
            }
        }
        return $weightTMP;
    }

    /**
     *
     * Returns plural days:
     * 
     * Example: if 1 -> day, or if bigger than 1 so -> days
     *
     * @param number $day
     */
    public static function getDayPluralFormat($day){

        $day_tmp  = $day . " dia";

        if($day > 1){
           $day_tmp  = $day . " dias";
        }
        return $day_tmp;
    }
    
    /**
     *
     * Returns the icon image:
     * 
     * 0 - WAITING
     * 1 - COMPLETE
     * 2 - NEW COMMENT
     * 3 - CANCEL
     * 4 - DISABLE
     *
     * @param number 
     * 
     */
    public static function getStatusImage($id_status){
        
        $image = null;

        switch ($id_status){
            case 0:
                $image = "icon_status_yellow.png";
                break;
            
            case 1:
                $image = "icon_status_green.png";
                break;
            
            case 2:
                $image = "icon_status_blue.png";
                break;
            
            case 3:
                $image = "icon_status_red.png";
                break;
            
            case 4:
                $image = "icon_status_gray.png";
                break;
        }
        return $image;
    }
    
    /**
     * Returns the values from the calcules between price, parcels
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function getCalculatesValues($price, $parcels, $descont){
        if($parcels == 0) $parcels = 1;
        $valor['parcel'] = $price / $parcels;
        return $valor;
    }
    
    /**
     * TODO: Remove this method and uses it in StoreUtils 
     * 
     * Returns the values from the calcules between price, parcels
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function getCountItemsCart($data){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        if($data['id_pedido'] == "") $data['id_pedido'] = 0;
        
        $select = "id, amount, valor";
        
        //If shopping cart
        if($data['tipo'] == "produto" || $data['tipo'] == "embrulho" || $data['tipo'] == "transporte" || $data['tipo'] == "modulo"){
        $sql = "SELECT ".$select.", SUM(amount), SUM(valor_total) FROM ecommerce_carrinho WHERE id_pedido = ".$data['id_pedido']." AND (tipo = 'produto' OR tipo = 'embrulho' OR tipo = 'transporte' OR tipo = 'modulo')";
        }else if($data['tipo'] == "servicos" || $data['tipo'] == "desenvolvimento" || $data['tipo'] == "hospedagem"){
        $sql = "SELECT ".$select.", SUM(amount), SUM(valor_total) FROM ecommerce_carrinho WHERE id_pedido = ".$data['id_pedido']."";
        }else{
        $sql = "SELECT ".$select.", SUM(amount), SUM(valor_total) FROM ecommerce_carrinho WHERE id_pedido = ".$data['id_pedido']." AND tipo = '".$data['tipo'] . "'";
        }
        
        try{           
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if($recordset){
                $recordset['valor_format'] = CurrencyUtils::getPriceFormat($recordset[0]['SUM(valor_total)'], true, false);
                $recordset['valor'] = CurrencyUtils::getFloatFormat($recordset[0]['SUM(valor_total)']);
                $set = MethodUtils::setSessionData('carrinho_amount', $recordset[0]['SUM(amount)']);
            }else{
                $recordset['valor_format'] = CurrencyUtils::getPriceFormat(0, true, false);
                $recordset['valor'] = CurrencyUtils::getFloatFormat(0);
            }          
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCountitemsCart() '. $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para obter os atributtos image dos produtos
     * 
     *
     * @param number id produto
     * @param number id foto
     *
    */
    public static function getProdutoImageAttribute($id_produto, $id_estoque = false){
        
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');

        $pa = new dbProdutosAttribute();
        $pa->setCurrentProduto($id_produto);   
        //Slot pictures
        if(!$id_estoque){
            $foto[0] = $pa->recuperar('produto_IMG_1');
            $foto[1] = $pa->recuperar('produto_IMG_2');
            $foto[2] = $pa->recuperar('produto_IMG_3');
            $foto[3] = $pa->recuperar('produto_IMG_4');
            $foto[4] = $pa->recuperar('produto_IMG_5');
            $foto[5] = $pa->recuperar('produto_IMG_6');
            
        }else{
            $foto[0] = $pa->recuperar('produto_VAR_1', 'texto', $id_estoque);
            $foto[1] = $pa->recuperar('produto_VAR_2', 'texto', $id_estoque);
            $foto[2] = $pa->recuperar('produto_VAR_3', 'texto', $id_estoque);
            $foto[3] = $pa->recuperar('produto_VAR_4', 'texto', $id_estoque);
            $foto[4] = $pa->recuperar('produto_VAR_5', 'texto', $id_estoque);
            $foto[5] = $pa->recuperar('produto_VAR_6', 'texto', $id_estoque);
        }
        //var_dump($foto);      
        return $foto;
    }
    
    /**
     *
     * Returns the caracteristics strings:
     *
     * @param string 
     * 
     */
    public static function getCaracteristics($type){
        
        $attr = array();

        switch ($type){
            case "editar_cor":
            case "cadastrar_cor":
                $attr['title'] = "caracteristics_page_title_new_color";
                $attr['tipo'] = "cor";
                $attr['label_1'] = "Nome da cor";
                $attr['label_2'] = "Cor";
                break;
            
            case "cadastrar_tamanho":
            case "editar_cor":
                $attr['title'] = "caracteristics_page_title_new_size";
                $attr['tipo'] = "tamanho";
                $attr['label_1'] = "Tamanho";
                $attr['label_2'] = "Descrição";
                break;
        }
        return $attr;
    }
    
    /**
     *
     * Returns the caracteristics properties:
     *
     * @param string 
     * 
     */
    public static function getCaracteristicsPropertiesById($id, $callback = false){
        
        if($id == '' || !is_numeric($id)) return false;
        $select = "id, tipo, number, texto, inteiro, extra";
        $sql = "SELECT ".$select." FROM ecommerce_caracteristicas WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();  
            
            if($callback && $recordset) return $recordset[$callback];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCaracteristicsPropertiesById() '.$e->getMessage();
        }
    }
    
    /**
     * Método para atualizar 
     * referentes aos items que já foram pagos, ou tem interesse de pagamento
     *
     * @param number
     *
    */
    public static function updateInventory($data, $item){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $qtd_estoque = ProdutosUtils::getEstoqueByIdVariante($item['id_variante']);
        
        $new_qtd = $qtd_estoque['qtd'] - $item['amount'];
        if($new_qtd < 0) $new_qtd = 0;
        
        if($data['status'] == 3){$values  = "qtd = " . $new_qtd ."";}
        
        $sql = "UPDATE ecommerce_estoque SET ". $values ." WHERE id = ". $item['id_variante'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Updates the inventory getting all products added into ecommerce_estoque 
            $qtd_estoque = ProdutosUtils::updateTotalEstoqueProduto($item['id_item']);
            
            return true;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: ProdutosUtils - updateInventory() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar 
     * referentes aos items que já foram pagos, ou tem interesse de pagamento
     *
     * @param number
     *
    */
    public static function getEstoqueByIdVariante($id_variante){
 
        $select = "id, id_produto, qtd, ref, tamanho, cor, valor, hexadecimal";
        $sql = "SELECT ".$select." FROM ecommerce_estoque WHERE id = $id_variante";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();  

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getEstoqueByIdVariante() '.$e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o estoque do produto 
     * Atualiza na tabela ecommerce_produtos, atualiza o unidades_current
     *
     * @param number
     *
    */
    public static function updateTotalEstoqueProduto($id_produto){
 
        $select = "id, id_produto, qtd, SUM(qtd)";
        $sql = "SELECT ".$select." FROM ecommerce_estoque WHERE id_produto = $id_produto";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll(); 

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - updateTotalEstoqueProduto() - SELECT '.$e->getMessage();
        }
        
        if(count($recordset) > 1){
            $values  = "unidades_current = " . $recordset['SUM(qtd)'] ."";
            $sql2 = "UPDATE ecommerce_produtos SET ". $values ." WHERE id = ". $id_produto . "";

            try{
                $comando = Yii::app()->db->createCommand($sql2);
                $control = $comando->execute();

                return true;

            }catch(CDbException $e){
                Yii::trace("ERROR ".$e->getMessage());
                echo 'ERROR: ProdutosUtils - updateTotalEstoqueProduto() - UPDATE '.$e->getMessage();
            }
        }
    }
    
    
     /**
     * Método para atualizar o item do estoque
     *
     * @param array
     *
    */
    public static function updateItemEstoque($data, $insert = false){
        
        if( $insert){
            $insert = "id_produto, qtd, tamanho, cor, valor, ref, n_index";
            $values = "{$data['id']}, {$data['qtd']}, '{$data['tamanho']}', '{$data['qtd']}', '{$data['qtd']}', '{$data['qtd']}', '{$data['qtd']}'";
            
            $sql = "INSERT INTO ecommerce_estoque ($insert) VALUES ($values)";            
        }
        
        if(!$insert){
            $values  = "qtd = '{$data['qtd']}', tamanho = '{$data['tamanho']}', cor ='{$data['cor']}', ";
            $values .= "valor = '{$data['acrescimo']}', ref = '{$data['ref']}', n_index = '{$data['n_index']}'";

            $sql = "UPDATE ecommerce_estoque SET $values WHERE id = " . $data['id'];
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
             echo "ERROR: ProdutosUtils - updateItemEstoque() " . $e->getMessage();
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
            $sql = "SELECT ".$select." FROM ecommerce_categorias WHERE categoria_url = '$categoria'";
        }
        
        if($sub != "" && $subitem == ""){
            $select = "id_categoria, id_subcategoria, subcategoria_label, subcategoria_url";
            $sql = "SELECT ".$select." FROM ecommerce_subcategorias WHERE subcategoria_url = '$sub'";
        }
        
        if($sub != "" && $subitem != ""){
            $select = "id_categoria, id_subcategoria, subitem_label, id_subitem, subitem_url";
            $sql = "SELECT ".$select." FROM ecommerce_subitems WHERE subitem_url = '$subitem'";
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
     * Método para organizar o bread crumb
     *
     * @param string
     * @param string
     * @param string
     *
    */
    public static function getBreadCrumb($categoria, $subcategoria, $subitem, $id){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $result = array();
        
        $cat = ProdutosUtils::getCategoriasId($categoria, "", "");
        $subcat = ProdutosUtils::getCategoriasId($categoria, $subcategoria, "");
        $subitems = ProdutosUtils::getCategoriasId($categoria, $subcategoria, $subitem);
        
        $result['cat'] = $categoria;
        if(isset($cat['categoria_label']))$result['cat_string'] = $cat['categoria_label'];
        if(isset($cat['categoria_url'])) $result['cat_url'] = $cat['categoria_url'];
        
        $result['subcat'] = $subcategoria;
        if(isset($subcat['subcategoria_label'])){
            $result['subcat_string'] = $subcat['subcategoria_label'];  
            $result['subcat_url'] = $subcat['subcategoria_url'];
        }else{
            $result['subcat_string'] = ""; 
            $result['subcat_url'] = "";
        }
        
        $result['subitem'] = $subitem;
        if(isset($subitems['subitem_label'])){
            $result['subitem_string'] = $subitems['subitem_label'];    
            $result['subitem_url'] = $subitems['subitem_url']; 
        }else{
            $result['subitem_string'] = "";
             $subitems['subitem_url'] = "";
        }
        
        return $result;
    }
    
    /**
     * Método para pegar o label de uma categoria com seu id
     * usada em topo site
     *
     * @param number
     *
    */
    public static function getCategoryContent($record, $type='categoria_url', $callback = 'categoria_label', $isAll = false){
        
        $select = "id_categoria, categoria_label, categoria_url";
        $sql = "SELECT ".$select." FROM ecommerce_categorias WHERE id_categoria = $record";
        if($type == "categoria_url")$sql = "SELECT ".$select." FROM ecommerce_categorias WHERE categoria_url = '$record'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($isAll) return $recordset;
            if($recordset) return $recordset[$callback];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCategoryContent() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para definir o id do pedido no pagamento, esse método é um 
     * método fake para pagamentos por crédito, já que este não utiliza
     * os retornos dos gateways.
     * 
     *
     * @param number
     * @param string
     *
    */
    public static function setPaymentId($id, $ref){
        
        $values  = "id_pedido = '" . $ref ."'";
        $sql =  "UPDATE ecommerce_pagamentos SET ". $values ." WHERE id = " .$id . "";   
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - setPaymentId() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar um atributo do produto
     * 
     *
     * @param number
     * @param string
     *
    */
    public static function updateAttribute($table, $field, $value, $id){
        
        $values  = "$field = '" . $value ."'";
        $sql =  "UPDATE $table SET ". $values ." WHERE id = " .$id . "";   
 
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return 'ERROR: ProdutosUtils - updateAttribute() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter as informações básicas do módulo
     * 
     *
     * @param number
     * @param string
     *
    */
    public static function getModuleInformation($id, $callback = null){
        
        if($id == '' || $id == 'undefined' || $id == null) $id = 0;
        
        $select = "id, nome, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id = $id";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($callback != "all"){
                return $recordset[$callback];
            }else{
                return $recordset;
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getModuleInformation() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter as informações básicas do produto
     * 
     *
     * @param number
     *
    */
    public static function getProdutoInformation($id, $isType = false, $isAll = false){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        if($isType){
            Yii::import('application.extensions.utils.admin.PaginasUtils');    
            Yii::import('application.extensions.utils.DateTimeUtils');
        }
   
        $select  = "id, id_user, nome, url, unidades_min, tipo, data, last_update, unidades_current, preco_real, ";
        $select .= "altura, largura, peso, comprimento, id_categoria, id_subcategoria, id_subitem, status";
        
        $sql = "SELECT $select FROM ecommerce_produtos WHERE id = $id";  
        if($isType) $sql = "SELECT $select FROM ecommerce_produtos WHERE $isType = $id";
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            if(!$isAll)$recordset = $command->queryRow();
            if( $isAll)$recordset = $command->queryAll();
            
            if($recordset && ($isType && count($recordset) > 0 && $isAll)){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['pages'] = PaginasUtils::getPagesContent($recordset[$i]['id']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);                    
                }
            }
            
            if($recordset && (count($recordset) > 0 && !$isAll)){
                $recordset['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset['preco_real'], true);
                //Se estiver zerado colaca fake
                if($recordset['altura'] == '')  $recordset['altura'] = 5;
                if($recordset['largura'] == '') $recordset['largura'] = 11;
                if($recordset['comprimento'] == '') $recordset['comprimento'] = 16;
                if($recordset['peso'] == '') $recordset['peso'] = 1;
            }
            
            return $recordset;            
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getProdutoInformation() '.$e->getMessage();
        }
    }
    
    /**
     * Método para verificar se é preciso paginar, separar as categorias,
     * subcategorias, subitems, ordernar por tipo, valor etc. 
     * 
     *
     * @param number
     * @param string
     *
    */
    public static function getPaginationAttributes($categoria, $subcategoria, $subitem, $is_store = false){
        
        Yii::import('application.extensions.utils.StoreUtils');

        $result = array();
        
        if(is_numeric($categoria)){
            $result['categoria'] = "";
            $result['subcategoria'] = ""; 
            $result['subitem'] = "";
            $result['start'] = $categoria;
            
        }else{
            $result['categoria'] = $categoria;
            $result['subitem'] = $subitem;
            $result['subcategoria'] = $subcategoria; 
            $result['start'] = 0;
        }
        
        if(!$is_store){
        if(!is_numeric($categoria)) $result['id_categoria'] = ProdutosUtils::getCategoriasByValue($categoria, 'categoria_url', 'categorias', 'id_categoria');
        if(!is_numeric($subcategoria) && $subcategoria != '') $result['id_subcategoria'] = ProdutosUtils::getCategoriasByValue($subcategoria, 'subcategoria_url', 'subcategorias', 'id_subcategoria');   
        if(!is_numeric($subitem) && $subitem != '') $result['id_subitem'] = ProdutosUtils::getCategoriasByValue($subitem, 'subitem_url', 'subitem', 'id_subitem');  
        }
        
        if( $is_store){
        if(!is_numeric($categoria)) $result['id_categoria'] = StoreUtils::getCategoriasByValue($categoria, 'categoria_url', 'categorias', 'id_categoria');
        if(!is_numeric($subcategoria) && $subcategoria != '') $result['id_subcategoria'] = StoreUtils::getCategoriasByValue($subcategoria, 'subcategoria_url', 'subcategorias', 'id_subcategoria');   
        if(!is_numeric($subitem) && $subitem != '') $result['id_subitem'] = StoreUtils::getCategoriasByValue($subitem, 'subitem_url', 'subitem', 'id_subitem');  
        }
        
        return $result;
    }
    
    /**
     * Método para obter os atributes de seleção orgazinados por
     * order by. 
     * TODO: Criar um arquivo de CONSTANTS para colocar os valores abaixo
     *
    */
    public static function getOrderBy(){

        $result = array();
        $session = MethodUtils::getSessionData();
        
        if(isset($session['ecommerce_limit_max'])) $result['max'] = $session['ecommerce_limit_max']; else $result['max'] = 10;
        if(isset($session['ecommerce_order_by'])) $result['order_by'] = $session['ecommerce_order_by']; else $result['order_by'] = " ORDER BY n_index ASC, nome ASC";
        if(isset($session['ecommerce_order_by'])) $result['order_by_ecom'] = $session['ecommerce_order_by_ecom']; else $result['order_by_ecom'] = " ORDER BY n_index ASC, nome ASC";
        if(isset($session['ecommerce_order'])) $result['order'] = $session['ecommerce_order']; else $result['order'] = "a-z";
        if(isset($session['ecommerce_style'])) $result['style'] = $session['ecommerce_style']; else $result['style'] = "inline";
        return $result;
    }
    
    /**
     * Método para definir os atributes de ordenação orgazinados por
     * order by. 
     * TODO: Criar um arquivo de CONSTANTS para colocar os valores abaixo
     *
    */
    public static function setOrderBy($order){
        
        $tag = " ORDER BY ";
        $and = " AND ";
        switch($order){
            case "a-z":
                $result = $tag . "nome ASC"; 
                $result_ecom = $tag . "nome ASC";
                break;
            case "z-a":
                $result = $tag . "nome DESC";
                $result_ecom = $tag . "nome DESC";
                break;
            case "price":
                $result = $tag . "preco_real ASC";
                $result_ecom = $tag . "preco_real ASC";
                break;
            case "sale":
                $result = $and . "promocao != ''"; 
                $result_ecom = $tag . "promocao != ''";
                break;
            case "new":
                $result = $and . "lancamento = 1"; 
                $result_ecom = $tag . "lancamento = 1";
                break;
        }
        
        MethodUtils::setSessionData("ecommerce_order_by", $result);
        MethodUtils::setSessionData("ecommerce_order_by_ecom", $result_ecom);
        MethodUtils::setSessionData("ecommerce_order", $order);
    }
    
    /**
     * Método para atualizar a quantidade produtos no fechamento
     * do pagamento, totalmente server side
     *
     * @param array
     *
    */
    public static function updateAmount($data){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
       
        $result = array();
        $sql = "SELECT amount, valor FROM ecommerce_carrinho WHERE id = " . $data['id'];  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($data['operacao'] == "+")$result['amount'] = $recordset['amount'] + 1;
            if($data['operacao'] == "-")$result['amount'] = $recordset['amount'] - 1;
            
            // make sure 0 is the smallest possible
            if($result['amount'] <= 0) $result['amount'] = 0;
            
            $result['valor']  = $recordset['valor'] * $result['amount'];
            $result['valor_float'] = CurrencyUtils::getFloatFormat($result['valor']);
            $result['valor_format'] = CurrencyUtils::getPriceFormat($result['valor'], true, false);
            
            $values = "amount = " . $result['amount'] .", valor_total = " . $result['valor_float'] ."";
            $sql2 =  "UPDATE ecommerce_carrinho SET ". $values ." WHERE id = ". $data['id'] . ""; 

            $comando = Yii::app()->db->createCommand($sql2);
            $control = $comando->execute();
            
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - updateAmount() '. $e->getMessage();
        }
    }
    
    /**
     * Método para definir as view dependendo do ramo do 
     * negócio
     *
    */
    public static function getViewByTypeBusiness(){
        
        $result = array();
        
        $result['editar'] = "product_common"; 
        $result['listar'] = "listar_common";
        $result['tipo'] = "common";
        $result['list_tip'] = "list";
        
        $result['editar'] = "product_common"; 
        $result['listar'] = "listar_common";
        $result['tipo'] = "common";
        $result['list_tip'] = "list";
        
        return $result;
    }
    
    /**
     * Método para obter os dados do produto comprado
     * Esse está na lista de pagamentos e apartir dai é buscado suas informações. 
     * 
     * TODO: remover este method daqui e utilzar o mesmo metodo em StoreUtils
    */
    public static function getCartItems($id, $tipo = 'produto', $id_user = null){

        if($id == '') return false;
        
        $session = MethodUtils::getSessionData();
        
        if($id_user == null) $id_user = $session['id'];
        $sql = "SELECT id, nome, id_item, tipo, extra FROM ecommerce_carrinho WHERE (id_pedido = $id AND id_user = {$session['id']} AND tipo = '$tipo')";  
        if($tipo == 'all')$sql = "SELECT id, tipo, nome, id_item, extra FROM ecommerce_carrinho WHERE id_pedido = $id AND id_user = $id_user";
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCartItems() '. $e->getMessage();
        }
        
    }
    
    /**
     *
     * Returns the e-commerce details
     * 
     */
    public static function getEcommerceDetails(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        
        //Verify if it was storaged some data previously
        //if($session['SES_ecommerce_details'] != '') return $session['SES_ecommerce_details'];
        
        $result = array();
        $result['bt_shopcart'] = PreferencesUtils::getAttributes("bt_shopcart", "texto");
        $result['frame_vitrine'] = PreferencesUtils::getAttributes("frame_vitrine", "texto");
        $result['menu_loja'] = PreferencesUtils::getAttributes("menu_loja", "texto");
        $result['vitrine_layout'] = PreferencesUtils::getAttributes("vitrine_layout", "texto");
        $result['categoria_home_layout'] = PreferencesUtils::getAttributes("categoria_home_layout", "texto");
        $result['cep_origem'] = PreferencesUtils::getAttributes("cep_origem", "texto");
        $result['frete_gratis_valor'] = PreferencesUtils::getAttributes("frete_gratis_valor", "number");
        $result['categorias_home'] = PreferencesUtils::getAttributes("categorias_home", 'inteiro');
        $result['outras_informacoes'] = PreferencesUtils::getAttributes("outras_informacoes", 'descricao');
        $result['prazo_entrega'] = PreferencesUtils::getAttributes("prazo_entrega", 'descricao');
        $result['mensagem'] = PreferencesUtils::getAttributes("mensagem", 'descricao');
        
        $result['produtos_qtd'] = PreferencesUtils::getPreferedItem("produtos_qtd");
        $result['envio'] = PreferencesUtils::getPreferedItem("envio");
        $result['embrulho'] = PreferencesUtils::getPreferedItem("embrulho");
        $result['showcase'] = PreferencesUtils::getPreferedItem("showcase");
        $result['parcelamento'] = PreferencesUtils::getPreferedItem("parcelamento");
        $result['valor_free'] = PreferencesUtils::getPreferedItem("valor_free");
        $result['menu_produtos_type'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');
        $result['limite_pagina'] = PreferencesUtils::getAttributes("limite_pagina", "inteiro");
        
        if($result['limite_pagina'] != "" && $result['limite_pagina'] != 0){
            $set = MethodUtils::setSessionData("ecommerce_limit_max", $result['limite_pagina']);
        }
        
        $setSession = MethodUtils::setSessionData('SES_ecommerce_details', $result);
        
        return $result;
    }
    
    /**
     *
     * Returns the e-commerce kind of price
     * 
     */
    public static function checkKindOfPrice(){        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');        
        return PreferencesUtils::getPreferedItem("valor_free");
    }
        
    
    /**
     *
     * Dispatch emails
     * 
     */
    public static function dispatchEmails($data){
        
        $dataOwner = array();
        
        switch($data['status']){
            case "1":
                $dataOwner['titulo_email'] = "Compra realizada";
                $dataOwner['staus'] = $data['status'];             
                $dataOwner['nome'] =  $data['nome'];
                $dataOwner['email'] =   $data['email'];
                $dataOwner['mensagem'] = "mensagem";
                $dataOwner['layout'] =  "status_compra";//"indique_amigo_common";
                $dataOwner['tipo'] =  "produtos";//"indique_amigo";
                $dataOwner['newsletter'] = false;
                break;
            
            default:
            break;
        
        }
        
        $owner = MethodUtils::sendEmail($dataOwner);
        
        return $owner;
    }
    
    /**
     *
     * Search by linked products and creates their records on 
     * ecommerce_carrinho's table
     * 
     */
    public static function applyProductsLinked($data){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        $id_pedido = explode("_", $data['id_pedido']);        
        $produto = StoreUtils::getItemCartSimple($id_pedido[2]);
        
        if(!$produto) return false;
        
        try{
            $result = ProdutosUtils::getProdutoInformation($produto['id_item'], "id_master", true);
            
            if(count($result) > 0){
                foreach($result as $values){
                    $result = StoreUtils::createRecordsShoppingCart($values, $data);
                }
            }
            
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - applyProductLinked() '. $e->getMessage();
        }        
    }
    
    /**
     *
     * Adiciona como produto vendido
     * 
     */
    public static function recordProductSold($data){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        $id_pedido = explode("_", $data['id_pedido']);        
        $produto = StoreUtils::getItemsCart($id_pedido[2]);
        
        if(!$produto) return false;
        
        try{           
            if(count($produto) > 0){
                foreach($produto as $values){
                    
                    //echo $values['id'] . ' ' . $values['nome'] . ' ' . $values['valor'];
                    if(isset($values['id'])) ActivityLogger::log($values['id'], 'produto_vendido');
                }
            }
            
            return $produto;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - recordProductSold() '. $e->getMessage();
        }        
    }
    
    /**
     * Método para atualizar a quantidade produtos no fechamento
     * do pagamento, totalmente server side
     *
     * @param array
     *
    */
    public static function updateIdMasterUsers($id, $id_user){ 
 
        try{
            $values = "id_user = " . $id_user ."";
            $sql =  "UPDATE ecommerce_produtos SET ". $values ." WHERE id_master = ". $id . " AND tipo = 'programa'"; 

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - updateMasterUsers() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados do produto que serão exibidos no menu droplist. 
     * 
     * 
    */
    public static function getMenuContent($id_categoria_menu, $tipo ='produto'){
        
        $sql = "SELECT id, nome, tipo FROM ecommerce_produtos WHERE id_categoria_menu = $id_categoria_menu AND tipo = '$tipo'";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
      
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getMenuContent() '. $e->getMessage();
        }
        
    }
    
    /**
     * Método para adicionar um item na wishlist. 
     * 
     * 
    */
    public static function addToWishList($id, $type, $label = 'wishlist'){
        
        $session = MethodUtils::getSessionData();
        $sql = "SELECT id_produto, name FROM ecommerce_attribute WHERE id_produto = $id AND name = '$label' AND texto = '$type' AND inteiro = ".$session['id'] . "";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
      
            if(!$recordset){
                
                $insert = "id_produto, name, texto, inteiro, estampa";
                $values = $id . "', '" .$label. "', '" .$type. "', '" .$session['id']. "', '" . date("Y-m-d H:i:s")."";
                $sql = "INSERT INTO ecommerce_attribute (".$insert.") VALUES ('".$values."')";

                $command = Yii::app()->db->createCommand($sql);
                $result_control = $command->execute();
                
                if( $result_control) $data['message'] = Yii::t("messageStrings", "wish_list_added");
                if(!$result_control) $data['message'] = Yii::t("messageStrings", "wish_list_fail");
                
                $data['result'] = $result_control;            
                
            }else{
                $data['message'] = Yii::t("messageStrings", "wish_list_already_added");
                $data['result'] = $recordset;
            }
            
            $result = array("result" => $data['result'], "message" => $data['message']);
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - addToWishList() '. $e->getMessage();
        }
        
    }
    
    /**
     * Método para adicionar um item a lista de comparação. 
     * 
     * 
    */
    public static function addToComparisonList($id, $type){
        
        $session = MethodUtils::getSessionData();
        
        try{
            //Diz que não há repetições
            $data['isAdded'] = false;
            
            //Define primeira utilização
            if($session['qtd_comparison'] == '') MethodUtils::setSessionData('qtd_comparison', 0);
            
            if($session['qtd_comparison'] < 3){
                $qtd =  $session['qtd_comparison'];
                
                //Se já esta adiconado apenas avisa
                if($session['item_' . $type . '_' . $qtd] != ''){
                    $data['message'] = Yii::t("messageStrings", "comparison_list_already_added");
                    $data['isAdded'] = true;
                    
                }else{
                    MethodUtils::setSessionData('item_' . $type . '_' . $qtd, $id);
                    $data['message'] = Yii::t("messageStrings", "comparison_list_added");
                    
                    $qtd++;
                    MethodUtils::setSessionData('qtd_comparison', $qtd);
                }
                
            }else{
                $data['message'] = Yii::t("messageStrings", "comparison_list_fail");
            }
            
            $result = array("result" => 1, "message" => $data['message'], "qtd" => $session['qtd_comparison'], "is_added" => $data['isAdded']);
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - addToComparisonList() '. $e->getMessage();
        }
    }
    
    /**
     * Método para obter os dados do produto que serão exibidos no menu droplist. 
     * 
     * 
    */
    public static function getCategoriaLabel($id_categoria){
        
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        $categoriasHandler = new CategoriaManager();
        
        try{
            $recordset = $categoriasHandler->getProductCategoryByLabel($id_categoria, true);
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getCategoriaLAbel() '. $e->getMessage();
        }
        
    }
    
    /**
     * Método para obter os dados do produto que serão exibidos no menu droplist. 
     * 
    */
    public static function removeItemCompara($id, $tipo){
        
        $session = MethodUtils::getSessionData();
        if($session[$id] != ''){
            if($id == 'item_' . $tipo . '_0'){
                if($session['qtd_comparison'] == 3){
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_0', $session['item_' . $tipo . '_1']);
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_1', $session['item_' . $tipo . '_2']);
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_2', '');
                    MethodUtils::setSessionData('qtd_comparison', 2);
                }
                
                if($session['qtd_comparison'] == 2){
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_0', $session['item_' . $tipo . '_1']);
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_1', '');
                    MethodUtils::setSessionData('qtd_comparison', 1);
                }
                
                if($session['qtd_comparison'] == 1){
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_0', '');
                    MethodUtils::setSessionData('qtd_comparison', 0);
                }
            }
            
            if($id == 'item_' . $tipo . '_1'){
                if($session['qtd_comparison'] == 3){
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_1', $session['item_' . $tipo . '_2']);
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_2', '');
                    MethodUtils::setSessionData('qtd_comparison', 2);
                }
                
                if($session['qtd_comparison'] == 2){
                    $setS = MethodUtils::setSessionData('item_' . $tipo . '_1', '');
                    MethodUtils::setSessionData('qtd_comparison', 1);
                }
            }
            
            if($id == 'item_' . $tipo . '_2'){              
               $setS = MethodUtils::setSessionData('item_' . $tipo . '_2', '');
               MethodUtils::setSessionData('qtd_comparison', 2);
            }
            
            
        }        
        return true;        
    }
    
    public static function getClearContent(){
        //Form Token ID
        $tokenName = "token_cc_pool";

        $data['FORM_MODE'] = 'new'; //new
        $data['FORM_ACTION_NEW'] = 'Criar';
        $data['FORM_ACTION_DESC'] = 'criar um novo';

        //Form Standard Data
        $data['id'] = "";
        $data['id_produto'] = "";
        $data['formPoolNome'] = "";
        
        $data['referencia'] = "";
        $data['nome'] = "";
        $data['id_categoria'] = "";
        $data['id_subcategoria'] = "";
        $data['id_subitem'] = "";
        $data['marca'] = "";
        $data['n_index'] = "";
        $data['frete_gratis'] = "";
        $data['keywords'] = "";
        $data['tipo'] = "produto";
        $data['descricao'] = "";
        $data['descricao_resumo'] = "";
        $data['preco_real'] = "";
        $data['preco'] = "";
        $data['date_start'] = "";
        $data['date_end'] = "";
        $data['unidades_min'] = "";
        $data['entrega'] = "";
        $data['percentage'] = "";
        $data['exibe_ecommerce'] = "";
        $data['exibe_produtos'] = "";
        $data['sob_consulta'] = 0;
        $data['ordem_servico'] = 0;
        $data['reputation'] = 0;
        
        $data['formPoolCategoria1'] = "";
        $data['formPoolCategoria'] = "";
        $data['formPoolSubCategoria'] = "";
        $data['formPoolSubItem'] = "";
        $data['formPoolCategoriaEscolhida'] = "Selecione uma categoria";
        $data['formPoolCategoriaDesc'] = "Selecione uma categoria";
        $data['formPoolMarca'] = "";
        $data['id_user'] = "";
        $data['id_master'] = "";//Linked
        $data['formPoolType'] = "produto";
        $data['formPoolPalavraChave'] = "";
        $data['formPoolMarcaOutra'] = "";
        $data['formDescricao'] = "";
        $data['formPoolValorReal'] = "0,00";
        $data['formPoolValor'] = "0,00";
        $data['formPoolDataInicio'] = "";
        $data['formPoolDataTermino'] = "";
        $data['formPoolNrMin'] = "1";
        $data['formPoolNrMax'] = "1";
        $data['formPoolPrazoEntrega'] = "";
        $data['formPoolNrMaxPerson'] = "1";
        $data['formPoolPercentage'] = "";
        $data['formPoolPeso'] = "1";
        $data['parcelas'] = 1;
        $data['formPoolFreteCHECKED'] = 0;
        $data['formPoolDivulgacaoHomeCHECKED'] = 0;
        $data['formPoolDivulgacaoPromocionalCHECKED'] = 0;
        $data['formPoolDivulgacaoEmpresasCHECKED'] = 0;
        $data['formPoolRegiao'] = "São Paulo";
        $data['formPoolEstado'] = '0';
        $data['formPoolEstadoCHECKED'] = "1";
        $data['id_categoria_menu'] = '';
        $data['token_cc_pool'] = "";
        $data['action'] = "novo";
        $data['video_conferencia'] = '';

        $data['vitrine'] = 0;
        $data['lancamento'] = 0;
        $data['promocao'] = "";
        $data['ecommerce_exibe'] = 0;
        
        //Autos
        $data['ano'] = '';
        $data['modelo'] = '';
        $data['unidade'] = '';
      
        //Medidas
        $data['peso'] = "";
        $data['largura'] = "";
        $data['altura'] = "";
        $data['comprimento'] = "";
        $data['diametro'] = "";

        //Transporte
        $data['transporte'] = "";
        $data['retirar_local'] = 0;
        $data['embrulho'] = "";

        $data['formSlotPicture1'] = "missing1";
        $data['formSlotPicture2'] = "missing2";
        $data['formSlotPicture3'] = "missing3";
        $data['formSlotPicture4'] = "missing4";
        $data['formSlotPicture5'] = "missing5";
        $data['formSlotPicture6'] = "missing6";

        $data['extra1'] = "";
        $data['extra2'] = "";

        return $data;
    }
    
    /**
     * Método para obter os attirbutes do produto. 
     * 
    */
    public static function getProdutoAttribute($id, $label, $field = false){
        
        $sql = "SELECT id_produto, id_variante, name, descricao, texto, inteiro FROM ecommerce_attribute WHERE id_produto = $id AND name = '$label'";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($field && $recordset) return $recordset[$field];
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - getProdutosAttribute() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o comentarios do produto 
     *
     * @param number
     *
    */
    public static function updateComentariosProduto($id){

        try{
            $command = Yii::app()->db->createCommand("SELECT id, nr_comentarios FROM ecommerce_produtos WHERE id = $id");           
            $recordset = $command->queryRow();         
        
            if($recordset){
                $sum  = $recordset['nr_comentarios'] + 1;
                $sql2 = "UPDATE ecommerce_produtos SET nr_comentarios = $sum WHERE id = $id";

                $comando = Yii::app()->db->createCommand($sql2);
                $control = $comando->execute();

                return $control;
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosUtils - updateComentariosProduto() '.$e->getMessage();
        }
    }
    
    /**
     * Get categories items.
     * 
     * @param number
     *
     */
    public static function getCategoriasByValue($value, $field = 'categoria_url', $type = 'categorias', $callback = false){
  
        if($type == 'produtos') $sql = "SELECT id, url, nome FROM ecommerce_produtos WHERE $field = '$value'";
        if($type == 'categorias') $sql = "SELECT id_categoria, categoria_label, categoria_url FROM ecommerce_categorias WHERE $field = '$value'";
        if($type == 'subcategorias') $sql = "SELECT id_subcategoria, subcategoria_label, subcategoria_url FROM ecommerce_subcategorias WHERE $field = '$value'";
        if($type == 'subitem') $sql = "SELECT id_subitem, subitem_label, subitem_url FROM ecommerce_subitems WHERE $field = '$value'";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryRow();
            
            if($recordset && $callback) return $recordset[$callback];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: StoreUtils - getCategoriasByValue() '.$e->getMessage();
        }
    }
    
    /**
     *
     * Returns query
     * 
     */
    public static function getMoreFilters(){
        
        $session = MethodUtils::getSessionData(); 
        $query1 = "";
        
        //echo 'jje: ' . $session['produtos_filtro_categoria'] . " " .$session['produtos_mais_filtro'];
        if($session['produtos_filtro_categoria'] != ''){$query2 = " AND id_categoria = {$session['produtos_filtro_categoria']}";}else{$query2 = "";}
        
        switch($session['produtos_mais_filtro']){
            case "exibe_produtos":
                $query1 = "AND exibe_produtos = 1";                
                break;
            case "nao_exibe_produtos":
                $query1 = "AND exibe_produtos = 0";
                break;             
            case "exibe_romaneio":
                $query1 = "AND exibe_produtos = 2";
                break;
        }
                
        return $query1 . " " . $query2;
    }
}
?>