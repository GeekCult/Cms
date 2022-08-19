<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' class="no-js" lang="pt-BR">
    <head>
        
        <meta http-equiv='Content-type' content='text/html;charset=UTF-8'/>
        <title><?php echo CHtml::encode($this->pageTitle) ?></title>
        
        <meta name='author' content='<?php echo $this->siteAuthor ?>'/>
        <?php if(Yii::app()->params['responsivo']){ ?><meta name="viewport" content="width=device-width, initial-scale=1.0"/><?php } ?>
                
        <meta name='description' content='<?php echo $this->pageDescription ?>'/>
	<meta name='keywords' content='<?php echo $this->pageMetatags ?>'/>
   
        <meta property='og:title' content='<?php echo $this->productTitle ?>'/>        
        <meta property='og:description' content='<?php echo $this->productDescription ?>'/>
        <meta property='fb:app_id' content='<?php echo $this->facebook_app_id ?>'/>
        
        <?php $baseUrl = Yii::app()->baseUrl; ?>
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseUrl ?>/media/user/icons/favicon.ico'/>

        
        <link href='<?php echo $baseUrl ?>/css/lib/bootstrap.css' rel='stylesheet'/>
        <?php if(Yii::app()->params['responsivo']){ ?><link href='<?php echo $baseUrl ?>/css/lib/bootstrap_responsive.css' rel='stylesheet'/><?php }else{ ?><link href='<?php echo $baseUrl ?>/css/lib/bootstrap_nonresponsive.css' rel='stylesheet'/><?php } ?>
        <link rel='stylesheet' type='text/css' href='<?php echo $baseUrl ?>/css/lib/layout_vevo.css'/>
        
        <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;  ?>
        <?php if($local_place){$css = 'http://dev.purplepier.com.br/media/user/css/minisite_main.css';}else{$css = '/media/user/css/minisite_main.css';} ?>
        <?php if(Yii::app()->params['site_type']) $css = '/media/user/css/main.css'; ?>
        <link rel='stylesheet' type='text/css' href='<?php echo $baseUrl . $css ?>'/>
        
        <link rel="stylesheet" href="<?php echo $baseUrl ?>/media/user/css/client.css" type="text/css">
   
        
        <!--[if lt IE 8]><link rel='stylesheet' type='text/css' href='/css/site/main/ie_hack.css'/><![endif]-->         

    </head>
    <body>
        
        <div class='shadow'><div class='clear'></div></div>
        <div class='overlay'></div>
        
        <?php echo $content ?>
        <input type='hidden' value='site' id='helper_local'/>

        <input type='hidden' id='social_network_title' value='<?php echo $this->productTitle ?>'/>
        <input type='hidden' id='social_network_description' value='<?php echo $this->productDescription ?>'/>
        <input type='hidden' id='helper_next_action_purple' value='' name='' />
        <input type='hidden' id='helper_socialNetWorkProfile' value='<?php echo $this->facebookProfile ?>' name='<?php echo $this->twitterProfile ?>' data-linkedin='<?php echo $this->linkedinProfile ?>' class='<?php echo $this->orkutProfile ?>' data-youtube='<?php echo $this->canalYoutubeProfile ?>'/>

        <?php if (Yii::app()->user->hasFlash('sessionTimeout')): ?> 
        <div class='flash_notice'>
            <div id='flash_notice_text'>
                <span><?php echo Yii::app()->user->getFlash('sessionTimeout'); ?></span>
            </div>
            <div class='flash_notice_button_close'></div>
        </div> 
        <?php endif; ?>
    </body>
</html>