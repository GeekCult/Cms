/*
    Document   : newsletter admin
    Created on : 15/07/2011, 09:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

$(document).ready(function(){        
    if($("#helper_action").attr('data-js-action') != 'listar_templates')initEmailListeners(); 
    if($("#helper_action").attr('data-js-action') == 'listar_templates')initEmailTemplatesListeners(); 
});


function initEmailListeners(){

    $('#bt_submit').click(function(){
        submitEmail();
    });
    
    $('#bt_send').click(function(){
        sendEmailMKT();
    });

    $('.bt_delete').click(function(){
        verifyAction(this.name);
    });
    
    $('.bt_email_emkt').click(function(){
        window.location = "/admin/email/template/" + this.name;
    });
    
    $("input[name='chamado']").change(function(){
        if($("input[name='chamado']").is(':checked')){
            $(".container_chamado_email").css("display", "block");
        }else{
            $(".container_chamado_email").css("display", "none");
        }
    });
    
    $('#bt_define').click(function(){
        updateForm();
    });
}

/*
 * Just for templates
 * @returns {undefined}
 * 
 */
function initEmailTemplatesListeners(){

    $('.bt_delete').click(function(){
        showAlertDimCancelAdvanced(this.name, deleteTemplate);
    });
}

//Send a e-mail to a specific user
function sendEmailMKT(){
    
    var nome = $('#nome').val();
    var email = $('#email').val();
    var message = $('#mensagem').val();
    var titulo = $('#titulo').val();
    var tipo = "template";
    var link = $('#link').val();
    var template = $("input[name='template']").is(':checked');
    var chamado = $("input[name='chamado']").is(':checked');
    var newsletter = $("input[name='newsletter']").is(':checked');
    var padrao = $("input[name='default']").is(':checked');
    var image  = $('#slot_pict_id_1').attr("src");
    var ramo_atuacao  = $('#ramo_atuacao').val();
    var abordagem  = $('#abordagem').val();
    var id_template  = $('#template').val();
    
    if(email != ''){
        $.post("/admin/email/enviar_emkt",{
            titulo_email: titulo,
            nome: nome,
            email: email,
            mensagem: message,
            template: template,
            chamado: chamado,
            newsletter: newsletter,
            tipo: tipo,
            titulo_chamado: $('#titulo_chamado').val(),
            prioridade: "baixa",
            data_final: "00/00/0000",
            descricao: $('#descricao_chamado').val(),
            image: image,
            padrao: padrao,
            ramo_atuacao: ramo_atuacao,
            abordagem: abordagem,
            link: link,
            id_template: id_template,
            open_prospect: $("input[name='insert_prospect']").is(':checked')

        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    }else{
        
    }
}

//Submit a new e-mail to newsletter
function submitEmail(){

    var email = $('#email').val();

    $.post("/admin/email/cadastrar",{
        email: email
    },function(data){            
        showAlertDim(data);
        $('#email').val("");
    });
}

/*
 * It shows an alertDim with a cancel or not action.
 * It works together the method bellow:  
 * 
 * PS: Functions callBacks:
 * 
 * cancelActionAlertDim();
 * completeActionAlertDim();
 *
 * @param number id
 * @param number item
 *
 */
function verifyAction(id){    
    id_item = id;   
    showAlertDimCancel();
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){
    
    $("#obj_container_" + id_item).fadeOut("fast");

    $.post("/admin/email/remover",{
        id_email: id_item
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}


/*
 * It sends the values from the radio button
 * It defines a new header to the layout selected
 * 
 * PS: Before it's working with the picture ID, instead of picture 
 * name.
 *
 */
function updateForm(){
    
    var selected = $("input[name='opcao']:checked").val();    
    var local = $("#local").val();
    
    if(selected == "empty.png") selected = "";

    $.post("/admin/detalhes/" + local + "/alterar", {
        selected: selected
        
    },function(data){
        showAlertDim(data);
        clearForm();
    });
}

/* 
 * Remover promocao
 * 
 */
function deleteTemplate(id){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Excluindo...');

    $.post("/admin/email/remover_template",{
        id: id

    },function(data){
       showAlertDim(data);
       $("#obj_container_" + id).fadeOut("fast");
       setTimeout("tb_removeAlert('common')", 1500);
    });
}