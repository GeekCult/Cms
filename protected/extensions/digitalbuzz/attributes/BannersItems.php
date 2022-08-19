<?php
/*
/*
 * This Class is used to set and retrieve banner items
 * 
 * @author Carlos GArcia
 *
*/

class BannersItems{
    
    var $banner = "";

    public function setCurrentBanner($banner){        
        $this->banner = $banner;        
    }    
    
    /**
     * Método para adicionar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function adicionar($type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $z_index, $label = "", $name = '', $descricao = ''){
        
        $select = "id_banner, tipo, src, p_x, p_y, width, height, color, f_type, s_text, s_thumb, link, variante, texto, z_index, label, name, descricao";
        
        $sql  = "INSERT INTO banners_items ($select) VALUES (".$this->banner.",'$type', '$src', $left, $top, '$width', '$height',";
        $sql .= "'$color', '$f_type', '$s_text','$s_thumb', '$link', '$variante', '$texto', '$z_index', '$label', '$name', '$descricao')";
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $command->query();
            
            return true;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();            
        }
    }
    
    /**
     * Método para atualizar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function atualizar($id, $type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $descricao, $z_index, $json = null, $isManager = false){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $values  = "tipo='".$type."', src= '".$src."', p_x= '" . $left ."', p_y= '".$top."', width= '" . $width ."', ";
        $values .= "height='".$height."', color='".$color."', f_type='" . $f_type ."', s_text='".$s_text."', s_thumb='" . $s_thumb ."', ";
        $values .= "link='".$link."', variante='".$variante."', texto='".$texto."', descricao='".$descricao."', z_index = '". $z_index. "', json = '". $json."'";        
        
        $sql  = "UPDATE banners_items SET ".$values." WHERE id = $id AND id_banner = $this->banner";
        if($isManager) $sql  = "UPDATE banners_items SET ".$values." WHERE id_banner = $this->banner";
        
        //if(!$isManager && ($type == "b" || $type == "o")) BannersUtils::updateUniqueAttributes($this->banner, $type, $src);
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            if($isManager) $command = Yii::app()->db2->createCommand($sql);
            $command->query();
            
            return true;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();            
        }
    }
    
    /**
     * Método para atualizar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function atualizarByName($name, $type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $descricao, $z_index, $json = null){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $values  = "tipo='".$type."', src= '".$src."', p_x= '" . $left ."', p_y= '".$top."', width= '" . $width ."', ";
        $values .= "height='".$height."', color='".$color."', f_type='" . $f_type ."', s_text='".$s_text."', s_thumb='" . $s_thumb ."', ";
        $values .= "link='".$link."', variante='".$variante."', texto='".$texto."', descricao='".$descricao."', z_index = '". $z_index. "', json = '". $json."'";        
        
        $sql  = "UPDATE banners_items SET ".$values." WHERE name = '$name' AND id_banner = $this->banner";
    
        try{
            $command = Yii::app()->db->createCommand($sql);
            $set = $command->query();
            
            return $set;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();            
        }
    }
    
    /**
     * Método para recuperar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function recuperar($id_banner, $isTemplate = false, $isItemIndex = false){
        
        
        
        $session = MethodUtils::getSessionData();
        //Evita problema de items perdidos nos banners_items.. as vezes não tem ID
        if($id_banner == '') $id_banner = 0; 
        $select = "id, label, name, id_banner, tipo, src, p_x, p_y, width, height, color, f_type, s_text, s_thumb, link, variante, texto, z_index, descricao, json";
        $sql = "SELECT $select FROM banners_items WHERE id_banner = ".$id_banner ." ORDER BY z_index ASC";
        
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            if($isTemplate) $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($isItemIndex){
                $result = array();
                if($recordset){foreach($recordset as $values){
                    $result[$values['name']] = $values;
                }}
                
                //Caso seja um minisite
                if($session['miniSiteUser'] != "" &&  $session['miniSiteRemote']) $result['miniSiteUrl'] = $session['miniSiteUrl'] . "/media/user/images/original/";
                if($session['miniSiteUser'] != "" && !$session['miniSiteRemote']) $result['miniSiteUrl'] = "/media/user/images/clients/";
                    
                return $result;
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function recuperarItem($id_item, $id = ""){
        
        $select = "id, id_banner";
        
        $sql = "SELECT $select FROM banners_items WHERE id = ".$id_item ." AND (tipo != 'b' AND tipo != 'o')";
        
        // It's used as save new banner is pressed
        if($id != "") $sql = "SELECT $select FROM banners_items WHERE id = ".$id_item ." AND id_banner = $id AND (tipo != 'b' AND tipo != 'o')";
        
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
     * Método para checar se um item existe de acordo com id do banner e name
     * 
     * @param string name
     * @param string type
     * 
    **/
    public function checkItemByName($id, $name){
        
        $sql = "SELECT id, id_banner FROM banners_items WHERE id_banner = $id AND name = '$name'";
    
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR: BannersItems - checkItemByName() " . $e->getMessage());
            echo "ERROR: BannersItems - checkItemByName() " . $e->getMessage();
        }
    }
    
    /**
     * Método para remover todos os items de um banner
     *  
     * 
    **/
    public function remover($id_item){

        $sql = "DELETE FROM banners_items WHERE id = $id_item";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return true;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function adicionarManager($type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $z_index, $json = "", $label = ""){
        
        $select = "id_banner, tipo, src, p_x, p_y, width, height, color, f_type, s_text, s_thumb, link, variante, texto, z_index, label, json";
        
        $sql  = "INSERT INTO banners_items ($select) VALUES (".$this->banner.",'$type', '$src', $left, $top, $width, $height, ";
        $sql .= "'$color', '$f_type', '$s_text','$s_thumb', '$link', '$variante', '$texto','$z_index', '$label', '$json')";
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $command->query();            
            return true;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage(); 
            
            
        }
    }
    
    /**
     * Método para adicionar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function atualizarManager($type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $z_index, $json = "", $label = ""){
        
        $select = "id_banner, tipo, src, p_x, p_y, width, height, color, f_type, s_text, s_thumb, link, variante, texto, z_index, label, json";
        
        $sql  = "INSERT INTO banners_items ($select) VALUES (".$this->banner.",'$type', '$src', $left, $top, $width, $height, ";
        $sql .= "'$color', '$f_type', '$s_text','$s_thumb', '$link', '$variante', '$texto','$z_index', '$label', '$json')";
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $command->query();            
            return true;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage(); 
            
            
        }
    }
    
    /**
     * Método para adicionar os items de um banner
     * 
     * @param string name
     * @param string type
    **/
    public function adicionarPlaygroundManager($json, $isDbUser = false){
        
        $select = "id_banner, json";
        
        $sql  = "INSERT INTO banners_items ($select) VALUES (".$this->banner.",'$json')";
        
        try{
            if(!$isDbUser) $command = Yii::app()->db->createCommand($sql);
            if( $isDbUser) $command = Yii::app()->db_user->createCommand($sql);
            $command->query();
            
            return true;
            
        }catch(CDbException $e){            
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage();            
        }
    }
}

?>