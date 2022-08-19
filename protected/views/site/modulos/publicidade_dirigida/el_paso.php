<div id="el_paso_<?php echo $id ?>" class="fullCP">
    <div class="container fullCT <?php if(!$is_full) echo 'padding_l_10' ?>">
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
        
        <?php if($banners){ if(count($banners) > 0){ ?>
        
        <?php $p=1;$i=0;foreach($banners as $valuesB){ ?>        
        <?php if($p == 1){ ?>
        <div class="row-fluid">
            <div class="grid <?php if(isset($layout_1) && $layout_1 != ''){ echo $layout_1;}else{echo "cs-style-1";} ?>">
        <?php } ?>
                <div class="span<?php if($qtd_items == 4){echo "3";} if($qtd_items == 3){echo "4";} if($qtd_items == 2){echo "6";}if($qtd_items == 1){echo "12";} ?> mgB">
                    <figure>
                            <?php if(isset($valuesB["info"]['tipo'])) $this->renderPartial("/site/common/banner/modelos/" . $valuesB["info"]['tipo'] . '/' . $valuesB["info"]['cool'], $valuesB["info"]["cool2"]); ?>
                            <figcaption>
                                    <h3 class="tItem"><?php if($valuesB["info"]["titulo"] != '0') echo $valuesB["info"]["titulo"] ?></h3>
                                    <span class="dItem"><?php if($valuesB["info"]["descricao"] != '0') echo $valuesB["info"]["descricao"] ?></span>
                                    <a class="fgHref" href="<?php if($valuesB["info"]["link"] != '') echo $valuesB["info"]["link"] ?>"><?php if($botao_label){ echo $botao_label;}else{echo 'Saiba mais'; } ?> &raquo;</a>
                            </figcaption>
                    </figure>
                </div>
            <!--END ITEM -->
        <?php if($p == $qtd_items || $i >= count($banners)-1){ ?>
            </div>
        </div>
        <?php } ?>
        <?php $p++;$i++; if($p > $qtd_items){$p=1;} ?>
        
        <?php } ?>
        
        <?php }} ?>
        
        
    </div>
</div>