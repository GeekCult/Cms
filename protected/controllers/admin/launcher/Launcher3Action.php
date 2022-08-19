<?php

class Launcher3Action extends CAction{
    
    private $action;
    private $id;

    /**
     * Launcher
     * Specific Admin Action to create .xls files
     *
     */
    public function run(){
        
        Yii::import('application.extensions.utils.StringUtils');
        
        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        switch($this->action){
            
            case "read_candidates":
                $this->readCandidates();
                break;
            
            case "read_company":
                $this->readCompany();
                break;
            
            case "read_job_applyed":
                $this->jobApplyed();
                break;
            
            case "update_especialidades":
                $this->updateEspecialidades();
                break;
            
            case "update_especialidades2":
                $this->updateEspecialidades2();
                break;
            
            case "update_setor":
                $this->updateSetor();
                break;
            
            case "bancocurriculo_especialidades":
                $this->transporteEspecialidades();
                break;
            
            case "backup_status":
                //$this->backupStatus();
                break;
            
            case "check_emails":
                $this->checkEmails();
                break;
            
            case "check_interesse_newsletter":
                $this->checkInteresseNewsletter();
                break;
            
            case "run_produtos":
                $this->runProdutos();
                break;
            
            case "run_produtos_categorias":
                $this->runProdutosCategorias();
                break;
        }
    }
    
    /*
     * Roda rotina de produtos para cadastrar lista xls no banco
     * 
     * 
     */
    public function runProdutos(){
        
        Yii::import('application.extensions.digitalbuzz.excelReader.JPhpExcelReader'); 
        Yii::import('application.extensions.utils.launchers.DataUtils');
        
        $data = new JPhpExcelReader('../../../../media/user/files/produtos.xls');
            
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 1);            

        $date = date("Y-m-d H:i:s");            
        
        try{
            //for($i = 1; $i <= $data->sheets[0]['numRows']; $i++){
            for($i = 2; $i <= 15; $i++){
                //Common
                $id =$data->sheets[0]['cells'][$i][1];
                $ref =$data->sheets[0]['cells'][$i][2];
                $produto = mb_convert_encoding($data->sheets[0]['cells'][$i][3], "UTF-8", mb_detect_encoding($data->sheets[0]['cells'][$i][3], "UTF-8, ISO-8859-1, ISO-8859-15", false));
                
                if($data->sheets[0]['cells'][$i][23] != ''){$marca = mb_convert_encoding($data->sheets[0]['cells'][$i][3], "UTF-8", mb_detect_encoding($data->sheets[0]['cells'][$i][3], "UTF-8, ISO-8859-1, ISO-8859-15", false));}else{$marca = "";}
                if($data->sheets[0]['cells'][$i][22] != ''){$unidade = mb_convert_encoding($data->sheets[0]['cells'][$i][4], "UTF-8", mb_detect_encoding($data->sheets[0]['cells'][$i][3], "UTF-8, ISO-8859-1, ISO-8859-15", false));}else{$unidade = "";}
                
                $id_cat = $data->sheets[0]['cells'][$i][4];
                $id_subcat = $data->sheets[0]['cells'][$i][5];
                
                $foto = $data->sheets[0]['cells'][$i][10];

                $produto_final =  StringUtils::StringToLowerCase(StringUtils::RemoveSpecialChar($produto), 'label');
                //echo $produto_final  . " Foto: " . $foto ."</br>";
                $recordSet = array(
                    'ref' => $ref,
                    'nome' => $produto_final,
                    'marca' => $marca,
                    'unidade' => '', //StringUtils::StringToLowerCase($unidade, 'simple')
                    'id_categoria' => $id_cat,
                    'id_subcategoria' => $id_subcat,
                    'exibe_produto' => 1,
                    'exibe_ecommerce' => 0,
                    'status' => 1,
                    'tipo' => 'simples',
                    'date' => $date,
                    'last_update' => $date,
                    'sob_consulta' => 1,
                    'foto' => $foto . ".jpg"

                );
                
                if($i < 20000)$set = DataUtils::insertProduto($recordSet);
                //$email = StringUtils::StringToLowerCase($email, 'simple');

            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - runProdutos() " . $e->getMessage();
        } 
    }
    
