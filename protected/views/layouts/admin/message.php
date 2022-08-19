<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title><?php echo Yii::app()->params['titlePageAdmin'] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta name="title" content="PurplePier" />
        <meta name="description" content="Purplepier web application " />
        <meta name="keywords" content="photos, imagine, see, gallery, photojournalism, pictures, images"/>
        <meta name="distribution" content="Global" />
        <meta name="author" content="CarlosGarcia" />
        <meta name="publisher" content="CarlosGarcia" />
        <meta name="copyright" content="CarlosGarcia" />
        <link rel="shortcut icon" type="image/x-icon" href="/media/user/icons/favicon.ico"/>

        <?php $baseUrl = Yii::app()->baseUrl; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/buttons.css" /> 
       
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/admin/<?php echo Yii::app()->params['adminOwner'] ?>/message.css" />
        <link rel="stylesheet" type="text/css" href="/css/admin/general/<?php echo Yii::app()->params['adminOwner'] ?>/brand.css" />

        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/jquery.js"></script>       
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/site/main.js"></script>

    </head>
    <body>
        <div class="shadow"><div class="clear"></div></div>
        <div class="overlay"></div>        
        <?php echo $content ?>                
    </body>
</html>
