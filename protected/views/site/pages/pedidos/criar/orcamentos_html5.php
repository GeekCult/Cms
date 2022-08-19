<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan">
    <!--TITLE-->
    <?php if($page_prop['gel_fr_initial'] != ""){ ?>
    <div class="row-fluid">
        <div class="mgR mgL">
        <h2 class="center standart-h2title"> 
            <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
        </h2>
        <hr class="half"/>
        </div>
    </div>
    <?php } ?>

    <!--END: TITLE-->

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <?php if ($text['titulo_01'] != '' || $text['texto_01'] != '') { ?>
    <div class="row-fluid">
        <!--IMAGE -->
        <div class="mgR mgL">
        <div class="span12 center">
            <?php if ($graphics['container_1'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                <div class='image_vertical_layout'>
                    <img src="/media/user/images/original/<?php echo $graphics['container_1']['foto'] ?>"/>
                </div>
             <?php  } } ?>
        </div>
        </div>
        <!-- END IMAGE -->

        <!-- FEATURE -->
        <div class="mgR mgL">
        <div class="span12">

            <h3 class="standart-h2title"><?php echo $text['titulo_01'] ?></h3>
            <hr class="half"/>
            <p class="lead"><?php echo nl2br($text['texto_01']) ?></p>

        </div>
        </div>
        <!--END:  FEATURE -->
        
    </div>
    <?php } ?>
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid"> 
        <div class="mgR mgL">
            <h3>Dados de contato</h3>
        </div>
    </div>
    <form id="form_orcamento">
        <div class="row-fluid"> 
            <div class="mgR mgL">
                <div class="span12">
                    <div class="span12">                    
                        <input id="nome" type="text" class="span12" value="" tabindex="1" placeholder="Nome/Razão Social" name="nome"/>                   
                    </div>
                </div>
                <div class="row-fluid"> 
                    <div class="span12">
                        <input id="contato" type="text" class="span12" value="" tabindex="2" placeholder="Nome para contato ou apelido" name="contato"/>
                    </div>
                </div>
                <div class="row-fluid"> 
                    <div class="span12">
                        <input  id="email" type="email" class="span12" value="" tabindex="3" placeholder="E-mail" name="email"/>

                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="mgR mgL">
                <div id="span12">
                    <div class="span5">
                        <div class="span12">
                            <label class="desc marg_bottom" id="title16" for="Field16">Número de telefone fixo</label>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                 <input id="ddd_fone" type="text" class="span2" value="" size="3" maxlength="2" tabindex="4" name="ddd_telefone"/>
                                 <input id="nr_fone" type="text" class="span4" value="" size="18" maxlength="8" tabindex="5" name="numero_telefone"/>
                            </div>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="span12">
                            <div class="span12">
                                <label class="desc marg_bottom" id="title16" for="Field16">Número de Celular</label>
                            </div>

                            <div class="row-fluid">
                                <input id="ddd_cel" type="text" class="span2" value="" size="3" maxlength="2" tabindex="6" name="ddd_celular"/>
                                <input id="nr_cel" type="text" class="span4" value="" size="18" maxlength="10" tabindex="7" name="numero_celular"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="mgR mgL">
                <h3>Endereço</h3>
            </div>
        </div>
        <div class="row-fluid">
            <div class="mgR mgL">
                <div class="span12">
                    <div class="span5">
                        <div class="span12">
                            <div class="span12">
                                <label class="desc marg_bottom" id="title16" for="Field16">CEP</label>
                            </div>

                            <div class="row-fluid">
                                <input id="cep" type="text" class="span4" value="" maxlength="9" tabindex="8" placeholder="13088-300" name="cep"/>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="mgR mgL">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span10">                        
                            <input id="endereco" type="text" class="span12" value="" size="8" tabindex="9" placeholder="Endereço" name="endereco"/>                        
                        </div>
                        <div class="span2">                        
                            <input id="numero" type="text" class="span12" value="" size="8" tabindex="10" placeholder="N." name="numero"/>                        
                        </div>
                    </div>                   

                    <div class="row-fluid">
                        <div class="span4">
                            <input id="bairro" type="text" class="span12" value=""  tabindex="11" placeholder="Bairro" name="bairro"/>
                        </div>
                        <div class="span3">
                            <input id="cidade" type="text" class="span12" value=""  tabindex="12" placeholder="Cidade" name="cidade"/>
                        </div>
                        <div class="span2">
                            <div class="styled-select-uf mgL">
                                <select id="estado" name="estado" tabindex="13" name="estado">
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

                </div>
            </div>

            <div class="row-fluid">
                <div class="mgR mgL">
                <span>
                    <label class="desc marg_bottom" id="title14" for="Field14">Escolha qual melhor tipo de contato</label>
                </span>
                <div class="clear"></div>
                <span>
                    <div class="styled-select">
                        <select id="tipo_contato" tabindex="14" name="tipo_contato">
                            <option value="E-mail" selected="selected">E-mail</option>
                            <option value="Celular">Celular</option>
                            <option value="Telefone de Contato">Telefone de contato</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>  
                </span>
                </div>
            </div>
        </div>
        <div class="row-fluid mgT2">
            <div class="mgR mgL">
                <div class="row-fluid">
                    <div class="span12">
                        <input id="titulo" class="span12 mgB" name="titulo" placeholder="O que você precisa?" tabindex="15"/>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <textarea id="mensagem" class="span12" rows="8" name="descricao" placeholder="Descrição do que você precisa" tabindex="16"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row-fluid">
         <div class="mgR mgL">
             <div id="output_contact"></div>
             <div class="clear"></div>
             <div class="form_buttons_support mgT">
                <div class="bt_common left mgR">
                    <input type='button' id='bt_clear' value='limpar'  class="botao btn-second" />
                </div>
                <div class="bt_common left">
                    <input type='button' id='bt_submit_pedido' value='enviar'  class="botao btn-main" />
                </div>
             </div>
         </div>
    </div>
    <div class='mgFooter'></div>

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->     

</div>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<script src="/js/site/pedidos/orcamentos_html5.js"></script>