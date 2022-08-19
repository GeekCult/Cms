<?php

/**
 * Description of CurlUtils
 *
 * Here are some method to make easier the class banners
 *
 * @author CarlosGarcia
 */
class CurlUtils{
    
    /**
     * Método para lanchar um chamado curl
     *
     * @param number
     * @param string
     *
    */
    public static function dispatchCurl($url, $data = ""){

        try{
            
            # code...
            $url = "http://www.". $url;

            // Inicia o cURL acessando uma URL
            $ch = curl_init();
            // Define a opção que diz que você quer receber o resultado encontrado
            curl_setopt($ch, CURLOPT_URL, $url);

            if(curl_exec($ch)){ // ?? - if request and data are completely received
                continue; // ?? - go to the next loop
            }
            // Encerra a conexão com o site
            curl_close($ch);
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para lanchar um chamado curl
     *
     * @param number
     * @param string
     *
    */
    public static function dispatchCurlSimple($url){

        try{
            $launche = file_get_contents('http://' . $url, false);
            return $launche;
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
     /**
     * Método para utilizar um CURL as FilegetContent
     *
     * @param number
     * @param string
     *
    */
    public static function getFileContents($site_url, $data = array()){

        try{
            
            $ch = curl_init();
            $timeout = 10;
            curl_setopt ($ch, CURLOPT_URL, $site_url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt ($ch, CURLOPT_POST, count($data));
            curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $file_contents = curl_exec($ch);
            curl_close($ch);
            
            return $file_contents;
            

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: CurlUtils - getFileContents() ". $e->getMessage();
        }
    }

}
?>