<!-- Footer ================================================== -->
<footer class="footer">
    <div class="ftMenu">  
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid mgT2">
                        <div class="span1">
                            <span class="twitter-sign"> <i class="fa fa-twitter fa-icon-large main-color"></i></span>
                        </div>
                        <div class="span11 hNews">
                            <p class="twitter-bottom"><span class="main-color">TWITTER:</span> Novos componentes para sua página, são as Páginas Avançadas dando um plus ao seu site <a href="#" title="twitter">veja agora</a></p>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="row-fluid">
                <div class="span3">
                    <h4 class="line3 center standart-h4title"><span>Links Rápidos</span></h4>
                    
                    <div id="mn3_line" class="mn3_line ftMn1">
                        <ul class="container_mn2_line">
                            <?php foreach ($preferences['menu3'] as $valuesr) {?>
                            <li><a class="link_mn2_line" href="/<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a></li>
                            <?php  }?>
                        </ul>
                    </div>
                </div>
                <div class="span3">
                   
                    <div id="mn_cols4_categorias-<?php echo $preferences['menu2_theme'] ?>">
                        <div class="container_mn2_cols4">                            
                            <div>
                            <?php if(count($preferences['menu2_categorias']) > 0){$p = 0; $i = 0; $previous_id = $preferences['menu2_categorias'][0]['id_categoria']; foreach ($preferences['menu2_categorias'] as $valuesE) { ?>
                            <?php if($i == 0){?><h4 class="line3 center standart-h4title"><span><?php echo $preferences['menu2_categorias'][0]['titulos']['nome']; ?></span></h4><?php } ?>
                            <div class="<?php if($i == 0) echo "divider_horizontal_mn_cat" ?>"></div>

                            <?php if($valuesE['id_categoria'] == $previous_id) { ?>
                                <div class="container_link_mn_cols4">
                                    <?php if(isset($valuesE['icon']['cool_j'])) {?>
                                    <div class="icon_mn2" style="background: url(<?php if(isset($valuesE['icon']['cool_j'])) echo $ic_path. $valuesE['icon']['cool_j'] ?>) no-repeat"></div>
                                    <?php } ?>
                                    <a class="link_mn2_cols4" href="/<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
                                </div>
                            <?php }else{ $p++;?>
                            </div>         
                            <div class=" <?php if($p >= 3) echo 'mg0R' ?>">
                                <h4 class="line3 center standart-h4title"><span><?php if(isset($preferences['menu2_categorias'][$i]['titulos']['nome'])) echo $preferences['menu2_categorias'][$i]['titulos']['nome'] ?></span></h4>
                                
                                <div class="container_link_mn_cols4">
                                    <?php if(isset($valuesE['icon']['cool_j'])) {?>
                                    <div class="icon_mn2" style="background: url(<?php if(isset($valuesE['icon']['cool_j']))echo $ic_path . $valuesE['icon']['cool_j'] ?>) no-repeat"></div>
                                    <?php } ?>
                                    <a class="link_mn2_cols4" href="/<?php if($valuesE['link_special'] == ''){echo $valuesE['nome'];}else{echo $valuesE['link_special'];} ?>"><?php echo $valuesE['label'] ?></a>
                                </div>
                            <?php  } $i++; $previous_id = $valuesE['id_categoria']; }}?>
                            
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="span3">
                    <h4 class="line3 center standart-h4title"><span>Nosso escritório</span></h4>
                    <address class="hCard">
                        <strong> <?php echo Settings::CTT_COMPANY_NAME ?></strong><br>
                        <i class="fa-icon-map-marker"></i> <?php echo Settings::CTT_ENDERECO ?><br>
                        <?php echo Settings::CTT_CIDADE . ' / ' . Settings::CTT_ESTADO ?><br>
                        <i class="fa-icon-phone-sign"></i> <?php echo Settings::CTT_TEL_1 ?>
                        <div class="foot-line"></div>

                    </address>
                </div>
                <div class="span3">
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
                            <?php if(isset($preferences['email']) && $preferences['email']){ ?>
                            <li class="email"><a href="mailto:<?php echo $preferences['email'] ?>">email </a></li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="half1 copyhr">
        </div>
    </div>
    <div class="ftLineCompany">
        <div class="footerPan">
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