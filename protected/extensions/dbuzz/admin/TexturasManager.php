<?php
/*
 * This Class is used to controll all functions related the feature texturas
 *
 * @author CarlosGarcia
 *
 * Date: 15/12/2010
 *
 */

class TexturasManager{

    /**
     * Metodo para recuperar todos os registros
     * da tabela texturas.
     *
     *
    */
    public function getAllContent($local){        

        $select = "id, nome, url_textura, tipo, bg_color, local";
        $sql = "SELECT ".$select." FROM personalizar_texturas WHERE local = '$local' ORDER BY id DESC";

        try{          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['checked'] = "checked";
            }            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getAllContent() " . $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar todos os registros
     * da tabela texturas.
     *
     *
    */
    public function getAllContentUser($local){        

        $select = "id, titulo, foto, tipo, cor, local, type_repeat";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE tipo = 'textura' AND local = '$local' ORDER BY id DESC";
        
        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
           
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getAllContentUser() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros
     * da tabela texturas.
     *
     *
    */
    public function getAllContentLimited($local){
        
        Yii::import('application.extensions.utils.DataBaseUtils');

        $select = "id, nome, url_textura, tipo, bg_color, local";
        $sql = "SELECT ".$select." FROM personalizar_texturas WHERE local = '$local' ORDER BY id DESC LIMIT 0, 10";
        
        try{          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
           
            $recordset['records'] = DataBaseUtils::getCountRowsPurpleManager("personalizar_texturas", "local", $local);            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getAllContentLimited() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContent($id){
        
        if($id == '') return false;
        $select = "id, nome, url_textura, tipo, bg_color, local";
        $sql = "SELECT ".$select." FROM personalizar_texturas WHERE id= $id ";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getContent() " . $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContentUser($id){
        
        if($id == '') return false;
        $select = "id, titulo AS nome, foto AS url_textura, type_repeat AS tipo, cor AS bg_color, local";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE id= $id ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getContent() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar o registro das cores
     *
     * @param number id
     *
    */
    public function getAllColors(){

        $select = "id, icon_color, cod_hexa";
        $sql = "SELECT ".$select." FROM conteudo_colors";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getAllColor() " . $e->getMessage();
        }
    }

    /**
     * metodo para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data){
        
        if($data[5] == "cadastrar"){
            $select = "nome, url_textura, tipo, bg_color, local";
            $values = "{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}";
            $sql    = "INSERT INTO personalizar_texturas ($select) VALUES ('$values')";
        }else{
            $values = "nome = '{$data[0]}', url_textura = '{$data[1]}', tipo = '{$data[2]}', bg_color = '{$data[3]}', local = '{$data[4]}'";          
            $sql    = "UPDATE personalizar_texturas SET ". $values ." WHERE id = {$data[6]}";
        }

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            $local_dev = explode(".", $_SERVER['SERVER_NAME']);
            
            /*
            if($local_dev[0] == "dev"){
                $comando2 = Yii::app()->db3->createCommand($sql);
                $control2 = $comando2->execute();
            }
            */
            
            echo json_encode(array('MESSAGE' => $data['message']));

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - submitContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitUserContent($data){

        $select = "titulo, foto, descricao, id_categoria, tipo, data, id_user, type_repeat, cor, local";
        $values  = $data['titulo']."', '".$data['foto']."', '".$data['descricao']."', '".$data['id_categoria']."', '".$data['tipo']."', '".$data['data']."', '".$data['id_user']."', '";
        $values .= $data['type_repeat']."', '".$data['cor']."', '".$data['local'];
        $sql =  "INSERT INTO conteudo_images (". $select .") VALUES ('". $values . "')";
        
        if($data['action'] == "alterar"){
            $values  = "titulo = '{$data['titulo']}', foto = '{$data['foto']}', descricao = '{$data[ 'descricao']}', cor = '{$data['type_repeat']}', ";
            $values .= "id_categoria = '{$data['id_categoria']}', tipo = '{$data[ 'tipo']}', data = '{$data[ 'data']}', type_repeat = '{$data['type_repeat']}'";
            $sql =  "UPDATE conteudo_images SET ". $values ." WHERE id = {$data['id']}";
        }
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
  
            //return Yii::app()->db->getLastInsertID();
            echo json_encode(array('MESSAGE' => Yii::t('messageStrings', 'message_result_gallery')));

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - submitUserContent() " . $e->getMessage();
        }
    }  
    

    /**
     * metodo para excluir um registro
     *
     * @param string page
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM personalizar_texturas WHERE id ='" . $data['id']. "'";

        try{

            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/media/images/textures/'.$data['local']."/".$data['image_name'])) {
               unlink($_SERVER['DOCUMENT_ROOT'] . '/media/images/textures/' .$data['local']."/". $data['image_name']);
            }

            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - deleteContent() " . $e->getMessage();
        }
    }

    /**
     * Metodo para atualizar um registro existente
     *
     * It sets the a new texture into preferences table
     * The get_post variable is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateContent($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $tipo_device = MethodUtils::getDeviceType();
        
        if($data[0] == "paginas" || $data[0] == "site" || $data[0] == "intro"){
            $values = "textura_" . $data[0] . " = '" . $data[1]."', tipo_textura_" . $data[0] . " = '" . $data[2]."', cor_textura_" . $data[0] . " = '" . $data[3]."'";
        }else if($data[0] == "sombras"){
            $values = "textura_" . $data[0] . " = '" . $data[1]."'";
        }else{
            $values = "textura_" . $data[0] . " = '" . $data[1]."', tipo_textura_" . $data[0] . " = '" . $data[2]."'";  
        }
        
        $sql = "UPDATE preferencias_data SET $values WHERE tipo = '$tipo_device'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Caso seja especial define
            if($data[0] == 'menu' || $data[0] == 'wallpaper' || $data[0] == 'flags' || $data[0] == 'menu' || $data[0] == 'efeitos'){
                $setTypePath = PreferencesUtils::setAttributes($data[0] . '_texture_type', $data['path']);
            }
            
            Yii::import('application.extensions.utils.HelperUtils');
            $content = HelperUtils::createCss();
            
            echo json_encode(array('MESSAGE' => $data['message'], 'control' => $control));

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - updateContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os textos
     * $pictures images usadas em alguma página
     *
     * @param string page
     *
    */
    public function getTransformedContent($start, $type){
        
        Yii::import('application.extensions.utils.DataBaseUtils');

        if($start < 10) $start = 0;

        $select = "id, nome, url_textura, tipo, bg_color, local";
        $sql = "SELECT $select FROM personalizar_texturas WHERE local = '$type' ORDER BY id DESC LIMIT $start, 10";

        try{        
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();                   
            $recordset['records'] = DataBaseUtils::getCountRowsPurpleManager("personalizar_texturas", "local", $type);            
     
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TexturasManager - getTransformedContent() " . $e->getMessage();
        }
        return $recordset;
    } 
    
    /**
     * Metodo para obter preferencias especiais
     *
     * @param array
     *
    */
    public function getContentSpecial($type){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        try{            
            
            if($type == 'button'){
                $result['button_type_special'] = PreferencesUtils::getAttributes('button_type_special', 'inteiro');
                $result['button_main_special'] = PreferencesUtils::getAttributes('button_main_special');
                $result['button_success_special'] = PreferencesUtils::getAttributes('button_success_special');
                $result['button_second_special'] = PreferencesUtils::getAttributes('button_second_special');
            }            
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - getContentSpecial() " . $e->getMessage();
        }
    }
    
    /**
     * Metodo para atualizar preferencias especiais
     *
     * @param array
     *
    */
    public function updateContentSpecial($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        try{            
            
            if($data['type'] == 'button'){
                $set = PreferencesUtils::setAttributes('button_type_special', MethodUtils::getBooleanNumber($data['type_special']), 'inteiro');
                $set = PreferencesUtils::setAttributes('button_main_special', $data['main_button']);
                $set = PreferencesUtils::setAttributes('button_success_special', $data['success_button']);
                $set = PreferencesUtils::setAttributes('button_second_special', $data['second_button']);
            }
            
            $content = HelperUtils::createCss();
            
            return $set;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: TexturasManager - updateContentSpecial() " . $e->getMessage();
        }
    }
}
?>