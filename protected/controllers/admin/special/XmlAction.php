<?php

class XmlAction extends CAction{

    private $XmlHandler;
    private $action;
    private $id;

    public function run(){

        Yii::import('application.extensions.vendors.xml.XmlManager');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->XmlHandler = new XmlManager();
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        $this->id = Yii::app()->getRequest()->getQuery('id'); 
        
        switch($this->action){
            
            case "get_xml_request":
                $this->getXml();
                break;
            
            case "get_auto_web":
                $this->getAutoWeb();
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
            $this->controller->render("/admin/pages/xml/dashboard", $data);           
            
        }catch(CDbException $e) {
            Yii::trace("ERROR XMLAction ".$e->getMessage());
            echo 'ERROR: XMLAction - dashboard() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XMLAction - dashboard()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * 
     * Get AutoWeb
     * 
     */
    public function getAutoWeb(){
        
        try{
            
            $session = MethodUtils::getSessionData();
                
            $result['content'] = $this->XmlHandler->getAutoWeb();
            
            $view = $this->controller->render("/admin/pages/xml/result", $result, true);
            
            echo json_encode(array('view' => $view));
            
        }catch(CDbException $e) {
            Yii::trace("ERROR XMLAction getFile()".$e->getMessage());
            echo 'ERROR: XMLAction - getFile() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XMLAction - getFile()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * 
     * Get Xml
     * 
     */
    public function getXml(){
        
        try{
            $session = MethodUtils::getSessionData();
            
            $settings = $this->XmlHandler->getSettings();
            
            $data = array('request' => 'GET', 'url' => "{$settings['url']}/Billet", "token" => $settings['token'], "params" => array(), 'decode' => true);
                
            $result['content'] = $this->XmlHandler->apiRequest($data);
            
            $view = $this->controller->render("/admin/pages/xml/result", $result, true);
            
            echo json_encode(array('view' => $view));
            
        }catch(CDbException $e) {
            Yii::trace("ERROR XMLAction getXml()".$e->getMessage());
            echo 'ERROR: XMLAction - getXml() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XMLAction - getXml()', 'trace' => $e->getMessage()), true);
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
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
        
    }

}
?>