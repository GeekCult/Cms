<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "email_page_title_sent") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <p>&nbsp;</p><p>&nbsp;</p>
    <div id="ItemManager">
        <div class="table_support">
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <tr class="title_table">
                    <td width="1%"  class="title_table"></td>
                    <td width="10%" class="title_table"><?php echo Yii::t('adminForm', 'title_common_name') ?></td>
                    <td width="10%" class="title_table"><?php echo Yii::t('adminForm', 'title_common_email_signed') ?></td>
                    <td width="10%" class="title_table"><?php echo Yii::t('adminForm', 'common_title') ?></td>
                    <td width="10%" class="title_table"><?php echo Yii::t('adminForm', 'common_menu_data_creation') ?></td>                    
                    <td width="2%" align="center" class="title_table"><?php echo Yii::t('adminForm', 'common_qtd') ?></td>
                    <td width="3%" class="edit_table" align="center" colspan="2"><?php echo Yii::t('adminForm', 'common_menu_edit') ?></td>
                </tr>
                <?php if(count($content) != 0){$color = "0"; foreach($content as $values){?>
                <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20"/></td>
                    <td><?php echo $values['nome']  ?></td>
                    <td><?php echo $values['email']  ?></td> 
                    <td><?php echo $values['titulo'] ?></td>
                    <td><?php echo $values['data_string'] ?></td>                    
                    <td align="center"><?php echo $values['total'] ?></td>
                    <td align="center"><a href="/admin/email/editar/<?php echo $values['id'] ?>"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></a></td>
                    <td align="center"><input type="button" id="bt_delete" class="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>
                <?php if($color == "1"){$color = "0"; }else{$color = "1";}; }} else{ ?>
                <tr class="rows_table_0">
                    <td height="30" align="center" colspan="7" >
                        <?php echo Yii::t("adminForm", "title_common_no_item") ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>