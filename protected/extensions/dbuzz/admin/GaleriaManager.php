<?php
/*
 * This Class is used to controll all functions related the feature Galeria
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */
class GaleriaManager{

    /**
     * Método para recuperar as galerias existentes
     *
     * @param string page
     *
    */
    public function getAllContent($type = 'foto'){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');
     
        $select = "id, id_graphic, id_categoria, id_galeria, id_subcategoria, tipo, nome, n_index, data_criacao, last_update, status";
        $sql = "SELECT ".$select." FROM general_galerias WHERE tipo = '$type' GROUP BY id_categoria, id_galeria ORDER BY id DESC LIMIT 0, 100";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i=0; $i < count($recordset); $i++){
                    $recordset[$i]['data_criacao'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data_criacao']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                }
            }
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: GaleriaManager - getAllContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as subcategorias de galerias existentes
     *
     * @param string page
     *
    */
    public function getAllGalleryAllowed(){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');        
     
        $select = "id, id_categoria, titulo, url, last_update, exibe, descricao, container_1";
        $sql = "SELECT $select FROM general_galerias_subcategorias WHERE exibe = 1 ORDER BY id DESC";
    
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i=0; $i < count($recordset); $i++){
                    $recordset[$i]['galeria'] = $this->getAllAllowedContent($recordset[$i]['id_categoria'], false, false, 'foto', $recordset[$i]['id']);
                    $recordset[$i]['graphics']  = GraphicsUtils::getCoolContent($recordset[$i]['container_1']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                    
                    //$recordset[$i]['data_criacao'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data_criacao']);
                    //$recordset[$i]['nome_url'] = StringUtils::StringToUnderline($recordset[$i]['nome']);
                }
            }
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: GaleriaManager - getAllGaleryAllowed() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as galerias existentes
     *
     * @param string page
     *
    */
    public function getAllAllowedContent($categoria = false, $id_galeria = false, $isIDS = false, $tipo = 'foto', $id_subcategoria = false, $ignore_allowed = false){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        
        $categoriaHandler = new CategoriaManager();
     
        $select = "id, id_graphic, id_categoria, id_subcategoria, id_galeria, tipo, nome, n_index, data_criacao, last_update, status";
        
        $status = "status = 1";
        if($ignore_allowed) $status = "status != 100";
        
        $sql = "SELECT $select FROM general_galerias WHERE $status AND (url = '$categoria' AND id_galeria = $id_galeria) AND tipo = '$tipo' ORDER BY id DESC LIMIT 0, 100";
        if($isIDS) $sql = "SELECT $select FROM general_galerias WHERE $status AND (id_categoria = '$categoria' AND id_galeria = $id_galeria) AND tipo = '$tipo' ORDER BY id";
        if(!$id_galeria)$sql = "SELECT $select FROM general_galerias WHERE $status AND url = '$categoria' AND tipo = '$tipo' GROUP BY id_categoria, id_galeria ORDER BY id DESC LIMIT 0, 100";
        if(!$categoria && !$id_galeria)$sql = "SELECT $select FROM general_galerias WHERE $status AND tipo = '$tipo' GROUP BY id_categoria, id_galeria ORDER BY id DESC LIMIT 0, 100";
        if($id_subcategoria) $sql = "SELECT $select FROM general_galerias WHERE $status AND id_subcategoria = $id_subcategoria GROUP BY id_subcategoria, id_galeria ORDER BY id DESC LIMIT 0, 100";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
           
            
            if(count($recordset) > 0){
                for($i=0; $i < count($recordset); $i++){

                    $recordset[$i]['data_criacao'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['data_criacao']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['last_update']);
                    $recordset[$i]['graphics']  = $this->getGraphicsById($recordset[$i]['id_categoria'], $recordset[$i]['id_galeria']);
                    $recordset[$i]['nome_url'] = StringUtils::StringToUrl($recordset[$i]['nome'], true, "_");
                    $recordset[$i]['info'] = $categoriaHandler->getContentById($recordset[$i]['id_galeria']);
                }
            }
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: GaleriaManager - getAllAllowedContent() " . $e->getMessage();
        }
    }

