<script type="text/javascript" src="/js/admin/documentar/bugs.js"></script>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent_general">
        <div class="titleContent_listar">Chamados</div>
    </div>    
    <div class="divider-fancybox"></div>
    <div class="bt_rigth_small" title="adicionar novo">
        <a href="#" id="bt_new_bug"><?php echo Yii::t("adminForm", "button_common_add") ?></a>
    </div>
    <div class="textLayout"><?php //echo Yii::t("adminForm", "bug_page_label_info") ?></div>
    <fieldset id="adminFormContentGeneral">
        <ul>
            <li class="rows">
                <p>&nbsp;</p>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "documentation_bug_label_1") ?></div>
                <div class="text">
                    <input id="titulo" type="text" class="form" value=""/>
                </div>
            </li>
            <li class="rows hidden hide">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "documentation_bug_label_2") ?></div>
                <div class="text">
                    <select id="prioridade" class="styled">
                        <option value="nenhuma"><?php echo Yii::t("adminForm", "select_common_any_one") ?></option>
                        <option value="baixa"><?php echo Yii::t("adminForm", "select_common_down") ?></option>
                        <option value="media"><?php echo Yii::t("adminForm", "select_common_medium") ?></option>
                        <option value="alta"><?php echo Yii::t("adminForm", "select_common_high") ?></option>
                    </select>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "documentation_bug_label_3") ?></div>
                <div class="text">
                    <textarea id="descricao" rows="4" class="form" ></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">&nbsp;</div>
                <div class="text">
                    <div id="message_error_bug"></div>
                </div>
                
            </li>
            <li class="rows">
                <div class="label_text_Admin">Dica de chamado</div>
                <div class="text">
                    <div class="conf_maps_tip_general">
                        <p class="conf_maps_tip_general">Utilize esse formulário para abrir uma tarefa para o nós </p>
                    </div>
                </div>
            </li>
        </ul>
    </fieldset>
    <input id="tipo" type="hidden" class="form" value="bug"/>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_bug_submit" value="<?php echo Yii::t("adminForm", "button_common_send") ?>"/>
    </div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>