/*
    Document   : curriculum_simple
    Created on : 16/11/2010, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript contact controller
    Purpose of the javascript follows.
*/
var step1 = false;
var step2 = false;
var step3 = false;
var step4 = false;

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
    }        
);
/*
 * Init create curriculum listeners
 *
 */
function initCadastroRapido(){

    $('#password_form').keyup(function(){                
        $('#formCredencialSeguranca').attr('src',passwordStrength($('#password_form').val()));
    });
    
    //Last button
    $("#bt_submit_curriculum").click(function(e){
        submitUserForm();
    });
    
    $('#bt_goto_2').click(function(e){
        goToStep2();
    });
    
    $('#bt_goto_3').click(function(e){
        goToStep3();
    });
    
    $('#bt_goto_4').click(function(e){
        goToStep4();
    });
    
    $('#bt_goto_5').click(function(e){
        goToStep5();
    });
    
    $('#bt_back_2').click(function(e){
        goToStep1();
    });
    
    $('#bt_back_3').click(function(e){
        goToStep2();
    }); 
    
    $('#bt_back_4').click(function(e){
        goToStep3();
    });
    
    $('#bt_continue_next_action').click(function(e){
        lauchNextActionSubmit();
    });
    
    $('.bt_close_modal').click(function(){
       $('.bt_close_login').trigger('click'); 
    });
    
    //It handles the celular operator
    $('.cel_operadoras :button').click(function(){   
        operadoraCelular($(this).attr('rel'), this.id);
    });

    initBlurCheckAction();
    initMasksCadastro();
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
 * From step 1 to step 2
 * Cadastro nomes, telefone
 *
 */
function goToStep2(){
    
    initBlurCheckAction();
    
    //Step - 2
    if((field1 == "" || email == "")){
        $("#message_error_1").empty().append("<div class='bg-danger'>Preencha todos os campos</div>");  
        step1 = false;
    }else{
        $('#step_1').hide();
        $('#step_2').fadeIn("fast");
        $('#step_3').hide();
        $('#step_4').hide();
        $(".message_errors").css("display", "none");
        step1 = true;
    } 
}

/*
 * Shows step 3
 * Endereço
 *
 */
function goToStep3(){
    
    initBlurCheckAction();
    
    //Step - 3
    if(endereco == "" || cidade == "" || bairro == ""){
        $("#message_termos").empty().append("<div class='bg-danger'>Preencha todos os dados</div>");
        step2 = false;
    }else{
        $('#step_1').hide();
        $('#step_2').hide()
        $('#step_3').fadeIn("fast");
        $('#step_4').hide();
        $(".message_errors_2").css("display", "none");
        step2 = true;
    } 
}

/*
 * Shows step 2
 * Termos e condiçoes
 *
 */
function goToStep4(){
    //Step - 3
    var termo = $("input[name='formTermosAceito']:checked").val();

    if(termo == undefined){      
        $("#message_termos").empty().append("<div class='bg-danger'>Você deve aceitar os termos de uso</div>"); 
        step3 = false;
    }else{
         $('#step_1, #step_2, #step_3').hide();
         $('#step_4').fadeIn("fast");
         step3 = true;
    }
}

/*
 * Shows step 5
 * Senha
 *
 */
function goToStep5(){
    
    password = $('#password_form').val();
    password_repeat = $('#password_repeat').val();

    if(password == "" || password_repeat == ""){        
        $("#message_password").empty().append("<div class='bg-danger'>Você deve digitar uma senha</div>"); 
        step3 = false;
    }else if(password != password_repeat){        
        $("#message_password").empty().append("<div class='bg-danger'>As senhas devem ser iguais</div>"); 
        step4 = false;
    }else{ 
        step4 = true;
        submitUserForm();        
    }
}

/*
 * Shows step 6
 * Conclusao, cadastro efetivado
 *
 */
function goToStep6(){
    $('#step_1').hide();
    $('#step_2').hide();
    $('#step_3').hide();
    $('#step_4').hide();
    $('#step_5').fadeIn("fast");
}

/*
 * Init masks listeners
 * There are differences between PJ and PF
 * 
 * @param number
 * 
 */
function initMasksCadastro(){ 
    
    var type = $('#helper_type_account').val();
    
    $('#phone').mask('(99) 9999-9999');
    $('#celphone').mask('(99) 99999-9999');
     
    if(type == 0){
        $('#documento').mask("999.999.999-99");
        $('#company').mask("99.999.999/9999-99"); 
        $("#extra").mask("99/99/9999");
    }else{
        $('#documento').mask("99.999.999/9999-99"); 
    }
    
    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#cep').on('keyup keydown change', function(event){
        
        var cep = $("#cep").val();        

        if(cep.length == 9){            
            $.post("/cep/webservice",{
            cep: cep
            },function(data){
                var state_combo = document.getElementById("estado");                
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                $("#endereco").val(jsonObject['tp_logradouro'] + ": " + jsonObject['logradouro']);
                $("#cidade").val(jsonObject['cidade']);
                $("#bairro").val(jsonObject['bairro']);
                state_combo.value = jsonObject['id_uf'];
            });
        }      
    });
}

