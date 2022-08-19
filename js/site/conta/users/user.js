
/*
 * Javascript Document
 * 
 * Main JS, create user account 
 *
 */
    
var dataNiver;
var isUserSearchLive = false;
    
$(document).ready(function(){        
            
    (function(){
        $('input#formTermosAceito').bind('click', function(event, ui){
            toggleButton();
        });
        
        if($("#helper_user_type").val() == 'pf') iniListenersCriarPF();
        if($("#helper_user_type").val() == 'pj') iniListenersCriarPJ();
        
    })();                     
});

/**
 * Init listeners PF
 * 
**/
function iniListenersCriarPF(){
    //Declarar Aqui!
    $('#form-cadastroRg').mask('99.999.999-*');
    $('#loginCadastradoTipoNumero').mask("999.999.999-99");
    $('#formCadastroNascimento').mask("99/99/9999");
            
    $('#formCredencialSenha').keyup(function(){                
        $('#formCredencialSeguranca').attr('src',passwordStrength($('#formCredencialSenha').val()));
    });
    
    initCepListener();
}

/**
 * Init listeners PJ
 * 
**/
function iniListenersCriarPJ(){
    $('#formCredencialSenha').keyup(function(){
        $('#formCredencialSeguranca').attr('src',passwordStrength($('#formCredencialSenha').val()));
    });

    //Declarar Aqui!
    $('#formCadastroInscricao').mask('999.999.999.999');
    
    initCepListener();
}

/**
 * Init birthday mask
 * Only PF has it.
 * 
**/
function initListenerAddBirthday(){
    $("#formCadastroNascimento").mask("99/99/9999");
}

/**
 * Init CEP Listener
 * It's used for both: PF and PJ users
 *
 **/
function initCepListener(){
    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#cep').keyup(function(event){
        
        var cep = $("#cep").val();        

        if(cep.length == 9){            
            $.post("/site/cep/webservice",{
            cep: cep
            },function(data){
                var state_combo = document.getElementById("formEnderecoEstado");                
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                $("#formEnderecoEndereco").val(jsonObject['tp_logradouro'] + ": " + jsonObject['logradouro']);
                $("#formEnderecoCidade").val(jsonObject['cidade']);
                $("#formEnderecoBairro").val(jsonObject['bairro']);
                state_combo.value = jsonObject['id_uf'];
            });
        }      
    });
}

/**
 * Init Live Search User
 * It's used for both: PF and PJ users
 * It's used into conta session
 *
 **/
function initLiveSearchUser(){

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#liveSearch').keyup(function(event){
        
        var searchLive = $("#liveSearch").val();        

        if(searchLive.length >= 2){           
            $.post("/conta/users_selection/live_search",{
                search_live: searchLive
            
            },function(data){              
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                
                if(jsonObject['items'].length > 0){
                    var items_sc = "";
                    $("#items_live_search_user").empty();
                    for(i = 0; i < jsonObject['items'].length; i++){
                        items_sc  = "<div class='item_sl_c'>";
                        items_sc += "<div class='item_sl_c_string'>" + jsonObject['items'][i]['field1'] + "</div>";
                        items_sc += "</div>";
                        $("#items_live_search_user").append(items_sc);
                        $("#items_live_search_user").fadeIn("fast");
                        isUserSearchLive = true;
                    }
                    
                    
                }           
            });
         }      
    });
    
    $("#bt_live_search_user").click(function(){
        if(isUserSearchLive){
        $("#items_live_search_user").fadeOut("fast");
        isUserSearchLive = false;
        }else{
        $("#items_live_search_user").fadeIn("fast");
        isUserSearchLive = true;   
        }
    });
  
    $("#search_name_user, #email_user").keyup(function(event){
        loadUsers();        
    });
    
    $("#search_status_user, #search_type_user").change(function(){
        loadUsers();
    });
}

/**
 * Loads a new bunch of users
 * 
 */
function loadUsers(){

    var nameUser = $("#search_name_user").val();  
    var emailUser = $("#email_user").val();
    var typeUser = $("#search_type_user").val();
    var statusUser = $("#search_status_user").val();

    if(nameUser.length >= 3 || nameUser.length == 0){
        $.post("/conta/users_selection/filter",{
            name_user: nameUser,
            email_user: emailUser,
            type_user: typeUser,
            status_user: statusUser

        },function(data){                              
            $("#base_row").empty().append(data);      
        });
    }
}

// Password strength meter
// This jQuery plugin is written by firas kassem [2007.04.05]
// Firas Kassem  phiras.wordpress.com || phiras at gmail {dot} com
// for more information : http://phiras.wordpress.com/2007/04/08/password-strength-meter-a-jquery-plugin/

var shortPass = '/media/images/icons/security/security_password_none.png';
var badPass = '/media/images/icons/security/security_password_baixa.png';
var goodPass = '/media/images/icons/security/security_password_media.png';
var strongPass = '/media/images/icons/security/security_password_alta.png';
var read = false;

function toggleButton() {
    read = !read;
    console.info("read="+read);
}

function passwordStrength(password) {
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