    /**
     * Método para recuperar o registro da tabela general_galerias
     *
     * @param number
     *
    */
    public function getContentById($id_categoria, $id_galeria, $type = 'galeria'){

        $select = "id, id_categoria, id_galeria, id_graphic, id_subcategoria, data_criacao, last_update, tipo, status";
        $sql = "SELECT ".$select." FROM general_galerias WHERE id_categoria = $id_categoria AND id_galeria = $id_galeria";

        try{
            $command = Yii::app()->db->createCommand($sql);
            
            if($type == 'galeria') $recordset = $command->queryRow();
            if($type == 'users')   $recordset = $command->queryAll();
            
            if($type == 'users' &&  $recordset){
                Yii::import('application.extensions.utils.users.UserUtils');
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['user'] = UserUtils::getUserFullById($recordset[$i]['id_graphic']);
                }
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: GaleriaManager - getContentById " . $e->getMessage();
        }
        return $recordset;
    }
    
    /**
     * Método para recuperar o registro da tabela general_galerias
     *
     * @param number
     *
    */
    public function getGraphicsById($id_categoria, $id_galeria){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $select = "id, id_graphic, tipo, nome, n_index";
        $sql = "SELECT ".$select." FROM general_galerias WHERE id_categoria = $id_categoria AND id_galeria = $id_galeria";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();            
            //Pega as imagens pelo id salvo
            if(count($recordset) > 0){
                for($i=0; $i < count($recordset); $i++){
                    $recordset[$i]['graphic'] = GraphicsHelperUtils::getPhotos($recordset[$i]['id_graphic']);
                }
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: GaleriaManager - getGraphicById() " . $e->getMessage();
        }
        return $recordset;
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitContent($data){

        $select = "id_graphic, id_categoria, tipo, nome, n_index, data_criacao, last_update, id_galeria, status, id_subcategoria, url";

        //pega a string e separa para ver quantas imagens tem
        $imageTMP = explode(",", $data['id_graphic']);       
        
        $date = date('Y-m-d H:i:s');
 
        try{

            for($i = 0; $i < count($imageTMP); $i++) {
                $values = "'{$imageTMP[$i]}', '{$data['id_categoria']}', '{$data['tipo']}', '{$data['nome']}', '{$data['index']}', '{$date}', '{$date}', '{$data['id_galeria']}', 1, '{$data['id_subcategoria']}', '{$data['url']}'";
                $sql =  "INSERT INTO general_galerias ($select) VALUES ($values)";
                $comando = Yii::app()->db->createCommand($sql);
                $control = $comando->execute();        
            }
            
            if($control){
                echo Yii::t("messageStrings", "message_result_gallery_created");
            }else{
                echo Yii::t("messageStrings", "message_result_gallery_fail");
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: GaleriaManager - submitContent() " . $e->getMessage();
        }
    }  
    
    /**
     * Método para atualizar uma galeria existente
     * esse método ficou separado para ter uma melhor
     * entendimento do código.
     *
     * PS: Ele possue o id que no submit não é necessário.
     *
     * @param array
     *
    */
    public function updateContent($data){

        $id_categoria = $data['id_categoria'];
        $id_galeria = $data['id_galeria'];
        $id_subcategoria = $data['id_subcategoria'];
        //pega a string e separa para ver quantas imagens tem
        $imageTMP = explode(",", $data['id_graphic']);
        //inicialmente tudo pode dar certo!
        $success=true;
        $date = date('Y-m-d H:i:s');
        
        try{            
            //Abaixo a locura é o seguinte: se tem atualiza, senão cria um novo!
            for($i = 0; $i < count($imageTMP); $i++) {
                
                if(count($imageTMP) > 0 && $imageTMP[$i]!=""){
                   
                    $sql = "SELECT id FROM general_galerias WHERE id_categoria = $id_categoria AND id_galeria = $id_galeria AND id_graphic = {$imageTMP[$i]} AND id_subcategoria = $id_subcategoria";
                    $comando1 = Yii::app()->db->createCommand($sql);
                    $exist =  $comando1->queryRow();

                    if(!$exist){
                        $select = "id_graphic, id_categoria, id_galeria, tipo, nome, n_index, data_criacao, last_update, id_subcategoria, url, status";
                        $values = "'{$imageTMP[$i]}', '{$data['id_categoria']}', '{$data['id_galeria']}', '{$data['tipo']}', '{$data['nome']}', '{$data['index']}', '$date', '$date', '{$data['id_subcategoria']}', '{$data['url']}', 1";
                        $sql2 =  "INSERT INTO general_galerias ($select) VALUES ($values)";
                        $comando2 = Yii::app()->db->createCommand($sql2);
                        $success = $comando2->execute();
                    }else{                   
                        $values2 = "id_graphic = '{$imageTMP[$i]}', id_categoria = '{$data['id_categoria']}', tipo = '{$data['tipo']}', last_update = '$date', nome = '{$data['nome']}', n_index = '{$data['index']}', id_galeria = '{$data['id_galeria']}', id_subcategoria = '{$id_subcategoria}', url = '{$data['url']}'";
                        $sql3 =  "UPDATE general_galerias SET ". $values2 ." WHERE id = {$exist['id']}";                                       
                        $comando3 = Yii::app()->db->createCommand($sql3);
                        $success = $comando3->execute();
                    }
                }
            }
            
            if($success){
                echo Yii::t("messageStrings", "message_result_gallery_update");
            }else{
                echo Yii::t("messageStrings", "message_result_gallery_fail");
            }

        }catch (CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: GaleriaManager - updateContent() " .  $e->getMessage();
        }
    } 
    
    /**
     * Método para atualizar os detalhes de uma galeria existente
     *
     * @param array
     *
    */
    public function updateDetailsSubCategory($data){

        try{                            
            $values = "descricao = '".$data['descricao'] . "', exibe = '".$data['exibe']. "', titulo = '".$data['titulo']. "', container_1 = '".$data['capa']."', last_update = '".date('Y-m-d H:i:s'). "'";
            $sql =  "UPDATE general_galerias_subcategorias SET ". $values ." WHERE id = " . $data['id'] . "";                                       
            
            $comando = Yii::app()->db->createCommand($sql);
            $success = $comando->execute();
        
            echo Yii::t("messageStrings", "message_result_gallery_update");

        }catch (CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: GaleriaManager - updateDetailsSubCategory() " .  $e->getMessage();
        }
    }
    

    /**
     *
     * Método para remover um registro
     *
     * @param array
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM general_galerias WHERE id_graphic = " . $data['id']. " AND id_galeria = " . $data['id_galeria']. " AND id_categoria = " . $data['id_categoria']."";
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: GaleriaManager - deleteContent() " .  $e->getMessage();
        }
    }
    
    /**
     *
     * Método para remover uma galeria
     *
     * @param array
     *
    */
    public function deleteGallery($data){

        $sql = "DELETE FROM general_galerias WHERE id_galeria = " . $data['id_galeria']. " AND id_categoria = " . $data['id_categoria']."";
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $data;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: GaleriaManager - deleteGallery() " .  $e->getMessage();
        }
    }
    
    /**
     * Método para mudar o status da galeria se está
     * travado ou não
     * 
     * @param boolean
     * @param number
     *
    */
    public static function setStatusGallery($isLocked, $id_categoria, $id_galeria){
        
        $isLocked = MethodUtils::getBooleanNumber($isLocked);
        
        $values = "status = '$isLocked'";     
        $sql = "UPDATE general_galerias SET ". $values . "WHERE id_categoria = ". $id_categoria." AND id_galeria =". $id_galeria."";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $command->execute(); 
            
            return $isLocked;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: GaleriaManager - setStatusGallery() " . $e->getMessage();
        }
    }
    
    /**
     * Método obter os dados de uma subcategoria
     * 
     * @param boolean
     * @param number
     *
    **/
    public static function getSubCategoriaContent($value, $field = 'url', $callback = false){
        
        $sql = "SELECT id, url, titulo FROM general_galerias_subcategorias WHERE $field = '$value'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 
            
            if(!$callback) return $recordset;
            return $recordset[$callback];

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: GaleriaManager - getSubCategoriaContent() " . $e->getMessage();
        }
    }
}

?>