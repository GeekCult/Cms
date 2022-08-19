<?php

/*
 * Logs two kinds of activities in the application:
 *
 * 1) user actions
 * 2) actions the system takes on an user
 *
 * Logs are text messages stored in the database
 *
 */

/**
 * Description of ActivityLogger
 *
 * @author guma
 */
class ActivityLogger {

    // Logs a message and depends on the user being authenticated
    public static function log($msg, $tipo = null, $browser = null){
        
        $session = MethodUtils::getSessionData();
        
        if($session['geolocation_city'] == ""){
            Yii::import('application.extensions.utils.ContadorVisitasUtils');        
            $ipInfo = ContadorVisitasUtils::getIPInformation();
            $setCity = MethodUtils::setSessionData('geolocation_city', $ipInfo['city']);
        }

        // logged user ID
        $user_id = Yii::app()->user->getId();
        
        //Get session data
        $session = MethodUtils::getSessionData();
        
        // timestamp
        date_default_timezone_set("Brazil/East");
        $timestamp = date('Y-m-d H:i:s', time());
        $ip = $_SERVER['REMOTE_ADDR'];
        // the requested URI in format "/controller/action/params"
        $uri = Yii::app()->request->requestUri;
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        $isCheck = ActivityLogger::checkRecord($tipo, $uri);
        //$isCheck = false;
        
        //echo $isCheck;

        // insert into database
        $sql = "INSERT INTO `activity_log` (`user_id`,`time`,`uri`,`msg`,`ip`,`browser`, `plataforma`, `tipo`, `cidade`) VALUES ('$user_id', '$timestamp', '$uri', '$msg', '$ip', '$browser', '".$session['plataforma']."', '$tipo', '{$session['geolocation_city']}')";
        $comando = Yii::app()->db->createCommand($sql);
        if(!$isCheck) $control = $comando->execute();
    }

    // Logs a message even if the user is not logged in, but depends on passing
    // it's ID as a parameter
    public static function logId($user_id, $msg, $browser = null, $url = null) {
        
        //Get session data
        $session = MethodUtils::getSessionData();

        // timestamp
        $timestamp = date('Y-m-d H:i:s', time());
        $ip = $_SERVER['REMOTE_ADDR'];
         
        // the requested URI in format "/controller/action/params"
        $uri = Yii::app()->request->requestUri;
        if($url != null) $uri = $url;

        // insert into database
        $connection = Yii::app()->db;
        $sql = "INSERT INTO `activity_log` (`user_id`,`time`,`uri`,`msg`,`ip`,`browser`, `plataforma`) VALUES ('$user_id', '$timestamp', '$uri', '$msg', '$ip', '$browser', '".$session['plataforma']."')";
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }
    
    /**
     * Creates a log file.
     * 
     * @param type $msg 
     */
    public static function logHandler($msg, $arquivo){
        
        $base = $baseUrl = Yii::app()->baseUrl;

        //pega o path completo de onde esta executanto
        $caminho_atual = getcwd(); 

        //muda o contexto de execução para a pasta logs
        //chdir("/media/user/log");

        $data = date("d-m-y");
        $hora = date("H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];

        //Texto a ser impresso no log:
        $texto = "[$hora][$ip]> $msg \n";

        $manipular = fopen("media/user/log/$arquivo", "a+b");
        
        fwrite($manipular, $texto);
        fclose($manipular);

        //Volta o contexto de execução para o caminho em que estava antes
        chdir($caminho_atual);
        
    }
    
    /**
     * Método para pegar os logs
     *
     * @param number id
     *
    */
    public static function getPopulars($tipo, $limit = 10){
        
        $select = "COUNT(num) AS count, uri, msg";
        $sql = "SELECT ".$select." FROM activity_log WHERE tipo = '$tipo' GROUP BY msg ORDER BY count DESC LIMIT $limit";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityLogger - getLog() ".$e->getMessage();
        }       
    }
    
    /**
     * Método para pegar os logs pelo tipo e data de inserção
     *
     * @param number id
     *
    */
    public static function getLogsByDate($tipo, $month, $year){
        
        $sql = "SELECT id, tipo, uri, msg FROM activity_log WHERE tipo = '$tipo' AND (time >= '{$year}-{$month}-01 00:00:00' AND time < '{$year}-{$month}-31 00:00:00') ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityLogger - getLogsByDate() ".$e->getMessage();
        }       
    }
    
    // Logs a message and depends on the user being authenticated
    public static function logComplete($user_id, $uri, $msg, $ip, $browser, $plataforma, $tipo, $cidade){
        
        $timestamp = date('Y-m-d H:i:s', time());

        // insert into database
        $sql = "INSERT INTO `activity_log` (`user_id`,`time`,`uri`,`msg`,`ip`,`browser`, `plataforma`, `tipo`, `cidade`, `date`) VALUES ('$user_id', '$timestamp', '$uri', '$msg', '$ip', '$browser', '".$plataforma."', '$tipo', '$cidade', '$timestamp')";
        $comando = Yii::app()->db->createCommand($sql);
        if(!$isCheck) $control = $comando->execute();
    }
    
    // Logs a message and depends on the user being authenticated
    public static function checkRecord($tipo, $uri){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
       
        try{
            $time = date("Y-m-d H:i:s");
            $check = DateTimeUtils::addTimeToDate($time, 0, 0, 0, 0, 0, 10, 'sub');//add or sub

            $var = $tipo . "_" . $uri;
            
            //Verifica se o valor na sessão é vazio ou maior igual ao ultimo definido
            if($session[$var] == '' || strtotime($session[$var]) <= strtotime($check)) {
                $set = MethodUtils::setSessionData($var, $time);
                return false;

            }else{
                return true;
            }
           
         }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ActivityLogger - checkRecord() ".$e->getMessage();
        } 
    }
    
    // Logs a message and depends on the user being authenticated
    public static function removeFromLog($id = null, $msg = null, $uri = null){
        
        if($id  != null) $sql = "DELETE FROM activity_log WHERE id = $id";
        if($msg != null) $sql = "DELETE FROM activity_log WHERE msg ='$message'";
        if($uri != null) $sql = "DELETE FROM activity_log WHERE uri ='$uri'";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR ActivityLogger - removeFromLog() ' .  $e->getMessage();
        }
    }
}

?>
