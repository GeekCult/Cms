<?php

class CategoriasAction extends CAction{

    private $categoriasHandler;
    private $paginasHandler;
    private $action;
    private $id;

    /**
     *
     * Categorias
     * Specific Admin Controller
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');

        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->categoriasHandler = new CategoriaManager();        
        $this->paginasHandler = new PaginasManager();

        switch($this->action){
            case "novo":
            case   ""  :
                $this->novo();
                break;
            
            case "adicionar":
                $this->adicionar();
                break;
            
            case "listar":
                $this->listar();
                break;

            case "cadastrar":
                $this->cadastrar();
                break;

            case "deletar":
                $this->deletar();
                break;

            case "editar":
                $this->editar();
                break;
            //Ecommerce
            case "cadastrar_categoria_ecommerce":
                $this->cadastrarCategoriaEcommerce();
                break;
            
            case "cadastrar_subcategoria_ecommerce":
                $this->cadastrarSubCategoriaEcommerce();
                break;
            
            case "reload_subcategoria_ecommerce":
                $this->reloadSubCategoriaEcommerce();
                break;
            
            case "reload_subitems_ecommerce":
                $this->reloadSubItemsEcommerce();
                break;
            //Galeria
            case "cadastrar_subcategoria_galeria":
                $this->cadastrarSubCategoriaGaleria();
                break;
            
            case "cadastrar_galeria":
                $this->cadastrarGaleria();
                break;
        }
    }

    /**
     *
     * Listar
     * List the main attributes and it opens the item list.
     *
     */
    public function listar(){

        $result = array();        

        try{
            $result['content'] = $this->categoriasHandler->getAllContent();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips("list", "categorias");
        
        $this->addScript("categorias");
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/categorias/listar", $result);
    }

    /**
     *
     * Novo
     * Add the main attributes
     * It uses a PaginaManager Class to populate the combox with
     * all pages recorded there.
     *
     */
    public function novo(){

        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['pages']   = $this->paginasHandler->getAllContentForCategory();            
            $result['content']['id_page'] = $this->id;            
            $result['content']['nome'] = "";            
            $result['action'] = $this->action;            
            $result['id_album'] = "";

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        } 
        
        $result['dicas'] = DicasUtils::getTips("new", "categoria");

        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/categorias/novo", $result);
    }
    
    /**
     *
     * Adicionar for Fancybox 
     * 
     * Add the main attributes
     * It uses a PaginaManager Class to populate the combox with
     * all pages recorded there.
     *
     */
    public function adicionar(){

        $result = array();

        try{            
            $result['id_page'] = $this->id;
            $result['pages']   = $this->paginasHandler->getAllContentForCategory();            
            $result['content']['id_page'] = $this->id;
            
            $result['content']['nome'] = "";            
            $result['action'] = "novo";            
            $result['id_album'] = "";

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }        

        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/categorias/adicionar", $result);

    }

