<?php if($content){$color = "0"; foreach($content as $values){?>
<tr id="img_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>" data-item-content="item_listar">
    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
    <td><?php echo $values['id'] ?></td>
    <?php if($values['tipo'] == "playground"){ ?>
    <td align="center"><a href="/media/user/images/purplecanvas/<?php echo $values['foto'] ?>" name="<?php echo $values['titulo'] ?>" class="fancybox"><img src="/media/user/images/purplecanvas/thumbs/<?php echo $values['foto'] ?>" alt="" title="<?php echo $values['titulo'] ?>" width="120"/></a></td>
    <?php } else if($values['tipo'] == "embeded"){ ?>
    <td align="center"><div style="position:relative; display: inline-block; width: 90px; height: 120px;"><?php echo $values['embeded'] ?></div></td>
    <?php } else{ ?>
    <td align="center"><a href="/media/user/images/original/<?php echo $values['foto'] ?>" name="<?php echo $values['titulo'] ?>" class="fancybox"><img src="/media/user/images/thumbs_50/<?php echo $values['foto'] ?>" alt="/media/user/images/thumbs_50/<?php echo $values['foto'] ?>" title="<?php echo $values['titulo'] ?>" width="120"/></a></td>
    <?php } ?>
    <td><?php echo $values['titulo'] ?></td>
    <td><?php echo $values['descricao'] ?></td>
    <td align="center"><input type="button" id="<?php echo $values['id'] ?>" name="<?php echo $values['foto'] ?>" title="editar" class="bt_edit"/></td>
    <td align="center"><input type="button" id="<?php echo $values['id'] ?>" name="<?php echo $values['foto'] ?>" title="excluir" class="bt_delete"/></td>
</tr>
<?php if($color == "1"){$color = "0"; }else{$color = "1";}; }} else{ ?>
<tr><td height="30" align="center" colspan="7" ><?php echo Yii::t("adminForm", "title_common_no_items") ?></td></tr>
<?php } ?>