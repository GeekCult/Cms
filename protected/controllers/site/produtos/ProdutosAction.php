<?php

class ProdutosAction extends CAction{

    private $cadastrarHandler;
    private $produtosHandler;
    private $chamadosHandler;
    private $controllerIDHandler;
    private $event;
    private $preferences;
    private $id_usuario;
    private $categorias;  
    private $manager;
    private $action;
    private $subitem;
    private $cat;
    private $sub;
    private $regiao;
    private $valida;
    private $session;
    private $id;
    private $nr_page;

    public function run(){

        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        Yii::import('application.extensions.dbuzz.admin.special.RegiaoManager');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        Yii::import('application.extensions.utils.BannersUtils');

        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PedidosManager');
        Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');

        $this->cadastrarHandler = new PedidosManager();
        $this->preferences = new MyPreferences();
        $this->manager = new DBManager();
        $this->valida = new dbValidar();
        $this->regiao = new RegiaoManager();
        $this->produtosHandler = new ProdutosManager();
        $this->categorias = new CategoriaManager();
        $this->controllerIDHandler = new PaginasManager();
        
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        //Essa variavel pode ser qualquer coisa como um id ou uma categoria
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        $this->cat = Yii::app()->getRequest()->getQuery('cat');
        $this->sub = Yii::app()->getRequest()->getQuery('sub');
        $this->subitem = Yii::app()->getRequest()->getQuery('subitem');
        
        $this->session = MethodUtils::getSessionData();
        $this->id_usuario = $this->session['id'];

        switch($this->action){

            case "listar":
            case "":
            case "listar_modulos":
                $this->listar();
                break;

            case "detalhes":
                $this->detalhes($this->id);
                break;

            case "compra_realizada":
                $this->compraRealizada();
                break;

            case "obter_produtos":
                $this->obterProdutos();
                break;
            
            case "search_produtos":
                $this->buscarProdutos();
                break;
            
            case "add_item":
                $this->addItem();
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
     * Lista todos os produtos
     * 
     * @param boolean
     * 
     */
    public function listar($isCategoria = false){
        
        Yii::import('application.extensions.utils.admin.PreferenceUtils');
      
        try{            
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::PRODUTOS); 
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::PRODUTOS);
            
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            //Paginação LIMIT
            if(isset($_GET['p'])){
                $data['ind'] = $_GET['p'];
                $start = ($data['ind'] -1) * 10;
            }else{
                $data['ind'] = 1;
                $start = 0;
            }
            
            if($isCategoria) $this->id = $this->action;
            
            //Ads
            //$data['ads'] = $this->manager->getBannersForPages($data['page']['id'], true);
      
            $data['content'] = $this->produtosHandler->getAllContentPrincipal(2, $start, $data['attr']);                   
            $data['advertise'] = BannersUtils::getBannersAdvertise($data['page']['id']);
            
            // BreadCrumb
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);
            
            // Menu lateral         
            
            $data['menu_ecommerce'] = $this->produtosHandler->getMenu();
            $data['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');            
            
            // Order By
            $data['order_by'] = ProdutosUtils::getOrderBy();
            
            // Paginacao
            $data['prd'] = ProdutosUtils::getPaginationAttributes($this->action, $this->cat, $this->sub, $this->subitem);
            $data['paginacao'] = MethodUtils::getPaginationAttributes($data, C::PRODUTOS_SIMPLES);
            $data['id_page'] = $this->nr_page;

            $data['categorias'] = $this->categorias->getAllProductCategories(2);
            $data['categoria_selected'] = $this->id;
            
            $data['categoria_info'] = $this->categorias->getProductCategoriaInfos(false, 2);
       
            $data['tipo'] = $this->id;
            
            if(($data['page']['layout'] == "" || !$data['preferences']['showcase'] || $data['preferences']['showcase'] == 0) && isset($data['content'][0]['categoria_url'])){
                $this->controller->redirect("/produtos/" . $data['content'][0]['categoria_url']);                
            }
            
            $data['page_title'] = "Produtos";

            $this->controller->layout = "site/index";
            $this->addScript($data, 'showcase', true);
            $this->controller->render("/site/pages/produtos/comum/showcase/{$data['page']['layout']}", $data);

        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosAction - listar() ' . $e->getMessage();
        }
    }
    
    /*
     * Lista os produtos separados por categoria, subcategoria, subitems
     * Separa também em paginação
     * 
     */
    public function categoriasManager(){
        
        Yii::import('application.extensions.utils.admin.PreferenceUtils');
        
        try{            
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::PRODUTOS); 
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::PRODUTOS);
            
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            // Checks if there is a paginations requests
            $data['prd'] = ProdutosUtils::getPaginationAttributes($this->action, $this->cat, $this->sub, $this->subitem);
            $data['order_by'] = ProdutosUtils::getOrderBy();
            
            //Paginação LIMIT
            if(isset($_GET['p'])){
                $data['ind'] = $_GET['p'];
                $start = ($data['ind'] -1) * 10;
            }else{
                $data['ind'] = 1;
                $start = 0;
            }
            
            //echo $data['prd']['categoria'] .  $data['prd']['subcategoria'] .  $data['prd']['subitem'] . ' - ' . $start;
            $data['content'] = $this->produtosHandler->getAllContentByCategoria($data['prd']['categoria'], $data['prd']['subcategoria'], $data['prd']['subitem'], $start, $data['order_by'], 'exibe_produtos', $data['attr']);
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);
           
            $data['id_page'] = $this->nr_page;
            
            //Ads
            $data['ads'] = $this->manager->getBannersForPages($data['page']['id'], true);
     
            //$data['qtd_pagination'] = round(count($data['content'])/10);
            $data['paginacao'] = MethodUtils::getPaginationAttributes($data, C::PRODUTOS_SIMPLES);
            
            $data['advertise'] = BannersUtils::getBannersAdvertise($data['page']['id']);
            
            // Menu lateral
            $data['menu_ecommerce'] = $this->produtosHandler->getMenu();
            $data['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');            

            $data['categorias'] = $this->categorias->getAllContentById($data['page']['id']);
            $data['categoria_info'] = $this->categorias->getProductCategoriaInfos($data['prd']['id_categoria']);

            //Page title
            $data['page_title'] = $data['bread_crumb']['cat_string'];

            $this->addScript($data, 'listar', true);
            
            $this->controller->layout = $data['layout']["plataform"]. "/index";        
            $this->controller->render('/site/pages/produtos/comum/listar/' . $data['page']['layout'], $data);
        
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR ProdutosAction - categoriasManager() ' . $e->getMessage();
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
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::PRODUTOS_DETAILS); 
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::PRODUTOS_DETAILS);

            //Passe a view para melhorar o retorno de alguns dados
            $data['content'] = $this->produtosHandler->getContentById($id, "detalhes");
            
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
            
            ActivityLogger::log($id, 'ver_produto');
            
            $this->addScript($data, 'detalhes', true);
            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/produtos/comum/detalhes/{$data['page']['layout']}", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR ProdutosAction - detalhes() ' .$e->getMessage();
        }
    }
    
    /*
     * Atualiza o status do produto
     * It uses the ProdutosUtils class
     * 
     * 
     *
    public function compraRealizada(){    
        
        Yii::import('application.extensions.dbuzz.site.pedidos.common.ChamadosManager');        
        $this->chamadosHandler = new ChamadosManager(); 
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
        $data['status'] = '1';
        $data['id_user'] = $this->session['id'];
        $data['id_produto'] = $_POST['id_produto'];
        $data['id_pedido'] = $this->session['id_pedido'];
        $data['id_owner'] = $this->session['id_owner'];
        
        $this->produtosHandler->updateStatus($data);
        
        //Se o produto estiver relacionado a um pedido, então atualiza o chamado
        if($data['id_pedido'] != 0) $this->chamadosHandler->updateStatus($data);
        
        $layout = $this->manager->getLayout();

        $data['menu_principal'] = $this->manager->getMenu();
        $data['plataform'] = $layout["plataform"];
        $data['preferences'] = $this->preferences->getPreferences(); 
        $data['isBanner'] = $this->manager->getBannerMainShow("produtos"); 
           
        $this->controller->layout = $layout["plataform"]. "/index";        
        $this->controller->render('/site/pages/produtos/general/compra_realizada', $data);
    } */
    
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
     * Buscar produtos
     * 
     * 
     */
    public function buscarProdutos(){
        
        Yii::import('application.extensions.utils.admin.PreferenceUtils');
        
      
        try{
            if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::PRODUTOS); 
            if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::PRODUTOS);
            
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            // Checks if there is a paginations requests
            $data['order_by'] = ProdutosUtils::getOrderBy();
            
            $data['keywords'] = $_REQUEST['keywords']; 
            $data['categoria_produto'] = $_REQUEST['categoria']; 

            if(Yii::app()->params['livechat'] == '1') $data['livechat'] = $this->preferences->getConversation(); 
            
            $data['content'] = $this->produtosHandler->searchProduto($data);
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);           
            $data['id_page'] = $this->nr_page;
            
            //Ads
            $data['ads'] = $this->manager->getBannersForPages($data['page']['id'], true);
            $data['paginacao'] = array('total' => 0);            
            $data['advertise'] = BannersUtils::getBannersAdvertise($data['page']['id']);
            
            // Menu lateral
            $data['menu_ecommerce'] = $this->produtosHandler->getMenu();
            $data['menu_produtos_tipo'] = PreferencesUtils::getAttributes("menu_produtos_type", 'texto');            

            $data['categorias'] = $this->categorias->getAllContentById($data['page']['id']);
            $data['categoria_info'] = array();

            //Page title
            $data['page_title'] = 'Produtos';
            $this->addScript($data, 'listar', true);            
            $this->controller->layout = $data['layout']["plataform"]. "/index";        
            $this->controller->render('/site/pages/produtos/comum/listar/' . $data['page']['layout'], $data);

        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosAction - buscarProduto() ' . $e->getMessage();
        }
    }
    
    /*
     * Adds one more item into shopping cart
     * 
     */
    public function addItem(){
        
        $session = MethodUtils::getSessionData();
        
        Yii::import('application.extensions.dbuzz.site.produtos.EcommerceManager');
        Yii::import('application.extensions.dbuzz.admin.PagamentosManager');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $ecommerceHandler = new EcommerceManager();
        
        try{        
            $data['data'] = date("Y-m-d H:m:s");
            $data['last_update'] = date("Y-m-d H:m:s");

            $data['id_item'] = $_POST['id_item'];
            $data['tipo'] = $_POST['tipo'];
            $data['valor'] = CurrencyUtils::checkFloatFormat($_POST['valor']);
            $data['escolha_pagamento'] = isset($_POST['escolha']);
            $data['metodo_pagamento'] = "";
            $data['mes'] = isset($_POST['mes']);
            if(!isset($_POST['mes'])) $data['mes'] = date("m");
            
            //Se for produto em estoque get POST variante
            (isset($_POST['id_variante'])) ? $data['id_variante'] = $_POST['id_variante'] : $data['id_variante'] = 0;
            
            $data['id_user'] = $session['id'];
            $data['id_pedido'] = StoreUtils::getTypePedidoSession($data['tipo']);

            //Se não houver um registro de carrinho atual
            if($data['id_pedido'] == "" || $data['id_pedido'] == null){
                $data['id_pedido'] = $ecommerceHandler->createFirstItemCart($data);
            }
            
            $item = $this->produtosHandler->getContentById($data['id_item'], "detalhes");                  

            //Sets number of items selected
            $qtd = $_POST['qtd']; if($qtd == "" || $qtd == "undefined")$qtd = 1;        
            $data['amount'] = $qtd;        
            $data['nome'] = $item['nome'];
            $data['pagamento'] = $result['pagamento'] = false;

            //If it's a product get the real value
            if($data['tipo'] == "produto" || $data['tipo'] == "elearn"){
                if($item['promocao'] != '0' && $item['promocao'] != ''){
                    $data['valor'] = $item['promocao'];
                }else{
                    $data['valor'] = $item['preco_real'];
                }
                $data['valor_unid'] = $data['valor']; 
                $data['valor'] = $data['valor'] * $qtd;                   
            }

            //If it's not a product get value defined
            if($data['tipo'] != "produto" && $data['tipo'] != "elearn"){$data['valor_unid'] = $data['valor']; $data['valor'] = $data['valor']* $qtd;}

            $ecommerceHandler->addItemShoppingCart($data);

            //Prepares all item to be shown into cart
            $result['amount'] = ProdutosUtils::getCountItemsCart($data);
            $result['items'] =  $ecommerceHandler->getItemsShoppingCart($data['id_pedido'], $data['tipo']);
            $result['id_pedido'] = $data['id_pedido'];
            
            ActivityLogger::log($data['id_item'], 'item_sob_consulta');

            echo json_encode($result);            
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: StoreAction - addItemCart() " . $e->getMessage();
        } 
    }
    
    /*
     * Cotação dos produtos
     * Exibe a tela de cotação com os itens e tals.
     * 
     * 
     */
    public function cotacao() {
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.dbuzz.site.produtos.EcommerceManager');
        
        $ecommerceHandler = new EcommerceManager();
        
        if(!Yii::app()->params['site_type']) $data = HelperUtils::getPageBundle(C::PRODUTOS); 
        if( Yii::app()->params['site_type']) $data = HelperUtils::getPageBundleSupreme(C::PRODUTOS);      
        
        $session = MethodUtils::getSessionData();
        
        $id_pedido = $session['PP_Id_Pedido'];
        
        $data['content'] = $ecommerceHandler->getFullItemsPayment($id_pedido, "produto");
        $data['id_pedido'] = $id_pedido;
        $data['id_usuario'] = $session['id'];
        
        //If user is logged in it fills out the user information
        $data['user_data']['contato'] = UserUtils::getUserContacts($session['id']);
        $data['user_data']['endereco'] = UserUtils::getAddress($session['id']);
        $data['user_data']['endereco2'] = UserUtils::getAddress2($session['id']);
        
        //Nome
        $data['user_data']['nome'] = $session['field1'];
        $data['user_data']['sobrenome'] = $session['field2'];        
      
        $this->addScript($data, 'cotacao');
        $this->controller->layout = "site/index";       
        $this->controller->render('/site/pages/produtos/general/carrinho', $data);
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
        $cs->registerScriptFile($baseUrl . '/js/site/produtos/comum/listar/produtos.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/html_components/comentarios.js', CClientScript::POS_END);
        $cs->registerCssFile($baseUrl . '/css/site/components/comentarios/comentarios.css', 'screen', CClientScript::POS_HEAD);
        //$cs->registerCssFile($baseUrl . '/css/site/content/'. $layout .'.css', 'screen', CClientScript::POS_HEAD);
        
        if($type == 'cotacao') $cs->registerScriptFile($baseUrl . '/js/site/produtos/comum/listar/cotacao.js', CClientScript::POS_END);
        if($type == 'pagamento') $cs->registerCssFile($baseUrl . '/css/site/content/pagamento/fechamento.css', 'screen', CClientScript::POS_HEAD);
        if($type == 'detalhes') $cs->registerCssFile($baseUrl . '/css/site/content/produtos/comum/detalhes/produto_detalhes.css', 'screen', CClientScript::POS_HEAD); 
        if($type == 'showcase') $cs->registerCssFile($baseUrl . "/css/site/content/produtos/comum/showcase/{$result['page']['layout']}.css", 'screen', CClientScript::POS_HEAD); 
        //if($type == 'listar') $cs->registerCssFile($baseUrl . "/css/site/content/produtos/comum/listar/{$result['page']['layout']}.css", 'screen', CClientScript::POS_HEAD); 
       
        $cs->registerCssFile($baseUrl . "/css/site/layout/layout_{$result['layout']['layout_site']}.css", 'screen', CClientScript::POS_HEAD);
        
        //Dublin Core and Metadata, só se não for imprimir
        if($isSpecial){require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data_produtos.php';}
        if($isSpecial){require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';}
        
    }
}
?>