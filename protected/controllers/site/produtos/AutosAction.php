<?php

class AutosAction extends CAction{

    private $autosHandler;
    private $controllerIDHandler;
    private $categorias;  
    private $action;
    private $subitem;
    private $cat;
    private $sub;
    private $valida;
    private $id;
    private $nr_page;

    public function run(){
        
        Yii::import('application.extensions.dbuzz.site.special.AutosManager');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.utils.admin.PrefencesUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');        
        Yii::import('application.extensions.utils.ProdutosUtils');        
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.StoreUtils');

        $this->autosHandler = new AutosManager();
        $this->categorias = new CategoriaManager();
        $this->controllerIDHandler = new PaginasManager();
        
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        $this->cat = Yii::app()->getRequest()->getQuery('cat');
        $this->sub = Yii::app()->getRequest()->getQuery('sub');
        $this->subitem = Yii::app()->getRequest()->getQuery('subitem');

        switch($this->action){

            case "listar":
            case "":
                $this->listar();
                break;

            case "detalhes":
                $this->detalhes($this->id);
                break;

            case "obter_produtos":
                $this->obterProdutos();
                break;
            
            case "load_modelos":
                $this->loadModelos();
                break;
            
            case "search_autos":
                $this->buscarAutos();
                break;
            
            case "cotacao":
                $this->cotacao();
                break;
            
            default:
                //Url friendly
                $url_friendly = StoreUtils::getUrlFriendly($this->action);
                if(isset($url_friendly['id'])){
                    $this->detalhes($url_friendly['id']);
                    break;
                }
                
                if($this->subitem != '' || isset($_GET['it'])){
                    (isset($_GET['it'])) ? $item = $_GET['it'] : $item =  $this->subitem;
                    $id = StoreUtils::getCategoriasByValue($item, 'url', 'produtos', 'id');
                    $this->detalhes($id);
                    break;
                }
                $this->categoriasManager();
                break;

        }
    }
    
    /*
     * Lista just redirect to the first category
     * 
     */
    public function listar(){
      
        try{            
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::AUTOS);
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::AUTOS);
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
      
