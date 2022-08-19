<div class="layoutGaleria" data-item-content="item_simples">
    <div class="layoutLogos" id="images_support">
        <div id="Searchresult">
        <?php if(count($content) > 0){ foreach ($content as $values) { ?>
            <?php if($values['foto'] != ""){ ?>
            <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                <div class='containerFotos'>
                    <?php if($type_images == "images"){?>
                    <input type="button" class="container_empty" alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['foto'] ?>" name="<?php echo $values['id'] ?>"/>
                    <?php }else {?>
                    <div id="bt-size-p"><input value="" type="button" name="p" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-m"><input value="" type="button" name="m" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-g"><input value="" type="button" name="g" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-j"><input value="" type="button" name="j" id="<?php echo $values['foto'] ?>"/></div>
                    <?php } ?> 
                    <?php if($values['tipo'] == "playground"){ ?>
                    <img src="/media/user/images/purplecanvas/thumbs/<?php echo $values['foto'] ?>" width='<?php echo $values['width'] ?>' height='<?php echo $values['height'] ?>' alt="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" style="<?php echo $values['margin'] ?>" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['foto'] ?>" width="120"/>
                    <?php }else{ ?>
                    <img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" width='<?php echo $values['width'] ?>' height='<?php echo $values['height'] ?>' alt="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" style="<?php echo $values['margin'] ?>" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['foto'] ?>" width="120"/>
                    <?php } ?>                    
                </div>
            </div>
        <?php } }?>           
        </div>
        <?php }else{ ?>
        <div class="result-message">
            <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
        </div>
        <?php } ?>
    </div>
</div>
<input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>

<?php if($init) { ?>
<script type="text/javascript">initPagination();</script>
<?php } ?>
<script language="javascript" type="text/javascript">
    //bug fix for fancybox images
    $("#images_support :button").click(function(e){ 
        
            <?php if(!$id_page){ ?>
            <?php   if($type_images == "galeria"){ ?> 
                parent.addImageStuff(this.id, this.name, this.title, "f");
            <?php  }else{ ?>
                
                <?php if(!$is_user){ ?>
                    parent.addImageSlots(this.id, this.name, this.title, "f");
                <?php } else{?>
                    parent.addImageStuff(this.id, this.name, this.title, "f");
                <?php } ?>   
            <?php   } ?>
            <?php }else{?>
            parent.addImageStuff(this.id, this.name);
            <?php }?>
    });
</script>