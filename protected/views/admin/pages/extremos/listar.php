<script type="text/javascript" src="/js/admin/banners.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo $title_current ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    
    <a href="/admin/<?php echo $local ?>/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <a href="/admin/html_banners/estatisticas">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_statistics") ?>"/>
    </a>
    <div class="clear"></div>
    <div class="container_devices_options left">
        <div class="picture_container_page"></div>
        <div class="title_devices">Você está editando <span class="title_device_name"><?php echo $session['device']?></span></div>
        <div class="title_empty_texture">
            <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
            <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
            <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
        </div>
    </div>
    <?php if($type == "banners"){ ?>
    <div class="sizeBannerSelector">
        <div class="label_text_banner"><?php echo Yii::t('adminForm', 'common_size') ?></div>
        <div class="label_text_banner"><a href="/admin/html_mini/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">200px</a></div>
        <div class="label_text_banner"><a href="/admin/html_blocks/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">250px</a></div>
        <div class="label_text_banner"><a href="/admin/html_spark/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">300px</a></div>
        <div class="label_text_banner"><a href="/admin/html_corona/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">450px</a></div>
        <div class="label_text_banner"><a href="/admin/html_lonsdale/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">720px</a></div>
        <div class="label_text_banner"><a href="/admin/html_banners/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">980px</a></div>
        <div class="label_text_banner"><a href="/admin/html_mainbanners/<?php if($is_purchase){echo "comprar";}else{echo "listar";} ?>">Banner Principal</a></div>
        <div class="clear"></div>
    </div>
    <?php } ?>
    <div class="layoutAdmin">
        <div class="content_buy_pp">
            <div class="titulo_comprar">
                <h4 class="left mgR0" style="margin-top: 0px;">Items</h4>
                <span style="font-size: 0.8em; display: inline-block; padding-top: 3px;"> - edite, troque, selecione seus items ou adquira novos</span>
            </div>
            
            <div class="right"><input type="button" class="botao <?php if($action == 'comprar') echo 'active' ?>" value="comprar" id="bt_buy_item" name="<?php echo $local ?>"/></div>
            <div class="right"><input type="button" class="botao <?php if($action == 'listar') echo 'active' ?>" value="meus items" id="bt_my_item" name="<?php echo $local ?>"/></div>
            <div class="clear"></div>
            <div id="fancybox_buy_items" class="iframe"></div>
        </div>
        <div class="divider_shadow_full_up"></div>
        <div class="layoutTopos">      
            <p>&nbsp;</p>
            <div id="buttons_banner_list_support" class="contentLayouts_TODOREMOVER">
                
                <?php if ($type == "banners") { ?>
                <div class="ctn_check_pp" id='ctnAll'>
                    <div class="bold">Escolha as páginas de exibição</div>
                    <div class="bt_close_black right" style="margin: -30px 0 0 0"></div>
                    <div class="divider_horizontal"></div>
                    <div class="contentCheckBoxes">
                        <?php $u = 0; for($p = 0; $p < count($paginas); $p++) { ?>

                            <?php if ($u == 0) { ?>
                            <ul class="ul_pg">
                            <?php } ?>
                                <div class="item_pagina_pp truncate">
                                    <input type="checkbox" id="pg_<?php echo $paginas[$p]["id"] ?>" name="<?php echo $paginas[$p]["id"] ?>" value="true" class="left mgR0" data-id='check_select'/>
                                    <input type="text" id="idx_<?php echo $paginas[$p]["id"] ?>" value="" class="miniT"/>
                                    <span  title='<?php echo $paginas[$p]['label']; ?>'><?php echo $paginas[$p]['label']; ?></span>
                                    <div class="clear"></div>
                                </div>
                            <?php if($u == 9){ ?>
                            </ul>
                            <?php } ?>

                        <?php $u++; if ($u == 10) $u=0; } ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="divider_horizontal"></div>                    
                    <div class="clear"></div>
                </div>
                <?php } ?>
                
                <?php if ($type == "banners" && (defined('Settings::PIER_PUBLICIDADE_FLUTUANTE') && Settings::PIER_PUBLICIDADE_FLUTUANTE)) { ?>
                <div class="ctn_check_flutuante" id='ctnFlutuante'>
                    <div class="bold" style="margin: 0px 0px 8px 0">Publicidade Flutuante</div>
                    <div class="bt_close_pb right" style="margin: -30px 0 0 0" id="bt_close_publicidade_flutuante"></div>
                    <div class="divider_horizontal"></div>
                    <p>&nbsp;</p>
                    <p>Preencha os dados abaixo para publicar esse banner na sua Publicidade Flutuante</p>
                    <div class="clear mgB"></div>
                    <div class="contentCheckBoxes">
                        <ul>
                            <li><input type="text" placeholder="Exibir até" id="expira_flutuante"/><span class="sF legend mgL">Ex: 23/03/2014</span></li>
                            <li><input type="checkbox" class="mgR left" id="exibe_publicidade_flutuante"/><div class="mgL left"><label class="sF" for="exibe_publicidade_flutuante">Exibe na Publicidade Flutuante</label></div></li>
                        </ul>
                    <div class="clear mgB2"></div>
                    <div class="divider_horizontal"></div>
                    <a href="/admin/html_banners/flutuante_configurar">
                        <input id="bt_settings_flututante" type="button" value="configurações" class="botao mgT2 left"/>
                    </a>
                    <input id="bt_save_flututante" type="button" value="salvar" class="botao mgT2 right"/>
                    </div>
                </div>
                <?php } ?>
                
                <?php if ($type == "banners" && (defined('Settings::PIER_PUBLICIDADE_GLOBAL') && Settings::PIER_PUBLICIDADE_GLOBAL)) { ?>
                <div class="ctn_check_flutuante" id='ctnGlobal'>
                    <div class="bold" style="margin: 0px 0px 8px 0">Publicidade Global</div>
                    <div class="bt_close_pb right" style="margin: -30px 0 0 0" id="bt_close_publicidade_global"></div>
                    <div class="divider_horizontal"></div>
                    <p>&nbsp;</p>
                    <p>Preencha os dados abaixo para publicar esse banner na Publicidade Global</p>
                    <div class="clear mgB"></div>
                    <div class="contentCheckBoxes">
                        <ul>
                            <li><input type="text" placeholder="Exibir até" id="expira_global"/><span class="sF legend mgL">Ex: 23/03/2014</span></li>
                            <li><input type="checkbox" class="mgR left" id="exibe_publicidade_global"/><div class="mgL left"><label class="sF" for="exibe_publicidade_global">Exibe na Publicidade Global</label></div></li>
                        </ul>
                    <div class="clear mgB2"></div>
                    <div class="divider_horizontal"></div>
                    <a href="/admin/html_banners/flutuante_configurar">
                        <input id="bt_settings_global" type="button" value="configurações" class="botao mgT2 left"/>
                    </a>
                    <input id="bt_save_global" type="button" value="salvar" class="botao mgT2 right"/>
                    </div>
                </div>
                <?php } ?>


                <?php if (count($content) > 0 && $content[0] != "vazio") { ?> 
                <?php foreach ($content as $values) { ?>                
                    <div class="clear mgB" id="obj_container_<?php echo $values['id'] ?>">
                        
                        <div class="banner_html_support tranparent">
                            <div class="<?php echo $values["tipo"] ?> row-fluid">
                                <?php if($values["modelo"] != 'render_partial'){ ?>
                                <div class="canvas_stage<?php echo $values["id"] ?>" id="stage"></div>
                                <script type="text/javascript">addBannerHTML('<?php echo json_encode($values["cool2"]) ?>', '<?php echo $values["id"] ?>')</script>
                                <script type="text/javascript">setSizeBanner('<?php echo $values["altura"] ?>', '<?php echo $values["largura"] ?>', '<?php echo $values['id'] ?>');</script>
                                <?php }else{ ?>
                                <?php if($local != 'rodapes' && $local != 'topos' ) {
                                    if(!$is_purchase) $this->renderPartial("/site/common/".$type_size. $values["cool"], $values["cool3"]);
                                    $tipo = $values["tipo"]; if($tipo == "html_mainbanners") $tipo = "html_banners";
                                    if( $is_purchase) echo "<img src='https://www.purplepier.com.br/media/images/layout_extremos/${tipo}/${values["thumb"]}'>";
                                }?> 
                                <?php if($local == 'rodapes' || $local == 'topos'){ if($local == 'rodapes') $tipo_local = "footer"; if($local == 'topos') $tipo_local = "header"; ?>
                                        <?php //if(!$is_purchase) include Yii::app()->getBasePath() . "/views/site/common/" . $tipo_local . "/site/special/" . $values["cool"] . '.php'; ?>
                                         <?php if(!$is_purchase) echo "<img src='https://www.purplepier.com.br/media/images/layout_extremos/${local}/${values["cool"]}.png'>"; ?>
                                         <?php if( $is_purchase) echo "<img src='https://www.purplepier.com.br/media/images/layout_extremos/${local}/${values["thumb"]}'>"; ?>
                                <?php }} ?>
                            </div>
                        </div>
                        
                        
                        
                        <?php if($action == 'listar'){ ?>
                            
                        <div class="CTTT">
                        <?php if(($local != 'topos' && $local != 'rodapes' && $local != 'html_mainbanners') && !$is_purchase){ ?>
                        <div class='label_swf_2 mgL0'>
                            <input type="button" id="<?php echo $values["id"] ?>" class="bt_publicidade_dirigida" title="Publicidade Dirigida"/>
                        </div>
                        <?php } ?>
                            
                        <div class="radioToposRodapes">
                            <?php if ($type != "banners") { ?>
                                <?php if ($type == "topos") { ?>
                                <input id="opcao_<?php echo $values["id"] ?>" type="radio" name="opcao" value="<?php echo $values["id"] ?>" <?php if ($preferences["topo"]['id'] == $values["id"]) echo "checked"; ?> class="left mgR0 mgT0 mgL0"/>
                                <label for="opcao_<?php echo $values["id"] ?>" style="margin-left: 5px; height: 15px; font-size: 0.9em; display: inline-block;"><?php echo $values["nome"] ?></label>
                                <?php } else { ?>
                                <input id="opcao_<?php echo $values["id"] ?>" type="radio" name="opcao" value="<?php echo $values["id"] ?>" <?php if ($preferences["rodape"]['id'] == $values["id"]) echo "checked"; ?> class="left mgR0 mgT0 mgL0"/>
                                <label for="opcao_<?php echo $values["id"] ?>" style="margin-left: 5px; height: 15px; font-size: 0.9em; display: inline-block;"><?php echo $values["nome"] ?></label>
                                <?php } ?>
                            <?php } ?>
                        </div>                        
                        
                        <?php if ($values["tipo"] == "html_mainbanners") { ?>
                            <div class="checkbox_mainbanner">
                                <label for="check_select" class="left mgL mgR">Exibir</label>
                                <input type="checkbox" value="<?php echo $values["id"] ?>" id="check_select" class="html_banner_checkbox left mgR" <?php if($values["exibe"] == '1')echo "checked"; ?>/>
                            </div>
                        <?php } ?>
                        <div  class="excluir"> 
                            <?php if($local != 'topos' && $local != 'rodapes'){ ?>
                            <?php if(defined('Settings::PIER_PUBLICIDADE_GLOBAL') && Settings::PIER_PUBLICIDADE_GLOBAL){ ?>
                            <input type="button" id="<?php echo $values["id"] ?>" class="bt_publicidade_global left mgR0" title="Publicidade Global - Timpan.us"/>
                            <?php } ?>
                            <?php if(defined('Settings::PIER_PUBLICIDADE_FLUTUANTE') && Settings::PIER_PUBLICIDADE_FLUTUANTE){ ?>
                            <input type="button" id="<?php echo $values["id"] ?>" class="bt_publicidade_flutuante left mgR0" title="Publicidade Flutante"/>
                            <?php } ?>
                            <?php if(defined('Settings::PIER_PUBLICIDADE_ONLINE') && Settings::PIER_PUBLICIDADE_ONLINE){ ?>
                            <input type="button" id="bt_publicidade_online" name="<?php echo $values["id"] ?>" class="left mgR0" title="Publicidade Online"/>
                            <?php } ?>
                            <?php } ?>
                            <?php if($values["modelo"] == 'render_partial'){ ?>
                            <input type="button" id="bt_edit_render" class="bt_edit left" name="<?php echo $values["id"] ?>" title="editar"/>
                            <?php }else{ ?>
                            <input type="button" id="bt_edit" class="left" name="<?php echo $values["id"] ?>" title="editar"/>
                            <?php } ?>
                            <input type="button" class="bt_support_delete" id="bt_delete" name="<?php echo $values["id"] ?>" title="excluir" class="left"/>
                        </div>
                        </div>
                        <?php }else{ ?>
                        <div class="divider_horizontal"></div>
                        <div class="left" style="font-size: 0.8em; margin: 15px 0 0 0; width: 75%;">
                            <div class="truncate"><?php echo $values["descricao"] ?></div>
                        </div>
                        <div class="valor left ctnValor"><?php echo $values["valor_string"] ?></div>
                        <input  type="button" class="botao right mgT0 bt_buy_item_pp" value="comprar" name="<?php echo $values['id'] ?>" rel="<?php echo $values["modelo"] ?>"/>
                        <?php } ?>
                        <div class="clear mgB"></div>
                        <div class="divider_shadow"></div>
                    </div>
                    
                    
                <?php }}else{ ?>
                <div class="result-message">
                    <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
<div class="clear"></div>
<p>&nbsp;</p>
<div class="buttons_right">
    <?php if($local == "topos" || $local == "rodapes"){ ?>
    <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
    <?php }?>
    <input type="button" class="bt_right"  id="bt_top" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
</div>



<div class="clear height_support"></div>
<input id="helper_id_html_action" value="listar" type="hidden" data-id-flutuante=""/>
<input id="helper_local" value="<?php echo $local ?>" type="hidden"/>
<input id="helper_qtd_pages" value="<?php echo count($paginas) ?>" type="hidden"/>
<input id="helper_mini_site" data-url="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUrl'] ?>" type="hidden" value="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUser'] ?>"/>
<div class="menu_shortcut">
    <ul>
        <?php if($action == "novo"){ ?>
        <li><input type="button" class="iSM icon_save" id="bt_submit"/></li>
        <?php } else { ?>
        <li><input type="button" class="iSM icon_save" id="bt_update"/></li>
        <?php }  ?>
        <li>
            <a href="/admin/<?php echo $local ?>/novo">
                <input type="button" class="iSM icon_new"/>
            </a>
        </li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>

<script type="text/javascript">initListenerListar();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>