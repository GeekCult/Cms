<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringUtils
 *
 * @author gustavo
 */
class StringUtils{

     
    /*
     * 
     * Converts a string to a proper format, ready to be used in URL's
     * 
     * @param string
     * 
     */
    public static function StringToUnderline($str, $isSpecial = false, $noUnderline = false){
        
        $stub = strtolower($str);
        $stub = str_replace(" ", "_", $stub);
        $stub = str_replace("-", "_", $stub);
        
        $search = explode(",", "ã,õ,ç,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,!,@,#,$,&,%,^,*,(,),[,],{,},=,+,.");
        $replace = explode(",","a,o,c,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,,,,,,,,,,,,");
        $stub = str_replace(",", "", $stub);
        $stub = str_replace("'", "", $stub);        
        $stub = str_replace($search, $replace, $stub);
        
        if($isSpecial) $stub = str_replace(":", "_", $stub);
        if($noUnderline)$stub = str_replace("_", "", $stub);
        
        return $stub;
    }
    
     /*
     * PS: Trocar também em Uploadify
     * Converts a string to a proper format, ready to be used in URL's
     * 
     * @param string
     * 
     */
    public static function StringToFile($str){
        
        $sufixo = substr($str, -3, 3);
        $file_name = substr($str, 0, -3);
        
        $file_name = strtolower($file_name);
        $file_name = str_replace(" ", "_", $file_name);
        $file_name = str_replace("-", "_", $file_name);
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,!,@,#,$,&,%,^,*,(,),[,],{,},=,+,.");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,,,,,,,,,,,,");
        $file_name = str_replace($search, $replace, $file_name);

        $file_name = $file_name . "." . $sufixo;
        
        return $file_name;
    }
    
    /*
     * Converts a string to a proper format, ready to be used in URL's
     * 
     * @param string
     */
    public static function StringToUrl($str, $isUrl = true, $symbol = '+'){
        $stub = strtolower($str);
        if($isUrl) $stub = str_replace(" ", "-", $stub);
        $search  = explode(",", "ç,à,ã,á,é,í,ó,ú,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,õ,û,å,ø,u,Ã,Õ,Á,É,Í,Ó,Ú,Ç,!,@,#,$,&,%,^,*,(,),[,],{,},=,+,");
        $replace = explode(",", "c,a,a,a,e,i,o,u,e,i,o,u,a,e,i,o,u,y,a,e,i,o,o,u,a,o,u,A,O,A,E,I,O,U,C,,,,,,,,,,,,,,,");
        $stub = str_replace($search, $replace, $stub);
        
        if($isUrl){
            $stub = str_replace("-", $symbol, $stub);
            $stub = str_replace("/", $symbol, $stub);
            $stub = str_replace(":", $symbol, $stub);//???
            $stub = str_replace(",", "", $stub);//???
            $stub = str_replace(".", "", $stub);//???
            $stub = str_replace("?", "", $stub);//???
            $stub = str_replace("---", "-", $stub);
        }

        return $stub;
    }
    
    /*
     * Converts a string to a proper format, ready to be used in URL's
     * 
     * @param string
     */
    public static function StringToUrlCompact($str, $isUrl = true, $symbol = '-'){
        $stub = strtolower($str);
        $stub = str_replace(" ", "", $stub);
        
        $search = explode(",", "ç,à,ã,á,é,í,ó,ú,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,õ,û,å,ø,u,Ã,Õ,Á,É,Í,Ó,Ú,Ç,!,@,#,$,&,%,^,*,(,),[,],{,},=,+,");
        $replace = explode(",","c,a,a,a,e,i,o,u,e,i,o,u,a,e,i,o,u,y,a,e,i,o,o,u,a,o,u,A,O,A,E,I,O,U,C,,,,,,,,,,,,,,,");
        $stub = str_replace($search, $replace, $stub);
        
        if($isUrl){
            $stub = str_replace("/", $symbol, $stub);
            $stub = str_replace(":", $symbol, $stub);//???
        }

        return $stub;
    }
    
    /*
     * Crops a string removing the last and first item relate the char $symbol
     * 
     * @param string
     */
    public static function StringTrim($str, $symbol = ' '){
        $stub = trim($str, $symbol);
       
        return $stub;
    }
    
