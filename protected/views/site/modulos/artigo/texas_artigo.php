<div id="texas_artigo_<?php echo $id ?>" class="fullCP">
    
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
            
    <div class="row-fluid">
      <div class="container fullCT">
            <?php if($layout_1 == 'up' || $layout_1 == ''){ ?>
            <?php if($image_1 != ''){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="thumbnails center">
                        <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                        <img id="slot_picture<?php echo $id ?>" src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                        <?php if($link_1 != ''){ ?></a><?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($titulo_1 != "" || $subtitulo_1 != "" || $texto_1 != ""){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                        <div class="ctnArtTxt">
                            <?php if($titulo_1 != ""){ ?>
                            <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                            <?php } ?>
                            <?php if($subtitulo_1 != ""){ ?>
                            <div class="clear"></div>
                            <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                            <?php } ?>
                            <?php if($texto_1 != ""){ ?>
                            <div class="clear"></div>
                            <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                            <?php } ?>
                        </div>
                    </div>            
                </div>        
            </div>
            <?php } ?>
          
            <?php } else{ ?>  
            <?php if($titulo_1 != "" || $subtitulo_1 != "" || $texto_1 != ""){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                        <div class="ctnArtTxt">
                            <?php if($titulo_1 != ""){ ?>
                            <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                            <?php } ?>
                            <?php if($subtitulo_1 != ""){ ?>
                            <div class="clear"></div>
                            <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                            <?php } ?>
                            <?php if($texto_1 != ""){ ?>
                            <div class="clear"></div>
                            <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                            <?php } ?>
                        </div>
                    </div>            
                </div>        
            </div>
            <?php } ?>
            <?php if($image_1 != ''){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="thumbnails center">
                        <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                        <img id="slot_picture<?php echo $id ?>" src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                        <?php if($link_1 != ''){ ?></a><?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>