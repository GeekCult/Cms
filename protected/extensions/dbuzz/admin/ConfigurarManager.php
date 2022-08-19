<?php
/*
 * This Class is used to controll all functions related the feature Configurar
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */

class ConfigurarManager{

    /**
     * Método para recuperar um registro organizados por id
     *
     * @param string page
     *
    */
    public function getContentRedesSociais(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;

        $select = "facebook, twitter, orkut, linkedin, google_mais_um";
        $sql = "SELECT ".$select." FROM preferencias_data WHERE id_user = $id_user";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $recordset['canal_youtube'] = PreferencesUtils::getAttributes('canal_youtube', 'texto');
            $recordset['instagram'] = PreferencesUtils::getAttributes('instagram', 'texto');
            $recordset['flickr'] = PreferencesUtils::getAttributes('flickr', 'texto');
            $recordset['pinterest'] = PreferencesUtils::getAttributes('pinterest', 'texto');
            $recordset['skype'] = PreferencesUtils::getAttributes('skype', 'texto');
            $recordset['telefone'] = PreferencesUtils::getAttributes('telefone_contato', 'texto');
            $recordset['email_contato'] = PreferencesUtils::getAttributes('email_contato', 'texto');
            $recordset['rss'] = PreferencesUtils::getAttributes('rss', 'texto');
            $recordset['home'] = PreferencesUtils::getAttributes('home', 'texto');
            $recordset['site_map'] = PreferencesUtils::getAttributes('site_map', 'texto');
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());         
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro organizados por id
     *
     * @param string page
     *
    */
    public function getAllFaqContent(){
        
        Yii::import('application.extensions.utils.FaqUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, titulo, resposta, date, last_update, status";
        $sql = "SELECT ".$select." FROM general_faq";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['status_string'] =  FaqUtils::getStatus($recordset[$i]['status']);
                    $recordset[$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());         
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro organizados por id
     *
     * @param string page
     *
    */
    public function getFaqContent($id){
        
        Yii::import('application.extensions.utils.FaqUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, titulo, resposta, date, last_update, status";
        $sql = "SELECT ".$select." FROM general_faq WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());         
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro
     *
     *
    */
    public function getContentGoogleMaps(){

        $select = "google_maps";
        $sql = "SELECT ".$select." FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());       
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro
     *
     *
    */
    public function getContentGoogle($servico = ''){

        $sql = "SELECT ".$servico." FROM preferencias_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());       
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro
     * do Google Analitics
     *
    */
    public function getContentGoogleAnalytics(){
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != ''){$id_user = $session['miniSiteUser'];}else{$id_user = 0;}
        
        $select = "google_analytics, google_analytics_view";
        $sql = "SELECT $select FROM preferencias_data WHERE id_user = $id_user";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro
     * do Meta Tags
     *
    */
    public function getContentMetaTags(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != ''){$id_user = $session['miniSiteUser'];}else{$id_user = 0;}

        $select = "metatags, descricao, titulo, status";
        $sql = "SELECT ".$select." FROM preferencias_data WHERE id_user = $id_user";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $recordset['site_release'] = PreferencesUtils::getAttributes('site_release', 'texto');
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro
     * do E-mail de contato
     *
    */
    public function getContentEmailContato(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;
        
        $select = "email_contato, email_sender";
        $sql = "SELECT $select FROM preferencias_data WHERE id_user = $id_user";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $recordset['email_contato_ceos'] = PreferencesUtils::getAttributes("email_ceos");
            $recordset['email_title'] = PreferencesUtils::getAttributes("email_title");
            $recordset['email_marketing'] = PreferencesUtils::getAttributes("email_emkt");
            $recordset['email_marketing_teste'] = PreferencesUtils::getAttributes("email_emkt_teste");
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContentRedesSociais($get_post){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;

        $values = "facebook = '" . $get_post[0] ."', " ."twitter = '" . $get_post[1] ."', " . "orkut = '" . $get_post[2] ."', linkedin = '" . $get_post[3] ."', google_mais_um = '" . $get_post[4] ."' ";
        $sql =  "UPDATE preferencias_data SET  $values WHERE id_user = $id_user";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $setYoutube = PreferencesUtils::setAttributes('canal_youtube', $get_post[5], 'texto');
            $setYoutube = PreferencesUtils::setAttributes('flickr', $get_post[6], 'texto');
            $setYoutube = PreferencesUtils::setAttributes('instagram', $get_post[7], 'texto');
            $setYoutube = PreferencesUtils::setAttributes('pinterest', $get_post[8], 'texto');
            $setHome = PreferencesUtils::setAttributes('home', $get_post['home'], 'texto');
            $setSkype = PreferencesUtils::setAttributes('skype', $get_post['skype'], 'texto');
            $setrss = PreferencesUtils::setAttributes('rss', $get_post['rss'], 'texto');
            $setTelefone = PreferencesUtils::setAttributes('telefone_contato', $get_post['telefone'], 'texto');
            $setEmail = PreferencesUtils::setAttributes('email_contato', $get_post['email'], 'texto');
            $setSiteMap = PreferencesUtils::setAttributes('site_map', $get_post['site_map'], 'texto');
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContentMetaTag($get_post){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != ''){$id_user = $session['miniSiteUser'];}else{$id_user = 0;}

        $values = "titulo = '" . $get_post[0] . "', descricao = '" . $get_post[1] . "', metatags = '" . $get_post[2] . "', status = '" . $get_post[3] . "'";
        $sql = "UPDATE preferencias_data SET $values WHERE id_user = $id_user";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $setDateRelease = PreferencesUtils::setAttributes('site_release', $get_post[4], 'texto');
            $setDateRelease = PreferencesUtils::setAttributes('site_release_inverse', $get_post[5], 'texto');
            
            if($session['miniSiteUser'] != '') $clearCache = MethodUtils::updateMiniSites('settings'); 
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContentFaq($get_post){

        $select = "titulo, resposta, date, last_update, status";
        $status = 1;
        if($get_post['action'] == "site") $status = 0;
        $values = $get_post[0]."', '".$get_post[1]."', '".date("Y-m-d H:i:s") . "', '" .date("Y-m-d H:i:s"). "', ' $status ";
        
        
        if ($get_post['action'] != "faq_edit" ){
            $sql =  "INSERT INTO general_faq (". $select .") VALUES ('". $values . "')";
        }else{
            $sql  = "UPDATE general_faq SET titulo = '$get_post[0]', resposta = '$get_post[1]', ";
            $sql .= "last_update = '". date("Y-m-d H:i:s")."', status = 1 ";
            $sql .= "WHERE id = ". $get_post['id'] . "";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            $result = array("ERROR" => 0, "success"=> 1, "message" => $get_post['message']);
            echo json_encode($result);


        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para remover um registro
     *
     * @param number
     *
    */
    public function removeFaqContent($id){

        $sql = "DELETE FROM general_faq WHERE id ='" . $id . "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            return Yii::t('messageStrings', 'message_result_faq_remove');
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para aprovar um faq
     *
     * @param number
     *
    */
    public function changeStatusFaq($id, $status){

        try{
            $sql  = "UPDATE general_faq SET status = $status WHERE id = $id";
  
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();           

            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitEmailContato($get_post){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;
        
        $values = "email_contato = '{$get_post[0]}', email_sender = '{$get_post[1]}'";
        $sql = "UPDATE preferencias_data SET $values WHERE id_user = $id_user";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $setCeos = PreferencesUtils::setAttributes("email_ceos", $get_post[2], "texto");
            $setTitulo = PreferencesUtils::setAttributes("email_title", $get_post[4], "texto");
            $setEmkt = PreferencesUtils::setAttributes("email_emkt", $get_post[3], "texto");
            $setEmktTeste = PreferencesUtils::setAttributes("email_emkt_teste", $get_post[5], "texto");
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContentGoogleAnalytics($get_post){
        //82705661 //UA-48446240-1
        $session = MethodUtils::getSessionData();
        if($session['miniSiteUser'] != "") $id_user = $session['miniSiteUser']; else $id_user = 0;
        
        $values = "google_analytics = '{$get_post[0]}', google_analytics_view = '{$get_post[1]}'";
        $sql =  "UPDATE preferencias_data SET  $values WHERE id_user = $id_user";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContentGoogleMaps($get_post){

         $values = "google_maps = '" . $get_post[0] . "'";
         $sql =  "UPDATE preferencias_data SET ". $values;

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data){

         $values = $data['field'] . " = '" . $data['value'] . "'";
         $sql =  "UPDATE preferencias_data SET ". $values;

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os valores do combo share
     *
    */
    public function getContentComboShare(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{ 
            //Combo share
            $recordset['exibe_combo_share'] = PreferencesUtils::getAttributes("exibe_combo_share", 'inteiro');
            $recordset['combo_share_position'] = PreferencesUtils::getAttributes("combo_share_position");
            $recordset['combo_share_color'] = PreferencesUtils::getAttributes("combo_share_color");
            $recordset['combo_share_position_py'] = PreferencesUtils::getAttributes("combo_share_position_py", 'inteiro');
            
            // Facebook like box
            $recordset['exibe_facebook_likebox'] = PreferencesUtils::getAttributes("exibe_facebook_likebox", 'inteiro');
            $recordset['facebook_likebox_position'] = PreferencesUtils::getAttributes("facebook_likebox_position");
            $recordset['facebook_likebox_color'] = PreferencesUtils::getAttributes("facebook_likebox_color");
            $recordset['facebook_likebox_position_py'] = PreferencesUtils::getAttributes("facebook_likebox_position_py", 'inteiro');
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo 'ERROR: ConfigurarManager - getContentComboShare() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para definir valores do ComboShare
     *
     * @param array
     *
    */
    public function defineComboShare($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
            $set = PreferencesUtils::setAttributes("exibe_combo_share", $data['exibe'], "inteiro");
            $set = PreferencesUtils::setAttributes("combo_share_position", $data['position'], "texto");
            $set = PreferencesUtils::setAttributes("combo_share_color", $data['color'], "texto");
            $set = PreferencesUtils::setAttributes("combo_share_position_py", $data['position_py'], "inteiro");
            
            $set = PreferencesUtils::setAttributes("exibe_facebook_likebox", $data['exibe_likebox'], "inteiro");
            $set = PreferencesUtils::setAttributes("facebook_likebox_position", $data['position_likebox'], "texto");
            $set = PreferencesUtils::setAttributes("facebook_likebox_color", $data['color_likebox'], "texto");
            $set = PreferencesUtils::setAttributes("facebook_likebox_position_py", $data['position_py_likebox'], "inteiro");
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os valores do RSS Feeds
     *
    */
    public function getContentRss(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
            $recordset['exibe_materia'] = PreferencesUtils::getAttributes("rss_exibe_materia", 'inteiro');
            $recordset['titulo_materia'] = PreferencesUtils::getAttributes("rss_titulo_materia");
            $recordset['texto_materia'] = PreferencesUtils::getAttributes("rss_texto_materia", 'descricao');
            
            $recordset['exibe_eventos'] = PreferencesUtils::getAttributes("rss_exibe_eventos", 'inteiro');
            $recordset['titulo_eventos'] = PreferencesUtils::getAttributes("rss_titulo_eventos");
            $recordset['texto_eventos'] = PreferencesUtils::getAttributes("rss_texto_eventos", 'descricao');
            
            $recordset['exibe_produtos'] = PreferencesUtils::getAttributes("rss_exibe_produtos", 'inteiro');
            $recordset['titulo_produtos'] = PreferencesUtils::getAttributes("rss_titulo_produtos");
            $recordset['texto_produtos'] = PreferencesUtils::getAttributes("rss_texto_produtos", 'descricao');
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo 'ERROR: ConfigurarManager - getContentComboShare() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para definir valores do Rss
     *
     * @param array
     *
    */
    public function defineRss($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
            $set = PreferencesUtils::setAttributes("rss_exibe_materia", $data['exibe_materia'], "inteiro");
            $set = PreferencesUtils::setAttributes("rss_titulo_materia", $data['titulo_materia'], "texto");
            $set = PreferencesUtils::setAttributes("rss_texto_materia", $data['texto_materia'], "descricao");
            
            $set = PreferencesUtils::setAttributes("rss_exibe_eventos", $data['exibe_eventos'], "inteiro");
            $set = PreferencesUtils::setAttributes("rss_titulo_eventos", $data['titulo_eventos'], "texto");
            $set = PreferencesUtils::setAttributes("rss_texto_eventos", $data['texto_eventos'], "descricao");
            
            $set = PreferencesUtils::setAttributes("rss_exibe_produtos", $data['exibe_produtos'], "inteiro");
            $set = PreferencesUtils::setAttributes("rss_titulo_produtos", $data['titulo_produtos'], "texto");
            $set = PreferencesUtils::setAttributes("rss_texto_produtos", $data['texto_produtos'], "descricao");
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os valores dos selos
     *
    */
    public function getContentSelos(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
            $recordset['exibe_ebit_selo'] = PreferencesUtils::getAttributes("exibe_ebit_selo", 'inteiro');
            $recordset['exibe_ebit_banner'] = PreferencesUtils::getAttributes("exibe_ebit_banner", 'inteiro');
            $recordset['ebit_selo_cod'] = PreferencesUtils::getAttributes("ebit_selo_cod", 'descricao');
            $recordset['ebit_banner_cod'] = PreferencesUtils::getAttributes("ebit_banner_cod", 'descricao');
            
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo 'ERROR: ConfigurarManager - getContentComboShare() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para definir valores dos selos
     *
     * @param array
     *
    */
    public function defineSelos($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
            $set = PreferencesUtils::setAttributes("exibe_ebit_selo", $data['exibe_ebit_selo'], "inteiro");
            $set = PreferencesUtils::setAttributes("ebit_selo_cod", $data['ebit_selo_cod'], "descricao");
            
            $set = PreferencesUtils::setAttributes("exibe_ebit_banner", $data['exibe_ebit_banner'], "inteiro");
            $set = PreferencesUtils::setAttributes("ebit_banner_cod", $data['ebit_banner_cod'], "descricao");
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}
?>