<?php

/**
 * Autor: CarlosGarcia
 * Date: 17/12/2010
 *
 * Fontes Class
 * Specific Class - Admin Controller
 *
 */
class FontesAction extends CAction {
    
    private $action;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run() {

        $this->action = Yii::app()->getRequest()->getQuery('action');

        Yii::import('application.extensions.dbuzz.admin.FontesManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.DicasUtils');

        switch ($this->action) {
            case "cores":
                $this->cores();
                break;
            case "tamanhos":
                $this->tamanhos();
                break;
            case "alterar":
                $this->alterar();
                break; 
            case "alterar_size":
                $this->alterarSize();
                break; 
            case "css":
                $this->criarCSS();
                break;
        }
    }

    /**
     *
     * Editar cores
     * Edits the main attributes and it opens the item list.
     *
     */
    public function cores() {

        $result = array();
        
        try {
            $minhas_preferencias = new MyPreferences();        
            $fontsHandler = new FontesManager();

            $result['content'] = $fontsHandler->getContent();
            $result['fonts'] = $fontsHandler->getFontsAttributes();
            
            $settings = $minhas_preferencias->getPreferences();  

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips("edit", "fontes");
        
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/fontes/cores", $result);
    }
    
     /**
     *
     * Editar tamanhos
     * Edits the main attributes and it opens the item list.
     *
     */
    public function tamanhos() {

        $result = array();
        
        try {
            $minhas_preferencias = new MyPreferences();        
            $fontsHandler = new FontesManager();

            $result['fonts'] = $fontsHandler->getFontsAttributes('size');
            
            $settings = $minhas_preferencias->getPreferences();  

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        
        $result['dicas'] = DicasUtils::getTips("edit", "fontes");
        
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/fontes/tamanhos", $result);
    }

    /**
     *
     * Alterar
     * This method update the submited form using a jQuery request
     *
     */
    public function alterar(){
        
        Yii::import('application.extensions.utils.HelperUtils');
        $get_post = array();

        //Old system update font colors
        $get_post[0] = $_POST['title_color'];
        $get_post[1] = $_POST['text_color'];
        $get_post[2] = $_POST['link_color'];
        $get_post[3] = $_POST['link_color_hover'];
        $get_post[4] = $_POST['menu_color'];
        $get_post[5] = $_POST['menu_color_hover'];
        $get_post[6] = $_POST['subtitulo_color'];
        $get_post[7] = $_POST['button_color_hover'];
        $get_post[8] = $_POST['button_color'];
        $get_post[9] = $_POST['input_text_color'];   
        
        
        //New system update font colors
        $data['title_popup'] = $_POST['title_popup_color'];
        $data['text_popup'] = $_POST['text_popup_color'];
        $data['chamada_cor'] = $_POST['input_chamada_color'];

        try {

	    $fontsHandler = new FontesManager();
            $content = $fontsHandler->updateContent($get_post);
            $attributes = $fontsHandler->updateAttributes($data);            
        
            $content = HelperUtils::createCss();
            
            echo Yii::t("messageStrings", "message_result_fonts_update");


        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: FontesAction - alterar() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Alterar
     * This method update the submited form using a jQuery request
     *
     */
    public function alterarSize(){
        
        Yii::import('application.extensions.utils.HelperUtils');
        $data = array();

        //System update font colors
        $data['title_size'] = $_POST['title_size'];
        $data['text_size'] = $_POST['text_size'];
        $data['text_line_height'] = $_POST['text_line_height'];
        $data['text_alignment'] = $_POST['text_alignment'];
        
        $data['subtitulo_size'] = $_POST['subtitulo_size'];
        $data['subtitulo_line'] = $_POST['subtitulo_line'];
        $data['subtitulo_alinhamento'] = $_POST['subtitulo_alinhamento'];
        $data['subtitulo_fonte'] = $_POST['subtitulo_fonte'];
        
        $data['chamada_size'] = $_POST['chamada_size'];
        $data['chamada_line'] = $_POST['chamada_line'];
        $data['chamada_alinhamento'] = $_POST['chamada_alinhamento'];
        $data['chamada_fonte'] = $_POST['chamada_fonte'];

        try{
	    $fontsHandler = new FontesManager();
            $attributes = $fontsHandler->updateAttributes($data);            
        
            $content = HelperUtils::createCss();
            
            echo Yii::t("messageStrings", "message_result_fonts_update");

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: FontesAction - alterar() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Criar CSS
     * This method update the submited form using a jQuery request
     * TODO: method test, remove it!!!
     * 
     */
    public function criarCSS(){        

        try {
            Yii::import('application.extensions.utils.HelperUtils');
            $content = HelperUtils::createCss();
            echo "T: " . $content;

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
}
?>