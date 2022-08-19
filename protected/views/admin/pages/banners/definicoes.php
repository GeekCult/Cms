<link rel="stylesheet" type="text/css" href="/media/user/css/main.css"/>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Definições do Banner principal</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    
   
    <div class="layoutAdmin_htmlBanner">
        <?php if(true == true) { ?>
  
        <?php include Yii::app()->getBasePath() . "/views/site/common/banner/banner.php"; ?>
        
        <?php }else { ?>
        <div class="result-message">
            <span><?php echo Yii::t('adminForm', 'message_result_no_records_found') ?></span>
        </div>
        <?php }?>         
    </div>
    <form id="form_content">
        <div class="layoutAdmin_htmlBanner">
            <ul>
               <li class="rows"> 
                    <div class="left" style="width: 400px;">
                        <div class="label_text_Admin_logos" style="margin-top: 8px;">Altura</div>             
                        <input type="text" id="banner_altura" value="<?php echo $preferences['main_banner_altura']?>"/>
                    </div>
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Altura do seu banner</h3></div>
                            <div class="topic info_text_line">Defina aqui uma altura padrão para seu banner</div>
                            <div class="topic info_text_line">Se esse valor não for preenchido seu banner ficará estranho</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="rows"> 
                    <div class="left" style="width: 400px;">
                        <div class="label_text_Admin_logos" style="margin-top: 8px;">Margem do topo</div>             
                        <input type="text" id="banner_distancia" value="<?php echo $preferences['main_banner_distancia']?>"/>                        
                        <div class="clear mgT2" style="width: 400px;">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Margem da base</div>             
                            <input type="text" id="banner_distancia_base" name="margin_base" value="<?php echo $margin_base ?>"/>
                        </div>
                    </div>
                    
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Distancia do seu banner em relação ao topo</h3></div>
                            <div class="topic info_text_line">Defina aqui uma distancia para seu banner</div>
                            <div class="topic info_text_line">Se esse valor não for preenchido ele pegará o padrão do layout</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php if(!isset($purpleitem)){ ?>
                <li class="rows"> 
                    <div class="left" style="width: 400px;">
                        <div class="label_text_Admin_logos" style="margin-top: 8px;">Setas</div>             
                        <div class="styled-select transparent">
                            <select id="buttons_laterais">
                                <option value="side_black_arrow.png">Setas pretas</option>
                                <option value="side_arc_white.png">Semi arcos transparents</option>
                                <option value="side_simple_arrow.png">Setas simples</option>
                                <option value="circulos_arrow.png">Circulos com seta preta</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                        <div class="label_text_Admin_logos" style="margin-top: 8px;">Painel de contagem</div>             
                        <input type="checkbox" id="painel_banner" name="painel_banner" class="left mgR" <?php if($main_banner_painel) echo "checked" ?>/> 
                        <span></span>
                    </div>
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Setas de navegação</h3></div>
                            <div class="topic info_text_line">Escolha seta para trocar seus banners quando tiver mais de um.</div>
                            <div class="topic info_text_line">Pelo menos um modelo deve ser escolhido</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="rows"> 
                    <div class="left" style="width: 400px;">
                        <div class="label_text_Admin_logos" style="margin-top: 8px;">Sombra</div>             
                        <div class="styled-select transparent">
                            <select id="shadow_banner">
                                <option value="" <?php if($main_banner_shadow == '') echo "selected" ?>>Nenhuma</option>
                                <option value="shadow_square.png" <?php if($main_banner_shadow == 'shadow_square.png') echo "selected" ?>>Sombra Billboard</option>
                                <option value="shadow_flip.png" <?php if($main_banner_shadow == 'shadow_flip.png') echo "selected" ?>>Sombra Flip</option>
                                <option value="shadow_morse.png" <?php if($main_banner_shadow == 'shadow_morse.png') echo "selected" ?>>Sombra Morse</option>
                            </select>
                        </div>
                    </div>
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Sombra</h3></div>
                            <div class="topic info_text_line">Exibe uma sobra abaixo do banner principal dando um efeito de destaque</div>
                            <div class="topic info_text_line">Escolha uma sombra se desejar.</div>
                            <div class="topic info_text_line">Se não desejar deixe em Nenhuma</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php }else{ ?>
                <li class="rows"> 
                    <div class="left" style="width: 400px;">
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Sombra</div>             
                            <div class="">
                                <input type="checkbox" name="shadow" <?php if($shadow) echo 'checked' ?>/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Fullscreen</div>             
                            <div class="">
                                <input type="checkbox" name="fullscreen" <?php if($fullscreen) echo 'checked' ?>/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Caption</div>             
                            <div class="">
                                <input type="checkbox" name="caption" <?php if($caption) echo 'checked' ?>/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Autoplay</div>             
                            <div class="">
                                <input type="checkbox" name="autoplay" <?php if($autoplay) echo 'checked' ?>/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Lightbox</div>             
                            <div class="">
                                <input type="checkbox" name="lightbox" <?php if($lightbox) echo 'checked' ?>/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px;">Intervalo</div>             
                            <div class="">
                                <input type="text" name="intervalo" value="<?php if($intervalo != 0){echo $intervalo;}else{echo '5';}  ?>"/>
                            </div>
                        </div>
                        <div class="clear mgB">
                            <div class="label_text_Admin_logos" style="margin-top: 8px; float: left">Animation</div>             
                            <div class="styled-select">
                                <select name="animation" id="animation">
                                    <option value="1">Basico direita para esquerda</option>            
                                    <option value="2">Basico Esquerda para direita</option>
                                    <option value="3">Basic bottom to top</option>
                                    <option value="4">Basic top to bottom</option>
                                    <option value="5">Horizontal Bar right to left</option>
                                    <option value="6">Horizontal Bar left ro right</option>
                                    <option value="7">Horizontal Bar right to left Bounce</option>
                                    <option value="8">Horizontal Bar left to right Bounce</option>
                                    <option value="9">Horizontal Bar Reverse right to left</option>
                                    <option value="10">Horizontal Bar Reverse left to right</option>
                                    <option value="11">Vertical Bar top to bottom</option>
                                    <option value="12">Vertical Bar bottom to top</option>
                                    <option value="13">Vertical Bar top to bottom Bounce</option>
                                    <option value="14">Vertical Bar bottom to top Bounce</option>
                                    <option value="15">Vertical Bar Reverse top to bottom</option>
                                    <option value="16">Vertical Bar Reverse bottom to top</option>
                                    <option value="17">Horizontal Bar Sequential right to left</option>
                                    <option value="18">Horizontal Bar Sequential left to right</option>
                                    <option value="19">Horizontal Bar SequentialR right to left</option>
                                    <option value="20">Horizontal Bar SequentialR left to right</option>
                                    <option value="21">Horizontal Bar Sequential right to left Bounce</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Sombra</h3></div>
                            <div class="topic info_text_line">Escolha uma sombra se desejar.</div>
                            <div class="topic info_text_line">Se não desejar deixe em Escolha</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <input type="hidden" name="id_purpleitem" value="<?php echo $purpleitem['id'] ?>"/>
                </li>
                <?php } ?>
            </ul>
        </div>
    </form>
    <div class="clear"></div>
    <input type="hidden" id="helper_action" data-animation="<?php if(isset($animation)) echo $animation ?>"/>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_save"); ?>" />
    </div>
    <div class="clear height_support"></div>
</div>
<script type="text/javascript">setTimeout(function(){initListenersDefinicoes();},1000);</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>