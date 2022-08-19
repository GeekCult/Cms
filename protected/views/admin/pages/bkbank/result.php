<div class="form-group">
    <div class="ctnResult" style="margin: 0 20px;">
        <div class="row">
            <div class="col-md-10 col-xs-10"><h4>Resultado</h4></div>
            <div class="col-md-2 col-xs-2"><button type="button" class="btn btn-main right bt_clear_result" style="background: red">Limpar</button></div>
        </div>
    </div>
    <pre>
    <?php echo MethodUtils::prettyJson($content, true); ?>
    </pre>
</div>