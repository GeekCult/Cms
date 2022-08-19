<!-- Footer ================================================== -->
<footer class="footer" data-template="rodape_atenas">
    <?php if(!isset($preferences['rodape']['attr']['rodape_layout_pos']) || (isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == "" || $preferences['rodape']['attr']['rodape_layout_pos'] == 'tradicional')){ ?>
    <div class="ftMenu">  
        <div class="container">
            <div class="clear"></div>
            <p>&nbsp;</p>
            <div class="row-fluid transparent_black_60 padding_t_10">
                <div class="left mgR2 mgL2"><h2 class="mg0">Dúvidas</h2></div>

                <div class="mn3_line ftMn1 mgL2 mgT">
                    <div class="row-fluid">
                        <?php if(isset($preferences['menu3'])){foreach ($preferences['menu3'] as $valuesr) {?>
                        <div class="left mgR"><a class="link_mn2_line" href="/<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></div>
                        <?php  }} ?>
                    </div>
                </div>
            </div>
            <div class="mgB2"></div>          
                                        
                
            <?php if(count($preferences['menu2_categorias']) > 0){ ?>
            <div class="ftMn1">
                
            
            <?php $p = 0; $i = 0; $previous_id = $preferences['menu2_categorias'][0]['id_categoria']; foreach ($preferences['menu2_categorias'] as $valuesE) { ?>
            <?php if($i == 0){?><div class="row-fluid transparent_black_60 padding_t_10"><div class="left mgR2 mgL2"><h2 class="mg0"><?php echo $preferences['menu2_categorias'][0]['titulos']['nome']; ?></h2></div><?php } ?>


            <?php if($valuesE['id_categoria'] == $previous_id) { ?>
            <div class="left mgR mgT">
                <a class="link_mn2_line" href="/<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
            </div>
            <?php }else{ $p++;?>

            <div class=" <?php if($p >= 3) echo 'mg0R' ?>">
                
                <div class="mgB2"></div>
                <div class="row-fluid transparent_black_60 padding_t_10 mgT"><div class="left mgR2 mgL2"><h2 class="mg0"><?php if(isset($preferences['menu2_categorias'][$i]['titulos']['nome'])) echo $preferences['menu2_categorias'][$i]['titulos']['nome'] ?></h2></div>
                    <div class="left mgR">
                        <a class="link_mn2_line " href="/<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
                    </div>
                </div>
            <?php  }  ?>
            
            <?php $i++; ?>
            <?php $previous_id = $valuesE['id_categoria']; if(count($preferences['menu2_categorias']) == ($i)){ ?></div> <?php } } ?>
            <div class="mgB2"></div>
            </div>
            <?php } ?> 
                    
            
            <?php if($preferences['telefone_contato'] != '' || $preferences['email_contato'] != ''){ ?>
            <div class="row-fluid transparent_black_60 padding_t_10">
                <div class="left mgR2 mgL2"><h2 class="mg0">Atendimento</h2></div>
                <div class="ftMn1 mgL2 mgT">
                    <?php if($preferences['telefone_contato']){ ?>
                    <div class="left mgR2"><?php echo $preferences['telefone_contato'] ?></div>
                    <?php } ?>
                    <?php if($preferences['email_contato']){ ?>
                    <div><?php echo $preferences['email_contato'] ?>></div>
                    <?php } ?>
                </div> 
                <div class="clear"></div>
            </div>
            <div class="mgB2"></div>
            <?php } ?>
                
            <div class="row-fluid transparent_black_60 padding_t_10">
                <div class="left mgR2 mgL2"><h2 class="mg0">Encontre-nos</h2></div>
                <div class="ftMn1 mgL2 mgT">
                    <div class=""> 
                        <ul class="socialIcons XFN">

                            <?php if($preferences['facebook']){ ?>
                            <li class="facebook normal"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>" target="_blank">facebook </a></li>
                            <?php } ?>
                            <?php if($preferences['linkedin']){ ?>
                            <li class="linkedin normal"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>" target="_blank">linkedin </a></li>
                            <?php } ?>
                            <?php if($preferences['twitter']){ ?>
                            <li class="twitter normal"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>" target="_blank">twitter</a></li>
                            <?php } ?>
                            <?php if($preferences['pintrest']){ ?>
                            <li class="pinterest normal"><a href="https://www.pinterest.com/<?php echo $preferences['pintrest'] ?>" target="_blank">pinterest</a></li>
                            <?php } ?>
                            <?php if($preferences['instagram']){ ?>
                            <li class="instagram normal"><a href="https://www.instagram.com/<?php echo $preferences['instagram'] ?>" target="_blank">instagram</a></li>
                            <?php } ?>
                            <?php if($preferences['flickr']){ ?>
                            <li class="flickr normal"><a href="<?php echo $preferences['flickr'] ?>" target="_blank">flickr </a></li>
                            <?php } ?>
                            <?php if($preferences['google_plus']){ ?>
                            <li class="googleplus normal"><a href="<?php echo $preferences['google_plus'] ?>" target="_blank">googleplus</a></li>
                            <?php } ?>
                            <?php if($preferences['skype']){ ?>
                            <li class="skype normal"><a href="javascript:;" title="<?php echo $preferences['skype'] ?>" data-message="<?php echo $preferences['skype'] ?>" data-title="Nosso Skype" class="launcher_modal_message">Skype</a></li>
                            <?php } ?>
                            <?php if($preferences['canal_youtube']){ ?>
                            <li class="youtube normal"><a href="<?php echo $preferences['youtube'] ?>" target="_blank">youtube</a></li>
                            <?php } ?>
                            <?php if($preferences['rss']){ ?>
                            <li class="rss normal"><a href="<?php echo $preferences['rss'] ?>">rss </a></li>
                            <?php } ?>
                            <?php if($preferences['home']){ ?>
                            <li class="homeicon normal"><a href="<?php echo $preferences['home'] ?>">homeicon</a></li>
                            <?php } ?>
                            <?php if($preferences['telefone_contato']){ ?>
                            <li class="phone normal"><a href="javascript:;" title="<?php echo $preferences['telefone_contato'] ?>" data-message="<?php echo $preferences['telefone_contato'] ?>" data-title="Ligue agora" class="launcher_modal_message">Telefone</a></li>
                            <?php } ?>
                            <?php if($preferences['email_contato']){ ?>
                            <li class="email normal"><a href="mailto:<?php echo $preferences['email_contato'] ?>">email </a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mgB2"></div>
            
            <?php if(isset($preferences['rodape']['attr']['ft_image_1']) && $preferences['rodape']['attr']['ft_image_1'] != ''){ ?>
            <div class="row-fluid">
                <div class="span12 mgT2 mgB2">                    
                    <img src="/media/user/images/original/<?php echo $preferences['rodape']['attr']['ft_image_1'] ?>" alt="Publicidade"/>                    
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    
    <?php if((isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == 'ciclone')){ ?>
    <div class="ftMenu">  
        <div class="container">
            
            <div class="row-fluid">
                <div class="span12 mgT2">
                    <?php if(isset($preferences['rodape']['attr']['ft_image_1']) && $preferences['rodape']['attr']['ft_image_1'] != ''){ ?>
                    <div class="center pp_square">
                        <img src="/media/user/images/original/<?php echo $preferences['rodape']['attr']['ft_image_1'] ?>" alt="Publicidade"/> 
                    </div>                    
                    <?php } ?>
                </div>
            </div>
            

            <div class="row-fluid">
                <div class="span2">
                    <h4 class="line3 center standart-h4title"><span>Links Rápidos</span></h4>
                    
                    <div class="mn3_line ftMn1">
                        <ul class="container_mn2_line">
                            <?php if(isset($preferences['menu3'])){foreach ($preferences['menu3'] as $valuesr) {?>
                            <li><a class="link_mn2_line" href="/<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                            <?php  }} ?>
                        </ul>
                    </div>
                </div>
                
                <div class="span4">
                    <h4 class="line3 center standart-h4title"><span>Nosso escritório</span></h4>
                    <address class="hCard">
                        <strong> <?php echo Settings::CTT_COMPANY_NAME ?></strong><br>
                        <i class="fa-icon-map-marker"></i> <?php echo Settings::CTT_ENDERECO ?><br>
                        <?php echo Settings::CTT_CIDADE . ' / ' . Settings::CTT_ESTADO ?><br>
                        <i class="fa-icon-phone-sign"></i> <?php echo Settings::CTT_TEL_1 ?>
                        <div class="foot-line"></div>

                    </address>
                </div>
                <div class="span2">
                    <h4 class="line3 center standart-h4title"><span>Entre em contato</span></h4>

                    <div class="widget_nav_menu"> 
                        <ul class="socialIcons XFN">
               
                            <?php if($preferences['facebook']){ ?>
                            <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">facebook </a></li>
                            <?php } ?>
                            <?php if($preferences['linkedin']){ ?>
                            <li class="linkedin"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>">linkedin </a></li>
                            <?php } ?>
                            <?php if($preferences['twitter']){ ?>
                            <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">twitter</a></li>
                            <?php } ?>
                            <?php if($preferences['pintrest']){ ?>
                            <li class="pinterest"><a href="<?php echo $preferences['pintrest'] ?>">pinterest</a></li>
                            <?php } ?>
                            <?php if($preferences['flickr']){ ?>
                            <li class="flickr"><a href="<?php echo $preferences['flickr'] ?>">flickr </a></li>
                            <?php } ?>
                            <?php if($preferences['google_plus']){ ?>
                            <li class="googleplus"><a href="<?php echo $preferences['google_plus'] ?>">googleplus</a></li>
                            <?php } ?>
                            <?php if($preferences['skype']){ ?>
                            <li class="skype"><a href="#" title="<?php echo $preferences['skype'] ?>">skype</a></li>
                            <?php } ?>
                            <?php if($preferences['canal_youtube']){ ?>
                            <li class="youtube"><a href="#">youtube</a></li>
                            <?php } ?>
                            <?php if($preferences['rss']){ ?>
                            <li class="rss"><a href="<?php echo $preferences['rss'] ?>">rss </a></li>
                            <?php } ?>
                            <?php if($preferences['home']){ ?>
                            <li class="homeicon"><a href="<?php echo $preferences['home'] ?>">homeicon</a></li>
                            <?php } ?>
                            <?php if($preferences['telefone_contato']){ ?>
                            <li class="phone"><a href="#" title="<?php echo $preferences['telefone_contato'] ?>">phone </a></li>
                            <?php } ?>
                            <?php if($preferences['email_contato']){ ?>
                            <li class="email"><a href="mailto:<?php echo $preferences['email_contato'] ?>">email </a></li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
                <!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
                <script src="https://apis.google.com/js/platform.js" async defer>
                  {lang: 'pt-BR'}
                </script>
                <?php if($preferences['google_plus'] != ''){ ?>
                <div class="span4">
                    <h4 class="line3 center standart-h4title"><span>Faça parte de nosso círculo</span></h4>                    
                    <div class=" fb_center2 ftFbBg">
                        <!-- Posicione esta tag onde você deseja que o widget apareça. -->

                        <div class="g-page" data-width="370" data-href="https://plus.google.com/<?php echo $preferences['google_plus'] ?>" data-layout="landscape" data-rel="publisher" data-theme="light"></div>
                        <!-- Posicione esta tag onde você deseja que o widget apareça. -->

                        <!-- Posicione esta tag depois da última tag do widget. -->
                        <script type="text/javascript">
                          window.___gcfg = {lang: 'pt-BR'};

                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/platform.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                    </div>                  
                </div>
                <?php } ?>
            </div>
            <hr class="half1 copyhr">
        </div>
    </div>
    <?php } ?>
    
    <?php if(Yii::app()->params['formas_pagamento']){ ?>
    <div class="row-fluid">
        <div class="payment_supportbar">
            <div class="container">                
                <div class="<?php if(Yii::app()->params['ssl_brand']){ ?>span8 <?php } else{ ?> span12 <?php } ?>"><img src="/media/images/layout/ecommerce/formas_de_pagamento.png" alt="Formas de pagamento" /></div>
                <?php if(Yii::app()->params['ssl_brand']){ ?>
                <div class=""><div class="right_resp"><img src="/media/images/layout/ecommerce/comodo_secure_transp_mini.png" alt="Selo SSL" /></div></div> 
                <?php } ?>
                <div class="clear"></div>
            </div>
        </div>        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php } ?>
    
    <div class="ftLineCompany">
        <div class="container">
            <div class="ft_copyright_line"><?php echo nl2br($preferences['rodape_copyright']) ?></div> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    
    <div class="ftLine2">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <div class="legenda_right">Todos os direitos reservados ©<?php echo date('Y')?></div>
                    <div class="legend_left">
                        <div id="mn3_line-branco" class="mn3_line">
                            <div class="container_mn2_line"> 
                                <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
                                <a class="link_mn2_line" href="/loja/comparar">Comparar produtos</a>
                                <span class="link_mn2_line">|</span>
                                <?php } ?>
                                <a class="link_mn2_line" href="/contato">Entre em contato</a>
                            </div>
                        </div>                
                    </div> 
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</footer>