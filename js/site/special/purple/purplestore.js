
/*
 * It buy a Item PurplePier.
 *
 * @param number id
 *
 */

$(document).ready(function(){        
    if($('#helper_action').attr('data-js-action') == 'editar' || $('#helper_action').attr('data-js-action') == 'editar_template') initEditarPurpleItems();
    if($('#helper_action').attr('data-js-action') == 'novo' || $('#helper_action').attr('data-js-action') == 'novo_template') initEditarPurpleItems();
    if($('#helper_action').attr('data-js-action') == 'novo' || $('#helper_action').attr('data-js-action') == 'nova_pagina') initEditarPurpleItems();
    
    
    if($('#helper_action').attr('data-js-action') == 'listar') initListarPurpleItems();
    if($('#helper_action').attr('data-js-action') == 'fatura') initFaturaPurpleStore();
    if($('#helper_action').attr('data-js-action') == 'editar_compra') initEditarCompra();
});


/*
 *  Edit or new action
 */
function initEditarPurpleItems(){ 
    
    setFileListener();
    
    $("#bt_submit, .icon_save").unbind('click');
    $("#bt_submit").click(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        var image = $('#slot_pict_id_0').attr('data-image-name');
        if($('#thumbname').val() != undefined && $('#thumbname').val() != '') image =$('#thumbname').val();
    
        $.post("/site/purplestore/salvar",{
            id: $('#helper_id').val(),
            tipo: $('#tipo').val(),
            modelo: $('#modelo').val(),
            cool: $('#cool').val(),
            titulo: $('#titulo').val(),
            descricao: $('#descricao').val(),
            valor: $('#valor').val(),
            valor_total: $('#valor_total').val(),
            promocao: $('#promocao').val(),
            date: $('#date').val(),
            lancamento: $("input[name='lancamento']").is(':checked'),
            action: $('#helper_action').attr('data-js-action'),
            image: image
            
        },function(data){
            var jsonObject = eval('(' + data + ')'); 
            showAlertDim(jsonObject['message']);
        });
    });
    
    //Menushortcut
    $(".icon_save").click(function(){
        $("#bt_submit").trigger('click');
    });
    
    $("#tipo").change(function(){
       $('#helper_action').attr('data-type', $(this).val());
       $('#helper_action').attr('data-path', $("#tipo option:selected").attr('data-tipo'));
       setFileListener();
    });
}

/*
 * Listar items and compras
 * 
 */
function initListarPurpleItems(){ 
    
    //Buy item purplestore
    $(".bt_buy_item_pp").click(function(){
        buyPPItem(this.id, this.name);
    });
    
    $(".bt_edit").click(function(){
        if($(this).attr('data-link') != ""){
            window.location = $(this).attr('data-link');
        }else{
            showAlertDim('Esse item não possui settings');
        } 
    });
    
    $(".exibe_item").click(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Atualizando Sistema...');
        $.post("/site/purplestore/exibe_item",{id: this.id, status: $(this).is(':checked')},function(data){showAlertDim(data);});
    });
    
}

function buyPPItem(id, tipo){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Comprando...');

    $.post("/purplestore/comprar",{
        id: id,
        tipo: tipo
    },function(data){
        var jsonObject = eval('(' + data + ')'); 
        if(jsonObject['ERROR'] > 0){
            showAlertDim("Erro!");
        }else{
            loadNewPurchasedItem(tipo, jsonObject);
        }
        
    });
}

function loadNewPurchasedItem(type, jsonObject){

    switch(type){
        case "article":
            showAlertDim("Done");
            break;
        case "banner":
            showAlertDim(jsonObject['message']);
            break;
        default:
            showAlertDim(jsonObject['message']);
            break;
    }
}


function setFileListener(){
    
    var path_folder = "media/images/" + $('#helper_action').attr('data-path') + '/';
    var current_file = $('#helper_action').attr('data-current-file');
    
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/admin/downloads/upload",
        params: {path: path_folder, current_file: current_file, replace: true},
        debug: false,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){
                
                $('#file_helper').val(responseJSON['file_name']);                
                applyPictureSize(responseJSON['file_name'], 0, $('#helper_action').attr('data-type'), true);
            }
        }
    });
}

/*
 * Fatura
 * 
 */
function initFaturaPurpleStore(){ 
    
    $(".bt_edit").click(function(){  
        if($(this).attr('data-type') == 'compra'){
            window.location = '/admin/purplestore/editar_compra/' + $(this).attr('data-id'); 
        }
        if($(this).attr('data-type') == 'pedido'){
            window.location = '/admin/ordem_servico/editar_pedido/' + $(this).attr('data-id'); 
        } 
        if($(this).attr('data-type') == 'conta'){
            window.location = '/admin/financeiro/editar_conta/' + $(this).attr('data-id'); 
        }
    });
    
    $(".bt_delete").click(function(){  
         
        if($(this).attr('data-type') == 'conta'){
            showAlertDimCancelAdvanced($(this).attr('data-id'), removeContaFromERP, 'Tem certeza que desaja remover está conta?');
            
            
        }
    });
    
    //Envia e-mail para Adminstrador checar se fatura esta ok
    $("#bt_check").click(function(){  
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Enviando...');
        
        $.post("/site/cobranca/user/",{id: $(this).attr('data-id'), email: $("#email_check").val()},function(data){
            var jsonObject = eval('(' + data + ')'); 
            if(jsonObject['result'] > 0){
                showAlertDim("Erro!");
            }else{
                showAlertDim(jsonObject['message']);
            }
        });
    });
    
    //Envia e-mail para cliente
    $("#bt_send_invoice").click(function(){  
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Enviando...');
        
        $.post("/site/cobranca/user/",{id: $(this).attr('data-id'), email: $(this).attr('data-email')},function(data){
            var jsonObject = eval('(' + data + ')'); 
            if(jsonObject['result'] > 0){
                showAlertDim("Erro!");
            }else{
                showAlertDim(jsonObject['message']);
            }
        });
    });
}

/*
 * Fatura, edita a conta
 * 
 */
function initEditarCompra(){ 

    $('#bt_submit, .icon_save').click(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
       $.post("/admin/purplestore/atualizar_compra",{
            id: $('#helper_action').attr('data-id'),
            titulo: $('#titulo').val(),
            descricao: $('#descricao').val(),
            desconto: $('#desconto').val()

        },function(data){
            var jsonObject = eval('(' + data + ')');        
            showAlertDim(jsonObject['message']); 

        }); 
    })
    
}

/*
 * Fatura, remove uma conta do ERP financeiro
 * Sempre é melhor adicionar desconto que remover
 * 
 */
function removeContaFromERP(id){ 

   showAlertDimPreloader(true, 'Apagando...');
   $.post("/admin/financeiro/remover_conta",{id: id

    },function(data){
        var jsonObject = eval('(' + data + ')');        
        showAlertDim(jsonObject['message']);
        $('#contIt_' + id).fadeOut('300');
    });   
}
