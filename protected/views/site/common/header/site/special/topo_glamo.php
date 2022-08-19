<!-- ################-->
<!-- START TOP MENU -->
<!-- ################-->
<?php if(Yii::app()->params['site_type']) $path_origin = "/media/user/images/original/";else $path_origin = ""; ?>
<link href="/css/site/components/headers/glamo.css" type="text/css" rel="stylesheet" />
<div id="topo_contatus" class="topo_helper nav-reaction headermainPan">
    <div class="navbar navbar-static-top">
        <div class="purplePan">
            <!-- navbar-fixed-top -->
            <div class="navbar-inner">
                <div class="container">

                    <?php if($preferences['topo']['attr']['topo_layout'] == 'common'){ ?>
                    <div id="Tg_common" class="relative">
                        <div class="topbar-sidebar topbar-sidebar-left">
                            <div id="search-2" class="widget widget_search left">
                                <form class="search-form" method="get">
                                    <input type="text" value="" class="search_field_input" placeholder="<?php if($preferences['topo']['attr']['frase_searchbox']) echo $preferences['topo']['attr']['frase_searchbox'] ?>" style="<?php if(isset($preferences['topo']['attr']['topo_cor_4']) && $preferences['topo']['attr']['topo_cor_4'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_4']};"; if(isset($preferences['topo']['attr']['topo_cor_5']) && $preferences['topo']['attr']['topo_cor_5'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_5']}"; ?>"/>
                                    <i class="bt_search_glamo fa fa-search searchbox_button" data-type="interesse" style="<?php if(isset($preferences['topo']['attr']['topo_cor_6']) && $preferences['topo']['attr']['topo_cor_6'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_6']}"; ?>"></i>
                                </form>
                            </div>
                            <?php if($preferences['telefone_contato'] != ''){ ?>
                            <div class="widget_text">
                                <div class="textwidget">                            
                                    <i class="fa fa-phone" <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>></i>
                                    <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>><?php echo $preferences['telefone_contato'] ?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="topbar-sidebar-right topbar-sidebar">
                            <div class="widget glamo-mini-cart-widget">
                                <div class="widget glamo-social-links-widget">
                                    <?php if($preferences['facebook']){ ?>
                                    <a class="fa-facebook fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>" data-original-title="Facebook" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                    <?php } ?>
                                    <?php if($preferences['twitter']){ ?>
                                    <a class="fa-twitter fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>" data-original-title="Twitter" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                    <?php } ?>
                                     <?php if($preferences['google_plus']){ ?>
                                    <a class="fa-google-plus fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="<?php echo $preferences['google_plus'] ?>" data-original-title="Google Plus" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> 
                        <div class="clear"></div>
                        <?php if($preferences['logo'] != ''){ ?>
                        <a class="brand" href="/home"> 
                            <img src="<?php echo $path_origin . $preferences['logo']?>" alt="Logo">
                        </a>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>

                    <?php if($preferences['topo']['attr']['topo_layout'] == 'refined'){ ?>
                    <div id="Tg_refined" class="relative">
                        <div class=" topbar-sidebar-left">
                            <?php if($preferences['logo'] != ''){ ?>
                            <a class="brand" href="/home"> 
                                <img src="<?php echo $path_origin . $preferences['logo']?>" alt="Logo">
                            </a>
                            <?php } ?>
                        </div>
                        <div class="topbar-sidebar-right topbar-sidebar">
                            <div class="right">
                                <?php if($preferences['telefone_contato'] != ''){ ?>
                                <div class="widget_text">
                                    <div class="textwidget">                            
                                        <i class="fa fa-phone" <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>></i>
                                        <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>><?php echo $preferences['telefone_contato'] ?></span>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="widget glamo-mini-cart-widget">
                                    <div class="widget glamo-social-links-widget">
                                        <?php if($preferences['facebook']){ ?>
                                        <a class="fa-facebook fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>" data-original-title="Facebook" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                        <?php if($preferences['twitter']){ ?>
                                        <a class="fa-twitter fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>" data-original-title="Twitter" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                         <?php if($preferences['google_plus']){ ?>
                                        <a class="fa-google-plus fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="<?php echo $preferences['google_plus'] ?>" data-original-title="Google Plus" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="clear"></div>

                        <div class="topbar-sidebar right">
                            <div id="search-2" class="widget widget_search left">
                                <form class="search-form" method="get">
                                    <input type="text" value="" class="search_field_input" placeholder="<?php if(isset($preferences['topo']['attr']['frase_searchbox']) && $preferences['topo']['attr']['frase_searchbox']) echo $preferences['topo']['attr']['frase_searchbox'] ?>" style="<?php if(isset($preferences['topo']['attr']['topo_cor_4']) && $preferences['topo']['attr']['topo_cor_4'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_4']};"; if(isset($preferences['topo']['attr']['topo_cor_5']) && $preferences['topo']['attr']['topo_cor_5'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_5']}"; ?>"/>
                                    <i class="bt_search_glamo fa fa-search searchbox_button" data-type="interesse" style="<?php if(isset($preferences['topo']['attr']['topo_cor_6']) && $preferences['topo']['attr']['topo_cor_6'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_6']}"; ?>"></i>
                                </form>
                            </div>

                        </div>

                        <div class="clear"></div>
                    </div>
                    <?php } ?>

                    <?php if($preferences['topo']['attr']['topo_layout'] == 'reverse' || $preferences['topo']['attr']['topo_layout'] == ''){ ?>
                    <div id="Tg_reverse" class="relative">
                        <div class=" topbar-sidebar-left">
                            <?php if($preferences['logo'] != ''){ ?>
                            <a class="brand" href="/home"> 
                                <img src="<?php echo $path_origin . $preferences['logo']?>" alt="Logo">
                            </a>
                            <?php } ?>
                        </div>                    
                        <div class="topbar-sidebar right search_ctn">
                            <div id="search-2" class="widget widget_search left">
                                <form class="search-form" method="get">
                                    <input type="text" value="" class="search_field_input" placeholder="<?php if($preferences['topo']['attr']['frase_searchbox']){echo $preferences['topo']['attr']['frase_searchbox'];}else{echo "O que você precisa?";} ?>" style="<?php if(isset($preferences['topo']['attr']['topo_cor_4']) && $preferences['topo']['attr']['topo_cor_4'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_4']};"; if(isset($preferences['topo']['attr']['topo_cor_5']) && $preferences['topo']['attr']['topo_cor_5'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_5']}"; ?>"/>
                                    <i class="bt_search_glamo fa fa-search searchbox_button" data-type="interesse" style="<?php if(isset($preferences['topo']['attr']['topo_cor_6']) && $preferences['topo']['attr']['topo_cor_6'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_6']}"; ?>"></i>
                                </form>
                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="topbar-sidebar-right topbar-sidebar">
                            <div class="right ctnRedSocial">
                                <?php if($preferences['telefone_contato'] != ''){ ?>
                                <div class="widget_text">
                                    <div class="textwidget">                            
                                        <i class="fa fa-phone" <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>></i>
                                        <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>><?php echo $preferences['telefone_contato'] ?></span>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="widget glamo-mini-cart-widget">
                                    <div class="widget glamo-social-links-widget">
                                        <?php if($preferences['facebook']){ ?>
                                        <a class="fa-facebook fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>" data-original-title="Facebook" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                        <?php if($preferences['twitter']){ ?>
                                        <a class="fa-twitter fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>" data-original-title="Twitter" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                         <?php if($preferences['google_plus']){ ?>
                                        <a class="fa-google-plus fa social-link tooltip-enable" data-placement="top" data-toggle="tooltip" title="" rel="nofollow" href="<?php echo $preferences['google_plus'] ?>" data-original-title="Google Plus" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="clear"></div>

                    </div>
                    <?php } ?>
                    
                    <?php if($preferences['topo']['attr']['topo_layout'] == 'easy'){ ?>
                    <div id="Tg_reverse" class="relative">
                        <div class=" topbar-sidebar-left">
                            <?php if($preferences['logo'] != ''){ ?>
                            <a class="brand" href="/home"> 
                                <img src="<?php echo $path_origin . $preferences['logo']?>" alt="Logo">
                            </a>
                            <?php } ?>
                        </div>                    
                        <div class="topbar-sidebar right search_ctn">
                            <div id="search-2" class="widget widget_search left">
                                <form class="search-form" method="get">
                                    <input type="text" value="" class="search_field_input" placeholder="<?php if($preferences['topo']['attr']['frase_searchbox']){echo $preferences['topo']['attr']['frase_searchbox'];}else{echo "O que você precisa?";} ?>" style="<?php if(isset($preferences['topo']['attr']['topo_cor_4']) && $preferences['topo']['attr']['topo_cor_4'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_4']};"; if(isset($preferences['topo']['attr']['topo_cor_5']) && $preferences['topo']['attr']['topo_cor_5'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_5']}"; ?>"/>
                                    <i class="bt_search_glamo fa fa-search searchbox_button" data-type="interesse" style="<?php if(isset($preferences['topo']['attr']['topo_cor_6']) && $preferences['topo']['attr']['topo_cor_6'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_6']}"; ?>"></i>
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($preferences['topo']['attr']['topo_layout'] == 'fgstorm'){ ?>
                    <div id="Tg_fgstorme" class="relative">
                        <p>&nbsp;</p>
                        <div class="topbar-sidebar topbar-sidebar-left">
                            <?php if($preferences['logo'] != ''){ ?>
                            <a class="brand" href="/home"> 
                                <img src="<?php echo $path_origin . $preferences['logo']?>" alt="Logo">
                            </a>
                            <?php } ?>                            
                        </div>
                        <div class="topbar-sidebar-right topbar-sidebar">
                            <?php if($preferences['email'] != ''){ ?>
                            <div class="widget_text right_resp">
                                <div class="textwidget">                            
                                    <i class="fa fa-envelope" <?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_2']}'"; ?>></i>
                                    <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?> class="italic"><?php echo $preferences['email'] ?></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <?php } ?>
                            
                            <?php if($preferences['telefone_contato'] != ''){ ?>
                            <div class="widget_text right_resp">
                                <div class="textwidget">  
                                    <div class="widget glamo-mini-cart-widget">
                                        <div class="widget glamo-social-links-widget">
                                            <div class="txt_right bold" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_2']};"; ?>">Central de Vendas:</div>
                                            <i class="fa fa-phone tooltip-enable social-link bF2" style="<?php if(isset($preferences['topo']['attr']['topo_cor_2']) && $preferences['topo']['attr']['topo_cor_2'] != '') echo "background: #{$preferences['topo']['attr']['topo_cor_2']};"; if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "color: #{$preferences['topo']['attr']['topo_cor_3']}"; ?>"></i>
                                            <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']};font-size: 1.6em'; "; ?> class="bF2 italic"><?php echo $preferences['telefone_contato'] ?></span>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <?php } ?>
                        </div> 
                        
                        
                        <div class="clear"></div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->

