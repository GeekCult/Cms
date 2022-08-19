<?php
/*
 * This Class is used to deal with XML files
 *
 * @author CarlosGarcia
 *
 * Date: 13/05/2008
 *
 */

class XmlManager{

    /*
     * Get settings
     */
    public function getSettings(){        

        try{ 
            $result = array();
            $result['user'] = "9d36034b-7d2e-4318-83e8-9cdabcf12eab";
            $result['pass'] = "2192777d-0ab7-474f-a615-7bfef814082b";
            $result['token'] = base64_encode("{$result['user']}:{$result['pass']}");
            
            $result['url'] = "https://hm.hysoft.com.br/Services/Ecommerce/v2";
            //$result['url'] = "https://cliente.hysoft.com.br/Services/Ecommerce/v2";
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XmlManager - getSettings() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - getSettings()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * Check if its has some problems
     */
    public function checkAutorization(){        

        try{ 
            $data = array();
            $data['url'] = "https://hm.hysoft.com.br/Services/Ecommerce/v2/Billet";
            $data['request'] = array();
            $data['params'] = array();
            $data['token'] = array();
            $recordset = $this->apiRequest($data);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XmlManager - checkAutorization() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - checkAutorization()', 'trace' => $e->getMessage()), true);
        }
    }
    
    
    /**
     * metodo para recuperar os textos
     *
     * @param string page
     *
    */
    public function apiRequest($data = array()){        

        try{     
            $curl = curl_init();
                    
            curl_setopt_array($curl, array(
                CURLOPT_URL => $data['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $data['request'],
                CURLOPT_POSTFIELDS => $data['params'],
                CURLOPT_HTTPHEADER => array(
                  "Accept: application/json",
                  "Content-Type: application/json",
                  "Authorization: Basic {$data['token']}"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            if(isset($data['decode'])) return json_decode($response, true);
            return $response;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XmlManager - apiRequest() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - apiRequest()', 'trace' => $e->getMessage()), true);
        }
    }  
    
    
    /**
    * Método para recuperar os registros da tabela em pagamentos
    * Pega as compras e depois os items comprados
    * 
    */
    public function getAutoWeb($data = array()){
        
        Yii::import('application.extensions.utils.integradores.AutoWebUtils');
        
        try{          
            $xml = "media/user/files/autoweb.xml";
            //$xml = simplexml_load_string($xml);
            $xml = simplexml_load_file($xml);
            $result = array();
            //var_dump($xml);
            //return false;
            if(isset($xml->Veiculos)){
                //var_dump($xml);
                $p = 0;
                foreach($xml->Veiculos->Veiculo as $veiculo){
                    
                    
                            
                    //echo MethodUtils::prettyJson($veiculo, true);
                    
                    $item = AutoWebUtils::organizeItem($veiculo);
                    $result[] = $item;
                    //var_dump($item);
                    //echo MethodUtils::prettyJson($veiculo, true);
                    //echo "{$item['codigo']} - {$item['nome']}</br>";
                    
                    //echo $veiculo->Codigo ." - " . $veiculo->Modelo . "</br>";
                    $p++;
                    if($p > 0) break;
                }
            }
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XmlManager - getAutoWeb() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - getAutoWeb()', 'trace' => $e->getMessage()), true);
        }   
    }
    
    /*
     * Set data
     * 
     * @params array
     * 
     */
    public function setData($data = array()){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
            
        try{              
            if(isset($data['query']) && $data['query'] == 'code'){ 
                $set = PreferencesUtils::setAttributes('code', $data['code'], 'texto');//texto ou descricao
            }
            
            
            return $set;            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: XmlManager - saveData()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - saveData()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * Get data
     * 
     * @params array
     * 
     */
    public function getData($data = array()){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
            
        try{  
            
            if(isset($data['query']) && $data['query'] == 'code'){ 
                $recordset['code'] = PreferencesUtils::getAttributes('code', 'texto');
            }
            
            if($recordset && isset($data['callback'])) return $recordset[$data['callback']];
            return $recordset;            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: XmlManager - getData()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - XmlManager - getData()', 'trace' => $e->getMessage()), true);
        }
    }
 
}
?>