/*
 * Init blur and focus listeners
 * 
 */
function initBlurCheckAction(){
    
    //Step 1
    field1 = $('#field1').val();
    field2 = $('#field2').val();
    documento = $('#documento').val();
    email = $('#email_cadastro_rapido').val();
    extra = $('#extra').val(); 
    
    //Step 2
    endereco = $('#endereco').val();
    bairro = $('#bairro').val();
    cidade = $('#cidade').val();
}

/*
 * Submit form when it is complet
 *
 */
function submitUserForm(){ 
    
    //User data
    var field1 = $('#field1').val();
    var field2 = $('#field2').val();
    var documento = $('#documento').val();
    var email = $('#email_cadastro_rapido').val();
    var phone = $('#phone').val();
    var celphone = $('#celphone').val();
    var extra = $('#extra').val();
    var type = $('#helper_type_account').val();    
    var termo = $('#formTermosAceito').val();
    var company = $('#company').val();
    
    //User adress
    var endereco = $('#endereco').val();
    var numero = $('#numero').val();
    var bairro = $('#bairro').val();
    var cidade = $('#cidade').val();
    var complemento = $('#complemento').val();
    var estado = $('#estado').val();
    var cep = $('#cep').val();
    
    var password = $('#password_form').val();
    var password_repeat = $('#password_repeat').val();
    var operadora = $('#cel_operator').val();

    //Step - 5 
    if(step1 && step2 && step3 && step4) completeForm = true;      
    
    if(completeForm){
        
        $("#message_password").empty().append("<div class='bg-info'>Salvando...</div>");

        var passwordMD5 = MD5($('#password_form').val());
        if(!isPressedSubmitUser){
            isPressedSubmitUser = true;
            $.post("/user/cadastrar_rapido",{
                type: type,
                field1: field1, 
                field2: field2,
                email: email,            
                extra: extra,
                documento: documento,
                celular: celphone,
                telefone: phone,
                company: company,
                password: passwordMD5,
                endereco: endereco,
                numero: numero,
                complemento: complemento,
                cidade: cidade,
                bairro: bairro,
                estado: estado,
                cep: cep,
                operadora:operadora

            },function(data){
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                if(jsonObject['ERROR'] != '0'){  
                    showError(jsonObject);
                }else{
                    goToStep6();
                    if(typeof _gap !== 'undefined') _gaq.push(['_trackPageview', '/cadastrar/' + type]);
                    if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/cadastrar/' + type});
                }
                isPressedSubmitUser =false;
            });
        }
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

/**
 *
 * Launches the next action, see the id helper_next_action_purple into index layout
 * The last argument is the next action
 * 
**/
function lauchNextActionSubmit(){
    var layoutAction = parent.$("#helper_next_action_purple").val();
    //var typeAction = $("#helper_next_action_purple").attr("name");
    //var folderAction = $("#helper_next_action_purple").attr("alt");
    reloadPopUp("inscricao", "inscricao", layoutAction, "completar_inscricao", 350, 850);
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

/*
 * Sets celular opearator 
 */
function operadoraCelular(value, id){
   
    var nextOp = (value * 1) + 1;
    if(nextOp > 4) nextOp = 0;
    
    $('#' + id).hide();
    $('#' + 'op_type_' + nextOp).show();
    $("#cel_operator").val(nextOp);
}