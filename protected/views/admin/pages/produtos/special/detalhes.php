<script type="text/javascript" src="/js/admin/produtos.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "title_product_edit_details") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <div class="clear"></div>
    <fieldset class="adminFormStore" id="slots_support">
        <div id="fancybox_gallery_launcher" class="iframe"></div>
        <div id="fancybox_images_launcher" class="iframe"></div>
        <div id="fancybox_banner_launcher" class="iframe"></div>
        <div id="fancybox_htmlbanners_launcher" class="iframe helper_tamanho_fake"></div>
        <h2><?php echo Yii::t("adminForm", "common_details") ?></h2>        
        <ul id="slot_support">            
            <li class="rows">
                <div class="label_text_Admin_logos">Preço Produtos - usar <b>0</b> como:</div>
                <div class="left mgR2 mgL" style="width:80px;">
                    <span class="fS left">R$0,00</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="price_produto" <?php if($attr['valor_free'] == 0) echo 'checked' ?> value="0"/>                    
                    </div>
                </div>
                <div class="left mgR2" style="width:90px;">
                    <span class="fS left">GRÁTIS</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="price_produto" <?php if($attr['valor_free'] == 1) echo 'checked' ?> value="1"/>                    
                    </div>
                </div>
                <div class="left mgR2" style="width:140px;">
                    <span class="fS left">NÃO MOSTRAR</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="price_produto" <?php if($attr['valor_free'] == 2) echo 'checked' ?> value="2"/>                    
                    </div>
                </div>
                <div class="left mgR2">
                    <span class="fS left">SOB CONSULTA</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="price_produto" <?php if($attr['valor_free'] == 3) echo 'checked' ?> value="3"/>                    
                    </div>
                </div>
                <div class="clear mgB"></div>
                <div class="label_text_Admin_logos">ShowCase - Categorias</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" value="true" class="mini left" name="exibe_showcase" <?php if($attr['showcase'] == 1) echo "checked"?>/>
                        <span class="label_text">Exibe página de categorias com descrição e uma imagem sobre esta</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Categorias Home</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" class="mini left" name="exibe_categorias_home" <?php if($attr['categorias_home'] == 1) echo "checked"?>/>
                        <span class="label_text">Exibe as categorias na home</span>
                    </div>
                </div>
                
                <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Quantidade de produtos</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" value="true" class="mini left" name="exibe_quantidade" <?php if($attr['produtos_qtd'] == 1) echo "checked"?>/>
                        <span class="label_text">Exibe a possibilidade de comprar mais de um produto</span>
                    </div>
                </div>                
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Embrulho para presente</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" value="true" class="mini left" name="exibe_embalagem" <?php if($attr['embrulho'] == 1) echo "checked"?>/>
                        <span class="label_text">Se seu produto pode ser embalado para presente</span>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Envio e transporte</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" value="true" class="mini left" name="exibe_transporte" <?php if($attr['envio'] == 1) echo "checked"?>/>
                        <span class="label_text">Se seu produto pode ser despachado</span>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(Yii::app()->params['ramo'] == 'ecommerce' || Yii::app()->params['ramo'] == 'educacao'){ ?>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Parcelamento</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="checkbox" value="true" class="mini left" name="exibe_parcelamento" <?php if($attr['parcelamento'] == 1) echo "checked"?>/>
                        <span class="label_text">Se seu produto pode ser comprado parcelado</span>
                    </div>
                </div>  
                <?php } ?>
              
                
                <div class="clear"></div>
                 
                <div class="label_text_Admin_logos">Tipo de menu</div>
                <div class="left" style="width:100px;">
                    <span class="fS left">Retrátil</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="menu_produtos_type" <?php if($attr['menu_produtos_type'] == "retratil") echo 'checked' ?> value="retratil"/>                    
                    </div>
                </div>
                <div class="left">
                    <span class="fS left">Com link</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="menu_produtos_type" <?php if($attr['menu_produtos_type'] == "link" || $attr['menu_produtos_type'] == '') echo 'checked' ?> value="link"/>                    
                    </div>
                </div>          
                
                <div class="clear mgB"></div>
                <div class="label_text_Admin_logos mgT0">Layout vitrine</div>  
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <div class="styled-select left mgR">
                            <select name="vitrine_layout" id="vitrine_layout">
                                <option value="vitrine_simple" <?php if($attr['vitrine_layout'] == 'vitrine_simple') echo 'selected' ?>>Vitrine Simples</option>
                                <option value="vitrine_lines" <?php if($attr['vitrine_layout'] == 'vitrine_lines') echo 'selected' ?>>Vitrine Lines</option>
                            </select>
                        </div>
                        <span class="label_text mgT0">Escolha como será a vitrine do seus produtos</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos mgT0">Layout categoria home</div>  
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <div class="styled-select left mgR">
                            <select name="categoria_home_layout" id="categoria_home_layout">
                                <option value="simples" <?php if($attr['categoria_home_layout'] == 'simples') echo 'selected' ?>>Simples</option>
                                <option value="full" <?php if($attr['categoria_home_layout'] == 'full') echo 'selected' ?>>Full</option>
                            </select>
                        </div>
                        <span class="label_text mgT0">Escolha como será o layout das categorias na home</span>
                    </div>
                </div>
                
                <div class="clear"></div>
                <div class="label_text_Admin_logos mgT0">Limite por página</div>  
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                       <div class="left mgR">
                           <input type="number" value="<?php if($attr['limite_pagina'] == ""){echo "10";}else{echo $attr['limite_pagina'];} ?>" id="limite_pagina" name="limite_pagina" class="input_mini"/>
                       </div>
                       <a href="#" class="tip_trigger" style="position: relative; float: left; top:3px; margin: 0 10px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip tip_full">Defina quantos items antes de paginar</p></a>
                    </div>
                </div>
                <div class="clear"></div>
                
            </li>
        </ul>
        
        <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
        <p>&nbsp;</p><p>&nbsp;</p>
        <h2>Informações de envio</h2>
        <p>&nbsp;</p>
        <ul>
            <li class="row">                
                <div class="clear"></div>
                <p>&nbsp;</p>
                <div class="label_text_Admin_logos">Cep de origem</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input id="cep_origem" type="text" value="<?php echo $attr['cep_origem'] ?>" class="small left mgR"/>
                        <span class="label_text">CEP de origem, centro de distribuição</span>
                    </div>
                </div>
                <div class="clear"></div>                
            </li>
            <li class="row">                
                <div class="clear"></div>
                <p>&nbsp;</p>
                <div class="label_text_Admin_logos">Frete grátis acima de R$ </div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input id="frete_gratis" type="text" value="<?php echo $attr['frete_gratis_valor'] ?>" class="input_mini left mgR"/>
                        <a href="#" class="tip_trigger" style="position: relative; float: left; top:0px; margin: 0 10px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip tip_full">Caso a compra seja maior que o valor ao lado o frete é grátis</p></a>
                        <span class="label_text"></span>
                    </div>
                </div>
                <div class="clear"></div>                
            </li>
        </ul>
        <?php } ?>
        
        
        <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
        <p>&nbsp;</p><p>&nbsp;</p>
        <h2>Informações exibidas no e-mail de compra</h2>
        <p>&nbsp;</p>
        <ul>
            <li>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Outras Informações </div>  
                <div class="container_slot_checkbox mgB">
                    <div class="text" style="width: 500px">
                        <textarea rows="10" id="outras_informacoes" cols="4"><?php echo $attr['outras_informacoes'] ?></textarea> 
                    </div>
                    <span class="label_text" style="margin-left: 200px;">Será exibido no e-mail de pedido</span>
                </div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Prazo de entrega </div>  
                <div class="container_slot_checkbox mgB">
                    <div class="text" style="width: 500px">
                        <textarea rows="10" id="prazo_entrega" cols="4"><?php echo $attr['prazo_entrega'] ?></textarea> 
                    </div>
                    <span class="label_text" style="margin-left: 200px;">Será exibido no e-mail de pedido</span>
                </div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="label_text_Admin_logos">Mensagem</div>  
                <div class="container_slot_checkbox mgB">
                    <div class="text" style="width: 500px">
                        <textarea rows="10" id="mensagem" cols="4"><?php echo $attr['mensagem'] ?></textarea> 
                    </div>
                    <span class="label_text" style="margin-left: 200px;">Será exibido no e-mail de pedido</span>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            
        </ul>
        <?php } ?>
         <div class="clear"></div>
         <p>&nbsp;</p>
        <div class="divider_shadow"></div>
        <h2><?php echo Yii::t("adminForm", "common_slot_graphic") ?></h2> 
        <ul id="frames">
            <li class="rows">                     
                <div class="container_frame_vitrine">                  
                  <img src="/media/images/layout/frames/small/frame_white_semirounded_200x300.png"/>
                  <div class="clear"></div>
                  <input type="radio" name="frame_vitrine" value="frame_white_semirounded_200x300.png" <?php if($attr['frame_vitrine'] == "frame_white_semirounded_200x300.png") echo "checked"?>/>                                    
                </div>
                <div class="container_frame_vitrine">                  
                  <img src="/media/images/layout/frames/small/frame_transparent_lines_semirounded_200x300.png"/>
                  <div class="clear"></div>
                  <input type="radio" name="frame_vitrine" value="frame_transparent_lines_semirounded_200x300.png" <?php if($attr['frame_vitrine'] == "frame_transparent_lines_semirounded_200x300.png") echo "checked"?>/>                                    
                </div>
                <div class="container_frame_vitrine">                  
                  <img src="/media/images/layout/frames/small/frame_nature.png"/>
                  <div class="clear"></div>
                  <input type="radio" name="frame_vitrine" value="frame_nature.png" <?php if($attr['frame_vitrine'] == "frame_nature.png") echo "checked"?>/>                                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
        </ul>
        <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
         <div class="clear"></div>
        <div class="divider_shadow"></div>
        <h2><?php echo Yii::t("adminForm", "common_slot_graphic") ?></h2>
        <ul id="shopcart">
            <li class="rows">                     
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_blue_dark_3.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_blue_dark_3.png" <?php if($attr['bt_shopcart'] == "cart_blue_dark_3.png" || $attr['bt_shopcart'] == "") echo "checked"?>/>          
                </div>
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_red_dark_3.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_red_dark_3.png" <?php if($attr['bt_shopcart'] == "cart_red_dark_3.png") echo "checked"?>/>          
                </div>
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_red_dark_2.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_red_dark_2.png" <?php if($attr['bt_shopcart'] == "cart_red_dark_2.png") echo "checked"?>/>          
                </div>
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_yellow_dark_3.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_yellow_dark_3.png" <?php if($attr['bt_shopcart'] == "cart_yellow_dark_3.png") echo "checked"?>/>          
                </div>
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_black_dark_3.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_black_dark_3.png" <?php if($attr['bt_shopcart'] == "cart_white_dark_3.png") echo "checked"?>/>          
                </div>
                <div class="container_frame_carrinho">
                  <div class="btn_carrinho">
                      <img src="/media/images/textures/botao/cart_white_dark_3.png"/>
                  </div>
                  <input type="radio" name="shopcart" value="cart_white_dark_3.png" <?php if($attr['bt_shopcart'] == "cart_white_dark_3.png") echo "checked"?>/>          
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
        </ul>
        <?php } ?>
        <div class="clear"></div>
        <div class="divider_shadow"></div>
        <h2><?php echo Yii::t("adminForm", "common_slot_graphic") ?></h2>
        <ul id="menu_store">
            <li class="rows">                     
                <div class="frame_menu_store">                  
                  <img src="/media/images/layout/frames/menu_loja_red.png"/> 
                  <div class="clear"></div>
                  <input type="radio" name="menu_loja" value="red" <?php if($attr['menu_loja'] == "red") echo "checked"?>/>          
                </div>
                <div class="frame_menu_store">                  
                  <img src="/media/images/layout/frames/menu_loja_black.png"/> 
                  <div class="clear"></div>
                  <input type="radio" name="menu_loja" value="black" <?php if($attr['menu_loja'] == "black") echo "checked"?>/>          
                </div>
                <div class="frame_menu_store">                  
                  <img src="/media/images/layout/frames/menu_loja_transparent.png"/> 
                  <div class="clear"></div>
                  <input type="radio" name="menu_loja" value="transparent" <?php if($attr['menu_loja'] == "transparent") echo "checked"?>/>          
                </div>
                
            </li>
         
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
        </ul>
        
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update"); ?>" />     
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear"); ?>"/>        
    </div>
    <div class="clear height_support"></div>
    
    <input id="id_page_helper" type="hidden" value="0"/>
    <input id="id_helper" type="hidden" value="<?php //echo $attributes['id_page'] ?>"/>
    <input id="helper_id_controller" type="hidden" value="50"/>
    <input id="helper_type_controller" type="hidden" value="logos"/>
</div>
<script type="text/javascript">initEditDetails();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>