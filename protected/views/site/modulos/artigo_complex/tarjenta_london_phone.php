<?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
<?php $path_image = "https://www.purplepier.com.br/media/images/textures/site/"; ?> 
<?php if($is_full){ ?>
<div id="tarjenta_london_phone_<?php echo $id ?>" style="<?php if($margin_bottom != "") echo "margin-bottom: {$margin_bottom}px;"; if($margin_top != "") echo "margin-top: {$margin_top}px;";if($padding_bottom != "") echo "padding-bottom: {$padding_bottom}px;"; if($padding_top != "") echo "padding-top: {$padding_top}px;";if($background != "") if($background_type == 0){echo "background: url($path_image$background)";}else if($background_type == 2){echo "background: url($path_image$background); background-color: $background_color";}else{echo "background: url($path_image$background)";} ?>">
<?php } ?>
    <div class="row-fluid">
        <div class="container" <?php if(!$is_full){ ?> style="<?php if($margin_bottom != "") echo "margin-bottom: {$margin_bottom}px;"; if($margin_top != "") echo "margin-top: {$margin_top}px;"; if($padding_bottom != "") echo "padding-bottom: {$padding_bottom}px;"; if($padding_top != "") echo "padding-top: {$padding_top}px;";if($background != "") if($background_type == 0){echo "background: url($path_image$background)";}else if($background_type == 2){echo "background: url($path_image$background); background-color: $background_color";}else{echo "background: url($path_image$background)";} ?>"<?php } ?>>
            
                
            <div class="" style="<?php if($item1_cor_3)echo "background-color:  $item1_cor_3!important;"?>">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="center mgT">
                            <div class="circle_regular" style="<?php if($item1_cor_2)echo "background-color:  $item1_cor_2!important;"?>">
                                <i class="fa fa-phone fa-icon-xlarge" style="<?php if($item1_cor_4)echo "color:  $item1_cor_4!important;"?>"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                       <h3 <?php if($item1_cor_1)echo "style='color: $item1_cor_1'"?> <?php if($item1_alinhamento_1 != "") echo "class='t_$item1_alinhamento_1'" ?>><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h3>  
                    </div>
                </div>
                
                <?php if($subtitulo_1 != ""){ ?>
                <div class="row-fluid">
                    <div class="span12">
                    <p <?php if($item2_cor_1)echo "style='color: $item2_cor_1'"?> class='lead <?php if($item1_alinhamento_2 != "") echo "t_$item1_alinhamento_2" ?>' > &nbsp;<?php if($subtitulo_1 != ""){echo $subtitulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></p>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($texto_1) && $texto_1 != ""){ ?>
                <div class="clear <?php if($texto_1 != "") echo "inline_block" ?>"><p <?php if($item1_cor_3)echo "style='color: $item1_cor_3'"?> <?php if($item1_alinhamento_3 != "") echo "class='t_$item1_alinhamento_3'" ?>><?php if($texto_1 != ""){echo $texto_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></p></div>
                <?php } ?>

            </div>
          
        </div>        
    </div>
<?php if($is_full){ ?>
</div>
<?php } ?>

