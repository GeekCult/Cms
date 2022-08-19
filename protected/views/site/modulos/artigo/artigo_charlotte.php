<div id="artigo_charlotte_<?php echo $id ?>" class="fullCP md_artigo_charlotte" data-id="<?php echo $id ?>">
    <div class="row-fluid">
      <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
            
            <div class="row-fluid">
                <div class="span12">
                    <div class="view">
                        <div class="mask">
                            <div class="bgArtCh"></div>
                            <div class="bgArtCh3">
                                <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                                <div class="txtFinal tItem3"><?php if(isset($extra['composite_texto_1'])){ echo $extra['composite_texto_1'];} ?></div>
                                <?php if($link_1 != ''){ ?></a><?php } ?>
                            </div>
                            <div class="row-same-height row-full-height">
                                <div class="col-md-8 col-xs-height col-full-height no-float pd_0">
                                    <div class="item">
                                        <?php if(isset($extra['composite_titulo_exibe_1']) && $extra['composite_titulo_exibe_1']){ ?><div class="tItem1 textoCh"><?php if(isset($extra['composite_titulo_1'])){ echo $extra['composite_titulo_1'];} ?></div><?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-height col-full-height no-float pd_0">
                                    <div class="item">
                                        <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                                        <div class="bgArtCh2"></div>                                        
                                        <?php if(isset($extra['composite_botao_exibe_1']) && $extra['composite_botao_exibe_1']){ ?><a href="#" class="info tItem2"><?php if(isset($extra['composite_label_botao_1'])){ echo $extra['composite_label_botao_1'];}else{echo "Saiba mais";} ?></a><?php } ?>
                                        <?php if($link_1 != ''){ ?></a><?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>  
                </div>
            </div>   
        </div>
    </div>
</div>