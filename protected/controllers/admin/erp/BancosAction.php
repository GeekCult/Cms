<?php

class BancosAction extends CAction{
   
    private $bancoHandler;
    private $itauHandler;
    private $action;  
    private $id;  


    /**
     *
     * Bancos 
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.erp.BancoManager');
        Yii::import('application.extensions.dbuzz.admin.erp.bancos.ItauManager');
        
        Yii::import('application.extensions.utils.DicasUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->bancoHandler = new BancoManager();
        $this->itauHandler = new ItauManager();
        
        switch($this->action){

            case "novo":
                $this->novo();
                break;
            
            case "editar":
                $this->novo();
                break;
            
            case "listar":
                $this->listar();
                break;
            
            case "listar_todos":
                $this->listar(true);
                break;
            
            case "atualizar":
                $this->atualizar();
                break;
            
            case "registrar":
                $this->registrar();
                break;
            
            case "protestar":
                $this->protestar();
                break;
            
            case "salvar":
                $this->salvar();
                break;
            
            case "excluir":
                $this->deletar();
                break;
          
        }
    }

    /**
     *
     * Novo
     * This method creates a new billet
     *
     */
    public function novo(){ 

        try{
            if($this->action == 'novo') $result['content'] = $this->bancoHandler->getContentClear();
            if($this->action == 'editar') $result['content'] = $this->bancoHandler->getContentById($this->id, $this->action);
            
            $result['session']  = MethodUtils::getSessionData();
            $result['dicas'] = DicasUtils::getTips(C::VAR_NEW, C::BILLET);
            $result['action'] = $this->action;
            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/erp/bancos/novo", $result);     
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - novo()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancosAction - novo() " . $e->getMessage();
        }
    }
    
    /*
     * Listar Financeiro
     * 
     */
    public function listar($isAll = false){
        
        $session = MethodUtils::getSessionData();
        
        try{        
            //Sets month and year default
            if($session['day_financeiro'] == "") $set = MethodUtils::setSessionData('day_financeiro', date('d'));
            if($session['month_financeiro'] == "") $set = MethodUtils::setSessionData('month_financeiro', date('m'));
            if($session['year_financeiro'] == "") $set = MethodUtils::setSessionData('year_financeiro', date('Y'));
       
            if(!$isAll) $result['content'] = $this->bancoHandler->getAllContent($session);
            if( $isAll) $result['content'] = $this->bancoHandler->getAllContent();
            
            $result['session']  = MethodUtils::getSessionData();
            $result['dicas'] = DicasUtils::getTips(C::VAR_LIST, C::ERP_PAYMENTS);            
            $result['action'] = $this->action;
            
            $result['day'] = $session['day_financeiro'];
            $result['month'] = $session['month_financeiro'];
            $result['year'] = $session['year_financeiro'];
            $result['status'] = $isAll;

            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/erp/bancos/listar", $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - listar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancosAction - listar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Atualizar
     * This method updates the billet status
     *
     */
    public function atualizar(){
        Yii::import('application.extensions.utils.erp.BancosUtils');

        try{
            $action = $_POST['action'];

            $bankRequest = $this->itauHandler->lerRetornoRemessa();

            $result = array('message' => Yii::t('messageStrings', 'message_result_bank_update'));
            
            echo json_encode($result);     
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - atualizar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancosAction - atualizar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Protestar
     * This method defines judicial intervation on billet
     *
     */
    public function protestar(){ 

        try{
            $id = $_POST['id'];

            $data = $this->bancoHandler->getContentById($id, 'get data');

            $bankRequest = $this->itauHandler->geraRemessaProtesto($data);
            
            $result = array('message' => Yii::t('messageStrings', 'message_result_judicial_intervation'), 'status' => $bankRequest);
            
            echo json_encode($result);     
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - protestar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancosAction - protestar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Registrar
     * This method registers the billet into the bank
     *
     */
    public function registrar(){ 

        try{
            $id = $_POST['id'];
            if (!empty($id)) {
                $data[] = $this->bancoHandler->getContentById($id, 'get data');
            } else {
                $ids = implode(',',$_POST['ids']);
                $resultado = $this->bancoHandler->getContentByIds($ids, 'get data');
                $data = $resultado['registros'];
            }

            $bankRequest = $this->itauHandler->geraRemessaTitulo($data);
            
            $result = array('message' => Yii::t('messageStrings', 'message_result_bank_register'), 'status' => $bankRequest);
            
            echo json_encode($result);     
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - registrar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: BancosAction - registrar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar contas a pagar
     * This method does the submit form using a jQuery request
     *
     */    
    public function salvar(){
        
        $params = array(); 
        parse_str($_POST['data'], $params);
        
        try{
            $content = $this->bancoHandler->saveBoleto();
            
            if($params['action'] == 'novo') $message = Yii::t('messageStrings', 'message_result_billet_submited');;
            if($params['action'] == 'editar') $message = Yii::t('messageStrings', 'message_result_billet_updated');
            
            $result = array("message" => $message, 'result' => $content);
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: BancosAction - salvar() " . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BancosAction - salvar()', 'trace' => $e->getMessage()), true);
        }
    }
     
    
    /**
     *
     * Deletar
     * This method deletes the selected record using a jQuery request
     *
     */
    public function deletar(){

        $data['id'] = $_POST['id'];

        try{
            $content = $this->bancoHandler->remove($data['id']);            
            echo json_encode(array('message' => Yii::t("messageStrings", "message_result_invoice_removed")));

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: BancoAction - deletar()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: BancosAction - deletar() ' . $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS and Javascript layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript(){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Funcionalidades de components html
        $cs->registerScriptFile($baseUrl . '/js/admin/erp/bancos.js', CClientScript::POS_END); 
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>