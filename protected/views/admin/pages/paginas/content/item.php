<tr id="item_<?php echo $id ?>" class="rows_table_0">
    <td width="1%"><img src='/media/images/icons/icon_mais.png'/></td>
    <td width="10%"><?php echo $info['titulo'] ?></td>
    <td width="10%"><?php echo $info['cool'] ?></td>
    <td width="2%" align="center"><input id="<?php echo $id ?>" type="text" class='small v_indice txt_center' name="exibe_row_<?php echo $id ?>" value="1" data-id_item="<?php echo $id ?>"/></td>
    <td width="2%" align="center"><input id="<?php echo $id ?>" type="checkbox" class='bt_exibe_row' name="exibe_row_<?php echo $id ?>" checked/></td>
    <td width="1%" align="center">
        <input id="<?php echo $id ?>" class="bt_ver" type="button" title="visualizar item">
    </td>
    <td width="1%" align="center">
        <input id="<?php echo $id ?>" class="bt_edit" type="button" title="editar item" data-id_componente="<?php echo $info['id'] ?>">
    </td>
    <td width="1%" align="center">
        <input id="<?php echo $id ?>" class="bt_delete" type="button" title="excluir item">
    </td>
</tr>