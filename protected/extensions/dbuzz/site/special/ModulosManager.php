<?php
/*
 * This Class is used to controll all functions related the feature Modulos
 * The Action ModuloAction must be improved, using this classes instead of the
 * statments into its action.
 * 
 * TODO: improve ModuloAcion
 * 
 * @author CarlosGarcia
 *
 *
 *
 */

class ModulosManager{
    
    
    /**
     * Método para redirecionar para o método específico
     *
     * @param string page
     *
    */
    public function getContents($modulo, $layout, $qtd, $divider, $extra){
        
        switch($modulo){
            
            case "noticias":
            case "colunas": 
            case "novidades":
            case "dicas":
            case "blog":
                $result = $this->getArticles($modulo, $qtd, 0);
                return $result;
                break;
            
            case "banners":
                $result = $this->getBanners("", $modulo, $layout, $qtd, $divider);
                return $result;
                break;
            
            case "form":
                $result = $this->loadFormModule("", $modulo, $layout, $qtd, $divider);
                return $result;
                break;
            
            case "eventos":
                $result = $this->loadEventModule("", $modulo, $layout, $qtd, $divider);
                return $result;
                break;
            
            case "galeria":
                $result = $this->loadGaleriaModule("", $modulo, $layout, $qtd, $divider, $extra);
                return $result;
                break;
            
            case "partner":
                $result = $this->loadPartnersModule("", $modulo, $layout, $qtd, $divider, $extra);
                return $result;
                break;
            
            default :
                return false;
                break;
        }
        
    }
    
    /**
     * Método para recuperar os conteúdos das matérias
     *
     * @param string 
     *
    **/
    public function getArticles($modulo, $qtd, $begin){

        Yii::import('application.extensions.dbuzz.admin.MateriasManager');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $materiasHandler = new MateriasManager();
        
        try{            
            $result[$modulo] =  $materiasHandler->getLimitedContent($modulo, "0", $qtd);            
            
            $result["classe_alerta"] = PreferencesUtils::getPreferedItem("classe_alerta");
            $result["classe_container"] = PreferencesUtils::getPreferedItem("classe_container");
            $result['path'] = "materias";
   
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: ModulosManagwer - getArticles() ' . $e->getMessage();
        }         
    }
    
    /**
     * Método para recuperar os conteúdos das matérias
     *
     * @param string 
     *
    **/
    public function getBanners($id, $modulo, $layout, $qtd, $divider){
       
    
        Yii::import('application.extensions.dbuzz.site.buscar.RelevanceManager');
        Yii::import('application.extensions.utils.BannersUtils');
        
        $relevanceHandler = new RelevanceManager();
        $session = MethodUtils::getSessionData();
        
        $type = BannersUtils::getSQLByLayout($layout);
        
        $result['content'] = $relevanceHandler->getAllBannersRecommended(22, $session['keywords'], $type['tipo'], $type['step'], $qtd);        
        $result['divider']  = $divider;
        
        return $result;
    }
    
    /*
     * It gets the module for a form component
     *
     * @param number
     * @param string
     * @param string
     * 
     */
    public function loadFormModule($id, $modulo, $layout, $qtd, $divider){
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $result['divider'] = PreferencesUtils::getPreferedItem("classe_container");       
        return $result;
    }
    
    /*
     * It gets the module for events components
     *
     * @param number
     * @param string
     * @param string
     * 
     */
    public function loadEventModule($id, $modulo, $layout, $qtd, $divider){

        Yii::import('application.extensions.dbuzz.admin.EventosManager');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $eventsHandler = new EventosManager();

        try{            
            $result["destaque"] =  $eventsHandler->getCurrentEvent();
          
            if($result["destaque"]['id'] != "") $result["eventos"]  =  $eventsHandler->getLastContentLimited(1, $result["destaque"]['id']); 
            $result['divider'] = $divider;
            $result["classe_alerta"] = PreferencesUtils::getPreferedItem("classe_alerta");
            
            //var_dump($result);
            //If there are no events, return nothing.
            if($result['destaque'] != FALSE){
                return $result; 
            }else{
                return false;
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: ModulosManagwer - loadEventModule() ' . $e->getMessage();
        }
    }
    
    /*
     * It gets a component specific module
     * 
     * @param number
     * @param string
     * @param string
     *
     */
    public function loadGaleriaModule($id, $modulo, $layout, $qtd, $divider, $extra){
   
        $galeria = explode('-', $extra);
        Yii::import('application.extensions.dbuzz.admin.GaleriaManager');
        $galeriaHandler = new GaleriaManager();
        
        try{            
            $result['content'] = $galeriaHandler->getAllAllowedContent($galeria[0], $galeria[1], true);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: ModulosManagwer - loadGaleriaModule() ' . $e->getMessage();
        }
        
        return $result;
    }
    
    /*
     * It gets a component specific module
     * 
     * @param number
     * @param string
     * @param string
     *
     */
    public function loadPartnersModule($id, $modulo, $layout, $qtd, $divider, $extra){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        
        try{ 
            $result = array();
            $user = UserUtils::getAllKindUsers('parceiro');
           
            if($user){ 
                for($i = 0; $i < count($user); $i++){
                    $result['parceiros'][$i] = UserSupportUtils::getUserByTag('parceiro', $user[$i]['id']);
                }
            }

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: ModulosManagwer - loadPartnersModule() ' . $e->getMessage();
        }
        //var_dump($result);
        return $result;
    }
}

?>