<?php

/**
 * Description of AdminUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class AdminUtils {

    /**
     * Método para obter as informações do componente via FrontEnd
     *
     * @param string
     * @param array
     *
    */
    public static function getInfo($page, $data = array()){
       
        $result = array();
       
        try{
            switch($page){
                
                default:
                    //return array();
                    break;
            }
            
            return $result;
            
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: AdminUtils - getInfo() " . $e->getMessage();
        }
    }
 
}
?>
