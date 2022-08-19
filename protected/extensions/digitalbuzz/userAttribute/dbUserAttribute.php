<?php
/*
 * This Class is used to set and retrieve user Atributes
 * @author Mauro Marchiori Neto
 *
 * Usage Notes
 *
 * $ua = new dbUserAttribute();
 *
 */

class dbUserAttribute {
    
    var $user = '';
    
    public function isDuplicate($name){
        
        $query = "SELECT count(user_id) as 'total' FROM user_attribute WHERE user_id = $this->user AND name = '$name'";
        
        //echo $query;
        try {
            $command = Yii::app()->db->createCommand($query);
            $result = $command->queryRow();
            return $result['total'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - isDuplicate()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - dbUserAttribute - isDuplicate' . $e->getMessage();
        }
    }

    public function setCurrentUser($user) {
        $this->user = $user;
    }

    /**
     * Método para adicionar um atributo do usuário na tabela
     * user_attributes
     *
     * @param $name
     * @param $value
     * @param string $type
     * @param bool $isCumulative
     * @internal param \name $string
     * @internal param \value $string
     * @internal param \type $string type pode ser integer, timestamp ou string* type pode ser integer, timestamp ou string
     * @return bool
     */
    public function adicionar($name, $value, $type = 'texto', $isCumulative = false, $data = array()) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($this->user);
        
        //No reason to put timestamp on every attribute unless
        //its shown as when it was added to the user, if it has
        //the purpose of lastupdate it should be in the manager.
        if(isset($data['obiz']) && $data['obiz']){  
            $insert = "INSERT INTO user_attribute (user_id,name, $type, estampa) VALUES ({$this->user},'{$name}', AES_ENCRYPT('$value', {$data['obiz']['serial']}), '". date('Y-m-d H:i:s') ."') ON DUPLICATE KEY UPDATE $type = AES_ENCRYPT('$value', {$data['obiz']['serial']})";
            $update = "UPDATE user_attribute SET $type = AES_ENCRYPT('$value', {$data['obiz']['serial']}) WHERE user_id = $this->user AND name = '$name'";
        }else{
            $insert = "INSERT INTO user_attribute (user_id,name, $type, estampa) VALUES ({$this->user}, '{$name}', '{$value}', '". date('Y-m-d H:i:s') ."') ON DUPLICATE KEY UPDATE $type = '$value'";
            $update = "UPDATE user_attribute SET $type = '$value' WHERE user_id = $this->user AND name = '$name'";
        }
        
        //echo $insert;
        //echo $update;
        
        try {
            if (!$this->isDuplicate($name) || $isCumulative)
                $command = Yii::app()->db->createCommand($insert);
            else
                $command = Yii::app()->db->createCommand($update);

            $result = $command->execute();
            return $result;
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - adicionar()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: dbUserAttribute - adicionar' .$e->getMessage();
        }
    }

