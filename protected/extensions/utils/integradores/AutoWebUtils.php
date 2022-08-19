<?php

/**
 * Description of AutoWebUtils
 *
 *
 * @author CarlosGarcia
 * 
 */
class AutoWebUtils{

    /**
     * Organize Item
     * 
     * @param array
     *
    **/
    public static function organizeItem($data){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        //Yii::import('application.extensions.utils.integradores.IntegradorUtils');
        
        try{
            $result = array();
            if(isset($data->Modelo)) $result['nome'] = StringUtils::StringToLowerCase((string)$data->Modelo, "name");
            if(isset($data->Codigo)) $result['codigo'] = (string)$data->Codigo;
            if(isset($data->PrecoVenda)){ 
                $price = str_replace('.', '', (string)$data->PrecoVenda);
                $price = str_replace(',', '.', $price);
                $result['preco_real'] = (float)$price;
                
            }
            if(isset($data->Observacao)) $result['descricao'] = StringUtils::StringToLowerCase(str_ireplace('\n', '</br>', (string)$data->Observacao), "texto");
            
            if(isset($data->TipoVeiculo)){
                $result['id_categoria'] = Yii::app()->params['integrador_categoria'];
            }
            
            $filtros = array();
            
            //if(isset($data->UsadoNovo)) $filtros['n_u'] = IntegradorUtils::getCaracteristicas(array('tipo' => 'nu', 'texto' => StringUtils::StringToLowerCase($data->UsadoNovo, 'name'), 'callback' => 'id'));
            //if(isset($data->Combustivel)) $filtros['fuel'] = IntegradorUtils::getCaracteristicas(array('tipo' => 'fuel', 'texto' => StringUtils::StringToLowerCase($data->Combustivel, 'name'), 'callback' => 'id'));
            //if(isset($data->Cor)) $filtros['c_p'] = IntegradorUtils::getCaracteristicas(array('tipo' => 'cp', 'texto' => StringUtils::StringToLowerCase($data->Cor, 'name'), 'callback' => 'id'));
            //if(isset($data->Cambio)) $filtros['cmb'] = IntegradorUtils::getCaracteristicas(array('tipo' => 'cmb', 'texto' => StringUtils::StringToLowerCase($data->Cambio, 'name'), 'callback' => 'id'));
            
            if(isset($data->KM)) $filtros['klm'] = (string)$data->KM;
            if(isset($data->AnoFabricacao)) $filtros['ano'] = (string)$data->AnoFabricacao;
            
            $result['filtros'] = json_encode($filtros);
            $result['url'] = StringUtils::StringToUrl($result['nome'], true, '-');
            $result['date_start'] = '2020-01-01 23:59:59';
            $result['date_end'] = '2020-01-01 23:59:59';
            $result['data'] = date('Y-m-d h:m:s');
            $result['id_user'] = '54';
            $result['status'] = 0;
            $result['n_u'] = 0;
            $result['keywords'] = '';
            $result['preco'] = 0;
        
            //Fotos
            if(isset($data->Fotos)){
                $i = 1;
                //Minimo 10 fotos
                foreach ($data->Fotos->Foto as $foto){
                    //if($i == 1) var_dump($foto->Foto);
                    $result["slot$i"] = (string)$foto->URI;
                    //echo (string)$foto->Nome . "</br>";
                    $i++;
                }
            }
            
            //Se não tiver imagens define as variaveis
            if(!isset($result["slot1"])){  $result["slot1"] = ''; }
            if(!isset($result["slot2"])){  $result["slot2"] = ''; }
            if(!isset($result["slot3"])){  $result["slot3"] = ''; }
            if(!isset($result["slot4"])){  $result["slot4"] = ''; }
            if(!isset($result["slot5"])){  $result["slot5"] = ''; }
            if(!isset($result["slot6"])){  $result["slot6"] = ''; }
            if(!isset($result["slot7"])){  $result["slot7"] = ''; }
            if(!isset($result["slot8"])){  $result["slot8"] = ''; }
            if(!isset($result["slot9"])){  $result["slot9"] = ''; }
            if(!isset($result["slot10"])){ $result["slot10"] = '';}
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - AutoWebUtils - organizeItem()', 'trace' => $e->getMessage()), true);
            echo "ERROR: AutoWebUtils - organizeItem() ". $e->getMessage();            
        }
    }
    
    /*
     * 
     * Auth
     * 
     */
    public static function makeAuth($email, $password){
        
        try{
            $client = new RestClient("http://api.autonitro.com.br/api/TokenAuth/Authenticate");
            $request = new RestRequest(Method.POST);
            //request.AddHeader(&quot;Accept&quot;, &quot;application/json&quot;);
            //request.AddParameter(&quot;application/json&quot;, string.Concat(&quot;{\&quot;usernameOrEmailAddress\&quot;:\&quot;&quot;, email, &quot;\&quot;, \&quot;password\&quot;:\&quot;&quot;,
            //password, &quot;\&quot;}\n&quot;), ParameterType.RequestBody);
            //IRestResponse response = client.Execute(request);
            if ($response.StatusCode == HttpStatusCode.OK){
                //$bearerToken = JsonConvert.DeserializeObject&lt;dynamic&gt;(response.Content).result.accessToken.ToString());
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - ActivityUtils - makeAuth()', 'trace' => $e->getMessage()), true);
            echo "ERROR: ActivityUtils - makeAuth() ". $e->getMessage();            
        }
    }

    /*
     * Get Stock
     * 
     * params string
     * 
     */
    public static function getCurrentStoreSiteStock($bearerToken, $cnpj){
        
        $client = new RestClient("http://api.autonitro.com.br/api/services/app/StoreSite/GetStoreSiteXmlByCNPJ?cnpj=&quot; + $cnpj");
        $request = new RestRequest(Method.GET);
        //$request.AddHeader(&quot;Accept&quot;, &quot;application/json&quot;);
        $request.AddHeader("Authorization", "Bearer " + $bearerToken);
        $response = client.Execute(request);
        
        if ($response.StatusCode == HttpStatusCode.OK){
            $result = JsonConvert.DeserializeObject&lt;dynamic&gt;(response.Content).result.ToString();
            return $result;
        }
        
        
    }
        
    
}

?>