<div id="texas_artigo_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
        <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
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
            <div class="row-fluid">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=348822858488121";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            </div>
            <div class="fb-comments" data-href="http://<?php echo $_SERVER['SERVER_NAME'] . $link_1 ?>" data-numposts="5" data-colorscheme="light" data-version="v2.3" data-width="100%"></div>
        </div>
    </div>
</div>