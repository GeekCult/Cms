<?php
/*
 * This Class is used to controll all functions related the feature Categorias
 *
 * @author CarlosGarcia
 *
 *
 */

class CategoriaManager {

    /**
     * Metodo para recuperar os textos
     *
     *
    */
    public function getAllContent() {
        
        Yii::import('application.extensions.utils.HelperUtils');
        
        $select = "id, id_page, nome";
        $sql = "SELECT ".$select." FROM conteudo_categorias";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll(); 
            
            for($i =0; $i < count($recordset); $i++){                
                $recordset[$i]['page_name'] = HelperUtils::getPageNameById($recordset[$i]['id_page']);                
            }

            return $recordset;

        }catch(CDbException $e){            
            echo 'ERROR: CategoriaManager - getAllContent() '.$e->getMessage();
        }
    }

    /**
     * Método para recuperar as categorias de cada action especifica
     * 
     * @param number
     *
    */
    public function getAllContentById($id_page, $id_sub = false){
        
        try{
            if($id_page != ""){

                $sql = "SELECT id, id_page, nome FROM conteudo_categorias WHERE id_page = $id_page";
                if($id_sub) $sql = "SELECT id, id_page, nome FROM conteudo_categorias WHERE id_page = $id_page AND id_subcategoria = $id_sub";

                $command = Yii::app()->db->createCommand($sql);
                $recordset = $command->queryAll();

                if(count($recordset) > 0){
                    return $recordset;
                }else{
                    $recordset[0]["nome"] = "Nenhuma categoria";
                    $recordset[0]["id"] = "";
                    return $recordset;
                }

            }else{
                $recordset[0]["nome"] = "Nenhuma categoria";
                $recordset[0]["id"] = "";
                return $recordset;
            }
        
        }catch(CDbException $e){
            echo 'ERROR: CategoriaManager - getAllContentById() '.$e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar uma determinada categoria pelo id da pagina
     *
     * @param number
     *
    */
    public function getContentByLabel($label, $isName = false){
        
        $sql = "SELECT id, id_page, nome FROM conteudo_categorias WHERE id = $label";
        if($isName) $sql = "SELECT id, id_page, nome FROM conteudo_categorias WHERE nome = '$label'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getContentByLabel() '. $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar uma determinada categoria pelo id da pagina
     *
     * @param number
     *
    */
    public function getContentById($id){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        $select = "id, id_page, nome, descricao, container_1";
        $sql = "SELECT ".$select." FROM conteudo_categorias WHERE id = $id ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset) $recordset['graphic'] = GraphicsUtils::getCoolContent($recordset['container_1']);
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getContentById() '. $e->getMessage();
        }
    }

    /**
     * 
     * Metodo para recuperar uma determinada categoria
     *
     * @param number
     *
    */
    public function getAllCoolContent($id_page){

        $select = "id, id_page, nome";
        $sql = "SELECT ".$select." FROM conteudo_categorias WHERE id_page = $id_page ";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getAllCoolContent() '. $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as informação da categoria do ecommerce
     * Adicionado variante para pegar por ID tb!
     *
     * @param number/string
     * @param boolean
     *
    */
    public function getProductCategoryByLabel($label, $isById = false){

        $select = "id_categoria, categoria_label, categoria_url, n_index, descricao";
        $sql = "SELECT ".$select." FROM ecommerce_categorias WHERE categoria_url = '$label'";
        if($isById) $sql = "SELECT ".$select." FROM ecommerce_categorias WHERE id_categoria = $label";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getProductCategoryByLabel() '.$e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as categoria dos produtos, loja
     *
     * @param number
     *
    */
    public function getAllProductCategories($tipo = 0){

        $select = "id_categoria, categoria_label, categoria_url, n_index, descricao, container_1";
        $sql = "SELECT $select FROM ecommerce_categorias WHERE tipo = $tipo ORDER BY n_index ASC";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getAllProductCategories() '. $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as categoria dos produtos, loja com imagem e descricao.
     * Usada para exibir categoria na página
     *
     * @param number
     *
    */
    public function getProductCategoriaInfos($id_categoria = false, $tipo = 0){
        
        Yii::import('application.extensions.utils.GraphicsUtils');

        $select = "id_categoria, categoria_label, categoria_url, n_index, descricao, container_1";
        if(!$id_categoria) $sql = "SELECT $select FROM ecommerce_categorias WHERE tipo = $tipo ORDER BY n_index ASC";
        if( $id_categoria) $sql = "SELECT $select FROM ecommerce_categorias WHERE id_categoria = $id_categoria AND tipo = $tipo";
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                if($recordset['container_1'] != '') $recordset['container_1'] = GraphicsUtils::getCoolContent($recordset['container_1']);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: CategoriaManager - getProductCategoriaInfos() '. $e->getMessage();
        }
    }
    
    
    
    /**
     * 
     * Método para recuperar as sucategoria dos produtos, loja
     * relacionado a categoria
     *
     * @param number
     *
    */
    public function getAllProductSubCategories($id_categoria, $isAll = false, $tipo = 0){

        $select = "id_subcategoria, subcategoria_label, subcategoria_url, id_categoria";
        $sql = "SELECT $select FROM ecommerce_subcategorias WHERE id_categoria = $id_categoria AND tipo = $tipo";
        if($isAll)$sql = "SELECT $select FROM ecommerce_subcategorias WHERE tipo = $tipo";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as suitem de produtos, loja
     * relacionado a subcategoria
     *
     * @param number
     *
    */
    public function getSubItemsEcommerce($id_subcategoria, $isAll = false, $tipo = 0){

        $select = "id_subitem, subitem_label, subitem_url, id_categoria, id_subcategoria";
        $sql = "SELECT $select FROM ecommerce_subitems WHERE id_subcategoria = $id_subcategoria";
        if($isAll)$sql = "SELECT $select FROM ecommerce_subitems WHERE tipo = $tipo";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitContent($data){              
        
        if($data[3] == "novo"){            
            $select = "id_page, nome";
            $values = $data[0] . "', '" . $data[1];
            $sql =  "INSERT INTO conteudo_categorias (". $select .") VALUES ('". $values . "')";            
        }else{            
            $values = "nome = '" . $data[1] ."', id_page = " . $data[0];
            $sql =  "UPDATE conteudo_categorias SET ". $values ." WHERE id = $data[4]";
        }  

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitContentEcommerce($data){
        
        Yii::import('application.extensions.utils.StringUtils');
        $urlString = StringUtils::StringToUnderline($data[1]);
        
        if($data[3] == "novo"){            
            $select = "categoria_label, categoria_url, exibe, tipo";
            $values = "'{$data[1]}','{$urlString}', 1, {$data['tipo']}";
            $sql =  "INSERT INTO ecommerce_categorias ($select) VALUES ($values)";            
        }else{            
            $values = "categoria_label = '{$data[1]}', categoria_url = '{$urlString}'";
            $sql =  "UPDATE ecommerce_categorias SET $values WHERE id = $data[4]";
        }  

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma nova subcategoria para ecommerce
     *
     * @param array
     *
    */
    public function submitSubContentEcommerce($data){ 
        
        Yii::import('application.extensions.utils.StringUtils');
        $urlString = StringUtils::StringToUnderline($data[0]);
        
        if($data[1] == "novo"){            
            $select = "subcategoria_label, id_categoria, subcategoria_url, tipo";
            $values = "'{$data[0]}', '{$data[2]}', '{$urlString}', {$data['tipo']}";
            $sql =  "INSERT INTO ecommerce_subcategorias ($select) VALUES ($values)"; 
            
        }else{            
            $values = "subcategoria_label = '{$data[0]}', subcategoria_url = '{$urlString}'";
            $sql =  "UPDATE ecommerce_subcategorias SET $values WHERE id = $data[2]";
        }  

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar as informacoes de uma categoria existente
     *
     * @param array
     *
    */
    public function updateInformacoesCategory($data){

        try{                            
            $values = "descricao = '".$data['descricao'] . "', nome = '".$data['nome']."', container_1 = '".$data['capa']."'";
            $sql =  "UPDATE conteudo_categorias SET ". $values ." WHERE id = " . $data['id'] . "";                                       
            
            $comando = Yii::app()->db->createCommand($sql);
            $success = $comando->execute();
        
            echo Yii::t("messageStrings", "message_result_category_update");

        }catch (CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar uma determinada categoria pelo id da pagina
     *
     * @param number
     *
    */
    public function getAllSubContentEcommerceById($id, $tipo = 0){
        
        $select = "id_subcategoria, id_categoria, subcategoria_label";
        $sql = "SELECT $select FROM ecommerce_subcategorias WHERE id_categoria = $id AND tipo = $tipo";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: CategoriasManager - getAllSubContentEcommerceById() " . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma nova subcategoria para galeria
     *
     * @param array
     *
    */
    public function submitSubContentGaleria($data){ 
        
        Yii::import('application.extensions.utils.StringUtils');
        $urlString = StringUtils::StringToUnderline($data[0]);
        
        $date = date("Y-m-d H:i:s");
        
        if($data[1] == "novo"){            
            $select = "titulo, id_categoria, url, data, exibe, last_update";
            $values = $data[0] . "', '" . $data[2]. "', '" . $urlString . "', '" . $date . "', 1, '" . $date;
            $sql =  "INSERT INTO general_galerias_subcategorias (". $select .") VALUES ('". $values . "')";            
        }else{            
            $values = "titulo = '" . $data[0] ."', url = '" . $urlString ."', last_update = '{$date}'";
            $sql =  "UPDATE general_galerias_subcategorias SET ". $values ." WHERE id = $data[2]";
        }  

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: CategoriasManager - submitSubContentGaleria() ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma nova subcategoria para galeria
     *
     * @param array
     *
    */
    public function submitContentGaleria($data){ 
        
        $select = "id_page, id_subcategoria, nome";
        $values = $data['id_page'] . "', '" . $data['id_subcategoria']. "', '" . $data['title'];
        $sql =  "INSERT INTO conteudo_categorias (". $select .") VALUES ('". $values . "')";            

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: CategoriasManager - submitContentGaleria() " . $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as sucategoria das galerias
     * relacionado a categoria
     *
     * @param number
     *
    */
    public function getAllSubGaleriasById($id_categoria, $isAll = false, $isAllRows = true){

        $select = "id, titulo, url, id_categoria, descricao, exibe, container_1";
        $sql = "SELECT ".$select." FROM general_galerias_subcategorias WHERE id_categoria = $id_categoria";
        if($isAll)$sql = "SELECT ".$select." FROM general_galerias_subcategorias";

        try {
            $command = Yii::app()->db->createCommand($sql);
            if( $isAllRows) $recordset = $command->queryAll();
            if(!$isAllRows) $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar as sucategoria das galerias
     * relacionado a categoria
     *
     * @param number
     *
    */
    public function getAllSubGaleriasBySubCategoria($id_subcategoria, $isAll = false, $isAllRows = true){

        $select = "id, titulo, url, id_categoria, descricao, exibe, container_1";
        $sql = "SELECT ".$select." FROM general_galerias_subcategorias WHERE id = $id_subcategoria";
        if($isAll)$sql = "SELECT ".$select." FROM general_galerias_subcategorias";

        try {
            $command = Yii::app()->db->createCommand($sql);
            if( $isAllRows) $recordset = $command->queryAll();
            if(!$isAllRows) $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Metodo para salvar um novo registro
     *
     * @param array
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM conteudo_categorias WHERE id ='" . $data['id']. "'";

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}
?>