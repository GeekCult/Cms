
<?php $baseUrl = Yii::app()->baseUrl; ?>
<script type="text/javascript" src="<?php if(Yii::app()->params['local'] == 0){ ?>//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js<?php }else{ ?><?php echo $baseUrl ?>/js/lib/fanc7/jquery.min.js <?php } ?>"></script>
<script type="text/javascript" src="<?php echo $baseUrl ?>/js/site/main.js"></script> 

<script src="<?php echo $baseUrl ?>/js/lib/bootstrap.js"></script>
<script src="<?php echo $baseUrl ?>/js/lib/ekko-lightbox.js"></script>
<script src="<?php echo $baseUrl ?>/js/lib/jquery.maskedinput-1.2.2.min.js"></script>

<?php if(defined('Settings::BANNER_PRINCIPAL') && Settings::BANNER_PRINCIPAL){ ?>
<script src="<?php echo $baseUrl ?>/js/lib/fanc7/jquery.seven.js"></script>
<script src="<?php echo $baseUrl ?>/js/lib/fanc7/jquery.reference_min.js"></script>
<?Php } ?>

<?php if(defined('Settings::MENU_PRINCIPAL') && Settings::MENU_PRINCIPAL != 'menu_responsivo'){ ?>
<script src="<?php echo $baseUrl ?>/js/lib/<?php echo Settings::MENU_PRINCIPAL ?>.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="<?php echo $baseUrl ?>/js/site/banner.js"></script>
<?php } ?>

<?php if(Yii::app()->params['ramo'] == 'ecommerce' || Yii::app()->params['ramo'] == 'educacao'){ ?>
<script type="text/javascript">verifyShoppingCartItems();</script>
<?php } ?>

<?php if(Yii::app()->params['pier_cotacoes']){ ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/modal/sob_consulta.php'; ?>
<?php } ?>

<?php include Yii::app()->getBasePath() . '/views/site/modulos/modal/esqueci_senha.php'; ?>

<?php //Main Banner ?>
<?php ($preferences['main_banner']['isShadow']) ? $sZB = 0 : $sZB = 0; ?>

<script type="text/javascript">initBannerMain('<?php echo json_encode($preferences['main_banner']['banners_random']) ?>');</script>
<script type="text/javascript">loadMethodsAfterLoaded();</script>


