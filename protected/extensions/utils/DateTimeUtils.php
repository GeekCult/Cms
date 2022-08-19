<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of DateTimeUtils
 *
 * @author gustavo
 */
class dateTimeUtils {

    public static function Greeting() {
        $endMorning = mktime(11, 59, 59, date("m"), date("d"), date("Y"));
        $endAfternoon = mktime(17, 59, 59, date("m"), date("d"), date("Y"));
        $endNight = mktime(05, 59, 59, date("m"), date("d"), date("Y"));

        $today = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

        if ($today > $endAfternoon) {
            return 'Boa noite';
        }
        else if ($today > $endMorning) {
            return 'Boa tarde';
        }
        else {
            return 'Bom dia';
        }

        return 'Em qual dimensão você está?';
    }

    /**
     * Método para formatar a data
     * Formato: 12 November 2010 | 3:11 pm
     *
     * @param string page
     *
    */
    public static function getDateFormate($date) {

        if ($date == NULL) return '';
        
        Yii::import('application.extensions.utils.MonthUtils');

        $dateTMP = explode(" ", $date);
        $dateTMP_date = explode("-", $dateTMP[0]);
        $dateTMP_time = explode(":", $dateTMP[1]);

        $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
        $dateTMP_time_GM = "am";

        if($dateTMP_time[0] > "12") {
           $dateTMP_time_GM = "pm";
        }

        $date_new = $dateTMP_date[2] . " " . $dateTMP_date_month . " " .$dateTMP_date[0] . " | " . $dateTMP_time[0] . ":" . $dateTMP_time[1] . " " . $dateTMP_time_GM;
        return $date_new;
    }
    
    /**
     * Método para formatar a data sem o periodo em horas
     * Formato: 12 November 2010
     *
     * @param string page
     *
    */
    public static function getDateFormateNoTime($date) {
        
        try{
            if ($date == NULL) return '';

            Yii::import('application.extensions.utils.MonthUtils');

            //Algumas datas podem vir como NULL
            ($date != NULL) ? $dateTMP = explode(" ", $date) : $dateTMP = NULL;

            if (count($dateTMP)>0) {
                $dateTMP_date = explode("-", $dateTMP[0]);
                $dateTMP_time = explode(":", $dateTMP[1]);        
                $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
                $date_new = $dateTMP_date[2] . " " . $dateTMP_date_month . " " .$dateTMP_date[0];
            } else {
                $date_new = false;
            }


            return $date_new;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DateTimeUtils - getDateFormateNoTime '. $e->getMessage();
        }
    }
    
    /**
     * Método para formatar a data sem o periodo em horas
     * 
     * Este método deve ser usado se não houver timeStamp
     * Formato: 12 November 2010
     *
     * @param string page
     *
    */
    public static function getDateFormateNoTimeStamp($date){
        
        Yii::import('application.extensions.utils.MonthUtils');
        $dateTMP_date = explode("-", $date);

        if(count($dateTMP_date)>0 && isset($dateTMP_date[1])){
            $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
            $date_new = $dateTMP_date[2] . " " . $dateTMP_date_month . " " .$dateTMP_date[0];
        }else{
            $date_new = false;
        }
        
        return $date_new;
    }
    
    /**
     * Método para separar a data em partes
     * 
     * array('day', 'month', 'year');
     *
     * @param string page
     *
    */
    public static function getDateFormateNoTimeStampParts($date){
        
        Yii::import('application.extensions.utils.MonthUtils');
        $dateTMP_date = explode("-", $date);

        if(count($dateTMP_date)>0 && isset($dateTMP_date[1])){
            $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
            $date_new = array('day' => $dateTMP_date[2], 'month' => $dateTMP_date_month, 'year' => $dateTMP_date[0]);
        }else{
            $date_new = array('day' => '', 'month' => '', 'year' => '');
        }
       
        return $date_new;
    }

