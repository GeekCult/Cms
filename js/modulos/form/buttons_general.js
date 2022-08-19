/*
 * Javascript Document
 * 
 * Helper JS, pre submit account 
 *
 */


/*
 * Método chamado dentro da view
 * isso evita alguns listeners desnecessários
 * 
 */
function initListenerButtonsPopoUp(){
    
    //It handles with curriculum
    $('#bt_create_curriculum').click(function(){       
        window.location = "/conta/curriculum/editar";                
    }); 
    
    //It handles with forgot password
    $('#bt_esqueci_senha').click(function(){       
        
        var email = $("#email_senha").val();
        $("#output_esqueci_senha").empty().append("<div class='bg-info'>Enviando...</div>");
        if(email != ""){
            $.post("/site/email/esqueci_senha",{                 
                email: email
            },function(data){

                var jsonObject = eval('(' + data + ')');

                if(jsonObject['ERROR'] > 0){
                   $("#container_senha_fields").hide();
                    $(".subtitle_senha_id").hide();
                    $("#output_esqueci_senha").empty().append("<div class='bg-danger'>Ocorreu um erro</div>");
                }

                if(jsonObject['SUCCESS'] > 0){
                    $("#container_senha_fields").hide();
                    $(".subtitle_senha_id").hide();
                    $("#output_esqueci_senha").empty().append("<div class='bg-success'>Email enviado!</div>");

                    if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/site/senha/pedido_realizado']);
                    if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv': '/site/senha/pedido_realizado'});
                }

            });
        }else{
            $("#output_esqueci_senha").empty().append("<div class='bg-danger'>Digite seu email</div>");
        }
        
    });
    
    //It handles with forgot password
    $('#bt_desbloqueio_senha').click(function(){       
        
        var email = $("#email_senha_desbloqueio").val();
        $("#output_desbloqueio_senha").empty().append("<div class='bg-info'>Enviando...</div>");
        
        if(email != ""){
            $.post("/site/email/desbloqueio_senha",{                 
                email: email
            },function(data){

                var jsonObject = eval('(' + data + ')');

                if(jsonObject['ERROR'] > 0){
                   $("#container_senha_fields").hide();
                    $(".subtitle_senha_id").hide();
                    $("#output_desbloqueio_senha").empty().append("<div class='bg-danger'>Ocorreu um erro</div>");
                }

                if(jsonObject['SUCCESS'] > 0){
                    $("#container_senha_fields").hide();
                    $(".subtitle_senha_id").hide();
                    $("#output_desbloqueio_senha").empty().append("<div class='bg-success'>Senha desbloqueada</div>");

                    if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/site/senha/desbloqueio']);
                    if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv': '/site/senha/desbloqueio'});
                }

            });
        }else{
            $("#output_desbloqueio_senha").empty().append("<div class='bg-danger'>Digite seu email</div>");
        }
        
    });
    //It handles with signup
    $('#bt_cadastrar_esqueci_senha').click(function(){
         showPopUp("componente", "form_submit", "cadastrar_business", 850, 360, false);                
    });
        
}