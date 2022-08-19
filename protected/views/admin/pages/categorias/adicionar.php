<script type="text/javascript" src="/js/admin/categorias.js"></script>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent_add">
        <div class="titleContent_listar"><?php echo  Yii::t("adminForm", "category_page_title_new") ?></div>
        <a class="bt_buy_stuff" href="#" title="comprar mais cools"></a>
        <a class="bt_back_stuff" href="/admin/images/adicionar" title="voltar"></a>
    </div>
    <div class="divider-fancybox"></div>
    <div class="textLayout"><?php echo Yii::t("adminForm", "category_page_label_info") ?></div>
        <fieldset class="adminFormContentCool">
            <ul>
                <li class="rows">
                   <p></p>
                </li>
                <p>&nbsp;</p><p>&nbsp;</p>
                <li class="rows">                    
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "category_page_label_1") ?></div>
                    <div class="text">
                        <div class="styled-select">
                            <select name="categoria" id="categoria" size="1" >
                                <?php foreach ($pages as $values) { ?>
                                <option value="<?php echo $values['id'] ?>" <?php if($values['id'] == $content['id_page']) echo " selected "; ?>><?php echo $values['label'] ?></option>
                                <?php } ?>
                            </select>
                        </div>                        
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "category_page_label_2") ?></div>
                    <div class="text half">
                        <input id="nome_categoria" type="text" class="form" value="<?php echo $content['nome'] ?>"/>
                    </div>
                </li>
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <li class="rows">
                    <div class="label_text_Admin">Dica - cada página pode ter uma ou mais categorias:</div>
                    <div class="text">
                        <div class="conf_maps_tip">
                            <span>Utiliza as categorias criadas para cada página para organizar seu site</span>
                            <span>Você deverá recarregar a página para sua categoria ser exibida</span>
                        </div>
                    </div>
                </li>
                <li class="rows">
                   <p></p>
                </li>
            </ul>
        </fieldset>
        <div class="buttons_right">       
            <input type="button" class="bt_right" id="bt_submit" value="<?php if($action == "novo"){echo Yii::t("adminForm", "button_common_submit");}else{echo Yii::t("adminForm", "button_common_update");} ?>"/>
        </div>
    
    </form>
</div>
<input type="hidden" value="<?php echo $action ?>" id="helper_action"/>
<input type="hidden" value="<?php echo $id_album ?>" id="helper_id_categoria"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>