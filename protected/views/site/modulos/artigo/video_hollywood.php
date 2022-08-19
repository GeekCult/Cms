<div id="video_hollywood_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
        <div class="ctnArtigo <?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
            <?php if($layout_1 == 'up' || $layout_1 == ''){ ?>
            <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>">               
                <div class="span12">            
                    <div class="ctnArtTxt">
                        <h2 class="mainTitle"><?php echo $titulo_1 ?></h2>
                        <h4><?php echo $subtitulo_1 ?></h4>
                        <p class="tP"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                        <?php if($link_1 != ''){ ?>
                        <div class="video-container"><?php echo stripslashes($link_1) ?></div>                            
                        <?php } ?>
                    </div>
                </div>            
            </div>
            <?php }else if($layout_1 == 'left'){ ?>
            <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>">               
                <div class="span3">            
                    <div class="ctnArtTxt">
                        <h2 class="mainTitle"><?php echo $titulo_1 ?></h2>
                        <h4><?php echo $subtitulo_1 ?></h4>
                        <p class="tP"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                        
                    </div>
                </div> 
                <div class="span9">
                    <?php if($link_1 != ''){ ?>
                    <div class="video-container"><?php echo $link_1 ?></div>                            
                    <?php } ?>
                </div>
            </div>
            <?php }else if($layout_1 == 'right'){ ?>
            <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>"> 
                <div class="span9">
                    <?php if($link_1 != ''){ ?>
                    <div class="video-container"><?php echo $link_1 ?></div>                            
                    <?php } ?>
                </div>
                <div class="span3">            
                    <div class="ctnArtTxt">
                        <h2 class="mainTitle"><?php echo $titulo_1 ?></h2>
                        <h4><?php echo $subtitulo_1 ?></h4>
                        <p class="tP"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>
                        
                    </div>
                </div>                 
            </div>
            <?php }else{ ?>
            <div class="container_block_row <?php if(!$is_full) echo 'padding_l_10' ?>">               
                <div class="span12">            
                    <div class="ctnArtTxt">
                        <?php if($link_1 != ''){ ?>
                        <div class="video-container"><?php echo $link_1 ?></div>                            
                        <?php } ?>
                        <h2 class="mainTitle"><?php echo $titulo_1 ?></h2>
                        <h4><?php echo $subtitulo_1 ?></h4>
                        <p class="tP"><?php echo htmlspecialchars_decode(nl2br($texto_1)) ?></p>                        
                    </div>
                </div>            
            </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

