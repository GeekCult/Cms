<div class="container_attributes_client">
    <h3 class="titulo">Ramo de atuação</h3>
    <div class="background-color container_tipo_cliente">
        <div class="container_cliente_info">
            <div class="phrase_info_client">Escolha o ramo de atuação de sua empresa</div>
        </div>
        <div class="tipo_cliente_box">            
            <label class="label_select_attr">Escolha:</label>
            <div class="styled-select_giant select_tipo_cliente">
                <select id="ramo_atuacao" name="formIdRamoAtuacao">
                    <option value="0">Ramo de Atuação</option>
                    <?php foreach($ramo_atuacao as $values){ ?>
                    <option value="<?php echo $values['id'] ?>" <?php if(isset($formIdRamoAtuacao)) {if($formIdRamoAtuacao == $values['id']) echo "selected";}else{ if(isset($content['ramo_atividade']) && $content['ramo_atividade'] == $values['id']) echo "selected";} ?>><?php echo $values['label'] ?></option>
                    <?php } ?>                    
                </select>
            </div>
        </div>
        <div class="clear"></div>
    </div>    
</div>