<?php

/**
 * Description of PreferencesUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class PreferencesUtils {

    
    /**
     * Método para pegar a coluna relacionada ao detalhe selecionado
     * parece bobo mais com isso fica mais fácil evoluir mais tarde
     *
     * @param string 
     *
    */
    public static function getDetailsSelected($type) {
        $type_detail = "";
        switch ($type){
            
            case "icons":
                $type_detail = "icons";           
                break;            
            case "flags":
                $type_detail = "flags";                
                break;
            case "container":
                $type_detail = "classe_container";                
                break;
            default:
                $type_detail = $type;
                break;
        }       
        return $type_detail;
    } 
    
    /**
     * Método para pegar a coluna relacionada ao detalhe selecionado
     * parece bobo mais com isso fica mais fácil evoluir mais tarde
     *
     * @param string 
     *
    */
    public static function getTextureSelected($type) {
        
        switch ($type){            
            case "site":
                $type_texture = "textura_site";           
                break;            
            case "topo":
                $type_texture = "textura_topo";           
                break;
            case "rodape":
                $type_texture = "textura_rodape";           
                break;
            case "menu":
                $type_texture = "textura_menu";           
                break;            
            case "botao":
                $type_texture = "textura_botao";           
                break;            
            case "overlay":
                $type_texture = "textura_overlay";           
                break;            
            case "paginas":
                $type_texture = "textura_paginas";                
                break;
            case "menu":
                $type_texture = "classe_container";                
                break;
            case "banners":
                $type_texture = "textura_banners";                
                break;
            case "topo_email":
                $type_texture = "textura_topo_email";                
                break;
            case "rodape_email":
                $type_texture = "textura_rodape_email";                
                break;
            case "sombras":
                $type_texture = "textura_sombras"; 
                break;
            case "detalhes":
                $type_texture = "textura_detalhes"; 
                break;
            case "intro":
                $type_texture = "textura_intro"; 
                break;
            case "mensagem":
                $type_texture = "textura_mensagem"; 
                break;
            case "textos":
                $type_texture = "textura_textos"; 
                break;            
            case "wallpaper":
                $type_texture = "textura_wallpaper"; 
                break;            
            default:
                $type_texture = "textura_site";            
                break;
        }       
        return $type_texture;
    } 
    
    /**
     * Com o nome da coluna busca na tabela preferencias_data pelo 
     * item em destaque
     *
     * @param string 
     *
    */
    public static function getPreferedItem($item){ 
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;

        $sql = "SELECT $item FROM preferencias_data WHERE id_user = $id_user";
   
        try{            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset[$item];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            return false;
        }
    }
    
    /**
     * Com o nome da coluna seta o valor correspondente 
     *
     * @param string 
     *
    */
    public static function setPreferedItem($field, $value, $plataforma = 'desktop'){        

        $values = "$field = '" . $value ."'";
        $sql =  "UPDATE preferencias_data SET ". $values ." WHERE tipo = '" .$plataforma . "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Com o nome da coluna busca na tabela preferencias_data pelo 
     * item em destaque
     *
     * @param string 
     *
    */
    public static function getPageSelected($id){        

        $sql = "SELECT layout FROM paginas_data WHERE id = $id";
   
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset['layout'];
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Save the gateways attributes
     *
     * @param array 
     *
    */
    public static function saveGatewaysPayment($dados){      

        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        if($dados['email_pagseguro'] != "" && $dados['token_pagseguro'] != ""){
        $pA->adicionar("email_pagseguro", $dados['email_pagseguro'], "texto");
        $pA->adicionar("token_pagseguro", $dados['token_pagseguro'], "texto");
        }
        
        echo Yii::t("messageStrings", "message_result_gateway_update");
        return true;
    }
    
    /**
     *  
     * Saves the info as id, and secret
     * 
     * @param array $data
     * @return boolean
     *  
    **/
    public static function saveAppFacebookInfos($data){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        if($data['id_app'] != "" && $data['secret'] != ""){
        $pA->adicionar("id_app_fb", $data['id_app'], "texto");
        $pA->adicionar("secret_fb", $data['secret'], "texto");
        $pA->adicionar("id_page_fb", $data['id_page'], "texto");
        }
        
        echo Yii::t("messageStrings", "message_result_app_update");
        return true;

    }
    
    /**
     * Get a specific info from preferences attributes
     * 
     * @param string
     * @return string
     *  
    **/
    public static function setAttributes($attribute, $value, $type = 'texto'){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;
        
        $pA = new PreferencesAttribute();
        $pA->setCurrentUser($id_user);
        
        $add = $pA->adicionar($attribute, $value, $type);
        
        return $add;
    }
    
    /**
     * Get a specific info from preferences attributes
     * 
     * @param string
     * @return string
     *  
    **/
    public static function getAttributes($attribute, $type = "texto", $plataforma = 'desktop'){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != ""){$id_user = $session['miniSiteUser'];}else{$id_user = 0;}

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser($id_user);        
        
        $result = $pA->recuperar($attribute, $type, $plataforma);      
         
        return $result;
    }
    
    /**
     * Get a specific info from preferences attributes
     * 
     * @param string
     * @return string
     *  
    **/
    public static function getAttributesComplete($attribute, $modelo){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser($id_user);        
        
        $result = $pA->recuperarComplete($attribute, $modelo);      
         
        return $result;
    }

    
    /**
     * Get a specific info from preferences attributes
     * 
     * @param string
     * @return string
     *  
    **/
    public static function getDividerByClass($class){
        
        $result = array();
        
        switch($class){
            case "divider_dotted":
            case "divider_dashed":
            case "divider_ridge":
            case "divider_groove":
            case "divider_solid":
                $classSel = explode("_", $class);
                if(count($classSel) >= 2){
                    $result['type'] = "css";
                    $result['src'] = $classSel[1];
                }else{
                    $result['type'] = "";
                    $result['src'] = "";
                }
                break;
            default:
               
                $classSel = explode("_", $class);
    
                if(count($classSel) >= 2){
                    $result['type'] = "image";
                    $result['src'] = $classSel[1].".png"; 
                }else{
                    $result['type'] = "";
                    $result['src'] = "";
                }
                
        }
         
        return $result;
    }
    
    /**
     * Set specifics values for e-commerce and e-learn business
     * 
     * @param array
     * @return string
     *  
    **/
    public static function setEcommerceSettings($data, $plataforma = 'desktop'){
        $values = "valor_free = '" . $data['free'] ."', showcase = '" . $data['showcase'] ."', produtos_qtd = '" . $data['quantidade'] ."',".
                "envio = '" . $data['transporte'] ."', parcelamento = '" . $data['parcelamento'] ."', embrulho = '" . $data['embalagem'] ."'";
        $sql =  "UPDATE preferencias_data SET ". $values ." WHERE tipo = '" .$plataforma . "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    
    /**
     * Método obter as atividades recentes.
     * Este método é chamado por um timer e só exibe uma actividade por vez.
     * O Timer é de 10 segundos
     *
    */
    public static function getMessages($plataforma){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);        
        
        $query = " AND inteiro = 0";
        $result = $pA->recuperarAll("message", "descricao", $plataforma, $query);      
         
        return $result;
    }
    
    /**
     * Close avisos
     * 
     * @param array
     * @return string
     *  
    **/
    public static function closeAviso($id, $status = '1'){
        
        $values = "inteiro = '" . $status ."'";
        $sql =  "UPDATE preferencias_attribute SET ". $values ." WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Get all menut attributes, may be creating a new utils class for that?
     * 
     * @param string
     *  
    **/
    public static function getMenuAttributes($plataforma = 'desktop'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{
            $result['menu_exibe'] = PreferencesUtils::getPreferedItem('menu_exibe');
            $result['menu_total'] = PreferencesUtils::getAttributes('menu_total', "texto", $plataforma); 
            $result['menu_align'] = PreferencesUtils::getAttributes('menu_align', "texto", $plataforma);
            $result['menu_space'] = PreferencesUtils::getAttributes('menu_space', "texto", $plataforma);
            $result['menu_sombra_texto'] = PreferencesUtils::getAttributes('menu_sombra_texto', "texto", $plataforma);
            $result['menu_dividers'] = PreferencesUtils::getAttributes('menu_dividers', "texto", $plataforma);
            $result['menu_cor_divider'] = PreferencesUtils::getAttributes('menu_cor_divider', "texto", $plataforma);
            $result['menu_altura'] = PreferencesUtils::getAttributes('menu_altura', "texto", $plataforma);
            $result['menu_fonte'] = PreferencesUtils::getAttributes('menu_fonte', "texto", $plataforma);
            
            $result['menu_background_color'] = PreferencesUtils::getAttributes('menu_background_color', "texto", $plataforma);
            $result['menu_background_active'] = PreferencesUtils::getAttributes('menu_background_active', "texto", $plataforma);
            $result['margin_menu_pos_x'] = PreferencesUtils::getAttributes('margin_menu_pos_x', "inteiro", $plataforma);
            $result['menu_margin_baixo'] = PreferencesUtils::getAttributes('menu_margin_baixo', "inteiro", $plataforma);
            
            $result['menu_background_exibe'] = PreferencesUtils::getAttributes('menu_background_exibe', "inteiro", $plataforma);
            $result['menu_active_exibe'] = PreferencesUtils::getAttributes('menu_active_exibe', "inteiro", $plataforma); 
            
            $result['textura_background_full'] = PreferencesUtils::getAttributes('textura_background_full', "inteiro", $plataforma);
            
          
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Get all menut attributes, may be creating a new utils class for that?
     * 
     * @param string
     *  
    **/
    public static function getComboShare($plataforma = 'desktop', $tipo = 'combo_share'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{   
            if($tipo == 'combo_share'){
                $result['exibe'] = PreferencesUtils::getAttributes('exibe_combo_share', 'inteiro', $plataforma);
                $result['position'] = PreferencesUtils::getAttributes('combo_share_position', "texto", $plataforma); 
                $result['color'] = PreferencesUtils::getAttributes('combo_share_color', "texto", $plataforma);
                $result['p_y'] = PreferencesUtils::getAttributes('combo_share_position_py', "inteiro", $plataforma);
            }
            
            if($tipo == 'facebook'){
                $result['exibe'] = PreferencesUtils::getAttributes('exibe_facebook_likebox', 'inteiro', $plataforma);
                $result['position'] = PreferencesUtils::getAttributes('facebook_likebox_position', "texto", $plataforma); 
                $result['color'] = PreferencesUtils::getAttributes('facebook_likebox_color', "texto", $plataforma);
                $result['p_y'] = PreferencesUtils::getAttributes('facebook_likebox_position_py', "inteiro", $plataforma);
            }
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}
?>
