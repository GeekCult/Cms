<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?> 
<div class="container pan" data-template="portfolio_detalhes_simples">
    
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
      
    
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
        
        <div class="row-fluid">
            <div class="col-md-6 col-sm-push-6">
                <a href="/portfolio">
                    <button class="botao btn-second right_resp mgT mgB btn-full-resp"><i class="fa fa-arrow-circle-left mgR"></i><span>voltar</span></button>
                </a>                
            </div>           
            <div class="col-md-6 col-md-pull-6">
                <h1 class="no-margin"><?php echo $content['nome'] ?></h1>
            </div>
        </div>
        <div class="divider_horizontal mgB"></div>
        <p>&nbsp;</p>
        
        <div class="container_item_produto" id="container_produto_<?php echo $content['id'] ?>">
            <div class="row-fluid mgB2">
                
                    <div class="owl-item">
                        <div class="item animated flipInX in">
                            <div class="img-style-1">
                                <div class="owl-img-wrapper owl-img-zoom2">
                                    <div class="pp_square padding_10" id="main_picture_detail">
                                        <div class="center">
                                            <img src="<?php echo $path_image .$content['image_0'] ?>" title="<?php echo $content['nome'] ?>" id="slot_picture0"/>
                                        </div>

                                    </div>
                                </diV>
                            </div>
                        </div>
                    </div>
               
            </div>
            
            <div class="row-fluid">
                <div class="span12">
                    <?php if($content['image_1'] != ""){ ?>
                    <div class="thumbnails">
                        <?php for($i = 1; $i < 6; $i++){ ?>
                        <?php if($content['image_' . $i] != ""){ ?>
                        <div class="span3 pp_square center">
                            <img src="<?php echo $path_image . $content['image_' . $i] ?>" id="slot_picture<?php echo $i ?>" rel="<?php if($content['image_' . $i] != "") echo $content['image_' . $i] ?>" alt="<?php echo $content['image_' . $i] ?>" class="thumbnail_foto_produto_html5"/>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php if($content['image_1'] != ""){ ?>
                        <div class="span3 pp_square center">
                                <img src="<?php echo $path_image. $content['image_0'] ?>" id="slot_picture7" rel="<?php if($content['image_0'] != "") echo $content['image_0'] ?>" alt="<?php echo $content['image_0'] ?>" class="thumbnail_foto_produto_html5"/>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>                        
                </div>
            </div>
            <div class="row-fluid hProduct">
                <div class="span12">                                
                    <div class="destino">
                        <h2 class="destino"><?php echo $content['nome'] ?></h2>
                    </div>

                    <?php if($content['descricao_resumo'] != ''){ ?>
                    <p>&nbsp</p>
                    <div class="descricao">
                        <h3>Sobre</h3>
                        <p class="lead"><?php echo nl2br($content['descricao_resumo']) ?></p>
                    </div>
                    <?php } ?>
                    
                    <?php if($content['descricao'] != ''){ ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <h3>Descrição do produto</h3>
                            <p class="lead"><?php echo nl2br($content['descricao']) ?></p>
                             <p>&nbsp;</p>

                             <div class="divider_shadow"></div>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                    <?php } ?>

                    <hr class="half" />

                    <div class="buttons_right_site">
                        <input class="botao left btn-lg btn-main" type="button" value="indicar amigo" id="<?php echo $content['id'] ?>" data-toggle="modal" data-target="#indique_modal"/>
                        <!--<input class="bt_shopping_cart botao left" type="button" value="ver comentários" id="<?php //echo $content['id'] ?>"/> -->
                    </div>
                    <div class="bt_back_produtos mgT right_resp">
                        <a href="/portfolio">
                            <button class="botao btn-second right_resp mgT mgB btn-full-resp"><i class="fa fa-arrow-circle-left mgR"></i><span>voltar</span></button>
                        </a>
                    </div>
                    <div class="clear"></div>
                    <hr class="half" />
                </div>
            </div>

            <div class="clear"></div>
           
            
            <?php if(isset($content['video1']['big'])){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="titulo_descricao titulo"><b>Videos</b></div>
                    <p class="align_left"><?php if(isset($content['video1']['big'])) echo $content['video1']['big'] ?></p>
                     <p>&nbsp;</p>
                     <div class="divider_shadow"></div>
                    <p>&nbsp;</p>
                </div>
            </div>
            <?php } ?>
            <div class="row-fluid">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=348822858488121";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            </div>
            <div class="fb-comments" data-href="http://<?php echo $_SERVER['SERVER_NAME'] . $url ?>" data-numposts="5" data-colorscheme="light" data-version="v2.3" data-width="100%"></div>

        </div>             
    </div>
</div>

<?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>


<input type="hidden" id="helper_action" data-js-action="details" data-titulo-indicacao="<?php echo $content['nome'] ?>" data-texto-indicacao="<?php echo $content['descricao'] ?>"/>
<input type="hidden" id="helper" data-js-action="details"/>
<input type="hidden" id="helper_tipo" value="produto"/>
<input type="hidden" id="id_general" value="<?php echo $content['id'] ?>"/>

<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/indique_amigo/modal_indique_amigo.php'; ?>