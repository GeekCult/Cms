<?php

class AlertDimWidget extends CWidget {

    public $imgFile;
    public $result;

    public function init() {
        
        //Yii::app()->clientScript->registerCoreScript('jquery');

        // registra o CSS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'alertDim.css';
        $cssFile = Yii::app()->getAssetManager()->publish($file);
        $css = Yii::app()->clientScript->registerCssFile($cssFile);

        // registra os JS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'alertDim.js';
        $jsFile = Yii::app()->getAssetManager()->publish($file);
        $js = Yii::app()->clientScript->registerScriptFile($jsFile, CClientScript::POS_BEGIN);

        // registra os Images do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
        $this->imgFile = Yii::app()->getAssetManager()->publish($file);

        $this->result['path'] = $this->imgFile;

    }

    public function run() {
        $this->render('alertDimWidget', $this->result); /* arquivo: ./views/styledWidget.php */
    }

}

?>
