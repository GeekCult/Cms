<?php

/**
 * Autor: CarlosGarcia
 * Date: 13/12/2010
 *
 * Banner Class
 * Specific Class - Admin Controller
 *
 */
class BannersAction extends CAction {

    private $bannerHandle;
    private $galleryHandler;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run(){
        //Action editar, listar.. // size swf 100,350.. //id banner
        $action = "";  $size = ""; $idpag = ""; $id = ""; $start = 0;//Valor inicial da paginação

        $size = Yii::app()->getRequest()->getQuery('size');
        $action = Yii::app()->getRequest()->getQuery('action');
        $id = Yii::app()->getRequest()->getQuery('id');
        $start = Yii::app()->getRequest()->getQuery('id');
        $idpag = Yii::app()->getRequest()->getQuery('id_page');

        Yii::import('application.extensions.dbuzz.admin.BannersManager');
        Yii::import('application.extensions.dbuzz.admin.GaleriaManager');
        Yii::import('application.extensions.utils.BannersUtils');

        $this->bannerHandle = new BannersManager();
        $this->galleryHandler = new GaleriaManager();
        
        $this->controller->all = MethodUtils::getAllAdminInformation();

        switch($action){

            case "novo":
            case   ""  :
                $this->novo($size);
                break;

            case "editar":
                $this->editar($size, $id);
                break;

            case "modificar":
                $this->modificar($id);
                break;

            case "listar":
                $this->listar($size);
                break;

            case "exibir":
                $this->exibir($id);
                break;

            case "mostrar":
                $this->mostrar();
                break;
            
            case "adicionarcool":
                $this->adicionarcool();
                break;

            case "salvar":
                $this->salvar($id);
                break;

            case "deletar":
                $this->deletar($size);
                break;

            case "recarregar_fancy":
                $this->recarregar_fancy(0);
                break;

            case "paginar":
                //$this->paginar($start, $idpag);
                break;

            case "paginar_fancy":
                $this->paginar_fancy($start, $size);
                break;
        }
    }

    /**
     *
     * Listar
     * List the main attributes and it opens the item list.
     *
     * Sizes: base.swf - 250x100 / base2.swf - 770x150 / base3.swf - 770x350
     *
     * @param $size number
     *
     */
    public function listar($size) {

        $result = array();

        switch ($size){

            case "image":
                $this->getController()->forward('/admin/galeria/listar');
                break;

            case "cool_image":
                $this->getController()->forward('/admin/galeria/cool');
                break;

            default :
                //Utiliza classe estática para facilitar
                $banner_propertie = BannersUtils::getBannerProperties($size);
                //Local, caminho do banner
                $result['local'] = $banner_propertie["local"];
                //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
                $result['base'] =  $banner_propertie["base"];
                break;
        }  

        try{            
            $content = $this->bannerHandle->getAllContent($result['local']);
            $result['content'] = $content;
            
            $this->controller->all = MethodUtils::getAllAdminInformation();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/banners/listar", $result);
    }

    /**
     *
     * Novo
     * List the main attributes and it opens the item list.
     * PS: action: It's used to save or create a new one
     *
     */
    public function novo($size) {

        $result = array();

        //Usado no metodo salvar se for diferente de editar então criar novo
        $result['action'] = "criar";

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($size);

        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];

        //Se for utilizar algum template
        $result['id_banner'] = $banner_propertie["template"];

        $result['title_dica'] = "Banners atraentes!";
        $result['text_dica'] = "Para deixar seus banners atraentes experimente utilizar cores tom sobre tom";
        $result['link_dica'] = Yii::t("adminDicas", "link_2");

        try{

            $content = $this->bannerHandle->getTemplate($result['id_banner']);
            $result['content'] = $content;
            
            $this->controller->all = MethodUtils::getAllAdminInformation();


        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }

        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/banners/novo", $result);
    }

