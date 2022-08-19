<?php
/*
/*
 * This Class is used to set and retrieve Banners Atributes
 * @author CarlosGarcia
 *
 *

*/

class BannersAttribute{
    
    var $banner = "";

    public function setCurrentBanner($id_banner){
        $this->banner = $id_banner; 
    }    
    
    /*
     * método para definir um atributo do banner
     * @param string name
     * @param string type
     *
     * type pode ser integer, timestamp ou string
    */
    public function adicionar($name, $value, $type = "texto"){

        $sql = "INSERT INTO banners_attribute (id, name, $type) VALUES ($this->banner , '$name', '$value')";
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $save = $command->query();
            return $save;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return $e->getMessage(); 
        }
    }

    /*
     * metodo para recuperar um atributo do banner
     * @param string name
     * @param string type
     *
     * type pode ser integer, timestamp ou string
    */
    public function recuperar($id, $variavel,$type = "texto"){

        $sql = "SELECT ".$type." FROM banners_attribute WHERE name = '".$variavel."' AND id = ".$id ."";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if(count($recordset) > 0)
                return $recordset[0][$type];
            return false;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
}

?>