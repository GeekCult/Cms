<?php
/*
 * This Class is used to deal with CSS files
 *
 * @author CarlosGarcia
 *
 * Date: 13/05/2008
 *
 */

class CssManager{

    /**
     * Metodo para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed.
     *
    */
    public function updateCSS(){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.special.ThemesUtils');
        Yii::import('application.extensions.utils.admin.TexturasUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');        
        
        try {
            
            $device = MethodUtils::getDeviceType();

            $select  = "botao_cor, botao_cor_hover, textura_botao, titulo_cor, subtitulo_cor, menu_cor, menu_cor_hover, textura_menu, textura_site, tipo_textura_site, ";
            $select .= "link_cor, link_cor_hover, texto_cor, flags, icons, cor_textura_site, textura_paginas, tipo_textura_paginas, cor_textura_paginas, ";
            $select .= "textura_overlay, textura_sombras, textura_rodape, tipo_textura_rodape, textura_topo, tipo_textura_topo, textura_wallpaper, textura_efeitos, ";
            $select .= "textura_vertical_block, textura_horizontal_block, textura_textos, input_text_cor, classe_alerta";
            $sql = "SELECT ".$select." FROM preferencias_data WHERE tipo = '$device'";

            $session = MethodUtils::getSessionData();
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();     

            //Initial variable
            $varURL= ""; 
            
            //Montando os site e as páginas internas
            //Site
            $typeSite = PreferencesUtils::getAttributes("site_texture_type");
            if($recordset['textura_site'] != ''){
            $varURL.= "body, .background_ipad";
            if($typeSite == '')     $varURL.= "{ background-image: url(/media/images/textures/site/";
            if($typeSite == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_site'] .");";
            $varURL.= "background-color: " . $recordset['cor_textura_site'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_site']) .";";
            if($recordset['tipo_textura_site'] == 5) $varURL.= "background-attachment:fixed!important;";
            if($recordset['tipo_textura_site'] == 2){ $varURL.= "background-position: top center;";}
            $varURL.= "}";
            }
            
            //Páginas
            $typePages = PreferencesUtils::getAttributes("paginas_texture_type");
            if($recordset['textura_paginas'] != ''){
            $varURL.= ".pan";
            if($typePages == '')     $varURL.= "{ background-image: url(/media/images/textures/paginas/";
            if($typePages == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_paginas'] .");";
            $varURL.= "background-color: " . $recordset['cor_textura_paginas'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_paginas']) .";";
            $varURL.= "}";

            $varURL.= ".pan_top, .pan_footer";
            $varURL.= "{ background-image: url(/media/images/textures/paginas/";
            $varURL.= $recordset['textura_paginas'] .");";
            $varURL.= "}";
            }

            //Montando os botões 
            $typeButton = PreferencesUtils::getAttributes("botao_texture_type");
            $typeButtonSpecial = PreferencesUtils::getAttributes("button_type_special", 'inteiro');
            
            if(!$typeButtonSpecial){
                $varURL.= ".botao, .botao_small";
                $varURL.= "{ color: #";
                $varURL.= $recordset['botao_cor'] .";";
                $varURL.= "}";

                $varURL.= ".botao:hover, .botao_small:hover";
                $varURL.= "{ color: #";
                $varURL.= $recordset['botao_cor_hover'] .";";
                $varURL.= "}";

                $varURL.= ".botao";
                if($typeButton == '') $varURL.= "{ background-image: url(/media/images/textures/botao/";
                if($typeButton == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
                $varURL.= $recordset['textura_botao'] .");";
                $varURL.= "min-width: 122px!important;";
                $varURL.= "}";
            
            }else{ 
                //Main
                $MainButtonSpecial = PreferencesUtils::getAttributes("button_main_special");
                $SuccessButtonSpecial = PreferencesUtils::getAttributes("button_success_special");
                $SecondButtonSpecial = PreferencesUtils::getAttributes("button_second_special");
                $tt_button = TexturasUtils::getCSSProperties($MainButtonSpecial);
                $varURL.= ".botao";
                $varURL.= "{ *display: inline; *zoom: 1;padding: 4px 12px;margin-bottom: 0; min-width: 100px; font-size: 14px; line-height: 30px; text-align: center; vertical-align: middle; cursor: pointer; /*text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); */  background-repeat: repeat-x;*border: 0;  -webkit-border-radius: 4px; -moz-border-radius: 4px;  border-radius: 4px;  *margin-left: .3em;  -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);  -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);  box-shadow: inset 0 1px 0 rgba(255,255,255,.2), 0 1px 2px rgba(0,0,0,.05);}";           
                $varURL.= ".btn-main {";
                if(isset($tt_button['common']))$varURL.= $tt_button['common'];
                $varURL.= "}";
                $varURL.= ".btn-main:hover {"; 
                if(isset($tt_button['hover'])) $varURL.= $tt_button['hover'];
                $varURL.= "}";
                
                if($SuccessButtonSpecial != ""){
                    $tt_button = TexturasUtils::getCSSProperties($SuccessButtonSpecial);
                    $varURL.= ".btn-success {";
                    if(isset($tt_button['common'])) $varURL.= $tt_button['common'];
                    $varURL.= "}";
                    $varURL.= ".btn-success:hover {"; 
                    if(isset($tt_button['hover'])) $varURL.= $tt_button['hover'];
                    $varURL.= "}";
                }
                
                if($SecondButtonSpecial != ""){
                    $tt_button = TexturasUtils::getCSSProperties($SecondButtonSpecial);
                    $varURL.= ".btn-second {";
                    if(isset($tt_button['common'])) $varURL.= $tt_button['common'];
                    $varURL.= "}";
                    $varURL.= ".btn-second:hover {"; 
                    if(isset($tt_button['hover'])) $varURL.= $tt_button['hover'];
                    $varURL.= "}";
                }
            }
            
            
            //Montando fontes
            $varURL.= "h1, .titulo, .main-color";
            $varURL.= "{ color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $chamada_cor = PreferencesUtils::getAttributes("chamada_cor");
            if($chamada_cor != ""){
            $varURL.= ".standart-h2title span";
            $varURL.= "{ color: #";
            $varURL.= $chamada_cor .";";
            $varURL.= "}";
            }
            
            $varURL.= ".main-bg-color, .jspDrag";
            $varURL.= "{ background-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".line2 span:before";
            $varURL.= "{ border-top-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".line2, .line2 span";
            $varURL.= "{ border-bottom-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".border-left-color";
            $varURL.= "{ border-left-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            

            //Montando os textos        
            $varURL.= "h1 ";
            $varURL.= "{";
            $varURL.= $this->getSpecialAttributes("h1", $recordset['flags']);
            $varURL.= "}";

            $varURL.= "h2, h3, h4, h5, h6, .subtitulo";
            $varURL.= "{ color: #";
            $varURL.= $recordset['subtitulo_cor'] .";";
            $varURL.= "}";

            $varURL.= "span, td, th, p, .texto, label";
            $varURL.= "{ color: #";
            $varURL.= $recordset['texto_cor'] .";";
            $varURL.= "}";

            $varURL.= ".topic, topic";
            $varURL.= "{ background: url(/media/images/detalhes/icons/";
            $varURL.= $recordset['icons'] .") no-repeat 0px 3px;";
            $varURL.= $this->getSpecialAttributes("topic", $recordset['icons']);
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
            
            $varLogoCtnAlt = PreferencesUtils::getAttributes("logo_container_height", 'inteiro');
            $varLogoCtnLar = PreferencesUtils::getAttributes("logo_container_width", 'inteiro');
            
            if($varLogoAlt != '' && $varLogoAlt != 0){ $varURL.= ".logo_site img, .brand img {height: ". $varLogoAlt."px !important;}";}
            if($varLogoLar != '' && $varLogoLar != 0){ $varURL.= ".logo_site img, .brand img {width: ". $varLogoLar."px!important;}";}
             
            if($varLogoPosY != '' && $varLogoPosY != 0){ $varURL.= ".logo, .brand"; $varURL.= "{top: ". $varLogoPosY."px;}";}
            if($varLogoPosX != '' && $varLogoPosX != 0){ $varURL.= ".logo, .brand"; $varURL.= "{left: ". $varLogoPosX."px;}";}           
            
            
            //if($varLogoCtnAlt != 0) $varURL.= ".logo_site {height: {$varLogoCtnAlt}px!important;}";
            //if($varLogoCtnLar != 0) $varURL.= ".logo_site {width: {$varLogoCtnLar}px!important;}";
            
            
            //Montando o menu
            $typeMenu = PreferencesUtils::getAttributes("menu_texture_type");
            
            $txtmenuFull = PreferencesUtils::getAttributes("textura_background_full", 'inteiro');
            $varURL.= "#menu, #menu-wrap, #menu-wrap2, #menuGroup li ul, #sticky_navigation .menu_wrap_mb_bg, .menu_wrap_mb_bg";
            if($typeMenu == '')     $varURL.= "{ background-image: url(/media/images/textures/menu/";
            if($typeMenu == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_menu'] .");";
            if($txtmenuFull) $varURL.= "background-size: 100% 100%;";
            $varURL.= "}";

            $varURL.= ".menu a, #menuGroup a, #menuTexture a, .menu li a > span";
            $varURL.= "{ color: #";
            $varURL.= $recordset['menu_cor'] .";";
            $varURL.= "}";

            $varURL.= ".menu a:hover, #menuGroup li:hover > a, #menuTexture li:hover > a, .menu li:hover > a > span";
            $varURL.= "{ color: #";
            $varURL.= $recordset['menu_cor_hover'] ."!important;";
            $varURL.= "}";

            $varMTL = PreferencesUtils::getAttributes("menu_total");
            if($varMTL == 'true'){
                $varURL.= "#menu, #menu-wrap, #menu-wrap2";
                $varURL.= "{ width: 100%}";
            }else{
                if(Yii::app()->params['tecnologia'] == 0){
                $varURL.= "#menu, #menu-wrap, #menu-wrap2";
                $varURL.= "{ width: 980px; left: 50%; margin-left: -490px}";
                }
            }

            $varMTL2 = PreferencesUtils::getAttributes("menu_align");
            if($varMTL2 == 'center'){
                $varURL.= "#menuGroup";                
                $varURL.= "{ display: table; left: auto; right: auto;  margin: 0 auto;}";
                $varURL.= "#menu-content-wrap { width: 980px; left: 50%; margin-left: -490px; left: 50%; position: absolute;}";
            }
            if($varMTL2 == 'right'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: auto; margin-left: 0px; right: 0%; position: absolute;}";            
            }
            if($varMTL2 == 'left'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: 0%; margin-left: 0px; right: auto; position: absolute;}";
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
                if(Yii::app()->params['tecnologia'] != 1){
                $varURL.= "#menuGroup, #menu-wrap, #menu-wrap2, #menuTexture";
                $varURL.= "{height: " . $varMnAlt ."px;}";
                }
                
                $varURL.= ".navbar .nav > li > a, .mn_posSame";
                $varURL.= "{padding-top: " . $varMnAlt ."px!important; padding-bottom: " . $varMnAlt ."px!important;}";
                
            }
            
            $varMDC = PreferencesUtils::getAttributes("menu_cor_divider");
            $varMDV = PreferencesUtils::getAttributes("menu_dividers");
             
            if($varMDV == 'true'){
                $varURL.= "#menuGroup li, .navbar .nav > li > a";
                $varURL.= "{border-right: 1px solid #$varMDC!important;}";
                
                $varURL.= ".navbar .nav > li:first-child a ";
                $varURL.= "{border-left: 1px solid #$varMDC!important;}";
                
            }else{
                $varURL.= "#menuGroup li";
                $varURL.= "{border-right: none; box-shadow: none}";
            }

            $varMTXT = PreferencesUtils::getAttributes("menu_sombra_texto");
            if($varMTXT == 'true'){
                $varURL.= "#menuGroup a, .navbar .nav > li > a";
                $varURL.= "{text-shadow: 0 1px 0 #ccc;}";
            }else{
                $varURL.= "#menuGroup a";
                $varURL.= "{text-shadow: none}";
            }
            
            $varMACTC = PreferencesUtils::getAttributes("menu_background_active");
            if($varMACTC != ''){
                $varURL.= "#menuGroup li.active a, .dropdown.active > .bgMenuOp, .has-dropdown.active > .bgMenuOp ";
                $varURL.= "{background: #$varMACTC!important;}";
            }
            
            $varMBGC = PreferencesUtils::getAttributes("menu_background_color");
            if($varMBGC != ''){
                $varURL.= "#menuGroup li a, .navbar .nav > li > a:hover, .navbar .nav >.sfHover > a, .top-bar-section ul li:hover > a";
                $varURL.= "{background: #$varMBGC;}";
            }
            
            $varMPOSx = PreferencesUtils::getAttributes("margin_menu_pos_x", 'inteiro');
            if($varMPOSx != '' && $varMPOSx != 0){
                $varURL.= "#menuGroup ";
                $varURL.= "{left: ".$varMPOSx ."px!important; position: absolute;}";
            }
            
            $varMenuMarg = PreferencesUtils::getAttributes("menu_margin_baixo", 'inteiro');
            if($varMenuMarg != '' && $varMenuMarg != 0){
                $varURL.= "#menu-wrap, #menu-wrap2";
                $varURL.= "{margin-bottom: {$varMenuMarg}px!important;}";
            }

            //Logos - Site
            $varLg = PreferencesUtils::getAttributes("logo_site");
            if($varLg != '') $imageLogo = GraphicsUtils::getCoolContent($varLg);
            
            
            if(isset($imageLogo['container']['foto'])){
                $varURL.= ".logo_site";
                $varURL.= "{background: url(/media/user/images/original/".$imageLogo['container']['foto'].") no-repeat; display: inline-block; height: 110px; width:270px}";
            }
            
            //Logos - General
            $varPrint = PreferencesUtils::getAttributes("logo_impressao");
            if($varPrint != '') $imageLogoPrint = GraphicsUtils::getCoolContent($varPrint);
            
            
            if(isset($imageLogoPrint['container']['foto'])){
                $varURL.= ".logo_general, .logo_impressao";
                $varURL.= "{background: url(/media/user/images/original/".$imageLogoPrint['container']['foto'].") no-repeat; display: inline-block; height: 110px; width:270px}";
            }

            //Montando os detalhes do site
            //Montando o menu
            $typeOverlay = PreferencesUtils::getAttributes("overlay_texture_type");
            if($recordset['textura_overlay'] != ''){
            $varURL.= ".overlay";
            if($typeOverlay == '')$varURL.= "{ background-image: url(/media/images/textures/overlay/";
            if($typeOverlay == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_overlay'] .");";
            $varURL.= "}";
            }

            if($recordset['textura_sombras'] != ''){
            $varURL.= ".shadow";
            $varURL.= "{ background-image: url(/media/images/textures/sombras/";
            $varURL.= $recordset['textura_sombras'] .");";
            $varURL.= "}";
            }
            
            //Montando os topos e rodapes
            $typeFooter = PreferencesUtils::getAttributes("rodape_texture_type");
            $varURL.= ".footermainPan";
            if($typeFooter == '') $varURL.= "{ background-image: url(/media/images/textures/rodape/";
            if($typeFooter == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_rodape'] .");";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_rodape']) .";";
            $varURL.= "}";
            
            //Montando o logo
            $varTopoAlt = PreferencesUtils::getAttributes("topo_altura", 'inteiro');
            if($varTopoAlt != '' && $varTopoAlt != 0){ $varURL.= ".headerPan,  .topo_helper .navbar-static-top"; $varURL.= "{height: ". $varTopoAlt."px;}";}
            $typeHeader = PreferencesUtils::getAttributes("topo_texture_type");
            
            $varTopoFit = PreferencesUtils::getAttributes("topo_fit", 'inteiro');
            if($recordset['textura_topo'] != ''){
            $varURL.= ".headermainPan, .topo_helper .navbar-static-top";
            if($typeHeader == '')     $varURL.= "{ background-image: url(/media/images/textures/topo/";
            if($typeHeader == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_topo'] .");";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_topo']) .";";
            if($varTopoFit) $varURL.= "background-size: 100% 100%;";
            $varURL.= "}"; 
            }
            
            //BarraSocial
            $varBarraDist = PreferencesUtils::getAttributes("barra_social_distancia", 'inteiro');
            if($varBarraDist != ''){ $varURL.= ".top-soc {top: ". $varBarraDist."px;}";}
            
            $varBarraPos = PreferencesUtils::getAttributes("barra_social_lado", 'texto');
            if($varBarraPos != ''){ $varURL.= ".social-top {float: ". $varBarraPos.";}";}
            
            $varBarraRedS = PreferencesUtils::getAttributes("barra_social_redes_sociais", 'inteiro');
            if($varBarraRedS == 0){ $varURL.= ".social-top li.br_icon_social {display: none!important;}";}
            
            
            $varBarraTypeCor = PreferencesUtils::getAttributes("barra_social_type_background", 'inteiro');
            $varBarraBG = PreferencesUtils::getAttributes("barra_social_background", 'texto');
            $varBarraBGC = PreferencesUtils::getAttributes("barra_social_background_color", 'texto');
            
            if($varBarraTypeCor == 1){
                $varURL.= ".top-soc {background: url(/media/images/textures/site/". $varBarraBG.");}";
            }
            
            if($varBarraTypeCor == 2){
                Yii::import('application.extensions.utils.HelperUtils');
                $rgb = HelperUtils::hex2rgb($varBarraBGC);
                if($varBarraBG != '')$varURL.= ".top-soc {background-image: url(/media/images/textures/efeitos/". $varBarraBG.");}";
                $varURL.= ".top-soc {background-color: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, 0.2)!important;}";
            }
            //BarraSocial - Fim 
            
            //BreadCrumb
            $varBreadCrumbTypeCor = PreferencesUtils::getAttributes("breadcrumb_type_background", 'inteiro');
            $varBreadCrumbBG = PreferencesUtils::getAttributes("breadcrumb_background", 'texto');
            $varBreadCrumbBGC = PreferencesUtils::getAttributes("breadcrumb_background_color", 'texto');
            $varBreadCrumbTop = PreferencesUtils::getAttributes("breadcrumb_top", 'inteiro');
            $varBreadCrumbBottom = PreferencesUtils::getAttributes("breadcrumb_bottom", 'inteiro');
            $varBreadCrumbSide = PreferencesUtils::getAttributes("breadcrumb_lado", 'texto');
           
            if($varBreadCrumbTypeCor == 1){
                $varURL.= ".breadcrumb {background: url(/media/images/textures/site/". $varBreadCrumbBG.")!important;}";
            }
            
            if($varBreadCrumbTypeCor == 2){
                Yii::import('application.extensions.utils.HelperUtils');
                $rgb = HelperUtils::hex2rgb($varBreadCrumbBGC);
                if($varBreadCrumbBG != '')$varURL.= ".breadcrumb {background-image: url(/media/images/textures/efeitos/". $varBreadCrumbBG.");}";
                $varURL.= ".breadcrumb {background-color: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, 0.6)!important;}";
            }
            
            if($varBreadCrumbTop != 0 && $varBreadCrumbTop != '') $varURL.= ".breadcrumb {margin-top: {$varBreadCrumbTop}px!important;}";
            if($varBreadCrumbBottom != 0 && $varBreadCrumbBottom != '') $varURL.= ".breadcrumb {margin-bottom: {$varBreadCrumbBottom}px!important;}";
            if($varBreadCrumbSide != ''){ $varURL.= ".breadcrumb {float: {$varBreadCrumbSide}!important;}";}
            //Breadcrumb - Fim

            
            $varFTMn = PreferencesUtils::getAttributes("ft_menu");
            $varFTMnTy = PreferencesUtils::getAttributes("ft_menu_type", 'inteiro');
            if($varFTMn != ''){
                $repT = 'repeat-x'; if($varFTMnTy == 1) $repT = 'repeat'; if($varFTMnTy == 2) $repT = 'no-repeat';
                $varURL.= ".ftMenu ";
                $varURL.= "{background: url(/media/images/textures/rodape/" . $varFTMn .") $repT ;}";
            }
            
            $varFTLn2 = PreferencesUtils::getAttributes("ft_line2");
            if($varFTLn2 != ''){
                $varURL.= ".ftLine2 ";
                $varURL.= "{background: url(/media/images/textures/site/" . $varFTLn2 .")  repeat;}";
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
            
            $varFTTituloMn = PreferencesUtils::getAttributes("ft_titulo_menu");
            if($varFTTituloMn != ''){$varURL.= ".tituloMenu";$varURL.= "{color: #" . $varFTTituloMn ." !important;}";}
            
            $varFTSubtituloMn = PreferencesUtils::getAttributes("ft_subtitulo_menu");
            if($varFTSubtituloMn != ''){$varURL.= ".subtituloMenu";$varURL.= "{color: #" . $varFTSubtituloMn ." !important;}";}
            
            $varFTTxtMn = PreferencesUtils::getAttributes("ft_txt_menu");
            if($varFTTxtMn != ''){$varURL.= ".textoMenu";$varURL.= "{color: #" . $varFTTxtMn ." !important;}";}
            
            $varFTTxtMn2Es = PreferencesUtils::getAttributes("ft_menu2_espacamento", 'inteiro');
            if($varFTTxtMn2Es != ''){
                $varURL.= ".container_link_mn_cols4 ";
                $varURL.= "{margin-bottom: " . $varFTTxtMn2Es ."px !important;}";
            }
            
            $varFTFbBg = PreferencesUtils::getAttributes("ft_fb_bg");
            if($varFTFbBg != ''){
                $varURL.= ".ftFbBg ";
                $varURL.= "{background: url(/media/images/textures/site/" . $varFTFbBg .")  repeat;}";
            }
            
            $varFTLnCn = PreferencesUtils::getAttributes("ft_ln_company_bg");
            if($varFTLnCn != ''){
                $varURL.= ".ftLineCompany ";
                $varURL.= "{background: url(/media/images/textures/site/" . $varFTLnCn .")  repeat;}";
            }
            
            $varFTTxtComp = PreferencesUtils::getAttributes("ft_txt_line_company");
            if($varFTTxtComp != ''){
                $varURL.= ".ftLineCompany, .ftLineCompany p, .ftLineCompany a, .ftLineCompany span ";
                $varURL.= "{color: #" . $varFTTxtComp ." !important;}";
            }
            
            //Montando blocks
            $varURL.= ".vertical_block";
            $varURL.= "{ background-image: url(/media/images/textures/";
            $varURL.= $recordset['textura_vertical_block'] .");";
            $varURL.= "}";

            $varURL.= ".horizontal_block";
            $varURL.= "{ background-image: url(/media/images/textures/";
            $varURL.= $recordset['textura_horizontal_block'] .");";
            $varURL.= "}";

            //Montando alertas
            $varAlr = TexturasUtils::getAttributesByClass($recordset['classe_alerta']);
            $varURL.= ".flash_notice";
            $varURL.= "{ background: " . $varAlr['background_color'].";";
            $varURL.= " boder-color: " . $varAlr['border_color'].";";
            $varURL.= "}";

            $varURL.= "#flash_notice_text span";
            $varURL.= "{ color: " . $varAlr['font_color'].";}";

            $varTxt = TexturasUtils::getTextureInputs($recordset['textura_textos']);
            $varURL.= ".container_inputs_corner_left";        
            $varURL.= "{ background-image: url(/media/images/layout/input_text/";
            $varURL.=  $varTxt['left'] .");";
            $varURL.= "}";

            $varURL.= ".container_inputs_middle";        
            $varURL.= "{ background-image: url(/media/images/layout/input_text/";
            $varURL.=  $varTxt['middle'] .");";
            $varURL.=  "color:#". $recordset['input_text_cor'] .";";
            $varURL.= "}";

            $varURL.= ".container_inputs_corner_right";        
            $varURL.= "{ background-image: url(/media/images/layout/input_text/";
            $varURL.=  $varTxt['right'] .");";
            $varURL.= "}";

            $varBTL = PreferencesUtils::getAttributes("bt_logar_owner");
            if($varBTL == "") $varBTL = "bt_logar_default.png";
            $varURL.= ".button_logar_owner";        
            $varURL.= "{ background: url(/media/images/buttons/";
            $varURL.=  $varBTL . ") no-repeat;";
            $varURL.= "}"; 

            $varBMore = PreferencesUtils::getAttributes("more");
            if($varBMore != "empty.png"){
            $varURL.= ".link_more";        
            $varURL.= "{ background: url(/media/images/detalhes/more/";
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
            $varURL.= "h1, .tit_size";        
            $varURL.= "{ font-size: ";
            $varURL.= $varTitleSize ."em!important;";
            $varURL.= "}";
            }
            
            //Font size
            $varSubTitleSize = PreferencesUtils::getAttributes("subtitulo_size", 'number');
            if($varSubTitleSize != "" && $varSubTitleSize != 0){
            $varURL.= ".subt_size";        
            $varURL.= "{ font-size: ";
            $varURL.= $varSubTitleSize ."em!important;";
            $varURL.= "}";
            }
            
            $varTextSize = PreferencesUtils::getAttributes("text_size");
            if($varTextSize != "" && $varTextSize != 0){
            $varURL.= "p, .texto";        
            $varURL.= "{ font-size: ";
            $varURL.= $varTextSize ."em!important;";
            $varURL.= "}";
            }
            
            $varTextLineHeight = PreferencesUtils::getAttributes("text_line_height");
            if($varTextLineHeight != "" && $varTextLineHeight != 0){
            $varURL.= "p, .texto";        
            $varURL.= "{ line-height: ";
            $varURL.= $varTextLineHeight ."px!important;";
            $varURL.= "}";
            }
            
            $varTextAlign = PreferencesUtils::getAttributes("text_alignment");
            if($varTextAlign != ""){
            $varURL.= "p, .texto";        
            $varURL.= "{ text-align: ";
            $varURL.= $varTextAlign .";";
            $varURL.= "}";
            }
            
            $varChamadaFonte = PreferencesUtils::getAttributes("chamada_fonte");
            $varChamadaAlinhamento = PreferencesUtils::getAttributes("chamada_alinhamento");
            $varChamadaSize = PreferencesUtils::getAttributes("chamada_size", 'number');
            $varChamadaLine = PreferencesUtils::getAttributes("chamada_line", 'number');
            if($varChamadaFonte != ""){
            $varURL.= ".standart-h2title, .standart-ptitle {font-family: chamada_title;}";        
            $varURL.= " @font-face { font-family: chamada_title; src: url('/media/fonts/{$varChamadaFonte}'); }";
            }
            
            if($varChamadaAlinhamento != ""){$varURL.= ".standart-h2title, .standart-ptitle {text-align: {$varChamadaAlinhamento}!important;}";}
            if($varChamadaSize != "" && $varChamadaSize != 0){$varURL.= ".standart-h2title .large-text, .standart-h2title {font-size: {$varChamadaSize}em!important;}";}
            if($varChamadaLine != "" && $varChamadaLine != 0){$varURL.= ".standart-h2title {line-height: {$varChamadaLine}em!important;}";}
            
            //Buttons
            $varSideButton = PreferencesUtils::getAttributes("side_button", 'texto', $session['device']);
            if($varSideButton != ""){
            $varURL.= ".bn_button_left, .btn_bt_left ";        
            $varURL.= "{ background: url(/media/images/detalhes/side_button/images/left_" . $varSideButton . ") no-repeat;}";
            $varURL.= ".bn_button_right, .btn_bt_right ";        
            $varURL.= "{ background: url(/media/images/detalhes/side_button/images/right_" . $varSideButton . ") no-repeat;}";
            }
          
            $varFrm = PreferencesUtils::getAttributes("frame_vitrine");
            if($varFrm == "") $varFrm = "frame_white_semirounded_200x300.png";
            $varURL.= ".produtos_item_vitrine";        
            $varURL.= "{ background: url(/media/images/layout/frames/small/";
            $varURL.=  $varFrm . ") no-repeat;";
            $varURL.= "}";
            $varURL.= ".produtos_item_vitrine_full";        
            $varURL.= "{ background: url(/media/images/layout/frames/full/";
            $varURL.=  $varFrm . ") no-repeat;";
            $varURL.= "}";
            
            $typeWallpaper = PreferencesUtils::getAttributes("wallpaper_texture_type");
            $varURL.= ".action-banner-bg";
            if($typeWallpaper == '') $varURL.= "{ background-image: url(/media/images/textures/wallpaper/";
            if($typeWallpaper == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_wallpaper'] .");";
            $varURL.= "}";
            
            // echo $recordset['textura_efeitos'];
            if($recordset['textura_efeitos'] != '' || $recordset['textura_efeitos'] != 0){
            $varURL.= ".action-banner-bg-top";
            $varURL.= "{ background-image: url(/media/images/textures/efeitos/";
            $varURL.= $recordset['textura_efeitos'] .");";
            $varURL.= "}";
            }
            
            $bn_distancia_t = PreferencesUtils::getAttributes("distancia_main_banner", 'inteiro');
            $bn_distancia_b = PreferencesUtils::getAttributes("main_banner_margin_base", 'inteiro');
            $bn_painel = PreferencesUtils::getAttributes("main_banner_painel", 'inteiro');
            $bn_shadow = PreferencesUtils::getAttributes("banner_shadow");
            
            if($bn_distancia_t != '') $varURL.= "#banner_main {padding-top:" . $bn_distancia_t ."px!important; }";
            if($bn_distancia_b != '') $varURL.= "#banner_main {padding-bottom:" . $bn_distancia_b ."px!important; }";            
            if($bn_painel) $varURL.= "#bnOlbDD {display: block}";
            
            if($bn_shadow != "") $varURL.= ".shadow_main_banner {background: url(/media/images/layout/banners/{$bn_shadow}) no-repeat;}";


            $varShpC = PreferencesUtils::getAttributes("bt_shopcart");
            if($varShpC == "") $varShpC = "cart_white_dark_3.png";
            $varURL.= ".botao_carrinho";        
            $varURL.= "{ background: url(/media/images/textures/botao/";
            $varURL.=  $varShpC . ") no-repeat;";
            $varURL.= "}";
            
            $varDivider = PreferencesUtils::getAttributes("dividers");
            $varDividerT = PreferencesUtils::getDividerByClass($varDivider);
            $varEDivider = PreferencesUtils::getAttributes("divider_espessura");
            $varCDivider = PreferencesUtils::getAttributes("divider_color");
            $varURL.= ".divider_horizontal, .titleContent";
            
            if($varDividerT != ''){
            if($varDividerT['type'] == "css"){
            if($varDividerT['src'] != "empty")$varURL.= "{ border-bottom:". $varEDivider ." ". $varDividerT['src']  ." ". $varCDivider ."}";
            }else{
            $varURL.= "{ background: url(/media/images/layout/dividers/";
            $varURL.=  $varDividerT['src'] . ") repeat-x; height: 10px;";
            $varURL.= "}";
            } 
            }
  
            $varDividerV = PreferencesUtils::getAttributes("dividers_vertical");
            if($varDividerV){
                $varDividerVT = PreferencesUtils::getDividerByClass($varDividerV);
                $varEDividerV = PreferencesUtils::getAttributes("divider_vertical_espessura");
                $varCDividerV = PreferencesUtils::getAttributes("divider_vertical_color");
                $varURL.= ".divider_vertical, .ctnDividerVertical";
                if($varDividerVT['type'] == "css"){
                if($varDividerVT['src'] != "empty")$varURL.= "{ border-right:". $varEDividerV ." ". $varDividerVT['src']  ." ". $varCDividerV ."}";
                }else{
                $varURL.= "{ background: url(/media/images/layout/dividers/";
                $varURL.=  $varDividerVT['src'] . ") repeat-y; width: 1px;";
                $varURL.= "}";
                }
            }

            $varMnStore = PreferencesUtils::getAttributes("menu_loja");
            $attrStore = ThemesUtils::getThemeAttributes($varMnStore);
            //$varURL.= ".main_menu_store_middle";        
            //$varURL.= "{ background: url(/media/images/layout/boundbox/menu_lateral/";
            //$varURL.=  $attrStore['background-middle'] . ") repeat-y;";
            //$varURL.=  "color: ".$attrStore['color'] . ";";
            //$varURL.= "}";
            //$varURL.= ".main_menu_store_middle a";        
            //$varURL.=  "{color: ".$attrStore['color'] . ";}";
            $varURL.= ".titulo_menu_ecommerce";        
            $varURL.=  "{border-bottom-color: ".$attrStore['divider'] . ";}";
            //$varURL.= ".subcat_items a, .subcat_items input[type='button'] {color: ".$attrStore['subitem-color'] . "!important;}";        
            

            $varURL.= ".main_menu_store_top";        
            $varURL.= "{ background: url(/media/images/layout/boundbox/menu_lateral/";
            $varURL.=  $attrStore['background-top'] . ") no-repeat;";
            $varURL.= "}";
            $varURL.= ".main_menu_store_bottom";        
            $varURL.= "{ background: url(/media/images/layout/boundbox/menu_lateral/";
            $varURL.=  $attrStore['background-bottom'] . ") no-repeat;";
            $varURL.= "}";   
            
            if(Yii::app()->params['pan_shadow']){
            $varURL.= ".pan_shadow {position: relative;}";
            $varURL.= ".pan_shadow:before {width: 30px; height: 100%; content: ''; background: url(/media/images/textures/paginas/shadow_left.png) no-repeat; position: absolute; margin-left: -30px;}";
            $varURL.= ".pan_shadow:after {width: 30px; height: 100%; content: ''; background: url(/media/images/textures/paginas/shadow_right.png) no-repeat; position: absolute; display: inline-block; right: -30px; top:0px;}";
            }
            
            
            //*******************//
            // Update settings file
            if($session['miniSiteUser'] == '') $setSettingsFile = MethodUtils::updateSettingsFile();
            

            //*******************//

            $nome = "main";
            if($session['device'] != "desktop" && $session['device'] != "") $nome = $session['device'];
            $cria = fopen("media/user/css/".$nome . ".css", "w+");

            $dados = $varURL;

            if(!file_exists($nome . ".css")){        
               $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
            }

            fclose($cria);
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: CssManager - updateCSS() ' . $e->getMessage();
        }

    }
    
    
    
    /*
     * Return the correct string type type
     * 
     * @param number
     * 
     */
    public function getSpecialAttributes($type, $verify){

        $result = "";
        
        switch ($type){            
            case "h1":
                if($verify != "" || $verify != "empty.png"){
                    $result .= "background: url(/media/images/detalhes/flags/" . $verify .") no-repeat 0px 0px;";
                    $result .= "padding:5px 0 5px 40px;";
                }
                break;
            case "topic":
                if($verify != "" || $verify != "empty.png"){
                $result = "padding:0px 0 0 25px;";
                }
                break;
        }       
        return $result;
    }
    
    
    /**
     * Metodo para criar ou editar um CSS
     * Neste caso esse método cria um arquivo CSS para
     * ser lido como Css.
     *
    */
    public function updateCssHotSite($id){
        
        Yii::import('application.extensions.utils.special.ThemesUtils');
        Yii::import('application.extensions.utils.admin.TexturasUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        try {
            
            $device = MethodUtils::getDeviceType();
            $session = MethodUtils::getSessionData();

            $select  = "botao_cor, botao_cor_hover, textura_botao, titulo_cor, subtitulo_cor, menu_cor, menu_cor_hover, textura_menu, textura_site, tipo_textura_site, ";
            $select .= "link_cor, link_cor_hover, texto_cor, flags, icons, cor_textura_site, textura_paginas, tipo_textura_paginas, cor_textura_paginas, ";
            $select .= "textura_overlay, textura_sombras, textura_rodape, tipo_textura_rodape, textura_topo, tipo_textura_topo, logos, ";
            $select .= "textura_vertical_block, textura_horizontal_block, textura_textos, input_text_cor, classe_alerta, hotsite";
            $sql = "SELECT ".$select." FROM preferencias_data WHERE id = $id";

            $session = MethodUtils::getSessionData();
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();     

            //Initial variable
            $varURL= ""; 
            
            //Montando os site e as páginas internas
            //Site
            $typeSite = PreferencesUtils::getAttributes("site_texture_type");
            if($recordset['textura_site'] != ''){
            $varURL.= "body, .background_ipad";
            if($typeSite == '')     $varURL.= "{ background-image: url(/media/images/textures/site/";
            if($typeSite == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_site'] .");";
            $varURL.= "background-color: " . $recordset['cor_textura_site'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_site']) .";";
            if($recordset['tipo_textura_site'] == 5) $varURL.= "background-attachment:fixed!important;";
            $varURL.= "}";
            }
            
            //Páginas
            $typePages = PreferencesUtils::getAttributes("paginas_texture_type");
            if($recordset['textura_paginas'] != ''){
            $varURL.= ".pan";
            if($typePages == '')     $varURL.= "{ background-image: url(/media/images/textures/paginas/";
            if($typePages == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_paginas'] .");";
            $varURL.= "background-color: " . $recordset['cor_textura_paginas'] .";";
            $varURL.= "background-repeat: " . TexturasUtils::getTypeTexture($recordset['tipo_textura_paginas']) .";";
            $varURL.= "}";

            $varURL.= ".pan_top, .pan_footer";
            $varURL.= "{ background-image: url(/media/images/textures/paginas/";
            $varURL.= $recordset['textura_paginas'] .");";
            $varURL.= "}";
            }

            //Montando os botões 
            $typeButton = PreferencesUtils::getAttributes("botao_texture_type");
            $varURL.= ".botao, .botao_small";
            $varURL.= "{ color: #";
            $varURL.= $recordset['botao_cor'] .";";
            $varURL.= "}";

            $varURL.= ".botao:hover, .botao_small:hover";
            $varURL.= "{ color: #";
            $varURL.= $recordset['botao_cor_hover'] .";";
            $varURL.= "}";

            $varURL.= ".botao";
            if($typeButton == '') $varURL.= "{ background-image: url(/media/images/textures/botao/";
            if($typeButton == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_botao'] .");";
            $varURL.= "}";

            $varURL.= "h1, .titulo";
            $varURL.= "{ color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".main-color, .main-color span, span.main-color";
            $varURL.= "{ color: #";
            $varURL.= $recordset['titulo_cor'] ."!important;";
            $varURL.= "}";
            
            $varURL.= ".main-border";
            $varURL.= "{ border-color: #";
            $varURL.= $recordset['titulo_cor'] ."!important;";
            $varURL.= "}";
            
            $varURL.= ".line2 span:before";
            $varURL.= "{ border-top-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".line2, .line2 span";
            $varURL.= "{ border-bottom-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            
            $varURL.= ".border-left-color";
            $varURL.= "{ border-left-color: #";
            $varURL.= $recordset['titulo_cor'] .";";
            $varURL.= "}";
            

            //Montando os textos        
            $varURL.= "h1 ";
            $varURL.= "{";
            $varURL.= $this->getSpecialAttributes("h1", $recordset['flags']);
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
            $varURL.= "{ background: url(/media/images/detalhes/icons/";
            $varURL.= $recordset['icons'] .") no-repeat 0px 0px;";
            $varURL.= $this->getSpecialAttributes("topic", $recordset['icons']);
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
            //Logos - Site
            $varLg = $recordset['logos'] ;
            
            
            if($varLg){
                $varURL.= ".logo_site";
                $varURL.= "{background: url(/media/user/images/original/{$varLg}) no-repeat; display: inline-block; height: 110px; width:270px}";
            }
            
            //Logos - General
            $varPrint = PreferencesUtils::getAttributes("logo_impressao");
            if($varPrint != '') $imageLogoPrint = GraphicsUtils::getCoolContent($varPrint);
            
            $varLogoPosX = PreferencesUtils::getAttributes("logo_pos_x", 'inteiro');
            $varLogoPosY = PreferencesUtils::getAttributes("logo_pos_y", 'inteiro');
            
            $varLogoAlt = PreferencesUtils::getAttributes("logo_altura", 'inteiro');
            $varLogoLar = PreferencesUtils::getAttributes("logo_largura", 'inteiro');
            
            $varLogoCtnAlt = PreferencesUtils::getAttributes("logo_container_height", 'inteiro');
            $varLogoCtnLar = PreferencesUtils::getAttributes("logo_container_width", 'inteiro');
             
            if($varLogoPosY != ''){ $varURL.= ".logo"; $varURL.= "{top: ". $varLogoPosY."px;}";}
            if($varLogoPosX != ''){ $varURL.= ".logo"; $varURL.= "{left: ". $varLogoPosX."px;}";}
            
            if($varLogoAlt != '' && $varLogoLar){ $varURL.= ".logo_site {background-size: ". $varLogoLar."px ". $varLogoAlt."px !important; width: {$varLogoLar}px!important;  height: {$varLogoAlt}px!important;}";}
            if($varLogoCtnAlt != 0) $varURL.= ".logo_site {height: {$varLogoCtnAlt}px!important;}";
            if($varLogoCtnLar != 0) $varURL.= ".logo_site {width: {$varLogoCtnLar}px!important;}";
            
            
            //Montando o menu
            $typeMenu = PreferencesUtils::getAttributes("menu_texture_type");
            $varURL.= "#menu, #menu-wrap, #menuGroup li ul";
            if($typeMenu == '')     $varURL.= "{ background-image: url(/media/images/textures/menu/";
            if($typeMenu == 'user') $varURL.= "{ background-image: url(/media/user/images/original/";
            $varURL.= $recordset['textura_menu'] .");";
            $varURL.= "}";

            $varURL.= ".menu a, #menuGroup a, #menuTexture a";
            $varURL.= "{ color: #";
            $varURL.= $recordset['menu_cor'] .";";
            $varURL.= "}";

            $varURL.= ".menu a:hover, #menuGroup li:hover > a, #menuTexture li:hover > a";
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
                $varURL.= "#menu-content-wrap { width: 980px; left: 50%; margin-left: -490px; left: 50%; position: absolute;}";
            }
            if($varMTL2 == 'right'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: auto; margin-left: 0px; right: 0%; position: absolute;}";            
            }
            if($varMTL2 == 'left'){
                $varURL.= "#menuGroup";
                $varURL.= "{ width: auto; left: 0%; margin-left: 0px; right: auto; position: absolute;}";
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
                $varURL.= "#menuGroup, #menu-wrap, #menuTexture";
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
                $varURL.= "#menuGroup li.active a, .navbar .nav > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus ";
                $varURL.= "{background: #$varMACTC!important;}";
            }
            
            $varMBGC = PreferencesUtils::getAttributes("menu_background_color");
            if($varMBGC != ''){
                $varURL.= "#menuGroup li a";
                $varURL.= "{background: #$varMBGC;}";
            }
            
            $varMPOSx = PreferencesUtils::getAttributes("margin_menu_pos_x", 'inteiro');
            if($varMPOSx != '' && $varMPOSx != 0){
                $varURL.= "#menuGroup ";
                $varURL.= "{left: ".$varMPOSx ."px!important; position: absolute;}";
            }

            //Logos - Site
            $varLg = PreferencesUtils::getAttributes("logo_site");
            if($varLg != '') $imageLogo = GraphicsUtils::getCoolContent($varLg);
            
            
          
            
            
            //*******************//
            // Update settings file
            if($session['miniSiteUser'] == '') $setSettingsFile = MethodUtils::updateSettingsFile();
            

            //*******************//

            $nome = "hotsite_" . $recordset['hotsite'];
            $cria = fopen("media/user/css/".$nome . ".css", "w+");

            $dados = $varURL;

            if(!file_exists($nome . ".css")){        
               $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
            }

            fclose($cria);
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: CssManager - updateCSSHotSite() ' . $e->getMessage();
        }

    }
}
?>