<?php

/**
 * Description of Activity
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 * 
 */
class ActivityUtils{

    /**
     * Set an activity
     * It set an activity recent from any king of action.
     * 
     * @param array
     *
    **/
    public static function setActivityRecent($data){
        
        Yii::import('application.extensions.utils.HelperUtils');
        $picture = HelperUtils::getAvatar($data['id_user']);
        
        $select  = "nome, mensagem, id_general, data, last_update, ";
        $select .= "id_user, titulo, tipo, picture";
        
        $values  = $data['nome']."', '".$data['message']."', '".$data['id_general']."', '".$data['date']."', '".$data['date']."', '";
        $values .= $data['id_user']."', '".$data['title']."', '".$data['tipo']."', '".$picture;
        
        $sql =  "INSERT INTO activity_recent (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return true;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ActivityUtils - setActivityRecent() ". $e->getMessage();
        }
    }
        
    /**
     * Método obter as atividades recentes.
     *
     *
    */
    public static function getRecentActivity(){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.ActivityUtils');
        
        $select = "id, titulo, nome, data, picture";
        $sql = "SELECT $select FROM activity_recent WHERE YEAR(data) = '" . date('Y'). "' AND MONTH(data) = '" . date('m'). "' ORDER BY id DESC";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                   $setStatus = ActivityUtils::setActivityStatus($recordset[$i]['id']);
                   $recordset[$i]['data_string'] = DateTimeUtils::getDateFormate($recordset[$i]['data']);
                }
            }
            
            //$recordset['encerramento_string'] = DateTimeUtils::getDateFormate($recordset['encerramento']);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityUtils - getRecentActivity() " . $e->getMessage();
        }
    }
    
    /**
     * Método obter as atividades recentes.
     * Este método é chamado por um timer e só exibe uma actividade por vez.
     * O Timer é de 10 segundos
     *
    */
    public static function getActivityByTimer(){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.ActivityUtils');
        
        $select = "id, titulo, nome, data, picture";
        $sql = "SELECT ".$select." FROM activity_recent WHERE status = 0 ORDER BY id ASC";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();
            
            if($recordset) ActivityUtils::setActivityStatus($recordset['id']);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityUtils - getActivityByTimer() " . $e->getMessage();
        }
    }
    
    /**
     * Método obter as atividades recentes.
     *
    */
    public static function getActivityByArgs($data){
        
        $select = "id, titulo, nome, data, picture";
        $sql = "SELECT ".$select." FROM activity_recent WHERE tipo = '".$data['tipo']."' AND id_general = ".$data['id_general']." AND id_user = ".$data['id_user']."";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ActivityUtils - getActivityByArgs() ' . $e->getMessage();
        }
    }
    
    /**
     * Método obter as atividades recentes.
     * Este método é chamado por um timer e só exibe uma actividade por vez.
     * O Timer é de 10 segundos
     *
    */
    public static function setActivityStatus($id){
        
        $values  = "status = '1'";       
        $sql =  "UPDATE activity_recent SET ". $values ." WHERE id = " .$id . ""; 

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute(); 
            return true;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityUtils - setActivityStatus() " . $e->getMessage();
        }
    }
    
    /**
     * Método atualizar uma atividade 
     *
    */
    public static function updateActivity($data){
        
        $values  = "last_update ='". date("Y-m-d H:i:s") ."'";       
        $sql =  "UPDATE activity_recent SET ". $values ." WHERE id_general = " .$data['id_general'] . " AND id_user = ". $data['id_user'] .""; 

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute(); 
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityUtils - updateActivity() ".$e->getMessage();
        }
    }
    
    /**
     * Método retorna a quantidade de atividades recentes pelo tipo.
     * 
     * @param string
     * @param string
     *
    */
    public static function getActivitiesByArgs($month, $tipo, $titulo, $lastUpdate = false){   
            
        Yii::import('application.extensions.utils.DateTimeUtils');
   
        $date = DateTimeUtils::getMonthSequence($month); 
       
        if(!$lastUpdate) $sqlRowsActivities = Yii::app()->db->createCommand("SELECT COUNT(*) FROM activity_recent WHERE data >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND data < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND tipo = '$tipo' AND titulo = '$titulo'")->queryScalar();
        if( $lastUpdate) $sqlRowsActivities = Yii::app()->db->createCommand("SELECT COUNT(*) FROM activity_recent WHERE last_update >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND last_update < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00' AND tipo = '$tipo' AND titulo = '$titulo'")->queryScalar();
        
        return $sqlRowsActivities;
    }
    
    /**
     * It manage activity server
     * 
     * @param array
     *
    **/
    public static function manageActivityServer($tipo, $id_general, $name, $value, $id_page = 0){
        
        $isExist = ActivityUtils::checkActivityServer($tipo, $id_general, $name, $id_page);
  
        $sql = "INSERT INTO activity_server (page_id, id_general, tipo, name, descricao) VALUES ('$id_page', '$id_general', '$tipo', '$name', '$value')";
        
        if($isExist){
            $sql = "UPDATE activity_server SET descricao = '$value' WHERE id_general = $id_general AND name = '$name' AND page_id = $id_page";
            if($value == '') $sql = "DELETE FROM activity_server WHERE id_general = $id_general AND name = '$name' AND page_id = $id_page";
        }
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            
            //Se não exister, mas o valor for vazio não faz nada
            if(!$isExist && $value == '') return false;
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ActivityUtils - manageActivityServer() ". $e->getMessage();
        }
    }
    
    /**
     * Método obter as atividades recentes.
     *
    */
    public static function checkActivityServer($tipo, $id_general, $name, $id_page){

        $sql = "SELECT id, id_general, tipo, descricao FROM activity_server WHERE id_general = $id_general AND tipo = '$tipo' AND name = '$name' AND page_id = $id_page";

        try{
            $command = Yii::app()->db->createCommand($sql);           
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ActivityUtils - getActivityByArgs() ' . $e->getMessage();
        }
    }
}
?>