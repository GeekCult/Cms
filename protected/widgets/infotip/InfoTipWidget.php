<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfoTipWidget
 *
 * @author CarlosGarcia
 */
class InfoTipWidget extends CWidget {
    
    public $id;
    public $title;
    public $dica;
    public $link;
    public $link_label;
    public $imgFile; 
    public $classe; 

    public function init() {

        // registra o CSS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'infotip.css';
        $cssFile = Yii::app()->getAssetManager()->publish($file);
        $css = Yii::app()->clientScript->registerCssFile($cssFile);

        // registra os JS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'infotip.js';
        $jsFile = Yii::app()->getAssetManager()->publish($file);
        $js = Yii::app()->clientScript->registerScriptFile($jsFile, CClientScript::POS_END);

        // registra os JS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'slideeffect.js';
        $jsFile = Yii::app()->getAssetManager()->publish($file);
        $js = Yii::app()->clientScript->registerScriptFile($jsFile, CClientScript::POS_END);

        // registra os JS do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'main_info.js';
        $jsFile = Yii::app()->getAssetManager()->publish($file);
        $js = Yii::app()->clientScript->registerScriptFile($jsFile, CClientScript::POS_END);        

        // registra os Images do widget
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
        $this->imgFile = Yii::app()->getAssetManager()->publish($file);
        
    }

    public function run() {
        
        $this->render('infotipWidget', array( 
                                              'id'=>$this->id,
                                              'title'=>$this->title,
                                              'classe'=>$this->classe,
                                              'dica'=>$this->dica,
                                              'link'=>$this->link,
                                              'link_label'=>$this->link_label,
                                              'path'=>$this->imgFile)); // arquivo: countdown/views/countdownWidget.php
    }

}

?>
