<?php if(defined('Settings::PIER_COMBOSHARE') && Settings::PIER_COMBOSHARE == 1) include Yii::app()->getBasePath() . "/views/site/common/share/combo_share.php"; ?>
<?php //include Yii::app()->getBasePath() . "/views/site/common/share/facebook_likebox.php"; ?>
<div class="clear"></div>
<div id="rodapeMain">
    <?php if(isset($preferences['rodape']["cool"])) include Yii::app()->getBasePath() . "/views/site/common/footer/site/special/" . $preferences['rodape']["cool"] . '.php'; ?>    
</div>
<div class="footer_extra base_black">
    
    <a href="<?php echo Yii::app()->params['link_desenvolvimento']?>" target="_blank">
        <div class="right mgT0 mgR">
            <img src="/media/images/logos/<?php echo Yii::app()->params['logo_desenvolvimento']?>" alt="" />
        </div>
    </a>
</div>
<?php if($preferences['google_analytics'] != ''){ ?>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("<?php echo $preferences['google_analytics']?>");
pageTracker._trackPageview();
} catch(err) {}
</script>
<?php } ?>

<?php include Yii::app()->getBasePath() . "/views/site/common/footer/extras/main.php"; ?>