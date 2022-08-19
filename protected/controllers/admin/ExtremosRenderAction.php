<?php

/**
 * Autor: CarlosGarcia
 * Date: 13/12/2010
 *
 * Banner - Render Partial Class
 * Specific Class - Admin Controller
 *
 */
class ExtremosRenderAction extends CAction {

    private $bannersHandler;
    private $extremosHandler;
    private $action;
    private $type_controller;
    private $preferencesHandler;
    private $id;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run() {
        
        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->id = Yii::app()->getRequest()->getQuery('id');
        $this->type_controller = $this->getController()->getAction()->getId();        
        
        Yii::import('application.extensions.dbuzz.admin.BannersManager');
        Yii::import('application.extensions.dbuzz.admin.special.ExtremosRenderManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->bannersHandler = new BannersManager();
        $this->extremosHandler = new ExtremosRenderManager();
        $this->preferencesHandler = new MyPreferences();

        switch($this->action){

            case "editar":
                $this->editar();
                break;
            
            case "salvar":
                $this->salvar();
                break;
            
            case "ver":
                $this->ver();
                break;
            
            case "load_view":
                $this->loadView();
                break;
        }
    }

    /**
     *
     * Editar
     * This method edits the html cool banner using a jQuery request
     * 
     * @param number
     * @param string
     *
     */
    public function editar() {
        
        Yii::import('application.extensions.utils.special.BannerElementsUtils');

        $result = array();
        $result['session'] = MethodUtils::getSessionData();
        $result['local'] = $this->type_controller;
        $result['action'] = "editar";
        $result['id'] = $this->id;

        try{
            //Utiliza classe estática para facilitar, várias cool features utilizam desta classe
            $banner_propertie = BannersUtils::getBannerProperties($this->type_controller, $result['session']['device']);
            $result['content'] = $this->bannersHandler->getContent($this->id, true);  
            $result['largura_banner'] = $banner_propertie["largura"];
            
            if($result['content']['tipo'] != "topos" && $result['content']['tipo'] != "rodapes"){
                
                $result['content']['cool2']['preferences'] = $this->preferencesHandler->getPreferences();
                $result['content']['cool2']['attr'] =  BannerElementsUtils::getBannersAttributes($result['content']['cool']);
                $result['type_size'] =  "banner/modelos/" . $result['content']['tipo'] . '/';
                $view = $result['content']['cool'];
            }
            
            if($result['content']['tipo'] == "topos"){               
               
                Yii::import('application.extensions.dbuzz.DBManager');
                $dbManager = new DBManager();
        
                $result['type_size'] =  "header/site/special/";
                $result['content']['cool2']['preferences'] = $this->preferencesHandler->getPreferences();
                $result['content']['cool2']['menu_principal'] =  $dbManager->getMenu('desktop', 'menu_principal');
                $result['content']['cool2']['menu_active'] = 'home';
                $view = $result['content']['cool'];
            }
            
            if($result['content']['tipo'] == "rodapes"){
                $result['type_size'] =  "footer/site/special/";
                $result['content']['cool2']['preferences'] = $this->preferencesHandler->getPreferences();
                $view = $result['content']['cool'];
            }           
            
            $this->preferencesHandler->setFonts('admin');
            
            $result['dicas'] = DicasUtils::getTips(C::VAR_EDIT, C::RENDER_PARTIAL);
            
            $this->addScript($result['content']['tipo']);
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/extremos/render/" . $result['content']['tipo'] . '/' . $view, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosRenderAction - editar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar
     * This method saves
     *
     */
    public function salvar(){

        $result = array();
        $result['session'] = MethodUtils::getSessionData();
        
        $id = $_POST['id_banner'];
        
        $result['content'] = $this->bannersHandler->getContent($id); 

        try{
            $update = $this->extremosHandler->updateBannerRender($result['content']);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            $clear = MethodUtils::setSessionData('banner_flutuante', "");
            $clear = MethodUtils::setSessionData('banner_global', "");
            
            echo json_encode($update);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosRenderAction - salvar() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Ver
     * This method show the specific banner to try its behaviours
     * 
     * @param number
     * @param string
     *
     */
    public function ver(){

        $result = array();
        $result['session'] = MethodUtils::getSessionData();
        $result['local'] = $this->type_controller;
        $result['action'] = "editar";
        $result['id'] = $this->id;

        try{
            //Utiliza classe estática para facilitar, várias cool features utilizam desta classe
            $banner_propertie = BannersUtils::getBannerProperties($this->type_controller, $result['session']['device']);
            $result['content'] = $this->bannersHandler->getContent($this->id, true);  
            $result['largura_banner'] = $banner_propertie["largura"];
            
            $result['type_size'] =  "banner/modelos/" . $result['content']['tipo'] . '/';
            
            $result['dicas'] = DicasUtils::getTips(C::VAR_SEE, C::RENDER_PARTIAL);
            
            //$this->preferencesHandler->setFonts();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosRenderAction - editar() " . $e->getMessage();
        }
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/extremos/ver", $result);
    }
    
    /**
     *
     * Load view
     * 
     * @param number
     * 
     */
    public function loadView(){

        try{
            $result['content'] = $this->bannersHandler->getContent($_POST['id'], true); 
            
            echo $this->controller->renderPartial("/site/common/banner/modelos/".$result['content']['tipo']. "/" . $result['content']['cool'] , $result['content']['cool2'], true);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosRenderAction - loadView() " . $e->getMessage();
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
    public function addScript($type = null){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Uploadfy: don't touch!       
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        
        $cs->registerScriptFile($baseUrl . '/js/admin/banners_render.js', CClientScript::POS_BEGIN);
        $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        
        if($type != null){
            $cs->registerCssFile($baseUrl    . '/media/user/css/main.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerCssFile($baseUrl    . '/css/lib/bootstrap.css', 'screen', CClientScript::POS_HEAD);
            $cs->registerCssFile($baseUrl    . '/css/site/layout/layout_strinter.css', 'screen', CClientScript::POS_BEGIN);
            
            $cs->registerCssFile($baseUrl    . '/css/lib/font-awesome.min.css', 'screen', CClientScript::POS_HEAD);
        }
        
        $this->controller->all = MethodUtils::getAllAdminInformation();    
    }
}
?>