<div class="styled-select">
    <select id="subcategoria" size="1" name="subcategoria" class="form-control">
        <option value="0">Nenhuma</option>
        <?php if($subcategoria){foreach ($subcategoria as $values) { ?>
            <option value="<?php echo $values['id_subcategoria'] ?>" <?php if(isset($produto['id_subcategoria']) && ($produto['id_subcategoria'] == $values['id_subcategoria'])) echo 'selected'; ?>><?php echo $values['subcategoria_label'] ?></option>
        <?php }} ?>
    </select>
</div>
