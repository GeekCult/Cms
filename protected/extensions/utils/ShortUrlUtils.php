<?php

/**
 * Description of ShortUrlUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class ShortUrlUtils{
    
    /**
     * Método para retornar o shorturl da tabela 
     * general_shorturl
     * 
     * @param number
     *
    */
    public static function getShortUrl($id){

        $sql = "SELECT shorturl FROM general_shorturl WHERE id_general = $id ";
        $command = Yii::app()->db->createCommand($sql);   
        $recordset = $command->queryRow();
        
        $shortUrl = "http://" .  $_SERVER['SERVER_NAME'] ."/lnk/". $recordset['shorturl'];
        
        return $shortUrl;
    }
    
    /**
     * Método para retornar o tipo do shorturl
     * Esse método usa a [rimeira letra para encontrar o
     * general correto
     * 
     * @param string
     *
    */
    public static function getTipo($substring){
        
        $tipo = "";

        switch($substring){            
            case "n":
                $tipo = "noticias";
                break;
            
            case "c":
                $tipo = "colunas";
                break;
            
            case "p":
                $tipo = "produtos";
                break;
            
            case "q":
                $tipo = "pesquisas";
                break;
            
            case "u":
                $tipo = "user";
                break;
            
            case "v":
                $tipo = "boletos";
                break;
            
            case "d":
                $tipo = "downloads";
                break;
        }
        return $tipo;
    }
    
    /**
    *
    * Method to retrive the prefix.
    * 
    * @param string
    *
    **/
    public static function getPrefix($type){
        
        $prefix = "";
        
        switch($type){            
            case "noticias":
                $prefix = "n";
                break;
            
            case "colunas":
                $prefix = "c";
                break;
            
            case "blog":
                $prefix = "b";
                break;
            
            case "produtos":
                $prefix = "p";
                break;
            
            case "pesquisas":
                $prefix = "q";
                break;
            
            case "user":
                $prefix = "u";
                break;
            
            case "boletos":
                $prefix = "v";
                break;
            
            case "downloads":
                $prefix = "d";
                break;
        }        
        return $prefix;
    }    
}
?>