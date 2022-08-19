<link rel='stylesheet' type='text/css' href='/css/site/modulos/banners/html_mainbanners/splash.css' />
<div class='ctnBillboard bnSplash' <?php if(isset($margin_1)) echo "style='margin-bottom:" .$margin_1."px'" ?>>
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
    
    <div class="bgBnSplash" <?php if(isset($image1['src'])){ ?>style="background: url(/media/user/images/original/<?php echo $image1['src'] ?>)" <?php } ?>></div>
    <div class='container_block_row container flexAdmin'>
        <div class="span12">
            <div class='ctnFullBillboard thumbnails center relative'>                
                <div class="row-fluid row-eq-height">
                    <div class="col-sm-6 padding_0">
                        <div class='ctnTextRolodex'>
                            <div class="row-fluid">
                                <div class="row-fluid ctnRl_1 hide">
                                    <div class='baseTextSplash bs_Bg_1' style="<?php if(isset($image1['src']) && $textura1['src'] != '') echo "background:url(/media/images/textures/site/" . $textura1['src'].");"; if(isset($textura1['variante']) && $textura1['variante']) echo 'opacity: 0.6;';  ?>"></div>
                                    <div class='TextSplash'>
                                        <h2 class="rlT_1 opacity_0" style="<?php if(isset($titulo1['color'])){ if($titulo1['color'] != '') echo "color:" . $titulo1['color'].";"; if($titulo1['f_type'] != '') echo "font-family:'" . str_replace("+", " ", $titulo1['f_type'])."';"; if($titulo1['s_text'] != '') echo "font-size:" . $titulo1['s_text']."em;";}  ?>"><?php if(isset($titulo1['descricao'])) echo $titulo1['descricao'] ?></h2>
                                        <h4 class="lead rlP_1 p1 opacity_0" style="<?php if(isset($titulo2['color'])){ if($titulo2['color']) echo "color:" . $titulo2['color'] ."!important;"; if($titulo2['f_type'] != '') echo "font-family:'" . str_replace("+", " ", $titulo2['f_type'])."';"; if($titulo2['s_text'] != '') echo "font-size:" . $titulo2['s_text']."em;"; } ?>"><?php if(isset($titulo2['descricao'])) echo nl2br($titulo2['descricao']) ?></h4>
                                        <p  class="lead rlP_1 p1 opacity_0" style="<?php if(isset($texto1['color'])){ if($texto1['color']) echo "color:" . $texto1['color'] ."!important;"; if($texto1['f_type'] != '') echo "font-family:'" . str_replace("+", " ", $texto1['f_type'])."';"; if($texto1['s_text'] != '') echo "font-size:" . $texto1['s_text']."em;"; } ?>"><?php if(isset($texto1['descricao'])) echo nl2br($texto1['descricao']) ?></p>
                                        <div class="clear"></div>
                                        <?php if(isset($botao1['variante']) && $botao1['variante'] === '1'){ ?>
                                        <?php if(isset($botao1['link']) && $botao1['link'] != ''){ ?><a href="<?php echo $botao1['link'] ?>" target="<?php if($botao1['s_thumb'] == 1){echo "_self";}else{echo "_blank";} ?>"><?php } ?>
                                        <input type="button" class="btn-main botao mgB2 rlBt_1 p1 opacity_0" value="<?php if(isset($botao1['descricao']) && $botao1['descricao'] != '') echo  $botao1['descricao']; ?>"/>
                                        <?php if(isset($botao1['link']) && $botao1['link'] != ''){ ?></a><?php } ?>
                                        <?php } ?>
                                        <div class="clear mgB"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 padding_0">
                        <div class="ctn_iRl_1 hide imgHgCtn">
                            <div class="iRl_1 opacity_0 imgHgCtn">
                                <div class='imgBillboard hide_resp'>
                                    <img src='<?php if(isset($image2['src'])) echo $path_image . $image2['src'] ?>' alt='<?php if(isset($image2['src'])) echo $image2['src'] ?>'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>            
        </div>
    </div>
    <div class='clear'></div>
    <input type="hidden" class="bannerPAttr" data-nr-animation="<?php if(isset($attr['nr_animation']) && ($attr['nr_animation'] != "" && $attr['nr_animation'] > 0 && $attr['nr_animation'] <= 3)){ echo $attr['nr_animation'];}else{echo '1';} ?>" data-intervalo-animation="<?php if(isset($attr['intervalo_animation']) && ($attr['intervalo_animation'] != "" )){ echo $attr['intervalo_animation'];}else{echo '5000';} ?>" data-wallpaper="<?php if(isset($image1['src'])) echo $image1['src'] ?>" data-callback="animateInSplash"/>
</div>
<script src="/js/modulos/banners/splash.js"></script>