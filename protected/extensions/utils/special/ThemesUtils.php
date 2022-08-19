<?php

/**
 * Description of ThemesUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class ThemesUtils{
    
    /**
     * Método para retornar os attributos dos temas
     *
     * @param number
     *
    */
    public static function getThemeAttributes($theme){
        
        $result = array();
        switch($theme){
            case "red":
                $result['background-top'] = "red_simple_top.png";
                $result['background-middle'] = "red_simple_middle.png";
                $result['background-bottom'] = "red_simple_bottom.png";
                $result['color'] = "#f1f1f1";
                $result['font-family'] = "avaliation";
                $result['font-size'] = "1em";
                $result['background-color'] = "#940606";
                $result['divider'] = "#6a0101";
                $result['subitem-color'] = "#CCCCCC";
                
                break;
            case "black":
                $result['background-top'] = "black_simple_top.png";
                $result['background-middle'] = "black_simple_middle.png";
                $result['background-bottom'] = "black_simple_bottom.png";
                $result['color'] = "#f1f1f1";
                $result['font-family'] = "avaliation";
                $result['font-size'] = "1em";
                $result['background-color'] = "#940606";
                $result['divider'] = "#0b0b0b";
                $result['subitem-color'] = "#CCCCCC";
                
                break;
           case "transparent":
                $result['background-top'] = "transparent_simple_top.png";
                $result['background-middle'] = "transparent_simple_middle.png";
                $result['background-bottom'] = "transparent_simple_bottom.png";
                $result['color'] = "#000000";
                $result['font-family'] = "avaliation";
                $result['font-size'] = "1em";
                $result['background-color'] = "#940606";
                $result['divider'] = "#cacaca";
                $result['subitem-color'] = "#111111";
                
                break;
            
            default:
                $result['background-top'] = "";
                $result['background-middle'] = "";
                $result['background-bottom'] = "";
                $result['color'] = "";
                $result['font-family'] = "";
                $result['font-size'] = "";
                $result['background-color'] = "";
                $result['divider'] = "";
                $result['subitem-color'] = "";
                
                break;
        }
        
        return $result;
    }
    
}
?>