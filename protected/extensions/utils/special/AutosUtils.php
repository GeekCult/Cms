<?php
/* 
 * This class contains common util functions regarding autos
 * 
 */

class AutosUtils {
    
    /**
     * Método para recuperar os registros de modelos
     *
     * @param string
     *
    */
    public static function getModelo($value = false, $type = false){
        
        if($type == 'single') $sql = "SELECT * FROM veiculos_modelo WHERE id = '$value'";      
        
        try{
            if($type == 'single') $recordset = Yii::app()->db2->createCommand($sql)->queryRow();            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosUtils - getModelos() '. $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros de fabricantes
     *
     * @param string
     *
    */
    public static function getFabricante($value = false, $type = false){
        
         if($type == 'single') $sql = "SELECT * FROM veiculos_fabricante WHERE id = $value";      
        
        try{
            if($type == 'single') $recordset = Yii::app()->db2->createCommand($sql)->queryRow();        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosUtils - getFabricantes() '. $e->getMessage();
        }
    }
}
?>