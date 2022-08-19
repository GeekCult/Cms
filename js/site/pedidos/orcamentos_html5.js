/*
    Document   : contact
    Created on : 16/11/2010, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript contact controller
    Purpose of the javascript follows.
*/

$(document).ready(function(){

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#fieldset_form').keyup(function(event){
        if (event.keyCode == '13'){
            submitContactForm();
        }
    });

    $("#bt_submit_pedido").click(function(e){
        submitOrcamentoForm();
    });

    $('#bt_clear').click(function(e){
        clearForm();
    });


});//Close Document Ready

function submitOrcamentoForm(){

    var nome = $('#nome').val();
    var contato = $('#contato').val();
    var email = $('#email').val();
    var mensagem = $('#mensagem').val();
    var telefone = $('#ddd_fone').val() + "-" + $('#nr_fone').val();
    var celular = $('#ddd_cel').val() + "-" + $('#nr_cel').val();
    var cep = $('#cep').val();
    var endereco = $('#endereco').val();
    var cidade = $('#cidade').val();
    var estado = $('#estado').val();
    var tipo_contato = $('#tipo_contato').val();

    var content = "Teste - ";
    
    $('#output_contact').removeClass('bg-danger').removeClass('bg-success').removeClass('bg-info');
    $('#output_contact').empty().append("<div>Enviando...</div>").addClass('bg-info');

    $.post("/email/submitorcamento",{
        email: email,
        data: $("form#form_orcamento").serialize()

    },function(data){
        //It transforms the returned json array in an object
        var jsonObject = eval('(' + data + ')');

        $('#output_contact').empty();
        $('#output_contact').removeClass('bg-danger').removeClass('bg-success').removeClass('bg-info');
        
        if(jsonObject['ERROR'] != '0') {  

           for(i = 0; i< jsonObject['ERROR_MSG'].length; i++){
                switch(jsonObject['ERROR_MSG'][i] ){

                     case "nome":
                        $('#output_contact').append("<div class='output_message'><span>Preencha o campo nome</span></div>");
                        break;

                    case "email":
                        $('#output_contact').append("<div class='output_message'><span>Campo e-mail preenchido incorreto</span></div>");
                        break;

                    case "telefone":
                        $('#output_contact').append("<div class='output_message'><span>Campo telefone preenchido incorreto</span></div>");
                        break;

                    case "mensagem":
                        $('#output_contact').append("<div class='output_message'><span>Preencha o campo mensagem</span></div>");
                        break;
                }
                $('#output_contact').addClass('bg-danger');
            }

        }else{
            $('#output_contact').append("<div class='output_message'><span>Sua mensagem foi enviada com sucesso!</span></div>");
            $('#output_contact').addClass('bg-success');
            clearForm();
        }
    });
}

function clearForm(){
    $('#nome').val("");
    $('#email').val("");
    $('#fone').val("");
    $('#mensagem').val("");
}