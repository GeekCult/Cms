<?php
/**
 * This Class is used to control all functions related the feature Users
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */

class UsersManager {

    /**
     * Método para recuperar os registros da tabela usuários
     * esse método retorna apenas alguns dados não todos.
     *
     *
    */
    public function getAllContent($tipo = 0, $start = 0) {

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $start = $start * 10;
        $obiz = HelperUtils::getObiz();
        $query = "";
        if($tipo == '0') $query = ' OR type = 2 OR type = 3';
        
        if(!$obiz) $select = "id, field1, field2, email, type, creation, account_states_id, account_locked, status, obiz";
        if( $obiz) $select = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, type, creation, account_states_id, account_locked, status, obiz";
        $sql = "SELECT $select FROM user_data WHERE (type = $tipo $query) ORDER BY field1 ASC LIMIT $start, 10 ";
        if($tipo == 100) $sql = "SELECT $select FROM user_data ORDER BY field1 ASC LIMIT $start, 10 ";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++) {
                
                $recordset[$i] = HelperUtils::getCripto($recordset[$i], C::DECRYPT, array('email_obz' => false, 'obiz' => $recordset[$i]['obiz']));
                $recordset[$i]['account_states_id_string'] =  UserUtils::getSituation($recordset[$i]['account_states_id']);
                $recordset[$i]['account_status'] =  StatusUtils::getTypeStringToIcon($recordset[$i]['account_states_id']);
                $recordset[$i]['account_locked_string'] =  UserUtils::getLocked($recordset[$i]['account_locked']);
                $recordset[$i]['creation'] =  DateTimeUtils::getDateFormateNoTime($recordset[$i]['creation']);
                $recordset[$i]['type_name'] =  UserUtils::getUserTypeString($recordset[$i]['type']);
                $recordset[$i]['user_name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);
            }
            
            //Gets the rows amount
            //$sqlRows = DataBaseUtils::getCountRecords("user_data", "", "", true);
            //if ($sqlRows > 11) $sqlRows = ($sqlRows) / 5;
            //$recordset[0]['records'] = $sqlRows;

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllContent()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getAllContent: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros da tabela usuários
     * esse método retorna apenas alguns dados não todos.
     * 
     * TODO: Tem um metod dupe deste em CurriculosManager, possivelmente esse não está mais em uso ou apenas 
     * nas buscas de curriculos
     * 
     * @params string
     * @params string
     * @params string
     * @params number
     * 
     *
    */
    public function getAllContentByAttributes($attribute = "", $equation = " = ", $search_by = "", $field = "texto", $start = 0) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');

        try {
            $fields = "count(user_id) as 'total'";
            $prepare = Yii::app()->db->createCommand("SELECT $fields FROM user_attribute WHERE name = '$attribute' AND $field $equation $search_by");
            $total = $prepare->queryScalar();

            $fields = "user_id, $field";
            $prepare = Yii::app()->db->createCommand("SELECT $fields FROM user_attribute WHERE name = '$attribute' AND $field $equation $search_by LIMIT $start, 20");
            $recordset = $prepare->queryAll();

            for($i = 0; $i < count($recordset); $i++) {
               $recordset[$i]['user'] =  UserUtils::getUserFullById($recordset[$i]['user_id']);
               $recordset[$i]['curriculum'] = BancoCurriculosUtils::getResumeData($recordset[$i]['user_id']);
               
               if ($search_by == "trainee") {
                   $recordset[$i]['trainee'] = UserSupportUtils::getTraineeAttributes($recordset[$i]['user_id']);
                   $recordset[$i]['contato'] = UserUtils::getUserContacts($recordset[$i]['user_id']);
                   $recordset[$i]['endereco'] = UserUtils::getAddress($recordset[$i]['user_id']);
               }
            }

            $recordset['total'] = $total;
      
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllContentByAttributes()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getAllContentByAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros da tabela usuários
     * esse método retorna apenas alguns dados não todos.
     *
     *
    */
    public function getAllContentByFiltersLive($name, $profession){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        
        if($name != ""){
            $sql = "SELECT * FROM user_data WHERE (name_full LIKE '$name%' AND is_resume = 1) ORDER BY field1 ASC";
            $tipo = 'nome';
        }
        
        if($profession != ""){
            $sql = "SELECT * FROM user_data WHERE id_ramo_atuacao = $profession AND is_resume = 1";
            $tipo = 'profissao';
        }
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    
                    if($tipo == 'nome'){
                        $recordset[$i]['json'] = json_decode($recordset[$i]['json'], true);
                    }
                    
                    if($tipo == 'profissao'){
                        $recordset[$i]['json'] = json_decode($recordset[$i]['json'], true);
                    }
                }
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllContentByFiltersAttributes()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getAllContentByFiltersAttributes: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros da tabela usuários
     * esse método retorna apenas alguns dados não todos.
     *
     *
    */
    public function getAllContentByFiltersAttributes($name = "", $profession = "", $start = 0) {

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');

        if ($start < 10) $start = 0;

        $select = "user_data.id, user_data.field1, user_data.field2, user_data.email, user_data.type, user_attribute.name, user_attribute.texto, user_attribute.user_id";

        if ($name != "" && $profession == "")
            $sql = "SELECT $select FROM user_data INNER JOIN user_attribute ON user_data.id = user_attribute.user_id AND (user_attribute.name = 'usuario_Profissao') AND ((user_data.field1 LIKE '%$name%') OR (user_data.field2 LIKE '%$name%')) ORDER BY user_data.id ASC";
        if ($name == "" && $profession != "")
            $sql = "SELECT $select FROM user_data INNER JOIN user_attribute ON user_data.id = user_attribute.user_id AND (user_attribute.name = 'usuario_Profissao') AND ((user_attribute.texto LIKE '%$profession%')) ORDER BY user_data.id ASC";
        
        MethodUtils::setSessionData('checkAction', $sql);
        
        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            if ($recordset) {
                for($i = 0; $i < count($recordset); $i++) {
                   $recordset[$i]['user'] =  UserUtils::getUserFullById($recordset[$i]['user_id']);
                   $recordset[$i]['curriculum'] = BancoCurriculosUtils::getResumeData($recordset[$i]['user_id']);
                }
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllContentByFiltersAttributes()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getAllContentByFiltersAttributes: ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar os dados do usuários
     *
     * @param number
     *
     * @return bool
     */
    public function getContentById($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        
        $obiz = HelperUtils::getObiz();
        
        if(!$obiz) $select = "id, field1, field2, email, avatar, type, birthday, creation, account_states_id, reputation, account_locked, status, email_hash, json, dominio, vencimento, is_nota, pais";
        if( $obiz) $select = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, type, AES_DECRYPT(birthday, {$obiz['serial']}) AS birthday, creation, account_states_id, reputation, account_locked, status, email_hash, AES_DECRYPT(json, {$obiz['serial']}) AS json, dominio, vencimento, is_nota, pais";
        $sql = "SELECT $select FROM user_data WHERE id = $id";
        
        
        MethodUtils::setSessionData('checkAction', $sql);

        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $recordset['creation']  = DateTimeUtils::getDateFormateNoTime($recordset['creation']);
                
                $recordset['telefone'] = $ua->recuperar('usuario_Telefone', 'texto', false, false, false, array('obiz' => $obiz));
                $recordset['telefone_ddd'] = substr($recordset['telefone'], 0, 2);
                $recordset['telefone_numero'] = substr($recordset['telefone'], 2, 8);
                
                $recordset['celular'] = $ua->recuperar('usuario_Celular', 'texto', false, false, false, array('obiz' => $obiz));
                $recordset['celular_ddd'] = substr($recordset['celular'], 0, 2);
                $recordset['celular_numero'] = substr($recordset['celular'], 2, 9);
                
                if($recordset['type'] != 1){
                    $recordset['nome'] = $recordset['field1'] . ' ' . $recordset['field2'];
                    $recordset['documento'] = $ua->recuperar('usuario_CPF', 'texto', false, false, false, array('obiz' => $obiz));
                }else{
                    $recordset['nome'] = $recordset['field1'];                    
                    $recordset['contato'] = $ua->recuperar('usuario_Responsavel', 'texto',false, false, false, array('obiz' => $obiz));
                    $recordset['documento'] = $ua->recuperar('usuario_CNPJ', 'texto', false, false, false, array('obiz' => $obiz));
                }
                
                $recordset['endereco'] = UserUtils::getAddress($id);
                //var_dump($recordset['endereco']);
                $recordset['json'] = json_decode($recordset['json'], true);
                
                if(defined('Settings::PIER_CLASSIFICADOS') && Settings::PIER_CLASSIFICADOS){
                    $recordset['max_anuncios'] = $ua->recuperar('max_anuncios', 'inteiro');
                    $recordset['destaques'] = $ua->recuperar('destaques', 'inteiro');
                }
                
                if(defined('Settings::DATALOG') && Settings::DATALOG){
                    $recordset['nr_operador'] = $ua->recuperar('nr_operador', 'inteiro');
                }

            }
            //var_dump($recordset);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getContentById()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getContentById: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os dados do usuário.
     * Esse método retorna até os endereços, e etc.
     * É utilizado nos PagamentosActions()
     *
     * @param number
     *
    */
    public function getFullContentById($id = null, $data = array()) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $obiz = HelperUtils::getObiz();
        
        if(!$obiz) $select  = "id, field1, field2, email, avatar, frase, cidade, json, ";
        if( $obiz) $select  = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(frase, {$obiz['serial']}) AS frase, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, AES_DECRYPT(json, {$obiz['serial']}) AS json, ";
        $select .= "vencimento, is_nota, dominio, receive_news, type, creation, account_states_id, account_locked, type, reputation, reputation_lower, reputation_higher, reputation_total, reputation_count, birthday, keywords, ramo_atuacao, id_ramo_atuacao, concorda, keywords, company";
        $sql = "SELECT $select FROM user_data WHERE id = $id";
        
        MethodUtils::setSessionData('checkAction', $sql);
        $session = MethodUtils::getSessionData();
        
        try{
            if($id != null && $id != 0 && $id != ''){
                
                $command = Yii::app()->db->createCommand($sql);
                $recordset = $command->queryRow();
             
                //Se for uma chamada do ecommerce verifica se deseja outro endereço
                if($session['local_entrega'] == '' || $session['local_entrega'] == '1'){
                    $recordset['endereco'] = UserUtils::getAddress($id, false);
                }else{
                    Yii::import('application.extensions.utils.ProdutosUtils');
                    $recordset['endereco'] = ProdutosUtils::getLocalEntrega($id, $session['local_entrega'], 'full');
                }
                
                $recordset['nome'] = UserUtils::getNameUser($recordset['field1'], $recordset['field2'], $recordset['type']);
                 
                $recordset['documentos'] = UserUtils::getDocuments($id, $recordset['type']);
                $recordset['contato'] = UserUtils::getUserContacts($id, $recordset['type']);
                $recordset['birthday'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['birthday']);
                
                //Infos
                if ($recordset && isset($data['gender'])) $estado_civil = UserUtils::getAttribute('usuario_EstadoCivil', 'inteiro', $id);
                if ($recordset && isset($data['gender'])) $recordset['estado_civil'] = UserUtils::getEstadoCivilById($estado_civil);
                if ($recordset && isset($data['gender'])) $recordset['estado_civil_id'] = $estado_civil;
                if ($recordset && isset($data['gender'])) $recordset['sexo'] = UserUtils::getAttribute('usuario_Sexo', 'texto', $id);

                //Profissao
                if ($recordset && isset($data['profissao'])) $recordset['profissao'] = UserUtils::getAttribute('profissao_profissional', 'texto', $id);
                if ($recordset && isset($data['profissao'])) $recordset['profissao_id'] = UserUtils::getAttribute('usuario_id_Profissao', 'inteiro', $id);            

                //Redes Sociais
                if(isset($data['redes_sociais'])){
                    if ($recordset) $recordset['facebook'] = UserUtils::getAttribute('usuario_Facebook', 'texto', $id);
                    if ($recordset) $recordset['twitter'] = UserUtils::getAttribute('usuario_Twitter', 'texto', $id);
                    if ($recordset) $recordset['linkedin'] = UserUtils::getAttribute('usuario_Linkedin', 'texto', $id);                
                }

                //$recordset['resume'] = BancoCurriculosUtils::getResumeData($id, true);
                $recordset['json'] = json_decode($recordset['json'], true);                
                
            }else{
                $recordset = UserUtils::getClearDataUser();
            }
          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getFullContentById()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getFullContentById: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar os dados do  usuário
     *
     *
     * @param number
     *
     * @return bool
     */
    public function saveUserData($data) {
        
        Yii::import('application.extensions.utils.EmailUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $date = date("Y-m-d H:i:s");
        if(!isset($data['documento'])) $data['documento'] = '';
        if(!isset($data['cpf'])) $data['cpf'] = $data['documento'];
        if(!isset($data['birthday'])) $data['birthday'] = "0000-00-00";
        if(!isset($data['keywords'])) $data['keywords'] = "";
        if(!isset($data['receive_news'])) $data['receive_news'] = 0;
        if(!isset($data['avatar'])) $data['avatar'] = "/media/images/avatar/avatar_profile.jpg";
        if(!isset($data['ramo_atuacao'])) $data['ramo_atuacao'] = 0;
        if(!isset($data['id_ramo_atuacao'])) $data['id_ramo_atuacao'] = 0;
        if(!isset($data['frase'])) $data['frase'] = '0';
        if(!isset($data['dominio'])) $data['dominio'] = '';
        if(!isset($data['company'])) $data['company'] = '';
        if(!isset($data['cidade'])) $data['cidade'] = '';
        if(!isset($data['descricao'])) $data['descricao'] = '';
        if(!isset($data['concorda'])) $data['concorda'] = 0;
        if(!isset($data['pais'])) $data['pais'] = 0;
        if(!isset($data['estado'])) $data['estado'] = 0;
        
        if(isset($data['tipo_conta'])) $data['type'] = $data['tipo_conta'];
        if(!isset($data['type'])){$fl_name = $data['field1'] . ' '. $data['field2'];}else{$fl_name = $data['field1'];}
        
        //Só se for Admin
        if($data['cHnalder'] == 'admin'){
            //add message in database
            if(!isset($data['account_locked'])) $data['account_locked'] = '1';
            if(!isset($data['account_state'])) $data['account_state'] = 1;
            if(!isset($data['cidade'])) $data['cidade'] = 0;
            if(!isset($data['id_cidade'])) $data['id_cidade'] = 0;
            if(!isset($data['pais'])) $data['pais'] = 0;
            //if($data['account_locked'] == '2') $data['account_state'] = 10; //Conta bloqueada
        }
            
        $isEmailExist = EmailUtils::checkEmailExist($data['email']);
        if($isEmailExist){$data['action'] = 'editar'; $data['id'] = $isEmailExist['id'];}
        
        $obiz = HelperUtils::getObiz();
                    
        if($data['action'] == "novo" ){
            
            $insert = "field1, field2, birthday, email, avatar, cidade, estado, documento, name_full, obiz, keywords, type, receive_news, password, email_hash, account_states_id, account_locked, dominio, descricao, last_update, is_nota, concorda, frase, reputation, lance, profile_level, date_extra, assinatura, reputation_lower, reputation_higher, reputation_total, reputation_count, resume, login, company, pais";
            if(!$obiz) $values  = "'{$data['field1']}', '{$data['field2']}', '{$data['birthday']}', '{$data['email']}', '{$data['avatar']}', '{$data['id_cidade']}',  '{$data['estado']}', '{$data['documento']}',  '$fl_name', 0,";
            if( $obiz) $values  = "AES_ENCRYPT('{$data['field1']}', {$obiz['serial']}), AES_ENCRYPT('{$data['field2']}', {$obiz['serial']}), AES_ENCRYPT('{$data['birthday']}', {$obiz['serial']}), AES_ENCRYPT('{$data['email']}', {$obiz['serial']}), AES_ENCRYPT('{$data['avatar']}', {$obiz['serial']}), AES_ENCRYPT('{$data['id_cidade']}', {$obiz['serial']}), AES_ENCRYPT('{$data['estado']}', {$obiz['serial']}), AES_ENCRYPT('{$data['documento']}', {$obiz['serial']}), AES_ENCRYPT('$fl_name', {$obiz['serial']}), 1, ";
            
            $values .=  "'{$data['keywords']}', '{$data['type']}', '{$data['receive_news']}', '{$data['password']}', '" . md5($data['email']) . "', ";
            $values .=  "'{$data['account_state']}', '{$data['account_locked']}', '{$data['dominio']}', '{$data['descricao']}', '{$date}', '{$data['nota']}', '{$data['concorda']}', '{$data['frase']}', 0, 0, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, '', '0000-00-00 00:00:00', '{$data['company']}', '{$data['pais']}'";
        }
        
        if($data['action'] != "novo" ){
            if(!$obiz) $update  = "field1 = '{$data['field1']}', field2 = '{$data['field2']}', birthday = '{$data['birthday']}', name_full = '$fl_name', avatar = '{$data['avatar']}', cidade = '{$data['id_cidade']}', estado = '{$data['estado']}', documento = '{$data['documento']}', obiz = 0, ";
            if( $obiz) $update  = "field1 = AES_ENCRYPT('{$data['field1']}', {$obiz['serial']}), field2 = AES_ENCRYPT('{$data['field2']}', {$obiz['serial']}), birthday = AES_ENCRYPT('{$data['birthday']}', {$obiz['serial']}),  name_full = AES_ENCRYPT('$fl_name', {$obiz['serial']}), avatar = AES_ENCRYPT('{$data['avatar']}', {$obiz['serial']}), cidade = AES_ENCRYPT('{$data['id_cidade']}', {$obiz['serial']}), estado = AES_ENCRYPT('{$data['estado']}', {$obiz['serial']}), documento = AES_ENCRYPT('{$data['documento']}', {$obiz['serial']}), name_full = AES_ENCRYPT('$fl_name', {$obiz['serial']}), obiz = 1, ";
            $update .= "receive_news = '{$data['receive_news']}', ramo_atuacao = '{$data['ramo_atuacao']}', id_ramo_atuacao = '{$data['id_ramo_atuacao']}', frase = '{$data['frase']}', last_update = '{$date}', keywords = '{$data['keywords']}', descricao = '{$data['descricao']}',";
            $update .= "dominio = '{$data['dominio']}', company = '{$data['company']}', company = '{$data['company']}', pais = '{$data['pais']}'";
            
            if(isset($data['update_email']) && !$obiz) $update .= ", email = '{$data['email']}' ";
            if(isset($data['update_email']) &&  $obiz) $update .= ", email = AES_ENCRYPT('{$data['email']}', {$obiz['serial']}) ";
                    
            if(isset($data['concorda'])) $update .= ", concorda = '{$data['concorda']}'";
            if(isset($data['account_state'])) $update .= ", account_states_id = '{$data['account_state']}'";
            if(isset($data['account_locked'])) $update .= ", account_locked = '{$data['account_locked']}'";
            if(isset($data['vencimento'])) $update .= ", vencimento = '{$data['vencimento']}'";if(isset($data['nota'])) $update .= ", is_nota = '{$data['nota']}'";
            if(isset($data['type'])) $update .= ", type = '{$data['type']}'";
        }
        
        

        try{            
            if($data['action'] != "editar"){                
                $sql = "INSERT INTO user_data ($insert) VALUES ($values)";
                MethodUtils::setSessionData('checkAction', $sql);
                $command = Yii::app()->db->createCommand($sql);
                $control = $command->execute();
                
                $id = Yii::app()->db->getLastInsertID();
                
                UserUtils::saveAditionalAttributes($data, $id);
                UserUtils::saveUserJson($data, $id);
                
            }else{  
                $sql = "UPDATE user_data SET $update WHERE id = {$data['id']}";
                
                MethodUtils::setSessionData('checkAction', $sql);
                $command = Yii::app()->db->createCommand($sql);
                $control = $command->execute();
                
                UserUtils::saveAditionalAttributes($data, $data['id']);
                UserUtils::saveUserJson($data, $data['id']);
                
                $id = $data['id'];        
            }
            
            //echo $sql;
            
            return array('result' => $control, 'id' => $id);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveuserData()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - saveUserData: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as categorias
     *
     *
    */
    public function getCategoriesUsers() {

        $select = "id, field1, field2, type, creation, account_states_id";
        $sql = "SELECT $select FROM user_data";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getCategoriesUsers()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getCategoriesUsers: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar os dados complementares
     * Pode ser de PF pu PJ
     * 
     * @param array
    */
    public function saveComplementData($get_post) {
        
        if ($get_post['type'] == "company") {
            
            $select = "razao_social, nome_fantasia, cnpj, data_aniversario, ramo_atividade, numero_funcionarios, ".
                      "porte_empresa, endereco, numero, bairro, cidade, estado, cep, email, telefone_1, telefone_2, id_user";
            
            $values = $get_post['razao_social']."', '".$get_post['nome_fantasia']."', '".$get_post['cnpj']."', '".$get_post['data_fundacao']."', '".$get_post['ramo_atividade']."', '".$get_post['num_funcionarios']."', '".
                      $get_post['porte_empresa']."', '".$get_post['endereco']."', '".$get_post['numero']."', '".$get_post['bairro']."', '".$get_post['cidade']."', '".$get_post['estado']."', '".
                      $get_post['cep']."', '".$get_post['email']."', '".$get_post['telefone_1']."', '".$get_post['telefone_2']."', '".$get_post['id_user'];
        }
        
        if ($get_post['type'] == "funcionario") {
            Yii::import('application.extensions.utils.DateTimeUtils');
            $data_nascimento = DateTimeUtils::setFormatDateNoTime($get_post['data_nascimento']);
            
            $select = "nome, data_aniversario, email, telefone_1, cpf, profissao, nome_fantasia, id_company";
            $values = $get_post['nome']."', '".$data_nascimento."', '".$get_post['email']."', '".$get_post['telefone']."', '".$get_post['documento']."', '".$get_post['profissao']."', '".
                      $get_post['empresa']."', '".$get_post['id_user'];
        }

        $sql =  "INSERT INTO user_company ($select) VALUES ('$values')";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            if($control && $get_post['type'] == "company") $this->updateProfileLevel("profile_" . $get_post['realizacao'], $get_post['id_user']);
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveCompementData()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - saveComplementData() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obetr os dados complementares
     * Pode ser de PF pu PJ
     * 
     * @param array
    */
    public function getComplementData($id){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $select = "id, nome, id_company, email, profissao, telefone_1, nome_fantasia, cpf, cnpj, rg, data_aniversario";
        $sql = "SELECT $select FROM user_company WHERE id_user = $id";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            if($recordset){
               $recordset['data_aniversario'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['data_aniversario']);
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getComplementData()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getComplementData: ' . $e->getMessage();
        }
    }

    /**
     * Método para salvar a compania que o usuario trabalha
     * Este método salva só a compania, poderá buscar ser a empresa
     * já é cadastrada e puxar os dados desta para agilizar.
     *
     * @param $data
     * @param $id_user
     * @return bool
     * @internal param $array
     */
    public function saveCompany($data, $id_user) {

        if(!isset($data['user']['user_id'])) $data['user']['user_id'] = 0;
        if(!isset($data['user']['nome'])) $data['user']['nome'] = '';
        
        $select = "cnpj, id_user, id_company, nome_fantasia";
        $values = $data['company']."', '".$id_user."', '".$data['user']['user_id']."', '".$data['user']['nome'];

        $sql = "INSERT INTO user_company ($select) VALUES ('$values')";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveCompany()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - saveCompany: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para excluir um registro existente
     * 
     *
     * @param number
     *
    */
    public function removeContent($id_user) {
        
        Yii::import('application.extensions.utils.users.UserUtils');

        $sql = "DELETE FROM user_data WHERE id = '$id_user'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Remove all items into user_attribute
            $removeItems = UserUtils::removeAttribute(null, null, $id_user, true);

            echo Yii::t("messageStrings", "message_result_user_delete");

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - removeContent()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - removeContent: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para excluir um registro existente
     * 
     *
     * @param number
     *
    */
    public function removeTagContent($id_user, $field) {

        $sql = "DELETE FROM user_attribute WHERE user_id = {$id_user} AND name = '$field'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            for($i = 0; $i < 100; $i++){
                MethodUtils::setSessionData("all_kind_user_$i", '');
            }
            
            if($field == 'cliente'){
                $sql2 = "UPDATE user_data SET is_client = 0 WHERE id = $id_user";
                $control2 = Yii::app()->db->createCommand($sql2)->execute();
                
            }
            
            if($field == 'anunciante'){
                $sql2 = "UPDATE user_data SET is_suplyer = 0 WHERE id = $id_user";
                $control2 = Yii::app()->db->createCommand($sql2)->execute();
                
            }
            
            if($field == 'aluno'){
                $sql2 = "UPDATE user_data SET is_student = 0 WHERE id = $id_user";
                $control2 = Yii::app()->db->createCommand($sql2)->execute();
                
            }

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - removeTagContent()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - removeTagContent() ' . $e->getMessage();
        }
    }

    /**
     * Método para excluir um registro existente
     *
     *
     * @param number
     *
     * @return bool
     */
    public function saveUserBusinessPage($data) {
        $values = "keywords = '{$data[ 'keywords']}'";
        
        if ('' != $data['lance']) $values = "keywords = '{$data[ 'keywords']}', lance = '{$data[ 'lance']}'";

        $sql = "UPDATE user_data SET $values WHERE id = {$data[ 'id']}";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();           
            return true;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveUserBusinessPage()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - saveUserBusinessPage: ' . $e->getMessage();
        }
    }

    /**
     * Método para adicionar o endereço ao
     * usuário em pauta
     *
     * @param $data
     * @param $id
     * @return bool
     * @internal param $array
     *
    public function saveUserAddress($data, $id){
        
        $userAddress = new UserAddress();
        
        try{
            if(!isset($data['type'])) $data['type'] = 1;
            if(isset($data['type_address'])) $data['type'] = $data['type_address'];
            if(isset($data['action']) && $data['action'] == 'editar'){ $data['editar'] = true;}else{$data['editar'] = false;}

            //Ele salva em qualquer tipo de endere�o, se ecomerce n�o pode utilizar esse m�todo para atualizar Address
            $addressVerify = UserAddress::model()->find('user_id=:userID', array(':userID'=>$id));   
            if($data['editar'] && $addressVerify){ $userAddress = $addressVerify; }
          
            $userAddress->user_id = $id;        
            $userAddress->address = addslashes($data['endereco']);
            $userAddress->address_types_id = $data['type'];//Se é endereço primario ou secundario: tipo presente e-commerce
            $userAddress->city = addslashes($data['cidade']);
            if(isset($data['complement'])) $userAddress->complement = addslashes($data['complement']);
            $userAddress->number = $data['numero'];
            $userAddress->bairro = addslashes($data['bairro']);
            if(isset($data['id_estado'])) $data['estado'] = $data['id_estado'];
            if($data['estado'] == '') $data['estado'] = 0;//Problemas com 
            $userAddress->state_id = $data['estado'];
            $userAddress->zip = addslashes($data['cep']);

            $userSave = $userAddress->save();
            
            return $userSave;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveUserAddress()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserManager - saveUserAddress() ' . $e->getMessage();
        }
    } */
    
    /**
     * Método para adicionar o endereço ao
     * usuário em pauta o metodo de cima está com problemas...começar a usar este
     *
     * @param $data
     */
    public function saveAddress($data, $id){
        
        if(!isset($data['type'])) $data['type'] = 1;
        if(isset($data['type_address'])) $data['type'] = $data['type_address'];
        if(isset($data['action']) && $data['action'] == 'editar'){ $data['editar'] = true;}else{$data['editar'] = false;}
        if(!isset($data['complement'])) $data['complement'] = '';
        if(!isset($data['pais'])) $data['pais'] = 0;
        if(!is_numeric($data['estado'])){ if(isset($data['id_estado'])){$data['estado'] = $data['id_estado'];}}
        if($data['estado'] == '') $data['estado'] = 0;//Problemas com 
        
        $data['cidade'] = addslashes($data['cidade']);
        $data['endereco'] = addslashes($data['endereco']);
        $data['bairro'] = addslashes($data['bairro']);
        $data['complement'] = addslashes($data['complement']);
        if($data['numero'] == '') $data['numero'] = 0;
        if(!isset($data['id_cidade']) || $data['id_cidade'] == '') $data['id_cidade'] = 0;
        
        //Chaca se o endereço já existe
        $check = $this->checkUserAddress($data, $id);
        if(!$check){unset($data['query']); $data['editar'] = false;}
        
        $obiz = HelperUtils::getObiz();
        
        $select = "user_id, zip, address, number, complement, city, bairro, state_id, address_types_id, pais, id_city";
        if(!$obiz) $values = "$id, '{$data['cep']}', '{$data['endereco']}', '{$data['numero']}', '{$data['complement']}', '{$data['cidade']}', '{$data['bairro']}', {$data['estado']}, {$data['type']}, '{$data['pais']}', '{$data['id_cidade']}'";
        if( $obiz) $values = "$id, AES_ENCRYPT('{$data['cep']}', {$obiz['serial']}), AES_ENCRYPT('{$data['endereco']}', {$obiz['serial']}), AES_ENCRYPT('{$data['numero']}', {$obiz['serial']}), AES_ENCRYPT('{$data['complement']}', {$obiz['serial']}), AES_ENCRYPT('{$data['cidade']}', {$obiz['serial']}), AES_ENCRYPT('{$data['bairro']}', {$obiz['serial']}), '{$data['estado']}', {$data['type']}, '{$data['pais']}', {$data['id_cidade']}";
            
        if(!$obiz) $values2 = "address = '{$data['endereco']}', city = '{$data['cidade']} ', bairro = '{$data['bairro']}', number = '{$data['numero']}', zip = '{$data['cep']}', complement = '{$data['complement'] }', state_id = '{$data['estado']}', pais = '{$data['pais']}', id_city = '{$data['id_cidade']}'";
        if( $obiz) $values2 = "address = AES_ENCRYPT('{$data['endereco']}', {$obiz['serial']}), city = AES_ENCRYPT('{$data['cidade']}', {$obiz['serial']}), bairro = AES_ENCRYPT('{$data['bairro']}', {$obiz['serial']}), number = AES_ENCRYPT('{$data['numero']}', {$obiz['serial']}), zip = AES_ENCRYPT('{$data['cep']}', {$obiz['serial']}), complement = AES_ENCRYPT('{$data['complement']}', {$obiz['serial']}), state_id = '{$data['estado']}', pais = '{$data['pais']}', id_city = '{$data['id_cidade']}'";
        
        if(!$data['editar']) $sql = "INSERT INTO user_address ($select) VALUES ($values)";
        if( $data['editar']) $sql = "UPDATE user_address SET $values2 WHERE id = $id AND address_types_id = {$data['type']}";
        if(isset($data['query'])) $sql = "UPDATE user_address SET $values2 WHERE (user_id = $id AND address_types_id = {$data['type']})";
        
        //echo $sql;
        MethodUtils::setSessionData('checkAction', $sql);

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - saveAddress()', 'trace' => $e->getMessage()), true);
            echo 'ERROR: UserManager - saveAddress() ' . $e->getMessage();
        }
    }

    /**
     * Método para adicionar os attributos ao
     * usuário em pauta
     *
     * @param $data
     * @param $id
     * @return bool
     * @internal param $array
     */
    public function saveAttributtesPerson($data, $id) {
        
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');
        
        $valida = new dbValidar();
        $ua = new dbUserAttribute();
        $ua->setCurrentUser($id);

        if (isset($data['twitter']) && $data['twitter'] != '') $ua->adicionar("usuario_Twitter", $data['twitter']);
        if (isset($data['facebook'])) if ($data['facebook'] != '') $ua->adicionar("usuario_Facebook", $data['facebook']);
        if (isset($data['site'])) if ($data['site'] != '') $ua->adicionar("site", $data['site']);
        if (isset($data['cpf'])) $ua->adicionar("usuario_CPF", $data['cpf']);
        if (isset($data['cnpj'])) $ua->adicionar("usuario_CNPJ", $data['cnpj']);
        if (isset($data['rg'])) $ua->adicionar("usuario_RG", $data['rg']);
        if (isset($data['sexo'])) $ua->adicionar("usuario_Sexo", $data['sexo']);
        if (isset($data['telefone'])) $ua->adicionar("usuario_Telefone", $valida->replacePhone($data['telefone']), 'texto');
        if (isset($data['fax'])) $ua->adicionar("usuario_Fax", $valida->replacePhone($data['fax']), 'texto');
        if (isset($data['celular'])) $ua->adicionar("usuario_Celular", $valida->replacePhone($data['celular']), 'texto');
        if (isset($data['cod_afiliacao'])) $ua->adicionar("usuario_CodAfiliacao", $data['cod_afiliacao']);
        if (isset($data['permission_level'])) $ua->adicionar($data['permission_level'], "permission_level");

        return true;
    }

    

    /**
     * Método para recuperar os usuário paginados
     *
     * @param $start
     * @param $idpag
     * @param int $tipo
     * @return
     * @internal param $string
     * @internal param $number
     */
    public function getTransformedContent($start = 0, $idpag = 0, $tipo = 0) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        if ($start < 10) $start = 0;
        
        $select = "id, field1, field2, email, type, creation, account_states_id, account_locked";
        if ($tipo != "todos")
            $sql = "SELECT ".$select." FROM user_data WHERE type = $tipo ORDER BY field1 ASC LIMIT " . $start . ", 10";
        else
            $sql = "SELECT ".$select." FROM user_data ORDER BY field1 ASC LIMIT " . $start . ", 10";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for ($i = 0; $i < count($recordset); $i++) {
               $recordset[$i]['account_states_id'] =  UserUtils::getSituation($recordset[$i]['account_states_id']);
               $recordset[$i]['account_locked'] =  UserUtils::getLocked($recordset[$i]['account_locked']);
               $recordset[$i]['creation'] =  DateTimeUtils::getDateFormateNoTime($recordset[$i]['creation']);
               $recordset[$i]['type_name'] =  UserUtils::getUserTypeString($recordset[$i]['type']);
               $recordset[$i]['user_name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);
            }
            
            //Gets the rows amount
            $sqlRows = DataBaseUtils::getCountRecords("user_data", "", "", true);
            if ($sqlRows > 11) $sqlRows = ($sqlRows) / 10;
            else $sqlRows = 0;
            $recordset['records'] = round($sqlRows);

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getTransforemdContent()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getTransformedContent' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar os usuário paginados com o uso de
     * filtros, são vários que podem ser usados
     *
     * @param $start
     * @param $user
     * @param $email
     * @param int $tipo
     * @param string $status
     * @return
     * @internal param $string
     * @internal param $number
     * @internal param $array
     */
    public function getUsersByFiltersSimple($start = 0, $user = NULL, $email = NULL, $tipo = 0, $status = "", $id = false) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        Yii::import('application.extensions.utils.users.UserUtils');        

        if ($start < 10) $start = 0;
        
        $obiz = HelperUtils::getObiz();
        
        $type_query = "type != '100'";
        if($tipo == '0') $type_query = "type = 0 OR type = 2 OR type = 3";
        if($tipo == '1') $type_query = "type = 1";
        
        if(!$obiz) $select = "id, field1, field2, email, type, creation, account_states_id, account_locked, status, obiz";
        if( $obiz) $select = "id, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, type, creation, account_states_id, account_locked, status, obiz";
        
        if (((($user != "todos" || $user != "" || $email != "") && $tipo != "todos") && $status != "") || $id ) {
            
            if ($user != "" && $email == "") {
                if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND ((field1 LIKE '$user%') OR (field2 LIKE '$user%')))  ORDER BY id DESC LIMIT $start, 100";
                if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND ((AES_DECRYPT(field1, {$obiz['serial']}) LIKE '$user%') OR (AES_DECRYPT(field2, {$obiz['serial']}) LIKE '$user%')))  ORDER BY id DESC LIMIT $start, 100";
            } else if($user == "" && $email != "") {
                if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND (email LIKE '%$email%')) ORDER BY id DESC LIMIT $start, 100";
                if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND (AES_DECRYPT(email, {$obiz['serial']}) LIKE '%$email%') ORDER BY id DESC LIMIT $start, 100";
            } else if($user == "" && $email == "" && $id) {
                $sql = "SELECT $select FROM user_data WHERE id = $id ORDER BY id DESC LIMIT $start, 100";
            } else {
                if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND (((field1 LIKE '$user%') OR (field2 LIKE '$user%')) AND (email LIKE '%$email%')))  ORDER BY id DESC LIMIT $start, 100";
                if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND account_states_id = $status AND (((AES_DECRYPT(field1, {$obiz['serial']}) LIKE '$user%') OR (AES_DECRYPT(field2, {$obiz['serial']}) LIKE '$user%')) AND (AES_DECRYPT(email, {$obiz['serial']}) LIKE '%$email%')))  ORDER BY id DESC LIMIT $start, 100";
            }
        
            
        }else if((($user != "todos" || $user != "" || $email != "") && $tipo != 'todos') && $status == "") {
            
            if ($status == "") {
                if ($user != "" && $email == "") {
                    if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND ((field1 LIKE '$user%') OR (field2 LIKE '$user%'))) ORDER BY id DESC LIMIT $start, 100";
                    if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND (AES_DECRYPT(field1, {$obiz['serial']}) LIKE '$user%' OR AES_DECRYPT(field2, {$obiz['serial']}) LIKE '$user%')) ORDER BY id DESC LIMIT $start, 100";
                } else if($user == "" && $email != "") {
                    if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND (email LIKE '%$email%')) ORDER BY id DESC LIMIT $start, 100";
                    if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND AES_DECRYPT(email, {$obiz['serial']}) LIKE '%$email%') ORDER BY id DESC LIMIT $start, 100";
                } else {
                    if(!$obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND (((field1 LIKE '$user%') OR (field2 LIKE '$user%')) AND (email LIKE '%$email%')))  ORDER BY id DESC LIMIT $start, 100";
                    if( $obiz) $sql = "SELECT $select FROM user_data WHERE (($type_query) AND (AES_DECRYPT(email, {$obiz['serial']}) LIKE '%$email%' AND (AES_DECRYPT(field1, {$obiz['serial']}) LIKE '$user%' OR AES_DECRYPT(field2, {$obiz['serial']}) LIKE '$user%'))) ORDER BY id DESC LIMIT $start, 100";
                }  
            }
            
        }else{
           if ($status != '')
               $sql = "SELECT $select FROM user_data WHERE account_states_id = $status ORDER BY id DESC LIMIT $start, 100";
           if ($status == '')
               $sql = "SELECT $select FROM user_data ORDER BY id DESC LIMIT $start, 100";
        }
        
