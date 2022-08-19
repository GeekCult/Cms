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
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');

        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.site.pedidos.common.PedidosManager');
        Yii::import('application.extensions.dbuzz.admin.ProdutosManager');
        Yii::import('application.extensions.utils.DicasUtils');

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
        
        
        $this->id = (string)Yii::app()->getRequest()->getQuery('id'); 
        
        $this->session = MethodUtils::getSessionData();
        $this->id_usuario = $this->session['id'];

        switch($this->action){

            case "novo":
            case "criar":
                $this->novo('novo');
                break;

            case "editar":
                $this->novo('editar');
                break;
            
            case "marketplace":
                $this->marketPlace();
                break;
            
            case "listar":
            case "":
            case "listar_modulos":
                $this->listar();
                break;

            case "remover":
                $this->remover();
                break;
            
            case "remover_image":
                $this->removerImage();
                break;

            case "salvar":
                $this->salvar();
                break;

            case "status":
                $this->updateStatus();
                break;

            case "salvar_detalhes":
                $this->salvarDetalhes();
                break;

            case "obter_produtos":
                $this->obterProdutos();
                break;
            
            case "exibir_order":
                $this->exibirOrder();
                break;
            
            case "adicionar_items":
                $this->adicionarItems();
                break;
            
            case "categorias_novo":
                $this->novoCategoria();
                break;
            
            case "categoria_settings":
                $this->settingMainCategoria();
                break;
            
            case "categoria_settings_salvar":
                $this->salvarSettingsMainCategoria();
                break;
            
            case "categorias":
                $this->novoCategoria();
                break;
            
            case "adicionar":
                $this->adicionar();
                break;
            
            case "sub_adicionar":
                $this->subAdicionar();
                break;

            case "categorias_listar":
                $this->listarCategoria();
                break;
            
            case "cadastrar_categoria":
                $this->cadastrarCategoria();
                break;
            
            case "remover_categoria":
                $this->removerCategoria();
                break;
            
            case "comentarios":
                $this->comentarios();
                break;
            
            case "comentarios":
                $this->comentarios(0);
                break;
            
            case "comentarios_aprovados":
                $this->comentarios(1);
                break;
            
            case "buscar":
                $this->buscar();
                break;
            
            default:
                $this->listar(true);
                break;

        }
    }
    
    /*
     * Buscar produtos
     * 
     */
    public function buscar(){
        
        try{
            $recordset['content'] = $this->produtosHandler->searchContent();
            $result['view'] = $this->controller->renderPartial("/admin/pages/produtos/special/items", $recordset, true); 
            echo json_encode($result);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR' . $e->getMessage();
        }
    }
    
    /*
     * Lista todos os produtos
     * 
     * @param boolean
     * 
     */
    public function listar($isCategoria = false){
        
        try{
            $request = Yii::app()->request;
   
            //Get the current controller name
            $controllerSelector = $this->getController()->getId();
            $session = MethodUtils::getSessionData();
            
            //Paginação LIMIT
            if(isset($_GET['p'])){
                $data['ind'] = $_GET['p'];
                $start = ($data['ind'] -1) * 10;
                if($start < 0 ){ $start = 0;$data['ind'] = 1;}
            }else{
                $data['ind'] = 1;
                $start = 0;
            }
            
            //Utiliza uma marcação ajax para separar a pesquisa  
            switch($this->id){            
                case "":
                case "todos":
                    
                    //Verifica se é Administrador(4) ou Acessor(1)
                    if($session['acess_level'] == 4) $data['content'] = $this->produtosHandler->getAllContent(true, "todos", 0, $start);
                    if($session['acess_level'] == 1) $data['content'] = $this->produtosHandler->getAllContent(true, "owner", $session['id'], $start);
                    
                    break;

                case "modular":
                case "produto":  
                case "modulo":
                case "programa":
                    //Verifica se é Administrador(4) ou Acessor(1)
                    if($session['acess_level'] == 4) $data['content'] = $this->produtosHandler->getAllContent(true, $this->id);
                    if($session['acess_level'] == 1) $data['content'] = $this->produtosHandler->getAllContent(false, $this->id, $session['id']);
                    break;

                case "from_owner":
                    $data['content'] = $this->produtosHandler->getContentByIdType($this->id_usuario, "users");
                    break;
                
                default:
                    //$data['content'] = $this->produtosHandler->getAllContentByCategoria($this->id, "", '', 0, $order_array = array('order_by' => '', 'order_by_ecom' => '','max' => 10), 'exibe_produtos', $controllerSelector);
                    //$data['descricao_categoria'] = $this->categorias->getProductCategoryByLabel($this->id);
                    break;
                    
            }
            
            // BreadCrumb
            $data['bread_crumb'] = ProdutosUtils::getBreadCrumb($this->action, $this->cat, $this->sub, $this->subitem);
            
            // Order By
            $data['attr'] = ProdutosUtils::getEcommerceDetails();
            
            // Paginacao
            $data['prd'] = ProdutosUtils::getPaginationAttributes($this->action, $this->cat, $this->sub, $this->subitem);
            $data['paginacao'] = MethodUtils::getPaginationAttributes($data, C::PRODUTOS_ADMIN);
            $data['id_page'] = $this->nr_page;

            $data['categorias'] = $this->categorias->getAllProductCategories(2);
            $data['categoria_selected'] = $this->id;
            if($session['produtos_mais_filtro'] != ''){$data['mais_filtros'] = $session['produtos_mais_filtro'];}else{$data['mais_filtros'] = "";}
            if($session['produtos_filtro_categoria'] != ''){$data['filtro_categoria'] = $session['produtos_filtro_categoria'];}else{$data['filtro_categoria'] = "";}

            $pack_info = ProdutosUtils::getViewByTypeBusiness(); 
            
            //Load tips
            $data['dicas'] = DicasUtils::getTips(C::VAR_LIST, $pack_info[C::TIPO]); 
            $data['tipo'] = $this->id;

            $data['preferences']['design_site'] = C::VAR_EMPTY;            
         
            $data['session'] = MethodUtils::getSessionData(); 
            $data['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'item', 'action' =>'listar'));       
            
            $this->addScript("listar");
            $this->controller->layout = "admin/admin"  . Yii::app()->params['admin_versao'];
            $this->controller->render("/admin/pages/produtos/special/listar", $data);           
            
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR' . $e->getMessage();
        }
    }
    
    /*
     * Editar um produto existente
     * 
     * 
     */
    public function novo($action){
        
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
        try{
            //Verifica se foi enviado o id do produto via POST ou
            //Se esta no URL da requisição
            if($action == 'editar')(isset($_POST['id_produto'])) ? $id_produto = $_POST['id_produto'] : $id_produto = $this->id;
            if($action == 'novo') $id_produto = 0;

            $layout = $this->manager->getLayout();
            $data['menu_principal'] = $this->manager->getMenu();
            $data['plataform'] = $layout["plataform"];
            $data['preferences'] = $this->preferences->getPreferences(); 
            $data['isBanner'] = $this->manager->getBannerMainShow("produtos");

            $data['ERROR'] = '0';

            //Form Token ID
            //$tokenName = "token_cc_pool";

            //Form Parameters
            //$data['FORM_SUBMIT_TO'] = '/produtos/salvar/';

            //$data['FORM_MODE'] = 'new'; //new
            //$data['FORM_ACTION_NEW'] = 'Editar';
            //$data['FORM_ACTION_DESC'] = 'editar um produto existente';
            //$data['token_cc_pool'] = "";

            if($action == 'editar') $result['content'] = $this->produtosHandler->getContentById($id_produto, "editar");
            if($action == 'novo') $result['content'] = ProdutosUtils::getClearContent();

            $pa = new dbProdutosAttribute();
            $pa->setCurrentProduto($id_produto);

            //Form Standard Data
            $data['id_produto'] = $result['content']['id'];
            $data['referencia'] = $result['content']['referencia'];
            $data['formPoolNome'] = $result['content']['nome'];
            $data['formPoolCategoria'] = $result['content']['id_categoria'];
            $data['formPoolSubCategoria'] = $result['content']['id_subcategoria'];
            $data['formPoolSubItem'] = $result['content']['id_subitem'];
            $data['formPoolCategoriaDesc'] = "Selecione uma categoria";
            $data['formPoolMarca'] = $result['content']['marca'];
            $data['id_user'] = $result['content']['id_user'];
            $data['id_master'] = $result['content']['id_master'];
            $data['n_index'] = $result['content']['n_index'];
            $data['formPoolPalavraChave'] = $result['content']['keywords'];
            $data['formPoolMarcaOutra'] = "";
            $data['formPoolType'] = $result['content']['tipo'];
            $data['formDescricao'] = $result['content']['descricao'];
            $data['descricao_resumo'] = $result['content']['descricao_resumo'];
            $data['formPoolValorReal'] = $result['content']['preco_real'];
            $data['formPoolValor'] = $result['content']['preco'];
            $data['formPoolDataInicio'] = $result['content']['date_start'];
            $data['formPoolDataTermino'] = $result['content']['date_end'];
            $data['formPoolNrMin'] = $result['content']['unidades_min'];
            $data['formPoolNrMax'] = "1";
            $data['formPoolPrazoEntrega'] = $result['content']['entrega'];
            $data['formPoolNrMaxPerson'] = "1";
            $data['formPoolPercentage'] = $result['content']['percentage'];
            $data['parcelas'] = $result['content']['parcelas'];
            $data['formPoolPeso'] = "1";
            $data['formPoolFreteCHECKED'] = 0;
            $data['formPoolDivulgacaoHomeCHECKED'] = 0;
            $data['formPoolDivulgacaoPromocionalCHECKED'] = 0;
            $data['formPoolDivulgacaoEmpresasCHECKED'] = 0;
            $data['formPoolRegiao'] = "São Paulo";
            $data['formPoolEstado'] = '0';
            $data['formPoolEstadoCHECKED'] = "1";
            $data['reputation'] = $result['content']['reputation'];
            $data['id_categoria_menu'] = $result['content']['id_categoria_menu'];
            $data['action'] = $action;

            //Slot pictures
            $data['formSlotPicture1'] = $pa->recuperar('produto_IMG_1');
            $data['formSlotPicture2'] = $pa->recuperar('produto_IMG_2');
            $data['formSlotPicture3'] = $pa->recuperar('produto_IMG_3');
            $data['formSlotPicture4'] = $pa->recuperar('produto_IMG_4');
            $data['formSlotPicture5'] = $pa->recuperar('produto_IMG_5');
            $data['formSlotPicture6'] = $pa->recuperar('produto_IMG_6');

            //Extras
            $data['extra1'] = $pa->recuperar('extra1');
            $data['extra2'] = $pa->recuperar('extra2');
            
            //Extras
            $data['video1'] = $pa->recuperar('video1', 'descricao');    
            $data['sob_consulta'] = $result['content']['sob_consulta'];

            //Informacoes
            $data['vitrine'] = $result['content']['vitrine'];
            $data['lancamento'] = $result['content']['lancamento'];
            $data['promocao'] = $result['content']['promocao'];
            $data['ecommerce_exibe'] = $result['content']['exibe_ecommerce'];
            $data['produtos_exibe'] = $result['content']['exibe_produtos'];

            //Medidas
            $data['peso'] = $result['content']['peso'];
            $data['largura'] = $result['content']['largura'];
            $data['altura'] = $result['content']['altura'];
            $data['comprimento'] = $result['content']['comprimento'];
            $data['diametro'] = $result['content']['diametro'];

            //Transporte
            $data['transporte'] = $result['content']['transporte'];
            $data['retirar_local'] = $result['content']['retirar_local'];
            $data['embrulho'] = $result['content']['embrulho'];
            $data['ordem_servico'] = $result['content']['ordem_servico'];
            $data['frete_gratis'] = $result['content']['frete_gratis'];


            //Get categorias, deve ser cadastrada em categorias, selecionar produtos
            $result['page'] = $this->manager->getController("produtos/novo");
            $data['id_controller'] = $result['page']['id'];
            $id_controller = $this->controllerIDHandler->getContentControllerByLabel("produtos");
            $data['categorias'] = $this->categorias->getAllProductCategories(2);

            $data['responsavel'] = UserUtils::getAllKindUsers("pedidos");

            $data['states']  = $this->regiao->getAllStates();
            $data['dicas'] = DicasUtils::getTips("new", "produtos");

            //Get the current controller name
            $controllerSelector = $this->getController()->getId();

            //Adiciona as categorias para exibi menu droplist
            $data['categorias_paginas'] = $this->categorias->getAllContentById(2);//TODO replace this hard-coded

            $data['session'] = MethodUtils::getSessionData(); 
            $data['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'item', 'action' => 'novo'));
            
            //Form Parameters
            $data['FORM_SUBMIT_TO'] = '/admin/produtos/salvar';
            $data['preferences']['design_site'] = "empty";
            
            $this->addScript("editar");
            $this->controller->layout = "admin/admin";           
            $this->controller->render("/admin/pages/produtos/editar/product_common", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ProdutosAction - novo() ' . $e->getMessage();
        }
    }
    
    /*
     * 
     * Salva o produto em foco
     * 
     * Este método é utilziado tanto para editar quanto para 
     * criar um novo produto
     * 
     * 
     */
    private function salvar(){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.dbuzz.admin.ImagesManager');
        
        $request = Yii::app()->request;
        $isPostRequest = $request->isPostRequest;

        $data['ERROR'] = '0';

        try{

            // Se for POST e tiver tokenName, e se o token estiver correto na ses
            // If it is a POST request and there's a tokenName, and if the token is correct in the session
            if ($isPostRequest){
                
                $data['action'] = $_POST['action'];

                $produto = new EcommerceProdutos();
                $imagesHandler = new ImagesManager();

                //if we are editing an already existing pool, this will be set
                if(isset($_POST['id_produto']) && $_POST['id_produto'] != ""){
                    $data['editar'] = true;
                    $data['id_produto'] = $_POST['id_produto'];
                    $produto->id = $_POST['id_produto'];
                    $produto = EcommerceProdutos::model()->find('id=:produtoID', array(':produtoID'=>$_POST['id_produto']));

                }else{
                    $data['editar'] = false;
                    $data['id_produto'] = "0";
                    $produto->data = date('Y-m-d H:i:s');
                }

                $data['categoriaEscolhida'] = $_POST['categoria'];
                $data['categoria'] = $_POST['categoria'];

                $produto->marca =  $_POST['marca'];
                if(isset($_POST['categoria']))$produto->id_categoria = $_POST['categoria'];
                if(isset($_POST['subcategoria'])){$produto->id_subcategoria = $_POST['subcategoria'];}else{$produto->id_subcategoria = 0;}
                if(isset($_POST['subitem'])){$produto->id_subitem = $_POST['subitem'];}else{$produto->id_subitem = 0;}
                if(isset($_POST['referencia'])) $produto->referencia = $_POST['referencia'];
                if(isset($_POST['n_index'])) $produto->n_index = $_POST['n_index'];
                if(isset($_POST['reputacao'])) $produto->reputation = $_POST['reputacao'];

                // Produto start and end dates
                $produto->last_update = date('Y-m-d H:i:s');
                $produto->date_end = $this->valida->estampa($_POST['data_termino']);
                $produto->date_start = $this->valida->estampa($_POST['data_inicio']);
                $produto->descricao = $_POST['descricao'];
                $produto->descricao_resumo = $_POST['descricao_resumo'];
                $produto->nome = $_POST['nome'];                
                $produto->status = 1;
                $produto->preco = str_replace(',', '.', $_POST['valor']);
                $produto->preco_real = str_replace(',', '.', $_POST['valor_real']);                

                //Must have two decimal places, decimal separator must be a period (.), and the optional thousands separator must be a comma (,).
                //$produto->price_min = str_replace('.', '', str_replace(',', '', $_POST['formPoolValorMinimo']));
                
                $produto->unidades_min = $_POST['min'];
                $produto->unidades_max = $_POST['max'];
                $produto->percentage = (isset($_POST['percentage'])) ? $_POST['percentage'] : 0;
                $produto->last_update = date("Y-m-d H:i:s");
                $produto->show_transport = $_POST['frete'];
                $produto->frete_gratis =  MethodUtils::getBooleanNumber($_POST['frete_gratis']);
                $produto->estado_produto = $_POST['estado'];
                $produto->entrega = $_POST['prazo_entrega'];
                $produto->parcelas = $_POST['parcelas'];
                $produto->unidades_person = $_POST['max_person'];
                $produto->url = StringUtils::StringToUrl($_POST['nome'], true, '-');
                if(isset($_POST['id_categoria_menu'])){$produto->id_categoria_menu = $_POST['id_categoria_menu'];} else{ $produto->id_categoria_menu = null;};
             
                //Id User
                ($_POST['id_user'] == 0) ? $produto->id_user = Yii::app()->user->id : $produto->id_user = $_POST['id_user'];
                if($data['editar']) $setPrograms = ProdutosUtils::updateIdMasterUsers($data['id_produto'], $produto->id_user);
                
                //Medidas
                $produto->peso = ProdutosUtils::getWeightCode($_POST['peso']);
                $produto->largura = $_POST['largura'];
                $produto->altura = $_POST['altura'];
                $produto->comprimento = $_POST['comprimento'];
                $produto->diametro = $_POST['diametro'];
                
                //Linked to
                if(isset($_POST['linked'])) $produto->id_master = $_POST['linked'];
                //Sob consulta
                if(isset($_POST['sob_consulta'])) $produto->sob_consulta = MethodUtils::getBooleanNumber($_POST['sob_consulta']);
                
                //Informações
                if(isset($_POST['ecommerce_exibe'])){$produto->exibe_ecommerce = MethodUtils::getBooleanNumber($_POST['ecommerce_exibe']);}
                if(isset($_POST['produtos_exibe'])){$produto->exibe_produtos = MethodUtils::getBooleanNumber($_POST['produtos_exibe']);}else{$produto->exibe_produtos = 0;}
                if(isset($_POST['promocao'])){$produto->promocao = $_POST['promocao'];}else{$produto->promocao = 0;}
                if(isset($_POST['vitrine'])){$produto->vitrine = MethodUtils::getBooleanNumber($_POST['vitrine']);}
                if(isset($_POST['ordem_servico'])){$produto->ordem_servico = MethodUtils::getBooleanNumber($_POST['ordem_servico']);}
                if(isset($_POST['lancamento'])){$produto->lancamento = MethodUtils::getBooleanNumber($_POST['lancamento']);}
                
                //Transporte
                if(isset($_POST['transporte'])){$produto->transporte = $_POST['transporte'];}else{$produto->transporte = 0;}
                if(isset($_POST['retirar_local'])){$produto->retirar_local = MethodUtils::getBooleanNumber($_POST['retirar_local']);}
                if(isset($_POST['embrulho'])){$produto->embrulho = $_POST['embrulho'];}else{$produto->embrulho = 0;}
                
                if(isset($_POST['palavra_chave']))$produto->keywords = $_POST['palavra_chave'];
                //if(isset($_POST['tipo'])){$produto->tipo = $_POST['tipo'];}else{$produto->tipo = "produto";}
                $produto->tipo = "simples";
                
                
                //Get categorias, deve ser cadastrada em categorias, selecionar produtos
                //$result['page'] = $this->manager->getController("produtos/novo");

                include 'protected/extensions/digitalbuzz/validar/produtos/product_common.php';

                $produto->setScenario('criar');
                $produto->validate();
               
                //Repopular o Formulario
                foreach ($_POST as $key => $value) {
                    $data[$key] = $value;
                    //if($_POST['formPoolNome'] == "") $error[] = "É necessário estar preenchendo o campo nome";
                }
           
                $produto->save();
                
                $result['id_produto'] =  $produto->id;
        
                Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');
                $pa = new dbProdutosAttribute();
                $pa->setCurrentProduto($result['id_produto']);

                //Works with pictures
                for($i = 1; $i <= 6; $i++) {
                    if (isset($_POST['picture' . $i]) && $_POST['picture' . $i] != ""){
                        if($_POST['picture' . $i] == "empty"){
                            $pa->adicionar("produto_IMG_" . $i, "");
                        }else{
                            $pa->adicionar("produto_IMG_" . $i, $_POST['picture' . $i]);
                        }
                    }
                }

                if(isset($_POST['extra1'])) $pa->adicionar("extra1", $_POST['extra1']);
                if(isset($_POST['extra2'])) $pa->adicionar("extra2", $_POST['extra2']);
                
                //Videos
                if(isset($_POST['video1'])) $pa->adicionar("video1", $_POST['video1'], 'descricao');
               

                //$data['categorias'] = $this->categorias->getAllProductCategories();

                if(isset($_POST['regiao'])) $result_save_regions = $this->regiao->saveProdutosRegions($produto->id, $_POST['regiao']);
                
                //Se for ecommerce e for novo cria um estoque
                //if(Yii::app()->params['ramo'] == "ecommerce") {if(!$data['editar']){ 
                   // Yii::import('application.extensions.digitalbuzz.produtosAttribute.EstoqueAttribute');
                   // $ea = new EstoqueAttribute();
                   // $ea->setCurrentProduto($result['id_produto']);
                    //$ea->adicionar('Principal', 0, 0, 0, 0, 0, 'main');
                //}}
                    
                
            }            

            //Create xml
            $createRSSFeed = HelperUtils::createFeed("produtos");
            $createRSSFeed = HelperUtils::createFeed("sitemap");
            
            if($data['action'] == 'novo')   $result['message'] = Yii::t('messageStrings', 'message_result_ecommerce_product');
            if($data['action'] == 'editar') $result['message'] = Yii::t('messageStrings', 'message_result_ecommerce_product_update');
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            echo json_encode($result);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR ProdutosAction - salvar() ' . $e->getMessage();
        }
    }
    
    /*
     * Remove o produto em foco
     * 
     * This method uses the ProdutosManager class to conclude
     * the request.
     * 
     * 
     */
    public function remover(){
        
        $id_produto = $_POST['id'];
        
        try{
            $this->produtosHandler->removeContent($id_produto);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }       
    }
    
    /*
     * Remove o produto em foco
     * 
     * This method uses the ProdutosManager class to conclude
     * the request.
     * 
     * 
     */
    public function removerImage(){
        
        $id_image = $_POST['id_image'];
        $id_produto = $_POST['id_produto'];
        $name_image = $_POST['name_image'];
        
        try{
            $this->produtosHandler->removeImage($id_produto, $id_image, $name_image);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ProdutosAction - removerImage() " . $e->getMessage();
        }       
    }
    
    /*
     * Atualiza o status do produto
     * It uses the ProdutosUtils class
     * 
     * 0 - WAITING
     * 1 - COMPLETE
     * 2 - NEW COMMENT
     * 3 - CANCEL
     * 4 - DISABLED
     * 
     * 
     */
    public function updateStatus(){
        
        $data['status'] = $_POST['status'];
        $data['id_produto'] = $_POST['id_produto'];
        
        $update = $this->produtosHandler->updateStatus($data);        
        echo $update;
    }
    
    /*
     * Atualiza o status do produto
     * It uses the ProdutosUtils class
     * 
     * 
     */
    public function salvarDetalhes(){    
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
        try{
            //Preferences attributes
            (isset($_POST['bt_shopcart'])) ? $data['bt_shopcart'] = $_POST['bt_shopcart'] : $data['bt_shopcart'] = '';
            (isset($_POST['frame_vitrine'])) ? $data['frame_vitrine'] = $_POST['frame_vitrine'] : $data['frame_vitrine'] = '';
            (isset($_POST['menu_loja'])) ? $data['menu_loja'] = $_POST['menu_loja'] : $data['menu_loja'] = '';
            (isset($_POST['layout_exibicao'])) ? $data['layout_exibicao'] = $_POST['layout_exibicao'] : $data['layout_exibicao'] = '';
            (isset($_POST['ordenar_exibicao'])) ? $data['ordenar_exibicao'] = $_POST['ordenar_exibicao'] : $data['ordenar_exibicao'] = '';
            (isset($_POST['frete_gratis'])) ? $data['frete_gratis'] = $_POST['frete_gratis'] : $data['frete_gratis'] = 0;

            //Preferences data 
            $data['free'] = $_POST['valor_free'];
            $data['showcase'] = MethodUtils::getBooleanNumber($_POST['showcase']);
            $data['categorias_home'] = MethodUtils::getBooleanNumber($_POST['categorias_home']);
            $data['transporte'] = MethodUtils::getBooleanNumber($_POST['transporte']);
            $data['frete_gratis_valor'] = CurrencyUtils::checkFloatFormat($data['frete_gratis']); //Se valor da compra for superior
            $data['quantidade'] = MethodUtils::getBooleanNumber($_POST['quantidade']);
            $data['parcelamento'] = MethodUtils::getBooleanNumber($_POST['parcelamento']);
            $data['embalagem'] = MethodUtils::getBooleanNumber($_POST['embalagem']);
            (isset($_POST['cep'])) ? $data['cep'] = $_POST['cep'] : $data['cep'] = '';
            $data['vitrine_layout'] = $_POST['vitrine_layout'];
            $data['categoria_home_layout'] = $_POST['categoria_home_layout'];
            (isset($_POST['outras_informacoes'])) ? $data['outras_informacoes'] = $_POST['outras_informacoes'] : $data['outras_informacoes'] = '';
            (isset($_POST['prazo_entrega'])) ? $data['prazo_entrega'] = $_POST['prazo_entrega'] : $data['prazo_entrega'] = '';
            (isset($_POST['mensagem'])) ? $data['mensagem'] = $_POST['mensagem'] : $data['mensagem'] = '';
            (isset($_POST['exibe_preco'])) ? $data['exibe_preco'] = MethodUtils::getBooleanNumber($_POST['exibe_preco']) : $data['exibe_preco'] = 0;
            (isset($_POST['exibe_foto'])) ? $data['exibe_foto'] = MethodUtils::getBooleanNumber($_POST['exibe_foto']) : $data['exibe_foto'] = 0;
            (isset($_POST['exibe_descricao'])) ? $data['exibe_descricao'] = MethodUtils::getBooleanNumber($_POST['exibe_descricao']) : $data['exibe_descricao'] = 0;

            $setPreferenceData = PreferencesUtils::setEcommerceSettings($data);

            $setAttributes = PreferencesUtils::setAttributes("bt_shopcart", $data['bt_shopcart'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("frame_vitrine", $data['frame_vitrine'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("menu_loja",$data['menu_loja'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("cep_origem",$data['cep'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("vitrine_layout",$data['vitrine_layout'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("categorias_home",$data['categorias_home'], "inteiro");
            $setAttributes = PreferencesUtils::setAttributes("outras_informacoes",$data['outras_informacoes'], "descricao");
            $setAttributes = PreferencesUtils::setAttributes("prazo_entrega",$data['prazo_entrega'], "descricao");
            $setAttributes = PreferencesUtils::setAttributes("mensagem",$data['mensagem'], "descricao");
            $setAttributes = PreferencesUtils::setAttributes("categoria_home_layout",$data['categoria_home_layout'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("menu_produtos_type", $_POST['menu_produtos_type'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("frete_gratis_valor", $data['frete_gratis_valor'], "number");
            $setAttributes = PreferencesUtils::setAttributes("limite_pagina", $_POST['limite_pagina'], "inteiro");
            $setAttributes = PreferencesUtils::setAttributes("produtos_layout_exibicao", $data['layout_exibicao'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("produtos_ordenar_exibicao", $data['ordenar_exibicao'], "texto");
            $setAttributes = PreferencesUtils::setAttributes("produtos_exibe_valor", $data['exibe_preco'], "inteiro");
            $setAttributes = PreferencesUtils::setAttributes("produtos_exibe_foto", $data['exibe_foto'], "inteiro");
            $setAttributes = PreferencesUtils::setAttributes("produtos_exibe_descricao", $data['exibe_descricao'], "inteiro");
            
            $content = HelperUtils::createCss();

            $result = array('ERROR' => false, "message" => Yii::t('messageStrings', 'message_result_settings_update'));
            $set = MethodUtils::setSessionData("SES_ecommerce_details", "");

            echo json_encode($result);
        
        }catch(CDbException $e){
            //Yii::trace("ERROR " . $e->getMessage());
            //Infos
            $error = array('message' => 'ERROR: ProdutosAction - salvarDetalhes()', 'trace' => $e->getMessage());
            $send_error = MethodUtils::sendError($error, true);
            
            echo 'ERROR: ProdutosAction - salvarDetalhes() ' . $e->getMessage();
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
    
    /**
     *
     * Exibir Order
     * Exibe os produtos definidos como ordem de serviço
     *
     */
    public function exibirOrder() {
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.OrdemAlfabeticaUtils');
        
        $userHandler = new UsersManager();
        
        $session = MethodUtils::getSessionData();        
        
        $result['ind'] = $this->id;
        
        if($result['ind'] == '' || $result['ind'] <= 0 ) $result['ind'] = 0;

        try { 
            
            $result['content'] = $this->produtosHandler->getContentByIdType(null, 'ordem_servico', $result['ind']);
            
            $result['id_page'] = false;
            
            //Paginacao            
            $result['action'] = $this->action . '/id';
            $result['paginacao'] = MethodUtils::getPaginationAttributes($result, 'ordem_servico');
            
            //$this->addScript("user", $isAdmin);
            $this->controller->layout = 'admin/admin_base';
            $this->controller->render("/admin/pages/produtos/special/exibir_order", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Adicionar Entidade
     *
     */
    public function adicionarItems() {
        
        $session = MethodUtils::getSessionData();        
        
        try {   
            $result = array();
            $this->controller->layout = 'admin/admin_base';
            $this->controller->render("/admin/pages/produtos/special/adicionar_item", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /*
     * Adicionar for Fancybox 
     * 
     * Add the main attributes
     * It uses a PaginaManager Class to populate the combox with
     * all pages recorded there.
     *
     */
    public function adicionar(){

        $result = array();

        try{            
            $result['id_page'] = $this->id;           
            $result['content']['id_page'] = $this->id;
            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";
            
            $this->controller->layout = "admin/admin_base";
            $this->controller->render("pages/produtos/categorias/categorias_adicionar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }         
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
            $result['categorias']   = $this->categorias->getAllProductCategories(2);          
            $result['content']['id_page'] = $this->id;
            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";
            
            $this->controller->layout = "admin/admin_base";
            $this->controller->render("pages/produtos/categorias/categorias_adicionar_sub", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }        
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
    public function novoCategoria(){

        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['categorias']   = $this->categorias->getAllProductCategories(2);
            
            //Se houver categorias busca subcategroias
            if(isset($result['categorias'][0]['id_categoria'])){
                $result['subcategorias'] = $this->categorias->getAllProductSubCategories($result['categorias'][0]['id_categoria'], false, 2);
            }else{
                $result['subcategorias'] = array();
            }
            
            $result['content']['id_page'] = $this->id;            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";
            $result['id_subcategoria'] = "";
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'categorias', 'action' => 'novo'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScriptCategorias();        
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/produtos/categorias/". Yii::app()->params['admin_content'] ."categorias_novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }  
    }
    
    /**
     *
     * Edita a main categoria com definições, fotos de exibição da categoria e etc
     * This method does the submit form using a jQuery request
     *
     */
    public function settingMainCategoria(){
        
        Yii::import('application.extensions.dbuzz.admin.LojaManager');
        $storeHandler = new LojaManager();

        try{
            $result['session'] = MethodUtils::getSessionData();
            $result['content'] = $storeHandler->getSettingsCategoria($this->id);
            $result['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'categorias', 'action' => 'novo'));
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
            $result['link'] = 'produtos';
        
            $this->addScriptCategorias(); 
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/categorias/ecommerce/". Yii::app()->params['admin_content'] ."settings", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ProdutosAction - settingMainCategoria() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Listar Categoria
     * List the main atrributes and it opens the select item list.
     * Just select one of it to edit.
     *
     */
    public function listarCategoria(){
        
        $result = array();        

        try{
            $result['categorias'] = $this->categorias->getAllProductCategories(2);
            $result['subcategorias'] = $this->categorias->getAllProductSubCategories("", true, 2);
            $result['subitems'] = $this->categorias->getSubItemsEcommerce("", true, 2);
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'categorias', 'action' => 'listar'));
            $result['dicas'] = DicasUtils::getTips("categories", "produtos");

            $this->addScriptCategorias();
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/produtos/categorias/". Yii::app()->params['admin_content'] ."categorias_listar", $result);

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
        
        Yii::import('application.extensions.dbuzz.admin.LojaManager');        
        $storeHandler = new LojaManager();

        $data = array();
       
        $data['subitem_label'] = $_POST['label_item_subcategoria']; 
        $data['id_categoria'] = $_POST['id_categoria'];
        $data['id_subcategoria'] = $_POST['id_subcategoria'];
        $data['action'] = $_POST['action'];
        $data['tipo'] = 2;
        
        if($data['action'] == "novo"){
            $data['message'] = Yii::t("messageStrings", "message_result_subitem");
        }else{
            $data['message'] = Yii::t("messageStrings", "message_result_subitem_update");
        }

        try{
            $content = $storeHandler->submitContent($data);

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
        
        Yii::import('application.extensions.dbuzz.admin.LojaManager');        
        $storeHandler = new LojaManager();

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
            $content = $storeHandler->removeCategory($data);
            

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar Settings categoria
     * This method does the submit form using a jQuery request
     *
     */
    public function salvarSettingsMainCategoria(){
        
        Yii::import('application.extensions.dbuzz.admin.LojaManager');
        $storeHandler = new LojaManager();

        $data = array();
        
        $data['id_categoria'] = $_POST['id_categoria'];
        $data['nome'] = $_POST['nome']; 
        if(isset($_POST['index'])) {$data['index'] = $_POST['index'];}else{$data['index'] = 0;}
        $data['descricao'] = $_POST['descricao'];
        $data['graphic'] = $_POST['graphic'];
        $data['exibe'] = MethodUtils::getBooleanNumber($_POST['exibe']);
        $data['error'] = null;
        
        //Messages return
        $data['message'] = Yii::t("messageStrings", "message_result_category_update");

        try{
            $result = $storeHandler->saveSettingsMainCategoria($data);
            
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
     * Comentarios
     * 
     * This method list the comments from de database
     *
     */
    public function comentarios($status = 0){  
        
        Yii::import('application.extensions.utils.CommentsUtils');
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
          
        $commentsHandler = new ComentariosManager(); 

        $result = array();
        
        $data['id'] = 0;     
        $data['categoria'] = $status;       
        $data['tipo'] = 'produto';
        $tipo = 'produto';
        
        try{
            $result['content'] = $commentsHandler->getAllAdminComments($data, $tipo);
            $result['tipo'] = $tipo;
            $result['status'] = $status;
            
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'comentarios', 'action' => 'listar'));
            $result['dicas'] = DicasUtils::getTips(C::VAR_LIST, C::COMMENTS);
        
            $this->addScriptComentarios();
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/produtos/special/". Yii::app()->params['admin_content'] ."comentarios", $result);

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
    public function detalhes(){
        
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $categoriasHandler = new CategoriaManager();
        
        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['categorias']   = $categoriasHandler->getAllProductCategories();
            (isset($result['categorias'][0]['id_categoria'])) ? $cat = $result['categorias'][0]['id_categoria'] : $cat = 0;
            $result['subcategorias']   = $categoriasHandler->getAllProductSubCategories($cat);           
            $result['action'] = "novo";            
            $result['id_album'] = "";
            $result['attr'] = ProdutosUtils::getEcommerceDetails();
            
          
            $result['session'] = MethodUtils::getSessionData(); 
            $result['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'detalhes', 'action' => 'detalhes'));       
            $result['dicas'] = DicasUtils::getTips("stock", "produtos");
        
            $this->addScriptDetalhes();        
            $this->controller->layout = "admin/admin" . Yii::app()->params['admin_versao'];
            $this->controller->render("pages/produtos/special/". Yii::app()->params['admin_content'] ."detalhes", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }  
    }
    
    /*
     * Editar um produto para marketplaces
     * 
     * 
     */
    public function marketPlace(){
        
        
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $request = Yii::app()->request;
        $isAjaxRequest = $request->isAjaxRequest;
        $isPostRequest = $request->isPostRequest;
        
        try{
            $data['content'] = $this->produtosHandler->getContentById($this->id, "editar");
            $data['dicas'] = DicasUtils::getTips("marketplaces", "produtos");
            $data['session'] = MethodUtils::getSessionData(); 
            $data['sidemenu'] = HelperUtils::adminUtils('produtos', array('extra' => 'item', 'action' => 'novo'));
            
            //Form Parameters
            $data['FORM_SUBMIT_TO'] = '/admin/produtos/salvar';
            $data['preferences']['design_site'] = "empty";
            
            $this->addScript("marketplace");
            $this->controller->layout = "admin/admin";          
            $this->controller->render("/admin/pages/produtos/special/marketplace", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            $send_error = MethodUtils::sendError(array('message' => 'ERROR: ProdutosAction - salvarDetalhes()', 'trace' => $e->getMessage()));
            echo 'ERROR: ProdutosAction - marketplace() ' . $e->getMessage();
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
    public function addScript($place){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        if($place != "listar" && $place != 'marketplace'){

            //$cs->registerScriptFile($baseUrl . '/js/regioes/intro_regioes.js', CClientScript::POS_BEGIN);

            //Funcionalidades de comportamento javascript default desta view
            $cs->registerScriptFile($baseUrl . '/js/admin/produtos.js', CClientScript::POS_BEGIN);

            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
            $cs->registerCssFile($baseUrl . '/css/admin/general/produtos.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
            
        }else if($place == 'marketplace'){
            $cs->registerScriptFile($baseUrl . '/js/admin/special/marketplaces.js', CClientScript::POS_BEGIN);
            
        }else{ 
            
            if($place == "listar") $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
            $cs->registerScriptFile($baseUrl . '/js/admin/produtos.js', CClientScript::POS_BEGIN);
            //$cs->registerScriptFile($baseUrl . '/js/site/produtos/listar/produto_listar.js', CClientScript::POS_END);
            //$cs->registerScriptFile($baseUrl . '/js/html_components/comentarios.js', CClientScript::POS_END);
            //$cs->registerCssFile($baseUrl . '/css/site/components/comentarios/comentarios.css', 'screen', CClientScript::POS_HEAD);
            //$cs->registerCssFile($baseUrl . '/css/site/content/'. $layout .'.css', 'screen', CClientScript::POS_HEAD);
        }
        
        //$cs->registerCssFile($baseUrl . '/css/site/layout/layout_'. $model .'.css', 'screen', CClientScript::POS_HEAD); 
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
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
    public function addScriptCategorias(){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();        
        //Funcionalidades javascript
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.json.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/extremos.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/categorias.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl    . '/css/lib/cool/extremos.css', 'screen', CClientScript::POS_BEGIN); 
        
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/produtos.js', CClientScript::POS_BEGIN);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
    }
    
    /**
     * Comentarios
     *
     * @param string
     *
     */
    public function addScriptComentarios(){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript(); 
        
        $cs->registerScriptFile($baseUrl . '/js/admin/comentarios.js', CClientScript::POS_END); 
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
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
    public function addScriptDetalhes(){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();        
        //Funcionalidades javascript
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.json.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/extremos.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/loja.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl    . '/css/lib/cool/extremos.css', 'screen', CClientScript::POS_HEAD); 
        
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        
        $cs->registerScriptFile($baseUrl . '/js/admin/categorias.js', CClientScript::POS_BEGIN);     
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>