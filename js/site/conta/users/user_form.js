/*
    Document   : user_form
    Created on : 16/03/2015, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript contact controller
    Purpose of the javascript follows.
*/
var action = 'novo';
var step1 = false;
var step2 = false;
var step3 = false;

var isPage_2 = false;
var isPage_3 = false;

var back1 = false;
var back2 = false;

var completeForm = false;
var isPressedSubmitUser = false;

// Password strength meter
// This jQuery plugin is written by firas kassem [2007.04.05]
// Firas Kassem  phiras.wordpress.com || phiras at gmail {dot} com
// for more information : http://phiras.wordpress.com/2007/04/08/password-strength-meter-a-jquery-plugin/

var shortPass = '/media/images/icons/security/security_password_none.png';
var badPass = '/media/images/icons/security/security_password_baixa.png';
var goodPass = '/media/images/icons/security/security_password_media.png';
var strongPass = '/media/images/icons/security/security_password_alta.png';

$(document).ready(function(){
    initCadastroRapido();
});

/*
 * Init create curriculum listeners
 *
 */
function initCadastroRapido(){
    
    $('#password').keyup(function(){                
        $('#formCredencialSeguranca').attr('src',passwordStrength($('#password').val()));
    });
    
    $('#bt_goto_1').click(function(e){
        goToStep2();
    });
    
    $('#bt_goto_2').click(function(e){
        goToStep3();
    });
    
    $('#bt_goto_3').click(function(e){
        goToStep4();
    });
    
    $('#bt_back_2').click(function(e){
        goToStep1();
    });
    
    $('#bt_back_3').click(function(e){
        goToStep2();
    });    

    initMasksCadastro($("#helper_type_account").val());
    
    $(".bt_change_type").click(function(e){
        e.preventDefault();
        $.post("/site/relatar/set_session_data",{
            id_user: 0,
            label: 'pre_type',
            value: $(this).attr('data-type')

        },function(data){
            window.location.reload();
        });
    });
}

/*
 * Shows step 1
 * Cadastro nomes, telefone
 *
 */
function goToStep1(){
    $(".message_errors").css("display", "none");

    $('#step_1').fadeIn("fast");
    $('#step_2').hide();
    $('#step_3').hide();    
}

/*
 * Shows step 2
 * Go to termo e condições
 *
 */
function goToStep2(){
    
    if($('#helper_tablet').val() != undefined ) if(documento == "") documento = '00000000000'; 
    var email  = $("#email_cadastro_rapido").val();
    var field1 = $("#field1").val();
    //Step - 2
    if(field1 == "" || email == ""){
        $("#message_error_1").empty().append("<div class='bg-danger mgB2'>Todos os campos devem ser preenchidos!</div>");  
        step1 = false;
    }else{
        $('#step_1, #step_3').hide();
        $('#step_2').fadeIn("fast");
        step1 = true;
    } 
     
}

/*
 * Shows step 3
 * Senha e Re-Senha
 *
 */
function goToStep3(){
    //Step - 3
    var termo = $("input[name='formTermosAceito']:checked").val();

    if(termo == undefined){      
        $("#message_termo").empty().append("<div class='bg-danger mgB2'>Você deve aceitar os termos e condições</div>"); 
        step2 = false;
    }else{
         $('#step_1').hide();
         $('#step_2').hide();
         $('#step_3').fadeIn("fast");
         step2 = true;
    }
}

/*
 * Shows step 4
 * Senha
 *
 */
function goToStep4(){
    
    password = $('#password').val();
    password_repeat = $('#password_repeat').val();

    if(password == "" || password_repeat == ""){        
        $("#message_senha").empty().append("<div class='bg-danger mgB2'>Digite uma senha!</div>");
        if(action != "editar") step3 = false;
    }else if(password != password_repeat){
        
        $("#message_senha").empty().append("<div class='bg-danger mgB2'>As senhas devem ser iguais!</div>");
        step3 = false;
    }else{ 
        step3 = true;
        submitUserForm();        
    }
}

/*
 * Shows step 5
 * Conclusao, cadastro efetivado
 *
 */
function goToStep5(){
    $('#step_1').hide();
    $('#step_2').hide();
    $('#step_3').hide();
    $('#step_4').fadeIn("fast");
}

/*
 * Init masks listeners
 * There are differences between PJ and PF
 * 
 * @param number
 * 
 */
