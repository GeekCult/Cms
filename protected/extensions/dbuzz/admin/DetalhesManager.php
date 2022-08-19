<?php
/*
 * This Class is used to controll all functions related the feature details
 * such as: Logos, Flags and Icons
 *
 * @author CarlosGarcia
 *
 * Date: 16/12/2010
 *
 */

class DetalhesManager{

    /**
     * Método para recuperar todos os registros
     * da tabela personalizar detalhes.
     *
    */
    public function getAllContent($tipo){
        
        $select = "id, nome, tipo, local, altura, largura, url_image, classe";
        $sql = "SELECT ".$select." FROM personalizar_detalhes WHERE local = '$tipo'";
        $i = 0;

        try{         
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0 ){
                foreach($recordset as $value){

                    $recordset[$i]['checked'] = "checked";
                    $i++;
                }
            }
            
            return $recordset;            

        } catch (CDbException $e) {

            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }

    }

    /**
     * Método para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContent($id) {

        $select = "id, nome, tipo, local, altura, largura, url_image, classe";
        $sql = "SELECT ".$select." FROM personalizar_detalhes WHERE id= $id ";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data){

        $select = "nome, tipo, local, url_image, altura, largura, classe";
        $values = $data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6];
        $sql =  "INSERT INTO personalizar_detalhes (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando -> execute();

            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * metodo para excluir um registro
     *
     * @param string page
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM personalizar_detalhes WHERE id ='" . $data['id']. "'";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();

            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * Metodo para atualizar um registro existente
     *
     * It sets the a new texture into preferences table
     * The get_post variable is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateContent($data){
        
        if($data[0] == "container"){
            $values =  "classe_container = '" . $data[1]."'";
        }else{
            //Fucking Béééééééé!
            if($data[0] == 'topo_email') $data[0] = "textura_topo_email";
            if($data[0] == 'rodape_email') $data[0] = "textura_rodape_email";
            
            $values = $data[0] . " = '" . $data[1]."'";
        }
        
        //Se precisar de query
        (isset($data['query'])) ? $query = $data['query'] : $query = '';
        
        try{
            if($data[0] == "more" || $data[0] == "side_button" || $data[0] == "dividers" || $data[0] == "pagination"){
                Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
                $pA = new PreferencesAttribute();
                $pA->setCurrentUser(0);
                $pA->adicionar($data[0], $data[1], "texto"); 
                
                if($data['color'] != "")     $pA->adicionar('divider_color', $data['color'], "texto");
                if($data['espessura'] != "") $pA->adicionar('divider_espessura', $data['espessura'], "texto");
               
            }else{
                $sql =  "UPDATE preferencias_data SET ". $values . " $query";
                $comando = Yii::app()->db->createCommand($sql);
                $control = $comando -> execute();
            }            
           
            $content = HelperUtils::createCss();
            
            if(isset($data['is_return'])){return $control;}else{echo $data['message'];}
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR DetalhesManager - updateContent() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as rpeferencisa de extremos
     *
     * @param 
     *
    */
    public function getContentExtremos($type){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{
            if($type == 'topo'){
                $recordset['topo_altura'] = PreferencesUtils::getAttributes('topo_altura', 'inteiro');
                $recordset['topo_fit'] = PreferencesUtils::getAttributes('topo_fit', 'inteiro');
                $recordset['logo_altura'] = PreferencesUtils::getAttributes('logo_altura', 'inteiro');
                $recordset['logo_largura'] = PreferencesUtils::getAttributes('logo_largura', 'inteiro');
                $recordset['logo_pos_x'] = PreferencesUtils::getAttributes('logo_pos_x', 'inteiro');
                $recordset['logo_pos_y'] = PreferencesUtils::getAttributes('logo_pos_y', 'inteiro');
                $recordset['logo_container_width'] = PreferencesUtils::getAttributes('logo_container_width', 'inteiro');
                $recordset['logo_container_height'] = PreferencesUtils::getAttributes('logo_container_height', 'inteiro');
                $recordset['frase_searchbox'] = PreferencesUtils::getAttributes('frase_searchbox', 'texto');
            }
            
            if($type == 'rodape'){
                $recordset['rodape_copyright'] = PreferencesUtils::getAttributes('rodape_copyright', 'descricao');
                $recordset['ft_menu'] = PreferencesUtils::getAttributes('ft_menu', 'texto');
                $recordset['ft_menu_type'] = PreferencesUtils::getAttributes('ft_menu_type', 'inteiro');
                $recordset['ft_menu_color'] = PreferencesUtils::getAttributes('ft_menu_color', 'texto');
                $recordset['ft_line2'] = PreferencesUtils::getAttributes('ft_line2', 'texto');
                $recordset['ft_txt_line2'] = PreferencesUtils::getAttributes('ft_txt_line2', 'texto');
                $recordset['ft_titulo_menu'] = PreferencesUtils::getAttributes('ft_titulo_menu', 'texto');
                $recordset['ft_subtitulo_menu'] = PreferencesUtils::getAttributes('ft_subtitulo_menu', 'texto');
                $recordset['ft_txt_menu'] = PreferencesUtils::getAttributes('ft_txt_menu', 'texto');
                $recordset['ft_txt_menu1'] = PreferencesUtils::getAttributes('ft_txt_menu1', 'texto');
                $recordset['ft_txt_menu2'] = PreferencesUtils::getAttributes('ft_txt_menu2', 'texto');
                $recordset['ft_menu2_espacamento'] = PreferencesUtils::getAttributes('ft_menu2_espacamento', 'inteiro');
                $recordset['ft_fb_bg'] = PreferencesUtils::getAttributes('ft_fb_bg', 'texto');
                $recordset['ft_ln_company_bg'] = PreferencesUtils::getAttributes('ft_ln_company_bg', 'texto');
                $recordset['ft_txt_line_company'] = PreferencesUtils::getAttributes('ft_txt_line_company', 'texto');                
            }
            
            if($type == 'barra_social'){
                $recordset['barra_social_distancia'] = PreferencesUtils::getAttributes('barra_social_distancia', 'inteiro');
                $recordset['barra_social_exibir'] = PreferencesUtils::getAttributes('barra_social_exibir', 'inteiro');
                $recordset['barra_social_lado'] = PreferencesUtils::getAttributes('barra_social_lado', 'texto');
                $recordset['barra_social_redes_sociais'] = PreferencesUtils::getAttributes('barra_social_redes_sociais', 'inteiro');
                $recordset['barra_social_background_type'] = PreferencesUtils::getAttributes('barra_social_type_background', 'inteiro');
                $recordset['barra_social_background'] = PreferencesUtils::getAttributes('barra_social_background', 'texto');
                $recordset['barra_social_background_color'] = PreferencesUtils::getAttributes('barra_social_background_color', 'texto'); 
            }
            
            if($type == 'perfil_flutuante'){
                $recordset['perfil_flutuante_distancia'] = PreferencesUtils::getAttributes('perfil_flutuante_distancia', 'inteiro');
                $recordset['perfil_flutuante_exibir'] = PreferencesUtils::getAttributes('perfil_flutuante_exibir', 'inteiro');
                $recordset['perfil_flutuante_lado'] = PreferencesUtils::getAttributes('perfil_flutuante_lado', 'texto');
                $recordset['perfil_flutuante_link'] = PreferencesUtils::getAttributes('perfil_flutuante_link', 'texto');
                $recordset['perfil_flutuante_background_type'] = PreferencesUtils::getAttributes('perfil_flutuante_type_background', 'inteiro');
                $recordset['perfil_flutuante_background'] = PreferencesUtils::getAttributes('perfil_flutuante_background', 'texto');
                $recordset['perfil_flutuante_layout'] = PreferencesUtils::getAttributes('perfil_flutuante_layout', 'texto');
                
                $recordset['perfil_flutuante_image_1'] = PreferencesUtils::getAttributes('perfil_flutuante_image_1', 'texto');
                $recordset['perfil_flutuante_image_2'] = PreferencesUtils::getAttributes('perfil_flutuante_image_2', 'texto');
                $recordset['perfil_flutuante_image_3'] = PreferencesUtils::getAttributes('perfil_flutuante_image_3', 'texto');
                $recordset['perfil_flutuante_image_4'] = PreferencesUtils::getAttributes('perfil_flutuante_image_4', 'texto');
                
                $recordset['perfil_flutuante_background_color'] = PreferencesUtils::getAttributes('perfil_flutuante_background_color', 'texto'); 
            }
            
            if($type == 'breadcrumb'){
                $recordset['breadcrumb_top'] = PreferencesUtils::getAttributes('breadcrumb_top', 'inteiro');
                $recordset['breadcrumb_bottom'] = PreferencesUtils::getAttributes('breadcrumb_bottom', 'inteiro');
                $recordset['breadcrumb_lado'] = PreferencesUtils::getAttributes('breadcrumb_lado', 'texto');
                
                $recordset['breadcrumb_background_type'] = PreferencesUtils::getAttributes('breadcrumb_type_background', 'inteiro');
                $recordset['breadcrumb_background'] = PreferencesUtils::getAttributes('breadcrumb_background', 'texto');
                $recordset['breadcrumb_background_color'] = PreferencesUtils::getAttributes('breadcrumb_background_color', 'texto'); 
            }
            
            if($type == 'favicon'){
                $recordset['favicon'] = PreferencesUtils::getAttributes('favicon', 'texto');//Não há esse registro               
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo para atualizar um registro existente
     *
     * It sets the a new texture into preferences table
     * The get_post variable is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateExtremos($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.HelperUtils');
        
        try{             
            
            if($data['type'] == 'topo'){
                if(isset($_POST['topo_altura'])) PreferencesUtils::setAttributes('topo_altura', $_POST['topo_altura'], "inteiro"); 
                if(isset($_POST['topo_fit'])) PreferencesUtils::setAttributes('topo_fit', MethodUtils::getBooleanNumber($_POST['topo_fit']), "inteiro");
                if(isset($_POST['logo_altura'])) PreferencesUtils::setAttributes('logo_altura', $_POST['logo_altura'], "inteiro"); 
                if(isset($_POST['logo_largura'])) PreferencesUtils::setAttributes('logo_largura', $_POST['logo_largura'], "inteiro");
                if(isset($_POST['pos_x'])) PreferencesUtils::setAttributes('logo_pos_x', $_POST['pos_x'], "inteiro"); 
                if(isset($_POST['pos_y'])) PreferencesUtils::setAttributes('logo_pos_y', $_POST['pos_y'], "inteiro");
                if(isset($_POST['container_largura'])) PreferencesUtils::setAttributes('logo_container_width', $_POST['container_largura'], "inteiro");
                if(isset($_POST['container_altura'])) PreferencesUtils::setAttributes('logo_container_height', $_POST['container_altura'], "inteiro"); 
                if(isset($_POST['frase_searchbox'])) PreferencesUtils::setAttributes('frase_searchbox', $_POST['frase_searchbox'], "texto");
                
            }
            
            if($data['type'] == 'rodape'){
                if(isset($_POST['rodape_copyright'])) PreferencesUtils::setAttributes('rodape_copyright', $_POST['rodape_copyright'], "descricao"); 
                if(isset($_POST['ft_menu'])) PreferencesUtils::setAttributes('ft_menu', $_POST['ft_menu'], "texto");
                if(isset($_POST['ft_menu_type'])) PreferencesUtils::setAttributes('ft_menu_type', $_POST['ft_menu_type'], "inteiro");
                if(isset($_POST['ft_menu_color'])) PreferencesUtils::setAttributes('ft_menu_color', $_POST['ft_menu_color'], "texto");
                if(isset($_POST['ft_line2'])) PreferencesUtils::setAttributes('ft_line2', $_POST['ft_line2'], "texto");
                if(isset($_POST['ft_txt_line2'])) PreferencesUtils::setAttributes('ft_txt_line2', $_POST['ft_txt_line2'], "texto");
                if(isset($_POST['ft_titulo_menu'])) PreferencesUtils::setAttributes('ft_titulo_menu', $_POST['ft_titulo_menu'], "texto");
                if(isset($_POST['ft_subtitulo_menu'])) PreferencesUtils::setAttributes('ft_subtitulo_menu', $_POST['ft_subtitulo_menu'], "texto");
                if(isset($_POST['ft_txt_menu'])) PreferencesUtils::setAttributes('ft_txt_menu', $_POST['ft_txt_menu'], "texto");
                if(isset($_POST['ft_txt_menu1'])) PreferencesUtils::setAttributes('ft_txt_menu1', $_POST['ft_txt_menu1'], "texto");
                if(isset($_POST['ft_txt_menu2'])) PreferencesUtils::setAttributes('ft_txt_menu2', $_POST['ft_txt_menu2'], "texto");
                if(isset($_POST['ft_menu2_espacamento'])) PreferencesUtils::setAttributes('ft_menu2_espacamento', $_POST['ft_menu2_espacamento'], "inteiro");
                if(isset($_POST['ft_fb_bg'])) PreferencesUtils::setAttributes('ft_fb_bg', $_POST['ft_fb_bg'], "texto");
                if(isset($_POST['ft_ln_company_bg'])) PreferencesUtils::setAttributes('ft_ln_company_bg', $_POST['ft_ln_company_bg'], "texto");
                if(isset($_POST['ft_txt_line_company'])) PreferencesUtils::setAttributes('ft_txt_line_company', $_POST['ft_txt_line_company'], "texto"); 
            }
            
            if($data['type'] == 'barra_social'){
                if(isset($_POST['barra_social_distancia'])) PreferencesUtils::setAttributes('barra_social_distancia', $_POST['barra_social_distancia'], "inteiro"); 
                if(isset($_POST['barra_social_lado'])) PreferencesUtils::setAttributes('barra_social_lado', $_POST['barra_social_lado'], "texto"); 
                if(isset($_POST['barra_social_redes_sociais'])) PreferencesUtils::setAttributes('barra_social_redes_sociais', MethodUtils::getBooleanNumber($_POST['barra_social_redes_sociais']), "inteiro"); 
                if(isset($_POST['barra_social_exibir'])) PreferencesUtils::setAttributes('barra_social_exibir', MethodUtils::getBooleanNumber($_POST['barra_social_exibir']), "inteiro"); 
                if(isset($_POST['type_background'])) PreferencesUtils::setAttributes('barra_social_type_background', $_POST['type_background'], "inteiro");
                
                if(isset($_POST['type_background'])){
                    $type = $_POST['type_background'];
                    if($type == 0) $background = $_POST['image_background'];
                    if($type == 1) $background = $_POST['texture_background'];
                    if($type == 2) $background = $_POST['color_background'];
                }
                if(isset($background)) PreferencesUtils::setAttributes('barra_social_background', $background, "texto");
                if(isset($_POST['cor_texture']) && $_POST['cor_texture'] != '') PreferencesUtils::setAttributes('barra_social_background_color', $_POST['cor_texture'], "texto");
                
            }
            
            if($data['type'] == 'perfil_flutuante'){
                if(isset($_POST['perfil_flutuante_distancia'])) PreferencesUtils::setAttributes('perfil_flutuante_distancia', $_POST['perfil_flutuante_distancia'], "inteiro"); 
                if(isset($_POST['perfil_flutuante_lado'])) PreferencesUtils::setAttributes('perfil_flutuante_lado', $_POST['perfil_flutuante_lado'], "texto"); 
                if(isset($_POST['perfil_flutuante_link'])) PreferencesUtils::setAttributes('perfil_flutuante_link', $_POST['perfil_flutuante_link'], "texto"); 
                if(isset($_POST['perfil_flutuante_exibir'])) PreferencesUtils::setAttributes('perfil_flutuante_exibir', MethodUtils::getBooleanNumber($_POST['perfil_flutuante_exibir']), "inteiro"); 
                if(isset($_POST['type_background'])) PreferencesUtils::setAttributes('perfil_flutuante_type_background', $_POST['type_background'], "inteiro");
                if(isset($_POST['layout'])) PreferencesUtils::setAttributes('perfil_flutuante_layout', $_POST['layout'], "texto");
                
                if(isset($_POST['type_background'])){
                    $type = $_POST['type_background'];
                    if($type == 0) $background = $_POST['image_background'];
                    if($type == 1) $background = $_POST['texture_background'];
                    if($type == 2) $background = $_POST['color_background'];
                }
                if(isset($_POST['image_1'])) PreferencesUtils::setAttributes('perfil_flutuante_image_1', $_POST['image_1'], "texto");
                if(isset($_POST['image_2'])) PreferencesUtils::setAttributes('perfil_flutuante_image_2', $_POST['image_2'], "texto");
                if(isset($_POST['image_3'])) PreferencesUtils::setAttributes('perfil_flutuante_image_3', $_POST['image_3'], "texto");
                if(isset($_POST['image_4'])) PreferencesUtils::setAttributes('perfil_flutuante_image_4', $_POST['image_4'], "texto");
                
                if(isset($background)) PreferencesUtils::setAttributes('perfil_flutuante_background', $background, "texto");
                if(isset($_POST['cor_texture']) && $_POST['cor_texture'] != '') PreferencesUtils::setAttributes('perfil_flutuante_background_color', $_POST['cor_texture'], "texto");
                
            }
            
            if($data['type'] == 'breadcrumb'){
                if(isset($_POST['margin_top'])) PreferencesUtils::setAttributes('breadcrumb_top', $_POST['margin_top'], "inteiro"); 
                if(isset($_POST['margin_bottom'])) PreferencesUtils::setAttributes('breadcrumb_bottom', $_POST['margin_bottom'], "inteiro"); 
                if(isset($_POST['breadcrumb_lado'])) PreferencesUtils::setAttributes('breadcrumb_lado', $_POST['breadcrumb_lado'], "texto"); 
                if(isset($_POST['type_background'])) PreferencesUtils::setAttributes('breadcrumb_type_background', $_POST['type_background'], "inteiro");
                
                if(isset($_POST['type_background'])){
                    $type = $_POST['type_background'];
                    if($type == 0) $background = $_POST['image_background'];
                    if($type == 1) $background = $_POST['texture_background'];
                    if($type == 2) $background = $_POST['color_background'];
                }
                if(isset($background)) PreferencesUtils::setAttributes('breadcrumb_background', $background, "texto");
                if(isset($_POST['cor_texture']) && $_POST['cor_texture'] != '') PreferencesUtils::setAttributes('breadcrumb_background_color', $_POST['cor_texture'], "texto");
                
            }
            
            $content = HelperUtils::createCss();
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}

?>