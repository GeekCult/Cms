<?php

/**
 * Description of UserUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class UserUtils {

    /**
     * Método para retornar o nome e sobrenome do usuário
     *
     * @param number
     * @return string
     */
    public static function getUserById($id_user = NULL, $isFull = false, $data = array()) {
        
        if ($id_user == NULL || $id_user == "") $id_user = 0;
        
        $session = MethodUtils::getSessionData();
        $obiz = HelperUtils::getObiz();
        //if($session["cache_user_{$id_user}"] != '' && !isset($data['ignore_cache'])) return $session["cache_user_{$id_user}"];
        
        try {
            if(!$obiz) $select = "id, field1, field2, type, email, account_states_id, birthday, account_locked, avatar, cidade, emails_extra, status, company, frase, extra_5, reputation";
            if( $obiz) $select = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, type, AES_DECRYPT(email, {$obiz['serial']}) AS email, account_states_id, AES_DECRYPT(birthday, {$obiz['serial']}) AS birthday, account_locked, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, emails_extra, status, company, AES_DECRYPT(frase, {$obiz['serial']}) AS frase, extra_5, reputation";
            $sql = "SELECT $select FROM user_data WHERE id = $id_user";
            if(isset($data['query']) && $data['query'] == 'simples') $sql = "SELECT id, email, type, field1, field2, emails_extra FROM user_data WHERE id = $id_user";
            
            MethodUtils::setSessionData('checkAction', $sql);

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if(!$isFull && $recordset){
                $user = "";                
                if ($recordset['type'] != '1') $user = $recordset['field1'] . " " . $recordset['field2'];
                if ($recordset['type'] == '1') $user = $recordset['field1'];
                if ($recordset['company'] != '' && $recordset['company'] != '0') $user = $recordset['company'];
                
                $recordset = $user;
            }
            
            if( $isFull && $recordset){

                if ($recordset['type'] == 0 || $recordset['type'] == 2 || $recordset['type'] == 3) $recordset['nome'] = $recordset['field1'] . " " . $recordset['field2'];
                if ($recordset['type'] == 1) $recordset['nome'] = $recordset['field1'];                
                
                $set = MethodUtils::setSessionData("cache_user_{$id_user}", $recordset);
            }
            
            if(isset($data['callback']) && $recordset) return $recordset[$data['callback']];
            return $recordset;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserById() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getUserById() " . $e->getMessage();
        }
    }

    /**
     * Método para retornar os dados completos do usuário
     * 
     * @param number
     *
     */
    public static function getUserFullById($id_user = NULL, $isPurple = false, $data = array()) {
        
        if ($id_user == NULL || $id_user == "") $id_user = 0;
        $session = MethodUtils::getSessionData();
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        //if(isset($data['cache'])){if($session["user_{$data['cache']}_$id_user"] != '') return $session["user_{$data['cache']}_$id_user"];} 
        
        try {
            $obiz = HelperUtils::getObiz();
            
            if(!$obiz) $sql = "SELECT * FROM user_data WHERE id = $id_user ";
            if( $obiz) $sql = "SELECT *, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(documento, {$obiz['serial']}) AS documento, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, AES_DECRYPT(birthday, {$obiz['serial']}) AS birthday, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(frase, {$obiz['serial']}) AS frase, AES_DECRYPT(name_full, {$obiz['serial']}) AS name_full, AES_DECRYPT(bairro, {$obiz['serial']}) AS bairro, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, AES_DECRYPT(estado, {$obiz['serial']}) AS estado, AES_DECRYPT(json, {$obiz['serial']}) AS json FROM user_data WHERE id = $id_user ";
            
            if(isset($data['query']) && $data['query'] == 'simples') $sql = "SELECT field1, field2, email, type, avatar FROM user_data WHERE id = $id_user";
            if(isset($data['query']) && $data['query'] == 'cobranca') $sql = "SELECT id, field1, field2, email, type, dominio, vencimento, emails_extra FROM user_data WHERE id = $id_user";
            if(isset($data['ramo_atuacao']) && $data['ramo_atuacao'] != '0') $sql = "SELECT * FROM user_data WHERE id = $id_user AND ramo_atuacao = {$data['ramo_atuacao']}";
            
            MethodUtils::setSessionData('checkAction', $sql);

            if(!$isPurple) $command = Yii::app()->db->createCommand($sql);
            if( $isPurple) $command = Yii::app()->db4->createCommand($sql);
            
            $recordset = $command->queryRow();

            if ($recordset && (isset($recordset['birthday']) && $recordset['birthday'] != null)){ $recordset['birthday_format'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['birthday']); $recordset['birthday_string'] = $recordset['birthday_format'];}
            if ($recordset) $recordset['name'] = UserUtils::getNameUser($recordset['field1'], $recordset['field2'], $recordset['type']);
            if ($recordset) $recordset['nome'] = $recordset['name'];
            
            if ($recordset && isset($recordset['lance_format'])) $recordset['lance_format'] = CurrencyUtils::getPriceFormat($recordset['lance'], true, false);
            if ($recordset && isset($recordset['account_states_id'])) $recordset['account_status'] =  StatusUtils::getTypeStringToIcon($recordset['account_states_id']);
            if ($recordset && isset($recordset['account_locked'])) $recordset['account_locked_string'] =  UserUtils::getLocked($recordset['account_locked']);
            if ($recordset && isset($recordset['json'])) $recordset['json'] = json_decode($recordset['json'], true);
            
            //Account info
            if ($recordset && isset($recordset['account_states_id'])) $recordset['account_states_id_string'] =  UserUtils::getSituation($recordset['account_states_id']);
            if ($recordset && isset($recordset['creation'])) $recordset['creation'] =  DateTimeUtils::getDateFormateNoTime($recordset['creation']);
            if ($recordset) $recordset['type_name'] = UserUtils::getUserTypeString($recordset['type']);
           
            //Infos
            if ($recordset) $estado_civil = UserUtils::getAttribute('usuario_EstadoCivil', 'inteiro', $id_user);
            if ($recordset) $recordset['estado_civil'] = UserUtils::getEstadoCivilById($estado_civil);
            if ($recordset) $recordset['estado_civil_id'] = $estado_civil;
            if ($recordset) $recordset['sexo'] = UserUtils::getAttribute('usuario_Sexo', 'texto', $id_user, false, false, false, array('obiz' => $obiz));
            
            //Profissao
            if ($recordset) $recordset['profissao'] = UserUtils::getAttribute('profissao_profissional', 'texto', $id_user);
            if ($recordset) $recordset['profissao_id'] = UserUtils::getAttribute('usuario_Profissao', 'inteiro', $id_user);            
            
            //Redes Sociais
            if(isset($data['rede_sociais'])){
                if ($recordset) $recordset['facebook'] = UserUtils::getAttribute('facebook', 'texto', $id_user);
                if ($recordset) $recordset['twitter'] = UserUtils::getAttribute('twitter', 'texto', $id_user);
                if ($recordset) $recordset['google_plus'] = UserUtils::getAttribute('googlePlus', 'texto', $id_user);
                if ($recordset) $recordset['linkedin'] = UserUtils::getAttribute('linkedIn', 'texto', $id_user);                
            }
            
            //Profissional
            if(isset($data['profissional'])){
                if ($recordset) $recordset['profissao_atividades'] = UserUtils::getAttribute('outros_profissional', 'descricao', $id_user);
                if ($recordset) $recordset['profissao_formacao'] = UserUtils::getAttribute('formacao_profissional', 'descricao', $id_user); 
                if ($recordset) $recordset['profissao_descricao'] = UserUtils::getAttribute('descricao_profissional', 'descricao', $id_user); 
            }
            
            //Contatos
            if(isset($data['contatos'])){
                if ($recordset) $recordset['contato'] = UserUtils::getUserContacts($id_user, $recordset['type_name'], array('pais' => $recordset['pais']));                
            }
            
            //Endereco
            if(isset($data['endereco'])){
                if ($recordset) $recordset['endereco'] = UserUtils::getAddress($id_user, $data['endereco_type']);                
            }
            
            //Integradores
            if(isset($data['integradores'])){
                if ($recordset) $recordset['integradores'] = UserUtils::getIntegradores($id_user);                
            }
            
            //Documentos
            if(isset($data['documentos'])){
                if ($recordset) $recordset['documentos'] = UserUtils::getDocuments($id_user, $recordset['type_name']);                
            }
                   
            //Cache
            if(isset($data['cache'])){ $set = MethodUtils::setSessionData("user_{$data['cache']}_$id_user", $recordset);} 
            
            return $recordset;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserFullById() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getUserFullById() " . $e->getMessage();
        }
    }

    /**
     * Método para retornar os aniversariantes do mês
     * 
     *
     */
    public static function getBirthdays() {
        
        Yii::import('application.extensions.utils.users.UserUtils');
        
        try {
            $select = "id, field1, field2, avatar, frase, email, birthday, type";
            $sql = "SELECT $select FROM user_data WHERE type != 1 AND MONTH(birthday) = MOD(MONTH(CURDATE()), 12)";
            
            MethodUtils::setSessionData('checkAction', $sql);

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if ($recordset) {
                for($i = 0; $i < count($recordset); $i++) {
                    $recordset[$i]['isEmployee'] = UserUtils::getAttribute("funcionario", "texto", $recordset[$i]['id']);
                }
            }

            return $recordset;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getBirthdays() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getBirthday" . $e->getMessage();
        }
    }

    /**
     * Método para retornar os aniversariantes do mês
     * 
     *
    */
    public static function getSocialNetworks($id_user) {
            
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        
        try {
            $ua = new dbUserAttribute();
            $ua->setCurrentUser($id_user);

            $data['twitter']  = $ua->recuperar('usuario_Twitter');
            $data['facebook'] = $ua->recuperar('usuario_Facebook');
            $data['linkedin'] = $ua->recuperar('usuario_Linkedin');

            return $data;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getSocialNetworks() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getSocialNetworks" . $e->getMessage();
        }
    }

    /**
     * Método para retornar os documentos
     * do usuário, pode ser pf ou pj ou outro se houver mais documentos
     * 
     * @param number
     * 
     *
    */
    public static function getDocuments($id_user = NULL, $type = 'all') {
            
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        
        try {
            
            //Avoid problems without user logged in
            if ($id_user == '') $id_user = 0;
            
            $ua = new dbUserAttribute();
            $ua->setCurrentUser($id_user);
            
            $data = array();
            $obiz = HelperUtils::getObiz();
            
            if(($type == 'all' || $type == 'pf' || $type == 'admin' || $type == '0' || $type == '2' || $type == '3')){ $data['cpf']  = $ua->recuperar('usuario_CPF', 'texto', false, false, false, array('obiz' => $obiz)); $data['documento'] = $data['cpf']; }
            if($type == 'all' || $type == 'pf' || $type == 'admin' || $type == '0' || $type == '2' || $type == '3') $data['rg'] = $ua->recuperar('usuario_RG', 'texto', false, false, false, array('obiz' => $obiz));
            if($type == 'all' || $type == 'pj' || $type == '1'){ $data['cnpj'] = $ua->recuperar('usuario_CNPJ', 'texto', false, false, false, array('obiz' => $obiz)); $data['documento'] = $data['cnpj'];}
            if($type == 'all' || $type == 'pj' || $type == '1') $data['ie'] = $ua->recuperar('usuario_InscricaoEstadual', 'texto', false, false, false, array('obiz' => $obiz));

            return $data;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getDocuments() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getDocuments() " . $e->getMessage();
        }
    }

    /**
     * Método para retornar endereço principal
     *
     * PAY ATTENTION: the type can be inline, data or another one.
     * inline it return the complete address
     *
     * @param number
     * @param string
     * @return array|string
     */
    public static function getAddress($id = NULL, $type = 1, $arg = array()) {
        
        Yii::import('application.extensions.utils.special.LocationUtils');
        
        try {            
            //Avoid problems without user logged in
            if($type == '' || $type == '0' || $type == false || !$type || $type == 0) $type = 1;
            if ($id == '') $id = 0;
             
            $obiz = HelperUtils::getObiz();
            
            if(!$obiz) $sql = "SELECT * FROM user_address WHERE user_id = $id AND address_types_id = $type";
            if( $obiz) $sql = "SELECT id, AES_DECRYPT(address, {$obiz['serial']}) AS address, AES_DECRYPT(zip, {$obiz['serial']}) AS zip, AES_DECRYPT(city, {$obiz['serial']}) AS city, AES_DECRYPT(number, {$obiz['serial']}) AS number, AES_DECRYPT(bairro, {$obiz['serial']}) AS bairro, AES_DECRYPT(complement, {$obiz['serial']}) AS complement, state_id, pais FROM user_address WHERE user_id = $id AND address_types_id = $type";
        
            MethodUtils::setSessionData('checkAction', $sql);
                
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            if ($recordset) {
                $recordset['cep_1'] = substr($recordset['zip'], 0, 5);
                $recordset['cep_2'] = substr($recordset['zip'], 5, 3);
                $recordset['cep'] = $recordset['zip'];
                
                $recordset['cep_string'] = $recordset['cep_1'] . '-' . $recordset['cep_2'];
                if(strpos($recordset['zip'], '-') !== false){
                    $recordset['cep_string'] = $recordset['zip'];
                }
                
                $recordset['endereco'] = $recordset['address'];
                $recordset['numero'] = $recordset['number'];
                $recordset['complemento'] = $recordset['complement'];
                $recordset['cidade'] = $recordset['city'];
                $recordset['estado'] = LocationUtils::getEstadoById($recordset['state_id']);
                $recordset['id_estado'] = $recordset['state_id'];
                $recordset['bairro'] = $recordset['bairro'];
                $recordset['pais'] = $recordset['pais'];
             
            }
            
            
            if(isset($arg['callback'])){ $callback = $arg['callback'];}else{$callback = '';}
                
            switch($callback) {            
                case "inline":
                    if($recordset['complemento'] != ''){$compl = " {$recordset['complemento']} ";}else{$compl = '';}
                    $result = $recordset['endereco'].", " .$recordset['numero']. $compl . " - ".$recordset['bairro']." ".$recordset['cidade']."/".$recordset['estado'];
                    return $result;
                    break;
                case "googlemaps":
                    Yii::import('application.extensions.utils.StringUtils');
                    $result = "";
                    if ($recordset['endereco'] != "") {
                        $endereco = StringUtils::StringToUrl($recordset['endereco']);
                        $cidade = StringUtils::StringToUrl($recordset['cidade']);
                        $estado = StringUtils::StringToUrl($recordset['estado']);
                        $result = $recordset['numero'].",+".$endereco.",+".$cidade.",+".$estado . "&sensor=false";
                    }
                    return $result;
                    break;
                default:
                    return $recordset;
                    break;
            }
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getAdrress() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getAddress() " . $e->getMessage();
        }
    }

    /**
     * Método para retornar o endeerço secundário
     *
     * PAY ATTENTION: the type can be inline, data or another one.
     * inline it return the complete address in one line
     *
     * @param number
     * @param string
     * @return array|string
     *
    public static function getAddress2($id, $type = "") {
        
        try {
            //Avoid problems without user logged in
            if ($id == '') $id = 0;

            //Gets the address
            $sql = "user_id = '" .$id. "' AND address_types_id = 2";
            $uAddress = UserAddress::model()->find($sql);

            $data = array();

            if ($uAddress) {
                $data['cep_1'] = substr($uAddress->zip, 0, 5);
                $data['cep_2'] = substr($uAddress->zip, 5, 3);
                $data['cep'] = $uAddress->zip;
                $data['endereco'] = $uAddress->address;
                $data['numero'] = $uAddress->number;
                $data['complemento'] = $uAddress->complement;
                $data['cidade'] = $uAddress->city;
                $data['estado'] = HelperUtils::getState($uAddress->state_id); 
                $data['id_estado'] = $uAddress->state_id;
                $data['bairro'] = $uAddress->bairro;
            } else {
                $data['cep_1'] = "";
                $data['cep_2'] = "";
                $data['cep'] = "";
                $data['endereco'] = "";
                $data['numero'] = "";
                $data['complemento'] = "";
                $data['cidade'] = "";
                $data['estado'] = ""; 
                $data['id_estado'] = "";
                $data['bairro'] = "";
            }

            switch($type) {            
                case "inline":
                    $result = $data['endereco'].", " .$data['numero']." ".$data['complemento']." ".$data['cidade']." / ".$data['estado'];
                    return $result;
                    break;
                default:
                    return $data;
                    break;
            }
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getAddress2() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getAddress2() " . $e->getMessage();
        }
    } */

    /**
     * Método para retornar os funcionários
     * 
     *
    */
    public static function getAllEmployees() {
            
        $select = "id, field1, field2";
        $sql = "SELECT $select FROM user_data WHERE type = 3 || type = 4";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryAll();
            
        return $recordset;
    }

    /**
     * Método para retornar os dados dos contatos do usuário
     *
     * @param number
     * @return array
     */
    public static function getUserContacts($id_user = NULL, $type = 'pf', $arg = array()){

        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        Yii::import('application.extensions.utils.StringUtils');

        try {
            $data = array();
            $ua = new dbUserAttribute();
            
            $obiz = HelperUtils::getObiz();
            //Avoid problems without user logged in
            if ($id_user == '') $id_user = 0;
            $ua->setCurrentUser($id_user);

            $data['telefone'] = $ua->recuperar('usuario_Telefone', 'texto', false, false, false, array('obiz' => $obiz));            
            $data['telefone_ddd'] =  substr($data['telefone'], 0, 2);
            $data['telefone_number'] =  substr($data['telefone'], 2, 10);
            $data['telefone_string'] =  StringUtils::getFormatString($data['telefone'], 'telefone', $arg);
            $data['fax'] = $ua->recuperar('usuario_Fax', "inteiro");
            $data['celular'] = $ua->recuperar('usuario_Celular', 'texto', false, false, false, array('obiz' => $obiz));
            $data['operadora'] = $ua->recuperar('usuario_Operadora', "inteiro");
            $data['celular_ddd'] =  substr($data['celular'], 0, 2);
            $data['celular_number'] =  substr($data['celular'], 2, 11);
            $data['celular_string'] = StringUtils::getFormatString($data['celular'], 'celular', $arg);
            $data['contato'] = $ua->recuperar('usuario_Contato', 'texto', false, false, false, array('obiz' => $obiz));
                        
            
            if(($type == 'pf' || $type == 'admin' || $type == '2' || $type == '0' || $type == '4')){
                
                $data['contato_rg'] = $ua->recuperar('contato_RG', 'texto', false, false, false, array('obiz' => $obiz));
                $data['contato_cpf'] = $ua->recuperar("contato_CPF", 'texto', false, false, false, array('obiz' => $obiz));
                
                $data['usuario_rg'] = $ua->recuperar('usuario_RG', 'texto', false, false, false, array('obiz' => $obiz));
                $data['usuario_cpf'] = $ua->recuperar("usuario_CPF", 'texto', false, false, false, array('obiz' => $obiz));
                $data['documento'] = $data['usuario_cpf'];

                $data['company'] = $ua->recuperar('user_Company');
                $data['estado_civil'] = $ua->recuperar('usuario_EstadoCivil', 'inteiro');
            }
            
            if($type == 'pj' || $type == '1'){
                $data['contato'] = $ua->recuperar("usuario_Responsavel", 'texto', false, false, false, array('obiz' => $obiz));
                $data['contato_cnpj'] = $ua->recuperar('usuario_CNPJ', 'texto', false, false, false, array('obiz' => $obiz));
                $data['contato_ie'] = $ua->recuperar("usuario_InscricaoEstadual", 'texto', false, false, false, array('obiz' => $obiz));
                $data['documento'] = $data['contato_cnpj'];
            }
            

            return $data;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserContacts() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getUserContacts() " . $e->getMessage();
        }
    }

    /**
     * Método para retornar o sexo do usuário
     * TODO: Mudar para gender.
     *
     * @param number
     * @return bool
     */
    public static function getUserSex($id_user) {
            
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        
        $data = array();
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id_user);
        
        $data['sexo']  = $ua->recuperar('usuario_Sexo');
    
        return $data['sexo'];
    }

    /**
     * Método para retornar o profile do usuario formatado,
     * por exemplo ele pode ter completado os dados adicionais e mais o
     * currículum, neste caso o novo level = 22;
     *
     * @param $id
     * @param $status
     * @return int
     * @internal param $number
     */
    public static function profileLevelVerification($id, $status) {
            
        $select = "id, profile_level";
        $sql = "SELECT $select FROM user_data WHERE id = $id";
        
        MethodUtils::setSessionData('checkAction', $sql);

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        
        $new_level = 0;
            
        switch($recordset['profile_level']) {
            case 0:
                if ($status == 1) $new_level = 1;
                if ($status == 2) $new_level = 2;
                break;
            case 1:
                if ($status == 1) $new_level = 1;
                if ($status == 2) $new_level = 22;
                break;
            case 2:
            case 22:
                if ($status == 1) $new_level = 22;
                if ($status == 2) $new_level = 22;
                break;
        }
    
        return $new_level;
    }

    /**
     * Método para retornar o nome do usuário
     *
     * @param $name
     * @param $second_name
     * @param $type
     * @return string
     * @internal param $strings
     */
    public static function getNameUser($name, $second_name, $type){
        
        if ($type == '1' || $type == '5') {
            $user_name = $name;
        }else{
            $user_name = $name . " " . $second_name;
        }
        
        return $user_name;
    }

    /**
     * Método para retornar o hash do email
     * 
     * @param number
     *
    */
    public static function getUserHash($id_user) {
            
        $select = "id, email_hash";
        $sql = "SELECT $select FROM user_data WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        $hash = $recordset['email_hash'];    
        
        return $hash;
    }

    /**
     * Método para retornar o id do usário pelo hash dele.
     * Usado pela preferncia de manter conectado
     * 
     * @param number
     *
    */
    public static function getUserByHash($hash) {
            
        $select = "id";
        $sql = "SELECT $select FROM user_data WHERE email_hash = '$hash'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();  
        
        return $recordset;
    }

    /**
     * Método para retornar o nome do usuário a
     * partir do email dele, é usado em logar das redes sociais
     *
     * @param string
     * @return string
     */
    public static function getUserByEmail($email) { 
        
        try {
            $select = "id, field1, field2, type";
            $sql = "SELECT $select FROM user_data WHERE email = '$email'";
            
            MethodUtils::setSessionData('checkAction', $sql);

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 
            $user = "";

            if ($recordset) {
                if ($recordset['type'] == 0 || $recordset['type'] == 2)
                    $user = $recordset['field1'] . " " . $recordset['field2'];
                if ($recordset['type'] == 1)
                    $user = $recordset['field2'];
            }

            return $user;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserByEmail() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getUserByEmail " . $e->getMessage();
        }
    }

    /**
     * Método para retornar o nome do usuário a
     * partir do email dele, é usado em logar das redes sociais
     * 
     * @param string
     *
    */
    public static function getUserFullByEmail($email) { 
         
        try {
            $select = "id, field1, field2, type, email";
            $sql = "SELECT $select FROM user_data WHERE email = '$email'";
            
            MethodUtils::setSessionData('checkAction', $sql);

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 

            if($recordset){
                
                if($recordset['type'] == 0 || $recordset['type'] == 2){
                    $recordset['name'] = $recordset['field1'] . " " . $recordset['field2'];
                    $recordset['nome'] = $recordset['name'];
                }
                
                if($recordset['type'] == 1){
                    $recordset['name'] = $recordset['field1'];
                    $recordset['nome'] = $recordset['name'];
                }
            }

            return $recordset;
            
        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserFullByEmail() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getUserFullByEmail " . $e->getMessage();
        }
    }

    /**
     * Método para retornar os dados dos creditos do usuário.
     *
     * @param bool $id_user
     * @return
     * @internal param $number
     */
    public static function getAccountCredits($id_user = false) { 

        Yii::import('application.extensions.utils.CurrencyUtils');        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');

        try {
            //Se não tiver id definido tenta pegar do usuário logado
            if (!$id_user) {
                $session = MethodUtils::getSessionData();
                $id_user = $session['id'];
            }
            
            if ($id_user == '') $id_user = 0;

            $ua = new dbUserAttribute();
            $ua->setCurrentUser($id_user);

            $recordset['credit_User'] = $ua->recuperar('credit_User', 'number');
            $recordset['credit_User_format'] = CurrencyUtils::getPriceFormat($recordset['credit_User'], true, false);
            $recordset['creditos_business_page'] = $ua->recuperar('creditos_business_page', 'number');
            $recordset['creditos_business_page_format'] = CurrencyUtils::getPriceFormat($recordset['creditos_business_page'], true, false);

            $recordset['id'] = $id_user;

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getAccountCredits() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getAccountCredits " . $e->getMessage();
        }
    }

    /**
     * Handle Credits purchased
     * 
     * @param array
     * @param array
     *
     */
    public static function setPurchasedCreditsAttributes($data = array(), $item = array()) {

        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.ProdutosUtils'); 
        Yii::import('application.extensions.utils.RulesUtils');
        
        //Se for classificados
        if(defined('Settings::PIER_CLASSIFICADOS') && Settings::PIER_CLASSIFICADOS){
            
            Yii::import('application.extensions.utils.special.ClassificadosUtils'); 
            
            $result['attr'] = ProdutosUtils::getEcommerceDetails(true, 'classificado'); 
            
            //Se for modelo 1 - com categorias com valores especiais
            if(isset($result['attr']['modelo']) && $result['attr']['modelo'] == '1'){
                $produto = ProdutosUtils::getProdutoById($item['id_item']);
                //var_dump($id_produto);
                if($produto){
                    //echo $produto['tipo'] . ' - ' . $produto['entrega'];
                    $setRules = RulesUtils::getRules($produto, $item);
                    //$result['plano'] = ProdutosUtils::getCategoryContent($id_produto, false, false, false);
                    //var_dump($result['plano']);
                } 
                
            //Se for modelo 0 - padrao de creditos iguais para todos
            }else{
                $valor = UserUtils::getAttribute('destaques', 'inteiro', $item['id_user']);
                $creditos = ProdutosUtils::getProdutoById($item['id_item'], array('callback' => 'entrega'));
                $new_value = $valor + ($creditos * $item['amount']);
                $set = UserUtils::setAttribute("destaques", $new_value, "inteiro", $item['id_user']);
            }        
        }
    }

    /**
     * Change status and some changes about the business page credits
     * purchased
     *
     * @param $data
     * @param $item
     * @return string
     * @internal param $array
     */
    public static function setBusinessPageCredits($data, $item) {

        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 

        $valor = UserUtils::getAccountCredits($item['id_item']);

        $ua = new dbUserAttribute();
        $ua->setCurrentUser($item['id_item']);
        $new_value = $item['valor'];

        if ($valor['creditos_business_page'] != "" || $valor['creditos_business_page'] != NULL)
            $new_value = $valor['creditos_business_page'] + $item['valor'];

        $new_value = CurrencyUtils::getFloatFormat($new_value);

        $ua->adicionar("creditos_business_page", $new_value, "number");

        return $new_value;
    }

    /**
     * Gets some empty values from user
     * 
     * PS: ESTA USANDO ATUALMENTE!!!!
     * 
     * @param array
     *
     */
    public static function getClearDataUser() {
        $result['field1'] = "";
        $result['field2'] = "";
        $result['type'] = "";
        $result['email'] = "";
        $result['id'] = "";
        $result['id_user'] = "";
        $result['avatar'] = "/media/images/avatar/avatar_profile.jpg";
        $result['frase'] = "";
        $result['creation'] = "";
        $result['documentos']['cnpj'] = "";
        $result['documentos']['cpf'] = "";
        $result['documentos']['rg'] = "";
        $result['profissao'] = "";
        $result['birthday'] = "";
        $result['curriculum_descricao'] = "";
        $result['keywords'] = "";
        $result['tempo_unidade'] = "";
        $result['estado_civil'] = "";
        $result['contato']['documento'] = "";
        $result['contato']['telefone'] = "";
        $result['nome_contato'] = "";
        $result['quantidade'] = "";
        $result['titulo'] = "";
        $result['departamento'] = "";
        $result['escolaridade'] = "";
        $result['porte_empresa'] = "";
        $result['email_contato'] = "";
        $result['faixa_salario'] = "";
        $result['descricao'] = "";
        $result['beneficios'] = "";
        $result['keywords_vaga'] = "";
        $result['tempo_experiencia'] = "";
        $result['sexo'] = "";
        $result['endereco']['cep'] = "";
        $result['endereco']['endereco'] = "";
        $result['endereco']['numero'] = "";
        $result['endereco']['bairro'] = "";
        $result['endereco']['cidade'] = "";
        $result['endereco']['complemento'] = "";
        $result['endereco']['id_estado'] = "";
        
        $result['endereco']['place'] = "";
        
        return $result;       
    }

    /**
     * Método para retornar os dados da Business Page
     * do user.
     *
     * @param bool $id_user
     * @return
     * @internal param $number
     *
    public static function getBusinessPageData($id_user = false) {

        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.GoogleMapsUtils');
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');

        //Se não tiver id definido tenta pegar do usuário logado
        if (!$id_user) $session = MethodUtils::getSessionData(); $id_user = $session['id'];

        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id_user);

        $recordset['anuncio'] = $ua->recuperar('anuncio', 'texto');
        $recordset['descricao'] = $ua->recuperar('descricao', 'descricao');
        $recordset['googlemaps'] =  $ua->recuperar('googlemaps', 'descricao');
        //$recordset['googlemaps'] = GoogleMapsUtils::getCoordenadesGoogleMaps($id_user);
        $recordset['promocao'] = $ua->recuperar('promocao', 'texto');
        $recordset['site'] = $ua->recuperar('site', 'texto');
        $recordset['creditos_business_page'] = $ua->recuperar('creditos_business_page', 'number');
        $recordset['creditos_business_page_format'] = CurrencyUtils::getPriceFormat($recordset['creditos_business_page'], true, false);
    
        return $recordset;
    } */

    /**
     * Change status and some changes about the credits purchased
     * 
     * @param array
     *
     *
    public static function saveBusinessPageData($data) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');         
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($data['id']);
        
        $ua->adicionar("anuncio", $data['image_anuncio'], "texto");
        $ua->adicionar("site", $data['site'], "texto");
        $ua->adicionar("descricao", $data['descricao'], "descricao");
        $ua->adicionar("googlemaps", $data['googlemaps'], "descricao");
    } */

    /**
     * Método para retornar os atributos do usuário
     * se for funcionário, administrador, atendimento, etc.
     * 
     * @param number
     * 
     *
    */
    public static function getUserTypeAttr($id_user) {
            
        $sql = "SELECT user_id, name FROM user_attribute WHERE user_id = $id_user AND texto = 'permission_level'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryAll();
        
        return $recordset;
    }
    
    /**
     * Método para remover todos os atributos antes de adicionar novos
     * 
     * @param number
    */
    public static function clearUserAttributes($id_user = NULL, $isTag = false) {

        if(!$isTag) $sql = "DELETE FROM user_attribute WHERE user_id = $id_user AND texto = 'permission_level'";
        if( $isTag) $sql = "DELETE FROM user_attribute WHERE user_id = $id_user AND name = '$isTag'";
        
        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - clearUserAttributes() ', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - clearUserAttributes " . $e->getMessage();
        }
    }

    /**
     * Sets the user permissions, current it's using a session to
     * set this permission, it could be not secure.
     *
     * @param number
     * @return bool
     */
    public static function loadAttributesPermissons($id) {
        Yii::import('application.extensions.utils.users.UserUtils');  
        $user_permissions = UserUtils::getUserTypeAttr($id);
        
        $count_permissions = count($user_permissions);
        if ($count_permissions > 0) {
            for($i = 0; $i < $count_permissions; $i++){
                //Como altera o valor do produto, somente se for necessário seta atacadista
                if($user_permissions[$i]['name'] != 'atacadista') $setSessionData = MethodUtils::setSessionData($user_permissions[$i]['name'], 1);
            }
        }        
        return true;
    }

    /**
     * Gets all users with the atributtes need.
     * This method uses a array to look for users.
     *
     * @param bool $types
     * @return bool
     * @internal param $string
     */
    public static function getAllKindUsers($types = false, $isPurple = false, $attributes = false, $data = array()){
        
        Yii::import('application.extensions.utils.users.UserUtils'); 
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.utils.OrdemAlfabeticaUtils');
        
        $session = MethodUtils::getSessionData();
        if((isset($data['cache']) && $data['cache']) && $session["users_$types"] != '') return $session["users_$types"];
        
        if(!$types){
            $sql = "SELECT user_id, name, inteiro, number, texto, descricao FROM user_attribute WHERE texto = 'permission_level'";
        
        }else{
            $type = UserUtils::getSQLCharges($types);
            $sql = "SELECT user_id, name, inteiro, number, texto, descricao FROM user_attribute WHERE (texto = 'permission_level' $type)";
        }
  
        try{
            
            if(!$isPurple) $command = Yii::app()->db->createCommand($sql);
            if( $isPurple) $command = Yii::app()->db4->createCommand($sql);
            
            if(isset($data['SUM']) && $types){
                $type = UserUtils::getSQLCharges($types);
                //echo "SELECT COUNT(*) FROM user_attribute WHERE texto = 'permission_level' $type";
                return Yii::app()->db->createCommand("SELECT COUNT(*) FROM user_attribute WHERE texto = 'permission_level' $type")->queryScalar();
            }
            
            $recordset = $command->queryAll();
            
            $user = false;
            
            if (count($recordset) > 0){
                $p = 0;
                for($i = 0; $i < count($recordset); $i++) {
                    
                    $info = UserUtils::getUserFullById($recordset[$i]['user_id'], $isPurple, $data);
                    
                    if ($info) {
                        
                        $user[$p] = $info;
                        $user[$p]['inteiro'] = $recordset[$i]['inteiro'];
                        $user[$p]['number'] = $recordset[$i]['number'];
                        $user[$p]['descricao'] = $recordset[$i]['descricao'];
                        $user[$p]['texto'] = $recordset[$i]['texto'];
                        $user[$p]['name'] = $recordset[$i]['name'];

                        $user[$p]['type_string'] = UserUtils::getUserTypeString($info['type'], true, $data);
                        if($attributes){ $user[$p][$attributes] = UserSupportUtils::getUserDetailsByTag('cliente', $recordset[$i]['user_id']);}

                        //Beeeeeeeee
                        $user[$p]['user'] = $user[$p];
                        $p++;
                        
                    } 
                }
                //Sort Array
                $user = OrdemAlfabeticaUtils::sortArray($user, "nome", SORT_ASC);
                
            } 
            
            $set = MethodUtils::setSessionData("users_$types", $user);
            return $user;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getAllKindOfUsers() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getAllKindOfUsers() ' . $e->getMessage();
        } 
    }

    /**
     * Gets the SQL string needed to find the
     * users attributes needed.
     *
     * @param string
     * @return string
     */
    public static function getSQLCharges($types) {
        
        switch($types) {
            case "pedidos":
            case "funcionarios":
            case "funcionario":
                //$result = " AND name = 'funcionario' OR name = 'acessor'";
                $result = " AND name = 'funcionario'";
                break;
            
            case "desenvolvedores":
            case "desenvolvedor":
                $result = " AND name = 'desenvolvedor'";
                break;
            
            case "cliente":
            case "clientes":
                $result = " AND name = 'cliente'";
                break;
            
            case "rede_beneficios ativo":
                $result = " AND name = 'rede_beneficios' AND descricao = 'ativo'";
                break;
            
            case "rede_beneficios inativo":
                $result = " AND name = 'rede_beneficios' AND descricao = 'inativo'";
                break;
            
            case "rede_beneficios novo":
                $result = " AND name = 'rede_beneficios' AND descricao = 'novo'";
                break;
            
            case "colunistas":
            case "colunista":
                $result = " AND name = 'colunista'";
                break;
            
            case "parceiros":
            case "parceiro":
                $result = " AND name = 'parceiro'";
                break;
            
            case "profissional":
                $result = " AND name = 'profissional'";
                break;
            
            case "ensino":
                $result = " AND name = 'profissional' OR name = 'funcionarios'";
                break;
            
            case "representante":
            case "vendedores":
                $result = " AND name = 'representante'";
                break;
            
            case "funcionario":
                $result = " AND name = 'funcionario'";
                break;
            
            default:
                $result = " AND name = '{$types}'";
                break;
            
        }       
        return $result;
    }

    /**
     * Método para criar uma conta de usuários rápida,
     * com poucas informações
     *
     * @param array
     * @param bool $isAdmin
     * @param bool $resturnId
     * @return bool
     */
    public static function createQuickUserAccount($data = array(), $isAditionalAttributes = false, $resturnId = false) {
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        Yii::import('application.extensions.utils.special.LocationUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.EmailUtils');
        Yii::import('application.extensions.utils.StringUtils'); 
        
        //Sets an avatar default
        if(!isset($data['avatar'])) $avatar = "/media/images/avatar/avatar_profile.jpg";
        if( isset($data['avatar'])) $avatar = $data['avatar'];
        
        //if no birthday data is declared
        
        $data['field1']  = StringUtils::StringTrim(addslashes($data['field1']));
        $data['field2']  = StringUtils::StringTrim(addslashes($data['field2']));
        
        if(!isset($data['birthday'])) $data['birthday'] = '0000-00-00';
        
        if(!isset($data['ramo_atuacao'])) $data['ramo_atuacao'] = 0;
        if(!isset($data['id_ramo_atuacao'])){$data['id_ramo_atuacao'] = 0;}else{$ramo = UserSupportUtils::getRamoAtuacao($data['id_ramo_atuacao'], false, 'label'); if($ramo){$data['ramo_atuacao'] = $ramo;} if(!is_numeric($data['id_ramo_atuacao'])){ $data['id_ramo_atuacao'] = 0;} }
        if(!isset($data['id_account_locked'])) $data['id_account_locked'] = UserUtils::checkAccountLocked();
        if(!isset($data['id_account_states'])) $data['id_account_states'] = 0;
        if(!isset($data['creation'])) $data['creation'] = date("Y-m-d H:i:s");
        if(!isset($data['tipo_conta'])) $data['tipo_conta'] = 0;
        if(!isset($data['documento'])){$data['documento'] = '';}else{$data['documento'] = StringUtils::clearString($data['documento'] , 'document');}
        if(!isset($data['nome'])) $data['nome'] = $data['field1'] . ' ' . $data['field2'];
        if(!isset($data['cpf'])){$data['cpf'] = '';}else{$data['cpf'] = StringUtils::clearString($data['cpf'], 'document');}
        if(!isset($data['cidade'])){$data['cidade'] = '';}else{$data['cidade'] = trim(addslashes($data['cidade']));}
        if(!isset($data['bairro'])){$data['bairro'] = '';}else{$data['bairro'] = trim(addslashes($data['bairro']));}
        if(!isset($data['frase'])){$data['frase'] = '';}else{$data['frase'] = trim(addslashes($data['frase']));}
        if(!isset($data['keywords'])){$data['keywords'] = '';}else{$data['keywords'] = trim(addslashes($data['keywords']));}
        if(!isset($data['pais'])){$data['pais'] = '0';}
        if(Yii::app()->params['language'] && $data['pais'] == '0') $data['pais'] = Yii::app()->params['language'];//Se for outro pais definido
        
        if($data['tipo_conta'] == 0){$data['name_full'] = $data['field1'] . ' '. $data['field2'];}else{$data['name_full'] = $data['field1'];}
        
        
        //Password not set
        if(!isset($data['password'])){
            $data['password_raw'] = MethodUtils::getRandomPassword();
            $data['password'] = md5($data['password_raw']);
            $data['password_send'] = true;
        }
        
        if(!isset($data['estado_civil'])) $data['estado_civil'] = 0;
        if(!isset($data['estado'])) $data['estado'] = '';
        $data['id_estado'] = $data['estado'];
        if(isset($data['estado']) && is_numeric($data['estado'])) $data['estado'] = LocationUtils::getEstadoById($data['estado']);
        if(isset($data['estado']) && !is_numeric($data['estado'])) $data['id_estado'] = LocationUtils::getEstadoByUf($data['estado']);
        if(isset($data['email'])) $data['email'] = StringUtils::StringToLowerCase($data['email'], 'simple');
        if(!isset($data['id_departamento'])) $data['id_departamento'] = 0;
        //Extras
        if(!isset($data['extra_1']) || (isset($data['extra_1']) && $data['extra_1'] == '')) $data['extra_1'] = '0';
        if(!isset($data['extra_2']) || (isset($data['extra_2']) && $data['extra_2'] == '')) $data['extra_2'] = '0';
        if(!isset($data['extra_3']) || (isset($data['extra_3']) && $data['extra_3'] == '')) $data['extra_3'] = '0';
        if(!isset($data['extra_4']) || (isset($data['extra_4']) && $data['extra_4'] == '')) $data['extra_4'] = '0';
        if(!isset($data['dominio'])) $data['dominio'] = '';
        if(!isset($data['company'])) $data['company'] = '';
        if(!isset($data['vencimento'])) $data['vencimento'] = 5;
        if(!isset($data['obiz'])){ $data['obiz'] = 0;}
        $data['alfa'] = StringUtils::RemoveSpecialChar(StringUtils::removeAcentos($data['name_full']), 5, true);
        //echo "T:{$data['alfa']}:T";
        $pid = hexdec(uniqid());
        //Não compartilha atributos especificos para usuário
        $data_raw = $data;
        
        //Atributos especificos para usuário
        $data['no_email_obiz'] = true;       
        if(Yii::app()->params['sign_in_open']) $data['id_account_states'] = 1;
        
        $obiz = HelperUtils::getObiz();
        
        //add message in database
        $insert  = "field1, field2, email, frase, password, email_hash, avatar, birthday, documento, name_full, cidade, bairro, estado,";
        $insert .= "receive_news, ramo_atuacao, id_ramo_atuacao, account_locked, account_states_id, creation, keywords, type, extra_1, extra_2, extra_3, extra_4, departamento, dominio, company, last_update, vencimento, obiz, alfa, pid, reputation, lance, profile_level, date_extra, assinatura, reputation_lower, reputation_higher, reputation_count, reputation_total, resume, login, pais";
        
        if(isset($data['insert_id_user']))$insert .= ", id";
        if(isset($data['tag_user']) && $data['tag_user'] == 'cliente') $insert .= ", is_client";
        if(isset($data['tag_user']) && $data['tag_user'] == 'aluno') $insert .= ", is_student";
        
        if(!$obiz) $values  = "'{$data['field1']}', '{$data['field2']}', '{$data['email']}',  '{$data['frase']}', '{$data['password']}', '" . md5($data['email'] . $data['documento']). "', '$avatar', '{$data['birthday']}', '{$data['documento']}', '{$data['name_full']}', '{$data['cidade']}', '{$data['bairro']}', '{$data['estado']}',";
        if( $obiz) $values  = "AES_ENCRYPT('{$data['field1']}', {$obiz['serial']}), AES_ENCRYPT('{$data['field2']}', {$obiz['serial']}), AES_ENCRYPT('{$data['email']}', {$obiz['serial']}), AES_ENCRYPT('{$data['frase']}', {$obiz['serial']}), '{$data['password']}', '" . md5($data['email'] . $data['documento']). "', AES_ENCRYPT('{$avatar}', {$obiz['serial']}), AES_ENCRYPT('{$data['birthday']}', {$obiz['serial']}),  AES_ENCRYPT('{$data['documento']}', {$obiz['serial']}), AES_ENCRYPT('{$data['name_full']}', {$obiz['serial']}), AES_ENCRYPT('{$data['cidade']}', {$obiz['serial']}), AES_ENCRYPT('{$data['bairro']}', {$obiz['serial']}), AES_ENCRYPT('{$data['estado']}', {$obiz['serial']}), ";
        
        $values .= "1, '{$data['ramo_atuacao']}', {$data['id_ramo_atuacao']}, {$data['id_account_locked']}, '{$data['id_account_states']}', '{$data['creation']}',";
        $values .= "'{$data['keywords']}', '{$data['tipo_conta']}', '{$data['extra_1']}', '{$data['extra_2']}', '{$data['extra_3']}', '{$data['extra_4']}', ";
        $values .= "'{$data['id_departamento']}', '{$data['dominio']}', '{$data['company']}', '{$data['creation']}', '{$data['vencimento']}', '{$data['obiz']}', '{$data['alfa']}', $pid, 0, 0, 0, '2000-01-01', '2000-01-01', 0, 0, 0, 0, '', '2000-01-01', '{$data['pais']}'";
        
        
        if(isset($data['tag_user']) && $data['tag_user'] == 'cliente') $values .= ", 1";
        if(isset($data['tag_user']) && $data['tag_user'] == 'aluno') $values .= ", 1";
        if(isset($data['insert_id_user'])) $values .= ",'{$data['insert_id_user']}'";
        
        $sql = "INSERT INTO user_data ($insert) VALUES ($values) ON DUPLICATE KEY UPDATE last_update = '{$data['creation']}'";
        
        MethodUtils::setSessionData('checkAction', $sql);
//echo $sql;
        try {
            //Check if the e-mail is already submited
            $isEmailExist = EmailUtils::checkEmailExist($data['email']);
            
            if (!$isEmailExist){
                $command = Yii::app()->db->createCommand($sql);
                $command->execute();

                //Get last id created
                $id = Yii::app()->db->getLastInsertID();        

                //If there are more data from user form.
                if($isAditionalAttributes){
                    UserUtils::saveAditionalAttributes($data, $id);
                }
                
                if(isset($data['endereco'])){
                    $userHander = new UsersManager();
                    $saveAddress = $userHander->saveAddress($data, $id);
                }
                
                $set = UserUtils::saveUserJson($data, $id);
                
                //Dispacht an e-mail to user signed.
                $data = $data_raw;
                
                $date = date('Ymd');
                $data['nome_Usuario'] = UserUtils::getUserNameString($data['field1'], $data['field2'], $data['tipo_conta']);
                $data['nome'] = UserUtils::getUserNameString($data['field1'], $data['field2'], $data['tipo_conta']);
                $data['tipo_conta'] =  UserUtils::getUserTypeString($data['tipo_conta'], true);
                $data['tipo'] = 'cadastro_rapido';
                $data['layout'] = 'cadastro_rapido';
                $data['abordagem'] = 1;
                if(!isset($data['descricao'])) $data['descricao'] = '';
                $data['id'] = $id;//Adiciona o novo id para uso posterior
                
                //Data email
                $data['server'] = $_SERVER['SERVER_NAME'];
                $data['dados'] = HelperUtils::getTitleSite();
                $data['logo'] = HelperUtils::getLogo("logos");
                $data['layout_template'] = EmailUtils::getEmailLayout();
                $data['render'] = true;$data['render_reply'] = true;
                $data['hash'] = md5($data['email'] . $data['documento']);
                $data['confirm_url'] = "http://" . $data['server']  . "/users/confirmar/" . $data['hash'];
                
                $data['view'] = Yii::app()->controller->renderPartial("/templates/email/views/cadastro", $data, true);
                $data['view_reply'] = Yii::app()->controller->renderPartial("/templates/email/views_reply/cadastro", $data, true);
               
                (isset($data['newsletter'])) ? $data['newsletter'] = 1 : $data['newsletter'] = false;
                
                if(!isset($data['ignore_email'])) $email_notification = MethodUtils::sendOrder($data);
                
                Yii::import('application.extensions.utils.special.NewsLetterUtils');
                if(!isset($data['ignore_piermail'])) $defineAcceptance = NewsLetterUtils::insertPierMail($data, $date);
                
                $activity = array(
                    "title" => Yii::t("activityStrings","user_submit"),
                    "nome" => $data['nome_Usuario'],
                    "message" => Yii::t("activityStrings", "user_submit_desc"),
                    "tipo" => "cadastro_usuario",
                    "id_general" => $id,
                    "date" => date("Y-m-d H:i:s"),
                    "last_update" => date("Y-m-d H:i:s"),
                    "id_user" => $id,
                    'extra' => $data['nome_Usuario'],
                    'valor' => 20
                );
                
                $session = MethodUtils::getSessionData();
                if($session['id'] == '' || $session['id'] == '0') MethodUtils::setSessionData('id', $id);
                
                $setActivity = MethodUtils::setActivityRecent($activity);

                return $id;
            
            }else{
               
                Yii::import('application.extensions.utils.special.LocationUtils');
                //If there are more data from user form.
                UserUtils::saveAditionalAttributes($data, $isEmailExist['id']);                
                if(isset($data['birthday'])) UserUtils::updateUserInfo('birthday', $data['birthday'], $isEmailExist['id']);
                if(isset($data['documento']) && $data['documento'] != '') UserUtils::updateUserInfo('documento', $data['documento'], $isEmailExist['id']);
                if(isset($data['ramo_atuacao']) && $data['ramo_atuacao'] != '0') UserUtils::updateUserInfo('ramo_atuacao', $data['ramo_atuacao'], $isEmailExist['id']);
                if(isset($data['id_ramo_atuacao']) && $data['id_ramo_atuacao'] != '0') UserUtils::updateUserInfo('id_ramo_atuacao', $data['id_ramo_atuacao'], $isEmailExist['id']);
                
                if(isset($data['endereco'])){
                    $data['editar'] = true;
                    $userHander = new UsersManager();
                    $saveAddress = $userHander->saveAddress($data, $isEmailExist['id']);
                }
                
                $set = UserUtils::saveUserJson($data, $isEmailExist['id']);
                ActivityLogger::log('cadastro usuario já existente - atualizando' . json_encode($_REQUEST), "user", null, null, false);
                 
                if ($resturnId) return $isEmailExist['id'];
                return false;
            }

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- createQuickUserAccount()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserUtils - createQuickUserAccount() ' . $e->getMessage();            
        }
    }

    /**
     * Save some aditional attributes
     * First the lats id is retrieve from the method createQuickUserAccount
     *
     * @param array
     * @param number
     * @return bool
     */
    public static function saveAditionalAttributes($data, $id) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
        Yii::import('application.extensions.utils.StringUtils');
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);
        $obiz = HelperUtils::getObiz();
        
        try {
            if($data['tipo_conta'] == '1'){
                if(isset($data['contato']) && $data['contato'] != '') $ua->adicionar("usuario_Responsavel", $data['contato'], "texto", false, array('obiz' => $obiz));
                if(isset($data['documento'])) $ua->adicionar("usuario_CNPJ", StringUtils::clearString($data['documento'], 'document'), "texto", false, array('obiz' => $obiz));
                if(isset($data['cnpj'])) $ua->adicionar("usuario_CNPJ", StringUtils::clearString($data['cnpj'], 'document'), "texto", false, array('obiz' => $obiz));
                if(isset($data['ie'])) $ua->adicionar("usuario_InscricaoEstadual", StringUtils::clearString($data['ie'], 'document'), "texto", false, array('obiz' => $obiz));                
                if(isset($data['company_description']))$ua->adicionar("user_Description", $data['company_description'], "descricao");
                
                if(isset($data['contato_rg'])) $ua->adicionar("contato_RG", StringUtils::clearString($data['contato_rg'], 'document'), "texto", false, array('obiz' => $obiz));                
                if(isset($data['contato_cpf']))$ua->adicionar("contato_CPF", StringUtils::clearString($data['contato_cpf'], 'document'), "texto", false, array('obiz' => $obiz));
                if(isset($data['contato_data_nascimento']))$ua->adicionar("contato_NASC", $data['contato_data_nascimento'], "texto", false, array('obiz' => $obiz));
                
            } else {
                if(isset($data['documento'])) $ua->adicionar("usuario_CPF", StringUtils::clearString($data['documento'], 'document'), "texto", false, array('obiz' => $obiz));
                if(isset($data['estado_civil']) && $data['estado_civil'] != '') $ua->adicionar("usuario_EstadoCivil", $data['estado_civil'], "inteiro");
                if(isset($data['sexo']) && $data['sexo'] != '')$ua->adicionar("usuario_Sexo", $data['sexo'], "texto");
                //if(isset($data['cpf']) && $data['cpf'] != '')$ua->adicionar("usuario_CPF", StringUtils::clearString($data['cpf'], 'document'), "texto", false, array('obiz' => $obiz));
                if(isset($data['rg']))$ua->adicionar("usuario_RG", StringUtils::clearString($data['rg'], 'document'), "texto", false, array('obiz' => $obiz));                
                
                if(isset($data['profissao'])){
                    Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
                    $profissao = BancoCurriculosUtils::getProfissaoById($data['profissao'], 'descricao');
                    $ua->adicionar("usuario_Profissao", $profissao, "texto", false, array('obiz' => $obiz));
                    $ua->adicionar("usuario_id_Profissao", $data['profissao'], "inteiro");
                }
            }
           
            if(isset($data['facebook'])) $ua->adicionar("usuario_Facebook", StringUtils::replacePhone($data['facebook']), "texto");
            if(isset($data['twitter'])) $ua->adicionar("usuario_Twitter", StringUtils::replacePhone($data['twitter']), "texto");
            if(isset($data['linkedin'])) $ua->adicionar("usuario_Linkedin", StringUtils::replacePhone($data['linkedin']), "texto");
            
            //if(isset($data['fax'])) $ua->adicionar("usuario_Fax", $data['fax'], "texto");
            if(isset($data['telefone'])) $ua->adicionar("usuario_Telefone", StringUtils::replacePhone($data['telefone']), "texto", false, array('obiz' => $obiz));
            if(isset($data['celular'])) $ua->adicionar("usuario_Celular", StringUtils::replacePhone($data['celular']), "texto", false, array('obiz' => $obiz));
            if(isset($data['operadora'])) $ua->adicionar('usuario_Operadora', $data['operadora'], 'inteiro');
            
            if(isset($data['associado'])) $ua->adicionar("associado", 'permission_level', "texto");
            
            if(isset($data['tag_user']) && $data['tag_user'] != ''){
                $ua->adicionar($data['tag_user'], 'permission_level', "texto");
                if($data['tag_user'] == 'cliente') $control2 = Yii::app()->db->createCommand("UPDATE user_data SET is_client = 1 WHERE id = $id")->execute(); 
                if($data['tag_user'] == 'aluno') $control2 = Yii::app()->db->createCommand("UPDATE user_data SET is_student = 1 WHERE id = $id")->execute();
            }
            
            //Classificados
            if(isset($data['max_anuncios']) && $data['max_anuncios'] != '') $ua->adicionar('max_anuncios', $data['max_anuncios'], "inteiro");
            if(isset($data['destaques'])) $ua->adicionar('destaques', $data['destaques'], "inteiro");
            
            //Integradores
            if(isset($data['intService1'])){
                $integrador = array();
                if(isset($data['intUrl1'])){ $integrador['url'] = $data['intUrl1']; }
                if(isset($data['intService1'])){ $integrador['service'] = $data['intService1']; }
                if(isset($data['intToken1'])){ $integrador['token'] = $data['intToken1']; }
                if(isset($data['intUser1'])){ $integrador['user'] = $data['intUser1']; }
                $ua->adicionar('intService1', json_encode($integrador), "texto", false, array('obiz' => $obiz));
            }
            
            //DataLog
            if(isset($data['nr_operador'])) $ua->adicionar('nr_operador', $data['nr_operador'], "inteiro");

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserUtils - saveAditionalAttributes() ' . $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- saveAditionalAttributes()', 'trace' => $e->getMessage()), true);
        }        
    }

    /**
     * Save an aditional attributes
     *
     * @param $label
     * @param $data
     * @param string $type
     * @param $id
     * @return bool
     * @internal param $array
     * @internal param $number
     */
    public static function setAttribute($label = "", $value = "", $type = "texto", $id = NULL, $isCumulative = false, $data = array()) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);
        
        try {            
            $ua->adicionar($label, $value, $type, $isCumulative, $data);
            return true;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setAttribute()', 'trace' => $e->getMessage()), true);
            return false;
        }        
    }

    /**
     * Save an aditional attributes
     *
     * @param string $name
     * @param int $inteiro
     * @param int $number
     * @param string $texto
     * @param string $descricao
     * @param array
     * @return bool
     */
    public static function setAttributeComplete($name = '', $inteiro = 0, $number = 0, $texto = '', $descricao = '', $id = NULL) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);
        
        try {            
            $ua->adicionarComplete($name, $inteiro, $number, $texto, $descricao);
            return true;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setAttributeComplete()', 'trace' => $e->getMessage()), true);
            return false;
        }        
    }

    /**
     * Gets an aditional attributes
     *
     * @param $label
     * @param string $type
     * @param $id
     * @param bool $all
     * @return bool
     * @internal param $string
     * @internal param $number
     */
    public static function getAttribute($label = "", $type = "texto", $id = NULL, $all = false, $is_Boolean = false, $is_Purple = false, $data = array()) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);
        
        try {            
            $attribute = $ua->recuperar($label, $type, $all, $is_Boolean, $is_Purple, $data); 
         
            return $attribute;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- getAttribute()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }        
    }
    
    /**
     * Gets an aditional attributes
     *
     * @param $label
     * @param string $type
     * @param $id
     * @param bool $all
     * @return bool
     * @internal param $string
     * @internal param $number
     */
    public static function getAttributes($label = "", $type = "texto", $id = NULL, $all = false) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);
        
        try {            
            $attribute = $ua->recuperarAll($label, $type, $all); 
         
            return $attribute;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- getAttributes()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }        
    }
    
    /**
     * Gets an aditional attributes
     *
     * @param $label
     * @param string $type
     * @param $id
     * @param bool $all
     * @return bool
     * @internal param $string
     * @internal param $number
     */
    public static function getAttributeItem($id_user = NULL, $label = "", $type = "texto", $data = array()) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
  
        $ua = new dbUserAttribute();
        
        try {            
            $attribute = $ua->getAttribute($id_user, $label, $type, $data); 
         
            return $attribute;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- getAttributeItem()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }        
    }

    /**
     * Gets an aditional attributes
     *
     * @param $label
     * @param string $type
     * @param $id
     * @param bool $all
     * @return
     * @internal param $string
     * @internal param $number
     */
    public static function removeAttribute($label = "", $type = "texto", $id = NULL, $all = false) {
        
        $sql = "DELETE FROM user_data WHERE user_id = $id AND name = '" .$label. "'";
        if ($all) $sql = "DELETE FROM user_attribute WHERE user_id = " .$id . "";

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
         
            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- removeAttribute()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }        
    }

    /**
     * Check if a attribute exist, and or if a user has a specific
     * attribute
     *
     * @param string $type
     * @param number
     * @param bool $all
     * @param bool $isUser
     * @return string
     * @internal param $string
     */
    public static function checkAttribute($type = "texto", $label = '', $all = true, $isUser = false, $isLabel = false) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
  
        $ua = new dbUserAttribute();
        
        try {            
            $attribute = $ua->checar($label, $type, $all, $isUser, $isLabel);           
            return $attribute;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- checkAttribute()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserUtils - checkAttribute() ' . $e->getMessage();
        }        
    }

    /**
     * Método para obter alguns attributos para o cadastro rápido
     * de usuário. Se for pj os labels são diferentes de pf.
     * 
     */
    public static function getQuickSignInAttributes($type) {
        
        switch($type) {
            case 0:
                $result['field1'] = Yii::t("adminForm", "order_page_label_name");
                $result['field2'] = Yii::t("adminForm", "common_last_name");
                $result['extra'] = Yii::t("adminForm", "order_page_label_birthday");
                $result['documento'] = Yii::t("adminForm", "order_page_label_cpf");
                break;
            
            case 1:
                $result['field1'] = Yii::t("adminForm", "common_company");
                $result['field2'] = Yii::t("adminForm", "common_company_brand");
                $result['extra'] = Yii::t("adminForm", "common_contact");
                $result['documento'] = Yii::t("adminForm", "order_page_label_cnpj");
                break;
            
        }        
        return $result;
    }

    /**
     * Método para atualizar o password, feito na conta,
     * pode ser PJ ou PF.
     *
     * @param array
     * @param bool $isMd5
     * @return bool|string
     */
    public static function setNewPassword($data = array(), $isMd5 = false) {
        
        if (!$isMd5) {
            $values = "password = '" . md5($data['senha']) ."', account_states_id = '1'";
        } else {
            $values = "password = '{$data['senha']}', account_states_id = '1'";   
        }
      
        if(isset($data['id']))   $sql =  "UPDATE user_data SET $values WHERE id = {$data['id']}";
        if(isset($data['hash'])) $sql =  "UPDATE user_data SET $values WHERE email_hash = '{$data['hash']}'";

        try {
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();           
            return true;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setNewPassword()', 'trace' => $e->getMessage()), true);
            return $e->getMessage();
        }
    }

    /**
     * Método para atualizar o estado da conta do usuário
     * 0 - inativo
     * 1 - ativo
     * 2 - completo
     * 3 - aguardando
     * 4 - sem e-mail
     *
     * @param $id_user
     * @param $state
     * @return bool
     * @internal param $number
     */
    public static function setUserAccountState($id_user, $state) {
        
        $values = "account_states_id = '$state'";  
        $sql =  "UPDATE user_data SET $values WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $do = $command->execute();           
            return $do;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setUserAccountState()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserUtils - setUserAccountState() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o usuário
     *
     * @param $id_user
     * @param string
     * @return bool
     * @internal param $number
     */
    public static function updateUserInfo($field = "", $value = "", $id_user = NULL, $data = array()){
        
        try{
            $sql = "UPDATE user_data SET $field = '{$value}' WHERE id = $id_user";
            if(isset($data['obiz']) && $data['obiz']) $sql = "UPDATE user_data SET $field = AES_ENCRYPT('{$value}', {$data['obiz']['serial']}) WHERE id = $id_user";
            $set = Yii::app()->db->createCommand($sql)->execute();
            return $set;         

        }catch(CDbException $e){
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - updateUserInfo()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserUtils - updateUserInfo() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar o user_data
     *
     * @param array
     * @param $number
     * 
     */
    public static function setUserDataInformation($data, $id_user){
        
        $values  = "extra_1 = '{$data['especializacao']}', ";
        $values .= "extra_2 = '{$data['setor']}', ";
        $values .= "extra_3 = '{$data['hierarquia']}', ";
        $values .= "extra_4 = '{$data['pretensao']}', ";
        $values .= "cidade = '{$data['cidade']}', ";
        $values .= "estado = '{$data['estado']}', ";
        $values .= "id_ramo_atuacao = '{$data['profissao']}', ";
        $values .= "profile_level = '{$data['profile_level']}'";
                
        $sql =  "UPDATE user_data SET $values WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $do = $command->execute(); 
            
            return $do;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setUserDataInformation()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserUtils - setUserDataInformation() ' .  $e->getMessage();
        }
    }

    /**
     * Método para atualizar os creditos que são utilizados da conta
     * para abastecer algum dos serviços online.
     *
     *
     * @param array
     * @param bool $isBusinessPage
     */
    public static function useUserCredits($data = array(), $isBusinessPage = true) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute'); 
        Yii::import('application.extensions.utils.users.UserUtils'); 
        
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($data['id']);
        
        $valorCredits = UserUtils::getAccountCredits($data['id']);   
        
        //If exist some calculates are make to up to date the values
        $new_value = $valorCredits['credit_User'] - $data['creditos_business_page'];
        $new_bs_value = $valorCredits['creditos_business_page'] + $data['creditos_business_page'];
        
        $ua->adicionar("credit_User", $new_value, "number");
        
        if ($isBusinessPage) {
            $ua->adicionar("creditos_business_page", $new_bs_value, "number");
        }
    }

    /**
     * Método para mudar o status da conta se está travado ou não
     *
     * @param $isLocked
     * @param $id_user
     * @return bool
     * @internal param $boolean
     */
    public static function setLockedAccount($isLocked, $id_user) {
        
        $isLocked = MethodUtils::getBooleanNumber($isLocked);
        
        $values = "account_locked = '$isLocked'";     
        $sql = "UPDATE user_data SET $values WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $command->execute(); 
            
            return true;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- setLockedAccount()', 'trace' => $e->getMessage()), true);
            return false;
        }
    }

    /**
     * Método para resetar o status da conta e envia uma nova senha
     * para o usuário, usado para atualizar clientes.
     *
     * @param $isLocked
     * @param $id_user
     * @param bool $isOwnerNeeded
     * @return bool|string
     * @internal param $boolean
     */
    public static function resetLockedAccount($isLocked = "", $id_user = NULL, $isOwnerNeeded = true) {
        
        Yii::import('application.extensions.utils.users.UserUtils'); 
         
        $isLocked = MethodUtils::getBooleanNumber($isLocked);
        $password = MethodUtils::getRandomPassword();
        $password_md5 = md5($password);
 
        $values = "account_locked = '$isLocked', password  = '$password_md5', account_states_id  = '3'"; 
        $sql = "UPDATE user_data SET $values WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        $user_data = UserUtils::getUserFullById($id_user);
        $user_doc = UserUtils::getDocuments($id_user);
        $user_hash = UserUtils::getUserHash($id_user);
        
        //Some specific attributes for PF and PJ
        if ($user_data['type'] == 0) {
            $data_account['nome'] =  $user_data['field1']. " " .$user_data[ 'field2'];
            if (isset($data_account['cpf'])) {
                $data_account['cpf'] = $user_doc['cpf'];
            } else {
                $data_account['cpf'] = '';
            }
            $data_account['tipo_conta'] = Yii::t("adminForm", "common_pf");
        } else {
            $data_account['nome'] =  $user_data[ 'field2'];
             if (isset($data_account['cpf'])) {
                 $data_account['cpf'] =  $user_doc['cnpj'];
             } else {
                 $data_account['cpf'] = '';
             }
            $data_account['tipo_conta'] = Yii::t("adminForm", "common_pj");
        }
        
        $data_account['titulo_email'] = "Atualização de cadastro";
        $data_account['newsletter'] =  1;
        $data_account['password'] =  $password;
        $data_account['telefone'] =  "";
        $data_account['email'] =  $user_data['email'];
        $data_account['layout'] =  "cadastro_common";
        $data_account['tipo'] =  "cadastro_atualizar_com_senha";
        $data_account['layout_reply'] = "cadastro_atualizar_com_senha";//Esse layout é de atualização de dados ACIC.
        $data_account['hash'] = $user_hash;      

        try {
            $command = Yii::app()->db->createCommand($sql);
            $command->execute(); 
            
            $sendEmail = MethodUtils::sendOrder($data_account, false);
            return $sendEmail;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- resetLockedAccount()', 'trace' => $e->getMessage()), true);
            return false;
        }
    }

    /**
     * Método para obter todos os ramos de atuação
     * 
     *
     */
    public static function getAllRamoAtuacao() {
        
        $session = MethodUtils::getSessionData();
        if($session['ramo_atuacao_all'] != '' && $session['ramo_atuacao_all'] != null) return $session['ramo_atuacao_all'];
        
        if(Yii::app()->params['no_db2_client']){
            
            $recordset = MethodUtils::requestPurplePier(0, 'ramo_atuacao_all', array('id' => 0));
            
            $result = json_decode($recordset, true); 
            $set = MethodUtils::setSessionData('ramo_atuacao_all', $result);
            return $result; 
            
        }else{            
            $command = Yii::app()->db2->createCommand("SELECT id, label, url FROM general_ramo_atuacao ORDER BY label ASC");
            $recordset = $command->queryAll();
            $set = MethodUtils::setSessionData('ramo_atuacao_all',  $recordset);
            return $recordset;
        }
    }
    
    /**
     * Método para obter todos os ramos de atuação
     * 
     *
     */
    public static function getAllProfissoes() {
        
        $session = MethodUtils::getSessionData();
        //if($session['profissoes_all'] != '' && $session['profissoes_all'] != null) return $session['profissoes_all'];
        
        if(Yii::app()->params['no_db2_client']){
            
            $recordset = MethodUtils::requestPurplePier(0, 'profissoes_all', array('id' => 0));
            
            $result = json_decode($recordset, true); 
            $set = MethodUtils::setSessionData('profissoes_all', $result);
            return $result; 
            
        }else{            
            $command = Yii::app()->db2->createCommand("SELECT * FROM general_profissoes ORDER BY descricao ASC");
            $recordset = $command->queryAll();
            $set = MethodUtils::setSessionData('profissoes_all',  $recordset);
            return $recordset;
        }
    }

    /**
     * Método para fechar uma cobrança chamado de dentro de Storetils::ItemManager()
     *
     * @param array
     * @param array
     * @return bool
     */
    public static function setOrderPayment($data, $item) {   
        
        Yii::import('application.extensions.utils.users.UserUtils'); 
        
        date_default_timezone_set("Brazil/East"); 
        $set = UserUtils::setAttribute("Hospedagem", date("m"), "inteiro", $item['id_item']);
        
        return $set;
    }

    /**
     * Método para retornar o nome do usuário,
     * ideal para organizar se é PF ou PJ
     *
     * @param string
     * @param string
     * @param number
     * @return string
     */
    public static function getUserNameString($field1, $field2, $type) {
       
        $result = "";

        switch ($type) {            
            case '0':
            case '2':
                $result = $field1 . " " . $field2;
                break;
            case '1':
                $result = $field1;
                break;          
            
        }        
        return $result;
    }

    /**
     * Método para retornar o tipo do usuário em number
     *
     * @param string
     * @return int|string
     */
    public static function getUserType($user) {
       
        $id_type = "";

        switch ($user) {            
            case "pf":
            case "funcionario":
                $id_type = 0;
                break;
            case "pj":
                $id_type = 1;
                break;          
            case "admin":
                $id_type = 2;
                break;                   
            case "colunista":
                $id_type = 0;
                break;           
            case "associado":
            case "fornecedor":
                $id_type = 1;
                break;
            case "fotografo":
                $id_type = 0;
                break;
        }        
        return $id_type;
    }

    /**
     * Método para retornar o tipo do usuário em String
     * Pode ser utilizado um id ou uma string como editar_pj.
     *
     * @param string
     * @param bool $isFullString
     * @return string
     */
    public static function getUserTypeString($type_person = "", $isFullString = false) {
       
        $type = "";

        switch($type_person) {            
            case '0':
            case "editar_pf":
            case "pf":
                $type = "pf";
                if ($isFullString)$type = Yii::t("siteStrings", "label_pf");
                break;
            
            case '1':
            case "editar_pj":
            case "pj":
                $type = "pj";
                if ($isFullString)$type = Yii::t("siteStrings", "label_pj");
                break;
            
            case '2':
            case '3':
                $type ="admin";
                if ($isFullString)$type = Yii::t("siteStrings", "label_pf");
                break;
        }  
        return $type;
    }

    /**
     * Método para retornar status da ativação da conta
     *
     * @param number
     * @return string
     */
    public static function getSituation($id) {
        
        $type = "";
        switch ($id) {            
            case 0:
                $type = "Inativo";
                break;
            case 1:
                $type = "Ativo";
                break;           
            case 2:
                $type ="Completo";
                break;           
            case 3:
                $type ="Aguardando";
                break;
            case 4:
                $type ="Sem e-mail";
                break;
            
        }        
        return $type;
    }

    /**
     * Método para retornar o status da conta
     *
     * @param number
     * @return string
     */
    public static function getLocked($type) {

        switch($type){            
            case '0':
                $result = "Ativa";
                break;
            case '1':
                $result = "Limitada";
                break;            
            case '2':
                $result = "Bloqueada";
                break;
            case '3':
                $result = "Aguardando Aprovação";
                break;
            case '4':
                $result = "Aprovação Recusada";
                break;
            case '10':
                $result = "Triagem";
                break;
            default:
                $result = "Ativa";
                break;
        }        
        return $result;
    }

    /**
     * Método para retornar as informaçoes do usuario pela consulta do nome e sobrenome do usuário
     *
     * @param $name
     * @param string $last_name
     * @param bool $isPJ
     * @return
     * @internal param $string
     */
    public static function getUserByName($name = "", $last_name = "", $isPJ = false) {
            
        $select = "id, field1, field2, type";
        $sql = "SELECT $select FROM user_data WHERE field1 = '$name' AND field2 = '$last_name'";
        if ($isPJ = true) $sql = "SELECT $select FROM user_data WHERE field1 = '$name'";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        
        if (!$recordset) $recordset['id'] = 0; 
        return $recordset;
    }

    /**
     * Método para retornar os dados do cliente.
     * 
     * @param number
     *
    */
    public static function getClientAttributes($id_user = NULL, $isPurple = false, $data = array()) {
        
        Yii::import('application.extensions.utils.CurrencyUtils');        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
 
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id_user);
        
        if(!isset($data['ignore_info'])){
            $recordset['user'] = $ua->recuperar('user', 'texto', false, false, $isPurple);
            $recordset['valor'] = $ua->recuperar('mensalidade', 'number', false, false, $isPurple);
            $recordset['escolaridade']  = $ua->recuperar('dominio', 'texto', false, false, $isPurple);
            
            $recordset['referencia'] = $ua->recuperar('referencia', 'texto', false, false, $isPurple);
            $recordset['user_db']  = $ua->recuperar('id_name', 'texto', false, false, $isPurple);
            $recordset['db']  = $ua->recuperar('db', 'texto', false, false, $isPurple);

            $recordset['rotina_db']  = $ua->recuperar('rotina_db', 'inteiro', false, false, $isPurple);
            $recordset['sync']  = $ua->recuperar('sync', 'inteiro', false, false, $isPurple);
            $recordset['host_db']  = $ua->recuperar('host_db', 'texto', false, false, $isPurple);//Host banco
            $recordset['host_port']  = $ua->recuperar('host_port', 'inteiro', false, false, $isPurple);
            
            $recordset['ftp_user'] = $ua->recuperar('ftp_user', 'texto', false, false, $isPurple);
            $recordset['ftp_senha'] = $ua->recuperar('ftp_senha', 'texto', false, false, $isPurple);
            $recordset['host'] = $ua->recuperar('host', 'texto', false, false, $isPurple);//Host site, ftp
            
            $recordset['dominio']  = $ua->recuperar('dominio', 'texto', false, false, $isPurple);
        
        }
        
        //*** TODO *** usado em cobrança, deixar mais leve pois na cobrança só precisa de vencimento//
        //$recordset['tipo_dominio']  = $ua->recuperar('tipo_dominio', 'texto', false, false, $isPurple);        
        //$recordset['cobrar']  = $ua->recuperar('cobrar', 'inteiro', false, false, $isPurple);        
        //$recordset['invoicetotal'] = $ua->recuperar('invoicetotal', 'number', false, false, $isPurple);//Host site, ftp
        
        $recordset['vencimento'] = $ua->recuperar('vencimento_cliente', 'texto', false, false, $isPurple);//Host site, ftp
        
        //Tipo de dominio: Comun, SSL, Subdominio
        //if(isset($recordset['tipo_dominio']) && $recordset['tipo_dominio'] == 0){
            //$tipo_url = 'http://www.';
        //}else if(isset($recordset['tipo_dominio']) && $recordset['tipo_dominio'] == 1){
             //$tipo_url = 'https://www.';
        //}else{
             //$tipo_url = '';
        //}        
         
        //$recordset['url']  = $tipo_url . $recordset['dominio'];
        
        $recordset['id'] = $id_user;
    
        return $recordset;
    }

    /**
     * Método para retornar os clientes integrados a um certo cliente
     * 
     * @param number
     *
    */
    public static function getIntegrados($id_user) {   
            
        $sql = "SELECT user_id, inteiro FROM user_attribute WHERE inteiro = $id_user AND name = 'integrado'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryAll();
        
        return $recordset;
    }

    /**
     * Método para retornar o número de novos clientes cadastrados no banco
     *
     * @param number
     * @param string $type
     * @return
     */
    public static function getNewUsersByDate($month = "", $type = 'all', $isRecords = false, $year = null, $isAll = false) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month, $year);

        $query = "SELECT COUNT(*) FROM user_data WHERE creation >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND creation < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00'";
        $sql   = "SELECT * FROM user_data WHERE creation >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND creation < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00'";
        if($isAll) $sql   = "SELECT * FROM user_data";
        
        if(!$isRecords){
            $sqlRowsClientes =
                Yii::app()->db->createCommand("SELECT COUNT(*) FROM user_data WHERE creation >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND creation < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00'")->queryScalar();
            if ($type != 'all')
                $sqlRowsClientes = Yii::app()->db->createCommand("SELECT COUNT(*) FROM user_data WHERE type = $type AND (creation >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND creation < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00')")->queryScalar();
            if ($sqlRowsClientes != '0')
                $recordset['clientes'] = $sqlRowsClientes;
        }else{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['creation_string'] = DateTimeUtils::getDateFormate($recordset[$i]['creation']);
                }
            }
        }
        
        if($isRecords) return $recordset;
        return $sqlRowsClientes;
    }

    /**
     * Método para separar nome string em nome e sobrenome
     *
     * @param string
     * @return array
     */
    public static function separateName($name) {
        try {
            $last_name = "";
            $user_name = explode(" ", $name);
            
            if (count($user_name) > 0) {
                for($p = 0; $p < count($user_name); $p++) {
                    if ($p == 0) {
                        $name = $user_name[0];
                    } else {
                        if ($p < count($user_name) -1) {
                            $last_name .= $user_name[$p] . " ";                
                        } else {
                            $last_name .= $user_name[$p];
                        }
                    }
                }
            }

            $result = array();
            $result['name'] = $name;
            $result['lastname'] = $last_name;

            return $result;
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- separateName()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - separateName() " . $e->getMessage();
        }
    }

    /** Get all companies by user */
    public static function getAllCompanies($id = NULL, $isAll = true){
        
        $query = "SELECT id, nome_fantasia, cnpj FROM user_company WHERE id_user = $id";
        
        try{
            $prepare = Yii::app()->db->createCommand($query);
            
            if( $isAll) $result = $prepare->queryAll();
            if(!$isAll) $result = $prepare->queryRow();
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- getAllCompanies()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getAllCompanies " . $e->getMessage();
        }
    }

    /*
     * Get all user by spec is_client, is_student 
     */
    public static function getAllUsersBySpec($spec = 'is_client', $data = array()){
        
        $query = "SELECT * FROM user_data WHERE $spec = 1";
        if(isset($data['query']) && $data['query'] == 'cobranca')$query = "SELECT id, field1, field2, vencimento, dominio, emails_extra, type FROM user_data WHERE $spec = 1";
        if(isset($data['query']) && $data['query'] == 'cobrar') $query = "SELECT * FROM user_data WHERE $spec = 1 AND is_cobrar = 1";
        $session = MethodUtils::getSessionData();
        //if($session[$spec] != '') return $session[$spec];
        
        try{
            $prepare = Yii::app()->db->createCommand($query);            
            $recordset = $prepare->queryAll();   
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);
                    $recordset[$i]['nome'] = $recordset[$i]['name'];

                    //Account info
                    $recordset[$i]['type_name'] = UserUtils::getUserTypeString($recordset[$i]['type']);
                }
            }
            
            //$set = MethodUtils::setSessionData($spec, $recordset);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils- getAllUserBySpec()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserUtils - getAllUserBySpec()" . $e->getMessage();
        }
    }
    
    public static function getEstadoCivilById($id) {
        
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        if($id != ''){ 
            //$recordset = BancoCurriculosUtils::getStringValueByParent($id, 'estado_civil'); 
            if($id == '0'){ $recordset = Yii::t('messageStrings', 'message_results_not_informated');}
            if($id == '1'){ $recordset = "Casado(a)";}
            if($id == '2'){ $recordset = "Solteiro(a)";}
            if($id == '3'){ $recordset = "Divorciado(a)";}
            if($id == '4'){ $recordset = "Viúvo(a)";}
            if($id == '5'){ $recordset = "União estável";}            
        }
        
        if($id == '') $recordset = Yii::t('messageStrings', 'message_results_not_informated');
            
        return $recordset;        
    }
    
    /*
     * Set lastUpdate value
     * 
     * @param id
     * 
     */
    public static function setLastUpdate($id){
        
        $recordset = UserUtils::updateUserInfo('login', date("Y-m-d H:i:s"), $id);
        return $recordset;
        
    }
    
    /*
     * CheckidPier
     * 
     * @param id
     * 
     */
    public static function checkIdPier($id, $session){
        
        if($session['user_id_pier'] == '0'){
            $set = UserUtils::updateUserInfo('id_pier', $session['id_pier'], $id);
            MethodUtils::setSessionData('user_id_pier', $session['id_pier']);
        }
    }
    
    /*
     * Set lastUpdate value
     * 
     * @param id
     * 
     */
    public static function checkTypeByDocument($documento = "", $type = "", $check = 'associado'){
        
        $recordset = UserUtils::checkAttribute('texto', $documento, $all = false, $isUser = false, $isLabel = true);
        
        if($recordset){
            $recordset = UserUtils::checkAttribute($type, $check, $all = false, $recordset['user_id'], $isLabel = true);
        }
        
        return $recordset;        
    }
    
    /*
     * Get address by cep
     * 
     * @param id
     * 
     */
    public static function getAddressByCEP($cep){        
        Yii::import('application.extensions.utils.special.CepUtils');
        return CepUtils::getCep($cep, true);    
    }
    
    /*
     * Save address     
     * @param array
     * 
     */
    public static function saveAddress($data){        
        
        Yii::import('application.extensions.dbuzz.admin.UsersManager');
        $userHander = new UsersManager();
        
        $result = $userHander->saveUserAddress($data, $data['id']);
        return $result;
           
    }
    
    /**
     * Método para obter os atributos do tipo de tag
     * 
     * @param string
     *
    */
    public static function getUserDetailsByTag($tag, $id_user){ 
        
        $result = array();
        
        try {
            if($tag == 'clientes'){
                $result['id_user'] = $id_user;
                $result['descricao'] = UserUtils::getAttribute('descricao_cliente', 'descricao', $id_user);
                $result['image'] = UserUtils::getAttribute('img_cliente', 'texto', $id_user);
                $result['site'] = UserUtils::getAttribute('site', 'texto', $id_user);
                $result['view'] = 'detalhes_cliente';
            }
            
            if($tag == 'funcionario'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $result = ERPUtils::getFuncionarioInformation($id_user);
            }
            
            if($tag == 'parceiro'){
                $result['id_user'] = $id_user;
      
                $result['image'] = UserUtils::getAttribute('logo_partner', 'texto', $id_user);
                $result['site_partner'] = UserUtils::getAttribute('site_partner', 'texto', $id_user);
                $result['view'] = 'editar_cliente_parceiro';
            }
            
            if($tag == 'profissional'){
                $result['id_user'] = $id_user;
      
                $result['profissao'] = UserUtils::getAttribute('profissao_profissional', 'texto', $id_user);
                $result['formacao'] = UserUtils::getAttribute('formacao_profissional', 'descricao', $id_user);
                $result['descricao'] = UserUtils::getAttribute('descricao_profissional', 'descricao', $id_user);
                $result['atividade'] = UserUtils::getAttribute('atividade_profissional', 'descricao', $id_user);
                $result['view'] = 'editar_cliente_profissional';
            }
           
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserByTag()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserSupportUtils - getUserByTag() ' . $e->getMessage();
        }
    }
    
    /*
     * Cria uma conta de usuário com o mínimo de informação
     * 
     * @params $_POST
     * 
     */
    public static function createDrillAccount($isArgs = false, $is_echo = true){
        
        try{
            if(!$isArgs){
                (isset($_POST['email'])) ? $valida_email = true : $valida_email = false;
                (isset($_POST['name'])) ? $valida_name = true : $valida_name = false;
                if(isset($_POST['avatar'])) $data['avatar'] = $_POST['avatar'];

                $data['email'] = $_POST['email'];            
                $nome = UserUtils::separateName($_POST['name']);
                if(isset($_POST['ignore_email']) && $_POST['ignore_email']) $data['ignore_email'] = true;
            }

            if( $isArgs){
                (isset($isArgs['email'])) ? $valida_email = true : $valida_email = false;
                (isset($isArgs['name'])) ? $valida_name = true : $valida_name = false;
                if(isset($isArgs['avatar'])) $data['avatar'] = $isArgs['avatar'];

                $data['email'] = $isArgs['email'];            
                $nome = UserUtils::separateName($isArgs['name']);
                if(isset($isArgs['ignore_email']) && $isArgs['ignore_email']) $data['ignore_email'] = true;
            }

            if($valida_email && $valida_name){            
                
                Yii::import('application.extensions.utils.StringUtils'); 
                $data['field1'] = $nome['name'];
                $data['field2'] = $nome['lastname'];
                if(isset($_POST['telefone'])){$data['telefone'] = $_POST['telefone'];}else{$data['telefone'] = "";}
                if(isset($_POST['celular'])){$data['celular'] = $_POST['celular'];}else{$data['celular'] = "";}
                
                //Se for params não precisa definir else
                if(isset($isArgs['telefone'])){$data['telefone'] = StringUtils::replacePhone($isArgs['telefone']);}
                if(isset($isArgs['celular'])){$data['celular'] = StringUtils::replacePhone($isArgs['celular']);}
                
                $data['password'] = MethodUtils::getRandomPassword();            

                $id = UserUtils::createQuickUserAccount($data, true, true);
                
                $set = UserUtils::saveUserJson($data, $id);

                $result = array("result" => 1, "id" => $id);

            }else{
                $result = array("result" => 0, "erro" => 'não conseguiu', "id" => 0);            
            }

            if( $is_echo) echo json_encode($result);
            if(!$is_echo) return $result;
        
    
        }catch(Exception $ex){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - createDrillAccount() ', 'trace' => $e->getMessage()), true);
            echo "ERROR - UserUtils - createDrillAccount() " .$e->getMessage();            
        }
    }
    
    /**
     * 
     * Método para recuperar todos os cool avatars 
     * do database, este separa por tipos.
     * 
     * Tipos: produtos, eventos, avatars.
     *
     */
    public static function getAllAvatars($tipo = 3){   

        $select = "id, id_categoria, titulo, cool_p, cool_m, cool_g, cool_j, data, valor";
        $sql = "SELECT $select FROM conteudo_cool WHERE id_tipo = 2 AND id_categoria = $tipo ORDER BY id ASC LIMIT 0, 26";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
            //$recordset['records'] = $this->getRows("todas");     
            return $recordset;

        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - getAllAvatars() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getAllAvatars() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getAllAvatars() ' . $e->getMessage();
        }
    }
    
    /**
     * 
     * Assinatura
     * 
     *@params array
     * 
     */
    public static function assinaturaHandler($data = array()){   
        
        Yii::import('application.extensions.utils.DateTimeUtils'); 
        $select = "id, nome, show_transport, preco_real";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE id = {$data['id_produto']} AND tipo = 'assinatura'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                if($data['query'] == 'periodo'){
                   
                    $recordset['expire'] = "0000-00-00";
                    if($recordset['show_transport'] == '1') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 1, 0, 0, 0, 0, 0, 'add', true);
                    if($recordset['show_transport'] == '2') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 0, 6, 0, 0, 0, 0, 'add', true);
                    if($recordset['show_transport'] == '3') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 0, 3, 0, 0, 0, 0, 'add', true);
                    if($recordset['show_transport'] == '4') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 0, 1, 0, 0, 0, 0, 'add', true);
                    if($recordset['show_transport'] == '5') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 0, 0, 15, 0, 0, 0, 'add', true);
                    if($recordset['show_transport'] == '6') $recordset['expire'] = DateTimeUtils::addTimeToDate($data['date'], 0, 0, 7, 0, 0, 0, 'add', true);
                }
            }
                
            return $recordset;

        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - assinaturaHandler() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - assinaturaHandler() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - assinaturaHandler() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para retornar o nome e sobrenome do usuário
     *
     * @param number
     * @return string
     */
    public static function getUserJsonById($id_user = NULL, $callback = false){
        
        $obiz = HelperUtils::getObiz();
        
        if(!$obiz) $sql = "SELECT id, json FROM user_data WHERE id = $id_user";
        if( $obiz) $sql = "SELECT id, AES_DECRYPT(json, {$obiz['serial']}) AS json FROM user_data WHERE id = $id_user";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try{
            $recordset = Yii::app()->db->createCommand($sql)->queryRow();
            if($recordset && $callback == 'json_decode') return json_decode($recordset['json'], true);
            if($recordset && $callback) return $recordset[$callback];
            return $recordset;

        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - getUserJsonById() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserJsonById() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getUserJsonById() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar as informações json do usuário
     *
     * @param number
     * 
     */
    public static function saveUserJson($args, $id_user){ 
        
        Yii::import('application.extensions.utils.StringUtils');
        
        try{
            $obiz = HelperUtils::getObiz();
            
            $recordset = UserUtils::getUserJsonById($id_user, 'json');                
            $json = array();
            if($recordset) $json = json_decode($recordset, true);
            
            if(isset($args['field1'])) $json['field1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['field1']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['field2'])) $json['field2'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['field2']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['email'])) $json['email'] = $args['email'];
            if(isset($args['documento'])) $json['documento'] = StringUtils::clearString($args['documento'], 'document');
            if(isset($args['rg'])) $json['rg'] = StringUtils::clearString($args['rg'], 'document');
            if(isset($args['estado_civil'])) $json['estado_civil'] = $args['estado_civil'];
            if(isset($args['info'])) $json['info'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['info']), ENT_QUOTES, 'utf-8', false)));
            
            if(isset($args['telefone'])) $json['telefone'] = StringUtils::replacePhone($args['telefone']);
            if(isset($args['telefone2'])) $json['telefone2'] = StringUtils::replacePhone($args['telefone2']);
            if(isset($args['telefone3'])) $json['telefone3'] = StringUtils::replacePhone($args['telefone3']);
            if(isset($args['celular'])) $json['celular'] = StringUtils::replacePhone($args['celular']);
            if(isset($args['endereco'])) $json['endereco'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['endereco']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['numero'])) $json['numero'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['numero']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['cidade'])) $json['cidade'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['cidade']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['bairro'])) $json['bairro'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['bairro']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['complemento'])) $json['complemento'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['complemento']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['uf'])) $json['cuf'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)StringUtils::jsonFy($args['uf']), ENT_QUOTES, 'utf-8', false)));
            if(isset($args['cep'])) $json['cep'] = StringUtils::clearString($args['cep'], 'cep');
            if(isset($args['file_doc_helper'])) $json['file_doc_helper'] = $args['file_doc_helper'];
            if(isset($args['file_doc_helper2'])) $json['file_doc_helper2'] = $args['file_doc_helper2'];
            if(isset($args['area'])) $json['area'] = $args['area'];
            
            $json = json_encode($json);
            $set = UserUtils::updateUserInfo('json', $json, $id_user, array('obiz' => $obiz));
            return $set;

        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - saveUserJson() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - saveUserJson() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - saveUserJson() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para retornar as informaçoes de login do usuario 
     *
     */
    public static function getUserPwd($id) {
           
        try{
            $sql = "SELECT id, email, password, type FROM user_data WHERE id = $id";       
            $recordset = Yii::app()->db->createCommand($sql)->queryRow();

            return $recordset;
        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - getUserPwd() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getUserPwd() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getUserPwd() ' . $e->getMessage();
        }
    }
    
    /**
     * Checa se precisa de um status especifico
     *
     */
    public static function checkAccountLocked(){
           
        try{
            
            $status = 0;//Ativo, cadeado verdinho
            //Se aplicativo Classificados
            if((defined('Settings::PIER_CLASSIFICADOS') && Settings::PIER_CLASSIFICADOS)){
                Yii::import('application.extensions.utils.ProdutosUtils');
                $attr = ProdutosUtils::getEcommerceDetails(true, 'classificado');
                if(isset($attr['docs_validate']) && $attr['docs_validate']) $status = 10; //Triagem se for 3 aguardando não libera os documentos
            }
            
            return $status;
            
        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - checkAccountLocked() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils -checkAccountLocked() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - checkAccountLocked() ' . $e->getMessage();
        }
    }
    
    /**
     * Pega os integradores
     *
     */
    public static function getIntegradores($id_user = null){
           
        try{
            
            $result = false;
            //Se aplicativo Integradores Defined
            if((defined('Settings::INTEGRADORES') && Settings::INTEGRADORES)){
                
                $obiz = HelperUtils::getObiz();
                
                $result['intService1'] = UserUtils::getAttribute('intService1', 'texto', $id_user, false, false, false, array('obiz' => $obiz));
                if($result['intService1']) $result['intService1'] = json_decode($result['intService1'], true);
            }
            
            return $result;
            
        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - getIntegradores() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getIntegradores() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getIntegradores() ' . $e->getMessage();
        }
    }
    
    /**
     * Pega os settings
     *
     */
    public static function getSettings($data = array()){
           
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        try{
            $session = MethodUtils::getSessionData();
            $result = false;
            
            if(isset($data['admin']) && $data['admin']){

                //Verify if it was storaged some data previously
                //if($session["SES_useradmin_details"] != '') return $session["SES_useradmin_details"];
                $result['termosa'] = PreferencesUtils::getAttributes("termosa", "inteiro");
                $result['termosOa'] = PreferencesUtils::getAttributes("termosOa", "inteiro");
                $result['keysa'] = PreferencesUtils::getAttributes("keysa", "inteiro");
                $result['ramosa'] = PreferencesUtils::getAttributes("ramosa", "inteiro");
                $result['slogana'] = PreferencesUtils::getAttributes("slogana", "inteiro");
                $result['sociala'] = PreferencesUtils::getAttributes("sociala", "inteiro");
                $result['newslettera'] = PreferencesUtils::getAttributes("newslettera", "inteiro");
                $result['gendera'] = PreferencesUtils::getAttributes("gendera", "inteiro");
                $result['relationa'] = PreferencesUtils::getAttributes("relationa", "inteiro");
                $result['birthdaya'] = PreferencesUtils::getAttributes("birthdaya", "inteiro");
                $result['avatara'] = PreferencesUtils::getAttributes("avatara", "inteiro");
                $result['nicka'] = PreferencesUtils::getAttributes("nicka", "inteiro");
                $result['tagsa'] = PreferencesUtils::getAttributes("tagsa", "inteiro");
                
                $result['cpfa'] = PreferencesUtils::getAttributes("cpfa", "inteiro");
                $result['cpfOa'] = PreferencesUtils::getAttributes("cpfOa", "inteiro");
                $result['rga'] = PreferencesUtils::getAttributes("rga", "inteiro");
                $result['rgOa'] = PreferencesUtils::getAttributes("rgOa", "inteiro");
                
                $result['telefonea'] = PreferencesUtils::getAttributes("telefonea", "inteiro");
                $result['telefoneOa'] = PreferencesUtils::getAttributes("telefoneOa", "inteiro");
                $result['celulara'] = PreferencesUtils::getAttributes("celulara", "inteiro");
                $result['celularOa'] = PreferencesUtils::getAttributes("celularOa", "inteiro");
                $result['telefonesadicionaisa'] = PreferencesUtils::getAttributes("telefonesadicionaisa", "inteiro");
                
                $result['enderecoa'] = PreferencesUtils::getAttributes("enderecoa", "inteiro");
                $result['enderecoOa'] = PreferencesUtils::getAttributes("enderecoOa", "inteiro");
                
                $result['bairroc'] = PreferencesUtils::getAttributes("bairroc", "inteiro");
                $result['bairroOc'] = PreferencesUtils::getAttributes("bairroOc", "inteiro");
                
                $result['cepa'] = PreferencesUtils::getAttributes("cepa", "inteiro");
                $result['cepOa'] = PreferencesUtils::getAttributes("cepOa", "inteiro");
                $result['paisa'] = PreferencesUtils::getAttributes("paisa", "inteiro");
                $result['paisOa'] = PreferencesUtils::getAttributes("paisOa", "inteiro");
                
                $result['integradoresa'] = PreferencesUtils::getAttributes("integradoresa", "inteiro");
            }
            
            //Se for conta do usuario
            if((isset($data['conta']) && $data['conta']) || (isset($data['users']) && $data['users'])){
                
                //Verify if it was storaged some data previously
                //if($session["SES_useradmin_details"] != '') return $session["SES_useradmin_details"];                
                $result['termosc'] = PreferencesUtils::getAttributes("termosc", "inteiro");
                $result['termosOc'] = PreferencesUtils::getAttributes("termosOc", "inteiro");
                $result['keysc'] = PreferencesUtils::getAttributes("keysc", "inteiro");
                $result['ramosc'] = PreferencesUtils::getAttributes("ramosc", "inteiro");
                $result['sloganc'] = PreferencesUtils::getAttributes("sloganc", "inteiro");
                $result['socialc'] = PreferencesUtils::getAttributes("socialc", "inteiro");
                $result['newsletterc'] = PreferencesUtils::getAttributes("newsletterc", "inteiro");
                $result['genderc'] = PreferencesUtils::getAttributes("genderc", "inteiro");
                $result['relationc'] = PreferencesUtils::getAttributes("relationc", "inteiro");
                $result['birthdayc'] = PreferencesUtils::getAttributes("birthdayc", "inteiro");
                $result['avatarc'] = PreferencesUtils::getAttributes("avatarc", "inteiro");
                $result['picturec'] = PreferencesUtils::getAttributes("picturec", "inteiro");
                $result['nickc'] = PreferencesUtils::getAttributes("nickc", "inteiro");
                $result['tagsc'] = PreferencesUtils::getAttributes("tagsc", "inteiro");
                
                $result['cpfc'] = PreferencesUtils::getAttributes("cpfc", "inteiro");
                $result['cpfOc'] = PreferencesUtils::getAttributes("cpfOc", "inteiro");
                $result['rgc'] = PreferencesUtils::getAttributes("rgc", "inteiro");
                $result['rgOc'] = PreferencesUtils::getAttributes("rgOc", "inteiro");
                
                $result['telefonec'] = PreferencesUtils::getAttributes("telefonec", "inteiro");
                $result['telefoneOc'] = PreferencesUtils::getAttributes("telefoneOc", "inteiro");
                $result['celularc'] = PreferencesUtils::getAttributes("celularc", "inteiro");
                $result['celularOc'] = PreferencesUtils::getAttributes("celularOc", "inteiro");
                $result['telefonesadicionaisc'] = PreferencesUtils::getAttributes("telefonesadicionaisc", "inteiro");
                
                $result['enderecoc'] = PreferencesUtils::getAttributes("enderecoc", "inteiro");
                $result['enderecoOc'] = PreferencesUtils::getAttributes("enderecoOc", "inteiro");
                
                $result['bairroc'] = PreferencesUtils::getAttributes("bairroc", "inteiro");
                $result['bairroOc'] = PreferencesUtils::getAttributes("bairroOc", "inteiro");
                
                $result['cepc'] = PreferencesUtils::getAttributes("cepc", "inteiro");
                $result['cepOc'] = PreferencesUtils::getAttributes("cepOc", "inteiro");
                $result['paisc'] = PreferencesUtils::getAttributes("paisc", "inteiro");
                $result['paisOc'] = PreferencesUtils::getAttributes("paisOc", "inteiro");
                
                $result['integradoresc'] = PreferencesUtils::getAttributes("integradoresc", "inteiro");
                
            }
            //var_dump($result);
            return $result;
            
        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - getSettings() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - getSettings() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - getSettings() ' . $e->getMessage();
        }
    }
    
    /**
     * Update os settings
     *
     */
    public static function updateSettings(){
           
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        try{
           
            $params = array();
            parse_str($_POST['data'], $params);
                        
            if(isset($params['termosa'])) $set = PreferencesUtils::setAttributes("termosa", $params['termosa'], "inteiro");
            if(isset($params['termosOa'])) $set = PreferencesUtils::setAttributes("termosOa", $params['termosOa'], "inteiro");
            if(isset($params['termosc'])) $set = PreferencesUtils::setAttributes("termosc", $params['termosc'], "inteiro");
            if(isset($params['termosOc'])) $set = PreferencesUtils::setAttributes("termosOc", $params['termosOc'], "inteiro");
            
            if(isset($params['keysa'])) $set = PreferencesUtils::setAttributes("keysa", $params['keysa'], "inteiro");
            if(isset($params['keysc'])) $set = PreferencesUtils::setAttributes("keysc", $params['keysc'], "inteiro");
            
            if(isset($params['ramosa'])) $set = PreferencesUtils::setAttributes("ramosa", $params['ramosa'], "inteiro");
            if(isset($params['ramosc'])) $set = PreferencesUtils::setAttributes("ramosc", $params['ramosc'], "inteiro");
            
            if(isset($params['slogana'])) $set = PreferencesUtils::setAttributes("slogana", $params['slogana'], "inteiro");
            if(isset($params['sloganc'])) $set = PreferencesUtils::setAttributes("sloganc", $params['sloganc'], "inteiro");
            
            if(isset($params['sociala'])) $set = PreferencesUtils::setAttributes("sociala", $params['sociala'], "inteiro");
            if(isset($params['socialc'])) $set = PreferencesUtils::setAttributes("socialc", $params['socialc'], "inteiro");
            
            if(isset($params['newslettera'])) $set = PreferencesUtils::setAttributes("newslettera", $params['newslettera'], "inteiro");
            if(isset($params['newsletterc'])) $set = PreferencesUtils::setAttributes("newsletterc", $params['newsletterc'], "inteiro");
            
            if(isset($params['gendera'])) $set = PreferencesUtils::setAttributes("gendera", $params['gendera'], "inteiro");
            if(isset($params['genderc'])) $set = PreferencesUtils::setAttributes("genderc", $params['genderc'], "inteiro");
            
            if(isset($params['relationa'])) $set = PreferencesUtils::setAttributes("relationa", $params['relationa'], "inteiro");
            if(isset($params['relationc'])) $set = PreferencesUtils::setAttributes("relationc", $params['relationc'], "inteiro");
            
            if(isset($params['birthdaya'])) $set = PreferencesUtils::setAttributes("birthdaya", $params['birthdaya'], "inteiro");
            if(isset($params['birthdayc'])) $set = PreferencesUtils::setAttributes("birthdayc", $params['birthdayc'], "inteiro");
            
            if(isset($params['avatara'])) $set = PreferencesUtils::setAttributes("avatara", $params['avatara'], "inteiro");
            if(isset($params['avatarc'])) $set = PreferencesUtils::setAttributes("avatarc", $params['avatarc'], "inteiro");
            if(isset($params['picturec'])) $set = PreferencesUtils::setAttributes("picturec", $params['picturec'], "inteiro");
            if(isset($params['nicka'])) $set = PreferencesUtils::setAttributes("nicka", $params['nicka'], "inteiro");
            if(isset($params['nickc'])) $set = PreferencesUtils::setAttributes("nickc", $params['nickc'], "inteiro");
            
            if(isset($params['tagsa'])) $set = PreferencesUtils::setAttributes("tagsa", $params['tagsa'], "inteiro");
            if(isset($params['tagsc'])) $set = PreferencesUtils::setAttributes("tagsc", $params['tagsc'], "inteiro");
            
            if(isset($params['cpfa'])) $set = PreferencesUtils::setAttributes("cpfa", $params['cpfa'], "inteiro");
            if(isset($params['cpfOc'])) $set = PreferencesUtils::setAttributes("cpfOc", $params['cpfOc'], "inteiro");
            if(isset($params['cpfc'])) $set = PreferencesUtils::setAttributes("cpfc", $params['cpfc'], "inteiro");
            if(isset($params['cpfOa'])) $set = PreferencesUtils::setAttributes("cpfOa", $params['cpfOa'], "inteiro");
            
            if(isset($params['rga'])) $set = PreferencesUtils::setAttributes("rga", $params['rga'], "inteiro");
            if(isset($params['rgOa'])) $set = PreferencesUtils::setAttributes("rgOa", $params['rgOa'], "inteiro");
            if(isset($params['rgc'])) $set = PreferencesUtils::setAttributes("rgc", $params['rgc'], "inteiro");
            if(isset($params['rgOc'])) $set = PreferencesUtils::setAttributes("rgOc", $params['rgOc'], "inteiro");
            
            if(isset($params['celulara'])) $set = PreferencesUtils::setAttributes("celulara", $params['celulara'], "inteiro");
            if(isset($params['celularOa'])) $set = PreferencesUtils::setAttributes("celularOa", $params['celularOa'], "inteiro");
            if(isset($params['celularc'])) $set = PreferencesUtils::setAttributes("celularc", $params['celularc'], "inteiro");
            if(isset($params['celularOc'])) $set = PreferencesUtils::setAttributes("celularOc", $params['celularOc'], "inteiro");
            
            if(isset($params['telefonea'])) $set = PreferencesUtils::setAttributes("telefonea", $params['telefonea'], "inteiro");
            if(isset($params['telefoneOa'])) $set = PreferencesUtils::setAttributes("telefoneOa", $params['telefoneOa'], "inteiro");
            if(isset($params['telefonec'])) $set = PreferencesUtils::setAttributes("telefonec", $params['telefonec'], "inteiro");
            if(isset($params['telefoneOc'])) $set = PreferencesUtils::setAttributes("telefoneOc", $params['telefoneOc'], "inteiro");
            
            if(isset($params['enderecoa'])) $set = PreferencesUtils::setAttributes("enderecoa", $params['enderecoa'], "inteiro");
            if(isset($params['enderecoOa'])) $set = PreferencesUtils::setAttributes("enderecoOa", $params['enderecoOa'], "inteiro");
            if(isset($params['enderecoc'])) $set = PreferencesUtils::setAttributes("enderecoc", $params['enderecoc'], "inteiro");
            if(isset($params['enderecoOc'])) $set = PreferencesUtils::setAttributes("enderecoOc", $params['enderecoOc'], "inteiro");
            
            if(isset($params['bairroa'])) $set = PreferencesUtils::setAttributes("bairroa", $params['bairroa'], "inteiro");
            if(isset($params['bairroOa'])) $set = PreferencesUtils::setAttributes("bairroOa", $params['bairroOa'], "inteiro");
            if(isset($params['bairroc'])) $set = PreferencesUtils::setAttributes("bairroc", $params['bairroc'], "inteiro");
            if(isset($params['bairroOc'])) $set = PreferencesUtils::setAttributes("bairroOc", $params['bairroOc'], "inteiro");
            
            if(isset($params['cepa'])) $set = PreferencesUtils::setAttributes("cepa", $params['cepa'], "inteiro");
            if(isset($params['cepOa'])) $set = PreferencesUtils::setAttributes("cepOa", $params['cepOa'], "inteiro");
            if(isset($params['cepc'])) $set = PreferencesUtils::setAttributes("cepc", $params['cepc'], "inteiro");
            if(isset($params['cepOc'])) $set = PreferencesUtils::setAttributes("cepOc", $params['telefoneOc'], "inteiro");
            
            if(isset($params['paisa'])) $set = PreferencesUtils::setAttributes("paisa", $params['paisa'], "inteiro");
            if(isset($params['paisOa'])) $set = PreferencesUtils::setAttributes("paisOa", $params['paisOa'], "inteiro");
            if(isset($params['paisc'])) $set = PreferencesUtils::setAttributes("paisc", $params['paisc'], "inteiro");
            if(isset($params['paisOc'])) $set = PreferencesUtils::setAttributes("paisOc", $params['paisOc'], "inteiro");
            
            if(isset($params['telefonesadicionaisa'])) $set = PreferencesUtils::setAttributes("telefonesadicionaisa", $params['telefonesadicionaisa'], "inteiro");
            if(isset($params['telefonesadicionaisc'])) $set = PreferencesUtils::setAttributes("telefonesadicionaisc", $params['telefonesadicionaisc'], "inteiro");
            
            if(isset($params['integradoresc'])) $set = PreferencesUtils::setAttributes("integradoresc", $params['integradoresc'], "inteiro");
            if(isset($params['integradoresa'])) $set = PreferencesUtils::setAttributes("integradoresa", $params['integradoresa'], "inteiro");
            
            $set = MethodUtils::setSessionData("SES_useradmin_details", "");
            $set = MethodUtils::setSessionData("SES_usera_details", "");
            
            return $set;
            
        }catch(CDbException $e){
            Yii::trace('ERROR - UserUtils - updateSettings() ' . $e->getMessage()); 
            MethodUtils::sendError(array('message' => 'ERROR - UserUtils - updateSettings() ', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserUtils - updateSettings() ' . $e->getMessage();
        }
    }
    
    /*
     * Validade mandatory fields
     * 
     */
    public static function validateFields($params = array()){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $error = array();
        
        if((!isset($params['vencimento']) || $params['vencimento'] == '')) $params['vencimento'] = 0;
        if( isset($params['birthday'])) $params['birthday'] = DateTimeUtils::setFormatDateNoTime($params['birthday']);
        if( (isset($params['avatar']) && $params['avatar'] == '') || (!isset($params['avatar']))){ $params['avatar'] = "/media/images/avatar/avatar_profile.jpg";}
        if(( isset($params['receive_news']))) $params['receive_news'] = MethodUtils::getBooleanNumber($params['receive_news']);
        if(( isset($params['concorda']))){ $params['concorda'] = MethodUtils::getBooleanNumber($params['concorda']);}else{$params['concorda'] = 0;}
        
        //Adiciona um prefixo para a obrigatoriedade
        if(isset($params['cHnalder']) == 'users'){$pref = 'c';}else{$pref = 'a';}
        
        if(isset($params['attrUser']["termosO$pref"]) && $params['attrUser']["termosO$pref"]){ if(!isset($params['concorda']) || (isset($params['concorda']) && !$params['concorda'])){$error[] = "É necessário Ler e ACEITAR os Termos e Condições";}}
        if(isset($params['attrUser']["celularO$pref"]) && $params['attrUser']["celularO$pref"]){ if(!isset($params['celular']) || (isset($params['celular']) && !$params['celular'])){$error[] = "É necessário preencher o campo Celular";}}
        if(isset($params['attrUser']["telefoneO$pref"]) && $params['attrUser']["telefoneO$pref"]){ if(!isset($params['telefone']) || (isset($params['telefone']) && !$params['telefone'])){$error[] = "É necessário preencher o campo Telefone";}}
        if(isset($params['attrUser']["cepO$pref"]) && $params['attrUser']["cepO$pref"]){ if(!isset($params['cep']) || (isset($params['cep']) && !$params['cep'])){$error[] = "É necessário preencher o campo Cep";}}
        if(isset($params['attrUser']["bairroO$pref"]) && $params['attrUser']["bairroO$pref"]){ if(!isset($params['bairro']) || (isset($params['bairro']) && !$params['bairro'])){$error[] = "É necessário preencher o campo Bairro";}}
        if(isset($params['attrUser']["enderecoO$pref"]) && $params['attrUser']["enderecoO$pref"]){ 
            
            if(!isset($params['endereco']) || (isset($params['endereco']) && $params['endereco'] == '')){$error[] = "É necessário preencher o campo Endereço";}
            if(!isset($params['numero']) || (isset($params['numero']) && $params['numero'] == '')){$error[] = "É necessário preencher o campo Número";}
            if(!isset($params['cidade']) || (isset($params['cidade']) && $params['cidade'] == '')){$error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'common_city');}
            if(!isset($params['estado']) || (isset($params['estado']) && $params['estado'] == '')){$error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'common_uf');}
        }
        
        if($params['email'] == ""){ $error[] = "É necessário preencher o campo E-mail";}
        
        if($params['tipo_conta'] != '1'){
            if(isset($params['attrUser']["cpfO$pref"]) && $params['attrUser']["cpfO$pref"]){ if(!isset($params['documento']) || (isset($params['documento']) && !$params['documento'])){$error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'doc_1');}}
            if(isset($params['attrUser']["rgO$pref"]) && $params['attrUser']["rgO$pref"]){ if(!isset($params['rg']) || (isset($params['rg']) && !$params['rg'])){$error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'doc_2');}}
        }else{
            
        }
        
        if(count($error) > 0) $params['errors'] = $error;
        
        return $params;
        
        // Barra campos obrigatórios que estejam vazios
        if($this->action == "pj" || $this->action == "editar_pj" || $this->action == 'salvar_pj'){
            ($params['formCadastroRazao'] == "" ? $error[] = "É necessário preencher o campo Razão Social" : "");
            ($params['formCadastroFantasia'] == "" ? $error[] = "É necessário preencher o campo Nome Fantasia" : "");
            if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)(Yii::app()->params['documento_mandatorio'] && $params['loginCadastradoTipoNumero'] == "" ? $error[] = "É necessário preencher o campo CNPJ" : "");
            if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formIdRamoAtuacao'] == "" ? $error[] = "É necessário preencher o campo Ramo de Atuação" : "");
            ($params['formCadastroResponsavel'] == "" ? $error[] = "É necessário preencher o campo Responsável" : "");

        }else{

            ($params['formCadastroNome'] == "" ? $error[] = "É necessário preencher o campo Nome" : "");
            ($params['formCadastroSobrenome'] == "" ? $error[] = "É necessário preencher o campo Sobrenome" : "");
            if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)(Yii::app()->params['documento_mandatorio'] && $params['loginCadastradoTipoNumero'] == "" ? $error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'doc_1') : "");
            //if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formCadastroRg'] == "" ? $error[] = "É necessário preencher o campo Rg" : "");
            //($params['formCadastroNascimento'] == "" ? $error[] = "É necessário preencher o campo data nascimento" : ""); 
            //if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formCadastroNascimento'] == "00/00/0000" ? $error[] = "É necessário preencher o campo data nascimento" : ""); 
            if($user) $data['account_status'] = $user['account_locked'];
        }
        
        $params['formTermosAceito'] = (isset($params['formTermosAceito']) ? "1" : "0");
        $params['formInfoNewsletter'] = (isset($params['formInfoNewsletter']) ? "1" : "0");
            
        ($params['loginCadastradoEmail'] == "" ? $error[] = "É necessário preencher o campo E-mail" : "");            
        if(($session['user_account_type'] != 2 && $session['user_account_type'] != 3 && $language == 'pt'))($params['formEnderecoCep'] == "" ? $error[] = "É necessário preencher o campo CEP" : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formEnderecoEndereco'] == "" ? $error[] = "É necessário preencher o campo Endereço" : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formEnderecoNumero'] == "" ? $error[] = "É necessário preencher o campo Numero" : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formEnderecoCidade'] == "" ? $error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'common_city') : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formEnderecoEstado'] == "" ? $error[] = "É necessário preencher o campo " . Yii::t('siteStrings', 'common_uf') : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3 && !$data['editar'])($params['formCredencialSenha'] == "" ? $error[] = "É necessário preencher o campo Senha" : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formCredencialSenha'] != "" && strlen($params['formCredencialSenha']) < 6 ? $error[] = "A senha tem que ter pelo menos 6 caracteres" : "");
        if($session['user_account_type'] != 2 && $session['user_account_type'] != 3)($params['formCredencialConfirma'] != $params['formCredencialSenha'] ? $error[] = "A senha tem que ser a mesma nos dois campos" : "");
        //if((isset($data['attrUser']['termosc']) && $data['attrUser']['termosc']) || (isset($data['attrUser']['termos_admin']) && $data['attrUser']['termos_admin'])){ ($params['formTermosAceito'] != "1" ? $error[] = "É necessário Ler e ACEITAR os Termos e Condições" : "");}
        //if(Yii::app()->params['telefone_mandatorio'] && ($params['formInfoCel'] == '' && $params['formInfoTel'] ==  '')) $error[] = "É necessário preencher o campo telefone ou celular";
        
        $data['json'] = array();
        if(isset($params['file_doc_helper'])) $data['json']['file_doc_helper'] = $params['file_doc_helper'];
        if(isset($params['file_doc_helper2'])) $data['json']['file_doc_helper2'] = $params['file_doc_helper2'];
        //(strlen($params['formInfoTelddd']) < 2 || strlen($params['formInfoTel']) < 8 ? $error[] = "É necessário preencher o campo Tel. fixo com um número válido" : "");
        
    }
    
    public static function setTagsToUser($params = array()){
        
        $atrib = $params['user_attributes'];
        $atributos_user = explode(", ", $atrib);
        $countAttr = count($atributos_user);
        //First it removes all prevously attributes
        if($countAttr > 0 && $data['editar']) UserUtils::clearUserAttributes($user_id);

        for($i = 0; $i < $countAttr; $i++){
            if($atributos_user[$i] != "") $ua->adicionar($atributos_user[$i], "permission_level", "texto"); 
            if($atributos_user[$i] == "cliente"){$user->is_client = 1; $user->save();}
        }
        //Bloquea a conta para avaliação
        $lockAccount = UserUtils::setLockedAccount("true", $user_id);
        if($type_user == "pj"){$type_user = Yii::t("siteStrings", "label_pj");}else{$type_user = Yii::t("siteStrings", "label_pf");};

        $date = date('Ymd');
        $data_email['nome'] =  $data['usuario_Nome'];                    
        $data_email['newsletter'] =  0;
        $data_email['email'] =  $user->email;
        $data_email['layout'] =  "user_attribute";
        $data_email['tipo'] =  "user_attribute";
        $data_email['tipo_conta'] = $type_user;
        $data_email['ramo_atuacao'] = 0;
        $data_email['abordagem'] = 1;

        //Yii::import('application.extensions.utils.special.NewsLetterUtils');
        //$defineAcceptance = NewsLetterUtils::insertPierMail($data_email, $date);
        //$sendEmail = MethodUtils::sendOrder($data_email);
        
    }
    
}