            $data['content'] = $this->autosHandler->getAllContentPrincipal(4, 0, $data['attr']);
            $this->controller->redirect("/autos/" . $data['content'][0]['categoria_url']);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosAction - listar() ' . $e->getMessage();
        }
    }
    
    /*
     * Lista os produtos separados por categoria, subcategoria, subitems
     * Separa também em paginação
     * 
     */
    public function categoriasManager(){
        
        try{            
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::AUTOS);
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::AUTOS);
            
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            // Checks if there is a paginations requests
            $data['prd'] = ProdutosUtils::getPaginationAttributes($this->action, $this->cat, $this->sub, $this->subitem);
            $data['order_by'] = ProdutosUtils::getOrderBy();
            
            //Paginação LIMIT
            if(isset($_GET['p'])){
                $data['ind'] = $_GET['p'];
                $start = ($data['ind'] -1) * 10;
                if($start < 1) $start = 0;
            }else{
                $data['ind'] = 1;
                $start = 0;
            }
            
            //echo $data['prd']['categoria'] .  $data['prd']['subcategoria'] .  $data['prd']['subitem'] . ' - ' . $start;
            $data['content'] = $this->autosHandler->getAllContentByCategoria($data['prd']['categoria'], $data['prd']['subcategoria'], $data['prd']['subitem'], $start, $data['order_by'], 'exibe_produtos', $data['attr']);
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);
           
            $data['id_page'] = $this->nr_page;

            $data['paginacao'] = MethodUtils::getPaginationAttributes($data, C::AUTOS);
            
            // Menu lateral
            $data['menu_ecommerce'] = $this->autosHandler->getMenu();
            $data['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');  
            $data['fabricantes'] = $this->autosHandler->getAllFabricantes();

            $data['categorias'] = $data['menu_ecommerce'];
            $data['categoria_info'] = $this->categorias->getProductCategoriaInfos($data['prd']['id_categoria']);

            //Page title
            $data['page_title'] = $data['bread_crumb']['cat_string'];

            $this->addScript($data, 'showcase', true);            
            $this->controller->layout = "site/index";        
            $this->controller->render('/site/pages/produtos/comum/showcase/' . $data['page']['layout'], $data);        
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR AutosAction - categoriasManager() ' . $e->getMessage();
        }
    }
    
    /*
     * Detalhes de um determinado produtos
     * 
     * @param number
     * 
     */
    public function detalhes($id){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.special.VideoUtils');
        Yii::import('application.extensions.dbuzz.site.buscar.RelevanceManager');        
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
             
        $commentsHandler = new ComentariosManager();
        
        $relevanceHandler = new RelevanceManager();
        $session = MethodUtils::getSessionData();
        
        try{
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::AUTOS_DETAILS);
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::AUTOS_DETAILS);

            //Passe a view para melhorar o retorno de alguns dados
            $data['content'] = $this->autosHandler->getContentById($id, "detalhes");
            
            //BreadCrumb
            $data['cat_url'] = $this->action;
            $data['subcat_url'] = $this->cat;
            $data['subitem_url'] = $this->sub;
            
            $video = ProdutosUtils::getProdutoAttribute($id, 'video1', 'descricao');
            if($video != '') $data['content']['video1'] = VideoUtils::resizeVideo($video);
            
            $qtd_vitrine = PaginasUtils::getAttributes($data['page']['id'], 'prod_qtd_vitrine', 'inteiro', false);
            $data['vitrine'] = $relevanceHandler->getAllProductsRecommended($id, 'exibe_produtos', 'produto', $qtd_vitrine);
            $data['carrinho_amount'] = $session['carrinho_amount'];
                    
            //Comentarios
            $data['comentarios'] = $commentsHandler->getCommentsByIdGeneral(array('id'=>$id), 'produto');
            $data['like'] = $commentsHandler->getLikesByIdGeneral($id, 'produtos');
            
            $data['page_title'] = $data['content']['nome'];
            
            ActivityLogger::log($id, 'ver_autos');            
            $this->addScript($data, 'detalhes', true);

            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/produtos/comum/detalhes/{$data['page']['layout']}", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR AutosAction - detalhes() ' .$e->getMessage();
        }
    }
    
    /*
     * Obter o produtos
     * 
     * Busca produtos de um determinado tipo
     * 
     */
    public function obterProdutos(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        try{
            $result = ProdutosUtils::getProdutoInformation("'modular'", 'tipo', true);
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }       
    }
    
    /*
     * Carrega os modelos
     * 
     * 
     */
    public function loadModelos(){

        try{
            $id = $_POST['id'];
            $content['content'] = $this->autosHandler->getModelos($id);
            $result['view'] = $this->controller->render("/site/pages/produtos/comum/content/item_modelos", $content, true);
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }       
    }
    
    /*
     * Buscar produtos
     * 
     * 
     */
    public function buscarAutos(){        
      
        try{
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::AUTOS);
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::AUTOS);
            
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            // Checks if there is a paginations requests
            $data['order_by'] = ProdutosUtils::getOrderBy();
            
            if(isset($_REQUEST['keywords'])){ $data['keywords'] = $_REQUEST['keywords'];}else{$data['keywords'] = '';}
            if(isset($_REQUEST['marca'])){ $data['fabricante'] = $_REQUEST['marca'];}else{$data['fabricante'] = '';};
            if(isset($_REQUEST['combustivel'])){ $data['combustivel'] = $_REQUEST['combustivel'];}else{$data['combustivel'] = '';};
            if(isset($_REQUEST['ano_inicial'])){ $data['ano_inicial'] = $_REQUEST['ano_inicial'];}else{$data['ano_inicial'] = '';};
            if(isset($_REQUEST['ano_final'])){ $data['ano_final'] = $_REQUEST['ano_final'];}else{$data['ano_final'] = '';};
            if(isset($_REQUEST['valor_min'])){ $data['valor_min'] = $_REQUEST['valor_min'];}else{$data['valor_min'] = '';};
            if(isset($_REQUEST['valor_max'])){ $data['valor_max'] = $_REQUEST['valor_max'];}else{$data['valor_max'] = '';};
            
            $data['content'] = $this->autosHandler->searchAutos($data);
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);           
            $data['id_page'] = $this->nr_page;
            $data['paginacao'] = array('total' => 0);
            $data['fabricantes'] = $this->autosHandler->getAllFabricantes();
            $data['modelo_veiculos'] = $this->autosHandler->getModelos($data['fabricante']);

            // Menu lateral
            $data['menu_ecommerce'] = $this->autosHandler->getMenu();
            $data['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');            

            $data['categorias'] = $data['menu_ecommerce'];
            $data['categoria_info'] = array();

            //Page title
            $data['page_title'] = 'Veículos';
            $this->addScript($data, 'listar', true);            
            $this->controller->layout = "site/index";        
            $this->controller->render('/site/pages/produtos/comum/showcase/' . $data['page']['layout'], $data);

        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: AutosAction - buscarProduto() ' . $e->getMessage();
        }
    }

    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($result, $type = false, $isSpecial = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        //Funcionalidades de comportamento javascript default desta view
        $cs->registerScriptFile($baseUrl . '/js/site/special/others/autos.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/html_components/comentarios.js', CClientScript::POS_END);
        $cs->registerCssFile($baseUrl . '/css/site/components/comentarios/comentarios.css', 'screen', CClientScript::POS_HEAD);
       
        if($type == 'detalhes') $cs->registerCssFile($baseUrl . '/css/site/content/produtos/comum/detalhes/produto_detalhes.css', 'screen', CClientScript::POS_HEAD); 
        if($type == 'showcase') $cs->registerCssFile($baseUrl . "/css/site/content/produtos/comum/showcase/{$result['page']['layout']}.css", 'screen', CClientScript::POS_HEAD); 
       
        $cs->registerCssFile($baseUrl . "/css/site/layout/layout_{$result['layout']['layout_site']}.css", 'screen', CClientScript::POS_HEAD);
        
        //Dublin Core and Metadata, só se não for imprimir
        if($isSpecial){require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data_produtos.php';}
        if($isSpecial){require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';}
        
    }
}
?>