<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<!--START MAIN-WRAPPER--> 
<div class="main-wrapper" data-template="ecommerce_simple_html5">
    
    <?php if(Yii::app()->params['pier_cotacoes']){ include Yii::app()->getBasePath() . '/views/site/pages/produtos/general/barra_austin.php'; } ?>
    
    <div class="container pan" data-template="ecommerce_simple_html5">
        <div class="pan_shadow">            
        
            <div class="mgL mgR">
                <p>&nbsp;</p>
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
                        <img src="/media/user/images/original/<?php echo $categoria_info['container_1']['container']['foto'] ?>" alt="<?php echo $categoria_info['container_1']['container']['titulo'] ?>" title="<?php echo $categoria_info['container_1']['container']['titulo'] ?>" class="mgT"/> 
                        <p>&nbsp;</p>
                        <?php } ?>
                        <?php //if(isset($categoria_info['container_1']['container']['titulo'])) echo $categoria_info['container_1']['container']['titulo']; ?>                                       
                    </div>
                </div>
                <?php }} ?> 

                <div class="row-fluid">
                    <?php if(count($menu_ecommerce)){ ?>
                    <div class="span3">
                        <?php include Yii::app()->getBasePath() . '/views/site/pages/produtos/comum/menu/menu_produtos_html5.php'; ?> 
                        <?php include Yii::app()->getBasePath() . "/views/site/common/banner/features/container_blocks_vertical.php"; ?>    
                    </div>
                    <?php } ?>

                    <div class="<?php if(count($menu_ecommerce)){ ?>span9<?php }else{ ?>span12<?php } ?>">
                        <div class="row-fluid">
                            <div class="container_bread_crumb">
                                <a href="/home" class="item_bread_span">Home</a>
                                <div class="arrow_divider"></div>
                                <a href="/produtos" class="item_bread_span">Produtos</a>
                                <div class="arrow_divider"></div>
                                <a href="/produtos/<?php echo strtolower($bread_crumb['cat_url']) ?>" class="item_bread_span"><?php echo $bread_crumb['cat_string'] ?></a>
                                <?php if ($bread_crumb['subcat_string'] != "") { ?><div class="arrow_divider"></div><?php } ?>
                                <a <?php if ($bread_crumb['subitem_string'] != "") { ?>href="/produtos/<?php echo strtolower($bread_crumb['cat_url']) ?>/<?php echo strtolower($bread_crumb['subcat_url']) ?>"<?php } ?>class="item_bread_span"><?php echo $bread_crumb['subcat_string'] ?></a>
                                <?php if ($bread_crumb['subitem_string'] != "") { ?><div class="arrow_divider"></div><?php } ?>
                                <span  class="item_bread_span"><?php echo $bread_crumb['subitem_string'] ?></span>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="title_category">
                                <h2 class="titulo"><?php if ($bread_crumb['subitem_string'] != "") { echo $bread_crumb['subitem_string']; } else if ($bread_crumb['subcat_string'] != "" && $bread_crumb['subitem_string'] == "") {echo $bread_crumb['subcat_string']; } else {echo $bread_crumb['cat_string'];} ?></h2>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <form id="search_produto_page" action="/produtos/search_produtos">
                                <div class="span1 mgT">
                                    <span class="badge">Filtro</span>
                                </div>
                                <div class="span4 center">
                                    <select class="span10 txt_plus0" name="categoria">
                                        <option value="0">Escolha uma categoria</option>
                                        <?php foreach ($menu_ecommerce as $values){?>
                                        <option value="<?php echo $values['id_categoria'] ?>" <?php if(isset($categoria_produto) && $categoria_produto != ''){ if($categoria_produto == $values['id_categoria'])echo 'selected';} ?>><?php echo $values['categoria_label'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="span4 center">
                                    <input type="text" placeholder="Palavra-chave" class="span12 txt_plus0" name="keywords" value="<?php if(isset($keywords) && $keywords != '') echo $keywords; ?>"/>
                                </div>
                                <div class="span3 center">
                                    <input type="button" value="buscar" class="botao btn-main bt_search_produto" data-form="search_produto_page"/>
                                </div>
                            </form>
                            <div class="clear"></div>
                            <div class="divider_horizontal mgT mgB"></div>
                        </div>
                        <?php $adQtd = 0; foreach ($ads as $values){ if($values['size'] == 'html_banners' || $values['size'] == 'html_lonsdale'){$adQtd++;} }?> 
                                       
                        <?php if ($ads && $adQtd > 0){ $w = 0; $p = 0; ?>
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
                                                    <img src="<?php echo '/media/user/images/original/' .$values['info']['cool2']['image1']['src'] ?>" alt="">
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


                        <?php if ($content && count($content) > 0){ $p = 0;?>   
                        <?php foreach ($content as $values){ ?> 

                        <?php if($p==0){ ?>
                        <div class="row-fluid mgB2">
                        <?php } ?>
                            <div class="span4">
                                <div class="thumbnails pp_square hProduct">
                                    <a href="/produtos/<?php echo $values['url'] ?>">
                                        <div class="ctn_picture">
                                            <img src="<?php if($values['image_0'] != ""){echo "/media/user/images/original/" .$values['image_0'];}else{echo "/media/images/layout/missing/missing_120x120.png";} ?>" alt="">
                                        </div>                            
                                        <div class="caption-ecommerce">
                                            <?php if(Yii::app()->params['produtos_preco']){ ?>
                                            <h4 class="pull-right"><?php echo $values['preco_real_string'] ?></h4>
                                            <?php } ?>
                                            <?php if($values['referencia'] != ''){ ?><p class="tItem center mg0 bold"><?php echo $values['referencia'] ?></p><?php } ?>
                                            <h4><?php echo $values['nome'] ?></h4>
                                            <p><?php echo $values['descricao_resumo'] ?></p>
                                        </div>
                                    </a>
                                    <?php if(Yii::app()->params['pier_cotacoes']){ ?>
                                    <div class="row-fluid">
                                        <button class="botao btn-main left btn-lg btn-block bt_consultar mgB mgT" type="button" data-toggle="modal" data-target="#sob_consulta" data-item="<?php echo $values['nome'] ?>" data-id="<?php echo $values['id'] ?>" data-valor="<?php echo $values['preco_real'] ?>"><i class="fa fa-plus mgR"></i>cotar</button>
                                    </div>                                        
                                    <?php } ?>
                                    
                                    <?php if(Yii::app()->params['produtos_ratings']){ ?>
                                    <hr class="half2"/>
                                    <div class="ratings">
                                        <p class="pull-right"><i class="fa fa-comments mgR0"></i><span class="badge"><?php echo $values['nr_comentarios'] ?></span></p>
                                        <p <?php if($values['reputation'] == 10){ echo "class='hide'";} ?>>                                                
                                            <span class="fa <?php if($values['reputation'] >= 1){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                            <span class="fa <?php if($values['reputation'] >= 2){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                            <span class="fa <?php if($values['reputation'] >= 3){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                            <span class="fa <?php if($values['reputation'] >= 4){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                            <span class="fa <?php if($values['reputation'] >= 5){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                        </p>
                                    </div>  
                                    <?Php } ?>
                                    
                                </div>
                            </div>
                        <?php $p++; if($p >=3){ $p=0;?>
                        </div>
                        <?php } ?>

                        <?php } ?>

                        <div class="clear mgB"></div>
                        <div class="row-fluid">
                            <?php include Yii::app()->getBasePath() . '/views/site/common/menu/paginacao/paginador_html5.php'; ?>
                            <p>&nbsp;</p>
                        </div>


                        <?php } else { ?>
                        <div class="center">
                            <div class="mgFooter"></div>
                            <strong class="texto"><?php echo Yii::t('messageStrings', 'message_result_no_products_found'); ?></strong>
                            <div class="mgFooter"></div>
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
        <div class="mgFooter"></div>
    </div>
    <!--[END] MAIN WRAPPER-->    
</div>



<input type="hidden" id="helper" value="<?php echo $id_page ?>" data-js-action="main"/>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php  include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>