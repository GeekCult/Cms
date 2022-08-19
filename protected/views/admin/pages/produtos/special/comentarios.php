<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "comments_page_title_list"); ?></h1>          
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new"); ?>"/>
    </a>
    <div class="clear"></div>
    
    <div class="comboboxSelector_double">
        <div class="container-combobox-cat_double">
            <a href="/admin/produtos/comentarios_aprovados" id="bt_aprovados" class="<?php if($status == 1) echo 'a_focus' ?>"><?php echo Yii::t("adminForm", "title_common_approved"); ?></a>
            <label>|</label>
            <a href="/admin/produtos/comentarios" id="bt_esperando" class="<?php if($status == 0 || $status == '') echo 'a_focus' ?>"><?php echo Yii::t("adminForm", "title_common_wait_approved"); ?></a>
        </div>
    </div>
    <div id="ItemManager">
        <div class="table_support">            
            <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">                
                <tr class="title_table">
                    <td width="1%"  ></td>
                    <td width="15%" ><?php echo Yii::t("adminForm", "common_menu_name") ?></td>
                    <td width="20%" ><?php echo Yii::t("adminForm", "common_title") ?></td>
                    <td width="40%" ><?php echo Yii::t("adminForm", "common_menu_comment") ?></td>
                    <td width="2%" align="center" colspan="4"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                </tr>  
                <?php if(count($content) > 0){ ?>
                <?php $color = "0"; foreach($content as $values){ ?>
                <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td><img alt="" src="/media/images/icons/icon_mais.png"/></td>
                    <td><?php echo $values['nome'] ?></td>
                    <td><div class="truncate"><?php echo $values['info']['nome'] ?></div></td>
                    <td><div class="truncate"><?php echo $values['subcomentario'] ?></div></td>
                    <td align="center"><input type="button" id="bt_status" name="<?php echo $values['id'] ?>" title="aprovar" class="comment_ok"/></td>
                    <td><input type="button" id="bt_reprove" name="<?php echo $values['id'] ?>" title="reprovar" class="comment_no"/></td>
                    <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></td>
                    <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>                
                <?php if($color == "1"){$color = "0"; }else{$color = "1";};} ?>            
                <?php } else{ ?>                
                <tr>
                    <td class="rows_table_0 center" colspan="4"><?php echo Yii::t("messageStrings", "message_result_comment_empty") ?></td>
                </tr>            
                <?php } ?>
            </table>
        </div>
    </div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" />
    </div>
    <input id="helper_tipo" value="0" type="hidden"/>
    <input id="helper_tipo_comment" value="<?php echo $tipo ?>" type="hidden"/>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>