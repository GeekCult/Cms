<?php
/*
 * This Class is used to controll all functions related the feature Autos
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 * $ua = new dbUserAttribute();
 *
 */

class AutosManager{

   /**
    * Método para recuperar os registros da tabela em pauta
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    */
    public function getAllContent($tipo = "auto", $start = 0, $args = array()){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        
        $commentHandler = new ComentariosManager();
        
        ((isset($args['limite_pagina']) && $args['limite_pagina'] != "")) ? $limite = $args['limite_pagina'] : $limite = 10;
        
        $select  = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, pais, parcelas, reputation, nr_comentarios, ";
        $select .= "unidades_current, marca, data, last_update, tipo, unidades_min, id_master, url, referencia, descricao_resumo";
      
        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = '$tipo' AND exibe_produtos = 1 ORDER BY n_index ASC, nome ASC LIMIT $start, $limite";
        
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
            echo 'ERROR: AutosManager - getAllContent() '. $e->getMessage();
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
    public function getAllContentPrincipal($tipo = 4){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $select = "id_categoria, categoria_label, descricao, n_index, categoria_url, container_1";
        $sql = "SELECT $select FROM ecommerce_categorias WHERE exibe = 1 AND tipo = $tipo ORDER BY n_index ASC, categoria_label ASC";

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
            echo 'ERROR: AutosManager - getContentPrincipal() '. $e->getMessage();
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
        
        Yii::import('application.extensions.utils.special.AutosUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');

        $select  = "id, id_categoria, descricao, descricao_resumo, data, nome, keywords, preco, status, parcelas, unidades_current, last_update, nr_comentarios, ";
        $select .= "preco_real, date_start, date_end, marca, entrega, cidade, pais, id_pedido, id_subcategoria, id_subitem, tipo, referencia, reputation,";
        $select .= "vitrine, promocao, lancamento, exibe_ecommerce, altura, largura, comprimento, diametro, peso, transporte, retirar_local, embrulho, ";
        $select .= "exibe_produtos, unidades_min, percentage, id_master, id_user, id_categoria_menu, url, sob_consulta, frete_gratis, ano, modelo";

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
            $recordset['modelo_string'] = AutosUtils::getModelo($recordset['modelo'], 'single'); 
            $recordset['marca_string'] = AutosUtils::getFabricante($recordset['marca'], 'single'); 
            
            $recordset['categoria_string'] = ProdutosUtils::getCategoriaLabel($recordset['id_categoria']);
            
            //Verifica onde será exibido o resultado e formata o resultado
            if($view == 'detalhes'){           
                $recordset['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset['date_start']);
                $recordset['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset['date_end']);
            }else{
                $recordset['date_start'] = DateTimeUtils::getDateFormatCommon($recordset['date_start']);
                $recordset['date_end'] = DateTimeUtils::getDateFormatCommon($recordset['date_end']);
            }
            
            $recordset['tags'] = StringUtils::transFormStringToArray($recordset['keywords']);
            
            $recordset['video1'] = ProdutosUtils::getStatusImage($recordset['status']);   
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getContentById() '.$e->getMessage();
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
        $sql = "SELECT id FROM ecommerce_produtos WHERE tipo = 'auto' AND id = 0";//FAKE
        
        if($cat != "" && $sub == "" && $id_categoria){
            $select = "id, id_categoria, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' AND $isType = 1 AND id_categoria = ". $id_categoria['id_categoria'] . $order['order_by'] ." LIMIT " . $start . ", ". $order['max'];
        }       
        
        if($sub != "" && $subitem == "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' AND $isType = 1 AND id_subcategoria = {$id_categoria['id_subcategoria']}"; 
        }
        
        if($sub != "" && $subitem != "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria, id_subitem, referencia, n_index";
            $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' AND $isType = 1 AND id_subitem = {$id_categoria['id_subitem']}"; 
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
            echo 'ERROR: AutosManager - getAllContentByCategoria() '. $e->getMessage();
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
            
            //Existe um metodo igual em AutosManager - Admin... é diferente um pouco
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
            echo 'ERROR: AutosManager - getContentByType() '. $e->getMessage();
        }
    }    
    
    /**
     * Método para obter o menu com todos
     * os itens do menu ecommerce.
     * As subcategorias restantes foram setadas nos ProdutosUtils
     * 
     * Tipo = 0 - ecommerce
     * Tipo = 1 - portfolio
     * Tipo = 2 - simples
     * Tipo = 3 - elearn
     * Tipo = 4 - autos
     *
    */
    public function getMenu(){
 
        Yii::import('application.extensions.utils.StoreUtils');
        
        $select  = "id_categoria, categoria_label, categoria_url";        
        $sql = "SELECT $select FROM ecommerce_categorias WHERE tipo = 4 AND exibe = 1 ORDER BY n_index ASC, categoria_label ASC"; //Tipo = 2 produtos

        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['menu_subcategoria'] = StoreUtils::getSubCategoriaItemsById($recordset[$i]['id_categoria'], "ORDER BY n_index ASC");
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getMenuEcommerce() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function getContentByIdAttribute($attribute, $type = 'auto'){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select  = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, ";
        $select .= "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url, descricao_resumo";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = '$type' AND $attribute = 1";
        
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
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                   
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getContentByIdAttribute() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function searchAutos($data){
        
        Yii::import('application.extensions.utils.special.AutosUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $search = "";
        if($data['keywords'] != ''){ $search .= " AND (nome LIKE '%{$data['keywords']}%' OR descricao LIKE '%{$data['keywords']}%' OR keywords LIKE '%{$data['keywords']}%')"; }
        if($data['fabricante'] != 0){ $search .= " AND (marca = {$data['fabricante']})";}
        if($data['combustivel'] != 0){ $search .= " AND (unidade = '{$data['combustivel']}')";}
        if($data['ano_inicial'] != 0){ $search .= " AND (ano >= '{$data['ano_inicial']}')";}
        if($data['ano_final'] != 0){ $search .= " AND (ano <= '{$data['ano_final']}')";}
        if($data['valor_min'] != 0){ $search .= " AND (preco_real >= " . $data['valor_min']. ")";}
        if($data['valor_max'] != 0){ $search .= " AND (preco_real <= " . $data['valor_max']. ")";}

        $select  = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, nr_comentarios, ";
        $select .= "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url, descricao_resumo, reputation, ano, modelo";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' $search";
        
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
                $recordset[$i]['modelo_string'] = AutosUtils::getModelo($recordset[$i]['modelo'], 'single');
                $recordset[$i]['marca_string'] = AutosUtils::getFabricante($recordset[$i]['marca'], 'single');
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);                   
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - searchAutos() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de fabricantes
     *
     * @param string
     *
    */
    public function getAllFabricantes($tipo = false){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
        
        $sql = "SELECT * FROM veiculos_fabricante ORDER BY nome ASC";      
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getAllFabricantes() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de fabricantes
     *
     * @param string
     *
    */
    public function getModelos($fabricante = false){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
        
        $sql = "SELECT * FROM veiculos_modelo"; 
        if($fabricante) $sql = "SELECT * FROM veiculos_modelo WHERE fabricante = $fabricante ORDER BY nome ASC";      
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getAllFabricantes() '. $e->getMessage();
        }
    }
    
}
?>