function initMasksCadastro(type){ 
    
    $('#phone').mask('(99) 99999-9999');

    if(type == 0){
        $('#documento').mask("999.999.999-99");
        $("#extra").mask("99/99/9999");
    }else{
        $('#documento').mask("99.999.999/9999-99"); 
    }
}

/**
 *
 * Show errors
 * 
**/
function showError(jsonObject){   
    for(i = 0; i< jsonObject['ERROR_MSG'].length; i++){
        switch(jsonObject['ERROR_MSG'][i]){

             case "nome":
                $('#output_contact').append("<div class='output_message'><span>Preencha o campo nome</span></div>");
                break;

            case "email":
                $('#output_contact').append("<div class='output_message'><span>Campo e-mail preenchido incorreto</span></div>");
                break;

            case "email_duplicated":
                $("#message_password").text("Esse e-mail já está em uso, acesse sua conta para cadastrar seu currículum");
                break;

            case "telefone":
                $('#output_contact').append("<div class='output_message'><span>Campo telefone preenchido incorreto</span></div>");
                break;

            case "mensagem":
                $('#output_contact').append("<div class='output_message'><span>Preencha o campo mensagem</span></div>");
                break;
        }
    }
}

/*
 * Submit form when it is complet
 *
 */
function submitUserForm(){ 

    var field1 = $('#field1').val();
    var field2 = $('#field2').val();
    var documento = $('#documento').val();
    var email = $('#email_cadastro_rapido').val();
    var phone = $('#phone').val();
    var extra = $('#extra').val();
    var type = $('#helper_type_account').val();    
    var termo = $('#formTermosAceito').val();
    var company = $('#company').val();
    
    var password = $('#password').val();
    var password_repeat = $('#password_repeat').val();

    //Step - 5 
    if(step1 && step2 && step3) completeForm = true;      
    
    if(completeForm){

        var passwordMD5 = MD5($('#password').val());
        if(!isPressedSubmitUser){
            isPressedSubmitUser = true;
        
            $.post("/conta/users/cadastrar_rapido",{
                type: type,
                field1: field1, 
                field2: field2,
                email: email,            
                extra: extra,
                company: company,
                documento: documento,
                telefone: phone,
                password: passwordMD5  

            },function(data){
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                if(jsonObject['ERROR'] != '0'){  
                    showError(jsonObject);
                }else{
                    goToStep5();
                    if(typeof _gaq !== 'undefined')  _gaq.push(['_trackPageview', '/site/usuario/cadastro_realizado']);
                    if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/site/usuario/cadastro_realizado'});
                }
                isPressedSubmitUser = false;
            });
        }
    }
}

/*
 * TODO: remove this statement bellow and use this in a separate
 * class. There are 3 or more statement like that.
 * 
 */
function passwordStrength(password){

    score = 0
    //password < 4
    if (password.length < 6 ) {
        return shortPass;
    }

    //password == username
    //if (password.toLowerCase()==username.toLowerCase()) return badPass

    //password length
    score += password.length * 4;
    score += (checkRepetition(1, password).length - password.length) * 1;
    score += (checkRepetition(2, password).length - password.length) * 1;
    score += (checkRepetition(3, password).length - password.length) * 1;
    score += (checkRepetition(4, password).length - password.length) * 1;

    //password has 3 numbers
    if (password.match(/(.*[0-9].*[0-9].*[0-9])/))  score += 5;

    //password has 2 sybols
    if (password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) score += 5;

    //password has Upper and Lower chars
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  score += 10;

    //password has number and chars
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  score += 15;
    //
    //password has number and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([0-9])/))  score += 15;

    //password has char and symbol
    if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && password.match(/([a-zA-Z])/))  score += 15;

    //password is just a nubers or chars
    if (password.match(/^\w+$/) || password.match(/^\d+$/) )  score -= 10;

    //verifing 0 < score < 100
    if (score < 0) score = 0;
    if (score > 100) score = 100;

    if (score < 34) return badPass;
    if (score < 68) return goodPass;
    
    return strongPass;
}

function checkRepetition(pLen, str) {
    res = "";
    for ( i=0; i<str.length ; i++ ) {
        repeated=true;
        for (j=0;j < pLen && (j+i+pLen) < str.length;j++)
            repeated=repeated && (str.charAt(j+i)==str.charAt(j+i+pLen));
        if (j<pLen) repeated=false;
        if (repeated) {
            i+=pLen-1;
            repeated=false;
        }
        else {
            res+=str.charAt(i);
        }
    }
    return res;
}