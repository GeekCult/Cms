<?php
/*
/*
 * This Class is used to set and retrieve produtos Atributes
 * @author Mauro Marchiori Neto
 *
 *

*/

class dbProdutosAttribute{
    
    var $produto = "";

    public function setCurrentProduto($produto){
        $this->produto = $produto; 
    }
    
    public function isDuplicate($name, $id_variavel = false) {
        
        $query =  "SELECT count(id_produto) as 'total' FROM ecommerce_attribute WHERE id_produto = $this->produto AND name = '$name'";
        if($id_variavel) $query =  "SELECT count(id_produto) as 'total' FROM ecommerce_attribute WHERE id_produto = $this->produto AND id_variante = $id_variavel AND name = '$name'";
        
        try {
            $command = Yii::app()->db->createCommand($query);
            $result = $command->queryRow();
            
            return $result['total'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR - dbProdutosAttribute - isDuplicate' . $e->getMessage();
        }
    }

    public function adicionar($name, $value, $type = "texto"){
        
        //No reason to put timestamp on every attribute unless
        //its shown as when it was added to the user, if it has
        //the purpose of lastupdate it should be in the manager.
        $insert = "INSERT INTO ecommerce_attribute (id_produto, name, ".$type.") VALUES (".$this->produto.",'".$name."','".$value."')";
        $update = "UPDATE ecommerce_attribute SET $type = '$value' WHERE id_produto = $this->produto AND name = '$name'";
        
        try{            
            if(!$this->isDuplicate($name)){
                $command = Yii::app()->db->createCommand($insert);
            }else{
                $command = Yii::app()->db->createCommand($update);
            }
            
            $result = $command->execute();
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: dbProdutosAttribute - adicionar() ".$e->getMessage(); 
        }        
    }
    
    public function adicionarComplete($name, $value, $type = "texto", $id_variavel = 0){
        
        //No reason to put timestamp on every attribute unless
        //its shown as when it was added to the user, if it has
        //the purpose of lastupdate it should be in the manager.
        $insert = "INSERT INTO ecommerce_attribute (id_produto, name, ".$type.", id_variante) VALUES (".$this->produto.",'".$name."','".$value."','".$id_variavel."')";
        $update = "UPDATE ecommerce_attribute SET $type = '$value' WHERE id_produto = $this->produto AND id_variante = $id_variavel AND name = '$name'";
        
        try{            
            if(!$this->isDuplicate($name, $id_variavel)){
                $command = Yii::app()->db->createCommand($insert);
            }else{
                $command = Yii::app()->db->createCommand($update);
            }
            
            $result = $command->execute();
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: dbProdutosAttribute - adicionar() ".$e->getMessage(); 
        }        
    }
    
    /*
     * metodo para recuperar um atributo do usuário
     * @param string name
     * @param string type
     *
     * type pode ser integer, timestamp ou string
    */
    public function recuperar($variavel, $type = "texto", $id_estoque = false){
        
        if($this->produto == '' || $this->produto == NULL) return false;
    
        $sql = "SELECT $type FROM ecommerce_attribute WHERE name = '$variavel' AND id_produto = ".$this->produto;
        if($id_estoque) $sql = "SELECT $type FROM ecommerce_attribute WHERE name = '$variavel' AND id_produto = ".$this->produto . ' AND id_variante = ' .$id_estoque;
            
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if(count($recordset) > 0) return $recordset[0][$type];
            
            return false;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: dbProdutosAttribute - recuperar() ".$e->getMessage();
        }
    }

    public function apagar($name,$value,$type = "texto") {
        return false; //this is just a stub, this actually doesnt work
    }
}

?>