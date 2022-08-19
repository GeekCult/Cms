<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<!--START MAIN-WRAPPER--> 

<div class="row-fluid" data-template="home_ecommerce_easy">
    
    <?php if(Yii::app()->params['pier_cotacoes']){ include Yii::app()->getBasePath() . '/views/site/pages/produtos/general/barra_austin.php'; } ?>
    
    <div class="container pan">
        <div class="pan_shadow">
            <div class="mgL_resp mgR">
                <?php if($page_prop['gel_fr_initial'] != '' || $text['titulo'] != ''){ ?>
                <!--TITLE-->
                <div class="row-fluid">   
                    <h1 class="center standart-h2title"> 
                        <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
                    </h1>
                    <p class="standart-ptitle bold"><?php echo $text['titulo'] ?></p>
                    <div class="divider_horizontal mgB2"></div>
                </div>
                <?php }else{ ?>
                <h1 class="hidden"><?php if(defined('Settings::SITE_DESCRIPTION') && Settings::SITE_DESCRIPTION != '') echo Settings::SITE_DESCRIPTION ?></h1>
                <?php } ?>
                
                <p>&nbsp;</p>
                <div class="row-fluid">
                    
                    <div class="span2">
                        <?php include Yii::app()->getBasePath() . '/views/site/pages/produtos/comum/menu/menu_produtos_html5.php'; ?>
                    </div>
                    <div class="span8">
                        
                        <?php if(isset($vitrine) && count($vitrine) > 0){ ?>                        
                        <div class="row-fluid">                          
                            <div class="squarebox">                                
                                <?php $qtd_users = count($vitrine);$m=0;$l=1; ?>
                                <!-- Carousel items -->
                                <div class="content">
                                    <h3 class="uppercase">Produtos em destaque</h3>
                                    <?php $link_prod = 'produtos'; if(isset($tipo_uso)){if($tipo_uso == 'loja'){$link_prod = 'loja';}} ?>
                                    <?php $p=1; for($i = 0; $i < $qtd_users; $i++){ ?>

                                    <?php if ($p == 1){ ?>
                                    <div class="item <?php if($i == 0) echo 'active'?>">
                                        <div class="row-fluid text-center">
                                    <?php } ?>
                                            <!-- ITEM-->   
                                            <div class="span4 mgB"> 
                                                <div class="thumbnail">
                                                    <div class="product-item-rounded center mgB">
                                                        <?php if(isset($vitrine[$i]['image_0'])){ ?>
                                                        <?php if($link_prod == 'produtos'){ ?>
                                                        <a href="/produtos/<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>">
                                                        <?php }else{ ?>
                                                        <a href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>">
                                                        <?php } ?>
                                                            <img src="/media/user/images/original/<?php echo $vitrine[$i]['image_0'] ?>" alt="<?php echo $vitrine[$i]['image_0'] ?>"/>
                                                        </a>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    <?php if($vitrine[$i]['referencia'] != ''){ ?><p class="tItem center mg0 bold"><?php echo $vitrine[$i]['referencia'] ?></p><?php } ?>
                                                    <h5 class="tItem center mg0" style="height: 40px!important; overflow: hidden"><?php echo $vitrine[$i]['nome'] ?></h5>
                                                    <div class="padding_l_10">
                                                        <p class="dItem line_height"><?php echo nl2br($vitrine[$i]['descricao_resumo']) ?></p> 
                                                    </div>
                                                    <div class="ctnButtonUS padding_l_10">
                                                        
                                                        <?php if(!Yii::app()->params['pier_cotacoes']){ ?>
                                                        <?php if($link_prod == 'produtos'){ ?>
                                                        <a class="botao btn-main btn btn-large btn-block mgB" href="<?php if(isset($vitrine[$i]['url'])) echo "/{$link_prod}/" . $vitrine[$i]['url'] ?>" >
                                                        <?php }else{ ?>
                                                        <a class="botao btn btn-main btn-large btn-block mgB" href="/loja/<?php echo $vitrine[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($vitrine[$i]['url'])) echo $vitrine[$i]['url'] ?>&v=<?php echo $vitrine[$i]['id_variante'] ?>"  >
                                                        <?php } ?>
                                                            <?php echo Yii::t('siteStrings', 'title_more_details'); ?>
                                                        </a> 
                                                        
                                                        <?php } ?>
                                                        
                                                        <?php if(Yii::app()->params['pier_cotacoes']){ ?>
                                                        <div class="row-fluid">
                                                            <button class="botao btn-main left btn-lg btn-block bt_consultar mgB mgT" type="button" data-toggle="modal" data-target="#sob_consulta" data-item="<?php echo $vitrine[$i]['nome'] ?>" data-id="<?php echo $vitrine[$i]['id'] ?>" data-valor="<?php echo $vitrine[$i]['preco_real'] ?>"><i class="fa fa-plus mgR"></i>cotar</button>
                                                            <p>&nbsp;</p>
                                                        </div>                                        
                                                        <?php } ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ITEM-->
                                    <?php if ($p == 3 || $i == ($qtd_users -1)){ ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php $p++; if($p > 3)$p=1;?>
                                    <?php } ?>
                                </div>                            
                            </div>                         
                        </div>
                        <p>&nbsp;</p>
                        <?php } ?>
                        
                        <?php if(isset($lancamentos) && count($lancamentos) > 0){ ?>                        
                        <div class="row-fluid">                          
                            <div class="squarebox">                                
                                <?php $qtd_users = count($lancamentos);$m=0;$l=1; ?>
                                <!-- Carousel items -->
                                <div class="content">
                                    <h3 class="uppercase">Lançamentos</h3>
                                    <?php $link_prod = 'produtos'; if(isset($tipo_uso)){if($tipo_uso == 'loja'){$link_prod = 'loja';}} ?>
                                    <?php $p=1; for($i = 0; $i < $qtd_users; $i++){ ?>

                                    <?php if ($p == 1){ ?>
                                    <div class="item <?php if($i == 0) echo 'active'?>">
                                        <div class="row-fluid text-center">
                                    <?php } ?>
                                            <!-- ITEM-->   
                                            <div class="span4 mgB"> 
                                                <?php if($lancamentos[$i]['lancamento']){ ?>
                                                <div class="bg_lancamento_small"></div>
                                                <?php } ?>
                                                <div class="thumbnail">
                                                    <div class="product-item-rounded center mgB">
                                                        <?php if(isset($lancamentos[$i]['image_0'])){ ?>
                                                        <?php if($link_prod == 'produtos'){ ?>
                                                        <a href="/produtos/<?php if(isset($lancamentos[$i]['url'])) echo $lancamentos[$i]['url'] ?>">
                                                        <?php }else{ ?>
                                                        <a href="/loja/<?php echo $lancamentos[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($lancamentos[$i]['url'])) echo $lancamentos[$i]['url'] ?>&v=<?php echo $lancamentos[$i]['id_variante'] ?>">
                                                        <?php } ?>
                                                            <img src="/media/user/images/original/<?php echo $lancamentos[$i]['image_0'] ?>" alt="<?php echo $lancamentos[$i]['image_0'] ?>"/>
                                                        </a>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    <?php if($lancamentos[$i]['referencia'] != ''){ ?><p class="tItem center mg0 bold"><?php echo $lancamentos[$i]['referencia'] ?></p><?php } ?>
                                                    <h5 class="tItem center mg0" style="height: 40px!important; overflow: hidden"><?php echo $lancamentos[$i]['nome'] ?></h5>
                                                    <div class="padding_l_20">
                                                        <p class="dItem line_height"><?php echo nl2br($lancamentos[$i]['descricao_resumo']) ?></p> 
                                                    </div>
                                                    <div class="ctnButtonUS padding_l_10">
                                                        <?php if(!Yii::app()->params['pier_cotacoes']){ ?>
                                                        <?php if($link_prod == 'produtos'){ ?>
                                                        <a class="botao btn-main btn-large btn-block" href="<?php if(isset($lancamentos[$i]['url'])) echo "/{$link_prod}/" . $lancamentos[$i]['url'] ?>" >
                                                        <?php }else{ ?>
                                                            <a class="botao btn-main btn-large btn-block" href="/loja/<?php echo $lancamentos[$i]['categoria_string']['categoria_url'] ?>?it=<?php if(isset($lancamentos[$i]['url'])) echo $lancamentos[$i]['url'] ?>&v=<?php echo $lancamentos[$i]['id_variante'] ?>"  >
                                                        <?php } ?>
                                                            <?php echo Yii::t('siteStrings', 'title_more_details'); ?>
                                                        </a>
                                                        <?php } ?>
                                                        <?php if(Yii::app()->params['pier_cotacoes']){ ?>
                                                        <div class="row-fluid">
                                                            <button class="botao btn-main left btn-lg btn-block bt_consultar mgB mgT" type="button" data-toggle="modal" data-target="#sob_consulta" data-item="<?php echo $lancamentos[$i]['nome'] ?>" data-id="<?php echo $lancamentos[$i]['id'] ?>" data-valor="<?php echo $lancamentos[$i]['preco_real'] ?>"><i class="fa fa-plus mgR"></i>cotar</button>
                                                            <p>&nbsp;</p>
                                                        </div>                                        
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ITEM-->
                                    <?php if ($p == 3 || $i == ($qtd_users -1)){ ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php $p++; if($p > 3)$p=1;?>
                                    <?php } ?>
                                </div>                            
                            </div>                         
                        </div>
                        <p>&nbsp;</p>
                        <?php } ?>
                        
                    </div>
                    <div class="span2">                        
                        <?php include Yii::app()->getBasePath() . "/views/site/common/banner/features/container_blocks_vertical.php"; ?>                      
                    </div>
                </div>
                <div class="row-fluid">                    
                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_01'] != '' || $text['texto_01'] != '' || $graphics['container_1'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">
                            <!-- FEATURE -->
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php if($text['titulo_01'] != '' || $text['texto_01'] != ''){ ?>
                                    <h2 class="titulo tit_size"><?php echo $text['titulo_01'] ?></h2>
                                    <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_01'] ?></h4>

                                    <p class="lead"><?php echo nl2br($text['texto_01']) ?></p>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--END:  FEATURE -->
                            <?php if ($graphics['container_1'] != "") { ?>
                            <!--IMAGE -->
                            <div class="row-fluid">
                                <div class="span12 center">
                                    <?php if ($graphics['container_1'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                                        <div class='image_vertical_layout'>
                                            <img src="/media/user/images/original/<?php echo $graphics['container_1']['foto'] ?>"/>
                                        </div>
                                     <?php  }else{ ?>
                                        <div class="container_bannerhtml_loader">
                                            <div class="canvas_stage<?php echo $graphics['container_1']['id'] ?>" id="stage"></div>
                                            <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_1']["cool"] ?>', '<?php echo $graphics['container_1']["id"] ?>')</script>
                                            <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_1']["altura"] ?>','<?php echo $graphics['container_1']["largura"] ?>', '<?php echo $graphics['container_1']["id"] ?>');</script> 
                                        </div>
                                    <?php  } } ?>
                                </div>
                            </div>

                            <!-- END IMAGE -->
                            <?php } ?>
                            <?php if($text['titulo_01'] != '' || $text['texto_01'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->


                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_02'] != '' || $text['texto_02'] != '' || $graphics['container_2'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">                            

                            <!-- FEATURE -->
                            <div class="span12">
                                <?php if($text['titulo_02'] != '' || $text['texto_02'] != ''){ ?>
                                <h2 class="titulo tit_size"><?php echo $text['titulo_02'] ?></h2>
                                <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_02'] ?></h4>
                                <p class="lead"><?php echo nl2br($text['texto_02']) ?></p>
                                <?php } ?>
                            </div>                            

                            <?php if ($graphics['container_2'] != "") { ?>
                            <!--IMAGE -->

                            <div class="row-fluid center">
                                <?php if ($graphics['container_2'] ) { if($graphics['container_2']['slot_type'] == "f"){ ?>                       
                                    <div class='image_vertical_layout'>
                                        <img src="/media/user/images/original/<?php echo $graphics['container_2']['foto'] ?>"/>
                                    </div>
                                 <?php  }else{ ?>
                                    <div class="container_bannerhtml_loader">
                                        <div class="canvas_stage<?php echo $graphics['container_2']['id'] ?>" id="stage"></div>
                                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_2']["cool"] ?>', '<?php echo $graphics['container_2']["id"] ?>')</script>
                                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_2']["altura"] ?>','<?php echo $graphics['container_2']["largura"] ?>', '<?php echo $graphics['container_2']["id"] ?>');</script> 
                                    </div>
                                <?php  } } ?>
                            </div>
                            <!-- END IMAGE -->

                            <?php } ?>

                            <!--END:  FEATURE -->
                            <?php if($text['titulo_02'] != '' || $text['texto_02'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->

                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_03'] != '' || $text['texto_03'] != '' || $graphics['container_3'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">
                            <!-- FEATURE -->
                            <div class="<?php if ($graphics['container_3'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                                <?php if($text['titulo_03'] != '' || $text['texto_03'] != ''){ ?>
                                <h2 class="titulo tit_size"><?php echo $text['titulo_03'] ?></h3>
                                <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_03'] ?></h4>
                                <p class="lead"><?php echo nl2br($text['texto_03']) ?></p>
                                <?php } ?>
                            </div>
                            <!--END:  FEATURE -->
                            <?php if ($graphics['container_3'] != "") { ?>
                            <!--IMAGE -->
                            <div class="span6 center">
                            <?php if ($graphics['container_3'] ) { if($graphics['container_3']['slot_type'] == "f"){ ?>                       
                                    <div class='image_vertical_layout'>
                                        <img src="/media/user/images/original/<?php echo $graphics['container_3']['foto'] ?>"/>
                                    </div>
                                 <?php  }else{ ?>
                                    <div class="container_bannerhtml_loader">
                                        <div class="canvas_stage<?php echo $graphics['container_3']['id'] ?>" id="stage"></div>
                                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_3']["cool"] ?>', '<?php echo $graphics['container_3']["id"] ?>')</script>
                                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_3']["altura"] ?>','<?php echo $graphics['container_3']["largura"] ?>', '<?php echo $graphics['container_3']["id"] ?>');</script> 
                                    </div>
                                <?php  } } ?>
                            </div>
                            <!-- END IMAGE -->
                            <?php } ?>
                            <?php if($text['titulo_03'] != '' || $text['texto_03'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->

                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_04'] != '' || $text['texto_04'] != '' || $graphics['container_4'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">
                            <?php if ($graphics['container_4'] != "") { ?>
                            <!--IMAGE -->
                            <div class="span6 center">
                                <?php if ($graphics['container_4'] ) { if($graphics['container_4']['slot_type'] == "f"){ ?>                       
                                    <div class='image_vertical_layout'>
                                        <img src="/media/user/images/original/<?php echo $graphics['container_4']['foto'] ?>"/>
                                    </div>
                                 <?php  }else{ ?>
                                    <div class="container_bannerhtml_loader">
                                        <div class="canvas_stage<?php echo $graphics['container_4']['id'] ?>" id="stage"></div>
                                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_4']["cool"] ?>', '<?php echo $graphics['container_4']["id"] ?>')</script>
                                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_4']["altura"] ?>','<?php echo $graphics['container_4']["largura"] ?>', '<?php echo $graphics['container_4']["id"] ?>');</script> 
                                    </div>
                                <?php  } } ?>
                            </div>
                            <!-- END IMAGE -->
                            <?php } ?>

                            <!-- FEATURE -->
                            <div class="<?php if ($graphics['container_4'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                                <?php if($text['titulo_04'] != '' || $text['texto_04'] != ''){ ?>
                                <h2 class="titulo tit_size"><?php echo $text['titulo_04'] ?></h2>
                                <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_04'] ?></h4>
                                <p class="lead"><?php echo nl2br($text['texto_04']) ?></p>
                                <?php } ?>
                            </div>
                            <!--END:  FEATURE -->
                            <?php if($text['titulo_04'] != '' || $text['texto_04'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->

                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_05'] != '' || $text['texto_05'] != '' || $graphics['container_5'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">
                            <?php if ($graphics['container_5'] != "") { ?>
                            <!--IMAGE -->
                            <div class="span6 center">
                                <?php if ($graphics['container_5'] ) { if($graphics['container_5']['slot_type'] == "f"){ ?>                       
                                    <div class='image_vertical_layout'>
                                        <img src="/media/user/images/original/<?php echo $graphics['container_5']['foto'] ?>"/>
                                    </div>
                                 <?php  }else{ ?>
                                    <div class="container_bannerhtml_loader">
                                        <div class="canvas_stage<?php echo $graphics['container_5']['id'] ?>" id="stage"></div>
                                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_5']["cool"] ?>', '<?php echo $graphics['container_5']["id"] ?>')</script>
                                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_5']["altura"] ?>','<?php echo $graphics['container_5']["largura"] ?>', '<?php echo $graphics['container_5']["id"] ?>');</script> 
                                    </div>
                                <?php  } } ?>
                            </div>
                            <!-- END IMAGE -->
                            <?php } ?>

                            <!-- FEATURE -->
                            <div class="<?php if ($graphics['container_5'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                                <?php if($text['titulo_05'] != '' || $text['texto_05'] != ''){ ?>
                                <h2 class="titulo tit_size"><?php echo $text['titulo_05'] ?></h2>
                                <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_05'] ?></h4>
                                <p class="lead"><?php echo nl2br($text['texto_05']) ?></p>
                                <?php } ?>

                            </div>
                            <!--END:  FEATURE -->
                            <?php if($text['titulo_05'] != '' || $text['texto_05'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->

                    <!-- ################ -->
                    <!-- CONTAINER  FEATURE -->
                    <!-- ################ -->
                    <?php if($text['titulo_06'] != '' || $text['texto_06'] != '' || $graphics['container_6'] != ""){ ?>
                    <div class="row-fluid">
                        <div class="">
                            <?php if ($graphics['container_6'] != "") { ?>
                            <!--IMAGE -->
                            <div class="span6 center">
                                <?php if ($graphics['container_6'] ) { if($graphics['container_6']['slot_type'] == "f"){ ?>                       
                                    <div class='image_vertical_layout'>
                                        <img src="/media/user/images/original/<?php echo $graphics['container_6']['foto'] ?>"/>
                                    </div>
                                 <?php  }else{ ?>
                                    <div class="container_bannerhtml_loader">
                                        <div class="canvas_stage<?php echo $graphics['container_6']['id'] ?>" id="stage"></div>
                                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_6']["cool"] ?>', '<?php echo $graphics['container_6']["id"] ?>')</script>
                                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_6']["altura"] ?>','<?php echo $graphics['container_6']["largura"] ?>', '<?php echo $graphics['container_6']["id"] ?>');</script> 
                                    </div>
                                <?php  } } ?>
                            </div>
                            <!-- END IMAGE -->
                            <?php } ?>

                            <!-- FEATURE -->
                            <div class="<?php if ($graphics['container_6'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                                <?php if($text['titulo_06'] != '' || $text['texto_06'] != ''){ ?>
                                <h2 class="titulo tit_size"><?php echo $text['titulo_06'] ?></h2>
                                <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_06'] ?></h4>
                                <p class="lead"><?php echo nl2br($text['texto_06']) ?></p>
                                <?php } ?>

                            </div>
                            <!--END:  FEATURE -->
                            <?php if($text['titulo_06'] != '' || $text['texto_06'] != ''){ ?>
                            <div class="span12">
                                <hr class="half"/>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ################ -->
                    <!-- END: CONTAINER  FEATURE -->
                    <!-- ################ -->

                    <!-- ################ -->
                    <!-- COMPONENTS -->
                    <!-- ################ -->
                    <?php foreach($rows as $values){
                        if(isset($values['content']) && isset($values['content']['url'])) $this->renderPartial("/site/modulos/" . $values['content']['url'] . $values['info']['modelo'] . "/" .  $values['info']['cool'], $values['content']);
                    } ?>
                    <!-- ################ -->
                    <!-- END COMPONENTS -->
                    <!-- ################ -->

                </div>
                    
            </div>
        </div>
    </div>
    <!--[END] MAIN WRAPPER-->
</div>

<input type="hidden" value="site" id="helper_local_logout"/>
<?php  include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>