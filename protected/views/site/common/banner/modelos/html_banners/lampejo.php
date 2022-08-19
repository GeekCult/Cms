<div id='billboard' class='ctnBillboard' <?php if(isset($margin_1)) echo "style='margin-bottom:" .$margin_1."px'" ?>>
    <?php $link = "/media/user/images/original/"; if(isset($miniSiteUrl)) $link = $miniSiteUrl; ?>
    <div class='container_block_row'>
        <div class="span12">
        <div class='ctnFullBillboard thumbnails center'>
            <?php if(isset($image1['link']) && $image1['link'] != ''){ ?>
            <a href='<?php echo $image1['link']; ?>' target="<?php if(isset($image1["variante"])){if($image1["variante"] == 1){echo '_self';}else{echo '_blank';}} ?>" class="bt_link_banner_advertise" data-id="<?php echo $image1['id_banner'] ?>">
            <?php } ?>
                
            <div id='novImg_<?php //echo $items['id'] ?>' class='imgBillboard'>
                <img src='<?php if(isset($image1['src'])) echo $link . $image1['src'] ?>' alt='<?php if(isset($image1['src'])) echo $image1['src'] ?>'/>
            </div>            
            <?php if(isset($image1['link']) && $image1['link'] != ''){ ?>
            </a>
            <?php } ?>
        </div>
        </div>
    </div>
    <div class='clear'></div>
</div>