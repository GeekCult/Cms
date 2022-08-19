<!-- Modal -->
<div class="modal fade" id="modal_contato" tabindex="-1" role="dialog" aria-labelledby="myModalLabelContato" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="myModalLabelContato">Contato</h4>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <form id="form_contato">
                        <div class="row-fluid">
                            <input id="nome" type="text" class="span12" value="" name="nome" placeholder="Nome"/>
                        </div>
                        <div class="row-fluid">
                            <input id="email" type="text" class="span12" value="" name="email" placeholder="Email"/>
                        </div>
                        <div class="row-fluid">
                            <input id="telefone" type="text" class="span12" value="" name="telefone" placeholder="Telefone"/>
                        </div>
                        <div class="row-fluid">
                            <textarea rows="3" id="mensagem" class="span12" name="mensagem" placeholder="Mensagem"></textarea>
                        </div> 
                    </form>                    
                </div>
                <div id="output_contact_modal" class="row-fluid"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-second" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-main" id="bt_submit_contato_modal">Enviar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->