        echo $sql;

        try{
            
            MethodUtils::setSessionData('checkAction', $sql);
            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            var_dump($recordset);
            if ($recordset) {
                for($i = 0; $i < count($recordset); $i++) {
                    $recordset[$i] =  HelperUtils::getCripto($recordset[$i], C::DECRYPT, array('email_obz' => false));
                    $recordset[$i]['account_states_id_string'] = UserUtils::getSituation($recordset[$i]['account_states_id']);
                    $recordset[$i]['account_status'] = StatusUtils::getTypeStringToIcon($recordset[$i]['account_states_id']);
                    $recordset[$i]['account_locked'] = UserUtils::getLocked($recordset[$i]['account_locked']);
                    $recordset[$i]['creation'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['creation']);
                    $recordset[$i]['type_name'] = UserUtils::getUserTypeString($recordset[$i]['type']);
                    $recordset[$i]['user_name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);
                }

                //Gets the rows amount
                $sqlRows = DataBaseUtils::getCountRecords("user_data", "", "", true);
                if ($sqlRows > 11) $sqlRows = ($sqlRows) / 10;
                $recordset['records'] = round($sqlRows);
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getUserFilterSimple()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UserManager - getUserFilterSimple() ".$e->getMessage();
        }
    }
    
    /**
     * Gets all users with the atuaction type
     *
     * @param bool $types
     * @return bool
     * @internal param $string
     */
    public static function getAllUsersByAtuacao($id = false, $start = 0) {       
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        //Works in pagination
        $start = ($start - 1) * 10;if($start < 0){$start = 0;};
           
        if(!$id) $sql = "SELECT * FROM user_data ORDER BY field1 ASC LIMIT $start, 10";
        if( $id) $sql = "SELECT * FROM user_data WHERE ramo_atuacao = $id ORDER BY field1 ASC LIMIT $start, 10";
        
        try {
            
            MethodUtils::setSessionData('checkAction', $sql);
            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['creation_string'] = DateTimeUtils::getDateFormate($recordset[$i]['creation']);
                }
            }
            
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllUsersByAtuacao()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UsersManager - getAllUsersByAtuacao() ". $e->getMessage();
        }  
    }
    
    /**
     * Gets all users with the atributtes need.
     * This method uses a array to look for users.
     *
     * @param bool $types
     * @return bool
     * @internal param $string
     */
    public static function getAllKindUsers($type = "", $start = 0){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        //Works in pagination
        $start = ($start - 1) * 10;if($start < 0){$start = 0;};
        $obiz = HelperUtils::getObiz();
        
        if($type != 'all'){
            if(!$obiz) $query  = "SELECT * FROM user_data as ud INNER JOIN user_attribute as ua ON ud.id = ua.user_id WHERE ua.name = '$type' ORDER BY ud.field1 ASC LIMIT $start, 10";
            if( $obiz) $query  = "SELECT *, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(documento, {$obiz['serial']}) AS documento, AES_DECRYPT(birthday, {$obiz['serial']}) AS birthday, AES_DECRYPT(name_full, {$obiz['serial']}) AS name_full, AES_DECRYPT(json, {$obiz['serial']}) AS json, AES_DECRYPT(bairro, {$obiz['serial']}) AS bairro, AES_DECRYPT(estado, {$obiz['serial']}) AS estado, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, AES_DECRYPT(frase, {$obiz['serial']}) AS frase FROM user_data as ud INNER JOIN user_attribute as ua ON ud.id = ua.user_id WHERE ua.name = '$type' ORDER BY ud.field1 ASC LIMIT $start, 10";
        }
        
        if($type == 'all'){
            if(!$obiz) $query  = "SELECT * FROM user_data ORDER BY field1 ASC LIMIT $start, 10";
            if( $obiz) $query  = "SELECT *, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(documento, {$obiz['serial']}) AS documento, AES_DECRYPT(birthday, {$obiz['serial']}) AS birthday, AES_DECRYPT(name_full, {$obiz['serial']}) AS name_full, AES_DECRYPT(json, {$obiz['serial']}) AS json, AES_DECRYPT(bairro, {$obiz['serial']}) AS bairro, AES_DECRYPT(estado, {$obiz['serial']}) AS estado, AES_DECRYPT(bairro, {$obiz['serial']}) AS bairro, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(cidade, {$obiz['serial']}) AS cidade, AES_DECRYPT(frase, {$obiz['serial']}) AS frase FROM user_data ORDER BY field1 ASC LIMIT $start, 10";
        }
        
        //echo $query;
        
        MethodUtils::setSessionData('checkAction', $query);
        
        try {
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();
            //var_dump($recordset);
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['type_name'] = DateTimeUtils::getDateFormate($recordset[$i]['creation']);
                    $recordset[$i]['creation_string'] = DateTimeUtils::getDateFormate($recordset[$i]['creation']);
                    $recordset[$i]['account_status'] =  StatusUtils::getTypeStringToIcon($recordset[$i]['account_states_id']);
                    $recordset[$i]['account_locked_string'] =  UserUtils::getLocked($recordset[$i]['account_locked']);
                    $recordset[$i]['account_states_id_string'] =  UserUtils::getSituation($recordset[$i]['account_states_id']);
                    $recordset[$i]['date_extra_string'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_extra']);
                    $recordset[$i]['json'] = json_decode($recordset[$i]['json'], true);
                    $recordset[$i]['creation'] =  DateTimeUtils::getDateFormateNoTime($recordset[$i]['creation']);
                    $recordset[$i]['type_name'] =  UserUtils::getUserTypeString($recordset[$i]['type']);
                    $recordset[$i]['user_name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);

                }
            }
            //var_dump($recordset);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllKindusers()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UsersManager - gelAllKindUsers() ". $e->getMessage();
        } 
    }
    
    /**
     * Gets info user if credentials are correct
     *
     * @param array
     * 
     */
    public static function getUserInfoByCredentials($data = array()){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $sql  = "SELECT * FROM user_data WHERE email = '{$data['email']}' AND password = '{$data['password']}'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $recordset = Yii::app()->db->createCommand($sql)->queryRow();
  
            if($recordset){                
                $recordset['creation_string'] = DateTimeUtils::getDateFormate($recordset['creation']);                
                $recordset['endereco'] = UserUtils::getAddress($recordset['id'], false);
                $recordset['documentos'] = UserUtils::getDocuments($recordset['id']);
                $recordset['contato'] = UserUtils::getUserContacts($recordset['id']);
                $recordset['sexo'] = UserUtils::getUserSex($recordset['id']);
                $recordset['birthday'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['birthday']);                
            } 
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getUserInfoByCredentials()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UsersManager - getUserInfoByCredentials() ". $e->getMessage();
        } 
    }
    
    /**
     * Gets info user if credentials are correct
     *
     * @param array
     * 
     */
    public static function checkUserAddress($data = array(), $id = NULL){
        
        $sql  = "SELECT * FROM user_address WHERE user_id = {$id} AND address_types_id = {$data['type']}";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $recordset = Yii::app()->db->createCommand($sql)->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - checkUserAddress()', 'trace' => $e->getMessage()), true);
            echo "ERROR: UsersManager - checkUserAddress() ". $e->getMessage();
        } 
    }
    
    /**
     * Método para recuperar os registros da tabela usuários que assinaram 
     * uma período de tempo
     *
    */
    public function getAllSubscribers($start = 0) {

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $start = $start * 10;
        
        $select = "id, avatar, field1, field2, email, type, assinatura, status";
        $sql = "SELECT $select FROM user_data WHERE assinatura != '0000-00-00' ORDER BY field1 ASC LIMIT $start, 10 ";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++) {
               $recordset[$i]['expire_string'] =  DateTimeUtils::getDateFormateNoTime($recordset[$i]['assinatura']);
               $recordset[$i]['type_name'] =  UserUtils::getUserTypeString($recordset[$i]['type']);
               $recordset[$i]['name'] = UserUtils::getNameUser($recordset[$i]['field1'], $recordset[$i]['field2'], $recordset[$i]['type']);
            }
            
            //Gets the rows amount
            $sqlRows = DataBaseUtils::getCountRecords("user_data", "", "", true);
            if ($sqlRows > 11) $sqlRows = ($sqlRows) / 5;
            $recordset[0]['records'] = $sqlRows;

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - getAllSubscribers()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - getAllSubscribers: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para checar um email existe
     *
    */
    public function checkEmail($email) {        
        
        $obiz = HelperUtils::getObiz();
        
        if(!$obiz) $sql = "SELECT id, email, field1, field2, type, name_full, documento FROM user_data WHERE email = '$email'";
        if( $obiz) $sql = "SELECT id, AES_DECRYPT(email, {$obiz['serial']}) as email, field1, field2, type, name_full, documento FROM user_data WHERE AES_DECRYPT(email, {$obiz['serial']}) = '$email'";
        
        MethodUtils::setSessionData('checkAction', $sql);

        try {
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                if($recordset['type'] != '1') $recordset['nome'] = "{$recordset['field1']} {$recordset['field2']}";
                if($recordset['type'] == '1') $recordset['nome'] = "{$recordset['field1']}";
            }

            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - UserManager - checkEmail()', 'trace' => $e->getMessage()), true);
            echo 'ERROR - UserManager - checkEmail: ' . $e->getMessage();
        }
    }
    
    /**
     * Método adicionar e atualizar os votos
     *
     * @param array
     *
    */
    public function recordVote($data){
        
        if($data['vote'] < $data['info']['reputation_lower']){$lower = $data['vote'];}else{$lower = $data['info']['reputation_lower'];}
        if($data['vote'] > $data['info']['reputation_higher']){$higher = $data['vote'];}else{$higher = $data['info']['reputation_higher'];}
        if($data['info']['reputation_lower'] == 0){$lower = $data['vote'];}
        
        $reputation['total'] = $data['info']['reputation_total'] +  $data['vote'];
        $reputation['count'] = $data['info']['reputation_count'] + 1;
        
        $rate = floor($reputation['total']) / $reputation['count'];        
        
        try{
            $values = "reputation = '$rate', reputation_total = '{$reputation['total']}', reputation_count = '{$reputation['count']}', reputation_lower = '$lower', reputation_higher = '$higher'";           
            $sql = "UPDATE user_data SET $values WHERE id = {$data['id']}";
            
            MethodUtils::setSessionData('checkAction', $sql);
    
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: UserManager - recordVote() '. $e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - Usermanager - recordVote()', 'trace' => $e->getMessage()), true);
        }
    }
}
