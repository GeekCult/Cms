<?php

/**
 * Description of CnovaUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 * 
 * Date: 13/10/2016
 * 
 */
class CnovaUtils {


    /**
     * Método para pegar o avatar do usuário
     *
     * @param number id
     *
    */
    public static function publicar($data = array()){
        
        
        try{
      
            $request = false;            
            return $request;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: CnovaUtils - publicar()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: CnovaUtils - publicar() ' . $e->getMessage();
        }
    }
}
?>