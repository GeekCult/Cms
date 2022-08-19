<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/database.php';
//echo $yii;

// remove the following lines when in production mode
//defined ('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
//Yii::log("Index Checkout", "profile", 'system.web.CController');
//Yii::trace('IndexCheckout', 'system.web.CController');
ini_set('display_errors','on');
require_once($yii);
Yii::createWebApplication($config)->run();