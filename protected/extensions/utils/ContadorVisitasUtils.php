<?php

/**
 * Description of Contador de Visitas Utils
 *
 * Here are some method to make easier the dealing to count
 * visits
 *
 * @author CarlosGarcia
 */
class ContadorVisitasUtils{
    
    /**
     * Método para setar uma novva visita
     * Utiliza o argumento tipo para separar a visita
     *
     * @param string tipo
     *
    */
    public static function setVisit($tipo_contador = false){
        
        Yii::import('application.extensions.utils.ContadorVisitasUtils');
        
        try {
            $session = MethodUtils::getSessionData();
            
            $tipo = $session["device"];
            
            
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR ContadorUtils - setVisit() ' . $e->getMessage();
        }         
    }
    
    /**
     * Método para retornar as visitas de um determinado tipo escolhido
     * Utiliza o argumento tipo para separar a visita
     *
     * @param string tipo
     *
    */
    public static function getVisit($tipo){
        
        $sql = "SELECT total FROM general_contador WHERE tipo = '$tipo' ";             
        $recordset = Yii::app()->db->createCommand($sql)->queryRow();         
        if(!$recordset) $recordset['total'] = 0;
        
        return $recordset['total'];
    }
    
    /**
     * Método para retornar as visitas de um determinado tipo escolhido
     * Utiliza o argumento tipo para separar a visita além da data e da plataforma 
     *
     * @param string tipo
     *
    */
    public static function getVisits($plataforma, $date){
        
        $sql = "SELECT id, date FROM general_contador_items WHERE plataforma = '$plataforma' AND date_simple = '$date'";      
        $recordset = Yii::app()->db->createCommand($sql)->queryAll();            
        
        return $recordset;
    }
    
    /**
     * Método para retornar as visitas por cidade de um determinado tipo escolhido
     *
     * @param string tipo
     *
    */
    public static function getVisitsByCity($month){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month);
        
        $sql = "SELECT COUNT(*), id, date, cidade FROM general_contador_items WHERE (date >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND date < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00') GROUP BY cidade ORDER BY COUNT(*) DESC";
        
        $command = Yii::app()->db->createCommand($sql);       
        $recordset = $command->queryAll();            
        
        return $recordset;
    }
    
    /**
     * Método para retornar as visitas de um determinado tipo escolhido
     * Utiliza o argumento tipo para separar a visita além da data e da plataforma 
     *
     * @param string tipo
     *
    */
    public static function getWeekVisits($week, $year, $plataforma, $callback = 'number'){
        
        $sql = "SELECT number, descricao FROM date_attribute WHERE label = 'week_".$week."_".$year."_".$plataforma."'";
        
        $command = Yii::app()->db->createCommand($sql);       
        $recordset = $command->queryRow();            
        
        return $recordset[$callback];
    }
    
    /**
     * Método para retornar as actions done realizadas 
     *
     * @param string tipo
     *
    */
    public static function getActionsDone($tipo, $label, $week, $plataforma = 'todas', $id = ''){
        
        $sql = "SELECT tipo, descricao, SUM(num) FROM general_contador_items WHERE tipo = '$label' GROUP BY descricao ORDER BY SUM(num) DESC";
        if($id != "")$sql = "SELECT tipo, descricao, SUM(num) FROM general_contador_items WHERE descricao = '$id' AND tipo = '$label' GROUP BY descricao ORDER BY SUM(num) DESC";
        
        $command = Yii::app()->db->createCommand($sql);       
        $recordset = $command->queryAll(); 
        
        switch($tipo){
            case "user":
                Yii::import('application.extensions.utils.users.UserUtils');
                if($recordset){
                    for($i=0; $i < count($recordset); $i++){
                        $recordset[$i]['user'] = UserUtils::getUserFullById($recordset[$i]['descricao']);
                    }
                }
                
                break;
        }

        return $recordset;
    }
    
    
    /**
     * Método para retornar as actions done realizadas 
     *
     * @param string tipo
     *
    */
    public static function getIPInformationAPI(){
        
        try {
            
            $result = array();
            $result['city'] = '';
            $result['isp'] = '';
            isset($_SERVER["HTTP_REFERER"]) ? $result['from'] = $_SERVER["HTTP_REFERER"] : $result['from'] = null;
            
            $lookupUrl = 'http://xml.utrace.de/?query=' . $_SERVER['REMOTE_ADDR'];
            //Build request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $lookupUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //Ensure we have a valid response
            if ($http_code != 200 || empty($response)) {
                return $result;
            }

            //Parse xml 
            $xml = simplexml_load_string($response);

            $city = $xml->xpath('/results/result/region');
            if (!empty($city) && $city[0] instanceof SimpleXMLElement) {
                //Clean result a bit
                $result['city'] = str_replace('>', '', str_replace('<', '', (string) $city[0]));
            }
            
            
            $isp = $xml->xpath('/results/result/isp');
            if (!empty($isp) && $isp[0] instanceof SimpleXMLElement) {
                //Clean result a bit
                $result['isp'] = str_replace('>', '', str_replace('<', '', (string) $isp[0]));

            }
           
            return $result;
            
            //187.123.8.123 - Cuiabá
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR ContadorUtils - getIPInfo() ' . $e->getMessage();
        }         
    }
    
    /**
     * Método para retornar as actions done realizadas 
     *
     * @param string tipo
     *
    */
    public static function getIPInformation(){
        
        try {
            
            
           
            return true;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR ContadorUtils - getIPInfo() ' . $e->getMessage();
        } 
    }
    
    
  
}
?>