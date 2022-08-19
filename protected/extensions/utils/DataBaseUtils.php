<?php

/**
 * Description of DataBaseUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class DataBaseUtils {
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela, categoria, tipo e etc, 
     * 
     * @param number
     *
    */
    public static function getCountRecordsPeriod($table, $local, $id, $from, $to){
 
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = '$id' AND data > '$from' AND data < '$to'")->queryScalar();
        
        return $sqlRows;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela, categoria, tipo e etc, 
     * 
     * @param number
     *
    */
    public static function getCountRecords($table, $local, $id, $isTotal = false){
        
        if(!$isTotal){
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = '$id'")->queryScalar();
        }else{
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ."")->queryScalar();   
        }
        
        return $sqlRows;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela, categoria, tipo e etc, 
     * 
     * @param number
     *
    */
    public static function getCountRecordsDouble($table, $local, $id, $local2, $id2, $isTotal = false){
        
        if(!$isTotal){
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = $id AND " . $local2 ." = '$id2'")->queryScalar();
        }else{
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ."")->queryScalar();   
        }
        
        return $sqlRows;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela e duas formas de limitação
     * 
     * @param number
     *
    */
    public static function getCountRecordsLimited($table, $local, $id, $local2, $id2){

        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = '$id' AND $local2 = '$id2'")->queryScalar();        
        return $sqlRows;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela e duas formas de limitação
     * 
     * @param number
     *
    */
    public static function getCountRecordsSpecial($table, $query, $skip = 10){
        
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM $table WHERE $query")->queryScalar();        
        
        $nr = $sqlRows;
        
        if($sqlRows >= 11) $nr = ($sqlRows) / $skip;
        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){            
    
            if($arredonda[1] >= 1){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        
        $result['total'] = $sqlRows;
        $result['partial'] = $nr;
        
        return $result;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela e duas formas de limitação
     * 
     * @param number
     *
    */
    public static function getCountRecordsElearn($table, $query, $skip = 10){
        
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM $table WHERE $query")->queryScalar(); 
        
        $nr = $sqlRows;
        
        $result['total'] = $sqlRows;
        $result['partial'] = $nr;
        
        return $result;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela e duas formas de limitação
     * 
     * @param number
     *
    */
    public static function getCountRecordsEcommerce($query, $skip = 10){
 
        $sql = "SELECT * FROM (SELECT B.id, B.id_produto, A.id_categoria, A.exibe_ecommerce, B.qtd FROM ecommerce_produtos AS A INNER JOIN ecommerce_estoque AS B ON A.id = B.id_produto WHERE ". $query .") AS T GROUP BY T.id_produto";

        $command = Yii::app()->db->createCommand($sql);   
        $data = $command->queryAll();
        
        $sqlRows = count($data);
        $nr = 0;
        
        if($sqlRows >= 11) $nr = ($sqlRows) / $skip;
        $arredonda = explode(".",  $nr);
      
        if(count($arredonda) > 1){
            if ($arredonda[1] >= 1){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        
        $result['total'] = $sqlRows;
        $result['partial'] = $nr;
        
        return $result;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela e duas formas de limitação
     * 
     * @param number
     *
    */
    public static function getCountRecordsProdutos($query, $skip = 10){
 
        $sql = "SELECT id FROM ecommerce_produtos WHERE $query";

        $command = Yii::app()->db->createCommand($sql);   
        $data = $command->queryAll();
        
        $sqlRows = count($data);
        $nr = 0;
        
        if($sqlRows >= 11) $nr = ($sqlRows) / $skip;
        $arredonda = explode(".",  $nr);
      
        if(count($arredonda) > 1){
            if ($arredonda[1] >= 1){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        
        $result['total'] = $sqlRows;
        $result['partial'] = $nr;
        
        return $result;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela, categoria, tipo e etc, esse retorno é usado para paginar 
     * páginas 
     * 
     * @param number
     *
    */
    public static function getCountRows($table, $local, $id){

        $nr = 0;
 
        $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = '$id'")->queryScalar();
        if($sqlRows >= 11) $nr = ($sqlRows) / 10;
        $arredonda = explode(".",  $nr);

        if(count($arredonda) >= 1){
            if ($arredonda[1] >= 1){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        return $nr;
    }
    
    /**
     * Método para retornar a quantidade de registro de uma tabela 
     * de acordo com a tabela, categoria, tipo e etc, 
     * 
     * @param number
     *
    */
    public static function getCountRowsPurpleManager($table, $local, $id){

        $nr = 0;
 
        $sqlRows = Yii::app()->db2->createCommand("SELECT COUNT(*) FROM ". $table ." WHERE ". $local ." = '$id'")->queryScalar();
        
        if($sqlRows >= 11){ 
            
            $nr = ($sqlRows) / 10;
            $arredonda = explode(".",  $nr);

            if(count($arredonda) > 1){
                if ($arredonda[1] >= 1){
                    $nr = ceil($nr);
                }else{
                    $nr = round($nr);
                }
            }
        }
 
        return $nr;
    }
    
    /**
     * Método para somar uma determinada coluna 
     * 
     * @param number
     *
    */
    public static function getSUMRecords($table, $column, $local1, $valor1, $date = null, $year = null, $month = null){       
        
        $query = "SELECT SUM($column) FROM ". $table ." WHERE ". $local1 ." = '$valor1'";
        if($date) $query = "SELECT SUM($column) FROM ". $table ." WHERE ". $local1 ." = '$valor1' AND $date >= '$year-$month-01' AND $date <= '$year-$month-31'";
            
        $prepare = Yii::app()->db->createCommand($query);
        $result = $prepare->queryAll();
        
        if($result[0]["SUM($column)"] <= 0){
            $sum = 0;
        }else{
            $sum = $result[0]["SUM($column)"];
        }
        
        return $sum;
    }
    
}
?>