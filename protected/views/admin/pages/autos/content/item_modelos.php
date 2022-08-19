<div class="label-categoria">Modelo</div>
<div class="styled-select">
    <select name="modelo" id="modelo" class="form-control default-select2">
        <?php foreach($content as $values){ ?>
        <option value="<?php echo $values['id'] ?>"><?php echo $values['nome'] ?></option>
        <?php } ?>
    </select>
</div>
