<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "newsletter_page_title_templates") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/emkt/criar_prospect">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <div class="comboboxSelector">
        <div class="container-combobox-cat">
            
        </div>
    </div>
    <div id="ItemManager">
        <div class="table_support">
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <tr class="title_table">
                    <td width="1%"></td>
                    <td width="2%" align="center"><?php echo Yii::t('adminForm', 'common_id') ?></td>
                    <td width="20%"><?php echo Yii::t('adminForm', 'common_title') ?></td>
                    <td width="40%"><div class="truncate"><?php echo Yii::t('adminForm', 'common_menu_description') ?></div></td>                    
                    <td width="20%"><?php echo Yii::t('adminForm', 'common_menu_data_creation') ?></td>
                    <td width="1%" align="center" colspan="3"><?php echo Yii::t('adminForm', 'common_menu_edit') ?></td>
                </tr>
                <?php if(count($content) != 0){ $color = "0"; foreach($content as $values){?>
                <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                    <td align="center"><div class="legend"><?php echo $values['id'] ?></div></td>
                    <td><?php echo $values['titulo']  ?></td>
                    <td><?php echo $values['descricao']  ?></td>                    
                    
                    <td><?php echo $values['data'] ?></td>
                    <td align="center"><a href="/emkt/ver_template/<?php echo $values['id'] ?>" target="_blank"><input type="button" class="bt_ver" title="ver template"/></a></td>
                    <td align="center"><a href="/admin/emkt/editar_prospect/<?php echo $values['id'] ?>"><input type="button" class="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></a></td>
                    <td align="center"><input type="button" class="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>
                <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} else{ ?>
                <tr class="rows_table_0">
                    <td height="30" align="center" colspan="7" >
                        <?php echo Yii::t("adminForm", "title_common_no_item") ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <input type="hidden" id="helper_action" data-js-action="listar_templates"/>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>