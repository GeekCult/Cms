<?php

/**
 * Description of ToposUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class ToposUtils{
    
    /**
     * Método para retornar os attributos dos temas
     *
     * @param number
     *
    */
    public static function getHeaderAttributes($modelo){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 

        $result = array();
        $layout = false;
        
        switch($modelo){
            
            case "topo_glamo":
            case "topo_ragazzo":  
            case "topo_perseus":
                //Colors
                $result['topo_cor_1'] = PreferencesUtils::getAttributes('topo_cor_1', 'texto', 'desktop');
                $result['topo_cor_2'] = PreferencesUtils::getAttributes('topo_cor_2', 'texto', 'desktop');
                $result['topo_cor_3'] = PreferencesUtils::getAttributes('topo_cor_3', 'texto', 'desktop');
                $result['topo_cor_4'] = PreferencesUtils::getAttributes('topo_cor_4', 'texto', 'desktop');
                $result['topo_cor_5'] = PreferencesUtils::getAttributes('topo_cor_5', 'texto', 'desktop');
                $result['topo_cor_6'] = PreferencesUtils::getAttributes('topo_cor_6', 'texto', 'desktop');
                if($modelo == 'topo_glamo') $layout = 'glamo';
                if($modelo == 'topo_perseus') $layout = 'perseus';
                break;
            
            case "topo_odin":                 
                //Textos
                $result['topo_titulo_1'] = PreferencesUtils::getAttributes('topo_titulo_1', 'texto', 'desktop');
                $result['topo_link_1'] = PreferencesUtils::getAttributes('topo_link_1', 'texto', 'desktop'); 
                if($modelo == 'topo_odin') $layout = 'odin';                
                break;
            
            default:
                //Colors
                $result['topo_cor_1'] = PreferencesUtils::getAttributes('topo_cor_1', 'texto', 'desktop');
                $result['topo_cor_2'] = PreferencesUtils::getAttributes('topo_cor_2', 'texto', 'desktop');
                $result['topo_cor_3'] = PreferencesUtils::getAttributes('topo_cor_3', 'texto', 'desktop');
                $result['topo_cor_4'] = PreferencesUtils::getAttributes('topo_cor_4', 'texto', 'desktop');
                $result['topo_cor_5'] = PreferencesUtils::getAttributes('topo_cor_5', 'texto', 'desktop');
                $result['topo_cor_6'] = PreferencesUtils::getAttributes('topo_cor_6', 'texto', 'desktop');
                if($modelo == 'topo_ecommerce_laffaiete') $layout = 'laffaiete';
                if($modelo == 'topo_osiris') $layout = 'osiris';
                //if($modelo == 'topo_searchbox') $layout = 'search';
                break;
            
        }
        
        //Add complementary files
        $setFiles = ToposUtils::addScript($layout);
        
        $result['topo_layout'] = PreferencesUtils::getAttributes('topo_layout', 'texto', 'desktop');
        $result['frase_searchbox'] = PreferencesUtils::getAttributes("frase_searchbox", 'texto', 'desktop');
 
        return $result;
        
    }
    
    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public static function addScript($layout = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        if($layout)  $cs->registerCssFile($baseUrl . "/css/site/components/headers/$layout.css", 'screen', CClientScript::POS_HEAD);

    }      
        
    
}
?>