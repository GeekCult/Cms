<?php

/**
 * Description of PicturesUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class GraphicsUtils {
    
    /**
     * Método para retornar o a foto, flash banner ou html banner needed
     * 
     * @param number
     *
    */
    public static function getCoolContent($container, $isContainer = true) {
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $type = explode("_", $container);
        
        switch ($type[0]){
            
            case "b":
                if($isContainer){
                    $recordset['container'] = GraphicsHelperUtils::getBanner($type[1]);
                    $recordset['container']['slot_type'] = $type[0];
                }else{
                    $recordset = GraphicsHelperUtils::getBanner($type[1]);
                    $recordset['slot_type'] = $type[0];
                }
                break;

            case "f":
                if($isContainer){
                    if(GraphicsHelperUtils::getPhotos($type[1])){
                    $recordset['container'] = GraphicsHelperUtils::getPhotos($type[1]);
                    $recordset['container']['slot_type'] = $type[0];
                    $recordset['container']['id'] = $container;
                    }else{
                    $recordset['container'] = false;
                    $recordset['container']['slot_type'] = false;
                    $recordset['container']['id'] = false;    
                    } 
                }else{
                    if(GraphicsHelperUtils::getPhotos($type[1])){
                    $recordset = GraphicsHelperUtils::getPhotos($type[1]);
                    $recordset['slot_type'] = $type[0];
                    $recordset['id'] = $container;
                    }else{
                    $recordset = false;
                    $recordset['slot_type'] = false;
                    $recordset['id'] = false;    
                    } 
                }
                break;
            
            case "c":
                if(GraphicsHelperUtils::getCool($type[1])){
                $recordset = GraphicsHelperUtils::getCool($type[1]);
                }
                break;
                
            case "e": 
                $recordset['container'] = GraphicsHelperUtils::getEmbededImages($type[1]);
                $recordset['container']['slot_type'];
                break;
                
            default: 
                if($isContainer){
                    $recordset['container'] = "";
                    $recordset['container']['slot_type'] = "";
                    $recordset['container']['foto'] = "";
                    $recordset['container']['icon']['cool_j'] = "";
                }else{
                    $recordset = "";
                    $recordset['slot_type'] = "";
                    $recordset['foto'] = "";
                    $recordset['icon']['cool_j'] = "";
                }
                break;

        }        
        return $recordset;
    }  
}
?>
