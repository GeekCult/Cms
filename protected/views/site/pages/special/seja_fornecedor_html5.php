<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan">
    
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if($page_prop['gel_fr_initial'] != ""){ ?>
        <!--TITLE-->
        <div class="row-fluid">   
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>
            <p class="standart-ptitle bold"><?php echo $text['titulo'] ?></p>
            <div class="divider_horizontal mgB2"></div>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid">      
        <div class="container_combo_text">
            <div class="title"><?php echo $text['titulo_01'];  ?></div>
            <?php if($text['subtitulo_01'] != ""){  ?><div class="subtitulo"><?php echo $text['subtitulo_01'];  ?></div><?php } ?>
            <p><?php echo nl2br($text['texto_01']) ?></p>
        </div> 
    </div>
    
    
    <?php if($page_prop['content'] && count($page_prop['content']) > 0){  ?>
    <div class="row-fluid">
        <div class="mgL">
            <div class="span12">
                <h2><?php echo $page_prop['forn_phrase'] ?></h2>
            </div>
        </div>
        <?php if($page_prop['content'] && count($page_prop['content']) > 0){foreach($page_prop['content'] as $values){ ?>
        <div class="span11">            
            <h4><i class="fa fa-check-circle main-color mgR"></i><?php echo $values['item_string'] ?></h4> 
            <p class="legend"><?php echo nl2br($values['detalhes']) ?></p>
            <hr class="half2"/>
        </div>
        <?php }} ?>
        <div class="divider_shadow"></div>
    </div>
    
    <?php } ?>
    

    <?php //if($content['exibe_produtos']){?>
    <div class="mgL mgR">
        <div class="row-fluid">
            <div class="span12">

                <h2 class="standart-h3title"><i class="fa-icon-envelope-alt main-color"></i>Digite os dados da sua empresa para ser um de nossos fornecedores</h2>
                <!-- CONTACT FORM -->
                <form id="form_seja_fornecedor">
                    <h3>Dados da empresa</h3>
                    <div class="row-fluid">
                        <div class="span5">
                            <input class="span12" type="text" name="field1" id="field1" value="" placeholder="Nome Fantasia">
                        </div>
                        <div class="span5">
                            <input class="span12" type="text" name="field2" id="field2" value="" placeholder="Razão Social">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span5">
                            <input class="span12" type="text" name="email" id="email" value="" placeholder="E-mail">
                        </div>
                        <div class="span4">
                            <input class="span12" type="text" name="contato" id="contato" value="" placeholder="Nome para contato">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <?php include Yii::app()->getBasePath() . "/views/site/pages/conta/users/atributos/ramo_atuacao_simple.php"; ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span5">
                            <label class="texto">Número de telefone fixo</label>                    
                            <input id="ddd_fone" type="text" class="span2" value="" size="3" maxlength="2" tabindex="13" name="ddd_telefone"/>
                            <input id="nr_fone" type="text" class="span4" value="" size="18" maxlength="8" tabindex="14" name="numero_telefone"/>
                        </div>
                        <div class="span5">
                            <div class="span12">
                                <div class="span12">
                                    <label class="desc marg_bottom texto" id="title16" for="Field16">Número de Celular</label>
                                </div>

                                <div class="row-fluid">
                                    <input id="ddd_cel" type="text" class="span2" value="" size="3" maxlength="2" tabindex="15" name="ddd_celular"/>
                                    <input id="nr_cel" type="text" class="span4" value="" size="18" maxlength="10" tabindex="16" name="numero_celular"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


                    <h3>Endereço</h3>


                    <div class="row-fluid">
                        <div class="span5">
                            <div class="row-fluid">
                                <input id="cep" type="text" class="span4" value="" size="9" maxlength="9" tabindex="13" placeholder="CEP" name="cep"/>
                                <span class="legend" for="cep">Ex: 13024-450</span>
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid">
                        <div class="span7">                        
                            <input id="endereco" type="text" class="span12" value="" size="8" tabindex="5" placeholder="Endereço" name="endereco"/>                        
                        </div>
                        <div class="span1">
                            <input id="numero" type="text" class="span12" value=""  tabindex="6" placeholder="Número" name="numero"/>
                        </div>
                        <div class="span3">
                            <input id="complement" type="text" class="span12" value=""  tabindex="6" placeholder="Complemento" name="complement"/>
                        </div>
                    </div>                   

                    <div class="row-fluid">
                        <div class="span4">
                            <input id="bairro" type="text" class="span12" value=""  tabindex="6" placeholder="Bairro" name="bairro"/>
                        </div>
                        <div class="span3">
                            <input id="cidade" type="text" class="span12" value=""  tabindex="6" placeholder="Cidade" name="cidade"/>
                        </div>
                        <div class="span4">
                            <div class="styled-select-uf">
                                <select id="estado" name="estado" tabindex="10" class="span2">
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MG">MG</option>
                                    <option value="MT">MG</option>
                                    <option value="MS">MS</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PN">PN</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RS">RS</option>
                                    <option value="SP" selected>SP</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span4">
                            <label class="texto">Você é fornecedor de:</label>
                            <select id="tipo_fornecedor" name="tipo_fornecedor">
                                <option value="">Escolha</option>
                                <?php foreach($page_prop['content'] as $values){ ?>
                                <option value="<?php echo $values['id_item'] ?>"><?php echo $values['item_string'] ?></option>
                                <?php } ?>                    
                            </select>
                        </div>
                        <div class="span4">  
                            <label class="texto">Melhor tipo de contato:</label>
                            <select id="tipo_contato" tabindex="12">
                                <option value="E-mail" selected="selected">E-mail</option>
                                <option value="Celular">Celular</option>
                                <option value="Telefone de Contato">Telefone de contato</option>
                                <option value="Outros">Outros</option>
                            </select>                 
                        </div>
                    </div>
                    <div id="output_contact"></div>
                    <hr class="half" />
                    <label>&nbsp;</label>
                    <div class="left"><input class="botao btn-second mgR2" type="button" value="Limpar" id='bt_clear_fornecedor'></div>
                    <div class="left"><input class="botao btn-main" type="button" value="Enviar" id='bt_submit_fornecedor'></div>

                </form>
                <!-- END CONTACT FORM -->				
            </div>
        </div>
    </div>
    </hr>
    <?php //} ?>
        
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->

    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
    
    <div class="mgFooter"></div>
</div>

<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>