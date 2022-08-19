<?php
/*
 * This Class is used to controll all functions related the feature Store
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */

class LojaManager {

//    /**
//     * Método para recuperar um registros de algum dos tipos criados
//     * 
//     * It's using the manager_purplepier to handle with these
//     * records  
//     *
//     * @param string
//     *
//    */
//    public function getAllLogs(){
//        
//        Yii::import('application.extensions.utils.DateTimeUtils');
//        $select = "id, ip, user_id, time, uri";
//        $sql = "SELECT ".$select." FROM activity_log ORDER BY id DESC LIMIT 200";
//
//        try{
//            $command = Yii::app()->db->createCommand($sql);
//            $recordset = $command->queryAll();
//            
//            for($i = 0; $i < count($recordset); $i++){
//                $recordset[$i]['time'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['time']);
//            }
//
//            return $recordset;
//
//        }catch(CDbException $e){
//            Yii::trace("ERROR ".$e->getMessage());
//            echo $e->getMessage();
//        }
//    }
    
    /**
     * Método para recuperar os dados dos settings da categoria
     * Dados como: Descrição, image, index etc.
     * 
     *
     * @param string
     *
    */
    public function getSettingsCategoria($id){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $select = "id_categoria, categoria_label, descricao, n_index, menu_1, menu_2, menu_3, exibe, container_1";
        $sql = "SELECT $select FROM ecommerce_categorias WHERE id_categoria = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            //TODO - criar esse method em uma classe estática, tem vários igual ele
            if($recordset['container_1'] != ""){
                $type = explode("_", $recordset['container_1']);

                switch($type[0]){

                    case "b":
                        $recordset['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                        $recordset['container_1']['slot_type'] = $type[0];
                        break;
                    case "f":
                        $recordset['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                        $recordset['container_1']['slot_type'] = $type[0];
                        break;
                    case "h":
                        $recordset['container_1'] = GraphicsHelperUtils::getHtmlBanners($type[1], $type[0]);
                        break;
                }
            }
          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: LojaManager - getsettingsCategoria() " . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro de sub item da sub categoria
     * esse nome num é muito bom mais fica diferente.
     *
     * @param array
     *
    */
    public function submitContent($data){ 
        
        Yii::import('application.extensions.utils.StringUtils');
        $urlString = StringUtils::StringToUnderline($data['subitem_label']);
        
        if($data['action'] == "novo"){            
            $select = "id_categoria, id_subcategoria, subitem_label, subitem_url, tipo";
            $values = "'{$data['id_categoria']}', '{$data['id_subcategoria']}', '{$data['subitem_label']}', '$urlString', {$data['tipo']}";
            $sql =  "INSERT INTO ecommerce_subitems ($select) VALUES ($values)";            
        }else{            
            $values = "subitem_label = '{$data['label_subitem']}', subitem_url = $urlString'";
            $sql =  "UPDATE ecommerce_subitems SET $values WHERE id = {$data['id_subcategoria']}";
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
     * Método para remover uma categoria de subitem, subcategoria ou categoria
     *
     * @param array
     *
    */
    public function removeCategory($data){ 
        
        switch ($data['type']){
            case "categoria":         
                $sql =  "DELETE FROM ecommerce_categorias WHERE id_categoria =" . $data['id']; 
                break;
            case "subcategoria":            
                $sql =  "DELETE FROM ecommerce_subcategorias WHERE id_subcategoria =" . $data['id']; 
                break;
            case "subitem":            
                $sql =  "DELETE FROM ecommerce_subitems WHERE id_subitem =" . $data['id']; 
                break;
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
     * Método para salvar os settings de categoria principal 
     *
     * @param array
     *
    */
    public function saveSettingsMainCategoria($data){              
                    
        $values  = "categoria_label = '{$data['nome']}', n_index = '{$data['index']}', descricao = '{$data['descricao']}', container_1 = '{$data['graphic']}', exibe = '{$data['exibe']}', ";
        $values .= "menu_1 = '{$data['menu_principal']}', menu_2 = '{$data['menu_2']}', menu_3 = '{$data['menu_3']}'";
        $sql =  "UPDATE ecommerce_categorias SET $values WHERE id_categoria = {$data['id_categoria']}"; 

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            $data['result'] = $control;
            
            return $data;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            $data['error'] = $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma nova caracteristica para serem
     * usadas como proprieddes dos obejto.
     *
     * @param array
     *
    */
    public function salvarCaracteristica($data){              
        
        if($data['action'] == "novo"){            
            $select = "tipo, texto, number, inteiro, extra, container_1";
            $values = "'{$data['tipo']}', '{$data['texto']}', '{$data['number']}', '{$data['inteiro']}', '{$data['extra']}', '{$data['extra2']}'";
            $sql =  "INSERT INTO ecommerce_caracteristicas ($select) VALUES ($values)";            
        }else{            
            $values = "texto = '{$data['texto']}', extra = '{$data['extra']}', container_1 = '{$data['extra2']}'";
            $sql =  "UPDATE ecommerce_caracteristicas SET $values WHERE id = {$data['id']}";
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
     * Método para remover uma categoria de subitem, subcategoria ou categoria
     *
     * @param array
     *
    */
    public function removeCaracteristica($data){        
              
        $sql = "DELETE FROM ecommerce_caracteristicas WHERE id =" . $data['id'];        

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
     * Método para obter as caracteristicas salva na tabela 
     * ecommerce_caracteristicas.
     *
     * @param string
     *
    */
    public function getCaracteristicas($tipo, $id = false){
 
        if(!$id) $sql = "SELECT id, tipo, texto, extra, container_1 FROM ecommerce_caracteristicas WHERE tipo = '$tipo'";
        if( $id) $sql = "SELECT id, tipo, texto, extra, container_1 FROM ecommerce_caracteristicas WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);         
            if(!$id) $recordset = $command->queryAll();
            if( $id) $recordset = $command->queryRow();
            
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

        $sql = "DELETE FROM conteudo_categorias WHERE id ='{$data['id']}'";

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