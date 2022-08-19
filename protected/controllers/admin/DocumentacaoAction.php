<?php

class DocumentacaoAction extends CAction {

    private $documentarHandler;
    private $action;
    private $sub_action;
    private $id;
    private $LIST = "list";
    private $NEW = "new";
    private $EDIT = "edit";
    private $TYPE = "pages";

    /**
     *
     * Documentação
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->sub_action = Yii::app()->getRequest()->getQuery('subaction');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.DocumentarManager');
        Yii::import('application.extensions.utils.DicasUtils');
        
        $this->documentarHandler = new DocumentarManager();

        switch($this->action){
            case "licensas":
                $this->licensas();
                break;

            case "apontamento":
                switch($this->sub_action) {
                    case "novo":
                    case "editar":
                        $this->novoApontamento();
                        break;
                    case "listar":
                        $this->listarApontamento();
                        break;
                    case "cadastrar":
                        $this->cadastrarApontamento();
                        break;
                }
                break;

            case "releases":                
                switch($this->sub_action){                
                    case "novo":                        
                        $this->novaRelease();
                        break;
                    
                    case "listar":                        
                        $this->listarReleases();
                        break;
                    
                    case "cadastrar":                        
                        $this->cadastrarRelease();
                        break;                
                }                
                break;
            
            case "concorda":                
                switch($this->sub_action){                
                    case "salvar":                        
                        $this->salvarConcorda();
                        break;
                                 
                }                
                break;

            case "bugs": 
            case "bug":
            case "feature":
            case "improvement":    
                switch($this->sub_action){                
                    case "novo":                        
                        $this->novoBug();
                        break;
                    
                    case "deletar":                        
                        $this->deletarBug();
                        break;
                    
                    case "adicionar":                        
                        $this->adicionarBugTracker();
                        break;
                    
                    case "listar":                        
                        $this->listarBug();
                        break;
                    
                    case "cadastrar":                        
                        $this->cadastrarBug();
                        break;  
                    
                    case "resolver":                        
                        $this->resolverBug();
                        break;
                    
                    case "executar":                        
                        $this->executarBug();
                        break;
                    
                    case "status":                        
                        $this->status();
                        break;
                }                
                break;
            
            case "logs":
                
                switch($this->sub_action){                    
                    case "listar":                        
                        $this->listarLogs();
                        break;
                                   
                }
                break;
        }
    }

    /**
     *
     * Licensas
     * List the main attributes and it opens the item list.
     *
     */
    public function licensas(){
        
        Yii::import('application.extensions.utils.DocumentarUtils');
         
        try{
            $result['content'] = DocumentarUtils::getLicensas();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);

        $this->addScripts("bugs");
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/licensas/licensas", $result);
    }

    /**
     *
     * Releases
     * This method opens the release report
     *
     */
    public function releases($message_result_setting) {

        //path do arquivo para leitura
        $arquivo = 'path/arquivo.txt';
        
        //abrimos o arquivo em leitura
        $fp = fopen($arquivo,'r');

        //lemos o arquivo
        $texto = fread($fp, filesize($arquivo));

        //transformamos as quebras de linha em etiquetas <br>
        $texto = nl2br($texto);

        echo $texto;

    }

