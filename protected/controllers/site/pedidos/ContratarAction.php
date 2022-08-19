<?php

class ContratarAction extends CAction {
    
    private $id_usuario;
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
        
        $session = MethodUtils::getSessionData();
        
        //Pode ser tanto PJ quanto PF
        $this->id_usuario = $session['id'];       


        switch ($this->action){

            case "":
                $this->contratar(Yii::app()->params['contratar']);               
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
    public function contratar($tipo = ''){
        
        $result = HelperUtils::getPageBundle(C::CONTRATAR);
        
        if($tipo == '') $view = $result['page']['layout'];
        if($tipo != '') $view = $tipo;
        
        try{
            $this->addScript($result);
            $this->controller->layout = $result['layout']["plataform"]. "/index";
            $this->controller->render("/site/pages/pedidos/criar/" . $view, $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR - PedidosAction - contratar() " . $e->getMessage();
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
    public function addScript($result){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        //Folha de estilo desta view
        $cs->registerCssFile($baseUrl . "/css/site/content/pedidos/criar/{$result['page']['layout']}.css", 'screen', CClientScript::POS_HEAD);
        $cs->registerCssFile($baseUrl . "/css/site/layout/layout_{$result['layout']['layout_site']}.css", 'screen', CClientScript::POS_HEAD); 
        
        //Dublin Core and Metadata
        include Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';
    }
}
?>