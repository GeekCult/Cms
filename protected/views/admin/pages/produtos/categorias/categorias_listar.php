<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "category_ecommerce_page_title_see") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/produtos/categorias_novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
     <div class="clear"></div>
    <div class="table_support_ecommerce">
        <?php if(count($categorias) != 0){ ?>
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">            
            <tr class="title_table">
                <td width="1%"  ></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_id") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_categoria") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_categoria_url") ?></td>
                <td width="5%" ><?php echo Yii::t("adminForm", "common_menu_index") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
            </tr>
            <?php if(true == true){ $color = "0"; foreach($categorias as $values){?>
            <tr id="item_<?php echo $values['id_categoria'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td><?php echo $values['id_categoria'] ?></td>
                <td><?php echo $values['categoria_label'] ?></td>
                <td><?php echo $values['categoria_url'] ?></td>   
                <td><?php echo $values['n_index'] ?></td>
                <td align="center"><input type="button" id="bt_edit_main" name="<?php echo $values['id_categoria'] ?>" title="editar" class="bt_edit"/></td>
                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_categoria'] ?>" title="excluir" alt="categoria"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} else{ ?>
            <tr>
                <td height="30" align="center" colspan="5" class="txt_padrao">
                    Não existem categorias cadastradas no sistema atualmente.
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
            <div class="result-message">                
                <span>Não existem categorias cadastradas no sistema atualmente.</span>                
            </div>
        <?php }  ?>
        <p>&nbsp;</p>
        <?php if(count($subcategorias) != 0){ ?>
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">            
            <tr class="title_table">
                <td width="1%"  ></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_id") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_subcategoria") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_subcategoria_url") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
            </tr>
            <?php if(true == true){ $color = "0"; foreach($subcategorias as $values){?>
            <tr id="item_<?php echo $values['id_subcategoria'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td><?php echo $values['id_subcategoria'] ?></td>
                <td><?php echo $values['subcategoria_label'] ?></td>
                <td><?php echo $values['subcategoria_url'] ?></td>         
                <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id_subcategoria'] ?>" title="editar"/></td>
                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_subcategoria'] ?>" title="excluir" alt="subcategoria"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} else{ ?>
            <tr>
                <td height="30" align="center" colspan="5" class="txt_padrao">
                    Não existem categorias cadastradas no sistema atualmente.
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
            <div class="result-message">                
                <span>Não existem categorias cadastradas no sistema atualmente.</span>                
            </div>
        <?php }  ?>
        <p>&nbsp;</p>
        <?php if(count($subitems) != 0){ ?>
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">            
            <tr class="title_table">
                <td width="1%"  ></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_id") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_subitem") ?></td>
                <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_subitem_url") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
            </tr>
            <?php if(true == true){ $color = "0"; foreach($subitems as $values){?>
            <tr id="item_<?php echo $values['id_subitem'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td><?php echo $values['id_subitem'] ?></td>
                <td><?php echo $values['subitem_label'] ?></td>
                <td><?php echo $values['subitem_url'] ?></td>         
                <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id_subitem'] ?>" title="editar"/></td>
                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_subitem'] ?>" title="excluir" alt="subitem"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} else{ ?>
            <tr>
                <td height="30" align="center" colspan="5" class="txt_padrao">
                    Não existem categorias cadastradas no sistema atualmente.
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
            <div class="result-message">                
                <span>Não existem categorias cadastradas no sistema atualmente.</span>                
            </div>
        <?php }  ?>
        
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" />
    </div>
    <input type="hidden" id="action_helper" value="categorias_listar"/>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>