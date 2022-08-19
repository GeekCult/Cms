<?php

/**
 * Description of PreferencesViewUtils
 *
 * This class works together PreferencesUtils
 *
 * @author CarlosGarcia 12/10/2010
 * 
 */
class PreferencesViewUtils{
    
    /**
     * Método para obter uma configuração especial de view.
     * Pode ser cadastro_usuario, popup, todo para personalizar os ramos de atuação.
     * 
     * @param string
     * 
    **/
    public static function getView($view, $field = "texto"){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        $result = $pA->recuperar($view, $field);        
        
        return $result;
    }
    
    /**
     * Save the views attributes
     *
     * @param array 
     *
    */
    public static function saveView($label, $value, $field = "texto", $isMessage = true){      

        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);        
       
        $pA->adicionar($label, $value, $field);
        
        if($isMessage) echo Yii::t("messageStrings", "message_result_config_view_update");
        return true;
    }
    
    /**
     * Método para obter uma configuração especial de view.
     * Utiliza um tipo para saber o que buscar e o tipo da conta para obter
     * o attribute correto.
     * 
     * @param string
     * 
    **/
    public static function getAttributesByType($label, $type, $field = "texto"){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $session = MethodUtils::getSessionData();
        
        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        $result = array();
        
        try{
            switch($label){
                case "banner_avisos":
                   
                    Yii::import('application.extensions.utils.GraphicsUtils');
                    if($type == 0 || $type == 2 || $type == 3 || $type == 4 || $type == 5) {
                        if($session['funcionario']){
                          $id = $pA->recuperar("banner_funcionario", $field);
                        }else if($session['atendimento'] || $session['administrador']){
                          $id = $pA->recuperar("banner_admin", $field); 
                        }else{
                          $id = $pA->recuperar("banner_pf", $field);   
                        }                    
                    }

                    if($type == 1) $id = $pA->recuperar("banner_pj", $field); 

                    $result = GraphicsUtils::getCoolContent($id);
                    break;

                case "link_avisos":
                    if($type == 0 || $type == 2 || $type == 4 || $type == 5){
                        if($session['funcionario']){
                          $result = $pA->recuperar("link_funcionario", $field);
                        }else if($session['atendimento'] || $session['administrador']){
                          $result = $pA->recuperar("link_admin", $field); 
                        }else{
                          $result = $pA->recuperar("link_pf", $field);   
                        };
                    }
                    if($type == 1) $result = $pA->recuperar("link_pj", $field);
                    break;
            }
        
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: PreferenceViewUtils - getAttributesByType() ".$e->getMessage();
        }
               
        
        return $result;
    }
    
    /**
     * Método para recuperar os logos
     * 
     * PS: Pay Attention with the sort
     *
     * @param string page
     *
    */
    public static function getAllBannersAvisos(){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        $result = array();

        $pA = new PreferencesAttribute();
        $pA->setCurrentUser(0);
        
        $result['container_1'] = $pA->recuperar("banner_pf", "texto");
        $result['container_2'] = $pA->recuperar("banner_pj", "texto");
        $result['container_3'] = $pA->recuperar("banner_admin", "texto");
        $result['container_4'] = $pA->recuperar("banner_funcionarios", "texto");
        
        $result['link_pf'] = $pA->recuperar("link_pf", "texto");
        $result['link_pj'] = $pA->recuperar("link_pj", "texto");
        $result['link_admin'] = $pA->recuperar("link_admin", "texto");
        $result['link_funcionarios'] = $pA->recuperar("link_funcionarios", "texto");

        return $result;
    }
}
?>