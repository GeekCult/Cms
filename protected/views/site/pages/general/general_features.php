<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan" data-template="general_features">
    
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
            </ul>
        </div>
        <?php } ?>
        
        <!--TITLE-->
        <?php if($page_prop['gel_fr_initial'] != '' || $text['titulo'] != ''){ ?>
        <div class="row-fluid">   
            <h1 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h1>
            <p class="standart-ptitle bold"><?php echo $text['titulo'] ?></p>
            <div class="divider_horizontal mgB2"></div>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>
    

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="1">
        <div class="mgL mgR">
            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_1'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_01'] != '' || $text['texto_01'] != ''){ ?>
                <h2><?php echo $text['titulo_01'] ?></h2>
                <h4><?php echo $text['subtitulo_01'] ?></h4>
                <hr class="half"/>
                <p class="lead"><?php echo nl2br($text['texto_01']) ?></p>
                <?php } ?>
            </div>
            <!--END:  FEATURE -->
            <?php if ($graphics['container_1'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
                <?php if ($graphics['container_1'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='image_vertical_layout mgT pp_square'>
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
            <!-- END IMAGE -->
            <?php } ?>
            <?php if($text['titulo_01'] != '' || $text['texto_01'] != ''){ ?>
            <div class="span12">
                <hr class="half"/>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->


    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="2">
        <div class="mgL mgR">
            <?php if ($graphics['container_2'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
                <?php if ($graphics['container_2'] ) { if($graphics['container_2']['slot_type'] == "f"){ ?>                       
                        <div class='image_vertical_layout pp_square'>
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

            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_2'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_02'] != '' || $text['texto_02'] != ''){ ?>
                <h2><?php echo $text['titulo_02'] ?></h2>
                <h4><?php echo $text['subtitulo_02'] ?></h4>
                <hr class="half"/>
                <p class="lead"><?php echo nl2br($text['texto_02']) ?></p>
                <?php } ?>
            </div>
            <!--END:  FEATURE -->
            <?php if($text['titulo_02'] != '' || $text['texto_02'] != ''){ ?>
            <div class="span12">
                <hr class="half"/>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="3">
        <div class="mgL mgR">
            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_3'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_03'] != '' || $text['texto_03'] != ''){ ?>
                <h2><?php echo $text['titulo_03'] ?></h3>
                <h4><?php echo $text['subtitulo_03'] ?></h4>
                <hr class="half"/>
                <p class="lead"><?php echo nl2br($text['texto_03']) ?></p>
                <?php } ?>
            </div>
            <!--END:  FEATURE -->
            <?php if ($graphics['container_3'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
            <?php if ($graphics['container_3'] ) { if($graphics['container_3']['slot_type'] == "f"){ ?>                       
                    <div class='image_vertical_layout pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_3']['foto'] ?>"/>
                    </div>
                 <?php  }else{ ?>
                    <div class="container_bannerhtml_loader">
                        <div class="canvas_stage<?php echo $graphics['container_3']['id'] ?>" id="stage"></div>
                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_3']["cool"] ?>', '<?php echo $graphics['container_3']["id"] ?>');</script>
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
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="4">
        <div class="mgL mgR">
            <?php if ($graphics['container_4'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
                <?php if ($graphics['container_4'] ) { if($graphics['container_4']['slot_type'] == "f"){ ?>                       
                    <div class='image_vertical_layout pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_4']['foto'] ?>"/>
                    </div>
                 <?php  }else{ ?>
                    <div class="container_bannerhtml_loader">
                        <div class="canvas_stage<?php echo $graphics['container_4']['id'] ?>" id="stage"></div>
                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_4']["cool"] ?>', '<?php echo $graphics['container_4']["id"] ?>');</script>
                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_4']["altura"] ?>','<?php echo $graphics['container_4']["largura"] ?>', '<?php echo $graphics['container_4']["id"] ?>');</script> 
                    </div>
                <?php  } } ?>
            </div>
            <!-- END IMAGE -->
            <?php } ?>

            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_4'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_04'] != '' || $text['texto_04'] != ''){ ?>
                <h2><?php echo $text['titulo_04'] ?></h2>
                <h4><?php echo $text['subtitulo_04'] ?></h4>
                <hr class="half"/>
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
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="5">
        <div class="mgL mgR">
            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_5'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_05'] != '' || $text['texto_05'] != ''){ ?>
                <h2><?php echo $text['titulo_05'] ?></h3>
                <h4><?php echo $text['subtitulo_05'] ?></h4>
                <hr class="half"/>
                <p class="lead"><?php echo nl2br($text['texto_05']) ?></p>
                <?php } ?>
            </div>
            <!--END:  FEATURE -->
            <?php if ($graphics['container_5'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
            <?php if ($graphics['container_5'] ) { if($graphics['container_5']['slot_type'] == "f"){ ?>                       
                    <div class='image_vertical_layout pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_5']['foto'] ?>"/>
                    </div>
                 <?php  }else{ ?>
                    <div class="container_bannerhtml_loader">
                        <div class="canvas_stage<?php echo $graphics['container_5']['id'] ?>" id="stage"></div>
                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_5']["cool"] ?>', '<?php echo $graphics['container_5']["id"] ?>');</script>
                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_5']["altura"] ?>','<?php echo $graphics['container_5']["largura"] ?>', '<?php echo $graphics['container_5']["id"] ?>');</script> 
                    </div>
                <?php  } } ?>
            </div>
            <!-- END IMAGE -->
            <?php } ?>
            <?php if($text['titulo_05'] != '' || $text['texto_05'] != ''){ ?>
            <div class="span12">
                <hr class="half"/>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid" data-item="6">
        <div class="mgL mgR">
            <?php if ($graphics['container_6'] != "") { ?>
            <!--IMAGE -->
            <div class="span6 center">
                <?php if ($graphics['container_6'] ) { if($graphics['container_6']['slot_type'] == "f"){ ?>                       
                    <div class='image_vertical_layout pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_6']['foto'] ?>"/>
                    </div>
                 <?php  }else{ ?>
                    <div class="container_bannerhtml_loader">
                        <div class="canvas_stage<?php echo $graphics['container_6']['id'] ?>" id="stage"></div>
                        <script type="text/javascript">addBannerHTML('<?php echo $graphics['container_6']["cool"] ?>', '<?php echo $graphics['container_6']["id"] ?>');</script>
                        <script type="text/javascript">setSizeBanner('<?php echo $graphics['container_6']["altura"] ?>','<?php echo $graphics['container_6']["largura"] ?>', '<?php echo $graphics['container_6']["id"] ?>');</script> 
                    </div>
                <?php  } } ?>
            </div>
            <!-- END IMAGE -->
            <?php } ?>

            <!-- FEATURE -->
            <div class="<?php if ($graphics['container_6'] != "") { ?> span6 <?php }else{ ?> span12 <?php } ?>">
                <?php if($text['titulo_06'] != '' || $text['texto_06'] != ''){ ?>
                <h2><?php echo $text['titulo_06'] ?></h2>
                <h4><?php echo $text['subtitulo_06'] ?></h4>
                <hr class="half"/>
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
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->
    
    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
    
    <div class="mgFooter"></div>
    
</div>
<!-- ################ -->
<!--END: CONTENT CONTAINER-->
<!-- ################ -->

<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . "/views/site/common/footer/{$plataform}/{$preferences['rodape_tipo']}.php"; ?>