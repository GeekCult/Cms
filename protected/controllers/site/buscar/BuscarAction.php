<?php

class BuscarAction extends CAction {
    
    private $searchHandler;
    private $action;
    private $search;

    /**
     *
     * Search - Busca
     * Specific Web Controller
     * All kind of search might be used here, btoh site and admin
     * there is a class SearchManager to help with it.
     *
     */
    public function run(){
        
        Yii::import('application.extensions.dbuzz.site.buscar.SearchManager');        

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->search = Yii::app()->getRequest()->getQuery('search');
        
        $this->searchHandler = new SearchManager();        

        switch($this->action){
           
            case "recent_activity":
                $this->recentActivity();
                break;
            
            case "destaque":
                $this->destaque();
                break;
            
            default:
                $this->procura();
                break;
        }
    }
    
    /**
     *
     * Simple Search
     * This method does the simple search using a jQuery request
     * Only some tables are consulted
     *
     */
    public function procura(){
        
        if(!Yii::app()->params['site_type']) $result = HelperUtils::getPageBundle(C::SEARCH); 
        if( Yii::app()->params['site_type']) $result = HelperUtils::getPageBundleSupreme(C::SEARCH);
        
        $result['search'] = str_replace("-", " ", $this->search);

        try{ 
            if(!Yii::app()->params['site_type']){
                $result['busca_paginas'] = $this->searchHandler->getContent($result, "paginas");
                $result['busca_materias'] = array();
                $result['produtos'] = array();
            }
            
            if(Yii::app()->params['site_type']){
                $result['busca_paginas'] = $this->searchHandler->getContentSupreme($result, "paginas");
                $result['busca_materias'] = $this->searchHandler->getContentSupreme($result, "materias");
                $result['produtos'] = $this->searchHandler->getContentSupreme($result, "produtos");
            }
            
            $result['count'] = count($result['busca_paginas']) + count($result['busca_materias']) + count($result['produtos']);
            
            MethodUtils::setActionDone($result['search'], "busca");           
            
            $result['count'] = count($result['busca_paginas']) + count($result['busca_materias']) + count($result['produtos']);            
            
            $this->addScript($result);            
            $this->controller->layout = $result["plataform"] . "/index";
            $this->controller->render("/site/pages/buscar/" . $result['page']['layout'], $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: BuscarAction - procurar() " .$e->getMessage();
        }
    }
    
    /**
     *
     * Destaque Search
     * This method does the simple search using a jQuery request
     * Only some tables are consulted
     *
     */
    public function destaque(){

        $session = MethodUtils::getSessionData();
        $result = HelperUtils::getPageBundle(C::SEARCH);
        
        $result['search'] = str_replace("-", " ", $this->search);
        $result['id_user_main'] = 0;
        $result['isNeededMoreUsers'] = false;

        try{            
            $result['menu_active'] = $session['menu_active'];            
            
            $result['users'] = $this->searchHandler->getContent($result, "users");
            
            $result['count'] = count($result['users']);
            
            
            MethodUtils::setActionDone("busca", $result['search']);
            
            $this->addScript($result['layout']['layout_site']);
            
            $this->controller->layout = $result["plataform"] . "/index";
            $this->controller->render("/site/pages/buscar/destaques", $result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: BuscarAction - destaque() " .$e->getMessage();
        }
    }
    
    /**
     *
     * Search Recent Activity
     * Shows the recent activity, this method is used as request.
     * The real calculates are done into ActivityUtils, this stament is just 
     * to display some action, since BuscaAction is a general class. 
     *
     */
    public function recentActivity(){
        
        Yii::import('application.extensions.utils.ActivityUtils');
        
        try{            
            $recordset = ActivityUtils::getActivityByTimer();
            echo json_encode($recordset);
            
        }catch(CDbException $e){
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
    public function addScript($result){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';

    }
}

?>