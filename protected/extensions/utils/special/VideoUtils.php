<?php

/**
 * Description of VideoUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class VideoUtils{
    
    /**
     * Método para dar resize no video
     *
     * @param string
     *
    */
    public static function resizeVideo($link, $size = false){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        $width  = StringUtils::get_string_between($link, 'width="', '"');
        $height = StringUtils::get_string_between($link, 'height="', '"');
         
        //SMALL 
        $small = str_replace($width, "160", $link);
        $small = str_replace($height, "100", $small);
        $result['small'] = $small;
        
        //Medium 
        $medium = str_replace($width, "210", $link);
        $medium = str_replace($height, "130", $medium);
        $result['medium'] = $medium;
        
        //Regular 
        $regular = str_replace($width, "560", $link);
        $regular = str_replace($height, "350", $regular);
        $result['regular'] = $regular;
        
        //Regular 2 
        $regular2 = str_replace($width, "620", $link);
        $regular2 = str_replace($height, "370", $regular2);
        $result['regular2'] = $regular2;
        
        //Medium 
        $medium = str_replace($width, "210", $link);
        $medium = str_replace($height, "210", $medium);
        $result['medium'] = $medium;
        
        //Big 
        $big = str_replace($width, "940", $link);
        $big = str_replace($height, "540", $big);
        $result['big'] = $big;
        
        //Giant 
        $giant = str_replace($width, "960", $link);
        $giant = str_replace($height, "540", $giant);
        $result['giant'] = $giant;
        
        if($size) return $result[$size];
        return $result;

    }
    
}
    
?>
