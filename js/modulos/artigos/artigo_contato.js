/*
    Document   : artigo_contato
    Created on : 16/07/2015, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript contact controller
    Purpose of the javascript follows.
*/

var pressContactFm = false;


$(document).ready(function(){
    initArtigoContactListeners();
});

function initArtigoContactListeners(){

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#fieldset_form').keyup(function(event){
        if(event.keyCode == '13'){submitContactForm();}
    });

    $("#bt_submit_contato").on('click', function(e){  
        if(!pressContactFm) submitContactFormArtigo();        
    });

    $('#bt_clear_contato').click(function(e){    
        clearForm();
    });
};//Close Document Ready

function submitContactFormArtigo(){

    var nome = $('#ajax-contacts #nome').val();
    var email = $('#ajax-contacts #email').val();
    var mensagem = $('#ajax-contacts #mensagem').val();
    var fone = $('#ajax-contacts #fone').val();
    var content = "Site - Contato";
    var tipo = "contato";
    pressContactFm = true;
    
    $('#output_contact').empty().append("<div class='bg-info'><span>Enviando... </span></div>");

    $.post("/site/email/submitemail",{
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
    $('#ajax-contacts #nome').val("");
    $('#ajax-contacts #email').val("");
    $('#ajax-contacts #fone').val("");
    $('#ajax-contacts #mensagem, #ajax-contacts #comentario, #ajax-contacts #titulo').val("");
}