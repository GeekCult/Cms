<?php

/**
 * Description of JsonSiteUtils
 *
 * Pre response to avoid data base connection, it's an actio to enhance the performance
 *
 * @author CarlosGarcia
 * 
 */
class JsonSiteUtils {


    /**
     * Método para pegar as propriedades do tipo de matéria
     *
     * @param string
     *
    */
    public static function updateDominioData(){
       
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager'); 
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.DBManager');

        $pA = new PreferencesAttribute();               
        $pageHandler = new PaginasManager();
       
        $preferencesManager = new MyPreferences();
        $dbManager = new DBManager();
            
        try{
            $result['id_app'] = PreferencesUtils::getAttributes("id_app_fb", "texto");
            $result['site_data'] = HelperUtils::getTitleSite();
            $result['paginas'] = $pageHandler->getPagesInfoForJson();
     
            $result['menu_principal'] = $dbManager->getMenu();
            if(Yii::app()->params['load_menu_3']) $result['menu_responsivo'] = $manager->getMenu('desktop', 'menu_responsivo');

            $result['site_settings'] = $preferencesManager->getPreferences(0, 1, 'desktop');

            //*******************//
     
            $nome = "dominio_data";
            $cria = fopen("media/user/files/$nome.json", "w+");

            $dados = json_encode($result);

            if(!file_exists("$nome.json")){        
               $escreve = fwrite($cria, utf8_encode("$dados"));
            }

            fclose($cria);
            
            return true;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: JsonSiteUitls - updateDominioData() ' . $e->getMessage();
        }
    }
    
