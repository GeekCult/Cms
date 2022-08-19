<?php include Yii::app()->getBasePath() . "/views/site/common/header/site/special/" . $preferences['topo']["cool"] . '.php'; ?> 

<!-- END HEADER headertop -->
<?php if($preferences["menu_exibe"]){ ?>
<div class="row-fluid z-under">
    <div class="span12">
    <?php if(Yii::app()->params['menu_type']){$menu_r = Yii::app()->params['menu_type'];}else{$menu_r = "menu_responsivo";} ?>
    <?php include Yii::app()->getBasePath() . "/views/site/common/menu/$menu_r.php"; ?>
    </div>
</div>
<?php } ?>

<?php //if($isBanner['banner_exibe'] == '1'){ ?>
<?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;  ?>
<?php if($local_place){$path_banner = 'http://dev.purplepier.com.br/media/user/images/clients/';}else{$path_banner = '/media/user/images/original/';} ?>
<!-- START HEADER headertop -->
<div class="headertop needhead" id="<?php echo $menu_active ?>">

    <!-- BLURED BACKGROUND-->
    <div class="action-banner-bg"></div>
    <!-- END BLURED BACKGROUND-->

    <!-- PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
    <div class="action-banner-bg-top"></div>
    <!-- END PIXEL BG DOTTS UNDER BLURED BACKGROUND-->

    <?php if(isset($preferences['barra_social_exibir']) && $preferences['barra_social_exibir']){ ?>
    <?php include Yii::app()->getBasePath() . "/views/site/modulos/topos/extra/barra_social.php"; ?>
    <?php } ?>
    
    <?php if($menu_active != 'home'){ ?>
    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="shine">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <!--IMAGE -->            
                            <?php if (isset($graphics['banner']) && $graphics['banner'] ) { if($graphics['banner']['slot_type'] == "f"){ ?>
                            <div class="row-fluid">
                                <div class="span12 center">
                                    <div class='image_vertical_layout'>
                                        <img src="<?php echo "//" . $_SERVER['SERVER_NAME'] ?>/media/user/images/original/<?php echo $graphics['banner']['foto'] ?>" alt="<?php echo $graphics['banner']['titulo'] ?>" title="<?php echo $graphics['banner']['foto'] ?>"/>
                                    </div>
                                <?php  } ?>
                                </div>
                            </div>
                            <?php } ?>            
                            <!-- END IMAGE -->
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <h1><?php if(isset($text['titulo'])) echo $text['titulo'] ?></h1>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE HEADER -->
    <?php } else{ ?>
    
    <div class="row-fluid">
        <div class="container">
            <div class="span12">
                <div id="banner_main" class="thumbnails center">    
                   <?php include Yii::app()->getBasePath() . "/views/site/common/banner/banner.php"; ?>
                </div>
            </div>
        </div>        
    </div>   
    <?php } ?>
    
</div>
<?php //} ?>