    /**
     *
     * Cadastrar
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrar(){

        $data = array();
        $data[0] = $_POST['id_page'];
        $data[1] = $_POST['title']; 
        $data[3] = $_POST['action']; 
        $data[4] = $_POST['id_categoria'];
        
        if($data[3] == "novo"){
            $data['message'] = Yii::t("messageStrings", "message_result_category");
        }else{
            $data['message'] = Yii::t("messageStrings", "message_result_category_update");
        }

        try{
            $content = $this->categoriasHandler->submitContent($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Deletar
     * This method deletes the record using a jQuery request
     *
     */
    public function deletar(){

        $data = array();
        $data['id'] = $_POST['id'];
        $data['message'] = Yii::t('messageStrings', 'message_result_category_delete');

        try{
            $content = $this->categoriasHandler->deleteContent($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

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
    public function editar(){        

        $result = array();        

        try{
            $result['pages']   = $this->paginasHandler->getAllContentForCategory(); 
            $result['content'] = $this->categoriasHandler->getContentById($this->id);             
            $result['id_page'] = $this->id;            
            $result['action'] = $this->action;            
            $result['id_album'] = $this->id;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("new", "categoria");

        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/categorias/novo", $result);
    }
    
    /**
     *
     * Cadastrar Ecommerce
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarCategoriaEcommerce(){

        $data = array();
        $data[1] = $_POST['title']; 
        $data[3] = $_POST['action']; 
        $data[4] = $_POST['id_categoria']; 
        if(isset($_POST['tipo'])){$data['tipo'] = $_POST['tipo'];}else{$data['tipo'] = 0;}
      
        $data['message'] = Yii::t("messageStrings", "message_result_category_update");       

        try{
            $content = $this->categoriasHandler->submitContentEcommerce($data);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Cadastrar Sub Categoria Ecommerce
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarSubCategoriaEcommerce(){

        $data = array();
        $data[0] = $_POST['title']; 
        $data[1] = $_POST['action']; 
        $data[2] = $_POST['id_categoria']; 
        if(isset($_POST['tipo'])){$data['tipo'] = $_POST['tipo'];}else{$data['tipo'] = 0;}
      
        $data['message'] = Yii::t("messageStrings", "message_result_subcategory_update");       

        try{
            $content = $this->categoriasHandler->submitSubContentEcommerce($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Recarregar Subcategoria
     * This method reload the ecommerce subcategories selected from a combobox changed 
     * request
     * 
     */
    public function reloadSubCategoriaEcommerce(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');

        $result = array(); 
        $id_categoria = $_POST['id'];
        $id_produto = $_POST['id_produto'];
        if($id_produto == '') $id_produto = 0;
        if(isset($_POST['tipo'])){$tipo = $_POST['tipo'];}else{$tipo = 0;}

        try{ 
            $result['produto'] = ProdutosUtils::getProdutoInformation($id_produto, false, false);            
            $result['subcategoria'] = $this->categoriasHandler->getAllSubContentEcommerceById($id_categoria, $tipo);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }          
        $this->controller->renderPartial("pages/categorias/ecommerce/content/item_combobox_subcategoria", $result);
    }
    
    /**
     *
     * Recarregar SubItem
     * This method reload the ecommerce subitem selected from a combobox changed 
     * request
     * 
     */
    public function reloadSubItemsEcommerce(){
        
        Yii::import('application.extensions.utils.ProdutosUtils');

        $result = array(); 
        $id_subitem = $_POST['id'];
        $id_produto = $_POST['id_produto'];
        if($id_produto == '') $id_produto = 0;

        try{ 
            $result['produto'] = ProdutosUtils::getProdutoInformation($id_produto, false, false);
            $result['subitems'] = $this->categoriasHandler->getSubItemsEcommerce($id_subitem);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }          
        $this->controller->renderPartial("pages/categorias/ecommerce/content/item_combobox_subitems", $result);
    }
    
    /**
     *
     * Cadastrar Sub Categoria Ecommerce
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarSubCategoriaGaleria(){

        $data = array();
        $data[0] = $_POST['title']; 
        $data[1] = $_POST['action']; 
        $data[2] = $_POST['id_categoria'];
        $data['status'] = 1;
      
        $data['message'] = Yii::t("messageStrings", "message_result_subcategory_update");       

        try{
            $content = $this->categoriasHandler->submitSubContentGaleria($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Cadastrar Sub Categoria Galeria
     * This method does the submit form using a jQuery request
     *
     */
    public function cadastrarGaleria(){

        $data = array();
        $data['title'] = $_POST['title']; 
        $data['action'] = $_POST['action']; 
        $data['id_page'] = $_POST['id_page'];
        $data['id_subcategoria'] = $_POST['id_subcategoria'];
      
        $data['message'] = Yii::t("messageStrings", "message_result_gallery_created");       

        try{
            $content = $this->categoriasHandler->submitContentGaleria($data);
            
            //Clear previouly data into session
            $clearCache = MethodUtils::clearAllCache(); 

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($file){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();        
        //Funcionalidades de components html
        $cs->registerScriptFile($baseUrl . '/js/admin/' . $file. ".js", CClientScript::POS_END);
    }

}
?>