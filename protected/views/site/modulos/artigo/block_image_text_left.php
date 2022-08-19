<div id="block_image_text_left_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
        <div class="ctnArtigo <?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
            <?php if($layout_1 == 'left' || $layout_1 == 'left_no_edge' || $layout_1 == ''){ ?>
            <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>">
                <?php if($image_1 != ''){ ?>
                <div class="span3">
                    <div id="artImg_<?php echo $id ?>" class="center <?php if($layout_1 == 'left'){ ?>pp_square<?php } ?>">
                        <a data-footer="<?php echo $subtitulo_1 ?>" data-gallery="imagesizes" data-title="<?php echo $titulo_1 ?>" data-toggle="lightbox" href="/media/user/images/original/<?php echo $image_1 ?>">
                            <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" title="<?php echo $titulo_1 ?>"/>
                        </a>                        
                    </div>
                </div>
                <?php } ?>
                <div class="<?php if($image_1 != ''){ ?> span9 <?php }else{ ?> span12 <?php } ?>">            
                    <div class="ctnArtTxt">
                        <h2><?php echo $titulo_1 ?></h2>
                        <h4><?php echo $subtitulo_1 ?></h4>
                        <p class="tP lead"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                        <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>"><?php if($label_1 != ''){echo $label_1;}else{echo "Saiba mais";} ?></a><?php } ?>
                    </div>
                </div>            
            </div>
            <?php }else if($layout_1 == 'right_no_edge_middle'){ ?>
                <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>" <?php if(!$is_full){ ?> style="<?php if($margin_bottom != "") echo "margin-bottom: {$margin_bottom}px;"; if($margin_top != "") echo "margin-top: {$margin_top}px;"; if($padding_bottom != "") echo "padding-bottom: {$padding_bottom}px;"; if($padding_top != "") echo "padding-top: {$padding_top}px;";if($background != "") if($background_type == 0){echo "background: url(/media/user/images/original/$background)";}else if($background_type == 2){echo "background: url(/media/images/textures/efeitos/$background); background-color: $background_color";}else{echo "background: url(/media/images/textures/site/$background)";} ?>"<?php } ?>>
                    <div class="<?php if($image_1 != ''){ ?> span6 <?php }else{ ?> span12 <?php } ?>">            
                        <div class="ctnArtTxt">
                            <h2><?php echo $titulo_1 ?></h2>
                            <h4><?php echo $subtitulo_1 ?></h4>
                            <p class="tP lead"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                            <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>"><?php if($label_1 != ''){echo $label_1;}else{echo "Saiba mais";} ?></a><?php } ?>
                        </div>
                    </div> 
                    <?php if($image_1 != ''){ ?>
                    <div class="span6">
                        <div id="artImg_<?php echo $id ?>" class="center <?php if($layout_1 == 'right'){ ?>pp_square<?php } ?>">
                            <a data-footer="<?php echo $subtitulo_1 ?>" data-gallery="imagesizes" data-title="<?php echo $titulo_1 ?>" data-toggle="lightbox" href="/media/user/images/original/<?php echo $image_1 ?>">
                            <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" title="<?php echo $titulo_1 ?>"/>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
            <?php }else if($layout_1 == 'left_no_edge_middle'){ ?>
                <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>" <?php if(!$is_full){ ?> style="<?php if($margin_bottom != "") echo "margin-bottom: {$margin_bottom}px;"; if($margin_top != "") echo "margin-top: {$margin_top}px;"; if($padding_bottom != "") echo "padding-bottom: {$padding_bottom}px;"; if($padding_top != "") echo "padding-top: {$padding_top}px;";if($background != "") if($background_type == 0){echo "background: url(/media/user/images/original/$background)";}else if($background_type == 2){echo "background: url(/media/images/textures/efeitos/$background); background-color: $background_color";}else{echo "background: url(/media/images/textures/site/$background)";} ?>"<?php } ?>>
                    <?php if($image_1 != ''){ ?>
                    <div class="span6">
                        <div id="artImg_<?php echo $id ?>" class="center <?php if($layout_1 == 'right'){ ?>pp_square<?php } ?>">
                            <a data-footer="<?php echo $subtitulo_1 ?>" data-gallery="imagesizes" data-title="<?php echo $titulo_1 ?>" data-toggle="lightbox" href="/media/user/images/original/<?php echo $image_1 ?>">
                            <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" title="<?php echo $titulo_1 ?>"/>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="<?php if($image_1 != ''){ ?> span6 <?php }else{ ?> span12 <?php } ?>">            
                        <div class="ctnArtTxt">
                            <h2><?php echo $titulo_1 ?></h2>
                            <h4><?php echo $subtitulo_1 ?></h4>
                            <p class="tP lead"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                            <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>"><?php if($label_1 != ''){echo $label_1;}else{echo "Saiba mais";} ?></a><?php } ?>
                        </div>
                    </div>                   
                </div>

            <?php }else{ ?>
                <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>" <?php if(!$is_full){ ?> style="<?php if($margin_bottom != "") echo "margin-bottom: {$margin_bottom}px;"; if($margin_top != "") echo "margin-top: {$margin_top}px;"; if($padding_bottom != "") echo "padding-bottom: {$padding_bottom}px;"; if($padding_top != "") echo "padding-top: {$padding_top}px;";if($background != "") if($background_type == 0){echo "background: url(/media/user/images/original/$background)";}else if($background_type == 2){echo "background: url(/media/images/textures/efeitos/$background); background-color: $background_color";}else{echo "background: url(/media/images/textures/site/$background)";} ?>"<?php } ?>>
                    <div class="<?php if($image_1 != ''){ ?> span9 <?php }else{ ?> span12 <?php } ?>">            
                        <div class="ctnArtTxt">
                            <h2><?php echo $titulo_1 ?></h2>
                            <h4><?php echo $subtitulo_1 ?></h4>
                            <p class="tP lead"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                            <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>"><?php if($label_1 != ''){echo $label_1;}else{echo "Saiba mais";} ?></a><?php } ?>
                        </div>
                    </div> 
                    <?php if($image_1 != ''){ ?>
                    <div class="span3">
                        <div id="artImg_<?php echo $id ?>" class="center <?php if($layout_1 == 'right'){ ?>pp_square<?php } ?>">
                            <a data-footer="<?php echo $subtitulo_1 ?>" data-gallery="imagesizes" data-title="<?php echo $titulo_1 ?>" data-toggle="lightbox" href="/media/user/images/original/<?php echo $image_1 ?>">
                            <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" title="<?php echo $titulo_1 ?>"/>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

