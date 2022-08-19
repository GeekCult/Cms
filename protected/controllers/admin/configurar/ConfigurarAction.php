<?php

class ConfigurarAction extends CAction{

    private $settingHandler;
    private $action;
    private $id;

    /**
     *
     * Downloads
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.ConfigurarManager');
        Yii::import('application.extensions.utils.DicasUtils');
        
        $this->settingHandler = new ConfigurarManager();

        switch($this->action){

            case "redes_sociais":
                $this->redesSociais();
                break;

            case "cadastrar_redes_sociais":
                $this->cadastrar_redes_sociais();
                break;
            
            case "google_maps":
                $this->googleMaps();
                break;
            
            case "cadastrar_google_maps":
                $this->cadastrarGoogleMaps();
                break;
            
            case "google_tags":
                $this->googleTagsManager();
                break;
            
            case "cadastrar_google_tags_manager":
                $this->cadastrarGoogleTagsManager();
                break; 
            
            case "google_analytics":
                $this->googleAnalytics();
                break;
            
            case "cadastrar_google_analytics":
                $this->cadastrarGoogleAnalytics();
                break;
            
            case "meta_tags":
                $this->metaTags();
                break;
            
            case "cadastrar_meta_tags":
                $this->cadastrarMetaTags();
                break;
            
            case "cadastrar_faq":
                $this->cadastrarFaq();
                break;
            
            case "email":
                $this->emailContato();
                break;
            
            case "cadastrar_email":
                $this->cadastrarEmailContato();
                break;
            
            case "usuarios":
                $this->getController()->forward( "users/pj/editar");
                break;
            
            case "device":
                $this->setCurrentDevice();
                break;
            
            case "dispositivos":
                $this->dispositivosMoveis();
                break;
            
            case "teste":
                $this->doTest();
                break;
            
            case "combo_share":
                $this->comboShare();
                break;
            
            case "definir_combo_share":
                $this->defineComboShare();
                break;
            
            case "faq":
                $this->faqNew(false);
                break;
            
            case "faq_edit":
                $this->faqNew(true);
                break;
            
            case "faq_listar":
                $this->faqListar();
                break;
            
            case "faq_remove":
                $this->faqRemover();
                break;
            
            case "faq_status":
                $this->faqChangeStatus();
                break;
            
            case "clear_cache":
                $this->limparCache();
                break;
            
            case "update_social":
                $this->updateSocial();
                break;

        }

    }
    
    /**
     *
     * FAQ - Frequent answer and questions
     *
     */
    public function faqNew($isEdit = false){

        try{
            if($isEdit) $result['content'] = $this->settingHandler->getFaqContent($this->id);
            $result['action'] = $this->action;
            $result['id'] = $this->id;
            
            $result['dicas'] = DicasUtils::getTips("list", "faq");

            $this->addScripts();
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/configurar/faq", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        
    }
    
    /**
     *
     * FAQ - Frequent answer and questions listar
     *
     */
    public function faqListar(){

        try{
            $result['content'] = $this->settingHandler->getAllFaqContent();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "faq");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/faq_listar", $result);
    }
    
    /**
     *
     * FAQ - Frequent answer and questions listar
     *
     */
    public function faqRemover(){
        
        $id = $_POST['id'];
        try{
            $result = $this->settingHandler->removeFaqContent($id);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        echo $result;
    }
    
    /**
     *
     * FAQ - Frequent answer and questions aprovar
     *
     */
    public function faqChangeStatus(){
        
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        try{
            $set = $this->settingHandler->changeStatusFaq($id, $status);
            $result = array('MESSAGE' => 'Status atualizado com sucesso!');
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        
    }
    
    /**
     *
     * Redes Sociais
     * List the main attributes and it opens the item list.
     *
     */
    public function redesSociais(){

        try{
            $result['content'] = $this->settingHandler->getContentRedesSociais();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/redes_sociais", $result);
    }
    
    /**
     *
     * Dispositivos Móveis
     * Setting some attributes to mobiles.
     *
     */
    public function dispositivosMoveis(){
        
        Yii::import('application.extensions.utils.admin.PreferencesViewUtils');
        
        $result = array();
        
        try{
            $result['smartphone'] = PreferencesViewUtils::getView("dispositivo_smartphone", "texto");
            $result['tablet']  = PreferencesViewUtils::getView("dispositivo_tablet", "texto");

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "devices");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/dispositivos_moveis", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar_redes_sociais(){
        
        $session = MethodUtils::getSessionData();

        $data = array();
        $data[0] = $_POST['facebook'];
        $data[1] = $_POST['twitter'];
        $data[2] = $_POST['orkut'];        
        $data[3] = $_POST['linkedin'];       
        $data[4] = $_POST['google_mais_um'];
        $data[5] = $_POST['canal_youtube'];
        $data[6] = $_POST['flickr'];
        $data[7] = $_POST['instagram'];
        $data[8] = $_POST['pinterest'];
        $data['home'] = $_POST['home'];
        $data['skype'] = $_POST['skype'];
        $data['rss'] = $_POST['rss'];
        $data['telefone'] = $_POST['telefone'];
        $data['email'] = $_POST['email'];
        $data['site_map'] = $_POST['site_map'];
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitContentRedesSociais($data);
            
            //Update JSON data_base infos
            if($session['miniSiteUser'] == "") $updateDataJson = MethodUtils::updateDominioData(); 
            if($session['miniSiteUser'] != "") $updateMiniSite = MethodUtils::updateMiniSites();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Google Maps
     * List the main attributes and it opens the item list.
     *
     */
    public function googleMaps(){

        try{
            $result['content'] = $this->settingHandler->getContentGoogleMaps();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/google_maps", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarGoogleMaps(){

        $data = array();
        $data[0] = $_POST['google_maps'];
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitContentGoogleMaps($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Google Tags Manager
     *
     */
    public function googleTagsManager(){

        try{
            $result['content'] = $this->settingHandler->getContentGoogle('google_tags_manager');

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/google_tags_manager", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarGoogleTagsManager(){

        $data = array();
        $data['field'] =  'google_tags_manager';
        $data['value'] = $_POST['google_tags'];
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitContent($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Google Maps
     * List the main attributes and it opens the item list.
     *
     */
    public function googleAnalytics(){

        try{
            $result['content'] = $this->settingHandler->getContentGoogleAnalytics();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/google_analitics", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarGoogleAnalytics(){

        $data = array();
        $data[0] = $_POST['google_analytics'];
        $data[1] = $_POST['google_analytics_view'];
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitContentGoogleAnalytics($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * MetaTags
     * List the main attributes and it opens the item list.
     *
     */
    public function metaTags(){

        try{
            $result['content'] = $this->settingHandler->getContentMetaTags();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/meta_tags", $result);
    }
    
    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarMetaTags(){
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        $data = array();
        $data[0] = $_POST['titulo'];
        $data[1] = $_POST['descricao'];
        $data[2] = $_POST['metatag'];
        
        $data[3] = MethodUtils::getBooleanNumber($_POST['online']);
        
        $data[4] = DateTimeUtils::setFormatDateNoTime($_POST['date_release']);
        $data[5] = DateTimeUtils::setFormatDateNoTime($_POST['date_release'], false);
        
        $data[4] = DateTimeUtils::getDateFormatCommonNoTime($data[4]);
        $data[5] = DateTimeUtils::getDateFormatCommonNoTime($data[5]);
        
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitContentMetaTag($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    } 
    
    /**
     *
     * Cadastrar Faq
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarFaq(){

        $data = array();
        $data[0] = $_POST['titulo'];
        $data[1] = $_POST['descricao'];
        $data['id'] = $_POST['id'];
        
        $data['action'] = $_POST['action'];
        
        $data['message'] = Yii::t('messageStrings', 'message_result_faq_update');

        try{
            $this->settingHandler->submitContentFaq($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * E-mail de contato
     * List the main attributes and it opens the item list.
     *
     */
    public function emailContato(){

        try{
            $result['content'] = $this->settingHandler->getContentEmailContato();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "email_contato");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/email_contato", $result);
    }
    
    /**
     *
     * Cadastrar E-mail de contato
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarEmailContato(){

        $data = array();
        $data[0] = $_POST['email'];
        $data[1] = $_POST['email_sender'];
        $data[2] = $_POST['email_ceos'];
        $data[3] = $_POST['email_emkt'];
        $data[4] = $_POST['titulo'];
        $data[5] = $_POST['email_emkt_teste'];
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->submitEmailContato($data);
            
            $session = MethodUtils::getSessionData();
            if($session['miniSiteUser'] != "") $updateMiniSite = MethodUtils::updateMiniSites();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Set the current device
     * Currently ot can be: mobile, desktop, tablet
     * Where default is desktop
     *
     */
    public function setCurrentDevice(){
        
        $device = $_POST['type_device'];

        try{
            $setDevice = MethodUtils::setSessionData("device", $device);
            $return = array("ERROR" =>  0, "message" => Yii::t('messageStrings', 'message_result_device_changed'), "device" => $device);
            echo json_encode($return);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            $return = array("ERROR" =>  0, "message" => $e->getMessage(), "device" => $device);
            echo json_encode($return);
        }
    }
    
    /**
     *
     * DO TEST
     * TODO: Create a class and controller to handle with it.
     *
     */
    public function doTest(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.StoreUtils');
        
        //$device = $_POST['type_device'];

        try{
            $values['id_item'] = 26;
            $values['amount'] = 1;
            $values['tipo'] = 'produto';
            $values['valor'] = 2;
            $values['id_variante'] = 1;
            $data['status'] = 3;
            $data['id_pedido'] = 76;
            //ProdutosUtils::updateInventory($data, $values);
            //StoreUtils::itemsManager($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * ComboShare Manager
     *
     */
    public function comboShare(){

        try{
            $result['content'] = $this->settingHandler->getContentComboShare();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "configurar");

        $this->addScripts();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/configurar/views/combo_share", $result);
    }
    
    /**
     *
     * Cadastrar definições do combo share
     *
     */
    public function defineComboShare(){

        $data = array();
        $data['exibe'] =  MethodUtils::getBooleanNumber($_POST['exibe']);
        $data['position'] = $_POST['position'];
        $data['position_py'] = $_POST['position_py'];
        $data['color'] = $_POST['color'];
        
        $data['exibe_likebox'] =  MethodUtils::getBooleanNumber($_POST['exibe_likebox']);
        $data['position_likebox'] = $_POST['position_likebox'];
        $data['position_py_likebox'] = $_POST['position_py_likebox'];
        $data['color_likebox'] = $_POST['color_likebox'];
        
        $data['message'] = Yii::t('messageStrings', 'message_result_setiing_update');

        try{
            $this->settingHandler->defineComboShare($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Limpar cache
     *
     */
    public function limparCache(){

        try{
            $clear = MethodUtils::clearAllCache();
            echo Yii::t('messageStrings', 'message_result_clear_success');

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Atualizar os posts das redes sociais
     *
     */
    public function updateSocial(){
        
        Yii::import('application.extensions.utils.special.RedesSociaisUtils');

        try{
            $update = RedesSociaisUtils::updateRedesSociais();
            echo json_encode($update);
            

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /*
     * Adds script
     *
     */
    public function addScripts(){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/admin/configurar.js', CClientScript::POS_END);
    }
}
?>