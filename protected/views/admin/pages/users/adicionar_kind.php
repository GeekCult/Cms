<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="title_list_fancy" style="margin: 5px 0px 5px 10px">
        <h2>Cadastrar entidade</h2>
    </div>
    <div class="divider-fancybox"></div>
    <div class="right" style="margin: 10px 15px 0px 0; width: 290px;">
        <div class="left" style="width: 250px">
            <label for="filtro" class="left" style="margin: 7px 10px 0px 0;font-weight: bold">Tipo</label>
            <div class="styled-select">
                <select id="filtro" name="filtro" style="font-size: 1em!important">
                    <option value="todos">Todos</option>
                    <option value="associado" <?php if($type == 'associado') echo 'selected' ?>>Associados</option>
                    <option value="colunista" <?php if($type == 'colunista') echo 'selected' ?>>Colunistas</option>
                    <option value="funcionario" <?php if($type == 'funcionario') echo 'selected' ?>>Funcionários</option>
                    <option value="desenvolvedor" <?php if($type == 'desenvolvedor') echo 'selected' ?>>Desenvolvedores</option>
                    <option value="parceiro" <?php if($type == 'parceiro') echo 'selected' ?>>Parceiros</option>
                    <option value="representante" <?php if($type == 'representante') echo 'selected' ?>>Representantes</option>
                    <option value="atendimento" <?php if($type == 'atendimento') echo 'selected' ?>>Atendimentos</option>
                    <option value="cliente" <?php if($type == 'cliente') echo 'selected' ?>>Clientes</option>
                    <option value="acessor" <?php if($type == 'acessor') echo 'selected' ?>>Acessores</option>
                    <option value="administrador" <?php if($type == 'administrador') echo 'selected' ?>>Administradores</option>
                    <option value="prospectador" <?php if($type == 'prospectador') echo 'selected' ?>>Prospectadores</option>
                    <option value="profissional" <?php if($type == 'profissional') echo 'selected' ?>>Profissionais</option>
                    <option value="rede_beneficios" <?php if($type == 'rede_beneficios') echo 'selected' ?>>Rede Benefícios</option>
                    <option value="fornecedor" <?php if($type == 'fornecedor') echo 'selected' ?>>Fornecedores</option>
                </select>
            </div>
        </div>
        <a href="/admin/users_selection/exibir_kind">
            <input type="button" class="bt_back_stuff" title="Adicionar entidade" style="margin: 3px 0 0 0"/>
        </a>
    </div>
    <div class="clear"></div>
    <p>&nbsp;</p>
    <div class="divider-fancybox"></div>
    <form id="entity">
        <div style="margin: 20px 0 0 20px;">
            <div class="mgB">
                <div class="styled-select">
                    <select id="tipo_conta" name="tipo_conta" style="font-size: 1em!important">
                        <option value="1">Pessoa Jurídica</option>
                        <option value="0">Pessoa Física</option>
                    </select>
                </div>
            </div>
            <div class="mgB">
                <input type="text" placeholder="Nome/Nome Fantasia" class="input_normal" name="field1"/>
            </div>
            <div class="mgB">
                <input type="text" placeholder="SobreNone/Razão social" class="input_normal" name="field2"/>
            </div>
            <div class="mgB">
                <input type="text" placeholder="E-mail" class="input_normal" name="email" id="email"/>
            </div>
            <div class="mgB">
                <input type="text" placeholder="Responsável" class="input_normal" name="contato" id="contato"/>
            </div>
            <div class="mgB">
                <input type="text" placeholder="DDD" class="input_mini left mgR" name="ddd_telefone" maxlength="2"/>
                <input type="text" placeholder="Telefone" class="input_small" name="telefone" maxlength="9"/>
            </div>
            <div class="mgB">
                <input type="checkbox" class="left" name="newsletter" class="left mgR" checked/>
                <label for="newsletter">Adicionar na lista de e-mail marketing</label>
            </div>
            <div id="message_error" class="mgB" style="display: none;">
                <div id="message_ctn"></div>
            </div>
            <div class="mgB">
                <input type="button" value="cadastrar" class="botao" id="bt_submit"/>
            </div>
            <input type="hidden" name="action" value="novo"/>
            <input type="hidden" name="tag_user" value="<?php echo $type ?>"/>
            <p>&nbsp;</p>
        </div>
    </form>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<script type="text/javascript">
    
    $("#filtro").change(function(){
        $.post("/site/relatar/set_session_data",{label: 'entidade',value: $("#filtro").val()},function(data){window.location.reload();});
    });
    
    $("#tipo_conta").change(function(){
        if($("#tipo_conta").val() == 0){$("#contato").hide()}else{$("#contato").hide()};
    });
    
    /*
     *
     * It sends the values from the textfield
     *
     */
    $("#bt_submit").click(function(){

        var allowSubmit = false;
         if($('#email').val() != '') allowSubmit = true; 
        $("form#entity").submit(function(e) {e.preventDefault();});

        $("#message_error").hide();    

        if(allowSubmit){
            $.post("/admin/recursos_humanos/salvar",{        
                data: $("form#entity").serialize()

            },function(data){
                var jsonObject = eval('(' + data + ')');
                showAlertDim(jsonObject['message']);


            });
        }else{
            $("#message_ctn").append("O e-mail deve estar preenchido!");
            $("#message_error").show();
        }  
    });
    
    //initListenerSelectionUser();
</script>