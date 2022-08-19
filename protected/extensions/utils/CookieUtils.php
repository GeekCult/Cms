<?php

/**
 * Description of CookieUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class CookieUtils{
    
    /**
     * Método para retornar uma string do tipo no-dipslay
     * se o cookie se ele existir.
     * 
     * @param string
     *
    */
    public static function getCookie($cookie_name){

        $cookie = Yii::app()->request->cookies[$cookie_name];
        
        if($cookie != NULL){
            return "no-display";
        }else{
            return "";
        }
    }
    
    /**
     * Método para retornar o cookie se ele existir
     * 
     * @param string
     *
    */
    public static function getCookieGeneral($cookie_name){

        $cookie = Yii::app()->request->cookies[$cookie_name];
        
        if($cookie != NULL || $cookie != ""){
            return $cookie;
        }else{
            return false;
        }
    }
}
?>