<?php

class ComentariosAction extends CAction{
    
    private $commentsHandler;
    private $action = null;
    private $id = null;
    private $LIST = "list";
    private $NEW = "new";
    private $EDIT = "edit";
    private $TYPE = "pages";

    /**
     * Comentários
     * Specific Controller
     * 
     * All kind of comments might be used here, both site and admin
     * there is a class ComentariosManager to help with it.
     *
     */
    public function run(){          
        
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');        
        $this->commentsHandler = new ComentariosManager(); 

        switch($this->action){
            
            //Site
            case "cadastrar":                
                $this->cadastrar();
                break;

            case "cadastrar_reply":                
                $this->cadastrarReply();
                break;
            
            case "carregar_comentarios":                
                $this->carregarComentarios();
                break;
            
            case "review":                
                $this->review();
                break;
            //Used to products, orders, business, banners and etc
            case "likes":  
            case "user_pj":
            case "user_pf":
            case "produtos":
            case "banners":
            case "videos":
            case "wiki":
            case "forum":
            case "materias":
            case "eventos":
            case "purplestore":
            case "rede_social":
            case "videos":
                $this->likes();
                break;
            
            //Used to products, orders, business, banners and etc
            case "likes_review":  
                $this->likesReview();
                break;
            
            //Admin
            case "listar":                
                $this->listar();
                break;
            
            //Admin
            case "editar":  
                $this->editar();
                break;
            
            case "comentarios_eventos": 
            case "comentarios_materias": 
            case "comentarios_produtos": 
            case "comentarios_ecommerce": 
            case "comentarios_elearn":
                $this->editar(false, $this->action);
                break;
            
            case "novo_depoimento":                
                $this->editar(true, 'depoimentos');
                break;
            
            case "editar_depoimentos":                
                $this->editar(false, 'depoimentos');
                break;
            
            case "listar_depoimentos":                
                $this->listar('depoimentos');
                break;
            
            //Admin
            case "atualizar":                
                $this->atualizar();
                break;

            case "aprovar":                
                $this->aprovar();
                break;
            
            case "reprovar":                
                $this->reprovar();
                break;
            
            case "remover":                
                $this->remover();
                break;
            
            case "recarregar_tipo":                
                $this->recarregarTipo();
                break;
        }
    }

    
    /**
     *
     * Cadastrar
     * 
     * This method does the submit form
     *
     */
    public function cadastrar(){
        
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.special.ApiUtils');

        $data = array();
        
        //Get name
        (isset($_POST['nome'])) ? $nome = $_POST['nome'] : $nome = '';
        (isset($_POST['title'])) ? $title = $_POST['title'] : $title = '';
        
        $data['id_general'] = $_POST['id_general'];
        $data['nome'] = StringUtils::StringToLowerCase($nome, "name");        
        $data['title'] = $title;
        $data['email'] = $_POST['email'];        
        $data['comentario'] = addslashes(strip_tags($_POST['comentario']));
        $data['data'] = date('Y-m-d H:i:s');
        $data['tipo_comentario'] = $_POST['tipo'];
        if(isset($_POST['exibe'])){$data['exibe'] = $_POST['exibe'];}else{$data['exibe'] = 0;}
        if($data['tipo_comentario'] == 'forum') $data['exibe'] = 1;
        if($data['tipo_comentario'] == 'produto') ProdutosUtils::updateComentariosProduto($data['id_general']);
        if(isset($_POST['file'])){$data['file'] = $_POST['file'];}else{$data['file'] = '';}
        
        //Get comment for info
        $data['info'] = ApiUtils::getContentFromType($data['tipo_comentario'], $data['id_general']);
        
        //Id User
        (isset($_POST['id_user'])) ? $data['id_user'] = $_POST['id_user'] : $data['id_user'] = 0;
        (isset($_POST['resposta'])) ? $data['resposta'] = $_POST['resposta'] : $data['resposta'] = '';
        
        //Main data
        $data['tipo'] = "comentario";
        $data['layout'] = "comentario_common";
        $data['newsletter'] = true;

        try{  
            ActivityLogger::log($data['id_user'], C::COMMENT_ . $data['tipo_comentario']);
            $content = $this->commentsHandler->submitComment($data);
            
            //Sends a alert e-mail
            $sendMessage = MethodUtils::sendOrder($data);
            
            echo json_encode(array('result' => $content, 'MESSAGE' => 'Comentário enviado com sucesso'));

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ComentariosAction - submitComment() " . $e->getMessage();
        }
    }
    
