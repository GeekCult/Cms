<?php

/**
 * Description of MethodUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class MethodUtils {

    
    /**
     * Método para obter os dados do usuário logado
     *
     */
    public static function getSessionData() {
        $session = new CHttpSession;
        $session->open();
        $data = $session;
        if($data['device'] == "")$data['device'] = "desktop";
        $session->close();
        return $data;
    }
    
    /**
     * Método para obter os dados do usuário logado
     *
     */
    public static function setSessionData($label, $data) {
        $session = new CHttpSession;
        $session->open();
        $session[$label] = $data;
        $session->close();
        return true;
    }

    /**
     * Método para limpar completamente uma session
     *
     */
    public static function cleanSessionData($args = false) {
        $session = new CHttpSession;
        $session->open();
        if (!$args) $session = array();
        else {
            foreach ($args as $key=>$value){
                unset($session[$value]);
            }
        }
        $session->close();
    }
    
    /**
     * Método para limpar completamente uma session
     *
     */
    public static function cleanSessionDataByCategory($value) {
        $session = new CHttpSession;
        $session->open();        
   
        for($i = 0; $i < 1000; $i++){
            unset($session[$value . $i]);
        }
    
        $session->close();
    }
    
    /**
     * Método para limpar todos dados previamente definidos
     *
     */
    public static function clearAllCache(){
        
        $args = array('SES_home', 'SES_contato', 'SES_blog', 'SES_eventos', 'SES_agenda', 'SES_materias', 'SES_pref', 'SES_conteudo', 'SES_', 'SES_TSITE', 'SES_paginasavancadas',
                      'SES_produtos', 'SES_conta', 'SES_trabalheconosco', 'SES_sejafornecedor', 'SES_loja', 'SES_intro', 'SES_ecommerce_details', 'SES_produtos_detalhes', 'SES_app', 'SES_pesquisas');
        $clear = MethodUtils::cleanSessionData($args);
        $clear = MethodUtils::cleanSessionDataByCategory('SES_ADS_');
        $clear = MethodUtils::cleanSessionDataByCategory('SES_ROWS_');
        
    }
    
    /**
     * Método para limpar os dados previamente definidos
     *
     */
    public static function cleanSessionDataByArgs(){
        
        $args = array('SES_home', 'SES_contato', 'SES_pref');
        MethodUtils::cleanSessionData($args);
    }
    
    /**
     * Método para limpar os banners setados previamente.
     * BugFix para banners selcionados onde os novos não limpam
     * os antigos, apenas append it!
     *
     *
     */
    public static function clearBannersOnStage() {
        $session = new CHttpSession;
        $session->open();
        $session['PPBannersIds'] = "";
        $session['keywords'] = "";
        $session->close();
        return true;
    }

    /**
     * Método para enviar um email
     *
     * @param array
     *
     * @return bool|string
     */
    public static function sendEmail($arr) {
        
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
        $emailHandler = new EmailManager();  

        $data_message['nome'] =  $arr['nome'];                   
        $data_message['email'] =   $arr['email'];
        $data_message['mensagem'] = $arr['message'];
        $data_message['layout'] =  $arr['layout'];//"indique_amigo_common";
        $data_message['tipo'] =  $arr['tipo_mensagem'];//"indique_amigo";
        $data_message['newsletter'] = false;

        $sendController = $emailHandler->submitSubscription($data_message);
        return $sendController;
    }
    
    /* 
     * Check time action
     * Check if a determined action has been trigger at a specified time
     * 
     * @param number
     * 
     */
    public static function checkTimeAction($action, $seconds = 10, $math = 'sub'){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();
       
        try{
            $time = date("Y-m-d H:i:s");
            $check = DateTimeUtils::addTimeToDate($time, 0, 0, 0, 0, 0, $seconds, $math);//add or sub
            
            //Verifica se o valor na sessão é vazio ou maior igual ao ultimo definido
            if($session[$action] == '' || strtotime($session[$action]) <= strtotime($check)) {
                $set = MethodUtils::setSessionData($action, $time);
                return false;

            }else{
                return true;
            }
           
         }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: MethodUtils - checkTimeAction() ".$e->getMessage();
        } 
    }

    /**
     * Método para enviar um email
     *
     * @param array
     * @param bool $isOwner
     */
    public static function sendEmailDirectly($data_message, $isOwner = true) {
        
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');
        $emailHandler = new EmailManager();  

        $sendController = $emailHandler->submitSubscription($data_message, $isOwner);
        return $sendController;
    }

    /**
     * Método para enviar um email de pedido ou interesse de usuário
     * utiliza o método universal submitSubscription.
     *
     * @param array
     * @param bool $isOwnerNeeded
     * @return bool|string
     */
    public static function sendOrder($data_message, $isOwnerNeeded = true) {
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');       
        $emailHandler = new EmailManager();
        $sendController = $emailHandler->submitSubscription($data_message, $isOwnerNeeded);
        return $sendController;
    }
    
    /**
     * Método para enviar um email para o WebMaster - PurplePier
     *
     * @param array
     */
    public static function sendError($data, $isOwnerNeeded = false) {
        Yii::import('application.extensions.dbuzz.site.email.EmailManager');   
        Yii::import('application.extensions.utils.DateTimeUtils');   
        $emailHandler = new EmailManager();
        
        //Send an email when a new error is found
        $data['layout'] = "content_general";
        $data['newsletter'] = false;
        $data['tipo'] = "error";
        $data['titulo_mensagem'] = "ERROR - PurplePier" ;
        $data['mensagem'] = '<b>'.$data['message'] . "</b><br/><br/> ERROR: " . $data['trace'];
        $data['nome'] = "http://" . $_SERVER['SERVER_NAME'];
        $data['email'] = "publicidade.exe@gmail.com";
        $data['time'] = DateTimeUtils::getDateFormate(date("Y-m-d H:i:s"));
        
        $sendController = $emailHandler->submitSubscription($data, $isOwnerNeeded);
        return $sendController;
    }
    
    /**
     * Random Password
     * It sorts a number betweem the elemnts bellow
     * It's used prepare a password.
     * 
     */
    public static function getRandomPassword($type = "") {
        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $cde = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $num = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $sufixo_new_1 = $abc[rand(0,25)];
        $sufixo_new_2 = $num[rand(0,9)];
        $sufixo_new_3 = $cde[rand(0,25)];
        
        $sufixo_new_4 = $abc[rand(0,25)];
        $sufixo_new_5 = $num[rand(0,9)];
        $sufixo_new_6 = $cde[rand(0,25)];
        
        $sufixo_new_7 = $abc[rand(0,25)];
        $sufixo_new_8 = $num[rand(0,9)];
        $sufixo_new_9 = $cde[rand(0,25)];
        
        $sufixo_new_10 = $abc[rand(0,25)];
        $sufixo_new_11 = $num[rand(0,9)];
        $sufixo_new_12 = $cde[rand(0,25)];
        
        $sufixo_new = $sufixo_new_1 . $sufixo_new_2 . $sufixo_new_3 . $sufixo_new_4 . $sufixo_new_5 . $sufixo_new_6;
        if($type == "creditos") $sufixo_new = $sufixo_new_1 . $sufixo_new_2 . $sufixo_new_3 . $sufixo_new_4 . $sufixo_new_5 . $sufixo_new_6 . $sufixo_new_7 . "-". $sufixo_new_8 . $sufixo_new_9 . $sufixo_new_10. $sufixo_new_11 ;
        return $sufixo_new;
    }
    
    /**
     * Método para obter o tipo do device que o usuário está editando no momento
     * O default é desktop
     *
    **/
    public static function getDeviceType(){        
        $session = new CHttpSession;
        $session->open();
        $type = $session['device'];
        $session->close();
        
        if($type == "") $type = "desktop";      
        
        return $type;
    }
    
    /**
     * Método para obter a preferencia do device, se o usuário deseja
     * utilizar o layout padrão para tudo ou o layout exclusivo para cada 
     * device, mobile e tablet.
     *
    **/
    public static function getDevicePreference(){      
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $preferenceSmartphone = PreferencesUtils::getAttributes("dispositivo_smartphone");
        $preferenceTablets = PreferencesUtils::getAttributes("dispositivo_tablet");
        
        //Set default
        $device = "desktop";  
        $deviceVisit = "desktop";
        $deviceString = strtolower($_SERVER['HTTP_USER_AGENT']);           

        //Se android verifica se é tablet ou smartphone
        if(stripos($deviceString,'android') !== false){
        if(stripos($deviceString,"mobile")){
                $deviceVisit = "mobile";
                if($preferenceSmartphone) $device = "mobile";
            }else{
                $deviceVisit = "tablet";
                if($preferenceTablets) $device = "tablet";
            }
        }

        if(stripos($deviceString,'ipad') !== false){
            $deviceVisit = "tablet";
            if($preferenceTablets) $device = "tablet";
        }

        if(stripos($deviceString,'iphone') !== false || stripos($deviceString,'ipod') !== false){
            $deviceVisit = "mobile";
            if($preferenceSmartphone) $device = "mobile";
        }
        
        //Set the device in focus
        $setSession = MethodUtils::setSessionData("plataforma", $device); 
        $setSession = MethodUtils::setSessionData("device", $deviceVisit);        
             
        return $device;
    }
    
    /**
     * Método que retorna o boolean em number
     * Se 0 é false se 1 é true
     *
     * NAO HA NECESSIDADE DESSE METODO
     * E POSSIVEL PEGAR O NUMERO DO BOOLEAN FAZENDO TYPE CASTING
     **/
    public static function getBooleanNumber($boolean){ 
        
        switch($boolean){
            case false: 
            //case 0: Fucking Problem
            case "":
            case "false":
            case "nao":
            case "undefined":
                $number = 0;
                break;

            case "on":
            case "sim":
            case true:
            case "true":
            //case 1: Fucking Problem
                $number = 1;
                break;
        } 
        return $number;
    }
    
    /**
     * Set cookies
     * General method to set that.
     * Remember: Time machine can be wrong so set the cookie some hours 
     * after current time;
     * 
     * @string
     * @string
     * @number
     *
    **/
    public static function setCookie($name, $param, $time){
        try{  
            
            $doCookie = new CHttpCookie($name, $param);
            $doCookie->expire = time() + $time;
            Yii::app()->request->cookies[$name] = $doCookie;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        } 
    }
    
    /**
     * Get Error message
     * General method to get error customized messages.
     * 
     * @number
     *
    **/
    public static function getErrorMessage($code){
        
        Yii::import('application.extensions.utils.ErrorUtils');
        $messageError = ErrorUtils::getErrorMessage($code);
        
        return $messageError;
    }

    /**
     * Set an activity
     * It uses an utils class to support to this action.
     *
     * @param array
     */
    public static function setActivityRecent($data){
        
        Yii::import('application.extensions.utils.ActivityUtils');
        $setActivity = ActivityUtils::setActivityRecent($data);
        return $setActivity;
    }
    
    /**
     * Update an activity
     * It uses an utils class to support to this action.
     *
     * @param array
     */
    public static function updateActivityRecent($data){
        
        Yii::import('application.extensions.utils.ActivityUtils');
        $setActivity = ActivityUtils::updateActivity($data);
        return $setActivity;
    }
    
    /**
     * Retrieve the cookie with the specified name PPGuest
     * If that cookie was set previously or its expiration's time
     * is not expired yet, it ignores the request
     * 
     */
    public static function verifySiteAlreadyVisited(){
        
        $session = MethodUtils::getSessionData();
        $device = $session['device'];
       
        $cookie_name = "PPGuest_" . $device;
        $cookie = false;
        if(isset(Yii::app()->request->cookies[$cookie_name])) $cookie = Yii::app()->request->cookies[$cookie_name];
       
        if(!$cookie){
            ActivityLogger::log("primeiro acesso do usuário", 'visitante_unico');
            //Set cookie to avoid unncessary records
            Yii::import('application.extensions.utils.ContadorVisitasUtils');        
            $addVisit = ContadorVisitasUtils::setVisit($device);
            //setcookie("PPGuest_" . $device, "visited", time()+2600);
            Yii::app()->request->cookies["PPGuest_" . $device] = new CHttpCookie("PPGuest_" . $device, "visited", array('expire'=> time()+2600));
        }
        
        return true;
    }
    
    /**
     * Retrieve the keywords queued.
     * This method must be separated and added into a specific
     * class, initialy it's here.
     * 
     */
    public static function getKeywordsQueued($tipo = "keywords"){
       
        //Get the last record
        $select = "id, tipo, descricao";
        $sql = "SELECT ".$select." FROM activity_server WHERE tipo = '$tipo' AND status = 0";
        
        $command = Yii::app()->db->createCommand($sql);        
        $recordset = $command->queryRow();
        
        if($recordset){
            //Set this record as viewed 
            $values = "status = '1'";
            $sql2 =  "UPDATE activity_server SET ". $values ." WHERE tipo = '$tipo' AND id = ". $recordset['id']. "";
            $comando = Yii::app()->db->createCommand($sql2);
            $control = $comando->execute();
        }else{
            //Set this record as viewed 
            $values = "status = '0'";
            $sql2 =  "UPDATE activity_server SET ". $values ." WHERE tipo = '$tipo'";
            $comando = Yii::app()->db->createCommand($sql2);
            
            $control = $comando->execute();
            
            //Double check, since all recordas were set to status 0
            $recordset = $command->queryRow();
        }    
        
        return $recordset['descricao'];
        
    }
    
    
    /**
     * Retrieve the id user from the PageName.
     * This page name is something like http://www.purplepier.com.br/CarlosGarcia.
     * 
     */
    public static function getIdUserByPageName($name){
        $sql = "SELECT id_user FROM paginas_data WHERE label = '$name'";
        
        $command = Yii::app()->db->createCommand($sql);        
        $recordset = $command->queryRow();
        return $recordset['id_user'];
    }
       
    /**
     * Método para setar uma nova acao, pode ser uma busca, um acesso de usuário
     * a conta dele e etc
     *
     * @param string
     * @param string
     *
    */
    public static function setActionDone($tipo, $descricao){
        
        $session = MethodUtils::getSessionData();
        
        date_default_timezone_set("Brazil/East");
        $date = date("Y-m-d H:i:s");
        
        $sql =  "INSERT INTO general_contador_items (plataforma, tipo, date, date_simple, descricao, num) VALUES ('".$session['plataforma']. "', '$tipo', '$date', '$date', '$descricao', 1)";
        
        $comando = Yii::app()->db->createCommand($sql);
        $control = $comando->execute();
        
        return $control;
    }
    
    /**
     * Método para checar se a ação foi realizada e printar na tela
     * 
     * @param array
     *
    */
    public static function returnMessage($data){
        
        if(!isset($data['message'])) $data['message'] = $data['mensagem'];
        
        if(!$data['result']){
            if(isset($data['error'])){
                if($data['error'] != ""){
                    if(isset($data['message_erro'])){
                        $data['message'] = $data['message_erro'];
                    }
                    $data['message'] = Yii::t("messageStrings", "message_result_error");
                }
            }else{
                $data['message'] = Yii::t("messageStrings", "message_result_not_altered");
                $data['error'] = "Not completed";
            }   
            
            
        }else{
            $data['error'] = 0;
        }
        
        if(!isset($data['extra'])) $data['extra'] = ""; 
        $result = array("result" => $data['result'], "message" => $data['message'], "error" => $data['error'], "extra" => $data['extra']);
        echo json_encode($result);
    }
    
    /**
     * Método para setar e retornar os date filters, como mês, ano e dia
     * Aplica as alterações no result e retorno 
     *
     *
    */
    public static function setDateFilter($data, $type = null){ 
        
        $session = MethodUtils::getSessionData();
        
        //Set month
        if($session['month_' . $type] == '') {
            $setSession = MethodUtils::setSessionData('month_' . $type,  date('m'));
            $data['month'] = date('m');
            
        }else{
            $data['month'] = $session['month_' . $type];
        }
        
        //Set year
        if($session['year_' . $type] == '') {
            $setSession = MethodUtils::setSessionData('year_' . $type,  date('Y'));
            $data['year'] = date('Y');
            
        }else{
            $data['year'] = $session['year_' . $type];
        }
        
        return $data;
    }
    
    /**
     * Método para definir os atributos da paginação 
     *
     *
    */
    public static function getPaginationAttributes($data, $type){
        
        Yii::import('application.extensions.utils.special.PaginacaoUtils');
        
        //$session = MethodUtils::getSessionData();
        
        $info = PaginacaoUtils::getPaginationInfo($data, $type);
        $qtd_rows = 10;
        
        // Index que está selecionado
        $paginacao['ind'] = $data['ind'];
        if($data['ind'] == '') $paginacao['ind'] = 1;
        
        //Commons attributes
        $paginacao['items'] = $info['items'];
        $paginacao['link'] = $info['link'];
        
        //More information about the records
        ($data['ind'] != 0) ? $pages = $data['ind'] : $pages = 1;
        $paginacao['total'] = $info['total'];
        $paginacao['total_records'] = $info['total'];
        $paginacao['total_records_viewed'] = $qtd_rows * $pages;
        
        //Begin - initial pagination number
        $paginacao['begin'] = $paginacao['ind'];
        if($paginacao['begin'] == '') $paginacao['begin'] = 1;
       
        if($info['items'] <= 5 || $paginacao['ind'] <= 4){
            $paginacao['begin'] = 1;
        }else if($paginacao['ind'] == 5 && $info['items'] >= 5){
             $paginacao['begin'] = 2;
        }else{
             $paginacao['begin'] = $paginacao['ind'] - 3;
        }

        //Final - last number item
        $paginacao['final'] = $info['items'];
        if($info['items'] > 5) {
            if($paginacao['ind'] >= 5){
                $paginacao['final'] = $paginacao['begin'] + 4;
            }else{
                $paginacao['final'] = 5;
            }
        }
        
        if($type == 'ecommerce' || $type == 'produtos_simples' || $type == 'produtos_admin' || $type == 'autos_admin' || $type == 'autos') $paginacao['isGet'] = true;
        if(isset($info['isGet']) && $info['isGet']) $paginacao['isGet'] = true;
        if(isset($info['extra'])){$paginacao['extra'] = $info['extra'];}else{$paginacao['extra'] = "";}
        
        return $paginacao;
        
    }
    
    /**
     *
     * Update Site Json database infos
     *
     */
    public static function updateDominioData(){
        
        Yii::import('application.extensions.utils.admin.JsonSiteUtils');
        
        $session = MethodUtils::getSessionData();

        try{ 
            
            //Se for minisite não salva jSon
            if($session['miniSiteUser'] != '') return true;
            
            if(defined('Settings::PIER_TURBO') && Settings::PIER_TURBO){
                $content = JsonSiteUtils::updateDominioData();
                return $content;
            }            
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - updateDominioData() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Update MiniSites Settings
     * It update JSON and CSS
     * 
     * @param $string
     *
     */
    public static function updateMiniSites($tipo = 'both'){
        
        Yii::import('application.extensions.utils.special.MIniSitesUtils');           

        try{           
            if($tipo == 'both' || $tipo == 'settings') $content = MIniSitesUtils::createSettingsFile();
            if($tipo == 'both' || $tipo == 'css') $content = MIniSitesUtils::updateCSS();
            
            return $content;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - updateMiniSettings() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Update MiniSites Settings
     * It update JSON and CSS
     * 
     * @param $string
     *
     */
    public static function setActivityServer($tipo, $id_general, $name, $value, $id_page = 0){
        
        Yii::import('application.extensions.utils.ActivityUtils');           

        try{ 
            $content = ActivityUtils::manageActivityServer($tipo, $id_general, $name, $value, $id_page);

            return $content;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - setActivityServer() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Get Preference attributes
     * 
     * @param $string
     *
     */
    public static function getPreferenceAttributes($attribute, $type = "texto", $plataforma = 'desktop'){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');           

        try{ 
            $content = PreferencesUtils::getAttributes($attribute, $type, $plataforma);
            return $content;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - getPreferenceAttributes() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Update MiniSites Settings
     * It update JSON and CSS
     * 
     * @param $string
     *
     */
    public static function updateSettingsFile($tipo = 'both'){
        
        Yii::import('application.extensions.utils.special.SettingsFileUtils');           

        try{           
            $content = SettingsFileUtils::updateSettingsFile();
            
            return $content;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - updateSettingsFile() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Uses this method to print a JSON more Human readable
     * Uses also a nl2br();
     * 
     * See example below
     * echo nl2br(MethodUtils::prettyPrintJSON(json_encode($recordset)));
     * 
     * @param json
     *
     */
    public static function prettyJson ($json, $isArray = true) {
        
        if($isArray) $json = json_encode ($json);
        $result      = '';
        $pos         = 0;
        $strLen      = strlen($json);
        $indentStr   = '  ';
        $newLine     = "\n";
        $prevChar    = '';
        $outOfQuotes = true;
        
        try{ 
            for ($i=0; $i<=$strLen; $i++) {

                // Grab the next character in the string.
                $char = substr($json, $i, 1);

                // Are we inside a quoted string?
                if ($char == '"' && $prevChar != '\\') {
                    $outOfQuotes = !$outOfQuotes;

                // If this character is the end of an element,
                // output a new line and indent the next line.
                } else if(($char == '}' || $char == ']') && $outOfQuotes) {
                    $result .= $newLine;
                    $pos --;
                    for ($j=0; $j<$pos; $j++) {
                        $result .= $indentStr;
                    }
                }

                // Add the character to the result string.
                $result .= $char;

                // If the last character was the beginning of an element,
                // output a new line and indent the next line.
                if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                    $result .= $newLine;
                    if ($char == '{' || $char == '[') {
                        $pos ++;
                    }

                    for ($j = 0; $j < $pos; $j++) {
                        $result .= $indentStr;
                    }
                }

                $prevChar = $char;
            }

            return nl2br($result);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - prettyPrintJSON() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Set Ping into BigData
     * 
     * @param $string
     *
     */
    public static function setPing($titulo, $tipo, $descricao = ""){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        $purplePierManager = new PurplePierManager();
        
        $session = MethodUtils::getSessionData();

        try{           
            $ping = array('titulo' => $titulo, 'descricao' => $descricao, 'tipo' => $tipo, 'plataforma' => $session['device']);
            $setPing = $purplePierManager->setPing($ping);
            
            return $setPing;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - setPing() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Validate fields
     * 
     * @param $string
     *
     */
    public static function validateFields($content = array(), $errors = array()){
        
        $result = array();
        
        $p = 0;
        for($i =0; $i < count($content); $i++){
            if($content[$i] == ''){            
                $result['STATUS'] = 0;
                $result['ERROR'][$p]['ERROR_MSG'] = Yii::t('errorStrings', 'missing_' . $errors[$i]);
                $p++;
            }  
        }
        
        if(isset($result['STATUS']) && $result['STATUS'] == 0){
            echo json_encode($result);
            return false;
        }else{
            return true;
        }
        
    }
    
    /**
     *
     * Check permission
     * 
     * @param booleand
     *
     */
    public static function checkPermission($isAdmin = false){
        
        $session = MethodUtils::getSessionData();
        if($session['user_account_type'] == 2 || Yii::app()->params['local'] == 1) return true;

        try{           
            if( $isAdmin) CController::redirect('/admin/permissao_negada');
            if(!$isAdmin) CController::redirect('/site/permissao_negada');
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - checkPermission() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Get PurpleStore Componente
     * 
     * @param string
     *
     */
    public static function getComponentPurpleStore($tipo, $qtd = 1){
        
        Yii::import('application.extensions.dbuzz.site.special.PurpleStoreManager');        
        $purpleStoreHandler = new PurpleStoreManager();

        try{           
            return $purpleStoreHandler->getItem($tipo, $qtd);
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - checkPermission() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Get Admin information
     * 
     * @param string
     *
     */
    public static function getAllAdminInformation(){
        
        Yii::import('application.extensions.dbuzz.admin.special.CanalComunicacaoManager');        
        $canalHandler = new CanalComunicacaoManager();

        try{           
            $recordset['canal'] = $canalHandler->getAllMessagesInfo();
            
            return $recordset;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - getAllAdminInformation() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Request an information from PurplePier
     * 
     * @param number
     * @param string
     *
     */
    public static function requestPurplePier($id_user, $url){
        
        Yii::import('application.extensions.dbuzz.site.special.PurplePierManager');
        $purplePierHandler = new PurplePierManager();

        try{           
            $recordset = $purplePierHandler->requestClientInformation($id_user, $url);
            return $recordset;
               
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: MethodUtils - requestPurplePier() " . $e->getMessage();
        }
    }     
}
?>