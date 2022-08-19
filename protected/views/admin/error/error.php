<div class="mainPan">
    <div class="wrap">
        <div class="pan_status">
            <div class="container_pan_status">
                <div class="pan_message_status">Error</div>
                <div class="bg_status">                    
                    <div class="container_error_message"><?php echo $message ?></div>
                    <div class="container_error_trace"><?php echo nl2br($trace); ?></div>
                </div>
                <div class="status_logo_cliente"></div>                
            </div>            
        </div>
    </div>
</div>
<?php 
//Code to expired session
//MAke sure it's working properly
$session = new CHttpSession; $session->open(); if($session["logado_admin"] == '0'){?>
<script type="text/javascript">parent.window.location = "/admin";</script>
<?php } $session->close(); ?>