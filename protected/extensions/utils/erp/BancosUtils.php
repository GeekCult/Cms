<?php

/**
 * Description of BancosUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class BancosUtils {


    /**
     * Método para pegar o avatar do usuário
     *
     * @param number id
     *
    */
    public static function getBankInfo($type, $data = array()){
        
        $recordset = array();
        
        try{
            
            switch ($type){
                case "itau";
                    $recordset['numero_banco'] = '341';
                    $recordset['nome_banco'] = 'BANCO ITAU SA';
                    $recordset['agencia'] = '1620';
                    $recordset['conta'] = '44874';
                    $recordset['digito_conta'] = '4';


                    break;
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoUtils - getBankInfo()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: BancoUtils - getBankInfo() ' . $e->getMessage();
        }
    }
}
?>