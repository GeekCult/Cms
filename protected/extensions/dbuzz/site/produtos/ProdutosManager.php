<?php
/*
 * This Class is used to controll all functions related the feature Paginas
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 * $ua = new dbUserAttribute();
 *
 */

class ProdutosManager{

   /**
    * Método para recuperar os registros da tabela em pauta
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    */
    public function getAllContent($tipo = "simples", $start = 0, $args = array()){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        
        $commentHandler = new ComentariosManager();
        
        ((isset($args['limite_pagina']) && $args['limite_pagina'] != "")) ? $limite = $args['limite_pagina'] : $limite = 10;
        
        $select  = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, pais, parcelas, reputation, nr_comentarios, ";
        $select .= "unidades_current, marca, data, last_update, tipo, unidades_min, id_master, url, referencia, descricao_resumo";
      
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE tipo = '$tipo' AND exibe_produtos = 1 ORDER BY id_categoria DESC, n_index ASC LIMIT $start, $limite";
        
        $type_price = ProdutosUtils::checkKindOfPrice();
        
        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){                
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);                
                    $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true, $type_price);
                    $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);            
                    $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                    $recordset[$i]['reviews'] = $commentHandler->getLikesByIdGeneral($recordset[$i]['id'], "produtos");
                    //$recordset[$i]['estoque'] = $this->getEstoqueProduto($recordset[$i]['id']);
                    $recordset[$i]['categoria'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria'], 'id');
                    

                    for($f = 0; $f < 6; $f++){                                          
                        $recordset[$i]['image_' . $f] = $fotos[$f];                   
                    }
                } 
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getAllContent() '. $e->getMessage();
        }   
        return $recordset;
    }
    
    /**
    * Método para recuperar os registros da tabela em pauta
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    */
    public function getAllContentPrincipal($tipo = 2){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $select = "id_categoria, categoria_label, descricao, n_index, categoria_url, container_1";
        $sql = "SELECT $select FROM ecommerce_categorias WHERE exibe = 1 AND tipo = $tipo ORDER BY n_index ASC";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            //Containers
            if(count($recordset) > 0){for($i = 0; $i < count($recordset); $i++){
                if($recordset[$i]['container_1'] != null || $recordset[$i]['container_1'] != ""){                
                    $type = explode("_", $recordset[$i]['container_1']);
                  
                    switch($type[0]){
                        
                        case "b":
                            $recordset[$i]['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                            $recordset[$i]['container_1']['slot_type'] = $type[0];
                            break;
                        case "f":
                            $recordset[$i]['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                            $recordset[$i]['container_1']['slot_type'] = $type[0];
                            break;
                        case "h":
                            $recordset[$i]['container_1'] = GraphicsHelperUtils::getHtmlBanners($type[1], $type[0]);
                            break;
                    }
                }
            }}
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getContentPrincipal() '. $e->getMessage();
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
    public function getContentById($id, $view = "", $id_estoque = false){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select  = "id, id_categoria, descricao, descricao_resumo, data, nome, keywords, preco, status, parcelas, unidades_current, last_update, nr_comentarios, ";
        $select .= "preco_real, date_start, date_end, marca, entrega, cidade, pais, id_pedido, id_subcategoria, id_subitem, tipo, referencia, reputation,";
        $select .= "vitrine, promocao, lancamento, exibe_ecommerce, altura, largura, comprimento, diametro, peso, transporte, retirar_local, embrulho, ";
        $select .= "exibe_produtos, unidades_min, percentage, id_master, id_user, id_categoria_menu, url, sob_consulta, frete_gratis";

        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();          
            $foto = ProdutosUtils::getProdutoImageAttribute($recordset['id'], $id_estoque);
            
            $type_price = ProdutosUtils::checkKindOfPrice();
            
            for($i = 0; $i < 6; $i++ ){
                if($foto[$i]){                  
                    $recordset['image_' . $i] = $foto[$i];              
                }else{                   
                    $recordset['image_' . $i] = "";                 
                }
            } 
            
            $recordset['status'] = ProdutosUtils::getStatusImage($recordset['status']);         
            $recordset['valores'] = ProdutosUtils::getCalculatesValues($recordset['preco_real'], $recordset['parcelas'], 0);           
            $recordset['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset['preco_real'], true, $type_price);                       
            $recordset['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset['valores']['parcel'], true, $type_price);           
            //$recordset['estoque'] = $this->getEstoqueProduto($recordset['id']);
            $recordset['categoria'] = ProdutosUtils::getCategoryContent($recordset['id_categoria'], 'id');
            $recordset['data'] = DateTimeUtils::getDateFormateNoTime($recordset['data']);
            $recordset['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset['last_update']);
            $recordset['id_estoque'] = $id_estoque;
            
            $recordset['categoria_string'] = ProdutosUtils::getCategoriaLabel($recordset['id_categoria']);
            
            //Verifica onde será exibido o resultado e formata o resultado
            if($view == 'detalhes'){           
                $recordset['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset['date_start']);
                $recordset['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset['date_end']);
            }else{
                $recordset['date_start'] = DateTimeUtils::getDateFormatCommon($recordset['date_start']);
                $recordset['date_end'] = DateTimeUtils::getDateFormatCommon($recordset['date_end']);
            }
            
            $recordset['video1'] = ProdutosUtils::getStatusImage($recordset['status']);   
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getContentById() '.$e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados por
     * categoria, principalmente Ecommerce
     *
     * @param number
     *
    */
    public function getAllContentByCategoria($cat, $sub, $subitem, $start, $order, $isType = 'exibe_ecommerce', $isAdmin = false){
        
        $id_categoria = ProdutosUtils::getCategoriasId($cat, $sub, $subitem);
        $sql = "SELECT id FROM ecommerce_produtos WHERE tipo = 'simples' AND id = 0";//FAKE
        
        if($cat != "" && $sub == "" && $id_categoria){
            $select = "id, id_categoria, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' AND $isType = 1 AND id_categoria = ". $id_categoria['id_categoria'] . $order['order_by'] ." LIMIT " . $start . ", ". $order['max'];
        }       
        
        if($sub != "" && $subitem == "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' AND $isType = 1 AND id_subcategoria = {$id_categoria['id_subcategoria']}" ." LIMIT " . $start . ", ". $order['max']; 
        }
        
        if($sub != "" && $subitem != "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria, id_subitem, referencia, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' AND $isType = 1 AND id_subitem = {$id_categoria['id_subitem']}" ." LIMIT " . $start . ", ". $order['max']; 
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){                    
                    $recordset_new[$i] = $this->getContentById($recordset[$i]['id']);
                }
                
                return $recordset_new;
                
            }else{
               return false; 
            }
            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getAllContentByCategoria() '. $e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados 
     * pelo tipo e id.
     *
     * @param number
     * @param string
     *
    */
    public function getContentByIdType($id, $type){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, url";
        
        switch($type){
            case "users":
                $sql = "SELECT $select FROM ecommerce_produtos WHERE id_user = $id ";
                break;
            
            case "pedido":
                $sql = "SELECT $select FROM ecommerce_produtos WHERE id_pedido = $id ";
                break;
            
            case "categoria":
                $sql = "SELECT $select FROM ecommerce_produtos WHERE id_categoria = $id AND tipo = 'simples' AND (exibe_produtos = 1)";
                break;
            
            //Existe um metodo igual em ProdutosManager - Admin... é diferente um pouco
            case "ordem_servico":
                $sql = "SELECT $select FROM ecommerce_produtos WHERE ordem_servico = 1 ORDER BY n_index ASC, nome ASC";
                break;
        }
        
        try{
            
            $type_price = ProdutosUtils::checkKindOfPrice();
            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['valor'] = $recordset[$i]['preco_real'];
                    $recordset[$i]['preco_real'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true, $type_price);
                    $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                    $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                    $recordset[$i]['tipo'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria']);

                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);

                    for ($f = 0; $f < 6; $f++){                                     
                        $recordset[$i]['image_' . $f] = $fotos[$f];                   
                    }             
                }
            }
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getContentByType() '. $e->getMessage();
        }
    }    
    
    /**
     * Método para obter as variantes de estoques
     *
     * @param number
     *
    *
    public function getEstoqueProduto($id){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
 
        $select = "id, id_produto, qtd, ref, tamanho, cor, valor, hexadecimal, n_index, tipo";
        $sql = "SELECT ".$select." FROM ecommerce_estoque WHERE id_produto = $id ORDER BY n_index";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['valor'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true, false);
                $recordset[$i]['cor_string'] = ProdutosUtils::getCaracteristicsPropertiesById($recordset[$i]['cor'], 'texto');
                $recordset[$i]['tamanho_string'] = ProdutosUtils::getCaracteristicsPropertiesById($recordset[$i]['tamanho'], 'texto');
            } 

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getEstoqueProdutos() '. $e->getMessage();
        }
    } */
    
    /**
     * Método para obter um item do estoque de um produto específico
     *
     * @param number
     *
    *
    public function getEstoqueItem($id){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.StoreUtils');
 
        $select = "id, id_produto, qtd, ref, tamanho, cor, valor, hexadecimal, n_index, tipo";
        $sql = "SELECT ".$select." FROM ecommerce_estoque WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow(); 
            
            $recordset['valor'] = CurrencyUtils::getPriceFormat($recordset['valor'], true, false);
            $recordset['image']['image_1'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 1);
            $recordset['image']['image_2'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 2);
            $recordset['image']['image_3'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 3);
            $recordset['image']['image_4'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 4);
            $recordset['image']['image_5'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 5);
            $recordset['image']['image_6'] = StoreUtils::getImageEstoque($recordset['id_produto'], $recordset['id'], 6);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getEstoqueProdutos() '. $e->getMessage();
        }
    } */
    
    /**
     * Método para obter o menu com todos
     * os itens do menu ecommerce.
     * As subcategorias restantes foram setadas nos ProdutosUtils
     *
    */
    public function getMenu(){
 
        Yii::import('application.extensions.utils.StoreUtils');
        
        $select  = "id_categoria, categoria_label, categoria_url";        
        $sql = "SELECT $select FROM ecommerce_categorias WHERE tipo = 2 AND exibe = 1 ORDER BY categoria_label ASC"; //Tipo = 2 produtos

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['menu_subcategoria'] = StoreUtils::getSubCategoriaItemsById($recordset[$i]['id_categoria']);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getMenuEcommerce() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function getContentByIdAttribute($attribute, $type = 'simples'){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select  = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, referencia,";
        $select .= "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url, descricao_resumo, ano, modelo ";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = '$type' AND $attribute = 1 ORDER BY nome ASC";
        
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
                
                if(Yii::app()->params['pier_autos']){
                    Yii::import('application.extensions.utils.special.AutosUtils');
                    $recordset[$i]['modelo_string'] = AutosUtils::getModelo($recordset[$i]['modelo'], 'single'); 
                    $recordset[$i]['marca_string'] = AutosUtils::getFabricante($recordset[$i]['marca'], 'single');
                }
            
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                  
                
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
     * Método para recuperar os registros que estão na lista de comparasion
     *
     * @param string
     *
    */
    public function getAllContentToComparasion($tipo = 'produto'){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
        
        $sqlInput = "id = 0";
        if($session['item_' . $tipo . '_0'] != '') $sqlInput  = "id = " . $session['item_' . $tipo . '_0'];
        if($session['item_' . $tipo . '_1'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_1'];
        if($session['item_' . $tipo . '_2'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_2'];
        if($session['item_' . $tipo . '_3'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_3'];
        
        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE $sqlInput";
      
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['preco_real'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['promocao'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['valores'] = ProdutosUtils::getCalculatesValues($recordset[$i]['preco_real'], $recordset[$i]['parcelas'], 0);           
                $recordset[$i]['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset[$i]['valores']['parcel'], true);
                
                for($p = 0; $p < 3; $p++){
                    if($recordset[$i]['id'] == $session['item_' . $tipo . '_' . $p]) {
                        $recordset[$i]['item_compara'] = 'item_' . $tipo . '_' . $p;
                        $recordset[$i]['item_tipo'] = $tipo;
                    }
                }
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                
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
     * Método para recuperar os registros da wish list
     *
     * @param number
     *
    */
    public function getAllContentWishList($id){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $select = "id_produto, name, texto, estampa";
        $sql = "SELECT ".$select." FROM ecommerce_attribute WHERE inteiro = $id AND name = 'wishlist'";
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['estampa'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['estampa']);
                $recordset[$i]['produto'] = ProdutosUtils::getProdutoInformation($recordset[$i]['id_produto'], 'id');
            }  
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getAllContentWishList() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function searchProduto($data){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        if($data['keywords'] != ''){ $keywords = " AND (referencia = '{$data['keywords']}' OR nome LIKE '%{$data['keywords']}%' OR descricao LIKE '%{$data['keywords']}%' OR keywords LIKE '%{$data['keywords']}%')";}else{$keywords = '';}
        if($data['categoria_produto'] != 0){ $categoria = " AND (id_categoria = {$data['categoria_produto']})";}else{$categoria = '';}

        $select  = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, nr_comentarios, ";
        $select .= "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url, descricao_resumo, reputation";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' $keywords $categoria";
        
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
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);                   
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - searchProduto() '. $e->getMessage();
        }
    }
    
}
?>