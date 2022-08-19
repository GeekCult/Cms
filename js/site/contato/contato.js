/*
    Document   : contact
    Created on : 16/11/2010, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript contact controller
    Purpose of the javascript follows.
*/

var pressContactFm = false;


$(document).ready(function(){
    if($('#helper_action').attr('data-js-action') == 'contato') initContactListeners();
    if($('#helper_action').attr('data-js-action') == 'depoimentos') initDepoimentosListener();
});

function initContactListeners(){
    
    initBlurContatoAction();

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#fieldset_form').keyup(function(event){
        if(event.keyCode == '13'){submitContactForm();}
    });

    $("#bt_submit_contato").on('click', function(e){  
        if(!pressContactFm) submitContactForm();        
    });

    $('#bt_clear_contato').click(function(e){    
        clearForm();
    });
    
    $("#fone").mask("(99) 99999-9999");

};//Close Document Ready

function submitContactForm(){

    var nome = $('#nome').val();
    var email = $('#email').val();
    var mensagem = $('#mensagem').val();
    var fone = $('#fone').val();
    var content = "Site - Contato";
    var tipo = "contato";
    pressContactFm = true;
    
    $('#output_contact').empty().append("<div class='bg-info'><span>Enviando... </span></div>");

    $.post("/email/submitemail",{
        nome: nome,
        tipo: tipo,
        email: email,
        telefone: fone,
        mensagem: mensagem,
        content: content

    },function(data){
        //It transforms the returned json array in an object
        var jsonObject = eval('(' + data + ')');

        $('#output_contact').empty();

        if(jsonObject['ERROR'] != '0') {

           for(i = 0; i< jsonObject['ERROR_MSG'].length; i++){
                switch(jsonObject['ERROR_MSG'][i] ){
                     case "nome":
                        $('#output_contact').empty().append("<div class='bg-danger'><span>Preencha o campo nome</span></div>");
                        break;
                        
                    case "email":
                        $('#output_contact').empty().append("<div class='bg-danger'><span>Campo e-mail preenchido incorreto</span></div>");
                        break;

                    case "telefone":
                        $('#output_contact').empty().append("<div class='bg-danger'><span>Campo telefone preenchido incorreto</span></div>");
                        break;

                    case "mensagem":
                        $('#output_contact').empty().append("<div class='bg-danger'><span>Preencha o campo mensagem</span></div>");
                        break;
                }                
            }
        }else{
            $('#output_contact').empty().append("<div class='bg-success'><span>Sua mensagem foi enviada com sucesso!</span></div>");
            if(typeof _gap !== 'undefined') _gaq.push(['_trackPageview', '/contato_envio_realizado']);
            if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv': '/contato_envio_realizado'});
   
            clearForm();
        } 
        
        pressContactFm = false;
    });
}

function clearForm(){

    $('#nome').val("");
    $('#email').val("");
    $('#fone').val("");
    $('#mensagem, #comentario, #titulo').val("");

}

function initBlurContatoAction(){

    $('#nome').focus(function(){        
        if($('#nome').val() == "Nome"){
            $('#nome').val('');
        }
    });

    $('#nome').blur(function(){
        if($('#nome').val() == ''){
           $('#nome').val('Nome');
        }
    });

    $('#email').focus(function(){
        if($('#email').val() == "E-mail"){
            $('#email').val('');
        }
    });

    $('#email').blur(function(){
        if($('#email').val() == ''){
           $('#email').val('E-mail');
        }
    });

    $('#fone').focus(function(){
        if($('#fone').val() == "Fone"){
            $('#fone').val('');
        }
    });

    $('#fone').blur(function(){
        if($('#fone').val() == ''){
           $('#fone').val('Fone');
        }
    });

    $('#mensagem').focus(function(){
        if($('#mensagem').val() == "Mensagem"){
            $('#mensagem').val('');
        }
    });

    $('#mensagem').blur(function(){
        if($('#mensagem').val() == ''){
           $('#mensagem').val('Mensagem');
        }
    });
}

/*
 * Create drill account
 *
 */
function initDepoimentosListener(){
    
    $('#bt_next_depoimento').click(function(){
        $('.avatar_container_avatar, .avatar_container_avatar2').show();
        $('.container_simple_contact').hide();
    });
    
    $('#bt_back_depoimento').click(function(){
        $('.avatar_container_avatar, .avatar_container_avatar2').hide();
        $('.container_simple_contact').show();
    });
    
    $('#bt_submit_depoimento').click(function(){
        $('#output').empty().append("<div class='bg-info'>Enviando...</div>");
        
        var email = $('#email').val();
        var nome = $('#nome').val();
        var comentario = $('#comentario').val();
        var avatar = $('#formAvatar').val();
        
        if(email != '' && nome != '' && comentario != ''){
            createDrillAccount(nome, email, avatar, true, sendDepoimento);
        }else{
            $('#output').empty().append("<div class='bg-danger'>Todos os campos devem ser preenchidos</div>");
        }
    });
    
    
}

/*
 * Posta o comentario
 * 
 */
function sendDepoimento(data){
   
   var jsonObject = eval('(' + data + ')');
   
   var email = $('#email').val();
   var nome = $('#nome').val();
   var titulo = $('#titulo').val();
   var comentario = $('#comentario').val();
    
   $.post("/admin/depoimentos/cadastrar",{
        id: '',
        id_user: jsonObject['id'],
        nome: nome,
        titulo: titulo,
        title: titulo,
        comentario: comentario,
        resposta: '',
        id_general: 0,
        email: email,
        tipo: 'depoimentos'

    },function(data){
        var jsonObject = eval('(' + data + ')');
        $('#output').empty().append("<div class='bg-success'>" + jsonObject['MESSAGE'] + "</div>");
        clearForm();
    });
}