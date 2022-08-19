<?php

class MarketPlacesAction extends CAction{
   
    private $marketPlacesHandler;
    private $produtosHandler;
    private $action;  
    private $id;  


    /**
     *
     * MarketPlaces
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.special.MarketPlacesManager');
        Yii::import('application.extensions.dbuzz.admin.ProdutosManager');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->marketPlacesHandler = new MarketPlacesManager();
        $this->produtosHandler = new ProdutosManager();
        
        switch($this->action){

            case "publicar":
                $this->publicar();
                break;          
        }
    }

    /**
     *
     * Publish
     * This method publishes into a MarketPlace
     *
     */
    public function publicar(){ 
        
        $marketplace = $_POST['marketplace'];
        $id_produto  = $_POST['id_produto'];

        try{
            $result['session']  = MethodUtils::getSessionData();
            
            $result['produto']  = $this->produtosHandler->getContentById($id_produto);  
            $result['publicar'] = $this->marketPlacesHandler->publicarProduto($result, $marketplace);
            
            $result['message'] = Yii::t('messageStrings', 'message_marketplace_error');
            
            echo json_encode($result);            
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: MarketPlacesAction - publicar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MarketPlacesAction - publicar() " . $e->getMessage();
        }
    }     
    
     /**
     *
     * View example
     *
     */
    public function novo(){ 

        try{
            if($this->action == 'novo') $result['content'] = $this->marketPlacesHandler->getContentClear();
            if($this->action == 'editar') $result['content'] = $this->marketPlacesHandler->getContentById($this->id, $this->action);
            
            $result['session']  = MethodUtils::getSessionData();
            $result['dicas'] = DicasUtils::getTips(C::VAR_NEW, C::BILLET);
            $result['action'] = $this->action;
            
            $this->addScript();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/erp/bancos/novo", $result);     
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: MarketPlacesAction - novo()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MarketPlacesAction - novo() " . $e->getMessage();
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
            $content = $this->marketPlacesHandler->remove($data['id']);            
            echo json_encode(array('message' => Yii::t("messageStrings", "message_result_invoice_removed")));

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: MarketPlacesAction - deletar()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: MarketPlacesAction - deletar() ' . $e->getMessage();
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
        $cs->registerScriptFile($baseUrl . '/js/admin/special/marketplaces.js', CClientScript::POS_END); 
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>