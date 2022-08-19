<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "details_page_header") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>

    <div id="buttons_support" class="layoutAdmin">
        <div class="container_texture_empty">
            <div class="title_empty_texture">
                <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
            </div>                        
        </div>
        <h2><?php echo Yii::t("adminForm", "common_details") ?></h2>        
        <ul id="slot_support">            
            <li class="rows">
                <div class="label_text_Admin_logos mgR">Topo - Altura</div>             
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <input type="input" id="topo_altura" class="mini2 left" value="<?php echo $content['topo_altura'] ?>" class="mgR"/>
                        <span class="mgL text fS">Deixe vazio se desejar utilizar tamanho original</span>
                    </div>
                </div>
                <div class="label_text_Admin_logos mgR">Topo - Textura </div>             
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <input type="checkbox" id="topo_fit" name="topo_fit" class="checkbox left" <?php if($content['topo_fit']) echo "checked"; ?>/>
                        <span class="text fS" style="margin-left: 22px;">Encaixar a textura no tamanho do topo</span>
                    </div>
                </div>
                
                <div class="divider_horizontal mgB"></div>
                <div class="label_text_Admin_logos mgR">Logo - Altura</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="altura" class="mini2 left" value="<?php echo $content['logo_altura'] ?>" class="mgR"/>
                        <span class="mgL text fS">Deixe vazio se desejar utilizar tamanho original da imagem</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos mgR">Logo - Largura</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="largura" class="mini2 left" value="<?php echo $content['logo_largura'] ?>" class="mgR"/>
                        <span class="mgL text fS">Deixe vazio se desejar utilizar tamanho original da imagem</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos mgR">Logo - Pos Y</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="pos_y" class="mini2 left" value="<?php echo $content['logo_pos_y'] ?>" class="mgR"/>
                        <span class="mgL text fS">Digite o valor para posicionar o logo para cima e para baixo</span>
                    </div>
                </div>
                <div class="clear"></div>
               <div class="label_text_Admin_logos mgR">Logo - Pos X</div>             
               <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="pos_x" class="mini2 left" value="<?php echo $content['logo_pos_x'] ?>" class="mgR"/>
                        <span class="mgL text fS">Digite o valor para posicionar o logo para esquerda e direita</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos mgR">Logo - Container largura</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="container_largura" class="mini2 left" value="<?php echo $content['logo_container_width'] ?>" class="mgR"/>
                        <span class="mgL text fS">Digite o valor para aumentar a largura do container do logo (não interfere no tamanho do logo)</span>
                    </div>
                </div>
                <div class="clear"></div>
               <div class="label_text_Admin_logos mgR">Logo - Container altura</div>             
               <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="container_altura" class="mini2 left" value="<?php echo $content['logo_container_height'] ?>" class="mgR"/>
                        <span class="mgL text fS">Digite o valor para aumentar a altura do container do logo (não interfere no tamanho do logo)</span>
                    </div>
                </div>
            </li>
            <li class="row"><div class="divider_horizontal mgB"></div></li>
            <li class="rows">
                <h2>Outros detalhes</h2>
            </li>
            <li class="rows">
                <div class="label_text_Admin_logos mgR">Frase - Buscar</div>             
               <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="frase_searchbox" class="half left" value="<?php echo $content['frase_searchbox'] ?>" class="mgR"/>
                        <span class="mgL text fS">Frase no campo de busca</span>
                    </div>
                </div>
            </li>
        </ul>   
        <p>&nbsp</p>
        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update_topo" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <p>&nbsp;</p>
    <div class="clear height_support"></div>
    <input type="file" class="hide" id="file"/>
</div>

<script type="text/javascript">initExtremosListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>