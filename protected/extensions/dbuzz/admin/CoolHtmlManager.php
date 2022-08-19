<?php
/*
 * This Class is used to controll all functions related the feature Cool
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */
class CoolHtmlManager {

    /**
     * Método para recuperar todos os cool components do database
     * Este metódo recupera todos os cool que estiverem setados 
     * como html
     *
    */
    public function getAllContent($type) {

        $select = "id, modelo, tipo, altura, largura, cool";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = '$type' ORDER BY id DESC LIMIT 0, 10";

        try{            
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            $recordset['records'] = $this->getRows($type); 
            
            return $recordset;
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar um determinado cool do database
     * Utiliza a variável para escolher com melhor precisão.
     *
     *
    */
    public function getContent($template, $isId = false){
        
        $select = "id, modelo, tipo, altura, largura, cool, texto, button";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE modelo = '$template'";
        
        if($isId){
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE id = '$template'";
        }

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um determinado cool do database
     * Utiliza a variável para escolher com melhor precisão.
     *
     *
    */
    public function getContentLimitedByCategory($tipo, $start = 0){
        
        $select = "id, modelo, tipo, altura, largura, cool";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = '$tipo' ORDER BY id DESC LIMIT " . $start . ", 10";
        
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();                   
            $recordset['records'] = 2;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
        return $recordset;
    }
    
    /*
     * Método para recuperar os dados dos menus
     * estes podem ser menu principal, menu 2 e menu 3.
     *
     * @param string
     * 
    */
    public function getMenu($type_menu, $idMiniSite = false) {
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        
        $categoriasHandler = new CategoriaManager();
        
        ($idMiniSite) ? $query = " AND id_user = $idMiniSite " : $query = " AND id_user = 0 ";

        $select = "nome, layout, label, controller, action, icon, id_categoria, link_special";
        
        switch($type_menu){
            case "mn2":
                $sql = "SELECT ".$select." FROM paginas_data WHERE menu_2 = 1 $query ORDER BY n_index ASC" ;
                break;
            case "mn3":
                $sql = "SELECT ".$select." FROM paginas_data WHERE menu_3 = 1 $query  ORDER BY n_index ASC" ;
                break;
            case "mn1":
                $sql = "SELECT ".$select." FROM paginas_data WHERE menu_principal = 1 $query  AND plataforma = 'desktop' ORDER BY n_index ASC" ;
                break;
            case "mn":
                $sql = "SELECT ".$select." FROM paginas_data WHERE id_categoria != '' $query  AND id_categoria != 0 ORDER BY id_categoria ASC" ;
                break;
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    if($type_menu == "mn"){                         
                        $recordset[$i]['titulos'] = $categoriasHandler->getContentById($recordset[$i]['id_categoria']);
                    }
                    if(isset($recordset[$i]['icon'])) $recordset[$i]['icon'] = GraphicsUtils::getCoolContent($recordset[$i]['icon']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar a quantidade de linhas de uma tabela
     * conteudo_cool
     *
     * @param number
     *
    */
    public function getRows($type){

        $nr = 0;

        $sqlRows = Yii::app()->db2->createCommand("SELECT COUNT(*) FROM conteudo_templates WHERE tipo = '$type'")->queryScalar();
        if($sqlRows > 10) $nr = ($sqlRows) / 10;

        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){
            if($arredonda[1] > 1){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        return $nr;
    }
    
    /**
     * Metodo para atualizar o status do banner,
     *
     * Se ira ser exibido então 1 senão 0.
     *
     * @param number
     * @param number
     *
    */
    public function setStatusSelection($id_banner, $status) {

        $values = "exibe = '" . $status ."', creditos = '100'";
        if (!$status) $values = "exibe = '" . $status ."', creditos = '0'";
        $sql =  "UPDATE banners_data SET ". $values ." WHERE id = $id_banner";

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando -> execute();
            // echo $sql;
            // echo $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar os modelos de conteudo_cool do Playground
     *
     * @param number
     *
    */
    public function getModelosPlayground(){

        $select = "id, titulo, image, valor";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE tipo = 'playground' ORDER BY id DESC" ;
  
        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            
            $recordset['records'] = $this->getRows('playground');
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
}
?>