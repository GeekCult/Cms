/*
    Document   : login admin
    Created on : 15/03/2011, 20:31:00
    Author     : CarlosGarcia
    Description: Login behaviour
    Purpose of the javascript follows.
*/  
var empty = "";
isPreventDefault = false;
//Init
$(document).ready(function(){

    //showAlertLogin("Logar!!!");

    $("#bt_logar").click(function(){
        //logar2();
        $("#formLoginAdmin").submit();
    });

    $('#user').focus();
    
    $('.flash_notice_button_close').click(function(){
         $('.flash_notice').fadeOut("slow");
    });
    
    $("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'autoScale': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': false, 'overlayShow': true, 'titleShow' : false,'type' : 'image',
        'onStart':function(){
            $.fancybox.removeBackground();
	}
    });
    
    //It handles with forgot password
    $('#bt_esqueci_senha').click(function(){ 
        
        var email = $("#user").val();
        $("#output2").empty().append("<div class='bg-info'>Enviando...</div>");
        if(email != ""){
            $.post("/site/email/esqueci_senha",{                 
                email: email
            },function(data){

                var jsonObject = eval('(' + data + ')');

                if(jsonObject['ERROR'] > 0){
                   $("#output2").empty().append("<div class='bg-danger'>Houve um erro</div>");
                }

                if(jsonObject['SUCCESS'] > 0){
                    $("#output2").empty().append("<div class='bg-success'>Pedido de senha enviado!</div>");

                    if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/site/senha/pedido_realizado']);
                    if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv': '/site/senha/pedido_realizado'});
                }

            });
        }else{
            $("#output2").empty().append("<div class='bg-danger'>Digite seu e-mail</div>");
        }
        
    });

});//Close Document Ready

function keyPressed(key){
    
    if(key == "enter"){
       $("#bt_logar").trigger('click');
    }
}

function logar(){

    var user = $('#user').val();
    var password = MD5($('#password').val());
    var permitir = $('#permitir').attr('checked');
    $(".message_result").hide();

    $.post("/admin/login/signin",{
        loginAcessoUser: user,
        loginAcessoSenha: password,
        loginPermitir: permitir
        
    },function(data){

        var jsonObject = eval('(' + data + ')');
        
        if(jsonObject['success']){           
            
            //Refresh page if it's a acessor
            //window.location = "/admin";
            
            $("#admin_user").text(jsonObject['user']);
            $("#admin_visits").text(jsonObject['visits_admin']);
            $("#site_visits").text(jsonObject['site_admin']);
            $("#admin_creation").text(jsonObject['creation']);

            //If the there is a flash notice on screen
            $('.flash_notice').fadeOut("slow");                
             
            $(".intro_logged_off").hide();
            $(".intro_logged_in").fadeIn("fast"); 
            
            //Save atributes to field email and password cache
            $("#formLoginAdmin").submit();

       }else{             
         $("#output").empty().append("<div class='message_result error'><i class='icon_p'></i><div class='content white'>Erro: Usuário ou Senha inválidos</div></div>");
         $(".message_result").show();         
       }
     
    });
    
    
}