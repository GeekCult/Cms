<?php

/*
 * This Class search the content sent from a jQuery request
 *
 * @author CarlosGarcia
 *
 */

class ShortUrlManager{

    
   /**
    *
    * Method to get the longUrl.
    * 
    * @param number
    *
    **/
    public function getLongUrl($shorturl){
        
        Yii::import('application.extensions.utils.ShortUrlUtils'); 
        $tipo = ShortUrlUtils::getTipo($shorturl[0]);
        $sql = "SELECT id, id_general, longurl FROM general_shorturl WHERE tipo = '$tipo' AND shorturl = '$shorturl'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            $longurl = "http://" .$_SERVER['SERVER_NAME'] . "/" . $tipo . "/" . $recordset['longurl']; 
            
            $result = array('tipo' => $tipo, 'id' => $recordset['id_general']);
            
            //Verifica o que fazer
            if($tipo == 'pesquisas' || $tipo == 'boletos'){
                return $result;
                
            //Se downloads
            }else if($tipo == 'downloads'){
                Yii::import('application.extensions.dbuzz.admin.DownloadManager');
                $downloadsHandler = new DownloadManager();
                $download = $downloadsHandler->getContentById($recordset['id_general']);
                
                $url = "http://" .$_SERVER['SERVER_NAME'] . "/media/user/downloads/" . $download['arquivo'];
                header("Location: " . $url); 
                exit;
            //Se qualquer coisa diferente 
            }else{
                header("Location: $longurl"); 
                exit;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
   /**
    *
    * Method to create a shortUrl.
    * It can be a shorturl to: materias, cool, produtos, blog and etc...
    * 
    * @param number
    * @param string
    *
    **/
    public function createShortUrl($tipo){
          
        $abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $num= array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        try{ 
            // security: strip all but alphanumerics & dashes
            $shortURL = $tipo . $abc[rand(0,25)] . $num[rand(0,9)] . $abc[rand(0,25)] . $num[rand(0,9)];
            return $shortURL;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
   /**
    *
    * Method to save a shortUrl inot database.
    * It can be a shorturl to: materias, cool, produtos, blog and etc...
    * 
    * @param array
    *
    **/
    public function saveShortUrl($get_post){
        
        $select = "id_general, tipo, longurl, shorturl";
        $values = $get_post['id_general']."', '".$get_post['tipo']."', '".$get_post['longurl']."', '".$get_post['shorturl'];
        $sql =  "INSERT INTO general_shorturl (". $select .") VALUES ('". $values . "')";
        
        $comando = Yii::app()->db->createCommand($sql);
        $control = $comando->execute();
    }
    
   /**
    *
    * Method to create and save a shortUrl into database.
    * It can be a shorturl to: materias, cool, produtos, blog and etc...
    * 
    * @param array
    *
    **/
    public function submitShortUrl($type){
        
        Yii::import('application.extensions.utils.ShortUrlUtils'); 
        $prefix_type = ShortUrlUtils::getPrefix($type);
        $shortUrlString = $this->createShortUrl($prefix_type);
        $id_last_inserted = Yii::app()->db->getLastInsertID();
        
        $shortUrlArray['tipo'] = $type;
        $shortUrlArray['id_general'] = $id_last_inserted;
        $shortUrlArray['shorturl'] = $shortUrlString;
        $shortUrlArray['longurl'] = "listar/" . $id_last_inserted;
        
        $submitForm = $this->saveShortUrl($shortUrlArray);
        
        return $shortUrlArray['shorturl'];

    }
    
    
}

?>