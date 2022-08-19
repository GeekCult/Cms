<?php

/**
 * Description of MonthUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * related month
 *
 * @author CarlosGarcia
 */
class MonthUtils {


    /**
     * Método para pegar o mes desejado
     *
     * @param string
     *
    */
    public static function getMonth($dateTMP_date) {
        
       switch ($dateTMP_date) {
            
            case 00:

                $dateTMP_date_month = "00";
                break;
            case 01:

                $dateTMP_date_month = "Janeiro";
                break;
            case 02:

                $dateTMP_date_month = "Fevereiro";
                break;
            case 03:

                $dateTMP_date_month = "Março";
                break;
            case 04:

                $dateTMP_date_month = "Abril";
                break;
            case 05:

                $dateTMP_date_month = "Maio";
                break;
            case 06:

                $dateTMP_date_month = "Junho";
                break;
            case 07:

                $dateTMP_date_month = "Julho";
                break;
            case "08":

                $dateTMP_date_month = "Agosto";
                break;
            case "09":

                $dateTMP_date_month = "Setembro";
                break;
            case "10":

                $dateTMP_date_month = "Outubro";
                break;
            case "11":

                $dateTMP_date_month = "Novembro";
                break;
            case "12":

                $dateTMP_date_month = "Dezembro";
                break;

            default:
                $dateTMP_date_month = "Error";
                break;
        }
        
        return $dateTMP_date_month;

    }
    

}
?>