    /**
     *
     * Novo Bug
     * It lists the main attributes and also it opens the item list.
     *
     */
    public function novoBug(){

        try{
            $result['content'] = $this->documentarHandler->getContentById('0');            
            $result['tipo'] = "bug";

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica: Códico de afilicação";
        $result['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
        $result['link_dica']  = "/site/associese/";

        $this->addScripts("bugs");
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/bugs/novo", $result);
    }
    
    /**
     *
     * Listar Bug
     * It lists the main attributes and also it opens the item list.
     *
     */
    public function listarBug(){
        
        Yii::import('application.extensions.utils.DocumentarUtils');
        
        $session = MethodUtils::getSessionData();

        try{
            if($session['bug_status'] == "") $session['bug_status'] = 0;
            if($this->action == "bugs") $this->action = "bug";
            $result['content'] = $this->documentarHandler->getAllContentBugs($this->action, $session['bug_status']);
            $result['status'] = $session['bug_status'];
            $result['action'] = $this->action;
            
            $result['total'] = DocumentarUtils::getSUM('tipo', $this->action, 'status', $session['bug_status']);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica 21";
        $result['text_dica'] = "Dica 21";
        $result['link_dica'] = "Dica 21";

        $this->addScripts("bugs");
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/bugs/listar", $result);
    }
    
    /**
     *
     * Deletar
     * This method deletes the selected record using a jQuery request
     *
     */
    public function deletarBug(){

        $get_post = array();

        $get_post['id'] = $_POST['id'];
        $get_post['message'] = Yii::t("messageStrings", "message_result_bug_delete");

        try{
            $content = $this->documentarHandler->deleteContent($get_post);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Bug Cadastrar
     * This method does the bug submit form using a jQuery request
     *
     */
    public function cadastrarBug(){
        
        $session = new CHttpSession;
        $session->open();

        $get_post = array();

        $get_post[0] = $_POST['titulo'];
        $get_post[1] = addslashes($_POST['descricao']);
        $get_post[2] = $_POST['tipo'];
        $get_post[3] = date('Y-m-d H:i:s');        
        $get_post['prioridade'] = $_POST['prioridade'];        
        $get_post['user'] = $session['field1'] . " " . $session['field2'];
        $get_post['message'] = Yii::t('messageStrings', 'message_result_documentar_bug');

        try{
            $content = $this->documentarHandler->submitBugContent($get_post);
            
            //Send an email when a new bug is submited
            $data['layout'] = "content_general";
            $data['newsletter'] = false;
            $data['tipo'] = "bug";
            $data['nome'] = $get_post['user'];
            $data['email'] = "publicidade.exe@gmail.com";
            $data['titulo_email'] = "Bug adicionado";
            $data['titulo_mensagem'] = $get_post[0];
            $data['mensagem'] = $get_post[1];
            $sendMessage = MethodUtils::sendOrder($data);
                
            //Set Recent Activity
            $activity = array("title" => Yii::t("activityStrings", "bug_added"),"nome" => $get_post[0], "message" => $get_post[1], "tipo" => "bug", "id_general" => Yii::app()->db->getLastInsertID(), "date" => $get_post[3], "last_update" => $get_post[3], "id_user" => "");
            $setActivity = MethodUtils::setActivityRecent($activity);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Shows the solve view Bug
     * This method open a special view to solve the related bug
     *
     */
    public function resolverBug(){

        try{
            $result['content'] = $this->documentarHandler->getContentById($this->id);            
            $result['tipo'] = "bug";
        
            $result['title_dica'] = "Dica: Códico de afilicação";
            $result['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
            $result['link_dica']  = "/site/associese/";

            $this->addScripts("bugs");
            $this->controller->layout = "admin/admin";
            $this->controller->render("/admin/pages/documentacao/bugs/resolver", $result);
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR - DocumentacaoAction - resolverBug(): " . $e->getMessage();
        }
    }
    
    /**
     *
     * Executar
     * This method does the submit form using a jQuery request 
     * to solve or not an order
     *
     */
    public function executarBug(){

        $get_post = array();
        
        $get_post['nome'] = $_POST['nome'];
        $get_post['titulo'] = $_POST['title'];
        $get_post['id'] = $_POST['id'];
        $get_post['descricao'] = $_POST['descricao'];
        $get_post['anotacao'] = $_POST['anotacao'];
        $get_post['status'] = $_POST['status'];
        $get_post['prioridade'] = $_POST['prioridade'];
        $get_post['id_worker'] = $_POST['id_worker'];
        $get_post['data'] = date('Y-m-d H:i:s');

        try{            
            $content = $this->documentarHandler->updateStatus($get_post);

        }catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Status Bug
     * It changes the bug, improvement and feature status
     *
     */
    public function status(){
        
        MethodUtils::setSessionData("bug_status", $_POST['status']);
        echo "Done";
        
    }
    
    /**
     *
     * Nova Release
     * 
     * It submits a new record into releases.
     *
     */
    public function novaRelease(){

        try{
            $result['content'] = $this->documentarHandler->getContentById('0');            
            $result['tipo'] = "release";

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica: Códico de afilicação";
        $result['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
        $result['link_dica']  = "/site/associese/";

        $this->addScripts("releases");
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/releases/novo", $result);
    }
    
    /**
     *
     * Listar Releases
     * 
     * It lists the main releases and also it opens the item list.
     *
     */
    public function listarReleases() {

        try {
            $result['content'] = $this->documentarHandler->getAllContent("release");

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica 21";
        $result['text_dica'] = "Dica 21";
        $result['link_dica'] = "Dica 21";

        $this->addScripts("releases");
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/releases/listar", $result);
    }
    
    /**
     *
     * Releases Cadastrar
     * 
     * This method does the release submit form using a jQuery request
     *
     */
    public function cadastrarRelease() {

        $get_post = array();

        $get_post[0] = $_POST['titulo'];
        $get_post[1] = $_POST['descricao'];
        $get_post[2] = $_POST['tipo'];
        $get_post[3] = date('Y-m-d H:i:s');
        $get_post['message'] =  Yii::t('messageStrings', 'message_result_documentar_release');

        try {
            
            $content = $this->documentarHandler->submitReleasesContent($get_post);


        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar Concorda
     * 
     * Agreement
     *
     */
    public function salvarConcorda() {
        
        $session = MethodUtils::getSessionData();

        try{            
            $content = $this->documentarHandler->saveAgreement($session['id'], 1);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Logs
     * List all logs records.
     *
     */
    public function listarLogs() {
        
        Yii::import('application.extensions.dbuzz.admin.LogsManager');
        $logsHandler = new LogsManager();

        try {
            $result['content'] = $logsHandler->getAllLogs();

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica: Códico de afilicação";
        $result['text_dica'] = "O Códico de afilicação é fornecido por um parceiro e garante grandes descontos.";
        $result['link_dica']  = "/site/associese/";

        $this->addScripts('logs');
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/logs/listar", $result);
    }
    
    /**
     *
     * Bug Tracker
     * Helps launching the bug tracker
     *
     */
    public function adicionarBugTracker(){
        $this->controller->layout = "admin/admin_base";
        $this->controller->render("/admin/pages/documentacao/bugs/adicionar");
    }

    /**
     *
     * Novo Apontamento
     * Renders the new apontamento page.
     *
     */

    public function novoApontamento() {

        $result = array();

        try {

            $result['content'] = $this->documentarHandler->getApontamentoById(0);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }

        $result['tipo'] = 'apontamento';
        $result['title_dica'] = "Dica: Códico de afilicação";
        $result['text_dica'] = "O Códico de afilicação é fornecido por um parceiro CompraComum e garante grandes descontos.";
        $result['link_dica']  = "/site/associese/";

        $this->addScripts('apontamento');
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/apontamento/novo", $result);
    }

    /**
     *
     * Cadastrar Apontamento
     * Receives the post data and sends it to the handler for a new apontamento in the database.
     *
     */

    public function cadastrarApontamento() {

        $get_post[0] = $_POST['titulo'];
        $get_post[1] = $_POST['data'];
        $get_post[2] = $_POST['tempo'];
        $get_post[3] = $_POST['worker'];
        $get_post[4] = $_POST['descricao'];

        //Return message if the action succeeds.
        $get_post['message'] = Yii::t('messageStrings', 'message_result_documentar_apontamento');

        try {

            $content = $this->documentarHandler->submitApontamento($get_post);
            
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Listar Apontamentos
     * It lists the main attributes and also it opens the hours list.
     *
     */

    public function listarApontamento() {
        
        $session = MethodUtils::getSessionData();
        
        //Sets month and year default
        if(!isset($session['month_apontamento'])) $session['month_apontamento'] = date('m');
        if(!isset($session['year_apontamento'])) $session['year_apontamento'] = date('Y');

        try {
            if($this->action == 'apontamento') $this->action = 'apontamento';
            $result['content'] = $this->documentarHandler->getAllApontamentos($session['month_apontamento'], $session['year_apontamento']);
            $result['action'] = $this->action;
            
            $result['month'] = $session['month_apontamento'];
            $result['year'] = $session['year_apontamento'];

            // print_r($result);

        } catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['title_dica'] = "Dica 21";
        $result['text_dica'] =  "Dica 21";
        $result['link_dica'] =  "Dica 21";

        $this->addScripts('apontamento');
        $this->controller->layout = "admin/admin";
        $this->controller->render("/admin/pages/documentacao/apontamento/listar", $result);
    }

    /**
     * Adds script
     *
     */
    public function addScripts($tipo){
        
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerScriptFile($baseUrl . '/js/admin/documentar/' . $tipo . '.js', CClientScript::POS_END);
    }


}
?>