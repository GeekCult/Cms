<?php

/**
 * Autor: CarlosGarcia
 * Date: 12/12/2010
 *
 * Matéria Class
 * Specific Class - Admin Controller
 *
 */
class LojaAction extends CAction{
    
    public  $categoriasHandler; 
    private $paginasHandler; 
    private $storeHandler;
    private $controllers;
    private $action;
    private $event;
    private $id;    

    /**
     * Run
     * Launcher method
     * TODO: Não utilizar EcommerceManager Global, usa-se site e admin nessa 
     * Action
     * 
     */
    public function run() {
       
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.admin.LojaManager');
        Yii::import('application.extensions.utils.DicasUtils');
        
        //Verifica se é Notícia, Coluna ou Blog
        $this->controllers = explode("/", $_SERVER['REQUEST_URI']);        
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->event = Yii::app()->getRequest()->getQuery('event');
        $this->id = Yii::app()->getRequest()->getQuery('id');        
        
        $this->storeHandler = new LojaManager();
        $this->paginasHandler = new PaginasManager();  
        $this->categoriasHandler = new CategoriaManager(); 

        switch($this->action){

            case "categorias_novo":
                $this->novoCategoria(0);
                break;
            case "categorias_novo_simples":
                $this->novoCategoria(2);
                break;
            
            case "categorias_novo_elearn":
                $this->novoCategoria(3);
                break;
            
            case "categorias":
                $this->novoCategoria();
                break;

            case "editar":
                $this->editar();
                break;
            
            case "estoque_listar":
                $this->listar();
                break;
            
            case "adicionar":
                $this->adicionar();
                break;
            
            case "adicionar_simples":
                $this->adicionar(2);
                break;
            
            case "adicionar_elearn":
                $this->adicionar(3);
                break;
            
            case "sub_adicionar":
                $this->subAdicionar();
                break;

            case "categorias_listar":
                $this->listarCategoria(0);
                break;
            
            case "categorias_listar_simples":
                $this->listarCategoria(2);
                break;
            
            case "categorias_listar_elearn":
                $this->listarCategoria(3);
                break;
            
            case "categoria_settings":
                $this->settingMainCategoria();
                break;
            
            case "categoria_settings_salvar":
                $this->salvarSettingsMainCategoria();
                break;
            
            case "cadastrar_categoria":
                $this->cadastrarCategoria();
                break;
            
            case "remover_categoria":
                $this->removerCategoria();
                break;
            
            case "estoque_cadastrar":
                $this->estoqueCadastrar();
                break;
            
            case "estoque_salvar":
                $this->estoqueSalvar();
                break;
            
            case "cadastrar_cor":
            case "cadastrar_tamanho":
                $this->novaCaracteristica();
                break;
            
            case "listar_cor":
            case "listar_tamanho":
                $this->listarCaracteristica();
                break;
            
            case "editar_cor":
            case "editar_tamanho":
                $this->novaCaracteristica();
                break;
            
            case "remover_caracteristica":
                $this->removerCaracteristica();
                break;
            
            case "salvar_caracteristica":
                $this->salvarCaracteristicas();
                break;
            
            case "details":
                $this->editarDetalhes();
                break;
            
            case "load_stock_item":
                $this->loadStockItem();
                break;
            
            case "save_stock_item":
                $this->saveStockItem();
                break;
            
            case "estatisticas":
                $this->estatisticas();
                break;
            
             case "analises":
                $this->analises();
                break;
            
            case "realizar_compra":
                $this->realizarCompra();
                break;
            
            case "pagar_compra":
                $this->pagarCompra();
                break;
            
            case "realizar_compra_elearn":
                $this->realizarCompra('elearn');
                break;
            
            case "pagar_compra_elearn":
                $this->pagarCompra('elearn');
                break;
            
            default:
                echo "ERROR: Action not found!";
                break;
        }
    }
    
