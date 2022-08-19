<?php

/**
 * Description of CookieUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class TermsCondictionsUtils{
    
    /**
     * Método para retornar o termo e condições
     * 
     *
    */
    public static function getTermos(){

        $select  = "id, titulo, titulo_01, texto_01, subtitulo_01, ";
        $select .= "titulo_02, texto_02, subtitulo_02, ";
        $select .= "titulo_03, texto_03, subtitulo_03, ";
        $select .= "titulo_04, texto_04, subtitulo_04, ";
        $select .= "titulo_05, texto_05, subtitulo_05, ";
        $select .= "titulo_06, texto_06, subtitulo_06"  ;
        $sql = "SELECT ".$select." FROM paginas_data WHERE nome = 'termos' ";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();  
        
        return $recordset;

    }
}
?>