<?php

/**
 * Description of DicasUtils
 *
 * Here are some method to make easier the dealing with it.
 *
 * @author CarlosGarcia
 */
class DicasUtils{
    
    /**
     * Método para retornar a dica de acordo com o
     * o tipo da página, cada página tem um controller próprio
     * que pode ser conferido no header desta.
     * Foi utilizado Inglês para padronizar...
     * 
     * @param string
     *
    */
    public static function getTips($type, $controller){
       
        $tips = array();
        
        $tips['title']     = Yii::t("dicasStrings", "title_" . $type . "_" . $controller);
        $tips['subtitle1'] = Yii::t("dicasStrings", "subtitle1_" . $type . "_" . $controller);
        $tips['subtitle2'] = Yii::t("dicasStrings", "subtitle2_" . $type . "_" . $controller);
        $tips['subtitle3'] = Yii::t("dicasStrings", "subtitle3_" . $type . "_" . $controller);
        $tips['subtitle4'] = Yii::t("dicasStrings", "subtitle4_" . $type . "_" . $controller);
        
        $tips['info_title'] = Yii::t("dicasStrings", "infotitle_" . $type . "_" . $controller);
        $tips['info_desc']  = Yii::t("dicasStrings", "infodescr_" . $type . "_" . $controller);
        $tips['link_label'] = Yii::t("conta/dicasStrings", "link_label"); 
        $tips['link']       = Yii::t("dicasStrings", "hiperlink_" . $type . "_" . $controller);
        $tips['id']         = Yii::t("dicasStrings", "id_" . $type . "_" . $controller);
        
        return $tips;
    } 
    
    /**
     * Método para retornar a dica de acordo com o
     * o tipo da página, cada página tem um controller próprio
     * que pode ser conferido no header desta.
     * Foi utilizado Inglês para padronizar...
     * 
     * @param string
     *
    */
    public static function getTipsConta($type, $controller){
       
        $tips = array();
        
        $tips['title']     = Yii::t("conta/dicasStrings", "title_" . $type . "_" . $controller);
        $tips['subtitle1'] = Yii::t("conta/dicasStrings", "subtitle1_" . $type . "_" . $controller);
        $tips['subtitle2'] = Yii::t("conta/dicasStrings", "subtitle2_" . $type . "_" . $controller);
        $tips['subtitle3'] = Yii::t("conta/dicasStrings", "subtitle3_" . $type . "_" . $controller);
        $tips['subtitle4'] = Yii::t("conta/dicasStrings", "subtitle4_" . $type . "_" . $controller);
        
        $tips['info_title'] = Yii::t("conta/dicasStrings", "infotitle_" . $type . "_" . $controller);
        $tips['info_desc']  = Yii::t("conta/dicasStrings", "infodescr_" . $type . "_" . $controller);
        $tips['link_label'] = Yii::t("conta/dicasStrings", "link_label");        
        $tips['link']       = Yii::t("conta/dicasStrings", "hiperlink_" . $type . "_" . $controller);
        $tips['id']         = Yii::t("conta/dicasStrings", "id_" . $type . "_" . $controller);
        
        return $tips;
    }
}
?>