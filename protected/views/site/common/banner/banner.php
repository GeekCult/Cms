<?php if(count($preferences['main_banner']['banners']) > 0) { ?>

<div id="banner_main_border" <?php if($isBanner['banner_exibe'] == '1' && Yii::app()->params['tecnologia'] == 0) echo "style='height:".$preferences['main_banner_altura']."px'" ?>>
    <div class="mn_banner_container relative"> 
        <div class="shadow_main_banner"></div>
        <div class="bn_button_left <?php if(count($preferences['main_banner']['banners']) < 2) echo " hide"; ?>"></div>
        <div class="bn_image_container" id="banner_main_support">        
            <?php $nd = 1; for($o = 0; $o < count($preferences['main_banner']['banners']); $o++){ ?>
            <div id="banner_loader<?php echo $nd ?>" <?php if($nd > 1) echo "style='display:none;'" ?>>
                <?php if($preferences['main_banner']['banners_random'][$o]['modelo'] == 'render_partial'){ $mnRpMp = $preferences['main_banner']['banners_random'][$o]; if(isset($mnRpMp["cool3"])){ ?>
                <?php $this->renderPartial("/site/common/banner/modelos/".$mnRpMp['tipo']. "/" . $mnRpMp['cool'], $mnRpMp["cool3"]);  ?> 
                <?php }}else{ ?>
                <div class="canvas_stage<?php echo $preferences['main_banner']['banners_random'][$o]['id'] ?>"></div>  
                <?php } ?>
            </div>
            <?php $nd++;} ?>
        </div>
        <div class="bn_button_right <?php if(count($preferences['main_banner']['banners']) < 2) echo " hide"; ?>"></div>
        <input type="hidden" value="<?php echo $preferences['main_banner']['quantidade_banners'] ?>" id="quantidade_banners"/>
    </div> 
    <?php if(count($preferences['main_banner']['banners']) > 1 && true == false){ ?>
    <ol id="bnOlbDD" class="carousel-indicators carousel-support">
        <?php $l = 1; for($j = 0; $j < count($preferences['main_banner']['banners']); $j++){  ?>
        <li id="bnOl_<?php echo $l ?>" class="bnOlbM <?php if($j==0) echo "active"?>" data-slide-to="<?php echo $l ?>" data-target="#banner_main"></li>
        <?php  $l++;} ?>
    </ol>
    <?php } ?>

</div>

<?php } ?>


