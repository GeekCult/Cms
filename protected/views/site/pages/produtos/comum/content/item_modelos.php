<select name="titulo_carro" id="titulo_carro" class="span12">
    <option value="0">Qualquer modelo</option>
    <?php foreach($content as $values){ ?>
    <option value="<?php echo $values['id'] ?>"><?php echo $values['nome'] ?></option>
    <?php } ?>
</select>