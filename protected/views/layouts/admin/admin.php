<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <?php $baseUrl = Yii::app()->baseUrl; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo Yii::app()->params['titlePageAdmin'] ?></title>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta name="title" content="<?php echo Yii::app()->params['titlePageAdmin'] ?>" />
        <meta name="description" content="<?php echo Yii::app()->params['titlePageAdmin'] ?>" />
        <meta name="keywords" content=""/>
        <meta name="distribution" content="Global" />
        <meta name="author" content="PurplePier" />
        <meta name="publisher" content="PurplePier" />
        <meta name="copyright" content="Purplepier" />
        <link rel='shortcut icon' type='image/x-icon' href='/media/user/icons/favicon.ico'/>
        
        <meta name="robots" content="noindex"/>
        <meta name="robots" content="noindex,nofollow"/>
        
        <link href="<?php echo $baseUrl . '/css/lib/bootstrap.css' ?>" rel="stylesheet"/> 

    
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/purplepier/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/<?php echo Yii::app()->params['adminOwner'] ?>/main.css" />
       
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/jquery.js"></script>
        <!--<script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/customComponents.js"></script>   -->   
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/admin/main.js"></script>  
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/howto/howto.js"></script> 
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/jquery.json.js"></script>
       

    </head>
    <body>
        <div class="mainPan">
            <div class="wrap">
                <?php include Yii::app()->getBasePath() . '/views/admin/common/header/header_image.php'; ?>
                <?php $this->widget('application.widgets.menu.MenuWidget'); ?>
                <div id="pan">
                <?php echo $content ?>
                </div>
                <?php include Yii::app()->getBasePath() . '/views/admin/common/footer/footer_image.php'; ?>
                <?php if(Yii::app()->user->hasFlash('sessionTimeout')): ?> 
                <div class="flash_notice">
                    <?php echo Yii::app()->user->getFlash('sessionTimeout');?>
                    <div class="flash_notice_button_close"></div>
                </div> 
                <?php endif; ?>
            </div>
        </div>
        
    </body>
</html>