    /**
     * Metodo para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed.
     *
    */
    public static function updateCSS(){
        
        Yii::import('application.extensions.utils.special.ThemesUtils');
        Yii::import('application.extensions.utils.admin.TexturasUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        Yii::import('application.extensions.dbuzz.admin.special.MiniSitesManager');
   
       $minisitesManager = new MiniSitesManager();
        
        try {
            
            $session = MethodUtils::getSessionData();
            $device = MethodUtils::getDeviceType();

            $select  = "botao_cor, botao_cor_hover, textura_botao, titulo_cor, subtitulo_cor, menu_cor, menu_cor_hover, textura_menu, textura_site, tipo_textura_site, ";
            $select .= "link_cor, link_cor_hover, texto_cor, flags, icons, cor_textura_site, textura_paginas, tipo_textura_paginas, cor_textura_paginas, ";
            $select .= "textura_overlay, textura_sombras, textura_rodape, tipo_textura_rodape, textura_topo, tipo_textura_topo, ";
            $select .= "textura_vertical_block, textura_horizontal_block, textura_textos, input_text_cor, classe_alerta";
            $sql = "SELECT {$select} FROM preferencias_data WHERE id_user = " . $session['miniSiteUser'];

            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();     

            //Initial variable
            $varURL= ""; 

            //Montando os site e as páginas internas
            if($recordset['textura_site'] != ''){
            $varURL.= "body, .background_ipad";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/site/";
            $varURL.= $recordset['textura_site'] .");";
            $varURL.= "background-color: " . $recordset['cor_textura_site'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_site']) .";";
            if($recordset['tipo_textura_site'] == 5) $varURL.= "background-attachment:fixed!important;";
            $varURL.= "}";
            }

            if($recordset['textura_paginas'] != ''){
            $varURL.= ".pan";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/paginas/";
            $varURL.= $recordset['textura_paginas'] .");";
            if($recordset['cor_textura_paginas'] != '')$varURL.= "background-color: " . $recordset['cor_textura_paginas'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_paginas']) .";";
            $varURL.= "}";

            $varURL.= ".pan_top, .pan_footer";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/paginas/";
            $varURL.= $recordset['textura_paginas'] .");";
            $varURL.= "}";
            }

            //Montando os botões 
            $varURL.= ".botao, .botao_small";
            $varURL.= "{ color: #";
            $varURL.= $recordset['botao_cor'] .";";
            $varURL.= "}";

            $varURL.= ".botao:hover, .botao_small:hover";
            $varURL.= "{ color: #";
            $varURL.= $recordset['botao_cor_hover'] .";";
            $varURL.= "}";

            $varURL.= ".botao";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/botao/";
            $varURL.= $recordset['textura_botao'] .");";
            $varURL.= "}";

            $varURL.= "h1, .titulo";
            $varURL.= "{ color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";

            //Montando os textos        
            $varURL.= "h1 ";
            $varURL.= "{";
            $varURL.= MIniSitesUtils::getSpecialAttributes("h1", $recordset['flags']);
            $varURL.= "}";

            $varURL.= "h2, h3, h4, h5, h6, .subtitulo";
            $varURL.= "{ color: #";
            $varURL.= $recordset['subtitulo_cor'] .";";
            $varURL.= "}";

            $varURL.= "span, td, th, p, .texto";
            $varURL.= "{ color: #";
            $varURL.= $recordset['texto_cor'] .";";
            $varURL.= "}";

            $varURL.= ".topic";
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/detalhes/icons/";
            $varURL.= $recordset['icons'] .") no-repeat 0px 10px;";
            $varURL.= MIniSitesUtils::getSpecialAttributes("topic", $recordset['icons']);
            $varURL.= "}";

            //Montando link
            $varURL.= "a, li a ";
            $varURL.= "{ color: #";
            $varURL.= $recordset['link_cor'] .";";
            $varURL.= "}";

            $varURL.= "a:hover";
            $varURL.= "{ color: #";
            $varURL.= $recordset['link_cor_hover'] .";";
            $varURL.= "}";
            
            //Montando o logo
            $varLogoPosX = PreferencesUtils::getAttributes("logo_pos_x", 'inteiro');
            $varLogoPosY = PreferencesUtils::getAttributes("logo_pos_y", 'inteiro');
            
            $varLogoAlt = PreferencesUtils::getAttributes("logo_altura", 'inteiro');
            $varLogoLar = PreferencesUtils::getAttributes("logo_largura", 'inteiro');
             
            if($varLogoPosY != ''){ $varURL.= ".logo"; $varURL.= "{top: ". $varLogoPosY."px;}";}
            if($varLogoPosX != ''){ $varURL.= ".logo"; $varURL.= "{left: ". $varLogoPosX."px;}";}
            
            if($varLogoAlt != '' && $varLogoLar){ $varURL.= ".logo_site {background-size: ". $varLogoAlt."px ". $varLogoLar."px !important;}";}

            //Montando o menu
            $varURL.= "#menu, #menu-wrap, #menuGroup li ul";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/menu/";
            $varURL.= $recordset['textura_menu'] .");";
            $varURL.= "}";

            $varURL.= ".menu a, #menuGroup a";
            $varURL.= "{ color: #";
            $varURL.= $recordset['menu_cor'] .";";
            $varURL.= "}";

            $varURL.= ".menu a:hover, #menuGroup li:hover > a";
            $varURL.= "{ color: #";
            $varURL.= $recordset['menu_cor_hover'] .";";
            $varURL.= "}";

            $varMTL = PreferencesUtils::getAttributes("menu_total");
            if($varMTL == 'true'){
                $varURL.= "#menu, #menu-wrap";
                $varURL.= "{ width: 100%}";
            }else{
                $varURL.= "#menu, #menu-wrap";
                $varURL.= "{ width: 980px; left: 50%; margin-left: -490px}";
            }

            $varMTL2 = PreferencesUtils::getAttributes("menu_align");
            if($varMTL2 == 'center'){
                $varURL.= "#menuGroup";
                $varURL.= "{ display: table; left: auto; right: auto;  margin: 0 auto;}";
            }
            if($varMTL2 == 'right'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: none; margin-left: 0px; right: 0%; position: absolute;}";            
            }
            if($varMTL2 == 'left'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: 0%; margin-left: 0px; right: none; position: absolute;}";
            }
            
            if($varMTL2 == 'center_left'){
                $varURL.= "#menu-content-wrap { width: 980px; left: 50%; margin-left: -490px; left: 50%; position: absolute;}";
                $varURL.= "#menuGroup { width: auto; left: 0%; margin-left: 0px; right: none; position: absolute;}";
            }
            
            if($varMTL2 == 'center_right'){
                $varURL.= "#menu-content-wrap { width: 980px; left: 50%; margin-left: -490px; left: 50%; position: absolute;}";
                $varURL.= "#menuGroup { width: auto; left: none; margin-left: 0px; right: 0; position: absolute;}";
            }
            
            $varMTS = PreferencesUtils::getAttributes("menu_space");
            $varURL.= "#menuGroup a";
            $varURL.= "{padding: 8px " . $varMTS ."px;}"; 
            
            $varMnAlt = PreferencesUtils::getAttributes("menu_altura");
            if($varMnAlt != ''){
                $varURL.= "#menuGroup, #menu-wrap";
                $varURL.= "{height: " . $varMnAlt ."px;}";
            }
            
            $varMDC = PreferencesUtils::getAttributes("menu_cor_divider");
            $varMDV = PreferencesUtils::getAttributes("menu_dividers");
             
            if($varMDV == 'true'){
                $varURL.= "#menuGroup li";
                $varURL.= "{border-right: 1px solid $varMDC; box-shadow: 1px 0 0 #444444; -moz-box-shadow: 1px 0 0 #444; -webkit-box-shadow: 1px 0 0 #444;}";
            }else{
                $varURL.= "#menuGroup li";
                $varURL.= "{border-right: none; box-shadow: none}";
            }

            $varMTXT = PreferencesUtils::getAttributes("menu_sombra_texto");
            if($varMTXT == 'true'){
                $varURL.= "#menuGroup a";
                $varURL.= "{text-shadow: 0 1px 0 #000;}";
            }else{
                $varURL.= "#menuGroup a";
                $varURL.= "{text-shadow: none}";
            }
            
            $varMACTC = PreferencesUtils::getAttributes("menu_background_active");
            if($varMACTC != ''){
                $varURL.= "#menuGroup li.active a";
                $varURL.= "{background: #$varMACTC!important;}";
            }
            
            $varMBGC = PreferencesUtils::getAttributes("menu_background_color");
            if($varMBGC != ''){
                $varURL.= "#menuGroup li a";
                $varURL.= "{background: #$varMBGC;}";
            }
            
            $varMPOSx = PreferencesUtils::getAttributes("margin_menu_pos_x", 'inteiro');
            if($varMPOSx != ''){
                $varURL.= "#menuGroup ";
                $varURL.= "{left: ".$varMPOSx ."px!important; position: absolute;}";
            }

            //Logos - Site
            $varLg = PreferencesUtils::getAttributes("logo_site");
            if($varLg != '') $imageLogo = GraphicsUtils::getCoolContent($varLg);

            //Montando os detalhes do site
            if($recordset['textura_overlay'] != ''){
            $varURL.= ".overlay";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/overlay/";
            $varURL.= $recordset['textura_overlay'] .");";
            $varURL.= "}";
            }

            if($recordset['textura_sombras'] != ''){
            $varURL.= ".shadow";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/sombras/";
            $varURL.= $recordset['textura_sombras'] .");";
            $varURL.= "}";
            }

            //Montando os topos e rodapes
            $varURL.= ".footermainPan";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/rodape/";
            $varURL.= $recordset['textura_rodape'] .");";
            if($recordset['tipo_textura_rodape'] != '') $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_rodape']) .";";
            $varURL.= "}";
            
            //Montando o logo
            $varTopoAlt = PreferencesUtils::getAttributes("topo_altura", 'inteiro');
            if($varTopoAlt != ''){ $varURL.= ".headerPan"; $varURL.= "{height: ". $varTopoAlt."px;}";}

            if($recordset['textura_topo'] != ''){
            $varURL.= ".headermainPan";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/topo/";
            $varURL.= $recordset['textura_topo'] .");";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_topo']) .";";
            $varURL.= "}"; 
            }
            
            $varFTMn = PreferencesUtils::getAttributes("ft_menu");
            if($varFTMn != ''){
                $varURL.= ".ftMenu ";
                $varURL.= "{background: url(//www.purplepier.com.br/media/images/textures/rodape/" . $varFTMn .")  repeat-x;}";
            }
            
            $varFTLn2 = PreferencesUtils::getAttributes("ft_line2");
            if($varFTLn2 != ''){
                $varURL.= ".ftLine2 ";
                $varURL.= "{background: url(//www.purplepier.com.br/media/images/textures/site/" . $varFTLn2 .")  repeat;}";
            }
            
            $varFTTxtLn2 = PreferencesUtils::getAttributes("ft_txt_line2");
            if($varFTTxtLn2 != ''){
                $varURL.= ".ftLine2, .ftLine2 p, .ftLine2 a, .ftLine2 span ";
                $varURL.= "{color: #" . $varFTTxtLn2 ." !important;}";
            }
            
            $varFTTxtMn1 = PreferencesUtils::getAttributes("ft_txt_menu1");
            if($varFTTxtMn1 != ''){
                $varURL.= ".ftMenu .ftMn1, .ftMenu .ftMn1 .p, .ftMenu .ftMn1 a, .ftMenu .ftMn1 span ";
                $varURL.= "{color: #" . $varFTTxtMn1 ." !important;}";
            }
            
            $varFTTxtMn2Es = PreferencesUtils::getAttributes("ft_menu2_espacamento", 'inteiro');
            if($varFTTxtMn2Es != ''){
                $varURL.= ".container_link_mn_cols4 ";
                $varURL.= "{margin-bottom: " . $varFTTxtMn2Es ."px !important;}";
            }
            
            $varFTFbBg = PreferencesUtils::getAttributes("ft_fb_bg");
            if($varFTFbBg != ''){
                $varURL.= ".ftFbBg ";
                $varURL.= "{background: url(//www.purplepier.com.br/media/images/textures/site/" . $varFTFbBg .")  repeat-x;}";
            }
            
            $varFTLnCn = PreferencesUtils::getAttributes("ft_ln_company_bg");
            if($varFTLnCn != ''){
                $varURL.= ".ftLineCompany ";
                $varURL.= "{background: url(//www.purplepier.com.br/media/images/textures/site/" . $varFTLnCn .")  repeat;}";
            }
            
            $varFTTxtComp = PreferencesUtils::getAttributes("ft_txt_line_company");
            if($varFTTxtComp != ''){
                $varURL.= ".ftLineCompany, .ftLineCompany .p, .ftLineCompany a, .ftLineCompany span ";
                $varURL.= "{color: #" . $varFTTxtComp ." !important;}";
            }
            
            //Montando blocks
            $varURL.= ".vertical_block";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/";
            $varURL.= $recordset['textura_vertical_block'] .");";
            $varURL.= "}";

            $varURL.= ".horizontal_block";
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/textures/";
            $varURL.= $recordset['textura_horizontal_block'] .");";
            $varURL.= "}";

            //Montando alertas
            $varAlr = TexturasUtils::getAttributesByClass($recordset['classe_alerta']);
            if(isset($varAlr['background_color']) && isset($varAlr['border_color']) && isset($varAlr['font_color'])){
                $varURL.= ".flash_notice";
                $varURL.= "{ background: " . $varAlr['background_color'].";";
                $varURL.= " boder-color: " . $varAlr['border_color'].";";
                $varURL.= "}";

                $varURL.= "#flash_notice_text span";
                $varURL.= "{ color: " . $varAlr['font_color'].";}";
            }

            if(isset($varTxt['left'] )){
            $varTxt = TexturasUtils::getTextureInputs($recordset['textura_textos']);
            $varURL.= ".container_inputs_corner_left";        
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/layout/input_text/";
            $varURL.=  $varTxt['left'] .");";
            $varURL.= "}";
            }
            
            if(isset($varTxt['middle'])){
            $varURL.= ".container_inputs_middle";        
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/layout/input_text/";
            $varURL.=  $varTxt['middle'] .");";
            $varURL.=  "color:#". $recordset['input_text_cor'] .";";
            $varURL.= "}";
            }
            
            if(isset($varTxt['right'])){
            $varURL.= ".container_inputs_corner_right";        
            $varURL.= "{ background-image: url(//www.purplepier.com.br/media/images/layout/input_text/";
            $varURL.=  $varTxt['right'] .");";
            $varURL.= "}";
            }

            $varBTL = PreferencesUtils::getAttributes("bt_logar_owner");
            if($varBTL == "") $varBTL = "bt_logar_default.png";
            $varURL.= ".button_logar_owner";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/buttons/";
            $varURL.=  $varBTL . ") no-repeat;";
            $varURL.= "}"; 

            $varBMore = PreferencesUtils::getAttributes("more");
            if($varBMore != "empty.png"){
            $varURL.= ".link_more";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/detalhes/more/";
            $varURL.=  $varBMore . ") no-repeat; padding: 5px 0px 5px 30px;";
            $varURL.= "}";
            }

            $varTitlePopup = PreferencesUtils::getAttributes("title_popup");
            if($varTitlePopup != ""){
            $varURL.= ".title_popup";        
            $varURL.= "{ color: #";
            $varURL.= $varTitlePopup .";";
            $varURL.= "}";
            }

            $varTextPopup = PreferencesUtils::getAttributes("text_popup");
            if($varTextPopup != ""){
            $varURL.= ".text_popup";        
            $varURL.= "{ color: #";
            $varURL.= $varTextPopup .";";
            $varURL.= "}";
            }

            //Font size
            $varTitleSize = PreferencesUtils::getAttributes("title_size");
            if($varTitleSize != ""){
            $varURL.= "h1";        
            $varURL.= "{ font-size: ";
            $varURL.= $varTitleSize ."pt!important;";
            $varURL.= "}";
            }
            
            $varTextSize = PreferencesUtils::getAttributes("text_size");
            if($varTextSize != ""){
            $varURL.= "p";        
            $varURL.= "{ font-size: ";
            $varURL.= $varTextSize ."pt!important;";
            $varURL.= "}";
            }
            
            $varTextLineHeight = PreferencesUtils::getAttributes("text_line_height");
            if($varTextLineHeight != ""){
            $varURL.= "p";        
            $varURL.= "{ line-height: ";
            $varURL.= $varTextLineHeight ."px!important;";
            $varURL.= "}";
            }
            
            $varTextAlign = PreferencesUtils::getAttributes("text_alignment");
            if($varTextAlign != ""){
            $varURL.= "p";        
            $varURL.= "{ text-align: ";
            $varURL.= $varTextAlign ."!important;";
            $varURL.= "}";
            }
            
            //Buttons
            $varSideButton = PreferencesUtils::getAttributes("side_button", 'texto', $session['device']);
            if($varSideButton != ""){
            $varURL.= ".bn_button_left ";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/detalhes/side_button/images/left_" . $varSideButton . ") no-repeat;}";
            $varURL.= ".bn_button_right ";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/detalhes/side_button/images/right_" . $varSideButton . ") no-repeat;}";
            }
          
            $varFrm = PreferencesUtils::getAttributes("frame_vitrine");
            if($varFrm == "") $varFrm = "frame_white_semirounded_200x300.png";
            $varURL.= ".produtos_item_vitrine";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/frames/small/";
            $varURL.=  $varFrm . ") no-repeat;";
            $varURL.= "}";
            $varURL.= ".produtos_item_vitrine_full";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/frames/full/";
            $varURL.=  $varFrm . ") no-repeat;";
            $varURL.= "}";

            $varShpC = PreferencesUtils::getAttributes("bt_shopcart");
            if($varShpC == "") $varShpC = "cart_white_dark_3.png";
            $varURL.= ".botao_carrinho";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/textures/botao/";
            $varURL.=  $varShpC . ") no-repeat;";
            $varURL.= "}";
   
            $varDivider = PreferencesUtils::getAttributes("dividers");
            $varDividerT = PreferencesUtils::getDividerByClass($varDivider);
            $varEDivider = PreferencesUtils::getAttributes("divider_espessura");
            $varCDivider = PreferencesUtils::getAttributes("divider_color");
            $varURL.= ".divider_horizontal, .titleContent";
            
            if($varDividerT != ''){
            if(isset($varDividerT['type']) && $varDividerT['type'] == "css"){
            if($varDividerT['src'] != "empty")$varURL.= "{ border-bottom:". $varEDivider ." ". $varDividerT['src']  ." ". $varCDivider ."}";
            }else{
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/dividers/";
            $varURL.=  $varDividerT['src'] . ") repeat-x; height: 7px;";
            $varURL.= "}";
            } 
            }
  
            $varDividerV = PreferencesUtils::getAttributes("dividers_vertical");
            if($varDividerV){
                $varDividerVT = PreferencesUtils::getDividerByClass($varDividerV);
                $varEDividerV = PreferencesUtils::getAttributes("divider_vertical_espessura");
                $varCDividerV = PreferencesUtils::getAttributes("divider_vertical_color");
                $varURL.= ".divider_vertical, .ctnDividerVertical";
                if(isset($varDividerVT['type']) && $varDividerVT['type'] == "css"){
                if(isset($varDividerVT['src']) &&$varDividerVT['src'] != "empty")$varURL.= "{ border-right:". $varEDividerV ." ". $varDividerVT['src']  ." ". $varCDividerV ."}";
                }else{
                $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/dividers/";
                $varURL.=  $varDividerVT['src'] . ") repeat-y; width: 1px;";
                $varURL.= "}";
                }
            }

            $varMnStore = PreferencesUtils::getAttributes("menu_loja");
            $attrStore = ThemesUtils::getThemeAttributes($varMnStore);
            $varURL.= ".main_menu_store_middle";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/boundbox/menu_lateral/";
            $varURL.=  $attrStore['background-middle'] . ") repeat-y;";
            $varURL.=  "color: ".$attrStore['color'] . ";";
            $varURL.= "}";
            $varURL.= ".main_menu_store_middle a";        
            $varURL.=  "{color: ".$attrStore['color'] . ";}";
            $varURL.= ".titulo_menu_ecommerce, .menu_item_ecommerce";        
            $varURL.=  "{border-bottom-color: ".$attrStore['divider'] . ";}";
            $varURL.= ".subcat_items a, .subcat_items input[type='button']";        
            $varURL.=  "{color: ".$attrStore['subitem-color'] . "!important;}";

            $varURL.= ".main_menu_store_top";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/boundbox/menu_lateral/";
            $varURL.=  $attrStore['background-top'] . ") no-repeat;";
            $varURL.= "}";
            $varURL.= ".main_menu_store_bottom";        
            $varURL.= "{ background: url(//www.purplepier.com.br/media/images/layout/boundbox/menu_lateral/";
            $varURL.=  $attrStore['background-bottom'] . ") no-repeat;";
            $varURL.= "}";
            
            $bn_distancia = PreferencesUtils::getAttributes("distancia_main_banner", 'inteiro');
            if($bn_distancia != '') $varURL.= "#banner_main {margin-top:" . $bn_distancia ."px!important; }";
            
            //*******************//

            $nome = "minisite_main";
            if($session['device'] != "desktop" && $session['device'] != "") $nome = $session['device'];
            $cria = fopen("media/user/css/".$nome . ".css", "w+");

            $dados = $varURL;

            if(!file_exists($nome . ".css")){        
               $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
            }

            fclose($cria);
            
            
            if($session['miniSiteRemote']) $upload = $minisitesManager->uploadFile($nome . ".css", 'css', 'httpdocs/css');
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: MiniSitesUtils - updateCSS() ' . $e->getMessage();
        }

    }
    
    
    
    /*
     * Return the correct string type type
     * 
     * @param number
     * 
     */
    public static function getSpecialAttributes($type, $verify){

        $result = "";
        
        switch ($type){            
            case "h1":
                if($verify != "" || $verify != "empty.png"){
                    $result .= "background: url(//www.purplepier.com.br/media/images/detalhes/flags/" . $verify .") no-repeat 0px 0px;";
                    $result .= "padding:5px 0 5px 40px;";
                }
                break;
            case "topic":
                if($verify != "" || $verify != "empty.png"){
                $result = "padding: 4px 0 0 25px;";
                }
                break;
        }       
        return $result;
    }

}
?>
