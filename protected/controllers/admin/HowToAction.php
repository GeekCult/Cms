<?php

/**
 * Autor: CarlosGarcia
 * Date: 05/02/2011
 *
 * HowTo Class
 * Specific Class - Admin Controller
 *
 */
class HowToAction extends CAction{
    
    private $id;

    /**
     * Run
     * Launcher Method
     *
     */
    public function run(){
        
        $action = Yii::app()->getRequest()->getQuery('action');
        $this->id = Yii::app()->getRequest()->getQuery('id');
        
        switch($action){
            case "wiki":
            case   ""  :
                $this->wiki();
                break;
            
            case "show":
                $this->show();
                break;
            
            case "recarregar":
                $this->recarregar();
                break;
            
            case "tags":
                $this->tags();
                break;
        }
    }
    
     /*
     * Mostra a primeira dica da tela do HowTo
     * A primeira deve ser uma tela simples com dicas de como o
     * howto funciona.
     * 
     */
    public function tags(){
        
        $this->controller->layout = 'admin/admin_base';
        $this->controller->render('/admin/pages/help/tags');
    }
    
    /*
     * Mostra a primeira dica da tela do HowTo
     * A primeira deve ser uma tela simples com dicas de como o
     * howto funciona.
     * 
     */
    public function show(){
        
        $id = $this->id;
        $title = "title_". $id;
        $desc = "desc_". $id;
        $info = "info_". $id;
        $tip = "tip_". $id;
        $link = "link_". $id;
        
        $result['title'] = Yii::t("dicasStrings", $title);
        $result['desc']  = Yii::t("dicasStrings", $desc);
        $result['info']  = Yii::t("dicasStrings", $info);
        $result['tip']   = Yii::t("dicasStrings", $tip);
        $result['link']  = Yii::t("dicasStrings", $link);
        
        $this->controller->layout = 'admin/admin_base';
        $this->controller->render('/admin/pages/help/howto', $result);
    }
    
    /*
     * Mostra a primeira dica da tela do HowTo
     * A primeira deve ser uma tela simples com dicas de como o
     * howto funciona.
     * 
     */
    public function wiki(){
        
        Yii::import('application.extensions.utils.special.TemplatesUtils');
        Yii::import('application.extensions.dbuzz.admin.MateriasManager');

        $materiasHandler = new MateriasManager();
        
        $result['materia_selecionada'] = $materiasHandler->getContentById($this->id);

        //Componentes
        $template_info = TemplatesUtils::getTemplatesInfo($result['materia_selecionada']['id'], 'materias');
        
        if(isset($template_info['id'])){
            $result['componentes'] = TemplatesUtils::getModule($template_info['id'], $result);
            $this->addscript($template_info['id']);
        }else{
            $result['componentes'] = false;
        }
        
        //Set ping activity
        $setPing = MethodUtils::setPing("Visualização Wiki - " .$this->id, "wiki");
        
        $this->controller->layout = 'admin/admin_bootstrap';
        $this->controller->render('/admin/pages/help/wiki', $result);
    }
    
    /*
     * Recarrega uma nova dica, esta id é passado por POST
     * E pode ser menor ou maior dependendo do lado que o user 
     * esta clicando nas setas laterais
     * 
     */
    public function recarregar(){
        
        $id = $this->id;
        $title = "title_". $id;
        $desc = "desc_". $id;
        $info = "info_". $id;
        $tip = "tip_". $id;
        $link = "link_". $id;
        
        $result['title'] = Yii::t("dicasStrings", $title);
        $result['desc']  = Yii::t("dicasStrings", $desc);
        $result['info']  = Yii::t("dicasStrings", $info);
        $result['tip']   = Yii::t("dicasStrings", $tip);
        $result['link']  = Yii::t("dicasStrings", $link);
        
        $this->controller->renderPartial('/admin/pages/help/item/item_simple', $result);
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
    public function addScript($cssComponentes = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCssFile($baseUrl . "/media/user/css/article_{$cssComponentes}.css", 'screen', CClientScript::POS_HEAD);

    }
}
?>