<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<!--START MAIN-WRAPPER--> 
<div class="main-wrapper" data-template="autos_simples">
    <div class="container">
        <div class="pan_shadow">            
        
            <div class="mgL_resp mgR_resp">
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
                    <?php $menu_tipo = 'autos'; ?>
                    <?php if(count($menu_ecommerce)){ ?>
                    <div class="span3">
                        <?php include Yii::app()->getBasePath() . '/views/site/pages/produtos/comum/menu/menu_produtos_html5.php'; ?> 
                        <?php include Yii::app()->getBasePath() . "/views/site/common/banner/features/container_blocks_vertical.php"; ?>    
                    </div>
                    <?php } ?>

                    <div class="<?php if(count($menu_ecommerce)){ ?>span9 <?php }else{ ?>span12<?php } ?>">
                        <?php if(Yii::app()->params['pier_autos_busca']){ ?>
                        <div class="row-fluid container_menu_total_items mgB">
                            <div class="squarebox">
                                <div class="content">
                                    <form id="form-search_autos" action="/autos/search_autos">
                                        <div class="row-fluid">
                                            <div class="span9">                
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <label for="">Fabricante</label>
                                                        <select name="marca" id="marca" class="span12">
                                                            <option value="0">Selecione</option>
                                                            <?php foreach($fabricantes as $values){ ?>
                                                            <option value="<?php echo $values['id'] ?>" <?php if(isset($fabricante) && ($fabricante == $values['id'])) echo 'selected'; ?>><?php echo $values['nome'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="span4">
                                                        <label for="">Categoria</label>                                                    
                                                        <select name="" id="" class="span12">
                                                            <option value="0">Selecione</option>
                                                            <?php foreach($categorias as $values2){ ?>
                                                            <option value="<?php echo $values2['id_categoria'] ?>" <?php if($values2['id_categoria'] == $bread_crumb['cat']) echo 'selected' ?>><?php echo $values2['categoria_label'] ?></option>
                                                            <?php } ?>
                                                        </select>                                                                                                      
                                                    </div>
                                                    <div class="span2">
                                                        <label for="">Valor Mín</label>
                                                        <select name="valor_min" id="valor_min" class="span12">
                                                            <option value="0" <?php if(isset($valor_min) && ($valor_min == '' || $valor_min == '0')) echo 'selected' ?>>R$0,00</option>
                                                            <option value="500" <?php if(isset($valor_min) && $valor_min == '500') echo 'selected' ?>>R$500,00</option>
                                                            <option value="1000" <?php if(isset($valor_min) && $valor_min == '1000') echo 'selected' ?>>R$1.000,00</option>
                                                            <option value="2000" <?php if(isset($valor_min) && $valor_min == '2000') echo 'selected' ?>>R$2.000,00</option>
                                                            <option value="3000" <?php if(isset($valor_min) && $valor_min == '3000') echo 'selected' ?>>R$3.000,00</option>
                                                        </select>
                                                    </div>
                                                    <div class="span2">
                                                        <label for="">Valor Máx</label>
                                                        <select name="valor_max" id="valor_max" class="span12">
                                                            <option value="0" <?php if(isset($valor_min) && $valor_min == '') echo 'selected' ?>>---</option>
                                                            <option value="1000" <?php if(isset($valor_max) && $valor_max == '1000') echo 'selected' ?>>R$1.000,00</option>
                                                            <option value="2000" <?php if(isset($valor_max) && $valor_max == '2000') echo 'selected' ?>>R$2.000,00</option>
                                                            <option value="3000" <?php if(isset($valor_max) && $valor_max == '3000') echo 'selected' ?>>R$3.000,00</option>
                                                            <option value="100000" <?php if(isset($valor_max) && $valor_max == '100000') echo 'selected' ?>>R$100.000,00</option>
                                                            <option value="200000" <?php if(isset($valor_max) && $valor_max == '200000') echo 'selected' ?>>R$200.000,00</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <label for="">Modelo</label>
                                                        <div id="modelo_loader">                                                            
                                                            <select name="modelo" id="modelo" class="span12">                                                                
                                                                <option value="0" <?php if(isset($modelo)){if($modelo == 0) echo 'selected';} ?>><?php if(isset($modelo) && $modelo == '0'){ ?>---<?php } ?><?php if(!isset($modelo)){ ?>Selecione Fabricante<?php } ?></option>
                                                                <?php if(isset($modelo_veiculos)){  foreach ($modelo_veiculos as $values){  ?>
                                                                <option value="<?php echo $values['id'] ?>" <?php if(isset($modelo)){if($values['id'] == $modelo) echo 'selected';} ?>><?php echo $values['nome'] ?></option>
                                                                <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="span4">
                                                        <label for="">Combustível</label>
                                                        <select name="combustivel" id="combustivel" class="span12">
                                                            <option value="0" <?php if(isset($combustivel) && $combustivel == '')  echo 'selected' ?>>Selecione</option>
                                                            <option value="1" <?php if(isset($combustivel) && $combustivel == '1') echo 'selected' ?>>Gasolina</option>
                                                            <option value="2" <?php if(isset($combustivel) && $combustivel == '2') echo 'selected' ?>>Álcool</option>
                                                            <option value="3" <?php if(isset($combustivel) && $combustivel == '3') echo 'selected' ?>>Flex</option>
                                                            <option value="4" <?php if(isset($combustivel) && $combustivel == '4') echo 'selected' ?>>Diesel</option>
                                                            <option value="5" <?php if(isset($combustivel) && $combustivel == '5') echo 'selected' ?>>Híbrido</option>
                                                            <option value="0" <?php if(isset($combustivel) && $combustivel == '6') echo 'selected' ?>>Indiferente</option>
                                                        </select>
                                                    </div>
                                                    <div class="span2">
                                                        <label for="">Ano Inicial</label>
                                                        <select name="ano_inicial" id="ano_inicial" class="span12">
                                                            <option value="2000" <?php if(isset($ano_inicial) && $ano_inicial == '2000') echo 'selected' ?>>2000</option>
                                                            <option value="2001" <?php if(isset($ano_inicial) && $ano_inicial == '2001') echo 'selected' ?>>2001</option>
                                                            <option value="2002" <?php if(isset($ano_inicial) && $ano_inicial == '2002') echo 'selected' ?>>2002</option>
                                                            <option value="2003" <?php if(isset($ano_inicial) && $ano_inicial == '2003') echo 'selected' ?>>2003</option>
                                                            <option value="2004" <?php if(isset($ano_inicial) && $ano_inicial == '2004') echo 'selected' ?>>2004</option>
                                                            <option value="2005" <?php if(isset($ano_inicial) && $ano_inicial == '2005') echo 'selected' ?>>2005</option>
                                                            <option value="2006" <?php if(isset($ano_inicial) && $ano_inicial == '2006') echo 'selected' ?>>2006</option>
                                                            <option value="2007" <?php if(isset($ano_inicial) && ($ano_inicial == '2007' || $ano_inicial == '')) echo 'selected' ?>>2007</option>
                                                            <option value="2008" <?php if(isset($ano_inicial) && $ano_inicial == '2008') echo 'selected' ?>>2008</option>
                                                            <option value="2009" <?php if(isset($ano_inicial) && $ano_inicial == '2009') echo 'selected' ?>>2009</option>
                                                            <option value="2010" <?php if(isset($ano_inicial) && $ano_inicial == '2010') echo 'selected' ?>>2010</option>
                                                            <option value="2011" <?php if(isset($ano_inicial) && $ano_inicial == '2011') echo 'selected' ?>>2011</option>
                                                            <option value="2012" <?php if(isset($ano_inicial) && $ano_inicial == '2012') echo 'selected' ?>>2012</option>
                                                            <option value="2013" <?php if(isset($ano_inicial) && $ano_inicial == '2013') echo 'selected' ?>>2013</option>
                                                            <option value="2014" <?php if(isset($ano_inicial) && $ano_inicial == '2014') echo 'selected' ?>>2014</option>
                                                            <option value="2015" <?php if(isset($ano_inicial) && $ano_inicial == '2015') echo 'selected' ?>>2015</option>
                                                        </select>
                                                    </div>
                                                    <div class="span2">
                                                        <label for="">Ano Final</label>
                                                        <select name="ano_final" id="ano_final" class="span12">
                                                            <option value="2000" <?php if(isset($ano_final) && $ano_final == '2000') echo 'selected' ?>>2000</option>
                                                            <option value="2001" <?php if(isset($ano_final) && $ano_final == '2001') echo 'selected' ?>>2001</option>
                                                            <option value="2002" <?php if(isset($ano_final) && $ano_final == '2002') echo 'selected' ?>>2002</option>
                                                            <option value="2003" <?php if(isset($ano_final) && $ano_final == '2003') echo 'selected' ?>>2003</option>
                                                            <option value="2004" <?php if(isset($ano_final) && $ano_final == '2004') echo 'selected' ?>>2004</option>
                                                            <option value="2005" <?php if(isset($ano_final) && $ano_final == '2005') echo 'selected' ?>>2005</option>
                                                            <option value="2006" <?php if(isset($ano_final) && $ano_final == '2006') echo 'selected' ?>>2006</option>
                                                            <option value="2007" <?php if(isset($ano_final) && $ano_final == '2007') echo 'selected' ?>>2007</option>
                                                            <option value="2008" <?php if(isset($ano_final) && $ano_final == '2008') echo 'selected' ?>>2008</option>
                                                            <option value="2009" <?php if(isset($ano_final) && $ano_final == '2009') echo 'selected' ?>>2009</option>
                                                            <option value="2010" <?php if(isset($ano_final) && $ano_final == '2010') echo 'selected' ?>>2010</option>
                                                            <option value="2011" <?php if(isset($ano_final) && $ano_final == '2011') echo 'selected' ?>>2011</option>
                                                            <option value="2012" <?php if(isset($ano_final) && $ano_final == '2012') echo 'selected' ?>>2012</option>
                                                            <option value="2013" <?php if(isset($ano_final) && $ano_final == '2013') echo 'selected' ?>>2013</option>
                                                            <option value="2014" <?php if(isset($ano_final) && $ano_final == '2014') echo 'selected' ?>>2014</option>
                                                            <option value="2015" <?php if(isset($ano_final) && $ano_final == '2015') echo 'selected' ?>>2015</option>
                                                            <option value="2016" <?php if(isset($ano_final) && ($ano_final == '2016' || $ano_final == '')) echo 'selected' ?>>2016</option>                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3 center">
                                                <label for="">&nbsp;</label>
                                                <button  class="btn btn-main btn-xxlarge mgT" id="bt_autos_search">
                                                    Buscar&nbsp;
                                                    <i class="fa fa-search"></i>
                                                </button>

                                            </div>
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
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
                                    <a href="/autos/<?php echo $values['url'] ?>">
                                        <div>
                                            <img src="<?php if($values['image_0'] != ""){echo "/media/user/images/original/" .$values['image_0'];}else{echo "/media/images/layout/missing/missing_120x120.png";} ?>" alt="">
                                        </div>                            
                                        <div class="caption-ecommerce autos"> 
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <p class="txt_left bold"><?php if(isset($values['marca_string']['nome']))echo $values['marca_string']['nome'] ?></p>
                                                </div>
                                                <div class="span6">
                                                    <p class="right_resp"><?php echo $values['ano'] ?></p>
                                                </div>
                                            </div>
                                            <h4 class="center"><?php echo $values['nome'] ?></h4>
                                            <p class="center"><?php if(isset($values['modelo_string']['nome'])) echo $values['modelo_string']['nome'] ?></p>
                                            <p><?php echo $values['descricao_resumo'] ?></p>
                                            <hr class="half2"/>
                                            <h4 class="center"><?php echo $values['preco_real_string'] ?></h4>                                            
                                        </div>
                                    </a>
                                    
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
                            <strong class="texto"><?php echo Yii::t('messageStrings', 'message_result_no_autos_found'); ?></strong>
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