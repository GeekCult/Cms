<!-- Modal -->
<div class="modal fade" id="indique_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="myModalLabel">Indique para seu Amigo</h4>
            </div>
            <div class="modal-body">
                <div id="container_indique_form" class="row-fluid">
                    <input id="name_indique_amigo" type="text" class="span12" value="" placeholder="Seu nome"/>
                    <input id="email_indique_amigo" type="text" class="span12" value="" name="email" placeholder="E-mail do amigo"/>
                    <textarea rows="3" cols="" id="mensagem_indique_amigo" class="span12" placeholder="Mensagem"></textarea>
                </div>
                <div id="container_indique_result" class="row-fluid" style="display:none">
                    <div class="span12">
                        <h2>Mensagem enviada com sucesso!</h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary bt_submit_friend">Enviar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/modulos/form/indique_amigo.js"></script>
<!-- Modal -->