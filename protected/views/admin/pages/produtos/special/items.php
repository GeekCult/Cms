<?php if($content){ $color = "0"; foreach($content as $values){ ?>
<tr id="container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
    <td  ><?php echo $values['referencia'] ?></td>
    <td  ><?php echo $values['nome'] ?></td>
    <td  ><?php echo $values['categoria'] ?></td>
    <td  ><?php echo $values['data'] ?></td>
    <td  ><?php echo $values['last_update'] ?></td>
    <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></td>
    <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
</tr>
<?php if($color == "1"){$color = "0"; }else{$color = "1";}; }}else{ ?>
<tr class="rows_table_0">
    <td height="30" align="center" colspan="7" >
        <?php echo Yii::t("adminForm", "title_common_no_item") ?>
    </td>
</tr>                
<?php } ?>
