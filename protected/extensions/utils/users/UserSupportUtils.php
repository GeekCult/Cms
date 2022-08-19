<?php

/**
 * Description of UserHelperUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class UserSupportUtils {
    
    /**
     * Método para criar uma conta de usuários rápida,
     * com poucas informações 
     * 
     *
     * @param array
     *
    */
    public static function createUserAccountFromSession($type = ""){
        
        Yii::import('application.extensions.utils.users.UserUtils');        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.EmailUtils');
        Yii::import('application.extensions.digitalbuzz.validar.dbValidar');

        $valida = new dbValidar();
        
        $session = MethodUtils::getSessionData();
        
        try{
            //Sets an avatar default
            $avatar = $session['picture_facebook'];
            //Set name     
            $data['field1'] = $session['name_facebook'];
            $data['field2'] = $session['lastname_facebook'];
            $data['id_facebook'] = $session['id_facebook'];
            $data['nome'] = $session['name_facebook'] . " " . $session['lastname_facebook'];   

            //Verify if the phone is set            
            if($session['telefone_redesocial'] !== ""){$data['telefone'] = $valida->replacePhone($session['telefone_redesocial']);}else{$data['telefone'] = "";}

            $data['email'] = $session['email_facebook'];
            
            if($session['birthday_facebook'] !== ''){$data['birthday'] = DateTimeUtils::setFormatDateNoTime($session['birthday_facebook'], false);}else{$data['birthday'] = '0000-00-00';}
            $data['password'] = MethodUtils::getRandomPassword();        

            //if some data are not declared  
            if(!isset($data['birthday'])) $data['birthday'] = NULL;
            if(!isset($data['documento'])) $data['documento'] = "";
            if(!isset($data['tipo_conta'])) $data['tipo_conta'] = 0;
            if(!isset($data['type_account'])) $data['type_account'] = 0;
            if(!isset($data['ramo_atuacao'])) $data['ramo_atuacao'] = "";
            if(!isset($data['id_ramo_atuacao'])) $data['id_ramo_atuacao'] = 0;
            if(!isset($data['id_account_locked'])) $data['id_account_locked'] = 0;
            if(!isset($data['id_account_states'])) $data['id_account_states'] = 1;

            //add message in database
            $insert = "field1, field2, email, type, receive_news, password, email_hash, avatar, birthday, ramo_atuacao, id_ramo_atuacao, account_locked, account_states_id";
            $values  = "'" . $data['field1'] . "', '" .$data['field2']."', '" .$data['email']."', '" .$data['tipo_conta']. "', ";
            $values .= "1, '". md5($data['password']) . "', '" . md5($data['email'] . $data['documento']). "', '$avatar', '". $data['birthday']. "', ";
            $values .= "'". $data['ramo_atuacao'] . "', " . $data['id_ramo_atuacao']. ", " . $data['id_account_locked']. ", " . $data['id_account_states']. "";

            $sql = "INSERT INTO user_data (".$insert.") VALUES (".$values.")";

            //First of all check if the email already exist.
            $existEmail = EmailUtils::checkEmailExist($data['email']);
            
            if(!$existEmail){
                $command = Yii::app()->db->createCommand($sql);
                $command->execute();

                //Get last id created
                $id = Yii::app()->db->getLastInsertID();

                //Dispacht an e-mail to user signed.
                $data['tipo_conta'] = UserUtils::getUserTypeString($data['tipo_conta'], true);
                
                $setAttribute = UserUtils::setAttribute("usuario_Externo", $type, "texto", $id);
                $setAttribute = UserUtils::setAttribute("id_Facebook", $data['id_facebook'], "inteiro", $id);
                
                if(isset($data['telefone']) != "")$setAttribute2 = UserUtils::setAttribute("usuario_Telefone", $data['telefone'], "texto", $id);
                
                //Set Recent Activity
                $activity = array("title" => Yii::t("activityStrings", "user_submit"),"nome" => $data['nome'], "message" => Yii::t("activityStrings", "user_submit_desc"), "tipo" => "user", "id_general" => $id, "date" => date("Y-m-d H:i:s"), "id_user" => $id);
                $setActivity = MethodUtils::setActivityRecent($activity);
                
                //Send notification: Email values
                $data['tipo'] = "cadastro_atualizar_com_senha";
                $data['layout'] =  "cadastro_common";
                $data['layout_reply'] = "cadastro_rapido_com_senha";
                $email_notification = MethodUtils::sendOrder($data);
                
                $setLoggedIn = MethodUtils::setSessionData("logado", 1);
                
                return $id;
                
            }else{
                return $existEmail['id'];                
            }

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para retornar os dados completos do usuário cadastrado em user_company
     * Esse método busca as informacoes desse usuário que é um colaborador de um determinado 
     * user PJ
     * 
     * @param string
     *
    */
    public static function getUserCompanyByEmail($email, $callback = ""){   
        
        $select = "id, nome";
        $sql = "SELECT ".$select." FROM user_company WHERE email = '$email'";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        
        if($callback == "")return $recordset;
        if($callback != "")return $recordset[$callback];
    }
    
    /**
     * Método para retornar os dados completos do usuário
     * 
     * @param number
     *
    */
    public static function getUserPurplePierFullById($id_user){   
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $select = "id, field1, field2, avatar, frase, keywords, email, lance, type, account_states_id";
        $sql = "SELECT ".$select." FROM user_data WHERE id = $id_user ";

        $command = Yii::app()->db4->createCommand($sql);
        $recordset = $command->queryRow();
        
        if($recordset) $recordset['lance_format'] = CurrencyUtils::getPriceFormat($recordset['lance'], true, false);
        if($recordset){ if($recordset['type'] == 1){$recordset['name'] = $recordset['field2'];}else{$recordset['name'] = $recordset['field1'] . " ".  $recordset['field2'];}};
        
        
        return $recordset;
    }
    
    /**
     * Método para adicionar as informações de trainee 
     * 
     * @param array
     *
    **/
    public static function setTraineeAttributes($id_user){
        Yii::import('application.extensions.utils.users.UserUtils');
        $setAtt = array();
        if(isset($_POST['nome_mae']))$setAtt[] = UserUtils::setAttribute("nome_mae", $_POST['nome_mae'], "texto", $id_user);
        if(isset($_POST['profissao_mae']))$setAtt[] = UserUtils::setAttribute("profissao_mae", $_POST['profissao_mae'], "texto", $id_user);
        if(isset($_POST['nome_pai']))$setAtt[] = UserUtils::setAttribute("nome_pai", $_POST['nome_pai'], "texto", $id_user);
        if(isset($_POST['profissao_pai']))$setAtt[] = UserUtils::setAttribute("profissao_pai", $_POST['profissao_pai'], "texto", $id_user);
        
        if(isset($_POST['local_nascimento']))$setAtt[] = UserUtils::setAttribute("local_nascimento", $_POST['local_nascimento'], "texto", $id_user);
        if(isset($_POST['estado_civil']))$setAtt[] = UserUtils::setAttribute("estado_civil", $_POST['estado_civil'], "texto", $id_user);
        
        if(isset($_POST['ensino_medio']))$setAtt[] = UserUtils::setAttribute("ensino_medio", $_POST['ensino_medio'], "texto", $id_user);
        if(isset($_POST['ensino_medio_conclusao']))$setAtt[] = UserUtils::setAttribute("ensino_medio_conclusao", $_POST['ensino_medio_conclusao'], "texto", $id_user);
        if(isset($_POST['graduacao']))$setAtt[] = UserUtils::setAttribute("graduacao", $_POST['graduacao'], "texto", $id_user);
        if(isset($_POST['graduacao_curso']))$setAtt[] = UserUtils::setAttribute("graduacao_curso", $_POST['graduacao_curso'], "texto", $id_user);
        if(isset($_POST['graduacao_periodo']))$setAtt[] = UserUtils::setAttribute("graduacao_periodo", $_POST['graduacao_periodo'], "texto", $id_user);
        if(isset($_POST['graduacao_conclusao']))$setAtt[] = UserUtils::setAttribute("graduacao_conclusao", $_POST['graduacao_conclusao'], "texto", $id_user);
        
        if(isset($_POST['posgraduacao']))$setAtt[] = UserUtils::setAttribute("posgraduacao", $_POST['posgraduacao'], "texto", $id_user);
        if(isset($_POST['posgraduacao_curso']))$setAtt[] = UserUtils::setAttribute("posgraduacao_curso", $_POST['posgraduacao_curso'], "texto", $id_user);
        if(isset($_POST['posgraduacao_periodo']))$setAtt[] = UserUtils::setAttribute("posgraduacao_periodo", $_POST['posgraduacao_periodo'], "texto", $id_user);
        if(isset($_POST['posgraduacao_conclusao']))$setAtt[] = UserUtils::setAttribute("posgraduacao_conclusao", $_POST['posgraduacao_conclusao'], "texto", $id_user);
        if(isset($_POST['outros_cursos_graduacao']))$setAtt[] = UserUtils::setAttribute("outros_cursos_graduacao", $_POST['outros_cursos_graduacao'], "descricao", $id_user);
        
        if(isset($_POST['word']))$setAtt[] = UserUtils::setAttribute("word", $_POST['word'], "texto", $id_user);
        if(isset($_POST['excel']))$setAtt[] = UserUtils::setAttribute("excel", $_POST['excel'], "texto", $id_user);
        if(isset($_POST['powerpoint']))$setAtt[] = UserUtils::setAttribute("powerpoint", $_POST['powerpoint'], "texto", $id_user);
        if(isset($_POST['ingles']))$setAtt[] = UserUtils::setAttribute("ingles", $_POST['ingles'], "texto", $id_user);
        if(isset($_POST['outro_indioma']))$setAtt[] = UserUtils::setAttribute("outro_indioma", $_POST['outro_indioma'], "texto", $id_user);
        if(isset($_POST['outro_indioma_titulo']))$setAtt[] = UserUtils::setAttribute("outro_indioma_titulo", $_POST['outro_indioma_titulo'], "texto", $id_user);
        if(isset($_POST['outros_cursos_complementares']))$setAtt[] = UserUtils::setAttribute("outros_cursos_complementares", $_POST['outros_cursos_complementares'], "descricao", $id_user);
        
        if(isset($_POST['pretensao_fixo']))$setAtt[] = UserUtils::setAttribute("pretensao_fixo", $_POST['pretensao_fixo'], "texto", $id_user);
        if(isset($_POST['pretensao_variavel']))$setAtt[] = UserUtils::setAttribute("pretensao_variavel", $_POST['pretensao_variavel'], "texto", $id_user);
        if(isset($_POST['carro']))$setAtt[] = UserUtils::setAttribute("carro", $_POST['carro'], "texto", $id_user);
        if(isset($_POST['fumante']))$setAtt[] = UserUtils::setAttribute("fumante", $_POST['fumante'], "texto", $id_user);
        
        if(isset($_POST['trabalha_atualmente']))$setAtt[] = UserUtils::setAttribute("trabalha_atualmente", $_POST['trabalha_atualmente'], "texto", $id_user);
        if(isset($_POST['atual_empresa']))$setAtt[] = UserUtils::setAttribute("atual_empresa", $_POST['atual_empresa'], "texto", $id_user);
        if(isset($_POST['tempo_empresa']))$setAtt[] = UserUtils::setAttribute("tempo_empresa", $_POST['tempo_empresa'], "texto", $id_user);
        if(isset($_POST['empresa_1']))$setAtt[] = UserUtils::setAttribute("empresa_1", $_POST['empresa_1'], "descricao", $id_user);
        if(isset($_POST['empresa_2']))$setAtt[] = UserUtils::setAttribute("empresa_2", $_POST['empresa_2'], "descricao", $id_user);
        if(isset($_POST['empresa_3']))$setAtt[] = UserUtils::setAttribute("empresa_3", $_POST['empresa_3'], "descricao", $id_user);
        
        if(isset($_POST['intercambio']))$setAtt[] = UserUtils::setAttribute("intercambio", $_POST['intercambio'], "texto", $id_user);
        if(isset($_POST['duracao_intercambio']))$setAtt[] = UserUtils::setAttribute("duracao_intercambio", $_POST['duracao_intercambio'], "texto", $id_user);
        if(isset($_POST['cidade_pais']))$setAtt[] = UserUtils::setAttribute("cidade_pais", $_POST['cidade_pais'], "texto", $id_user);
        if(isset($_POST['esportes']))$setAtt[] = UserUtils::setAttribute("esportes", $_POST['esportes'], "texto", $id_user);
        if(isset($_POST['tipo_esporte']))$setAtt[] = UserUtils::setAttribute("tipo_esporte", $_POST['tipo_esporte'], "texto", $id_user);
        if(isset($_POST['ano_esporte']))$setAtt[] = UserUtils::setAttribute("ano_esporte", $_POST['ano_esporte'], "texto", $id_user);
        if(isset($_POST['voluntariado']))$setAtt[] = UserUtils::setAttribute("voluntariado", $_POST['voluntariado'], "texto", $id_user);
        if(isset($_POST['atividades_voluntariado']))$setAtt[] = UserUtils::setAttribute("atividades_voluntariado", $_POST['atividades_voluntariado'], "texto", $id_user);
        if(isset($_POST['hobby']))$setAtt[] = UserUtils::setAttribute("hobby", $_POST['hobby'], "texto", $id_user);
        if(isset($_POST['midia_acic']))$setAtt[] = UserUtils::setAttribute("midia_acic", $_POST['midia_acic'], "texto", $id_user);
        if(isset($_POST['midia_acic_radio']))$setAtt[] = UserUtils::setAttribute("midia_acic_radio", $_POST['midia_acic_radio'], "texto", $id_user);
        
        $setAtt[] = UserUtils::setAttribute("usuario_TempoExperiencia", "0 meses", "texto", $id_user);
        $setAtt[] = UserUtils::setAttribute("usuario_Profissao", "Trainees", "texto", $id_user);
        
        return $setAtt;
    }
    
    /**
     * Método para adicionar as informações de trainee 
     * 
     * @param array
     *
    **/
    public static function getTraineeAttributes($id_user){
        Yii::import('application.extensions.utils.users.UserUtils');
        $result = array();
        $result["nome_mae"] = UserUtils::getAttribute("nome_mae", "texto", $id_user);
        $result["profissao_mae"] = UserUtils::getAttribute("profissao_mae", "texto", $id_user);
        $result["nome_pai"] = UserUtils::getAttribute("nome_pai", "texto", $id_user);
        $result["profissao_pai"] = UserUtils::getAttribute("profissao_pai", "texto", $id_user);
        
        $result["local_nascimento"] = UserUtils::getAttribute("local_nascimento", "texto", $id_user);
        $result["estado_civil"] = UserUtils::getAttribute("estado_civil", "texto", $id_user);
        
        $result["ensino_medio"] = UserUtils::getAttribute("ensino_medio", "texto", $id_user);
        $result["ensino_medio_conclusao"] = UserUtils::getAttribute("ensino_medio_conclusao", "texto", $id_user);
        $result["graduacao"] = UserUtils::getAttribute("graduacao", "texto", $id_user);
        $result["graduacao_curso"] = UserUtils::getAttribute("graduacao_curso", "texto", $id_user);
        $result["graduacao_periodo"] = UserUtils::getAttribute("graduacao_periodo",  "texto", $id_user);
        $result["graduacao_conclusao"] = UserUtils::getAttribute("graduacao_conclusao",  "texto", $id_user);
        
        $result["posgraduacao"] = UserUtils::getAttribute("posgraduacao", "texto", $id_user);
        $result["posgraduacao_curso"] = UserUtils::getAttribute("posgraduacao_curso", "texto", $id_user);
        $result["posgraduacao_periodo"] = UserUtils::getAttribute("posgraduacao_periodo", "texto", $id_user);
        $result["posgraduacao_conclusao"] = UserUtils::getAttribute("posgraduacao_conclusao", "texto", $id_user);
        $result["outros_cursos_graduacao"] = UserUtils::getAttribute("outros_cursos_graduacao","descricao", $id_user);
        
        $result["word"] = UserUtils::getAttribute("word", "texto", $id_user);
        $result["excel"] = UserUtils::getAttribute("excel", "texto", $id_user);
        $result["powerpoint"] = UserUtils::getAttribute("powerpoint", "texto", $id_user);
        $result["ingles"] = UserUtils::getAttribute("ingles", "texto", $id_user);
        $result["outro_indioma"] = UserUtils::getAttribute("outro_indioma", "texto", $id_user);
        $result["outro_indioma_titulo"] = UserUtils::getAttribute("outro_indioma_titulo", "texto", $id_user);
        $result["outros_cursos_complementares"] = UserUtils::getAttribute("outros_cursos_complementares", "descricao", $id_user);
        
        $result["pretensao_fixo"] = UserUtils::getAttribute("pretensao_fixo", "texto", $id_user);
        $result["pretensao_variavel"] = UserUtils::getAttribute("pretensao_variavel", "texto", $id_user);
        $result["carro"] = UserUtils::getAttribute("carro", "texto", $id_user);
        $result["fumante"] = UserUtils::getAttribute("fumante", "texto", $id_user);
        
        $result["trabalha_atualmente"] = UserUtils::getAttribute("trabalha_atualmente", "texto", $id_user);
        $result["atual_empresa"] = UserUtils::getAttribute("atual_empresa", "texto", $id_user);
        $result["tempo_empresa"] = UserUtils::getAttribute("tempo_empresa", "texto", $id_user);
        $result["empresa_1"] = UserUtils::getAttribute("empresa_1", "descricao", $id_user);
        $result["empresa_2"] = UserUtils::getAttribute("empresa_2", "descricao", $id_user);
        $result["empresa_3"] = UserUtils::getAttribute("empresa_3", "descricao", $id_user);
        
        $result["intercambio"] = UserUtils::getAttribute("intercambio", "texto", $id_user);
        $result["duracao_intercambio"] = UserUtils::getAttribute("duracao_intercambio", "texto", $id_user);
        $result["cidade_pais"] = UserUtils::getAttribute("cidade_pais", "texto", $id_user);
        $result["esportes"] = UserUtils::getAttribute("esportes", "texto", $id_user);
        $result["tipo_esporte"] = UserUtils::getAttribute("tipo_esporte", "texto", $id_user);
        $result["ano_esporte"] = UserUtils::getAttribute("ano_esporte", "texto", $id_user);
        $result["voluntariado"] = UserUtils::getAttribute("voluntariado", "texto", $id_user);
        $result["atividades_voluntariado"] = UserUtils::getAttribute("atividades_voluntariado", "texto", $id_user);
        $result["hobby"] = UserUtils::getAttribute("hobby", "texto", $id_user);
        $result["midia_acic"] = UserUtils::getAttribute("midia_acic", "texto", $id_user);
        $result["midia_acic_radio"] = UserUtils::getAttribute("midia_acic_radio", "texto", $id_user);
        
        
        return $result;
    }
    
    /**
     * Método para obter as estatisticas dos trainees
     * 
     *
    **/
    public static function getStatisticsTrainees(){
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        $result = array();
        
        $result['radio'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "radio"); 
        $result['google'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "google");
        $result['facebook'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "facebook");
        $result['jornal'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "jornal");
        $result['site_acic'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "site_acic");
        $result['faculdades'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "faculdades");
        $result['email_marketing'] = UserSupportUtils::getAttributesStatisticsTrainees("midia_acic_radio", "email_marketing");
        $result['candidatos'] = UserSupportUtils::getAttributesStatisticsTrainees("usuario_Profissao", "Trainees");
        
        return $result;
    }
    
    /**
     * Método para obter as informações de trainee 
     * 
     * @param string
     *
    **/
    public static function getAttributesStatisticsTrainees($label, $search_by){

        $sql = "SELECT name FROM user_attribute WHERE name = '$label' AND texto = '$search_by'";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryAll();
        
        return count($recordset);
    }
    
    /**
     * Método para retornar se um determinado item já foi adquirido por um determinado 
     * usuário.
     * 
     * @param string
     *
    */
    public static function verifyPurchasedItem($label, $field = 'texto', $id_general, $id_user){   
        
        $sql = "SELECT name FROM user_attribute WHERE name = '$label' AND $field = $id_general AND user_id = $id_user";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        
        return $recordset;
      
    }
    
    /**
     * Método para habilitar quais modulos o usuário adquiriu
     * 
     * 
     * @param string
     *
    */
    public static function setUserModules($id_user){   
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        
        $sql = "SELECT name, inteiro, texto FROM user_attribute WHERE name = 'modulo' AND user_id = $id_user";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryAll();
        
        if($recordset){
            foreach($recordset as $values){
                
                $modulo = false;//Defines as false first
                
                switch($values['name']){
                    case "modulo":
                         $modulo = ProdutosUtils::getModuleInformation($values['inteiro'], "url"); 
                         break;
                    
                }
                if($modulo)$setModule = MethodUtils::setSessionData($id_user."_".$modulo, "1");
                
            }
        }
        //Set an id to client
        $setIdClient = MethodUtils::setSessionData("id_client", $id_user);
        
        return true;      
    }
    
    /*
     * This method sets a new database user
     * 
     * @param db_user - access to new database user
     * 
     */
    public static function setNewDB($values){
        
        $db = Yii::createComponent(array(
           'class' => 'CDbConnection',
            // other config properties...
             'connectionString'=>"mysql:host=".$values['host'].";port=3306;dbname=".$values['database']."",
                'username'=> $values['user'],
                'password'=> $values['password'],
                'charset'=>'utf8',
                'emulatePrepare' => true,
                'enableParamLogging'=>true,
                'enableProfiling' => true,
        ));

        $setDB = Yii::app()->setComponent('db_user', $db);
    }
    
    /*
     * This method returns a status depend on waht is required
     * It is used to get account_locekd status
     * 
     * @param number
     * 
     */
    public static function getStatusByType($status){
        
        switch($status){
            case 2:
                 $status = 0; //Destravada, Sucesso
                 break;
             case 0:
                 $status = 1;//Travada, aberto pode ter problemas de pagamento
                 break;
             case 2:
                 $status = 2;//Inativo, pendente
                 break;
             case 3:
                 $status = 3;//excluida
                 break;

        }
        
        return $status;
    }
    
    /**
     * Método para obter o ramo de atuação, está em outra classe DataUtils,
     * Tem bastante coisa legal lá, confira!
     * 
     * 
     * @param number
     *
    */
    public static function getRamoAtuacao($id_ramo_atuacao, $isId = true, $field = false){   
        
        try{
            Yii::import('application.extensions.utils.launchers.DataUtils');

            $ramo = DataUtils::getRamoAtuacaoValue($id_ramo_atuacao, $isId, $field);

            return $ramo;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - UserSupportUtils - getRamoAtuacao: ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os atributos do tipo de tag
     * 
     * @param string
     *
    */
    public static function getUserByTag($tag, $id_user){ 
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        
        (Yii::app()->params['erp_ramo'] == '') ? $path = 'common' : $path = Yii::app()->params['erp_ramo']; 
       
        try{
            if($tag =='cliente'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $result = ERPUtils::getClienteInformation($id_user);
            }
            
            if($tag =='funcionario'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $result = ERPUtils::getFuncionarioInformation($id_user);
            }
            
            if($tag =='parceiro'){
                $result['id_user'] = $id_user;
      
                $result['image'] = UserUtils::getAttribute('logo_partner', 'texto', $id_user);
                $result['site_partner'] = UserUtils::getAttribute('site_partner', 'texto', $id_user);
                $result['view'] = 'editar_cliente_parceiro';
            }
            
            if($tag =='profissional'){
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
            echo 'ERROR - UserSupportUtils - getUserByTag() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar detalhes do cliente
     * 
     * @param array
     *
    */
    public static function saveUserByTag(){ 

        $params = array();
        parse_str($_POST['data'], $params);
        
        (Yii::app()->params['erp_ramo'] == '') ? $path = 'common' : $path = Yii::app()->params['erp_ramo'];        
       
        try{
            
            if($params['helper_tag'] =='cliente'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $set = ERPUtils::saveClienteInformation($params);
            }
            
            if($params['helper_tag'] =='profissional'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $set = ERPUtils::saveProfissionalInformation($params);
            }
            
            if($params['helper_tag'] =='parceiro'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $set = ERPUtils::saveParceiroInformation($params);
            }
            
            if($params['helper_tag'] =='funcionario'){
                Yii::import('application.extensions.utils.erp.ramo.' . $path . '.ERPUtils');
                $set = ERPUtils::saveFuncionarioInformation($params);
            }
            return $set;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - UserSupportUtils - saveUserByTag() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para obter os atributos do tipo de tag
     * 
     * @param string
     *
    */
    public static function getUserDetailsByTag($tag, $id_user){ 
        
        Yii::import('application.extensions.utils.users.UserUtils');

        $result = array();
        
        try {
            if($tag == 'clientes' || $tag == 'cliente'){
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
            echo 'ERROR - UserSupportUtils - getUserByTag() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar detalhes do usuário
     * 
     * @param array
     *
    */
    public static function saveDetalhesByTag(){
        
        Yii::import('application.extensions.utils.users.UserUtils');    

        $params = array();
        parse_str($_POST['data'], $params);  
        
        $id = $params['helper_id_user'];
       
        try{
            
            if($params['helper_tag'] =='cliente'){                
                $result['setDescricao'] =  UserUtils::setAttribute("descricao_cliente", $params['descricao'], "descricao", $id);
                $result['setImage'] =  UserUtils::setAttribute('img_cliente', $params['image'], "texto", $id);
                $result['setSite'] =  UserUtils::setAttribute("site", $params['site'], "texto", $id);
            }
            
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - UserSupportUtils - saveDetalhesByTag() ' . $e->getMessage();
        }
    }
    
}
