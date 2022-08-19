<?php

/**
 * Description of ToposUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class BannerElementsUtils{
    
    /**
     * Método para retornar os attributos dos temas
     *
     * @param number
     *
    */
    public static function getBannersAttributes($modelo){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 

        $result = array();
        
        switch($modelo){
            
            case "megratron":
            case "banner_orcamentus":
                //Attributes
                $result['botao_label_1'] = PreferencesUtils::getAttributes('botao_label_1', 'texto');
                $result['botao_link_1'] = PreferencesUtils::getAttributes('botao_link_1', 'texto');
                $result['botao_label_2'] = PreferencesUtils::getAttributes('botao_label_2', 'texto');
                $result['botao_link_2'] = PreferencesUtils::getAttributes('botao_link_2', 'texto');                
                break;
            
            case "banner_rolodex":
                //Attributes
                $result['nr_animation'] = PreferencesUtils::getAttributes('nr_animation', 'inteiro');
                $result['intervalo_animation'] = PreferencesUtils::getAttributes('intervalo_animation', 'inteiro');
                break;
            
            case "banner_google_plus":
                //Attributes
                $result['nr_animation'] = PreferencesUtils::getAttributes('nr_animation', 'inteiro');
                $result['intervalo_animation'] = PreferencesUtils::getAttributes('intervalo_animation', 'inteiro');
                break;
            
            default:
                
                break;
            
        }
        
        $result['banner_layout'] = PreferencesUtils::getAttributes('banner_layout', 'texto', 'desktop'); 
        return $result;
    }
    
    /**
     * Método para retornar os attributos dos temas
     *
     * @param number
     *
    */
    public static function updateBannerAttributes($data, $params){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 

        $result = array();
        
        switch($data['cool']){
            
            case "megratron":
            case "banner_orcamentus":
                //Attributes
                if(isset($params['botao_label_1']))$result['botao_label_1'] = PreferencesUtils::setAttributes('botao_label_1', $params['botao_label_1'], 'texto');
                if(isset($params['botao_link_1']))$result['botao_link_1'] = PreferencesUtils::setAttributes('botao_link_1', $params['botao_link_1'], 'texto');
                if(isset($params['botao_label_2']))$result['botao_label_2'] = PreferencesUtils::setAttributes('botao_label_2', $params['botao_label_2'], 'texto');
                if(isset($params['botao_link_2']))$result['botao_link_2'] = PreferencesUtils::setAttributes('botao_link_2', $params['botao_link_2'], 'texto');
                
                break;
            
            case "banner_rolodex":
                //Attributes
                if(isset($params['nr_animation']))$result['nr_animation'] = PreferencesUtils::setAttributes('nr_animation', $params['nr_animation'], 'inteiro');
                if(isset($params['intervalo_animation']))$result['intervalo_animation'] = PreferencesUtils::setAttributes('intervalo_animation', $params['intervalo_animation'], 'inteiro');
                break;
                
            default:
                
                break;
            
        }
        
        //$result['banner_layout'] = PreferencesUtils::getAttributes('banner_layout', 'texto', 'desktop'); 
        return $result;
    }       
        
    
}
?>