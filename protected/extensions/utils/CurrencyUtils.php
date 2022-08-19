<?php
/* 
 * This class contains common util functions regarding products
 * 
 */

class CurrencyUtils {

    /**
     * Returns the price with a new format
     * 
     * It replace the dot to comma or adds a
     * ",00" if it's an integer value.
     *
     * It formats the value until 99.999,00
     *
     */
    public static function getPriceFormat($price, $prefix = true, $free = 1){
        
        if($price == 0 && $free == 1) return Yii::t("siteStrings", "label_free");
        if($price == 0 && $free == 2) return "";
        if($price == 0 && $free == 3) return Yii::t("siteStrings", "label_sobconsulta");
        
        //Make sure it has just two decimals number after comma.
        $price = number_format($price, 2, ".", "");
        
        $price = explode(".", $price);

        //This function verify if the last number is a .90 . 80 ... or simililar ending in 0
        //It fixes a bug with the float which the 0 were missing in that cases
        if(count($price) > 1 ){
            if(strlen($price[1]) == 1){
                $price[1] = $price[1] . "0";
            }
            //Se tiver mais de duas casas decimais depois da virgula
            if(strlen($price[1]) > 2){
                $pricetmp = str_split($price[1], 2);
                $price[1] = $pricetmp[0];
            }
        }

        $priceTMP = str_split($price[0], 1);

        //It formats: 1.000 - 9.99
        if(count($priceTMP) == 4){
            $price[0] = substr($price[0], 0, 1) . "." .substr($price[0], 1, 3);
        }
        
        //It formats: 10.000 - 99.99
        if(count($priceTMP) == 5){
            $price[0] = substr($price[0], 0, 2). "." .substr($price[0], 2, 3);
        }
        
        //It formats: 10.000,30 - 99.99
        if(count($priceTMP) == 6){
            $price[0] = substr($price[0], 0, 3). "." .substr($price[0], 3, 4);
        }
        
        if(count($priceTMP) == 7){
            $price[0] = substr($price[0], 0, 4). "." .substr($price[0], 4, 5);
        }

        if(count($price) < 2){
            //Se o valor for vazio então soca zero!
            if($price[0] != ""){
                $price  = $price[0] . ",00";
            }else{
                $price  = "0,00";
            }
        }else{
            $price  = $price[0] . "," . $price[1];
        }

        if($prefix){
            $price = "R$" . $price;            
        }
        
        return $price;
    }
    
    /**
     * Returns a special format price to be used with gateway
     * of payments, PagSeguro needs some like 9.90, and the database
     * save as 9.9 is missing a zero to be accepted into gateway.
     * 
     * @param float
     *
     */
    public static function getFloatFormat($price){
        
        $price = explode(".", $price);
        
        if(count($price) > 1 ){
            if(strlen($price[1]) == 1){
                $price[1] = $price[1] . "0";
            }
        }else{
            $price[1] = "00";
        }
        
        //Make sure it has just two decimals number after comma.
        $group_value = $price[0] . "." .$price[1];        
        $new_value = number_format($group_value, 2);
        
        return $new_value;
    }
    
    /**
     * Returns a special format to price
     * For instace uses types a comma instead of a point it 
     * transform it
     * 
     * @param number
     *
     */
    public static function checkFloatFormat($price){      
        
        return str_replace(",", ".", $price);
    }

    /**
     * Returns the values from the calcules between price, parcels
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function getCalculatesValues($price, $parcels, $descont){
        $valor['parcel'] = $price / $parcels;
        return $valor;
    }
    
    
}
?>
