<div class="container_attributes_client">
    <h3 class="titulo">Tipo de cliente</h3>
    <div class="background-color container_tipo_cliente">
        <div class="container_items_client">Você não adicionou nenhuma tag para esse usuário ainda</div>
        <div class="divider_horizontal"></div>
        <div class="container_cliente_info">
            <div class="phrase_info_client">Você pode adicionar quantas tags precisar</div>
        </div>
        <?php $loader = explode("/", $_SERVER['REQUEST_URI']);?>
        <div class="tipo_cliente_box">            
            <label class="label_select_attr">Escolha:</label>
            <div class="styled-select select_tipo_cliente">
                <select id="type_account" name="type_account">
                    <?php if($loader[1] == "conta" && $session['atendimento'] != 1 && $session['administrador'] != 1){ ?>
                    <?php if($loader[3] == "pj" || $loader[3] == "editar_pj"){ ?>
                    <option value="associado">Associado</option>
                    <option value="parceiro">Parceiro</option>
                    <option value="colunista">Colunista</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="aluno">Aluno</option>
                    <option value="seguidor">Seguidor</option>
                    <?php } ?>
                    <?php if($loader[3] == "pf" || $loader[3] == "editar_pf"){ ?>
                    <option value="associado">Associado</option>
                    <option value="colunista">Colunista</option>
                    <option value="funcionario">Funcionário</option>
                    <option value="parceiro">Parceiro</option>
                    <option value="representante">Representante</option>
                    <option value="prospectador">Prospectador</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="aluno">Aluno</option>
                    <option value="seguidor">Seguidor</option>
                    <?php } ?>
                    <?php } else { ?>
                    <option value="associado">Associado</option>
                    <option value="colunista">Colunista</option>
                    <option value="funcionario">Funcionário</option>
                    <option value="desenvolvedor">Desenvolvedor</option>
                    <option value="parceiro">Parceiro</option>
                    <option value="representante">Representante</option>
                    <option value="atendimento">Atendimento</option>
                    <option value="cliente">Cliente</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="acessor">Acessor</option>
                    <option value="administrador">Administrador</option>
                    <option value="prospectador">Prospectador</option>
                    <option value="profissional">Profissional</option>
                    <option value="benchmarking">Benchmarking</option>
                    <option value="aluno">Aluno</option>
                    <option value="seguidor">Seguidor</option>
                    <?php } ?>
                </select>
            </div>
            <div class="bt_add_attr"><input type="button" class="botao_small" value="+" id="bt_add_atribute"/></div>
            <input id="helper_atributos_clientes" type="hidden" value="" name="user_attributes"/>
            <input id="helper_check_update" type="hidden" value="0" name="helper_check_update"/>
            <input id="helper_json_atributos_clientes" type="hidden" value='<?php echo json_encode($user_attributes) ?>' />
        </div>
        <div class="clear"></div>
    </div>    
</div>