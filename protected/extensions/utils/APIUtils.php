<?php

/**
 * Description of APIUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class APIUtils {


    /**
     * Método para pegar o avatar do usuário
     *
     * @param number id
     *
    */
    public static function request($url, $data = array()){
        
        Yii::import('application.extensions.utils.launchers.CurlUtils');
        
        $id_user = 0;
        
        try{
            $uri = "https://www.purplepier.com.br/site/request/{$url}/{$id_user}";
            $request = CurlUtils::getFileContents($uri, $data);
            
            return $request;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: APIUtils - request() ' . $e->getMessage();
        }
    }
}
?>