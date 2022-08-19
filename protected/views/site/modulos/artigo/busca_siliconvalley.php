<div id="busca_siliconvalley_<?php echo $id ?>" class="fullCP">
    <link rel="stylesheet" href="/css/site/modulos/artigo/registros.css" type="text/css" media="screen" />
    <div class="row-fluid">
      <div class="container fullCT">
            <div id="busca_siliconvalley_step_1">
                <?php if($image_1 != ''){ ?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="thumbnails center">
                            <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                            <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" />
                            <?php if($link_1 != ''){ ?></a><?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
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
                        </div>            
                    </div>        
                </div>
                <div class="row-fluid">                
                    <form>
                        <div class="span10">
                            <div class="input_support_rb">
                                <span class="www_box left hide_resp">www.</span>
                                <input type="text" placeholder="Digite o site que deseja verificar" id="dominio_responsivo_input" class="input_box_sub">
                            </div>                        
                        </div>
                        <div class="span2 center">
                            <button id="bt_check_responsive" class="domain-registration-submit" type="button"><i class="fa fa-google mgR"></i>Verificar</button>
                        </div>                    
                    </form>               
                </div>
                <div class="row-fluid center mgT mgB">
                    <div class="span12">
                        <a class="domain-registration-action link" href="http://g1.globo.com/tecnologia/noticia/2015/04/google-passa-esconder-sites-descalibrados-com-o-mundo-movel.html" target="_blank"><span>Leia: Google esconderá sites não responsivos de suas buscas</span></a>
                    </div>                
                </div>
                <div class="row-fluid mgB2">
                    <div class="span12 center">
                        <img src="/media/images/logos/google.png" alt="Logo Google" />
                    </div>
                </div>
            </div>
            <div id="busca_siliconvalley_step_2">
                <div class="row-fluid center">
                    <h2>Se o seu site é otimizado para os dispositivos móveis, Parabéns!</h2>
                    <h4>Caso seu site não seja otimizado para celulares e tablets, clique abaixo e peça um orçamento.</h4>
                </div>
                <hr class="half" />
                <div class="row-fluid center mgT mgB">
                    <div class="span12">
                        <button id="bt_back_responsive" class="btn btn-second btn-large mgR" type="button">Analisar outro site</button>
                        <a href="/orcamento"><button class="btn btn-success btn-large" type="button">Pedir Orçamento</button></a>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>