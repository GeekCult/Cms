<?php if(isset($vitrine) && count($vitrine) > 0){ ?>
<div id="vitrine_barcelona_<?php echo $id ?>" class="fullCP">
    <?php if($layout_1 == 'common' || $layout_1 == ''){ ?>
    <div class="row-fluid"> 
        <?php if($titulo_1 != "" || $subtitulo_1 != "" || $texto_1 != ""){ ?>
        <div class="container fullCT ">
            <div class="span12">
                <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                    <div class="ctnArtTxt">
                        <h2><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                        <div class="clear"></div>
                        <?php if($subtitulo_1 != ""){ ?>
                        <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                        <div class="clear"></div>
                        <?php } ?>
                        <?php if($texto_1 != ""){ ?>
                        <p class="tP"><?php if($texto_1 != ""){echo $texto_1;}else{if(isset($isAdmin))echo C::TEXT_LOREM;} ?></p>
                        <?php } ?>
                    </div>
                </div>            
            </div> 
            <hr class="half" />
        </div> 
        <?php } ?>
        <div class="container fullCT">
            <div id="myCaroussel_<?php echo $id ?>" class="carousel slide" data-ride="carousel">
                <div class="<?php if(!$is_full) echo 'padding_l_10' ?>">
                <?php $qtd_users = count($vitrine);$m=0;$l=1; ?>
                
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <?php $link_prod = 'produtos'; if(isset($tipo_uso)){if($tipo_uso == 'loja'){$link_prod = 'loja';}} ?>
                    <?php $p=1; for($i = 0; $i < $qtd_users; $i++){ ?>

                    <?php if ($p == 1){ ?>
                    <div class="item <?php if($i == 0) echo 'active'?>">
                        <div class="row-fluid text-center">
                    <?php } ?>

                            <!-- ITEM-->   
                            <div class="span<?php if($qtd_items == 4){echo "3";} if($qtd_items == 3){echo "4";} if($qtd_items == 2){echo "6";}if($qtd_items == 1){echo "12";} ?>"> 
                                <div class="thumbnail">
                                    <div class="product-item-rounded center">
                                        <?php if(isset($vitrine[$i]['image_0'])){ ?>
                                        <?php if($link_prod == 'produtos'){ ?>
                                        <a href="/produtos/<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>">
                                        <?php }else{ ?>
                                        <a href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>">
                                        <?php } ?>
                                            <img src="/media/user/images/original/<?php echo $vitrine[$i]['image_0'] ?>" width="200" alt="<?php echo $vitrine[$i]['image_0'] ?>"/>
                                        </a>
                                        <?php } ?>
                                    </div>
                                    <?php if($titulo_exibe){ ?>
                                    <h5 class="tItem center"><?php echo $vitrine[$i]['nome'] ?></h5>
                                    <?php } ?>
                                    <?php if($titulo_exibe){ ?>
                                    <div class="padding_20">
                                        <p class="dItem line_height"><?php echo nl2br($vitrine[$i]['descricao_resumo']) ?></p> 
                                    </div>                                
                                    <?php } ?>
                                    <?php if($botao_exibe){ ?>
                                    <div class="ctnButtonUS padding_l_10">
                                        <p>
                                            <?php if($link_prod == 'produtos'){ ?>
                                            <a class="btn btn-large btn-block" href="<?php if(isset($vitrine[$i]['url'])) echo "/{$link_prod}/" . $vitrine[$i]['url'] ?>" <?php if($cor_botao) echo "style='background-image: linear-gradient($cor_botao, $cor_botao2); background-color: $cor_botao2; color: $cor_botao_label;'" ?> >
                                            <?php }else{ ?>
                                                <a class="btn btn-large btn-block" href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>" <?php if($cor_botao) echo "style='background-image: linear-gradient($cor_botao, $cor_botao2); background-color: $cor_botao2; color: $cor_botao_label;'" ?> >
                                            <?php } ?>
                                                <?php if(isset($botao_label) && $botao_label){echo $botao_label;}else{echo Yii::t('siteStrings', 'title_more_details');}; ?>
                                            </a>
                                        </p>	
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- ITEM-->

                    <?php if ($p == $qtd_items || $i == ($qtd_users -1)){ ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php $p++; if($p>$qtd_items)$p=1;?>

                    <?php } ?>

                </div><!-- /INNER-->
                <?php if($qtd_users > $qtd_items){ ?>
                <ol class="carousel-indicators carousel-support">
                    <?php for($j = 0; $j < $qtd_users; $j++){ if($l == 1){ ?>
                    <li class="<?php if($j==0) echo "active"?>" data-slide-to="<?php echo $m ?>" data-target="#myCaroussel_<?php echo $id ?>"></li>
                    <?php } $l++; if($l > ($qtd_items)){$l=1;$m++;}} ?>
                </ol>
                <?php } ?>
                <!-- Carousel nav -->
                <?php if($qtd_users > $qtd_items){ ?>
                <a class="carousel-control left" href="#myCaroussel_<?php echo $id ?>" data-slide="prev"><i class="fa fa-chevron-left carArrow"></i></a>
                <a class="carousel-control right" href="#myCaroussel_<?php echo $id ?>" data-slide="next"><i class="fa fa-chevron-right carArrow"></i></a>
                <?php } ?>
                </div>
            </div>
        </div>    
    </div>
    <?php } ?>
    
    <?php if($layout_1 == 'lumi_light'){ ?>
    <div class="row-fluid"> 
        <?php if($titulo_1 != "" || $subtitulo_1 != "" || $texto_1 != ""){ ?>
        <div class="container fullCT ">
            <div class="span12">
                <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                    <div class="ctnArtTxt tt_stripes">
                        <h2 class="txt_mark mg0"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                        <div class="clear mgB"></div>
                        <?php if($subtitulo_1 != ""){ ?>
                        <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                        <div class="clear"></div>
                        <?php } ?>
                        <?php if($texto_1 != ""){ ?>
                        <p class="tP"><?php if($texto_1 != ""){echo $texto_1;}else{if(isset($isAdmin))echo C::TEXT_LOREM;} ?></p>
                        <?php } ?>
                    </div>
                </div>            
            </div> 
            <hr class="half" />
        </div> 
        <?php } ?>
        <div class="container fullCT">
            <div id="myCaroussel_<?php echo $id ?>" class="carousel slide" data-ride="carousel">
                <div class="<?php if(!$is_full) echo 'padding_l_10' ?>">
                <?php $qtd_users = count($vitrine);$m=0;$l=1; ?>
                
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <?php $link_prod = 'produtos'; if(isset($tipo_uso)){if($tipo_uso == 'loja'){$link_prod = 'loja';}} if(isset($tipo_uso)){if($tipo_uso == 'auto'){$link_prod = 'autos';}} ?>
                    <?php $p=1; for($i = 0; $i < $qtd_users; $i++){ ?>

                    <?php if ($p == 1){ ?>
                    <div class="item <?php if($i == 0) echo 'active'?>">
                        <div class="row-fluid text-center">
                    <?php } ?>

                            <!-- ITEM-->   
                            <div class="span<?php if($qtd_items == 4){echo "3";} if($qtd_items == 3){echo "4";} if($qtd_items == 2){echo "6";}if($qtd_items == 1){echo "12";} ?>"> 
                                <div class="">
                                    <div class="center">
                                        <?php if(isset($vitrine[$i]['image_0'])){ ?>
                                        <?php if($link_prod == 'produtos'){ ?>
                                        <a href="/produtos/<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>">
                                        <?php }else if($link_prod == 'autos'){ ?>
                                        <a href="/autos/<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>">
                                        <?php }else{ ?>
                                        <a href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>">
                                        <?php } ?>
                                            <img src="/media/user/images/original/<?php echo $vitrine[$i]['image_0'] ?>" alt="<?php echo $vitrine[$i]['image_0'] ?>" class="img-polaroid"/>
                                        </a>
                                        <?php } ?>
                                    </div>
                                    <?php if($titulo_exibe){ ?>
                                    <div class="row-fluid">
                                        <div class="col-md-6">
                                            <div class="tItem txt_left bold"><?php echo $vitrine[$i]['marca_string']['nome']  ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tItem right_resp bold"><?php echo $vitrine[$i]['ano'] ?></div>
                                        </div>
                                    </div>
                                    
                                    <?php } ?>
                                    <?php if($titulo_exibe){ ?>
                                    <h5 class="dItem uppercase txt_left"><?php echo $vitrine[$i]['nome'] ?></h5>
                                    <hr />
                                    <?php } ?>
                                    <?php if($titulo_exibe){ ?>
                                    
                                    <div class="row-fluid">
                                        <p class="dItem line_height txt_left"><?php echo nl2br($vitrine[$i]['preco_real_string']) ?></p> 
                                    </div> 
                                    <hr />
                                    <?php } ?>
                                    <?php if($botao_exibe){ ?>
                                    <div class="ctnButtonUS">
                                        <p>
                                            <?php if($link_prod == 'produtos'){ ?>
                                            <a class="btn btn-large btn-block" href="<?php if(isset($vitrine[$i]['url'])) echo "/{$link_prod}/" . $vitrine[$i]['url'] ?>" <?php if($cor_botao) echo "style='background-image: linear-gradient($cor_botao, $cor_botao2); background-color: $cor_botao2; color: $cor_botao_label;'" ?> >
                                            <?php }else if($link_prod == 'autos'){ ?>
                                            <a class="btn btn-large btn-block" href="<?php if(isset($vitrine[$i]['url'])) echo "/{$link_prod}/" . $vitrine[$i]['url'] ?>" <?php if($cor_botao) echo "style='background-image: linear-gradient($cor_botao, $cor_botao2); background-color: $cor_botao2; color: $cor_botao_label;'" ?> >
                                            <?php }else{ ?>
                                            <a class="btn btn-large btn-block" href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>" <?php if($cor_botao) echo "style='background-image: linear-gradient($cor_botao, $cor_botao2); background-color: $cor_botao2; color: $cor_botao_label;'" ?> >
                                            <?php } ?>
                                                <?php if(isset($botao_label) && $botao_label){echo $botao_label;}else{echo Yii::t('siteStrings', 'title_more_details');}; ?>
                                            </a>
                                        </p>	
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- ITEM-->

                    <?php if ($p == $qtd_items || $i == ($qtd_users -1)){ ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php $p++; if($p>$qtd_items)$p=1;?>

                    <?php } ?>

                </div><!-- /INNER-->
                <?php if($qtd_users > $qtd_items){ ?>
                <ol class="carousel-indicators carousel-support">
                    <?php for($j = 0; $j < $qtd_users; $j++){ if($l == 1){ ?>
                    <li class="<?php if($j==0) echo "active"?>" data-slide-to="<?php echo $m ?>" data-target="#myCaroussel_<?php echo $id ?>"></li>
                    <?php } $l++; if($l > ($qtd_items)){$l=1;$m++;}} ?>
                </ol>
                <?php } ?>
                <!-- Carousel nav -->
                <?php if($qtd_users > $qtd_items){ ?>
                <a class="carousel-control left" href="#myCaroussel_<?php echo $id ?>" data-slide="prev"><i class="fa fa-chevron-left carArrow"></i></a>
                <a class="carousel-control right" href="#myCaroussel_<?php echo $id ?>" data-slide="next"><i class="fa fa-chevron-right carArrow"></i></a>
                <?php } ?>
                </div>
            </div>
        </div>    
    </div>
    <?php } ?>
</div>
<?php } ?>