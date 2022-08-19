<!-- Footer ================================================== -->
<footer class="footer">
    <div class="ftMenu">
        <?php if(!isset($preferences['rodape']['attr']['rodape_layout_pos']) || (isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == "" || $preferences['rodape']['attr']['rodape_layout_pos'] == 'tradicional')){ ?>
        <div class="container">
            <?php if($preferences['menu3'] && count($preferences['menu3']) > 0){ ?>
            <div class="row-fluid mgT2 mgB2">
                <div class="span12">                      
                    <div class="center mgB2"> 
                        <div id="mn3_line" class="mn3_line ftMn1">
                            <div class="container_mn2_line">
                                <?php foreach ($preferences['menu3'] as $valuesr) {?>
                                    <a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a>
                                <?php if($valuesr != end($preferences['menu3'])){?>
                                    <span class="link_mn2_line">|</span>
                                <?php } ?>
                                <?php  }?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="divider_shadow"></div>
                </div>
            </div>
            <?php } ?>
            
            <div class="row-fluid">
                <div id="ftMnCor_<?php echo $preferences['menu2_theme'] ?>">
                    <div class="span3">
                        <h4 class="line3 center standart-h4title"><span class="main_color">Links Rápidos</span></h4>

                        <div id="mn3_line" class="mn3_line ftMn1">
                            <ul class="container_mn2_line">
                                <?php count($preferences['menu3']);foreach ($preferences['menu3'] as $valuesr) {?>
                                <li><a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                                <?php  }?>
                            </ul>
                        </div>
                    </div>
                    <div class="span3">              

                        <div class="container_mn2_cols4">                            
                            <div>
                            <?php if(count($preferences['menu2_categorias']) > 0){$p = 0; $i = 0; $previous_id = $preferences['menu2_categorias'][0]['id_categoria']; foreach ($preferences['menu2_categorias'] as $valuesE) { ?>
                            <?php if($i == 0){?><h4 class="line3 center standart-h4title"><span><?php echo $preferences['menu2_categorias'][0]['titulos']['nome']; ?></span></h4><?php } ?>
                            <div class="<?php if($i == 0) echo "divider_horizontal_mn_cat" ?>"></div>

                            <?php if($valuesE['id_categoria'] == $previous_id) { ?>
                                <div class="container_link_mn_cols4 ftMn1">
                                    <?php if(isset($valuesE['icon']['cool_j'])) {?>
                                    <div class="icon_mn2" style="background: url(<?php if(isset($valuesE['icon']['cool_j'])) echo $ic_path. $valuesE['icon']['cool_j'] ?>) no-repeat"></div>
                                    <?php } ?>
                                    <a class="link_mn2_cols4" href="<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
                                </div>
                            <?php }else{ $p++;?>
                            </div>         
                            <div class=" <?php if($p >= 3) echo 'mg0R' ?>">
                                <h4 class="line3 center standart-h4title"><span><?php if(isset($preferences['menu2_categorias'][$i]['titulos']['nome'])) echo $preferences['menu2_categorias'][$i]['titulos']['nome'] ?></span></h4>

                                <div class="container_link_mn_cols4 ftMn1">
                                    <?php if(isset($valuesE['icon']['cool_j'])) {?>
                                    <div class="icon_mn2" style="background: url(<?php if(isset($valuesE['icon']['cool_j']))echo $ic_path . $valuesE['icon']['cool_j'] ?>) no-repeat"></div>
                                    <?php } ?>
                                    <a class="link_mn2_cols4" href="<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
                                </div>
                            <?php  } $i++; $previous_id = $valuesE['id_categoria']; }}?>

                            </div>
                        </div>           

                    </div>

                    <div class="<?php if($preferences['facebook_id'] != ''){ echo "span3";}else{echo "span6";} ?> ">
                        <h4 class="line3 center standart-h4title"><span>Encontre-nos</span></h4>
                        <address class="ftMn1">
                            <ul class="socialIconsLine">

                                <?php if($preferences['facebook']){ ?>
                                <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">Facebook </a></li>
                                <?php } ?>
                                <?php if($preferences['linkedin']){ ?>
                                <li class="linkedin"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>">Linkedin </a></li>
                                <?php } ?>
                                <?php if($preferences['twitter']){ ?>
                                <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">Twitter</a></li>
                                <?php } ?>
                                <?php if($preferences['pintrest']){ ?>
                                <li class="pinterest"><a href="<?php echo $preferences['pintrest'] ?>">Pinterest</a></li>
                                <?php } ?>
                                <?php if($preferences['flickr']){ ?>
                                <li class="flickr"><a href="<?php echo $preferences['flickr'] ?>">Flickr </a></li>
                                <?php } ?>
                                <?php if($preferences['google_plus']){ ?>
                                <li class="googleplus"><a href="<?php echo $preferences['google_plus'] ?>">GooglePlus</a></li>
                                <?php } ?>
                                <?php if($preferences['skype']){ ?>
                                <li class="skype"><a href="#" title="<?php echo $preferences['skype'] ?>">Skype</a></li>
                                <?php } ?>
                                <?php if($preferences['canal_youtube']){ ?>
                                <li class="youtube"><a href="#">Youtube</a></li>
                                <?php } ?>
                                <?php if($preferences['rss']){ ?>
                                <li class="rss"><a href="<?php echo $preferences['rss'] ?>">Rss </a></li>
                                <?php } ?>
                                <?php if($preferences['home']){ ?>
                                <li class="homeicon"><a href="<?php echo $preferences['home'] ?>">Home</a></li>
                                <?php } ?>
                                <?php if($preferences['telefone_contato']){ ?>
                                <li class="phone"><a href="#" title="<?php echo $preferences['telefone_contato'] ?>">Telefone</a></li>
                                <?php } ?>
                                <?php if($preferences['email']){ ?>
                                <li class="email"><a href="mailto:<?php echo $preferences['email'] ?>">E-mail</a></li>
                                <?php } ?>

                            </ul>

                        </address>
                    </div>
                    <?php if($preferences['facebook'] != ''){ ?>
                    <div class="span3">
                        <h4 class="line3 center standart-h4title"><span>Entre em contato</span></h4>                    
                        <div class=" fb_center2 ftFbBg">
                            <div id="fb-root"></div>
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=<?php //echo $preferences['facebook_id'] ?>";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="container_plugin_likebox mgb_10">
                                <div class="fb-page" data-href="https://www.facebook.com/<?php echo $preferences['facebook'] ?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/<?php echo $preferences['facebook'] ?>"><a href="https://www.facebook.com/<?php echo $preferences['facebook'] ?>">Facebook</a></blockquote></div></div>
                            </div>                        
                        </div>                  
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            
            
            <?php if(isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == 'tornado'){ ?>
                <?php if($preferences['menu3'] && count($preferences['menu3']) > 0){ ?>
                <div class="row-fluid mgT2 mgB2">
                    <div class="span12">                      
                        <div class="center mgB2"> 
                            <div id="mn3_line" class="mn3_line ftMn1">
                                <div class="container_mn2_line">
                                    <?php foreach ($preferences['menu3'] as $valuesr) {?>
                                        <a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a>
                                    <?php if($valuesr != end($preferences['menu3'])){?>
                                        <span class="link_mn2_line">|</span>
                                    <?php } ?>
                                    <?php  }?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="divider_shadow"></div>
                    </div>
                </div>
                <?php } ?>

                <div class="row-fluid">
                    <div id="ftMnCor_<?php echo $preferences['menu2_theme'] ?>">
                        <div class="span3">
                            <h4 class="line3 center standart-h4title"><span class="main_color">Links Rápidos</span></h4>

                            <div id="mn3_line" class="mn3_line ftMn1">
                                <ul class="container_mn2_line">
                                    <?php count($preferences['menu3']);foreach ($preferences['menu3'] as $valuesr) {?>
                                    <li><a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                                    <?php  }?>
                                </ul>
                            </div>
                        </div>
                        <div class="span4">
                            <h4 class="line3 center standart-h4title"><span>Encontre-nos</span></h4>
                            <address class="ftMn1">
                                <ul class="socialIconsLine">

                                    <?php if($preferences['facebook']){ ?>
                                    <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">Facebook </a></li>
                                    <?php } ?>
                                    <?php if($preferences['linkedin']){ ?>
                                    <li class="linkedin"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>">Linkedin </a></li>
                                    <?php } ?>
                                    <?php if($preferences['twitter']){ ?>
                                    <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">Twitter</a></li>
                                    <?php } ?>
                                    <?php if($preferences['pintrest']){ ?>
                                    <li class="pinterest"><a href="<?php echo $preferences['pintrest'] ?>">Pinterest</a></li>
                                    <?php } ?>
                                    <?php if($preferences['flickr']){ ?>
                                    <li class="flickr"><a href="<?php echo $preferences['flickr'] ?>">Flickr </a></li>
                                    <?php } ?>
                                    <?php if($preferences['google_plus']){ ?>
                                    <li class="googleplus"><a href="<?php echo $preferences['google_plus'] ?>">GooglePlus</a></li>
                                    <?php } ?>
                                    <?php if($preferences['skype']){ ?>
                                    <li class="skype"><a href="#" title="<?php echo $preferences['skype'] ?>">Skype</a></li>
                                    <?php } ?>
                                    <?php if($preferences['canal_youtube']){ ?>
                                    <li class="youtube"><a href="#">Youtube</a></li>
                                    <?php } ?>
                                    <?php if($preferences['rss']){ ?>
                                    <li class="rss"><a href="<?php echo $preferences['rss'] ?>">Rss </a></li>
                                    <?php } ?>
                                    <?php if($preferences['home']){ ?>
                                    <li class="homeicon"><a href="<?php echo $preferences['home'] ?>">Home</a></li>
                                    <?php } ?>
                                    <?php if($preferences['telefone_contato']){ ?>
                                    <li class="phone"><a href="#" title="<?php echo $preferences['telefone_contato'] ?>">Telefone</a></li>
                                    <?php } ?>
                                    <?php if($preferences['email']){ ?>
                                    <li class="email"><a href="mailto:<?php echo $preferences['email'] ?>">E-mail</a></li>
                                    <?php } ?>

                                </ul>

                            </address>
                        </div>
                        <?php if($preferences['facebook'] != ''){ ?>
                        <div class="span5">
                            <h4 class="line3 center standart-h4title"><span>Curta nossa página</span></h4>                    
                            <div class=" fb_center2 ftFbBg">
                                <div id="fb-root"></div>
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=<?php //echo $preferences['facebook_id'] ?>";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                                </script>
                                <div class="container_plugin_likebox mgb_10">
                                    <div class="fb-page" data-href="https://www.facebook.com/<?php echo $preferences['facebook'] ?>" data-hide-cover="false" data-width="580" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/<?php echo $preferences['facebook'] ?>"><a href="https://www.facebook.com/<?php echo $preferences['facebook'] ?>">Facebook</a></blockquote></div></div>
                                </div>                        
                            </div>                  
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            
            <?php if(isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == 'granizo'){ ?>
                <?php if($preferences['menu3'] && count($preferences['menu3']) > 0){ ?>
                <div class="row-fluid mgT2 mgB2">
                    <div class="span12">                      
                        <div class="center mgB2"> 
                            <div id="mn3_line" class="mn3_line ftMn1">
                                <div class="container_mn2_line">
                                    <?php foreach ($preferences['menu3'] as $valuesr) {?>
                                        <a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a>
                                    <?php if($valuesr != end($preferences['menu3'])){?>
                                        <span class="link_mn2_line">|</span>
                                    <?php } ?>
                                    <?php  }?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="divider_shadow"></div>
                    </div>
                </div>
                <?php } ?>

                <div class="row-fluid">
                    <div id="ftMnCor_<?php echo $preferences['menu2_theme'] ?>">
                        <div class="span3">
                            <h4 class="line3 center standart-h4title"><span class="main_color">Links Rápidos</span></h4>

                            <div id="mn3_line" class="mn3_line ftMn1">
                                <ul class="container_mn2_line">
                                    <?php count($preferences['menu3']);foreach ($preferences['menu3'] as $valuesr) {?>
                                    <li><a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                                    <?php  }?>
                                </ul>
                            </div>
                        </div>
                        <div class="span4">
                            <h4 class="line3 center standart-h4title"><span>Encontre-nos</span></h4>
                            <address class="ftMn1">
                                <ul class="socialIconsLine">

                                    <?php if($preferences['facebook']){ ?>
                                    <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">Facebook </a></li>
                                    <?php } ?>
                                    <?php if($preferences['linkedin']){ ?>
                                    <li class="linkedin"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>">Linkedin </a></li>
                                    <?php } ?>
                                    <?php if($preferences['twitter']){ ?>
                                    <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">Twitter</a></li>
                                    <?php } ?>
                                    <?php if($preferences['pintrest']){ ?>
                                    <li class="pinterest"><a href="<?php echo $preferences['pintrest'] ?>">Pinterest</a></li>
                                    <?php } ?>
                                    <?php if($preferences['flickr']){ ?>
                                    <li class="flickr"><a href="<?php echo $preferences['flickr'] ?>">Flickr </a></li>
                                    <?php } ?>
                                    <?php if($preferences['google_plus']){ ?>
                                    <li class="googleplus"><a href="<?php echo $preferences['google_plus'] ?>">GooglePlus</a></li>
                                    <?php } ?>
                                    <?php if($preferences['skype']){ ?>
                                    <li class="skype"><a href="#" title="<?php echo $preferences['skype'] ?>">Skype</a></li>
                                    <?php } ?>
                                    <?php if($preferences['canal_youtube']){ ?>
                                    <li class="youtube"><a href="#">Youtube</a></li>
                                    <?php } ?>
                                    <?php if($preferences['rss']){ ?>
                                    <li class="rss"><a href="<?php echo $preferences['rss'] ?>">Rss </a></li>
                                    <?php } ?>
                                    <?php if($preferences['home']){ ?>
                                    <li class="homeicon"><a href="<?php echo $preferences['home'] ?>">Home</a></li>
                                    <?php } ?>
                                    <?php if($preferences['telefone_contato']){ ?>
                                    <li class="phone"><a href="#" title="<?php echo $preferences['telefone_contato'] ?>">Telefone</a></li>
                                    <?php } ?>
                                    <?php if($preferences['email']){ ?>
                                    <li class="email"><a href="mailto:<?php echo $preferences['email'] ?>">E-mail</a></li>
                                    <?php } ?>

                                </ul>

                            </address>
                        </div>
                        <!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
                        <script src="https://apis.google.com/js/platform.js" async defer>
                          {lang: 'pt-BR'}
                        </script>
                        <?php if($preferences['google_plus'] != ''){ ?>
                        <div class="span5">
                            <h4 class="line3 center standart-h4title"><span>Faça parte de nosso círculo</span></h4>                    
                            <div class=" fb_center2 ftFbBg">
                                <!-- Posicione esta tag onde você deseja que o widget apareça. -->
                                 
                                <div class="g-page" data-width="450" data-href="<?php echo $preferences['google_plus'] ?>" data-layout="landscape" data-rel="publisher" data-theme="light"></div>
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
                </div>
            <hr class="half">
        </div>
        <?php } ?>
            
 

        <?php if(!isset($preferences['rodape']['attr']['rodape_layout_pos']) || (isset($preferences['rodape']['attr']['rodape_layout_pos']) && $preferences['rodape']['attr']['rodape_layout_pos'] == 'vortex')){ ?>
        <div class="container">
            <?php if(isset($preferences['menu3']) && $preferences['menu3'] && count($preferences['menu3']) > 0){ ?>
            <div class="row-fluid mgT2 mgB2">
                <div class="span12">                      
                    <div class="center mgB2"> 
                        <div id="mn3_line" class="mn3_line ftMn1">
                            <div class="container_mn2_line">
                                <?php foreach ($preferences['menu3'] as $valuesr) {?>
                                    <a class="link_mn2_line" href="/<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a>
                                <?php if($valuesr != end($preferences['menu3'])){?>
                                    <span class="link_mn2_line">|</span>
                                <?php } ?>
                                <?php  }?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="divider_shadow"></div>
                </div>
            </div>
            <?php } ?>
            
            <div class="row-fluid">
                <div id="ftMnCor_<?php echo $preferences['menu2_theme'] ?>">
                    <div class="span3">
                        <h4 class="line3 center standart-h4title"><span class="main_color">Links Rápidos</span></h4>

                        <div id="mn3_line" class="mn3_line ftMn1">
                            <ul class="container_mn2_line">
                                <?php if(isset($preferences['menu2'])){count($preferences['menu2']);foreach ($preferences['menu2'] as $valuesr) {?>
                                <li><a class="link_mn2_line" href="/<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                                <?php  }} ?>
                            </ul>
                        </div>
                    </div>
                    <div class="span6"> 
                        <h4 class="line3 center standart-h4title"><span class="main_color">Dados de contato</span></h4>
                        <div class="row">
                            <div class="span2">
                                <i class="fa fa-map-marker right_resp ftMn1 bF2"></i>
                            </div>
                            <div class="span10">
                                <p class="subtituloMenu"><?php if(isset($preferences['rodape']['attr']['chamada_texto'])) echo nl2br($preferences['rodape']['attr']['chamada_texto']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span2">
                                <i class="fa fa-phone-square right_resp ftMn1 bF"></i>
                            </div>
                            <div class="span10">
                                <p class="textoMenu"><?php if(isset($preferences['rodape']['attr']['titulo_column_1'])) echo nl2br($preferences['rodape']['attr']['titulo_column_1']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="span2">
                                <i class="fa fa-envelope right_resp ftMn1 bF"></i>
                            </div>
                            <div class="span10">
                                <p class="textoMenu"><?php if(isset($preferences['rodape']['attr']['texto_column_1'])) echo nl2br($preferences['rodape']['attr']['texto_column_1']) ?></p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="span3">
                        <h4 class="line3 center standart-h4title"><span>Encontre-nos</span></h4>
                        <address class="ftMn1">
                            <ul class="socialIconsLine">
                                <?php if($preferences['facebook']){ ?>
                                <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">Facebook </a></li>
                                <?php } ?>
                                <?php if($preferences['linkedin']){ ?>
                                <li class="linkedin"><a href="http://www.linkedin.com.br/<?php echo $preferences['linkedin'] ?>">Linkedin </a></li>
                                <?php } ?>
                                <?php if($preferences['twitter']){ ?>
                                <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">Twitter</a></li>
                                <?php } ?>
                                <?php if($preferences['pintrest']){ ?>
                                <li class="pinterest"><a href="<?php echo $preferences['pintrest'] ?>">Pinterest</a></li>
                                <?php } ?>
                                <?php if($preferences['flickr']){ ?>
                                <li class="flickr"><a href="<?php echo $preferences['flickr'] ?>">Flickr </a></li>
                                <?php } ?>
                                <?php if($preferences['google_plus']){ ?>
                                <li class="googleplus"><a href="<?php echo $preferences['google_plus'] ?>">GooglePlus</a></li>
                                <?php } ?>
                                <?php if($preferences['skype']){ ?>
                                <li class="skype"><a href="#" title="<?php echo $preferences['skype'] ?>">Skype</a></li>
                                <?php } ?>
                                <?php if($preferences['canal_youtube']){ ?>
                                <li class="youtube"><a href="#">Youtube</a></li>
                                <?php } ?>
                                <?php if($preferences['rss']){ ?>
                                <li class="rss"><a href="<?php echo $preferences['rss'] ?>">Rss </a></li>
                                <?php } ?>
                                <?php if($preferences['home']){ ?>
                                <li class="homeicon"><a href="<?php echo $preferences['home'] ?>">Home</a></li>
                                <?php } ?>
                                <?php if($preferences['telefone_contato']){ ?>
                                <li class="phone"><a href="#" title="<?php echo $preferences['telefone_contato'] ?>">Telefone</a></li>
                                <?php } ?>
                                <?php if($preferences['email_contato']){ ?>
                                <li class="email"><a href="mailto:<?php echo $preferences['email_contato'] ?>">E-mail</a></li>
                                <?php } ?>

                            </ul>

                        </address>
                    </div>
                    
                </div>
            </div>
            <hr class="half">
        </div>
        <?php } ?>
    </div>
    
    
    
    
    <div class="ftLineCompany">
        <div class="footerPan">
            <div class="container">
                <div class="ft_copyright_line"><p class="center"><?php echo nl2br($preferences['rodape_copyright']) ?></p></div> 
            </div>
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