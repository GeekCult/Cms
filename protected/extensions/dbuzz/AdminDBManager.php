<?php
/*
 * This Class is used to set and retrieve user Atributes from Admin
 * @author CarlosGarcia
 *
 * Usage Notes
 *
*/

class AdminDBManager{

    /**
     * Método para recuperar o número de acessos
     *
     * @return string acessos
     *
    */
    public function getAcessos(){
        Yii::import('application.extensions.utils.ContadorVisitasUtils');        
        $result['admin'] = ContadorVisitasUtils::getVisit("admin");        
        $result['site'] = ContadorVisitasUtils::getVisit("desktop");
        
        return $result;
    }

    /**
     * Método para recuperar os dados do usuário logado
     *
     * @return array recordset
     *
    */
    public function getUserData($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $obiz = HelperUtils::getObiz();
        
        if(!$obiz) $select = "id, field1, field2, frase, creation, avatar";
        if( $obiz) $select = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(frase, {$obiz['serial']}) AS frase, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, creation"; 
        $sql = "SELECT $select FROM user_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset) $recordset['creation'] = DateTimeUtils::getDateFormateNoTime($recordset['creation']);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
}
?>