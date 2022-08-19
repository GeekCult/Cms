<?php

/**
 * Description of PaginasUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class PaginasAdvancedUtils {

    
    /**
     * Método para submeter os dados da pagina
     *
     * @param string image
     * @param array slot
     *
     */
    public static function applyComponent($data){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        
        if($data['action'] == 'novo'){ 
            $sql =  "INSERT INTO paginas_rows (id_page, id_componente, layout, slots, n_index, titulo, tipo, cool, exibe) VALUES (".$data['id_pagina'] .", ". $data['id_componente'].", '". $data['layout']."', ". $data['slots'].", ". $data['n_index'].", '". $data['info']['titulo']."', '". $data['info']['modelo']."', '". $data['info']['cool'] . "', 1)";
        }else{
            $sql =  "UPDATE paginas_rows SET $tipo = '$value' WHERE id_pagina = $id AND name = '$name'";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            
            //Set ping activity               
            $purplePierManager = new PurplePierManager();
            $ping = array('titulo' => $data['info']['titulo'], 'descricao' => $data['id_componente'], 'tipo' => 'compra_purplestore', 'plataforma' => 'desktop');
            if($data['action'] == 'novo') $setPing = $purplePierManager->setPing($ping);
            
            return $control;
            

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasAdvancedUtils - applyComponent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os dados do componente
     *
     * @param number id
     *
    */
    public static function getTemplateBlock($id, $type = 'bloco_pagina', $isAll = false){

        $select = "id, titulo, descricao, modelo, tipo, cool, thumb";
        
        if(!$isAll) $sql = "SELECT ".$select." FROM conteudo_templates WHERE id = $id";
        if( $isAll) $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = '$type'";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            if(!$isAll) $recordset = $command->queryRow();
            if( $isAll) $recordset = $command->queryAll();
            
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getTemplateBlock() " .$e->getMessage();
        }
    }
    
    
    /**
     * Método para deletar um determinado registro
     *
     * @param array
     *
    */
    public static function deleteContent($id){

        $sql = "DELETE FROM paginas_rows WHERE id = $id";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para deletar um determinado registro
     *
     * @param array
     *
    */
    public static function updateRow($id, $value, $type){
        
        if($type == 'status'){ $field = 'exibe'; $value = MethodUtils::getBooleanNumber($value); }
        if($type == 'indice'){ $field = 'n_index'; }

        $sql = "UPDATE paginas_rows SET $field = $value WHERE id = $id";

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
     * Método para recuperar a edição do bloco
     *
     * @param number id
     *
    */
    public static function getItemContent($id){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');

        $select = "id, id_page, id_componente, tipo, titulo, n_index";        
        $sql = "SELECT $select FROM paginas_rows WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset) $recordset['content'] = BlocksUtils::getViewProperties($recordset);
            //var_dump($recordset);
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getItemContent() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os blocos de acordo com a row passado
     *
     * @param number id
     *
    */
    public static function getViewContent($id, $isLoremYsum = false){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');

        $select = "id, id_page, id_componente, tipo, titulo, n_index, cool";        
        
        $sql = "SELECT ".$select." FROM paginas_rows WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $recordset['info'] = PaginasAdvancedUtils::getTemplateBlock($recordset['id_componente']);
                
                //$recordset[$i]['info'] = array('modelo' => $recordset[$i]['tipo'], 'cool' => $recordset[$i]['cool']);
                $recordset['content'] = BlocksUtils::getViewProperties($recordset, $isLoremYsum);
                $recordset['view'] = $this->controller->renderPartial('/site/modulos/' . $recordset['content']['url'] . $recordset['info']['modelo'] . '/' .$recordset['info']['cool'], $recordset['content'], true);
                if(isset($recordset['content']['js'])) PaginasAdvancedUtils::addScript($recordset['content']['js']);
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getItemContent() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os blocos de acordo com a pagina
     *
     * @param number id
     * @param array
     *
    */
    public static function getModule($id_page, $info_page = array()){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');

        $select = "id, id_page, id_componente, tipo, titulo, n_index, tipo, json";        
        
        $sql = "SELECT ".$select." FROM paginas_rows WHERE id_page = $id_page AND exibe = 1 ORDER BY n_index ASC";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['info'] = PaginasAdvancedUtils::getTemplateBlock($recordset[$i]['id_componente']);
                    $recordset[$i]['content'] = BlocksUtils::getViewProperties($recordset[$i]);
                    $recordset[$i]['content']['page_info'] = $info_page;
                    if(isset($recordset[$i]['content']['js'])){ PaginasAdvancedUtils::addScript($recordset[$i]['content']['js']);}
                    
                    if($recordset[$i]['tipo'] == 'topo' && ($info_page['page']['hotsite'] != 0 && $info_page['page']['hotsite'] != '')) $recordset[$i]['content']['menu'] = PaginasAdvancedUtils::getMenuContent($info_page['page']['hotsite']);
                }
               
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getModule() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os blocos para a freente do site
     *
     * @param number id
     * @param array
     *
    */
    public static function getModuleFrontEnd($id_page, $info_page = array()){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');

        $select = "id, id_page, id_componente, tipo, titulo, n_index, tipo, cool, json";       
        $sql = "SELECT $select FROM paginas_rows WHERE id_page = $id_page AND exibe = 1 ORDER BY n_index ASC";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
       
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['info'] = array('modelo' => $recordset[$i]['tipo'], 'tipo' => $recordset[$i]['tipo'], 'cool' => $recordset[$i]['cool'], 'id_page' => $id_page, 'id_componente' => $recordset[$i]['id_componente'], 'id_row' => $recordset[$i]['id']);
                    $recordset[$i]['content'] = json_decode($recordset[$i]['json'], true);
                    
                    (isset($recordset[$i]['content'])) ? $info = array_merge($recordset[$i]['info'], $recordset[$i]['content']) : $info = $recordset[$i]['info'];
                
                    //More content
                    $more_content = PaginasAdvancedUtils::getViewPropertiesFrontEnd($info);
                    if(isset($recordset[$i]['content']) && $more_content) $recordset[$i]['content'] = array_merge($recordset[$i]['content'], $more_content);
                    
                    $recordset[$i]['content']['page_info'] = $info_page;
                    
                    //if($recordset[$i]['tipo'] == 'topo' && ($info_page['page']['hotsite'] != 0 && $info_page['page']['hotsite'] != '')) $recordset[$i]['content']['menu'] = PaginasAdvancedUtils::getMenuContent($info_page['page']['hotsite']);
                }
               
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getModuleHome() " .$e->getMessage();
        }
    }
    
    /**
     * Método para obter os items do menu
     *
     * @param string image
     * @param array slot
     *
     */
    public static function getMenuContent($id){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        try{
            //Get the last record
            $sql = "SELECT id, nome, label, icon, action, controller, link_special FROM paginas_data WHERE hotsite = $id";

            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryAll();

            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['icon'] = GraphicsUtils::getCoolContent($recordset[$i]['icon']);
                }
            }

            return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasAdvancedUtils - getMenuContent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter as informações do componente via FrontEnd
     *
     * @param string
     *
    */
    public static function getViewPropertiesFrontEnd($data, $isLoremYpsum = false){
        
        $result = array();
        try{
           
            switch($data['tipo']){
                
                case 'noticias':
                case 'novidades':
                case 'dicas':
                    
                    Yii::import('application.extensions.dbuzz.admin.MateriasManager');
                    $materiasHandler = new MateriasManager();  
                    
                    $result['materias'] = $materiasHandler->getLimitedContent($data['tipo'], (isset($data['comecar_em']) && $data['comecar_em'] != '') ? $data['comecar_em'] : 0, (isset($data['qtd_items']) && $data['qtd_items'] != '') ? $data['qtd_items'] : 10);             
                    break;
                
                case 'banners':
                case 'publicidade_dirigida':   
                    Yii::import('application.extensions.dbuzz.DBManager');
                    $dbManager = new DBManager();
                    
                    if(!isset($data['order_by'])) $data['order_by'] = '';
                    (isset($data['modelo_banner']) && $data['modelo_banner'] != '') ? $modelo = " AND size = '{$data['modelo_banner']}'" : $modelo = '';
                    $result['banners'] = $dbManager->getBannersForPages($data['id_page'], true, $data['order_by'], $modelo);                  
                    break;
                
                case 'ecommerce': 
                    Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');        
                    $produtosHandler = new ProdutosManager();

                    $result['categorias_ecommerce'] = $produtosHandler->getAllContentPrincipal();                 
                    break;
                
                case 'produtos':
                    Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');
                    $produtosHandler = new ProdutosManager();
                    
                    if(isset($data['galeria']) && ($data['galeria'] == 0 || $data['galeria'] == '')) $result['vitrine'] = $produtosHandler->getContentByIdAttribute('vitrine');
                    
                    if($data['tipo_uso'] == 'auto'){
                        $result['vitrine'] = $produtosHandler->getContentByIdAttribute('vitrine', $data['tipo_uso']);                        
                    }
                    
                    if(isset($data['galeria']) && $data['galeria'] != 0){
                        if($data['tipo_uso'] == 'produtos') $result['produtos'] = $produtosHandler->getContentByIdType($data['galeria'], 'categoria');                        
                    }
                    break;
                
                case 'folha_pedidos':
                    Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');
                    $produtosHandler = new ProdutosManager();
        
                    $result['items'] = $produtosHandler->getContentByIdType(null, 'ordem_servico');  
                    break;
                
                case 'eventos':
                    Yii::import('application.extensions.dbuzz.admin.EventosManager');
                    $eventosHandler = new EventosManager();
                    
                    $result['eventos'] = $eventosHandler->getLastContentLimited($data['qtd_items_query'], 0);
                    break;
                
                case 'users':
                case 'galeria':
                case 'promocao':
                    //TODO Don't touch
                   
                    Yii::import('application.extensions.dbuzz.admin.GaleriaManager');                    
                    $galeriaHandler = new GaleriaManager();
                    
                    if(!isset($data['galeria'])) $data['galeria'] = 0;
                    $arrUser = explode('-', $data['galeria']);
         
                    if($data['tipo'] == 'users'){ 
                        Yii::import('application.extensions.utils.users.UserUtils');
                        Yii::import('application.extensions.utils.users.UserSupportUtils');
                        
                        if(isset($data['categoria_galeria'])) $tipo = $data['categoria_galeria']; else $tipo = 1;
                            
                        if(isset($arrUser[0]) && isset($arrUser[1])){
                            $result['users'] = $galeriaHandler->getContentById($arrUser[0], $arrUser[1], 'users');

                            if($result['users']) {
                                for($p = 0; $p < count($result['users']); $p++){
                                    $result['users'][$p]['dados'] = UserUtils::getUserFullById($result['users'][$p]['id_graphic']);
                                    if($tipo == 2) $result['users'][$p]['profissional'] = UserSupportUtils::getUserDetailsByTag('profissional', $result['users'][$p]['id_graphic']);
                                    if($tipo == 1){ $result['users'][$p]['cliente'] = UserSupportUtils::getUserDetailsByTag('cliente', $result['users'][$p]['id_graphic']);}
                                }
                            }
                        }
                        
                        if(isset($arrUser[0]) && !isset($arrUser[1])){
                           $result['users'] = UserUtils::getAllKindUsers(" AND name= 'cliente' LIMIT 10", false, 'cliente');
                           $result['is_user'] = true;
                        }
                    }
                   
                    if($data['tipo'] == 'galeria'){
                        
                        if(isset($arrUser[0]) && isset($arrUser[1])){
                            $result['content'] = $galeriaHandler->getAllAllowedContent($arrUser[0], $arrUser[1], true, 'foto', false, true);
                           // $result['galeria'] = $galeriaHander->getContentById($arrUser[0], $arrUser[1], 'galeria');
                        }
                    }  
                    
                    /*
                    if($data['tipo'] == 'promocao'){
                        Yii::import('application.extensions.dbuzz.site.special.PromocaoManager');                    
                        $promocaoHandler = new PromocaoManager();                        
                        if($data['galeria'] != '') $result['content'] = $promocaoHandler->getContentById($data['galeria']);
                    } 
                    */
                    break;
                    
                case 'publicidade_online':
                case 'revistas':
                case 'revista':
                    
                    //Publicidade Online
                    if($data['tipo'] == 'publicidade_online'){
                        Yii::import('application.extensions.dbuzz.site.buscar.RelevanceManager');
                        $relevanceHandler = new RelevanceManager();

                        $session = MethodUtils::getSessionData();
                        $type = $data['modelo_banner']; $qtd = 4; $id = null;

                        $result['anuncios'] = $relevanceHandler->getAllBannersRecommended($id, $session['keywords'], $type, $type, $qtd, true); 
                    }
                    
                    //Revistas
                    if($data['tipo'] == 'revistas'){
                        Yii::import('application.extensions.dbuzz.admin.special.RevistaManager');
                        $revistasHandler = new RevistaManager();

                        $result['revistas'] = $revistasHandler->getAllContentLimited(10, true);
                    }
                    
                    //Revista
                    if($data['tipo'] == 'revista'){                        
                        
                        Yii::import('application.extensions.dbuzz.admin.special.RevistaManager');
                        Yii::import('application.extensions.utils.special.TemplatesUtils');
                        $revistasHandler = new RevistaManager();
                        
                        if(!isset($data['galeria']) || $data['galeria'] == '') $data['galeria'] = 0;
                       
                        $result['revista'] = $revistasHandler->getTemplateById($data['galeria']);
                        //Get components for template
                        isset($result['revista']['id']) ? $result['componentes'] = TemplatesUtils::getModule($result['revista']['id'], $result['revista']) : $result['componentes'] = false;
                                                 
                    }
                    
                    break;
                    
                //Tabelas
                case "tabela":                       
                    //Get items from paginas_items
                    $result['table'] = PaginasAdvancedUtils::getItemsAttributes($data['id_componente'], $data['id_row'], $data['id_page']);                                                 
                    break;
                
                case 'combo':
                    Yii::import('application.extensions.utils.admin.ComboComponentsUtils');
                    $result['combo'] = ComboComponentsUtils::getRecords($data); 
                    break;
                
                //Videos
                case 'videos':                    
                                    
                    Yii::import('application.extensions.dbuzz.admin.VideosManager');
                    $videosHandler = new VideosManager();

                    $qtd = $data['qtd_items_query'];
                    $query = "";  $limit = "LIMIT $qtd";
                    $result['videos'] = $videosHandler->getVideos($query, $limit);
                    
                //Redes Sociais
                case 'redes_sociais':                    
                                    
                    Yii::import('application.extensions.dbuzz.site.redessociais.FacebookManager');
                    Yii::import('application.extensions.dbuzz.site.redessociais.TwitterManager');
                    Yii::import('application.extensions.vendors.google.GoogleManager');
                    $facebookHandler = new FacebookManager();
                    $googleHandler = new GoogleManager();
                    $twitterHandler = new TwitterManager();

                    $result['redes_sociais']['facebook'] = $facebookHandler->getLastPosts();
                    $result['redes_sociais']['google_plus'] = $googleHandler->getLastPosts();
                    $result['redes_sociais']['twitter'] = $twitterHandler->getLastPosts();
                    
                //Autos
                case 'autos':                    
                    Yii::import('application.extensions.dbuzz.site.special.AutosManager');       
                    $autosHandler = new AutosManager();
                    
                    $result['categorias'] = $autosHandler->getMenu();
                    $result['fabricantes'] = $autosHandler->getAllFabricantes();
                    $result['modelo_veiculos'] = $autosHandler->getModelos();
                
                default:
                    //return array();
                    break;
            }
            
            return $result;
            
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasAdvancedUtils - getViewPropertiesFrontEnd() " . $e->getMessage();
        }
    }
    
    /*
     * Insert new files if needed
     * 
     * @param array
     * 
     */
    public static function checkNeedComplementaryFile($rows){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $revista = $reservas = $publicidade_online = false; $modernizr = false; $toucheffects = false; $elpaso = false; $css_hover = false;
        $artigo_chalotte = false; $scrool_animation = false; $artigo_laredo = false; $contato_sanantonio = false; $madagascar = false;
        $registro_connecticut = false;
       
        if($rows){
            foreach($rows as $values){
                if($values['tipo'] == 'revista' && !$revista){
                    $cs->registerCssFile($baseUrl . '/css/lib/flipbook/jquery.jscrollpane.custom.css', 'screen', CClientScript::POS_HEAD);
                    $cs->registerCssFile($baseUrl . '/css/lib/flipbook/bookblock.css', 'screen', CClientScript::POS_HEAD);
                    $cs->registerCssFile($baseUrl . '/css/lib/flipbook/custom2.css', 'screen', CClientScript::POS_HEAD);

                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/modernizr.custom.79639.js', CClientScript::POS_HEAD);

                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.mousewheel.js', CClientScript::POS_END);
                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.jscrollpane.min.js', CClientScript::POS_END);
                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquerypp.custom.js', CClientScript::POS_END);
                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.bookblock.js', CClientScript::POS_END);
                    $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/page.js', CClientScript::POS_END);
                    $revista = true;
                }
                
                if($values['tipo'] == 'reservas' && !$reservas){
                    $cs->registerScriptFile($baseUrl . '/js/lib/timepicker/jquery.ui.timepicker.js', CClientScript::POS_END);
                    $cs->registerScriptFile($baseUrl . '/js/modulos/special/reservas.js', CClientScript::POS_END);
                    $reservas = true;
                }             
               
                if($values['cool'] == 'el_paso' && !$elpaso || $values['cool'] == 'artigo_brooklyn' && !$elpaso){
                    //$cs->registerCssFile($baseUrl . '/css/site/modulos/publicidade/publicidade_online.css', 'screen', CClientScript::POS_HEAD);
                    if(!$modernizr){$cs->registerScriptFile($baseUrl . '/js/lib/modernizr.custom.js', CClientScript::POS_END); $modernizr = true;}
                    if(!$toucheffects){$cs->registerScriptFile($baseUrl . '/js/modulos/publicidade/toucheffects.js', CClientScript::POS_END); $toucheffects = true;}
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/publicidade/el_paso.css', 'screen', CClientScript::POS_HEAD); 
                    $elpaso = true;
                }
                
                if($values['cool'] == 'texas_hold' && !$css_hover){
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/artigo/css_hover.css', 'screen', CClientScript::POS_HEAD); 
                    $css_hover = true;
                }
                
                if($values['cool'] == 'registros_connecticut' || $values['cool'] == 'registros_iwoa' || $values['cool'] == 'busca_siliconvalley' && !$registro_connecticut){
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/artigo/registros.css', 'screen', CClientScript::POS_HEAD); 
                    $registro_connecticut = true;
                }    
                
                 if($values['cool'] == 'materia_maine' && !$madagascar){
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/materias/novidades/madagascar.css', 'screen', CClientScript::POS_HEAD); 
                    $madagascar = true;
                } 
                
                if($values['cool'] == 'artigo_charlotte' && !$artigo_chalotte){
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/artigo/artigo_charlotte.css', 'screen', CClientScript::POS_HEAD); 
                    $cs->registerScriptFile($baseUrl . '/js/modulos/artigos/artigo_charlotte.js', CClientScript::POS_END);
                    $artigo_chalotte = true;
                }
                
                if($values['cool'] == 'contato_sanantonio' && !$contato_sanantonio){
                    $cs->registerScriptFile($baseUrl . '/js/modulos/artigos/artigo_contato.js', CClientScript::POS_END);
                    $contato_sanantonio = true;
                }
                
                if($values['cool'] == 'artigo_laredo' && !$artigo_laredo){
                    $cs->registerCssFile($baseUrl . '/css/site/modulos/artigo/artigo_laredo.css', 'screen', CClientScript::POS_HEAD); 
                    $cs->registerScriptFile($baseUrl . '/js/modulos/artigos/artigo_laredo.js', CClientScript::POS_END);
                    $artigo_laredo = true;
                }
                
                if($values['cool'] == 'artigo_coral_springs' && !$scrool_animation){
                    $cs->registerScriptFile($baseUrl . '/js/modulos/special/scrollpage_animation.js', CClientScript::POS_END);
                    $scrool_animation = true;
                }
            }
        }
    }
    
    /*
     * Get items form paginas_attributes
     * 
     * @param number
     * 
     */
    public static function getItemsAttributes($id_componente, $id_row, $id_page){
        
        try{
            //Get the last record
            $sql = "SELECT * FROM paginas_items WHERE id_componente = $id_componente AND id_row = $id_row AND id_pagina = $id_page ORDER BY n_index ASC";

            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryAll();

            return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasAdvancedUtils - getItemsAttributes() ' . $e->getMessage();
        }
    }
    
    /*
     * Get items form paginas_attributes
     * 
     * @param number
     * 
     */
    public static function getItemAttribute($id){
        
        try{
            $sql = "SELECT * FROM paginas_items WHERE id = $id";

            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryRow();

            return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasAdvancedUtils - getItemAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     * @param string
     * @param array
     *
     */
    public static function addScript($js){
        //Funcionalidades de components html
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/modulos/special/' . $js, CClientScript::POS_END); 
    }
 
}
?>
