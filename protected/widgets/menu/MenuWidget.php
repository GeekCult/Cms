<?php

class MenuWidget extends CWidget {

    public $imgFile;
    public $result;

    public function init() {
        
        Yii::import('application.extensions.dbuzz.admin.special.CanalComunicacaoManager');
        Yii::import('application.extensions.dbuzz.admin.special.PierPedidosManager'); 
        $canalHandler = new CanalComunicacaoManager(); 

        // registra o CSS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'menu.css';
        $cssFile = Yii::app()->getAssetManager()->publish($file);
        $css = Yii::app()->clientScript->registerCssFile($cssFile);

        // registra os JS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'menu.js';
        $jsFile = Yii::app()->getAssetManager()->publish($file);
        $js = Yii::app()->clientScript->registerScriptFile($jsFile, CClientScript::POS_BEGIN);

        // registra os Images do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
        $this->imgFile = Yii::app()->getAssetManager()->publish($file);

        $this->result['path'] = $this->imgFile;
        
        $this->result['canal'] = $canalHandler->getAllMessagesInfo();
                  
        $pierPedidosHandler = new PierPedidosManager();
        $this->result['pier_chamados'] = $pierPedidosHandler->getAllChamados();
        

    }

    public function run() {
        $this->render('menuWidget', $this->result); /* arquivo: ./views/styledWidget.php */
    }

}

?>
