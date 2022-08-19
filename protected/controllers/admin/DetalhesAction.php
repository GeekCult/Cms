<?php

/**
 * Autor: CarlosGarcia
 * Date: 16/12/2010
 *
 * Detalhes Class
 * Specific Class - Admin Controller
 *
 */
class DetalhesAction extends CAction{
    
    private $detalhesHandler;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run(){

        $action = Yii::app()->getRequest()->getQuery('action');
        $type = Yii::app()->getRequest()->getQuery('type');
        $id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.DetalhesManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.DicasUtils');
        
        $this->detalhesHandler = new DetalhesManager();
        
        switch($action){

            case "novo":
            case   ""  :
                $this->novo($type);
                break;

            case "cadastrar":
                $this->cadastrar();
                break;

             case "deletar":
                $this->deletar();
                break;

            case "editar":
                $this->editar($type, $id);
                break;

            case "listar":
                $this->listar($type);
                break;

            case "alterar":
                $this->alterar($type);
                break;
            
            case "definir":
                $this->definir($type);
                break;
            
            case "definir_banners_propriedades":
                $this->definirPropriedades();
                break;
            
            case "topo":
                $this->detalhesExtremos('topo');
                break;
            
            case "rodape":
                $this->detalhesExtremos('rodape');
                break;
            
            case "barra_social":
                $this->detalhesEspeciais('barra_social');
                break;
            
            case "perfil_flutuante":
                $this->detalhesEspeciais('perfil_flutuante');
                break;
            
            case "breadcrumb":
                $this->detalhesEspeciais('breadcrumb');
                break;
            
            case "alterar_extremos":
                $this->alterarExtremos();
                break;

            default :
                $this->listar($type);
                break;
        }
    }

    /**
     *
     * Listar
     * List the main attributes and it opens the item list.
     *
     */
    public function listar($type) {
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        $minhas_preferencias = new MyPreferences();        ;

        try{            
            $content = $this->detalhesHandler->getAllContent($type);
            $settings = $minhas_preferencias->getPreferences();
            
            $result['preferences'] = $settings;
            
            //Get the prefered item into minhas_preferencias table
            $type_choose = PreferencesUtils::getDetailsSelected($type);
            $result['item_choose'] = PreferencesUtils::getPreferedItem($type_choose);
            
            if($type == "more")$result['item_choose'] = $minhas_preferencias->getPreferencesAttributes($type);
            if($type == "pagination")$result['item_choose'] = $minhas_preferencias->getPreferencesAttributes($type);

            $result['content'] = $content;
            $result['title'] = $type;

        } catch (CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "detalhes");
        
        ($type != "dividers") ? $view = "listar" : $view = "dividers";
        
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/detalhes/" . $view, $result);
    }

