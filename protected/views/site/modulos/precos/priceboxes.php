<div id="priceboxes_<?php echo $id ?>" class="fullCP">
    <div class="container fullCT <?php if(!$is_full) echo 'padding_l_10' ?>">
        <link rel="stylesheet" href="/css/site/content/special/others/precos.css" type="text/css" media="screen" />
        <?php if($qtd_blocos == 1){ ?>
        <div class="row-fluid">
            <div class="span12">
                <!-- START PRICE-->
                <div class="pricing-table <?php if($destaque_1) echo "pricing-table-highlighted" ?>">
                    <!-- HEADER PRICE-->
                    <div class="pricing-table-header cBl1">
                        <div class="reflex">
                            <h2><?php if($titulo_1 != "") echo htmlspecialchars_decode($titulo_1) ?></h2>
                            <?php if($valor_1 != '0'){ ?>
                            <h3><?php echo $unidade_1 ?><span><?php echo $valor_1 ?></span><span class="mo"><?php echo $centavos_1 ?> <?php echo $frequencia_1 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END HEADER PRICE-->
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_1) ?></strong></p>
                    </div>
                    <!--BODY PRICE-->
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_1)) ?>
                    </div>
                    <!--END BODY PRICE-->
                    <!-- BUTTON -->
                     <?php if($label_1 != ""){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_1 ?>" class="btn btn-large btn-info"><?php echo $label_1 ?></a>
                    </div>
                    <?php } ?>
                    <!-- END BUTTON -->
                </div>
                <!-- END PRICE-->
            </div>
        </div>
        <?php } ?>
        <?php if($qtd_blocos == 2 || $qtd_blocos == ""){ ?>
        <div class="row-fluid">
            <div class="span6">
                <!-- START PRICE-->
                <div class="pricing-table <?php if($destaque_1) echo "pricing-table-highlighted" ?>">
                    <!-- HEADER PRICE-->
                    <div class="pricing-table-header cBl1">
                        <div class="reflex">
                            <h2><?php if($titulo_1 != "") echo $titulo_1 ?></h2>
                             <?php if($valor_1 != '0'){ ?>
                            <h3><?php echo $unidade_1 ?><span><?php echo $valor_1 ?></span><span class="mo"><?php echo $centavos_1 ?> <?php echo $frequencia_1 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END HEADER PRICE-->
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_1) ?></strong></p>
                    </div>
                    <!--BODY PRICE-->
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_1)) ?>
                    </div>
                    <!--END BODY PRICE-->
                    <!-- BUTTON -->
                     <?php if($label_1 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_1 ?>" class="btn btn-large btn-info"><?php echo $label_1 ?></a>
                    </div>
                    <?php } ?>
                    <!-- END BUTTON -->
                </div>
                <!-- END PRICE-->
            </div>
            <!-- END PRICE ITEM -->
            <div class="span6">
                <div class="pricing-table <?php if($destaque_2) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl2">
                        <div class="reflex">
                            <h2><?php echo $titulo_2 ?></h2>
                             <?php if($valor_2 != '0'){ ?>
                            <h3><?php echo $unidade_2 ?><span><?php echo $valor_2 ?></span><span class="mo"><?php echo $centavos_2 ?> <?php echo $frequencia_2 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_2) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_2)) ?>
                    </div>
                     <?php if($label_2 != ""){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_2 ?>" class="btn btn-large btn-info"><?php echo $label_2 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if($qtd_blocos == 3){ ?>
        <div class="row-fluid">
            <div class="span4">
                <!-- START PRICE-->
                <div class="pricing-table <?php if($destaque_1) echo "pricing-table-highlighted" ?>">
                    <!-- HEADER PRICE-->
                    <div class="pricing-table-header cBl1">
                        <div class="reflex">
                            <h2><?php if($titulo_1 != "") echo $titulo_1 ?></h2>
                             <?php if($valor_1 != '0'){ ?>
                            <h3><?php echo $unidade_1 ?><span><?php echo $valor_1 ?></span><span class="mo"><?php echo $centavos_1 ?> <?php echo $frequencia_1 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END HEADER PRICE-->
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_1) ?></strong></p>
                    </div>
                    <!--BODY PRICE-->
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_1)) ?>
                    </div>
                    <!--END BODY PRICE-->
                    <!-- BUTTON -->
                     <?php if($label_1 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_1 ?>" class="btn btn-large btn-info"><?php echo $label_1 ?></a>
                    </div>
                    <?php } ?>
                    <!-- END BUTTON -->
                </div>
                <!-- END PRICE-->
            </div>
            <!-- END PRICE ITEM -->
            <div class="span4">
                <div class="pricing-table <?php if($destaque_2) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl2">
                        <div class="reflex">
                            <h2><?php echo $titulo_2 ?></h2>
                             <?php if($valor_2 != '0'){ ?>
                            <h3><?php echo $unidade_2 ?><span><?php echo $valor_2 ?></span><span class="mo"><?php echo $centavos_2 ?> <?php echo $frequencia_2 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_2) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_2)) ?>
                    </div>
                     <?php if($label_2 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_2 ?>" class="btn btn-large btn-info"><?php echo $label_2 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- END PRICE ITEM -->
            <div class="span4">
                <div class="pricing-table <?php if($destaque_3) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl3">
                        <div class="reflex">
                            <h2><?php echo $titulo_3 ?></h2>
                             <?php if($valor_3 != '0'){ ?>
                            <h3><?php echo $unidade_3 ?><span><?php echo $valor_3 ?></span><span class="mo"><?php echo $centavos_3 ?> <?php echo $frequencia_3 ?></span></h3>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_3) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_3)) ?>
                    </div>
                     <?php if($label_3 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_3 ?>" class="btn btn-large btn-info"><?php echo $label_3 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>


        <?php if($qtd_blocos == 4){ ?>
        <div class="row-fluid">
            <div class="span3">
                <!-- START PRICE-->
                <div class="pricing-table <?php if($destaque_1) echo "pricing-table-highlighted" ?>">
                    <!-- HEADER PRICE-->
                    <div class="pricing-table-header cBl1">
                        <div class="reflex">
                            <h2><?php if($titulo_1 != "") echo $titulo_1 ?></h2>
                             <?php if($valor_1 != '0'){ ?>
                            <h4><?php echo $unidade_1 ?><span><?php echo $valor_1 ?></span><span class="mo"><?php echo $centavos_1 ?> <?php echo $frequencia_1 ?></span></h4>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END HEADER PRICE-->
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_1) ?></strong></p>
                    </div>
                    <!--BODY PRICE-->
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_1)) ?>
                    </div>
                    <!--END BODY PRICE-->
                    <!-- BUTTON -->
                     <?php if($label_1 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_1 ?>" class="btn btn-large btn-info"><?php echo $label_1 ?></a>
                    </div>
                    <?php } ?>
                    <!-- END BUTTON -->
                </div>
                <!-- END PRICE-->
            </div>
            <!-- END PRICE ITEM -->
            <div class="span3">
                <div class="pricing-table <?php if($destaque_2) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl2">
                        <div class="reflex">
                            <h2><?php echo $titulo_2 ?></h2>
                             <?php if($valor_2 != '0'){ ?>
                            <h4><?php echo $unidade_2 ?><span><?php echo $valor_2 ?></span><span class="mo"><?php echo $centavos_2 ?> <?php echo $frequencia_2 ?></span></h4>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_2) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_2)) ?>
                    </div>
                     <?php if($label_2 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_2 ?>" class="btn btn-large btn-info"><?php echo $label_2 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- END PRICE ITEM -->
            <div class="span3">
                <div class="pricing-table <?php if($destaque_3) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl3">
                        <div class="reflex">
                            <h2><?php echo $titulo_3 ?></h2>
                             <?php if($valor_3 != '0'){ ?>
                            <h4><?php echo $unidade_3 ?><span><?php echo $valor_3 ?></span><span class="mo"><?php echo $centavos_3 ?> <?php echo $frequencia_3 ?></span></h4>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_3) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_3)) ?>
                    </div>
                     <?php if($label_3 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_3 ?>" class="btn btn-large btn-info"><?php echo $label_3 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- END PRICE ITEM -->
            <div class="span3">
                <div class="pricing-table <?php if($destaque_4) echo "pricing-table-highlighted" ?>">
                    <div class="pricing-table-header cBl4">
                        <div class="reflex">
                            <h2><?php echo $titulo_4 ?></h2>
                             <?php if($valor_4 != '0'){ ?>
                            <h4><?php echo $unidade_4 ?><span><?php echo $valor_4 ?></span><span class="mo"><?php echo $centavos_4 ?> <?php echo $frequencia_4 ?></span></h4>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pricing-table-space"></div>
                    <div class="pricing-table-text">
                        <p><strong><?php echo htmlspecialchars_decode($subtitulo_4) ?></strong></p>
                    </div>
                    <div class="pricing-table-features">
                        <?php echo htmlspecialchars_decode(nl2br($texto_4)) ?>
                    </div>
                     <?php if($label_4 != ''){ ?>
                    <div class="pricing-table-sign-up">
                        <a href="<?php echo $link_4 ?>" class="btn btn-large btn-info"><?php echo $label_4 ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>