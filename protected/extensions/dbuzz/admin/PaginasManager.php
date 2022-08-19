<?php
/*
 * This Class is used to controll all functions related the feature Paginas
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 * $ua = new dbUserAttribute();
 *
 */

class PaginasManager{

    /**
     * metodo para recuperar os textos
     *
     * @param string page
     *
    */
    public function getContent($page){        

        $select = "id, nome, menu_principal, menu_2, menu_3, n_index, label, action, tipo,".
                  "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06,".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06,".
                  "link_01, link_02, link_03, link_04, link_05, link_06, banner_exibe, modelo, ".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06, icon, keywords, controller,".
                  "id_categoria, layout, id_user, dica_exibe, network_exibe, video_exibe, main_for_group, link_special, breadcrumb_exibe";

        $sql = "SELECT ".$select." FROM paginas_data WHERE nome = '$page'";

        try{          
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();

            for($i = 1; $i < 7; $i++){
                $recordset['visibility' . $i] = $this->verifyText($recordset['titulo_0' . $i], $i);
            }
            
            //Avoid a unnecessary text label
            if($recordset['label'] == 'vazio') $recordset['label'] = "";
            
            //Next field set editable
            $recordset['num'] = 2;

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getContent() " .$e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros da tabela paginas_data
     *
     *
     */
    public function getAllContent($isFull = false){

        $select = "id, nome, menu_principal, menu_2, menu_3, n_index, label, action, tipo,".
                  "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06,".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06,".
                  "link_01, link_02, link_03, link_04, link_05, link_06, banner_exibe, modelo, ".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06, icon, keywords, ".
                  "id_categoria, controller, layout, id_user, dica_exibe, network_exibe, video_exibe, main_for_group, link_special, views";

        $sql = "SELECT ".$select." FROM paginas_data WHERE tipo != 'perfil' AND tipo != 'elearn' ORDER BY n_index ASC";        
        if($isFull)$sql = "SELECT ".$select." FROM paginas_data AND exibe = 1";

        try{

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();            
             //Next field set editable
            $recordset['num'] = 2;
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getAllContent() " .$e->getMessage();
        }
    }


    /**
     * Metodo para recuperar os textos via id
     *
     * @param number id
     *
    */
    public function getContentById($id){

        $select = "id, nome, menu_principal, menu_2, menu_3, n_index, label, action, tipo,".
                  "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06,".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06,".
                  "link_01, link_02, link_03, link_04, link_05, link_06, banner_exibe, modelo, ".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06, icon, keywords,".
                  "id_categoria, controller, layout, id_user, dica_exibe, network_exibe, video_exibe, main_for_group, ".
                  "link_special, titulo_pagina, hotsite, breadcrumb_exibe";

        $sql = "SELECT ".$select." FROM paginas_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
                     
            $loop = true;
            
            if($recordset){
                for($i = 1; $i < 7; $i++){
                    $recordset['visibility' . $i] = $this->verifyText($recordset['titulo_0' . $i], $i);                
                    if($recordset['visibility' . $i] != "" && $loop == true){
                        //Next field set editable
                        $recordset['num'] = $i;
                        $loop = false;
                    }
                }
            }
            
            //Sets the first field set editable
            $recordset['num'] = 2;
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getContentById() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar os gráficos via id
     *
     * @param number id
     *
    */
    public function getSlotsById($id){

        $select = "container_1, container_2, container_3, container_4, container_5,".
                  "container_6, container_7, container_8, container_9, container_10, banner, icon";

        $sql = "SELECT ".$select." FROM paginas_data WHERE id = '$id'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getSlotsById() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar o id do controller atual
     *
     * @param number id
     *
    */
    public function getContentController($controller){

        $sql = "SELECT id FROM paginas_data WHERE controller = '$controller'";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();            
            return $recordset['id'];

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getContentController() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o id do controller atual utilizando 
     * o label como limitante
     *
     * @param string
     *
    */
    public function getContentControllerByLabel($controller){

        $sql = "SELECT id FROM paginas_data WHERE nome = '$controller'";

        try {

            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();            
            return $recordset['id'];

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getContentControllerByLabel() " . $e->getMessage();
        }

    }

    /**
     * Método para verificar qual block deve estar oculto
     * ao abrir a página
     *
     * @param string page
     *
    */
    public function verifyText($text, $i){
        ($text == "") ? $display = "visibility" . $i : $display = "";
        return $display;
    }


    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getPagesInfoEdit($session, $isHidden = false){
        
        //Sets the first field set editable
        $recordset['num'] = 2;
        
        $status = 1;
        if($isHidden) $status = 0;
        if($isHidden && $session['master_purple']) $status = '0 OR exibe = 2';
        
        $select = "id, nome, menu_principal, menu_2, menu_3, n_index, label, layout, banner, action, tipo,".
                  "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06,".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06,".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06,".
                  "link_01, link_02, link_03, link_04, link_05, link_06, modelo, ".
                  "container_1, container_2, container_3, container_4, container_5, container_6, ".
                  "container_7, container_8, container_9, container_10, icon, plataforma, keywords, ".
                  "id_categoria, dica_exibe, network_exibe, video_exibe, main_for_group, link_special, breadcrumb_exibe, views";

        $sql = "SELECT ".$select." FROM paginas_data WHERE plataforma = '".$session['device']. "' AND id != 0 AND label != 'vazio' AND tipo != 'elearn' AND exibe = $status AND id_user = 0 ORDER BY menu_principal DESC, label ASC";
       
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            return $recordset;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: PaginasMAnager - getPagesInfoEdit() " . $e->getMessage();
        }
    }

    /**
     * metodo para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data) {
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        $sLabel  = StringUtils::StringToUnderline($data[0], false, true);
        $session = MethodUtils::getSessionData();

        $select = "nome, menu_principal, menu_2, menu_3, n_index, label, ".
                  "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,".
                  "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06, ".
                  "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06, ".
                  "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06, ".
                  "link_01, link_02, link_03, link_04, link_05, link_06, ".
                  "container_1, container_2, container_3, container_4, container_5, ".
                  "container_6, container_7, container_8, container_9, container_10, banner, icon, banner_exibe, plataforma, keywords, ".
                  "layout, controller, tipo, id_user, dica_exibe, network_exibe, video_exibe, main_for_group, link_special, titulo_pagina, modelo, hotsite,".
                  "breadcrumb_exibe";

        $values = $sLabel."', '".$data['menu_principal']."', '".$data['menu_2']."', '".$data['menu_3']."', '".$data[3]."', '".$data[0]."', '".$data[4].
                  "', '".$data[6]."', '".$data[8]."', '".$data[10]."', '".$data[12]."', '".$data[14].
                  "', '".$data[16]."', '".$data[5]."', '".$data[7]."', '".$data[9]."', '".$data[11].
                  "', '".$data[13]."', '".$data[15].
                  "', '".$data['subtitulo_01']."', '".$data['subtitulo_02']."', '".$data['subtitulo_03']."', '".$data['subtitulo_04']."', '".$data['subtitulo_05']."', '".$data['subtitulo_06'].
                  "', '".$data['label_link_01']."', '".$data['label_link_02']."', '".$data['label_link_03']."', '".$data['label_link_04']."', '".$data['label_link_05']."', '".$data['label_link_06'].
                  "', '".$data['link_01']."', '".$data['link_02']."', '".$data['link_03']."', '".$data['link_04']."', '".$data['link_05']."', '".$data['link_06'].        
                  "', '".$data['slot_1'] ."', '".$data['slot_2'].
                  "', '".$data['slot_3']."', '".$data['slot_4']."', '".$data['slot_5']."', '".$data['slot_6'].
                  "', '".$data['slot_7']."', '".$data['slot_8']."', '".$data['slot_9']."', '".$data['slot_10'].
                  "', '".$data['banner'] ."', '".$data['icon']."', '".$data['banner_exibe']."', '".$session['device']."', '".$session['keywords'].
                  "', '".$data['layout']."', '".$data['controller']."', '".$data['tipo']."', '".$data['id_user']."', '".$data['dica_exibe'].
                  "', '".$data['network_exibe']."', '".$data['video_exibe']."', '".$data['main_for_group']."', '".$data['link_special']."', '".$data['titulo_pagina'] ."', '".$data['modelo'] ."', '".$data['id_hotsite'].
                  "', '".$data['breadcrumb_exibe'];

        $sql =  "INSERT INTO paginas_data (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $updateSiteMap = HelperUtils::createFeed('sitemap');
            
            if(isset($data['return'])){ return $control;}else{echo Yii::t("messageStrings", "message_result_page");}
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: PaginasMAnager - submitContent() " . $e->getMessage();
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
    public function updateContent($data) {
        
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        //Aqui verifica se a página é uma página exclusiva que não pode ser removida ou ter seu controller trocado
        //Special page
        if($data['special_page'] != "" && $data['special_page'] != "editar_curso"){ 
            
            $values = "n_index = '" . $data[3] ."', " ."label = '" . $data[0] ."', ".
                      "titulo = '" . $data[4] ."', " ."texto_01 = '" . $data[6] ."', " . "texto_02 = '" . $data[8] ."', " ."texto_03 = '" . $data[10] . "', ".
                      "texto_04 = '" . $data[12] ."', " . "texto_05 = '" . $data[14] ."', " ."texto_06 = '" . $data[16] . "', ".
                      "titulo_01 = '" . $data[5] ."', " ."titulo_02 = '" . $data[7] ."', " . "titulo_03 = '" . $data[9] ."', " ."titulo_04 = '" . $data[11] . "', " .
                      "titulo_05 = '" . $data[13] ."', " ."titulo_06 = '" . $data[15] ."', banner = '" . $data['banner'] ."', container_1 = '" . $data['slot_1'] ."', " .
                      "container_2 = '" . $data['slot_2'] ."', container_3 = '" . $data['slot_3'] ."', container_4 = '" . $data['slot_4'] ."', " .
                      "container_5 = '" . $data['slot_5'] ."',  container_6 = '" . $data['slot_6'] ."', container_7 = '" . $data['slot_7'] ."', " .
                      "subtitulo_01 = '" . $data['subtitulo_01'] ."',  subtitulo_02 = '" . $data['subtitulo_02'] ."', subtitulo_03 = '" . $data['subtitulo_03'] ."', " .
                      "subtitulo_04 = '" . $data['subtitulo_04'] ."',  subtitulo_05 = '" . $data['subtitulo_05'] ."', subtitulo_06 = '" . $data['subtitulo_06'] ."', " .
                      "label_link_01 = '" . $data['label_link_01'] ."',  label_link_02 = '" . $data['label_link_02'] ."', label_link_03 = '" . $data['label_link_03'] ."', " .
                      "label_link_04 = '" . $data['label_link_04'] ."',  label_link_05 = '" . $data['label_link_05'] ."', label_link_06 = '" . $data['label_link_06'] ."', " .
                      "link_01 = '" . $data['link_01'] ."',  link_02 = '" . $data['link_02'] ."', link_03 = '" . $data['link_03'] ."', " .
                      "link_04 = '" . $data['link_04'] ."',  link_05 = '" . $data['link_05'] ."', link_06 = '" . $data['link_06'] ."', " .
                      "container_8 = '" . $data['slot_8'] ."', container_9 = '" . $data['slot_9'] ."', container_10 = '" . $data['slot_10']."', icon = '" . $data['icon'] ."', banner_exibe = '" . $data['banner_exibe'] ."', " .
                      "keywords = '" . $data['keywords'] ."', controller = '" . $data['controller'] . "', layout = '" . $data['layout']. "', tipo = '" . $data['tipo'] ."', " .
                      "dica_exibe = '" . $data['dica_exibe']."', network_exibe = '" . $data['network_exibe']."', video_exibe = '" . $data['video_exibe']."', main_for_group = '" . $data['main_for_group'] . "', ".
                      "link_special = '" . $data['link_special']."', titulo_pagina = '" . $data['titulo_pagina']."', modelo = '" . $data['modelo'] ."', hotsite = '" . $data['id_hotsite']."', breadcrumb_exibe = '" . $data['breadcrumb_exibe']."', " .
                      "menu_principal = '" . $data['menu_principal']."', menu_2 = '" . $data['menu_2']."', menu_3 = '" . $data['menu_3']."'";
        }else{
            
            $sLabel = StringUtils::StringToUnderline($data[0], false, true);
            
            $values = "nome = '" . $sLabel ."', " . "n_index = '" . $data[3] ."', " ."label = '" . $data[0] ."', ".
                      "titulo = '" . $data[4] ."', " ."texto_01 = '" . $data[6] ."', " . "texto_02 = '" . $data[8] ."', " ."texto_03 = '" . $data[10] . "', ".
                      "texto_04 = '" . $data[12] ."', " . "texto_05 = '" . $data[14] ."', " ."texto_06 = '" . $data[16] . "', ".
                      "titulo_01 = '" . $data[5] ."', " ."titulo_02 = '" . $data[7] ."', " . "titulo_03 = '" . $data[9] ."', " ."titulo_04 = '" . $data[11] . "', " .
                      "titulo_05 = '" . $data[13] ."', " ."titulo_06 = '" . $data[15] ."', banner = '" . $data['banner'] ."', container_1 = '" . $data['slot_1'] ."', " .
                      "container_2 = '" . $data['slot_2'] ."', container_3 = '" . $data['slot_3'] ."', container_4 = '" . $data['slot_4'] ."', " .
                      "container_5 = '" . $data['slot_5'] ."',  container_6 = '" . $data['slot_6'] ."', container_7 = '" . $data['slot_7'] ."', " .
                      "subtitulo_01 = '" . $data['subtitulo_01'] ."',  subtitulo_02 = '" . $data['subtitulo_02'] ."', subtitulo_03 = '" . $data['subtitulo_03'] ."', " .
                      "subtitulo_04 = '" . $data['subtitulo_04'] ."',  subtitulo_05 = '" . $data['subtitulo_05'] ."', subtitulo_06 = '" . $data['subtitulo_06'] ."', " .
                      "label_link_01 = '" . $data['label_link_01'] ."',  label_link_02 = '" . $data['label_link_02'] ."', label_link_03 = '" . $data['label_link_03'] ."', " .
                      "label_link_04 = '" . $data['label_link_04'] ."',  label_link_05 = '" . $data['label_link_05'] ."', label_link_06 = '" . $data['label_link_06'] ."', " .
                      "link_01 = '" . $data['link_01'] ."',  link_02 = '" . $data['link_02'] ."', link_03 = '" . $data['link_03'] ."', " .
                      "link_04 = '" . $data['link_04'] ."',  link_05 = '" . $data['link_05'] ."', link_06 = '" . $data['link_06'] ."', " .
                      "container_8 = '" . $data['slot_8'] ."', container_9 = '" . $data['slot_9'] ."', container_10 = '" . $data['slot_10'] ."', icon = '" . $data['icon'] ."', banner_exibe = '" . $data['banner_exibe'] ."', ".
                      "keywords = '" . $data['keywords'] ."', controller = '" . $data['controller'] . "', layout = '" . $data['layout']. "', tipo = '" . $data['tipo'] ."', " .
                      "dica_exibe = '" . $data['dica_exibe']."', network_exibe = '" . $data['network_exibe']."', video_exibe = '" . $data['video_exibe'] ."', main_for_group = '" . $data['main_for_group'] . "', ".
                      "link_special = '" . $data['link_special']."', titulo_pagina = '" . $data['titulo_pagina']."', modelo = '" . $data['modelo']."', hotsite = '" . $data['id_hotsite']."', breadcrumb_exibe = '" . $data['breadcrumb_exibe']."', " .
                      "menu_principal = '" . $data['menu_principal']."', menu_2 = '" . $data['menu_2']."', menu_3 = '" . $data['menu_3']."'";
        }


        $sql =  "UPDATE paginas_data SET ". $values ." WHERE id = " .$data['id_page'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $updateSiteMap = HelperUtils::createFeed('sitemap');            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: PaginasMAnager - updateContent() " . $e->getMessage();
        }

    }

    /**
     * Método para deletar um determinado registro
     *
     * @param array
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM paginas_data WHERE id ='" . $data['id']. "'";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * Metodo para atualizar o layout de uma página específica
     *
     * It sets the a new layout into paginas_data table
     * The get_post array is a POST content from jQuery
     *
     * @param array
     *
    */
    public function defineContent($data){

        $values = "layout = '" . $data[0] ."', " . "controller = '" . $data[2] ."'";
        $sql =  "UPDATE paginas_data SET ". $values ." WHERE id = $data[1]";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar os registros da tabela especialmente
     * para preencher os registros de categorias, esta sendo utilzados para
     * completar combobox atualmente.
     *
     *
    */
    public function getAllContentForCategory($isBannerUtil = false){
        
        ($isBannerUtil) ? $limit = " AND tipo != 'elearn'" : $limit = "";
        $select = "id, nome, label";
        $sql = "SELECT ".$select." FROM paginas_data WHERE (nome != 'vazio' AND tipo != 'perfil' $limit) OR tipo = 'suporte'";
       
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasMAnager - getAllContentForCategory() " .$e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o status de exibição de campos
     * correspondentes|,
     *
     * @param number/string
     * @param number/string
     * @param number
     *
    */
    public function setAttributeData($field, $valor, $id_page){
        
        $values = $field . " = " . $valor;        
        $sql =  "UPDATE paginas_data SET ". $values ." WHERE id = $id_page";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            if($control){ 
                $message = Yii::t("messageStrings", "message_result_page_update");
            }else{
                $message = Yii::t("messageStrings", "message_result_action_error");
            }
            
            return $message; 
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: PaginasMAnager - setAttributeData() " .$e->getMessage();
        }
    } 
    
    /**
     * Método para recuperar os textos via id
     * Tecnologia - Pode ser 1 de Html5 com Bootstrap ou 0 simples
     *
     * @param string
     *
    */
    public function getLayoutTemplates($modelo){
        
        (Yii::app()->params['tecnologia'] == '') ? $tecnologia = 0 : $tecnologia = Yii::app()->params['tecnologia'];
        
        if($modelo == "" || $modelo == "vazio") $modelo = "paginas";

        $select = "id, titulo, descricao, thumb, cool, valor";
        $sql = "SELECT $select FROM conteudo_templates WHERE tipo = 'template' AND modelo = '$modelo' AND tecnologia = $tecnologia";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            $recordset[0]['qtd'] = count($recordset);
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasManager - getLayoutTemplates() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o conteúdo clear para pagina
     *
     * @param string page
     *
    */
    public function getContentClear(){ 
        
        $session = MethodUtils::getSessionData();
        
        try{
            $result = array("id" => 0, 
                "nome" => '', 'label' => '',
                'menu_principal' => '',
                'menu_2' => '', 'menu_3' => '',  'titulo' => '',  'frase' => '',
                'n_index' => '', 'banner_exibe' => '', 'network_exibe' => '',
                'titulo_01' => '','titulo_02' => '','titulo_03' => '','titulo_04' => '','titulo_05' => '','titulo_06' => '',
                'subtitulo_01' => '', 'subtitulo_02' => '', 'subtitulo_03' => '', 'subtitulo_04' => '', 'subtitulo_05' => '', 'subtitulo_06' => '',
                'texto_01' => '', 'texto_02' => '', 'texto_03' => '', 'texto_04' => '', 'texto_05' => '', 'texto_06' => '',
                'label_01' => '', 'label_02' => '', 'label_03' => '', 'label_04' => '', 'label_05' => '', 'label_06' => '',
                'label_link_01' => '', 'label_link_02' => '', 'label_link_03' => '', 'label_link_04' => '', 'label_link_05' => '', 'label_link_06' => '',
                'visibility1' => '', 'visibility2' => 'visibility2', 'visibility3' => 'visibility3', 'visibility4' => 'visibility4', 'visibility5' => 'visibility5', 'visibility6' => 'visibility6',
                'link_01' => '', 'link_02' => '', 'link_03' => '', 'link_04' => '', 'link_05' => '', 'link_06' => '',
                'tipo' => '', 'id_user' => '', 'dica_exibe' => '', 'layout' => '', 'video_exibe', 'main_for_group' => '', 'keywords' => '',
                'link_special' => '', 'icon' => '', 'controller' => '', 'hotsite' => $session['hotsite_id'], 'breadcrumb_exibe' => 0,
                'fb_titulo' => '', 'fb_descricao' => '', 'fb_foto' => ''
            );

           
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasManager - getContentClear() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os layouts blocks de pagina
     *
     * @param number id
     *
    */
    public function getLayoutBlockTemplates($id_page){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');

        $select = "id, id_page, id_componente, n_index, titulo, tipo, json, exibe";
        $sql = "SELECT ".$select." FROM paginas_rows WHERE id_page = $id_page ORDER BY n_index ASC";
        

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['titulo_componente'] = BlocksUtils::getItemAttribute('titulo_componente', $recordset[$i]['id'], $recordset[$i]['id_componente'], $recordset[$i]['id_page']);
            }}
            
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginasManager - getLayoutBlockTemplates() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todas as páginas que farão parte do Json
     *
     *
    */
    public function getPagesInfoForJson(){
        
        Yii::import('application.extensions.dbuzz.DBManager');
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.admin.PaginasUtils');
        Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        $manager = new DBManager();
        
        $select  = "id, nome, menu_principal, menu_2, menu_3, n_index, label, layout, banner, action, tipo,";
        $select .= "titulo, texto_01, texto_02, texto_03, texto_04, texto_05, texto_06,";
        $select .= "titulo_01, titulo_02, titulo_03, titulo_04, titulo_05, titulo_06,";
        $select .= "subtitulo_01, subtitulo_02, subtitulo_03, subtitulo_04, subtitulo_05, subtitulo_06,";
        $select .= "label_link_01, label_link_02, label_link_03, label_link_04, label_link_05, label_link_06,";
        $select .= "link_01, link_02, link_03, link_04, link_05, link_06, ";
        $select .= "container_1, container_2, container_3, container_4, container_5, container_6, ";
        $select .= "container_7, container_8, container_9, container_10, icon, plataforma, keywords, ";
        $select .= "modelo, banner_exibe, controller, titulo_pagina, modelo, hotsite, ";
        $select .= "id_categoria, dica_exibe, network_exibe, video_exibe, main_for_group, link_special, breadcrumb_exibe, views";

        $sql = "SELECT $select FROM paginas_data WHERE id_user = 0 AND (plataforma = 'desktop' AND id != 0 AND tipo != 'elearn')";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();            
            
            $result = array();
            if($recordset){                
                foreach ($recordset as $values){
                    for($p = 1; $p <= 10; $p++){
                        if($values['container_' . $p] != ''){
                            $type = explode("_", $values['container_' . $p]);
                            $values['container_' . $p] = GraphicsUtils::getCoolContent($values['container_' . $p], false);
                            $values['container_' . $p]['slot_type'] = $type[0];
                        }
                        
                    }
                    
                    if($values['banner'] != ''){
                        $typeB = explode("_", $values['banner']);
                        $values['banner'] = GraphicsUtils::getCoolContent($values['banner'], false);
                        $values['banner']['slot_type'] = $typeB[0];
                    }
                    
                    if(isset($values['keywords'])) $values['tags'] = StringUtils::transFormStringToArray($values['keywords']);
                    //Get some extra resources
                    $values['page_prop'] = PaginasUtils::getPagesSpecialProperties($values['id'], $values['tipo']);
                    $values['extra'] = $manager->getExtraResources($values['layout']);
                    
                    //Banners - Ads
                    if($values['modelo'] == 0) $values['ads'] = $manager->getBannersForPages($values['id']);
                    if($values['modelo'] == 2) $values['ads'] = $manager->getBannersForPages($values['id'], true);
                    if($values['modelo'] == 1) $values['ads'] = array();
                 
                    //Componentes
                    if($values['modelo'] == 0) $values['rows'] = $manager->getModules($values['id']);
                    if($values['modelo'] == 1 || $values['modelo'] == 2) $values['rows'] = PaginasAdvancedUtils::getModuleFrontEnd($values['id']);                    
                    
                    $values['attributes'] = PaginasUtils::retrieveAttributes($values['id']);
                
                    //Set final data
                    $result[$values['nome']] = $values;
                }

            }
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: PaginasManager - getPagesInfoForJson() " . $e->getMessage();
        }
    }
}
?>