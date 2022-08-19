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
    public function getAllContent($isAdmin = false, $tipo = "simples", $id_user = 0, $start = 0){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        $query = ProdutosUtils::getMoreFilters();
        
        $select  = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, pais, parcelas, reputation, n_index, ";
        $select .= "unidades_current, marca, data, last_update, tipo, unidades_min, id_master, url, descricao_resumo, referencia";

        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = '$tipo' $query ORDER BY id_categoria DESC";        
        if($tipo == "todos"){$sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' $query ORDER BY nome ASC LIMIT $start, 10";}
        if($tipo == "owner"){ $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'simples' $query AND id_user = $id_user ORDER BY nome ASC LIMIT $start, 10";}
      
        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){                
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);                
                    $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                    $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);            
                    $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                    
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
    public function getAllContentComprar($tipo = "produto", $start = 0, $args = array()){
        
    
        $sql = "SELECT * FROM (SELECT A.id, A.id_categoria, A.nome, A.preco_real, A.lancamento, A.tipo, A.promocao, B.id_produto, B.id AS id_estoque, A.n_index, B.qtd FROM ecommerce_produtos AS A INNER JOIN ecommerce_estoque AS B ON A.id = B.id_produto WHERE A.exibe_ecommerce = 1 AND B.qtd > 0 ORDER BY A.n_index ASC) AS T GROUP BY id_produto ORDER BY nome ASC LIMIT $start, {$args['limite_pagina']}";
  
        
        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    if($recordset[$i]['tipo'] == 'produto') $recordset_new[$i] = $this->getContentById($recordset[$i]['id'], '', $recordset[$i]['id_estoque']);
                    if($recordset[$i]['tipo'] == 'elearn')  $recordset_new[$i] = $this->getContentById($recordset[$i]['id'], '', $recordset[$i]['id_estoque']);
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
    * Método para recuperar os registros da tabela em pauta
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    *
    public function getAllContentPrincipal($tipo = "simples"){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $select = "id_categoria, categoria_label, descricao, n_index, categoria_url, container_1, descricao_resumo, url";
        $sql = "SELECT $select FROM ecommerce_categorias WHERE exibe = 1 AND tipo = '$tipo' ORDER BY n_index ASC";

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
        
    } */

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

        $select  = "id, id_categoria, descricao, descricao_resumo, data, nome, keywords, preco, status, parcelas, unidades_current, last_update,";
        $select .= "preco_real, date_start, date_end, marca, entrega, cidade, pais, id_pedido, id_subcategoria, id_subitem, tipo, ordem_servico, ";
        $select .= "vitrine, promocao, lancamento, exibe_ecommerce, altura, largura, comprimento, diametro, peso, transporte, retirar_local, embrulho, ";
        $select .= "exibe_produtos, unidades_min, percentage, id_master, id_user, id_categoria_menu, url, referencia, sob_consulta, frete_gratis, ";
        $select .= "n_index, reputation, views ";

        $sql = "SELECT $select FROM ecommerce_produtos WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();          
            $foto = ProdutosUtils::getProdutoImageAttribute($recordset['id'], $id_estoque);
            
            for($i = 0; $i < 6; $i++ ){
                if($foto[$i]){                  
                    $recordset['image_' . $i] = $foto[$i];              
                }else{                   
                    $recordset['image_' . $i] = "";                 
                }
            } 
            
            $recordset['status'] = ProdutosUtils::getStatusImage($recordset['status']);         
            $recordset['valores'] = ProdutosUtils::getCalculatesValues($recordset['preco_real'], $recordset['parcelas'], 0);           
            $recordset['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset['preco_real'], true);                       
            $recordset['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset['valores']['parcel'], true);           
            //$recordset['estoque'] = $this->getEstoqueProduto($recordset['id']);
            $recordset['categoria'] = ProdutosUtils::getCategoryContent($recordset['id_categoria'], 'id');
            $recordset['data'] = DateTimeUtils::getDateFormateNoTime($recordset['data']);
            //$recordset['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset['last_update']);
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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR: ProdutosManager - getContentById()', 'trace' => $e->getMessage()), true);  
            echo 'ERROR: ProdutosManager - getContentById() '.$e->getMessage();
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
    public function getContentByIdType($id, $type, $start = 0){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, url";
        
        switch($type){
            case "users":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_user = $id AND tipo = 'simpels'";
                break;
            
            case "pedido":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_pedido = $id AND tipo = 'simples'";
                break;
            
            case "ordem_servico":
                $start = ($start -1) * 10; if($start < 0) $start = 0;
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE ordem_servico = 1 ORDER BY nome ASC LIMIT $start, 10";
                break;
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){ 
                $recordset[$i]['valor'] = $recordset[$i]['preco_real'];
                $recordset[$i]['preco_real'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);                
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['tipo'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria']);
                
                $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - getContentByType() '. $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitContent($get_post){
   
        $select = "nome, descricao, id_categoria, data, slot1";
        $values = $get_post[0]."', '".$get_post[1]."', '".$get_post[2]."', '".$get_post['data'] ."', '".$get_post[3];
        
        if ($get_post['action'] != "editar" ){
            $sql =  "INSERT INTO ecommerce_produtos (". $select .") VALUES ('". $values . "')";
        }else{
            $sql  = "UPDATE ecommerce_produtos SET nome = '$get_post[0]', descricao = '$get_post[1]', id_categoria = '$get_post[2]', slot1 = '$get_post[3]',";
            $sql .= "last_update = '". date("Y-m-d H:i:s")."' ";
            $sql .= "WHERE id = ". $get_post['id'] . "";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: ProdutosManager - submitContent() '.  $e->getMessage();
        }
    }

    /**
     * Método para remover um determinado registro
     *
     * @param number
     *
    */
    public function removeContent($id){

        $sql = "DELETE FROM ecommerce_produtos WHERE id = " . $id ;
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo "Produto removido com sucesso";

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: ProdutosManager - removeContent() '. $e->getMessage();
        }
    }
    
    /**
     * Método para remover um determinado registro
     *
     * @param number
     *
    */
    public function removeImage($id_produto, $id_image, $name_image){

        $sql = "DELETE FROM ecommerce_attribute WHERE id_produto = " . $id_produto . " AND name = 'produto_IMG_$id_image'" ;
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            $imageFolders = array('', 'original/', 'thumbs_50/', 'thumbs_120/', 'thumbs_200/', 'thumbs_250/', 'thumbs_350/', 'thumbs_650/');

            foreach ($imageFolders as $folder) {

                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/media/user/images/$folder" . $name_image)) {
                   unlink($_SERVER['DOCUMENT_ROOT'] . "/media/user/images/$folder" . $name_image);
                }
            }
            
            echo "Image removida com sucesso";

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: ProdutosManager - removeImage() '. $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o status do produto
     *
     * @param array
     *
    */
    public function updateStatus($data){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $status = $data['status'];
        $id_produto = $data['id_produto'];

        $sql = "UPDATE ecommerce_produtos SET status = '$status' WHERE id = $id_produto";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: ProdutosManager - updateStatus() '. $e->getMessage();
        }
        return Yii::t('commonForm', 'product_status_updated');
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
    }*/
    
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
    }
     * */
     
    
    /**
     * Método para obter o menu com todos
     * os itens do menu ecommerce.
     * As subcategorias restantes foram setadas nos ProdutosUtils
     *
     *
    */
    public function getMenuEcommerce(){
 
        Yii::import('application.extensions.utils.StoreUtils');
        
        $select  = "id_categoria, categoria_label, categoria_url";        
        $sql = "SELECT ".$select." FROM ecommerce_categorias WHERE exibe = 1";

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
    *
    public function getContentByIdAttribute($attribute){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE $attribute = 1 AND tipo = 'simples'";
        
        
        if(Yii::app()->params['ramo'] == "ecommerce"){
        $select = "A.id, A.id_categoria, A.descricao, A.descricao_resumo, A.date_start, A.date_end, A.nome, A.preco_real, A.cidade, " .
                  "A.pais, A.parcelas, A.unidades_current, A.marca, A.data, A.tipo, A.lancamento, A.promocao, A.url, B.id_produto, B.id AS id_estoque";
        $sql = "SELECT * FROM (SELECT ".$select." FROM ecommerce_produtos AS A INNER JOIN ecommerce_estoque as B ON A.id = B.id_produto WHERE A.$attribute = 1 AND B.qtd > 0 ORDER BY B.n_index ASC) AS T GROUP BY id_produto";
        } 
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['promocao'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['tipo'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria']);
                $recordset[$i]['valores'] = ProdutosUtils::getCalculatesValues($recordset[$i]['preco_real'], $recordset[$i]['parcelas'], 0);                                 
                $recordset[$i]['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset[$i]['valores']['parcel'], true);
                (isset($recordset[$i]['id_estoque'])) ? $recordset[$i]['id_variante'] = $recordset[$i]['id_estoque'] : $recordset[$i]['id_variante'] = 0;
                
                if(Yii::app()->params['ramo'] == "ecommerce"){
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id'], $recordset[$i]['id_variante']);
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
    } */
    
    /**
     * Método para recuperar os registros que estão na lista de comparasion
     *
     * @param string
     *
    *
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
     
     */
    
   /**
    * Método para buscar produtos
    *  
    * Este método utiliza o getProdutoImageAttribute que busca as images 
    * na tabela ecommerce_attributes. Esta verifica todas a imagens que estão cadastradas
    * adiciona no array para ser usado. 
    * 
    */
    public function searchContent(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        $query = ProdutosUtils::getMoreFilters();

        if(isset($_POST['titulo']) && $_POST['titulo'] != ''){ $query_titulo = " AND (nome LIKE '{$_POST['titulo']}%') ";}else{$query_titulo = "";}
        if(isset($_POST['referencia']) && $_POST['referencia'] != ''){ $query_referencia = " AND (referencia LIKE '{$_POST['referencia']}%') ";}else{$query_referencia = "";}
        
        $sql = "SELECT * FROM ecommerce_produtos WHERE tipo = 'simples' $query $query_referencia $query_titulo ORDER BY nome ASC";
        
        try{          
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){                                 
                    $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                    $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);            
                    $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);                    
                    $recordset[$i]['categoria'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria'], 'id');
                } 
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosManager - searchContent() '. $e->getMessage();
        }       
    }
    
}

?>