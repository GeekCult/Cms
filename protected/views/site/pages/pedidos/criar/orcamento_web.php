<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan">

    
    <div class="row-fluid">
        <h2>VOCÊ ESTÁ A UM PASSO DE COLOCAR SUA EMPRESA NA WEB!</h2>
        <h5>Assinatura de Serviços</h5>
        <p>Para concluir o processo de assinatura de um plano de hospedagem ou registro de domínio preencha os camposa baixo para contratar nossos serviços.</p>
    </div>
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <div class="row-fluid"> 
        
            <form id="form_orcamento">
                <div class="mgR mgL">
                    <h3>Dados do Domínio</h3>
                    <div class="row-fluid">
                        <p>Informe o domínio que irá hospedar, se irá registrar o domínio ou apenas reservar o endereço para sua empresa.</p>
                        <p class="bold mgT">Endereço do Site (Domínio)*</p>
                        <input type="text" name="dominio" placeholder="http://www." class="span8"/>
                   
                        <p class="bold mgT">Sobre o registro do seu domínio, qual a melhor opção?</p>
                        <div class="row-fluid">
                            <input type="radio" name="registro" class="left mgR" id="registro_1" value="Quero que hospede e registre o meu domínio."/>
                            <label for="registro_1" class="mgL2">Quero que hospede e registre o meu domínio.</label>
                        </div>   
                        <div class="row-fluid">
                            <input type="radio" name="registro" class="left mgR" id="registro_2" value="Já possuo um domínio, quero apenas hospede meu site."/>
                            <label for="registro_2" class="mgL2">Já possuo um domínio, quero que apenas hospede meu site.</label>
                        </div>
                        <div class="row-fluid">
                            <input type="radio" name="registro" class="left mgR" id="registro_3" value="Quero apenas reservar o meu domínio."/>
                            <label for="registro_3" class="mgL2">Quero apenas reservar o meu domínio.</label>
                        </div>

                    </div>
                </div>
                <div class="mgB"></div>
                <div class="row-fluid">                    
                    <div class="mgR mgL">
                        <h3>Dados do Responsável</h3>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="span12">                    
                                    <input id="nome" type="text" class="span12" value="" tabindex="1" placeholder="Nome completo" name="nome"/>                   
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span12">                    
                                    <input id="cpf" type="text" class="span12" value="" tabindex="1" placeholder="CPF do responsável" name="cpf"/>                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="row-fluid"> 
                            <div class="span6">
                                <input  id="email" type="email" class="span12" value="" tabindex="3" placeholder="E-mail para contato" name="email"/>
                            </div>
                             
                            <div class="span6">
                                <input id="contato" type="text" class="span12" value="" tabindex="2" placeholder="Telefone" name="telefone"/>
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
                                    <div class="row-fluid">
                                        <input id="cep" type="text" class="span6" value="" maxlength="9" tabindex="8" placeholder="CEP - ex:13088-300" name="cep"/>                            
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
                                        <select id="estado" name="estado" tabindex="13">
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
                </div>
               
                <div class="row-fluid">
                    <div class="mgR mgL">
                        <h3>Plano de Hospedagem Escolhido</h3>
                        <p class="bold">Escolha a Periodicidade para pagamento</p>
                        <div class="row-fluid">
                            
                            <div class="row-fluid">
                                <input type="radio" name="hospedagem" class="left mgR" id="hospedagem_1" value="Hospedagem Mensal (R$ 27,90)"/>
                                <label for="hospedagem_1" class="mgL2">Hospedagem Mensal (R$ 27,90)</label>
                            </div>   
                            <div class="row-fluid">
                                <input type="radio" name="hospedagem" class="left mgR" id="hospedagem_2" value="Hospedagem Semestral (R$ 72,90) - Desconto de R$ 10,80"/>
                                <label for="hospedagem_2" class="mgL2">Hospedagem Trimestral (R$ 72,90) - Desconto de R$ 10,80</label>
                            </div>
                            <div class="row-fluid">
                                <input type="radio" name="hospedagem" class="left mgR" id="hospedagem_3" value="Hospedagem Anual (R$ 259,20) - Desconto de R$ 75,60"/>
                                <label for="hospedagem_3" class="mgL2">Hospedagem Anual (R$ 259,20) - Desconto de R$ 75,60</label>
                            </div>
                            <div class="row-fluid">
                                <input type="radio" name="hospedagem" class="left mgR" id="hospedagem_4" value="Quero Apenas Registrar meu domínio (Nacionais R$ 29,90 / Internacionais R$ 39,90)"/>
                                <label for="hospedagem_4" class="mgL2">Quero Apenas Registrar meu domínio (Nacionais R$ 29,90 / Internacionais R$ 39,90)</label>
                            </div>
                        </div>
                        <div class="row-fluid mgT2">
                            <p class="bold">CUPOM de Desconto!</p>
                            <input type="text" name="cupom" placeholder="" class="span8"/>
                            <p>Se você recebeu um cupom de desconto informe o código promocional neste campo!</p>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="celular" id="celular"/>
                <input type="hidden" name="descricao" id="descricao" value="Orçamento de Hospedagem e criação de Site para minha empresa"/>
                <input type="hidden" name="titulo" id="titulo" value="Orçamento Site"/>
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
        </div>
    </div>
    
    <div class='mgFooter'></div>

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->     

</div>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>

<script src="/js/site/pedidos/orcamentos_web.js"></script>