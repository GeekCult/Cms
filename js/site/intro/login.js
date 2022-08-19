/*
 * Javascript Document
 * 
 * Helper JS, pre submit account 
 *
 */
   
var timer_type = "500";
var isValidUserPre = true;

/*
 * Método chamado dentro da view
 * isso evita alguns listeners desnecessários
 * 
 */
function initListenerPrecadastro(){
        
    //Apply the listeners
    applyListenerEmailFields(); 
    
    //It handles the logar form
    $('#bt_logar').click(function(){   
        logarPre();
    });      
}


function keyPressed(key){
    if(key == "enter"){        
        $("*:focus").each(function() {
            if($(this).attr("id") == "email_type" || $(this).attr("id") == "loginCadastradoCNPJ" || $(this).attr("id") == "loginCadastradoCPF") {continueTypeSigned();};
            if($(this).attr("id") == "email_login" || $(this).attr("id") == "loginSenha"){logarPre();};
            
        });  
    }
}
    
//This method listening the focus and blur
function applyListenerEmailFields(){

    $("#email_login").focus(function(){
        if($('#email_login').val() == "E-mail" || $('#email_login').val() == "E-mail deve ser preenchido"){
           $('#email_login').val('');
        }
    });

    $('#email_login').blur(function(){
        if($('#email_login').val() == ''){
           $('#email_login').val('E-mail');
        }
    });
        
    $("#loginSenha").focus(function(){
        if($('#loginSenha').val() == "Senha" || $('#loginSenha').val() == "Senha deve ser preenchida"){
           $('#loginSenha').val("");  
           $('#loginSenha').attr("type", 'password');
        }
    });

    $('#loginSenha').blur(function(){
        if($('#loginSenha').val() == ""){ 
            $('#loginSenha').attr("type", 'text');
           $('#loginSenha').val("Senha");
        }
    });
    

}

/*
 *  Logar pre cadastro!
 *  
 */
function logarPre(){
    
    isValidUserPre = true;
        
    var user_login_html = $("#email_login").val();
    var user_senha_html  = $("#loginSenha").val();
    var user_next_action  = $("#helper_next_action").val();       

    if(user_login_html == "" || user_login_html == "E-mail" || user_login_html == "E-mail deve ser preenchido"){
        $("#email_login").val("E-mail deve ser preenchido");
        isValidUserPre = false;
    }

    if($("#loginSenha").val() == "Senha" ||  $("#loginSenha").val() == "Senha deve ser preenchida"){  
        $("#loginSenha").val("");
        isValidUserPre = false;
    }

    if(isValidUserPre){  
        //Recolhe a antiga message de erro se existir
        $(".login_component_message").animate({height: "hide"},{duration: "500"});

        $.post("/login/autenticacao",{
            email: user_login_html,
            senha: user_senha_html,
            loginNextAction: user_next_action

        },function(data){ 

            var jsonObject = eval('(' + data + ')');
            if(jsonObject['logado'] == '1'){        

                if(jsonObject['next_action']!= ""){ 
                   
                    window.location = "/home";
                }else{
                    setTimeout("initLoginListenersButtons()", 500);
                    tb_removeLogin();
                    //If the there is a flash notice on screen
                    $('.flash_notice').fadeOut("slow");
                }

            }else{
                $("#message").empty().append("<div class='bg-danger mgB2'>Senha ou usuário inválido</div>");
            }             
        });
    }     
}