    /*
     * 
     * Random
     * It sorts a number betweem the elemnts bellow
     * It's used just to avoid some images with the same name.
     * 
     */
    public static function getRandom(){
        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $num = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $sufixo_new_1 = $abc[rand(0,25)];
        $sufixo_new_2 = $num[rand(0,9)];
        $sufixo_new = $sufixo_new_1 . $sufixo_new_2;
        
        return $sufixo_new;
    }
    
    /*
     * Removes some characters not suitable 
     * 
     * @param string
     * 
     */
    public static function RemoveSpecialChar($var){
        $tam = 100;
        $sizeName = strlen($var);
        $a="¡·…ÈÕÌ”Û⁄˙«Á√„¿‡¬‚ ÍŒÓ‘Ù’ı€˚& -!@#$%®&*()_+}=}{[]^~?/:;><,'¥`\"";
        $b="AaEeIiOoUuCcAaAaAaEeIiOoOoUue_________________________________";
        $var = strtr($var,$a,$b);
        $var = strtolower($var);
        $var = str_replace("'", "", $var);
        if ($sizeName>$tam){
         $var = substr($var,0,$tam);
        }
        
        return $var;
    }
    
   
    
    /*
     * Remove ascentos
     * 
     * @param string
     *  
     */
    public static function removeAcentos($str) {
        
        $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
        $to = "aaaaeeiooouucAAAAEEIOOOUUC";
    
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);
        
    }
    
    /*
     * Removes the uppercase format and set the first letter
     * from each one as capital.
     * 
     * @param string
     * 
     */
    public static function StringToLowerCase($var, $name = "name"){
        
        //Name
        $stub = $var;
        
        if($name == "name"){
           $stub = ucwords(strtolower($var)); 
        }
        //Paragrafo
        if($name == "texto"){
           $stub = ucfirst(strtolower($var));
        }
        //Entire lowercase
        if($name == "simple"){
           $stub = strtolower($var);
        }
        
        //Ideal para converter caracteres especiais quando converte do *.XLS.
        if($name == 'especial'){
            $stub = mb_strtolower($var, 'UTF-8');
            $stub = ucwords(strtolower($stub));
        }
        
        if($name == "label"){
           $stub = ucwords(strtolower($var)); 
           $stub = str_replace(" De ", " de ", $stub);
           $stub = str_replace(" Da ", " da ", $stub);
           $stub = str_replace(" Do ", " do ", $stub);
           $stub = str_replace(" Das ", " das ", $stub);
           $stub = str_replace(" Dos ", " dos ", $stub);
           $stub = str_replace(" Na ", " na ", $stub);
           $stub = str_replace(" No ", " no ", $stub);
           $stub = str_replace(" E ", " e ", $stub);
           $stub = str_replace(" A ", " a ", $stub);
        }
        return $stub;
    }
    
   /*
    * This method returns the string between to tags
    * It gets a complete string and uses the first tag and last tag to slip it up
    * 
    * @strings
    * 
    */
    public static function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        
        return substr($string,$ini,$len);
    }
    
    /*
    * This method returns the result string to array
    * 
    * @strings
    * 
    */
    public static function transFormStringToArray($string, $char = ','){
        $result = false;
        if($string != '') $result = explode($char, $string);        
        return $result;
    }
    
    /*
    * This method returns the string between to tags
    * It gets a complete string and uses the first tag and last tag to slip it up
    * 
    * @strings
    * 
    */
    public static function getFormatString($string, $type){
        
        $result = $string;
        
        if($string != ""){
            
            switch ($type){
                case 'celular':
                    $total = strlen($string);
                   
                    if($total <= 10){
                        $ddd = substr($string, 0, 2);
                        $number1 = substr($string, 2, 4);
                        $number2 = substr($string, 6);
                    }else{
                        $ddd = substr($string, 0, 2);
                        $number1 = substr($string, 2, 5);
                        $number2 = substr($string, 7);
                    }
                    $result = "(" . $ddd . ") ". $number1 . "-" . $number2;
                    break;
                case 'telefone':
                    $ddd = substr($string, 0, 2);
                    $number1 = substr($string, 2, 4);
                    $number2 = substr($string, 6);
                    $result = "(" . $ddd . ") ". $number1 . "-" . $number2;
                    break;
                
                case 'celular_clear':
                case 'telefone_clear':
                    $ddd = substr($string, 0, 2);
                    $number1 = substr($string, 3, 4);
                    $number2 = substr($string, 8);                   
                    $result = $ddd . $number1 . $number2;
                    break;
            }
            
        }
        
        return $result;
    }
    
    /*
     * Replace
     * 
     * @param string
     * 
     */
    public static function replace($string) {
        return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
    }
    
    /*
     * Replace phone
     * 
     * @param string
     * 
     */
    public static function replacePhone($string) {
        //$string = str_replace("/","", str_replace("-","", str_replace("+","", str_replace(".","",str_replace("(","",str_replace(")","",str_replace(" ","", $string)))))));
        $string = str_replace("/","",$string);
        $string = str_replace("(","",$string);
        $string = str_replace(")","",$string);
        $string = str_replace("-","",$string);
        $string = str_replace("+","",$string);
        $string = str_replace(" ","",$string);
        return $string;
    }
    
    /*
     * Replace by a specific value
     * 
     * @param string
     * @para string
     * 
     */
    public static function replaceChar($char, $string) {
        return $string = str_replace($char,"", $string);
    }
    
    /*
     * Replace by a specific value for another
     * 
     * @param string
     * @param string
     * @param string
     * 
     */
    public static function replaceCharBy($char, $by, $string) {
        return $string = str_replace($char, $by, $string);
    }
    
    /*
     * 
     * Transform \n to <br> to save into database 
     * After taht it turn it back to <br> 
     * 
     */
    public static function breakline($text){
        
        // Damn pesky carriage returns...
        $text = str_replace("\r\n", "<br>", $text);
        $text = str_replace("\r", "<br>", $text);

        // JSON requires new line characters be escaped
        $text = str_replace("\n", "<br>", $text);
        
        //$text = addslashes($text);
        return $text;
    
    }
    
    /*
     * 
     * 
     */
    public static function utf8_ansi($valor='') {

    $utf8_ansi2 = array(
        "\u00c0" =>"À",
        "\u00c1" =>"Á",
        "\u00c2" =>"Â",
        "\u00c3" =>"Ã",
        "\u00c4" =>"Ä",
        "\u00c5" =>"Å",
        "\u00c6" =>"Æ",
        "\u00c7" =>"Ç",
        "\u00c8" =>"È",
        "\u00c9" =>"É",
        "\u00ca" =>"Ê",
        "\u00cb" =>"Ë",
        "\u00cc" =>"Ì",
        "\u00cd" =>"Í",
        "\u00ce" =>"Î",
        "\u00cf" =>"Ï",
        "\u00d1" =>"Ñ",
        "\u00d2" =>"Ò",
        "\u00d3" =>"Ó",
        "\u00d4" =>"Ô",
        "\u00d5" =>"Õ",
        "\u00d6" =>"Ö",
        "\u00d8" =>"Ø",
        "\u00d9" =>"Ù",
        "\u00da" =>"Ú",
        "\u00db" =>"Û",
        "\u00dc" =>"Ü",
        "\u00dd" =>"Ý",
        "\u00df" =>"ß",
        "\u00e0" =>"à",
        "\u00e1" =>"á",
        "\u00e2" =>"â",
        "\u00e3" =>"ã",
        "\u00e4" =>"ä",
        "\u00e5" =>"å",
        "\u00e6" =>"æ",
        "\u00e7" =>"ç",
        "\u00e8" =>"è",
        "\u00e9" =>"é",
        "\u00ea" =>"ê",
        "\u00eb" =>"ë",
        "\u00ec" =>"ì",
        "\u00ed" =>"í",
        "\u00ee" =>"î",
        "\u00ef" =>"ï",
        "\u00f0" =>"ð",
        "\u00f1" =>"ñ",
        "\u00f2" =>"ò",
        "\u00f3" =>"ó",
        "\u00f4" =>"ô",
        "\u00f5" =>"õ",
        "\u00f6" =>"ö",
        "\u00f8" =>"ø",
        "\u00f9" =>"ù",
        "\u00fa" =>"ú",
        "\u00fb" =>"û",
        "\u00fc" =>"ü",
        "\u00fd" =>"ý",
        "\u00ff" =>"ÿ");

    return strtr($valor, $utf8_ansi2);      

    }
}

?>
