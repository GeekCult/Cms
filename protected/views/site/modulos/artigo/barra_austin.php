<div id="barra_austin_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
      <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
            <?php if($layout_1 == 'up' || $layout_1 == ''){ ?>
            <div class="row-fluid">
                <div class="span12 hide">
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
            <div class="row-fluid mgT">
                <div class="span3">
                    <input type="email" placeholder="Email" name="email" class="span12 txt_plus0_resp"/>
                </div>
                <div class="span3">
                    <div class="row-fluid">
                        <div class="span7">
                            <input type="password" placeholder="Senha" name="password" class="span12 txt_plus0_resp"/>
                        </div>
                        <div class="span5">
                            <input type="button" value="logar" class="botao btn-main btn-auto"/>
                        </div>
                    </div>                   
                </div>
                <div class="span3">
                    <div class="left mgR mgT mgB"><span class="tP pointer" data-toggle="modal" data-target="#esqueci_senha"><div class="badge main-bg-color">Esqueci senha</div></span></div>
                    <div class="left mgB"><a href="/cadastrar" class="link uppercase tP"><div class="botao btn-success btn-auto">Cadastre-se</div></a></div>
                </div>
                <div class="span3">
                    <div class="botao btn-main right_resp"><i class="fa fa-shopping-cart mgR"></i>0 item(s) - R$0,00</div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>