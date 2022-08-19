<?php

/**
 * Description of TexturasUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class TexturasUtils{
    
    /**
     * Método para pegar as propriedades do evento, usado en Novo e editar Admin
     * Este métod agrupa as propriedades do objeto em um array para facilitar o uso deste
     * na view.
     * 
     * @type
     * @action
     * @id_controller
     * @id_page
     *
     * @param string 
     * @param string
     *
    */
    public static function getAttributes($type) {
        
        $result['local'] = $type;
        
        switch ($type){
            
            case "efeitos":
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 1;
                $result['title_tab'] = "Texturas";
                $result['link'] = "paginas";
                break;
            
            case "paginas":
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 0;
                $result['title_tab'] = "Efeitos";
                $result['link'] = "efeitos";
                break;
            
            case "site":
            case "rodape":
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 0;
                $result['title_tab'] = "Efeitos";
                $result['link'] = "efeitos";
                break;
            
            case "intro":
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 0;
                $result['title_tab'] = "Intro";
                $result['link'] = "intro";
                break;
            
            case "mensagem":  
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 0;
                $result['title_tab'] = "Mensagem";
                $result['link'] = "mensagem";
                break;
            
            case "icones":  
                $result['width_fake']= "120";
                $result['height_fake'] = "120";
                $result['bg_type'] = 0;
                $result['title_tab'] = "Efeitos";
                $result['link'] = "efeitos";
                break;
        }
             
        $result['init'] = true;
        $result['id_page'] = 2;
        
        return $result;

    } 
    
    /*
     * Return the correct string type type
     * 
     * @param number
     * 
     */
    public static function getTypeTexture($type){
        
        $result = "";
        
        switch ($type){
            
            case "1":
                $result = "repeat";
                break;
            case "2":
                $result = "no-repeat";
                break;
            case "3":
            case "5":
                $result = "repeat-x";
                break;
            case "4":
                $result = "repeat-y";
                break;
            default:
                $result = "repeat";
                break;
            } 
            //echo $type . ' - ' . $result .  ':';
        return $result;
    }
    
    /*
     * Return the correct url string
     * 
     * @param string
     * 
     */
    public static function getTextureInputs($url_texture){
        
        $split = explode(".", $url_texture);
        $result['left'] = $split[0]."_left." . $split[1];
        $result['middle'] = $split[0]."_middle." . $split[1];
        $result['right'] = $split[0]."_right." . $split[1];
        
        return $result;
    }
    
    /*
     * Return the correct attributes from a specific class
     * PS: Pay attention to set the classes bellow on the colors.css
     * into cool css folder.
     * 
     * @param string
     * 
     */
    public static function getAttributesByClass($class){
        
        $result = "";
        
        switch ($class){
            
            case "alert_yellow_simple":
                $result['background_color'] = "#fffee6";
                $result['border_color'] = "#ffee36";
                $result['font_color'] = "#333";
                break;
            
            case "alert_blue_simple":
                $result['background_color'] = "#135a7d";
                $result['border_color'] = "#053750";
                $result['font_color'] = "#f1f1f1";
                break;
            
            case "alert_red_simple":
                $result['background_color'] = "#940606";
                $result['border_color'] = "#520202";
                $result['font_color'] = "#f1f1f1";
                break;
            
            case "alert_black_simple":
                $result['background_color'] = "#333333";
                $result['border_color'] = "#f1f1f1";
                $result['font_color'] = "#f1f1f1";
                break;
            
            case "alert_white_simple":
                $result['background_color'] = "#f9f9f9";
                $result['border_color'] = "#333333";
                $result['font_color'] = "#333333";
                break;
            
            case "alert_orange_simple":
                $result['background_color'] = "#ff9900";
                $result['border_color'] = "#d98c07";
                $result['font_color'] = "#fff";
                break;
            
            case "alert_purple_simple":
                $result['background_color'] = "#981aa3";
                $result['border_color'] = "#6a0573";
                $result['font_color'] = "#fff";
                break;
        }
        return $result;
    }
    
    /*
     * Return the correct attributes from a specific class
     * PS: Pay attention to set the classes bellow on the botao_responsivos.css
     * 
     * @param string
     * 
     */
    public static function getCSSProperties($class){
        
        $result = "";
  
        switch ($class){
            
            case "btn-red":
                $result['common'] = "color: #ffffff; background-color: #e80707; background-image: linear-gradient(to bottom, #f70d0d, #c71212); border-color: #c40a0a #c40a0a #c40a0a; border: 1px solid #c40a0a; *border: 4; -webkit-border-radius: 4px; -moz-border-radius: 4px;";
                $result['hover'] = "color: #ffffff; background-color: #c71212; background-image: linear-gradient(to bottom, #c71212, #c71212); border-color: #c40a0a #c40a0a #c40a0a;";
                break;
            case "btn-simple-blue":
                $result['common'] = "color:#ffffff; background-color: #147cc7; border-color: #0962a1 #0962a1 #0962a1; background-image: none; border: 1px solid #0962a1; *border: 4; -webkit-border-radius: 4px; -moz-border-radius: 4px;";
                $result['hover'] = "color: #ffffff; background-color: #156dd9; border-color: #0962a1 #0962a1 #0962a1; background-image: none;} background-image: none!important;";
                break;
            
            case "btn-flat-blue":
                $result['common'] = "color:#ffffff; background-color: #147cc7; border-color: #147cc7 #147cc7 #147cc7; background-image: none; border-radius: 0px;border: 1px solid #156dd9; *border: 0; -webkit-border-radius: 0px; -moz-border-radius: 0px;";
                $result['hover'] = "color:#ffffff; background-color: #156dd9; border-color: #156dd9 #156dd9 #156dd9; background-image: none; border-radius: 0px; background-image: none!important;";
                break;
            
            case "btn-green":
                $result['common'] = "color: #ffffff;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);background-color: #5bb75b;background-image: -moz-linear-gradient(top, #62c462, #51a351);background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351)); background-image: -webkit-linear-gradient(top, #62c462, #51a351); background-image: -o-linear-gradient(top, #62c462, #51a351); background-image: linear-gradient(to bottom, #62c462, #51a351); background-repeat: repeat-x; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0); border: 1px solid green";
                $result['hover'] = "color: #ffffff!important;background-color: #4AA04A!important; background-image: none!important;";
                break;
            
            case "btn-white":
                $result['common'] = "color: #333333; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(to bottom, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0); border-color: #e6e6e6 #e6e6e6 #bfbfbf; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); *background-color: #e6e6e6; filter: progid:DXImageTransform.Microsoft.gradient(enabled = false); border: 1px solid #bbbbbb; *border: 0; border-bottom-color: #a2a2a2; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; *margin-left: .3em; -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05); -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05); box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);";
                $result['hover'] = "color: #333333;background-color: #e6e6e6; background-image: none!important; ";
                break;
            
            case "btn-purple":
                $result['common'] = "color: #ffffff; background-color: #94093e; background-image: linear-gradient(to bottom, #bf076c, #780237); border-color: #78053e #78053e #78053e;";
                $result['hover'] = "color: #ffffff;background-color: #780237; background-image: linear-gradient(to bottom, #780237, #780237); border-color: #78053e #78053e #78053e;";
                break;
            
            case "btn-orange-shine":
                $result['common'] = "background-color: #EEA12E; background-image: -moz-linear-gradient(center top , #EEA72E 0%, #C67729 50%, #B54E00 50%, #893B00 100%); border: 1px solid #951100;border-radius: 5px; box-shadow: 0 0 0 1px rgba(255, 115, 100, 0.4) inset, 0 1px 3px #333333; color: #fff; padding: 5px 14px;text-align: center;text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.8);min-width: 100px;";
                $result['hover'] = "color: #ffffff;background-image: linear-gradient(to bottom, #780237, #780237); border-color: #78053e #78053e #78053e;";
                break;
            
            case "btn-yellow":
                $result['common'] = "background: #ffea00; background-image: -webkit-linear-gradient(top, #ffea00, #ffcc00); background-image: -moz-linear-gradient(top, #ffea00, #ffcc00); background-image: -ms-linear-gradient(top, #ffea00, #ffcc00); background-image: -o-linear-gradient(top, #ffea00, #ffcc00); background-image: linear-gradient(to bottom, #ffea00, #ffcc00); -webkit-border-radius: 5; -moz-border-radius: 5; border-radius: 5px; text-shadow: 1px 1px 1px #666666; color: #ffffff; border: solid #edcd00 1px; text-decoration: none;";
                $result['hover'] = "background: #ffde00;  text-decoration: none;";
                break;
            
            case "btn-black":
                $result['common'] = "background: #585858; background-image: -webkit-linear-gradient(top, #585858, #232323); background-image: -moz-linear-gradient(top, #585858, #232323); background-image: -ms-linear-gradient(top, #585858, #232323); background-image: -o-linear-gradient(top, #585858, #232323); background-image: linear-gradient(to bottom, #585858, #232323); -webkit-border-radius: 5; -moz-border-radius: 5; border-radius: 5px; text-shadow: 1px 1px 1px #666666; color: #ffffff; border: solid #474646 1px; text-decoration: none;";
                $result['hover'] = "background: #585858;  text-decoration: none;";
                break;
            
        }
        
        return $result;
    }

}
?>
