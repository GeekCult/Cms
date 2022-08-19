<?php

/**
 * Description of RodapesUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class RodapesUtils{
    
    /**
     * Método para retornar os attributos dos temas
     *
     * @param number
     *
    */
    public static function getFooterAttributes($modelo){
        
        Yii::import('application.extensions.dbuzz.admin.MateriasManager');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        Yii::import('application.extensions.dbuzz.admin.EventosManager');
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
        $materiasHandler = new MateriasManager();
        
        /*
         * 
         * PS ----> O banner deve estar selecionado para obter os atributos abaixo
         * 
         */

        $result = array();
 
        switch($modelo){
            case "rodape_acervo":
            case "rodape_roma":             
                $result['acervo'] = $materiasHandler->getLastContentLimited(10, 0, 'noticias', false);                
                break;
            
            case "nekocat":
            case "rodape_napoli":
            case "rodape_bellagio":
            case "stalker":

                $comentariosHandler = new ComentariosManager();
                $result['acervo'] = $materiasHandler->getLastContentLimited(10, 0, 'noticias', false);
                
                //Chamada
                $result['chamada_titulo'] = PreferencesUtils::getAttributes('chamada_titulo', 'texto', 'desktop');
                $result['chamada_texto'] = PreferencesUtils::getAttributes('chamada_texto', 'texto', 'desktop');
                
                $result['depoimentos'] = $comentariosHandler->getLimitedContent('depoimentos', 1, 1, 'ORDER BY RAND()');
                $result['titulo_column_1'] = PreferencesUtils::getAttributes('titulo_column_1', 'texto', 'desktop');
                $result['texto_column_1'] = PreferencesUtils::getAttributes('texto_column_1', 'texto', 'desktop');
                $result['link_column_1'] = PreferencesUtils::getAttributes('link_column_1', 'texto', 'desktop');
                
                //Layout
                $result['container_layout_1'] = PreferencesUtils::getAttributes('container_layout_1', 'inteiro', 'desktop');
                $result['container_layout_2'] = PreferencesUtils::getAttributes('container_layout_2', 'inteiro', 'desktop');
                $result['rodape_layout_pos'] = PreferencesUtils::getAttributes('rodape_layout_pos', 'texto', 'desktop');
                
                //Facebooks
                $result['facebook_2'] = PreferencesUtils::getAttributes('facebook_2', 'texto', 'desktop');
                $result['facebook_3'] = PreferencesUtils::getAttributes('facebook_3', 'texto', 'desktop');
                break;
            
            case "rodape_siena":
                $eventosHandler = new EventosManager();
                $result['agenda'] = $eventosHandler->getAgenda('', true, 'LIMIT 3');
                
                //Chamada
                $result['chamada_titulo'] = PreferencesUtils::getAttributes('chamada_titulo', 'texto', 'desktop');
                $result['chamada_texto'] = PreferencesUtils::getAttributes('chamada_texto', 'texto', 'desktop');
                                
                break;
            
            case "rodape_machete":
            case "rodape_brew":
            case "rodape_atenas":
                
                //Chamada
                $result['chamada_titulo'] = PreferencesUtils::getAttributes('chamada_titulo', 'texto', 'desktop');
                $result['chamada_texto'] = PreferencesUtils::getAttributes('chamada_texto', 'texto', 'desktop');
                $result['ft_image_1'] = PreferencesUtils::getAttributes('ft_image_1', 'texto', 'desktop');
                $result['rodape_layout_pos'] = PreferencesUtils::getAttributes('rodape_layout_pos', 'texto', 'desktop');
                                
                break;
            
            case "stalker":
            case "vevo":
                $result['rodape_layout_pos'] = PreferencesUtils::getAttributes('rodape_layout_pos', 'texto', 'desktop');                                
                break;
        }
        
        return $result;
        
    }

}
?>