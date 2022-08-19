<?php

/**
 * Description of HelperUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class HelperUtils {


    /**
     * Método para pegar o avatar do usuário
     *
     * @param number id
     *
    */
    public static function getAvatar($id = ""){
        
        $obiz = HelperUtils::getObiz();
        
        if($id == "" || $id == '0'){            
            $result = "/media/images/avatar/avatar_profile.jpg";  
            
        }else{  
            
            if(!$obiz) $fields = "id, avatar";
            if( $obiz) $fields = "id, AES_DECRYPT(avatar, {$obiz['serial']}) as avatar";
            
            $sql = "SELECT $fields FROM user_data WHERE id = {$id}";
            
            $command = Yii::app()->db->createCommand($sql);      
            $user = $command->queryRow();
                    
            //Verifica se o user ainda esta cadastrado
            if($user != null){
                $result = $user['avatar'];
            } else {
                $result = "/media/images/avatar/avatar_profile.jpg";
            }            
        }        
        return $result;
    }
    
    /**
     * Método para pegar a frase do usuário
     *
     * @param number id
     *
    */
    public static function getFrase($id){
        
        if($id == "" || $id == '0') {            
            $result = "To dentro!!!";            
        }else{            
            $sql = "id = '" . $id . "'";
            $user = User::model()->find($sql);            
            //Verifica se o user ainda esta cadastrado
            if($user != null){
                $result = $user->frase;
            } else {
                $result = "";
            }            
        }        
        return $result;
    }
    
    /**
     * Método para pegar o tipo do usuário Pessoa Física ou Jurídica
     *
     * @param number id
     *
    */
    public static function getTipo($id){
                   
        $sql = "id = '" . $id . "'";
        $user = User::model()->find($sql);            
        //Verifica se o user ainda esta cadastrado
        if($user != null){
            $result = $user->type;
        } else {
            $result = "";
        }            
                
        return $result;
    }
    
    /**
     * Método para pegar o tipo do usuário Pessoa Física ou Jurídica
     *
     * @param number id
     *
    */
    public static function getUserById($id, $isPurple = false, $data = array()){
                   
        Yii::import('application.extensions.utils.users.UserUtils'); 
        
        try{
            $recordset = UserUtils::getUserFullById($id, $isPurple, $data);
            return $recordset;  
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: HelperUtils - getUserById() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR: HelperUtils - getUserById()', 'trace' => $e->getMessage()), true);
        }

    }
    
    /**
     * Método para pegar o nivel do profile, se foi completo
     * ou não! 0 não completo e 1 está completo, com a tabela user_company
     * preenchida
     *
     * @param number id
     *
    */
    public static function getProfileLevel($id, $needed = ""){       
            
        $sql = "id = '" . $id . "'";
        $user = User::model()->find($sql);
        //Verifica se o user ainda esta cadastrado
        if($user != null){
            Yii::import('application.extensions.utils.users.UserUtils');
            $result = UserUtils::getAttribute("profile_" . $needed, "inteiro", $id);
        } else {
            $result = false;
        }              
        return $result;
    }
    
    
    /**
     * Método para o pegar o titulo da página com alguns 
     * detalhes de contato.
     * 
     * PS: Essa merda é usada dentro do enviar e-mail classe,
     * as vezes se alterar pode dar pau, cuidado se mexer!!!
     *
    */
    public static function getTitleSite($data = array()){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $sql = "SELECT titulo, descricao, metatags, google_tags_manager FROM preferencias_data WHERE tipo = 'desktop'";
        
        $session = MethodUtils::getSessionData();
        
        if($session['dados_site'] != '') return $session['dados_site'];
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $recordset['email_title'] = PreferencesUtils::getAttributes("email_title");
            $recordset['email_mkt_teste'] = PreferencesUtils::getAttributes("email_emkt_teste");
            $recordset['facebook'] = HelperUtils::getSocialNetWorkProfile("facebook");
            $recordset['twitter'] = HelperUtils::getSocialNetWorkProfile("twitter");
            $recordset['rss']  = HelperUtils::getSocialNetWorkProfile("rss");
            $recordset['telefone'] = PreferencesUtils::getAttributes('telefone_contato', 'texto');
            $recordset['endereco'] = PreferencesUtils::getAttributes('endereco', 'texto');
            $recordset['whatsapp'] = PreferencesUtils::getAttributes('whatsapp', 'texto');
            
            if(!isset($data['partial'])){
                $recordset['facebook_app_id'] = PreferencesUtils::getAttributes("id_app_fb", "texto");
                $recordset['logo_rede_sociais'] = HelperUtils::getLogosGeneral();
                $recordset['logo_app'] = HelperUtils::getLogosGeneral("logo_app");                
                $recordset['linkedin'] = HelperUtils::getSocialNetWorkProfile("linkedin");
                $recordset['google_tags_manager'] = $recordset['google_tags_manager'];
                $recordset['canal_youtube'] = HelperUtils::getPreferencesAttributes("canal_youtube");
                $recordset['flickr'] = HelperUtils::getPreferencesAttributes("flicker");
                $recordset['instagram'] = HelperUtils::getPreferencesAttributes("instagram");
                $recordset['pinterest'] = HelperUtils::getPreferencesAttributes("pinterest");
            }
            
            $set = MethodUtils::setSessionData('dados_site', $recordset);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getTitleSite() " . $e->getMessage();
        }
    }
    
    /**
     * Método para pegar a data de criação
     *
     * @param number id
     *
    */
    public static function getDateCreation($id){
        
        if($id == "" || $id == '0'){            
            $result = "Sem registro";            
        }else{            
            $sql = "id = '" . $id . "'";
            $user = User::model()->find($sql);
            $result = $user->creation;            
        }        
        return $result;
    }
    
    /**
     * Método para redirecionar um usuário não logado
     * ou que seu login tenha expirado
     *
     * @param boolean
     *
    */
    public static function redirectGuest($type_request){
        if ($type_request) {   
            echo "expirou";  
        }else{
            $this->redirect(Yii::app()->homeUrl);
        }
    }
    
    /**
     *
     * Create Feed
     * This method updates the XML Feed file
     * it sets all materias in that table database
     *
     */
    public static function createFeed($fromPage){
        
        Yii::import('application.extensions.dbuzz.admin.XmlManager');        
        $feedHandler = new XmlManager();

        try{            
            switch($fromPage){                
                case "materias":
                    $content = true;
                    $content = $feedHandler->updateMateriasRSS();
                    break;
                
                case "eventos":
                    $content = $feedHandler->updateEventosRSS();
                    break;
                
                case "produtos":
                    $content = $feedHandler->updateProdutosRSS();
                    break;
                
                case "ecommerce":
                    $content = $feedHandler->updateProdutosRSS('ecommerce');
                    break;
                
                case "blog":
                    $content = $feedHandler->updateBlogRSS();
                    break;
                
                case "site":
                    $content = $feedHandler->updateSiteRSS();
                    break;
                
                case "sitemap":
                    $content = $feedHandler->updateSiteMap();
                    break;
            }  
            
            
            return $content;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: HelperUtils - createFeed() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Create CSS
     * This method updates the CSS  file
     * it sets styles from the table minhas_preferencias
     *
     */
    public static function createCss(){
        
        Yii::import('application.extensions.dbuzz.admin.CssManager');        
        $cssHandler = new CssManager();

        try{           
            $content = $cssHandler->updateCSS();
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: HelperUtils - createCSS() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - createCSS() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para pegar o label de uma página com seu id
     * usada em categorias
     *
     * @param number
     *
    */
    public static function getPageNameById($id){
        
        $select = "id, label";
        $sql = "SELECT $select FROM paginas_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getPageNameById() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getPageNameById() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para pegar o label de uma categoria com seu id
     * usada em topo site
     *
     * @param number
     *
    */
    public static function getCategoryLabel($id, $isAll = false){
        
        $select = "nome, descricao, container_1";
        $sql = "SELECT $select FROM conteudo_categorias WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($isAll) return $recordset;
            return $recordset['nome'];

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getCategoryLabel() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getCategoryLabel() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para pegar o logo do usuário selecionado em:
     * Admin restrict area, layout->detalhes->logos
     *
    */
    public static function getLogo($tipo = "logos", $isSpecial = false){

        try{
            if(!$isSpecial){
                $command = Yii::app()->db->createCommand("SELECT $tipo FROM preferencias_data");
                $recordset = $command->queryRow();            
                return $recordset['logos'];
            }
            
            if( $isSpecial){       
                Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
                $pA = new PreferencesAttribute();                
                $pA->setCurrentUser(0);
                
                return $pA->recuperar($tipo, "texto");
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getLogo() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getLogo() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para pegar o logo do usuário selecionado em:
     * Admin restrict area, layout->detalhes->logos
     *
    */
    public static function getSocialNetWorkProfile($tipo = "facebook"){
        
        $sql = "SELECT $tipo FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset[$tipo];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getSocialNetWorkProfile() " . $e->getMessage();
            //MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getSocialNetwork() ', 'trace' => $e->getMessage()), true);
        }         
    }
    
    /**
     * Método para pegar o logo do usuário selecionado em:
     * Preferencias attributes
     *
    */
    public static function getLogosGeneral($logo = "logo_redes_sociais", $local = "texto"){

        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        
        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        try{       
            $logo_bruto= $pA->recuperar($logo, $local);
            
            if($logo_bruto){
                $picture = explode("_", $logo_bruto);
                $result['logo']  = GraphicsHelperUtils::getPhotos($picture['1']);
            }else{
                $result['logo']['foto'] = "";
            }
            return $result['logo']['foto'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getLogosGeneral() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getLogosGeneral() ', 'trace' => $e->getMessage()), true);
        }        
    }
    
    /**
     * Método para pegar o estado de acordo com o id dele
     * usa-se a tabela general_state
     * Maurooooooooo viadinho
     *
     * @param number id
     *
    */
    public static function getState($id, $byUf = false){
        
        if($id == '' || $id == NULL) $id = 0;
        $sql = "SELECT uf FROM general_state WHERE id = $id";
        if($byUf) $sql = "SELECT id FROM general_state WHERE uf = '$id'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($byUf) return $recordset['id'];
            return $recordset['uf'];
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getState() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getState() ', 'trace' => $e->getMessage()), true);
        }  
    }
    
    /**
     * Método para retornar a string dos booleans
     *
     * @param number
     *
    */
    public static function getStringBooleanValue($boolean){
        
        switch($boolean){
            case 1:
                $result = "Sim";
                break;
            
            case 0:
                $result = "Não";
                break;
            default:
                $result = "Não";
                break;
        }
        
        return $result;
    }
    
    /**
     * Método para retornar a string entre dois pontos limitantes
     * algo como de $$ até &&
     *
     * @param string
     * @param string
     * @param string
     *
    */
    public static function getStringBetween($string, $start, $end){
        
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        
        return substr($string,$ini,$len);
    }
    
    /**
     * Método para obter os atributos das preferencia 
     *
     * @param string
     *
    */
    public static function getPreferencesAttributes($attribute, $field = 'texto', $plataforma = 'desktop'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');        
        $result = PreferencesUtils::getAttributes($attribute, $field, $plataforma);
        return $result;
    }
    
    /**
     * Método para obter pack relacionado a página
     * Centraliza os bundle commons para todas as páginas
     *
    */
    public static function getPageBundle($tipo, $isHotsite = false, $data = array()){
        
        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');  
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils');
        Yii::import('application.extensions.utils.special.TemplatesUtils');
        Yii::import('application.extensions.utils.special.BlocksSupportUtils');
  
        $preferencias = new MyPreferences();
        $manager = new DBManager();
        
        $result = array(); 
        $device = MethodUtils::getDevice();
        $session = MethodUtils::getSessionData();
        
        //Business Intelligence - Inbound Marketing
        if($session['id_pier'] == '' || strpos($session['id_pier'], "@") !== false){
            $id_pier = HelperUtils::inboundTracker(array('action' => 'get_pier', 'user' => '')); 
            $result['id_pp_user'] = $id_pier;
        }
        
        $setUrl = MethodUtils::setSessionData('current_url', MethodUtils::getCurrentPageURL(false, true));
        
        //Automatização de emails
        MethodUtils::getEmailAutomationParams();
       
        //Firewall
        $validation = HelperUtils::Firewall(null, false, true);
        if(!$validation) Yii::app()->controller->redirect('/');
        
        try{
        
            //Se PierTurbo estiver ativado!!!
            if(defined('Settings::PIER_TURBO') && Settings::PIER_TURBO){

                $json = file_get_contents('media/user/files/dominio_data.json');
                $data = json_decode($json, true);

                //echo MethodUtils::prettyJson($json, false);

                $result['layout'] = array('layout_site'=> $data['site_settings']['layout_site'], 'design_site' => $data['site_settings']['design_site'], 'plataform' => 'site');
                $result['menu_principal'] = $data['menu_principal'];
                if(Yii::app()->params['load_menu_3']) $result['menu_responsivo'] = $data['menu_responsivo'];

                $result['text'] = $data['paginas'][$tipo];
                $result['graphics']  = array('container_1' => $data['paginas'][$tipo]['container_1'], 'container_2' => $data['paginas'][$tipo]['container_2'], 'container_3' => $data['paginas'][$tipo]['container_3'], 'container_4' => $data['paginas'][$tipo]['container_4'], 'container_5' => $data['paginas'][$tipo]['container_5'], 'container_6' => $data['paginas'][$tipo]['container_6'], 'container_7' => $data['paginas'][$tipo]['container_7'], 'container_8' => $data['paginas'][$tipo]['container_8'], 'container_9' => $data['paginas'][$tipo]['container_9'], 'container_10' => $data['paginas'][$tipo]['container_10'], 'banner' => $data['paginas'][$tipo]['banner']);

                $result['preferences'] = $data['site_settings'];
                $result['site_data'] = $data['site_data']; //From HelperUtils::getTitleSite

                $result['isBanner'] = array('id' => $data['paginas'][$tipo]['id'], 'banner_exibe' => $data['paginas'][$tipo]['banner_exibe']);

                $result['id_app'] = $data['id_app'];
                $result['page'] = $data['paginas'][$tipo];
                //array("id" => $data['paginas'][$tipo]['id'], "layout" => $data['paginas'][$tipo]['layout'], "tipo" => $data['paginas'][$tipo]['tipo'], "controller" => $data['paginas'][$tipo]['controller'], "nome"  => $data['paginas'][$tipo]['nome'], "label" => $data['paginas'][$tipo]['label'], "action" => $data['paginas'][$tipo]['action'], "titulo" => $data['paginas'][$tipo]['titulo'], "titulo_01" => $data['paginas'][$tipo]['titulo_01'], "titulo_pagina" => $data['paginas'][$tipo]['titulo_pagina'], "modelo" => $data['paginas'][$tipo]['modelo'], "hotsite"  => $data['paginas'][$tipo]['hotsite']);;

                $result['page_prop'] = $data['paginas'][$tipo]['page_prop'];
                $result['ads'] = $data['paginas'][$tipo]['ads'];
                $result['attributes'] = $data['paginas'][$tipo]['attributes'];

                $result['plataform'] = 'site';

                //Se for pagina avançada, comum ou mix
                $result['rows'] = $data['paginas'][$tipo]['rows'];
                $setFiles = PaginasAdvancedUtils::checkNeedComplementaryFile($result['rows']);

                //Page title        
                ($data['paginas'][$tipo]['titulo_pagina'] != "") ? $result['titulo_pagina'] = $data['paginas'][$tipo]['titulo_pagina'] : $result['titulo_pagina'] = $data['site_data']['titulo'];

                //Ecommerce - getCategorias
                $result['extra'] = $data['paginas'][$tipo]['extra'];

            //Se Pier turbo não estiver ativado   
            }else{
                
                if(defined('Settings::PIER_MULTILINGUAS') && Settings::PIER_MULTILINGUAS){$tipo = HelperUtils::checkLanguageController($tipo);}
                
                $result['text'] = $manager->getText($tipo);
                if(!$result['text']) return false;
                $result['graphics']  = array("container_1" => $result['text']['container_1'], "container_2" => $result['text']['container_2'], "container_3" => $result['text']['container_3'], "container_4" => $result['text']['container_4'], "container_5" => $result['text']['container_5'], "container_6" => $result['text']['container_6'], "container_7" => $result['text']['container_7'], "container_8" => $result['text']['container_8'], "container_9" => $result['text']['container_9'], "container_10" => $result['text']['container_10'], "banner" => $result['text']['banner'], "banner_exibe" => $result['text']['banner_exibe'], "icon" => $result['text']['icon']);
                $result['plataform'] = 'site';

                $result['menu_principal'] = $manager->getMenu();
                if(Yii::app()->params['load_menu_3']) $result['menu_responsivo'] = $manager->getMenu('desktop', 'menu_responsivo');
                if(Yii::app()->params['megamenu']){$result['mega_menu'] = $manager->getMegaMenu();}                
       
                if(!$isHotsite) $result['preferences'] = $preferencias->getPreferences(Yii::app()->language, array('json' => $result['text']['json']));
                if( $isHotsite) $result['preferences'] = $preferencias->getPreferences(Yii::app()->language, array('id' => $result['text']['hotsite']));
                
                $result['id_app'] = $result['preferences']['facebook_id'];
                $result['site_data'] = $result['preferences']['json'];

                $result['page'] = array('id' => $result['text']['id'], 'layout' => $result['text']['layout'], 'tipo' => $result['text']['tipo'], 'controller' => $result['text']['controller'], 'nome' => $result['text']['nome'], 'label' => $result['text']['label'], 'action' => $result['text']['action'], 'titulo' => $result['text']['titulo'], 'titulo_01' => $result['text']['titulo_01'], 'titulo_pagina' => $result['text']['titulo_pagina'], 'modelo' => $result['text']['modelo'], 'hotsite' => $result['text']['hotsite']);
                
                $setView  = PaginasUtils::setVisit($result);

                //Banners - Ads
                if(isset($result['text']['modelo']) && $result['text']['modelo'] == 0) $result['ads'] = $manager->getBannersForPages($result['text']['id'], true);
                if(isset($result['text']['modelo']) && $result['text']['modelo'] == 2) $result['ads'] = $manager->getBannersForPages($result['text']['id'], true);
                if(isset($result['text']['modelo']) && $result['text']['modelo'] == 1) $result['ads'] = array();//Paginas avancadas
                
                if(defined('Settings::PIER_PERFILFLUTUANTE') && Settings::PIER_PERFILFLUTUANTE){$result['perfil_flutuante'] = $manager->getSpecialContent('perfil_flutuante');}

                //Componentes
                if(isset($result['text']['id']) && $result['text']['id'] != '' && !isset($data['ignore_components'])){
                    $result['rows'] = TemplatesUtils::getModuleFrontEnd($result['text']['id_template'], $result);
                    $setFiles = PaginasAdvancedUtils::checkNeedComplementaryFile($result['rows']);
                }
                
                $result['page_prop'] = PaginasUtils::getPagesSpecialProperties($result['text']['id'], $result['text']['tipo'], $result['text']['layout']);

                //Page title        
                ($result['text']['titulo_pagina'] != "") ? $result['titulo_pagina'] = $result['text']['titulo_pagina'] : $result['titulo_pagina'] = $result['site_data']['titulo'];
            }

            //Facebook login            
            if(defined('Settings::PIER_FACEBOOK') && Settings::PIER_FACEBOOK){
                Yii::import('application.extensions.dbuzz.site.redessociais.FacebookManager');
                $facebook = new FacebookManager();         
                (Yii::app()->params['ssl']) ? $ssl = "https://" : $ssl = "http://"; 
                
                if(!isset($_GET['code'])){
                    $result['facebook_login'] = $facebook->initFacebookApi($ssl . $_SERVER['SERVER_NAME'] . "/login/cadastrar"); 
                    MethodUtils::setSessionData('facebook_login', $result['facebook_login']['url']);
                    
                }else{
                    $result['facebook_login'] = '';
                }
            }
            
            $result['session'] = $session;
            
            if(defined('Settings::PIER_PUBLICIDADE_FLUTUANTE') && Settings::PIER_PUBLICIDADE_FLUTUANTE ){ if($session['banner_flutuante'] == "" && $session['banner_flutuante'] != "no_display_flutuante") MethodUtils::setSessionData('banner_flutuante', $manager->getBannerPublicidade('flutuante'));}
            if(defined('Settings::PIER_PUBLICIDADE_GLOBAL') && Settings::PIER_PUBLICIDADE_GLOBAL ){ if($session['banner_global'] == "") MethodUtils::setSessionData('banner_global', $manager->getBannerPublicidade('global'));}
            if(defined('Settings::PIER_AFILIADOS') && Settings::PIER_AFILIADOS) MethodUtils::recordParams();
            
            /* MENU ACTIVE */
            if($tipo == ''){
                $result['menu_active'] = 'home';
                $set = MethodUtils::setSessionData('menu_active', 'home');
            }else{
                if($tipo == 'showcase') $tipo = 'loja';
                $result['menu_active'] = $tipo;
                $set = MethodUtils::setSessionData('menu_active', $tipo);            
            }
            
            if($session['menu_active_support'] != ''){                
                $result['menu_active'] = $session['menu_active_support'];
                $set = MethodUtils::setSessionData('menu_active', $session['menu_active_support']); 
            }

            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getPageBundle() "  . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getPageBundle() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para obter pack relacionado a página
     * Centraliza os bundle commons para todas as páginas
     *
    */
    public static function getGaleriaItems($id_categoria, $id_galeria, $type){
        
        Yii::import('application.extensions.dbuzz.admin.GaleriaManager');
        $galeriaHandler = new GaleriaManager();
        
        $users = $galeriaHandler->getContentById($id_categoria, $id_galeria, $type);
        return $users;
        
    }
    
    /**
     * Método para organizar o breadcrumb
     *
    */
    public static function organizeBreadCrumb($data, $type){
        
        switch ($type){
            case 'ecommerce':
                Yii::import('application.extensions.utils.ProdutosUtils');
                $breadCrumb = ProdutosUtils::getBreadCrumb($data['cat_url'], $data['subcat_url'], $data['subitem_url'], $data['content']['id']);
                
                $result['bd_ecommerce'] = "loja";
                
                $result['second'] = $breadCrumb['cat_string'];
                $result['second_link'] = "/loja/" . $breadCrumb['cat_url'];
                
                if($breadCrumb['subcat_string'] != ''){
                    $result['third'] = $breadCrumb['subcat_string'];
                    $result['third_link'] = $result['second_link']. '/' . $breadCrumb['subcat_url'];
                }
                
                if($breadCrumb['subitem_string'] != ''){
                    $result['third'] = $breadCrumb['subcat_string'];
                    $result['third_link'] = $result['second_link'] . '/' . $breadCrumb['subcat_url'];
                    $result['fourth'] = $breadCrumb['subitem_string'];
                    $result['fourth_link'] = $result['third_link'] . '/' .$breadCrumb['subitem_url'];
                    
                }
                
                $result['final'] = "detalhes";
                $result['titulo_pagina'] = "";
                break;
                
            case 'eventos':
                Yii::import('application.extensions.utils.EventosUtils');
                
                $result['tipo'] = $data['page']['tipo'];
                $result['layout'] = $data['page']['layout'];
                $result['nome'] = $data['page']['nome'];
                $result['label'] = $data['page']['label'];
               
                $url = "eventos/" . EventosUtils::getIdCategoria(null, $data['evento_selecionado']['id_categoria']);
                $result['nome_url'] = $url;
                
                $result['second'] = $data['evento_selecionado']['titulo'];
                $result['second_link'] = "";
   
                
                $result['final'] = "detalhes";
               // $result['titulo_pagina'] = "";
                break;
        }
        
        if(isset($data['page']['id'])) $result['id'] = $data['page']['id'];
        return $result;
        
    }
    
    /**
     * Método para organizar os ids selecionais e adiciona-los em uma vairavel na sessão
     * de acordo com o tipo dele. Com essa variavel pode-se organizar uma query para evitar que alguns registros 
     * sejam buscados
     * 
     * @param string
     * @param string
     *
    */
    public static function organizeIdsViewed($type, $query){
        
        $session = MethodUtils::getSessionData();
        
        ($session[$type] != '') ? $queryTotal = $session[$type] . $query : $queryTotal = $query;
        $setQuery = MethodUtils::setSessionData($type, $queryTotal);
        
    }
    
    /**
     * Covert Hexadeciaml to rgb
     * 
     * @param string
     * @param string
     *
    */
    public static function hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       
       $rgb = array($r, $g, $b);
       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }
    
    /*
     * Transforma <br> para breakline \n 
     * 
     */
    public static function getBreakLine($string){
        return preg_replace('/<br(\s+)?\/?>/i', "\n", $string);
    }
    
    /*
     * StringUtils 
     * 
     * @params string
     * 
     */
    public static function stringUtils($string, $type, $data = array()){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        if($type == 'url') $result = StringUtils::StringToUrl($string, true, '-');
        if($type == 'remove_special_chars') $result = StringUtils::RemoveSpecialChar($string, false);
        if($type == 'remove_acentos') $result = StringUtils::removeAcentos($string);
        if($type == 'shorten_string') $result = StringUtils::shortenString($string, $data);
        if($type == 'format_string') $result = StringUtils::getFormatString($string, $data['type']);
        if($type == 'set_link') $result = StringUtils::setLinks($string, $data['only_urls']);
        
        return $result;
    }
    
    /*
     * DateTimeUtils 
     * 
     * @params date
     * 
     */
    public static function dateTimeUtils($date, $type, $data = array()){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        if($type == 'elapse') $result = DateTimeUtils::getTimeElapsedString($date, $data['full']);        
        
        return $result;
    }
    
    /*
     * MathUtils 
     * 
     * @params date
     * 
     */
    public static function mathUtils($type, $data = array()){
        
        Yii::import('application.extensions.utils.lib.MathUtils');
        if($type == 'percent_simple') $result = MathUtils::getPercentage($data['number'], $data['amount'], $data['decimal'], $data['is_floor'], $data['is_negative']);        
        
        return $result;
    }
    
    /*
     * AdminUtils 
     * 
     * @params string
     * 
     */
    public static function adminUtils($string, $data = array()){
        
        Yii::import('application.extensions.utils.admin.AdminUtils');      
        $result = AdminUtils::getInfo($string, $data);  
        return $result;
    }
    
    /*
     * JsonUtils, creates json files 
     * 
     * @params array
     * 
     */
    public static function jsonData($data = array()){
        
        Yii::import('application.extensions.utils.JsonUtils');        
        $result = JsonUtils::createJson($data);        
        return $result;
    }
    
    /**
     * JsonUtils, get json files
     * 
     * @params array
     * 
    **/
    public static function getJsonData($data = array()){
        
        $result = false;
        $session = MethodUtils::getSessionData();
        if($session['language_set'] != 'pt' && $session['language_apps'] != ''){$lg = "_" .$session['language_set'];}else{$lg = "";} 
        
        if(is_file($_SERVER['DOCUMENT_ROOT'] . "/media/user/files/{$data['app']}{$lg}.json")){
            $json = file_get_contents("media/user/files/{$data['app']}{$lg}.json");
            $result = json_decode($json, true);
        }
        
        return $result;
    }
    
    /*
     * 
     * Backup DB
     * 
     */
    public static function backupDb($filepath, $tables = '*'){
        
        try{
            
            if($tables == '*'){
                $tables = array();
                $tables = Yii::app()->db->schema->getTableNames();
            } else {
                $tables = is_array($tables) ? $tables : explode(',', $tables);
            }

            ini_set('max_execution_time', 300); //300 seconds = 5 minutes

            $return = '';

            foreach ($tables as $table) {

                //Ignore some tables
                if($table != 'activity_log' && $table != 'general_contador_items'){

                    $result = Yii::app()->db->createCommand('SELECT * FROM ' . $table)->query();
                    $return.= 'DROP TABLE IF EXISTS ' . $table . ';';
                    $row2 = Yii::app()->db->createCommand('SHOW CREATE TABLE ' . $table)->queryRow();
                    $return.= "\n\n" . $row2['Create Table'] . ";\n\n";
                    foreach ($result as $row) {
                        $return.= 'INSERT INTO ' . $table . ' VALUES(';
                        foreach ($row as $data) {
                            $data = addslashes($data);

                            // Updated to preg_replace to suit PHP5.3 +
                            $data = preg_replace("/\n/", "\\n", $data);
                            if (isset($data)) {
                                $return.= '"' . $data . '"';
                            } else {
                                $return.= '""';
                            }
                            $return.= ',';
                        }
                        $return = substr($return, 0, strlen($return) - 1);
                        $return.= ");\n";
                    }
                    $return.="\n\n\n";
                }
            }
            //save file
            $handle = fopen($filepath, 'w+');
            fwrite($handle, $return);
            fclose($handle);

            return $handle;
       
        }catch(Exception $ex) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - backUpDb() "  . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - backUpDb() ', 'trace' => $e->getMessage()), true);
        }
    }
    
    /* 
     * Logout 
     * 
     */
    public static function logout(){
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
        //Sets live chat to on
        Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
        $session = MethodUtils::getSessionData();
        if($session['logado_admin'] == 1) $setLiveChatON = PreferencesUtils::setPreferedItem('online_admin', 0);
        
        //Clear cookie
        $id_cookie = "PP_Login";            
        $doCookie = new CHttpCookie($id_cookie, "deslogado");
        $doCookie->expire = time() + 30;
        Yii::app()->request->cookies[$id_cookie] = $doCookie;
        
        MethodUtils::setSessionData('logado_admin', '');
        MethodUtils::setSessionData('atacadista', '');
        
        unset(Yii::app()->request->cookies['PP_Login']);

        // Limpa a sessao
        $session = new CHttpSession;
        $session->open();
        $session->clear();
        $session->destroy();
        $session->close();

        // Logout
        Yii::app()->user->logout();      
        
        $_SESSION = array();
        
        // Redireciona para a homepage do admin
        $assigned_roles = Yii::app()->authManager->getRoles(Yii::app()->user->id); //obtains all assigned roles for this user id
        if (!empty($assigned_roles)){ //checks that there are assigned roles
            $auth = Yii::app()->authManager; //initializes the authManager
            foreach($assigned_roles as $n => $role){
                if($auth->revoke($n, Yii::app()->user->id)){ //remove each assigned role for this user
                    Yii::app()->authManager->save(); //again always save the result
                }
            }
        }
        
        return true;
        
    }
    
    /*
     * LinkFy
     * 
     */
    public static function linkfy($text){
        
        $text = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<div class='video-container'><iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe></div>",$text);
        $text = preg_replace('#https?://(www\.)?vimeo\.com/(\d+)#','<div class="video-container"><iframe class="videoFrame" src="//player.vimeo.com/video/$2" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>',  $text);
        
        //$text = preg_replace('ll' ,'<iframe src="https://www.facebook.com/video/embed?video_id=" frameborder="0" height="484" width="860"></iframe>', $text);
        $text = preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target='_blank'>$3</a>", $text);  
        $text = preg_replace("/(^|[\n ])([\w]*?)((www)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target='_blank'>$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"ftp://$3\" target='_blank'>$3</a>", $text);  
        $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);       
        
        return($text);        
    }
    
    /*
     * Get domain metatag
     * 
     */
    public static function getDomainMetaData($url, $callback = false){
        
        if(strpos($url, "http") !== false){
            $sites_html = file_get_contents($url);

            $html = new DOMDocument();
            @$html->loadHTML($sites_html);
            $metatags = array();

            //Get all meta tags and loop through them.
            foreach($html->getElementsByTagName('meta') as $meta) {
                //If the property attribute of the meta tag is og:image
                if($meta->getAttribute('property') == 'og:image'){ 
                    //Assign the value from content attribute to $meta_og_img
                    $metatags['image'] = $meta->getAttribute('content');
                }

                if($meta->getAttribute('name') == 'description'){
                    $metatags['description'] = $meta->getAttribute('content');
                }
                if($meta->getAttribute('name') == 'author'){
                    $metatags['author'] = $meta->getAttribute('content');
                }
            }

            //Get all meta tags and loop through them.
            foreach($html->getElementsByTagName('title') as $title) {
                $metatags['title'] = $title->textContent;
            }

            return $metatags;
        }else{
           return $url; 
        }
    }
    
    /*
     * Metodo para obter drill data
     * 
     * @params data
     * 
     */
    public static function getData($data = array()){
        
        Yii::import('application.extensions.utils.DataUtils');        
        $result = DataUtils::getInfo($data);        
        return $result;
    }
    
    /*
     * Metodo para obter drill data
     * 
     * @params data
     * 
     */
    public static function FireWall($data = array(), $isPOST = true, $isGET = false){
        
        Yii::import('application.extensions.utils.special.FireWallUtils');        
        if($isPOST) $result = FireWallUtils::checkSecurity($data);
        if($isGET)  $result = FireWallUtils::checkURLSecurity(); 
        return $result;
    }
    
    /*
     * Método para checar qual lingua está em pauta.
     * 
     * Para utilizar o language_test, deve-se definir a lingua dentro da view veja em Admin / Users / Criar Pf
     * 
     */
    public static function checkLanguage($data = array()){
        
        $session = MethodUtils::getSessionData();
        if($session['language_set'] != '') Yii::app()->language = $session['language_set']; 
        
        if(isset($data['callback']) && $data['callback'] == 'query2'){
            if($session['language_apps'] != 'pt' && $session['language_apps'] != '0' && $session['language_apps'] != '') return " AND language = '{$session['language_apps']}' ";
            if($session['language_apps'] == 'pt' || $session['language_apps'] == '0' || $session['language_apps'] == '') return " AND (language = 'pt' OR language = '' OR language = '0') ";
        }
        
        if(isset($data['callback']) && $data['callback'] == 'query'){
            if(Yii::app()->language != 'pt') return " AND language = '" . Yii::app()->language ."' ";
            if(Yii::app()->language == 'pt') return " AND (language = 'pt' OR language = '' OR language = '0') ";
        }
        
        if(isset($data['callback']) && $data['callback'] == 'colapse'){
            if(Yii::app()->language != 'pt') return Yii::app()->language;
            if(Yii::app()->language == 'pt' || Yii::app()->language == '') return '0';
        }       
        
        if(isset($data['callback']) && $data['callback'] == 'colapse_admin'){
            if($session['language_apps'] == '') MethodUtils::setSessionData('language_apps', '0');
            return $session['language_apps'];
        } 
        
        return Yii::app()->language;
    }
    
    /*
     * Método para checar qual lingua está em pauta
     * 
     */
    public static function checkLanguageController($tipo){
        
        $session = MethodUtils::getSessionData();
        
        if($session['language_set'] != '') Yii::app()->language = $session['language_set']; 
        
        if(Yii::app()->language == 'en'){
            if($tipo == 'servicos') $tipo = 'services';
            if($tipo == 'loja') $tipo = 'store';
            if($tipo == 'showcase') $tipo = 'store';
            if($tipo == 'trabalhe_conosco' || $tipo == 'trabalheconosco') $tipo = 'work-with-us';
            if($tipo == 'sejafornecedor' || $tipo == 'seja_fornecedor') $tipo = 'be-a-supplyer';
            if($tipo == 'contato') $tipo = 'contact';
            if($tipo == 'orcamento') $tipo = 'estimate';
        }
        
        if(Yii::app()->language == 'sp'){
            if($tipo == 'servicos') $tipo = 'servicios';
            if($tipo == 'loja') $tipo = 'tienda';
            if($tipo == 'showcase') $tipo = 'tienda';
            if($tipo == 'trabalhe_conosco' || $tipo == 'trabalheconosco') $tipo = 'trabaja-con-nosotros';
            if($tipo == 'sejafornecedor' || $tipo == 'seja_fornecedor') $tipo = 'es-proveedor';
            if($tipo == 'contato') $tipo = 'contacto';
            if($tipo == 'orcamento') $tipo = 'presupuesto';
        }
           
        return $tipo;
    }
    
    /*
     * Chama Metodo
     * 
     */
    public static function checkRedirectController($page, $sub, $helper, $id){
        
        Yii::import('application.extensions.utils.special.MultiLinguasUtils');        
        $result = MultiLinguasUtils::checkRedirectController($page, $sub, $helper, $id);        
        return $result;
    }
    
    /*
     * Marketing Digital Acompanhamento
     * 
     * @params array
     * 
     */
    public static function inboundTracker($data = array()){
        
        Yii::import('application.extensions.utils.inbound.TrackerUtils');
        $result = false;

        if($data['action'] == 'get_user') $result = TrackerUtils::getUser($data);
        if($data['action'] == 'get_pier') $result = TrackerUtils::getUser($data);
        if($data['action'] == 'set_keys') $result = TrackerUtils::setKeys($data);
        return $result; 
    }
        
    /*
     * Insert image, verifica se é uma imagem padrão PurplePier
     * 
     * @params string
     * @params array
     * 
     */
    public static function insertImage($image, $data = array()){
        
        Yii::import('application.extensions.utils.special.BlocksSupportUtils');        
        return BlocksSupportUtils::insertImage($image, $data);
    }
    
    /*
     * Get anime properties dor componentes elements
     * 
     * @params string
     * @params array
     * 
     */
    public static function getAnime($componente, $animation, $data = array()){
        
        Yii::import('application.extensions.utils.special.BlocksSupportUtils');        
        return BlocksSupportUtils::getAnimeProperties($componente, $animation, $data = array());
    }
    
    /*
     * Get anime properties dor componentes elements
     * 
     * @params string
     * @params array
     * 
     */
    public static function getMandatory($data = array()){
        
        Yii::import('application.extensions.utils.special.ContaUtils');        
        return ContaUtils::mandatoryBehaviour($data);
    }
    
    /*
     * Get exclusive text, labels for localization
     * 
     * @params array
     * 
     */
    public static function t($label, $data = array()){
        
        Yii::import('application.extensions.utils.special.MultiLinguasUtils');        
        return MultiLinguasUtils::getLocalization($label, $data);
    }
    
    /*
     * Insert um item nos items visualizados no site
     * 
     * @params array
     * 
     */
    public static function setViewedItem($data = array()){
        
        $session = MethodUtils::getSessionData();
        $items = array();
        
        //$setItem = MethodUtils::setSessionData('viewed_items', '');
        //$setItem = MethodUtils::setSessionData("{$data['tipo']}_{$data['id']}", '');        
        //return true;
        
        //Se já existir um registro, não adiciona novos;
        if($session["{$data['tipo']}_{$data['id']}"] != '') return false;
        
        if($session['viewed_items'] != ''){
            $items = json_decode($session['viewed_items']);
        }
        
        $items[] = array('image' => $data['image'], 'tipo' => $data['tipo'], 'titulo' => $data['titulo'], 'chamada' => $data['chamada'], 'descricao' => $data['descricao'], 'reputation' => $data['reputation'], 'promocao' => $data['promocao'], 'promocao_string' => $data['promocao_string'], 'parcelas' => $data['parcelas'], 'preco_real_string' => $data['preco_real_string'], 'parcela_valor_string' => $data['parcela_valor_string'], 'selo' => $data['selo'], 'id' => $data['id'], 'preco_real' => $data['preco_real'], 'url' => $data['url'], 'categoria_string' => array('categoria_url' => $data['categoria_url']), 'date_end_clock' => $data['date_end_clock'], 'sob_encomenda' => $data['sob_encomenda'], 'sob_consulta' => $data['sob_consulta']);
        $item = json_encode($items);
        
        $setItem = MethodUtils::setSessionData('viewed_items', $item);
        $setView = MethodUtils::setSessionData("{$data['tipo']}_{$data['id']}", 'added');
        
        return true;
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
    public static function setFonts($id_page, $data = array()){

        

        try{
            if(isset($data['font']) && ($data['font'] != '' && $data['font'] != '0')){
                Yii::app()->getClientScript()->registerCssFile("https://fonts.googleapis.com/css?family={$data['font']}:400,600,900", 'screen', CClientScript::POS_HEAD);
                
            }else{                

                $sql = "SELECT descricao FROM activity_server WHERE (tipo = 'fonte' AND page_id = $id_page) GROUP BY descricao";
                if($id_page == "admin") $sql = "SELECT descricao FROM activity_server WHERE tipo = 'fonte' GROUP BY descricao";

                $command = Yii::app()->db->createCommand($sql);           
                $recordset = $command->queryAll(); 

                if($recordset){

                    foreach($recordset as $values){
                        if(isset($values['descricao']) && ($values['descricao'] != '' && $values['descricao'] != '0')){
                            Yii::app()->getClientScript()->registerCssFile("https://fonts.googleapis.com/css?family={$values['descricao']}", 'screen', CClientScript::POS_BEGIN);
                        }
                    }
                }
            }

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - setFonts()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - setFonts()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - setFonts()".$e->getMessage();
        }
    }
    
    /**
     * 
     * Set preferences
     *
    */
    public static function updatePrefersJson(){

        try{
            Yii::import('application.extensions.dbuzz.MyPreferences');  

            $prefer = new MyPreferences();     
            $set = $prefer->movePreferencias();
            
            return $set;

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - updatePrefersJson()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - updatePrefersJson()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - updatePrefersJson()".$e->getMessage();
        }
    }
    
    /**
     * 
     * Cripto information
     *
    */
    public static function getCripto($data = array(), $type = C::ENCRYPT, $arg = array()){

        try{
            Yii::import('application.extensions.utils.CriptoUtils');  

            if($type == C::ENCRYPT){ $data = CriptoUtils::setEnCripto($data, $arg);}
            if($type == C::DECRYPT){ $data = CriptoUtils::getDeCripto($data, $arg);}
            
            return $data;

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - getCripto()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getCripto()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - getCripto()".$e->getMessage();
        }
    }
    
    /**
     * 
     * Cripto information
     *
    */
    public static function getObiz($data = array()){

        try{
            if(!Yii::app()->params['token_pp']) return false;
            $data = array('token' => Yii::app()->params['token_pp'], 'serial' => Yii::app()->params['serialp']);
            
            return $data;

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - getCripto()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getCripto()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - getCripto()".$e->getMessage();
        }
    }
    
    /**
     * 
     * WhatsApp Url
     *
    */
    public static function getWhatsAppUrl(){

        try{
            // Fix Api Whatsapp on Desktops
            // Dev: Jean Livino
            $session = MethodUtils::getSessionData();
            
            if($session['whatsapp_url'] != '') return $session['whatsapp_url'];
            
            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

            // check if is a mobile
            if($iphone || $android || $palmpre || $ipod || $berry == true){$wts = "https://api.whatsapp.com";}else{$wts = "https://web.whatsapp.com";}
            
            MethodUtils::setSessionData("whatsapp_url", $wts);
            return $wts;

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - getWhatsAppUrl()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - getWhatsAppUrl()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - getWhatsAppUrl()".$e->getMessage();
        }
    }
    
    /**
     * 
     * Check se exits parametro definido
     *
    */
    public static function checkParams($data = array()){

        try{
            
            if(isset($data['param'])){
                if(Yii::app()->params[$data['param']]){ 
                    $result = Yii::app()->params[$data['param']];
                }else{
                    $result = $data['result'];
                }
            }
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - checkParams()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - checkParams()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - checkParams()".$e->getMessage();
        }
    }
    
    /**
     * 
     * Check se exits parametro definido
     *
    */
    public static function setBn($data = array()){
        
        Yii::import('application.extensions.utils.special.BannerElementsUtils');  
        
        try{
            return BannerElementsUtils::setBnAttrs($data);

        }catch(CDbException $e){
            Yii::trace("ERROR HelperUtils - setBn()" . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - HelperUtils - setBn()', 'trace' => $e->getMessage()), true);
            echo "ERROR HelperUtils - setBn()".$e->getMessage();
        }
    }
}
?>