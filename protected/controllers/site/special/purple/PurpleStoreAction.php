<?php

class PurpleStoreAction extends CAction{
    
    private $purpleStoreHandler;
    private $preferences;
    private $manager;   
    private $action;
    private $type;
    private $id;

    /**
     * PurpleStore
     * Special Action
     *
     */
    public function run(){
        
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->type = Yii::app()->getRequest()->getQuery('type');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.site.special.PurpleStoreManager');
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.DicasUtils');
        Yii::import('application.extensions.dbuzz.DBManager');
        
        $this->purpleStoreHandler = new PurpleStoreManager();
        $this->preferences = new MyPreferences();
        $this->manager = new DBManager(); 

        switch($this->action){
            
            case "":
                $this->listar('componente_site');
                break;
            
            case "listar":
                $this->listar($this->id);
                break;
            
            case "novo":
                $this->editar();
                
                break;
            case "novo_template":
                $this->editar(false, 'extremos');
                break;
            
            case "nova_pagina":
                $this->editar(false, 'templates');
                break;
            
            case "editar":
                $this->editar($this->id);
                break;
            
            case "salvar":
                $this->salvar();
                break;
            
            case "exibe":
                $this->exibeLoja($this->id);
                break;
            
            case "exibe_conteudo":
                $this->exibeConteudo();
                break;
            
            case "comprar":
                $this->comprarItem();
                break;
            
            case "exibe_item":
                $this->exibeItem();
                break;
            
            //Minhas compras
            case "componentes":
                $this->listarCompras('blocos_pagina');
                break;
            
            case "aplicativos":
                $this->listarCompras('componente_site');
                break;
            
            //Fatura
            case "minha_fatura":
                $this->fatura();
                break;
            
            case "proxima_fatura":
                $this->fatura('proxima');
                break;
            
            case "fatura_anterior":
                $this->fatura('anterior');
                break;
            
            case "ver_fatura":
                $this->fatura('atual', true);
                break;
            
            case "editar_compra":
                $this->editarCompra();
                break;
            
            case "atualizar_compra":
                $this->atualizarCompra();
                break;
        }
    }
    
