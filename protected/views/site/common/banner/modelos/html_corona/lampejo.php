<div class='ctnBillboard'>
    <div class='container_block_row'>
        <div class='ctnFullBillboard center'>
            <?php if(isset($image1['link']) && $image1['link'] != ''){ ?>
            <a href='<?php echo $image1['link']; ?>' target="<?php if(isset($image1["variante"])){if($image1["variante"] == 1){echo '_self';}else{echo '_blank';}} ?>" class="bt_link_banner_advertise" data-id="<?php echo $image1['id_banner'] ?>">
            <?php } ?>
                
            <div class='imgBillboard'>
                <img src='/media/user/images/original/<?php if(isset($image1['src'])) echo $image1['src'] ?>' alt='<?php if(isset($image1['src'])) echo $image1['src'] ?>'/>
            </div>            
            <?php if(isset($image1['link']) && $image1['link'] != ''){ ?>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class='clear'></div>
</div>