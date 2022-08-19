<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<link rel="stylesheet" type="text/css" href="/css/site/modulos/sharebar/share_bar_complex.css" />

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan">
    
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if($page_prop['gel_fr_initial'] != ""){ ?>
        <!--TITLE-->
        <div class="row-fluid">   
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>
            <p class="standart-ptitle"><?php echo $text['titulo'] ?></p>
            <div class="divider_horizontal mgB2"></div>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>
    
    <div class="mgR mgL">

        <!-- ################ -->
        <!-- CONTAINER  FEATURE -->
        <!-- ################ -->
        <?php if ($text['titulo_01'] != '' || $text['texto_01'] != '') { ?>
        <div class="row-fluid">

            <!-- FEATURE -->
            <div class="span12">

                <h3 class="standart-h2title"><?php echo $text['titulo_01'] ?></h3>
                <hr class="half"/>
                <p class="lead"><?php echo nl2br($text['texto_01']) ?></p>

            </div>
        </div>
        <?php } ?>

        <!-- ################ -->
        <!-- CONTAINER  MATERIA -->
        <!-- ################ -->
        <?php if($materia_selecionada != false) { ?> 
        <div class="row-fluid">
            <div class="span12">
                <div class="span9">
                    <div class="title_materia">
                        <h2><?php echo $materia_selecionada['titulo'] ?></h2>
                    </div>
                    <div class="divider_horizontal"></div>
                    <h3><?php echo nl2br($materia_selecionada['subtitulo']); ?></h3>
                    <div class="dataMateria subtitulo"><?php echo Yii::t("siteStrings", "label_uptodate"); echo $materia_selecionada['last_update_string']; ?></div>
                    <div class="clear"></div>
                    <?php if($materia_selecionada['container_1'] != ""){ ?> 
                    <div class="thumbs container_image_materia center" id="container_image_helper">

                        <?php if(!isset($materia_selecionada['graphic']['container']['embeded'])){ ?>                 
                            <img src="<?php echo $materia_selecionada['picture']; ?>" id="slot_picture90" alt="missing" title="<?php echo $materia_selecionada['titulo']; ?>" class="hgtSize_<?php echo $page_prop['mat_lk_rcn_img'] ?>"/>
                        <?php }else{ ?>                       
                            <div class="txt_center">
                                <?php echo $materia_selecionada['graphic']['container']['ficha_tecnica'] ?>
                                <div class="clear"></div>
                            </div>                       
                        <?php } ?>                   

                    </div>  
                    <div class="title_materias_down">Titulo: <?php if(isset($materia_selecionada['graphic']['container']['titulo'])){echo $materia_selecionada['graphic']['container']['titulo'];}else{echo $materia_selecionada['titulo'];} ?></div>
                     <?php } ?>
                    <div class="clear"></div>
                    <?php include Yii::app()->getBasePath() . '/views/site/modulos/sharebar/font_size.php'; ?>
                    <div class="clear"></div>
                    <?php include Yii::app()->getBasePath() . '/views/site/modulos/sharebar/share_bar_complex2.php'; ?>
                    <div class="textMateria texto"><?php echo nl2br($materia_selecionada['materia']); ?></div>

                    <div class="clear"></div>
                    <div id="loader_barshare2">                     
                        
                        
                        
                    </div>
 
                    <div class="clear"></div>
                    <?php if(isset($componentes) && ($componentes && count($componentns) > 0)){ ?>
                        <div class="mgT2"></div>
                        <div class="row-fluid">
                        <?php for($i = 0; $i < count($componentes); $i++){ ?>                    
                        <?php echo $this->renderPartial('/site/modulos/materias/special/' . $componentes[$i]['content']['url'] . $componentes[$i]['info']['modelo'] . '/' . $componentes[$i]['info']['cool'], $componentes[$i]['content']); ?>
                        <?php } ?>
                        </div>
                        <div class="clear"></div>
                    <?php } ?>
                        
                    <div class="divider_shadow"></div>
                    <div class="clear"></div>
                    <div class="left ">
                        <input type="button" class="botao btn-main" value="indicar amigo" data-toggle="modal" data-target="#indique_modal"/>
                    </div>
                    <a href="/blog/" class="right">
                        <input type="button" class="botao btn-second" value="voltar"/>
                    </a>
                    <div class="clear mgB2"></div>                    
                    <div class="divider_horizontal"></div>
                    <p>&nbsp</p>
                    <a name="postar_comentario"></a>
                    <div class="container_comentarios_html5">
                        <div class="comentarios_title">
                            <h1><?php echo Yii::t("siteStrings", "common_comment");?></h1>
                            <div class="comentarios_subtitle"><?php echo Yii::t("siteStrings", "common_comment_subtitle");?></div>
                        </div>
                        <div id="loaderComment">
                            <?php $this->renderPartial("/site/components/comentarios/comment_responsive", $comentarios);  ?> 
                        </div>
                            

                        <div>       
                            <input type="text" value="" class="comment_name<?php echo $materia_selecionada['id']; ?> span12" placeholder="<?php echo Yii::t("siteStrings", "label_name");?>"/>
                            <input type="email" value="" class="comment_email<?php echo $materia_selecionada['id']; ?> span12" placeholder="<?php echo Yii::t("siteStrings", "label_email");?>"/>

                            <textarea rows="4" class="comment_message<?php echo $materia_selecionada['id']; ?> span12" placeholder="<?php echo Yii::t("siteStrings", "label_comments");?>"></textarea>

                            <div class="label_checkbox_email">
                                <input type="checkbox" class="comentario_checkbox" name="no_email" checked/>
                                <span class="label_checkbox texto"><?php echo Yii::t("siteStrings", "common_no_show_email");?></span>
                            </div>                                       
                            <div id="output_contact"></div>
                            <div id="label_comentarios">&nbsp;</div>
                            <div id="output_contact"></div>
                            <div class="clear"></div>
                            <input type="button" value="comentar" class="submit_comment botao btn-main" id="<?php echo $materia_selecionada['id']; ?>"/>
                                 
                        </div>
                    </div>
                    <div class="container_comentarios_sent">
                        <div class="message_result_comment"><?php echo Yii::t("siteStrings", "message_result_sent");?></div>                        
                    </div>
                    
                    
                </div>
                <div class="span3">                    
                    <?php include Yii::app()->getBasePath() . "/views/site/common/banner/features/container_blocks_vertical.php"; ?>    
                    <div class="menuMateria">
                        <ul>
                            <li>
                                <h4>Veja mais [+]</h4>
                            </li>
                            <?php if($links_recomendados && count($links_recomendados) > 0){foreach($links_recomendados as $values) { ?>
                            <li>                            
                                <div class="truncate">
                                    <a href="<?php echo "/noticias/listar/" . $values['id'] ?>"><?php echo $values['titulo'] ?></a>
                                </div>                          
                            </li>
                            <?php }} ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

            <hr class="half"/>
        </div>

        <div class="row-fluid">

            <div class="span12">        
                <?php $i = 0; if($links_recomendados && count($links_recomendados) > 0){foreach($links_recomendados as $values){ if($i < $page_prop['mat_lk_rcn_blc']){ ?>
                <div class="span3">
                    
                    <div class="container_block_quarter">
                        <h4 class="title_noticias"><?php echo $values['titulo'] ?></h4>
                        <div class="row-fuid">
                            <div class="thumb image_noticias">
                                <?php if(isset($values['slot_type']) && ($values['slot_type'] == "f" && $values['container_1']['foto'] != "")){ ?>
                                <img src="/media/user/images/thumbs_350/<?php echo $values['container_1']['foto'] ?>" alt="<?php echo $values['container_1']['foto'] ?>"/>
                                <?php } else if(isset($values['slot_type']) && ($values['slot_type'] == "e" && isset($values['container_1']['embeded']))){ ?>
                                <a href="/noticias/listar/<?php if(isset($values['id'])) echo $values['id'] ?>/<?php if(isset($values['url_title'])) echo $values['url_title'] ?>">
                                    <div style="width: 200px; height: 100px; position: absolute;"></div>
                                    <?php echo $values['container_1']['embeded_medium'] ?>                                    
                                </a>
                                <div class="logo_getty_images_mini"></div>
                                <?php } else { ?>
                                <img src="/media/images/layout/missing/missing_350x150.jpg" alt="missing" title="<?php echo Yii::t("messageForm", "message_no_picture"); ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="data_noticias"><?php echo $values['data'] ?></div>
                        <div class="desc_noticias"><p class="lead"><?php echo nl2br($values['subtitulo']) ?></p></div>
                        <hr class="half" />
                        <div class="link_noticias"><a href="/noticias/listar/<?php echo $values['id'] ?>"><span class="badge"><?php echo Yii::t("siteStrings", "label_read_more");?></span></a></div>
                    </div>              

                    <div class="clear"></div>
                </div>
                <?php } $i++; }} ?>                        
                <div class="clear"></div>
            </div>
        </div>

        <?php } else { ?>
        <div class="result-message">
            <span><?php echo Yii::t("siteStrings", "label_columns_not_found");?></span>
        </div>
        <?php } ?>
    </div>
    
    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
    
    <div class="mgFooter"></div>
</div>
<input type="hidden" value="site" id="helper_local_logout"/>
<input type="hidden" value="materia" id="helper_tipo"/>
<input type="hidden" value="review" id="helper_tipo_reply"/>
<input type="hidden" value="<?php echo $materia_selecionada['id'] ?>" id="id_general"/>
<div class="hide">
<input type="hidden" id="helper_action" data-js-action="view" data-titulo-indicacao="<?php echo $materia_selecionada['titulo'] ?>" data-texto-indicacao="<?php echo $materia_selecionada['subtitulo'] ?>"/>
<img alt="<?php echo $materia_selecionada['picture']; ?>" src="<?php echo $materia_selecionada['picture']; ?>"/>
<link rel="image_src"  type="image/jpeg" href="<?php echo $materia_selecionada['picture']; ?>" />
</div> 
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/indique_amigo/modal_indique_amigo.php'; ?>



