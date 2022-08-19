<?php
/*
 * This Class is used to controll all functions related the feature Logos
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */
class LogosManager{

    /**
     * Método para recuperar os logos
     * 
     * PS: Pay Attention with the sort
     *
     * @param string page
     *
    */
    public function getAllContent(){
        
        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        
        try{
            $result = array();
            $session = MethodUtils::getSessionData();
            $pA = new PreferencesAttribute();

            ($session['miniSiteUser'] != '') ? $id_user = $session['miniSiteUser'] : $id_user = 0;
            $pA->setCurrentUser($id_user);

            $result['container_1'] = $pA->recuperar("logo_redes_sociais", "texto");
            $result['container_2'] = $pA->recuperar("logo_email", "texto");
            $result['container_3'] = $pA->recuperar("logo_tablet_intro", "texto");
            $result['container_4'] = $pA->recuperar("logo_tablet", "texto");
            $result['container_5'] = $pA->recuperar("logo_app", "texto");
            $result['container_6'] = $pA->recuperar("logo_mobile", "texto");
            $result['container_7'] = $pA->recuperar("logo_site", "texto");
            $result['container_8'] = $pA->recuperar("logo_impressao", "texto");
            $result['container_9'] = $pA->recuperar("logo_redes_sociais", "texto");
            $result['container_10'] = $pA->recuperar("logo_redes_sociais", "texto");
            $result['container_11'] = $pA->recuperar("logo_mobile", "texto");

            return $result;
        
         }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR LogosManager - getAllContent() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar um registro existente
     *
     * It updates the selected content 
     * The get_post array is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateContent($dados){

        Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
        Yii::import('application.extensions.dbuzz.admin.DetalhesManager');
        
        try{
            $session = MethodUtils::getSessionData();
            $detalhesHandler = new DetalhesManager();
            $pA = new PreferencesAttribute();        

            ($session['miniSiteUser'] != '') ? $id_user = $session['miniSiteUser'] : $id_user = 0;

            $pA->setCurrentUser($id_user);

            if($dados['logo_email']) $detalhesHandler->updateContent(array(0 => 'logos', 1 => $dados['logo_email_image'], 'is_return' => true, 'query' => " WHERE id_user = {$id_user}"));

            $result['logo_email'] = $pA->adicionar("logo_email", $dados['logo_email'], "texto");
            $result['logo_rede'] = $pA->adicionar("logo_redes_sociais", $dados['logo_network'], "texto");
            $result['logo_tablet'] = $pA->adicionar("logo_tablet_intro", $dados['logo_tablet_intro'], "texto");
            $result['logo_tablet2'] = $pA->adicionar("logo_tablet", $dados['logo_tablet'], "texto");
            $result['logo_app'] = $pA->adicionar("logo_app", $dados['logo_app'], "texto");
            $result['logo_mobile'] = $pA->adicionar("logo_mobile", $dados['logo_mobile'], "texto");
            $result['logo_site'] = $pA->adicionar("logo_site", $dados['logo_site'], "texto");
            $result['logo_site2'] = $pA->adicionar("logo_site_string", $dados['logo_site_image'], "texto");
            $result['logo_impressao'] = $pA->adicionar("logo_impressao", $dados['logo_impressao'], "texto");
            $result['message'] = Yii::t("messageStrings", "message_result_brand_update");
            
            echo json_encode($result);
            
         }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR LogosManager - updateContent() ". $e->getMessage();
        }
        
    }
}
?>