    /**
     * Listar Loja
     * It uses a helper class to controll the actions
     * 
     * @param string
     * 
    **/
    public function listar($tipo){
        
        try{
            $result['content'] = $this->purpleStoreHandler->getAllItems($tipo);
            $result['attributes'] = PurpleStoreUtils::getAttributes($tipo);
            
            $result['dicas'] = DicasUtils::getTips(C::STORE, C::PURPLESTORE);
        
            $this->addScript();
            $this->controller->layout = 'admin/admin';
            $this->controller->render("/admin/pages/purplestore/listar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
    }
    
    /**
     * Editar componente
     * It uses a helper class to controll the actions
     * 
     * @param string
     * 
    **/
    public function editar($id = false, $tipo = 'aplicativos'){
        
        try{
            if(!$id) $result['content'] = PurpleStoreUtils::getClearItem();
            if( $id) $result['content'] = $this->purpleStoreHandler->getItemById($id);
            
            $result['attributes'] = PurpleStoreUtils::getAttributes($result['content']['tipo']);
            $result['action'] = $this->action;
            
            $result['dicas'] = DicasUtils::getTips(C::STORE, C::PURPLESTORE);
            
            if($tipo == 'aplicativos') $view = 'editar';
            if($tipo == 'templates') $view = 'editar_templates';
            if($tipo == 'extremos') $view = 'editar_extremos';
        
            $this->addScript('editar');
            $this->controller->layout = 'admin/admin';
            $this->controller->render("/admin/pages/purplestore/" . $view, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
    }
    
    /**
     *
     * salvar
     * This method does the submit form using a jQuery request
     *
     */
    public function salvar() {
        
        Yii::import('application.extensions.utils.FileUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');

        $data = array();

        $data['titulo'] = $_POST['titulo'];
        $data['descricao'] = $_POST['descricao'];
        $data['valor'] = $_POST['valor'];
        $data['valor_total'] = $_POST['valor_total'];
        $data['promocao'] = $_POST['promocao'];
        $data['date'] = DateTimeUtils::setFormatDateNoTime($_POST['date']);
        $data['lancamento'] = MethodUtils::getBooleanNumber($_POST['lancamento']);
        $data['action'] = $_POST['action'];
        $data['tipo'] = $_POST['tipo'];
        $data['modelo'] = $_POST['modelo'];
        $data['cool'] = $_POST['cool'];
        (isset($_POST['image'])) ? $data['thumb'] = $_POST['image'] : $data['thumb'] = "";
        $data['id'] = $_POST['id'];
        
        if($data['action'] == 'novo' || $data['action'] == 'novo_template' || $data['action'] == 'nova_pagina') $data['message'] = Yii::t("messageStrings", "message_result_add");
        if($data['action'] == 'editar' || $data['action'] == 'editar_template' || $data['action'] == 'editar_pagina') $data['message'] = Yii::t("messageStrings", "message_result_update");

        try{
            $content = $this->purpleStoreHandler->submitContent($data);
            
            $result = array('result' => $content, 'message' => $data['message']);
            echo json_encode($result);

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: PurpleStoreAction - salvar() ' . $e->getMessage();
        }
    }
    
    /**
     * Exibe Loja
     * It uses a helper class to controll the actions
     * 
     * @params string
     * 
    **/
    public function exibeLoja($tipo){
        
        try{
            $result['content'] = $this->purpleStoreHandler->getAllItemsByCategory($tipo);
            $result['attributes'] = PurpleStoreUtils::getAttributes($tipo);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
        
        $this->addScript();
        $this->controller->layout = 'admin/admin_base';
        $this->controller->render("/site/pages/purple/store/content/item_simples", $result);

        //echo json_encode($result);
    }
    
    /**
     * Exibe Loja
     * It uses a helper class to controll the actions
     * 
    **/
    public function exibeConteudo(){
        
        try{
            $result['content'] = $this->purpleStoreHandler->getAllArticlesByCategory($this->type);
            
            $this->addScript();
            $this->controller->layout = 'admin/admin_base';
            $this->controller->render("/site/pages/purple/store/main/articles", $result);
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
    }
    
    /*
     * Comprar item
     *
     * Gets the item from the PurplePier Manager and saves it
     * into User database
     *
     */
    public function comprarItem(){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        Yii::import('application.extensions.utils.BannersUtils');
        
        $id = $_POST['id'];
        $type = $_POST['tipo'];
        
        //If it's not a html banners return previous type
        $type = BannersUtils::getTypeItem($type);

        try{            
            $item = $this->purpleStoreHandler->getItemPPById($id, $type);
            //Salva o item no banco do usuário
            $purchase_item = $this->purpleStoreHandler->purchaseItem($item, $type);
            
            if( $purchase_item) $json_data = array ('ERROR'=>0, 'item' => $item, 'message' => Yii::t('messageStrings', 'message_result_purchased'));
            if(!$purchase_item) $json_data = array ('ERROR'=>0, 'item' => $item, 'message' => Yii::t('messageStrings', 'message_result_already_purchased'));
            
            if($purchase_item){ 
                
                $session = MethodUtils::getSessionData();
                
                $data =  array("title" => Yii::t("activityStrings", "resume_submit"),
                        "nome" => 'Carlos Garcia',
                        "email" => 'publicidade.exe@gmail.com',
                        "telefone" => '',
                        "dominio" => $_SERVER['SERVER_NAME'],
                        "message" => Yii::t("activityStrings", "item_purchased"),
                        "tipo" => "purplestore",
                        'item' => $item['titulo'],
                        "layout" => "purplestore_common",
                        "id_general" => 0,
                        "date" => date("Y-m-d H:i:s"),
                        "id_user" => 0);
                
                $sendEmail = MethodUtils::sendEmailDirectly($data, true);
                
                $type_purchase = "compra_purplestore";
                if($type == 'componente_site') $type_purchase = "compra_aplicativo";
                
                //Set ping activity       
                $purplePierManager = new PurplePierManager();
                $ping = array('titulo' => $item['titulo'], 'descricao' => $id, 'tipo' => $type_purchase, 'plataforma' => $session['device'], 'id_item' => $id, 'valor' => $item['valor'], 'id_user' => Yii::app()->params['id_user']);
                $setPing = $purplePierManager->setPing($ping);
                
                $setPurchase  = $purplePierManager->setPurchase($ping);
                
                //Se não for local
                if(!Yii::app()->params['local']) $setPurchase2 = MethodUtils::setPurplePier(Yii::app()->params['id_user'], "purchase_item", $ping);
                //echo json_encode($setPurchase2);
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            $json_data = array ('ERROR'=>1,'message'=> $e->getMessage());
            
        }
        
       echo json_encode($json_data);
    }
    
    /*
     * Comprar item
     *
     * Gets the item from the PurplePier Manager and saves it
     * into User database
     *
     */
    public function exibeItem(){
        
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        $session = MethodUtils::getSessionData();
        $set = PurpleStoreUtils::setItemStatus($_POST['id'], MethodUtils::getBooleanNumber($_POST['status']));
        
        if($session['miniSiteUser'] == '') MethodUtils::updateSettingsFile();
        
        echo Yii::t('messageStrings', 'message_result_success');
    }
    
    /**
     * Listar Compras na Loja
     * 
     * @param string
     * 
    **/
    public function listarCompras($tipo){
        
        try{
            $result['content'] = $this->purpleStoreHandler->getAllPurchasedItems($tipo);
            $result['attributes'] = PurpleStoreUtils::getAttributes($tipo);
            
            $result['dicas'] = DicasUtils::getTips(C::STORE, C::PURPLESTORE);
        
            $this->addScript();
            $this->controller->layout = 'admin/admin';
            $this->controller->render("/admin/pages/purplestore/listar_compras", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
    }
    
    //FATURA
    /**
     * Ver Fatura
     * 
     * @param string
     * 
    **/
    public function fatura($corrente = 'atual', $isSpecific = false){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        Yii::import('application.extensions.dbuzz.admin.erp.BoletoManager');        
        Yii::import('application.controllers.admin.erp.BoletosAction');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.MonthUtils');
        
        $boletoHandler = new BoletoManager();
        $purplePierHandler = new PurplePierManager();
        
        if($corrente == 'atual') $month = date('m');
        if($corrente == 'proxima'){ $month = date('m') + 1; if($month > 12){$month = 01;}}
        if($corrente == 'anterior') $month = date('m') - 1;
        
        $id_user = Yii::app()->params['id_user'];
        if($isSpecific) $id_user = $this->id;
        
        try{            
            $result['user'] = UserUtils::getUserFullById($id_user);
            if(!$isSpecific) $result = json_decode($purplePierHandler->requestClientInformation($id_user, C::USER_INFO), true);
            if( $isSpecific) $result['user']['dados'] = UserUtils::getClientAttributes($id_user, false);
            $result['items'] = $this->purpleStoreHandler->getAllPurchaseByUser($id_user, $month, $isSpecific);
   
            $result['corrente'] = $corrente;
            $result['action'] = $this->action;
            
            $data_boleto = array();
  
            $data_boleto['titulo'] = "Fatura " . MonthUtils::getMonth($month) . " - " . $result['user']['dados']['dominio'];
            $data_boleto['descricao'] = 'Cobrança items';
            $data_boleto['valor'] = CurrencyUtils::checkFloatFormat($result['items']['sum']);
            $data_boleto['tipo'] = 1;//Para que serve está porra??????? 
            $data_boleto['action'] = 'novo';
            $data_boleto['dominio'] = $result['user']['dados']['dominio'];
            
            $data_boleto['id_entidade'] =  $id_user;
            $data_boleto['id'] = 0;
            $data_boleto['vencimento'] = $result['user']['dados']['vencimento'] . '/' . date('m') . '/' . date('Y');
            $data_boleto['status'] = 0;
            $data_boleto['file_name'] = $result['items']['month'] . "_" . $id_user . '.pdf';
            $data_boleto['ignore_erp'] = true;
            
            if($isSpecific){
                //$result['boleto'] = $boletoHandler->saveBoleto($data_boleto, true);
                //$create = BoletosAction::ver($result['boleto']['id'], null, false, $data_boleto['file_name']);     
                //Problema com STATUS, esse é zero!
            }
 
            if(!$isSpecific) $result['link_fatura'] = json_decode($purplePierHandler->requestClientInformation($id_user, C::USER_INVOICE, $data_boleto), true);
            $result['dicas'] = DicasUtils::getTips(C::STORE, C::PURPLESTORE);
        
            $this->addScript();
            $this->controller->layout = 'admin/admin';
            $this->controller->render("/admin/pages/purplestore/fatura", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }   
    }
    
    /*
     * Edit an item from DB2 Purchases
     * 
     */
    public function editarCompra(){
        
        $result['content'] = $this->purpleStoreHandler->getItemPurchasedById($this->id);
        
        $result['dicas'] = DicasUtils::getTips(C::STORE, C::PURPLESTORE);
        
        $this->addScript();
        $this->controller->layout = 'admin/admin';
        $this->controller->render("/admin/pages/purplestore/editar_compra", $result);        
    }
    
    /*
     * Update an item from DB2 Purchases
     * 
     */
    public function atualizarCompra(){
        
        $data['id'] = $_POST['id'];
        $data['titulo'] = $_POST['titulo'];
        $data['descricao'] = $_POST['descricao'];
        $data['desconto'] = $_POST['desconto'];
        
        $result = $this->purpleStoreHandler->updatePurchase($data);
        
        echo json_encode(array('result' => $result, 'message' => Yii::t('messageStrings', 'message_result_success')));
    }
    
    /*
     * Generates a PDF file
     * There is a 
     * 
     */
    public function htmlToPDF($content, $output = 'browser', $file_name = 'boleto.pdf'){
        require_once('protected/extensions/vendors/html2pdf/html2pdf.class.php');

        $html2pdf = new HTML2PDF('P','A4','en', array(0, 0, 0, 0));
        /* Abre a tela de impressão */
        //$html2pdf->pdf->IncludeJS("print(true);");

        $html2pdf->pdf->SetDisplayMode('real');

        /* Parametro vuehtml = true desabilita o pdf para desenvolvimento do layout */
        $vuehtml = isset($_GET['vuehtml']);
        $html2pdf->writeHTML($content, false);

        /* Abrir no navegador */
        if($output == 'browser') $html2pdf->Output($file_name);

        /* Salva o PDF no servidor para enviar por email */
        if($output == 'file') $html2pdf->Output('media/user/pdf/' . $file_name, 'F');

        /* Força o download no browser */
        if($output == 'download') $html2pdf->Output($file_name, 'D');
    }    
    
    /**
     * Method responsible to apply the CSS layout into the View
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
        
        $cs->registerCssFile($baseUrl . '/css/site/content/special/purple/purplestore.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/site/special/purple/purplestore.js', CClientScript::POS_BEGIN);
        
        //Js
        if($type == 'editar'){
            $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
            //Uploadfy: don't touch!
            $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);       
            $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_END);
        }
    }
}
?>
