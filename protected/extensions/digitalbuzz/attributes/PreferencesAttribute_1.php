<?php
/* 
/*
 * This Class is used to set and retrieve user Atributes
 * 
 * @author CarlosGarcia
 *
 *
*/
class PreferencesAttribute{
    
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
    public function adicionar($name, $value, $type = "texto", $plataforma = "desktop"){
        
        $session = MethodUtils::getSessionData();
        if($session['device'] == "")$session['device'] = "desktop";
        
        $varAttribute = $this->recuperar($name, "name", $plataforma);//Verifica se tem um registro já
        
        if($varAttribute == ""){
            $sql = "INSERT INTO preferencias_attribute (user_id,name,".$type.",estampa, plataforma) VALUES (".$this->user.",'".$name."','".$value."', '". date('Y-m-d H:i:s') ."','". $session['device']."')";
        }else{
            $sql = "UPDATE preferencias_attribute SET ".$type." = '".$value."', plataforma = '".$plataforma."' WHERE user_id = $this->user AND name ='$name' AND plataforma = '$plataforma' ";
        }

        try{
            $command = Yii::app()->db->createCommand($sql);
            $done = $command->execute();
            return $done;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PreferencesAttributes - adicionar() ' . $e->getMessage();  
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
    public function recuperar($variavel, $type = "texto", $plataforma = "desktop"){

        $sql = "SELECT id, name, $type FROM preferencias_attribute WHERE user_id = $this->user AND (plataforma = '$plataforma' AND name = '{$variavel}')";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset[$type];        
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PreferencesAttributes - recuperar() ' . $e->getMessage();
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

        $sql = "SELECT id, name, ".$type." FROM preferencias_attribute WHERE name = '".$variavel."' AND (user_id = {$this->user} AND plataforma = '$plataforma' $query )";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;        
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PreferencesAttributes - recuperarAll() ' .$e->getMessage();
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
    public function recuperarComplete($variavel, $modelo, $query = ""){

        $sql = "SELECT id, name, inteiro, descricao, texto, tipo FROM preferencias_attribute WHERE user_id = $this->user AND (name = '{$variavel}' AND tipo = '{$modelo}') $query";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            return $recordset;        
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: PreferencesAttributes - recuperarComplete() ' .$e->getMessage();
        }
    }

    public function apagar($name,$value,$type = "texto"){
        return false; //this is just a stub, this actually doesnt work
    }
}
?>