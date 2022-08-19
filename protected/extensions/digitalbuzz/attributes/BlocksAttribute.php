<?php
/* 
/*
 * This Class is used to set and retrieve user Atributes
 * 
 * @author CarlosGarcia
 *
 *
*/
class BlocksAttribute{
    
    var $user = "";

    public function setCurrentUser($user) {
        $this->user = $user;
    }

    /*
     * Método para adicionar um atributo do usuário na tabela
     * user_attributes, type pode ser integer, timestamp ou string
     *
     * @param string name
     * @param string value
     * @param string type
     *
    */
    public function adicionar($label, $value, $type = "texto", $id_pagina, $id_componente, $id_row, $tipo, $plataforma = "desktop"){
        
        $session = MethodUtils::getSessionData();
        if($session['device'] == "") $session['device'] = "desktop";
        
        $varAttribute = $this->recuperar($label, $type, $id_pagina, $id_componente, $id_row, $plataforma, false);//Verifica se tem um registro já
        
        if(!$varAttribute){
            $sql = "INSERT INTO paginas_attribute (user_id, name,".$type.", estampa, plataforma, id_pagina, id_componente, id_row, tipo) VALUES (".$this->user.",'".$label."','".$value."', '". date('Y-m-d H:i:s') ."','". $session['device']."', ". $id_pagina.", ". $id_componente .", ". $id_row.", '". $tipo ."')";
        }else{
            $sql = "UPDATE paginas_attribute SET ".$type." = '".$value."', tipo = '$tipo' WHERE name ='$label' AND id_pagina = $id_pagina AND id_row = $id_row AND id_componente = $id_componente ";
        }
            
        try{
            $command = Yii::app()->db->createCommand($sql);
            $done = $command->execute();
            return $done;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BlocksAttributes - adicionar() ' . $e->getMessage();  
        }
    }

    /*
     * Método para recuperar um atributo do usuário
     * type pode ser integer, timestamp ou string
     * 
     * @param string name
     * @param string type
     *
    */
    public function recuperar($label, $type = "texto", $id_pagina, $id_componente, $id_row, $plataforma = "desktop", $isField = true){

        $sql = "SELECT id, name, tipo, ".$type." FROM paginas_attribute WHERE name = '".$label."' AND (user_id = ".$this->user . " AND plataforma = '$plataforma' AND id_pagina = $id_pagina AND id_componente = $id_componente AND id_row = $id_row)";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
           
            if($recordset && $recordset['tipo'] == 'imagessss'){
                Yii::import('application.extensions.utils.GraphicsUtils');
                $recordset[$type] = GraphicsUtils::getCoolContent($recordset[$type]);
            }
            
            if(!$isField) return $recordset;
            return $recordset[$type];        
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BlocksAttributes - recuperar() ' . $e->getMessage();
        }
    }
    
    /*
     * Método para recuperar um atributo do usuário
     * type pode ser integer, timestamp ou string
     * 
     * @param string name
     * @param string type
     *
    */
    public function recuperarAll($variavel, $type = "texto", $plataforma = "desktop", $query = ""){

        $sql = "SELECT id, name, ".$type." FROM paginas_attribute WHERE name = '".$variavel."' AND (user_id = ".$this->user . " AND plataforma = '$plataforma' $query )";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;        
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BlocksAttributes - recuperarAll() ' .$e->getMessage();
        }
    }

    public function apagar($label,$value,$type = "texto"){
        return false; //this is just a stub, this actually doesnt work
    }
}
?>