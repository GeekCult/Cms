<?php
/*
 * This Class is used to set and retrieve user Atributes
 * @author CarlosGarcia
 *
 * Data: 06/01/2011
 */

class DBManager{
    
    private $isAdmin;

    /**
     *
     * Desktop, Tablets, Mobile
     *
     * Método para incluir os css necessários para montar o layout
     *
     * Repare que existe um layout para o site e um outro para a página
     * Os layouts são aplicados via comando Javascript
     *
     */
    public function getLayout(){

        $select = "design_site, layout_site, layout_home ";
        $sql = "SELECT ".$select." FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();
            $recordset['plataform'] = "site";

            return $recordset;

        }catch(CDbException $e){
            echo 'ERROR: DBManager getLayout() - ' . $e->getMessage();
        }        
    }

    /*
     * Método para recuperar os dados do menu
     *
     *
    */
    public function getMenu($tipo = "desktop", $menu = 'menu_principal', $sql = ''){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');

        $select = "id, nome, layout, label, controller, action, main_for_group, id_categoria, link_special";
        $sql = "SELECT ".$select." FROM paginas_data WHERE plataforma = '$tipo' AND ( $menu = 1 AND nome != 'Intro' AND (id_user = 0)) $sql ORDER BY n_index ASC ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                
                if(defined('Settings::MENU_PRINCIPAL') && (Settings::MENU_PRINCIPAL == 'menu_responsivo' || Settings::MENU_PRINCIPAL == '')){
  
                    for($i = 0; $i < count($recordset); $i++){
                        if($recordset[$i]['main_for_group'] && $recordset[$i]['id_categoria'] != 0 && $menu == 'menu_principal') {                        
                            $recordset[$i]['more'] = PaginasUtils::getMenuContent(null, $recordset[$i]['id_categoria']);
                            $recordset[$i]['products'] = ProdutosUtils::getMenuContent($recordset[$i]['id_categoria']);
                        }else{
                            $recordset[$i]['more'] = array();
                        }
                    }
                }
                
                if(defined('Settings::MENU_PRINCIPAL') && Settings::MENU_PRINCIPAL == 'menu_mega'){
                    
                    for($i = 0; $i < count($recordset); $i++){
                        if($recordset[$i]['main_for_group'] && $menu == 'menu_principal'){ 
                            $galeria_usuarios = PaginasUtils::getAttributes($recordset[$i]['id'], "galeria_usuarios", "texto", false);
                            if($galeria_usuarios != '') $recordset[$i]['more'] = PaginasUtils::getMenuSpecialContent($galeria_usuarios);
                            if($galeria_usuarios == '' && $recordset[$i]['id_categoria'] != 0) $recordset[$i]['more'] = PaginasUtils::getMenuContent(null, $recordset[$i]['id_categoria']);
                            if($galeria_usuarios == '' && $recordset[$i]['id_categoria'] == 0) $recordset[$i]['more'] = array();
                            
                        }else{
                            $recordset[$i]['more'] = array();
                        }
                    }
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getMenu() - ' . $e->getMessage();
        }
    }
   
    
    /*
     * Método para recuperar os dados do menu
     *
     * @param string
    */
    public function getBannerMainShow($controller = "home"){

        $sql = "SELECT id, banner_exibe FROM paginas_data WHERE nome = '$controller'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getBannerMainShow() - ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getText($page){
        
        $this->isAdmin = Yii::app()->controller->id;
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.ModulesUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        $select = "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06, ".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06, ".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06, ".
                  "link_01, link_02, link_03, link_04, link_05, link_06, keywords,".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06, id, " .
                  "network_exibe, dica_exibe, breadcrumb_exibe, views";

        $sql = "SELECT ".$select." FROM paginas_data WHERE nome = '$page'";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            //Applies a special content and/or styled comment
            if($recordset['texto_01'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_01'] = ModulesUtils::defineComment($recordset['texto_01']);
                if($this->isAdmin != 'admin') $recordset['texto_01'] = ModulesUtils::getModule($recordset['texto_01']);
            }
            
            if($recordset['texto_02'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_02'] = ModulesUtils::defineComment($recordset['texto_02']);
                if($this->isAdmin != 'admin') $recordset['texto_02'] = ModulesUtils::getModule ($recordset['texto_02']);
            }
            
            if($recordset['texto_03'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_03'] = ModulesUtils::defineComment($recordset['texto_03']);
                if($this->isAdmin != 'admin') $recordset['texto_03'] = ModulesUtils::getModule($recordset['texto_03']);
            }
            
            if($recordset['texto_04'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_04'] = ModulesUtils::defineComment($recordset['texto_04']);
                if($this->isAdmin != 'admin') $recordset['texto_04'] = ModulesUtils::getModule($recordset['texto_04']);
            }
            
            if($recordset['texto_05'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_05'] = ModulesUtils::defineComment($recordset['texto_05']);
                if($this->isAdmin != 'admin') $recordset['texto_05'] = ModulesUtils::getModule($recordset['texto_05']);
            }
            
            if($recordset['texto_06'] != ""){
                if($this->isAdmin != 'admin') $recordset['texto_06'] = ModulesUtils::defineComment($recordset['texto_06']);   
                if($this->isAdmin != 'admin') $recordset['texto_06'] = ModulesUtils::getModule($recordset['texto_06']);
            }
            
            $recordset['attributes'] = PaginasUtils::retrieveAttributes($recordset['id'], true);
            
            if(isset($recordset['keywords'])) $recordset['tags'] = StringUtils::transFormStringToArray($recordset['keywords']);
            
            //Facebook Application ID
            $recordset['id_app'] = PreferencesUtils::getAttributes("id_app_fb", "texto");
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getText() - ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar o layout
     * Esta classe é similar a classe ControllerManager
     * Quando alterar aqui, altere também lá!
     *
     * @param string page
     *
    */
    public function getController($page, $isID = null){

        $select = "id, layout, tipo, controller, nome, label, action, titulo, titulo_01, titulo_pagina, modelo, hotsite";
        $sql = "SELECT ".$select." FROM paginas_data WHERE nome = '$page' AND minisite = 0";
        if($isID != null) $sql = "SELECT ".$select." FROM paginas_data WHERE id = $isID AND minisite = 0";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $setSession = MethodUtils::setSessionData('menu_active', $page);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getController() - ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getGraphics($page){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');

        $select = "container_1, container_2, container_3, container_4, container_5, " .
                  "container_6, container_7, container_8, container_9, container_10, banner";

        $sql = "SELECT ".$select." FROM paginas_data WHERE nome = '$page'";


        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            //Containers
            for($i = 1; $i <= 10; $i++){
                if($recordset['container_' . $i] != null || $recordset['container_' . $i] != ""){                
                    $type = explode("_", $recordset['container_' . $i]);
                  
                    switch($type[0]){
                        
                        case "b":
                            $recordset['container_' . $i] = GraphicsHelperUtils::getBanner($type[1]);
                            $recordset['container_' . $i]['slot_type'] = $type[0];
                            break;
                        
                        case "f":
                            $recordset['container_' . $i] = GraphicsHelperUtils::getPhotos($type[1]);
                            $recordset['container_' . $i]['slot_type'] = $type[0];
                            break;
                        
                        case "h":
                            $recordset['container_' . $i] = GraphicsHelperUtils::getHtmlBanners($type[1], $type[0]);
                            break;
                        
                        case "e":
                            $recordset['container_' . $i] = GraphicsHelperUtils::getEmbededImages($type[1]);
                            break;
                    }
                }
            }

            //Banner
            if($recordset['banner'] != null || $recordset['banner'] != ""){

                $type = explode("_", $recordset['banner']);

                if($type[0] == "b"){
                    $recordset['banner'] = GraphicsHelperUtils::getBanner($type[1]);
                    $recordset['banner']['slot_type'] = $type[0];
                }else{
                    $recordset['banner'] = GraphicsHelperUtils::getPhotos($type[1]);
                    $recordset['banner']['slot_type'] = $type[0];
                }
            }

            return $recordset;
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getGraphics() - ' . $e->getMessage();
        }
    }
    
    /**
     * Método para pegar os banner
     *
     * @param number id
     *
    */
    public function getBanner($id){
 
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "cor, cool, altura, largura, modelo, image";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset)$recordset['cool2'] = BannersUtils::getBannersItems($recordset['id']);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getBanner() - ' .$e->getMessage();
        }
    }
    
    /**
     * Método para pegar os banner que serão exibidos na pagina
     *
     * @param number
     *
    */
    public function getBannersForPages($id_page, $isAdvanced = false, $order_by = 'n_index', $modelo = ''){
 
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.dbuzz.admin.ExtremosManager');  
        
        
        //If the arguments were storaged previously in session return then
        //$session = MethodUtils::getSessionData();
        //if($session['SES_ADS_'.$id_page] != ''){
            //$set = BannersUtils::runPageViewsSession($session['SES_ADS_' . $id_page], $id_page);
            //return $session['SES_ADS_' . $id_page];
        //}
        
        $bannersHandler = new ExtremosManager();
        
        if($order_by == 'n_index' || $order_by == '') $sql = "SELECT id, banner_id, page_id, size FROM banners_attribute WHERE page_id = $id_page $modelo ORDER BY n_index ASC";
        if($order_by == 'random') $sql = "SELECT id, banner_id, page_id, size FROM banners_attribute WHERE page_id = $id_page $modelo ORDER BY RAND()";
 
        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if($recordset){
                for($i = 0; $i < count($recordset); $i++){  
                    $recordset[$i]['info'] = $bannersHandler->getContent($recordset[$i]['banner_id'], $isAdvanced);
                    if(!$isAdvanced) $recordset[$i]['cool2'] = BannersUtils::getBannersItems($recordset[$i]['banner_id']);
                    $controllerBanner = BannersUtils::setPageViews($recordset[$i]['id'], $recordset[$i]['info']['lance'], $recordset[$i]['info']['creditos'], $recordset[$i]['info']['page_views']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getBannersForPages() - ' .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os módulos
     *
     * @param number
     *
    */
    public function getModules($id_page){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
          
        $select = "id, id_page, layout, n_index";
        $sql = "SELECT ".$select." FROM paginas_rows WHERE id_page = $id_page";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['modulo'] = PaginasUtils::getModule($recordset[$i]['id']);
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            'ERROR: DBManager getModules() - ' .$e->getMessage();
        }
    }

    
    /**
     * Método para pegar as fotos
     *
     * @param number id
     *
    */
    public function getPhotos($id){

        $select = "titulo, foto";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE id = '$id'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getPhotos() - ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as informações que 
     * serão exibidas na página de home se
     * o site estiver em construção, manutenço e etc.
     *
     * @param string page
     *
    */
    public function getIntro(){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.admin.TexturasUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');        
              

        try{
            //$json = file_get_contents('media/user/files/dominio_data.json');
            if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;
            $json = file_get_contents('media/user/files/minisite_settings.json');

            $data = json_decode($json, true);
            
            
            //Get logo            
            $recordset['layout']['textura_intro'] = '//www.purplepier.com.br/media/images/textures/intro/intro_purplepier.jpg';
            
            $recordset['site_release'] = $data['site_settings']['site_release'];
            $recordset['logo'] = "";
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DBManager getIntro() - ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar obter alguns recursos extras dependendo da
     * view selecionado
     *
     * @param string view
     *
    */
    public function getExtraResources($layout){
        
        $recordset = array();
        try{
            switch ($layout){
                case 'home_categorias_ecommerce':
                    $isCategoriaHome = HelperUtils::getPreferencesAttributes('categorias_home', 'inteiro');
                    if($isCategoriaHome){
                        Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');        
                        $produtosHandler = new ProdutosManager();

                        $recordset['categorias_ecommerce'] = $produtosHandler->getAllContentPrincipal();
                        $recordset['categorias_home_layout'] = HelperUtils::getPreferencesAttributes('categoria_home_layout', 'texto');
                    }
                    break;
            }
            

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: DBManager - getExtraResources() ".$e->getMessage();
        }
    }

}
?>