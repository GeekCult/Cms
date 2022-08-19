<?php

class RegistroAction extends CAction{
    
    private $action;
    private $id;

    /**
     * Registro
     * Special Action
     *
     */
    public function run(){
        
        $this->action = Yii::app()->getRequest()->getQuery('sub');
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        switch($this->action){
            
            case "":  
                $this->listar(); 
                break;
            
            case "whois":  
                $this->whois(); 
                break;
        }
    }
    
    /**
     * Show calendar
     * 
     * shows the publish options
     * remember that mktime will automatically correct if invalid dates are entered
     * for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
     * this provides a built in "rounding" feature to generate_calendar();
     *
     */
    public function listar(){
        
        require_once 'protected/extensions/vendors/registros/registrobr/Avail.php';
        
        $result = HelperUtils::getPageBundle(C::REGISTROS);

        $atrib = array(
            "lang"        => 1,            # EN (PT = 1)
            "server"      => SERVER_ADDR,
            "port"        => SERVER_PORT,
            "cookie_file" => COOKIE_FILE,
            "ip"          => "",
            "suggest"     => 0,            # No domain suggestions
        );
        
        if(isset($_REQUEST['dominio'])) $result['dominio'] = $_REQUEST['dominio'];
        if(isset($_REQUEST['dominio'])) $result['dominio_simples'] = explode("." , $_REQUEST['dominio']);
        if(isset($_REQUEST['dominio'])) $result['domain_info'] = $this->check_domain_availability("www.".$result['dominio'], $atrib);
        
        try{            
         
            $this->addScript($result);
            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/special/registros", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: RegistroAction - listar() " . $e->getMessage();
        }         
    }
    
    /**
     * Who IS
     * 
     */
    public function whois(){
        
        Yii::import('application.extensions.utils.APIUtils');
        
        $result = HelperUtils::getPageBundle(C::REGISTROS);
        
        if(isset($_REQUEST['dominio'])) $result['dominio'] = $_REQUEST['dominio'];
        if(isset($_REQUEST['extensao'])) $result['extensao'] = $_REQUEST['extensao'];
        if(isset($_REQUEST['dominio'])) $result['dominio_simples'] = explode("." , $_REQUEST['dominio']);
        
        if(isset($_REQUEST['dominio']))  $result['domain_info'] = json_decode(APIUtils::request('check_domain', array('dominio' => $result['dominio'], 'extensao' => $result['extensao'])), true);
        
        if(isset($_REQUEST['dominio'])){ $result['domain_available'] = 'unavailable';}
        if(isset($_REQUEST['dominio'])){ if(strpos($result['domain_info']['content'], 'Domínio inexistente:') !== false){$result['domain_available'] = 'available';}}
        if(isset($_REQUEST['dominio'])){ if(strpos($result['domain_info']['content'], 'Consulta inválida') !== false){$result['domain_available'] = 'invalid';}}

        if(isset($result['domain_info']['content'])) $result['domain_info']['content'] = $this->delete_all_between('% Problemas de segurança', 'CNPJ: 05.506.560/0001-36', $result['domain_info']['content']);
        
        try{       
            $this->addScript($result);
            $this->controller->layout = "site/index";
            $this->controller->render("/site/pages/special/registros_whois", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: RegistroAction - listar() " . $e->getMessage();
        }         
    }
    
    /*
     * Check a domain availability
     * 
     */
    public function check_domain_availability($fqdn, $parameters) {
        
        $client = new AvailClient();
        $client->setParam($parameters);
        $response = $client->send_query($fqdn);
        
        return $response;
    }
    
    /*
     * Check a domain whois
     * 
     */
    public function check_br_whois( $url, $array_fields ){
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "PHP Whois/Curl script", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => http_build_query($array_fields),
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;

        // the return is a webpage... stripping useless data (menu, links) and trim it...
        $trim_content = substr($content, strpos($content, '% Copyright'));

        return array('header' => $header, 'content' => trim(strip_tags(utf8_encode($trim_content))));
    }
    
    public function delete_all_between($beginning, $end, $string) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
          return $string;
        }

        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        return str_replace($textToDelete, '', $string);
    }
    
    
    /**
     * Method responsible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($result){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCssFile($baseUrl . "/css/site/layout/layout_{$result['layout']['layout_site']}.css", 'screen', CClientScript::POS_HEAD);
        $cs->registerCssFile($baseUrl . '/css/site/modulos/artigo/registros.css', 'screen', CClientScript::POS_HEAD); 
        
        //Dublin Core and Metadata
        require_once Yii::app()->basePath . '/extensions/vendors/resources/meta_data.php';
        require_once Yii::app()->basePath . '/extensions/vendors/resources/dublin_metatags.php';
 
    }
}
?>