    /**
     *
     * Editar
     * Edits the swf selected, it retreive and opens the swf from the
     * banner table.
     *
     * Pay attention it's working with the image gallery edit too;
     * It's is sepatared with the action contruir.
     *
     * @param $id number
     *
     */
    public function editar($size, $id_banner) {

        $result = array();

        $result['id_banner'] = $id_banner;

        $result['action'] = "editar";

        $result['title_dica'] = "Banners atraentes!";
        $result['text_dica'] = "Para deixar seus banners atraentes experimente utilizar cores tom sobre tom";
        $result['link_dica'] = "#";

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($size);
        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];
        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];
        //Pega a banner id para edita-lo
        $result['id_banner'] = $id_banner;
        //Se for image quer dizer que é para crir uma imageCool
        if($size == "image") $result['action'] = "construir";
        
        $this->controller->all = MethodUtils::getAllAdminInformation();

        if($result['action'] != "construir"){

            $result['content'] = $this->bannerHandle->getContent($result['id_banner']);
            $result['local'] = "cool_image";

        }else{

            $result['content'] = $this->galleryHandler->getPicture($result['id_banner']);
            
        }

        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/banners/novo", $result);
    }

    /**
     *
     * Exibir
     * Exibe os banners ou outra cool stuff no fancybox
     *
     *
     * @param $id number
     *
     */
    public function exibir($id) {

        $result = array();

        //Utilize a sessão que mais lhe agradar
        $size = "blocks";

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($size);

        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['resize'] =  $banner_propertie["resize"];

        try{
            $result['content'] = $this->bannerHandle->getPaginationContent($result['local'], $result['resize']);

     
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }

        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/banners/exibir", $result);
    }

    /**
     *
     * RecarregarFancy
     *
     * Ideal para funcionar em um fancybox
     *
     * This method lists all records with a specific type
     *
     * @param number id
     *
     */
    public function recarregar_fancy($id) {

        $result = array();

        $result['local'] = $_POST['tipo'];

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($result['local']);

        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];
        
        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['resize'] =  $banner_propertie["resize"];

        try{
            $result['content'] = $this->bannerHandle->getContentByCat($result['local'], $result['resize']);
            $result['init'] = false;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }

        $this->controller->renderPartial("pages/banners/content/item_simples", $result);
    }

    /**
     *
     * Paginar
     * This method does the reloading items.
     * It loads a new sequency of images from the database
     *
     *
     * @param start number
     * @param idpag  number
     *
     */
    public function paginar($start, $idpag) {

        $result = array();

        try {

            //$content = $this->bannerHandle->getPaginationContent($start, $idpag);

            //$result['content'] = $content;

            $result['id_page'] = $idpag;

            $result['init'] = true;


        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());

            echo "ERROR " . $e->getMessage();
        }

        $this->controller->renderPartial("pages/banners/content/item_simples", $result);
    }

    /**
     *
     * Paginar_fancy
     * This method does the link reload items.
     * It load a new sequency of images from the database
     *
     *
     * @param start number
     * @param size  number
     *
     */
    public function paginar_fancy($start, $size){

        $result = array();
        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($size);
        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];
        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];
        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['resize'] =  $banner_propertie["resize"];

        try{
            $result['content'] = $this->bannerHandle->getNextPaginationContent($start, $size, $result['resize']);
            $result['init'] = true;

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
           echo "ERROR " . $e->getMessage();
        }

        $this->controller->layout = "admin/admin_base";
        $this->controller->renderPartial("pages/banners/content/item_simples", $result);
    }

    /**
     *
     * Salvar
     * This method uses a jQuery request to save all the attributes from
     * the banner edited.
     * The values are set into Flash background.
     * Each property bellow as altura, cor or cool are complete string separate by &.
     *
     * Ex: &x1=2&y1-1&c1=#ff9900&p1=77
     *
     * TODO; Put it and the Topos stament absolute equal this in the same class
     *
     */
    public function salvar($id){

        $id      = $_POST["id"];
        $altura  = $_POST["altura"];
        $largura = $_POST["largura"];
        $cor     = $_POST["colors"];
        $cool    = $_POST["cool"];
        $modelo  = $_POST["modelo"];
        $tipo    = $_POST["tipo"];
        $action  = $_POST["action"];

        if($action != "editar" ){
            $sql = "INSERT INTO banners_data (tipo, altura, largura, cor, cool, modelo) VALUES ('$tipo', '$altura','$largura', '$cor',  '$cool', '$modelo')";

        }else{
            $sql = "UPDATE banners_data SET altura = '$altura', largura = '$largura', cor = '$cor', cool = '$cool',  modelo = '$modelo' WHERE id ='$id'";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando -> execute();
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            echo $message;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     *
     * Deletar
     * This method removes the record using a jQuery request
     *
     */
    public function deletar($tipo){
  
        $get_post = array();

        switch($tipo){
            case "topos":
                $get_post['message'] = Yii::t('messageStrings', 'message_result_header_delete');
                break;

            case "rodapes":
                $get_post['message'] = Yii::t('messageStrings', 'message_result_footer_delete');
                break;
           
            default:      
                $get_post['message'] = Yii::t('messageStrings', 'message_result_banner_delete');
                break;
        }

        $get_post['id'] = $_POST['id'];

        try{
            $content = $this->bannerHandle->deleteContent($get_post);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     *
     * Mostrar
     *
     * It' used on page admin view to set the SWF size banner, its main
     * function is adjusts the banner size to fit in the banner slot
     * container and container_ ...x
     *
     * Works with the paginas.js in a jQuery requesting.
     *
     *
     */
    public function mostrar(){

        $result = array();

        $id_banner = $_POST['id_banner'];

        $result['content'] = $this->bannerHandle->getBannerSwf($id_banner);

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties($result['content']['tipo']);

        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['resize'] =  $banner_propertie["resize"];

        //$result['id_banner'] = $id_banner;

        $this->controller->renderPartial("pages/galeria/content/item_swf", $result);

    }
    
    /**
     *
     * Adicionar cool
     * 
     * Almost the same the upper stamentent
     * TODO: Puts the both together, try uses the POST local to do it! 
     *
     * It' used on page admin view to set the SWF size banner, its main
     * function is adjusts the banner size to fit in the banner slot
     * container and container_ ...x
     *
     * Works with the paginas.js in a jQuery requesting.
     *
     *
     */
    public function adicionarCool() {

        $result = array();

        $id_banner = $_POST['id_banner'];

        $result['content'] = $this->bannerHandle->getNoResizeBannerSwf($id_banner);

        //Utiliza classe estática para facilitar
        $banner_propertie = BannersUtils::getBannerProperties("container_banner");

        //Local, caminho do banner
        $result['local'] = $banner_propertie["local"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['base'] =  $banner_propertie["base"];

        //Base, tamanho do swf que será usado, quando mais certo melhor o efieto final
        $result['resize'] =  $banner_propertie["resize"];

        //$result['id_banner'] = $id_banner;

        $this->controller->renderPartial("pages/galeria/content/item_swf", $result);

    }

}

?>
