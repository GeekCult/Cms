<?php
/*
 * This Class is used to controll all functions related the feature Paginas
 *
 * @author CarlosGarcia
 *
 *
 */

class MenuManager{

    /**
     * metodo para recuperar os textos
     *
     * @param string page
     *
    */
    public function getAllContent(){
        
        $select = "id, id_categoria, arquivo, data, nome";
        $sql = "SELECT ".$select." FROM conteudo_downloads";

        try{     
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }

    /**
     * Método para recuperar um determinado registro
     * Usado em editar conteúdo
     *
     * @param number
     *
    */
    public function getContentById($id){

        $sql = "SELECT * FROM paginas_modulos WHERE id = $id ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data){
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;

        $values = "menu_exibe = '{$data["menu_exibe"]}'";
        $sql =  "UPDATE preferencias_data SET $values WHERE id_user = $id_user";

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
     * Método para recuperar os menus items
     *
     * @param string
     *
    */
    public function getAllContentByType($type, $id){
        
        if($type=='menu_container') $sql = "SELECT * FROM paginas_modulos WHERE tipo = '$type'";
        if($type=='menu_categoria') $sql = "SELECT * FROM paginas_modulos WHERE tipo = '$type' AND id_row = $id";
        if($type=='menu_item') $sql = "SELECT * FROM paginas_modulos WHERE tipo = '$type' AND id_row = $id";

        try{     
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitMenuSpecialContent(){
        
        $data = array();
        parse_str($_POST['data'], $data);
        
        if($data['tipo'] == 'menu_item') $id = $data['id_row'];
        if($data['tipo'] == 'menu_categoria') $id = $data['id_menu'];
        if($data['tipo'] == 'menu_container') $id = $data['id_menu'];

        if($data['action'] == 'novo'){$sql = "INSERT INTO paginas_modulos (titulo, descricao, tipo, id_row, id_menu, link_special)  VALUES ('{$data['titulo']}', '{$data['descricao']}', '{$data['tipo']}', '{$data['id_row']}', '{$data['id_menu']}', '{$data['link_special']}' )";
        }else{$sql = "UPDATE paginas_modulos SET titulo = '{$data['titulo']}', descricao = '{$data['descricao']}', link_special = '{$data['link_special']}' WHERE id = '{$id}'";}
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para encontrar view adequada
     *
     * @param string page
     *
    */
    public function getView($type){
        
   
        switch($type){
            
            case "editar_item":
            case "criar_item":
                $result = 'criar_item';
                break;
            
            case "editar_categoria":
            case "criar_categoria":
                $result = 'criar_categoria';
                break;
            
            case "editar_menu":
            case "criar_menu":
                $result = 'criar_menu';
                break;
            
            default:
                $result = 'criar_item';
                break;
            
        }
        
        return $result;
    }
    
    /**
     * Método para excluir um registro existente
     * TODO: It uses a GET http request: Change it!
     *
     * @param number
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM paginas_modulos WHERE id ='{$data['id']}'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: MenuManager - deleteContent() ' . $e->getMessage();
        }
    }
}

?>