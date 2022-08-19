<!-- Modal -->
<div class="modal fade" id="sob_consulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabelSobConsulta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="myModalLabelSobConsulta">Cotação de produtos</h4>
            </div>
            <div class="modal-body">
                <div id="container_indique_form" class="row-fluid">
                    <form id="formSobConsulta">
                        <div class="row-fluid">
                            <div class="span2"><input type="number" value="1" id="sob_consulta_nr" name="sob_consulta_numero" class="span12"/></div>
                            <div class="span10"><div class="truncate"><h3 id="title_consultar" class="mg0"></h3></div></div>
                        </div>
                        <div class="row-fluid hide">
                            <input id="name_sob_consulta" type="text" class="span12" value="" placeholder="Seu nome" name="nome"/>
                            <input id="email_sob_consulta" type="email" class="span12" value="" name="email" placeholder="Seu e-mail"/>
                            <textarea rows="1" id="mensagem_sob_consulta" class="span12" placeholder="Escrever algo?" name="message"></textarea>
                        </div>                        
                        <input type="hidden" id="titulo_sob_consulta" name="titulo_sob_consulta"/>
                        <input type="hidden" id="id_sob_consulta" name="id_sob_consulta"/>
                        <div id="input_sob_consulta"></div>
                    </form>
                </div>
                <div id="output_sob_consulta" class="row-fluid"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-second" data-dismiss="modal">Continuar cotando</button> 
                <button type="button" class="btn btn-main bt_shopping_cart_global bt_consultar_prod_id" title="Adicionar ao carrinho" id="" data-id-variante="0" data-id-produto="0" data-tipo="produto" alt="bt_shopping_cart"><i class="fa fa-plus mgR"></i>Adicionar</button>
                <hr class="half" />
                <a href="/produtos/cotacao" class="btn btn-success">Fechar cotação</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->