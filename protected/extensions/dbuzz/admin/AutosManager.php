<?php
/*
 * This Class is used to controll all functions related the feature Automóveis
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
    public function getAllContent($isAdmin = false, $tipo = "auto", $id_user = 0, $start = 0){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        $commentHandler = new ComentariosManager();
        
        $query = ProdutosUtils::getMoreFilters();
        
        $select  = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, pais, parcelas, reputation, ano, modelo, ";
        $select .= "unidades_current, marca, data, last_update, tipo, unidades_min, id_master, url, descricao_resumo, referencia";

        $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = '$tipo' $query ORDER BY id_categoria DESC";
        
        ($isAdmin) ? $orderBy = 'nome ASC' : $orderBy = 'id_categoria DESC';
        
        if($tipo == "todos"){$sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' $query ORDER BY $orderBy LIMIT $start, 10";}
        if($tipo == "owner"){ $sql = "SELECT $select FROM ecommerce_produtos WHERE tipo = 'auto' $query AND id_user = $id_user ORDER BY $orderBy LIMIT $start, 10";}
      
       
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
                    $recordset[$i]['reviews'] = $commentHandler->getLikesByIdGeneral($recordset[$i]['id'], "produtos");
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
        $select .= "n_index, reputation, views, ano, modelo, unidade";

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
            $send_error = MethodUtils::sendError(array('message' => 'ERROR: AutosManager - getContentById()', 'trace' => $e->getMessage()), true);  
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
        $sql = "SELECT id FROM ecommerce_produtos WHERE id = 0";//FAKE
        
        (Yii::app()->params['ramo'] == "ecommerce") ? $isEcommerce = true : $isEcommerce = false;
        
        
        if($cat != "" && $sub == "" && $id_categoria){
            $select = "id, id_categoria";
            $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE tipo = 'autos' AND id_categoria = ". $id_categoria['id_categoria'] . $order['order_by'] ." LIMIT " . $start . ", ". $order['max'];
            
        }       
        
        if($sub != "" && $subitem == "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria";
            $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_subcategoria = ". $id_categoria['id_subcategoria'] . ""; 
           
        }
        
        if($sub != "" && $subitem != "" && $id_categoria){
            $select = "id, id_categoria, id_subcategoria, id_subitem";
            $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_subitem = ". $id_categoria['id_subitem'] . ""; 
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);         
            $recordset = $command->queryAll();
            
            if($recordset){
                $recordset_new = array();
                for($i = 0; $i < count($recordset); $i++){
                    if(!$isAdmin) $recordset_new[$i] = $this->getContentById($recordset[$i]['id'], '', $recordset[$i]['id_estoque']);
                    if( $isAdmin) $recordset_new[$i] = $this->getContentById($recordset[$i]['id']);
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
    public function getContentByIdType($id, $type, $start = 0){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, descricao, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, url, ano, modelo";
        
        switch($type){
            case "users":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_user = $id AND tipo = 'auto'";
                break;
            
            case "pedido":
                $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE id_pedido = $id AND tipo = 'auto'";
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
            echo 'ERROR: AutosManager - getContentByType() '. $e->getMessage();
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
            echo 'ERROR: AutosManager - submitContent() '.  $e->getMessage();
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
            echo 'ERROR: AutosManager - removeContent() '. $e->getMessage();
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
            echo 'ERROR: AutosManager - removeImage() '. $e->getMessage();
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
            echo 'ERROR: AutosManager - updateStatus() '. $e->getMessage();
        }
        return Yii::t('commonForm', 'product_status_updated');
    }
    
    /**
     * Método para recuperar os registros organizados 
     * pelo atributo: vitrine, lançamento, promoção.
     *
     * @param string
     *
    */
    public function getContentByIdAttribute($attribute){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE $attribute = 1 AND tipo = 'auto'";
        
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
            echo 'ERROR: AutosManager - getContentByIdAttribute() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros ano modelo
     *
     * @param string
     *
    */
    public function getAllVeiculosAnos($tipo = false){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
        
        $sqlInput = "id = 0";
        if($session['item_' . $tipo . '_0'] != '') $sqlInput  = "id = " . $session['item_' . $tipo . '_0'];
        if($session['item_' . $tipo . '_1'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_1'];
        if($session['item_' . $tipo . '_2'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_2'];
        if($session['item_' . $tipo . '_3'] != '') $sqlInput .= " OR id = " . $session['item_' . $tipo . '_3'];
        
        $sql = "SELECT * FROM veiculos_ano_modelo";
      
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                /*
                $recordset[$i]['preco_real'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true);
                $recordset[$i]['promocao'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['valores'] = ProdutosUtils::getCalculatesValues($recordset[$i]['preco_real'], $recordset[$i]['parcelas'], 0);           
                $recordset[$i]['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset[$i]['valores']['parcel'], true);     
                 * 
                 */                      
            }  
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getAllVeiculosAnos() '. $e->getMessage();
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
        
        $sql = "SELECT * FROM veiculos_fabricante";      
        
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
    public function getModelos($fabricante = false, $isId = false){
        
        $sql = "SELECT * FROM veiculos_modelo"; 
        if($fabricante) $sql = "SELECT * FROM veiculos_modelo WHERE marca = $fabricante";      
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            if(!$isId) $recordset = $command->queryAll(); 
            if( $isId) $recordset = $command->queryRow(); 
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosManager - getAllFabricantes() '. $e->getMessage();
        }
    }
    
}
?>