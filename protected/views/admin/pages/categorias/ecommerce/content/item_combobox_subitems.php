<div class="styled-select">
    <select id="subitem" size="1" name="subitem" class="form-control">
        <option value="0">Nenhuma</option>
        <?php if($subitems){foreach ($subitems as $values) { ?>
            <option value="<?php echo $values['id_subitem'] ?>" <?php if($values['id_subitem'] == $produto['id_subitem']) echo " selected" ?>><?php echo $values['subitem_label'] ?></option>
        <?php }} ?>
    </select>
</div>