    /**
     * Método para formatar a data
     * Formato: 05/12/2011
     * 
     * Is inverse is used along a DatePicker Component
     *
     * @param string page
     *
    */
    public static function getDateFormatCommon($date, $isInverse = false){
        
        $dateTMP = explode(" ", $date);
 
        if(count($dateTMP) <= 1) return $date;
        
        $dateTMP_date = explode("-", $dateTMP[0]);
        $dateTMP_time = explode(":", $dateTMP[1]);
        
        
        
        if(!$isInverse) $date_new = $dateTMP_date[2] . "/" . $dateTMP_date[1] . "/" .$dateTMP_date[0];
        if( $isInverse) $date_new = $dateTMP_date[1] . "/" . $dateTMP_date[2] . "/" .$dateTMP_date[0];
        
        return $date_new;
    }
    
    /**
     * Método para formatar a data
     * Formato: 05/12/2011
     *
     * @param string page
     *
    */
    public static function getDateFormatCommonNoTime($date, $isComplex = false, $isInternational = false){
        
        Yii::import('application.extensions.utils.MonthUtils');
        
        if($date != NULL){
            $dateTMP_date = explode("-", $date);
            
            if(!$isComplex){
                if(count($dateTMP_date)>0){
                    if(!$isInternational) $date_new = $dateTMP_date[2] . "/" . $dateTMP_date[1] . "/" .$dateTMP_date[0];
                    if( $isInternational) $date_new = $dateTMP_date[1] . "/" . $dateTMP_date[2] . "/" .$dateTMP_date[0];

                }else{
                    $date_new = false;  
                }
            }
            
            if($isComplex){
                if(count($dateTMP_date)>0){
                    $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
                    $date_new = $dateTMP_date[2] . " " . $dateTMP_date_month . " " .$dateTMP_date[0];

                }else{
                    $date_new = false;  
                }
            }
            
        }else{
            $date_new = '00/00/0000';
        }
        
        return $date_new;
    }
    
    /**
     * Método para transformar de padrão 05/12/2011 para
     * mySQL formato
     * Formato: 2011-01-01 00:00:00
     *
     * @param number
     *
    */
    public static function setFormatDateTime($date, $isInverse = false, $time = '00:00'){
        $dateTMP_date = explode("/", $date);
        if(!$isInverse)$date_new = $dateTMP_date[2] . "-" . $dateTMP_date[1] . "-" .$dateTMP_date[0] . " " . $time .":00";
        if( $isInverse)$date_new = $dateTMP_date[2] . "-" . $dateTMP_date[0] . "-" .$dateTMP_date[1] . " " . $time .":00";
        return $date_new;
    }
    
    /**
     * Método para transformar de padrão 05/12/2011 ou 12/05/2011 para
     * mySQL formato
     * Formato: 2011-01-21
     *
     * @param number
     *
    */
    public static function setFormatDateNoTime($date, $isNational = true){ 
        
        if($date == '') return "0000-00-00";
        $dateTMP_date = explode("/", $date);
        
        if(isset($dateTMP_date[2])){ 
            if($isNational) {
                $date_new = $dateTMP_date[2] . "-" . $dateTMP_date[1] . "-" .$dateTMP_date[0];

            }else{
                $date_new = $dateTMP_date[2] . "-" . $dateTMP_date[0] . "-" .$dateTMP_date[1];    
            }
        }else{
            return "0000-00-00";
        }
        
        return $date_new;
    }
    
    
    /**
     * Método para formatar o tempo
     * Formato: 00:00
     *
     * @param string
     *
    */
    public static function getTimeFormated($time){       
        $timeTMP = explode(":", $time);
        $time_new = $timeTMP[0] . ":" . $timeTMP[1];
        return $time_new;

    }
    
    /**
     * Método para retornar soemnte o tempo
     * Formato: 00:00
     *
     * @param string
     *
    */
    public static function getTime($data){       
        $time = explode(" ", $data);
        $timeTMP = explode(":", $time[1]);
        $time_new = $timeTMP[0] . ":" . $timeTMP[1];
        return $time_new;

    }
    
    /**
     * Método para retornar a data separada em um array
     * 
     * @param string
     *
    */
    public static function getSplitDateNoTime($date, $isFull = false){ 
        if($date != ''){
            if($isFull) {$dateTp = explode(" ", $date); $date = $dateTp[0];}
            $dateTMP_date = explode("-", $date);
            $date_new['day'] = $dateTMP_date[2];
            $date_new['month'] = $dateTMP_date[1];
            $date_new['year'] = $dateTMP_date[0];
        }else{
            $date_new['day'] = $date_new['month'] = $date_new['year'] = "";
        }
        
        return $date_new;
    }
    
