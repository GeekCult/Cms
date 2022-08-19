<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' class="no-js" lang="pt-BR">
    <head>
        <title>Ops!</title>
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
        <?php if(Yii::app()->params['responsivo']){ ?><meta name="viewport" content="width=device-width, initial-scale=1.0"/><?php } ?>

        <?php $baseUrl = Yii::app()->baseUrl; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/bootstrap.css" />
        <?php if(Yii::app()->params['responsivo']){ ?><link href='/css/lib/bootstrap_responsive.css' rel='stylesheet'/><?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/css/lib/message.css" />

        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/lib/fanc7/jquery.min.js"></script>       
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/site/main.js"></script>
    </head>
    <body>
        <div class="shadow"><div class="clear"></div></div>
        <div class="overlay"></div>        
        <?php echo $content ?>                
    </body>
</html>
