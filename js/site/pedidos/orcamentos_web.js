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
    
    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#cep').keyup(function(event) {
        var cep = $('#cep').val();
        if (cep.length == 9) {
            $.post('/cep/webservice',{
            cep: cep
            }, function(data) {
                var state_combo = document.getElementById('state');                
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                $('#endereco').val(jsonObject['tp_logradouro'] + ': ' + jsonObject['logradouro']);
                $('#cidade').val(jsonObject['cidade']);
                $('#bairro').val(jsonObject['bairro']);
                state_combo.value = jsonObject['id_uf'];
            });
        }
    });


});//Close Document Ready

function submitOrcamentoForm(){
    
    $('#output_contact').removeClass('bg-danger').removeClass('bg-success').removeClass('bg-info');
    $('#output_contact').empty().append("<div>Enviando...</div>").addClass('bg-info');

    $.post("/email/submitorcamentoweb",{
        data: $("form#form_orcamento").serialize()

    },function(data){
        //It transforms the returned json array in an object
        var jsonObject = eval('(' + data + ')');

        $('#output_contact').empty().removeClass('bg-danger').removeClass('bg-success').removeClass('bg-info');
        
        if(jsonObject['ERROR'] != '0') {  

           for(i = 0; i< jsonObject['ERROR_MSG'].length; i++){
                switch(jsonObject['ERROR_MSG'][i] ){
                    
                    case "dominio":
                        $('#output_contact').append("<div class='output_message'><span>Campo domínio deve ser preenchido</span></div>");
                        break;
                        
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