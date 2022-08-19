<?php

/**
 * Description of TemplatesUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class TemplatesUtils {
    
    /**
     * Create template
     *
     * @param number id
     *
    */
    public static function createTemplate($id_categoria, $tipo){
        
        $date = date("Y-m-d H:i:s");

        try{
            $sql =  "INSERT INTO templates_data (id_categoria, tipo, data, last_update) VALUES ($id_categoria, '$tipo', '$date', '$date')";
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return Yii::app()->db->getLastInsertID();
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - createTemplate() " .$e->getMessage();
        }
    }
    
    /**
     * Get template info by id_categoria and type
     *
     * @param number id
     *
    */
    public static function getTemplatesInfo($id, $tipo){

        try{
            $sql = "SELECT * FROM templates_data WHERE id_categoria = $id AND tipo = '$tipo'";

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
              
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getTemplateInfo() " .$e->getMessage();
        }
    }
    
    /**
     * Get template info by id
     *
     * @param number id
     *
    */
    public static function getTemplateById($id){

        try{
            $sql = "SELECT * FROM templates_data WHERE id = $id";

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
              
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getTemplateInfo() " .$e->getMessage();
        }
    }

    
    /**
     * Método para submeter os dados do template
     *
     * @param string image
     * @param array slot
     *
     */
    public static function applyComponent($data){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        
        if($data['action'] == 'novo'){ 
            $sql =  "INSERT INTO templates_rows (id_template, id_componente, layout, slots, n_index, titulo, tipo, exibe) VALUES ({$data['id_template']}, {$data['id_componente']}, '{$data['layout']}', {$data['slots']}, {$data['n_index']}, '{$data['info']['titulo']}', '{$data['info']['modelo']}', 1)";
        }else{
            $sql =  "UPDATE templates_rows SET $tipo = '$value' WHERE id_template = $id AND name = '$name'";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Set ping activity               
            $purplePierManager = new PurplePierManager();
            $ping = array('titulo' => $data['info']['titulo'], 'descricao' => $data['id_componente'], 'tipo' => 'compra_purplestore', 'plataforma' => 'desktop');
            if($data['action'] == 'novo') $setPing = $purplePierManager->setPing($ping);
            
            return $control;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: TemplatesUtils - applyComponent() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os dados do componente
     *
     * @param number id
     *
    */
    public static function getTemplateBlock($id, $type = 'email_content', $isAll = false){

        $select = "id, titulo, descricao, modelo, tipo, cool, thumb";
        
        if(!$isAll) $sql = "SELECT $select FROM conteudo_templates WHERE id = $id";
        if( $isAll) $sql = "SELECT $select FROM conteudo_templates WHERE tipo = '$type'";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            if(!$isAll) $recordset = $command->queryRow();
            if( $isAll) $recordset = $command->queryAll();
            
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getTemplateBlock() " .$e->getMessage();
        }
    }
    
    /**
     * Método para deletar um template
     *
     * @param array
     *
    */
    public static function deleteTemplate($id){

        $sql = "DELETE FROM templates_data WHERE id = $id";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para deletar um template
     *
     * @param array
     *
    */
    public static function deleteCampaign($id){

        $sql = "DELETE FROM general_campanhas WHERE id = $id";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para deletar um determinado registro
     *
     * @param array
     *
    */
    public static function deleteComponent($id){

        $sql = "DELETE FROM templates_rows WHERE id = $id";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch (CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para deletar um determinado registro
     *
     * @param array
     *
    */
    public static function updateRow($id, $value, $type){
        
        if($type == 'status'){ $field = 'exibe'; $value = MethodUtils::getBooleanNumber($value); }
        if($type == 'indice'){ $field = 'n_index'; }

        $sql = "UPDATE templates_rows SET $field = $value WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar a edição do bloco
     *
     * @param number id
     *
    */
    public static function getItemContent($id){
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');

        $select = "id, id_template, id_componente, tipo, titulo, n_index";        
        $sql = "SELECT ".$select." FROM templates_rows WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset) $recordset['content'] = BlocksTemplatesUtils::getViewProperties($recordset);
            //var_dump($recordset);
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getItemContent() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os blocos de acordo com a row passado
     *
     * @param number id
     *
    */
    public static function getViewContent($id, $isLoremYsum = false){
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');

        $select = "id, id_template, id_componente, tipo, titulo, n_index";        
        $sql = "SELECT ".$select." FROM templates_rows WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $recordset['info'] = TemplatesUtils::getTemplateBlock($recordset['id_componente']);
                $recordset['content'] = BlocksTemplatesUtils::getViewProperties($recordset, $isLoremYsum);
      
                $recordset['content']['emkt_info'] = array('id' => 1);
                $recordset['content']['user'] = array('nome' => "Carlos Garcia", 'email' => 'contato@teste.com.br');
                //$recordset['view'] = $this->controller->renderPartial('/admin/pages/email/components/' .$recordset['info']['cool'], $recordset['content'], true);
                
                //if(isset($recordset['content']['js'])) TemplatesUtils::addScript($recordset['content']['js']);
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getItemContent() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os blocos de acordo com a pagina
     *
     * @param number id
     * @param array
     *
    */
    public static function getModule($id_template, $info_page = array()){
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');

        $select = "id, id_template, id_componente, tipo, titulo, n_index, tipo, json";        
        $sql = "SELECT $select FROM templates_rows WHERE id_template = $id_template AND exibe = 1 ORDER BY n_index ASC";
   
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['info'] = TemplatesUtils::getTemplateBlock($recordset[$i]['id_componente']);
                    $recordset[$i]['content'] = BlocksTemplatesUtils::getViewProperties($recordset[$i]);
                    $recordset[$i]['content']['emkt_info'] = $info_page;
                    
                    //if($recordset[$i]['tipo'] == 'topo' && ($info_page['page']['hotsite'] != 0 && $info_page['page']['hotsite'] != '')) $recordset[$i]['content']['menu'] = TemplatesUtils::getMenuContent($info_page['page']['hotsite']);
                }               
            }
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getModule() " .$e->getMessage();
        }
    }
    
   /**
     * Método para recuperar os layouts blocks de pagina
     *
     * @param number id
     *
    */
    public static function getLayoutBlockTemplates($id){
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');

        $select = "id, id_template, id_componente, n_index, titulo, tipo, json, exibe";
        $sql = "SELECT ".$select." FROM templates_rows WHERE id_template = $id ORDER BY n_index ASC";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['titulo_componente'] = BlocksTemplatesUtils::getItemAttribute('titulo_componente', 'texto',$recordset[$i]['id_componente'], $recordset[$i]['id_template'], $recordset[$i]['id']);
            }}
            
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getLayoutBlockTemplates() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os layouts blocks de pagina
     *
     * @param number id
     *
    */
    public static function prepareTemplateForType($type='emkt', $id){

        try{
            $recordset = Yii::app()->db->createCommand("SELECT * FROM general_campanhas WHERE id = {$id}")->queryRow();

            return $result;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getLayoutBlockTemplates() " .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um attributo
     *
     * @param number id
     *
    */
    public static function getTemplateAttribute($id_template, $attribute, $field = false){

        $select = "id, id_template, id_componente, name, inteiro, texto, descricao, tipo";
        $sql = "SELECT ".$select." FROM templates_attribute WHERE id_template = $id_template AND name = '$attribute'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($field && $recordset) return $recordset[$field];
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getTemplatesAttributes() " .$e->getMessage();
        }
    }
    
    /**
     * Método para setar um attributo
     *
     * @param number id
     *
    */
    public static function setTemplateAttribute($attribute, $value, $type, $id_template, $id_componente, $id_row){
        
        Yii::import('application.extensions.utils.special.BlocksTemplatesUtils');       

        try{
            $recordset = BlocksTemplatesUtils::saveItem($attribute, $value, $type, $id_template, $id_componente, $id_row, 'texto');
            return $recordset;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - setTemplatesAttributes() " .$e->getMessage();
        }
    }
    
    /**
     * Método para obter as propriedade do template
     *
     * @param number id
     *
    */
    public static function getTemplateProperties($id){ 
        
        $result['server'] =  "http://" . $_SERVER['SERVER_NAME'];

        try{
            $result = array();
            
            $result['background_type'] = TemplatesUtils::getTemplateAttribute($id, 'template_background_type', "inteiro");
            $result['background'] = TemplatesUtils::getTemplateAttribute($id, 'template_image_background', 'texto');
            $result['background_color'] = TemplatesUtils::getTemplateAttribute($id, 'template_background_cor', 'texto');

            $result['background_type_2'] = TemplatesUtils::getTemplateAttribute($id, 'template_background_type_2', "inteiro");
            $result['background_2'] = TemplatesUtils::getTemplateAttribute($id, 'template_image_background_2', 'texto');
            $result['background_color_2'] = TemplatesUtils::getTemplateAttribute($id, 'template_background_cor_2', 'texto');
            
            return $result;
            
        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: TemplatesUtils - getTemplateProperties() " .$e->getMessage();
        }
    }
    
    
}
?>
