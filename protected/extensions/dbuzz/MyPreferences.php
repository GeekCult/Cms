<?php
/*
/*
 * This Class is used to set and retrieve some my preferences_data and attributes
 * @author CarlosGarcia
 * @date 27/11/2010
 *
 * Usage Notes
 *
 *
*/

class MyPreferences{

    /*
     * Método para recuperar as principais definições do usuário
     * Pega no bamco todas as definiçoes de topo, background, rodapes, layouts e
     * etc.
     *
     */
    public function getPreferences($id_page = 0, $id = 1, $plataforma = 'desktop'){ 
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.dbuzz.admin.CoolHtmlManager');
        Yii::import('application.extensions.dbuzz.DBManager');
        
        $session = MethodUtils::getSessionData();
        
        $coolHtmlManager = new CoolHtmlManager();
        $dbManager = new DBManager();
      
        $select = "topo, rodape, textura_site, textura_paginas, textura_sombras, textura_overlay, design_site, layout_site, layout_home, ".
                  "titulo_cor, texto_cor, link_cor, link_cor_hover, textura_menu, botao_cor, botao_cor_hover, textura_topo, textura_rodape, ".
                  "textura_botao, textura_vertical_block, textura_horizontal_block, logos, icons, flags, banner, menu_cor, menu_cor_hover, ".
                  "subtitulo_cor, status, classe_container, tipo_textura_paginas, tipo_textura_site, tipo_textura_topo, tipo_textura_rodape, ".
                  "tipo_textura_menu, tipo_textura_botao, tipo_textura_vertical_block1, tipo_textura_vertical_block2, tipo_textura_horizontal_block1, ".
                  "tipo_textura_horizontal_block2, cor_textura_site, cor_textura_paginas, metatags, descricao, titulo, google_analytics, classe_alerta, ".
                  "facebook, twitter, linkedin, google_mais_um, menu_exibe, embrulho, showcase, valor_free, produtos_qtd, envio, parcelamento, ".
                  "rodape_tipo, topo_tipo, textura_wallpaper";

        $st_sql= "SELECT ".$select." FROM preferencias_data WHERE id = $id";
   
        try{            
            $command = Yii::app()->db->createCommand($st_sql);
            $recordset = $command->queryRow();
            
            $recordset['logo'] = $this->getPreferencesAttributes("logo_site_string");
            $recordset['topo'] = $this->getElements("banners_data", $recordset['topo'], 'topo');
            $recordset['rodape'] = $this->getElements("banners_data", $recordset['rodape'], 'rodape');
            $recordset['main_banner'] = $this->getMainBanners($plataforma);
            $recordset['facebook_id'] = $this->getPreferencesAttributes("id_app_fb");
            $recordset['canal_youtube'] = $this->getPreferencesAttributes("canal_youtube");
            $recordset['pintrest'] = $this->getPreferencesAttributes("pinterest");
            $recordset['flickr'] = $this->getPreferencesAttributes("flickr");
            $recordset['skype'] = $this->getPreferencesAttributes("skype");
            $recordset['instagram'] = $this->getPreferencesAttributes("instagram");
           
            $recordset['rss'] = $this->getPreferencesAttributes("rss");
            $recordset['home'] = $this->getPreferencesAttributes("home");
            $recordset['telefone_contato'] = $this->getPreferencesAttributes("telefone_contato");
            $recordset['email_contato'] = $this->getPreferencesAttributes("email_contato");
            $recordset['email'] = $recordset['email_contato'];
            $recordset['google_plus'] = $recordset['google_mais_um'];
            $recordset['site_map'] = $this->getPreferencesAttributes("site_map");
            $recordset['vitrine_layout'] = $this->getPreferencesAttributes("vitrine_layout");
            $recordset['pagination'] = $this->getPreferencesAttributes("pagination");
            
            //Redes sociais
            $recordset['combo_share'] = PreferencesUtils::getComboShare('desktop', 'combo_share');
            $recordset['facebook_likebox'] = PreferencesUtils::getComboShare('desktop', 'facebook');
            
            //Menu rodapes
            $recordset['menu'] = $dbManager->getMenu();
            $recordset['menu3'] =  $dbManager->getMenu('desktop', 'menu_3');
            $recordset['menu2'] =  $dbManager->getMenu('desktop', 'menu_2');
            $recordset['menu2_categorias'] =  $coolHtmlManager->getMenu('mn');
            $recordset['menu2_theme'] = $this->getPreferencesAttributes("ft_txt_menu2");
            $recordset['menu_total'] = $this->getPreferencesAttributes("menu_total");
            $recordset['menu_align'] = $this->getPreferencesAttributes("menu_align");
            $recordset['menu_fonte'] = $this->getPreferencesAttributes("menu_fonte");
            
            $recordset['rodape_copyright'] = $this->getPreferencesAttributes("rodape_copyright", 'descricao');
            
            //Main banner
            $recordset['main_banner_altura'] = $this->getPreferencesAttributes("altura_main_banner", 'inteiro');
            $recordset['main_banner_distancia'] = $this->getPreferencesAttributes("distancia_main_banner", 'inteiro');
            
            $setFonts = $this->setFonts($id_page);
            //$setCss = $this->setCss();
            
            //Check if is need a livechat actions
            if(Yii::app()->params['livechat'] == '1') $recordset['livechat'] = $this->getConversation();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());   
            echo "ERROR: MyPreferences - getPreference() ".$e->getMessage();
            return $e->getMessage();
        }
    }
    
    /**
     * Método para obter os banners principais
     * Pega todos os banners que foram selecionados previamente
     *
    */
    public function getMainBanners($plataforma){
        
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $ccc = new CController('context');
        
        $select = "id, tipo, modelo, altura, largura, image, image_type, cool, titulo, descricao";        
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = 'html_mainbanners' AND plataforma = '$plataforma' AND exibe = 1 AND minisite = 0";

        try{            
            $command = Yii::app()->db->createCommand($sql);            
            $records['banners'] = $command->queryAll();
            $records['quantidade_banners'] = count($records['banners']);
            
            for($i = 0; $i < $records['quantidade_banners']; $i++){
                $records['banners'][$i]['cool2'] = BannersUtils::getBannersItems($records['banners'][$i]['id']);
                //Se for um render_partial pega os dados itemindex e também uma view pronta
                if($records['banners'][$i]['modelo'] == 'render_partial') {
                    $records['banners'][$i]['cool3'] = BannersUtils::getBannersItems($records['banners'][$i]['id'], false, true);
                }
            }
            
            $records['banners_random'] = BannersUtils::randomBanners($records['banners']);
            $records['isShadow'] = PreferencesUtils::getAttributes('banner_shadow', 'texto');
            
            return $records;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para obter as url dos topos, rodapes
     *
     * @param string table
     * @param number id
     *
    */
    public function getElements($table, $id, $type){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        switch($table){
            case "banners_data":                
                $select = "id, modelo, tipo, largura, altura, cor, cool, detalhes";
                $sql = "SELECT ".$select." FROM ".$table." WHERE id = $id";
                $command = Yii::app()->db->createCommand($sql);
                break;
        }        

        try{          
            $record = $command->queryRow();
            
            if($record){
                $record['cool2'] = BannersUtils::getBannersItems($record['id']);
                if($type == 'topo') {
                    Yii::import('application.extensions.utils.special.ToposUtils');
                    $record['attr'] = ToposUtils::getHeaderAttributes($record['cool']);
                }
                if($type == 'rodape'){
                    Yii::import('application.extensions.utils.special.RodapesUtils');
                    $record['attr'] = RodapesUtils::getFooterAttributes($record['cool']);
                }
            }
            return $record;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para obter os atributos das preferencia 
     *
     * @param string
     *
    */
    public function getPreferencesAttributes($attribute, $type = 'texto', $plataforma = 'desktop' ){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');        
        $result = PreferencesUtils::getAttributes($attribute, $type, $plataforma);
        return $result;
    }
    
    /**
     *
     * Desktop, Tablets, Mobile
     *
     * Método para pegar a conversa do chat, isso caso o usuário fique trocando de página durante
     * a visita
     *
     *
     */
    public function getConversation(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        $recordset = array();
        
        $recordset['settings']['live'] = PreferencesUtils::getPreferedItem('online_admin');
        
        //Gets settings attributes
        $recordset['settings']['moderador'] = $session['user'];
        
        if($recordset['settings']['moderador'] == '') $recordset['settings']['moderador'] = PreferencesUtils::getAttributes('moderador', 'texto');
       
        $recordset['settings']['chamada'] = PreferencesUtils::getAttributes('chamada_lc', 'texto');
        $recordset['settings']['message1'] = PreferencesUtils::getAttributes('welcome1', 'descricao');
        $recordset['settings']['message2'] = PreferencesUtils::getAttributes('welcome2', 'descricao');
        $recordset['settings']['message3'] = PreferencesUtils::getAttributes('welcome3', 'descricao');
        $recordset['settings']['cor'] = PreferencesUtils::getAttributes('cor_lc', 'texto');
        
        //Initial values
        if($session['livechatLaunch'] == '') $session['livechatLaunch'] = 1;
        if($session['livechatLaunchMessage'] == '') $session['livechatLaunchMessage'] = 1;
        
        if($session['livechat'] != ''){            

            $select = "id, nome, id_user, tipo, message, date";
            $sql = "SELECT ".$select." FROM inhamer_messages WHERE id_user = ". $session['livechat'] . "";

            try{
                $command = Yii::app()->db->createCommand($sql);           
                $recordset['conversation'] = $command->queryAll(); 
              
                if($recordset['conversation']){
                    $setSession = MethodUtils::setSessionData('livechatLaunch', true);
                }

            }catch(CDbException $e){
                Yii::trace("ERROR ".$e->getMessage());
                echo "ERROR ".$e->getMessage();
            }
        }
        
        //Checks if it needs launching
        $recordset['settings']['livechatLaunch'] = $session['livechatLaunch'];
        $recordset['settings']['livechatLaunchMessage'] = $session['livechatLaunchMessage'];
        
        return $recordset;
    }
    
    /**
     * Método para definir as fontes que devem ser inseridas no sistema 
     * TODO: COLOCAR essa chamada em um arquico de settings para evitar esse request ao DB
     * 
     * //<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
     * //<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
     *
     * @param string
     *
    */
    public function setFonts($id_page){

        $sql = "SELECT descricao FROM activity_server WHERE tipo = 'fonte' AND page_id = $id_page GROUP BY descricao";
        if($id_page == 'admin') $sql = "SELECT descricao FROM activity_server WHERE tipo = 'fonte' GROUP BY descricao";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll(); 

            if($recordset){
                
                $cs = Yii::app()->getClientScript();
                
                foreach($recordset as $values){
                    $cs->registerCssFile('http://fonts.googleapis.com/css?family=' . $values['descricao'], 'screen', CClientScript::POS_BEGIN);
                }
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para definir as fontes que devem ser inseridas no sistema 
     * TODO: COLOCAR essa chamada em um arquico de settings para evitar esse request ao DB
     *
     * @param string
     *
    */
    public function setCss(){

        $sql = "SELECT descricao FROM activity_server WHERE tipo = 'css' GROUP BY descricao";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll(); 

            if($recordset){
                
                $cs = Yii::app()->getClientScript();
                
                foreach($recordset as $values){
                    $cs->registerCssFile($values['descricao'], 'screen', CClientScript::POS_BEGIN);
                }
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
}
?>