    /**
     *
     * Realizar compra 
     * 
     * Add the main storage attributes
     * 
     * @params string
     *
     */
    public function realizarCompra($tipo = 'ecommerce'){
        
        Yii::import('application.extensions.dbuzz.admin.EcommerceManager');        
        $ecommerceHandler = new EcommerceManager();
        
        $result = array();

        try{            
            $result['content'] = $ecommerceHandler->getAllContentComprar('produto', 0, array('limite_pagina' => 20000));
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils($tipo, array('extra' => 'pagamento', 'action' => 'realizar_compra'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
            $result['tipo'] = $tipo;
            
            $this->addScript('compra');
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/ecommerce/". Yii::app()->params['admin_content'] ."realizar_compra", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - LojaAction - realizarCompra() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - LojaAction - realizarCompra()', 'trace' => $e->getMessage()), true);
        }  
    }
    
    /**
     *
     * Pagar compra  
     * View to finalize the purchase
     * 
     * @params $string
     * 
     */
    public function pagarCompra($tipo = 'ecommerce'){
        
        Yii::import('application.extensions.dbuzz.site.ecommerce.EcommerceManager');        
        $ecommerceHandler = new EcommerceManager();

        try{  
            $result['session'] = MethodUtils::getSessionData(); 
            $result['content'] = $ecommerceHandler->getFullItemsPayment($result['session']['PP_Id_Pedido'], "produto");
            $result['id_pedido'] = $result['session']['PP_Id_Pedido'];
            $result['id_usuario'] = $result['session']['id_comprar_cliente'];
            $result['tipo'] = $tipo;
            
            $result['sidemenu'] = HelperUtils::adminUtils($tipo, array('extra' => 'pagamento', 'action' => 'realizar_compra'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScript('compra');
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/ecommerce/". Yii::app()->params['admin_content'] ."pagar_compra", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - LojaAction - realizarCompra() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - LojaAction - realizarCompra()', 'trace' => $e->getMessage()), true);
        }  
    }
    
    /**
     *
     * Estoque salvar 
     * 
     * Add the main storage attributes
     * This method uses the class Javascript jquery.json
     *
     */
    public function estoqueSalvar(){
      
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.EstoqueAttribute');
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        try{
            
            $json = stripslashes($_POST["json"]);
            $output = json_decode($json, true);

            $ea = new EstoqueAttribute();
            $ea->setCurrentProduto($output['id']);

            for($i = 0; $i <= $output['nr']; $i++){
                $isSet = $ea->recuperar($output['ref_'.$i]);
                if(!$isSet && $output['ref_'.$i] != "empty"){
                    if($output['n_index_'.$i] == '') $output['n_index_'.$i] = 0; if($output['qtd_'.$i] == '') $output['qtd_'.$i] = 1;
                    $ea->adicionar($output['ref_'.$i], $output['size_'.$i], $output['color_'.$i], $output['val_'.$i], $output['qtd_'.$i], $output['n_index_'.$i], 'variante');
                }
                if($output['color_'.$i] == "remove") $ea->remover($output['ref_'.$i]);
            }

            //Updates the inventory getting all products added into ecommerce_estoque 
            $qtd_estoque = ProdutosUtils::updateTotalEstoqueProduto($output['id']);
            
            $json = HelperUtils::jsonData(array('app' => C::ECOMMERCE));

            echo Yii::t("messageStrings", "message_result_stock_add");
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - LojaAction - estoqueCadastrar() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - LojaAction - estoqueSalvar()', 'trace' => $e->getMessage()), true);
        }  
    }
    
    /**
     *
     * Estoque cadastrar 
     * 
     * Add the main storage attributes
     *
     */
    public function estoqueCadastrar(){
        
        Yii::import('application.extensions.dbuzz.admin.EcommerceManager');        
        $ecommerceHandler = new EcommerceManager();

        $result = array();

        try{            
            $result['content'] = $ecommerceHandler->getContentById($this->controllers[4]);
            $result['estoque'] = $ecommerceHandler->getEstoqueProduto($this->controllers[4]);
            $result['tamanho'] = $this->storeHandler->getCaracteristicas("tamanho");
            $result['cor']     = $this->storeHandler->getCaracteristicas("cor");
            $result['action'] = "novo";            
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'estoque', 'action' => 'novo'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
            
            $json = HelperUtils::jsonData(array('app' => C::ECOMMERCE));
        
            $this->addScript();
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/ecommerce/estoque/". Yii::app()->params['admin_content'] ."cadastrar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - LojaAction - estoqueCadastrar() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - LojaAction - estoqueCadastrar()', 'trace' => $e->getMessage()), true);
        }  
    }
    
    /**
     *
     * Adicionar for Fancybox 
     * 
     * Add the main attributes
     * It uses a PaginaManager Class to populate the combox with
     * all pages recorded there.
     *
     */
    public function adicionar($tipo = 0){

        $result = array();

        try{            
            $result['id_page'] = $this->id;           
            $result['content']['id_page'] = $this->id;
            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";
            $result['tipo'] = $tipo;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }        

        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/categorias/ecommerce/adicionar_store", $result);
    }
    
    /**
     *
     * Adicionar subcategory for Fancybox 
     * 
     * Add the main attributes
     * It uses a PaginaManager Class to populate the combox with
     * all pages recorded there.
     *
     */
    public function subAdicionar(){

        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['categorias']   = $this->categoriasHandler->getAllProductCategories();          
            $result['content']['id_page'] = $this->id;
            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";
            //$result['tipo'] = 0;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }        

        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/categorias/ecommerce/adicionar_sub_store", $result);
    }
    
    /**
     *
     * Nova Categoria
     * It adds a new record into database.
     * It uses a id 0 record to simulate some fake data.
     * It is used just to avoid unecessary codes.
     * 
     * Tipo = 0 - ecommerce
     * Tipo = 1 - portfolio
     * Tipo = 2 - simples
     * Tipo = 3 - elearn
     * Tipo = 4 - autos
     *
     */
    public function novoCategoria($tipo = 0){

        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['categorias'] = $this->categoriasHandler->getAllProductCategories($tipo);
            
            //Se houver categorias busca subcategroias
            if(isset($result['categorias'][0]['id_categoria'])){
                $result['subcategorias'] = $this->categoriasHandler->getAllProductSubCategories($result['categorias'][0]['id_categoria']);
            }else{
                $result['subcategorias'] = array();
            }
            
            $result['content']['id_page'] = $this->id;            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";
            $result['tipo'] = $tipo;
            $result['id_album'] = "";
            $result['id_subcategoria'] = "";
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'categorias', 'action' => 'novo'));
            
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScript();        
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/loja/". Yii::app()->params['admin_content'] ."novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Listar Categoria
     * List the main atrributes and it opens the select item list.
     * Just select one of it to edit.
     * 
     * Tipo = 0 - ecommerce
     * Tipo = 1 - portfolio
     * Tipo = 2 - simples
     * Tipo = 3 - elearn
     *
     */
    public function listarCategoria($tipo = 0){
        
        $result = array();        

        try{
            $result['categorias'] = $this->categoriasHandler->getAllProductCategories($tipo);
            $result['subcategorias'] = $this->categoriasHandler->getAllProductSubCategories("", true, $tipo);
            $result['subitems'] = $this->categoriasHandler->getSubItemsEcommerce("", true, $tipo);
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'categorias', 'action' => 'listar'));
            $result['tipo'] = $tipo;
            
            $result['dicas'] = DicasUtils::getTips("categories", "produtos");
        
            $this->addScript("categorias");
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/categorias/ecommerce/". Yii::app()->params['admin_content'] ."listar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
    }
    
    /**
     *
     * Cadastrar categoria
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarCategoria(){

        $data = array();
        
        try{
            $data['subitem_label'] = $_POST['label_item_subcategoria']; 
            $data['id_categoria'] = $_POST['id_categoria'];
            $data['id_subcategoria'] = $_POST['id_subcategoria'];
            $data['action'] = $_POST['action']; 
            $data['tipo'] = 0;

            if($data['action'] == "novo"){
                $data['message'] = Yii::t("messageStrings", "message_result_subitem");
            }else{
                $data['message'] = Yii::t("messageStrings", "message_result_subitem_update");
            }

            $content = $this->storeHandler->submitContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Edita a main categoria com definições, fotos de exibição da categoria e etc
     * This method does the submit form using a jQuery request
     *
     */
    public function settingMainCategoria(){

        $result = array();

        try{
            $result['session'] = MethodUtils::getSessionData();
            $result['content'] = $this->storeHandler->getSettingsCategoria($this->id);
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'categorias', 'action' => 'novo'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
            $result['link'] = 'ecommerce';
        
            $this->addScript("categorias");
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/categorias/ecommerce/". Yii::app()->params['admin_content'] ."settings", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: LojaAction - settingMainCategoria() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar Settings categoria
     * This method does the submit form using a jQuery request
     *
     */
    public function salvarSettingsMainCategoria(){

        $data = array();
        
        $data['id_categoria'] = $_POST['id_categoria'];
        $data['nome'] = $_POST['nome']; 
        if(isset($_POST['index'])) {$data['index'] = $_POST['index'];}else{$data['index'] = 0;}
        if(isset($_POST['menu_principal'])) {$data['menu_principal'] = MethodUtils::getBooleanNumber($_POST['menu_principal']);}else{$data['menu_principal'] = 0;}
        if(isset($_POST['menu_2'])) {$data['menu_2'] = MethodUtils::getBooleanNumber($_POST['menu_2']);}else{$data['menu_2'] = 0;}
        if(isset($_POST['menu_3'])) {$data['menu_3'] = MethodUtils::getBooleanNumber($_POST['menu_3']);}else{$data['menu_3'] = 0;}
        $data['descricao'] = $_POST['descricao'];
        $data['graphic'] = $_POST['graphic'];
        $data['exibe'] = MethodUtils::getBooleanNumber($_POST['exibe']);
        $data['error'] = null;
        
        //Messages return
        $data['message'] = Yii::t("messageStrings", "message_result_category_update");

        try{
            $result = $this->storeHandler->saveSettingsMainCategoria($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            MethodUtils::returnMessage($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
    }
    
    /**
     *
     * Remover categoria, subcategoria e subitem
     * This method does the submit form using a jQuery request
     *
     */
    public function removerCategoria(){

        $data = array();
        
        $data['id'] = $_POST['id'];
        $data['type'] = $_POST['type']; 
        
        switch ($data['type']){
            case "categoria":
                $data['message'] = Yii::t("messageStrings", "message_result_category_delete");
                break;
            case "subcategoria": 
                $data['message'] = Yii::t("messageStrings", "message_result_subcategory_delete");
                break;
            case "subitem": 
                $data['message'] = Yii::t("messageStrings", "message_result_subitem_delete");
                break;
        }

        try{
            $content = $this->storeHandler->removeCategory($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Nova caracteristica
     * 
     * It adds the caracteristics to be used into
     * add stock attritubutes
     *
     */
    public function novaCaracteristica(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $result = array();

        try{        
            $result['attributes'] = ProdutosUtils::getCaracteristics($this->action);
            
            if($this->event != '') {
                $result['id'] = $this->event;
                $result['action'] = "editar";
                $result['content']   = $this->storeHandler->getCaracteristicas(null, $this->event);
                
            }else{
               $result['id'] = '';
               $result['action'] = "novo";
            }
            
            $result['id_page'] = $this->id;
            $result['categorias']   = $this->categoriasHandler->getAllProductCategories();
            $result['subcategorias']   = $this->categoriasHandler->getAllProductSubCategories($result['categorias'][0]['id_categoria']);           
                                   
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'detalhes', 'action' => 'detalhes')); 
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");

            $this->addScript();        
            $this->controller->layout = "admin/admin2";
            $this->controller->render("pages/ecommerce/caracteristicas/novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }        
    }
    
    /**
     *
     * Remover caracteristica
     *
     */
    public function removerCaracteristica(){
        
        $data['id'] = $_POST['id'];
        $data['type'] = $_POST['type'];
        $data['message'] = Yii::t('messageStrings', 'message_result_ecommerce_caracteristic_delete');

        try{
            $content = $this->storeHandler->removeCaracteristica($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Carrega um item para ser editado
     *
     */
    public function loadStockItem(){
        
        Yii::import('application.extensions.dbuzz.admin.EcommerceManager');        
        $ecommerceHandler = new EcommerceManager();

        try{
            $result['tipo'] = $_POST['tipo'];
            $result['estoque'] = $ecommerceHandler->getEstoqueItem($_POST['id']);
            $result['tamanho'] = $this->storeHandler->getCaracteristicas("tamanho");
            $result['cor']     = $this->storeHandler->getCaracteristicas("cor");


        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }  

        if($result['tipo'] == 'item') echo $this->controller->renderPartial("pages/produtos/estoque/content/item", $result);
        if($result['tipo'] == 'images') echo json_encode($result);
    }
    
    /**
     *
     * Carrega um item para ser editado
     *
     */
    public function saveStockItem(){
        
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        //All values
        $data['cor'] = $_POST['cor']; $data['tamanho'] = $_POST['tamanho']; 
        $data['ref'] = $_POST['ref']; $data['acrescimo'] = $_POST['acrescimo'];
        $data['id'] = $_POST['id']; $data['qtd'] = $_POST['qtd']; $data['n_index'] = $_POST['n_index'];
        $data['id_produto'] = $_POST['id_produto'];
        
        try{            
            $update = ProdutosUtils::updateItemEstoque($data);            
            
            $pa = new dbProdutosAttribute();
            $pa->setCurrentProduto($data['id_produto']);

            //Works with pictures
            for($i = 1; $i <= 6; $i++) {
                if (isset($_POST['picture' . $i]) && $_POST['picture' . $i] != ""){
                    if($_POST['picture' . $i] == "empty"){
                        $pa->adicionarComplete("produto_VAR_" . $i, "", 'texto', $data['id']);
                    }else{
                        $pa->adicionarComplete("produto_VAR_" . $i, $_POST['picture' . $i], 'texto', $data['id']);
                    }
                }
            }
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

            echo Yii::t('messageStrings', 'message_result_stock_add');

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: LojaAction - saveStockItem() " . $e->getMessage();
        } 
    }
    
    /**
     *
     * Listar caracteristica
     * 
     * It list the caracteristics to be used into
     * add stock attritubutes
     *
     */
    public function listarCaracteristica(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $result = array();

        try{
            $tipo = explode("_", $this->action);
            $result['tipo'] = $tipo[1];
            $result['content']   = $this->storeHandler->getCaracteristicas($tipo[1]);           
            $result['attributes'] = ProdutosUtils::getCaracteristics($this->action);
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'detalhes', 'action' => 'detalhes')); 
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScript();        
            $this->controller->layout = "admin/admin2";
            $this->controller->render("pages/ecommerce/caracteristicas/listar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar Caracteristica
     * This method does the submit form using a jQuery request
     *
     */
    public function salvarCaracteristicas(){

        $data = array();
        
        $data['id'] = $_POST['id'];
        $data['action'] = $_POST['action'];
        $data['tipo'] = $_POST['tipo'];
        $data['texto'] = $_POST['label_caracteristica'];
        $data['number'] = "";
        $data['extra'] = $_POST['extra'];
        if(isset($_POST['image'])) $data['extra2'] = $_POST['image']; else $data['extra2'] = "";
        $data['inteiro'] = "";
        
        
        if($data['action'] == "novo"){
            $data['message'] = Yii::t("messageStrings", "message_result_ecommerce_caracteristic");
        }else{
            $data['message'] = Yii::t("messageStrings", "message_result_ecommerce_caracteristic_update");
        }

        try{
            $content = $this->storeHandler->salvarCaracteristica($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Editar detalhes
     * 
     * Detalhes gerais de e-commerce, cor do botão de carrinho
     * Tipo do container de vitrine, se fucnoina com grátis ou R$0,00
     *
     */
    public function editarDetalhes(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['categorias']   = $this->categoriasHandler->getAllProductCategories();
            (isset($result['categorias'][0]['id_categoria'])) ? $cat = $result['categorias'][0]['id_categoria'] : $cat = 0;
            $result['subcategorias']   = $this->categoriasHandler->getAllProductSubCategories($cat);           
            $result['action'] = "novo";            
            $result['id_album'] = "";
            $result['attr'] = ProdutosUtils::getEcommerceDetails();
            
          
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('ecommerce', array('extra' => 'detalhes', 'action' => 'detalhes'));       
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScript();        
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/ecommerce/special/". Yii::app()->params['admin_content'] ."detalhes", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }  
    }
    
    /**
     * Admin - Estatisticas
     *
     * Exibe as estatisticas da loja
     *
     */
    public function estatisticas(){
        
        Yii::import('application.extensions.dbuzz.admin.special.MilestonesManager');
        Yii::import('application.extensions.dbuzz.admin.EstatisticasManager');
        Yii::import('application.extensions.utils.users.UserUtils'); 
        Yii::import('application.extensions.utils.ActivityUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        
        $milestoneHandler = new MilestonesManager();
        $estatisticasHandler = new EstatisticasManager();
     
        
        $session = MethodUtils::getSessionData();
        if(!isset($session['month_ecommerce']) || $session['month_ecommerce'] == '') MethodUtils::setSessionData('month_ecommerce', date('m'));
        if(!isset($session['year_ecommerce']) || $session['year_ecommerce'] == '') MethodUtils::setSessionData('year_ecommerce', date('Y'));
        
        $result['month'] = $session['month_ecommerce'];
        $result['year'] = $session['year_ecommerce'];
        
        try{
            $data = array("vendas", 'produtos_vendidos', 'produtos_carrinho', 'maxima');
            $result['milestone'] = $milestoneHandler->getAllMilestoneFor('produtos', $data);
            
            //Vendas
            $result['vendas'] = StoreUtils::getItemsVendidos($result['month'], $result['year']);
            $result['size_vendas'] = MathUtils::getPercentage($result['milestone']['vendas'], $result['milestone']['maxima']);
            $result['porcentagem_vendas'] = MathUtils::getPercentage($result['vendas'], $result['milestone']['vendas']);
            
            //Produtos vendidos
            $result['produtos_vendidos'] = StoreUtils::getItemsVendidos($result['month'], $result['year'], 0, true);
            $result['size_produtos_vendidos'] = MathUtils::getPercentage($result['milestone']['produtos_vendidos'], $result['milestone']['maxima']);
            $result['porcentagem_produtos_vendidos'] = MathUtils::getPercentage($result['produtos_vendidos'], $result['milestone']['produtos_vendidos']);
            
            //Produtos carrinhos
            $result['produtos_carrinho'] = StoreUtils::getItemsFromCarrinho($result['month'], $result['year']);
            $result['size_produtos_carrinho'] = MathUtils::getPercentage($result['milestone']['produtos_carrinho'], $result['milestone']['maxima']);
            $result['porcentagem_produtos_carrinho'] = MathUtils::getPercentage(count($result['produtos_carrinho']), $result['milestone']['produtos_carrinho']);
            
            
            $result['dicas'] = DicasUtils::getTips("statistics", 'ecommerce');
            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("/admin/pages/loja/estatisticas", $result);

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: CurriculosAction - estatisitcas() ' . $e->getMessage();
        }   
    }
    
    /**
     * Admin - Analises
     *
     * Exibe as analises da loja
     *
     */
    public function analises(){
        
        Yii::import('application.extensions.dbuzz.admin.special.MilestonesManager');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PropostasManager');
        Yii::import('application.extensions.dbuzz.admin.EstatisticasManager');
        Yii::import('application.extensions.utils.users.UserUtils'); 
        Yii::import('application.extensions.utils.ActivityUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        
        $milestoneHandler = new MilestonesManager();
        $estatisticasHandler = new EstatisticasManager();
        $propostasHandler = new PropostasManager();
        
        $session = MethodUtils::getSessionData();
        if(!isset($session['month_ecommerce']) || $session['month_ecommerce'] == '') MethodUtils::setSessionData('month_ecommerce', date('m'));
        if(!isset($session['year_ecommerce']) || $session['year_ecommerce'] == '') MethodUtils::setSessionData('year_ecommerce', date('Y'));
        
        $result['month'] = $session['month_ecommerce'];
        $result['year'] = $session['year_ecommerce'];
        
        try{
            $data = array('loja_step_1', 'loja_step_2', 'loja_step_3', 'loja_step_3a', 'loja_step_3b', 'loja_step_3c', 'loja_step_4', 'loja_step_5', 'loja_step_6', 'loja_step_7', 'loja_step_7_error', 'maxima_analise');
            $result['milestone'] = $milestoneHandler->getAllMilestoneFor('produtos', $data);
            
            //Iniciando Pagamento
            $result['step_1'] = ActivityLogger::getLogsByDate('ecommerce_carrinho', $result['month'], $result['year']);
            $result['size_step_1'] = MathUtils::getPercentage($result['milestone']['loja_step_1'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_1'] = MathUtils::getPercentage(count($result['step_1']), $result['milestone']['loja_step_1']);
            
            //Identificação
            $result['step_2'] = ActivityLogger::getLogsByDate('ecommerce_identificacao', $result['month'], $result['year']);
            $result['size_step_2'] = MathUtils::getPercentage($result['milestone']['loja_step_2'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_2'] = MathUtils::getPercentage(count($result['step_2']), $result['milestone']['loja_step_2']);
            
            //Cadastro novo usuário
            $result['step_3'] = ActivityLogger::getLogsByDate('ecommerce_cadastro_usuario', $result['month'], $result['year']);
            $result['size_step_3'] = MathUtils::getPercentage($result['milestone']['loja_step_3'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_3'] = MathUtils::getPercentage(count($result['step_3']), $result['milestone']['loja_step_3']);
            
            //Informe endereco
            $result['step_3a'] = ActivityLogger::getLogsByDate('ecommerce_informe_endereco', $result['month'], $result['year']);
            $result['size_step_3a'] = MathUtils::getPercentage($result['milestone']['loja_step_3a'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_3a'] = MathUtils::getPercentage(count($result['step_3a']), $result['milestone']['loja_step_3a']);
            
            //Cadastro de usuário efetivado
            $result['step_3b'] = ActivityLogger::getLogsByDate('ecommerce_cadastro_efetivado', $result['month'], $result['year']);
            $result['size_step_3b'] = MathUtils::getPercentage($result['milestone']['loja_step_3b'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_3b'] = MathUtils::getPercentage(count($result['step_3b']), $result['milestone']['loja_step_3b']);            
            
            //Cadastro / Atualização endeeco
            $result['step_3c'] = ActivityLogger::getLogsByDate('ecommerce_cadastro_endereco_efetivado', $result['month'], $result['year']);
            $result['size_step_3c'] = MathUtils::getPercentage($result['milestone']['loja_step_3c'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_3c'] = MathUtils::getPercentage(count($result['step_3c']), $result['milestone']['loja_step_3c']);
            
            //Embalagem
            $result['step_4'] = ActivityLogger::getLogsByDate('ecommerce_embalagem', $result['month'], $result['year']);
            $result['size_step_4'] = MathUtils::getPercentage($result['milestone']['loja_step_4'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_4'] = MathUtils::getPercentage(count($result['step_4']), $result['milestone']['loja_step_4']);
            
            //Envio
            $result['step_5'] = ActivityLogger::getLogsByDate('ecommerce_escolhe_frete', $result['month'], $result['year']);
            $result['size_step_5'] = MathUtils::getPercentage($result['milestone']['loja_step_5'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_5'] = MathUtils::getPercentage(count($result['step_5']), $result['milestone']['loja_step_5']);
            
            //Escolha da forma de pagamento
            $result['step_6'] = ActivityLogger::getLogsByDate('ecommerce_forma_pagamento', $result['month'], $result['year']);
            $result['size_step_6'] = MathUtils::getPercentage($result['milestone']['loja_step_6'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_6'] = MathUtils::getPercentage(count($result['step_6']), $result['milestone']['loja_step_6']);
            
            //Escolha da forma de pagamento
            $result['step_7'] = ActivityLogger::getLogsByDate('ecommerce_pagamento_final', $result['month'], $result['year']);
            $result['size_step_7'] = MathUtils::getPercentage($result['milestone']['loja_step_7'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_7'] = MathUtils::getPercentage(count($result['step_7']), $result['milestone']['loja_step_7']);
            
            //Escolha da forma de pagamento
            $result['step_7_error'] = ActivityLogger::getLogsByDate('ecommerce_pagamento_final_error', $result['month'], $result['year']);
            $result['size_step_7_error'] = MathUtils::getPercentage($result['milestone']['loja_step_7_error'], $result['milestone']['maxima_analise']);
            $result['porcentagem_step_7_error'] = MathUtils::getPercentage(count($result['step_7_error']), $result['milestone']['loja_step_7']);
            
            $result['dicas'] = DicasUtils::getTips("statistics", 'ecommerce');
            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("/admin/pages/loja/analises", $result);

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: CurriculosAction - estatisitcas() ' . $e->getMessage();
        }   
    }
    
    /**
     * Method resposible to apply the CSS and JAvascript layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($type = false){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        if(!$type){
            //Funcionalidades javascript
            $cs->registerScriptFile($baseUrl . '/js/lib/jquery.json.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/admin/extremos.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/admin/loja.js', CClientScript::POS_END);
            $cs->registerCssFile($baseUrl    . '/css/lib/cool/extremos.css', 'screen', CClientScript::POS_HEAD); 

            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);

            $cs->registerScriptFile($baseUrl . '/js/admin/categorias.js', CClientScript::POS_END);     
            $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END);
        }
        
        if($type == 'categorias'){
            
            //Funcionalidades javascript
            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);
            
            $cs->registerScriptFile($baseUrl . '/js/admin/categorias.js', CClientScript::POS_END); 
            $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END);
            
        }
        
        if( $type == 'compra'){
            //Funcionalidades javascript
            $cs->registerScriptFile($baseUrl . '/js/admin/loja_comprar.js', CClientScript::POS_END);
            
        }
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
    }
    
}
?>