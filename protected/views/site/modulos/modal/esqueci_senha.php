<!-- Modal -->
<div class="modal fade" id="esqueci_senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEsqueci" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="myModalLabelEsqueci">Esqueceu sua senha?</h4>
            </div>
            <div class="modal-body">
                <p>Digite seu e-mail para receber uma nova</p>
                <div class="row-fluid">                    
                    <input id="email_senha" type="email" class="span12" value="" name="email" placeholder="E-mail"/>
                </div>
                <div class="row-fluid">                    
                    <div id="output_esqueci_senha"></div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-second" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-main" id="bt_esqueci_senha">Enviar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="desbloqueio_senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDesbloqueio" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="myModalLabelDesbloqueio">Senha bloqueada?</h4>
            </div>
            <div class="modal-body">
                <p>Digite seu e-mail para desbloquear sua senha</p>
                <div class="row-fluid">                    
                    <input id="email_senha_desbloqueio" type="email" class="span12" value="" name="email" placeholder="E-mail"/>
                </div>
                <div class="row-fluid">                    
                    <div id="output_desbloqueio_senha"></div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-second" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-main" id="bt_desbloqueio_senha">Enviar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/modulos/form/buttons_general.js"></script>
<script type="text/javascript">initListenerButtonsPopoUp();</script>
<!-- Modal -->