    /**
     * Método para adicionar um atributo do usuário na tabela
     * user_attributes
     *
     * @param $name
     * @param $inteiro
     * @param $number
     * @param $texto
     * @param $descricao
     * @return bool
     * @internal param \name $string
     * @internal param \value $string
     * @internal param \type $string type pode ser integer, timestamp ou string*
     * type pode ser integer, timestamp ou string
     */
    public function adicionarComplete($name, $inteiro, $number, $texto, $descricao) {

        $sql = "INSERT INTO user_attribute (user_id, name, inteiro, number , estampa, texto, descricao) VALUES (".
                $this->user.",'".$name."','".$inteiro."','".$number."', '". date('Y-m-d H:i:s') ."','". $texto."','".$descricao ."')". 
                " ON DUPLICATE KEY UPDATE texto = '".$texto."', descricao = '".$descricao."', inteiro = '".$inteiro."'";
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $command->query();
            return true;
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - adicionarComplete()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();  
        }
    }

    /**
     * metodo para recuperar um atributo do usuário
     * @param $variavel
     * @param string $type
     * @param bool $all
     * @param bool $isBoolean
     * @return bool
     * @internal param \name $string
     * @internal param \type $string type pode ser integer, timestamp ou string*
     * type pode ser integer, timestamp ou string
     */
    public function recuperar($variavel, $type = "texto", $all = false, $isBoolean = false, $isPurple = false, $data = array()) {
        
        $type_init = $type;
        if ($all) $type = 'name, inteiro, number, texto, descricao';
        if(isset($data['obiz']) && $data['obiz']) $type = "AES_DECRYPT($type, {$data['obiz']['serial']}) AS $type";
        $sql = "SELECT $type FROM user_attribute WHERE name = '$variavel' AND user_id = {$this->user}";
        //echo $sql;
        //return $sql; exit;

        try{
            if(!$isPurple) $command = Yii::app()->db->createCommand($sql);
            if( $isPurple) $command = Yii::app()->db4->createCommand($sql);
            
            $recordset = $command->queryAll();

            //Se definir AES encima redefine aqui, pois tem callback
            if(isset($data['obiz']) && $data['obiz']){ $type = $type_init;}
                
            if(count($recordset) > 0){
                if ($isBoolean) return true;
                if ($all) return $recordset[0];
                return $recordset[0][$type];
                
            }else{
                return false;
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - recuperar()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }
    }
    
    /**
     * metodo para recuperar um atributo do usuário
     * @param $variavel
     * @param string $type
     * @param bool $all
     * @param bool $isBoolean
     * @return bool
     * @internal param \name $string
     * @internal param \type $string type pode ser integer, timestamp ou string*
     * type pode ser integer, timestamp ou string
     */
    public function recuperarAll($variavel, $type = "texto", $all = false, $isPurple = false) {
        
        $sql = "SELECT * FROM user_attribute WHERE $type = '$variavel' AND user_id = {$this->user}";
        // return $sql; exit;

        try{
            if(!$isPurple) $command = Yii::app()->db->createCommand($sql);
            if( $isPurple) $command = Yii::app()->db4->createCommand($sql);
            
            $recordset = $command->queryAll();

            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - recuperarAll()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um atributo do usuário
     * 
     */
    public function getAttribute($id_user, $variavel = "", $type = "texto", $data = array()) {

        $sql = "SELECT * FROM user_attribute WHERE $type = '{$variavel}' AND user_id = $id_user";
        
        //echo $sql;
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset && (isset($data['callback']))) return $recordset[$data['callback']];
            return $recordset;
          
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - getAttribute()', 'trace' => $e->getMessage()), true);
            echo "ERROR: dbUserAttribute - getAttribute() ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar um atributo do usuário
     * @param $variavel
     * @param string $type
     * @param bool $all
     * @param bool $id_user
     * @return string
     * @internal param \name $string
     * @internal param \type $string type pode ser integer, timestamp ou string*
     * type pode ser integer, timestamp ou string
     */
    public function checar($variavel, $type = "texto", $all = true, $id_user = false, $checkLabel = false) {

        $sql = "SELECT user_id, $type FROM user_attribute WHERE $type = '{$variavel}'";
        
        if ($id_user){
            if(!$checkLabel) $sql = "SELECT user_id, $type FROM user_attribute WHERE $type = '{$variavel}' AND user_id = $id_user";
            if( $checkLabel) $sql = "SELECT user_id, $type FROM user_attribute WHERE name = '{$variavel}' AND user_id = $id_user";
        }
        
        //echo $sql;
        try {
            $command = Yii::app()->db->createCommand($sql);
            if ( $all) $recordset = $command->queryAll();
            if (!$all) $recordset = $command->queryRow();
            
            return $recordset;
          
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - checar()', 'trace' => $e->getMessage()), true);
            echo "ERROR: dbUserAttribute - checar() ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um atributo do usuário
     * @param string name
     * @param string type
     *
     * type pode ser integer, timestamp ou string
     */
    public function updateProperty($data) {

        $sql = "UPDATE user_attribute SET ".$data['field'] ." = '". $data['nivel']."' WHERE user_id = " . $data['id_user']. " " . $data['sql'] . "";

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - updateProperty()', 'trace' => $e->getMessage()), true);
            echo "ERROR ". $e->getMessage();
        }
    }

    public function apagar($id, $name){
        $sql = "DELETE FROM user_attribute WHERE user_id = $id AND name = '{$name}'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - dbUserAttribute - apagar()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: dbUserAttribute - apagar() ' . $e->getMessage();
        }
    }
}