<?php

class BkbankAction extends CAction{


    private $BkBankHandler;
    private $action;
    private $id;


    public function run(){

        Yii::import('application.extensions.vendors.bkbank.BkBankManager');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->BkBankHandler = new BkBankManager();
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        $this->id = Yii::app()->getRequest()->getQuery('id'); 
        
        switch($this->action){
            
            case "billet":
                $this->billet();
                break;
            
            case "billet_generate":
                $this->generateBillet();
                break;
            
            case "payments":
                $this->payments();
                break;
            
            default:
            case "dashboard":
                $this->dashboard();
                break;
        }
    }
    
    /*
     * 
     * Dashboard
     * 
     */
    public function dashboard(){
        
        try{
   
            $session = MethodUtils::getSessionData();
                    
            $data['dicas'] = DicasUtils::getTips(C::GENERAL, C::SANDBOX); 
            $data['sidemenu'] = HelperUtils::adminUtils('bkbank', array('action' => 'dashboard'));       
            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("/admin/pages/bkbank/dashboard", $data);           
            
        }catch(CDbException $e) {
            Yii::trace("ERROR BkbankAction ".$e->getMessage());
            echo 'ERROR: BkbankAction - dashboard() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkbankAction - dashboard()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * 
     * Get Billets
     * 
     */
    public function billet(){
        
        try{
            $session = MethodUtils::getSessionData();
            
            //$result['content'] = array('Nome' => ' Carlos Garcia', 'Formação' => 'Publicidade Propaganda', 'MBA' => 'Desenvolivento de Dispositos Móveis', 'Cidade' => 'Campinas');
            $settings = $this->BkBankHandler->getSettings();
            
            $data = array('request' => 'GET', 'url' => "{$settings['url']}/Billet", "token" => $settings['token'], "params" => array(), 'decode' => true);
                
            $result['content'] = $this->BkBankHandler->apiRequest($data);
            
            $view = $this->controller->render("/admin/pages/bkbank/result", $result, true);
            
            echo json_encode(array('view' => $view));
            
        }catch(CDbException $e) {
            Yii::trace("ERROR BkbankAction billet()".$e->getMessage());
            echo 'ERROR: BkbankAction - billet() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkbankAction - billet()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * 
     * Generate a Billet
     * 
     */
    public function generateBillet(){
        
        try{
            $session = MethodUtils::getSessionData();
            
            
            $interest = array("code" => 2, "percentage" => 2, "amount" => 0);
            $fine = array("code" => 1, "percentage" => 0, "amount" => 10, 'date' => "2021-05-22");
            $discount = array("code" => 2, "percentage" => 5, "amount" => 0, 'date' => "2021-05-17");
            $address = array("zipCode" => "14098100", "address" => "Rua Expedicionário José Calzzani", "number" => "106", "neighborhood" => "Jardim São José", "complement" => "Apto 44", "city" => "Ribeirão Preto", "state" => "SP");
            $payer = array("name" => 'Carlos Garcia', "document" => "27788336840", 'address' => $address);
            
            $billet = json_encode(array("amount" => 12, "dueDate" => "2021-05-19", "description" => 'Parcela 1 de 1', 'generateHtml' => true, 'interest' => $interest, 'discount' => $discount, 'fine' => $fine, 'payer' => $payer));
            
            $settings = $this->BkBankHandler->getSettings();
                    
            $data = array('request' => 'POST', 'url' => "{$settings['url']}/Billet", "token" => $settings['token'], "params" => $billet, 'decode' => true);
                
            
            $result['content'] = $this->BkBankHandler->apiRequest($data);
            
            $view = $this->controller->render("/admin/pages/bkbank/result", $result, true);
            
            echo json_encode(array('view' => $view));
            
        }catch(CDbException $e) {
            Yii::trace("ERROR BkbankAction generateBillet()".$e->getMessage());
            echo 'ERROR: BkbankAction - generateBillet() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkbankAction - generateBillet()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * 
     * Payments
     * 
     */
    public function payments(){
        
        try{
            $session = MethodUtils::getSessionData();
            
            $settings = $this->BkBankHandler->getSettings();
            
            $data = array('request' => 'GET', 'url' => "{$settings['url']}/Payment?pagesize=1", "token" => $settings['token'], "params" => array("pagesize" => 1, "page" => 0));
                
            $result['content'] = json_decode($this->BkBankHandler->apiRequest($data), true);
            $view = $this->controller->render("/admin/pages/bkbank/result", $result, true);
            
            echo json_encode(array('view' => $view));
            
        }catch(CDbException $e) {
            Yii::trace("ERROR BkbankAction payments()".$e->getMessage());
            echo 'ERROR: BkbankAction - payments() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkbankAction - payments()', 'trace' => $e->getMessage()), true);
        }
    }

    /**
     * 
     * Add resources
     *
     * @param array
     *
     */
    public function addScript($data = array()){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
      
        //Funcionalidades de comportamento javascript default desta view
        //$cs->registerScriptFile($baseUrl . '/js/admin/BkBank.js', CClientScript::POS_END); 
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
    }

}
?>