    /*
     * Roda rotina de produtos para cadastrar lista xls no banco
     * 
     * 
     */
    public function runProdutosCategorias(){
        
        Yii::import('application.extensions.digitalbuzz.excelReader.JPhpExcelReader'); 
        Yii::import('application.extensions.utils.launchers.DataUtils');
        
        $data = new JPhpExcelReader('../../../../media/user/files/produtos_categorias.xls');
            
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 1);            

        $date = date("Y-m-d H:i:s");            
        
        try{
            //for($i = 1; $i <= $data->sheets[0]['numRows']; $i++){
            for($i = 10; $i <= 1010; $i++){
                //Common
                $id =$data->sheets[0]['cells'][$i][1];
                $titulo = mb_convert_encoding($data->sheets[0]['cells'][$i][2], "UTF-8", mb_detect_encoding($data->sheets[0]['cells'][$i][2], "UTF-8, ISO-8859-1, ISO-8859-15", false));
      

                //$titulo =  StringUtils::StringToLowerCase(StringUtils::RemoveSpecialChar($titulo), 'label');
                $titulo =  StringUtils::StringToLowerCase($titulo, 'especial');
                $url =  StringUtils::StringToUrl($titulo, true, '_');
                echo $id  . " titulo: " . $titulo ." - " . $url ."</br>";
                
                $recordSet = array(
                    'id' => $id,
                    'id_categoria' => 0,
                    'categoria_label' => $titulo,
                    'categoria_url' => $url,
                    'tipo' => 2, //produtos simples
                    'exibe' => 1,
                    'id_special' => true
                );
                
                $recordSub = array(
                    'id' => $id,
                    'id_categoria' => 0,
                    'subcategoria_label' => $titulo,
                    'subcategoria_url' => $url,
                    'tipo' => 2, //produtos simples
                    'exibe' => 1,
                    'id_special' => true
                );
                
                //if($i <= 10) $id = DataUtils::insertProdutoCategorias($recordSet);
                if($i <= 1000) $id = DataUtils::insertProdutoSubCategorias($recordSub);
                //$email = StringUtils::StringToLowerCase($email, 'simple');

            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - runProdutos() " . $e->getMessage();
        } 
    }
    
    public function checkInteresseNewsletter(){
        
        Yii::import('application.extensions.utils.special.NewsLetterUtils');
        
        $emails = NewsLetterUtils::getAllEmailWebhook();        
        $date = date("Y-m-d H:i:s");
        $p = 0;
        
        foreach($emails as $email){
            //if($p < 40){
                echo $email['email'] . "</br>";
                $isExist = NewsLetterUtils::checkEmailExist($email['email']);
                if(!$isExist){
                    $data = array('email' => $email['email'], 'cidade' => $email['cidade'], 'nome' => '', 'newsletter' => 1);
                    $set = NewsLetterUtils::insertIntoNewsletter($data, $date);
                }
            //}
            $p++;
        }
    }
    
    public function checkEmails(){
        
        Yii::import('application.extensions.utils.special.NewsLetterUtils');
        
        //$emails = NewsLetterUtils::getNewsLettersPierMail(false, 450);
        $emails = NewsLetterUtils::getNewsLettersPierMail();
        
        
        $p = 0;
        $total_existe = 0;
        $total_naoexiste = 0;
        
        foreach($emails as $email){
            //if($p < 40){
                
                $available = NewsLetterUtils::verifyEmail($email['email']);
                //echo "T - " . $available . "</br>";
                if($available){
                    $total_existe++;
                    //var_dump($available);
                    echo $p . " "  .$email['id'] . ' '.$email['email']." existe </br>";
                    
                }else{
                    $total_naoexiste++;
                    $status = NewsLetterUtils::updateEmailStatus($email['id'], 0, $email['email']);
                    echo $p . " " .$email['id'] . ' ' .$email['email'] ." nao existe!!! $status </br>";                    
                }                
            //}
            $p++;
        }
        
        echo  "</b>Existe: " . $total_existe . "</br>";
        echo  "Não existe: " . $total_naoexiste . "</br>";
    }
    
