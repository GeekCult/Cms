<?php

/*
 * This Class is used to controll all functions related the feature fontes
 *
 * @author CarlosGarcia
 *
 * Date: 16/12/2010
 *
 */

class FontesManager{

    /**
     * Método para recuperar os registros relacionados as 
     * cores dos textos da tabela minhas preferencias.
     *
    */
    public function getContent(){
        
        $select = "texto_cor, subtitulo_cor, titulo_cor, link_cor, link_cor_hover, menu_cor, menu_cor_hover, botao_cor, botao_cor_hover, input_text_cor";
        $sql = "SELECT ".$select." FROM preferencias_data";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();            
            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para recuperar os registros relacionados aos 
     * attributos de cores dos textos da tabela minhas preferencias attributes.
     *
    */
    public function getFontsAttributes($isType = 'popup'){        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        if($isType == 'popup'){
            $result['title_popup'] = PreferencesUtils::getAttributes("title_popup", "texto");
            $result['text_popup'] = PreferencesUtils::getAttributes("text_popup", "texto");
            $result['chamada_cor'] = PreferencesUtils::getAttributes("chamada_cor", "texto");
        }
        
        if($isType == 'size'){
            $result['title_size'] = PreferencesUtils::getAttributes("title_size", "texto");
            $result['text_size'] = PreferencesUtils::getAttributes("text_size", "texto");
            $result['text_line_height'] = PreferencesUtils::getAttributes("text_line_height", "texto");
            $result['text_alignment'] = PreferencesUtils::getAttributes("text_alignment", "texto");
            $result['subtitle_size'] = PreferencesUtils::getAttributes("subtitulo_size", "number");
            $result['subtitle_line'] = PreferencesUtils::getAttributes("subtitulo_line", "number");
            $result['subtitle_alinhamento'] = PreferencesUtils::getAttributes("subtitulo_alinhamento", "texto");
            $result['subtitle_fonte'] = PreferencesUtils::getAttributes("subtitulo_fonte", "texto");
            $result['chamada_size'] = PreferencesUtils::getAttributes("chamada_size", "number");
            $result['chamada_line'] = PreferencesUtils::getAttributes("chamada_line", "number");
            $result['chamada_alinhamento'] = PreferencesUtils::getAttributes("chamada_alinhamento", "texto");
            $result['chamada_fonte'] = PreferencesUtils::getAttributes("chamada_fonte", "texto");
        }
        
        return $result;
    }

    /**
     * Método para atualizar um novo registro existente
     * The get_post variable is a POST content from jQuery
     *
     * @param array 
     *
    */
    public function updateContent($get_post){

        $values = "texto_cor = '" . $get_post[1]."', titulo_cor = '".$get_post[0]."', link_cor = '".$get_post[2]."', " .
                  "link_cor_hover = '" .$get_post[3] . "', menu_cor = '" .$get_post[4] . "', " .
                  "menu_cor_hover = '" .$get_post[5] . "', subtitulo_cor = '" .$get_post[6] . "', " .
                  "botao_cor_hover = '" .$get_post[7] . "', botao_cor = '" .$get_post[8] . "', " .
                  "input_text_cor = '" .$get_post[9]. "'";

        $sql =  "UPDATE preferencias_data SET ". $values ."";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando -> execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar um novo registro existente,
     * este método é para a personalização das cores sem ter de mexer
     * na tabela preferencias, esse método adiciona na tabela preferencia_attribute
     *
     * @param array 
     *
    */
    public function updateAttributes($data){
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        //Popup
        if(isset($data['title_popup']))$setAttributes = PreferencesUtils::setAttributes("title_popup", $data['title_popup'], "texto");
        if(isset($data['text_popup']))$setAttributes = PreferencesUtils::setAttributes("text_popup",$data['text_popup'], "texto");
        if(isset($data['chamada_cor']))$setAttributes = PreferencesUtils::setAttributes("chamada_cor",$data['chamada_cor'], "texto");
        
        //Fonts Size
        if(isset($data['title_size']))$setAttributes = PreferencesUtils::setAttributes("title_size", $data['title_size'], "texto");
        if(isset($data['text_size']))$setAttributes = PreferencesUtils::setAttributes("text_size",$data['text_size'], "texto");
        if(isset($data['text_line_height']))$setAttributes = PreferencesUtils::setAttributes("text_line_height",$data['text_line_height'], "texto");
        if(isset($data['text_alignment']))$setAttributes = PreferencesUtils::setAttributes("text_alignment",$data['text_alignment'], "texto");
        
        if(isset($data['subtitulo_size']))$setAttributes = PreferencesUtils::setAttributes("subtitulo_size",$data['subtitulo_size'], "number");
        if(isset($data['subtitulo_line']))$setAttributes = PreferencesUtils::setAttributes("subtitulo_line",$data['subtitulo_line'], "number");
        if(isset($data['subtitulo_alinhamento']))$setAttributes = PreferencesUtils::setAttributes("subtitulo_alinhamento",$data['subtitulo_alinhamento'], "texto");
        if(isset($data['subtitulo_fonte']))$setAttributes = PreferencesUtils::setAttributes("subtitulo_fonte",$data['subtitulo_fonte'], "texto");
        
        if(isset($data['chamada_size']))$setAttributes = PreferencesUtils::setAttributes("chamada_size",$data['chamada_size'], "number");
        if(isset($data['chamada_line']))$setAttributes = PreferencesUtils::setAttributes("chamada_line",$data['chamada_line'], "number");
        if(isset($data['chamada_alinhamento']))$setAttributes = PreferencesUtils::setAttributes("chamada_alinhamento",$data['chamada_alinhamento'], "texto");
        if(isset($data['chamada_fonte']))$setAttributes = PreferencesUtils::setAttributes("chamada_fonte",$data['chamada_fonte'], "texto");
       
        return $setAttributes;
    }
}
?>