    /**
     *
     * Novo
     * List the main attributes and it opens the item list.
     *
     */
    public function novo($type){

        //Array onde será guardada as respostas
        $result = array(); 

        try{
            $content = $this->detalhesHandler->getContent(0);
            $result['content'] = $content;
            $result['title'] = $type;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "detalhes");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/detalhes/novo", $result);
    }

    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar(){

        $get_post = array();

        $get_post[0] = $_POST['title'];
        $get_post[1] = $_POST['tipo'];
        $get_post[2] = $_POST['local'];
        $get_post[3] = $_POST['file'];
        $get_post[4] = "20";
        $get_post[5] = "20";
        $get_post[6] = $_POST['classe'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_details');

        try{
            $content = $this->detalhesHandler->submitContent($get_post);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Deletar
     * This method deletes the record using a jQuery request
     *
     */
    public function deletar() {

        $get_post = array();
        $get_post['id'] = $_POST['id'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_details_delete');

        try{
            $content = $this->detalhesHandler->deleteContent($get_post);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Editar
     * This method edits the record using a jQuery request
     *
     */
    public function editar($local, $id) {

        $result = array();
        $result['title_texture'] = $local;
        $result['title'] = $local;

        try{
            $result['content'] = $this->detalhesHandler->getContent($id);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "detalhes");
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/detalhes/novo", $result);
    }

    /**
     *
     * Alterar
     * This method update the preferences table, it uses a
     * submited form using a jQuery request
     *
     */
    public function alterar($type){

        $get_post = array();
        $get_post[0] = $type;
        $get_post[1] = $_POST['selected'];
        $get_post['color'] = "";
        $get_post['espessura'] = "";
        
        if(isset($_POST['color']))$get_post['color'] = $_POST['color'];
        if(isset($_POST['espessura']))$get_post['espessura'] = $_POST['espessura'];
        
        $get_post['message'] = Yii::t('messageStrings', 'message_result_details_update');

        try{
            $content = $this->detalhesHandler->updateContent($get_post);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Definir
     * This method update the preferences table, it uses a
     * submited form using a jQuery request
     *
     */
    public function definir($type){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $data['message'] = Yii::t('messageStrings', 'message_result_details_update');

        try{
            $content = PreferencesUtils::setAttributes($type, $_POST['selected'], $_POST['type']);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();            
            $css = HelperUtils::createCss();
            
            echo $content;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DetalhesAction - definir() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Definir propriedades
     * This method update the preferences table, it uses a
     * submited form using a jQuery request
     *
     */
    public function definirPropriedades(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $data['message'] = Yii::t('messageStrings', 'message_result_details_update');

        try{
            $content = PreferencesUtils::setAttributes('altura_main_banner', $_POST['altura'], 'inteiro');
            $content = PreferencesUtils::setAttributes('distancia_main_banner', $_POST['distancia'], 'inteiro');
            
            $params = array();
            if(isset($_POST['data'])) parse_str($_POST['data'], $params);
        
            if(isset($params['caption'])){$result['caption'] = PreferencesUtils::setAttributes('main_banner_caption', 1, 'inteiro');}else{$result['caption'] = PreferencesUtils::setAttributes('main_banner_caption', 0, 'inteiro');}
            if(isset($params['shadow'])){$result['shadow'] = PreferencesUtils::setAttributes('main_banner_shadow', 1, 'inteiro');}else{$result['shadow'] = PreferencesUtils::setAttributes('main_banner_shadow', 0, 'inteiro');}
            if(isset($params['fullscreen'])){$result['fullscreen'] = PreferencesUtils::setAttributes('main_banner_fullscreen', 1, 'inteiro');}else{$result['fullscreen'] = PreferencesUtils::setAttributes('main_banner_fullscreen', 0, 'inteiro');} 
            if(isset($params['autoplay'])){$result['autoplay'] = PreferencesUtils::setAttributes('main_banner_autoplay', 1, 'inteiro');}else{$result['autoplay'] = PreferencesUtils::setAttributes('main_banner_autoplay', 0, 'inteiro');}
            if(isset($params['lightbox'])){$result['lightbox'] = PreferencesUtils::setAttributes('main_banner_lightbox', 1, 'inteiro');}else{$result['lightbox'] = PreferencesUtils::setAttributes('main_banner_lightbox', 0, 'inteiro');}
            if(isset($params['animation'])){$result['animation'] = PreferencesUtils::setAttributes('main_banner_animation', $params['animation'], 'inteiro');}else{$result['animation'] = PreferencesUtils::setAttributes('main_banner_animation', 1, 'inteiro');}
            if(isset($params['intervalo'])){$result['intervalo'] = PreferencesUtils::setAttributes('main_banner_intervalo', $params['intervalo'], 'inteiro');}
            if(isset($params['margin_base'])){$result['margin_base'] = PreferencesUtils::setAttributes('main_banner_margin_base', $params['margin_base'], 'inteiro');}
            if(isset($params['painel_banner'])){ $is_panel = MethodUtils::getBooleanNumber($params['painel_banner']); }else{$is_panel = 0;}
            $result['painel_banner'] = PreferencesUtils::setAttributes('main_banner_painel', $is_panel, 'inteiro');
            
            Yii::import('application.extensions.utils.HelperUtils');
            $set = HelperUtils::createCss();
            
            $setSettingsFile = MethodUtils::updateSettingsFile();
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DetalhesAction - definirPropriedades() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Extremos Details
     *
     */
    public function detalhesExtremos($tipo){

        try{
            $result['content'] = $this->detalhesHandler->getContentExtremos($tipo);
            
            $result['dicas'] = DicasUtils::getTips("list", "detalhes");
        
            $this->addScript(true);
            
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/detalhes/" . $tipo, $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DetalhesAction - detalhesRodape() ' . $e->getMessage();
        }        
    }
    
    /**
     *
     * Sepcial Details
     *
     */
    public function detalhesEspeciais($tipo){

        try{
            $result['content'] = $this->detalhesHandler->getContentExtremos($tipo);
            
            $result['dicas'] = DicasUtils::getTips("list", "detalhes");
        
            $this->addScript2($tipo, true);
            
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/detalhes/" . $tipo, $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DetalhesAction - detalhesRodape() ' . $e->getMessage();
        }        
    }
    
    /**
     *
     * Altera Topo e Rodape
     *
     */
    public function alterarExtremos(){

        $data['type'] = $_POST['type'];
        $data['message'] = Yii::t('messageStrings', 'message_result_details_update');

        try{ 
            //Dirty work on manger class :(
            $content = $this->detalhesHandler->updateExtremos($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: DetalhesAction - detalhesTopo() ' . $e->getMessage();
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
    public function addScript($isJsNeed = false, $isCoolPicker = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        //Uploadfy: don't touch!       
        $cs->registerScriptFile($baseUrl . '/js/lib/jquery.js', CClientScript::POS_BEGIN);
        $cs->registerCssFile($baseUrl    . '/js/lib/upload/fileuploader.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerScriptFile($baseUrl . '/js/lib/upload/fileuploader.js', CClientScript::POS_BEGIN);
        
        if($isJsNeed) $cs->registerScriptFile($baseUrl . '/js/admin/detalhes.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerScriptFile($baseUrl . '/js/lib/jscolor/jscolor.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerCssFile($baseUrl . '/css/lib/cool/cool_html.css', 'screen', CClientScript::POS_BEGIN); 
        
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
    public function addScript2($js, $isCoolPicker = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerScriptFile($baseUrl . '/js/admin/detalhes/' . $js . '.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerScriptFile($baseUrl . '/js/lib/jscolor/jscolor.js', CClientScript::POS_BEGIN);
        if($isCoolPicker) $cs->registerCssFile($baseUrl . '/css/lib/cool/cool_html.css', 'screen', CClientScript::POS_BEGIN); 
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>