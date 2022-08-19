<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->

<!-- PAGE HEADER -->
<div class="container pan">
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/site/breadcrumb.php'; ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if($page_prop['gel_fr_initial'] != ""){ ?>
        <!--TITLE-->
        <div class="row-fluid">   
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>
            <div class="divider_horizontal mgB2"></div>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>
    
    <?php if($rows && count($rows) > 0){foreach($rows as $values){
        if(isset($values['content']) && isset($values['content']['url'])) $this->renderPartial("/site/modulos/" . $values['content']['url'] . $values['info']['modelo'] . "/" .  $values['info']['cool'], $values['content']);
     }} ?>
    
    <!-- CONTENT CONTAINER -->

    <div class="row-fluid">
        <div class="mgL mgR">
            <?php if((isset($contatos['ctt_address']) && ($contatos['ctt_address'] != '' && $contatos['ctt_cidade'] != '')) || Settings::CTT_ENDERECO != ''){ ?>
            <div class="span12">
                <div class="color-bottom-line center">
                    <h2 class="line center"><span><i class="fa-icon-map-marker main-color"></i> Nossa localização</span></h2>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="span12 center">
                        <!-- MAP DIV // !Don't remove this !Important -->
                        <div id="map"></div>
                        <!-- MAP DIV // !Don't remove this !Important -->
                    </div>
                    <hr class="half">                
                </div>
            </div>
            <?php } ?>
            <!-- MAP DIV // !Don't remove this !Important -->
            <div class="row-fluid">
                
                <div class="span4">
                    <div class="color-bottom-line">
                        <h3 class="standart-h3title"><i class="fa-icon-pushpin main-color"></i> Nosso escritório</h3>
                    </div>
                    <div class="">
                        <div class="well">
                            <address>
                                <p class="black2">
                                    <strong><?php if(isset($contatos['ctt_company_name'])){echo $contatos['ctt_company_name'];} if(Settings::CTT_COMPANY_NAME){echo Settings::CTT_COMPANY_NAME; } ?></strong><br>
                                    <?php if(isset($contatos['ctt_address'])){echo $contatos['ctt_address'];} if(Settings::CTT_ENDERECO){echo Settings::CTT_ENDERECO; } ?><br>
                                    <?php if(isset($contatos['ctt_cidade'])){echo $contatos['ctt_cidade'] . ' / ' . $contatos['ctt_estado'];} if(Settings::CTT_CIDADE){echo Settings::CTT_CIDADE . ' / ' . Settings::CTT_ESTADO; } ?><br>
                                    <i class="fa-icon-phone-sign"></i> <?php if(isset($contatos['ctt_tel_1'])){echo $contatos['ctt_tel_1'];} if(Settings::CTT_TEL_1){echo Settings::CTT_TEL_1; } ?>
                                </p>
                                <div class="foot-line"></div>

                            </address>
                        </div>	


                        <h3 class="standart-h3title"><i class="fa-icon-share main-color"></i> Entre em contato</h3>

                        <div class="well">
                            <div class="widget_nav_menu"> 
                                <ul class="socialIcons">

                                    <?php if($preferences['facebook']){ ?>
                                    <li class="facebook"><a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>">facebook </a></li>
                                    <?php } ?>
                                    <?php if($preferences['linkedin']){ ?>
                                    <li class="linkedin"><a href="<?php echo $preferences['twitter'] ?>">linkedin </a></li>
                                    <?php } ?>
                                    <?php if($preferences['twitter']){ ?>
                                    <li class="twitter"><a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>">twitter</a></li>
                                    <?php } ?>

                                    <?php if($preferences['google_plus']){ ?>
                                    <li class="googleplus"><a href="http://plus.google.com.br/<?php echo $preferences['google_plus'] ?>">googleplus</a></li>
                                    <?php } ?>
                                    <?php if($preferences['rss']){ ?>
                                    <li class="rss"><a href="/rss">rss </a></li>
                                    <?php } ?>
                                    <?php if($preferences['email']){ ?>
                                    <li class="email"><a href="/contato">Email </a></li>
                                    <?php } ?>
                                    <?php if($preferences['telefone_contato']){ ?>
                                    <li class="phone"><a href="/contato" title="<?php echo $preferences['telefone_contato'] ?> ">Telefone</a></li>
                                    <?php } ?>
                                    <?php if($preferences['site_map']){ ?>
                                    <li class="map_site"><a href="#">Mapa do Site</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>								
                </div>
                <div class="span8">

                    <h3 class="standart-h3title"><i class="fa-icon-envelope-alt main-color"></i> Escreva uma mensagem para nós</h3>
                    <!-- CONTACT FORM -->
                    <form id="ajax-contacts">
                        <label class="texto">Nome</label><input class="span12" type="text" name="nome" id="nome" value=""><br>

                        <label class="texto">E-Mail</label><input class="span12" type="email" name="email" id="email" value=""><br>

                        <label class="texto">Telefone</label><input class="span12" type="text" name="fone" id="fone" value=""><br>

                        <label class="texto">Mensagem</label><textarea class="span12" name="messagem" id="mensagem" rows="5" cols="25"></textarea><br>

                        <div id="output_contact"></div>
                        <label>&nbsp;</label>
                        <div class="left"><input class="botao btn-second mgR2" type="button" value="Limpar" id='bt_clear_contato'></div>
                        <div class="left"><input class="botao btn-main" type="button" value="Enviar" id='bt_submit_contato'></div>

                    </form>

                    <!-- END CONTACT FORM -->
                    <div class="mgFooter"></div>

                </div>
                  
            </div>
        </div>
    </div>

    <div class="mgFooter"></div>
</div>
<input type="hidden" id="helper_action" data-js-action="contato"/>
<input type="hidden" value="site" id="helper_local_logout" data-address="<?php if(isset($contatos['ctt_address'])){echo $contatos['ctt_address'] . ' - ' . $contatos['ctt_cidade']; } if(Settings::CTT_ENDERECO != ''){echo Settings::CTT_ENDERECO . ' - ' . Settings::CTT_CIDADE; }  ?>"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>

<!-- gMap PLUGIN -->
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/lib/jquery.gmap.js"></script>
<script type="text/javascript">
		
				jQuery(document).ready(function(){

				jQuery('#map').gMap({ address: $('#helper_local_logout').attr('data-address'),
							   panControl: true,
						   zoomControl: true,
							   zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL
							   },
						   mapTypeControl: true,
						   scaleControl: true,
						   streetViewControl: false,
						   overviewMapControl: true,
							   scrollwheel: true,
							   icon: {
						image: "http://www.google.com/mapfiles/marker.png",
						shadow: "http://www.google.com/mapfiles/shadow50.png",
						iconsize: [20, 34],
						shadowsize: [37, 34],
						iconanchor: [9, 34],
						shadowanchor: [19, 34]
					},
						zoom:14,
							   markers: [
							{ 'address' : $('#helper_local_logout').attr('data-address')}
						]
							   
							   
							   }); 
				});



</script>