    /**
     * Método para obter o mes abreviado
     * Ex: Nov, Dez, Jan...
     * 
     * @param string
     *
    */
    public static function getAbreviateMonth($month){
        
        $month = Yii::t("adminForm", "date_month_". $month);
        return $month;
    }
    
    /**
     * Método para obter a imagem do tempo
     * 
     * @param string
     *
    */
    public static function getPictureWeather($label){
        
        $picture = "sol.png";
        
        switch($label){
            case "Parcialmente ensolarado":
                $picture = "parcialmente_ensolarado.png";
                break;
            case "Sol":
                $picture = "sol.png";
                break;
            case "Chuva":
                $picture = "chuva.png";
                break;
        }
        
        return $picture;
    }
    
    /**
     * Método para calcular o tempo passado entre duas datas
     * $checkin[0]  = "2013-03-09 10:00:01";
     * $checkout[0] = "2013-03-12 10:55:15";
     * 
     * @param array
     *
    **/
    public static function getTimePassedBy($data, $callback = 'minutes', $isSimple = true){
        
        try{
            if($isSimple){
                $checkin[0] = $data['data_criacao'];
                $checkout[0] = $data['last_update'];
            }

            $diffSeconds = 0;
            for($i = 0; $i < count($checkin); $i++){
              $diffSeconds += strtotime($checkout[$i]) - strtotime($checkin[$i]);
            }

            $result['hours'] = floor($diffSeconds/3600);
            $result['minutes'] = floor($diffSeconds / 60);
            //echo $hours.' hours ' . $minutes.' minutes </br>';

            return $result[$callback];
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: DateTimeUtils - getTimePassedBy() '. $e->getMessage();
        }
    }
    
    /**
     * Método para transformar hora para minutos ou segundos
     * 
     * @param string
     *
    **/
    public static function transformHourToMinutes($time, $callback = 'minutes'){
        
	$result['seconds'] = floor($time * 3600);
        $result['minutes'] = floor($time * 60);
        
        return $result[$callback];
    }
    
    /**
     * Método para calcular o periodo dos meses quando se recebe apenas o mes corrente
     * 
     * @param string
     *
    **/
    public static function getMonthSequence($month, $year = null, $action = 'increase'){
        
        if($year == null) $year = date('Y');
        
	$result['month_current'] = $month;
        $result['year_current'] = $year;
        $result['year_next'] = $year;
        
        if($action == 'increase'){
            $result['month_next'] = $month + 1;
            if($result['month_next'] > 12) {
                $result['month_next'] = '01';
                $result['year_next'] = $result['year_current'] + 1;
            }
        }
        
        if($action == 'decrease'){
            $result['month_next'] = $month - 1;
            if($result['month_next'] < 1){
                $result['month_next'] = 12;
                $result['year_next'] = $result['year_current'] - 1;
            }
        }
        
        return $result;
    }
    
    /**
     * Método para adicionar tempo a uma data
     * 
     * @param string
     * @paran numbers
     *
    **/
    public static function addTimeToDate($value, $years = 0, $months = 0, $days = 0, $hours = 0, $minutes = 0, $seconds = 0, $tipo = 'add'){        
        
        //$date = new DateTime($value);
        //if($tipo == 'add') $date->add(new DateInterval("P0Y0M0DT0H0M{$seconds}S"));
        //if($tipo == 'sub') $date->add(new DateInterval("P0Y0M0DT0H0M{$seconds}S"));
        
        //return $date->format('Y-m-d H:i:s') . "\n";
        
        $cd = strtotime($value);
        if($tipo == 'add'){
        $newdate =  date('Y-m-d H:i:s', mktime(
                    date('H',$cd)+$hours,
                    date('i',$cd)+$minutes,
                    date('s',$cd)+$seconds,
                    date('m',$cd)+$months,
                    date('d',$cd)+$days,
                    date('Y',$cd)+$years));
        }
       
        if($tipo == 'sub'){
        $newdate =  date('Y-m-d H:i:s', mktime(
                    date('H',$cd)-$hours,
                    date('i',$cd)-$minutes,
                    date('s',$cd)-$seconds,
                    date('m',$cd)-$months,
                    date('d',$cd)-$days,
                    date('Y',$cd)-$years));
        }
        
        return $newdate;
    }
    
    
    /**
     * Método para calcular o periodo dos meses quando se recebe apenas o mes corrente
     * 
     * @param string
     *
    **/
    public static function getDateSequence($current_date, $time_full = false, $action = 'increase'){
        
        $result = false;
        
        if(!$time_full){
            $date = explode("-", $current_date);
        }
        
	
        if(isset($date[1])){
            
            $new_date = DateTimeUtils::getMonthSequence($date[1], null, $action);
            $result = $new_date['year_next'] . "-" . $new_date['month_next']  . "-" . $date[2];
        }
        
        return $result;
    }
    
