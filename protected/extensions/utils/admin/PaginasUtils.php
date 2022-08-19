<?php

/**
 * Description of PaginasUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class PaginasUtils {

    
    /**
     * Método para pegar as propriedades do evento, usado en Novo e editar Admin
     * Este métod agrupa as propriedades do objeto em um array para facilitar o uso deste
     * na view.
     *
    */
    public static function getUsedContainer($slot) {

        $slotTMP = false;

        switch(""){

            case $slot["container_1"]:
                $slotTMP = "1";
                break;

            case $slot["container_2"]:
                $slotTMP = "2";
                break;

            case $slot["container_3"]:
                $slotTMP = "3";
                break;

            case $slot["container_4"]:
                $slotTMP = "4";
                break;

            case $slot["container_5"]:
                $slotTMP = "4";
                break;

            case $slot["container_6"]:
                $slotTMP = "6";
                break;

            case $slot["container_7"]:
                $slotTMP = "7";
                break;

            case $slot["container_8"]:
                $slotTMP = "8";
                break;

            case $slot["container_9"]:
                $slotTMP = "9";
                break;

            case $slot["container_10"]:
                $slotTMP = "10";
                break;            

        }
        return $slotTMP;
    }
    
    /**
     * Método para obter os items do menu
     *
     * @param string image
     * @param array slot
     *
     */
    public static function getMenuContent($type, $id = false){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        try{
            //Get the last record
            $select = "id, nome, label, icon, action, controller, link_special";
            $sql = "SELECT $select FROM paginas_data WHERE $type = 1";
            if($id && $id != 0) $sql = "SELECT $select FROM paginas_data WHERE id_categoria = $id ORDER BY n_index ASC";

            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryAll();

            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['icon'] = GraphicsUtils::getCoolContent($recordset[$i]['icon']);
                }
            }

            return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasUtils - getMenuContent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os items do menu
     *
     * @param string image
     * @param array slot
     *
     */
    public static function getMenuSpecialContent($id){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.dbuzz.admin.special.MenuManager');
        
        $menuHandler = new MenuManager();
        
        try{
            $sql = "SELECT * FROM paginas_modulos WHERE id_row = $id";

            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['more'] = $menuHandler->getAllContentByType('menu_item', $recordset[$i]['id']);
                }
            }
          
            return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasUtils - getMenuContent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os modulos
     *
     * @param number
     *
     */
    public static function getModule($id_row){
        
        Yii::import('application.extensions.dbuzz.site.special.ModulosManager');        
        $modulesHandler = new ModulosManager();
        
        //Get the last record
        $select = "id_row, tipo, amount, layout, divider, extra";
        $sql = "SELECT ".$select." FROM paginas_modulos WHERE id_row = $id_row";
        
        try{
            $command = Yii::app()->db->createCommand($sql);        
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['content'] = $modulesHandler->getContents($recordset[$i]['tipo'], $recordset[$i]['layout'], $recordset[$i]['amount'], $recordset[$i]['divider'], $recordset[$i]['extra']);
            }
            
            return $recordset;
             
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasUtils - getModules() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter as páginas de conteúdo de um deterninado
     * curso de e-commerce
     * 
     * FYI: id_user neste caso é o id do curso/produto que essa página está linkado
     * 
     * @param number
     *
    */
    public static function getPagesContent($id, $isFull = false, $nr = 0, $isAll = false){
        
        $select = "id, n_index, label, titulo, layout, tipo";
        if($isFull)  $select = "id, n_index, id_user, label, titulo, layout, tipo";
   
        $sql = "SELECT ".$select." FROM paginas_data WHERE id_user = $id AND tipo = 'elearn' ORDER by n_index ASC LIMIT $nr, 5";  
        if($isAll) $sql = "SELECT ".$select." FROM paginas_data WHERE id_user = $id AND tipo = 'elearn' ORDER by n_index ASC";  
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasUtils - getPagesContent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter as páginas de conteúdo de um deterninado
     * curso de e-commerce
     * 
     * FYI: id_user neste caso é o id do curso/produto que essa página está linkado
     * 
     * @param number
     *
    */
    public static function getSimplePageContent($id, $isFull = false, $nr = 0){
        
        $select = "id, n_index, label, titulo, layout, tipo";
        if($isFull)  $select = "id, n_index, id_user, label, titulo, layout, tipo";
    
        $sql = "SELECT ".$select." FROM paginas_data WHERE id_user = $id AND tipo = 'elearn' AND n_index = $nr ORDER by n_index ASC";  
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PaginasUtils - getSimplePageContent '. $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar attributes a tabela paginas attributes
     * 
     * @param array
     *
    */
    public static function retrieveAttributes($id, $isResizeVideo = false, $isHotsite = false){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.special.VideoUtils');
        
        if($id != ""){
        
            $result['video_1'] = PaginasUtils::getAttributes($id, "video_1", "descricao", false);
            $result['video_2'] = PaginasUtils::getAttributes($id, "video_2", "descricao", false);
            $result['video_3'] = PaginasUtils::getAttributes($id, "video_3", "descricao", false);

            $result['dica_titulo'] = PaginasUtils::getAttributes($id, "dica_titulo", "texto", false);
            $result['dica_subtitulo'] = PaginasUtils::getAttributes($id, "dica_subtitulo", "texto", false);
            $result['dica_texto'] = PaginasUtils::getAttributes($id, "dica_texto", "descricao", false);
            
            $result['galeria_usuarios'] = PaginasUtils::getAttributes($id, "galeria_usuarios", "texto", false);
            
            //Dubin Core
            $result['dc_identificator'] = PaginasUtils::getAttributes($id, "dc_identificator", "texto", false);
            $result['dc_format'] = PaginasUtils::getAttributes($id, "dc_format", "texto", false);
            $result['dc_language'] = PaginasUtils::getAttributes($id, "dc_language", "texto", false);
            $result['dc_publisher'] = PaginasUtils::getAttributes($id, "dc_publisher","texto", false);
            $result['dc_email'] = PaginasUtils::getAttributes($id, "dc_email", "texto", false);
            $result['dc_creator'] = PaginasUtils::getAttributes($id, "dc_creator", "texto", false);
            $result['dc_subject'] = PaginasUtils::getAttributes($id, "dc_subject", "descricao", false);
            $result['dc_publisher'] = PaginasUtils::getAttributes($id, "dc_publisher", "texto", false);
            $result['dc_contributor'] = PaginasUtils::getAttributes($id, "dc_contributor", "texto", false);
            $result['dc_date'] = PaginasUtils::getAttributes($id, "dc_date", "texto", false);
            $result['dc_relation'] = PaginasUtils::getAttributes($id, "dc_relation", "texto", false);
            $result['dc_coverage'] = PaginasUtils::getAttributes($id, "dc_coverage", "texto", false);
            $result['dc_copyright'] = PaginasUtils::getAttributes($id, "dc_copyright", "descricao", false);
            
            //Facebook
            $result['fb_titulo'] = PaginasUtils::getAttributes($id, "titulo_rs_fb", "texto", false);
            $result['fb_texto'] = PaginasUtils::getAttributes($id, "texto_rs_fb", "descricao", false);
            $result['fb_slot_1'] = PaginasUtils::getAttributes($id, "slot_fb_1", "texto", false);
            
            
            
        
        }else{        
            $result['video_1'] = "";
            $result['video_2'] = "";
            $result['video_3'] = "";

            $result['dica_titulo'] = "";
            $result['dica_subtitulo'] = "";
            $result['dica_texto'] = "";
            
            //Dubin Core
            $result['dc_identificator'] = '';
            $result['dc_format'] = '';
            $result['dc_language'] = '';
            $result['dc_publisher'] = '';
            $result['dc_email'] = '';
            $result['dc_creator'] = '';
            $result['dc_subject'] = '';
            $result['dc_publisher'] = '';
            $result['dc_contributor'] = '';
            $result['dc_date'] = '';
            $result['dc_relation'] = '';
            $result['dc_coverage'] = '';
            $result['dc_copyright'] = '';
            
            //Facebook
            $result['fb_titulo'] = '';
            $result['fb_texto'] = '';
            $result['fb_slot_1'] = '';
        
        }
        
        if($isHotsite){
            ($id != "") ? $result['topo_exibe'] = PaginasUtils::getAttributes($id, "topo_exibe", "inteiro", false) : $result['topo_exibe'] = "";
            ($id != "") ? $result['rodape_exibe'] = PaginasUtils::getAttributes($id, "rodape_exibe", "inteiro", false) : $result['rodape_exibe'] = "";
        }
        
        if($isResizeVideo) $result['video_1'] = VideoUtils::resizeVideo($result['video_1']);
        return $result;
    }
    
 
    
    /**
     * Método para adicionar attributes a tabela paginas attributes
     * 
     * @param array
     *
    */
    public static function defineAttributes($data){
        
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        
        try{
            $video1 = PaginasUtils::setAttributes($data['id_page'], "video_1", $data['video_1'], "descricao");
            $video2 = PaginasUtils::setAttributes($data['id_page'], "video_2", $data['video_2'], "descricao");
            $video3 = PaginasUtils::setAttributes($data['id_page'], "video_3", $data['video_3'], "descricao");

            $dica1 = PaginasUtils::setAttributes($data['id_page'], "dica_titulo", $data['dica_titulo'], "texto");
            $dica2 = PaginasUtils::setAttributes($data['id_page'], "dica_subtitulo", $data['dica_subtitulo'], "texto");
            $dica3 = PaginasUtils::setAttributes($data['id_page'], "dica_texto", $data['dica_texto'], "descricao");

            $galeria_usuarios = PaginasUtils::setAttributes($data['id_page'], "galeria_usuarios", $data['galeria_usuarios'], "texto");
            
            //Dubin Core
            $db1 = PaginasUtils::setAttributes($data['id_page'], "dc_identificator", trim($data['dc_identificator']), "texto");
            $db2 = PaginasUtils::setAttributes($data['id_page'], "dc_format", trim($data['dc_format']), "texto");
            $db3 = PaginasUtils::setAttributes($data['id_page'], "dc_language", trim($data['dc_language']), "texto");
            $db4 = PaginasUtils::setAttributes($data['id_page'], "dc_publisher", trim($data['dc_publisher']), "texto");
            $db5 = PaginasUtils::setAttributes($data['id_page'], "dc_email", trim($data['dc_email']), "texto");
            $db6 = PaginasUtils::setAttributes($data['id_page'], "dc_creator", trim($data['dc_creator']), "texto");
            $db7 = PaginasUtils::setAttributes($data['id_page'], "dc_subject", trim($data['dc_subject']), "descricao");
            $db8 = PaginasUtils::setAttributes($data['id_page'], "dc_publisher", trim($data['dc_publisher']), "texto");
            $db9 = PaginasUtils::setAttributes($data['id_page'], "dc_contributor", trim($data['dc_contributor']), "texto");
            if($data['special_page'] == 'novo')$db10 = PaginasUtils::setAttributes($data['id_page'], "dc_date", date('Y-m-d'), "texto");
            $db11 = PaginasUtils::setAttributes($data['id_page'], "dc_relation", trim($data['dc_relation']), "texto");
            $db12 = PaginasUtils::setAttributes($data['id_page'], "dc_coverage", trim($data['dc_coverage']), "texto");
            $db13 = PaginasUtils::setAttributes($data['id_page'], "dc_copyright", trim($data['dc_copyright']), "descricao");
            $db14 = PaginasUtils::setAttributes($data['id_page'], "dc_title", trim($data[2]), "texto");
            $db15 = PaginasUtils::setAttributes($data['id_page'], "dc_description", trim($data['keywords']), "descricao");
            $db16 = PaginasUtils::setAttributes($data['id_page'],"dc_lastupdate",trim(date('Y-m-d')), "texto");
            
            //Facebook
            $fb1 = PaginasUtils::setAttributes($data['id_page'], "titulo_rs_fb", $data['fb_titulo'], "texto");
            $fb2 = PaginasUtils::setAttributes($data['id_page'], "texto_rs_fb", $data['fb_texto'], "descricao");
            $fb3 = PaginasUtils::setAttributes($data['id_page'], "slot_fb_1", $data['slot_fb_1'], "texto");
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - defineAttributes() ' . $e->getMessage();
        }
        
    }
    
    /**
     * Método para adicionar attributes da tabela paginas_attributes
     * 
     * @param string and numbers
     *
    */
    public static function setAttributes($id, $name, $value, $tipo = "texto"){
   
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        
        $isSet = PaginasUtils::getAttributes($id, $name, $tipo);
        
        if(!$isSet){ 
            $sql =  "INSERT INTO paginas_attribute (id_pagina, name, $tipo) VALUES ('$id ', '$name', '$value')";
        }else{
            $sql =  "UPDATE paginas_attribute SET $tipo = '$value' WHERE id_pagina = $id AND name = '$name'";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            //Se estiver vazio não salva
            if($value != "" || $isSet){
                $control = $comando->execute();
                return $control;
            }

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - setAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os attributes da tabela paginas_attributes
     * 
     *
    */
    public static function getAttributes($id, $name, $tipo = "texto", $isFull = true){
        if($id == '') return;
        $select = "name, texto, inteiro, descricao";
        $sql = "SELECT ".$select." FROM paginas_attribute WHERE id_pagina = $id AND name = '$name'";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
          
            if($isFull){
                return $recordset;
            }else{
                if($recordset) $recordset[$tipo];
                return $recordset;
            }

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - getAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os attributes da tabela paginas_attributes usando valores comuns ao usuário
     * Esse método utiliza os atributos de páginas únicas e especialmente do usuário pai.
     * É utilizado para setar o Settings.php 
     * 
     * @param string
     * @param string
     * @param number
     *
    */
    public static function getAttributesByUser($name, $tipo = "texto", $id_user = 0, $isFull = false){

        $select = "name, texto, inteiro, descricao";
        $sql = "SELECT ".$select." FROM paginas_attribute WHERE user_id = $id_user AND name = '$name'";  
 
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
          
            if($isFull){
                return $recordset;
            }else{
                return $recordset[$tipo];
            }

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - getAttributesByUser() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar as propriedade de paginas
     * 
     * @param array
     *
    */
    public static function definePagesProperties($id){
        
        $result = array();
        $session = MethodUtils::getSessionData();
        
        try{
            switch($_POST['tipo']){
                case 'materias':
                case 'blog':
                case 'wiki':
                    if(isset($_POST['mat_lk_rcn_qtd'])) $result['qtd'] = PaginasUtils::setAttributes($id, "mat_lk_rcn_qtd", $_POST['mat_lk_rcn_qtd'], "inteiro");
                    if(isset($_POST['mat_lk_rcn_afi'])) $result['afi'] = PaginasUtils::setAttributes($id, "mat_lk_rcn_afi", $_POST['mat_lk_rcn_afi'], "texto");
                    if(isset($_POST['mat_lk_rcn_adv'])) $result['adv'] = PaginasUtils::setAttributes($id, "mat_lk_rcn_adv", $_POST['mat_lk_rcn_adv'], "inteiro");
                    if(isset($_POST['mat_lk_rcn_blc'])) $result['blc'] = PaginasUtils::setAttributes($id, "mat_lk_rcn_blc", $_POST['mat_lk_rcn_blc'], "inteiro");
                    if(isset($_POST['mat_lk_rcn_img'])) $result['blc'] = PaginasUtils::setAttributes($id, "mat_lk_rcn_img", $_POST['mat_lk_rcn_img'], "inteiro");
                    break;
                    
                case 'galeria': 
                    if(isset($_POST['gal_date'])) $result['dat'] = PaginasUtils::setAttributes($id, "gal_date", MethodUtils::getBooleanNumber($_POST['gal_date']), "inteiro");
                    if(isset($_POST['gal_fr_dt'])) $result['frs'] = PaginasUtils::setAttributes($id, "gal_fr_dt", $_POST['gal_fr_dt'], "descricao");
                    if(isset($_POST['gal_subfr_dt'])) $result['frs'] = PaginasUtils::setAttributes($id, "gal_subfr_dt", $_POST['gal_subfr_dt'], "descricao");
                    break;
                    
                case 'eventos': 
                    if(isset($_POST['evt_date'])) $result['dat'] = PaginasUtils::setAttributes($id, "evt_date", MethodUtils::getBooleanNumber($_POST['evt_date']), "inteiro");
                    if(isset($_POST['evt_fr_dt'])) $result['frs'] = PaginasUtils::setAttributes($id, "evt_fr_dt", $_POST['evt_fr_dt'], "descricao");
                    if(isset($_POST['evt_fr_prof'])) $result['frs_prof'] = PaginasUtils::setAttributes($id, "evt_fr_prof", $_POST['evt_fr_prof'], "texto");
                    if(isset($_POST['evt_form_type'])) $result['form_type'] = PaginasUtils::setAttributes($id, "evt_form_type", $_POST['evt_form_type'], "texto");
                    if(isset($_POST['evt_calendario_exibe'])) $result['evt_calendario_exibe'] = PaginasUtils::setAttributes($id, "evt_calendario_exibe", MethodUtils::getBooleanNumber($_POST['evt_calendario_exibe']), "inteiro");
                    if(isset($_POST['evt_formulario_open'])) $result['evt_formulario_open'] = PaginasUtils::setAttributes($id, "evt_formulario_open", MethodUtils::getBooleanNumber($_POST['evt_formulario_open']), "inteiro");
                    if(isset($_POST['evt_img_size'])) $result['evt_img_size'] = PaginasUtils::setAttributes($id, "evt_img_size", $_POST['evt_img_size'], "inteiro");
                    break;
                
                case 'produtos': 
                case 'produtos_detalhes':
                    if(isset($_POST['prod_qtd_vitrine'])) $result['prod_qtd'] = PaginasUtils::setAttributes($id, "prod_qtd_vitrine", $_POST['prod_qtd_vitrine'], "inteiro");
                    break;
                    
                case 'depoimentos': 
                    if(isset($_POST['titulo_depoimento'])) $result['titulo_depoimento'] = PaginasUtils::setAttributes($id, "titulo_depoimento", $_POST['titulo_depoimento'], "texto");
                    if(isset($_POST['subtitulo_depoimento'])) $result['subtitulo_depoimento'] = PaginasUtils::setAttributes($id, "subtitulo_depoimento", $_POST['subtitulo_depoimento'], "texto");
                    if(isset($_POST['descricao_depoimento'])) $result['descricao_depoimento'] = PaginasUtils::setAttributes($id, "descricao_depoimento", $_POST['descricao_depoimento'], "descricao");
                    break;
                
                case 'contato':
                    if(isset($_POST['ctt_company_name'])) $result['ctt_company_name'] = PaginasUtils::setAttributes($id, "ctt_company_name", $_POST['ctt_company_name'], "texto");
                    if(isset($_POST['ctt_address'])) $result['ctt_address'] = PaginasUtils::setAttributes($id, "ctt_address", $_POST['ctt_address'], "descricao");
                    if(isset($_POST['ctt_tel_1'])) $result['ctt_tel_1'] = PaginasUtils::setAttributes($id, "ctt_tel_1", $_POST['ctt_tel_1'], "texto");
                    if(isset($_POST['ctt_tel_2'])) $result['ctt_tel_2'] = PaginasUtils::setAttributes($id, "ctt_tel_2", $_POST['ctt_tel_2'], "texto");
                    if(isset($_POST['ctt_fax'])) $result['ctt_fax'] = PaginasUtils::setAttributes($id, "ctt_fax", $_POST['ctt_fax'], "texto");
                    if(isset($_POST['ctt_celular'])) $result['ctt_celular'] = PaginasUtils::setAttributes($id, "ctt_celular", $_POST['ctt_celular'], "texto");
                    if(isset($_POST['ctt_email'])) $result['ctt_email'] = PaginasUtils::setAttributes($id, "ctt_email", $_POST['ctt_email'], "texto");
                    if(isset($_POST['ctt_cidade'])) $result['ctt_cidade'] = PaginasUtils::setAttributes($id, "ctt_cidade", $_POST['ctt_cidade'], "texto");
                    if(isset($_POST['ctt_estado'])) $result['ctt_estado'] = PaginasUtils::setAttributes($id, "ctt_estado", $_POST['ctt_estado'], "texto");
                    if(isset($_POST['ctt_site'])) $result['ctt_site'] = PaginasUtils::setAttributes($id, "ctt_site", $_POST['ctt_site'], "texto");
                    break;
                    
                case "fornecedor":
                    if(isset($_POST['forn_phrase'])) $result['forn_phrase'] = PaginasUtils::setAttributes($id, "forn_phrase", $_POST['forn_phrase'], "texto");
                    break;
            }
            
            //General
            if(isset($_POST['gel_fr_initial'])) $result['gel_fr_initial'] = PaginasUtils::setAttributes($id, "gel_fr_initial", $_POST['gel_fr_initial'], "descricao");
            
            if($session['miniSiteUser'] == '') $setSettingsFile = MethodUtils::updateSettingsFile();
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - definePagesProperties() ' . $e->getMessage();
        }
        
    }
    
    /**
     * Método para obeter attributes especiais das paginas
     * 
     * @param array
     *
    */
    public static function getPagesSpecialProperties($id, $tipo){
        
        $result = array();
     
        switch($tipo){
            case 'materias':
            case 'noticias':
            case 'blog':
            case 'wiki':
                $result['mat_lk_rcn_qtd'] = PaginasUtils::getAttributes($id, "mat_lk_rcn_qtd", "inteiro", false);
                $result['mat_lk_rcn_afi'] = PaginasUtils::getAttributes($id, "mat_lk_rcn_afi", "texto", false);
                $result['mat_lk_rcn_adv'] = PaginasUtils::getAttributes($id, "mat_lk_rcn_adv", "inteiro", false);
                $result['mat_lk_rcn_blc'] = PaginasUtils::getAttributes($id, "mat_lk_rcn_blc", "inteiro", false);
                $result['mat_lk_rcn_img'] = PaginasUtils::getAttributes($id, "mat_lk_rcn_img", "inteiro", false);
                break;
            
            case 'galeria':        
                $result['gal_date'] = PaginasUtils::getAttributes($id, "gal_date", "inteiro", false);
                $result['gal_fr_dt'] = PaginasUtils::getAttributes($id, "gal_fr_dt", "descricao", false);
                $result['gal_subfr_dt'] = PaginasUtils::getAttributes($id, "gal_subfr_dt", "descricao", false);
                break;
            
            case 'eventos':        
                $result['evt_date'] = PaginasUtils::getAttributes($id, "evt_date", "inteiro", false);
                $result['evt_fr_dt'] = PaginasUtils::getAttributes($id, "evt_fr_dt", "descricao", false);
                $result['evt_fr_prof'] = PaginasUtils::getAttributes($id, "evt_fr_prof", "texto", false);
                $result['evt_form_type'] = PaginasUtils::getAttributes($id, "evt_form_type", "texto", false);
                $result['evt_calendario_exibe'] = PaginasUtils::getAttributes($id, "evt_calendario_exibe", "inteiro", false);
                $result['evt_formulario_open'] = PaginasUtils::getAttributes($id, "evt_formulario_open", "inteiro", false);
                $result['evt_img_size'] = PaginasUtils::getAttributes($id, "evt_img_size", "inteiro", false);
                break;
            
            case 'produtos':  
            case 'produtos_detalhes':
                $result['prod_qtd_vitrine'] = PaginasUtils::getAttributes($id, "prod_qtd_vitrine", "inteiro", false);
                break;
            
            case 'depoimentos':  
                $result['titulo_depoimento'] = PaginasUtils::getAttributes($id, "titulo_depoimento", "texto", false);
                $result['subtitulo_depoimento'] = PaginasUtils::getAttributes($id, "subtitulo_depoimento", "texto", false);
                $result['descricao_depoimento'] = PaginasUtils::getAttributes($id, "descricao_depoimento", "descricao", false);
                break;
            
            case 'fornecedor': 
                //Yii::import('application.extensions.dbuzz.admin.erp.InsumosManager');
                //$insumosHandler = new InsumosManager();
                
                $result['content'] = array();
                $result['insumos'] = array();
                $result['forn_phrase'] = PaginasUtils::getAttributes($id, "forn_phrase", "texto", false);
                break;
            
             case 'home': 
                //Yii::import('application.extensions.dbuzz.admin.erp.InsumosManager');
                //$insumosHandler = new InsumosManager();
                
                $result['content'] = array();
                $result['insumos'] = array();
                $result['form_phrase'] = PaginasUtils::getAttributes($id, "form_phrase", "texto", false);
                break;
            
            case 'contato': 
                $result['ctt_company_name'] = PaginasUtils::getAttributes($id, "ctt_company_name", "texto", false);
                $result['ctt_address'] = PaginasUtils::getAttributes($id, "ctt_address", "descricao", false);
                $result['ctt_tel_1'] = PaginasUtils::getAttributes($id, "ctt_tel_1", "texto", false);
                $result['ctt_tel_2'] = PaginasUtils::getAttributes($id, "ctt_tel_2", "texto", false);
                $result['ctt_fax'] = PaginasUtils::getAttributes($id, "ctt_fax", "texto", false);
                $result['ctt_celular'] = PaginasUtils::getAttributes($id, "ctt_celular", "texto", false);
                $result['ctt_email'] = PaginasUtils::getAttributes($id, "ctt_email", "texto", false);
                $result['ctt_cidade'] = PaginasUtils::getAttributes($id, "ctt_cidade", "texto", false);
                $result['ctt_estado'] = PaginasUtils::getAttributes($id, "ctt_estado", "texto", false);
                $result['ctt_site'] = PaginasUtils::getAttributes($id, "ctt_site", "texto", false);
                break;
        }
        
        $result['gel_fr_initial'] = PaginasUtils::getAttributes($id, "gel_fr_initial", "descricao", false);
        
        return $result;
    }
    
    /**
     * Método para alterar o status de visibilidade da página, se deve ser exibida em listar/paginas ou deve ser ocultada
     * 
     * @param string and numbers
     *
    */
    public static function setPageVisibility($controller, $status){
        
        $sql = "UPDATE paginas_data SET exibe = '$status' WHERE tipo = '$controller'";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
           
            $control = $comando->execute();
            return $control;
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - setPageVisibility() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar uma visita a view
     * 
     * @param numbers
     *
    */
    public static function setVisit($data = array()){
        
        if(!isset($data['text']['id'])) return true;
        $data['text']['views'] = $data['text']['views'] + 1;        
        
        $sql = "UPDATE paginas_data SET views = {$data['text']['views']} WHERE id = {$data['text']['id']}";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
           
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: PaginasUtils - setVisit() ' . $e->getMessage();
        }
    }
}
?>
