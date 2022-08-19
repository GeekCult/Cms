<script type="text/javascript" src="/js/lib/jquery.js"></script>

<link rel="stylesheet" href="/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<div id="menu_admin">
    <ul class="menu_admin"><?php $session = MethodUtils::getSessionData(); ?> 
        <li id="hide">
            <a href="/admin"><span><?php echo Yii::t("menuStrings", "widget_menu_warns") ?></span></a>
        </li>
        <?php if(true){ ?>
        
        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_coloumn1_content") ?></span></a>
            <ul>
                <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                <?php //if(defined('Settings::PIER_PAGINAS') && Settings::PIER_PAGINAS){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_pages") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/paginas/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a href="/admin/paginas/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a href="/admin/paginas/ocultas"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_hidden") ?></span></a></li>
                    </ul>
                </li>
                <?php //} ?>
                
                <?php //if(defined('Settings::PIER_IMAGENS') && Settings::PIER_IMAGENS){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_images") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/images/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a href="/admin/images/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?Php //} ?>
                
                
                
                <?php if(!true){ ?>
                <li class="hide"><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_banner") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/html_banners/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/html_banners/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a id="editar" href="/admin/html_banners/comprar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_templates") ?></span></a></li>
                        <li><a id="editar" href="/admin/html_banners/estatisticas"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_estatistics") ?></span></a></li>
                        <li><a id="editar" href="/admin/html_banners/recomendacoes"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_recomendations") ?></span></a></li>
                        <li><a id="editar" href="/admin/html_banners/definicoes"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_main_banner") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if(true == false){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_gallery") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_create") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a href="/admin/galeria/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_pictures") ?></span></a></li>
                                <li><a href="/admin/galeria/novo_users"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_users") ?></span></a></li>
                                
                            </ul>
                        </li>
                        <li><a id="editar" href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a href="/admin/galeria/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_pictures") ?></span></a></li>
                                <li><a href="/admin/galeria/listar_users"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_users") ?></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if(true == false){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_downloads") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/downloads/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/downloads/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if(true == false){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_hiperlinks") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/hiperlinks/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/hiperlinks/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if(true == false){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_videos") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/videos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/videos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php } ?>
                
                <?php if(!true){ ?>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_article") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_news") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a id="cadastrar" href="/admin/noticias/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a id="listar" href="/admin/noticias/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_columns") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a id="cadastrar" href="/admin/colunas/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a id="listar" href="/admin/colunas/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                        <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_releases") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a id="cadastrar" href="/admin/novidades/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a id="listar" href="/admin/novidades/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                        <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_tips") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a id="cadastrar" href="/admin/dicas/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a id="listar" href="/admin/dicas/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        
                       
                        <li><a href="/admin/materias/comentarios"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_comments") ?></span></a></li>
                    </ul>                    
                </li>
                <?php } ?>
                
                <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                <?php if(true == false){ ?>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_events") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/eventos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="listar" href="/admin/eventos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a href="/admin/eventos/comentarios"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_comments") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php } ?>
                
                <?php if(true == false){ ?>
                <li>                  
                    <a class="parent" href="#"><span><?php echo Yii::t("menuStrings", "widget_menu_services_order_review") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/depoimentos/novo_depoimento"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a href="/admin/depoimentos/listar_depoimentos"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>                      
                </li>
                <?php } ?>
                
                <?php if(true == false){ ?>               
                <li>
                    <a href="#" class="parent"><span>FAQ</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/configurar/faq"><span>Cadastrar</span></a></li>
                        <li><a href="/admin/configurar/faq_listar"><span>Listar</span></a></li>
                    </ul>
                </li>
                <?php } ?> 
                
                
                
                <?php if(true == false){ ?>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_portfolio") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/portfolio/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/portfolio/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_category") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a id="cadastrar" href="/admin/portfolio/categorias_novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a id="listar" href="/admin/portfolio/categorias_listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                <li class="hidden"><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_cools") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/cool/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="listar" href="/admin/cool/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                
                <?php  ?>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_category") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/categorias/novo/1"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="listar" href="/admin/categorias/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php  ?>
                
                <?php } ?>
            </ul>
        </li> 
        
        <?php if(Yii::app()->params['pier_itau']){ ?>
        <li><a class="parent"><span>Integração Itaú</span></a>
            <ul id="bt_abrir_colabore">
                 <li><a class="parent"><span>Pagamentos</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/bancos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a href="/admin/bancos/listar_todos"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <?php } ?>
        
        <li class="hide"><a href="/admin/bkbank" class="parent"><span>BK Bank</span></a></li>
        <li class="hide"><a href="/admin/xml" class="parent"><span>XML</span></a></li>
        <?php } ?>
        <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
        <?php if(Yii::app()->params['pier_layout']){ ?>
        <li class="hide"><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_coloumn3_content") ?></span></a>
            <ul id="bt_abrir_colabore">
                 <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_header") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/topos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a href="/admin/topos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a href="/admin/detalhes/editar/topo"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_details") ?></span></a></li>
                        <?php if(true == false){ ?>
                        <li><a href="/admin/detalhes/editar_special/barra_social"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_barra_social") ?></span></a></li>
                        <?php } ?>
                        <?php if(true == false){ ?>
                        <li><a href="/admin/detalhes/editar_special/perfil_flutuante"><span>Perfil Flutuante</span></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_footer") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/rodapes/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/rodapes/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a id="editar" href="/admin/detalhes/editar/rodape"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_details") ?></span></a></li>
                    </ul>
                </li>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_menu") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <?php if(true == false){ ?>
                        <li><a id="cadastrar" href="#" class="parent"><span>Menu Especial</span></a>
                            <ul id="bt_abrir_admin">
                                <li><a href="/admin/menu/criar_menu"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                                <li><a href="/admin/menu/listar_menu"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li><a id="cadastrar" href="/admin/menu/editar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_settings") ?></span></a></li>
                         
                    </ul>
                </li>               

                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_textures") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/texturas/topo/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_header") ?></span></a></li>
                        <li><a href="/admin/texturas/rodape/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_footer") ?></span></a></li>
                        <li><a href="/admin/texturas/site/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_background") ?></span></a></li>
                        <li><a href="/admin/texturas/paginas/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_foreground") ?></span></a></li>
                        <li><a href="/admin/texturas/efeitos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_effects") ?></span></a></li>
                        <li><a href="/admin/texturas/menu/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_menu") ?></span></a></li>
                        <li><a href="/admin/texturas/botao/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_buttons") ?></span></a></li>
                        <li><a href="/admin/texturas/icones/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_icons") ?></span></a></li>
                        <li><a href="/admin/texturas/overlay/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_overlay") ?></span></a></li>
                        <li><a href="/admin/texturas/sombras/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_shadow") ?></span></a></li>
                        <li><a href="/admin/texturas/intro/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_intro") ?></span></a></li>
                        <li><a href="/admin/texturas/banners/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_banners") ?></span></a></li>
                        <li><a href="/admin/texturas/mensagem/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_mensagem") ?></span></a></li>
                        <li><a href="/admin/texturas/textos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_textures_texts") ?></span></a></li>
                        <li><a href="/admin/texturas/wallpaper/listar"><span>papel de parede</span></a></li>
                        
                    </ul>
                </li>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_details") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/logos/selecionar"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_brand") ?></span></a></li>
                        <li><a href="/admin/detalhes/flags/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_flags") ?></span></a></li>
                        <li><a href="/admin/alertas/editar"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_alerts") ?></span></a></li>
                        <li><a href="/admin/detalhes/icons/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_icons") ?></span></a></li>
                        <li><a href="/admin/detalhes/more/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_more") ?></span></a></li>
                        <li><a href="/admin/detalhes/barmore/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_barmore") ?></span></a></li>
                        <li><a href="/admin/detalhes/container/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_container") ?></span></a></li>
                        <li><a href="/admin/detalhes/side_button/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_side_button") ?></span></a></li>
                        <li><a href="/admin/detalhes/dividers/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_dividers") ?></span></a></li> 
                        <li><a href="/admin/detalhes/editar_special/breadcrumb"><span><?php echo Yii::t("menuStrings", "widget_menu_details_breadcrumb") ?></span></a></li>
                        <li><a href="/admin/detalhes/pagination/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_details_pagination") ?></span></a></li> 
                    </ul>
                </li>
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_email") ?></span></a>
                    <ul id="bt_abrir_admin">                                            
                        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_email_layout") ?></span></a>
                            <ul id="bt_abrir_admin">
                                <li><a href="/admin/logos/selecionar"><span><?php echo Yii::t("menuStrings", "widget_menu_emkt_logos") ?></span></a></li>
                                <li><a id="listar" href="/admin/email/topo"><span><?php echo Yii::t("menuStrings", "widget_menu_emkt_header") ?></span></a></li>
                                <li><a id="listar" href="/admin/email/rodape"><span><?php echo Yii::t("menuStrings", "widget_menu_emkt_footer") ?></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_fonts") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/fontes/cores"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_colors") ?></span></a></li>
                        <li><a href="/admin/fontes/tamanhos"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_size") ?></span></a></li>
                    </ul>
                </li>
                <?php if(Yii::app()->params['local'] == 1 || $session['user_account_type'] == 3){ ?>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_layout") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/configurarview/cadastro_usuarios"><span><?php echo Yii::t("menuStrings", "widget_menu_config_cadastro") ?></span></a></li>
                        <li><a href="/admin/configurarview/conta_avisos"><span><?php echo Yii::t("menuStrings", "widget_menu_config_account_intro") ?></span></a></li>
                        <li><a href="/admin/configurarview/message_board"><span><?php echo Yii::t("menuStrings", "widget_menu_config_message_board") ?></span></a></li>
                        <li><a href="/admin/layoutsite/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_layout_site") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                <li><a class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_css_editor") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/csseditor/gerenciar"><span><?php echo Yii::t("menuStrings", "widget_menu_manager") ?></span></a></li>
                        <li><a href="/admin/csseditor/modelos"><span><?php echo Yii::t("menuStrings", "widget_menu_models") ?></span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <?php } ?>
        
        <?php } ?>
        
        <?php if(Yii::app()->params['pier_autos']){ ?>
            <?php include Yii::app()->getBasePath() . '/views/admin/common/menu/common/menu_autos.php'; ?>
        <?php } ?>
        
        <?php if(Yii::app()->params['pier_produtos']){ ?>
            <?php include Yii::app()->getBasePath() . '/views/admin/common/menu/common/menu.php'; ?>
        <?php } ?>       
        
        <?php if(Yii::app()->params['servicos'] != 0){ ?>
            <?php include Yii::app()->getBasePath() . '/views/admin/common/menu/common/servicos.php'; ?>
        <?php } ?>
        
        <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
        <?php if(true == true){ ?>
        <li id="hide"><a href="#"><span><?php echo Yii::t("menuStrings", "widget_menu_coloumn6_content") ?></span></a>
            <ul id="bt_abrir_colabore">
                <!-- 
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_emkt") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/newsletter/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="listar" href="/admin/newsletter/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <li><a id="listar" href="/admin/email/mailing_upload"><span><?php echo Yii::t("menuStrings", "widget_menu_upload_mailing") ?></span></a></li>
                    </ul>
                </li>
                -->
                <li><a href="#" class="parent"><span>Contatos recebidos</span></a>
                    <ul id="bt_abrir_admin">                        
                        <li><a id="listar" href="/admin/email/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>                      
                    </ul>
                </li>
               
                
                <?php if(Yii::app()->params['purple'] == '1'){ ?>
                <li>
                    <a href="#" class="parent"><span>Canal Comunicação</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/canal_comunicacao/novo"><span>Cadastrar</span></a></li>
                        <li><a href="/admin/canal_comunicacao/listar"><span>Listar</span></a></li>
                        <li><a href="/admin/canal_comunicacao/chamados"><span>Chamados</span></a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </li>
        <?Php } ?>
        <?php } ?>

        <li style="background: url(/media/images/layout/menu_admin/main_bg_purple.png) repeat-x; margin-left: -5px;"><a href="#"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_purplestore") ?></span></a>
            <ul id="bt_abrir_colabore">
                <?php if(Yii::app()->params['purple'] == '1'){ ?>
                <li><a href="#" class="parent"><span>Componentes</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/purplestore/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?> Aplicativo</span></a></li>
                        <li><a id="cadastrar" href="/admin/purplestore/novo_template"><span>Cadastrar Extremos</span></a></li>
                        <li><a id="cadastrar" href="/admin/purplestore/nova_pagina"><span>Cadastrar Template</span></a></li>
                        <li><a id="listar" href="/admin/purplestore"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php }else{ ?>
                <li><a href="/admin/purplestore"><span>Componentes</span></a></li>    
                <?php } ?>
                <!--
                <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_purchased") ?></span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/purplestore/componentes"><span>Meus Componentes</span></a></li>
                        <li><a id="listar" href="/admin/purplestore/aplicativos"><span>Meus Aplicativos</span></a></li>
                    </ul>
                </li>
                <li><a href="#" class="parent"><span>Minha Fatura</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/purplestore/minha_fatura"><span>Ver Fatura</span></a></li>
                        
                    </ul>
                </li> -->
            </ul>
        </li>
        <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
        <li id="hide">
            <a href="#"><span>Controle</span></a>            
           <ul>               
                <li>
                    <a href="#" class="parent"><span>Usuários</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a>
                            <ul id="bt_abrir_admin">                          
                                <li><a id="cadastrar" href="/admin/users/pf"><span><?php echo Yii::t("menuStrings", "widget_menu_user_pf") ?></span></a></li>
                                <li><a id="cadastrar" href="/admin/users/pj"><span><?php echo Yii::t("menuStrings", "widget_menu_user_pj") ?></span></a></li>
                            </ul>
                        </li>
                        <li><a id="listar" href="/admin/users/pf/listar_pf"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                        <!--
                        <li><a id="listar" href="/admin/users/admin/aniversariantes"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_niver") ?></span></a></li>
                        <?php if(Yii::app()->params['purple'] == '1'){ ?>
                        <li><a id="listar" href="/admin/users/admin/clientes"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_clients") ?></span></a></li>
                        <?php } ?>
                        <li><a id="listar" href="/admin/users/admin/parceiros"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_partners") ?></span></a></li>
                        <li><a id="listar" href="/admin/users/admin/profissionais"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_professionals") ?></span></a></li>
                        -->
                    </ul>
                </li>
                <li>
                    <a href="/admin/configurar/redes_sociais"><span>Redes Sociais</span></a>
                    
                </li>               
                <li>
                    <a href="#" class="parent"><span>Configurações</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/configurar/meta_tags"><span>Site</span></a></li>
                        <li><a href="/admin/configurar/google_analytics"><span>Google Analytics</span></a></li>
                        <!-- <li><a href="/admin/configurar/google_maps"><span>Google Maps</span></a></li> -->
                        <!-- <li><a href="/admin/configurar/google_tags"><span>Google Tags Manager</span></a></li>  -->                      
                        <li><a href="/admin/configurar/email"><span>E-mail de contato</span></a></li>
                        <!-- <li><a href="/admin/configurar/dispositivos"><span>Dispositivos Móveis</span></a></li> -->
                        <!-- <li><a href="/admin/configurarview/rss"><span>RSS Feeds</span></a></li> -->
                        <!-- <li><a href="/admin/configurarview/selos"><span>Selos</span></a></li> -->
                    </ul>
                </li>
                
                
               
                
                
               
                
                <?php if(Yii::app()->params['purple'] == '1'){ ?>
                <li>
                    <a href="#" class="parent"><span>SQL - Controler</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/sql/adicionar_coluna"><span>Cadastrar Coluna</span></a></li>
                        <li><a href="/admin/sql/adicionar_tabela"><span>Cadastrar Tabela</span></a></li>
                        <li><a href="/admin/sql/remover_primary_key"><span>Remover Primary Key</span></a></li>
                        <li><a href="/admin/sql/testar_conexao"><span>Testar conexão</span></a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#" class="parent"><span>Clientes - BigData</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/ping/listar_visitas_admin"><span>Acessos ao Admin</span></a></li>
                        <li><a href="/admin/ping/listar_visitas_conta"><span>Acessos ao Conta</span></a></li>
                        <li><a href="/admin/ping/listar_visitas_erp"><span>Acessos ao ERP</span></a></li>
                        <li><a href="/admin/ping/listar_purplestore"><span>Compras PurpleStore</span></a></li>
                        <li><a href="/admin/ping/listar_wiki"><span>Acessos Wiki</span></a></li>
                        <li><a href="/admin/ping/listar_canal_comunicacao"><span>Vizualizações Alertas</span></a></li>
                    </ul>
                </li>
                
                <?php } ?>
                <!-- <li><a href="/admin/documentacao/licensas"><span>Licensas e Termos</span></a></li> -->
                
                <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                <!--
                <li><a href="#" class="parent"><span>Estatísticas</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a href="/admin/documentacao/logs/listar"><span>Logs</span></a></li>
                        <li><a href="/admin/estatisticas/listar"><span>Estatísticas do Site</span></a></li>
                        <li><a href="/admin/estatisticas/visitas"><span>Estatísticas de Visitas</span></a></li>
                        <li><a href="/admin/estatisticas/google_analytics"><span>Google Analytics</span></a></li>
                    </ul>
                </li>   
                -->
                <?php } ?>               
            </ul>
        </li>
        <?php } ?>
        
        <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
        <?php if(Yii::app()->params['purple'] == '1'){ ?>
        <li><a href="#"><span>Documentação</span></a>
            <ul id="bt_abrir_colabore">
                <li><a href="#" class="fancy-how-to iframe"><span>Ajuda</span></a></li>
                
                <?php  if(($session['user_account_type'] == 2 || $session['user_account_type'] == 3) && $session['acess_level'] > 1){ ?>
                <li><a href="#" class="parent"><span>Releases</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/documentacao/releases/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/documentacao/releases/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if(Yii::app()->params['purple'] == '1'){ ?>
                <li><a href="#" class="parent"><span>Bugs</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/documentacao/bugs/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/documentacao/bugs/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                <?php } ?>
                <li><a href="#" class="parent"><span>Apontamento</span></a>
                    <ul id="bt_abrir_admin">
                        <li><a id="cadastrar" href="/admin/documentacao/apontamento/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                        <li><a id="editar" href="/admin/documentacao/apontamento/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
                    </ul>
                </li>
                
            </ul>
        </li>
        <?php } ?>
        <?php } ?>
        <li id="hide" class="last"><a href="/admin/logout"><span>Sair</span></a></li>
    </ul>
</div>
<input type="hidden" id="bt" value="<?php echo $this->result['path'] ?>"/>
<div id="copyright" style="display: none">Copyright &copy; 2010 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>