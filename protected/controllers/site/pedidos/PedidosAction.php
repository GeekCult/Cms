<?php

class PedidosAction extends CAction {
    
    private $LIST = "list";
    private $NEW = "new";
    private $EDIT = "edit";
    private $TYPE = "pages";
    
    private $preferencias;
    private $categorias;
    private $id_usuario;
    private $controll;
    private $manager;
    private $pedidos;
    private $action;
    private $type;
    private $id;

    /**
     *
     * Pedidos;
     * Special Class
     * It uses a web controller together a HandlerAction and
     * some ajustments in ContentAction.
     *
     * PS: Don't forget, it's using the attributes sub and action from
     * <nr><sub><action> from config main.php
     *
     */
    public function run(){        

        $this->action = Yii::app()->getRequest()->getQuery('action'); 
        $this->type = Yii::app()->getRequest()->getQuery('type');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        switch ($this->action){

            case "":
                $this->orcamento();
                break;
            
            case "folha_pedidos":
                $this->folhaPedidos();
                break;
            
            default:
                echo 'error';
                break;
        }
        
    }
    
    /*
     * Novo
     *
     * Abre a view mencionada na action.
     * Esta classe é bem genérica portanto preste
     * atenção na sua view
     * 
     * SITE USA ESSA FUNCAO
     *
     */
    public function orcamento($tipo = ''){
        
        if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle(C::ORCAMENTO);
        if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme(C::ORCAMENTO);
  
        try{
            if($tipo == '') $view = $result['page']['layout'];
            if($tipo != '') $view = $tipo;
            
            $this->addScriptSite($result);
            $this->controller->layout = $result['layout']["plataform"]. "/index";
            $this->controller->render("/site/pages/pedidos/criar/" . $view, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR - PedidosAction - orcamento() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Folha de Pedidos
     * 
     * Cria um novo chamado
     *
     */
    public function folhaPedidos(){
        
        Yii::import('application.controllers.admin.erp.OrdemPedidosAction');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $data = array();
        parse_str($_POST['data'], $data);

        try{    
            $data['id_cliente'] = UserUtils::createQuickUserAccount($data, true, true);
            $set = OrdemPedidosAction::criarChamado($data); 
            
            $addItems = OrdemPedidosAction::salvarItemsSite($data, $set['id']);
            
            $result = array("result" => $set, "message" => $set['message']);
            MethodUtils::returnMessage($result);


        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
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
    public function addScriptSite($result){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();       
        
        //Dublin Core and Metadata
        include Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';
    }
}
?>