    /**
     * Backup Status
     *
     *
     */
    public function backupStatus(){ 
         
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.LocationUtils');

        //$table = "erp_boletos";
        $table = "erp_financeiro";
        
        try{      
            //TODO: Teocar abaixo também
            $sql = "SELECT * FROM $table";
            //Db backup
            $command = Yii::app()->db5->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               $command = Yii::app()->db->createCommand("UPDATE $table SET status = '{$recordset[$i]['status']}' WHERE id = {$recordset[$i]['id']}");
               $do = $command->execute(); 
               echo $recordset[$i]['id'] . " " . $recordset[$i]['status'] . " " . $do. "</br>";
            }
            
            echo "TOTAL: " . count($recordset);
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launche3Action - backupStatus() " . $e->getMessage();
        } 
    }
    
    /**
     * Backup Status
     *
     *
     */
    public function backupStatusERP(){ 
         
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.LocationUtils');


        try{            
            $sql = "SELECT * FROM erp_financeiro";
            //Db backup
            $command = Yii::app()->db5->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               $command = Yii::app()->db->createCommand("UPDATE erp_financeiro SET status = '{$recordset[$i]['status']}' WHERE id = {$recordset[$i]['id']}");
               $do = $command->execute(); 
               echo $recordset[$i]['id'] . " " . $recordset[$i]['status'] . " " . $do. "</br>";
            }
            
            echo "TOTAL: " . count($recordset);
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launche3Action - backupStatus() " . $e->getMessage();
        } 
    }
    
    /**
     * Read candidates
     *
     *
     */
    public function readCandidates(){ 
         
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.LocationUtils');
        
        $select  = "id, email, nome, sobrenome, cidade, estado, complemento, data_nascimento, estado_civil, cpf, ";
        $select .= "sexo, cep, endereco, numero, pais, bairro, imagem, area_interesse, especializacao, nivel_hierarquico, pre_ini, pre_fim, ";
        $select .= "status, nivel, ultimo_acesso, telefone, celular, data";
        //2346
        //2407
        //2624 ultimo
        //2901
        //2948
        //3041
        //3120
        //3135
        //3176
        try{            
            $sql = "SELECT * FROM candidato WHERE id > 3177";
           
            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
            //for($i = 0; $i < 1; $i++){
                //echo $recordset[$i]['name'] . ' ' . $recordset[$i]['value_string']. '</br>';
                $recordset[$i]['cpf'] = StringUtils::replace($recordset[$i]['cpf']);
                $recordset[$i]['documento'] = $recordset[$i]['cpf'];
                $recordset[$i]['field1'] = $recordset[$i]['nome'];
                $recordset[$i]['field2'] = $recordset[$i]['sobrenome'];
                
                $recordset[$i]['celular'] = StringUtils::replacePhone($recordset[$i]['celular']);
                $recordset[$i]['telefone'] = StringUtils::replacePhone($recordset[$i]['telefone']);
                $recordset[$i]['birthday'] = DateTimeUtils::setFormatDateNoTime($recordset[$i]['data_nascimento']);
                $recordset[$i]['id_account_states'] = 1;
                if($recordset[$i]['data'] != "0000-00-00 00:00:00") $recordset[$i]['creation'] = $recordset[$i]['data'];
                $recordset[$i]['ignore_email'] = true;
                $recordset[$i]['id_departamento'] = $recordset[$i]['id'];
                $recordset[$i]['profissao'] = 0;
                $recordset[$i]['estado_civil'] = EmpregosUtils::getIdEstadoCivil($recordset[$i]['estado_civil']);
                
                //Extras
                $recordset[$i]['extra_1'] = $recordset[$i]['setor'] = $recordset[$i]['area_interesse'];
                $recordset[$i]['extra_2'] = $recordset[$i]['especializacao'];
                $recordset[$i]['extra_3'] = $recordset[$i]['hierarquia'] = $recordset[$i]['nivel_hierarquico'];
                $recordset[$i]['extra_4'] = $recordset[$i]['pretensao'] = EmpregosUtils::getIdPretensaoByValue($recordset[$i]['pre_ini']);
                
                $recordset[$i]['cidade'] = addslashes(LocationUtils::getCidadeById($recordset[$i]['cidade']));
                $recordset[$i]['estado_string'] = LocationUtils::getEstadoById($recordset[$i]['estado']);
                
                $recordset[$i]['password_old'] = base64_decode($recordset[$i]['senha']);
                $recordset[$i]['password_string'] = $recordset[$i]['password_old'];
                $recordset[$i]['password'] = md5($recordset[$i]['password_string']);
                $recordset[$i]['editar'] = false;
                
                //Avatar
                if($recordset[$i]['imagem'] != '') $recordset[$i]['avatar'] = "/media/user/images/original/" . $recordset[$i]['imagem'];
                
                
                $id_user = UserUtils::createQuickUserAccount($recordset[$i], true, true);
      
                //More details;
                $recordset[$i]['nivel_idioma'] = EmpregosUtils::getNivelIdioma($recordset[$i]['id']);
                $recordset[$i]['conhecimento_informatica'] = EmpregosUtils::getConhecimentoInformatica($recordset[$i]['id']);
                $recordset[$i]['experiencia_profissional'] = EmpregosUtils::getExperienciaProfissional($recordset[$i]['id']);
                $recordset[$i]['formacao_academica'] = EmpregosUtils::getFormacaoAcademica($recordset[$i]['id']);
                $recordset[$i]['informacoes'] = EmpregosUtils::getInformacoesComplementares($recordset[$i]['id']);
                
                ($recordset[$i]['ultimo_acesso'] != "0000-00-00 00:00:00") ? $last_update = $recordset[$i]['ultimo_acesso'] : $last_update = date("Y-m-d H:i:s");
                $setLastUpdate = UserUtils::setAttribute('usuario_LastUpdate', $last_update, 'texto', $id_user);
                
                $setCurriculos = $this->setCurriculosData($recordset[$i], $id_user);
                
                //echo "User: " . $id_user . " " . json_encode($setCurriculos) ."</br>";
                ($id_user > 7836) ? $newUser = " - Novo usuario " : $newUser = "";
                echo "User: " . $id_user . " " . $recordset[$i]['setor']  . " ID: ". $recordset[$i]['id']. " Estado - " . $recordset[$i]['estado'] . " -  " . $recordset[$i]['birthday'] . $newUser . "</br>";
        
            }
            //echo nl2br(MethodUtils::prettyPrintJSON(json_encode($recordset)));
            //echo json_encode($recordset);
            //return $recordset;       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launche3Action - readCandidates() " . $e->getMessage();
        } 
    }
    
    /**
     * Read company
     *
     *
     */
    public function readCompany(){ 
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');  
        Yii::import('application.extensions.utils.special.LocationUtils');
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        
        $select  = "id, email, nome_fantasia, razao_social, cidade, estado, complemento, porte, setor, cnpj, ";
        $select .= "descricao, cep, endereco, numero, pais, bairro, imagem, contato, ";
        $select .= "status, nivel, ultimo_acesso, telefone, data_criacao";
        try{            
            $sql = "SELECT * FROM empresa";
           
            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
            //for($i = 0; $i < 1; $i++){
                //echo $recordset[$i]['name'] . ' ' . $recordset[$i]['value_string']. '</br>';
                $recordset[$i]['field1'] = StringUtils::replace($recordset[$i]['razao_social']);
                $recordset[$i]['field2'] = StringUtils::replace($recordset[$i]['nome_fantasia']);
                
                
                $recordset[$i]['cnpj'] = StringUtils::replace($recordset[$i]['cnpj']);
                $recordset[$i]['telefone'] = StringUtils::replacePhone($recordset[$i]['telefone']);
                $recordset[$i]['documento'] = $recordset[$i]['cnpj'];
                
                $recordset[$i]['cidade'] = addslashes(LocationUtils::getCidadeById($recordset[$i]['cidade']));
                $recordset[$i]['estado'] = LocationUtils::getEstadoById($recordset[$i]['estado']);
                $recordset[$i]['telefone'] = StringUtils::replacePhone($recordset[$i]['telefone']);
                $recordset[$i]['id_account_states'] = 1;
                
                $recordset[$i]['ignore_email'] = true;
                $recordset[$i]['tipo_conta'] = $recordset[$i]['type'] = 1;
                
                $recordset[$i]['password_old'] = base64_decode($recordset[$i]['senha']);
                $recordset[$i]['password_string'] = $recordset[$i]['password_old'];
                $recordset[$i]['password'] = md5($recordset[$i]['password_string']);
                $recordset[$i]['creation'] = $recordset[$i]['data_criacao'];
                
                $recordset[$i]['editar'] = false;
                
                //Avatar
                if($recordset[$i]['imagem'] != '') $recordset[$i]['avatar'] = "/media/user/images/original/" . $recordset[$i]['imagem'];
                
                
                
                $id_user = UserUtils::createQuickUserAccount($recordset[$i], true, true);
                //echo $id_user;
                
                ($id_user > 7728) ? $newUser = " - Novo usuário " : $newUser = "";
                echo "User: " . $id_user . " " . " ID: ". $recordset[$i]['id']. $newUser . "</br>";
                //echo $id_user . " " . $recordset[$i]['password_old'] . "</br>";
                
                ($recordset[$i]['ultimo_acesso'] != "0000-00-00 00:00:00") ? $last_update = $recordset[$i]['ultimo_acesso'] : $last_update = date("Y-m-d H:i:s");
                $setLastUpdate = UserUtils::setAttribute('usuario_LastUpdate', $last_update, 'texto', $id_user);
                
                //Vagas
                //TODO conferir vagas STATUS
                //TODO adicionar nivel de usuário: publico ou protegido
                $recordset[$i]['vagas'] = EmpregosUtils::getVagasByCompany($recordset[$i]['id']);
                
                $recordset[$i]['setVagas'] = $this->setVagas($recordset[$i], $id_user);
     
            }
           
            //echo nl2br(MethodUtils::prettyPrintJSON(json_encode($recordset)));
            //return $recordset;       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launche3Action - readCompany() " . $e->getMessage();
        } 
    }
    
    /**
     * Set curriculo data 
     *
     * @param array
     *
     */
    public function setCurriculosData($data, $id_user){ 
       
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        Yii::import('application.extensions.dbuzz.site.bancocurriculos.CurriculosManager');
        
        $curriculosHandler = new CurriculosManager();
        
        try{            
            $result['idiomas'] = EmpregosUtils::setIdiomas($data['nivel_idioma'], $id_user);
            $result['conhecimento_informatica'] = EmpregosUtils::setConhecimentoInformatica($data['conhecimento_informatica'], $id_user);
            $result['experiencia_profissional'] = EmpregosUtils::setExperienciaProfissional($data['experiencia_profissional'], $id_user);
            $result['formacao_academica'] = EmpregosUtils::setFormacaoAcademica($data['formacao_academica'], $id_user);
            $result['informacoes'] = EmpregosUtils::setInformacoesComplementares($data['informacoes'], $id_user);
            $result['resume'] = $curriculosHandler->saveResumeAttributes($data, $id_user, true);
            
            //Set Recent Activity                 
            $activity = array(
                    "title" => Yii::t("activityStrings", "resume_submit"),
                    "nome" => $data['nome'] . ' ' . $data['sobrenome'],
                    "email" => $data['email'],
                    "telefone" => $data['telefone'],
                    "profissao" => BancoCurriculosUtils::getProfissaoById($data['profissao'], 'descricao'),
                    "tempo_experiencia" => "" . ' ' . "",
                    "message" => Yii::t("activityStrings", "resume_submit_desc"),
                    "tipo" => "curriculo",
                    "id_general" => $id_user,
                    "id_user" => $id_user,
                    "date" => date("Y-m-d H:i:s")
                );

            $result['activity'] = MethodUtils::setActivityRecent($activity);

            return $result;       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - setCurriculosData() " . $e->getMessage();
        } 
    }
    
    /**
     * Set curriculo data 
     *
     * @param array
     *
     */
    public function setVagas($data, $id_user){ 
       
        $result = array();
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        Yii::import('application.extensions.dbuzz.admin.bancocurriculos.VagasManager');
        
        $vagasHandler = new VagasManager();
        
        $select  = "id, area, especializacao, nivel_hierarquico, pne, cargo, ";
        $select .= "numero_vagas, descricao, tipo_contrato, jornada, id_user, ";
        $select .= "cep, endereco, numero, bairro, estado, cidade, salario_ini, salario_fim, ";
        $select .= "data, id_user, status";
        
        try{
            $info['nome'] = $data['field2']; 
            $info['email'] = $data['email'];
            $info['telefone'] = $data['telefone'];
            $info['tipo'] = 'vaga';
            
            foreach ($data['vagas'] as $value) {
                //Set values need to a old method
                $value['titulo'] = $value['cargo'];
                $value['setor'] = $value['area'];
                $value['salario'] = EmpregosUtils::getIdPretensaoByValue($value['salario_ini']);
                $value['hierarquia'] = $value['nivel_hierarquico'];
                $value['empresa'] = $info['nome'];
                $value['destaque'] = 1;
                $value['id_general'] = $value['id'];
                
                $val_job = array_merge($value, $info);
                
                $isVagasExist = $this->checkVagaExist($id_user, $value['titulo']);
                (!$isVagasExist) ? $result = $vagasHandler->createVaga($val_job) : $result = false;
                
            }
            
            return $result;       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - setVagas() " . $e->getMessage();
        } 
    }
    
    /**
     * Apply candidates to a job 
     *
     * @param array
     *
     */
    public function jobApplyed(){ 
       
        Yii::import('application.extensions.utils.launchers.EmpregosUtils');
        Yii::import('application.extensions.dbuzz.site.bancocurriculos.VagasManager');
        
        $vagasHandler = new VagasManager();
        
        $select  = "id, id_curriculo, id_vaga, data";
        
        $sql = "SELECT * FROM candidatura";
        
        try{

            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            foreach ($recordset as $value){
                $id_candidate = EmpregosUtils::getUserByIdOld($value['id_curriculo']);
                $job = EmpregosUtils::getVagaByIdOld($value['id_vaga']);
                $candidatar = EmpregosUtils::candidatar($id_candidate, $job);
                echo $candidatar;
                //echo $value['id'] . " - " . $id_candidate . ' - (' . $value['id_vaga'] . " - ". $job['id'] . " - " . $job['id_usuario'] . ")";
            }
            
            
            return $recordset;       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - jobApplyed() " . $e->getMessage();
        } 
    }
    
    /**
     * Método para criar uma vaga
     * Usa-se como um pedidi e este pode ser qualquer um
     * basta seguir os campos da tabela controle_pedidos ou utilizar
     * a tabela de apoio controle_attributes
     *
     * @param array
     *
     * @return bool
     * 
     */
    public function checkVagaExist($id, $titulo) {
        
        $sql = "SELECT id FROM controle_pedidos WHERE id_usuario = $id AND titulo = '$titulo'";
        
        try{

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();             
            
            return $recordset;  

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: Launcher3Action - checkVagaExist() ' . $e->getMessage();
        }
    }
    
    /**
     * Create estoque item from a main ecommerce item 
     *
     *
     */
    public function transporteEspecialidadesCursos(){ 
       
        Yii::import('application.extensions.utils.special.BancoCurriculosUtils');
        
        try{            
            $sql = "SELECT id, idioma FROM idiomas";
           
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 1; $i < count($recordset); $i++){
                //echo $recordset[$i]['id'] . ' ' . $recordset[$i]['idioma']. '</br>';
                $data['parent'] = $recordset[$i]['id'];
                $data['name'] = 'idioma';
                $data['value_string'] = $recordset[$i]['idioma'];
                $data['value_int'] = 0;
                $data['value_float'] = 0;
                $set = BancoCurriculosUtils::manageEspecialidade($data);
            }
           
            //return $recordset['id'];       
   

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: Launcher3Action - transporteEspecialidades() " . $e->getMessage();
        } 
    }
    
    /**
     * Método para excluir um registro existente
     * 
     *
     * @param number
     *
    */
    public function updateEspecialidades(){
       
        try {
            $sql = "SELECT id, id_area_interesse, especializacao FROM especializacao";
           
            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               $command = Yii::app()->db2->createCommand("UPDATE general_especialidades SET  name = 'especializacao', value_string = '{$recordset[$i]['especializacao']}', value_int = {$recordset[$i]['id_area_interesse']} WHERE id = {$recordset[$i]['id']}");
               //$do = $command->execute(); 
               echo $recordset[$i]['especializacao'] . " " . "</br>";
            }

            //          
            //return $do;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserUtils - setUserAccountState() ' .  $e->getMessage();
        }
    }
    
    public function updateEspecialidades2(){
       
        try {
            $sql = "SELECT * FROM general_especialidades WHERE name = 'area' AND parent < 14";
           
            $command = Yii::app()->db_manager_online->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               //$command = Yii::app()->db2->createCommand("UPDATE general_especialidades SET  parent = {$recordset[$i]['parent']} WHERE id = {$recordset[$i]['id']}");
               $command = Yii::app()->db2->createCommand("INSERT INTO general_especialidades (name, value_string, parent) VALUES ('{$recordset[$i]['name']}', '{$recordset[$i]['value_string']}', {$recordset[$i]['parent']})");
               //$do = $command->execute(); 
               echo $recordset[$i]['name'] . " " . $recordset[$i]['value_string'] . "</br>";
            }

            //          
            //return $do;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserUtils - setUserAccountState() ' .  $e->getMessage();
        }
    }
    
    public function updateSetor(){
       
        try {
            $sql = "SELECT id, setor FROM setor";
           
            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               //$command = Yii::app()->db2->createCommand("UPDATE general_especialidades SET  name = 'especializacao', value_string = '{$recordset[$i]['especializacao']}', value_int = {$recordset[$i]['id_area_interesse']} WHERE id = {$recordset[$i]['id']}");
               $command = Yii::app()->db2->createCommand("INSERT INTO general_especialidades (name, value_string, parent) VALUES ('setor', '{$recordset[$i]['setor']}', {$recordset[$i]['id']})");
               $do = $command->execute(); 
               echo $recordset[$i]['setor'] . " " . "</br>";
            }


            //          
            //return $do;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserUtils - updateAreaInteresse() ' .  $e->getMessage();
        }
    }
    
    public function removeCurriculos(){
       
        try {
            $sql = "SELECT id, setor FROM setor";
           
            $command = Yii::app()->db6->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
               //$command = Yii::app()->db2->createCommand("UPDATE general_especialidades SET  name = 'especializacao', value_string = '{$recordset[$i]['especializacao']}', value_int = {$recordset[$i]['id_area_interesse']} WHERE id = {$recordset[$i]['id']}");
               $command = Yii::app()->db2->createCommand("INSERT INTO general_especialidades (name, value_string, parent) VALUES ('setor', '{$recordset[$i]['setor']}', {$recordset[$i]['id']})");
               $do = $command->execute(); 
               echo $recordset[$i]['setor'] . " " . "</br>";
            }
            
            //return $do;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: UserUtils - updateAreaInteresse() ' .  $e->getMessage();
        }
    }
}

?>