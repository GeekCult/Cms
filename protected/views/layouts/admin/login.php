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
        <link rel="shortcut icon" type="image/x-icon" href="//www.purplepier.com.br/media/images/icons/favicon.ico" />
        
        <meta name="robots" content="noindex"/>
        <meta name="robots" content="noindex,nofollow"/>
        
        <link rel='stylesheet' type='text/css' href='<? echo $baseUrl ?>/css/lib/reset.css'/>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/general/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/buttons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/cool/cool_html.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/cool/colors.css" /> -->
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/site/components/special/button_colorful.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/js/fancybox/jquery.fancybox-1.3.4.css" />
    
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/purplepier/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/<?php echo Yii::app()->params['adminOwner'] ?>/main.css" />
       
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/keyboardlistener.js"></script>   
        
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
       
    </head>
    <body style="background: url(/media/images/layout/admin/bg.jpg) repeat!important;">
        <div id="pan">
            <?php echo $content ?>
        </div>
        <?php if(Yii::app()->user->hasFlash('sessionTimeout')): ?> 
        <div class="flash_notice">
            <?php echo Yii::app()->user->getFlash('sessionTimeout');?>
            <div class="flash_notice_button_close"></div>
        </div> 
        <?php endif; ?>       
    </body>
</html>