    /**
     *
     * Cadastrar Reply
     * 
     * This method does the submit form for replies
     * It's different from comment because it has some 
     * new attributes.
     *
     */
    public function cadastrarReply(){

        $data = array();
        $session = MethodUtils::getSessionData();

        $data['id_general'] = $_POST['id_general'];
        $data['nome'] = $_POST['nome'];                
        $data['email'] = $_POST['email'];        
        $data['comentario'] = $_POST['comentario'];
        $data['date_comment'] = date('Y-m-d H:i:s');
        $data['tipo'] = $_POST['tipo'];
        $data['tipo_comentario'] = $_POST['tipo'];
        $data['id_comment'] = $_POST['id_comment'];
        $data['reply_to'] = $_POST['reply_to'];
        if(isset($_POST['exibe'])){$data['exibe'] = $_POST['exibe'];}else{$data['exibe'] = 0;}
        if($data['tipo'] == 'forum_reply') $data['exibe'] = 1;
        
        (isset($_POST['id_user']) && $_POST['id_user'] != '') ? $data['id_user'] = $_POST['id_user'] : $data['id_user'] = 0;
        if($data['id_user'] == 0 && $_POST['tipo'] == 'rede_social_reply') $data['id_user'] = $session['id'];

        try{ 
            ActivityLogger::log($data['id_user'], C::COMMENT_ . $data['tipo']);
            $content = $this->commentsHandler->submitReply($data);
            //$content = true;
            $result = array('STATUS' => $content, 'message' => 'Feito');
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Review
     * 
     * This method handles all event related the review
     * It can be a like, unlike and reply button
     *
     */
    public function review(){

        $data = array();
        $data['id'] = $_POST['id'];
        $data['tipo'] = $_POST['tipo'];

        try{            
            $content = $this->commentsHandler->submitReview($data);            
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Likes
     * 
     * This method handles all event related the likes
     * It can be a like, unlike 
     *
     */
    public function likes(){
        
        $data = array();
        $data['id'] = $_POST['id'];
        $data['tipo'] = $_POST['tipo'];
        $data['local'] = $_POST['local'];
        
        //Se precisar adicoinar no DB2
        if(isset($_POST['DB2'])) $data['DB2'] = true;
        
        try{    
            //$set = MethodUtils::sendEventAnalytics(array('categoria' => 'submit_like', 'action' => 'enviado', 'label' => 'gostou'));
            
            $content = $this->commentsHandler->submitLikes($data);
            $notify = $this->commentsHandler->notify($data);
        
            ActivityLogger::log(C::STR_ACCESS_PAGE . C::LIKE, 'cadastrar_like');
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR - ComentariosAction - likes()', 'trace' => $e->getMessage()), true);
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Likes
     * 
     * This method handles all event related the likes
     * It can be a like, unlike 
     *
     */
    public function likesReview(){

        $data = array();
        $data['id'] = $_POST['id'];
        $data['tipo'] = $_POST['tipo'];
        $data['local'] = $_POST['local'];

        try{            
            $content = $this->commentsHandler->submitLikesReview($data);
            $notify = $this->commentsHandler->notify($data);
            
            ActivityLogger::log(C::INTERACTION . C::LIKE, 'like_' . $data['tipo'] . "_" . $data['local']);
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    /**
     *
     * Carregar comentários
     * 
     * This method does loadComments froma general_content
     * It's using a jQuery request to load the content dynamic
     *
     */
    public function carregarComentarios(){
        
        $component = "comment_simple";

        $data = array();
        $data['id'] = $_POST['id'];
        $data['tipo'] = $_POST['tipo'];

        try{
            $result['content'] = $this->commentsHandler->getCommentsByIdGeneral($data, $data['tipo']);
        
            if(count($result['content']) > 0){ 
                $this->controller->renderPartial("/site/components/comentarios/" . $component, $result);   

            }else{
                if($data['tipo'] == 'usuario')echo '<div class="cntCom">' . Yii::t("messageStrings", "message_result_no_comments_user") . '</div>';
                if($data['tipo'] == 'materias')echo '<div class="cntCom">' . Yii::t("messageStrings", "message_result_no_comments_articles") . '</div>';
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Listar
     * 
     * This method list the comments from de database
     *
     */
    public function listar($tipo = 'comentarios'){  
        
        Yii::import('application.extensions.utils.CommentsUtils');

        $result = array();
        
        $data['id'] = 0;     
        $data['categoria'] = CommentsUtils::getStatus($this->id);       
        $data['tipo'] = 'materias';
        
        try{
            $result['content'] = $this->commentsHandler->getAllAdminComments($data, $tipo);
            $result['tipo'] = $tipo;
            $result['status'] = $this->id;
            
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);
        
            $this->addScript("admin", "all");

            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/comentarios/listar", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Editar
     * This method edits the record using a jQuery request
     *
     */
    public function editar($isNew = false, $tipo = false){

        $result = array();

        try{
            $controllerIDHandler = new PaginasManager();
            $categoriaHandler = new CategoriaManager();
          
            if(!$isNew) $result['content'] = $this->commentsHandler->getCommentById($this->id);
            if( $isNew) $result['content'] = $this->commentsHandler->getCommentClear();
            
            $controller = $controllerIDHandler->getContentController("comentarios");
            $result['categorias'] = $categoriaHandler->getAllContentById($controller);
            $result['id_controller'] = $controller;
            $result['link'] = $this->commentsHandler->getLinkBack($tipo);
            
            //Tipo
            $result['is_new'] = $isNew;
            
            $result['session']  = MethodUtils::getSessionData();
            $result['sidemenu'] = HelperUtils::adminUtils('comentarios_especial', array('extra' => $tipo));            
            $result['dicas'] = DicasUtils::getTips(C::GENERAL, C::COMMENTS);
        
            $this->addScript("admin", "all");
            $this->controller->layout = "admin/admin2";
            $this->controller->render("/admin/pages/comentarios/novo", $result);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Atualizar
     * 
     * This method updates the comment selected
     *
     */
    public function atualizar(){ 
        
        $data['id'] = $_POST['id'];
        $data['nome'] = $_POST['nome'];    
        $data['titulo'] = $_POST['titulo'];
        $data['comentario'] = $_POST['comentario'];
        $data['resposta'] = $_POST['resposta']; 

        try{
            $result['content'] = $this->commentsHandler->updateComment($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
    }
    
    /**
     *
     * Aprovar
     * 
     * This method approves the comment selected
     *
     */
    public function aprovar(){        

        $result = array();
        
        $data['id'] = $_POST['id'];    
        $data['status'] = 1;
        $data['message'] = Yii::t("messageStrings", "message_result_comment_approve" );

        try{
            $result['content'] = $this->commentsHandler->approveContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
    }
    
    /**
     *
     * Reprovar
     * 
     * This method approves the comment selected
     *
     */
    public function reprovar(){        

        $result = array();
        
        $data['id'] = $_POST['id'];    
        $data['status'] = 2;
        $data['message'] = Yii::t("messageStrings", "message_result_comment_reprove" );

        try{
            $result['content'] = $this->commentsHandler->approveContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
    }
    
    /**
     *
     * Recarregar tipo
     * 
     * This method reloads a new category 
     * It can be a article, products, cools and etx
     *
     */
    public function recarregarTipo(){        

        $result = array();
        
        $tipo = $_POST['tipo'];    
        $status = $_POST['status']; 
        
        try{
            $result['content'] = $this->commentsHandler->reloadCommentsCategory($tipo, $status);
            $result['status'] = $status;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }        
        $this->controller->renderPartial("/admin/pages/comentarios/content/items", $result);
    }
    
    /**
     *
     * Deletar
     * This method deletes the selected record using a jQuery request
     *
     */
    public function remover(){

        $data = array();

        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t("messageStrings", "message_result_comment_delete" );

        try{
            $content = $this->commentsHandler->deleteContent($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS layout into the component
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($action, $component){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
                
        //Funcionalidades da view       
        switch($action){            
            case "admin":
                $cs->registerScriptFile($baseUrl . '/js/admin/comentarios.js', CClientScript::POS_END);
                $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_END);
                $this->controller->all = MethodUtils::getAllAdminInformation();
                break;
        } 
    }
}
?>