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
class CoolManager{

    /**
     * metodo para recuperar todos os cool do database
     *
     *
    */
    public function getAllContent($tipo = "picture"){
        
        $select = "id, id_categoria, titulo, cool_p, cool_m, cool_g, cool_j, data, valor";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE tipo = '$tipo' ORDER BY id DESC LIMIT 0, 10";

        try{
            $command = Yii::app()->db3->createCommand($sql);
            $recordset = $command->queryAll();   
            $recordset['records'] = $this->getRows("todas");     
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Metodo para recuperar os registros organizados por
     * categoria
     *
     * @param $id_cat number
     *
    */
    public function getContentByCat($id_tipo, $tipo = "picture") {
        
        $select = "id, id_categoria, cool_p, cool_m, cool_g, cool_j, titulo";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE id_tipo = $id_tipo AND tipo = '$tipo' LIMIT 0, 10";

        try{
            $command = Yii::app()->db2->createCommand($sql);            
            $recordset = $command->queryAll();            
            $recordset['records'] = $this->getRows($id_tipo);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * metodo para recuperar os textos
     *
     * @param string page
     *
    */
    public function getContent($start){

        if($start < 10) $start = 0;

        $select = "id, id_categoria, cool_p, cool_m, cool_g, cool_j, data, titulo, valor";
        $sql = "SELECT ".$select." FROM conteudo_cool";

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
     * Método para recuperar os textos
     * $pictures images usadas em alguma página
     *
     * @param string page
     *
    */
    public function getTransformedContent($start, $id_cat, $tipo = "picture"){

        if($start < 10) $start = 0;
        $select = "id,  id_categoria, cool_p, cool_m, cool_g, cool_j, data, titulo, valor";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE tipo = '$tipo' AND id_tipo = $id_cat  LIMIT " . $start . ", 10";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll();
            $recordset['records'] = $this->getRows("todas");
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo $e->getMessage();
        }
    }
    
    /**
     * 
     * Método para recuperar todos os cool avatars 
     * do database, este separa por tipos.
     * 
     * Tipos: produtos, eventos, avatars.
     *
     */
    public function getAllAvatars($tipo = 3){   

        $select = "id, id_categoria, titulo, cool_p, cool_m, cool_g, cool_j, data, valor";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE id_tipo = 2 AND id_categoria = $tipo ORDER BY id ASC LIMIT 0, 26";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
            //$recordset['records'] = $this->getRows("todas");     
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método usado para recuperar um obejto cool registro organizado pelo
     * seu id
     *
     * @param $id number
     *
    */
    public function getContentById($id){

        $select = "id, id_categoria, cool_p, cool_m, cool_g, cool_j, titulo";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE id = $id";

        try{
            $command = Yii::app()->db2->createCommand($sql);     
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Metodo para adicionar um novo Cool
     *
     * @param array
     *
    */
    public function submitContent($get_post){

        $select  = "titulo, valor, id_categoria, data, id_tipo, ";
        $select .= "cool_p, cool_m, cool_g, cool_j";
        
        $values  = $get_post[0]."', '".$get_post[2]."', '".$get_post[3]."', '".$get_post[4]."', '".$get_post[5]."', '";
        $values .= $get_post[ 'cool_p']."', '".$get_post['cool_m']."', '".$get_post['cool_g']."', '".$get_post['cool_j'];
        $sql =  "INSERT INTO conteudo_cool (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar a quantidade de linhas de uma tabela
     * conteudo_cool
     *
     * @param number
     *
    */
    public function getRows($id_cat){

        $nr = 0;
        $select = ' id ';

        if($id_cat != "todas"){
            $sqlRows = Yii::app()->db2->createCommand("SELECT COUNT(*) FROM conteudo_cool WHERE tipo = 'picture' AND id_tipo = $id_cat")->queryScalar();

        }else{
            $sqlRows = Yii::app()->db2->createCommand("SELECT COUNT(*) FROM conteudo_cool WHERE tipo = 'picture'")->queryScalar();
        }

        if($sqlRows > 10) $nr = ($sqlRows) / 10;
        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){

            if($arredonda[1] > 2){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        return $nr;
    }

}
?>