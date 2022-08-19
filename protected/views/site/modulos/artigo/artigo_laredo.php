<div id="artigo_laredo_<?php echo $id ?>" class="fullCP md_artigo_laredo" data-id="<?php echo $id ?>">
    <div class="row-fluid">
      <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
        <div class="span12">
            <div class="view">
                <div class="mask">                          
                    <div class="row-same-height row-full-height rowinline">
                        <div class="row-fluid">
                            <div class="bgArtCh">
                               <div class="item">
                                    <?php if(isset($extra['composite_titulo_exibe_1']) && $extra['composite_titulo_exibe_1']){ ?><div class="tItem1 textoCh"><?php if(isset($extra['composite_titulo_1'])){ echo $extra['composite_titulo_1'];} ?></div><?php } ?>
                                </div> 
                            </div>                                    
                            <div class="bgArtCh2">
                                <div class="item">
                                    <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>                                      
                                    <?php if(isset($extra['composite_botao_exibe_1']) && $extra['composite_botao_exibe_1']){ ?><div class="txtInfo tItem2"><?php if(isset($extra['composite_label_botao_1'])){ echo $extra['composite_label_botao_1'];}else{echo "Saiba mais";} ?></div><?php } ?>
                                    <?php if($link_1 != ''){ ?></a><?php } ?>
                                </div>
                            </div>
                            <div class="bgArtCh3">
                                <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                                <div class="txtFinal tItem3"><?php if(isset($extra['composite_texto_1'])){ echo $extra['composite_texto_1'];} ?></div>
                                <?php if($link_1 != ''){ ?></a><?php } ?>
                            </div>
                        </div>                                
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>