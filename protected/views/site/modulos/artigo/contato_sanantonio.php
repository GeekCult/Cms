<div id="contato_sanantonio_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
      <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
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
            <?php if($layout_1 == 'tradicional' || $layout_1 == ''){ ?>
            <div class="row-fluid">
                <div class="<?php if(!$is_full) echo 'padding_l_10' ?>">
                    <!-- CONTACT FORM -->
                    <form id="ajax-contacts">                    
                        <input class="span12" type="text" name="nome" id="nome" value="" placeholder="Nome"><br>
                        <input class="span12" type="email" name="email" id="email" value="" placeholder="Email"><br>                  
                        <input class="span12" type="text" name="fone" id="fone" value="" placeholder="Telefone"><br>                   
                        <textarea class="span12" name="messagem" id="mensagem" rows="5" cols="25" placeholder="Mensagem"></textarea><br>
                        <div id="output_contact"></div>
                        <label>&nbsp;</label>
                        <div class="left"><input class="botao btn-second mgR2" type="button" value="Limpar" id='bt_clear_contato'></div>
                        <div class="left"><input class="botao btn-main" type="button" value="Enviar" id='bt_submit_contato'></div>
                    </form>
                </div>                
            </div>            
            <?php } ?>
        </div>
    </div>
</div>