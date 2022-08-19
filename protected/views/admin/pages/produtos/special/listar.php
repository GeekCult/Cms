<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "product_page_title_list") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/produtos/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <div class="comboboxSelector_giant">
        <label for="categoria" class="filtro_pos"><?php echo Yii::t("adminForm", "title_common_filter") ?></label>
        <div class="container-combobox-cat">
            <div class="styled-select">
                <select id="categoria">
                    <option value="" <?php if($filtro_categoria == "" || $tipo == "") echo "selected" ?>>Todos</option>
                    <?php foreach($categorias as $values){ ?>
                    <option value="<?php echo $values['id_categoria'] ?>" <?php if($filtro_categoria == $values['id_categoria']) echo "selected" ?>><?php echo $values['categoria_label'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div >
        <div class="table_support">
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <tr class="title_table">
                    <td width="1%"  ></td>
                    <td width="5%" ><?php echo Yii::t("adminForm", "common_menu_ref") ?></td>
                    <td width="20%" ><?php echo Yii::t("adminForm", "common_menu_name") ?></td>
                    <td width="15%" ><?php echo Yii::t("adminForm", "common_menu_categories") ?></td>
                    <td width="10%" ><?php echo Yii::t("adminForm", "common_menu_date_creation") ?></td>
                    <td width="10%" ><?php echo Yii::t("adminForm", "common_menu_last_update") ?></td>
                    <td width="1%"  align="center" colspan="3"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                </tr>
                <?php if($content){ ?>
                <tr class="title_table">
                    <td></td>
                    <td><input type="text" style="width: 95%" id='referencia' placeholder="Buscar ref."/></td>
                    <td><input type="text" style="width: 95%" id='titulo' placeholder="Buscar título"/></td>
                    <td><input type="text" style="width: 95%" disabled="true" placeholder="Desativado"/></td>
                    <td><input type="text" style="width: 95%" disabled="true" placeholder="Desativado"/></td>
                    <td><input type="text" style="width: 95%" disabled="true" placeholder="Desativado"/></td>
                    <td align="center" colspan="3"><input type="button" class='' id='bt_search' value='buscar'/></td>
                </tr>
                <tbody id='ItemManager'>
                <?php $color = "0"; foreach($content as $values){ ?>
                <tr id="container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                    <td  ><?php echo $values['referencia'] ?></td>
                    <td  ><?php echo $values['nome'] ?></td>
                    <td  ><?php echo $values['categoria'] ?></td>
                    <td  ><?php echo $values['data'] ?></td>
                    <td  ><?php echo $values['last_update'] ?></td>
                    
                    <td align="center"><input type="button" id="bt_marketplace" name="<?php echo $values['id'] ?>" title="marketplace"/></td>
                    <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></td>
                    <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>
                <?php if($color == "1"){$color = "0"; }else{$color = "1";}; } ?>
                </tbody>
                <?php }else{ ?>
                <tr class="rows_table_0">
                    <td height="30" align="center" colspan="7" >
                        <?php echo Yii::t("adminForm", "title_common_no_item") ?>
                    </td>
                </tr>
                <?php }  ?>
            </table>
        </div>
        <?php include Yii::app()->getBasePath() . '/views/site/common/menu/paginacao/paginador.php'; ?>
        <p>&nbsp;</p>
        <div class="container_qtd_users"><b>Quantidade de produtos: </b> <?php echo count($content) ?></div>
    </div>
    <div class="clear"></div>
    <?php include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
     <div class="clear"></div>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" />
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <p>&nbsp;</p>
    <div class="clear"></div>
    <div class="mgFooter" style="margin-bottom: 80px; display: inline-block"></div>
    <div class="clear"></div>
</div>
<input type="hidden" id="helper_type_publish" value="produto"/>
<input type="hidden" id="action_helper" value="listar"/>
<input type="hidden" id="helper_type_id" value=""/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>