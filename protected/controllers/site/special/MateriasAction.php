<?php

class MateriasAction extends CAction{

    private $portfolioHandler;
    private $id_usuario; 
    private $action;
    private $subitem;
    private $cat;
    private $sub;
    private $session;
    private $id;

    public function run(){

        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.dbuzz.site.special.PortfolioManager');
       
        $this->portfolioHandler = new PortfolioManager();
        
        $this->action = Yii::app()->getRequest()->getQuery('action');      
        //Essa variavel pode ser qualquer coisa como um id ou uma categoria
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        $this->cat = Yii::app()->getRequest()->getQuery('cat');
        $this->sub = Yii::app()->getRequest()->getQuery('sub');
        $this->subitem = Yii::app()->getRequest()->getQuery('subitem');
        
        $this->session = MethodUtils::getSessionData();
        $this->id_usuario = $this->session['id'];
        
        if(isset($_REQUEST['i'])){$id = $_REQUEST['i'];}else{$id = 0;}
        switch($this->action){
            
            case "":
            case "listar":
                if($id === 0) $this->listar();
                if($id !== 0) $this->detalhes($id);
                break;
        }
    }
    
    /*
     * Lista todos os produtos
     * 
     * @param boolean
     * 
     */
    public function listar($isCategoria = false){
      
        try{
            $data = HelperUtils::getPageBundle(C::NEWS);
            
            if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;
            if($local_place){$json = file_get_contents('/Applications/MAMP/htdocs/purplepier/www/media/user/files/minisite_portfolio_settings.json');}else{$json = file_get_contents('media/user/files/minisite_portfolio_settings.json');} 

            $settings = json_decode($json, true);
            
            $data['content'] = $settings['content'];
            $data['materia_selecionada'] = $this->materiasHandler->getLastContent("noticias", true);
            $data['categoria_info'] = $settings['categoria_info'];
            $data['menu_ecommerce'] = array(); 

            $this->addScript($data);
            $this->controller->layout = "site/index";            
            $this->controller->render("/site/pages/materias/noticias/materias_advertiser_html5", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: MateriaAction - listar() ' . $e->getMessage();
        }
    }
    
    /*
     * Detalhes de um determinado produtos
     * 
     * @param number
     * 
     */
    public function detalhes($id){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.special.VideoUtils');     
        
        try{            
            $data = HelperUtils::getPageBundle(C::NOTICIAS);
            
            if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;
            if($local_place){$json = file_get_contents('/Applications/MAMP/htdocs/purplepier/www/media/user/files/minisite_portfolio_settings.json');}else{$json = file_get_contents('media/user/files/minisite_portfolio_settings.json');} 

            $settings = json_decode($json, true);
            
            //Passe a view para melhorar o retorno de alguns dados
            $data['content'] = $settings['content'][$id];

            $data['url'] = "portfolio/{$data['content']['url']}";
            
            $this->addScript($data);
            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/portfolio/portfolio_simples/detalhes", $data);
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriaAction - detalhes() ' .$e->getMessage();
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

        //Funcionalidades de comportamento javascript default desta view
        //$cs->registerScriptFile($baseUrl . '/js/site/special/others/portfolio.js', CClientScript::POS_END);
        $cs->registerCssFile($baseUrl . "/css/site/content/portfolio/portfolio_simples.css", 'screen', CClientScript::POS_HEAD);
        
        //Dublin Core and Metadata
        include Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        
    }
}
?>