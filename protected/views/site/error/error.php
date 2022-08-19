<div class="mainPan">
    <div class="wrap">
        <div class="row-fluid">
            <div class="pan_status container">
                
                <div id="error_message" class="container_pan_status">
                    <div class="status_logo_cliente">
                        <?php if(true == false){ ?>
                        <img src="/media/images/logos/<?php echo $info['logo']['container']['foto'] ?>" alt="logo" title="Logo" height="50" class="hide"/>
                        <?php } ?>
                    </div>
                    <div class="messageEr">
                        <h2>Isso é constrangedor: ocorreu um erro</h2>
                        <input type="button" class="botao" value="ver detalhes" id="ver_detalhes"/>
                    </div>

                    <div id="message_error" class="bg_status">                    
                        <div class="container_error_message"><?php echo $message ?></div>
                        <div class="container_error_trace">
                            <textarea name="" id="" cols="30" rows="10" style="width: 570px; height: 100px; line-height: 15px; color: #333"><?php echo $trace; ?></textarea>
                        </div>
                    </div>
                    <div class="pan_message_status"><b>Info:</b> <span class="sF">Um e-mail foi enviado com detalhes ao Administrador do site</span></div>
                </div>            
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    $('#ver_detalhes').click(function(){$('#message_error, .messageEr').toggle();});
    updateIntro(<?php echo json_encode($info['layout']) ?>);
</script>