     /**
     * Método para formatar a data
     * Formato: 12 November 2010 | 3:11 pm
     *
     * @param string page
     *
    */
    public static function getDateFormatFromWebHook($date){
        
         if ($date == NULL) return '';
        
        Yii::import('application.extensions.utils.MonthUtils');

        $dateTMP = explode("T", $date);
        $dateTMP_date = explode("-", $dateTMP[0]);
        $dateTMP_time = explode(":", $dateTMP[1]);

        $dateTMP_date_month = MonthUtils::getMonth($dateTMP_date[1]);
        $dateTMP_time_GM = "am";

        if($dateTMP_time[0] > "12") {
           $dateTMP_time_GM = "pm";
        }

        $date_new = $dateTMP_date[2] . " " . $dateTMP_date_month . " " .$dateTMP_date[0] . " | " . $dateTMP_time[0] . ":" . $dateTMP_time[1] . " " . $dateTMP_time_GM;
        return $date_new;
    }
    
    /**
     * Método para formatar a hora 
     * Formato: 13:22
     * 
     * Is inverse is used along a DatePicker Component
     *
     * @param string page
     *
    */
    public static function getHourFromDate($date){
        
        $dateTMP = explode(" ", $date);
 
        if(count($dateTMP) <= 1) return $date;
        
        $dateTMP_date = explode("-", $dateTMP[0]);
        $dateTMP_time = explode(":", $dateTMP[1]);
        
        $date_new = $dateTMP_time[0] . ":" . $dateTMP_time[1];       
        
        return $date_new;
    }
    
    /**
     * Método para pegar os valores da data 
     *
     * @param string page
     *
    */
    public static function getDateValuesFromDate($date, $idDate = 'simples'){     
        
        $values = array();
        
        if($idDate == 'simples'){
            $dateTMP = explode("/", $date);
            if(count($dateTMP) <= 1) return $date;
        
            $values['day'] = $dateTMP[0];
            $values['month'] = $dateTMP[1];
            $values['year'] = $dateTMP[2];
        }  
        
        if($idDate == 'complex'){
            
            $dateTMP = explode(" ", $date);
            if(count($dateTMP) <= 1) return $date;
            
            $dateTMP_date = explode("-", $dateTMP[0]);
            $dateTMP_time = explode(":", $dateTMP[1]);
        
            $values['day'] = $dateTMP_date[2];
            $values['month'] = $dateTMP_date[1];
            $values['year'] = $dateTMP_date[0];
            $values['hour'] = $dateTMP_time[0];
            $values['minute'] = $dateTMP_time[1];
            $values['time'] = $dateTMP_time[0] . ":" . $dateTMP_time[1];
            
        }  
        
        return $values;
    }
    
    /**
     * Método para obter o mês de uma data
     * Formato: 05/12/2011
     * 
     * Is inverse is used along a DatePicker Component
     *
     * @param string page
     *
    */
    public static function getMonth($date, $isfull = true){
        
        Yii::import('application.extensions.utils.MonthUtils');
        
        if($isfull){
            $dateTMP = explode(" ", $date);

            if(count($dateTMP) <= 1) return $date;

            $dateTMP_date = explode("-", $dateTMP[0]);
            $tmp_month = $dateTMP_date[1];
        }
        
        if(!$isfull){
            $dateTMP = explode("-", $date);
            if(count($dateTMP) <= 1) return $date;
            
            $tmp_month = $dateTMP[1];
        }
        
        $month = MonthUtils::getMonth($tmp_month);
        
        return $month;
    }
        
}
?>
