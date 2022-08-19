/*
    Document   : send mail
    Created on : 13/01/2011, 09:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/


$(document).ready(function(){
    $('#bt_submit,  .bt_submit_friend').click(function(){submitForm();});
    $('#bt_clear').click(function(){clearForm();});

});//Close Document Ready


/*
 * It clear the textfield
 *
 */
function clearForm(){
    $("#name").val("");
    $("#email").val("");
}

/*
 * It sends the values from the textfield to a specific controller.
 * It fowards to relate user the right message.
 *
 */
function submitForm(){

    var name = $('#name_indique_amigo').val();
    var email = $('#email_indique_amigo').val();
    var mensagem = $('#mensagem_indique_amigo').val();
    var titulo_interesse = parent.$('#helper_action').attr('data-titulo-indicacao');
    var texto_interesse = parent.$('#helper_action').attr('data-texto-indicacao');
    
    $("#output_indique_amigo").empty().append("<div class='mgB mgT bg-info'>Enviando...</div>");
    
    $.post("/site/email/indiqueamigo", {
        nome: name,
        email: email,
        mensagem:mensagem,
        titulo_interesse: titulo_interesse,
        texto_interesse: texto_interesse

    },function(data){
        var json_data_object = eval("(" + data + ")");
        if(json_data_object['ERROR'] > 0){
            $("#output_indique_amigo").empty().append("<div class='mgB mgT bg-danger'>E-mail incorreto</div>");
            
        }else{
            $("#output_indique_amigo").empty().append("<div class='mgB mgT bg-success'>Mensagem enviada com sucesso!</div>");
        }
    });
}