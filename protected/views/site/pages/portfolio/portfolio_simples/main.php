<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>
<!--START MAIN-WRAPPER--> 
<div class="main-wrapper">
    
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
        

    <div id="portfolio_simples" class="container pan">
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
                <hr class="half"/>
            </div>
            <?php } ?>
            <!--END: TITLE-->
            
            <?php if($categoria_info){ if($categoria_info['container_1'] != ''){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <?php if(isset($categoria_info['container_1']['container']['foto'])){ ?> 
                    <img src="]<?php echo $path_image . $categoria_info['container_1']['container']['foto'] ?>" alt="<?php echo $categoria_info['container_1']['container']['titulo'] ?>" title="<?php echo $categoria_info['container_1']['container']['titulo'] ?>" class="mgT"/> 
                    <p>&nbsp;</p>
                    <?php } ?>
                    <?php //if(isset($categoria_info['container_1']['container']['titulo'])) echo $categoria_info['container_1']['container']['titulo']; ?>                                
                </div>
            </div>
            <?php }} ?>
            
            <div class="row-fluid hide">
                <div id="bt_menu_portfolio_retratil" class="cat-title-solid mgB mgT"></div>
                <hr class="half2" />
                <div id="menu_portfolio" class="row-fluid">
                    <div class="span12">
                        <?php include Yii::app()->getBasePath() . '/views/site/pages/portfolio/menu/menu_simples.php'; ?> 
                    </div>
                </div>
            </div>
        
            <div class="row-fluid mgT2">
                
                <div class="span12">
                    <?php $adQtd = count($ads); if ($ads && $adQtd > 0){ $w = 0; $p = 0; ?>
                    <div class="row-fluid carousel-holder mgB2">

                        <div class="span12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <?php if($adQtd > 1){ ?>
                                <ol class="carousel-indicators">
                                    <?php for($mn =0; $mn < count($ads); $mn++){ ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $mn ?>" <?php if($mn == 0) echo "class='active'"; ?>></li>
                                    <?php } ?>
                                </ol>
                                <?php } ?>
                                <div class="carousel-inner">                                       
                                    <?php foreach ($ads as $values){ ?> 
                                    <?php if($values['size'] == 'html_banners'){ ?>
                                    <div class="item <?php if($w == 0) echo 'active';?>">
                                        <div class="thumbnails center">
                                            <div class="thumbnail">
                                                <img class="" src="<?php echo $path_image .$values['info']['cool2']['image1']['src'] ?>" alt="">
                                            </div>
                                        </div>                                    
                                    </div>
                                    <?php }$w++;} ?>
                                </div>
                                <?php if($adQtd > 1){ ?>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-chevron-left carArrow"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-chevron-right carArrow"></span>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                    
                    
                    <?php if ($content && count($content) > 0){?>   
                    <?php foreach ($content as $values){ ?> 

                    <div class="row-fluid mgB2">
                        <div class="span5">
                            <div class="row-fluid">
                                <div class="owl-item">
                                    <div class="item animated flipInX in">
                                        <div class="img-style-1">
                                            <div class="owl-img-wrapper owl-img-zoom2">
                                                <img src="<?php if($values['image_0'] != ""){echo $path_image .$values['image_0'];}else{echo "/media/images/layout/missing/missing_120x120.png";} ?>" alt="" class="img-responsive">
                                                <div class="owl-img-overlay"></div>
                                                <div class="Button owl-img-pops-effect3">
                                                    <span class="owl-img-pops">
                                                        <a data-footer="<?php echo $values['descricao_resumo'] ?>" data-gallery="imagesizes" data-title="<?php echo $values['nome'] ?>" data-toggle="lightbox" href="<?php if($values['image_0'] != ""){echo $path_image .$values['image_0'];}else{echo "/media/images/layout/missing/missing_120x120.png";} ?>">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </span>
                                                    <span class="owl-img-pops">
                                                        <a href="/portfolio/<?php echo $values['url'] ?>">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                        <div class="span7">
                            <div class="caption-ecommerce">
                                <h2><?php echo $values['nome'] ?></h2>
                                <p class="texto lead"><?php echo $values['descricao_resumo'] ?></p>
                                <div class="ratings mgB2">
                                    <p>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star-empty"></span>
                                    </p>
                                </div>
                                
                                <a href="/portfolio/?i=<?php echo $values['url'] ?>">
                                    <input type="button" class="botao btn-main" value="ver detalhes"/>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                    <?php }} else { ?>
                    <div class="center">
                        <div class="mgFooter"></div>
                        <strong class="texto"><?php echo Yii::t('messageStrings', 'message_result_no_products_found'); ?></strong>
                    </div>
                    <?php } ?>
                    
                    
                </div>
                
                
            </div>
            
            
        </div>
    </div>

    <div class="row-fluid">
        <div class="container pan">
            <?php if(isset($descricao_categoria['descricao'])){ ?>
            <div class="cntCategoria"><?php echo nl2br($descricao_categoria['descricao']) ?></div>
            <?php } ?>            
        </div>
    </div>
    
    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
    
    <!--[END] MAIN WRAPPER-->
</div>


<div class="mgFooter"></div>
<input type="hidden" id="helper" value="" data-js-action="main"/>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php  include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>