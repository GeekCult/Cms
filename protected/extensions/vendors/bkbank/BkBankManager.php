<?php
/*
 * This Class is used to controll all functions related the feature Bk Bank
 *
 * @author CarlosGarcia
 *
 *
 * Data 30/03/2021
 *
 */

class BkBankManager{
    
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
            echo 'ERROR: BkBankManager - getSettings() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - getSettings()', 'trace' => $e->getMessage()), true);
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
            echo 'ERROR: BkBankManager - getAllContent() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - getAllContent()', 'trace' => $e->getMessage()), true);
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
            echo 'ERROR: BkBankManager - apiRequest() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - apiRequest()', 'trace' => $e->getMessage()), true);
        }
    }    
    
    /*
     * Request token
     * 
     */
    public function tokenRequest($data = array()){ 
        
            
        //$api = $this->getSettings(array('query' => 'api'));
        //$user = "TUDX";
        //$pass = "B6D0E9CF-A526-499B-82CE-EEAF44ECCB80";
        
        $user = "9d36034b-7d2e-4318-83e8-9cdabcf12eab";
        $pass = "2192777d-0ab7-474f-a615-7bfef814082b";
        
        $args = json_encode($data['params']);
        //$args = $data['params'];
        $url = "https://hm.hysoft.com.br/Services/Ecommerce/v2/{$data['url']}";
        //$url = "https://cliente.hysoft.com.br/Services/Ecommerce/v2/{$data['url']}";
        $token = base64_encode("$user:$pass");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $data['request'],
            CURLOPT_POSTFIELDS => $args,
            CURLOPT_HTTPHEADER => array(
              "Authorization: Basic {$token}",
              "Content-Type: application/json",
              "Accept: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;
    }
    
    /*
     * Set definicoes
     * 
     * @params array
     * 
     */
    public function saveSettings($data = array()){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
            
        try{              
            if(isset($data['query']) && $data['query'] == 'code'){ 
                $set = PreferencesUtils::setAttributes('melhorenvio_code', $data['code'], 'descricao');
            }
            
            if(isset($data['query']) && $data['query'] == 'api'){ 
                $set = PreferencesUtils::setAttributes('melhorenvio_client_id', $data['client_id'], 'texto');
                $set = PreferencesUtils::setAttributes('melhorenvio_secret', $data['secret'], 'texto');
                $dados = $this->organizeUserInfo($data);
                $set = PreferencesUtils::setAttributes('melhorenvio_json', $dados, 'descricao');
            }
            
            if(isset($data['query']) && $data['query'] == 'token'){ 
                $set = PreferencesUtils::setAttributes('melhorenvio_token', $data['token']['access_token'], 'descricao');
                $set = PreferencesUtils::setAttributes('melhorenvio_token_refresh', $data['token']['refresh_token'], 'descricao');            
                $set = PreferencesUtils::setAttributes('melhorenvio_token_expira', date("Y-m-d", (strtotime(date(date("Y-m-d"))) + $data['token']['expires_in'])) , 'texto'); 
            }
            
            return $set;            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: BkBankManager - saveSettings()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - saveSettings()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * Get definicoes
     * 
     * @params array
     * 
     */
    public function getSettingssss($data = array()){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
            
        try{  
            
            if(isset($data['query']) && $data['query'] == 'code'){ 
                $recordset['code'] = PreferencesUtils::getAttributes('melhorenvio_code', 'descricao');
            }
            
            if(isset($data['query']) && $data['query'] == 'api'){
                $recordset['client_id'] = PreferencesUtils::getAttributes('melhorenvio_client_id', 'texto'); 
                $recordset['secret'] = PreferencesUtils::getAttributes('melhorenvio_secret', 'texto');
                $recordset['json'] = json_decode(PreferencesUtils::getAttributes('melhorenvio_json', 'descricao'), true);
            }
            
            if(isset($data['query']) && $data['query'] == 'json'){
                $recordset['json'] = json_decode(PreferencesUtils::getAttributes('melhorenvio_json', 'descricao'), true);
            }
            
            if(isset($data['query']) && $data['query'] == 'token'){
                
                if( Yii::app()->params['local']){
                    $recordset['token'] = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkyNDNjNjBjYWI4ZjNmNzE3OGRmMjM3NTgyN2ZmY2Q3MTM0ZjYzNzhiNTM0YWIzZTNiMjUyMDVjNDkxMmVjOWM4NjFlOTA1OGYwOTI3NjRkIn0.eyJhdWQiOiIzNDIiLCJqdGkiOiI5MjQzYzYwY2FiOGYzZjcxNzhkZjIzNzU4MjdmZmNkNzEzNGY2Mzc4YjUzNGFiM2UzYjI1MjA1YzQ5MTJlYzljODYxZTkwNThmMDkyNzY0ZCIsImlhdCI6MTU4Njg5Mzg4NiwibmJmIjoxNTg2ODkzODg2LCJleHAiOjE1ODk0ODU4ODYsInN1YiI6IjBlM2FmOTcwLWZiM2ItNDUzZi1iZjJkLWFhYjZiMGZhMWI4NCIsInNjb3BlcyI6WyJjYXJ0LXdyaXRlIiwidHJhbnNhY3Rpb25zLXJlYWQiLCJ3ZWJob29rcy1yZWFkIiwid2ViaG9va3Mtd3JpdGUiLCJvcmRlcnMtcmVhZCIsInByb2R1Y3RzLXJlYWQiLCJwcm9kdWN0cy13cml0ZSIsInB1cmNoYXNlcy1yZWFkIiwic2hpcHBpbmctY2FsY3VsYXRlIiwic2hpcHBpbmctY2FuY2VsIiwic2hpcHBpbmctY2hlY2tvdXQiLCJzaGlwcGluZy1jb21wYW5pZXMiLCJzaGlwcGluZy1nZW5lcmF0ZSIsInNoaXBwaW5nLXByZXZpZXciLCJzaGlwcGluZy1wcmludCIsInNoaXBwaW5nLXNoYXJlIiwic2hpcHBpbmctdHJhY2tpbmciLCJlY29tbWVyY2Utc2hpcHBpbmciXX0.ZhTfnKIxmuH3TvlRsdlq57inVhQhOQ5tgw2ukQ_whrb-IXkhDtnWZsCAe4-TxG7_x6pCGY5G3kNkPjz8pzAN2hYrKcecdrFU0u0PSJt8-QH7Nx0z6oSCPG7uDBV3oV5OrhcczRuvZFujblNqipo8Wg5o3jH-V0kqVUac88BdR9HaBCrrvBRKdDiBTTHgTUjkqZRVe8220DpL27dXEvN7Ct20jqiqMqdu-uU2GfTYt3JOvpJErG6jb11a8l61RUNDy5sj-zmQyM4Hb5ugxBNbxj1C384nWG-NjrZHDkoU7ybKdjkfgFQOLbEPTINPTH3WAlHCDdb-2cuU32WN9izo_vcBMLRYBoa4NjllP5S3X45TR-d7adBbfAWlFr9dQBjhjoSOUb4PCEag0yPlI3vgFJe9vYdcRoU78Py7neHX-icFSxU51ymLu7GktoeDlHiJ40549mDoc9YvIwqMOLxwp2w0PUb6yT_2Zg6X3I-vcyHYr7B_jKKarPXEPfGcDbeb66YgiTGSpkxi2W2D7BQSgkrtoHS5fJdSgUlN_546OwCEGx0XcIPZGNbk0VWoMN4hXKHkg0X4uBW9ulhgKqJD_F1pQ-wxdl0sSVGLTfuEF50hDmSnTgnPnTJg4hNsS8prZ_y9VKeRzl1CaQYcgcBW_quiYCQQjVnpOpbXGnRPtxI";
                }
                
                if(!Yii::app()->params['local']){
                    $recordset['token'] = PreferencesUtils::getAttributes('melhorenvio_token', 'descricao'); 
                    $recordset['refresh'] = PreferencesUtils::getAttributes('melhorenvio_token_refresh', 'descricao');
                    $recordset['expira'] = PreferencesUtils::getAttributes('melhorenvio_token_expira', 'texto');
                }
            }
            
            if($recordset && isset($data['callback'])) return $recordset[$data['callback']];
            return $recordset;            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: BkBankManager - getSettings()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - getSettings()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /*
     * Renew token
     * Each day checks expira token
     * 
     * @params array
     * 
     */
    public function renewToken(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
            
        try{  
            $session = MethodUtils::getSessionData();
            //if($session['me_tk_refresh'] != '') return false;
            
            $recordset['expira'] = PreferencesUtils::getAttributes('melhorenvio_token_expira', 'texto');
            
            $exp = strtotime($recordset['expira']);  $refre = strtotime(date('Y-m-d'). ' - 2 days');
            
            //echo $recordset['expira'] . "($exp)" . ' - ' . date('Y-m-d', strtotime(date('Y-m-d'). ' - 2 days')) . "($refre)";
            
            if($exp >= $refre){ //Dois dias a menos
                $recordset['refresh'] = PreferencesUtils::getAttributes('melhorenvio_token_refresh', 'descricao');
                $update = $this->tokenRequest(array('refresh_token' => $recordset['refresh'], 'query' => 'refresh'));
                $set = $this->saveSettings(array('query' => 'token', 'token' => json_decode($update, true)));
            }
            
            $set = MethodUtils::setSessionData('me_tk_refresh', 1);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: BkBankManager - renewToken()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - BkBankManager - renewToken()', 'trace' => $e->getMessage()), true);
        }
    }


}

?>