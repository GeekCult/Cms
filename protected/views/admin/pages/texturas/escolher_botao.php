<div class="container_pan">
    <link rel='stylesheet' type='text/css' href='/css/admin/general/botao_responsivo.css'/>
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", 'textures_page_list_title_see') . $title_texture ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <?php if(Yii::app()->params['local'] == 1 || Yii::app()->params['purple'] == 1){ ?>
    <a href="/admin/texturas/<?php echo $title_texture ?>/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_acervo') ?>"/>
    </a>
    <?php } ?>
    <a href="/admin/texturas/<?php echo $title_texture?>/adicionar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_new') ?>"/>
    </a>
    <input type="button" class="bt_right bt_define" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
    <div class="clear"></div>
    <div class="layoutAdmin_blocks">        
        <div id="buttons_support" class="layout_textures"> 
            <div id="menu_conta" class="mgT2 mgB2">
                <div class="menu_conta_container_buttons" style="right:0">
                    <ul>
                        <li id="link_conta_01" class="blc_tab" data-tab="0"><a href="/admin/texturas/botao/listar"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Comum</div><div class="tab_corner_disable_right"></div></a></li>
                        <li id="link_conta_02" class="blc_tab" data-tab="1"><a href="/admin/texturas/botao_especial/escolher"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Especial</div><div class="tab_corner_disable_right"></div></a></li>
                    </ul>
                </div>
            </div>
            <div class="divider_horizontal"></div>
            
            <div class="container_texture_empty">
                <div class="title_empty_texture">
                    <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                    <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                    <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
                </div>                          
            </div>
            <div class="clear divider_shadow"></div>
            <div class="clear"></div>
            <ul>
                <li class="row">
                    <div class="">
                        <input type="checkbox" id="check_escolhe" class="left mgR" name="check_escolhe" <?php if($content['button_type_special']) echo 'checked' ?>/>
                        <div class="legend">Caso deseje utilizar especial deixe selecionado</div>
                    </div>                    
                    <div class="clear"></div>
                    <div class="mgT2 mgB2"></div>
                </li>
                <li class="row">
                    <div class="left">
                        <input type="button" class="<?php if($content['button_main_special'] != ""){echo 'btn ' . $content['button_main_special'];}else{ echo "botao";}  ?>" id="bt_main_escolhe" value="principal"/>
                    </div>
                    <div class="right mgB2">
                        <div class="styled-select">
                            <select name="botao_main" id="botao_main">
                                <option value="">Escolher</option>
                                <option value="btn-flat-blue" <?php if($content['button_main_special'] == "btn-flat-blue") echo 'selected' ?>>Flat Azul</option>
                                <option value="btn-simple-blue" <?php if($content['button_main_special'] == "btn-simple-blue") echo 'selected' ?>>Simples Azul</option>
                                <option value="btn-red" <?php if($content['button_main_special'] == "btn-red") echo 'selected' ?>>Gradiente Vermelho</option>
                                <option value="btn-green" <?php if($content['button_main_special'] == "btn-green") echo 'selected' ?>>Gradiente Verde</option>
                                <option value="btn-white" <?php if($content['button_main_special'] == "btn-white") echo 'selected' ?>>Gradiente Branco</option>
                                <option value="btn-purple" <?php if($content['button_main_special'] == "btn-purple") echo 'selected' ?>>Gradiente Roxo</option>
                                <option value="btn-orange-shine" <?php if($content['button_main_special'] == "btn-orange-shine") echo 'selected' ?>>Brilhante Laranja</option>
                                <option value="btn-yellow" <?php if($content['button_main_special'] == "btn-yellow") echo 'selected' ?>>Amarelo</option>
                            </select>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="divider_horizontal mgT2 mgB2"></div>
                </li>
                
                <li class="row">
                    <div class="left mgT2">
                        <input type="button" class="<?php if($content['button_second_special'] != ""){echo 'btn ' . $content['button_second_special'];}else{ echo "botao";}  ?>" id="bt_second_escolhe" value="secundário"/>
                    </div>
                    <div class="right mgB2 mgT2">
                        <div class="styled-select">
                            <select name="botao_second" id="botao_second">
                                <option value="">Escolher</option>
                                <option value="btn-flat-blue" <?php if($content['button_second_special'] == "btn-flat-blue") echo 'selected' ?>>Flat Azul</option>
                                <option value="btn-simple-blue" <?php if($content['button_second_special'] == "btn-simple-blue") echo 'selected' ?>>Simples Azul</option>
                                <option value="btn-red" <?php if($content['button_second_special'] == "btn-red") echo 'selected' ?>>Gradiente Vermelho</option>
                                <option value="btn-green" <?php if($content['button_second_special'] == "btn-green") echo 'selected' ?>>Gradiente Verde</option>
                                <option value="btn-white" <?php if($content['button_second_special'] == "btn-white") echo 'selected' ?>>Gradiente Branco</option>
                                <option value="btn-purple" <?php if($content['button_second_special'] == "btn-purple") echo 'selected' ?>>Gradiente Roxo</option>
                                <option value="btn-orange-shine" <?php if($content['button_second_special'] == "btn-orange-shine") echo 'selected' ?>>Brilhante Laranja</option>
                                <option value="btn-yellow" <?php if($content['button_second_special'] == "btn-yellow") echo 'selected' ?>>Amarelo</option>
                            </select>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="divider_horizontal mgT2 mgB2"></div>
                </li>
                
                <li class="row">
                    <div class="left mgT2">
                        <input type="button" class="<?php if($content['button_success_special'] != ""){echo 'btn ' . $content['button_success_special'];}else{ echo "botao";}  ?>" id="bt_success_escolhe" value="destaque"/>
                    </div>
                    <div class="right mgB2 mgT2">
                        <div class="styled-select">
                            <select name="botao_success" id="botao_success">
                                <option value="">Escolher</option>
                                <option value="btn-flat-blue" <?php if($content['button_success_special'] == "btn-flat-blue") echo 'selected' ?>>Flat Azul</option>
                                <option value="btn-simple-blue" <?php if($content['button_success_special'] == "btn-simple-blue") echo 'selected' ?>>Simples Azul</option>
                                <option value="btn-red" <?php if($content['button_success_special'] == "btn-red") echo 'selected' ?>>Gradiente Vermelho</option>
                                <option value="btn-green" <?php if($content['button_success_special'] == "btn-green") echo 'selected' ?>>Gradiente Verde</option>
                                <option value="btn-white" <?php if($content['button_success_special'] == "btn-white") echo 'selected' ?>>Gradiente Branco</option>
                                <option value="btn-purple" <?php if($content['button_success_special'] == "btn-purple") echo 'selected' ?>>Gradiente Roxo</option>
                                <option value="btn-orange-shine" <?php if($content['button_success_special'] == "btn-orange-shine") echo 'selected' ?>>Brilhante Laranja</option>
                                <option value="btn-yellow" <?php if($content['button_success_special'] == "btn-yellow") echo 'selected' ?>>Amarelo</option>
                            </select>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="divider_horizontal mgT2 mgB2"></div>
                </li>
            </ul>
        </div>
    </div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        <div class="buttons_right">
            <input type="button" id="bt_submit_escolhe" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
            <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_top') ?>"/>
        </div>
        <div class="clear height_support"></div>
    </div>
</div>
<div class="clear"></div>

<div class="menu_shortcut">
    <ul>
        <li><input type="button" class="iSM icon_save"/></li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>
<input id="local" value="<?php echo $title_texture?>" type="hidden"/>
<input type="hidden" id="helper_action" data-js-action="escolher"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>