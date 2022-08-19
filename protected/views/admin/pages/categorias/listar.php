<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "category_page_title_see") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/categorias/novo/1">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <div class="clear"></div>
    <div class="table_support">       
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">            
            <tr class="title_table">
                <td width="1%"  ></td>
                <td width="40%" ><?php echo Yii::t("adminForm", "common_menu_name_categoria") ?></td>
                <td width="40%" ><?php echo Yii::t("adminForm", "common_menu_page_categoria") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
            </tr>
            <?php if(isset($content[0]['nome']) && $content[0]['nome'] != ""){ $color = "0"; foreach($content as $values){?>
            <tr id="item_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td><?php echo $values['nome'] ?></td>
                <td><?php echo $values['page_name']['label'] ?></td>         
                <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></td>
                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} else{ ?>
            <tr class="rows_table_0">
                <td height="30" align="center" colspan="5" class="txt_padrao">
                    Não existem categorias cadastradas no sistema atualmente.
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" />
    </div>
    <div class="clear"></div>
    <p>&nbsp;</p>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>