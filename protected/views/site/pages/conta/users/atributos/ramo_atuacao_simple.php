<div class="styled-select">
    <select id="ramo_atuacao" name="formIdRamoAtuacao" class="sF3 span12">
        <option value="0">Ramo de Atuação</option>
        <?php foreach($ramo_atuacao as $values){ ?>
        <option value="<?php echo $values['id'] ?>" <?php if(isset($formIdRamoAtuacao)) {if($formIdRamoAtuacao == $values['id']) echo "selected";}else{ if(isset($content['ramo_atividade']) && $content['ramo_atividade'] == $values['id']) echo "selected";} ?>><?php echo $values['label'] ?></option>
        <?php } ?>                    
    </select>
</div>      