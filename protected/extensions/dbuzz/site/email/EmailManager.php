<?php

/*
 * This Class search the content sent from a jQuery request
 *
 * @author CarlosGarcia
 *
 */

class EmailManager{
    
    /**
     * Método para recuperar os contatos cadastrados
     *
    */
    public function getAllContent($tipo = "contato"){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, nome, email, telefone, mensagem, data, titulo, last_update, container_1";
        $sql = "SELECT $select FROM general_contato WHERE tipo = '$tipo' ORDER BY id DESC";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os contatos cadastrados
     *
    */
    public function getAllContentBySql($tipo = "contato", $sql = ""){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, nome, email, telefone, mensagem, data, titulo, last_update, container_1, COUNT(*) AS total";
        $sql = "SELECT $select FROM general_contato WHERE tipo = '$tipo' $sql ORDER BY id DESC";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                    $recordset[$i]['last_update_string'] = DateTimeUtils::getDateFormate($recordset[$i]['last_update']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um e-mail cadastrado, neste caso está referindo-se a um template
     * salvo previamente
     *
    */
    public function getContent($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, nome, email, telefone, mensagem, data, tipo, titulo, last_update, container_1, link";
        $sql = "SELECT $select FROM general_contato WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['data']);
                }
                
                Yii::import('application.extensions.digitalbuzz.attributes.PreferencesAttribute');
                $pA = new PreferencesAttribute();
                $pA->setCurrentUser(0);
                $recordset['padrao'] = $pA->recuperar("emkt_padrao", "inteiro");
            }
            
            return $recordset;

        }catch(CDbException $e){
            echo "ERROR ".$e->getMessage();
        }
    }
    
    
    /**
     * Método para enviar um e-mail como citado no switch abaixo
     * Várias páginas utilizam esse método, e veja também no classe
     * MethodUtils um metodo statico que faz essa chamada.
     * 
     * $isOwnerNeeded means all sistem user will receive a copy from the email.
     *
    */
    public function submitSubscription($data, $isOwnerNeeded = true){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.EmailUtils');
        Yii::import('application.extensions.utils.ModulesUtils');
        Yii::import('application.extensions.digitalbuzz.email.dbEmail');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        try {
            $dados = HelperUtils::getTitleSite();
            $date = date('Ymd');

            //add message in database if newsletter true
            if(!isset($data['newsletter'])) $data['newsletter'] = true;
            if($data['newsletter']){
                $setNewsletter = EmailUtils::acceptNewsLetter($data, $date);
            }

            //Gets social networks
            $network = array();
            $network['facebook'] = HelperUtils::getSocialNetWorkProfile("facebook");
            $network['twitter']  = HelperUtils::getSocialNetWorkProfile("twitter");
            $network['rss']  = HelperUtils::getSocialNetWorkProfile("rss");
            $data['social_networks'] = ModulesUtils::getSocialNetworksForEmails($network);

            $isOwnerReceiver = false;

            //send email from purplepier
            $data['titulo'] = $dados['email_title'];
            $data['server'] = $_SERVER['SERVER_NAME'];

            $data['logo'] = HelperUtils::getLogo("logos");
            $email_receiver = EmailUtils::getEmailContato();
            $data['sender'] = EmailUtils::getEmailSender();

            $data['layout_template'] = EmailUtils::getEmailLayout();
            if(isset($data['layout_reply']) && $data['layout_reply'] == "") $data['layout_reply'] = "reply_common";
            if(!isset($data['layout_reply'])) $data['layout_reply'] = "reply_common";

            $email = new dbEmail();
            $email->setReturnPath($data['sender']);
            $email->setFrom($data['sender'], $data['titulo']);
                   

            //Verify if an email title is set
            if(isset($data['titulo_email'])){
                $email->subject($data['titulo_email']);
            }else{
                $email->subject(Yii::t("siteStrings", "email_title_" . $data['tipo']));
            }

            $email->loadLayout("mail_common");
            if(!isset($data['render'])) $email->setContent("email/content/" .$data['layout']); 
            if( isset($data['render']) && $data['render']) $email->setRenderPartial($data);

            //Main info
            $email->replace("title", $data['titulo']);
            $email->replace("server",  $data['server']);
            $email->replace("logo",   "http://" . $data['server'] ."/media/user/images/original/" . $data['logo']);        
            $email->replace("header", "http://" . $data['server'] ."/media/images/textures/topo_email/" . $data['layout_template']['textura_topo_email']);
            $email->replace("footer", "http://" . $data['server'] ."/media/images/textures/rodape_email/" . $data['layout_template']['textura_rodape_email']);

            switch($data['tipo']){

                case "cadastro":
                    $isOwnerReceiver = true;
                    $data['hash'] = md5($data['email'] . $data['cpf']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_conta']);
                    $data['layout_reply'] = "cadastro_common";
                    $this->submitReply($data);
                    break;

                case "cadastro_rapido":
                    $isOwnerReceiver = true;
                    $data['hash'] = md5($data['email'] . $data['cpf']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_conta']);
                    $email->replace("password", $data['password']);
                    $data['layout_reply'] = "cadastro_rapido";
                    $this->submitReply($data);
                    break;

                case "cadastro_atualizar_com_senha":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_conta']);
                    $this->submitReply($data);
                    break;

                case "nova_senha":
                    $email->replace("nome", $data['nome']);                        
                    $email->replace("senha", $data['senha']);
                    $email->recipient($data['email']); 
                    break;
                
                case "forum":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['user']); 
                    $email->replace("titulo", $data['titulo_forum']);                        
                    $email->replace("subtitulo", $data['subtitulo_forum']); 
                    $email->replace("descricao", $data['descricao_forum']);
                    break;
                
                case "ticket":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['user']); 
                    $email->replace("dominio", $data['empresa']);
                    $email->replace("titulo", $data['titulo_ticket']);                   
                    $email->replace("descricao", $data['descricao_ticket']);
                    $email->replace("id", $data['id_ticket']); 
                    break;
                
                case "licitacao_fornecedor":
                    $isOwnerReceiver = true;
                    $email->replace("empresa", $data['field1']); 
                    $email->replace("email", $data['email']);                        
                    $email->replace("cidade", $data['cidade']); 
                    $email->replace("endereco", $data['endereco']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("cnpj", $data['documento']); 
                    $email->replace("licitacao", $data['licitacao']); 
                    $isSpecialReceiver = true;
                    $email_special_receiver = Yii::app()->params['licitacao_email_receivers'];
                    if($email_special_receiver != '') $isSpecialReceiver = true;
                    break;
                
                case "vale_credito":                       
                    $email->replace("vale_credito", $data['vale_credito']);
                    $email->recipient($data['email']); 
                    break;
                
                case "notificacao": 
                    $isOwnerReceiver = true;
                    if(isset($data['isOwnerReceiver'])) $isOwnerReceiver = $data['isOwnerReceiver'];
                    if(isset($data['comentario'])) $email->replace("comentario", $data['comentario']);
                    $email->replace("titulo_notificacao", $data['titulo_note']);
                    $email->replace("like", $data['avaliacao']);
                    $email->replace("tipo_item", $data['tipo_item']);
                    break;
                
                case "redebeneficios_aprovado":                       
                    $email->replace("nome", $data['nome']);
                    $email->recipient($data['email']);            
                    break;
                
                case "seguir": 
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $this->submitReply($data);
                    break;

                case "contato":
                case "recados":
                case "duvida":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("conteudo", nl2br($data['mensagem']));
                    $this->submitReply($data);
                    break;
                
                case "duvida_resposta":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['nome']);                    
                    $email->replace("titulo_duvida", $data['titulo_duvida']);
                    $email->replace("duvida", $data['duvida']);
                    $email->replace("resposta", nl2br($data['resposta']));
                    break;

                case "promocao":
                    $isOwnerReceiver = true;
                    $this->submitReply($data);
                    break;
                
                case "promocao_indicacao_premiada":
                    $isOwnerReceiver = false;
                    break;
                
                case "promocao_participante":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("promocao", $data['promocao']);
                    $data['layout_reply'] =  $data['layout'];
                    $this->submitReply($data);
                    break;
                
                case "curriculo":
                    $isOwnerReceiver = true;                
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("profissao", $data['profissao']);
                    $email->replace("tempo_experiencia", $data['tempo_experiencia']);
                    $data['layout_reply'] = "curriculum_submited_common";
                    $data['hash'] = md5($data['email'] . $data['cpf']);
                    $this->submitReply($data);
                    break;

                case "indique_amigo":
                    $email->recipient($data['email']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("conteudo", $data['mensagem']);
                    $email->replace("titulo_interesse", $data['titulo_interesse']);
                    $email->replace("texto_interesse", $data['texto_interesse']);                   
                    ($data['link_interesse'] != '') ? $email->replace("link", $_SERVER['HTTP_HOST'] . $data['link_interesse']) : $email->replace("link", $_SERVER['HTTP_HOST'] ."/". $_SERVER['REQUEST_URI']);
                    $email->replace("conteudo", nl2br($data['mensagem']));
                    break;

                case "general_action":
                case "bug":
                case "error":    
                    $isOwnerReceiver = false;
                    $email->recipient($data['email']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo']);
                    $email->replace("titulo_mensagem", $data['titulo_mensagem']);
                    $email->replace("conteudo", nl2br($data['mensagem']));
                    (isset($data['time'])) ? $email->replace("time", $data['time']) : $email->replace("time", '');
                    break;

                case "publicidade":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $this->submitReply($data);
                    break;

                case "tarefa":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['nome']);
                    $email->replace("titulo_tarefa", $data['titulo_tarefa']);
                    $email->replace("descricao", $data['descricao']);
                    if(isset($data['cliente'])) $email->replace("cliente", $data['cliente']);                    
                    break;

                case "interesse_promocao":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("loja", $data['loja']);
                    $email->replace("telefone", $data['telefone']);
                    $this->submitReply($data);
                    break;

                case "eventos":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("celular", $data['celular']);
                    $email->replace("endereco", $data['endereco']);
                    $email->replace("cidade", $data['cidade']);
                    $email->replace("mensagem", $data['mensagem']);
                    $email->replace("evento", $data['titulo_evento']);
                    (isset($data['layout_event_reply'])) ? $data['layout_reply'] = $data['layout_event_reply'] : $data['layout_reply'] = "evento_reply_common";
                    $this->submitReply($data);
                    break;

                case "eventos_externo":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("profissao", $data['profissao']);
                    $email->replace("empresa", $data['empresa']);
                    $email->replace("documento", $data['documento']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("aniversario", $data['aniversario']);
                    $email->replace("evento", $data['titulo_evento']);
                    (isset($data['layout_event_reply'])) ? $data['layout_reply'] = $data['layout_event_reply'] : $data['layout_reply'] = "evento_reply_common";
                    $this->submitReply($data);
                    break;
                
                case "orcamentus":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("celular", $data['celular']);
                    $email->replace("cidade", $data['cidade']);
                    $email->replace("titulo", $data['titulo_orcamentus']);
                    $email->replace("descricao", $data['descricao_orcamentus']);
                    $data['layout_reply'] = "orcamentus_reply_common";
                    if(isset($data['reply']) && $data['reply'])$this->submitReply($data);
                    break;

                 case "reclamar":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("titulo_reclamacao", $data['titulo_reclamacao']);
                    $email->replace("mensagem", nl2br($data['mensagem']));
                    $this->submitReply($data);
                    break;
                
                 case "reservas":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("dia", $data['data']);
                    $email->replace("horario", $data['hour']);
                    $data['layout_reply'] = 'reservation';
                    $this->submitReply($data);
                    break;

                case "parceria":
                    $isOwnerReceiver = true;               
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("file", $data['file']);
                    $email->replace("descricao", $data['comentario']);
                    $email->replace("titulo_projeto", $data['titulo_projeto']);
                    $email->replace("cnpj", $data['cnpj']);                
                    $this->submitReply($data);
                    break;

                case "associar":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("cnpj", $data['cnpj']); 
                    $email->replace("scpc", $data['scpc']);
                    $email->replace("publicidade", $data['publicidade']);
                    $email->replace("business", $data['business']);
                    $email->replace("origem", $data['origem']);
                    $email->replace("digital", $data['digital']);
                    $email->replace("cooperativa", $data['cooperativa']);
                    $email->replace("exclusividade", $data['exclusividade']);
                    $email->replace("consultoria", $data['consultoria']);
                    $email->replace("jucesp", $data['jucesp']);
                    $email->replace("mais_varejo", $data['mais_varejo']);
                    $email->replace("mapa_comercio", $data['mapa_comercio']);
                    $this->submitReply($data);
                    break;

                case "user_attribute":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_conta']);
                    $email->replace("email", $data['email']);
                    break;

                case "playground":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['nome']);
                    $email->replace("image", $data['image']);
                    $email->replace("nome_amigo", $data['nome_amigo']);
                    $email->replace("mensagem", nl2br($data['mensagem']));
                    $email->replace("size", $data['size']);
                    break;

                case "cobranca":
                case "reenviar_cobranca":
                    $isOwnerReceiver = false;
                    $descricao = $this->getFormatLines($data['items'], "cobranca");
                    $email->recipient($data['email']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("titulo", $data['titulo']);
                    $email->replace("mensagem", nl2br($data['mensagem']));
                    //if($data['tipo'] == "reenviar_cobranca") $email->replace("pedido", $data['pedido']);
                    $email->replace("url", $data['url']);
                    $email->replace("descricao", $descricao);            
                    break;

                case "comentario":
                    $isOwnerReceiver = true;  
                    if(isset($data['tipo_comentario'])) $email->replace("tipo_comentario", $data['tipo_comentario']);
                    if(isset($data['info']['titulo'])) $email->replace("titulo_comentario", $data['info']['titulo']);
                    if(isset($data['info']['nome'])) $email->replace("titulo_comentario", $data['info']['nome']);                    
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $email->replace("comentario", nl2br($data['comentario']));
                    $this->submitReply($data);
                    break;

                case "orcamento":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("contato", $data['contato']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("titulo", $data['titulo_orcamento']);
                    $email->replace("mensagem", $data['descricao_orcamento']);
                    $email->replace("celular", $data['celular']);
                    $email->replace("tipo_contato", $data['tipo_contato']);
                    $email->replace("endereco", $data['endereco']);
                    $email->replace("cidade", $data['cidade']);
                    $email->replace("bairro", $data['bairro']);
                    $email->replace("estado", $data['estado']);
                    $email->replace("cep", $data['cep']);
                    $this->submitReply($data);
                    break;
                
                case "orcamento_web":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("plano", $data['plano']);
                    $email->replace("registro", $data['registro']);
                    $email->replace("dominio", $data['dominio']);
                    $email->replace("cupom", $data['cupom']);
                    $email->replace("email", $data['email']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("titulo", $data['titulo_orcamento']);
                    
                    $email->replace("cpf", $data['cpf']);
                    $email->replace("tipo_contato", $data['tipo_contato']);
                    $email->replace("endereco", $data['endereco']);
                    $email->replace("cidade", $data['cidade']);
                    $email->replace("bairro", $data['bairro']);
                    $email->replace("estado", $data['estado']);
                    $email->replace("cep", $data['cep']);
                    $this->submitReply($data);
                    break;

                case "produtos":
                    $email->replace("nome", $data['nome']);
                    $this->submitReply($data);
                    break;
                
                case "pesquisa":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['user']); 
                    $email->replace("titulo", $data['titulo_forum']);                        
                    $email->replace("descricao", $data['descricao_forum']);
                    break;
                
                case "pesquisa_reply":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']); 
                    $email->replace("titulo", $data['titulo_pesquisa']);                        
                    $email->replace("json", $data['json']);
                    break;

                case "corrigir_pesquisa":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("nota", $data['nota']);
                    $email->replace("curso", $data['curso']);
                    $email->replace("conteudo", $data['mensagem']);
                    $this->submitReply($data);
                    break;

                case "corrigir_pesquisa_recuperacao":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("nota", $data['nota']);
                    $email->replace("curso", $data['curso']);
                    $email->replace("conteudo", $data['mensagem']);
                    $email->replace("url", $data['recuperacao']['url']);
                    $this->submitReply($data);
                    break;

                case "enviar_codigo_correios":
                    $email->replace("nome", $data['nome']);
                    $email->replace("codigo_correio", $data['codigo_correio']);
                    $email->replace("curso", $data['curso']);
                    $email->replace("conteudo", $data['mensagem']);
                    break;
                
                case "relatar":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("atividade", $data['mensagem']);
                    break;
                
                case "newsletter":
                    $isOwnerReceiver = true;
                    $email->replace("nome", $data['nome']);
                    $email->replace("email", $data['email']);
                    $data['layout_reply'] = "newsletter_reply_common";
                    $this->submitReply($data);
                    break;
                
                case "erp_publicidade":
                    $isOwnerReceiver = true;
                    $email->replace("dominio", $data['dominio']);
                    $email->replace("titulo", $data['titulo']);
                    $email->replace("descricao", $data['descricao']);
                    $email->replace("periodo", $data['quantidade']);
                    $email->replace("valor", $data['valor']);                    
                    $this->submitReply($data);
                    break;
                
                case "vaga":
                    $isOwnerReceiver = true;
                    $email->replace("titulo", $data['titulo_vaga']);
                    $email->replace("email", $data['email']);
                    $email->replace("empresa", $data['nome']);
                    $this->submitReply($data);
                    break;
                
                //Empresa que recebe curriculo
                case "candidatar_vaga":
                    $isOwnerReceiver = false;
                    $email->replace("vaga", $data['titulo_vaga']);
                    $email->replace("email_candidato", $data['email_candidato']);
                    $email->replace("cidade", $data['cidade_candidato']);
                    $email->replace("telefone", $data['telefone']);
                    $email->replace("candidato", $data['candidato']);
                    $email->replace("contato", $data['contato']);
                    $email->replace("profissao", $data['profissao']);
                    $email->replace("setor", $data['setor']);
                    $email->replace("especializacao", $data['especializacao']);
                    $email->replace("tempo_experiencia", $data['tempo_experiencia']);
                    
                    break;
                //Candidato recebe notificacao da vaga que se candidatou
                case "candidato_vaga":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['candidato']);   
                    $email->replace("vaga", $data['titulo_vaga']);                    
                    break;
                
                //Qualquer tipo de informacao
                case "informacao":
                    $isOwnerReceiver = false;
                    $email->replace("nome", $data['nome']);                   
                    break;
                
                //Qualquer tipo de informacao
                case "teste":
                    $isOwnerReceiver = true;
                    if(isset( $data['nome'])) $email->replace("nome", $data['nome']);
                    if(isset( $data['message'])) $email->replace("message", nl2br ($data['message']));
                    break;
                    
                case "cotacao":
                    $isOwnerReceiver = true;
                    $email_receiver = 'pedidosonline@fgimport.com.br';
                    $this->submitReply($data);
                    break;
                
                //Invoice
                case "invoice":
                    $isOwnerReceiver = false;                                      
                    break;
                
                 //Qualquer tipo de informacao
                case "purplestore":
                    $isOwnerReceiver = false;
                    $email->replace("dominio", $data['dominio']); 
                    $email->replace("item", $data['item']);                   
                    break;
                
                //Qualquer tipo de informacao
                case "seja_fornecedor":
                    $isOwnerReceiver = true;
                    $email->replace("empresa", $data['nome']);  
                    $email->replace("cidade", $data['cidade']);
                    $email->replace("insumo", $data['tipo_fornecedor_string']);
                    break;
                
                //Outras chamadas
                case "boleto":
                    $isOwnerReceiver = false;                 
                    break;
                
                default:
                    $isOwnerReceiver = true;                                      
                    break;
            }
            
            //If it's a attachement
            (isset($data['folder'])) ? $folder = $data['folder'] : $folder = 'pdf';
            //It verifies if there are more than just one e-mail that will receive
            //that infos, if there are all the e-mail will be dispatched
            $checkSendEmail = false;
            $email->replace("do", Yii::t('siteStrings', "do_a_". Yii::app()->params['gender']));
            $email->replace("social_network", $data['social_networks']);

            if(!$isOwnerReceiver){
                if($isOwnerNeeded){                 
                    
                    $receiver = explode(", ", $data['email']);
                    for($i = 0; $i < count($receiver); $i++){                         
                        $email->recipient($receiver[$i]);
                        
                        //If there is a file to be attached
                        if(isset($data['attachment'])){
                            $email->header("mixed", $data['attachment'], $folder);
                        }else{
                            $email->header("html");
                        }   
                        
                        $checkSendEmail = $email->send();
                        
                    }                    
                };
                
            }else{
                
                if($isOwnerNeeded){
                    $receiver_owner = explode(", ", $email_receiver);
                    for($i = 0; $i < count($receiver_owner); $i++){
                         
                        $email->recipient($receiver_owner[$i]);
                        
                        //If there is a file to be attached
                        if(isset($data['attachment'])){
                            $email->header("mixed", $data['attachment'], $folder);
                        }else{
                            $email->header("html");
                        }                        
                        
                        $checkSendEmail = $email->send();
                        
                    }
                }
            }
            
            //Caso precise enviar email para mais alguém
            if(isset($isSpecialReceiver) && $isSpecialReceiver){
                
                $receiver_owner2 = explode(", ", $email_special_receiver);
                if(count($receiver_owner2) > 0){
                    for($i = 0; $i < count($receiver_owner2); $i++){
                        
                        $email->recipient($receiver_owner2[$i]);
                        $email->header("html");
                        $checkSendEmail = $email->send(); 
                        
                        //echo $receiver_owner2[$i] . " - " . $checkSendEmail;
                    }
                }
            }
            
            if($checkSendEmail) ActivityLogger::log(C::EMAIL_TYPE . $data['tipo'], C::SENDED_EMAIL);

            return $checkSendEmail;
            
        }catch(CDbException $e){
            
            Yii::trace("ERROR " . $e->getMessage());
           
            //Infos
            $error = array('message' => 'ERROR: EmailManager', 'trace' => $e->getMessage());
            $send_error = MethodUtils::sendError($error, true);        
       
            echo "ERROR: EmailManager - submitSubscription() " . $e->getMessage();
        } 
    }
    
    /**
     * Método para enviar o e-mail de inscrição
     *
    */
    public function submitReply($data){
        
        Yii::import('application.extensions.utils.HelperUtils');
        Yii::import('application.extensions.utils.EmailUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.digitalbuzz.email.dbEmail');
        
        try{
            $isSpecialReceiver = false;
            $email = new dbEmail();
            $email->setReturnPath($data['sender']);
            $email->setFrom($data['sender'], $data['titulo']);
            $email->header("html");

            $email->recipient($data['email']);

            //Verify if an email title is set
            if(isset($data['titulo_email'])){
                $email->subject($data['titulo_email']);
            }else{
                $email->subject(Yii::t("siteStrings", "email_title_" .$data['tipo']));
            }
            
            $email->loadLayout("mail_common");
            if(!isset($data['render_reply'])) $email->setContent("email/reply/" .$data['layout_reply']);
            if( isset($data['render_reply']) && $data['render_reply']){
                $data['view'] = $data['view_reply'];
                $email->setRenderPartial($data);          
            }
           
            switch($data['tipo']){
                case "contato":
                case "duvida":
                case "publicidade":
                case "parceria":
                case "associar":
                case "recados":
                case "reclamar":
                case "orcamento":
                case "orcamento_web":
                case "orcamentus":
                case "newsletter":
                case "comentario":
                case "seguir":
                    $email->replace("nome", $data['nome']);
                    break;
                
                case "erp_publicidade":
                    $email->replace("dominio", $data['dominio']);
                    $email->replace("titulo", $data['titulo_job']);
                    $email->replace("descricao", $data['descricao']);
                    $email->replace("periodo", $data['quantidade']);
                    $email->replace("valor", $data['valor']); 
                    break;

                case "curriculo":
                    $confirmUrl = "http://" . $data['server']  . "/users/confirmar/" . $data['hash'];
                    $email->replace("confirmUrl", $confirmUrl);
                    $email->replace("nome", $data['nome']);
                    break;
                
                case "vaga":                    
                    $email->replace("titulo", $data['titulo_vaga']);
                    $email->replace("nome", $data['nome']);
                    break;

                case "chamado_fechado":
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_pedido']);
                    $email->replace("titulo", $data['titulo_tarefa']);
                    $email->replace("anotacao", $data['anotacao']);
                    break;
                
                case "chamado_fechado_erp":
                    $email->replace("id", $data['id']);
                    $email->replace("nome", $data['nome']);
                    $email->replace("tipo", $data['tipo_pedido']);
                    $email->replace("cliente", $data['cliente']);
                    $email->replace("titulo", $data['titulo_tarefa']);
                    $email->replace("descricao", $data['descricao_tarefa']);
                    $email->replace("anotacao", $data['anotacao']); 
                    
                    $email_complement = UserUtils::getAllKindUsers('funcionario', false, false);
                    
                    if($email_complement){
                        $email_special_receiver = EmailUtils::organizeEmailToString($email_complement, 'kind');
                        if($email_special_receiver != '') $isSpecialReceiver = true;
                    }                    
                    break;
     
                
                case "reservas":
                    $email->replace("nome", $data['nome']);
                    $email->replace("dia", $data['data']);
                    $email->replace("horario", $data['hour']);
                    break;

                case "eventos":
                case "eventos_externo":
                    $email->replace("nome", $data['nome']);
                    $email->replace("titulo_evento", $data['titulo_evento']);
                    $email->replace("data", $data['data_evento']);
                    $email->replace("horario", $data['hora_evento']);
                    $email->replace("local", $data['local_evento']);
                    break;

                case "cadastro":  
                    $email->replace("nome", $data['nome']);
                    $confirmUrl = "http://" . $data['server']  . "/users/confirmar/" . $data['hash'];
                    $email->replace("confirmUrl", $confirmUrl);
                    break;

                case "cadastro_rapido":              
                    $email->replace("nome", $data['nome']);
                    $email->replace("descricao", $data['descricao']);
                    $email->replace("password", $data['password']);
                    $confirmUrl = "http://" . $data['server']  . "/users/confirmar/" . $data['hash'];
                    $email->replace("confirmUrl", $confirmUrl);
                    break;

                case "produtos": 
                    $email->replace("nome", $data['nome']);
                    $email->replace("status", $data['status']);
                    break;

                case "cadastro_atualizar_com_senha":              
                    $email->replace("nome", $data['nome']);
                    $email->replace("user", $data['email']);
                    $email->replace("password", $data['password']);
                    $loginUrl = "http://" . $data['server']  . "/login/atualizar";
                    $email->replace("url_login", $loginUrl);
                    break;

                case "corrigir_pesquisa_recuperacao":
                    $email->replace("nome", $data['nome']);
                    $email->replace("nota", $data['nota']);
                    $email->replace("curso", $data['curso']);
                    $email->replace("conteudo", $data['mensagem']);
                    $email->replace("url", $data['recuperacao']['url']);                   
                    break;

            }

            $email->replace("do", Yii::t('siteStrings', "do_a_". Yii::app()->params['gender']));

            $email->replace("title", $data['titulo']);
            $email->replace("server",  $data['server']);
            $email->replace("social_network", $data['social_networks']);
            $email->replace("logo",   "http://" . $data['server'] ."/media/user/images/original/" . $data['logo']);        
            $email->replace("header", "http://" . $data['server'] ."/media/images/textures/topo_email/" . $data['layout_template']['textura_topo_email']);
            $email->replace("footer", "http://" . $data['server'] ."/media/images/textures/rodape_email/" . $data['layout_template']['textura_rodape_email']);
            $send = $email->send();
            
            //Caso precise enviar email para mais alguém
            if(isset($isSpecialReceiver) && $isSpecialReceiver){
                
                $receiver_owner2 = explode(", ", $email_special_receiver);
                if(count($receiver_owner2) > 0){
                    for($i = 0; $i < count($receiver_owner2); $i++){
                        
                        $email->recipient($receiver_owner2[$i]);
                        $email->header("html");
                        $checkSendEmail = $email->send(); 
                        
                        //echo $receiver_owner2[$i] . " - " . $checkSendEmail;
                    }
                }
            }
            
            return $send;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        } 
    } 
    
    /**
     * Submit email by SwiftMailer
     *
     * @param number
     *
    */
    public function sendEmailBySwift($data){       

        //send email from owner
        $dados = HelperUtils::getTitleSite();
        $data['server'] = $_SERVER['SERVER_NAME'];
        $data['sender'] = EmailUtils::getEmailSender();

        // Get mailer
        $SM = Yii::app()->swiftMailer;

        try{
            // Render view and get content
            // Notice the last argument being `true` on render()
            $content = $data['view'];

            // Plain text content
            $plainTextContent = " ";

            // Get config
            //$mailHost = Yii::app()->params['mail_host'];//'mail.orcament.us'; 
            //$mailHost = 'purplepier.com.br'; 
            $mailHost = 'mail.purplepier.com.br'; 
            $mailPort = 26; // Optional 465
            $mailuser = "contato@purplepier.com.br";
            $password = "CtPu453Lk";

            // New transport
            $Transport = $SM->smtpTransport($mailHost, $mailPort)->setUsername($mailuser)->setPassword($password);;

            // Mailer
            $Mailer = $SM->mailer($Transport);

            // New message
            $Message = $SM
                ->newMessage($data['titulo_email'])
                ->setFrom(array($data['sender'] => $dados['email_title']))
                ->setTo(array($data['email'] => $data['nome']))
                ->addPart($content, 'text/html')
                ->setBody($plainTextContent);

            $swiftAttachment = Swift_Attachment::fromPath("media/user/{$data['folder']}/{$data['attachment']}");
            $Message->attach($swiftAttachment);
            // Send mail
            $result = $Mailer->send($Message);
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para excluir um registro existente
     *
     * @param number
     *
    */
    public function deleteContent($get_post){

        $sql = "DELETE FROM general_contato WHERE id ='" . $get_post['id_email']. "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /*
     * Prepare the array to be replace into the e-mail html template
     * It separates the array into a table fields ready to be used.
     * 
     * @param array
     * 
     */
    public function getFormatLines($array, $tipo){
        
        $result = "";
        switch($tipo){
            
            case "cobranca":
                if($array){
                    foreach($array as $values){
                        $result .= "<tr style='background:#ccc; border-bottom: 1px solid #333;'>";
                        $result .= "<td align= 'center'>". $values['amount'] ."</td>";
                        $result .= "<td style='padding-left: 10px;'>". $values['nome'] ."</td>";
                        $result .= "<td style='padding-left: 10px;'>". $values['valor_unid_format'] ."</td>";   
                        $result .= "<td style='padding-left: 10px;'>". $values['valor_format'] ."</td>";
                        $result .= "</tr>";            
                    }
                     
                }else{
                        $result .= "<tr style='background:#ccc; border-bottom: 1px solid #333;'>";
                        $result .= "<td>". Yii::t("messageStrings", "message_result_no_items") ."</td>";
                        $result .= "<td align='center'> - </td>";
                        $result .= "<td align='center'>0</td>";
                        $result .= "<td align='center'>0</td>";
                        $result .= "</tr>";
                }
                
                break;
        }
        
        if($array){
        $result .= "<tr style='background:#ccc; border-bottom: 1px solid #333;'>";
        $result .= "<td colspan='3' align='right' style='margin-right: 10px;'><b>Total </b></td>";
        $result .= "<td align='left' style='padding-left: 10px; font-weight: bold;'>". $array[0]['total'] ."</td></tr>";
        }
        
        return $result;
    }
}

?>