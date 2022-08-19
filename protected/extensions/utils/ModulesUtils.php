<?php

/**
 * Description of ModulesUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class ModulesUtils{
    
    /**
     * Método para substituir uma chamada de modulo pelo modulo
     * em questão.
     * 
     * @param string
     *
    */
    public static function getModule($stub){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        //Splits gallery
        $id_galeria = StringUtils::get_string_between($stub, "<galeria>", "</galeria>");      
        
        if($id_galeria != ""){
            $stub = str_replace("<galeria>" . $id_galeria, "<div id='md_1'><script>setTimeout(function(){loadModule('md_1', 'slideshow', 'simple', '".$id_galeria."', 'empty', true, 'load', 1, 0, 'articles');}, 1000);</script></div>", $stub);
            $stub = str_replace("</galeria>", "", $stub);
        }
        
        //Splits image
        $image  = StringUtils::get_string_between($stub, "<imagem>", "</imagem>");     
        $image2 = StringUtils::get_string_between($stub, "<imagem2>", "</imagem2>"); 
        $image3 = StringUtils::get_string_between($stub, "<imagem3>", "</imagem3>"); 
        $image4 = StringUtils::get_string_between($stub, "<imagem4>", "</imagem4>"); 
        $image5 = StringUtils::get_string_between($stub, "<imagem5>", "</imagem5>"); 
        $image6  = StringUtils::get_string_between($stub,"<imagem6>", "</imagem6>");     
        $image7 = StringUtils::get_string_between($stub, "<imagem7>", "</imagem7>"); 
        $image8 = StringUtils::get_string_between($stub, "<imagem8>", "</imagem8>"); 
        $image9 = StringUtils::get_string_between($stub, "<imagem9>", "</imagem9>"); 
        $image10 = StringUtils::get_string_between($stub,"<imagem10>","</imagem10>"); 
        $image11 = StringUtils::get_string_between($stub,"<imagem11>","</imagem11>"); 
        
        if($image != "" || $image != NULL){
            $id = explode('-', $image);        
            $stub = str_replace("<imagem>" . $image, "</p><div id='img_$id[0]'><script>setTimeout(function(){loadModule('img_$id[0]', 'images', '$image', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem>", "", $stub);
        }
        
        if($image2 != "" || $image2 != NULL){
            $id = explode('-', $image2);        
            $stub = str_replace("<imagem2>" . $image2, "</p><div id='img_$id[0]_2'><script>setTimeout(function(){loadModule('img_$id[0]_2', 'images', '$image2', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem2>", "", $stub);
        }
        
        if($image3 != "" || $image3 != NULL){
            $id = explode('-', $image3);        
            $stub = str_replace("<imagem3>" . $image3, "</p><div id='img_$id[0]_3'><script>setTimeout(function(){loadModule('img_$id[0]_3', 'images', '$image3', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem3>", "", $stub);
        }
        
        if($image4 != "" || $image4 != NULL){
            $id = explode('-', $image4);        
            $stub = str_replace("<imagem4>" . $image4, "</p><div id='img_$id[0]_4'><script>setTimeout(function(){loadModule('img_$id[0]_4', 'images', '$image4', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem4>", "", $stub);
        }
        
        if($image5 != "" || $image5 != NULL){
            $id = explode('-', $image5);        
            $stub = str_replace("<imagem5>" . $image5, "</p><div id='img_$id[0]_5'><script>setTimeout(function(){loadModule('img_$id[0]_5', 'images', '$image5', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem5>", "", $stub);
        }
        
        if($image6 != "" || $image6 != NULL){
            $id = explode('-', $image6);        
            $stub = str_replace("<imagem6>" . $image6, "</p><div id='img_$id[0]_6'><script>setTimeout(function(){loadModule('img_$id[0]_6', 'images', '$image6', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem6>", "", $stub);
        }
        
        if($image7 != "" || $image7 != NULL){
            $id = explode('-', $image7);        
            $stub = str_replace("<imagem7>" . $image7, "</p><div id='img_$id[0]_7'><script>setTimeout(function(){loadModule('img_$id[0]_7', 'images', '$image7', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem7>", "", $stub);
        }
        
        if($image8 != "" || $image8 != NULL){
            $id = explode('-', $image8);        
            $stub = str_replace("<imagem8>" . $image8, "</p><div id='img_$id[0]_8'><script>setTimeout(function(){loadModule('img_$id[0]_8', 'images', '$image8', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem8>", "", $stub);
        }
        
        if($image9 != "" || $image9 != NULL){
            $id = explode('-', $image9);        
            $stub = str_replace("<imagem9>" . $image9, "</p><div id='img_$id[0]_9'><script>setTimeout(function(){loadModule('img_$id[0]_9', 'images', '$image9', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem9>", "", $stub);
        }
        
        if($image10 != "" || $image10 != NULL){
            $id = explode('-', $image10);        
            $stub = str_replace("<imagem10>" . $image10, "</p><div id='img_$id[0]_10'><script>setTimeout(function(){loadModule('img_$id[0]_10', 'images', '$image10', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem10>", "", $stub);
        }
        
        if($image11 != "" || $image11 != NULL){
            $id = explode('-', $image11);        
            $stub = str_replace("<imagem11>" . $image11, "</p><div id='img_$id[0]_11'><script>setTimeout(function(){loadModule('img_$id[0]_11', 'images', '$image11', '".$id[0]."', 'empty', true, 'load', 1, '', '');},1000);</script></div><p>", $stub);
            $stub = str_replace("</imagem11>", "", $stub);
        }
        
        return $stub; 
    }  
    
    // Converts a string to a proper format, ready to be used in URL's
    public static function defineComment($stub) {
        
        $stub = str_replace("<comentario>", "</p><p class='italic'><i class='aspas'></i>", $stub);
        $stub = str_replace("</comentario>", "<i class='aspas_end'></i></p><p>", $stub);
        
        $stub = str_replace("<comentario_simples>", "</p><div class='relative'><div class='aspas_round'></div><p class='italic mediumColumnTable4 inline_block'>", $stub);
        $stub = str_replace("</comentario_simples>", "<div class='aspas_round_end'></div></p><p>", $stub);
        
        $stub = str_replace("<comentario_square>", "</p><div class='cnCmS'><div class='aspas_square'></div><div class='lSp'><p class='italic mediumColumnTable4 inline_block'>", $stub);
        $stub = str_replace("</comentario_square>", "<div class='aspas_square_end'></div></div></p><p>", $stub);
        
        return $stub;
    }
    
    // Gets modules purchased
    public static function getDataModules($id_user){

        $session = MethodUtils::getSessionData();
        $recordset = array();
        
        if($session[$id_user."_".'modulo_vitrine'] == '1'){
            Yii::import('application.extensions.utils.modulos.VitrineUtils');
            $recordset['modulo_vitrine'] = VitrineUtils::getAllContent($id_user, "vitrine"); 
        }
         
        return $recordset;
    }
    
    // Gets modules purchased
    public static function getSocialNetworksForEmails($data, $tipo = "email"){
        
        $amount = 0; $result = "";
        $server = $_SERVER['SERVER_NAME'];
        
        if($data['facebook']) $amount++;
        if($data['twitter'])  $amount++;
        if($data['rss'])  $amount++;
        
        $facebook = "http://www.facebook.com.br/".$data['facebook'];
        $twitter = "http://www.twitter.com.br/".$data['twitter'];
        $rss = "http://" . $server . "/site/rss";       
        
        $path = "http://" . $server . "/media/images/email/";
        $style1 = "text-align:center; margin-bottom: 20px";
        $style2 = "margin-left:65px; margin-bottom: 20px; float:left";
        $style3 = "margin-bottom: 20px; float:left";
        
        switch ($tipo){
            case "email":
                if($amount == 0){
                    $result = "";
                }
                
                if($amount == 1){
                    if($data['twitter']) $result = "<div style='$style1'><a href='$twitter'><img src='".$path. "bt_nt_twitter.png' alt='twitter'/></a></div>";
                    if($data['facebook']) $result = "<div style='$style1'><a href='$facebook'><img src='".$path. "bt_nt_facebook.png' alt='facebook'/></a></div>";
                }
                
                if($amount == 2){
                    if($data['twitter']) $result .= "<div style='$style2'><a href='$twitter'><img src='".$path. "bt_nt_twitter.png' alt='twitter'/></a></div>";
                    if($data['facebook']) $result .= "<div style='$style2'><a href='$facebook'><img src='".$path. "bt_nt_facebook.png' alt='facebook'/></a></div>";
                    if($data['rss']) $result .= "<div style='$style2'><a href='$rss'><img src='".$path. "bt_nt_rss.png' alt='rss'/></a></div>";
                }
                
                if($amount == 3){
                    if($data['twitter']) $result .= "<div style='$style3'><a href='$twitter'><img src='".$path. "bt_nt_twitter.png' alt='twitter'/></a></div>";
                    if($data['facebook']) $result .= "<div style='$style3'><a href='$facebook'><img src='".$path. "bt_nt_facebook.png' alt='facebook'/></a></div>";
                    if($data['rss']) $result .= "<div style='$style3'><a href='$rss'><img src='".$path. "bt_nt_rss.png' alt='rss'/></a></div>";
                }
                break;
        }
         
        return $result;
    }
    
   

}
?>
