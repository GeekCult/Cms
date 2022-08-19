<?php

class FornecedorAction extends CAction{
    
    private $id;
    private $action;   
    private $vagasHandler;
    

    /**
     *
     * Trabalhe Conosco
     * Specific Controller
     *
     */

    public function run(){

        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
   
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('sub');       
        
        switch($this->action){
            
            case "":
                $this->listar();
                break;
            
            case "cadastrar":
                $this->cadastrar();
                break;
        }
    }
    
    /*
     * Listar view trabalhe conosco
     * 
     */
    public function listar(){
        
        $result = array();
        
        $session = MethodUtils::getSessionData();
        
        try{            
            if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle(C::SEJAFORNECEDOR); 
            if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme(C::SEJAFORNECEDOR);
                       
            $result['page_prop'] = PaginasUtils::getPagesSpecialProperties($result['page']['id'], $result['page']['tipo']);
            $result['ramo_atuacao'] = UserUtils::getAllRamoAtuacao();
            
            ActivityLogger::log(C::STR_ACCESS_PAGE . C::SEJAFORNECEDOR, C::SEE_SEJA_FORNECEDOR);
            
            //Page title
            $data_site = HelperUtils::getTitleSite();
            ($result['page']['titulo_pagina'] != '') ? $this->controller->pageTitle = $result['page']['titulo_pagina'] : $this->controller->pageTitle = $data_site['titulo'];

            $this->addScript($result['layout']['layout_site']);
            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/special/" . $result['page']['layout'], $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: FornecedorActon - listar() " . $e->getMessage();
        }
    }
    
    /*
     * Listar view trabalhe conosco
     * 
     */
    public function cadastrar(){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.erp.InsumoUtils');
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        
        $purplePier = new PurplePierManager();
        
        $result = array();        
        $session = MethodUtils::getSessionData();
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        try{
            $params['avatar'] = "/media/images/avatar/avatar_profile.jpg";
            $params['telefone'] = $params['ddd_telefone'] . ' ' . $params['numero_telefone'];
            $params['celular'] = $params['ddd_celular'] . ' ' . $params['numero_celular'];
            $params['tipo_conta'] = 1;
            $params['password'] = md5(MethodUtils::getRandomPassword());
            $params['ramo_atuacao'] = $params['formIdRamoAtuacao'];
            $params['tag_user'] = 'fornecedor';
            $params['editar'] = false;
            $params['extra_1'] = $params['tipo_fornecedor'];
            
            //Validade fields
            $fields = array($params['field1'], $params['cidade'], $params['ramo_atuacao'], $params['tipo_fornecedor'], $params['email']);
            $errors = array(C::NOME_FANTASIA, C::CITY, C::RAMO_ATUACAO, C::TIPO_FORNECEDOR, C::EMAIL);            
            
            $isValidate = MethodUtils::validateFields($fields, $errors);
            
            if($isValidate){
                $id_user = UserUtils::createQuickUserAccount($params, true, true);
                $pierprofile = $purplePier->setPierProfile($params);
                                
                //Dispacht an e-mail to user signed in.
                $params['nome'] = $params['field1'];
                $params['tipo_conta'] =  UserUtils::getUserTypeString($params['tipo_conta'], true);
                $params['tipo'] = 'seja_fornecedor';
                $params['layout'] = 'seja_fornecedor';
                $params['message'] = $params['mensagem'] = '';
                $params['tipo_fornecedor_string'] = InsumoUtils::getInsumoById($params['tipo_fornecedor'], 'nome');
             
                
                $activity = array(
                    "title" => Yii::t("activityStrings","supplyer_submit"),
                    "nome" => $params['field1'],
                    "message" => Yii::t("activityStrings", "supplyer_submit_desc"),
                    "tipo" => "cadastro_fornecedor",
                    "id_general" => $id_user,
                    "date" => date("Y-m-d H:i:s"),
                    "last_update" => date("Y-m-d H:i:s"),
                    "id_user" => $id_user
                );
                
                $setActivity = MethodUtils::setActivityRecent($activity);
                $send_email = MethodUtils::sendEmailDirectly($params);
                
                
                $result = array('STATUS' => 1, 'MESSAGE' => Yii::t('messageStrings', 'message_result_apply_success'), 
                                'PIERPROFILE' => $pierprofile, 'USER' => $id_user, 'EMAIL' => $send_email);
                echo json_encode($result);
            }
      
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: FornecedorActon - cadastrar() " . $e->getMessage();
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
    public function addScript($model){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCssFile($baseUrl . '/css/site/layout/layout_'. $model .'.css', 'screen', CClientScript::POS_HEAD);
        //$cs->registerScriptFile($baseUrl . '/js/lib/jquery.maskedinput-1.2.2.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/site/special/others/seja_fornecedor.js', CClientScript::POS_END);
    }
}
?>