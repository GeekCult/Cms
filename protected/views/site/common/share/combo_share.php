<?php if($preferences['combo_share']['exibe']){ ?>
<div id="comboShare" class="comboShareNW <?php echo $preferences['combo_share']['color'] . ' ' . $preferences['combo_share']['position'] ?>" style="top:<?php echo $preferences['combo_share']['p_y'] ?>px">
    <div class="icons share_facebook" rel="simple">
        <img src="/media/images/icons/cs_facebook.jpg" alt="Facebook" class="icCs"/>
    </div>
    <div class="icons share_twitter" rel="simple">
        <img src="/media/images/icons/cs_twitter.jpg" alt="Twitter" class="icCs"/>
    </div>
    <div class="icons share_linkedin">
        <img src="/media/images/icons/cs_linkedin.jpg" alt="LinkedIn" class="icCs"/>
    </div>
    <div class="icons mg0 share_googleplus" rel="simple">
        <img src="/media/images/icons/cs_google.jpg" alt="GooglePlus" class="icCs"/>
    </div>
</div>
<?php } ?>